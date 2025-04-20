<?php

namespace App\Service\AO;

class StatutAOUtils
{
    public const STATUS_DRAFT = 'DRAFT';
    public const STATUS_PUBLISHED = 'PUBLISHED';
    public const STATUS_CANCELLED = 'CANCELLED';
    public const STATUS_ASSIGNED = 'ASSIGNED';
    public const STATUTS = [
        self::STATUS_DRAFT => 'Brouillon',
        self::STATUS_PUBLISHED => 'Publié',
        self::STATUS_CANCELLED => 'Clôturé',
        self::STATUS_ASSIGNED => 'Attribué'
    ];

    public static function getChoices(bool $isCreation): array
    {
        $choices = self::STATUTS;
        if ($isCreation) {
            unset($choices[self::STATUS_CANCELLED]);
            unset($choices[self::STATUS_ASSIGNED]);
        }
        return array_flip($choices);
    }

    public static function getValues(): array
    {
        return array_keys(self::STATUTS);
    }
}