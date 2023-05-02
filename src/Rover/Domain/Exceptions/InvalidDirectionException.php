<?php

namespace Src\Rover\Domain\Exceptions;

use Exception;

final class InvalidDirectionException extends Exception
{
    public function __construct()
    {
        parent::__construct('Direction value is not valid');
    }
}