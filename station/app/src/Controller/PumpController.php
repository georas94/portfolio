<?php

namespace App\Controller;

use App\Entity\Pump;
use App\Entity\Shift;
use App\Enum\StatusTypeString;
use App\Form\PumpFormType;
use App\Form\ShiftEndFormType;
use App\Form\ShiftStartFormType;
use App\Repository\PumpRepository;
use App\Repository\ShiftRepository;
use App\Service\PumpService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class PumpController extends AbstractController
{
    public function __construct(private PumpRepository $pumpRepository,private ShiftRepository $shiftRepository, private PumpService $pumpService)
    {
    }

    #[Route('/pump', name: 'app_pump')]
    public function index(): Response
    {
        return $this->render('pump/index.html.twig', [
            'pumps' => $this->pumpRepository->findAll()
        ]);
    }

    #[Route('/pump-history', name: 'app_pump_history')]
    public function pumpHistory(Request $request): Response
    {
        return $this->render('pump/history.html.twig', [
            'shifts' => $this->shiftRepository->findBy([], ['status' => 'ASC']),
            'statusInProcess' => StatusTypeString::STATUS_IN_PROCESS->value,
            'statusEnded' => StatusTypeString::STATUS_COMPLETED->value,
        ]);
    }

    #[Route('/pump-start', name: 'app_pump_start')]
    public function pumpStart(Request $request): Response
    {
        $shift = new Shift();
        $form = $this->createForm(ShiftStartFormType::class, $shift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->pumpService->startOrEndShift($shift);
                $this->addFlash('success', 'Tournée crée avec succès');
                return $this->redirectToRoute('app_pump_history', [
                    'shifts' => $this->shiftRepository->findAll()
                ]);
            } catch (Throwable) {
                $this->addFlash('error', 'Erreur lors de la création de la tournée');
            }
        }

        return $this->render('pump/start.html.twig', [
            'shiftStartForm' => $form
        ]);
    }

    #[Route('/pump-end/{id}', name: 'app_pump_end')]
    public function pumpEnd(Shift $shift, Request $request): Response
    {
        $form = $this->createForm(ShiftEndFormType::class, $shift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->pumpService->startOrEndShift($shift);
                $this->addFlash('success', 'Tournée terminée avec succès');
                return $this->redirectToRoute('app_pump_history', [
                    'shifts' => $this->shiftRepository->findAll()
                ]);
            } catch (Throwable) {
                $this->addFlash('error', 'Erreur lors de la clôture de la tournée');
            }
        }

        return $this->render('pump/end.html.twig', [
            'shiftEndForm' => $form
        ]);
    }

    #[Route('/add-pump', name: 'app_add_pump')]
    public function addPump(Request $request): Response
    {
        $pump = new Pump();
        $form = $this->createForm(PumpFormType::class, $pump);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->pumpService->createOrUpdatePump($pump);
                $this->addFlash('success', 'Pompe crée avec succès');
                return $this->redirectToRoute('app_pump', [
                    'pumps' => $this->pumpRepository->findAll()
                ]);
            } catch (Throwable $e) {
                $this->addFlash('error', 'Erreur lors de la création de la cuve');
            }
        }

        return $this->render('pump/add.html.twig', [
            'addPumpForm' => $form
        ]);
    }

    #[Route('/edit-pump/{id}', name: 'app_edit_pump')]
    public function editPump(Pump $pump, Request $request): Response
    {
        $form = $this->createForm(PumpFormType::class, $pump);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->pumpService->createOrUpdatePump($pump);
                $this->addFlash('success', 'Pompe modifiée avec succès');
                return $this->redirectToRoute('app_pump', [
                    'pumps' => $this->pumpRepository->findAll()
                ]);
            } catch (Throwable $e) {
                $this->addFlash('error', 'Erreur lors de la modification de la pompe');
                throw new Exception($e->getMessage());
            }
        }

        return $this->render('pump/edit.html.twig', [
            'editPumpForm' => $form
        ]);
    }
}
