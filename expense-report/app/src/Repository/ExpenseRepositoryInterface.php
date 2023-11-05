<?php

namespace App\Repository;

use Symfony\Component\Security\Core\User\UserInterface;

interface ExpenseRepositoryInterface
{
    public function getManagerialExpenses(UserInterface $user): array;

    public function getEmployeeExpenses(UserInterface $user): array;

    public function getManagerialExpensesToValidate(UserInterface $user): array;
}