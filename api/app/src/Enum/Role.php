<?php

namespace App\Enum;

enum Role
{
    public static function role(string $role): string
    {
        return match($role)
        {
            RoleString::ROLE_EMPLOYEE->name=> RoleString::ROLE_EMPLOYEE->value,
            RoleString::ROLE_ACCOUNTANT->name => RoleString::ROLE_ACCOUNTANT->value,
            RoleString::ROLE_TREASURER->name => RoleString::ROLE_TREASURER->value,
            RoleString::ROLE_MANAGER->name => RoleString::ROLE_MANAGER->value,
            default => null
        };
    }
}