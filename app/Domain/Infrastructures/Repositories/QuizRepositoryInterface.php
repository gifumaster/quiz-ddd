<?php

namespace App\Domain\Infrastructures\Repositories;

use App\Models\Quiz;
use Illuminate\Support\Collection;

interface QuizRepositoryInterface
{
    public function findById(string $id): ?Quiz;
    public function getAll(): Collection;
    public function create(array $data): Quiz;
    public function update(string $id, array $data): ?Quiz;
    public function delete(string $id): bool;
}