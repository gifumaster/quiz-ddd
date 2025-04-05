<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth.supabase')->group(function () {
    // 認証が必要なAPIルート
    Route::get('/user', function (Request $request) {
        return response()->json([
            'user' => $request->get('user')
        ]);
    });

    // 他の保護されたルートをここに追加
    Route::apiResource('quizzes', QuizController::class);
});
