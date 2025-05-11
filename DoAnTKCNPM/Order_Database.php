<?php
require_once 'Database.php';

class Order_Database extends Database
{
    //Order
    public function getAllOrders()
    {
        $sql = self::$connection->prepare("SELECT * FROM orders");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getOrderById($order_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM `orders` WHERE order_id = ?");
        $sql->bind_param('i', $order_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        return $items;
    }
    public function addOrder($id, $address, $pay_method, $total_money)
    {
        $sql = self::$connection->prepare("INSERT INTO orders (`id`, `address`, `pay_method`, `total_money`) 
        VALUES (?, ?, ?, ?)");
        $sql->bind_param('issi', $id, $address, $pay_method, $total_money);
        $result = $sql->execute();
        return $result;
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
            $sql = self::$connection->prepare("
            SELECT od.*, sp.ten, sp.anh 
            FROM order_detail od 
            INNER JOIN sanpham sp ON od.ma = sp.ma 
            WHERE od.order_id = ?");
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
}
