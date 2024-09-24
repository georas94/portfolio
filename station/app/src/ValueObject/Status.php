<?php

namespace App\ValueObject;

use App\Enum\Status as StatusEnum;

class Status
{
    private string $value;

    private function __construct(string $statusDecoded)
    {
        $this->value = $statusDecoded;
    }

    public static function fromString(string $status): self
    {
        return new self(StatusEnum::status($status));
    }

    public function getValue(): string
    {
        return $this->value;
    }
}