<?php
require_once 'header_nav.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <title>Document</title>
    <style>
        nav {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="silebar">
        <div class="sidebar-image">
            <img style="width: 100%; height: 400px;" src="img/contact.jpg" alt="">
        </div>
    </div>
    <div class="contact-title">
        <div class="contact-text">
            <p>Xin chào bạn!!</p>
            <p>Nếu bạn có góp ý gì đừng ngần ngại điền thông tin vào phiếu và gửi tôi nhé</p>
        </div>
    </div>
    <!-- End Header -->
    <div class="customer-care-form">
        <div class="container">
            <div class="contact-info">
                <div class="info-item">
                    <div class="icon"><i class="fas fa-phone"></i></div>
                    <div class="info-text">
                        <h3>Số điện thoại</h3>
                        <p>+843438553</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="icon"><i class="fas fa-envelope"></i></div>
                    <div class="info-text">
                        <h3>Email</h3>
                        <p>interiority@mail.com</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="info-text">
                        <h3>Địa chỉ</h3>
                        <p>350-352 Võ Văn Kiệt</p>
                        <p>Phường Cô Giang, Quận 1,</p>
                        <p>Thành phố Hồ Chí Minh, Việt Nam.</p>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <h2></h2>
                <div class="form-group">
                    <input type="text" placeholder="Họ tên">
                    <input type="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Vấn đề gặp phải">
                    <input type="text" placeholder="Số điện thoại">
                </div>
                <div class="form-group message">
                    <textarea placeholder="Ý kiến"></textarea>
                </div>
                <button class="send-button">Gửi</button>
            </div>
        </div>
    </div>
    <?php
    require_once 'footer.php';
    ?>
</body>

</html>