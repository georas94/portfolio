<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class EmailService
{
    private VerifyEmailHelperInterface $verifyEmailHelper;
    private MailerInterface $mailer;

    public function __construct(VerifyEmailHelperInterface $verifyEmailHelper, MailerInterface $mailer)
    {
        $this->verifyEmailHelper = $verifyEmailHelper;
        $this->mailer = $mailer;
    }

    public function sendVerificationEmail(User $user, string $randomPassword): bool
    {
        // generate a signed url and email it to the user
        $this->sendEmailConfirmation(
            $user,
            (new TemplatedEmail())
                ->from(new Address('admin@frais.com', 'Utilisateur admin'))
                ->to($user->getEmail())
                ->subject('Vérification de votre compte')
                ->htmlTemplate('registration/confirmation_email.html.twig')
            ,
            $randomPassword
        );

        return true;
    }

    private function sendEmailConfirmation($user, TemplatedEmail $email, string $randomPassword)
    {
        $context = $email->getContext();
        $signatureComponents = $this->verifyEmailHelper->generateSignature(
            'app_verify_email',
            $user->getId(),
            $user->getEmail()
        );

        $context['signedUrl'] = $signatureComponents->getSignedUrl();
        $context['username'] = $user->getFirstname();
        $context['randomPassword'] = $randomPassword;
        $context['expiresAtMessageKey'] = $signatureComponents->getExpirationMessageKey();
        $context['expiresAtMessageData'] = $signatureComponents->getExpirationMessageData();

        $email->context($context);
        $this->mailer->send($email);
    }
}