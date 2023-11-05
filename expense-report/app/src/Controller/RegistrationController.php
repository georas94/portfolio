<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\UserService;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Security\EmailVerifier;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private UserService $userService;
    private TranslatorInterface $translatorInterface;
    private EmailVerifier $emailVerifier;


    public function __construct(UserService $userService, TranslatorInterface $translatorInterface, EmailVerifier $emailVerifier)
    {
        $this->userService = $userService;
        $this->translatorInterface = $translatorInterface;
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request): Response
    {
        $connectedUser = $this->getUser();
        if (!$connectedUser) {
            throw new LogicException($this->translatorInterface->trans('app.error.user.not.found'));
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($this->userService->createUser($user, $connectedUser)){
                $this->addFlash('success', $this->translatorInterface->trans('app.success.user.create'));
                return $this->redirectToRoute('app_managerial_user_dashboard');
            }else {
                $this->addFlash('error', $this->translatorInterface->trans('app.error.user.create'));
            }
        }

        return $this->render('registration/registration.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());
            return $this->redirectToRoute('app_register');
        }

        return $this->redirectToRoute('app_employee_user_account', [
            'id' => $this->getUser()->getId()
        ]);
    }
}
