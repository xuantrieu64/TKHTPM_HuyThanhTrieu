<?php
session_start();
require_once 'header.php';
require_once 'SanPham_Database.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$sanpham_database = new SanPham_Database();
$sanphams = $sanpham_database->TatCaSanPham();

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
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($sanphams as $item) { ?>
                    <form action="add_cart.php?masp" method="post">
                        <div class="list col mb-5">
                            <div class="card h-100 shadow-sm border-0">
                                <!-- Sale badge -->
                                <?php if (!empty($item['giamgia'])) { ?>
                                    <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                        -<?= $item['giamgia'] ?>%
                                    </div>
                                <?php } ?>
                                <input type="hidden" id="ma" name="ma" value="<?= $item['ma'] ?>">
                                <input type="hidden" id="ten" name="ten" value="<?= $item['ten'] ?>">
                                <input type="hidden" id="gia" name="gia" value="<?= $item['gia'] ?>">
                                <input type="hidden" id="anh" name="anh" value="<?= $item['anh'] ?>">
                                <!-- Product image -->
                                <div class="position-relative overflow-hidden">
                                    <img class="card-img-top img-fluid" src="<?= htmlspecialchars($item['anh']) ?>" alt="<?= htmlspecialchars($item['ten']) ?>" style="object-fit: cover; height: 250px;">
                                </div>

                                <!-- Product details -->
                                <div class="card-body p-3 text-center">
                                    <a href="item.php?masp=<?= htmlspecialchars($item['ma']) ?>" class="text-decoration-none text-dark">
                                        <h5 class="fw-bolder"><?= htmlspecialchars($item['ten']) ?></h5>
                                    </a>

                                    <!-- Rating -->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
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
                                <div class="card-footer p-3 bg-transparent border-top-0">
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-outline-dark flex-grow-1 me-2">🛒 Thêm vào giỏ</button>
                                        <a class="btn btn-dark flex-grow-1" href="#">🛍️ Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
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