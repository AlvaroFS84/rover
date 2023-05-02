<?php

namespace Src\Rover\Domain;

use Src\Rover\Domain\ValueObjects\ObstaclesList;
use Src\Rover\Domain\ValueObjects\Position;

final class Rover
{
    /**
     * Id is unused because we are not going to store any info, but an entity needs way to be identified
     */
    private $id;

    public function __construct(
        private Position $position,
        private ObstaclesList $obstaclesList
    ) {
        $this->id = uniqid();
    }

    /**
    * Get the value of position
    */ 
    public function getPosition():Position
    {
        return $this->position;
    }
    
    /**
     * Set the value of position
     *
     * @return  self
     */ 
    public function setPosition($position):Rover
    {
        $this->position = $position;
        
        return $this;
    }
    
    /**
     * Get the value of obstaclesList
     */ 
    public function getObstaclesList():ObstaclesList
    {
            return $this->obstaclesList;
    }
    /**
     * Set the value of obstaclesList
     *
     * @return  self
     */ 
    public function setObstaclesList($obstaclesList):Rover
    {
            $this->obstaclesList = $obstaclesList;
            return $this;
    }
    
    public function __toString():string
    {
        return sprintf('The position of the rover is X = %d Y = %d and direction = %s', $this->getPosition()->getX(), $this->getPosition()->getY(), $this->getPosition()->getDirection());
    }
}