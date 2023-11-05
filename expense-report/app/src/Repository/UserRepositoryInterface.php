<?php

namespace App\Repository;

use App\Entity\User;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserRepositoryInterface
{
    public function getCreatedUsers(UserInterface $user): array;
    public function updatePassword(User $user, FormInterface $form): bool;
}