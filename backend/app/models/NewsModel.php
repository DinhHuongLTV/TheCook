<?php
require_once 'app/models/Model.php';

class NewsModel extends Model
{
    public $__name, $__summary, $__avatar, $__content, $__status, $__seo_title, $__seo_description, $__seo_keywords, $__category;
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

    public function getById($id) {
        $sql_select = "SELECT * FROM news WHERE id = :id";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':id' => $id
        ];
        $obj_select->execute($data);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $sql_create = "INSERT INTO news (name, summary, status, content, avatar, seo_keywords, seo_title, seo_description, category_id) 
                       VALUES (:name, :summary, :status, :content, :avatar, :seo_keywords, :seo_title, :seo_description, :category)";
        $obj_create = $this->__connection->prepare($sql_create);
        $data = [
            ':name'     => $this->__name,
            ':summary'  => $this->__summary,
            ':status'   => $this->__status,
            ':avatar'   => $this->__avatar,
            ':content'  => $this->__content,
            ':seo_title'    => $this->__seo_title,
            ':seo_keywords' => $this->__seo_keywords,
            ':seo_description'  => $this->__seo_description,
            ':category'     => $this->__category
        ];
        return $obj_create->execute($data);
    }

    public function update($id) {
        $sql_update = "UPDATE news SET 
                       name = :name, summary = :summary, status = :status, avatar = :img, content = :content, 
                       seo_keywords = :seo_keywords, seo_title = :seo_title, seo_description = :seo_description,
                       category_id = :category
                       WHERE id = :id";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':name'     => $this->__name,
            ':summary'  => $this->__summary,
            ':status'   => $this->__status,
            ':img'      => $this->__avatar,
            ':content'  => $this->__content,
            ':seo_title'    => $this->__seo_title,
            ':seo_keywords' => $this->__seo_keywords,
            ':seo_description'  => $this->__seo_description,
            ':category'     => $this->__category,
            ':id'           => $id
        ];
        return $obj_update->execute($data);
    }

    public function getByName($name) {
        $sql_select = "SELECT * FROM news WHERE name = :name";
        $obj_select = $this->__connection->prepare($sql_select);
        $data = [
            ':name' => $name
        ];
        $obj_select->execute($data);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql_delete = "DELETE FROM news WHERE id = :id";
        $obj_delete = $this->__connection->prepare($sql_delete);
        $data = [
            ':id' => $id
        ];
        return $obj_delete->execute($data);
    }

    public function countTotal()
    {
        $sql_count = "SELECT COUNT(id) FROM news WHERE TRUE";
        $obj_count = $this->__connection->prepare($sql_count);
        $obj_count->execute();
        return $obj_count->fetchColumn();
    }
}