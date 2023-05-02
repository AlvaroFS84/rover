<?php

namespace Src\Rover\Infrastructure\Repositories;

use Src\Rover\Domain\Repositories\RoverRepositoryInterface;

/**
 * Repository that interact with the ORM model class
 */
class RoverRepository implements RoverRepositoryInterface
{
    public function startRover(int $x, int $y, string $direction):void
    {
        //delete previous position
        Rover::truncate();
        
        //create rover
        $startedRover = new Rover();
        $startedRover->x = $x;
        $startedRover->y = $y;
        $startedRover->direction = $direction;
        $startedRover->save();
    }
    
    public function getRover()
    {
        return  Rover::all()->first();
    }

    public function updateRover(int $x, int $y, string $direction)
    {
        $rover = Rover::all()->first();
        $rover->x = $x;
        $rover->y = $y;
        $rover->direction = $direction;

        $rover->save();
    }
}