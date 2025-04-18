<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

require_once 'SanPham_Database.php';
$sanpham_database = new SanPham_Database();
$loaisanpham = $sanpham_database->TatCaLoaiSanPham();
// Kiểm tra nếu có từ khóa tìm kiếm
if (isset($_GET['maloai'])) {
    $maloai = $_GET['maloai'];
    $sanphams = $sanpham_database->SanPhamTheoLoai($maloai);
} else if (isset($_GET['keyword'])) {
    $sanphams = $sanpham_database->TimKiemSanPham($_GET['keyword']);
} else {
    $sanphams = $sanpham_database->TatCaSanPham();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>


    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand fw-bold" href="#!">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Loại sản phẩm
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php foreach ($loaisanpham as $loai): ?>
            <li>
                <a class="dropdown-item" href="index.php?maloai=<?= htmlspecialchars($loai['maloai']) ?>">
                    <?= htmlspecialchars($loai['tenloai']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</li>

            </ul>
            <form action="" method="GET" class="d-flex" role="search">
                        <input class="form-control me-2" type="text" id="keyword" name="keyword" placeholder="Tìm kiếm sản phẩm..."aria-label="search">
                        <button class="btn btn-primary me-2" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
                        </button>       
            </form>


            <div class="d-flex align-items-center ">
                <button class="btn btn-outline-dark me-3" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
                <a href="logout.php" class="btn btn-danger">Đăng xuất</a>
            </div>
        </div>
    </div>
</nav>

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <!-- dung de tao san pham quang cao -->
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
       
    
    <?php
if (empty($sanphams)) {
    echo '<div class="col-12 text-center"><h5 class="text-danger">Không tìm thấy sản phẩm phù hợp.</h5></div>';
} else {
    foreach($sanphams as $item) {
?>
        <div class="col mb-5">
            <div class="card h-100 shadow-sm border-0 rounded-4 transition" style="transition: all 0.3s ease-in-out;">
                <!-- Sale badge -->
                <?php if (!empty($item['giamgia'])) { ?>
                    <div class="badge bg-danger text-white position-absolute" style="top: 0.75rem; right: 0.75rem">
                        -<?= $item['giamgia'] ?>%
                    </div>
                <?php } ?>

                <!-- Product image -->
                <div class="position-relative overflow-hidden p-3">
                    <img class="card-img-top img-fluid rounded-3" src="<?= htmlspecialchars($item['anh']) ?>" alt="<?= htmlspecialchars($item['ten']) ?>" style="object-fit: cover; height: 250px;">
                </div>

                <!-- Product details -->
                <div class="card-body px-3 py-2 text-center d-flex flex-column">
                    <a href="item.php?masp=<?= htmlspecialchars($item['ma']) ?>" class="text-decoration-none text-dark mb-2">
                        <h5 class="fw-bold text-truncate" title="<?= htmlspecialchars($item['ten']) ?>">
                            <?= htmlspecialchars($item['ten']) ?>
                        </h5>
                    </a>

                    <!-- Rating -->
                    <div class="d-flex justify-content-center small text-warning mb-2">
                        <?php for ($i = 0; $i < 5; $i++) echo '<i class="bi bi-star-fill"></i>'; ?>
                    </div>

                    <!-- Product price -->
                    <p class="text-danger fw-bold mb-1">
                        <?= number_format($item['gia'], 0, ',', '.') ?> VNĐ
                    </p>

                    <!-- Product description -->
                    <?php $desc = substr($item['mota'], 0, 100); ?>
                        <p class="text-muted small mb-2">
                            <?= htmlspecialchars(substr($desc, 0, strrpos($desc, " "))) ?>...
                            <a href="item.php?masp=<?= htmlspecialchars($item['ma']) ?>" class="text-primary small">Xem thêm</a>
                        </p>
                </div>

                <!-- Product actions -->
                <div class="card-footer bg-transparent border-top-0 px-3 pb-3">
                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-dark w-100 btn-sm" href="#">🛒 Thêm vào giỏ</a>
                        <a class="btn btn-dark w-100 btn-sm" href="#">🛍️ Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
        <?php }} ?>
    </div>
</div>

</section>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Shop Bán Điện Thoại Uy Tín</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
