<?php
session_start();
require_once 'header_nav.php';
require_once 'Order_Database.php';
$order_database = new Order_Database();



// Lấy danh sách đơn hàng
$orders = $order_database->getAllOrdersWithDetails();
?>
<?php if (isset($_SESSION['message'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('center-toast');
            toast.textContent = "<?= addslashes($_SESSION['message']) ?>";
            toast.style.display = 'block';

            setTimeout(() => {
                toast.style.display = 'none';
            }, 2000); // 2 giây
        });
    </script>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>



<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/header.css?v=<?= filemtime('css/header.css') ?>">
    <link href="https://unpkg.com/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/orders.css?v=<?= filemtime('css/orders.css') ?>">
    <title>Đơn hàng của bạn</title>
    <style>
        .star-rating {
            display: flex;
            gap: 4px;
            font-size: 26px;
            cursor: pointer;
        }

        .star-rating .star {
            color: #ccc;
            transition: color 0.2s;
        }

        .star-rating .star.active {
            color: #f5c518;
        }
    </style>

</head>

<body>
    <!-- <div id="center-toast" style="
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #198754;
    color: white;
    padding: 16px 28px;
    border-radius: 8px;
    font-size: 18px;
    z-index: 9999;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
"></div> -->


    <h2 style="margin:0 20px;">Đơn hàng của bạn</h2>

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
                    <button type="submit" class="btn-confirm btn-common mt-3">Đã nhận được hàng</button>
                </form>

                <!-- Nút đánh giá chung -->
                <button type="button" class="btn btn-review btn-common "
                    data-order-id="<?= $order['order_id'] ?>"
                    data-item-count="<?= count($order['details']) ?>"
                    onclick="handleReviewClick(this)">
                    Đánh giá sản phẩm
                </button>
                <!-- Modal chọn sản phẩm để đánh giá -->
                <div class="modal fade" id="chonSanPhamModal<?= $order['order_id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Chọn sản phẩm để đánh giá</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                            </div>
                            <div class="modal-body">
                                <?php foreach ($order['details'] as $item): ?>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span><?= $item['ten'] ?></span>
                                        <<button class="btn btn-sm btn-outline-primary" onclick="openDanhGiaModal('<?= $item['ma'] ?>', <?= $order['order_id'] ?>)">Đánh giá</button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Modal đánh giá từng sản phẩm -->
                <div id="danhGiaModalContainer_<?= $order['order_id'] ?>" style="display: contents">
                    <?php foreach ($order['details'] as $item): ?>
                        <div class="modal fade" id="danhGiaModal<?= $item['ma'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="xu_ly_danh_gia.php">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Đánh giá: <?= $item['ten'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="sp_id" value="<?= $item['ma'] ?>">
                                            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                            <div class="mb-3">
                                                <label class="form-label">Số sao</label>
                                                <div class="star-rating" data-sp-id="<?= $item['ma'] ?>">
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <i class="ri-star-line star" data-value="<?= $i ?>"></i>
                                                    <?php endfor; ?>
                                                    <input type="hidden" name="sao" class="rating-value" value="">
                                                </div>
        
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nội dung</label>
                                                <textarea class="form-control" name="noidung" rows="3" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Gửi</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function handleReviewClick(button) {
            const orderId = button.getAttribute('data-order-id');
            const itemCount = parseInt(button.getAttribute('data-item-count'));

            if (itemCount === 1) {
                // Tìm ID sản phẩm duy nhất trong đơn hàng
                const modal = document.querySelector(`#danhGiaModalContainer_${orderId}`);
                const modalId = modal.querySelector('.modal').id;
                const modalInstance = new bootstrap.Modal(document.getElementById(modalId));
                modalInstance.show();
            } else {
                // Mở modal chọn sản phẩm
                const modal = new bootstrap.Modal(document.getElementById('chonSanPhamModal' + orderId));
                modal.show();
            }
        }

        function openDanhGiaModal(maSP, orderId) {
            // Tắt modal chọn sản phẩm
            const chonModalEl = document.getElementById('chonSanPhamModal' + orderId);
            const chonModalInstance = bootstrap.Modal.getInstance(chonModalEl);
            if (chonModalInstance) {
                chonModalInstance.hide();
            }

            // Mở modal đánh giá sản phẩm
            const danhGiaModal = new bootstrap.Modal(document.getElementById('danhGiaModal' + maSP));
            danhGiaModal.show();
        }



        document.querySelectorAll('.star-rating').forEach(group => {
            const stars = group.querySelectorAll('.star');
            const input = group.querySelector('.rating-value');

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = parseInt(star.getAttribute('data-value'));

                    // Gán giá trị sao vào input ẩn
                    input.value = value;

                    // Highlight sao theo giá trị đã chọn
                    stars.forEach(s => {
                        s.classList.toggle('active', parseInt(s.getAttribute('data-value')) <= value);
                    });
                });
            });
        });
    </script>

</body>

</html>