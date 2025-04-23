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
    $quantity = $_POST['inputQuantity'] ?? 1; // Lấy số lượng từ POST, mặc định là 1

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    $productExists = false;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['ma'] == $ma) {
            $_SESSION['cart'][$key]['inputQuantity'] += $quantity;
            $productExists = true;
            break;
        }
    }

    // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
    if (!$productExists) {
        $_SESSION['cart'][] = [
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
