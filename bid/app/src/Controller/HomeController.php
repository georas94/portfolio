<?php

namespace App\Controller;

use App\Entity\AO;
use App\Repository\AORepository;
use App\Service\AO\StatutAOUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(readonly AORepository $AORepository, readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $aos = $this->entityManager->getRepository(AO::class)
            ->findBy(['statut' => StatutAOUtils::STATUS_ACTIVE], ['dateLimite' => 'ASC'], 6);

        return $this->render('home/index.html.twig', [
            'aos' => $aos,
            'cancelledStatus' => StatutAOUtils::STATUS_CANCELLED,
            'publishedStatus' => StatutAOUtils::STATUS_ACTIVE,
            'draftStatus' => StatutAOUtils::STATUS_DRAFT,
            'assignedStatus' => StatutAOUtils::STATUS_IN_PROGRESS
        ]);
    }
}
