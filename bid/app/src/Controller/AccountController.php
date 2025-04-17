<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/mon-compte')]
class AccountController extends AbstractController
{
    #[Route('', name: 'app_user_account')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        // Le user est automatiquement disponible via $this->getUser()
        return $this->render('account/account.html.twig');
    }

    #[Route('/editer', name: 'app_account_edit')]
    #[IsGranted('ROLE_USER')]
    public function edit(): Response
    {
        // Cette action devra être complétée avec un formulaire d'édition
        return $this->render('account/edit.html.twig');
    }

    #[Route('/changer-mot-de-passe', name: 'app_change_password')]
    #[IsGranted('ROLE_USER')]
    public function changePassword(): Response
    {
        // À implémenter avec le composant Security de Symfony
        return $this->render('account/change_password.html.twig');
    }
}