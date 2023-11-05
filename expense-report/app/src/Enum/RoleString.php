<?php

namespace App\Enum;

enum RoleString: string
{
    //Role utilisateur
    case ROLE_EMPLOYEE = 'Employé';
    //Role trésorerie
    case ROLE_TREASURER = 'Trésorier';
    //Role comptable
    case ROLE_ACCOUNTANT = 'Comptable';
    //Role manager (DAF)
    case ROLE_MANAGER = 'Financier';
}