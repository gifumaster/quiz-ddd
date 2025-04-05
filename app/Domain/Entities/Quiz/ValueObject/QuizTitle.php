<?php

namespace App\Domain\Entities\Quiz\ValueObject;

use InvalidArgumentException;

readonly class QuizTitle
{
    private function __construct(private ?string $value)
    {
        if ($value !== null && mb_strlen($value) > 255) {
            throw new InvalidArgumentException('クイズのタイトルは255文字以内である必要があります');
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
