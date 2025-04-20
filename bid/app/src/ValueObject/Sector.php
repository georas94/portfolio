<?php

namespace App\ValueObject;

final readonly class Sector
{
    public function __construct(
        private string $code,
        private string $label,
        private string $category
    ) {}

    public function getCode(): string { return $this->code; }
    public function getLabel(): string { return $this->label; }
    public function getCategory(): string { return $this->category; }

    public function equals(Sector $other): bool
    {
        return $this->code === $other->getCode();
    }

    public function __toString(): string
    {
        return $this->code;
    }
}