<?php
session_start();
require_once 'header.php';
require_once 'SanPham_Database.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$sanpham_database = new SanPham_Database();
if (isset($_GET['maloai'])) {
    $sanphams = $sanpham_database->SanPhamTheoLoai($_GET['maloai']);
} elseif (isset($_GET['keyword'])) {
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
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- FontAwesome Icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Remix Icon -->
    <link href="https://unpkg.com/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Style Header  -->
    <link rel="stylesheet" href="css/header.css?v=<?= filemtime('css/header.css') ?>">
    <!-- Style Footer  -->
    <link rel="stylesheet" href="css/footer.css?v=<?= filemtime('css/footer.css') ?>">

</head>

<body>
    <!-- Section-->
    <section class="py-5 d-flex justify-content-center">
        <div class="container mt-5">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                <?php if (empty($sanphams)): ?>
                    <div class="col-12 text-center">
                        <p class="text-danger fw-bold">Không tìm thấy sản phẩm nào.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($sanphams as $item): ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm position-relative">
                                <?php if (!empty($item['giamgia'])): ?>
                                    <div class="badge bg-danger text-white position-absolute" style="top: 10px; right: 10px">
                                        -<?= $item['giamgia'] ?>%
                                    </div>
                                <?php endif; ?>

                                <!-- Ảnh sản phẩm -->
                                <img src="<?= htmlspecialchars($item['anh']) ?>" class="card-img-top mt-1" style="height: 220px; object-fit: contain;" alt="Ảnh sản phẩm">

                                <!-- Nội dung sản phẩm -->
                                <div class="card-body text-center position-relative">
                                    <h5 class="card-title mb-1"><?= htmlspecialchars($item['ten']) ?></h5>
                                    <p class="card-text text-danger fw-bold mb-1">
                                        <?= number_format($item['gia'], 0, ',', '.') ?> VNĐ
                                    </p>
                                    <p class="card-text text-muted small mb-2">
                                        <?= htmlspecialchars(mb_substr($item['mota'], 0, 60)) ?>...
                                    </p>

                                    <!-- Vùng click dẫn đến trang chi tiết -->
                                    <a href="item.php?masp=<?= $item['ma'] ?>" class="stretched-link"></a>
                                </div>

                                <!-- Footer: nút mua và giỏ hàng -->
                                <div class="card-footer bg-white border-top-0 z-1 px-3 pb-3">
                                    <div class="d-flex gap-2">
                                        <!-- Nút Thêm vào giỏ -->
                                        <form action="add_cart.php" method="post" class="flex-grow-1" onsubmit="event.stopPropagation();">
                                            <input type="hidden" name="ma" value="<?= $item['ma'] ?>">
                                            <input type="hidden" name="ten" value="<?= $item['ten'] ?>">
                                            <input type="hidden" name="gia" value="<?= $item['gia'] ?>">
                                            <input type="hidden" name="anh" value="<?= $item['anh'] ?>">
                                            <button class="btn btn-outline-primary w-100 btn-sm" type="submit">🛒 Thêm</button>
                                        </form>

                                        <!-- Nút Mua Ngay -->
                                        <form action="add_cart.php" method="post" class="flex-grow-1" onsubmit="event.stopPropagation();">
                                            <input type="hidden" name="ma" value="<?= $item['ma'] ?>">
                                            <input type="hidden" name="ten" value="<?= $item['ten'] ?>">
                                            <input type="hidden" name="gia" value="<?= $item['gia'] ?>">
                                            <input type="hidden" name="anh" value="<?= $item['anh'] ?>">
                                            <button class="btn btn-outline-primary w-100 btn-sm" type="submit">🛍️ Mua ngay</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <?php
    require_once 'footer.php';
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- Link JS Header -->
    <script src="js/header.js"></script>
</body>

</html>