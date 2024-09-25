<?php

namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Throwable;

class UserService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function createOrUpdateUser(User $user): void
    {
        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }catch (Throwable){
            throw new LogicException();
        }
    }
}
