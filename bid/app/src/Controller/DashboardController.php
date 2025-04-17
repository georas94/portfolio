<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        $appelsOffres = [
            ['id' => 1, 'titre' => 'Développement Web', 'dateLimite' => (new \DateTime('now'))->format('Y-m-d'), 'description' => 'Description pour le développement web', 'organisation' => 'TechCorp'],
            ['id' => 2, 'titre' => 'Rénovation Domotique', 'dateLimite' => (new \DateTime('now'))->format('Y-m-d'), 'description' => 'Description pour la rénovation domotique', 'organisation' => 'HomeSmart'],
            ['id' => 3, 'titre' => 'Marketing Digital', 'dateLimite' => (new \DateTime('now'))->modify('+1 day')->format('Y-m-d'), 'description' => 'Description pour le marketing digital', 'organisation' => 'MarkTech'],
            ['id' => 4, 'titre' => 'Infrastructure réseau', 'dateLimite' => (new \DateTime('now'))->modify('+2 days')->format('Y-m-d'), 'description' => 'Description pour l\'infrastructure réseau', 'organisation' => 'RéseauPro'],
            ['id' => 5, 'titre' => 'Intégration Logiciels', 'dateLimite' => (new \DateTime('now'))->modify('+3 days')->format('Y-m-d'), 'description' => 'Description pour l\'intégration de logiciels', 'organisation' => 'LogicielPlus'],
            ['id' => 6, 'titre' => 'Développement Mobile', 'dateLimite' => (new \DateTime('now'))->modify('+4 days')->format('Y-m-d'), 'description' => 'Description pour le développement mobile', 'organisation' => 'MobileDev'],
            ['id' => 7, 'titre' => 'Sécurité Informatique', 'dateLimite' => (new \DateTime('now'))->modify('+5 days')->format('Y-m-d'), 'description' => 'Description pour la sécurité informatique', 'organisation' => 'SecureNet'],
            ['id' => 8, 'titre' => 'Anthropologie', 'dateLimite' => (new \DateTime('now'))->modify('+6 days')->format('Y-m-d'), 'description' => 'Description pour les services d\'anthropologie', 'organisation' => 'AnthroPlex'],
            ['id' => 9, 'titre' => 'Marketing Digital', 'dateLimite' => (new \DateTime('now'))->modify('+7 days')->format('Y-m-d'), 'description' => 'Description pour le marketing digital', 'organisation' => 'MarkTech2'],
            ['id' => 10, 'titre' => 'Gestion de Projet', 'dateLimite' => (new \DateTime('now'))->modify('+8 days')->format('Y-m-d'), 'description' => 'Description pour la gestion de projet', 'organisation' => 'ProjetManager'],
        ];

        return $this->render('home/home.html.twig', [
            'appels_offres' => $appelsOffres,
        ]);
    }
}
