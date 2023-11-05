<?php

namespace App\ValueObject;

use App\Enum\ExpenseType as ExpenseEnum;

class ExpenseType
{
    private string $value;

    private function __construct(string $typeDecoded)
    {
        $this->value = $typeDecoded;
    }

    public static function fromString(?string $type): self
    {
        return new self(ExpenseEnum::type($type));
    }

    public function getValue(): string
    {
        return $this->value;
    }
}