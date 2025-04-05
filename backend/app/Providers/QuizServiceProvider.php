<?php

namespace App\Providers;

use App\Domain\Infrastructures\Repositories\QuizRepository;
use App\Domain\Infrastructures\Repositories\QuizRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class QuizServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(QuizRepositoryInterface::class, QuizRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
