<?php
require_once 'Order_Database.php';
require_once 'SanPham_Database.php';
$order_database = new Order_Database();
$sanpham_database = new SanPham_Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);

    //Lấy danh sách sản phẩm và số lượng trong đơn hàng
    $sanphams = $order_database->getSanPhamWithQuantity($order_id);

    //Cập nhật số lượng tồn kho và số lượng đã bán
    if($sanphams && $sanphams->num_rows > 0) {
        while($row = $sanphams->fetch_assoc()) {
            $ma = $row['ma'];
            $quantity = $row['quantity'];

            $updateQuantity = $sanpham_database->updateQuantity($ma, $quantity);
        }
    }
    //cập nhật trạng thái
    $updated = $order_database->updateOrderStatus($order_id, 'Đã giao');

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
