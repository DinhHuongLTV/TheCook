<?php
require_once 'app/models/Model.php';

class AdminModel extends Model
{
    public $__username, $__password, $__avatar;
    public function getAll($params = [])
    {
        $sql_search = " WHERE TRUE";
        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            $sql_search = " WHERE username LIKE '%$name%'";
        }
        $sql_getAll = "SELECT * FROM admin $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_getAll);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql_select_one = "SELECT * FROM admin WHERE id = :id";
        $obj_select_one = $this->__connection->prepare($sql_select_one);
        $data = [
            ':id'=>$id
        ];
        $obj_select_one->execute($data);
        return $obj_select_one->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $sql_create = "INSERT INTO admin (username, password, avatar) VALUES (:username, :password, :avatar)";
        $obj_create = $this->__connection->prepare($sql_create);
        $data = [
            ':username' => $this->__username,
            ':password' => $this->__password,
            ':avatar' => $this->__avatar
        ];
        return $obj_create->execute($data);
    }

    public function delete($id)
    {
        $sql_delete = "DELETE FROM admin WHERE id = :id";
        $obj_delete = $this->__connection->prepare($sql_delete);
        $data = [
            ':id' => $id,
        ];
        return $obj_delete->execute($data);
    }

    public function update($id)
    {
        $sql_update = "UPDATE admin SET password = :password, avatar = :avatar WHERE id = :id";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':password' => $this->__password,
            ':avatar' => $this->__avatar,
            ':id' => $id
        ];
        return $obj_update->execute($data);
    }

    public function getByName($name) {
        $sql_select = "SELECT * FROM admin WHERE username = :username";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':username' => $name
        ];
        $obj_select->execute($data);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    public function countTotal()
    {
        $sql_count = "SELECT COUNT(id) FROM admin WHERE TRUE";
        $obj_count = $this->__connection->prepare($sql_count);
        $obj_count->execute();
        return $obj_count->fetchColumn();
    }
}