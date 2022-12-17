<?php
require_once "app/models/Model.php";
class OrderDetailModel extends Model
{
    public function detail($id) {
        $sql_select = "SELECT * FROM orders JOIN chefs ON orders.chef_id = chefs.id WHERE orders.id = :id";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':id' => $id,
        ];
        $obj_select->execute($data);
        echo "<pre>";
        print_r($obj_select->fetchAll(PDO::FETCH_ASSOC));
        echo "</pre>";
//        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
}