<?php
require_once "SanPham_Database.php";
$product_Database = new SanPham_Database();

$productType = isset($_GET['productType']) ? $_GET['productType'] : null;

// Lấy dữ liệu số lượng sản phẩm hiện có
$thongkeData = $product_Database->getProductStock($productType);

$labels = [];
$values = [];

foreach ($thongkeData as $row) {
    $labels[] = $row['ten']; // Tên sản phẩm
    $values[] = $row['soluong']; // Số lượng hiện có
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thống kê số lượng sản phẩm hiện có</title>
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

    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Thống kê số lượng sản phẩm hiện có</h2>
        
        <canvas id="productChart"></canvas>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© 2025 Admin Panel. All rights reserved.</p>
    </footer>

    <!-- Chart Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('productChart').getContext('2d');
            var productChart = new Chart(ctx, {
                type: 'bar', // Biểu đồ cột
                data: {
                    labels: <?= json_encode($labels) ?>,
                    datasets: [{
                        label: 'Số lượng hiện có',
                        data: <?= json_encode($values) ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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