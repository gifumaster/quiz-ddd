<?php

namespace App\Domain\Usecases;

use App\Domain\Entities\Quiz\QuizEntity;
use App\Domain\Entities\Quiz\ValueObject\QuizImageUrl;
use App\Domain\Infrastructures\Repositories\QuizRepositoryInterface;

class CreateQuizUsecase
{
    public function __construct(
        private readonly QuizRepositoryInterface $quizRepository,
    ) {}

    public function execute(
        ?string $title,
        string $imageUrl,
        ?string $correctWorldId,
    ): QuizEntity {
        $quiz = QuizEntity::create(
            title: $title,
            imageUrl: QuizImageUrl::from($imageUrl),
            correctWorldId: $correctWorldId,
        );

        return $this->quizRepository->create($quiz);
    }
}
