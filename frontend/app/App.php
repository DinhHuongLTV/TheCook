<?php

class App
{
    public $__controller, $__action;

    public function __construct()
    {
        $this->__controller = 'chef';
        $this->__action = 'index';
        $this->handleUrl();
    }

    public function loadError($name = '404')
    {
        require_once "app/views/errors/" . $name . ".php";
    }

    public function handleUrl()
    {
        if (isset($_GET["controller"]) && !empty($_GET["controller"])) {
            $this->__controller = $_GET["controller"];
        }
        // xu ly controller
        if (file_exists("app/controllers/" . $this->__controller . "Controller.php")) {
            require_once "app/controllers/" . $this->__controller . "Controller.php";
            $controller = $this->__controller . "Controller";
            if (class_exists($controller)) {
                $this->__controller = new $controller();
            } else {
                $this->loadError();
            }
        }

        // xu ly action
        if (isset($_GET["action"]) && !empty($_GET["action"])) {
            $this->__action = $_GET["action"];
        }


        if (!method_exists($this->__controller, $this->__action)) {
            $this->loadError();
        } else {
            call_user_func_array([$this->__controller, $this->__action], []);
        }
    }
}