<?php
include_once "SanPham_Database.php";
$product_Database = new SanPham_Database();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $products = $product_Database->getProductByID($id);
} else {
    header('Location: crud.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Edit Product - Admin Panel</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            border-radius: 10px 10px 0 0;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            width: 100%;
            border-radius: 5px;
        }
        img {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Edit Product</div>
            <div class="card-body">
                <form action="productProcess.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit">
                    <div class="mb-3">
                        <label class="form-label">Mã sản phẩm:</label>
                        <input type="text" class="form-control" name="id" value="<?= htmlspecialchars($products['ma']) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm:</label>
                        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($products['ten']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá:</label>
                        <input type="number" class="form-control" name="price" value="<?= htmlspecialchars($products['gia']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số lượng:</label>
                        <input type="number" class="form-control" name="price" value="<?= htmlspecialchars($products['soluong']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả:</label>
                        <textarea class="form-control" name="des" required><?= htmlspecialchars($products['mota']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh:</label>
                        <input type="file" class="form-control" name="image">
                        <?php if (!empty($products['anh'])): ?>
                            <div class="mt-2 text-center">
                                <img src="<?= htmlspecialchars($products['anh']) ?>" alt="Current Image" style="max-width: 30%; height: auto;">
                            </div>
                        <?php endif; ?>
                        <input type="hidden" name="current_image" value="<?= htmlspecialchars($products['anh']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mã loại:</label>
                        <input type="text" class="form-control" name="category_id" value="<?= htmlspecialchars($products['maloai']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày tạo: </label>
                        <input type="date" class="form-control" name="created_date" value="<?= htmlspecialchars($products['ngaytao']) ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>