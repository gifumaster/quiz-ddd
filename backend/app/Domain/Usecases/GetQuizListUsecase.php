<?php

namespace App\Domain\Usecases;

use App\Domain\Infrastructures\Repositories\QuizRepositoryInterface;
use Illuminate\Support\Collection;

class GetQuizListUsecase
{
    public function __construct(
        private readonly QuizRepositoryInterface $quizRepository,
    ) {}

    public function execute(): Collection
    {
        return $this->quizRepository->getAll();
    }
}
