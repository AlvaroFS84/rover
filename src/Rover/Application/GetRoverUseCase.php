<?php

namespace Src\Rover\Application;

use Src\Rover\Domain\Repositories\RoverRepositoryInterface;
use Src\Rover\Domain\Rover;
use Src\Rover\Domain\ValueObjects\ObstaclesList;
use Src\Rover\Domain\ValueObjects\Position;

/**
 * This use case retuen an entity rover wirh the stored info
 */
class  GetRoverUseCase
{
    public function __construct(
        private RoverRepositoryInterface $roverRepository
    ){}

    public function __invoke():Rover
    {
        $storedRover = $this->roverRepository->getRover();

        $rover = new Rover(
            new Position($storedRover->x, $storedRover->y, $storedRover->direction),
             new ObstaclesList()
         );

         return $rover;
    }
}