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
    public function TongSoSanPham()
    {
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
    //Search
    public function TimKiemSanPham($keyword)
    {
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
    public function TatCaLoaiSanPham()
    {
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


    public function SanPhamTheoLoai($maloai)
    {
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

    //Đánh giá sản phẩm
    public function getDanhGiaByMaSP($masp)
    {
        $stmt = self::$connection->prepare("
        SELECT danhgiasanpham.*, users.username 
            FROM danhgiasanpham 
            JOIN users ON danhgiasanpham.user_id = users.id 
            WHERE danhgiasanpham.sp_id = ? 
            ORDER BY danhgiasanpham.ngaydanhgia DESC
    ");
        $stmt->bind_param("i", $masp);
        $stmt->execute();
        $result = $stmt->get_result();

        $reviews = [];
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }

        $stmt->close();
        return $reviews;
    }

    //trung bình số sao

    public function getAverageRating($masp)
    {
        $stmt = self::$connection->prepare("
        SELECT ROUND(AVG(sao), 1) AS avg_rating, COUNT(*) AS total_reviews
        FROM danhgiasanpham 
        WHERE sp_id = ?
    ");
        $stmt->bind_param("i", $masp);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        return $result; // ['avg_rating' => ..., 'total_reviews' => ...]
    }
    //Cập nhật số lượng dựa vào mã sản phẩm
    public function updateQuantity($ma, $quantity)
    {
        $sql = self::$connection->prepare("UPDATE sanpham SET soluong = soluong - ?, daban = daban + ?
        WHERE ma = ? AND soluong >= ?");
        $sql->bind_param("iiii", $quantity, $quantity, $ma, $quantity);
        $item = $sql->execute();
        return $item;
    }
}
