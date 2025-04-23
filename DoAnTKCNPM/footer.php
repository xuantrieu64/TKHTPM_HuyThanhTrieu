<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .container {
            margin: 0 50px;
            color: white;
        }

        footer {
            font-family: "Open Sans", sans-serif;
            padding: 50px 0 0 12px;
            background: #696687;
            margin-top: 20px;
            inset: 0;
        }

        footer .row-gird {
            display: grid;
            justify-content: space-between;
            grid-template-columns: repeat(4, 25%);

        }

        .footer-item p:first-child {
            font-weight: bolder;
            margin-bottom: 12px;
        }

        .footer-item p {
            font-weight: lighter;
            line-height: 32px;
        }

        .row-flex-product-detail {
            justify-content: flex-start;
        }

        .information {
            display: flex;
            justify-content: space-between;
            margin: 0 40px 0 40px;
            padding: 30px 0;
        }

        .information-text {
            font-size: 20px;
        }

        .information-icon i {
            padding: 5px;
            cursor: pointer;
        }

        .information-icon i {
            display: inline-block;
            width: 30px;
            height: 30px;
            justify-content: center;
            align-items: center;
            text-align: center;
            line-height: 20px;
            transition: 0.3s ease-in-out;
            border-radius: 50%;
        }

        .information-icon i:nth-child(1):hover {
            background: blue;
        }

        .information-icon i:nth-child(2):hover {
            background: rgb(110, 210, 220);
        }

        .information-icon i:nth-child(3):hover {
            background: rgb(234, 141, 157);
        }
    </style>
    <title>Document</title>
</head>

<body>
    <!-- Start Footer -->
    <footer>
        <div class="container">
            <div class="row-gird">
                <div class="footer-item">
                    <p>Thông tin và chính sách</p>
                    <p>Đăng ký thành viên</p>
                    <p>Mua hàng online</p>
                    <p>Chính sách đổi trả</p>
                    <p>Chính sách giao hàng</p>
                </div>
                <div class="footer-item">
                    <p>Dịch vụ khác</p>
                    <p>Chính sách bảo hành</p>
                    <p>Tuyển dụng</p>
                    <p>Liên kết hợp tác kinh doanh</p>
                </div>
                <div class="footer-item">
                    <p>Chăm sóc khách hàng</p>
                    <p>Trải nghiệm mua sắm</p>
                    <p>Hỏi đáp</p>
                </div>
                <div class="footer-item">
                    <p>Địa chỉ liên hệ</p>
                    <p>Công ty TNHH HTT và dịch vụ</p>
                    <p>Địa chỉ văn phòng: 350-352 Võ Văn Kiệt, Phường Cô Giang, Quận 1, Thành phố Hồ Chí Minh, Việt Nam.
                        Điện thoại: 028.7108.9666</p>
                </div>
            </div>
            <div class="information">
                <div class="information-text">
                    Rất vui được gặp bạn!!
                </div>
                <div class="information-icon">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-instagram"></i>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
</body>

</html>