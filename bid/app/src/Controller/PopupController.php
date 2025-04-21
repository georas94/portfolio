<?php

namespace App\Controller;

use App\Repository\AORepository;
use App\Service\GeoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PopupController extends AbstractController
{
    public function __construct(readonly AORepository $AORepository, readonly GeoService $geoService)
    {
    }

    #[Route('/api/popup/{id}', name: 'api_popup', methods: ['GET'])]
    public function getPopupContent(int $id): Response
    {
        $ao = $this->AORepository->find($id);
        if (!$ao) {
            return new Response('Projet non trouvé', 404);
        }

        $address = $this->geoService->getLocation($ao->getLocation()['lat'], $ao->getLocation()['lng']);
        $label = $this->geoService->getCityLabel($address);

        return $this->render('/ao/component/_popup.html.twig', [
            'ao' => $ao,
            'city' => $label
        ], new Response(null, 200, [
            'Cache-Control' => 'public, max-age=3600' // Cache 1h
        ]));
    }
}