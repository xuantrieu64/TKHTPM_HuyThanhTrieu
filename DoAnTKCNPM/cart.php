<?php
require_once 'SanPham_Database.php';
session_start();

// Khởi tạo giỏ hàng nếu nó chưa tồn tại
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function getCartTotal()
{
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            // Kiểm tra xem các khóa 'gia' và 'inputQuantity' có tồn tại và không phải là null
            if (isset($item['gia']) && is_numeric($item['gia']) && isset($item['inputQuantity']) && is_numeric($item['inputQuantity'])) {
                $total += $item['gia'] * $item['inputQuantity'];
            }
        }
    }
    return $total;
}

// Xử lý yêu cầu xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $idToRemove = $_GET['id'];
    if (isset($_SESSION['cart'][$idToRemove])) {
        unset($_SESSION['cart'][$idToRemove]);
    }
    // Sau khi xóa, chuyển hướng người dùng trở lại trang giỏ hàng để cập nhật giao diện
    header('Location: cart.php');
    exit();
}

$sanpham_database = new SanPham_Database();
$sanphams = $sanpham_database->TatCaSanPham();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />

    <title>Giỏ hàng</title>
</head>

<body>
    <nav>
        <div class="container">
            <ul>
                <li><a href=""><img style="width: 50px; height: auto;" src="" alt="Logo"></a></li>
                <li id="adress-form"><a href="index.php">Home</a></li>
                <li><input type="text" placeholder="Bạn tìm gì..."><i class="fa-solid fa-magnifying-glass"></i></li>
                <li><a href="cart.php"><button><i class="fa-solid fa-cart-shopping"></i>Giỏ hàng</button></a></li>
                <li><a href="pay.html">Lịch sử<br>đơn hàng</a></li>
                <li><a href="">Category</a></li>
                <li><a href="">About us</a></li>
                <li><a href="">Contact us</a></li>
                <li><a href="">Login</a></li>
            </ul>
        </div>
    </nav>
    <section class="cart-section p-to-top">
        <div class="cart-back">
            <i class="fa-solid fa-arrow-left"></i>
            <p>Giỏ hàng của bạn</p>
        </div>
        <div class="container">
            <div class="row-flex row-flex-product-cart">
                <p class="heading-text">Giỏ hàng</p>
            </div>
            <?php
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $item) { ?>
                    <div class="cart-item" data-product-id="<?= $id ?>">
                        <div class="cart-list-item">
                            <div class="cart-list-item-product">
                                <div class="cart-image">
                                    <input style="position: absolute; top: 45%; left: 15px;" type="checkbox" id="checkbox" name="selected_products[]" value="<?= $id ?>">
                                    <img src="img/dienthoai1.jpg" alt="<?= isset($item['ten']) ? htmlspecialchars($item['ten']) : '' ?>">
                                </div>
                                <div class="format-product">
                                    <div class="info-product-on">
                                        <div class="product-name">
                                            <?= isset($item['ten']) ? htmlspecialchars($item['ten']) : '' ?>
                                        </div>
                                        <div class="action">
                                            <form action="?action=remove&id=<?= $id ?>" method="post" class="remove-item-form">
                                                <input type="hidden" name="action" value="remove">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <button type="submit" style="font-size: 20px; cursor: pointer;" class="remove-item-button">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="info-product-under">
                                        <div class="product-price">
                                            <span><?= (isset($item['gia']) && is_numeric($item['gia'])) ? number_format($item['gia']) : '0' ?></span>
                                        </div>
                                        <div class="product-quantity">
                                            <button type="button" class="btn-icon-quantity minus" onclick="loadDes(this)"><i
                                                    class="fa-solid fa-minus"></i></button>
                                            <input type="text" class="amount" name="amount" value="<?= isset($item['inputQuantity']) ? htmlspecialchars($item['inputQuantity']) : '1' ?>">
                                            <button type="button" class="btn-icon-quantity plus" onclick="loadIn(this)"><i
                                                    class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>
                <div class="cart-total-money">
                    <div class="cart-text">
                        <span class="cart-content">Tổng tiền: <p id="cart-total"><?= number_format(getCartTotal(), 0, '.', '.') ?></p><sup style="font-size: 15px;"> đ</sup></span>
                        <form action="pay.php" method="post">
                            <button type="submit" class="btn-pay">Mua ngay</button>
                        </form>
                    </div>
                </div>
            <?php
            } else { ?>
                <p>Giỏ hàng của bạn đang trống.</p>
            <?php
            }
            ?>
        </div>
    </section>
    <script>
        let loadIn = (button) => {
            let input = button.parentElement.querySelector('.amount');
            let amount = parseInt(input.value) || 1; // Đảm bảo giá trị là số hoặc 1
            amount++;
            input.value = amount;
            updateTotal();
        }

        let loadDes = (button) => {
            let input = button.parentElement.querySelector('.amount');
            let amount = parseInt(input.value) || 1; // Đảm bảo giá trị là số hoặc 1
            if (amount > 1) {
                amount--;
            }
            input.value = amount;
            updateTotal();
        }

        let updateTotal = () => {
            let total = 0;
            let cartItems = document.querySelectorAll('.cart-item');

            cartItems.forEach(item => {
                let priceElement = item.querySelector('.product-price span');
                let priceText = priceElement.textContent.replace(',', '');
                let price = parseFloat(priceText) || 0;
                let quantity = parseInt(item.querySelector('.amount').value) || 1;
                total += price * quantity;
            });

            // Cập nhật tổng tiền
            document.getElementById('cart-total').textContent = total.toLocaleString();
        }

        // Thêm sự kiện cho các input để tự động cập nhật khi người dùng nhập
        document.querySelectorAll('.amount').forEach(input => {
            input.addEventListener('input', () => {
                let amount = parseInt(input.value);
                if (isNaN(amount) || amount < 1) {
                    input.value = 1; // Đặt giá trị tối thiểu là 1
                }
                updateTotal(); // Cập nhật tổng nếu giá trị thay đổi
            });
        });
    </script>
</body>

</html>