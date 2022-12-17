<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/NewsModel.php";
class NewsController extends Controller
{
//    public function search($name = "")
//    {
//        $this->__data['data'] = (new NewsModel())->getAll(['name' => $name]);
//        $this->__data['page_title'] = "Quản lý tin";
//        $this->__data['content'] = 'news/index';
//        $this->render('layouts/main', $this->__data);
//    }

    public function detail() {
        $news_model = new NewsModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: index.php?controller=news&action=index");
            exit();
        }
        $id = $_GET['id'];
        $this->__data['data'] = $news_model->getById($id);
//        echo "<pre>";
//        print_r($this->__data['data']);
//        echo "</pre>";
        $this->__data['content'] = "news/detail";
        $this->__data['header'] = "blocks/header_logined";
        $this->__data['footer'] = "blocks/footer_main";
        $this->__data['page_title'] = $this->__data['data']['name'];
        $this->render("layouts/main", $this->__data);
    }

    public function index() {
        $news_model = new NewsModel();
        $this->__data['data']['news'] = $news_model->getAll();
        $this->__data['content'] = "news/index";
        $this->__data['page_title'] = "Tin mới nhất";
        $this->__data['header'] = "blocks/header_logined";
        $this->__data['footer'] = "blocks/footer_main";
        $this->render("layouts/main", $this->__data);
    }
}