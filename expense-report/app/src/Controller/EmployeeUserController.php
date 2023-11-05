<?php

namespace App\Controller;

use App\Entity\User;
use App\Enum\Role;
use App\Form\UpdatePasswordFormType;
use App\Repository\UserRepositoryInterface;
use App\Service\UserService;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Throwable;

class EmployeeUserController extends AbstractController
{
    private TranslatorInterface $translatorInterface;
    private UserRepositoryInterface $userRepositoryInterface;
    private UserService $userService;

    public function __construct(TranslatorInterface $translatorInterface, UserRepositoryInterface $userRepositoryInterface, UserService $userService)
    {
        $this->translatorInterface = $translatorInterface;
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->userService = $userService;
    }

    #[Route('/employee/users/{id}/account', name: 'app_employee_user_account')]
    public function account(User $user, Request $request): Response
    {
        $connectedUser = $this->getUser();
        if (!$connectedUser) {
            throw new LogicException($this->translatorInterface->trans('app.error.user.not.found'));
        }

        $form = $this->createForm(UpdatePasswordFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $this->userService->verifyPassword($form);
                if($this->userRepositoryInterface->updatePassword($user, $form)){
                    $this->addFlash('success', $this->translatorInterface->trans('app.success.employee.user.update.password'));
                }else {
                    $this->addFlash('error', $this->translatorInterface->trans('app.error.employee.user.update.password'));
                }
            }catch(Throwable $exception){
                $this->addFlash('error', $this->translatorInterface->trans($exception->getMessage()));
            }
        }

        return $this->render('employee/user/view/view.html.twig', [
            'user' => $user,
            'role' => Role::role(current($user->getRoles())),
            'form' => $form
        ]);
    }
}
