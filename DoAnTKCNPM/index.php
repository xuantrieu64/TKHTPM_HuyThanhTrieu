<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>

<?php
require_once 'SanPham_Database.php';
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
                    <li class="nav-item"><a class="nav-link active" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <form action="cart.php">
                        <button class="btn btn-outline-dark me-3" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
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
                <?php foreach ($sanphams as $item) { ?>
                    <form action="add_cart.php?masp" method="post">
                        <div class="col mb-5">
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
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>