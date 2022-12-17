<?php
require_once "app/models/Model.php";
class NewsModel extends Model
{

    public function getAll($params = [])
    {
        $sql_search = " WHERE TRUE";
        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            $sql_search = " WHERE name LIKE %$name%";
        }
        $sql_select_all = "SELECT * FROM news $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByName($name) {
        $sql_select = "SELECT * FROM news WHERE name LIKE ':name'";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':name' => $name
        ];
        $obj_select->execute($data);
        $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql_select = "SELECT * FROM news WHERE id = :id";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':id' => $id
        ];
        $obj_select->execute($data);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
}