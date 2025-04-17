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

    public static function getChoices(): array
    {
        return array_flip(self::STATUTS);
    }

    public static function getValues(): array
    {
        return array_keys(self::STATUTS);
    }
}