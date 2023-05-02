<?php

namespace Src\Rover\Domain\ValueObjects;

/**
 * Value object that represents an list of obstacles on the planet terrain
 */
class ObstaclesList
{
    private $obstacles;

    public function __construct()
    {
        //coordinates of the obstacles
        $this->obstacles = [
            [10,2],
            [1,40],
            [5,200],
            [12,58],
            [141,100],
            [100,57],
            [190,134],
            [37,87],
            [40,105],
            [1,3],
        ];
    }

    //Value object are inmutable, so we dont need setters
    
    /**
     * Get the value of obstacles
     */ 
    public function getObstacles()
    {
        return $this->obstacles;
    }
} 