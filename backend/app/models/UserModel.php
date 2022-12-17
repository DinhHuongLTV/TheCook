<?php
require_once 'app/models/Model.php';

class UserModel extends Model
{
    public $__category_id = 3;
    public $__username, $__password, $__first_name, $__last_name, $__phone, $__address, $__email, $__avatar, $__jobs;
    public $__facebook, $__status;
    public function getAll($params = [])
    {
        $sql_search = " WHERE TRUE";
        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            $sql_search = " WHERE username LIKE %$name%";
        }
        $sql_select_all = "SELECT * FROM users $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql_select_one = "SELECT * FROM users WHERE id = :id";
        $obj_select_one = $this->__connection->prepare($sql_select_one);
        $data = [
            ':id'=>$id
        ];
        $obj_select_one->execute($data);
        return $obj_select_one->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $sql_create = "INSERT INTO users (category_id, username, password, first_name, last_name, phone, address, email, avatar, jobs, facebook, status)
                       VALUES (:category_id, :username, :password, :first_name, :last_name, :phone, :address, :email, :avatar, :jobs, :facebook, :status)";
        $obj_create = $this->__connection->prepare($sql_create);
        $data = [
            ':category_id' =>$this->__category_id,
            ':username' => $this->__username,
            ':password' => $this->__password,
            ':avatar' => $this->__avatar,
            ':first_name' => $this->__first_name,
            ':last_name' => $this->__last_name,
            ':phone' => $this->__phone,
            ':address' => $this->__address,
            ':email' => $this->__email,
            ':jobs' => $this->__jobs,
            ':facebook' => $this->__facebook,
            ':status' => $this->__status
        ];
        return $obj_create->execute($data);
    }

    public function delete($id)
    {
        $sql_delete = "DELETE FROM users WHERE id = :id";
        $obj_delete = $this->__connection->prepare($sql_delete);
        $data = [
            ':id' => $id
        ];
        return $obj_delete->execute($data);
    }

    public function update($id)
    {
        $sql_update = "UPDATE users SET username = :username, password = :password, first_name = :first_name, last_name = :last_name,
                        phone = :phone, address = :address, email = :email, avatar = :avatar, jobs = :jobs, facebook = :facebook, status = :status WHERE id = :id";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':username'     => $this->__username,
            ':password'     => $this->__password,
            ':avatar'       => $this->__avatar,
            ':first_name'   => $this->__first_name,
            ':last_name'    => $this->__last_name,
            ':phone'        => $this->__phone,
            ':address'      => $this->__address,
            ':email'        => $this->__email,
            ':jobs'         => $this->__jobs,
            ':facebook'     => $this->__facebook,
            ':status'       => $this->__status,
            ':id'           => $id
        ];
        return $obj_update->execute($data);
    }

    public function countTotal()
    {
        $sql_count = "SELECT COUNT(id) FROM users WHERE TRUE";
        $obj_count = $this->__connection->prepare($sql_count);
        $obj_count->execute();
        return $obj_count->fetchColumn();
    }

    public function getByUsername($username) {
        $sql_select = "SELECT * FROM users WHERE username = :username";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':username' => $username
        ];
        $obj_select->execute($data);
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
}