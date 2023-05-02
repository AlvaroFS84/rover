<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Src\Rover\Application\DetectObstacleUseCase;
use Src\Rover\Application\Interface\DetectObstacleUseCaseInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
