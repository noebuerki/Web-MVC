<?php

namespace App\Exception;

use App\View\View;
use Throwable;

class ExceptionListener
{
    private function __construct()
    {
    }

    public static function register()
    {
        set_exception_handler(self::class . '::handleException');
    }

    public static function handleException(Throwable $exception)
    {
        $error = $exception->getMessage();

        if (substr($error, -9) === "not found" || substr($error, -2) === "()") {
            print($error);
            $message = "404: Page not found";
        } else {
            $message = $error;
        }

        $view = new View('general/error');
        $view->title = 'Error';
        $view->heading = '❌ A Error has occured';
        $view->userMessage = $message;

        if ($exception instanceof DatabaseConnectionException) {
            $view->userMessage = 'Please contact the Administrator of this Website';
        }

        $view->display();
    }
}
