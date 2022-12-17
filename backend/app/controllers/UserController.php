<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/UserModel.php";

class UserController extends Controller
{
    public function index($username = "")
    {
        $user_model = new UserModel();
        $this->__data['data'] = $user_model->getAll(['name' => $username]);
        $this->__data['page_title'] = "Danh sách admin";
        $this->__data['content'] = 'user/index';
        $this->render('layouts/main', $this->__data);
    }

    public function create()
    {
        $has_error = 0;
        $user_model = new UserModel();
        if (isset($_POST['submit'])) {
            $username   = $this->__data['data']['username']     = $_POST['username'];
            $password   = $this->__data['data']['password']     = $_POST['password'];
            $password2  = $this->__data['data']['password2']    = $_POST['password2'];
            $first_name = $this->__data['data']['firstname']    = $_POST['firstname'];
            $last_name  = $this->__data['data']['lastname']     = $_POST['lastname'];
            $phone      = $this->__data['data']['phone']    = $_POST['phone'];
            $email      = $this->__data['data']['email']    = $_POST['email'];
            $jobs       = $this->__data['data']['jobs']     = $_POST['jobs'];
            $facebook   = $this->__data['data']['facebook'] = $_POST['facebook'];
            $status     = $this->__data['data']['status']   = $_POST['status'];
            $avatar     = $_FILES['avatar'];
            if (empty($username)) {
                $this->__data['data']['ue'] = "Tên đăng nhập không để trống";
                $has_error = 1;
            } else if (strlen($username) < 5) {
                $this->__data['data']['ue'] = "Tên đăng nhập quá ngắn (tên đăng nhập lớn hơn 5 ký tự)";
                $has_error = 1;
            } else if ($user_model->getByUsername($username) != NULL) {
                $this->__data['data']['ue'] = "Tên đăng nhập đã tồn tại";
                $has_error = 1;
            }
            if (empty($password)) {
                $this->__data['data']['pe'] = "Mật khẩu không để trống";
                $has_error = 1;
            } else if (strlen($password) < 5) {
                $this->__data['data']['pe'] = "Mật khẩu quá ngắn (Mật khẩu lớn hơn 5 ký tự)";
                $has_error = 1;
            }
            if (empty($password2)) {
                $this->__data['data']['pe2'] = "Chưa nhập lại mật khẩu";
                $has_error = 1;
            } else if (strcmp($password, $password2) != 0) {
                $this->__data['data']['pe2'] = "Mật khẩu không trùng khớp";
                $has_error = 1;
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->__data['data']['ee'] = "Email không đúng định dạng";
                $has_error = 1;
            }
            if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
                $this->__data['data']['fbe'] = "Link không đúng định dạng";
                $has_error = 1;
            }
            if(!preg_match('/^[0-9]{10}+$/', $phone)) {
                $this->__data['data']['phe'] = "Số điện thoại không hợp lệ";
                $has_error = 1;
            }
            if ($avatar['error'] == 0) {
                $filename_extension = ['png', 'jpg', 'jpeg'];
                $extension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
                $file_size_mb = round($avatar['size'] / 1024 / 1024, 2);
                if (!in_array($extension, $filename_extension)) {
                    $this->__data['data']['ae'] = "Ảnh không đúng định dạng";
                    $has_error = 1;
                } else if ($file_size_mb > 2) {
                    $this->__data['data']['ae'] = "Kích thước ảnh quá lớn (chọn ảnh nhỏ hơn 2mb)";
                    $has_error = 1;
                }
            }

            if (!$has_error) {
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
                $user_model->__username = $username;
                $user_model->__password = $password;
                $user_model->__first_name = $first_name;
                $user_model->__last_name = $last_name;
                $user_model->__phone = $phone;
                $user_model->__email = $email;
                $user_model->__jobs = $jobs;
                $user_model->__facebook = $facebook;
                $user_model->__status = $status;
                $user_model->__avatar = $filename;
                $is_inserted = $user_model->create();
                if ($is_inserted) {
                    $_SESSION['success'] = "Tạo mới người dùng thành công";
                } else {
                    $_SESSION['error'] = "Tạo mới người dùng thất bại";
                }
                header("Location: index.php?controller=user&action=index");
                exit();
            }
        }

