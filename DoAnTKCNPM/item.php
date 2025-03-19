<?php
require_once 'sanpham_database.php';

// Khởi tạo kết nối Database
$database = new Database();
$product_database = new SanPham_Database();

// Lấy `id` từ URL
$product_id = isset($_GET['masp']) ? intval($_GET['masp']) : 0;

// Kiểm tra nếu không có sản phẩm
$product = $product_database->getProductById($product_id);
if (!$product) {
    die("<h1>Sản phẩm không tìm thấy!</h1>");
}

// Lấy danh sách sản phẩm liên quan
$related_products = $product_database->getRelatedProducts($product['maloai'], $product_id);

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($product['ten']) ?> - Chi tiết sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
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
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

    <!-- Chi tiết sản phẩm -->
    <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"> <img class="card-img-top" src="img/<?= htmlspecialchars(string: $product['anh']) ?>"
                            alt="Image" />
                    </div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h1 class="display-5 fw-bolder"><?= htmlspecialchars($product['ten']) ?></h1>
                        <div class="fs-5 mb-5">
                            <span><?= htmlspecialchars($product['gia']) ?>$</span>
                        </div>
                        <p class="lead"><?= htmlspecialchars($product['mota']) ?></p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1"
                                style="max-width: 3rem" />
                            <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- Sản phẩm liên quan -->
    <section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4 text-center">Sản phẩm liên quan</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($related_products as $related) { ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img class="card-img-top p-3" src="img/<?= htmlspecialchars($related['anh']) ?>" alt="<?= htmlspecialchars($related['ten']) ?>" />
                        <div class="card-body text-center">
                            <h5 class="fw-bolder"><?= htmlspecialchars($related['ten']) ?></h5>
                            <span class="text-muted">$<?= number_format($related['gia'], 2) ?></span>
                        </div>
                        <div class="card-footer bg-white border-0 text-center">
                           
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

</body>

</html>
