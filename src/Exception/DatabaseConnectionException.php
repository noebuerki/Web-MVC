<?php

namespace App\Exception;

use Exception;

class DatabaseConnectionException extends Exception
{
    public function __construct($errors)
    {
        $message = 'Can`t connect to Database';
        $code = 0;
        $previous = null;

        parent::__construct($message, $code, $previous);
    }
}
