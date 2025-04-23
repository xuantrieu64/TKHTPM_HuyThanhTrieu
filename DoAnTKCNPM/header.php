<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <title>Document</title>
    <style>
        .container ul li a {
            text-decoration: none;
            color: #fff;
        }

        nav ul {
            padding-left: 100px;
        }
    </style>
</head>

<body>
    <!-- Start Header -->
    <header>
        <nav>
            <div class="container">
                <ul>
                    <li><a href="">Moblie Shop</a></li>
                    <li id="adress-form"><a href="index.php">Home</a></li>
                    <li><input type="text" placeholder="Bạn tìm gì..."><i class="fa-solid fa-magnifying-glass"></i></li>
                    <li><a href="cart.php"><button><i class="fa-solid fa-cart-shopping"></i>Giỏ hàng</button></a></li>
                    <li><a href="#">Lịch sử<br>đơn hàng</a></li>
                    <li><a href="">Danh mục<i class="ri-arrow-down-s-fill"></i></a></li>
                    <li><a href="contact.php">Liên hệ</a></li>
                    <li><a href="login.php">Đăng xuất</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- End Header -->

    <!-- Start Slider -->
    <div class="slider">
        <div class="slide-show">
            <div class="list-image">
                <img src="img/slider-iphone.jpg" alt="">
                <img src="img/slider-oppo.jpg" alt="">
                <img src="img/slider-poco.jpg" alt="">
                <img src="img/slider-tecno.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- End Slider -->
    <script>
        const listImage = document.querySelector('.list-image');
        const img = document.getElementsByTagName('img');
        let current = 0;
        const length = img.length;
        const intervalTime = 3000;
        const resetDelay = 50; // Thời gian chờ ngắn (ms)

        setInterval(() => {
            if (current == length - 1) {
                listImage.style.transform = `translateX(0px)`;
                current = 0;
                // Không tăng current ngay lập tức, để cho thấy ảnh đầu tiên
            } else {
                current++;
                let width = img[0].offsetWidth;
                listImage.style.transform = `translateX(${width * -1 * current}px)`;
            }
        }, intervalTime);
    </script>
</body>

</html>