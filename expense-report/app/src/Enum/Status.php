<?php

namespace App\Enum;

use App\Entity\Expense;

enum Status
{
    public static function status(string $status): string
    {
        return match($status)
        {
            Expense::STATUS_DRAFT => 'Brouillon',
            Expense::STATUS_REJECTED_FROM_DRAFT => 'Abandonné',
            Expense::STATUS_TO_REVIEW_ACCOUNTING => 'En cours de traitement service comptabilité',
            Expense::STATUS_REJECTED_FROM_ACCOUNTING => 'Rejet du service comptabilité',
            Expense::STATUS_TO_REVIEW_MANAGER => 'En cours de traitement service financier',
            Expense::STATUS_REJECTED_FROM_MANAGER => 'Rejet du service financier',
            Expense::STATUS_TO_REVIEW_FROM_MANAGER_TO_TREASURY => 'Envoyé du service financier à la trésorerie',
            Expense::STATUS_TO_REVIEW_FROM_ACCOUNTANT_TO_TREASURY => 'Envoyé du service comptable à la trésorerie',
            Expense::STATUS_VALIDATED_FROM_TREASURY => 'Validé par la trésorerie',
        };
    }
}