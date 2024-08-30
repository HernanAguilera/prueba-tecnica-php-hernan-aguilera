<?php

namespace Hernanaguilera\PruebaTecnicaPhp\Repositories;


class InvalidDataException extends \Exception
{
    public function __construct($message = "Invalid data", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
