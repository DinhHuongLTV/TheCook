<?php
require_once 'app/models/Model.php';
class OrderModel extends Model
{
    public $__user_id, $__fullname, $__address, $__phone, $__email, $__note, $__booking_date, $__booking_hour, $__price_total, $__payment_status, $__order_code;
    public $__chef_id;
    public function create() {
        $sql_create = "INSERT INTO orders (user_id, fullname, address, phone, email, note, booking_date, booking_hour, price_total, payment_status, order_code, chef_id) values (:user_id, :fullname, :address, :phone, :email, :note, :booking_date, :booking_hour, :price_total, :payment_status, :order_code, :chef_id)";
        $obj_create = $this->__connection->prepare($sql_create);
        $data = [
            ':user_id'=>$this->__user_id,
            ':fullname' => $this->__fullname,
            ':address' => $this->__address,
            ':phone' => $this->__phone,
            ':email' => $this->__email,
            ':note' => $this->__note,
            ':booking_date' => $this->__booking_date,
            ':booking_hour' => $this->__booking_hour,
            ':price_total' => $this->__price_total,
            ':payment_status' => $this->__payment_status,
            ':order_code' => $this->__order_code,
            ':chef_id'  =>$this->__chef_id
        ];
        return $obj_create->execute($data);
    }

    public function getAll($params = []) {
        $sql_search = " WHERE TRUE";
        if (isset($params['name'])) {
            $name = $params['name'];
            $sql_search = " WHERE order_code LIKE '%$name'";
        }
        $sql_select_all = "SELECT * FROM orders $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql_select = "SELECT * FROM orders WHERE id = :id";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':id' => $id
        ];
        $obj_select->execute($data);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
}