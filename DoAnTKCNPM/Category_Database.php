<?php
require_once 'Database.php';

class Category_Database extends Database
{
    public function getAllLoai()
    {
        $sql = self::$connection->prepare("SELECT * FROM `loai`");
        $sql->execute();
        $result = array();
        $result = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getAllLoaiById($maloai)
    {
        $sql = self::$connection->prepare("SELECT * FROM `loai` WHERE maloai = ?");
        $sql->bind_param('i', $maloai);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        return $items;
    }
}
