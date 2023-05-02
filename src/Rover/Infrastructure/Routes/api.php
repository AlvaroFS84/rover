<?php

use Illuminate\Support\Facades\Route;
use Src\Rover\Infrastructure\Controllers\MoveRoverController;
use Src\Rover\Infrastructure\Controllers\StartRoverController;

Route::post('/start-rover', StartRoverController::class);
Route::patch('/move-rover', MoveRoverController::class);