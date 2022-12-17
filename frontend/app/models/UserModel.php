<?php
require_once "app/models/Model.php";
class UserModel extends Model
{
    public $__category_id = 3;
    public $__username, $__password, $__first_name, $__last_name, $__phone, $__address, $__email, $__avatar, $__jobs;
    public $__facebook, $__status = 1;
    public function getById($id) {
        $sql_select = "SELECT * FROM users WHERE id = :id";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':id' => $id,
        ];
        $obj_select->execute($data);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $sql_create = "INSERT INTO users (category_id, username, password, status)
                       VALUES (:category_id, :username, :password, :status)";
        $obj_create = $this->__connection->prepare($sql_create);
        $data = [
            ':category_id' =>$this->__category_id,
            ':username' => $this->__username,
            ':password' => $this->__password,
            ':status'   => $this->__status
        ];
        return $obj_create->execute($data);
    }

    public function update($id)
    {
        $sql_update = "UPDATE users SET password = :password, first_name = :first_name, last_name = :last_name,
                        phone = :phone, address = :address, email = :email, avatar = :avatar, jobs = :jobs, facebook = :facebook WHERE id = :id";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':password'     => $this->__password,
            ':avatar'       => $this->__avatar,
            ':first_name'   => $this->__first_name,
            ':last_name'    => $this->__last_name,
            ':phone'        => $this->__phone,
            ':address'      => $this->__address,
            ':email'        => $this->__email,
            ':jobs'         => $this->__jobs,
            ':facebook'     => $this->__facebook,
            ':id'           => $id
        ];
        return $obj_update->execute($data);
    }

    public function getByUsername($username) {
        $sql_select = "SELECT * FROM users WHERE username = :username";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':username' => $username
        ];
        $obj_select->execute($data);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
}