<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/OrderModel.php";
require_once "app/models/ChefModel.php";
class OrderController extends Controller
{
    public function booking() {
        $chef_model = new ChefModel();

        if(!isset($_GET['chef_id']) || !is_numeric($_GET['chef_id']) || $chef_model->getById($_GET['chef_id']) == NULL) {
            header("Location: index.php?controller=chef&action=index");
            exit();
        }
        $chef_id = $_GET['chef_id'];
        $this->__data['data']['chef'] = $chef_model->getById($chef_id);

        if (isset($_POST['submit'])) {
            $thoigian = $_POST['booking_hour'];
            $thoiluong = $_POST['booking_time'];
            $date = $_POST['booking_date'];
            $address = $_POST['booking_place'];
            if (empty($thoigian) || empty($thoiluong) || empty($date) || empty($address)) {
                $this->__data['error'] = "Vui lòng nhập đủ thông tin";
            } else if ($thoiluong < 0) {
                $this->__data['error'] = "Thời lượng sai cú pháp";
            }

            if (empty($this->__data['error'])) {
                $_SESSION['order_detail']['booking_hour'] = $thoigian;
                $_SESSION['order_detail']['booking_time'] = $thoiluong;
                $_SESSION['order_detail']['booking_date'] = $date;
                $_SESSION['order_detail']['booking_place'] = $address;
                $_SESSION['order_detail']['chef_id'] = $chef_id;
                header("Location: index.php?controller=order&action=create&chef_id=$chef_id");
                exit();
            }
        }
        $this->__data['page_title'] = "Đặt lịch đầu bếp";
        $this->__data['content'] = "order/booking";
        $this->__data['header'] = "blocks/header_logined";
        $this->__data['footer'] = "blocks/footer_main";
        $this->render('layouts/main', $this->__data);
    }

    public function detail() {
        $order_model = new OrderModel();

        if(!isset($_GET['id']) || !is_numeric($_GET['id']) || $order_model->getById($_GET['id']) == NULL) {
            header("Location: index.php?controller=order&action=index");
            exit();
        }

        $id = $_GET['id'];
        $this->__data['order'] = $order_model->getById($id);
        $this->__data['page_title'] = "Chi tiết đơn hàng";
        $this->__data['content'] = "order/detailed";
        $this->__data['header'] = "blocks/header_logined";
        $this->__data['footer'] = "blocks/footer_main";
        $this->render('layouts/main', $this->__data);
    }

    public function index() {
        $order_model = new OrderModel();

        $this->__data['orders'] = $order_model->getAll();
        $this->__data['page_title'] = "Lịch sử thuê đầu bếp";
        $this->__data['content'] = "order/index";
        $this->__data['header'] = "blocks/header_logined";
        $this->__data['footer'] = "blocks/footer_main";
        $this->render('layouts/main', $this->__data);
    }

    public function create() {
        $chef_model = new ChefModel();
        $order_model = new OrderModel();

        if(!isset($_GET['chef_id']) || !is_numeric($_GET['chef_id']) || $chef_model->getById($_GET['chef_id']) == NULL) {
            header("Location: index.php?controller=chef&action=index");
            exit();
        }

//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";

        if (isset($_POST['submit'])) {
            $order_model->__payment_status = 0;
            if (isset($_POST['payment'])) {
                $order_model->__payment_status = 1;
            }

            $order_model->__user_id = $_SESSION['user']['id'];
            $order_model->__fullname = $_SESSION['user']['first_name'] ." ". $_SESSION['user']['last_name'];
            $order_model->__address = $_POST['address'];
            $order_model->__order_code = $_POST['order_code'];
            $order_model->__phone  = $_POST['phone'];
            $order_model->__note   = $_POST['note'];
            $order_model->__booking_date = $_POST['date'];
            $order_model->__booking_hour = $_POST['time'];
            $order_model->__price_total = $_POST['price'];
            $order_model->__chef_id = $_SESSION['order_detail']['chef_id'];
            $is_created = $order_model->create();
                if ($is_created) {
                    header("Location: index.php?controller=chef&action=index");
                } else {
                    header("Location: index.php?controller=fail");
                }
            exit();
        }

        $chef_id = $_GET['chef_id'];
        $this->__data['chef'] = $chef_model->getById($chef_id);
        $this->__data['page_title'] = "Xác nhận đơn hàng";
        $this->__data['content'] = "order/detail";
        $this->__data['header'] = "blocks/header_logined";
        $this->__data['footer'] = "blocks/footer_main";
        $this->render('layouts/main', $this->__data);
    }
}