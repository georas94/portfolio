<?php

namespace App\Enum;

enum FuelType
{
    public static function type(string $type): string
    {
        return match($type)
        {
            FuelTypeString::TYPE_ESSENCE->name => FuelTypeString::TYPE_ESSENCE->value,
            FuelTypeString::TYPE_DIESEL->name => FuelTypeString::TYPE_DIESEL->value,
            default => null
        };
    }
}
