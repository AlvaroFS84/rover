<?php

namespace Src\Rover\Domain\Exceptions;

use Exception;

final class InvalidYException extends Exception
{
    public function __construct()
    {
        parent::__construct('Y value is not valid');
    }
}