<?php

namespace App\Controller;

use AODocument;
use App\Entity\AO;
use App\Entity\Soumission;
use App\Form\AOType;
use App\Form\SoumissionType;
use App\Service\AO\AOUtils;
use App\Service\DocumentManager;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/ao', name: 'app_ao_')]
class AOController extends AbstractController
{
    private const ALLOWED_DOCUMENT_TYPES = [
        'application/pdf',
        'image/jpeg',
        'image/png',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/msword',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly DocumentManager        $docManager
    ) {}

    // 3. Liste des AO
    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(): Response
    {
        $status = [
            'Publié'
        ];
        if (in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            $status[] = 'Brouillon';
        }
        $aos = $this->em->getRepository(AO::class)
            ->findBy(['statut' => $status], ['dateLimite' => 'ASC']);

        return $this->render('ao/list/list.html.twig', [
            'aos' => $aos
        ]);
    }

    // 1. Création d'un nouvel AO
    #[Route('/nouveau', name: 'create', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function create(Request $request): Response
    {
        $ao = new AO();
        $form = $this->createForm(AOType::class, $ao);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion des fichiers uploadés
            $uploadedFiles = $request->files->get('ao_form')['documents'] ?? [];
            foreach ($uploadedFiles as $uploadedFile) {
                if (!in_array($uploadedFile->getMimeType(), self::ALLOWED_DOCUMENT_TYPES)) {
                    $this->addFlash('error', 'Type de fichier non autorisé: ' . $uploadedFile->getClientOriginalName());
                    continue;
                }

                if ($uploadedFile->getSize() > 10 * 1024 * 1024) { // 10MB max
                    $this->addFlash('error', 'Fichier trop volumineux: ' . $uploadedFile->getClientOriginalName());
                    continue;
                }
                $document = new AODocument();
                $document->setFile($uploadedFile);
                $document->setOriginalName($uploadedFile->getClientOriginalName());
                $document->setMimeType($uploadedFile->getMimeType());
                $document->setUploadedAt(new \DateTimeImmutable());

                $ao->addDocument($document);
            }

            $pdfPath = $this->docManager->generateDossier($ao, $this->getUser());
            $ao->setPdfPath($pdfPath);
            $this->em->persist($ao);
            $this->em->flush();
            AOUtils::logChanges($ao, $this->getUser(), $this->em, 'CREATE');

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
                AOUtils::logChanges($ao, $this->getUser(), $this->em, 'UPDATE', $changes);
            }

            // Re-générer le PDF si nécessaire
            if ($form->get('regenerate_pdf')->getData()) {
                $pdfPath = $this->docManager->generateDossier($ao, $this->getUser());
                $ao->setPdfPath($pdfPath);
                AOUtils::logChanges($ao, $this->getUser(), $this->em, 'PDF_REGENERATE');
            }

            $this->em->flush();

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
        // Vérification date limite
        if ($ao->getDateLimite() < new DateTime()) {
            throw $this->createAccessDeniedException('La date limite est dépassée');
        }

        $soumission = new Soumission();
        $form = $this->createForm(SoumissionType::class, $soumission);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Génération du PDF
            $pdfPath = $docManager->generateDossier($ao, $this->getUser());
            $ao->setPdfPath($pdfPath);
            $this->em->persist($ao);
            $this->em->flush();

            $soumission->setEntreprise($this->getUser());
            $soumission->setAo($ao);
            $soumission->setDateSoumission(new DateTime());
            $this->em->persist($soumission);
            $this->em->flush();

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
            'canSubmit' => $this->isGranted('ROLE_ENTREPRISE')
                && $ao->getDateLimite() > new DateTime()
        ]);
    }

    // 5. Clôturer un AO
    #[Route('/{id}/cloturer', name: 'close', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function close(AO $ao): Response
    {
        $ao->setStatut('Clôturé');
        $this->em->flush();

        // TODO: Notifier les participants
        $this->addFlash('success', 'AO clôturé');
        return $this->redirectToRoute('app_ao_detail', ['id' => $ao->getId()]);
    }

    #[Route('/download/{id}', name: 'download_pdf')]
    public function downloadPdf(AO $ao): Response
    {
        return $this->file($this->getParameter('kernel.project_dir') . '/public' . $ao->getPdfPath());
    }
}