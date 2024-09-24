<?php

namespace App\ValueObject;

use App\Enum\FuelType as FuelEnum;

class FuelType
{
    private string $value;

    private function __construct(string $typeDecoded)
    {
        $this->value = $typeDecoded;
    }

    public static function fromString(?string $type): self
    {
        return new self(FuelEnum::type($type));
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
