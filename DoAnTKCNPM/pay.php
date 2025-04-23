<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Luu thong tin giao hang
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];

    $_SESSION['name'] = $name;
    $_SESSION['phone'] = $phone;
    $_SESSION['adress'] = $adress;

    //Luu thong tin voucher
    //Luu thong tin phuong thuc thanh toan
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit();
}


$name = isset($_SESSION['name']) ? $_SESSION['name'] : "Vui long nhap ho ten";
$phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : "Vui long nhap sdt";
$adress = isset($_SESSION['adress']) ? $_SESSION['adress'] : "Vui long nhap dia chi";

// Kiểm tra xem form đã được submit hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem có dữ liệu được gửi từ input radio có name là 'method-pay' hay không
    if (isset($_POST["method-pay"])) {
        // Lưu phương thức thanh toán đã chọn vào session
        $_SESSION["payment_method"] = $_POST["method-pay"];
        // Chuyển hướng để cập nhật hiển thị
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }
}

// Lấy phương thức thanh toán đã chọn từ session (nếu có)
$phuong_thuc_da_chon = isset($_SESSION["payment_method"]) ? $_SESSION["payment_method"] : "Tiền mặt"; // Mặc định là Tiền mặt

// Xác định tên phương thức thanh toán để hiển thị
$ten_phuong_thuc_hien_thi = "";
switch ($phuong_thuc_da_chon) {
    case "tienmat":
        $ten_phuong_thuc_hien_thi = "Tiền mặt";
        break;
    case "nganhang":
        $ten_phuong_thuc_hien_thi = "Ngân hàng";
        break;
    case "momo":
        $ten_phuong_thuc_hien_thi = "Momo";
        break;
    default:
        $ten_phuong_thuc_hien_thi = "Chua chon"; // Mặc định nếu không có hoặc giá trị không hợp lệ
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pay.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <title>Document</title>
    <style>
        :root {
            --header-height: 70px;
            --main-bg: #f0efef;
            --main-transition: all 0.3s ease;
            --main-color: #fff;
            --main-font-weight: 500;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        ul {
            list-style: none;
            padding: 12px;
        }

        a {
            text-decoration: none;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        nav ul {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
        }

        nav ul li,
        a {
            color: #fff;
            font-size: 15px;
        }

        nav ul li:nth-child(2) a {
            color: yellow;
        }

        nav ul li:nth-child(2) i {
            color: yellow;
            font-size: 15px;
            margin-left: 6px;
        }

        nav ul li:nth-child(3) {
            position: relative;
        }

        nav ul li:nth-child(3) input {
            width: 100%;
            height: 30px;
            border-radius: 5px;
            border: none;
            padding-left: 6px;
            outline: none;
        }

        nav ul li:nth-child(3) i {
            position: absolute;
            font-size: 20px;
            right: 12px;
            color: black;
            line-height: 30px;
            cursor: pointer;
        }

        nav ul li:nth-child(4) button {
            height: 30px;
            padding: 0 12px;
            border-radius: 5px;
            cursor: pointer;
            background-color: transparent;
            color: #fff;
            border: 1px solid #fff;
            transition: all 0.3s ease;
        }

        nav ul li:nth-child(4) button i {
            margin-right: 6px;
        }

        nav ul li:nth-child(4) button:hover {
            background-color: #575555;
        }

        nav ul li:nth-child(5) {
            text-align: center;
        }

        nav ul li:nth-child(5):hover a {
            color: yellow;
        }

        nav ul li:nth-child(6) a {
            text-align: start;
            color: yellow;
        }

        nav ul li:nth-child(7):hover a {
            color: yellow;
        }

        nav ul li:nth-child(8):hover a {
            color: yellow;
        }

        .main-btn:hover {
            background-color: orange;
            color: black;
        }

        .product-item-price {
            margin-top: 6px;
        }

        .product-item-price p {
            font-weight: var(--main-font-weight);
        }

        .product-item-price p span {
            font-weight: 300;
            font-size: small;
            text-decoration: line-through;
        }

        .main-h2 {
            font-weight: var(--main-font-weight);
            margin: 12px 0;
            font-size: 20px;
        }

        header {
            height: var(--header-height);
            border-bottom: 1px solid #d5d2d2;
            position: fixed;
            z-index: 1;
            width: 100%;
            background-color: rgba(255, 0, 0, .9) !important;
        }

        header .row-flex {
            align-items: center;
        }

        .header-logo img {
            width: 70px;
            cursor: pointer;
        }

        .header-nav nav ul {
            display: flex;
        }

        .header-nav nav ul li {
            padding: 0 10px;
            /*tren duoi 0, trai phai 10px*/
            transition: var(--main-transition);
            cursor: pointer;

        }

        .header-nav nav ul li a {
            line-height: var(--header-height);
            font-size: smaller;
        }

        .header-nav nav ul li:hover {
            background-color: var(--main-bg);
        }

        .header-search {
            position: relative;
        }

        .header-search i {
            position: absolute;
            top: 50%;
            left: 6px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .header-search input {
            height: 30px;
            border: 1px solid black;
            padding-left: 20px;
            border-radius: 5px;
        }

        /* Slider */

        .slider {
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 140px;
        }

        .slide-show {
            width: 800px;
            overflow: hidden;
        }

        .list-image {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .list-image img {
            width: 800px;
            height: 400px;
        }

        /*End Slider */
    </style>
</head>

<body>
    <!-- Start Header -->
    <header>
        <div class="nav-wrapper">
            <nav>
                <div class="container">
                    <ul>
                        <li><a href="">Moblie Shop</a></li>
                        <li id="adress-form"><a href="index.php">Home</a></li>
                        <li><input type="text" placeholder="Bạn tìm gì..."><i class="fa-solid fa-magnifying-glass"></i>
                        </li>
                        <li><a href="cart.php"><button><i class="fa-solid fa-cart-shopping"></i>Giỏ hàng</button></a>
                        </li>
                        <li><a href="#">Lịch sử<br>đơn hàng</a></li>
                        <li><a href="">Danh mục<i class="ri-arrow-down-s-fill"></i></a></li>
                        <li><a href="contact.php">Liên hệ</a></li>
                        <li><a href="login.php">Đăng xuất</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- End Header -->

    <div class="pay-section">
        <div class="pay-section-container">
            <div class="row-grid">
                <div class="pay-section-left">
                    <h2>Thông tin sản phẩm</h2>
                    <div class="pay-section-detail">
                        <div class="pay-section-detail-content">
                            <img src="image/smartphone.png" alt="" style="width: 50px;">
                            <div class="pay-information">
                                <p>Iphone</p>
                                <p>12.000.000 D</p>
                            </div>
                            <p>Số lượng: 2</p>
                        </div>
                    </div>
                    <div class="pay-section-detail">
                        <div class="pay-section-detail-content">
                            <img src="image/smartphone.png" alt="" style="width: 50px;">
                            <div class="pay-information">
                                <p>Iphone</p>
                                <p>12.000.000 D</p>
                            </div>
                            <p>Số lượng: 2</p>
                        </div>
                    </div>
                    <div class="pay-section-detail">
                        <div class="pay-section-detail-content">
                            <img src="image/smartphone.png" alt="" style="width: 50px;">
                            <div class="pay-information">
                                <p>Iphone</p>
                                <p>12.000.000 D</p>
                            </div>
                            <p>Số lượng: 2</p>
                        </div>
                    </div>
                    <div class="pay-section-detail">
                        <div class="pay-section-detail-content">
                            <img src="image/smartphone.png" alt="" style="width: 50px;">
                            <div class="pay-information">
                                <p>Iphone</p>
                                <p>12.000.000 D</p>
                            </div>
                            <p>Số lượng: 2</p>
                        </div>
                    </div>
                    <div class="pay-section-detail">
                        <div class="pay-section-detail-content">
                            <img src="image/smartphone.png" alt="" style="width: 50px;">
                            <div class="pay-information">
                                <p>Iphone</p>
                                <p>12.000.000 D</p>
                            </div>
                            <p>Số lượng: 2</p>
                        </div>
                    </div>
                </div>
                <div class="pay-section-right">
                    <h2>Thông tin giao hàng</h2>

                    <!-- Hiển thị thông tin đã nhập -->
                    <div class="pay-infor-user">
                        <div class="pay-wrapper">
                            <div class="pay-infor-personal">
                                <p><i class="ri-map-pin-line" style="margin-right: 5px;"></i><?= $name ?></p>
                                <p><?= $phone ?></p>
                            </div>
                            <div class="pay-infor-address">
                                <p><?= $adress ?></p>
                            </div>
                        </div>
                        <div id="adress-form" class="pay-icon-right">
                            <i class="ri-arrow-drop-right-line"></i>
                        </div>
                    </div>
                    <!--Kết thúc hiển thị thông tin đã nhập -->

                    <!-- Nhập thông tin -->
                    <div class="adress-form">
                        <div class="adress-form-content">
                            <h2>Chọn địa chỉ nhận hàng <span id="adress-close">X Đóng</span></h2>
                            <form action="#" method="POST">
                                <p>
                                    Chọn đầy đủ địa chỉ nhận hàng để biết chính xác thời gian giao
                                </p>
                                <input type="text" id="name" name="name" placeholder="Nhập họ tên">
                                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại">
                                <input type="text" id="adress" name="adress" placeholder="Nhập địa chỉ của bạn">
                                <button type="submit">Xác nhận</button>
                            </form>
                        </div>
                    </div>
                    <!--Kết thúc nhập thông tin -->

                    <!-- Chọn voucher, phương thức thanh toán -->
                    <div class="pay-section-function">
                        <div class="pay-voucher">
                            <div class="pay-voucher-title">Voucher</div>
                            <div class="pay-deal">
                                <div class="pay-voucher-name">Giảm 10%</div>
                                <div style="font-size: 20px;" id="voucher-form" class="voucher-icon">
                                    <i class="ri-arrow-drop-right-line"></i>
                                </div>
                            </div>

                            <!-- Chọn mã giảm giá trên form -->
                            <div class="voucher-form">
                                <div class="voucher-form-content">
                                    <h2>Chọn voucher <span id="voucher-close">X Đóng</span></h2>
                                    <form action="#">
                                        <div class="voucher-list-container">
                                            <div class="voucher-item">
                                                <div class="voucher-infor">
                                                    <div class="voucher-infor-setting">
                                                        <div class="voucher-border">
                                                            <img src="img/voucher.png" alt="">
                                                        </div>
                                                        <div class="confident">
                                                            <p style="margin-right: 50px;">Giảm 10%</p>
                                                            <p>HSD: 25.04.2025</p>
                                                        </div>
                                                    </div>
                                                    <input type="radio" name="selected_voucher">
                                                </div>
                                            </div>

                                            <div class="voucher-item">
                                                <div class="voucher-infor">
                                                    <div class="voucher-infor-setting">
                                                        <div class="voucher-border">
                                                            <img src="img/voucher.png" alt="">
                                                        </div>
                                                        <div class="confident">
                                                            <p style="margin-right: 50px;">Giam 10%</p>
                                                            <p>HSD: 25.04.2025</p>
                                                        </div>
                                                    </div>
                                                    <input type="radio" name="selected_voucher">
                                                </div>
                                            </div>
                                            <div class="voucher-item">
                                                <div class="voucher-infor">
                                                    <div class="voucher-infor-setting">
                                                        <div class="voucher-border">
                                                            <img src="img/voucher.png" alt="">
                                                        </div>
                                                        <div class="confident">
                                                            <p style="margin-right: 50px;">Giam 10%</p>
                                                            <p>HSD: 25.04.2025</p>
                                                        </div>
                                                    </div>
                                                    <input type="radio" name="selected_voucher">
                                                </div>
                                            </div>

                                            <div class="voucher-item">
                                                <div class="voucher-infor">
                                                    <div class="voucher-infor-setting">
                                                        <div class="voucher-border">
                                                            <img src="img/voucher.png" alt="">
                                                        </div>
                                                        <div class="confident">
                                                            <p style="margin-right: 50px;">Giam 10%</p>
                                                            <p>HSD: 25.04.2025</p>
                                                        </div>
                                                    </div>
                                                    <input type="radio" name="selected_voucher">
                                                </div>
                                            </div>
                                            <div class="voucher-item">
                                                <div class="voucher-infor">
                                                    <div class="voucher-infor-setting">
                                                        <div class="voucher-border">
                                                            <img src="voucher.png" alt="">
                                                        </div>
                                                        <div class="confident">
                                                            <p style="margin-right: 50px;">Giam 10%</p>
                                                            <p>HSD: 25.04.2025</p>
                                                        </div>
                                                    </div>
                                                    <input type="radio" name="selected_voucher">
                                                </div>
                                            </div>
                                            <div class="voucher-item">
                                                <div class="voucher-infor">
                                                    <div class="voucher-infor-setting">
                                                        <div class="voucher-border">
                                                            <img src="img/voucher.png" alt="">
                                                        </div>
                                                        <div class="confident">
                                                            <p style="margin-right: 50px;">Giam 10%</p>
                                                            <p>HSD: 25.04.2025</p>
                                                        </div>
                                                    </div>
                                                    <input type="radio" name="selected_voucher">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn-submit" type="submit">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Hết chọn mã giảm giá trên form -->
                        </div>
                        <div class="pay-method">
                            <div class="pay-method-title">Phương thức thanh toán</div>
                            <div class="pay-method-money-wrapper">
                                <div class="pay-method-name"><?= $ten_phuong_thuc_hien_thi ?></div>
                                <div id="method-pay-form" class="method-pay-icon">
                                    <i style="font-size: 20px;" class="ri-arrow-drop-right-line"></i>
                                </div>
                            </div>
                            <div class="method-pay-form">
                                <div class="pay-form-content">
                                    <h2>Chọn phương thức thanh toán <span id="pay-close">X Đóng</span></h2>
                                    <form action="#" method="POST">
                                        <div class="payment-options">
                                            <div class="payment-option">
                                                <input type="radio" id="tienmat" name="method-pay" value="tienmat" <?php if ($phuong_thuc_da_chon === 'tienmat') echo 'checked'; ?>>
                                                <label for="tienmat" class="payment-label">Tiền mặt</label>
                                            </div>
                                            <div class="payment-option">
                                                <input type="radio" id="nganhang" name="method-pay" value="nganhang" <?php if ($phuong_thuc_da_chon === 'nganhang') echo 'checked'; ?>>
                                                <label for="nganhang" class="payment-label">Ngân hàng</label>
                                            </div>
                                            <div class="payment-option">
                                                <input type="radio" id="momo" name="method-pay" value="momo" <?php if ($phuong_thuc_da_chon === 'momo') echo 'checked'; ?>>
                                                <label for="momo" class="payment-label">Momo</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn-pay">Xác nhận</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="pay-order">
                            <div class="pay-total-money">Tổng cộng: 345.345.345 đồng</div>
                            <button type="submit">Đặt hàng</button>
                        </div>
                    </div>
                    <!-- Kết thúc chọn voucher, phương thức thanh toán -->
                </div>
            </div>
        </div>
    </div>

    <script src="js/pay.js"></script>

</body>

</html>