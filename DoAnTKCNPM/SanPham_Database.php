<?php
require_once 'Database.php';

class SanPham_Database extends Database
{
    //lay tat ca du lieu
    public function TatCaSanPham()
   {
        $sql = self::$connection->prepare("SELECT * FROM sanpham");
       $sql->execute();
       $result = array();
        $result = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
   }
 

    
    //function getAllProducts($page, $perPage)
   // {
        // Tính số thứ tự trang bắt đầu
       // $firstLink = ($page - 1) * $perPage;
        //Dùng LIMIT để giới hạn số lượng hiển thị 1 trang
       // $sql = "SELECT * FROM products LIMIT $firstLink, $perPage";
       // $sql->execute(); //return an object
       // $items = array();
       // $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
       // return $items; //return an array
   // } 

    //lay id
    // public function getProductById($id)
    // {
    //     $sql = self::$connection->prepare("SELECT * FROM product WHERE id = ?");
    //     $sql->bind_param("i", $id); //Truy van cau lenh
    //     $sql->execute(); //Thuc thi cau lenh

    //     $items = array();
    //     $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC)[0];
    //     return $items;
    // }

    public function getProductByID($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM `sanpham` WHERE ma=?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items[0];
    }
    public function getRelatedProducts($category_id, $current_product_id, $limit = 4)
    {
        $sql = self::$connection->prepare("SELECT * FROM `sanpham` WHERE maloai=? AND ma != ? LIMIT ?");
        $sql->bind_param("iii", $category_id, $current_product_id, $limit);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function addProduct($id, $name, $price, $desc, $image, $category_id)
    {
        $sql = self::$connection->prepare("INSERT INTO product VALUE (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("isissi", $id, $name, $price, $desc, $image, $category_id);
        $resualt = $sql->execute();
        return $resualt;
    }

    //Delete
    public function deleteProduct($id)
    {
        $sql = self::$connection->prepare("DELETE FROM sanpham WHERE masp = ?");
        $sql->bind_param("i", $id);
        $resualt = $sql->execute();

        return $resualt;
    }
    //Search
    public function searchProduct($keyword)
    {
        $sql = self::$connection->prepare("SELECT * FROM product WHERE name LIKE '%$keyword%'");
        //$sql->bind_param("i", $id); //Truy van cau lenh
        $sql->execute(); //Thuc thi cau lenh

        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    //Edit
    public function editProduct($id, $name, $price, $desc, $image, $category_id)
    {
        $stmt = self::$connection->prepare("UPDATE Products SET id = ? name = ?, price = ?, desc = ?, image = ?, category_id = ? WHERE id = ?");
        $stmt->bind_param("isissii", $name, $price, $desc, $image, $category_id, $id);
        return $stmt->execute();
    }
}
