<?php

namespace Src\Rover\Domain\Exceptions;

use Exception;

final class CommandNotValidException extends Exception
{
    public function __construct()
    {
        parent::__construct('Command not valid inserted');
    }
}