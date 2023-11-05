<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use LogicException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Throwable;

class UserService
{
    private UserPasswordHasherInterface $userPasswordHasher;
    private EntityManagerInterface $entityManager;
    private EmailService $emailService;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, EmailService $emailService)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->entityManager = $entityManager;
        $this->emailService = $emailService;
    }

    public function createUser(User $user, UserInterface $connectedUser): bool
    {
        $randomPassword =  strtoupper(substr($user->getLastname(), 0, 3) . substr($user->getFirstname(), 0, 3) . (new \DateTime())->format('Y'));
        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                $randomPassword
            )
        );
        $user->setIsPasswordChanged(false);
        $user->setCreatedBy($connectedUser);
        $this->entityManager->beginTransaction();
        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $this->emailService->sendVerificationEmail($user, $randomPassword);

            $this->entityManager->commit();
            return true;
        }catch (Throwable){
            $this->entityManager->rollback();
            throw new Exception();
        }
    }

    public function verifyPassword(FormInterface $form): bool
    {
        // If the two password given are not equal
        if($form->get('plainPassword')->getData() !== $form->get('plainPasswordConfirm')->getData()){
            throw new LogicException('app.error.employee.user.update.password.notSame');
        }

        // If the password doesn't contain any number
        if(!preg_match('~[0-9]+~', $form->get('plainPassword')->getData() ) || !preg_match('~[0-9]+~', $form->get('plainPasswordConfirm')->getData())){
            throw new LogicException('app.error.employee.user.update.password.noContainsInteger');
        }

        return true;
    }
}