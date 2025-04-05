<?php

namespace App\Domain\Infrastructures\Repositories;

use App\Models\Quiz;
use App\Domain\Entities\Quiz\QuizEntity;
use App\Domain\Entities\Quiz\ValueObject\QuizId;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class QuizRepository implements QuizRepositoryInterface
{
    public function findById(string $id): ?QuizEntity
    {
        $quiz = Quiz::find($id);
        return $quiz ? QuizEntity::fromArray($quiz->toArray()) : null;
    }

    public function getAll(): Collection
    {
        return Quiz::all()->map(fn($quiz) => QuizEntity::fromArray($quiz->toArray()));
    }

    public function create(QuizEntity $entity): QuizEntity
    {
        $data = $entity->toArray();
        if (!isset($data['id']) || $data['id'] === null) {
            $data['id'] = QuizId::generate()->value();
        }
        $quiz = Quiz::create($data);
        return QuizEntity::fromArray($quiz->toArray());
    }

    public function update(QuizEntity $entity): ?QuizEntity
    {
        $quiz = Quiz::find($entity->id);
        if (!$quiz) {
            return null;
        }

        $quiz->update($entity->toArray());
        return QuizEntity::fromArray($quiz->toArray());
    }

    public function delete(string $id): bool
    {
        $quiz = Quiz::find($id);
        if (!$quiz) {
            return false;
        }

        return $quiz->delete();
    }
}
