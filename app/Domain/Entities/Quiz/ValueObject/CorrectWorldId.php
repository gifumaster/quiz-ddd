<?php

namespace App\Domain\Entities\Quiz\ValueObject;

use InvalidArgumentException;
use Illuminate\Support\Str;

readonly class CorrectWorldId
{
    private function __construct(private ?string $value)
    {
        if ($value !== null && !Str::isUuid($value)) {
            throw new InvalidArgumentException('正解のワールドIDはUUID形式である必要があります');
        }
    }

    public static function from(?string $value): self
    {
        return new self($value);
    }

    public function value(): ?string
    {
        return $this->value;
    }

    public function equals(?self $other): bool
    {
        if ($other === null) {
            return $this->value === null;
        }
        return $this->value === $other->value;
    }
}
