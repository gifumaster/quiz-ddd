<?php

namespace App\Domain\Usecases;

use App\Domain\Entities\Quiz\QuizEntity;
use App\Domain\Entities\Quiz\ValueObject\QuizId;
use App\Domain\Entities\Quiz\ValueObject\QuizImageUrl;
use App\Domain\Infrastructures\Repositories\QuizRepositoryInterface;

class UpdateQuizUsecase
{
    public function __construct(
        private readonly QuizRepositoryInterface $quizRepository,
    ) {}

    public function execute(
        string $id,
        ?string $title,
        string $imageUrl,
        ?string $correctWorldId,
    ): ?QuizEntity {
        $quiz = QuizEntity::fromArray([
            'id' => $id,
            'title' => $title,
            'image_url' => $imageUrl,
            'correct_world_id' => $correctWorldId,
        ]);

        return $this->quizRepository->update($quiz);
    }
}
