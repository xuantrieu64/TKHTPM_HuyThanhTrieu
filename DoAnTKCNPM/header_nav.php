<?php
require_once 'Category_Database.php';
$category_database = new Category_Database();
$loaisanpham = $category_database->getAllLoai();

?>
<!-- Start Header -->
<!-- Header: Bootstrap Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top p-0">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php">📱 PhoneShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu trái -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Trang chủ</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="loaiDropdown" role="button" data-bs-toggle="dropdown">
                        Danh mục
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($loaisanpham as $loai): ?>
                            <li><a class="dropdown-item" href="index.php?maloai=<?= $loai['maloai'] ?>"><?= htmlspecialchars($loai['tenloai']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link active" href="orders.php">Đơn hàng</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact.php">Liên hệ</a></li>
            </ul>

            <!-- Form tìm kiếm -->
            <form class="d-flex me-3 my-2" method="get" action="index.php">
                <input class="form-control me-2" type="search" name="keyword" placeholder="Tìm sản phẩm..." aria-label="Search">
                <button class="btn btn-light" type="submit">Tìm</button>
            </form>

            <!-- Giỏ hàng và Tài khoản -->
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="cart.php">🛒 Giỏ hàng</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">👤 Đăng xuất</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- End Header -->