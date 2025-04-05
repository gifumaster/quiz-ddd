<?php

namespace App\Domain\Usecases;

use App\Domain\Entities\Quiz\ValueObject\QuizId;
use App\Domain\Infrastructures\Repositories\QuizRepositoryInterface;

class DeleteQuizUsecase
{
    public function __construct(
        private readonly QuizRepositoryInterface $quizRepository,
    ) {}

    public function execute(string $id): bool
    {
        return $this->quizRepository->delete(QuizId::from($id));
    }
}
