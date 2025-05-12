<?php
require_once 'header_nav.php';
require_once 'SanPham_Database.php';
session_start();

// Khởi tạo kết nối Database
$database = new Database();
$product_database = new SanPham_Database();

// Lấy `id` từ URL
$product_id = isset($_GET['masp']) ? intval($_GET['masp']) : 0;

// Kiểm tra nếu không có sản phẩm
$product = $product_database->getProductById($product_id);
$reviews = $product_database->getDanhGiaByMaSP($product_id);
if (!$product) {
    die("<h1 class='text-center text-danger mt-5'>Sản phẩm không tìm thấy!</h1>");
}

// Lấy danh sách sản phẩm liên quan
$related_products = $product_database->getRelatedProducts($product['maloai'], $product_id);


$rating_data = $product_database->getAverageRating($product_id);
$average_rating = $rating_data['avg_rating'] ?? 0;
$total_reviews = $rating_data['total_reviews'] ?? 0;

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
                        <?php if ($total_reviews > 0): ?>
                            <h4 class="mb-3">
                                <span class="text-warning">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="ri-star-<?= $i <= $average_rating ? 'fill' : ($i - 0.5 <= $average_rating ? 'half-line' : 'line') ?>"></i>
                                    <?php endfor; ?>
                                </span>
                                (<?= $average_rating ?>/5 sao từ <?= $total_reviews ?> đánh giá)
                            </h4>
                        <?php endif; ?>

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


    <!-- Đánh giá sản phẩm -->
    <section class="container mt-5">
        <h3 class="fw-bold mb-4">Đánh giá sản phẩm</h3>
        <?php if (empty($reviews)): ?>
            <p class="text-muted">Chưa có đánh giá nào cho sản phẩm này.</p>
        <?php else: ?>
            <?php foreach ($reviews as $review): ?>
                <div class="mb-3 p-3 border rounded shadow-sm bg-light">
                    <div class="d-flex justify-content-between">
                        <strong><?= htmlspecialchars($review['username']) ?></strong>
                        <small class="text-muted"><?= date('d/m/Y', strtotime($review['ngaydanhgia'])) ?></small>
                    </div>
                    <div class="text-warning mb-1">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="ri-star-<?= $i <= $review['sao'] ? 'fill' : 'line' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="mb-0"><?= nl2br(htmlspecialchars($review['noidung'])) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
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