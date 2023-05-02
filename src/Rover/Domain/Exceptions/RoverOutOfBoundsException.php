<?php

namespace Src\Rover\Domain\Exceptions;

use Exception;

final class RoverOutOfBoundsException extends Exception
{
    public function __construct()
    {
        parent::__construct('Rover can\'t move out of map bounds');
    }
}