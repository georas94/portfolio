<?php

namespace App\Enum;

enum StatusTypeString: string
{
    case STATUS_IN_PROCESS = 'En cours de service';
    case STATUS_COMPLETED = 'Terminé';
}
