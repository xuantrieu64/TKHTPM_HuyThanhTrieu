<?php
session_start();
require_once 'SanPham_Database.php';
require_once 'header_nav.php';

// Xử lý form nhập thông tin giao hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['phone'], $_POST['adress'])) {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $adress = trim($_POST['adress']);

    // Kiểm tra dữ liệu không được để trống
    if ($name !== '' && $phone !== '' && $adress !== '') {
        $_SESSION['name'] = $name;
        $_SESSION['phone'] = $phone;
        $_SESSION['adress'] = $adress;

        // Chuyển hướng lại trang
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin giao hàng!');</script>";
    }
}

// Lấy dữ liệu đã lưu
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "Vui lòng nhập họ tên";
$phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : "Vui lòng nhập số điện thoại";
$adress = isset($_SESSION['adress']) ? $_SESSION['adress'] : "Vui lòng nhập địa chỉ";

// Khởi tạo mặc định
$products = [];
$voucher = null;
$total = 0;

// Xử lý dữ liệu từ checkout_data (POST qua JS hoặc AJAX)
if (isset($_POST['checkout_data'])) {
    $data = json_decode($_POST['checkout_data'], true);

    $products = $data['products'] ?? [];
    $voucher = $data['voucher'] ?? null;

    // Lưu voucher vào session nếu cần dùng sau
    $_SESSION['voucher'] = $voucher;

    // Tính tổng tiền đơn hàng
    foreach ($products as $product) {
        $price = isset($product['price']) ? (int)$product['price'] : 0;
        $quantity = isset($product['quantity']) ? (int)$product['quantity'] : 0;
        $total += $price * $quantity;
    }

    // Kiểm tra và áp dụng voucher nếu có
    if ($voucher && isset($voucher['discount'])) {
        $discountPercent = (int)$voucher['discount'];
        $total -= ($total * $discountPercent / 100);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/header.css?v=<?= filemtime('css/header.css') ?>">
    <link rel="stylesheet" href="css/pay.css?v=<?= filemtime('css/pay.css') ?>">
    <title>Document</title>
    <style>
       
    </style>
</head>

<body>
    <div class="pay-section" style="min-height: 100vh;">
        <div class="pay-section-container">
            <div class="row-grid">
                <div class="pay-section-left">
                    <h2>Thông tin sản phẩm</h2>
                    <?php foreach ($products as $product): ?>
                        <div class="pay-section-detail" style="padding: 20px;">
                            <div class="pay-section-detail-content">
                                <img src="<?= $product['image'] ?>" alt="" style="width: 100px;">
                                <div class="pay-information">
                                    <p style="margin: 0 0 20px 0; font-size: 15px;"><?= $product['name'] ?></p>
                                    <p style="margin: 20px 0 0 0; "><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</p>
                                </div>
                                <p>SL: <?= $product['quantity'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="pay-section-right">
                    <h2>Thông tin giao hàng</h2>
                    <!-- Hiển thị thông tin đã nhập -->
                    <div class="pay-infor-user">
                        <div class="pay-wrapper">
                            <div class="pay-infor-personal">
                                <p><i class="ri-map-pin-line" style="margin-right: 5px;"></i>trieu</p>
                                <p>123456789</p>
                            </div>
                            <div class="pay-infor-address">
                                <p>123 nguyen hue</p>
                            </div>
                        </div>
                        <div id="adress-form" class="pay-icon-right">
                            <i class="ri-arrow-drop-right-line"></i>
                        </div>
                    </div>
                    <!--Kết thúc hiển thị thông tin đã nhập -->

                    <!-- Nhập thông tin -->
                    <div class="adress-form" style="display: none;">
                        <div class="adress-form-content">
                            <h2>Chọn địa chỉ nhận hàng <span id="adress-close">X Đóng</span></h2>
                            <div class="form-list">
                                <p>
                                    Chọn đầy đủ địa chỉ nhận hàng để biết chính xác thời gian giao
                                </p>
                                <input class="address-input" type="text" id="name" name="name" placeholder="Nhập họ tên">
                                <input class="address-input" type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại">
                                <input class="address-input" type="text" id="adress" name="adress" placeholder="Nhập địa chỉ của bạn">
                                <button type="button" class="submit-address">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                    <!--Kết thúc nhập thông tin -->

                    <!-- Chọn voucher, phương thức thanh toán -->
                    <div class="pay-section-function">
                        <div class="pay-voucher" style="margin: 5px 0;">
                            <div class="pay-voucher-title">Voucher</div>
                            <div class="pay-deal">
                                <div class="pay-voucher-name">
                                    <?= isset($voucher['name']) ? $voucher['name'] : 'Không có voucher' ?>
                                </div>
                                <div style="font-size: 20px; display: none;" id="voucher-form" class="voucher-icon">
                                    <?= isset($voucher['phantram']) ? $voucher['phantram'] . '% Giảm' : '0% Giảm' ?>
                                </div>
                            </div>
                        </div>
                        <div class="pay-method" style="margin: 5px 0;">
                            <div class="pay-method-title">Phương thức thanh toán</div>
                            <div class="pay-method-money-wrapper">
                                <div class="pay-method-name" id="selected-method">Momo</div>
                                <div style="font-size: 20px;" id="method-pay-form" class="method-pay-icon">
                                    <i class="ri-arrow-drop-right-line"></i>
                                </div>
                            </div>
                            <div class="method-pay-form" style="display: none;">
                                <div class="pay-form-content">
                                    <h2>Chọn phương thức thanh toán <span id="pay-close">X Đóng</span></h2>
                                    <div class="payment-options" style="padding: 20px;">
                                        <div class="payment-option">
                                            <input type="radio" id="thanhtoankhinhanhang" name="method-pay">
                                            <label for="thanhtoankhinhanhang" class="payment-label">Thanh toán khi nhận hàng</label>
                                        </div>
                                        <div class="payment-option">
                                            <input type="radio" id="nganhang" name="method-pay">
                                            <label for="nganhang" class="payment-label">Ngân hàng</label>
                                        </div>
                                        <div class="payment-option">
                                            <input type="radio" id="momo" name="method-pay">
                                            <label for="momo" class="payment-label">Momo</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-pay">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                        <div class="pay-order">
                            <div class="pay-total-money">
                                Tổng cộng: <?= number_format($total, 0, ',', '.') ?> đồng
                            </div>

                            <button type="submit">Đặt hàng</button>
                        </div>
                    </div>
                    <!-- Kết thúc chọn voucher, phương thức thanh toán -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form nhap dia chi
        const adress = document.querySelector('#adress-form.pay-icon-right');
        const adressclose = document.querySelector('#adress-close');

        adress.addEventListener("click", function() {
            document.querySelector('.adress-form').style.display = "flex";
        });
        adressclose.addEventListener("click", function() {
            document.querySelector('.adress-form').style.display = "none";
        });


        // Lắng nghe sự kiện nhấn nút "Xác nhận"
        document.querySelector('button.submit-address').addEventListener('click', function() {
            // Lấy thông tin từ các trường nhập liệu
            const name = document.getElementById('name').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const address = document.getElementById('adress').value.trim();

            // Kiểm tra xem các trường có trống không
            if (name === '' || phone === '' || address === '') {
                alert('Vui lòng điền đầy đủ thông tin!');
                return;
            }

            // Cập nhật hiển thị thông tin vừa nhập vào phần thông tin người dùng
            document.querySelector('.pay-infor-personal').innerHTML = `
        <p><i class="ri-map-pin-line" style="margin-right: 5px;"></i>${name}</p>
        <p>${phone}</p>`;
            document.querySelector('.pay-infor-address').innerHTML = `<p>${address}</p>`;

            // Đóng form nhập địa chỉ sau khi nhấn xác nhận
            document.querySelector('.adress-form').style.display = 'none';

            // Tuỳ chọn: Gửi thông tin về server qua POST để lưu vào session
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `name=${encodeURIComponent(name)}&phone=${encodeURIComponent(phone)}&adress=${encodeURIComponent(address)}`
            });
        });

        const pay = document.querySelector('#method-pay-form.method-pay-icon');
        const payClose = document.querySelector('#pay-close');
        const confirmPaymentMethod = document.getElementById('confirm-payment-method');
        const selectedMethod = document.getElementById('selected-method');

        pay.addEventListener("click", function() {
            document.querySelector('.method-pay-form').style.display = "flex";
        });
        payClose.addEventListener("click", function() {
            document.querySelector('.method-pay-form').style.display = "none";
        });

        document.querySelector('.btn-pay').addEventListener('click', function() {
            // Lấy thông tin phương thức thanh toán đã chọn
            const selectedMethod = document.querySelector('input[name="method-pay"]:checked');

            if (selectedMethod) {
                const methodName = selectedMethod.nextElementSibling.textContent.trim();
                // Cập nhật hiển thị phương thức thanh toán đã chọn
                document.querySelector('.pay-method-name').textContent = methodName;

                // Đóng form phương thức thanh toán sau khi nhấn xác nhận
                document.querySelector('.method-pay-form').style.display = 'none';
            } else {
                alert('Vui lòng chọn phương thức thanh toán!');
            }
        });
    </script>
    <script src="js/header.js"></script>

</body>

</html>