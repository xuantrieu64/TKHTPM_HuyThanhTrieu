<?php
require_once 'Order_Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];

    $db = new Order_Database();
    $result = $db->updateOrderStatus($orderId, 'Đang giao hàng');

    echo $result ? 'success' : 'error';
    
    exit; 
}
