<?php
require_once "SanPham_Database.php";
$product_Database = new SanPham_Database();

/**
 * Kiểm tra tính hợp lệ của dữ liệu đầu vào
 */
function validateInput($name, $price, $category_id, $created_date) {
    if (empty($name)) return "Tên sản phẩm không được để trống.";
    if (!is_numeric($price) || $price < 0) return "Giá sản phẩm không hợp lệ.";
    if (!filter_var($category_id, FILTER_VALIDATE_INT)) return "Mã danh mục không hợp lệ.";
    if (!empty($created_date) && strtotime($created_date) === false) return "Ngày tạo không hợp lệ.";
    return null;
}

/**
 * Xử lý tải ảnh lên (trả về đường dẫn ảnh hoặc lỗi)
 */
function uploadImage($imageFile, $currentImage) {
    if (isset($imageFile) && $imageFile['error'] === 0) {
        $target_dir = "img/";
        $imageFileType = strtolower(pathinfo($imageFile["name"], PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($imageFileType, $allowed_types)) {
            return "Chỉ chấp nhận các định dạng ảnh JPG, JPEG, PNG, GIF.";
        }

        if ($imageFile['size'] > 5 * 1024 * 1024) { // Giới hạn 5MB
            return "Ảnh không được vượt quá 5MB.";
        }

        $newFileName = $target_dir . uniqid() . "." . $imageFileType;

        if (move_uploaded_file($imageFile["tmp_name"], $newFileName)) {
            // Xóa ảnh cũ nếu có và là ảnh đã tải lên trước đó
            if (!empty($currentImage) && strpos($currentImage, 'img/') !== false && file_exists($currentImage)) {
                unlink($currentImage);
            }
            return $newFileName; // Trả về đường dẫn ảnh mới
        } else {
            return "Lỗi khi tải ảnh lên.";
        }
    }
    return $currentImage; // Giữ nguyên ảnh cũ nếu không có ảnh mới được tải lên thành công
}

// 👉 **Xóa sản phẩm**
if (isset($_GET['action']) && $_GET['action'] === "delete" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = $product_Database->getProductById($id);
    if ($product && !empty($product['image']) && strpos($product['image'], 'img/') !== false && file_exists($product['image'])) {
        unlink($product['image']);
    }
    $product_Database->deleteProduct($id);
    header('Location: crud_product.php');
    exit;
}

// 👉 **Thêm hoặc sửa sản phẩm**
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = $_POST['id'] ?? "";
    $name = $_POST['name'] ?? "";
    $des = $_POST['des'] ?? "";
    $category_id = $_POST['category_id'] ?? "";
    $price = $_POST['price'] ?? "";
    $created_date = $_POST['created_date'] ?? "";
    $current_image = $_POST['current_image'] ?? "";
    $soluong = $_POST['soluong'] ?? "";

    // Kiểm tra đầu vào
    $error = validateInput($name, $price, $category_id, $created_date);
    if ($error) {
        echo "<script>alert('$error'); window.history.back();</script>";
        exit;
    }

    $image_to_update = $current_image; // Mặc định giữ nguyên ảnh cũ

    // Kiểm tra xem có tệp ảnh mới được tải lên hay không
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        // Nếu có ảnh mới, hãy tải lên và lấy đường dẫn mới
        $image_result = uploadImage($_FILES['image'], $current_image);
        if (strpos($image_result, "Lỗi") !== false || strpos($image_result, "Chỉ chấp nhận") !== false) {
            echo "<script>alert('$image_result'); window.history.back();</script>";
            exit;
        }
        $image_to_update = $image_result;
    }

    if ($action === "add") {
        $product_Database->addProduct($id, $name, $price, $soluong, $des, $image_to_update, $category_id, $created_date);
    } elseif ($action === "edit") {
        $product_Database->editProduct($id, $name, $price, $soluong, $des, $image_to_update, $category_id, $created_date);
    }

    header('Location: crud_product.php');
    exit;
}
?>