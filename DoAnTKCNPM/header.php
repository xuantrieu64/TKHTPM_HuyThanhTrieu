<?php
require_once 'Category_Database.php';
$category_database = new Category_Database();
$loaisanpham = $category_database->getAllLoai();

?>
<!-- Start Header -->
<header>
    <!-- Header: Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
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
                </ul>

                <!-- Form tìm kiếm -->
                <form class="d-flex me-3" method="get" action="index.php">
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
</header>
<!-- End Header -->

<!-- Start Slider -->
<div id="carouselExample" class="carousel slide m-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active"><img src="img/slider-iphone.jpg" class="d-block w-100" alt="iPhone"></div>
        <div class="carousel-item"><img src="img/slider-oppo.jpg" class="d-block w-100" alt="Oppo"></div>
        <div class="carousel-item"><img src="img/slider-poco.jpg" class="d-block w-100" alt="Poco"></div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>