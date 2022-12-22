<?php
session_start();
require_once "app/controllers/Controller.php";
class HomeController extends Controller
{
    public function index()
    {
        $data['content'] = "home/index";
        $data['page_title'] = "The Cook - Trang chủ";
        $data['header'] = "blocks/header_logined";
        $data['footer'] = "blocks/footer_main";
        $this->render("layouts/main", $data);
    }
}
