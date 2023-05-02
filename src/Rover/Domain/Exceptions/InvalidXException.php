<?php

namespace Src\Rover\Domain\Exceptions;

use Exception;

final class InvalidXException extends Exception
{
    public function __construct()
    {
        parent::__construct('X value is not valid');
    }
}