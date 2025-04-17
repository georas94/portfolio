<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LegalController extends AbstractController
{
    #[Route('/legal/mentions', name: 'app_legal_mentions')]
    public function mentions(): Response
    {
        return $this->render('legal/mentions.html.twig');
    }

    #[Route('/legal/conditions-generales', name: 'app_legal_conditions')]
    public function conditions(): Response
    {
        return $this->render('legal/conditions.html.twig');
    }
}
