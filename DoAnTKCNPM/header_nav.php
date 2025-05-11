<?php 
require_once 'Category_Database.php';
$category_database = new Category_Database();
$categories = $category_database->getAllLoai();

?>
<!-- Start Header -->
<header>
    <nav>
        <ul>
            <li><a href="index.php">Moblie Shop</a></li>
            <li id="adress-form"><a href="index.php">Home</a></li>
            <li><input type="text" placeholder="Bạn tìm gì..."><i class="fa-solid fa-magnifying-glass"></i></li>
            <li><a href="cart.php"><button><i class="fa-solid fa-cart-shopping"></i>Giỏ hàng</button></a></li>
            <li><a href="orders.php">Lịch sử<br>đơn hàng</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Danh mục<i class="ri-arrow-down-s-fill"></i></a>
                <ul class="dropdown-menu">
                    <?php foreach($categories as $category) {?>
                    <li><a href="index.php?category_id=<?= $category['maloai']?>"><?= $category['tenloai']?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <li><a href="contact.php">Liên hệ</a></li>
            <li><a href="login.php">Đăng xuất</a></li>
        </ul>
    </nav>
</header>
<!-- End Header -->