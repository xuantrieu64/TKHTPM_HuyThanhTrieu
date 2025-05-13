<?php
require_once "SanPham_Database.php";
$product_Database = new SanPham_Database();

// Lấy danh sách loại sản phẩm
$productTypes = $product_Database->getAllProductTypes();

// Lấy tham số lọc từ URL
$productType = $_GET['productType'] ?? null;
$startDate = $_GET['startDate'] ?? null;
$endDate = $_GET['endDate'] ?? null;

// Lấy dữ liệu thống kê
$salesData = $product_Database->getProductOders($productType, $startDate, $endDate);

$salesLabels = [];
$salesValues = [];
foreach ($salesData as $row) {
    $salesLabels[] = $row['ten'];
    $salesValues[] = $row['soluong'];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê sản phẩm đã bán</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap + ChartJS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
        }
        .card {
            border-radius: 1rem;
        }
        footer {
            margin-top: 80px;
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">🛠 Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="crud_product.php">Quản lý sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" href="crud_order.php">Quản lý đơn hàng</a></li>
                <li class="nav-item"><a class="nav-link active" href="thongke_sanpham.php">Thống kê</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Đăng xuất</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Nội dung chính -->
<div class="container py-5">
    <div class="row mb-4 justify-content-center">
        <div class="col-lg-8 text-center">
            <h2 class="fw-bold">📊 Thống kê sản phẩm đã bán</h2>
            <p class="text-muted">Lọc số liệu theo loại sản phẩm và thời gian để xem xu hướng bán hàng.</p>
        </div>
    </div>

    <!-- Form lọc -->
    <form method="GET" class="mb-4">
        <div class="row justify-content-center g-3">
            <div class="col-md-4">
                <label for="productType" class="form-label">Loại sản phẩm</label>
                <select name="productType" id="productType" class="form-select">
                    <option value="">-- Tất cả --</option>
                    <?php foreach ($productTypes as $type): ?>
                        <option value="<?= $type['maloai'] ?>" <?= ($productType == $type['maloai']) ? 'selected' : '' ?>>
                            <?= $type['tenloai'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">🔍 Lọc</button>
            </div>
        </div>
    </form>

    <!-- Biểu đồ -->
    <div class="card shadow p-4">
        <h5 class="card-title text-center mb-4">Biểu đồ số lượng sản phẩm đã bán</h5>
        <canvas id="salesChart" height="100"></canvas>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-3">
    <div class="container">
        <small>© 2025 Admin Panel. All rights reserved.</small>
    </div>
</footer>

<!-- Script Chart.js -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($salesLabels) ?>,
                datasets: [{
                    label: 'Số lượng đã bán',
                    data: <?= json_encode($salesValues) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
