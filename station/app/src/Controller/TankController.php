<?php

namespace App\Controller;

use App\Entity\Tank;
use App\Form\TankFormType;
use App\Repository\TankRepository;
use App\Service\TankService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class TankController extends AbstractController
{
    public function __construct(private TankRepository $tankRepository, private TankService $tankService)
    {
    }

    #[Route('/tank', name: 'app_tank')]
    public function index(): Response
    {
        return $this->render('tank/index.html.twig', [
            'tanks' => $this->tankRepository->findAll()
        ]);
    }

    #[Route('/add-tank', name: 'app_add_tank')]
    public function addTank(Request $request): Response
    {
        $tank = new Tank();
        $form = $this->createForm(TankFormType::class, $tank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->tankService->createOrUpdateTank($tank);
                $this->addFlash('success', 'Cuve crée avec succès');
                return $this->redirectToRoute('app_tank', [
                    'tanks' => $this->tankRepository->findAll()
                ]);
            } catch (Throwable $e) {
                $this->addFlash('error', 'Erreur lors de la création de la cuve');
                throw new Exception($e->getMessage());
            }
        }

        return $this->render('tank/add.html.twig', [
            'addTankForm' => $form
        ]);
    }

    #[Route('/edit-tank/{id}', name: 'app_edit_tank')]
    public function editTank(Tank $tank, Request $request): Response
    {
        $form = $this->createForm(TankFormType::class, $tank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->tankService->createOrUpdateTank($tank);
                $this->addFlash('success', 'Cuve modifiée avec succès');
                return $this->redirectToRoute('app_tank', [
                    'tanks' => $this->tankRepository->findAll()
                ]);
            } catch (Throwable $e) {
                $this->addFlash('error', 'Erreur lors de la modification de la cuve');
                throw new Exception($e->getMessage());
            }
        }

        return $this->render('tank/edit.html.twig', [
            'editTankForm' => $form
        ]);
    }
}
