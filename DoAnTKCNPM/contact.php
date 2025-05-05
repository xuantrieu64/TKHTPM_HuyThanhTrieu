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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/header.css?v=<?= filemtime('css/header.css') ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?= filemtime('css/footer.css') ?>">
    
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
        <form action="contact_process.php" method="POST">
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
                    <div class="form-group">
                        <input type="text" id="ho_ten" name="ho_ten" placeholder="Họ tên">
                        <input type="email" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" id="van_de" name="van_de" placeholder="Vấn đề gặp phải">
                        <input type="text" id="sdt" name="sdt" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group message">
                        <textarea id="y_kien" name="y_kien" placeholder="Ý kiến"></textarea>
                    </div>
                    <button type="submit" class="send-button">Gửi</button>
                </div>
            </div>
        </form>
    </div>
    <?php
    require_once 'footer.php';
    ?>

    <script src="js/header.js"></script>
</body>

</html>