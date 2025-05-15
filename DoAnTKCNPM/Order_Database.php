<?php
require_once 'Database.php';

class Order_Database extends Database
{
    //Lấy tất cả sản phẩm
    public function getAllOrders()
    {
        $sql = self::$connection->prepare("SELECT * FROM orders");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    //Order detail
    public function getAllOrderDetail()
    {
        $sql = self::$connection->prepare("SELECT order_detail.*, sanpham.ten, sanpham.anh FROM order_detail
        INNER JOIN sanpham ON order_detail.ma = sanpham.ma");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getAllOrdersWithDetails()
    {
        $orders = $this->getAllOrders();
        foreach ($orders as &$order) {
            $order_id = $order['order_id'];
            $sql = self::$connection->prepare("SELECT od.*, sp.ten, sp.anh FROM order_detail od 
            INNER JOIN sanpham sp ON od.ma = sp.ma WHERE od.order_id = ?");
            $sql->bind_param("i", $order_id);
            $sql->execute();
            $order['details'] = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return $orders;
    }

    public function getOrderDetailById($order_detail_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM order_detail WHERE order_detail_id = ?");
        $sql->bind_param('i', $order_detail_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        return $items;
    }
    public function addOrderDetail($order_id, $ma, $quantity, $price)
    {
        $sql = self::$connection->prepare("INSERT INTO order_detail (order_id, ma, quantity, price)
        VALUES(?, ?, ?, ?)");
        $sql->bind_param('iiii', $order_id, $ma, $quantity, $price);
        $result = $sql->execute();
        return $result;
    }
    public function addOrderAndReturnId($name, $address, $pay_method, $total_money)
    {
        $sql = self::$connection->prepare("INSERT INTO orders (`name`, `address`, `pay_method`, `total_money`, `created_at`, `status`)
    VALUES (?, ?, ?, ?, NOW(), 'Chờ xác nhận')");
        $sql->bind_param('sssd', $name, $address, $pay_method, $total_money);
        $sql->execute();
        return self::$connection->insert_id; // trả lại id của đơn hàng vừa tạo
    }
    public function updateOrderStatus($orderId, $newStatus)
    {
        $sql = self::$connection->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
        $sql->bind_param('si', $newStatus, $orderId);
        return $sql->execute();
    }
    public function getOrdersByPage($page, $perPage)
    {
        $startPage = (int)(($page - 1) * $perPage);
        $perPage = (int)$perPage;
        $query = "SELECT * FROM orders ORDER BY order_id DESC LIMIT $startPage, $perPage";
        $sql = self::$connection->prepare($query);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }



    public function getTotalOrders()
    {
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM orders");
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }



    public function paginateBar($url, $page, $total, $perPage)
    {
        $totalLink = ceil($total / $perPage);
        if ($total <= $perPage) {
            return '';
        }
        $link = "<ul class='pagination'>";
        //nut ve dau tien
        $link .= "<li class='page-item'><a href='$url&page=1' class='page-link'>&laquo;&laquo;</a></li>";
        //nut ve truoc do
        $prevPage = ($page > 1) ? ($page - 1) : 1;
        $link .= "<li class='page-item'><a href='$url&page=$prevPage' class='page-link'>&laquo;</a></li>";
        //cac trang
        for ($j = 1; $j <= $totalLink; $j++) {
            if ($j == $page) {
                $link .= "<li class='page-item active'><a href='$url&page=$j' class='page-link'>$j</a></li>";
            } else {
                $link .= "<li class='page-item'><a href='$url&page=$j' class='page-link'>$j</a></li>";
            }
        }
        //nut ke tiep
        $nextPage = ($page < $totalLink) ? ($page + 1) : $totalLink;
        $link .= "<li class='page-item'><a href='$url&page=$nextPage' class='page-link'>&raquo;</a></li>";
        //nut ve cuoi
        $link .= "<li class='page-item'><a href='$url&page=$totalLink' class='page-link'>&raquo;&raquo;</a></li>";
        $link .= "</ul>";
        return $link;
    }
    public function getOrdersWithDetailsByPage($page, $perPage)
    {
        $orders = $this->getOrdersByPage($page, $perPage);
        foreach ($orders as &$order) {
            $order_id = $order['order_id'];
            $sql = self::$connection->prepare("SELECT od.*, sp.ten, sp.anh FROM order_detail od 
            INNER JOIN sanpham sp ON od.ma = sp.ma WHERE od.order_id = ?");
            $sql->bind_param("i", $order_id);
            $sql->execute();
            $order['details'] = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return $orders;
    }
    //Lấy mã sản phẩm và số lượng sản phẩm theo đơn hàng
    public function getSanPhamWithQuantity($order_id)
    {
        $sql = self::$connection->prepare("SELECT ma, quantity FROM order_detail WHERE order_id = ?");
        $sql->bind_param("i", $order_id);
        $sql->execute();

        $result = $sql->get_result();
        return $result;
    }
}
