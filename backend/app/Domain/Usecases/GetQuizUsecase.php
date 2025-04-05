<?php

namespace App\Domain\Usecases;

use App\Domain\Entities\Quiz\QuizEntity;
use App\Domain\Entities\Quiz\ValueObject\QuizId;
use App\Domain\Infrastructures\Repositories\QuizRepositoryInterface;

class GetQuizUsecase
{
    public function __construct(
        private readonly QuizRepositoryInterface $quizRepository,
    ) {}

    public function execute(string $id): ?QuizEntity
    {
        return $this->quizRepository->findById(QuizId::from($id));
    }
}
