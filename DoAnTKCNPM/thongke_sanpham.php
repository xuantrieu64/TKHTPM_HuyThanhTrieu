<?php
require_once "SanPham_Database.php";
$product_Database = new SanPham_Database();

// Lấy dữ liệu số lượng sản phẩm đã bán
$productType = isset($_GET['productType']) ? $_GET['productType'] : null;
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;

$salesData = $product_Database->getProductOders($productType, $startDate, $endDate);

$salesLabels = [];
$salesValues = [];

foreach ($salesData as $row) {
    $salesLabels[] = $row['ten']; // Tên sản phẩm
    $salesValues[] = $row['soluong']; // Số lượng đã bán
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thống kê số lượng sản phẩm đã bán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="crud_product.php">Quản lý sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link active" href="thongke.php">Thống kê</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Thống kê số lượng sản phẩm đã bán</h2>

        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="productType" class="form-label">Mã loại sản phẩm</label>
                    <input type="number" name="productType" id="productType" class="form-control" placeholder="Nhập mã loại">
                </div>
                <div class="col-md-4">
                    <label for="startDate" class="form-label">Ngày bắt đầu</label>
                    <input type="date" name="startDate" id="startDate" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="endDate" class="form-label">Ngày kết thúc</label>
                    <input type="date" name="endDate" id="endDate" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Lọc dữ liệu</button>
        </form>

        <canvas id="salesChart"></canvas>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© 2025 Admin Panel. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('salesChart').getContext('2d');
            var salesChart = new Chart(ctx, {
                type: 'bar', 
                data: {
                    labels: <?= json_encode($salesLabels) ?>,
                    datasets: [{
                        label: 'Số lượng đã bán',
                        data: <?= json_encode($salesValues) ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>