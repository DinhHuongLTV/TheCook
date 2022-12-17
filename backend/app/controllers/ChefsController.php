<?php
session_start();
require_once 'app/controllers/Controller.php';
require_once 'app/models/ChefModel.php';
require_once 'app/models/ChefCategoryModel.php';
class ChefsController extends Controller
{
    public function index() {
        $chef_model = new ChefModel();
        $this->__data['data'] = $chef_model->getAll();
        $this->__data['content'] = "chef/index";
        $this->__data['page_title'] = "Danh sách đầu bếp";
        $this->render("layouts/main", $this->__data);
    }

    public function create() {
        $has_error = 0;
        $chef_model = new ChefModel();
        $category_model = new ChefCategoryModel();
        if (isset($_POST['submit'])) {
            $username       = $_POST['username'];
            $password       = $_POST['password'];
            $password2      = $_POST['password2'];
            $first_name     = $_POST['firstname'];
            $last_name      = $_POST['lastname'];
            $phone          = $_POST['phone'];
            $email          = $_POST['email'];
            $jobs           = $_POST['jobs'];
            $facebook       = $_POST['facebook'];
            $status         = $_POST['status'];
            $summary        = $_POST['summary'];
            $description    = $_POST['description'];
            $avatar         = $_FILES['avatar'];
            $category_id    = $_POST['category'];
            $nationality    = $_POST['nationality'];
            $price          = $_POST['price'];
            if (empty($username)) {
                $this->__data['data']['ue'] = "Tên đăng nhập không để trống";
                $has_error = 1;
            } else if (strlen($username) < 5) {
                $this->__data['data']['ue'] = "Tên đăng nhập quá ngắn (tên đăng nhập lớn hơn 5 ký tự)";
                $has_error = 1;
            } else if ($chef_model->getByName($username) != NULL) {
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
            if (empty($nationality)) {
                $this->__data['data']['ne'] = "Quốc tịch không để trống";
                $has_error = 1;
            }
            if (empty($price)) {
                $this->__data['data']['pre'] = "Không để trống mức giá";
            } else if (!is_numeric($price)) {
                $this->__data['data']['pre'] = "Giá tiền là số nguyên";
            }
            if (empty($phone)){
                $this->__data['data']['phe'] = "Phải có số điện thoại";
                $has_error = 1;
            } else if(!preg_match('/^[0-9]{10}+$/', $phone)) {
                $this->__data['data']['phe'] = "Số điện thoại không hợp lệ";
                $has_error = 1;
            }
            if (empty($summary)) {
                $this->__data['data']['se'] = "Phải có mô tả ngắn gọn về bản thân";
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
                $filename = "placeholder.png";
                if ($avatar['error'] == 0) {
                    $dir_upload = "assets/uploads";
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    $filename = time() . "-chef-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }
                // gọi model
                $chef_model->__username = $username;
                $chef_model->__password = $password;
                $chef_model->__first_name = $first_name;
                $chef_model->__last_name = $last_name;
                $chef_model->__phone = $phone;
                $chef_model->__email = $email;
                $chef_model->__jobs = $jobs;
                $chef_model->__facebook = $facebook;
                $chef_model->__status = $status;
                $chef_model->__avatar = $filename;
                $chef_model->__description = $description;
                $chef_model->__summary  = $summary;
                $chef_model->__chef_category_id = $category_id;
                $chef_model->__nationality = $nationality;
                $chef_model->__price = $price;
                $is_inserted = $chef_model->create();
                if ($is_inserted) {
                    $_SESSION['success'] = "Tạo mới đầu bếp thành công";
                } else {
                    $_SESSION['error'] = "Tạo mới đầu bếp thất bại";
                }
                header("Location: index.php?controller=chefs&action=index");
                exit();
            }
        }
        $this->__data['data']['categories'] = $category_model->getAll();
        $this->__data['page_title'] = "Thêm mới đầu bếp";
        $this->__data['content'] = "chef/create";
        $this->render("layouts/main", $this->__data);
    }

    public function update()
    {
        $chef_model = new ChefModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $chef_model->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=chefs");
            exit();
        }
        $has_error = 0;
        $id = $_GET['id'];
        $chef_detail = $chef_model->getById($id);
        $this->__data['data']['username'] = $chef_detail['username'];
        $this->__data['data']['password'] = $chef_detail['password'];
        $this->__data['data']['avatar'] = $chef_detail['avatar'];
        $this->__data['data']['firstname'] = $chef_detail['first_name'];
        $this->__data['data']['lastname'] = $chef_detail['last_name'];
        $this->__data['data']['phone'] = $chef_detail['phone'];
        $this->__data['data']['email'] = $chef_detail['email'];
        $this->__data['data']['jobs'] = $chef_detail['jobs'];
        $this->__data['data']['facebook'] = $chef_detail['facebook'];
        $this->__data['data']['status'] = $chef_detail['status'];
        $this->__data['data']['summary'] = $chef_detail['summary'];
        $this->__data['data']['description'] = $chef_detail['description'];
        $this->__data['data']['address'] = $chef_detail['address'];
        $this->__data['data']['category'] = $chef_detail['category_id'];
        $this->__data['data']['nationality'] = $chef_detail['nationality'];
        $this->__data['data']['price'] = $chef_detail['price'];
        $filename = $chef_detail['avatar'];
        if (isset($_POST['submit'])) {
            $password   = $_POST['password'];
            $first_name = $_POST['firstname'];
            $last_name  = $_POST['lastname'];
            $phone      = $_POST['phone'];
            $email      = $_POST['email'];
            $jobs       = $_POST['jobs'];
            $facebook   = $_POST['facebook'];
            $status     = $_POST['status'];
            $description = $_POST['description'];
            $summary    = $_POST['summary'];
            $category_id = $_POST['category'];
            $nationality = $_POST['nationality'];
            $price = $_POST['price'];
            $avatar = $_FILES['avatar'];

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
            if (empty($price)) {
                $this->__data['data']['pre'] = "Không để trống mức giá";
            } else if (!is_numeric($price)) {
                $this->__data['data']['pre'] = "Giá tiền là số nguyên";
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
            if (empty($nationality)) {
                $this->__data['data']['ne'] = "Quốc tịch không để trống";
                $has_error = 1;
            }

            if (!$has_error) {
                // upload avatar
                if ($avatar['error'] == 0) {
                    $dir_upload = "assets/uploads";
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    @unlink($dir_upload . "/" . $filename);
                    $filename = time() . "-chef-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }
                // gọi model
                $chef_model->__password = $password;
                $chef_model->__first_name = $first_name;
                $chef_model->__last_name = $last_name;
                $chef_model->__phone = $phone;
                $chef_model->__email = $email;
                $chef_model->__jobs = $jobs;
                $chef_model->__facebook = $facebook;
                $chef_model->__status = $status;
                $chef_model->__avatar = $filename;
                $chef_model->__summary  = $summary;
                $chef_model->__description = $description;
                $chef_model->__chef_category_id = $category_id;
                $chef_model->__nationality  = $nationality;
                $is_updated = $chef_model->update($id);
                if ($is_updated) {
                    $_SESSION['success'] = "Cập nhật thông tin đầu bếp thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật thông tin đầu bếp thất bại";
                }
                header("Location: index.php?controller=chefs&action=index");
                exit();
            }
        }
        $this->__data['data']['categories'] = (new ChefCategoryModel())->getAll();
        $this->__data['content'] = 'chef/update';
        $this->__data['page_title'] = "Cập nhật thông tin đầu bếp";
        $this->render('layouts/main', $this->__data);
    }

    public function detail() {
        $chef_model = new ChefModel();
        $category_model = new ChefCategoryModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $chef_model->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=chefs");
            exit();
        }
        $id = $_GET['id'];
        $this->__data['page_title'] = "Chi tiết thông tin";
        $this->__data['data'] = $chef_model->getById($id);
        $this->__data['data']['category'] = $category_model->getById($this->__data['data']['category_id']);
        $this->__data['content'] = "chef/detail";
        $this->render("layouts/main", $this->__data);
    }

    public function delete() {
        $chef_model = new ChefModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $chef_model->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=chefs");
            exit();
        }
        $id = $_GET['id'];

        $is_deleted = $chef_model->delete($id);
        if ($is_deleted) {
            $_SESSION['success'] = "Xóa thành công";
        } else {
            $_SESSION['error'] = "Xóa thất bại";
        }
        header("Location: index.php?controller=chefs&action=index");
        exit();
    }
}