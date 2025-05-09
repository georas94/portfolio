<?php

namespace App\Controller;

use App\Entity\AO;
use App\Entity\AODocument;
use App\Entity\Soumission;
use App\Enum\SectorEnum;
use App\Form\AOType;
use App\Form\SoumissionType;
use App\Service\AO\AOUtils;
use App\Service\AO\StatutAOUtils;
use App\Service\DocumentManager;
use App\Service\GeoService;
use App\Service\MapHelper;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Uid\Uuid;
use Throwable;

#[Route('/ao', name: 'app_ao_')]
class AOController extends AbstractController
{
    private Client $elasticClient;
    private const ELASTIC_SEARCH_INDEX_NAME = 'ao';
    //Par défaut 700 000 000 millions Xof
    private const FILTER_MAX_VALUE = 700000000;
    private const ALLOWED_DOCUMENT_TYPES = [
        'application/pdf',
        'image/jpeg',
        'image/png',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/msword',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    /**
     * @throws AuthenticationException
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly DocumentManager        $docManager,
        private readonly AOUtils                $AOUtils,
        private readonly geoService             $geoService,
    )
    {
        $this->elasticClient = ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
//            ->setBasicAuthentication('elastic', 'votre_mot_de_passe') // Si sécurité activée
            ->build();
    }

    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(SerializerInterface $serializer, Request $request): Response
    {
        $status = [
            StatutAOUtils::STATUS_ACTIVE
        ];
        if ($this->isGranted('ROLE_ADMIN')) {
            $status[] = StatutAOUtils::STATUS_DRAFT;
            $status[] = StatutAOUtils::STATUS_ACTIVE;
            $status[] = StatutAOUtils::STATUS_IN_PROGRESS;
            $status[] = StatutAOUtils::STATUS_CANCELLED;
        }

        $q = $request->query->get('q', '');
        $min = $request->query->get('min', '');
        $max = $request->query->get('max', '');

        $qb = $this->entityManager->createQueryBuilder()
            ->select('ao')
            ->from(AO::class, 'ao')
            ->leftJoin('ao.entreprise', 'e')->addSelect('e');

        $qb->andWhere('ao.statut IN (:statuts)')->setParameter('statuts', $status);
        if ($q) {
            $qb->andWhere('ao.titre LIKE :q OR e.nom LIKE :q')->setParameter('q', "%{$q}%");
        }
        if ($min) {
            $qb->andWhere('ao.budget >= :min')->setParameter('min', $min);
        }
        if ($max) {
            $qb->andWhere('ao.budget <= :max')->setParameter('max', $max);
        }

        $aos = $qb->orderBy('ao.dateLimite', 'ASC')->getQuery()->getResult();

        $geoJsonData = json_decode(file_get_contents($this->getParameter('kernel.project_dir') . '/public/assets/geo_data/burkina-faso.geojson'), true);
        // Si requête AJAX, on renvoie JSON
        if ($request->isXmlHttpRequest()) {
            // Formatage des données pour AJAX
            $data = [
                'html' => $this->renderView('ao/component/_results.html.twig', ['aos' => $aos]),
                'markers' => $this->formatMarkers($aos), // Données pour la carte,
                'count' => count($aos),
                'sample' => array_slice($aos, 0, 5), // Affiche max 5 éléments en preview
                'bounds' => MapHelper::calculateBounds($aos) // Calcul des coordonnées du cluster
            ];

            return new JsonResponse($data);
        }

        // Sinon page normale
        return $this->render('ao/list/list.html.twig', [
            'aos' => $aos,
            'q' => $q,
            'min' => $min,
            'max' => $max,
            'filterMaxValue' => self::FILTER_MAX_VALUE,
            'cancelledStatus' => StatutAOUtils::STATUS_CANCELLED,
            'publishedStatus' => StatutAOUtils::STATUS_ACTIVE,
            'draftStatus' => StatutAOUtils::STATUS_DRAFT,
            'assignedStatus' => StatutAOUtils::STATUS_IN_PROGRESS,
            'SectorEnumCategories' => SectorEnum::getByCategory(),
            'geoJsonData' => $geoJsonData,
        ]);
    }

