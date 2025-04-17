<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
</head>

<body>

    <!-- Start Navbar -->
    <nav>
        <div class="container">
            <ul>
                <li><a href=""><img style="width: 50px;" src="image/smartphone.png" alt=""></a></li>
                <li id="adress-form"><a href="#">Ninh Thuận<i class="fa-solid fa-sort-down"></i></a></li>
                <li><input type="text" placeholder="Bạn tìm gì..."><i class="fa-solid fa-magnifying-glass"></i></li>
                <li><a href="cart.php"><button><i class="fa-solid fa-cart-shopping"></i>Giỏ hàng</button></a></li>
                <li><a href="">Lịch sử<br>đơn hàng</a></li>
                <li><a href=""><span class="parent"><span class="point">.</span></span>Mua thẻ nạp ngay!</a></li>
                <li><a href="">24h Công nghệ</a></li>
                <li><a href="">Hỏi đáp</a></li>
                <li><a href="">Game app</a></li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->

    <section class="cart-section-pay p-to-top">
        <div class="container">
            <div class="row-grid">
                <div class="cart-section-pay-left">
                    <h2 class="main-h2">Thông tin Đơn Hàng</h2>
                    <div class="cart-section-pay-left-detail">
                        <img style="width: 80px; height: 80px;" src="img/dienthoai1.jpg" alt="">
                        <div class="cart-pay-information">
                            <p>IPhone 16 promax 1T</p>
                            <div class="product-item-price">
                                <p class="price">30,000 <sup>d</sup><span>56,000 <sup>d</sup></span></p>
                            </div>
                        </div>
                        <p class="quantity">So luong :1</p>
                    </div>
                </div>
                <div class="cart-section-right">
                    <h2 class="main-h2">Thông tin giao hàng</h2>
                    <div class="cart-section-right-input-name-phone">
                        <input type="text" placeholder="Ten" name="" id="">
                        <input type="text" placeholder="Dien thoai" name="" id="">
                    </div>
                    <div class="cart-section-right-input-email">
                        <input type="text" placeholder="Email" name="" id="">
                    </div>
                    <div class="cart-section-right-select">
                        <select name="" id="city">
                            <option value="">Tỉnh/Tp</option>
                        </select>
                        <select name="" id="district">
                            <option value="">Quận/huyện</option>
                        </select>
                        <select name="" id="ward">
                            <option value="">Phường/xã</option>
                        </select>
                    </div>
                    <div class="cart-section-right-input-adress">
                        <input type="text" placeholder="Dia chi" name="" id="">
                    </div>
                    <div class="cart-section-right-input-note">
                        <input type="text" placeholder="Ghi chu" name="" id="">
                    </div>
                    <button class="main-btn">Mua hang</button>
                </div>
            </div>
        </div>
    </section>

</body>

</html>