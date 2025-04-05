<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Infrastructures\Repositories\QuizRepositoryInterface;
use App\Domain\Infrastructures\Repositories\QuizRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(QuizRepositoryInterface::class, QuizRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
