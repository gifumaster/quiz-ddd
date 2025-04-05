<?php

namespace App\Domain\Entities\Quiz\ValueObject;

use InvalidArgumentException;

readonly class QuizImageUrl
{
    private function __construct(private string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Invalid URL format');
        }
    }

    public static function from(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
