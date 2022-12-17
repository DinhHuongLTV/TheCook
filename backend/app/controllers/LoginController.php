<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/AdminModel.php";
class LoginController extends Controller
{
    public function login() {
//        nếu đăng nhập rồi thì chuyển hướng backend
        if (isset($_SESSION['user'])) {
            header("Location: index.php?controller=user&action=index");
            exit();
        }

        if (isset($_POST['submit'])) {
            $admin_model = new AdminModel();
            $username = $this->__data['data']['username'] = $_POST['username'];
            $password = $this->__data['data']['password'] = $_POST['password'];

            if (empty($username) || empty($password)) {
                $this->__data['error'] = "Tên đăng nhập / mật khẩu không để trống";
            }

            if (empty($this->__data['error'])) {
                $existed_admin = $admin_model->getByName($username);
                if (empty($existed_admin)) {
                    $this->__data['error'] = "Người dùng không tồn tại";
                } else {
                    $is_same = password_verify($password, $existed_admin['password']);
                    if ($is_same) {
                        $this->__data['error'] = "Sai mật khẩu";
                    } else {
                        $_SESSION['success'] = "Đăng nhập thành công";
                        $_SESSION['user'] = $existed_admin;
                        header("Location: index.php?controller=user");
                        exit();
                    }
                }
            }
        }
        $this->__data['content'] = "login/login";
        $this->render("layouts/main_login", $this->__data);
    }

    public function signup(){
        if (isset($_SESSION['user'])) {
            header("Location: index.php?controller=user&action=index");
            exit();
        }
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            if (empty($username) || empty($password)) {
                $this->__data['error'] = "Không để trống tên ĐN / MK";
            } else if (strlen($username) < 5 || strlen($password) < 5) {
                $this->__data['error'] = "Tên ĐN / MK quá ngắn";
            } else if (empty($password_confirm)) {
                $this->__data['error'] = "Chưa xác nhận lại mật khẩu";
            } else if (strcmp($password_confirm, $password)) {
                $this->__data['error'] = "Mật khẩu không trùng khớp";
            } else if ((new AdminModel())->getByName($username) != NULL) {
                $this->__data['error'] = "Tên đãng nhập đã được dùng";
            }

            if (empty($this->__data['error'])) {
                $admin_model = new AdminModel();
                $admin_model->__username = $username;
                $admin_model->__password = $password;
                $is_created = $admin_model->create();
                if ($is_created) {
                    $_SESSION['success'] = "Đăng nhập bằng tài khoản vừa tạo";
                    header("Location: index.php?controller=login&action=login");
                    exit();
                } else {
                    $this->__data['error'] = "Không tạo được";
                }
            }
        }

        $this->__data['content'] = "login/signup";
        $this->render('layouts/main_login', $this->__data);
    }

    public function signout() {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        if (isset($_COOKIE['user'])) {
            setcookie('user', "", time()-1);
        }
        $_SESSION['success'] = "Đăng xuất thành công";
        header("Location: index.php?controller=login&action=login");
    }
}