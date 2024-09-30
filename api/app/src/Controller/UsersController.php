<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Throwable;

class UsersController extends AbstractController
{
    public function __construct(private UserRepository $userRepository, private NormalizerInterface $normalizer)
    {
    }

    #[Route('/', name: 'app')]
    public function index(): JsonResponse
    {
        return $this->json([
            'Bienvenue !'
        ]);
    }

    #[Route('/users', name: 'app_users')]
    public function users(): JsonResponse
    {
        try{
            return $this->json($this->normalizer->normalize($this->userRepository->findAll()));
        }catch(Throwable $exception){
            return $this->json([
                'error' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);
        }
    }

    #[Route('/users/{id}', name: 'app_user_view')]
    public function viewUser(Request $request): JsonResponse
    {
        try{
            if(!$request->get('id') || !is_int((int)$request->get('id'))){
                throw new Exception("L'id fournit n'est pas correct", 400);
            }
            $user = $this->userRepository->find($request->get('id'));
            if(!$user){
                throw new Exception("Utilisateur non trouvé en base de données", 400);
            }

            return $this->json($this->normalizer->normalize($user));
        }catch(Throwable $exception){
            return $this->json([
                'error' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);
        }

    }
}
