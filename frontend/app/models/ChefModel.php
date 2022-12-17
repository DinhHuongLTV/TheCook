<?php
require_once 'app/models/Model.php';

class ChefModel extends Model
{
    public $__user_category_id = 2;
    public $__chef_category_id;
    public $__username;
    public $__password;
    public $__first_name;
    public $__last_name;
    public $__summary;
    public $__description;
    public $__nationality;
    public $__phone;
    public $__address;
    public $__email;
    public $__avatar;
    public $__jobs;
    public $__facebook;
    public $__status;
    public $__price;

    public function create() {
        $sql_create = "INSERT INTO chefs 
    (user_category_id, category_id, username, password, avatar, price, first_name, last_name, summary, description, nationality, phone, address, email, jobs, facebook, status) VALUES 
    (:user_category_id,  :chef_category_id, :username, :password, :avatar, :price, :first_name, :last_name, :summary, :description, :nationality, :phone, :address, :email, :jobs, :facebook, :status)";
        $obj_create = $this->__connection->prepare($sql_create);
        $data = [
            ':user_category_id' => $this->__user_category_id,
            ':chef_category_id' => $this->__chef_category_id,
            ':username'         => $this->__username,
            ':password'         => $this->__password,
            ':avatar'           => $this->__avatar,
            ':first_name'       => $this->__first_name,
            ':last_name'        => $this->__last_name,
            ':summary'          => $this->__summary,
            ':description'      => $this->__description,
            ':nationality'      => $this->__nationality,
            ':phone'            => $this->__phone,
            ':address'          => $this->__address,
            ':email'            => $this->__email,
            ':jobs'             => $this->__jobs,
            ':facebook'         => $this->__facebook,
            ':status'           => $this->__status,
            ':price'            => $this->__price
        ];
        return $obj_create->execute($data);
    }

    public function getById($id)
    {
        $sql_select_one = "SELECT * FROM chefs WHERE id = :id";
        $obj_select_one = $this->__connection->prepare($sql_select_one);
        $data = [
            ':id'=>$id
        ];
        $obj_select_one->execute($data);
        return $obj_select_one->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id)
    {
        $sql_update = "UPDATE chefs SET category_id = :chef_category_id, password = :password, avatar = :avatar, first_name = :first_name, last_name = :last_name, summary = :summary, description = :description, 
                 nationality = :nationality, price = :price, phone = :phone, address = :address, email = :email, jobs = :jobs, facebook = :facebook, status = :status WHERE id = :id";
        $data = [
            ':password'     => $this->__password,
            ':avatar'   => $this->__avatar,
            ':first_name'   => $this->__first_name,
            ':last_name'    => $this->__last_name,
            ':summary'      => $this->__summary,
            ':description'  => $this->__description,
            ':nationality'  => $this->__nationality,
            ':phone'    => $this->__phone,
            ':address'  => $this->__address,
            ':email'    => $this->__email,
            ':jobs'     => $this->__jobs,
            ':price'    => $this->__price,
            ':facebook' => $this->__facebook,
            ':status'   => $this->__status,
            ':chef_category_id' => $this->__chef_category_id,
            ':id'       => $id
        ];

        $obj_update = $this->__connection->prepare($sql_update);
        return $obj_update->execute($data);
    }

    public function getAll($params = [])
    {
        $sql_search = " WHERE TRUE";
        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            $sql_search = " WHERE username LIKE '%$name%'";
        }
        $sql_getAll = "SELECT * FROM chefs $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_getAll);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }
}