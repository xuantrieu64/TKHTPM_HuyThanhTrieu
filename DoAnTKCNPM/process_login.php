<?php
session_start();
require_once 'Database.php'; // Import class Database

// Tạo kết nối database
$conn = new Database();
$conn = $conn::$connection; // Lấy kết nối từ thuộc tính static

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); // Lấy mật khẩu từ form (không hash)

    if (!$conn) {
        die("Lỗi kết nối database!");
    }

    // Truy vấn kiểm tra user
    $sql = "SELECT id, username, password_hash, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Lỗi prepare statement: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Kiểm tra mật khẩu trực tiếp (Vì không hash)
        if ($password === $user['password_hash']) { 
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Chuyển hướng theo quyền
            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Mật khẩu không đúng!";
        }
    } else {
        $_SESSION['error'] = "Tên đăng nhập không tồn tại!";
    }

    header("Location: login.php");
    exit();
}
?>
