<?php

namespace Src\Rover\Application;

use Src\Rover\Domain\Repositories\RoverRepositoryInterface;
use Src\Rover\Domain\Rover;

/**
 * Use case that updated the database rover info
 */
class  UpdateRoverUseCase
{
    public function __construct(
        private RoverRepositoryInterface $roverRepository
    ){}

    public function __invoke(Rover $rover):void
    {
        $this->roverRepository->updateRover(
            $rover->getPosition()->getX(),
            $rover->getPosition()->getY(),
            $rover->getPosition()->getDirection()
    
        );
    }
}