<?php
session_start();
require_once 'app/controllers/Controller.php';
require_once 'app/models/ChefCategoryModel.php';

class ChefCategoryController extends Controller
{
    public function index($category_name = "")
    {
        $category_model = new ChefCategoryModel();
        $this->__data['data'] = $category_model->getAll(['name' => $category_name]);
        $this->__data['page_title'] = "Danh sách hạng mục đầu bếp";
        $this->__data['content'] = "chefCategories/index";
        $this->render('layouts/main', $this->__data);
    }

    public function create()
    {
        $has_error = 0;
        $category_model = new ChefCategoryModel();
        if (isset($_POST['submit'])) {
            $name = $this->__data['data']['name'] = $_POST['name'];
            $description = $this->__data['data']['description'] = $_POST['description'];
            $status = $this->__data['data']['status'] = $_POST['status'];
            $avatar = $_FILES['avatar'];

            if (empty($name)) {
                $this->__data['data']['ne'] = "Tên hạng mục không để trống";
                $has_error = 1;
            } else if (strlen($name) < 4) {
                $this->__data['data']['ne'] = "Tên hạng mục quá ngắn";
                $has_error = 1;
            } else if ($category_model->getByName($name) != NULL) {
                $this->__data['data']['ne'] = "Hạng mục đã được tạo";
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

            if ($has_error == 0) {
                if ($avatar['error'] == 0) {
                    $filename = "placeholder.png";
                    $dir_upload = "assets/uploads";
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    $filename = time() . "-chefCategory-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }
                $category_model->__name = $name;
                $category_model->__description = $description;
                $category_model->__avatar = $filename;
                $category_model->__status = $status;
                $is_created = $category_model->create();
                if ($is_created) {
                    $_SESSION['success'] = "Tạo mới hạng mục thành công";
                } else {
                    $_SESSION['error'] = "Tạo mới hạng mục thất bại";
                }
                header("Location: index.php?controller=chefCategory&action=index");
                exit();
            }
        }
        $this->__data['page_title'] = "Thêm hạng mục mới";
        $this->__data['content'] = "chefcategories/create";
        $this->render('layouts/main', $this->__data);
    }

    public function update()
    {

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: index.php?controller=chefCategory&action=index");
            exit();
        }
        $id = $_GET['id'];
        $has_error = 0;
        $category_model = new ChefCategoryModel();
        $existed_category = $category_model->getById($id);
        $this->__data['data']['name'] = $existed_category['name'];
        $this->__data['data']['description'] = $existed_category['description'];
        $this->__data['data']['status'] = $existed_category['status'];
        $this->__data['data']['avatar'] = $existed_category['avatar'];
        $filename = $existed_category['avatar'];
        if (isset($_POST['submit'])) {
            $name = $this->__data['name'] = $_POST['name'];
            $description = $this->__data['description'] = $_POST['description'];
            $status = $this->__data['status'] = $_POST['status'];
            $avatar = $_FILES['avatar'];

            if (empty($name)) {
                $this->__data['data']['ne'] = "Tên hạng mục không để trống";
                $has_error = 1;
            } else if (strlen($name) < 4) {
                $this->__data['data']['ne'] = "Tên hạng mục quá ngắn";
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

            if ($has_error == 0) {
                if ($avatar['error'] == 0) {
                    $dir_upload = "assets/uploads";
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    @unlink($dir_upload . "/" . $filename);
                    $filename = time() . "-chefCategory-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }
                $category_model->__name = $name;
                $category_model->__description = $description;
                $category_model->__avatar = $filename;
                $category_model->__status = $status;
                $is_created = $category_model->update($id);
                if ($is_created) {
                    $_SESSION['success'] = "Chỉnh sửa hạng mục thành công";
                } else {
                    $_SESSION['error'] = "Chỉnh sửa hạng mục thất bại";
                }
                header("Location: index.php?controller=chefCategory&action=index");
                exit();
            }
        }
        $this->__data['page_title'] = "Chỉnh sửa hạng mục";
        $this->__data['content'] = "chefcategories/update";
        $this->render('layouts/main', $this->__data);
    }

    public function delete()
    {
        $category_model = new ChefCategoryModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: index.php?controller=chefCategory&action=index");
            exit();
        }

        $id = $_GET['id'];
        $existed_category = $category_model->getById($id);
        @unlink("assets/uploads/" . $existed_category['avatar']);
        $is_deleted = $category_model->delete($id);
        if ($is_deleted) {
            $_SESSION['success'] = "Xóa hạng mục thành công";
        } else {
            $_SESSION['error'] = "Xóa hạng mục thất bại";
        }
        header("Location: index.php?controller=chefCategory&action=index");
        exit();
    }

    public function detail()
    {
        $category_model = new ChefCategoryModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: index.php?controller=chefCategory&action=index");
            exit();
        }
        $id = $_GET['id'];
        $this->__data['data'] = $category_model->getById($id);
        $this->__data['page_title'] = "Chi tiết hạng mục";
        $this->__data['content'] = "chefcategories/detail";
        $this->render('layouts/main', $this->__data);
    }
}