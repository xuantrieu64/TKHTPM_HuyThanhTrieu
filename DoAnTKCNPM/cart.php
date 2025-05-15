<?php
require_once 'header_nav.php';
require_once 'SanPham_Database.php';

session_start();

// Khởi tạo giỏ hàng nếu nó chưa tồn tại
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Xử lý yêu cầu xóa sản phẩm khỏi giỏ hàng
if (isset($_POST['action']) && $_POST['action'] == 'remove' && isset($_POST['id'])) {
    $idToRemove = $_POST['id'];
    if (isset($_SESSION['cart'][$idToRemove])) {
        unset($_SESSION['cart'][$idToRemove]);
    }
    // Sau khi xóa, chuyển hướng người dùng trở lại trang giỏ hàng để cập nhật giao diện
    header('Location: cart.php');
    exit();
}

$sanpham_database = new SanPham_Database();
$sanphams = $sanpham_database->TatCaSanPham();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://unpkg.com/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style_cart.css?v=<?= filemtime('css/style_cart.css') ?>">
    <link rel="stylesheet" href="css/header.css?v=<?= filemtime('css/header.css') ?>">

    <title>Giỏ hàng</title>
    <style>
        .cart-item {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .container ul li a {
            text-decoration: none;
            color: #fff;
        }

        .nav-wrapper {
            padding-left: 100px;
        }
    </style>
</head>

<body>
    <section class="cart-section p-to-top">
        <div class="container" style="margin-bottom: 100px;">
            <div class="row-flex row-flex-product-cart">
                <p class="heading-text">Giỏ hàng</p>
            </div>
            <form action="pay.php" method="POST" id="productForm">
                <input type="hidden" name="checkout_data" id="checkout_data">
                <?php
                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $id => $item) { ?>
                        <div class="cart-item" data-product-id="<?= $id ?>">
                            <div class="cart-list-item">
                                <div class="cart-list-item-product" id="prices">
                                    <div class="cart-image" style="position: relative;">
                                        <input style="position: absolute; top: 45%; left: -15px;" type="checkbox" id="checkbox_<?= $id ?>" name="selected_products[]" value="<?= $id ?>" class="product-checkbox">
                                        <img src="<?= htmlspecialchars($item['anh'] ?? '') ?>" alt="<?= htmlspecialchars($item['ten'] ?? '') ?>">
                                    </div>
                                    <div class="format-product">
                                        <div class="info-product-on">
                                            <div class="product-name">
                                                <?= htmlspecialchars($item['ten'] ?? '') ?>
                                                <input type="hidden" id="<?= $item['ten'] ?>" name="<?= $item['ten'] ?>">
                                            </div>
                                            <div class="action">
                                                <button class="remove-item" type="button" data-id="<?= $id ?>"><i class="ri-delete-bin-line"></i></button>
                                            </div>
                                        </div>
                                        <div class="info-product-under">
                                            <div class="product-price">
                                                <span><?= (isset($item['gia']) && is_numeric($item['gia'])) ? number_format($item['gia']) : '0' ?> VNĐ</span>
                                                <input type="hidden" id="<?= $item['gia'] ?>" name="<?= $item['gia'] ?>">
                                            </div>
                                            <div class="product-quantity">
                                                <button type="button" class="btn-icon-quantity minus" onclick="updateQuantity(this, -1)"><i class="fa-solid fa-minus"></i></button>
                                                <input type="text" class="amount" min="1" name="amount" value="<?= htmlspecialchars($item['inputQuantity'] ?? '1') ?>">
                                                <button type="button" class="btn-icon-quantity plus" onclick="updateQuantity(this, 1)"><i class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } ?>
                    <div class="cart-voucher" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-left: auto; margin-right: auto; width: 700px; height: 50px; background: rgba(200, 200, 200, 0.5); border-radius: 5px; cursor: pointer;">

                        <div class="cart-voucher-item" style="display: flex; align-items: center; padding: 18px 15px; justify-content: space-between;">
                            <div class="voucher-title"><i class="ri-discount-percent-line"></i>Voucher</div>
                            <div class="voucher-name" style="display: flex; margin-right: 10px;">
                                <p id="selected-voucher-name"></p>
                                <div id="voucher-form" class="voucher-icon">
                                    <i class="ri-arrow-right-wide-line"></i>
                                </div>
                            </div>
                            <?php
                            $vouchers = $sanpham_database->getVoucher();
                            if (isset($_GET['id_ma'])) {
                                $id_ma = $_GET['id_ma'];
                                $tenma = $_GET['tenma'];
                                $phantram = $_GET['phantram'];
                                $ngayhethan = $_GET['ngayhethan'];
                            }
                            ?>
                            <div class="voucher-form" style="display: none;">
                                <div class="voucher-form-content">
                                    <div class="voucher-title">
                                        <h2>Chọn voucher <span id="voucher-close">X Đóng</span></h2>
                                    </div>
                                    <div class="voucher-list">
                                        <?php foreach ($vouchers as $voucher) { ?>
                                            <input type="hidden" name="selected_voucher_name" id="selected_voucher_name">
                                            <div class="voucher-item" data-discount="<?= $voucher['phantram'] ?>">
                                                <img style="width: 50px;" src="img/voucher.png" alt="">
                                                <div class="voucher-content">
                                                    <div class="voucher-name"><?= $voucher['tenma'] ?></div>
                                                    <div class="voucher-date"><?= $voucher['ngayhethan'] ?></div>
                                                </div>
                                                <input type="radio" name="voucher">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <button class="btn-apply" type="button">Áp dụng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cart-total-money">
                        <div class="cart-text">
                            <span class="cart-content">Tổng tiền: <p id="cart-total">0</p> VND</span>
                            <!-- Thêm input ẩn để gửi danh sách sản phẩm -->
                            <button type="submit" class="btn-pay">Mua ngay</button>

                        </div>
                    </div>
                <?php
                } else { ?>
                    <p>Giỏ hàng của bạn đang trống.</p>
                <?php
                }
                ?>
            </form>
        </div>
    </section>
    <script>
        const checkboxes = document.querySelectorAll('.product-checkbox');
        const cartTotalElement = document.getElementById('cart-total');
        const selectedVoucherNameElement = document.getElementById('selected-voucher-name');
        let discountPercentage = 0; // Biến lưu phần trăm giảm giá

        const updateTotalPrice = () => {
            let subTotal = 0;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const productId = checkbox.value;
                    const cartItem = document.querySelector(`.cart-item[data-product-id="${productId}"]`);
                    if (cartItem) {
                        const priceText = cartItem.querySelector('.product-price span').textContent.replace(/[^0-9.-]/g, '');
                        const price = parseFloat(priceText) || 0;
                        const quantity = parseInt(cartItem.querySelector('.amount').value) || 1;
                        subTotal += price * quantity;
                    }
                }
            });

            // Tính toán giảm giá
            const discount = (subTotal * discountPercentage) / 100;
            const finalTotal = Math.max(subTotal - discount, 0); // Đảm bảo tổng tiền không âm

            const formattedTotal = new Intl.NumberFormat('vi-VN', {
                style: 'decimal',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(finalTotal);

            cartTotalElement.textContent = formattedTotal;
        };

        // Xử lý sự kiện cho các checkbox sản phẩm
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateTotalPrice);
        });

        // Xử lý sự kiện cho nút "Áp dụng" voucher  
        document.querySelector('.btn-apply').addEventListener('click', () => {
            const selectedVoucherItem = Array.from(document.querySelectorAll('.voucher-item')).find(item => item.querySelector('input[type="radio"]').checked);

            if (selectedVoucherItem) {
                discountPercentage = parseFloat(selectedVoucherItem.dataset.discount) || 0; // Lấy phần trăm giảm
                selectedVoucherNameElement.textContent = selectedVoucherItem.querySelector('.voucher-name').textContent; // Hiển thị tên voucher
                updateTotalPrice(); // Cập nhật tổng tiền

                // Đóng phần chọn voucher
                formVoucher.style.display = 'none'; // Ẩn phần voucher
            } else {
                alert('Vui lòng chọn voucher');
            }
        });

        // Cập nhật số lượng và tính toán lại tổng tiền
        const updateQuantity = (button, change) => {
            const input = button.parentElement.querySelector('.amount');
            let amount = parseInt(input.value) || 1;
            amount += change;
            if (amount < 1) amount = 1;
            input.value = amount;
            updateTotalPrice(); // Cập nhật tổng tiền khi thay đổi số lượng

            const productId = button.closest('.cart-item').dataset.productId;
            fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${productId}&quantity=${amount}`
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        console.error('Lỗi khi cập nhật giỏ hàng:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Lỗi mạng:', error);
                });
        };

        // Gọi hàm tính tổng ban đầu khi trang tải
        updateTotalPrice();

        // Xử lý sự kiện cho các input số lượng để tự động cập nhật
        document.querySelectorAll('.amount').forEach(input => {
            input.addEventListener('input', function() {
                let amount = parseInt(this.value);
                if (isNaN(amount) || amount < 1) {
                    this.value = 1;
                    amount = 1;
                }
                updateTotalPrice();
                const productId = this.closest('.cart-item').dataset.productId;
                fetch('update_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id=${productId}&quantity=${amount}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            console.error('Lỗi khi cập nhật giỏ hàng:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi mạng:', error);
                    });
            });
        });

        // Xử lý sự kiện cho voucher
        const btnClick = document.querySelector('.ri-arrow-right-wide-line');
        const formVoucher = document.querySelector('.voucher-form');
        const close = document.querySelector('#voucher-close');

        btnClick.addEventListener('click', () => {
            formVoucher.style.display = 'block';
        });

        close.addEventListener('click', () => {
            formVoucher.style.display = 'none';
        });

        const voucherItems = document.querySelectorAll('.voucher-item');

        voucherItems.forEach(item => {
            const radio = item.querySelector('input[type="radio"]');

            item.addEventListener('click', () => {
                voucherItems.forEach(otherItem => {
                    const radioOther = otherItem.querySelector('input[type="radio"]');
                    if (radioOther !== radio) {
                        radioOther.checked = false;
                    }
                });
                if (radio) {
                    radio.checked = true;
                }
            });
            if (radio) {
                radio.addEventListener('click', (event) => {
                    event.stopPropagation();
                });
            }
        });

        // Gửi dữ liệu sản phẩm + voucher sang pay.php
        document.querySelector('.btn-pay').addEventListener('click', function(e) {
            e.preventDefault();

            // Lấy danh sách sản phẩm đã chọn
            const selectedProducts = Array.from(document.querySelectorAll('.product-checkbox:checked')).map(checkbox => {
                const cartItem = checkbox.closest('.cart-item');
                const productId = checkbox.value;
                const productName = cartItem.querySelector('.product-name')?.textContent.trim() || '';
                const priceText = cartItem.querySelector('.product-price span')?.textContent.replace(/[^0-9]/g, '') || '0';
                const price = parseInt(priceText, 10);
                const quantity = parseInt(cartItem.querySelector('.amount')?.value || '1');
                const image = cartItem.querySelector('img')?.getAttribute('src') || '';

                return {
                    id: productId,
                    name: productName,
                    price,
                    quantity,
                    image
                };
            });

            if (selectedProducts.length === 0) {
                alert("Vui lòng chọn ít nhất một sản phẩm để thanh toán.");
                return;
            }

            // Lấy thông tin voucher đã chọn (nếu có)
            const selectedVoucher = document.querySelector('.voucher-item input[type="radio"]:checked');
            let voucher = null;
            if (selectedVoucher) {
                const voucherItem = selectedVoucher.closest('.voucher-item');
                voucher = {
                    name: voucherItem.querySelector('.voucher-name')?.textContent.trim() || '',
                    discount: parseFloat(voucherItem.dataset.discount || '0')
                };
            }

            // Gộp dữ liệu cần gửi
            const payload = {
                products: selectedProducts,
                voucher: voucher
            };

            // Gán vào input hidden dưới dạng JSON
            document.getElementById('checkout_data').value = JSON.stringify(payload);


            document.getElementById('selected_voucher_name').value = voucher?.name || '';

            // Gửi form
            document.getElementById('productForm').submit();
        });

        //Xoa san pham 
        // Bắt sự kiện click nút xóa
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');

                if (confirm("Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?")) {
                    fetch('cart.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `action=remove&id=${encodeURIComponent(productId)}`
                        })
                        .then(response => {
                            if (response.redirected) {
                                window.location.href = response.url; // Chuyển hướng nếu server redirect
                            } else {
                                location.reload(); // Nếu không có redirect, tự reload
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi khi gửi yêu cầu xóa:', error);
                            alert("Có lỗi xảy ra khi xóa sản phẩm.");
                        });
                }
            });
        });
    </script>
    <script src="js/header.js"></script>
</body>

</html>