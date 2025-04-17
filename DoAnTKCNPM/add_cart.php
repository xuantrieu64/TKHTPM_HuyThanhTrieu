<?php 
session_start();

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if(isset($_POST['ma'])){
    $ma = $_POST['ma'];
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];

    $_SESSION['cart'][] = [
        'ma' => $ma,
        'ten' => $ten,
        'gia' => $gia,
        'inputQuantity' => 1
    ];
}

header('Location: index.php');
exit();
