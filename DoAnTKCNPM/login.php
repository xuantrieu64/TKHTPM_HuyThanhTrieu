<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập & Đăng ký</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card p-4 shadow" style="width: 400px;">
        <h3 class="text-center">Chào mừng bạn!</h3>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <!-- Tabs để chuyển đổi giữa Đăng nhập và Đăng ký -->
        <ul class="nav nav-tabs" id="authTabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#loginTab">Đăng nhập</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#registerTab">Đăng ký</a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <!-- Form Đăng nhập -->
            <div id="loginTab" class="tab-pane fade show active">
                <form action="process_login.php" method="POST">
                    <div class="mb-3">
                        <label>Tên đăng nhập:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Mật khẩu:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                </form>
            </div>

            <!-- Form Đăng ký -->
            <div id="registerTab" class="tab-pane fade">
                <form action="process_register.php" method="POST">
                    <div class="mb-3">
                        <label>Tên đăng nhập:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Mật khẩu:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
