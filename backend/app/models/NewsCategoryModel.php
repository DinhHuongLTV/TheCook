<?php
require_once 'app/models/Model.php';
class NewsCategoryModel extends Model
{
    public $__name, $__description, $__status, $__avatar;
    public function getAll($params = [])
    {
        $sql_search = " WHERE TRUE";
        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            $sql_search = "WHERE username LIKE %$name%";
        }
        $sql_select_all = "SELECT * FROM news_categories $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql_select = "SELECT * FROM news_categories WHERE id = :id";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':id' => $id
        ];
        $obj_select->execute($data);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $sql_create = "INSERT INTO news_categories (name, description, status, avatar) VALUES (:name, :description, :status, :avatar)";
        $obj_create = $this->__connection->prepare($sql_create);
        $data = [
            ':name' => $this->__name,
            ':description' => $this->__description,
            ':status' => $this->__status,
            ':avatar' => $this->__avatar
        ];
        return $obj_create->execute($data);
    }

    public function update($id) {
        $sql_update = "UPDATE news_categories SET name = :name, description = :description, status = :status, avatar = :avatar WHERE id = :id";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':name' => $this->__name,
            ':description' => $this->__description,
            ':status' => $this->__status,
            ':avatar' => $this->__avatar,
            ':id' => $id
        ];
        return $obj_update->execute($data);
    }

    public function getByName($name) {
        $sql_select = "SELECT * FROM news_categories WHERE name = :name";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':name' => $name
        ];
        $obj_select->execute($data);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql_delete = "DELETE FROM news_categories WHERE id = :id";
        $obj_delete = $this->__connection->prepare($sql_delete);
        $data = [
            ':id' => $id
        ];
        return $obj_delete->execute($data);
    }

    public function countTotal()
    {
        $sql_count = "SELECT COUNT(id) FROM news_categories WHERE TRUE";
        $obj_count = $this->__connection->prepare($sql_count);
        $obj_count->execute();
        return $obj_count->fetchColumn();
    }
}