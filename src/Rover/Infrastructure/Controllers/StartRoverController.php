<?php

namespace Src\Rover\Infrastructure\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Rover\Application\CreateRoverUseCase;
use Throwable;

class StartRoverController
{
    public function __construct(
        private CreateRoverUseCase $createRoverUseCase,
    ) {}

    public function __invoke(Request $request):JsonResponse
    {
        try{
            $x = $request->input('x');
            $y = $request->input('y');
            $direction = strtoupper($request->input('direction'));

            $this->createRoverUseCase->__invoke($x, $y, $direction);

            $payload = ['message' => 'Rover Started'];
            $code = 200;

        }catch(Exception|Throwable $e){
            $payload = ['message' => $e->getMessage()];
            $code = 400;
        }
        
        return new JsonResponse($payload, $code);
    }
}