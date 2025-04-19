<?php

namespace App\Service\AO;

class StatutAOUtils
{
    public const DEFAULT_STATUS = 'BROUILLON';
    public const STATUTS = [
        'BROUILLON' => 'Brouillon',
        'PUBLIE' => 'Publié',
        'CLOTURE' => 'Clôturé',
        'ATTRIBUE' => 'Attribué'
    ];

    public static function getChoices(bool $isCreation): array
    {
        $choices = self::STATUTS;
        if ($isCreation) {
            unset($choices['CLOTURE']);
            unset($choices['ATTRIBUE']);
        }
        return array_flip($choices);
    }

    public static function getValues(): array
    {
        return array_keys(self::STATUTS);
    }
}