<?php

namespace App\Service;


class MapHelper
{
    public static function calculateBounds(array $markers): array
    {
        if (empty($markers)) {
            return [
                '_southWest' => ['lat' => 0, 'lng' => 0],
                '_northEast' => ['lat' => 0, 'lng' => 0]
            ];
        }

        $lats = array_map(fn($m) => $m->getLocation()['lat'], $markers);
        $lngs = array_map(fn($m) => $m->getLocation()['lng'], $markers);

        return [
            '_southWest' => [
                'lat' => min($lats),
                'lng' => min($lngs)
            ],
            '_northEast' => [
                'lat' => max($lats),
                'lng' => max($lngs)
            ]
        ];
    }
}