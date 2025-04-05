<?php

namespace App\Domain\Infrastructures\Repositories;

use App\Domain\Entities\Quiz\QuizEntity;
use Illuminate\Support\Collection;

interface QuizRepositoryInterface
{
    public function findById(string $id): ?QuizEntity;
    public function getAll(): Collection;
    public function create(QuizEntity $entity): QuizEntity;
    public function update(QuizEntity $entity): ?QuizEntity;
    public function delete(string $id): bool;
}
