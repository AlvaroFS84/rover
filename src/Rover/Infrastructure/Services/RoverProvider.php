<?php

namespace Src\Rover\Infrastructure\Services;


use Illuminate\Support\ServiceProvider;
use Src\Rover\Application\DetectObstacleUseCase;
use Src\Rover\Application\Interface\DetectObstacleUseCaseInterface;
use Src\Rover\Domain\Repositories\RoverRepositoryInterface;
use Src\Rover\Infrastructure\Repositories\RoverRepository;

class RoverProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DetectObstacleUseCaseInterface::class, DetectObstacleUseCase::class);
        $this->app->bind(RoverRepositoryInterface::class, RoverRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
