<?php

namespace App\Controller;

use App\Entity\User;
use App\Enum\Role;
use App\Repository\UserRepositoryInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ManagerialUserController extends AbstractController
{
    private TranslatorInterface $translatorInterface;
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface, TranslatorInterface $translatorInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->translatorInterface = $translatorInterface;
    }

    #[Route('/managerial/users/dashboard', name: 'app_managerial_user_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new LogicException($this->translatorInterface->trans('app.error.user.not.found'));
        }

        $usersResultSet = $this->userRepositoryInterface->getCreatedUsers($this->getUser());

        return $this->render('managerial/user/dashboard/dashboard.html.twig', [
            'usersResultSet' => $usersResultSet
        ]);
    }

    #[Route('/managerial/users/{id}/view', name: 'app_managerial_user_view')]
    public function view(User $user): Response
    {
        $connectedUser = $this->getUser();
        if (!$connectedUser) {
            throw new LogicException($this->translatorInterface->trans('app.error.user.not.found'));
        }

        return $this->render('managerial/user/view/view.html.twig', [
            'user' => $user,
            'role' => Role::role(current($user->getRoles()))
        ]);
    }
}
