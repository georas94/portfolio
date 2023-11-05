<?php

namespace App\Enum;

enum ExpenseType
{
    public static function type(string $type): string
    {
        return match($type)
        {
            ExpenseTypeString::TYPE_RESTAURANT->name => ExpenseTypeString::TYPE_RESTAURANT->value,
            ExpenseTypeString::TYPE_TAXI->name => ExpenseTypeString::TYPE_TAXI->value,
            ExpenseTypeString::TYPE_PARKING->name => ExpenseTypeString::TYPE_PARKING->value,
            ExpenseTypeString::TYPE_PEAGE->name => ExpenseTypeString::TYPE_PEAGE->value,
            ExpenseTypeString::TYPE_VOITURE->name => ExpenseTypeString::TYPE_VOITURE->value,
            ExpenseTypeString::TYPE_DIVERS->name => ExpenseTypeString::TYPE_DIVERS->value,
            default => null
        };
    }
}