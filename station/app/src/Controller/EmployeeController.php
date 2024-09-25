<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditEmployeeFormType;
use App\Repository\UserRepository;
use App\Service\UserService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class EmployeeController extends AbstractController
{
    public function __construct(private UserRepository $userRepository, private UserService $userService)
    {
    }

    #[Route('/employee-list', name: 'app_list_employee')]
    public function index(): Response
    {
        return $this->render('employee/list.html.twig', [
            'employees' => $this->userRepository->findAll(),
        ]);
    }

    #[Route('/employee/{id}', name: 'app_view_employee')]
    public function viewEmployee(User $user): Response
    {
        return $this->render('employee/view.html.twig', [
            'employee' => $user,
        ]);
    }

    #[Route('/employee/edit/{id}', name: 'app_edit_employee')]
    public function editEmployee(User $user, Request $request): Response
    {
        $form = $this->createForm(EditEmployeeFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->userService->createOrUpdateUser($user);
                $this->addFlash('success', 'Utilisateur modifié avec succès');

                return $this->redirectToRoute('app_view_employee', [
                    'id' => $user->getId()
                ]);
            } catch (Throwable) {
                $this->addFlash('error', 'Erreur lors de la modification de l\'utilisateur');
                return $this->redirectToRoute('app_edit_employee', [
                    'id' => $user->getId()
                ]);
            }
        }

        return $this->render('employee/edit.html.twig', [
            'editEmployeeForm' => $form,
        ]);
    }
}
