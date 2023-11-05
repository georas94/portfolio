<?php

namespace App\Enum;

enum ExpenseTypeString: string
{
    case TYPE_RESTAURANT = 'Restaurant';
    case TYPE_TAXI = 'Taxi';
    case TYPE_PARKING = 'Parking';
    case TYPE_PEAGE = 'Péages';
    case TYPE_VOITURE = 'Voiture';
    case TYPE_DIVERS = 'Divers';
}