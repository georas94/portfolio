<?php

namespace App\Enum;

use App\ValueObject\Sector;

class SectorEnum
{
    public const BUILDING = 'BTP01';
    public const ROAD = 'BTP02';
    public const BRIDGE = 'BTP03';
    public const SOLAR = 'ENE01';
    public const GRID = 'ENE02';
    public const WATER = 'ENV01';
    public const SANITATION = 'ENV02';
    public const HEALTH = 'SOC01';
    public const EDUCATION = 'EDU02';
    public const AGRICULTURE = 'AGR01';
    public const LIVESTOCK = 'AGR02';
    public const TRANSPORT = 'INF01';
    public const ICT = 'INF02';

    private static array $sectors = [
        self::BUILDING => ['Bâtiment public', 'BTP'],
        self::ROAD => ['Routes', 'BTP'],
        self::BRIDGE => ['Ponts', 'BTP'],
        self::SOLAR => ['Énergie solaire', 'Énergie'],
        self::GRID => ['Réseaux électriques', 'Énergie'],
        self::WATER => ['Accès à l\'eau', 'Environnement'],
        self::SANITATION => ['Assainissement', 'Environnement'],
        self::HEALTH => ['Santé', 'Social'],
        self::EDUCATION => ['Éducation', 'Social'],
        self::AGRICULTURE => ['Agriculture', 'Agroalimentaire'],
        self::LIVESTOCK => ['Élevage', 'Agroalimentaire'],
        self::TRANSPORT => ['Transports urbains', 'Infrastructure'],
        self::ICT => ['Technologies de l\'information', 'Infrastructure'],
    ];

    public static function getSector(string $code): Sector
    {
        if (!isset(self::$sectors[$code])) {
            throw new \InvalidArgumentException("Secteur invalide: $code");
        }

        return new Sector(
            $code,
            self::$sectors[$code][0],
            self::$sectors[$code][1]
        );
    }

    public static function getAll(): array
    {
        return array_map(
            fn ($code) => self::getSector($code),
            array_keys(self::$sectors)
        );
    }

    public static function getByCategory(): array
    {
        $categories = [];
        foreach (self::$sectors as $code => [$label, $category]) {
            $categories[$category][] = self::getSector($code);
        }
        return $categories;
    }

    public static function getRandomCodes(int $count = 2): array
    {
        $codes = array_keys(self::$sectors);
        shuffle($codes);
        return array_slice($codes, 0, $count);
    }
}
