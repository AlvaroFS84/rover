<?php

namespace Src\Rover\Infrastructure\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Rover\Application\CreateRoverUseCase;
use Src\Rover\Application\GetRoverUseCase;
use Src\Rover\Application\MoveRoverUseCase;
use Src\Rover\Application\UpdateRoverUseCase;
use Src\Rover\Infrastructure\Repositories\RoverRepository;

final class MoveRoverController
{
   
    public function __construct(
        private MoveRoverUseCase $moveRoverUseCase,
        private CreateRoverUseCase $createRoverUseCase,
        private RoverRepository $roverRepository,
        private GetRoverUseCase $getRoverUseCase,
        private UpdateRoverUseCase $updateRoverUseCase
    ) {}

    /**
     * Receives the rover movement request
     */
    public function __invoke(Request $request)
    {
        try{

            $command = strtoupper($request->input('command'));
            $rover = $this->getRoverUseCase->__invoke();

            $updatedRover = $this->moveRoverUseCase->__invoke($rover,$command);
            $this->updateRoverUseCase->__invoke($updatedRover);

            $payload = ['message' => $updatedRover->__toString()];
            $code = 200;
        }catch(Exception $e){
            $payload = ['error' => $e->getMessage()];
            $code = 400;
        };

        return new JsonResponse($payload, $code);
    }
}