        // gọi view
        $this->__data['content'] = 'user/create';
        $this->__data['page_title'] = "Tạo người dùng mới";
        $this->render('layouts/main', $this->__data);
    }

    public function update()
    {
        $user_model = new UserModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $user_model->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=user");
            exit();
        }
        $has_error = 0;
        $id = $_GET['id'];
        $user_detail = $user_model->getById($id);
        $this->__data['data']['username'] = $user_detail['username'];
        $this->__data['data']['password'] = $user_detail['password'];
        $this->__data['data']['avatar'] = $user_detail['avatar'];
        $this->__data['data']['firstname'] = $user_detail['first_name'];
        $this->__data['data']['lastname'] = $user_detail['last_name'];
        $this->__data['data']['phone'] = $user_detail['phone'];
        $this->__data['data']['email'] = $user_detail['email'];
        $this->__data['data']['jobs'] = $user_detail['jobs'];
        $this->__data['data']['facebook'] = $user_detail['facebook'];
        $this->__data['data']['status'] = $user_detail['status'];
        $filename = $user_detail['avatar'];
        if (isset($_POST['submit'])) {
            $username = $this->__data['data']['username'] = $_POST['username'];
            $password = $this->__data['data']['password'] = $_POST['password'];
            $first_name = $this->__data['data']['firstname'] = $_POST['firstname'];
            $last_name = $this->__data['data']['lastname'] = $_POST['lastname'];
            $phone = $this->__data['data']['phone'] = $_POST['phone'];
            $email = $this->__data['data']['email'] = $_POST['email'];
            $jobs = $this->__data['data']['jobs'] = $_POST['jobs'];
            $facebook = $this->__data['data']['facebook'] = $_POST['facebook'];
            $status = $this->__data['data']['status'] = $_POST['status'];
            $avatar = $_FILES['avatar'];
            if (empty($username)) {
                $this->__data['data']['ue'] = "Tên đăng nhập không để trống";
                $has_error = 1;
            } else if (strlen($username) < 5) {
                $this->__data['data']['ue'] = "Tên đăng nhập quá ngắn (tên đăng nhập lớn hơn 5 ký tự)";
                $has_error = 1;
            }

            if (empty($password)) {
                $this->__data['data']['pe'] = "Mật khẩu không để trống";
                $has_error = 1;
            } else if (strlen($password) < 5) {
                $this->__data['data']['pe'] = "Mật khẩu quá ngắn (Mật khẩu lớn hơn 5 ký tự)";
                $has_error = 1;
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->__data['data']['ee'] = "Email không đúng định dạng";
                $has_error = 1;
            }
            if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
                $this->__data['data']['fbe'] = "Link không đúng định dạng";
                $has_error = 1;
            }
            if ($avatar['error'] == 0) {
                $filename_extension = ['png', 'jpg', 'jpeg'];
                $extension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
                $file_size_mb = round($avatar['size'] / 1024 / 1024, 2);
                if (!in_array($extension, $filename_extension)) {
                    $this->__data['data']['ae'] = "Ảnh không đúng định dạng";
                    $has_error = 1;
                } else if ($file_size_mb > 2) {
                    $this->__data['data']['ae'] = "Kích thước ảnh quá lớn (chọn ảnh nhỏ hơn 2mb)";
                    $has_error = 1;
                }
            }

            if (!$has_error) {
                // upload avatar
                if ($avatar['error'] == 0) {
                    $dir_upload = "assets/uploads";
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    @unlink($dir_upload . "/" . $filename);
                    $filename = time() . "-admin-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }
                // gọi model
                $user_model->__username = $username;
                $user_model->__password = $password;
                $user_model->__first_name = $first_name;
                $user_model->__last_name = $last_name;
                $user_model->__phone = $phone;
                $user_model->__email = $email;
                $user_model->__jobs = $jobs;
                $user_model->__facebook = $facebook;
                $user_model->__status = $status;
                $user_model->__avatar = $filename;
                $is_updated = $user_model->update($id);
                if ($is_updated) {
                    $_SESSION['success'] = "Cập nhật thông tin người dùng thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật thông tin người dùng thất bại";
                }
                header("Location: index.php?controller=user&action=index");
                exit();
            }
        }
        // gọi view
        $this->__data['content'] = 'user/update';
        $this->__data['page_title'] = "Cập nhật thành viên";
        $this->render('layouts/main', $this->__data);
    }

    public function detail()
    {
        $user_model = new UserModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $user_model->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: index.php?controller=user&action=index");
            exit();
        }

        $id = $_GET['id'];
        $this->__data['data'] = $user_model->getById($id);
        $this->__data['page_title'] = "Thông tin thành viên";
        $this->__data['content'] = 'user/detail';
        $this->render("layouts/main", $this->__data);
    }

    public function delete()
    {
        $user_model = new UserModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $user_model->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: index.php?controller=admin&action=index");
            exit();
        }
        $id = $_GET['id'];
        $existed_user = $user_model->getById($id);
        @unlink("assets/uploads/" . $existed_user['avatar']);
        $is_deleted = $user_model->delete($id);
        if ($is_deleted) {
            $_SESSION['success'] = "Xóa user thành công";
        } else {
            $_SESSION['error'] = "Xóa user thất bại";
        }
        header("Location: index.php?controller=user&action=index");
        exit();
    }
}