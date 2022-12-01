<?php

namespace App\View;

class View
{
    private $viewfile;

    private $properties = array();

    public $isDocument = false;

    public function __construct($viewfile)
    {
        $this->viewfile = "./../templates/$viewfile.php";
    }

    public function __get($key)
    {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }
    }

    public function __set($key, $value)
    {
        if (!isset($this->$key)) {
            $this->properties[$key] = $value;
        }
    }

    public function display()
    {
        extract($this->properties);

        require './../templates/general/header.php';
        require $this->viewfile;
        require './../templates/general/footer.php';
    }
}
