<?php

namespace App\Domain\Entities\Quiz\ValueObject;

use Illuminate\Support\Str;
use InvalidArgumentException;

readonly class QuizId
{
    private function __construct(private string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Quiz ID cannot be empty');
        }
    }

    public static function from(?string $value): self
    {
        return new self($value);
    }

    /**
     * ULIDを使用して新しいQuizIdを生成します
     */
    public static function generate(): self
    {
        return new self(Str::ulid());
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
