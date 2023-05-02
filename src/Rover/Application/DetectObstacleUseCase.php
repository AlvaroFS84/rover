<?php

namespace Src\Rover\Application;

use Src\Rover\Application\Interface\DetectObstacleUseCaseInterface;

/**
 * Use case with the obstacle detection responsability
 */
class DetectObstacleUseCase implements DetectObstacleUseCaseInterface
{
    /**
     * Encapsulates the obstacle detection logic
     */
    public function detect(int $x, int $y, array $obstacleList):bool
    {
        return in_array([$x,$y], $obstacleList);
    }
} 