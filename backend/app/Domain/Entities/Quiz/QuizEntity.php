<?php

namespace App\Domain\Entities\Quiz;

use App\Domain\Entities\Quiz\ValueObject\QuizId;
use App\Domain\Entities\Quiz\ValueObject\QuizImageUrl;
use App\Domain\Entities\Quiz\ValueObject\QuizTitle;
use App\Domain\Entities\Quiz\ValueObject\CorrectWorldId;
use DateTime;

readonly class QuizEntity
{
    public readonly QuizId $id;
    public readonly QuizTitle $title;
    public readonly QuizImageUrl $imageUrl;
    public readonly ?CorrectWorldId $correctWorldId;
    public readonly ?DateTime $createdAt;
    public readonly ?DateTime $updatedAt;

    private function __construct(
        QuizId $id,
        QuizTitle $title,
        QuizImageUrl $imageUrl,
        ?CorrectWorldId $correctWorldId,
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
        ?string $correctWorldId,
    ): self {
        return new self(
            id: QuizId::generate(),
            title: QuizTitle::from($title),
            imageUrl: $imageUrl,
            correctWorldId: $correctWorldId !== null ? CorrectWorldId::from($correctWorldId) : null,
            createdAt: new DateTime(),
            updatedAt: new DateTime()
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'title' => $this->title->value(),
            'image_url' => $this->imageUrl->value(),
            'correct_world_id' => $this->correctWorldId?->value(),
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: QuizId::from($data['id']),
            title: QuizTitle::from($data['title'] ?? null),
            imageUrl: QuizImageUrl::from($data['image_url']),
            correctWorldId: isset($data['correct_world_id']) ? CorrectWorldId::from($data['correct_world_id']) : null,
            createdAt: isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            updatedAt: isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }
}
