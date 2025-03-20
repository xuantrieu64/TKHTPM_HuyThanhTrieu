<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Add Product - Admin Panel</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Add New Product</h2>
        <form action="productProcess.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="name" class="form-label">Mã sản phẩm:</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <!-- Product Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
            <!-- Product Price -->
            <div class="mb-3">
                <label for="productPrice" class="form-label">Giá:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="soluong" class="form-label">Số lượng:</label>
                <input type="number" class="form-control" id="soluong" name="soluong" required>
            </div>
            <!-- Product Description -->
            <div class="mb-3">
                <label for="productDescription" class="form-label">Mô tả:</label>
                <textarea class="form-control" id="des" name="des" required></textarea>
            </div>
            
            <!-- Product Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh:</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3">
                <label for="createdDate" class="form-label">Ngayf tạo:</label>
                <input type="date" class="form-control" id="created_date" name="created_date" required>
            </div>
            <!-- Product Category -->
            <div class="mb-3">
                <label for="category" class="form-label">Mã loại:</label>
                <input type="text" class="form-control" id="category_id" name="category_id" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
