<?php
session_start();

if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $id = $_POST['id'];
    $quantity = (int)$_POST['quantity'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['inputQuantity'] = $quantity;
        echo json_encode(['success' => true]);
        exit();
    }
}

echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
exit();