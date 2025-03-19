<?php
session_start();
require_once 'Database.php'; // Import class Database

// Lấy kết nối
$conn = new Database();
$conn = $conn::$connection;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); // Không hash mật khẩu
    $role = 'user'; // Mặc định user mới là "user"

    if (!$conn) {
        die("Lỗi kết nối database!");
    }

    // Kiểm tra xem username hoặc email đã tồn tại chưa
    $check_sql = "SELECT id FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Tên đăng nhập hoặc email đã tồn tại!";
        header("Location: login.php");
        exit();
    }

    // Thêm user mới vào database
    $sql = "INSERT INTO users (username, password_hash, email, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Lỗi prepare statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $username, $password, $email, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Đăng ký thành công! Bạn có thể đăng nhập.";
    } else {
        $_SESSION['error'] = "Đăng ký thất bại!";
    }

    header("Location: login.php");
    exit();
}
?>
