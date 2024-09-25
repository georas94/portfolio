<?php

namespace App\Enum;

enum RoleString: string
{
    //Role employé
    case ROLE_EMPLOYEE = 'Employé';
    //Role gérant
    case ROLE_MANAGER = 'Gérant';
    //Role pompiste
    case ROLE_GAS_STATION_ATTENDANT = 'Pompiste';
    //Role pompiste
    case ROLE_ADMIN = 'Admin';
}
