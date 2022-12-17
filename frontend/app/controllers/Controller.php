<?php
class Controller
{
    public $__data;
    public function __construct()
    {
        $this->__data = [];
        $controller = isset($_GET['controller']) ? $_GET['controller'] : "user";
        $action = isset($_GET['action']) ? $_GET['action'] : "index";
        if (!isset($_SESSION['user'])
            && strcmp($controller, "login") && !in_array($action, ['login', 'signup'])
        ) {
            $_SESSION['error'] = "Bạn phải đăng nhập";
            header("Location: index.php?controller=login&action=login");
            exit();
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['user_category_id'] == 1) {
            unset($_SESSION['user']);
            header("Location: index.php?controller=login&action=login");
            exit();
        }
    }

    public function render($url, $data = []) {
        extract($data);
        if (file_exists("app/views/".$url.".php")) {
            require_once "app/views/".$url.".php";
        }
    }
}