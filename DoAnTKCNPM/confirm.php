<?php
require_once 'Order_Database.php';
$order_database = new Order_Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $orderId = intval($_POST['order_id']);

    // Gọi hàm cập nhật trạng thái
    $updated = $order_database->updateOrderStatus($orderId, 'Đã giao');

    if ($updated) {
        // Chuyển hướng trở lại trang đơn hàng
        header('Location: orders.php');
        exit;
    } else {
        echo "Cập nhật trạng thái thất bại.";
    }
} else {
    echo "Dữ liệu không hợp lệ.";
}
