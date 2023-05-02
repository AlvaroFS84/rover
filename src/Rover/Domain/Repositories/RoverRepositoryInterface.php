<?php

namespace Src\Rover\Domain\Repositories;

/**
 * Interface implemented by a Infrastructure repostory, implementing Repository pattern
 */
interface RoverRepositoryInterface
{
    public function startRover(int $x, int $y, string $direction):void;
    public function getRover();
    public function updateRover(int $x, int $y, string $direction);
}