<?php

namespace App\Http\Controllers;

use App\Domain\Infrastructures\Services\QuizService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class QuizController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    public function index(Request $request): JsonResponse
    {
        $quizzes = $this->quizService->getAllQuizzes();
        return response()->json($quizzes);
    }

    public function show($id): JsonResponse
    {
        $quiz = $this->quizService->getQuizById($id);
        return response()->json($quiz);
    }

    public function store(Request $request): JsonResponse
    {
        $quiz = $this->quizService->createQuiz($request->all());
        return response()->json($quiz, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $quiz = $this->quizService->updateQuiz($id, $request->all());
        return response()->json($quiz);
    }

    public function destroy($id): JsonResponse
    {
        $this->quizService->deleteQuiz($id);
        return response()->json(null, 204);
    }
}