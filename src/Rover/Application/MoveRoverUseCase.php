<?php

namespace Src\Rover\Application;

use Src\Rover\Application\Interface\DetectObstacleUseCaseInterface;
use Src\Rover\Domain\Exceptions\CommandNotValidException;
use Src\Rover\Domain\Exceptions\RoverOutOfBoundsException;
use Src\Rover\Domain\Repositories\RoverRepositoryInterface;
use Src\Rover\Domain\Rover;
use Src\Rover\Domain\ValueObjects\ObstaclesList;
use Src\Rover\Domain\ValueObjects\Position;

/**
 * Use case with the  rover movement responsability
 */
class MoveRoverUseCase
{
    /**
     * The constructor function receives interfaces to repect the dependency inversion principle of SOLID
     */
    public function __construct(
        private DetectObstacleUseCaseInterface $detectObstacleUseCase,
        private RoverRepositoryInterface $roverRepository
    ) { }


    public function __invoke(Rover $rover, string $command):Rover
    {
        $steps = str_split(strtoupper($command));

        $x = $rover->getPosition()->getX();
        $y = $rover->getPosition()->getY();
        $direction = $rover->getPosition()->getDirection();

        $obstacleDetected = false;

        foreach($steps as $step){
            if(!in_array($step, ['L','R', 'F'])){
                throw new CommandNotValidException();
            }
            switch($step){
                case 'L':
                    if($direction == 'N' && !$this->detectObstacleUseCase->detect($x-1,$y, $rover->getObstaclesList()->getObstacles())){
                        $direction = 'W';
                        $x = $x-1;
                    }else if($direction == 'S' && !$this->detectObstacleUseCase->detect($x+1,$y, $rover->getObstaclesList()->getObstacles())){
                        $direction = 'E';
                        $x = $x+1;
                    }else if($direction == 'E' && !$this->detectObstacleUseCase->detect($x,$y+1, $rover->getObstaclesList()->getObstacles())){
                        $direction = 'N';
                        $y = $y+1;
                    }
                    else if($direction == 'W' && !$this->detectObstacleUseCase->detect($x,$y-1, $rover->getObstaclesList()->getObstacles())){
                        $direction = 'S';
                        $y = $y-1;
                    }else{
                        $obstacleDetected = true;
                    }      
                break;
                case 'R':
                    if($direction == 'N' && !$this->detectObstacleUseCase->detect($x+1,$y, $rover->getObstaclesList()->getObstacles())){
                        $direction = 'E';
                        $x = $x+1;
                    }else if($direction == 'S' && !$this->detectObstacleUseCase->detect($x-1,$y, $rover->getObstaclesList()->getObstacles())){
                        $direction = 'W';
                        $x = $x-1;
                    }else if($direction == 'E' && !$this->detectObstacleUseCase->detect($x,$y-1, $rover->getObstaclesList()->getObstacles())){
                        $direction = 'S';
                        $y = $y-1;
                    }
                    else if($direction == 'W' && !$this->detectObstacleUseCase->detect($x,$y+1, $rover->getObstaclesList()->getObstacles())){
                        $direction = 'N';
                        $y = $y+1;
                    }else{
                        $obstacleDetected = true;
                    }        
                    break;
                case 'F':
                    if($direction == 'N' && !$this->detectObstacleUseCase->detect($x,$y+1, $rover->getObstaclesList()->getObstacles())){
                        $y = $y+1;
                    }else if($direction == 'S' && !$this->detectObstacleUseCase->detect($x,$y-1, $rover->getObstaclesList()->getObstacles())){
                        $y = $y-1;
                    }else if($direction == 'E' && !$this->detectObstacleUseCase->detect($x+1,$y, $rover->getObstaclesList()->getObstacles())){
                        $x = $x+1;
                    }
                    else if($direction == 'W' && !$this->detectObstacleUseCase->detect($x-1,$y, $rover->getObstaclesList()->getObstacles())){
                        $x = $x-1;
                    }else{
                        $obstacleDetected = true;
                    }      
                    break;
            }
            if($x < 0 || $x >= 200 || $y < 0 || $y >= 200){
                throw new RoverOutOfBoundsException();
            }
            if( $obstacleDetected){
                break;
            }
        };

        $current_position = new Position($x,$y,$direction);
        $rover->setPosition($current_position);

        return $rover;
    }
}