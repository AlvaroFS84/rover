<?php

namespace Src\Rover\Application\Interface;

interface DetectObstacleUseCaseInterface
{
    public function detect(int $x, int $y, array $obstacleList):bool;
}