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
    

    public function deleteProduct($id)
    {
        $sql = self::$connection->prepare("DELETE FROM `sanpham` WHERE ma=?");
        $sql->bind_param('i', $id);
        $result = $sql->execute();
        return $result;
    }

    public function addProduct($id, $name, $price, $desc, $image, $category_id, $created_date, $soluong)
    {
        $sql = self::$connection->prepare("
            INSERT INTO `sanpham`(`ma`, `ten`, `gia`, `mota`, `anh`, `maloai`, `ngaytao`, `soluong`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $sql->bind_param('isissisi', $id, $name, $price, $desc, $image, $category_id, $created_date, $soluong);
        $result = $sql->execute();
        return $result;
    }
    
    //Search
    
    
    public function TimKiemSanPham($keyword) {
        $stmt = self::$connection->prepare("SELECT * FROM sanpham WHERE ten LIKE ?");
        $search = "%" . $keyword . "%";
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $sanphams = [];
        while ($row = $result->fetch_assoc()) {
            $sanphams[] = $row;
        }
        $stmt->close();
        return $sanphams;
    }
    
    
    public function editProduct($id, $name, $price, $desc, $image, $category_id, $created_date, $soluong)
    {
        $sql = self::$connection->prepare("
            UPDATE `sanpham` 
            SET `ten` = ?, `gia` = ?, `mota` = ?, `anh` = ?, `maloai` = ?, `ngaytao` = ?, `soluong` = ?
            WHERE `ma` = ?
        ");
        $sql->bind_param('sissisii', $name, $price, $desc, $image, $category_id, $created_date,$soluong, $id);
        $result = $sql->execute();
        return $result;
    }
    public function getProductSales() {
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
    




    //loại sản phẩm
    public function TatCaLoaiSanPham() {
        $stmt = self::$connection->prepare("SELECT * FROM loai");
        $stmt->execute();
        $result = $stmt->get_result();
        $loais = [];
        while ($row = $result->fetch_assoc()) {
            $loais[] = $row;
        }
        $stmt->close();
        return $loais;
    }
    
    public function SanPhamTheoLoai($maloai) {
        $stmt = self::$connection->prepare("SELECT * FROM sanpham WHERE maloai = ?");
        $stmt->bind_param("i", $maloai);
        $stmt->execute();
        $result = $stmt->get_result();
        $sanphams = [];
        while ($row = $result->fetch_assoc()) {
            $sanphams[] = $row;
        }
        $stmt->close();
        return $sanphams;
    }

    //Đánh giá
    
    
    
}
