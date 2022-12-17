<?php
session_start();
require_once 'app/controllers/Controller.php';
require_once 'app/models/OrderModel.php';
class OrderController extends Controller
{
    public function index (){
        $order_model = new OrderModel();
        $this->__data['data'] = $order_model->getAll();
        $this->__data['page_title'] = "Quản lý đơn hàng";
        $this->__data['content'] = "order/index";
        $this->render('layouts/main', $this->__data);
    }

    public function detail() {
        $order_model = new OrderModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $order_model->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=order&action=index");
            exit();
        }

        $id = $_GET['id'];
        $this->__data['data'] = $order_model->getById($id);
        $this->__data['content'] = "order/detail";
        $this->__data['page_title'] = "Chi tiết đơn hàng";
    }
}