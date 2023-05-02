<?php

namespace Src\Rover\Application;

use Src\Rover\Domain\Repositories\RoverRepositoryInterface;
use Src\Rover\Domain\Rover;
use Src\Rover\Domain\ValueObjects\ObstaclesList;
use Src\Rover\Domain\ValueObjects\Position;
/**
 * Use case with the Rover createon responsability
 */
final class CreateRoverUseCase
{
    public function __construct( 
        private RoverRepositoryInterface $roverRepository
        ){}
    /**
     * Retuns a Rover class instance with the given position, an obstacle list
     */
    public function __invoke(int $x, int $y, string $direction):void
    {
        $position = new Position($x, $y, $direction);
        $obstaclesList = new ObstaclesList();
        $rover = new Rover($position, $obstaclesList);
        
        $this->roverRepository->startRover(
            $rover->getPosition()->getX(),
            $rover->getPosition()->getY(),
            $rover->getPosition()->getDirection()
        );

    }
}