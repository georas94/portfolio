<?php

namespace App\Security;

use App\Entity\Expense;
use App\Entity\User;
use App\Enum\RoleString;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ExpenseVoter extends Voter
{
    private const EDIT = 'edit';

    protected function supports(string $attribute, mixed $subject): bool
    {
        if ($attribute !== self::EDIT) {
            return false;
        }

        if (!$subject instanceof Expense) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Expense $post */
        $expense = $subject;

        return match($attribute) {
            self::EDIT => $this->canEdit($expense, $user),
            default => throw new \LogicException('This code should not be reached!')
        };
    }

    private function canEdit(Expense $expense, User $user): bool
    {
        switch ($expense->getStatus()){
            case Expense::STATUS_TO_REVIEW_ACCOUNTING:
                if (in_array(RoleString::ROLE_ACCOUNTANT->name, $user->getRoles(), true)){
                    return true;
                }
                return false;
            case Expense::STATUS_TO_REVIEW_FROM_MANAGER_TO_TREASURY:
            case Expense::STATUS_TO_REVIEW_FROM_ACCOUNTANT_TO_TREASURY:
                if (in_array(RoleString::ROLE_TREASURER->name, $user->getRoles(), true)){
                    return true;
                }
                return false;
            case Expense::STATUS_TO_REVIEW_MANAGER:
                if (in_array(RoleString::ROLE_MANAGER->name, $user->getRoles(), true)){
                    return true;
                }
                return false;
            default:
                return false;
        }
    }
}