<?php

namespace App\Http\Controllers;

use App\Domain\Usecases\CreateQuizUsecase;
use App\Domain\Usecases\DeleteQuizUsecase;
use App\Domain\Usecases\GetQuizListUsecase;
use App\Domain\Usecases\GetQuizUsecase;
use App\Domain\Usecases\UpdateQuizUsecase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuizController extends Controller
{
    public function __construct(
        private readonly CreateQuizUsecase $createQuizUsecase,
        private readonly GetQuizListUsecase $getQuizListUsecase,
        private readonly GetQuizUsecase $getQuizUsecase,
        private readonly UpdateQuizUsecase $updateQuizUsecase,
        private readonly DeleteQuizUsecase $deleteQuizUsecase,
    ) {}

    public function index(): JsonResponse
    {
        $quizzes = $this->getQuizListUsecase->execute();
        return response()->json($quizzes->map->toArray());
    }

    public function show(string $id): JsonResponse
    {
        $quiz = $this->getQuizUsecase->execute($id);
        if (!$quiz) {
            return response()->json(['message' => 'クイズが見つかりません'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($quiz->toArray());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_url' => 'required|url',
            'correct_world_id' => 'nullable|string',
        ]);

        $quiz = $this->createQuizUsecase->execute(
            title: $validated['title'] ?? null,
            imageUrl: $validated['image_url'],
            correctWorldId: $validated['correct_world_id'] ?? null,
        );

        return response()->json($quiz->toArray(), Response::HTTP_CREATED);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_url' => 'required|url',
            'correct_world_id' => 'nullable|string',
        ]);

        $quiz = $this->updateQuizUsecase->execute(
            id: $id,
            title: $validated['title'] ?? null,
            imageUrl: $validated['image_url'],
            correctWorldId: $validated['correct_world_id'] ?? null,
        );

        if (!$quiz) {
            return response()->json(['message' => 'クイズが見つかりません'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($quiz->toArray());
    }

    public function destroy(string $id): JsonResponse
    {
        $result = $this->deleteQuizUsecase->execute($id);
        if (!$result) {
            return response()->json(['message' => 'クイズが見つかりません'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
