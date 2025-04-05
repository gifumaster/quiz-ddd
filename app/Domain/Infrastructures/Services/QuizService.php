<?php

namespace App\Domain\Infrastructures\Services;

use App\Domain\Infrastructures\Repositories\QuizRepositoryInterface;

class QuizService
{
    private QuizRepositoryInterface $quizRepository;

    public function __construct(QuizRepositoryInterface $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function getQuizById(int $id)
    {
        return $this->quizRepository->findById($id);
    }

    public function getAllQuizzes()
    {
        return $this->quizRepository->findAll();
    }

    public function createQuiz(array $data)
    {
        return $this->quizRepository->create($data);
    }

    public function updateQuiz(int $id, array $data)
    {
        return $this->quizRepository->update($id, $data);
    }

    public function deleteQuiz(int $id)
    {
        return $this->quizRepository->delete($id);
    }
}