<?php
session_start();
require_once 'SanPham_Database.php';
$product_database = new SanPham_Database();

$products = $product_database->TatCaSanPham();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Item - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand fw-bold text-primary" href="#">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active fw-semibold" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <a class="btn btn-danger ms-3" href="logout.php">Đăng xuất</a>
            </div>
        </div>
    </nav>
    <!-- Product section-->
    <section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Quản lý <b>Sản phẩm</b></h2>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="btn btn-success" href="addproduct.php">
                                <i class="bi bi-plus-circle"></i> Thêm sản phẩm
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Mô tả</th>
                            <th style="width: 150px;">Ngày tạo</th>
                            <th>Ảnh</th>
                            <th>Mã Loại</th>
                            <th style="width: 150px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= htmlspecialchars($product['ma']) ?></td>
                                    <td><?= htmlspecialchars($product['ten']) ?></td>
                                    <td><?= htmlspecialchars($product['gia']) ?> VNĐ</td>
                                    <td><?= htmlspecialchars($product['mota']) ?></td>
                                    <td><?= htmlspecialchars($product['ngaytao']) ?></td>
                                    <td>
                                        <img style="width: 50px; height: 50px; object-fit: cover;" 
                                            src="<?= htmlspecialchars($product['anh']) ?>" alt="Ảnh sản phẩm" />
                                    </td>
                                    <td><?= htmlspecialchars($product['maloai']) ?></td>
                                    <td>
    <div class="mb-1">
        <a href="editproduct.php?id=<?= $product['ma'] ?>" class="btn btn-primary btn-sm w-100">
            <i class="bi bi-pencil"></i> Sửa
        </a>
    </div>
    <div>
        <a href="productProcess.php?action=delete&id=<?= $product['ma'] ?>"
            class="btn btn-danger btn-sm w-100"
            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
            <i class="bi bi-trash"></i> Xóa
        </a>
    </div>
</td>

                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Không có sản phẩm nào.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
  <div class="clearfix">
                        <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                        <ul class="pagination">
                            <li class="page-item"><a href="#" class="page-link">Previous</a></li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item active"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">4</a></li>
                            <li class="page-item"><a href="#" class="page-link">5</a></li>
                            <li class="page-item"><a href="#" class="page-link">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>



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