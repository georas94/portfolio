<?php

namespace App\Controller;

use App\Repository\TankRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Throwable;

class TankController extends AbstractController
{
    public function __construct(private TankRepository $tankRepository, private NormalizerInterface $normalizer)
    {
    }

    #[Route('/tanks', name: 'app_tank_list')]
    public function tanks(): JsonResponse
    {
        try{
            return $this->json($this->normalizer->normalize($this->tankRepository->findAll()));
        }catch(Throwable $exception){
            return $this->json([
                'error' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);
        }
    }
}
