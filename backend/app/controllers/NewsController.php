<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/NewsModel.php";
require_once "app/models/NewsCategoryModel.php";

class NewsController extends Controller
{
    public function index($name = "")
    {
        $this->__data['data'] = (new NewsModel())->getAll(['name' => $name]);
        $this->__data['page_title'] = "Quản lý tin";
        $this->__data['content'] = 'news/index';
        $this->render('layouts/main', $this->__data);
    }

    public function create()
    {
        $category_model = new NewsCategoryModel();
        $news_model = new NewsModel();
        $has_error = 0;
        if (isset($_POST['submit'])) {
            $category_id    = $this->__data['data']['category']     = $_POST['category'];
            $name           = $this->__data['data']['name']         = $_POST['name'];
            $summary        = $this->__data['data']['summary']      = $_POST['summary'];
            $content        = $this->__data['data']['content']      = $_POST['content'];
            $seo_title      = $this->__data['data']['seo_title']    = $_POST['seo_title'];
            $seo_keywords   = $this->__data['data']['seo_keywords'] = $_POST['seo_keywords'];
            $seo_description = $this->__data['data']['seo_description'] = $_POST['seo_description'];
            $status         = $this->__data['data']['status']           = $_POST['status'];
            $avatar         = $_FILES['avatar'];
            if (empty($name)) {
                $this->__data['data']['ne'] = "Tiêu đề không để trống";
                $has_error = 1;
            } else if (strlen($name) < 10) {
                $this->__data['data']['ne'] = "Tiêu đề quá ngắn";
                $has_error = 1;
            }

            if (empty($summary)) {
                $this->__data['data']['se'] = "Phải tóm tắt tin tức";
                $has_error = 1;
            } else if (strlen($summary) < 20) {
                $this->__data['data']['se'] = "Tóm tắt phải đảm bảo trên 20 từ";
                $has_error = 1;
            }

            if ($avatar['error'] == 0) {
                $filename_extension = ['png', 'jpg', 'jpeg'];
                $extension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
                $file_size_mb = round($avatar['size'] / 1024 / 1024, 2);
                if (!in_array($extension, $filename_extension)) {
                    $this->__data['data']['ae'] = "Ảnh không đúng định dạng";
                    $has_error = 1;
                } else if ($file_size_mb > 4) {
                    $this->__data['data']['ae'] = "Kích thước quá lớn";
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
                    $filename = time() . "-news-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }

//                $__name, $__summary, $__img, $__content, $__status, $__seo_title, $__seo_description, $__seo_keywords, $__category;
                $news_model->__category = $category_id;
                $news_model->__name = $name;
                $news_model->__summary = $summary;
                $news_model->__avatar = $filename;
                $news_model->__content = $content;
                $news_model->__status = $status;
                $news_model->__seo_description = $seo_description;
                $news_model->__seo_title = $seo_title;
                $news_model->__seo_keywords = $seo_keywords;

                $is_created = $news_model->create();
                if ($is_created) {
                    $_SESSION['success'] = "Tạo tin thành công";
                } else {
                    $_SESSION['error'] = "Tạo tin thất bại";
                }
                header("Location: index.php?controller=news&action=index");
                exit();
            }
        }

        $this->__data['data']['categories'] = $category_model->getAll();
        $this->__data['content'] = "news/create";
        $this->__data['page_title'] = "Tạo tin tức mới";
        $this->render('layouts/main', $this->__data);
    }

    public function update() {
        $category_model = new NewsCategoryModel();
        $news_model = new NewsModel();
        $has_error = 0;

        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $news_model->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: index.php?controller=news&action=index");
            exit();
        }

        $id = $_GET['id'];
        $existed_news = $news_model->getById($id);
        $this->__data['data']['category']   = $existed_news['category_id'];
        $this->__data['data']['name']       = $existed_news['name'];
        $this->__data['data']['summary']    = $existed_news['summary'];
        $this->__data['data']['content']    = $existed_news['content'];
        $this->__data['data']['seo_title']  = $existed_news['seo_title'];
        $this->__data['data']['seo_keywords']       = $existed_news['seo_keywords'];
        $this->__data['data']['seo_description']    = $existed_news['seo_description'];
        $this->__data['data']['status']             = $existed_news['status'];
        $this->__data['data']['avatar']             = $existed_news['avatar'];
        $filename                                   = $existed_news['avatar'];
        if (isset($_POST['submit'])) {
            $category_id    = $this->__data['data']['category']     = $_POST['category'];
            $name           = $this->__data['data']['name']         = $_POST['name'];
            $summary        = $this->__data['data']['summary']      = $_POST['summary'];
            $content        = $this->__data['data']['content']      = $_POST['content'];
            $seo_title      = $this->__data['data']['seo_title']    = $_POST['seo_title'];
            $seo_keywords   = $this->__data['data']['seo_keywords'] = $_POST['seo_keywords'];
            $seo_description = $this->__data['data']['seo_description'] = $_POST['seo_description'];
            $status         = $this->__data['data']['status']           = $_POST['status'];
            $avatar         = $_FILES['avatar'];
            if (empty($name)) {
                $this->__data['data']['ne'] = "Tiêu đề không để trống";
                $has_error = 1;
            } else if (strlen($name) < 10) {
                $this->__data['data']['ne'] = "Tiêu đề quá ngắn";
                $has_error = 1;
            }

            if (empty($summary)) {
                $this->__data['data']['se'] = "Phải tóm tắt tin tức";
                $has_error = 1;
            } else if (strlen($summary) < 20) {
                $this->__data['data']['se'] = "Tóm tắt phải đảm bảo trên 20 từ";
                $has_error = 1;
            }

            if ($avatar['error'] == 0) {
                $filename_extension = ['png', 'jpg', 'jpeg'];
                $extension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
                $file_size_mb = round($avatar['size'] / 1024 / 1024, 2);
                if (!in_array($extension, $filename_extension)) {
                    $this->__data['data']['ae'] = "Ảnh không đúng định dạng";
                    $has_error = 1;
                } else if ($file_size_mb > 4) {
                    $this->__data['data']['ae'] = "Kích thước quá lớn";
                    $has_error = 1;
                }
            }

            if (!$has_error) {
                if ($avatar['error'] == 0) {
                    $dir_upload = "assets/uploads";
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    $filename = time() . "-news-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }

//                $__name, $__summary, $__img, $__content, $__status, $__seo_title, $__seo_description, $__seo_keywords, $__category;
                $news_model->__category = $category_id;
                $news_model->__name     = $name;
                $news_model->__summary  = $summary;
                $news_model->__avatar   = $filename;
                $news_model->__content  = $content;
                $news_model->__status   = $status;
                $news_model->__seo_description  = $seo_description;
                $news_model->__seo_title        = $seo_title;
                $news_model->__seo_keywords     = $seo_keywords;

                $is_created = $news_model->update($id);
                if ($is_created) {
                    $_SESSION['success'] = "Cập nhật tin thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật tin thất bại";
                }
                header("Location: index.php?controller=news&action=index");
                exit();
            }
        }

        $this->__data['data']['categories'] = $category_model->getAll();
        $this->__data['content'] = "news/update";
        $this->__data['page_title'] = "Cập nhật tin";
        $this->render('layouts/main', $this->__data);
    }

    public function detail() {
        $news_model = new NewsModel();
        $category_model = new NewsCategoryModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $news_model->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: index.php?controller=news&action=index");
            exit();
        }
        $id = $_GET['id'];
        $this->__data['data'] = $news_model->getById($id);
        $this->__data['data']['categories'] = $category_model->getAll();
        $this->__data['content'] = "news/detail";
        $this->__data['page_title'] = "Chi tiết tin tức";
        $this->render("layouts/main", $this->__data);
    }

    public function delete() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || (new NewsModel())->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: index.php?controller=news&action=index");
            exit();
        }

        $id = $_GET['id'];
        $is_deleted = (new NewsModel())->delete($id);
        if ($is_deleted) {
            $_SESSION['success'] = "Xóa thành công";
        } else {
            $_SESSION['error'] = "Xóa thất bại";
        }
        header("Location: index.php?controller=news&action=index");
        exit();
    }
}