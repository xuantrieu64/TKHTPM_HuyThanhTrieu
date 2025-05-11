<?php
require_once 'Order_Database.php';

$order_database = new Order_Database();

$orders = $order_database->getAllOrdersWithDetails();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <!-- Style -->
    <link rel="stylesheet" href="css/crud_order.css">
    <title>Quản lý đơn hàng</title>
</head>

<body>
    <!-- Start Layout -->
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                <div class="admin-sidebar-top">
                    <div class="avatar-admin">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div class="name-admin">Admin</div>
                </div>
                <div class="admin-sidebar-content">
                    <ul>
                        <li><a href=""><i class="ri-box-3-line"></i>Quản lý Sản phẩm</a></li>
                        <li><a href=""><i class="fa-solid fa-calendar"></i>Quản lý Đơn hàng</a></li>
                        <li><a href=""><i class="ri-feedback-line"></i>Quản lý Đánh giá</a></li>
                        <li><a href=""><i class="ri-shield-user-line"></i>Quản lý Người dùng</a></li>
                        <li><a href=""><i class="ri-bar-chart-2-line"></i>Thống kê</a></li>
                        <li><a href=""><i class="ri-file-chart-line"></i>Báo cáo<i class="ri-arrow-down-s-fill"></i></a>
                            <ul class="sub-menu">
                                <div class="sub-menu-items">
                                    <li><a href=""></a><i class="ri-arrow-right-s-fill"></i>Doanh thu</li>
                                    <li><a href=""></a><i class="ri-arrow-right-s-fill"></i>Số lượng sản phẩm</li>
                                    <li><a href=""></a><i class="ri-arrow-right-s-fill"></i>Sản phẩm tốt nhất</li>
                                </div>
                            </ul>
                        </li>
                        <li><a href=""><i class="ri-discount-percent-line"></i>Khuyến mãi</a></li>
                    </ul>
                </div>
            </div>
            <div class="admin-content">
                <div class="admin-content-top">
                    <div class="admin-content-top-left">
                        <ul class="flex-box">
                            <li>
                                <form action="review.php">
                                    <div class="search">
                                        <input type="text" placeholder="Tìm kiếm" class="search-input">
                                        <i class="ri-search-line"></i>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="admin-content-top-right">
                        <ul class="flex-box">
                            <li><i class="fa-solid fa-bell" number="1"></i></li>
                            <li><i class="fa-solid fa-envelope" number="2"></i></li>
                            <li>
                                <i class="fa-solid fa-user-tie"></i>
                                <p>Admin</p>
                                <i style="font-size: 1.3em;" class="ri-arrow-down-s-fill"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="admin-content-review">
                    <div class="admin-content-review-title">
                        <h1>Quản lý đơn hàng</h1>
                    </div>
                    <div class="admin-content-review-table">
                        <div class="admin-content-review-table-list">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Ngày tạo</th>
                                        <th>Địa chỉ</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order) : ?>
                                        <tr>
                                            <td><?= $order['order_id'] ?></td>
                                            <td><?= $order['name'] ?></td>
                                            <td><?= $order['created_at'] ?></td>
                                            <td><?= $order['address'] ?></td>
                                            <td><?= $order['pay_method'] ?></td>
                                            <td><?= number_format($order['total_money'], 0, ',', '.') ?></td>
                                            <td><?= $order['status'] ?></td>
                                            <td>
                                                <button class="btn-order" data-id="<?= $order['order_id'] ?>">Xác nhận</button>
                                                <!-- Trong phần HTML -->
                                                <button class="btn-order-detail" data-index="<?= $order['order_id'] ?>">Xem chi tiết</button>
                                            </td>
                                        </tr>
                                        <!-- Form chi tiet don hang -->
                                        <div class="form-orders-detail" data-index="<?= $order['order_id'] ?>" style="display: none;">
                                            <div class="wapper-orders">
                                                <div class="form-order-title">
                                                    <div class="order-text">Chi tiết đơn hàng</div>
                                                    <p class="order-close">X</p>
                                                </div>
                                                <div class="form-order-product">
                                                    <?php foreach ($order['details'] as $item): ?>
                                                        <div class="form-order-product-detail">
                                                            <img style="width: 150px;" src="<?= $item['anh'] ?>" alt="">
                                                            <div class="order-content">
                                                                <div class="order-name"><?= $item['ten'] ?></div>
                                                                <div class="order-price"><?= number_format($item['price'], 0, ',', '.') ?> VND</div>
                                                            </div>
                                                            <div class="order-quantity">SL: <?= $item['quantity'] ?></div>
                                                        </div>

                                                    <?php endforeach; ?>
                                                    <div class="order-total-money">Tổng tiền: <?= number_format($order['total_money'], 0, ',', '.') ?> VND</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- End Form chi tiet don hang -->
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Layout -->

    <script>
        const menuLi = document.querySelectorAll('.admin-sidebar-content > ul > li > a');
        const submenu = document.querySelectorAll('.sub-menu');

        for (let index = 0; index < menuLi.length; index++) {
            menuLi[index].addEventListener('click', (e) => {

                e.preventDefault()
                // for (let i = 0; i < submenu.length; i++) {
                //     submenu[i].setAttribute("style", "height: 0px")
                // }
                menuLi[index].parentNode.querySelector('ul').classList.toggle('active')
                // const submenuHeight = menuLi[index].parentNode.querySelector('ul .sub-menu-items').offsetHeight
                // menuLi[index].parentNode.querySelector('ul').setAttribute("style", "height: " + submenuHeight + "px")

            });
        }

        const btnDetails = document.querySelectorAll('.btn-order-detail');
        const formDetails = document.querySelectorAll('.form-orders-detail');
        const closeDetails = document.querySelectorAll('.order-close');

        btnDetails.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-index');
                document.querySelector(`.form-orders-detail[data-index="${id}"]`).style.display = 'block';
            });
        });

        closeDetails.forEach(closeBtn => {
            closeBtn.addEventListener('click', () => {
                closeBtn.closest('.form-orders-detail').style.display = 'none';
            });
        });

        document.querySelectorAll('.btn-order').forEach(btn => {
            btn.addEventListener('click', function() {
                const orderId = this.getAttribute('data-id');

                if (confirm("Bạn có chắc muốn xác nhận đơn hàng này?")) {
                    fetch('update_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'order_id=' + orderId
                        })
                        .then(response => response.text())
                        .then(result => {
                            if (result === 'success') {
                                alert('Cập nhật trạng thái thành công!');
                                // Cập nhật giao diện nếu muốn
                                this.closest('tr').querySelector('td:nth-child(7)').textContent = 'Đang giao hàng';
                            } else {
                                alert('Có lỗi xảy ra khi cập nhật.');
                            }
                        });
                }
            });
        });
    </script>
</body>

</html>