<?php
require_once "app/models/Model.php";
class OrderModel extends Model
{


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