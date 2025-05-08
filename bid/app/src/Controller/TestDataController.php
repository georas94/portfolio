<?php

namespace App\Controller;

use App\Entity\AO;
use App\Entity\AODocument;
use App\Entity\Entreprise;
use App\Enum\SectorEnum;
use App\Service\AO\StatutAOUtils;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TestDataController extends AbstractController
{
    #[Route('/generate-test-data', name: 'generate_test_data')]
    #[IsGranted('ROLE_ADMIN')]
    public function generateTestData(EntityManagerInterface $em): Response
    {

        $villes = [
            'Ouagadougou' => ['lat' => 12.3714, 'lng' => -1.5197],
            'Bobo-Dioulasso' => ['lat' => 11.1866, 'lng' => -4.2975],
            'Koudougou' => ['lat' => 12.2565, 'lng' => -2.3588],
            'Ouahigouya' => ['lat' => 13.5822, 'lng' => -2.4216],
            'Banfora' => ['lat' => 10.6333, 'lng' => -4.7667],
            'Tenkodogo' => ['lat' => 11.786925, 'lng' => -0.370633],
            'Boussé' => ['lat' => 12.663600, 'lng' => -1.895635],
        ];

        $secteurs = [
            ['batiment', 'infrastructure'],
            ['sante', 'education'],
            ['agriculture', 'energie'],
            ['transport', 'route'],
            ['eau', 'assainissement']
        ];

        $nomsEntreprises = [
            'BTP Burkina SA',
            'SOGEA-SATOM',
            'PFO Energie',
            'Eau Vive International',
            'SANTEK Medical'
        ];

        $typesProjet = [
            'la construction d\'une école primaire',
            'l\'aménagement d\'un centre de santé',
            'la réhabilitation de routes urbaines',
            'un projet d\'adduction d\'eau potable',
            'l\'installation de systèmes solaires',
            'la construction d\'un marché municipal',
            'un projet d\'assainissement'
        ];

        $descriptions = [
            'Projet important pour le développement local nécessitant une expertise technique avérée.',
            'Mission complexe intégrant plusieurs lots techniques et nécessitant une coordination rigoureuse.',
            'Projet financé par des bailleurs internationaux avec des exigences strictes de reporting.',
            'Marché public avec clauses sociales et environnementales à respecter impérativement.',
            'Projet pilote pouvant déboucher sur d\'autres marchés dans la région.'
        ];

        $statuses = [
            StatutAOUtils::STATUS_DRAFT,
            StatutAOUtils::STATUS_ACTIVE,
            StatutAOUtils::STATUS_IN_PROGRESS,
            StatutAOUtils::STATUS_EVALUATION,
            StatutAOUtils::STATUS_ATTRIBUTED
        ];

        $em->beginTransaction();
        try {
            // Création des entreprises fictives
            $entreprises = [];
            foreach ($nomsEntreprises as $nom) {
                $entreprise = new Entreprise();
                $entreprise->setNom($nom);
                $entreprise->setSectorCode(SectorEnum::getSector(SectorEnum::getRandomCodes(rand(1, 6))[0]));
                $em->persist($entreprise);
                $entreprises[] = $entreprise;
            }

            $em->flush();

            for ($i = 1; $i <= 15; $i++) {
                $ville = array_rand($villes);
                $secteur = $secteurs[array_rand($secteurs)];

                $ao = new AO();
                $ao->setReference('AO-2025-' . str_pad($i, 3, '0', STR_PAD_LEFT));
                $ao->setTitre('Appel d\'offres pour ' . $typesProjet[array_rand($typesProjet)]);
                $ao->setDescription($descriptions[array_rand($descriptions)]);
                $ao->setEntreprise($entreprises[array_rand($entreprises)]);
                $ao->setDateLimite(new DateTime('+' . rand(30, 180) . ' days'));
                $ao->setBudget(rand(50000000, 500000000));
                $ao->setStatut($statuses[array_rand($statuses)]);
                $ao->setLocation($villes[$ville]['lat'], $villes[$ville]['lng']);
                $ao->setZoneImpact([
                    'rayon' => rand(10, 100),
                    'secteurs' => $secteur
                ]);
                $ao->setPdfPath($this->getParameter('kernel.project_dir') . '/public/uploads/ao_documents/test_pdf.pdf');

                $docCount = rand(1, 3);
                for ($d = 1; $d <= $docCount; $d++) {
                    $document = new AODocument();
                    $document->setOriginalName("Document {$d} - Cahier des charges");
                    $document->setFileName(__DIR__.'/../public/uploads/ao_documents/test_pdf.pdf');
                    $document->setFileSize(15);
                    $document->setMimeType('application/pdf');
                    $document->setUploadedAt(new \DateTimeImmutable());
                    $ao->addDocument($document);
                }

                $em->persist($ao);
            }

            $em->flush();
            $em->commit();
        } catch (Exception $exception) {
            $em->rollback();
            dd($exception);
        }

        return new Response('15 appels d\'offres de test + entreprises générés avec succès!');
    }

    #[Route('/test', name: 'app_test')]
    #[IsGranted('ROLE_ADMIN')]
    public function test(EntityManagerInterface $em): Response
    {
        return new Response('OK');
    }
}
