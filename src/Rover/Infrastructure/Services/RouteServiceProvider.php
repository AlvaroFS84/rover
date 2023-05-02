<?php

namespace Src\Rover\Infrastructure\Services;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Src\Rover\Infrastructure\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapRoutes();
    }

    public function mapRoutes()
    {
        Route::prefix('api/rover')
            ->namespace($this->namespace)
            ->group(base_path('src/Rover/Infrastructure/Routes/api.php'));    
    }
}