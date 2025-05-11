<?php
require_once 'header_nav.php';
require_once 'Order_Database.php';
$order_database = new Order_Database();

// Lấy danh sách đơn hàng
$orders = $order_database->getAllOrdersWithDetails();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css?v=<?= filemtime('css/header.css') ?>">
    <link href="https://unpkg.com/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/orders.css?v=<?= filemtime('css/orders.css') ?>">
    <title>Đơn hàng của bạn</title>
</head>

<body>

    <h2 style="padding-top: 75px; margin:0 20px;">Đơn hàng của bạn</h2>

    <?php foreach ($orders as $order): ?>
        <div class="order-container">
            <div class="order-header">
                <span class="order-id">Đơn hàng #<?= $order['order_id'] ?></span>
                <?php
                $statusClass = '';
                switch (strtolower($order['status'])) {
                    case 'chờ xác nhận':
                        $statusClass = 'status-pending';
                        break;
                    case 'đang xử lý':
                        $statusClass = 'status-processing';
                        break;
                    case 'đang giao':
                        $statusClass = 'status-shipped';
                        break;
                    case 'đã giao':
                        $statusClass = 'status-delivered';
                        break;
                    default:
                        $statusClass = 'status-processing';
                }
                ?>
                <span class="order-status <?= $statusClass ?>">
                    <?= ucfirst($order['status']) ?>
                </span>

            </div>
            <div class="order-details">
                <div class="detail-item"><span>Ngày đặt:</span> <span><?= $order['created_at'] ?></span></div>
                <div class="detail-item"><span>Địa chỉ giao:</span> <span><?= htmlspecialchars($order['address']) ?></span></div>
                <div class="detail-item"><span>Thanh toán:</span> <span><?= htmlspecialchars($order['pay_method']) ?></span></div>
            </div>
            <div class="order-items-list">
                <h3>Sản phẩm</h3>
                <?php foreach ($order['details'] as $item): ?>
                    <div class="order-item">
                        <div class="item-image">
                            <img src="<?= $item['anh'] ?>" alt="<?= $item['ten'] ?>" width="60">
                        </div>
                        <div class="item-info">
                            <div class="item-name"><?= $item['ten'] ?></div>
                            <div class="item-quantity">Số lượng: <?= $item['quantity'] ?></div>
                        </div>
                        <div class="item-price"><?= number_format($item['price'], 0, ',', '.') ?> VND</div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="total-amount">Tổng cộng: <?= number_format($order['total_money'], 0, ',', '.') ?> VND</div>
            <div class="order-actions">
                <form action="confirm.php" method="post" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                    <button type="submit" class="btn-confirm">Đã nhận được hàng</button>
                </form>

                <a href="#" class="btn-review">Đánh giá sản phẩm</a>
            </div>
        </div>
    <?php endforeach; ?>

</body>

</html>