<?php

namespace App\ValueObject;

use App\Enum\Role as RoleEnum;

class Role
{
    private string $value;

    private function __construct(string $role)
    {
        $this->value = $role;
    }

    public static function fromString(?string $role): self
    {
        return new self(RoleEnum::role($role));
    }

    public function getValue(): string
    {
        return $this->value;
    }
}