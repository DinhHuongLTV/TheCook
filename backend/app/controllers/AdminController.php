<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/AdminModel.php";

class AdminController extends Controller
{
    public function index($username = "")
    {
        $admin_model = new AdminModel();
        $this->__data['data'] = $admin_model->getAll(['name' => $username]);
        $this->__data['page_title'] = "Danh sách admin";
        $this->__data['content'] = 'admin/index';
        $this->render('layouts/main', $this->__data);
    }

    public function create()
    {
        $admin_model = new AdminModel();
        $existed_admin = $admin_model->getAll();
        if (isset($_POST['submit'])) {
            $username = $this->__data['data']['username'] = $_POST['username'];
            $password = $this->__data['data']['password'] = $_POST['password'];
            $password2 = $this->__data['data']['password2'] = $_POST['password2'];
            $avatar = $_FILES['avatar'];
            if (empty($username)) {
                $this->__data['data']['ue'] = "Tên đăng nhập không để trống";
            } else if (strlen($username) < 5) {
                $this->__data['data']['ue'] = "Tên đăng nhập quá ngắn (tên đăng nhập lớn hơn 5 ký tự)";
            } else {
                foreach ($existed_admin as $admin) {
                    if (!strcmp($admin['username'], $username)) {
                        $this->__data['data']['ue'] = "Tên đăng nhập đã tồn tại";
                    }
                }
            }
            if (empty($password)) {
                $this->__data['data']['pe'] = "Mật khẩu không để trống";
            } else if (strlen($password) < 5) {
                $this->__data['data']['pe'] = "Mật khẩu quá ngắn (Mật khẩu lớn hơn 5 ký tự)";
            }
            if (empty($password2)) {
                $this->__data['data']['pe2'] = "Chưa nhập lại mật khẩu";
            } else if (strcmp($password, $password2) != 0) {
                $this->__data['data']['pe2'] = "Mật khẩu không trùng khớp";
            }
            if ($avatar['error'] == 0) {
                $filename_extension = ['png', 'jpg', 'jpeg'];
                $extension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
                $file_size_mb = round($avatar['size'] / 1024 / 1024, 2);
                if (!in_array($extension, $filename_extension)) {
                    $this->__data['data']['ae'] = "Ảnh không đúng định dạng";
                } else if ($file_size_mb > 2) {
                    $this->__data['data']['ae'] = "Kích thước ảnh quá lớn (chọn ảnh nhỏ hơn 2mb)";
                }
            }

            if (empty($this->__data['data']['ue']) &&
                empty($this->__data['data']['pe']) &&
                empty($this->__data['data']['pe2']) &&
                empty($this->__data['data']['ae'])) {
                // upload avatar
                $filename = "placeholder.png";
                if ($avatar['error'] == 0) {
                    $dir_upload = "assets/uploads";
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    $filename = time() . "-admin-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }
                // gọi model
                $admin_model->__username = $username;
//                $admin_model->__password = md5($password);
                $admin_model->__password = $password;
                $admin_model->__avatar = $filename;
                $is_inserted = $admin_model->create();
                if ($is_inserted) {
                    $_SESSION['success'] = "Thêm admin thành công";
                } else {
                    $_SESSION['error'] = "Thêm admin thất bại";
                }
                header("Location: index.php?controller=admin&action=index");
                exit();
            }
        }

        // gọi view
        $this->__data['content'] = 'admin/create';
        $this->__data['page_title'] = "Tạo admin";
        $this->render('layouts/main', $this->__data);
    }

    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=admin");
            exit();
        }
        $id = $_GET['id'];
        $admin_model = new AdminModel();
        $admin_detail = $admin_model->getById($id);
        $this->__data['data']['username'] = $admin_detail['username'];
        $this->__data['data']['password'] = $admin_detail['password'];
        $this->__data['data']['avatar']   = $admin_detail['avatar'];
        if (isset($_POST['submit'])) {
            $password =  $_POST['password'];
            $avatar = $_FILES['avatar'];
            if (empty($password)) {
                $this->__data['data']['pe'] = "Mật khẩu không để trống";
            } else if (strlen($password) < 5) {
                $this->__data['data']['pe'] = "Mật khẩu quá ngắn (Mật khẩu lớn hơn 5 ký tự)";
            }
            if ($avatar['error'] == 0) {
                $filename_extension = ['png', 'jpg', 'jpeg'];
                $extension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
                $file_size_mb = round($avatar['size'] / 1024 / 1024, 2);
                if (!in_array($extension, $filename_extension)) {
                    $this->__data['data']['ae'] = "Ảnh không đúng định dạng";
                } else if ($file_size_mb > 2) {
                    $this->__data['data']['ae'] = "Kích thước ảnh quá lớn (chọn ảnh nhỏ hơn 2mb)";
                }
            }

            if (
                empty($this->__data['data']['pe']) &&
                empty($this->__data['data']['ae'])) {
                // upload avatar
                $filename = $admin_detail['avatar'];
                if ($avatar['error'] == 0) {
                    $dir_upload = "assets/uploads";
                    @unlink($dir_upload . '/' . $filename);
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    $filename = time() . "-admin-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }
                // gọi model
//                $admin_model->__username = $username;
//                $admin_model->__password = md5($password);/
                $admin_model->__password = $password;
                $admin_model->__avatar = $filename;
                $is_updated = $admin_model->update($id);
                if ($is_updated) {
                    $_SESSION['success'] = "Cập nhật admin thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật admin thất bại";
                }
                header("Location: index.php?controller=admin&action=index");
                exit();
            }
        }
        // gọi view
        $this->__data['content'] = 'admin/update';
        $this->__data['page_title'] = "Cập nhật admin";
        $this->render('layouts/main', $this->__data);
    }

    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: index.php?controller=admin&action=index");
            exit();
        }

        $id = $_GET['id'];
        $admin_model = new AdminModel();
        $this->__data['data'] = $admin_model->getById($id);
        $this->__data['page_title'] = "Thông tin admin";
        $this->__data['content'] = 'admin/detail';
        $this->render("layouts/main", $this->__data);
    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: index.php?controller=admin&action=index");
            exit();
        }
        $id = $_GET['id'];
        $admin_model = new AdminModel();
        $is_deleted = $admin_model->delete($id);
        if ($is_deleted) {
            $_SESSION['success'] = "Xóa admin thành công";
        } else {
            $_SESSION['error'] = "Xóa admin thành công";
        }
        header("Location: index.php?controller=admin&action=index");
        exit();
    }
}