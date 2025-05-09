<?php
require_once 'SanPham_Database.php';
session_start();

// Khởi tạo kết nối Database
$database = new Database();
$product_database = new SanPham_Database();

// Lấy `id` từ URL
$product_id = isset($_GET['masp']) ? intval($_GET['masp']) : 0;

// Kiểm tra nếu không có sản phẩm
$product = $product_database->getProductById($product_id);
if (!$product) {
    die("<h1 class='text-center text-danger mt-5'>Sản phẩm không tìm thấy!</h1>");
}

// Lấy danh sách sản phẩm liên quan
$related_products = $product_database->getRelatedProducts($product['maloai'], $product_id);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($product['ten']) ?> - Chi tiết sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/header.css?v=<?= filemtime('css/header.css') ?>">
    
    <style>
        .product-img {
            object-fit: cover;
            height: 400px;
            border-radius: 10px;
        }

        .product-img:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        .related-img {
            height: 220px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Giới thiệu</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Danh mục</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Tất cả sản phẩm</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Bán chạy</a></li>
                            <li><a class="dropdown-item" href="#">Hàng mới</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i> Giỏ hàng
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav> -->
    <?php
    require_once 'header_nav.php';
    ?>
    <!-- Chi tiết sản phẩm -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <form action="add_cart.php" method="post">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img class="img-fluid product-img" src="<?= htmlspecialchars($product['anh']) ?>" alt="Ảnh sản phẩm">
                        <input type="hidden" name="anh" value="<?= htmlspecialchars($product['anh']) ?>">
                    </div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder"><?= htmlspecialchars($product['ten']) ?></h1>
                        <input type="hidden" name="ten" value="<?= htmlspecialchars($product['ten']) ?>">
                        <div class="fs-5 mb-3">
                            <span class="text-danger fw-bold"><?= number_format($product['gia'], 0, ',', '.') ?> VNĐ</span>
                            <input type="hidden" name="gia" value="<?= htmlspecialchars($product['gia']) ?>">
                        </div>
                        <p class="lead"><?= nl2br(htmlspecialchars($product['mota'])) ?></p>
                        <div class="d-flex">
                            <input type="hidden" name="ma" value="<?= htmlspecialchars($product['ma']) ?>">
                            <input class="form-control text-center me-3" id="inputQuantity" type="number" name="inputQuantity" value="1" min="1" style="max-width: 4rem;">
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                <i class="bi-cart-fill me-1"></i> Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Sản phẩm liên quan -->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4 text-center">Sản phẩm liên quan</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <?php foreach ($related_products as $related) { ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <img class="card-img-top related-img p-3" src="<?= htmlspecialchars($related['anh']) ?>" alt="<?= htmlspecialchars($related['ten']) ?>">
                            <div class="card-body text-center">
                                <h5 class="fw-bolder"><?= htmlspecialchars($related['ten']) ?></h5>
                                <p class="text-danger fw-bold"><?= number_format($related['gia'], 0, ',', '.') ?> VNĐ</p>
                            </div>
                            <div class="card-footer bg-white border-0 text-center">
                                <a href="item.php?masp=<?= htmlspecialchars($related['ma']) ?>" class="btn btn-dark btn-sm">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/header.js"></script>
</body>

</html>