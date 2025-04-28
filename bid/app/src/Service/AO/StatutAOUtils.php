<?php

namespace App\Service\AO;

class StatutAOUtils
{
    public const STATUS_DRAFT = 'DRAFT';
    public const STATUS_ACTIVE = 'PUBLISHED';
    public const STATUS_CANCELLED = 'CANCELLED';
    public const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    public const STATUS_EVALUATION = 'EVALUATION';
    public const STATUS_ATTRIBUTED = 'ATTRIBUTED';
    public const STATUTS = [
        self::STATUS_DRAFT => 'Brouillon',
        self::STATUS_ACTIVE => 'Actif',
        self::STATUS_CANCELLED => 'Clôturé',
        self::STATUS_IN_PROGRESS => 'En cours de traitement',
        self::STATUS_ATTRIBUTED => "Attribué",
    ];

    public static function getChoices(bool $isCreation): array
    {
        $choices = self::STATUTS;
        if ($isCreation) {
            unset($choices[self::STATUS_CANCELLED]);
            unset($choices[self::STATUS_IN_PROGRESS]);
        }
        return array_flip($choices);
    }

    public static function getValues(): array
    {
        return array_keys(self::STATUTS);
    }
}