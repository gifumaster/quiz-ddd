<?php

namespace App\Domain\Infrastructures\Repositories;

use App\Domain\Entities\Quiz\QuizEntity;
use App\Domain\Entities\Quiz\ValueObject\QuizId;
use Illuminate\Support\Collection;

interface QuizRepositoryInterface
{
    public function findById(QuizId $id): ?QuizEntity;
    public function getAll(): Collection;
    public function create(QuizEntity $entity): QuizEntity;
    public function update(QuizEntity $entity): ?QuizEntity;
    public function delete(QuizId $id): bool;
}
