<?php
session_start();
require_once 'Database.php'; // Đảm bảo không có khoảng trắng hoặc dòng mới trước đó

// Tạo đối tượng Database và lấy kết nối
$db = new Database();
$conn = $db->__construct();  // Kết nối cơ sở dữ liệu

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối CSDL không thành công.");
}

// Lấy dữ liệu từ form
$sp_id = $_POST['sp_id'] ?? null;
$user_id = $_POST['user_id'] ?? null;
$sao = $_POST['sao'] ?? null;
$noidung = trim($_POST['noidung'] ?? '');

// Kiểm tra dữ liệu hợp lệ
if (!$sp_id || !$user_id || !$sao || !$noidung) {
    die("Dữ liệu không hợp lệ.");
}

// Cập nhật câu lệnh SQL với tên bảng và các trường phù hợp
$sql = "INSERT INTO danhgiasanpham (user_id, sp_id, sao, noidung, ngaydanhgia) 
        VALUES (?, ?, ?, ?, NOW())";

// Chuẩn bị và thực thi câu lệnh
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiis", $user_id, $sp_id, $sao, $noidung);

if ($stmt->execute()) {
    // Thêm thành công, chuyển hướng người dùng
     $_SESSION['message'] = 'Đánh giá thành công!';
    header("Location:orders.php");
    exit();
} else {
    echo "Lỗi khi thêm đánh giá: " . $stmt->error;
}
?>
