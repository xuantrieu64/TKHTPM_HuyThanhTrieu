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
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        return $items;
    }
    public function getRelatedProducts($category_id, $current_product_id, $limit = 4)
    {
        $sql = self::$connection->prepare("SELECT * FROM `sanpham` WHERE maloai=? AND ma != ? LIMIT ?");
        $sql->bind_param("iii", $category_id, $current_product_id, $limit);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteProduct($id)
    {
        $sql = self::$connection->prepare("DELETE FROM `sanpham` WHERE ma=?");
        $sql->bind_param('i', $id);
        $result = $sql->execute();
        return $result;
    }

    public function addProduct($id, $name, $price, $soluong, $desc, $image, $category_id, $created_date)
    {
        $sql = self::$connection->prepare("
            INSERT INTO `sanpham`(`ma`, `ten`, `gia`, `soluong`, `mota`, `anh`, `maloai`, `ngaytao`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $sql->bind_param('isiissis', $id, $name, $price, $soluong, $desc, $image, $category_id, $created_date);
        $result = $sql->execute();
        return $result;
    }

    //Delete
    // public function deleteProduct($id)
    // {
    //     $sql = self::$connection->prepare("DELETE FROM sanpham WHERE masp = ?");
    //     $sql->bind_param("i", $id);
    //     $resualt = $sql->execute();

    //     return $resualt;
    // }
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

    public function editProduct($id, $name, $price, $soluong, $desc, $image, $category_id, $created_date)
    {
        $sql = self::$connection->prepare("
            UPDATE `sanpham` 
            SET `ten` = ?, `gia` = ?, `soluong` = ?, `mota` = ?, `anh` = ?, `maloai` = ?, `ngaytao` = ?
            WHERE `ma` = ?
        ");
        $sql->bind_param('siissisi', $name, $price, $soluong, $desc, $image, $category_id, $created_date, $id);
        $result = $sql->execute();
        return $result;
    }
    public function getProductSales()
    {
        $sql = "SELECT ten, daban AS soluong_ban FROM sanpham ORDER BY soluong_ban DESC";

        $stmt = self::$connection->prepare($sql);
        if (!$stmt) {
            die("Lỗi truy vấn: " . self::$connection->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data ?: []; // Trả về mảng rỗng nếu không có dữ liệu
    }

    //lay voucher
    public function getVoucher()
    {
        $sql = self::$connection->prepare("SELECT * FROM magiamgia");
        $sql->execute();
        $result = array();
        $result = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function TongSoSanPham() {
        $sql = "SELECT COUNT(*) as total FROM sanpham";
        $result = self::$connection->query($sql); 
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    public function getProductStock($productType = null)
{
    $sql = "SELECT ten, soluong FROM sanpham"; 
    $conditions = [];

    if ($productType) {
        $conditions[] = "maloai = ?";
    }

    if ($conditions) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $stmt = self::$connection->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . self::$connection->error);
    }

    if ($productType) {
        $stmt->bind_param("s", $productType);
    }

    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
public function getProductOders($productType = null, $startDate = null, $endDate = null)
{
    $sql = "SELECT ten, daban AS soluong FROM sanpham WHERE 1=1";
    
    if ($productType) {
        $sql .= " AND ma_loai = ?";
    }
    if ($startDate && $endDate) {
        $sql .= " AND sold_date BETWEEN ? AND ?";
    }
    $sql .= " ORDER BY soluong DESC";

    $stmt = self::$connection->prepare($sql);
    if (!$stmt) {
        die("Lỗi truy vấn: " . self::$connection->error);
    }

    // Bind parameters
    if ($productType && $startDate && $endDate) {
        $stmt->bind_param("iss", $productType, $startDate, $endDate);
    } elseif ($productType) {
        $stmt->bind_param("s", $productType);
    } elseif ($startDate && $endDate) {
        $stmt->bind_param("ss", $startDate, $endDate);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data ?: []; 
}
}
