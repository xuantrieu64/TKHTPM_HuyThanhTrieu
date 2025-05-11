<?php
require_once 'Order_Database.php';
$order_database = new Order_Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Lấy thông tin người dùng
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress']; // chú ý lỗi chính tả nếu có: "adress" => "adress"
    $pay_method = $_POST['method-pay'] ?? 'Momo';
    $products = $_POST['products'];

    // 2. Tính tổng tiền đơn hàng
    $total_money = 0;
    foreach ($products as $product) {
        $total_money += $product['price'] * $product['quantity'];
    }

    $voucher_discount = $_POST['voucher_discount'] ?? 0;
    $total_money -= ($total_money * (int)$voucher_discount / 100);


    // 3. Lưu vào bảng orders
    $order_id = $order_database->addOrderAndReturnId($name, $adress, $pay_method, $total_money);

    // 4. Lưu từng sản phẩm vào order_detail
    foreach ($products as $product) {
        $product_id = $product['id'];
        $quantity = $product['quantity'];
        $price = $product['price'];
        $order_database->addOrderDetail($order_id, $product_id, $quantity, $price);
    }

    // 5. Chuyển trang đến order.php
    header("Location: orders.php");
    exit;
}
