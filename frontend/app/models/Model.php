<?php
require_once "configs/DataBase.php";
class Model
{
    public $__connection;
    public function __construct()
    {
        try {
            $this->__connection = new PDO(Database::DB_DSN, DataBase::DB_USERNAME, DataBase::DB_PASSWORD);
        } catch (PDOException $e) {
            die("Lỗi kết nốt: " . $e->getMessage());
        }
    }
}