    // 1. Création d'un nouvel AO
    #[Route('/nouveau', name: 'create', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function create(
        Request                                                                $request,
        SluggerInterface                                                       $slugger,
        #[Autowire('%kernel.project_dir%/public/uploads/ao_documents')] string $documentsDirectory
    ): Response
    {
        $ao = new AO();
        $form = $this->createForm(AOType::class, $ao);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion des fichiers uploadés
            $uploadedFiles = $form->get('documents')->getData() ?? [];
            foreach ($uploadedFiles as $uploadedFile) {
                // Vérifiez d'abord si le fichier est valide
                if (!$uploadedFile->isValid()) {
                    $this->addFlash('error', 'Fichier invalide: ' . $uploadedFile->getClientOriginalName());
                    continue;
                }

                // Vérifiez que le fichier temporaire existe
                if (!file_exists($uploadedFile->getPathname())) {
                    $this->addFlash('error', 'Erreur technique avec le fichier: ' . $uploadedFile->getClientOriginalName());
                    continue;
                }

                // Déplacez le fichier immédiatement
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $namespace = Uuid::fromString(Uuid::NAMESPACE_OID);
                $uuid = Uuid::v3($namespace, $safeFilename . '-' . uniqid());

                $newFilename = $uuid->toString() . '.' . $uploadedFile->guessExtension();
                try {

                    $document = new AODocument();
                    $document->setFileName($newFilename); // Stockez le nom du fichier
                    $document->setOriginalName($uploadedFile->getClientOriginalName()); // Conservez le nom original
                    $document->setMimeType($uploadedFile->getMimeType());
                    $document->setUploadedAt(new DateTimeImmutable());
                    $document->setFileSize($uploadedFile->getSize());
                    $ao->addDocument($document);

                    $uploadedFile->move(
                        $documentsDirectory,
                        $newFilename
                    );

                    $this->entityManager->persist($document);
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Erreur lors de l\'enregistrement: ' . $e->getMessage());
                }
            }

            $ao->setPdfPath($this->docManager->generateDossier($ao, $this->getUser(), 'PDF_CREATE'));
            $this->entityManager->persist($ao);
            $this->entityManager->flush();

            $this->addFlash('create_ao_success', 'AO créé avec succès');
            return $this->redirectToRoute('app_ao_detail', ['id' => $ao->getId()]);
        }

        return $this->render('ao/create/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}/modifier', name: 'edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(AO $ao, Request $request): Response
    {
        $originalAo = clone $ao;

        $form = $this->createForm(AOType::class, $ao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $changes = AOUtils::getEntityChanges($originalAo, $ao);
            if (!empty($changes)) {
                $this->AOUtils->logChanges($ao, $this->getUser(), 'UPDATE', $changes);
            }

            // Re-générer le PDF si nécessaire
            if ($form->get('regenerate_pdf')->getData()) {
                $ao->setPdfPath($this->docManager->generateDossier($ao, $this->getUser(), 'PDF_REGENERATE'));
            }

            $this->entityManager->flush();

            $this->addFlash('edit_ao_success', 'AO modifié avec succès');
            return $this->redirectToRoute('app_ao_detail', ['id' => $ao->getId()]);
        }

        return $this->render('ao/edit/edit.html.twig', [
            'ao' => $ao,
            'form' => $form->createView()
        ]);
    }

    // 2. Soumission à un AO
    #[Route('/{id}/soumettre', name: 'submit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ENTREPRISE')]
    public function submit(AO $ao, Request $request, DocumentManager $docManager): Response
    {
        // Vérification date de clôture
        if ($ao->getDateLimite() < new DateTime()) {
            throw $this->createAccessDeniedException('La date de clôture est dépassée');
        }

        $soumission = new Soumission();
        $form = $this->createForm(SoumissionType::class, $soumission);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Génération du PDF
            $ao->setPdfPath($this->docManager->generateDossier($ao, $this->getUser(), 'PDF_CREATE'));
            $this->entityManager->persist($ao);
            $this->entityManager->flush();

            $soumission->setEntreprise($this->getUser());
            $soumission->setAo($ao);
            $soumission->setDateSoumission(new DateTime());
            $this->entityManager->persist($soumission);
            $this->entityManager->flush();

            $this->addFlash('success', 'Soumission enregistrée');
            return $this->redirectToRoute('app_ao_list');
        }

        return $this->render('ao/submit/submit.html.twig', [
            'ao' => $ao,
            'form' => $form->createView()
        ]);
    }

    // 4. Détail d'un AO
    #[Route('/{id}', name: 'detail', methods: ['GET'])]
    public function detail(AO $ao): Response
    {
        return $this->render('ao/detail/detail.html.twig', [
            'ao' => $ao,
            'cancelledStatus' => StatutAOUtils::STATUS_CANCELLED,
            'publishedStatus' => StatutAOUtils::STATUS_ACTIVE,
            'draftStatus' => StatutAOUtils::STATUS_DRAFT,
            'assignedStatus' => StatutAOUtils::STATUS_IN_PROGRESS,
            'canSubmit' => $this->isGranted('ROLE_ENTREPRISE')
                && $ao->getDateLimite() > new DateTime()
        ]);
    }

    // 5. Clôturer un AO
    #[Route('/{id}/cloturer', name: 'close', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function close(AO $ao): Response
    {
        $ao->setStatut(StatutAOUtils::STATUS_CANCELLED);
        $this->entityManager->flush();

        // TODO: Notifier les participants
        $this->addFlash('success', 'AO clôturé');
        return $this->redirectToRoute('app_ao_detail', ['id' => $ao->getId()]);
    }

    #[Route('/download/{id}', name: 'download_pdf')]
    public function downloadPdf(AO $ao): Response
    {
        return $this->file($this->getParameter('kernel.project_dir') . '/public' . $ao->getPdfPath());
    }

    #[Route('/document/{id}/preview', name: 'document_preview')]
    public function previewDocument(AODocument $document, KernelInterface $kernelInterface): Response
    {
        $filePath = $kernelInterface->getProjectDir() . '/public/uploads/ao_documents/test_pdf.pdf';// . $document->getFileName();
        $mimeType = $document->getMimeType();
        if (!file_exists($filePath)) {
            throw $this->createNotFoundException('Fichier introuvable');
        }

        // PDF - Stream avec en-têtes spécifiques
        if ($mimeType === 'application/pdf') {
            return new Response(
                file_get_contents($filePath),
                Response::HTTP_OK,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . $document->getOriginalName() . '"'
                ]
            );
        }

        // Images - BinaryFileResponse standard
        if (in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif'])) {
            return new BinaryFileResponse($document->getFileName(), 200, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline'
            ]);
        }

        throw $this->createNotFoundException('Type de fichier non supporté');
    }

    #[Route('/document/{id}/delete', name: 'delete_document', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteDocument(AODocument $document): Response
    {
        try {
            // 1. Préparer les données avant suppression
            $ao = $document->getAo();
            $documentData = [
                'document_id' => $document->getId(),
                'file_name' => $document->getFileName(),
                'original_name' => $document->getOriginalName(),
            ];

            // 2. Supprimer le document
            $filePath = $this->getParameter('kernel.project_dir') . '/public/uploads/ao_documents/' . $document->getFileName();
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $this->entityManager->remove($document);
            $this->entityManager->flush();

            // 3. Logger la suppression spécifique
            $this->AOUtils->logDocument($ao, $this->getUser(), $documentData, 'DOCUMENT_DELETE');

            return new Response(null, Response::HTTP_NO_CONTENT);

        } catch (Exception $e) {
            return new Response(
                $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    #[Route('/public/recherche', name: 'public_search', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function publicAOSearch(Request $request): Response
    {
        $query = trim($request->query->get('q', ''));

        $results = [];
        if (!empty($query)) {
            $searchParams = [
                'index' => 'ao',
                'body' => [
                    'size' => 20,
                    '_source' => [
                        'reference', 'entity', 'objet', 'hash_id', 'full_text', 'reference_number'
                    ],
                    'query' => [
                        'multi_match' => [
                            'query' => $query,
                            'fields' => [
                                'reference^4',
                                'entity^3',
                                'objet^2',
                                'full_text'
                            ],
                            'operator' => 'and',
                            'fuzziness' => 'AUTO'
                        ]
                    ],
                    'highlight' => [
                        'pre_tags' => ['<mark>'],
                        'post_tags' => ['</mark>'],
                        'fields' => [
                            'full_text' => [
                                'type' => 'fvh',
                                'fragment_size' => 200,
                                'number_of_fragments' => 2
                            ]
                        ]
                    ]
                ]
            ];

            $response = $this->elasticClient->search($searchParams);
            foreach ($response['hits']['hits'] as $hit) {
                $source = $hit['_source'];
                $highlight = $hit['highlight']['full_text'] ?? [];

                $results[] = [
                    'reference' => $source['reference'] ?? null,
                    'referenceNumber' => $source['reference_number'] ?? null,
                    'entity' => $source['entity'] ?? null,
                    'objet' => $source['objet'] ?? null,
                    'hash_id' => $source['hash_id'] ?? null,
                    'highlight' => $highlight,
                ];
            }
        }

        return $this->render('ao/public/public_search.html.twig', [
            'query' => $query,
            'results' => $results
        ]);
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     * @throws MissingParameterException
     */
    #[Route('/public/ao/{id}', name: 'public_detail')]
    public function showAO(string $id, Request $request): Response
    {
        $result = $this->elasticClient->get([
            'index' => self::ELASTIC_SEARCH_INDEX_NAME,
            'id' => $id
        ]);

        return $this->render('ao/public/public_detail.html.twig', [
            'ao' => $result['_source'],
            'query' => $request->query->get('q')
        ]);
    }

    private function formatMarkers(array $aos): array
    {
        return array_map(function (AO $ao) {
            $address = $this->geoService->getLocation($ao->getLocation()['lat'], $ao->getLocation()['lng']);
            $label = $this->geoService->getCityLabel($address);
            return [
                'lat' => $ao->getLocation()['lat'],
                'lng' => $ao->getLocation()['lng'],
                'popup' => $this->renderView('ao/component/_popup.html.twig', ['ao' => $ao, 'city' => $label]),
            ];
        }, $aos);
    }
}