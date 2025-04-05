<?php

namespace App\Domain\Entities\Quiz;

use App\Domain\Entities\Quiz\ValueObject\QuizId;
use App\Domain\Entities\Quiz\ValueObject\QuizImageUrl;
use DateTime;

readonly class QuizEntity
{
    public readonly QuizId $id;
    public readonly ?string $title;
    public readonly QuizImageUrl $imageUrl;
    public readonly string $correctWorldId;
    public readonly ?DateTime $createdAt;
    public readonly ?DateTime $updatedAt;

    private function __construct(
        QuizId $id,
        ?string $title,
        QuizImageUrl $imageUrl,
        string $correctWorldId,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->imageUrl = $imageUrl;
        $this->correctWorldId = $correctWorldId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        ?string $title,
        QuizImageUrl $imageUrl,
        string $correctWorldId,
    ): self {
        return new self(
            id: QuizId::generate(),
            title: $title,
            imageUrl: $imageUrl,
            correctWorldId: $correctWorldId,
            createdAt: new DateTime(),
            updatedAt: new DateTime()
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'title' => $this->title,
            'image_url' => $this->imageUrl->value(),
            'correct_world_id' => $this->correctWorldId,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: QuizId::from($data['id']),
            title: $data['title'] ?? null,
            imageUrl: QuizImageUrl::from($data['image_url']),
            correctWorldId: $data['correct_world_id'],
            createdAt: isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            updatedAt: isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }
}
