<?php

namespace App\Controller;

use App\View\View;

class DefaultController
{
    private $errorCodes = array(
        "Unknown Error", 
        "Input Error", 
        "Permission Error"
    );

    public function index()
    {
        $controller = new UserController();
        $controller->index();
    }

    public function about()
    {
        $view = new View('default/about');
        $view->title = 'About us ❤️';
        $view->heading = 'About Web-MVC';
        $view->display();
    }

    public function privacy()
    {
        $view = new View('default/privacy');
        $view->title = 'Privacy';
        $view->heading = 'Privacy is essential';
        $view->display();
    }

    public function error()
    {
        if (!empty($_GET['errorid']) && is_numeric($_GET['errorid']) && !empty($_GET['target']) && is_string($_GET['target'])) {
            if (!strpos($_GET['target'], "javascript")) {
                $target = $_GET['target'];
                $view = new View('default/error');
                $view->title = 'Info';
                $view->heading = '';
                $view->message = $this->errorCodes[$_GET['errorid'] - 1];
                $view->target = $target;
                $view->display();
            } else {
                header('Location: /default/error?errorid=1&target=/');
            }
        } else {
            header('Location: /default/error?errorid=2&target=/');
        }
    }
}
