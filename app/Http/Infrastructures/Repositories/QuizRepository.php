<?php

namespace App\Http\Infrastructures\Repositories;

use App\Models\Quiz;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class QuizRepository implements QuizRepositoryInterface
{
    public function findById(string $id): ?Quiz
    {
        return Quiz::find($id);
    }

    public function getAll(): Collection
    {
        return Quiz::all();
    }

    public function create(array $data): Quiz
    {
        $data['id'] = $data['id'] ?? Str::uuid()->toString();
        return Quiz::create($data);
    }

    public function update(string $id, array $data): ?Quiz
    {
        $quiz = $this->findById($id);
        if (!$quiz) {
            return null;
        }

        $quiz->update($data);
        return $quiz;
    }

    public function delete(string $id): bool
    {
        $quiz = $this->findById($id);
        if (!$quiz) {
            return false;
        }

        return $quiz->delete();
    }
}