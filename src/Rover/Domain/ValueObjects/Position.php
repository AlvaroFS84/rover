<?php

namespace Src\Rover\Domain\ValueObjects;

use Src\Rover\Domain\Exceptions\InvalidDirectionException as ExceptionsInvalidDirectionException;
use Src\Rover\Domain\Exceptions\InvalidXException as ExceptionsInvalidXException;
use Src\Rover\Domain\Exceptions\InvalidYException as ExceptionsInvalidYException;

/**
 * Value object that represents the position of the rover
 */
class Position
{
    public function __construct(
        private int $x,
        private int $y,
        private string $direction
    )
    {
        if( $this->x < 0 || $this->x > 200 ){
            throw new ExceptionsInvalidXException;
        }

        if( $this->y < 0 || $this->y > 200 ){
            throw new ExceptionsInvalidYException;
        }

        if( ! in_array($this->direction, ['N', 'S', 'E', 'W'])){
            throw new ExceptionsInvalidDirectionException;
        }
    }
    
    //Value object are inmutable, so we dont need setters

    /**
     * Get the value of x
     */ 
    public function getX():int
    {
         return $this->x;
    }
    /**
     * Get the value of y
     */ 
    public function getY():int
    {
        return $this->y;
    }

    /**
     * Get the value of direction
     */ 
    public function getDirection():string
    {
        return $this->direction;
    }

    /**
     * check if two positions are equals
     */
    public function isEqualTo(Position $other):bool
    {
        return $this->x === $other->getX() && $this->y === $other->getY() && $this->direction === $other->getDirection(); 
    }
}