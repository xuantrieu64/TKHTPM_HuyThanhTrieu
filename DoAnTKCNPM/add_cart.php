<?php
session_start();
// var_dump($_SESSION['cart']);

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['ma'])) {
    $ma = $_POST['ma'];
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $anh = $_POST['anh'];
    $quantity = isset($_POST['inputQuantity']) ? (int)$_POST['inputQuantity'] : 1;

    if (isset($_SESSION['cart'][$ma])) {
        $_SESSION['cart'][$ma]['inputQuantity'] += $quantity;
    } else {
        $_SESSION['cart'][$ma] = [
            'ma' => $ma,
            'ten' => $ten,
            'gia' => $gia,
            'anh' => $anh,
            'inputQuantity' => $quantity
        ];
    }
}

header('Location: index.php');
exit();
