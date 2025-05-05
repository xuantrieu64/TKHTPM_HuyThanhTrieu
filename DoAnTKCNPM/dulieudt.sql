-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 07:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dulieudt`
--

-- --------------------------------------------------------

--
-- Table structure for table `chamsoc`
--

CREATE TABLE `chamsoc` (
  `ma_chamsoc` int(11) NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `sdt` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `van_de` varchar(255) NOT NULL,
  `y_kien` varchar(255) NOT NULL,
  `ngay_tao` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chamsoc`
--

INSERT INTO `chamsoc` (`ma_chamsoc`, `ho_ten`, `sdt`, `email`, `van_de`, `y_kien`, `ngay_tao`) VALUES
(1, 'Tran van xuan trieu', '1234567', 'trieu@gmail.com', 'rrf', 'ddd', '2025-04-28'),
(2, '', '', '', '', '', '2025-04-28'),
(3, '', '', '', '', '', '2025-04-28'),
(4, '', '', '', '', '', '2025-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `loai`
--

CREATE TABLE `loai` (
  `maloai` int(11) NOT NULL,
  `tenloai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loai`
--

INSERT INTO `loai` (`maloai`, `tenloai`) VALUES
(1, 'Điện thoại'),
(2, 'Máy tính bảng');

-- --------------------------------------------------------

--
-- Table structure for table `magiamgia`
--

CREATE TABLE `magiamgia` (
  `id_ma` int(11) NOT NULL,
  `tenma` varchar(50) NOT NULL,
  `phantram` int(11) NOT NULL,
  `ngayhethan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `magiamgia`
--

INSERT INTO `magiamgia` (`id_ma`, `tenma`, `phantram`, `ngayhethan`) VALUES
(1, 'Giảm 15%', 15, '2025-04-27'),
(2, 'Giảm 5%', 5, '2025-04-28'),
(3, 'Giảm 8%', 8, '2025-04-27'),
(4, 'Giảm 7%', 7, '2025-04-28'),
(5, 'Giảm 50%', 50, '2025-04-27'),
(6, 'Giảm 30%', 30, '2025-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_code` varchar(60) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_desc` tinytext NOT NULL,
  `product_img_name` varchar(60) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `product_name`, `product_desc`, `product_img_name`, `price`) VALUES
(1, 'PD1001', 'Android Phone FX1', 'Di sertakan secara rambang yang lansung tidak munasabah. Jika anda ingin menggunakan Lorem Ipsum, anda perlu memastikan bahwa tiada apa yang', 'android-phone.jpg', 200.50),
(2, 'PD1002', 'Television DXT', 'Ia menggunakan kamus yang mengandungi lebih 200 ayat Latin, bersama model dan struktur ayat Latin, untuk menghasilkan Lorem Ipsum yang munasabah.', 'lcd-tv.jpg', 500.85),
(3, 'PD1003', 'External Hard Disk', 'Ada banyak versi dari mukasurat-mukasurat Lorem Ipsum yang sedia ada, tetapi kebanyakkannya telah diubahsuai, lawak jenaka diselitkan, atau ayat ayat yang', 'external-hard-disk.jpg', 100.00),
(4, 'PD1004', 'Wrist Watch GE2', 'Memalukan akan terselit didalam di tengah tengah kandungan text. Semua injin Lorem Ipsum didalam Internet hanya mengulangi text, sekaligus menjadikan injin kami sebagai yang terunggul dan tepat sekali di Internet.', 'wrist-watch.jpg', 400.30);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `ma` int(11) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `anh` varchar(255) NOT NULL,
  `mota` text NOT NULL,
  `gia` float NOT NULL,
  `maloai` int(11) NOT NULL,
  `ngaytao` date NOT NULL DEFAULT current_timestamp(),
  `soluong` int(11) NOT NULL,
  `daban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`ma`, `ten`, `anh`, `mota`, `gia`, `maloai`, `ngaytao`, `soluong`, `daban`) VALUES
(1, 'iPhone 16 Pro Max 256GB', 'img/6804a8bd29842.jpg', 'iPhone 16 Pro Max sở hữu màn hình Super Retina XDR OLED 6.9 inch với công nghệ ProMotion, mang lại trải nghiệm hiển thị mượt mà và sắc nét, lý tưởng cho giải trí và làm việc. Với chipset A18 Pro mạnh mẽ, mẫu iPhone đời mới này cung cấp hiệu suất vượt trội, giúp xử lý mượt mà các tác vụ nặng như chơi game hay edit video. Chiếc điện thoại iPhone 16 mới này còn sở hữu hệ thống camera Ultra Wide 48MP cho khả năng chụp ảnh cực kỳ chi tiết, mang đến chất lượng hình ảnh ấn tượng trong mọi tình huống.', 30600000, 1, '2025-04-20', 50, 0),
(2, 'iPhone 15 128GB', 'img/68049e7c3f4ea.jpg', 'iPhone 15 128GB được trang bị màn hình Dynamic Island kích thước 6.1 inch với công nghệ hiển thị Super Retina XDR màn lại trải nghiệm hình ảnh vượt trội. Điện thoại với mặt lưng kính nhám chống bám mồ hôi cùng 5 phiên bản màu sắc lựa chọn: Hồng, Vàng, Xanh lá, Xanh dương và đen. Camera trên iPhone 15 series cũng được nâng cấp lên cảm biến 48MP cùng tính năng chụp zoom quang học tới 2x. Cùng với thiết kế cổng sạc thay đổi từ lightning sang USB-C vô cùng ấn tượng.', 25500000, 1, '2025-04-20', 11, 0),
(3, 'iPhone 15 Pro Max 256GB', 'img/68049e87c0e2d.jpg', 'iPhone 15 Pro Max 256GB cũ đẹp trang bị bộ vi xử lý A17 Pro 6 lõi, GPU 6 lõi và bộ nhớ trong 256GB, mặt sau sở hữu cụm 3 camera 48 + 12 + 12MP. Máy có màn hình 6.7 inch, 2796 x 1290 pixel, tốc độ làm mới 120Hz và kích thước tổng 159.9 x 76.7 x 8.25mm. Máy hỗ trợ sạc nhanh qua USB-C, sạc không dây 15W, nặng 221g và kháng nước IP68.', 23999000, 1, '2025-04-20', 10, 0),
(4, 'iPhone 14 Pro Max 512GB', 'img/68049e9920e43.jpg', 'Màn hình Dynamic Island - Sự biến mất của màn hình tai thỏ thay thế bằng thiết kế viên thuốc, OLED 6,7 inch, hỗ trợ always-on display. Cấu hình iPhone 14 Pro Max mạnh mẽ, hiệu năng cực khủng từ chipset A16 Bionic\r\nLàm chủ công nghệ nhiếp ảnh - Camera sau 48MP, cảm biến TOF sống động\r\nPin liền lithium-ion kết hợp cùng công nghệ sạc nhanh cải tiến', 23400000, 1, '2025-04-20', 40, 0),
(5, 'iPhone 13 128GB | Chính hãng VN/A', 'img/68049eae597a8.jpg', 'iPhone 13 thường được trang bị chip A15 Bionic mạnh mẽ với 6 nhân CPU và 4 nhân GPU, cung cấp mức hiệu năng vượt trội, giúp xử lý nhanh chóng các tác vụ nặng. Màn hình Super Retina XDR 6.1 inch trên máy cũng được đánh giá cao khi mang tới hình ảnh sắc nét với độ sáng cao, tối ưu hóa trải nghiệm xem nội dung dưới mọi điều kiện ánh sáng. Chưa hết, iPhone13 còn sở hữu hệ thống camera kép 12MP với công nghệ ổn định hình ảnh quang học (OIS) cải thiện khả năng quay film, chụp hình, ngay cả khi đang ở trong môi trường ánh sáng yếu.', 29000000, 1, '2025-04-20', 40, 0),
(6, 'Samsung Galaxy Z Flip6 12GB 256GB', 'img/68049ecaaf237.jpg', 'Samsung Z Flip 6 sở hữu nhiều nâng cấp ấn tượng nhờ được trang bị chip Snapdragon 8 Gen 3 for Galaxy, RAM 12GB, mang lại hiệu năng mạnh mẽ cho đa nhiệm và chơi game. Camera chính 50MP của máy giúp cải thiện khả năng quay chụp, đặc biệt trong môi trường thiếu sáng. Cùng với đó là pin 4.000mAh, hỗ trợ sạc nhanh 25W, giúp kéo dài thời gian sử dụng của người dùng.', 27800000, 2, '2025-04-20', 35, 0),
(7, 'Samsung Galaxy Z Fold 6 12GB 256GB', 'img/68049ed38c119.jpg', 'Samsung Z Fold 6 sở hữu thiết kế gập đẳng cấp cùng độ mỏng 12.1mm khi gập, 5.6mm khi mở và chỉ nặng 239g gọn nhẹ, linh hoạt cùng khung kim loại nhôm bền bỉ. Máy được tích hợp Snapdragon 8 thế hệ 3 tăng sức mạnh vượt trội. Pin 4400mAh cho trải nghiệm ấn tượng đến 12 giờ. Camera gồm 3 ống kính, quay phim đến chuẩn 8K quay chụp chuyên nghiệp hơn', 32500000, 2, '2025-04-20', 25, 0),
(8, 'Samsung Galaxy S25 Ultra 512GB', 'img/68049edfa20ed.jpg', 'Điện thoại S25 Ultra bản 512GB trang bị chip xử lý Snapdragon 8 Elite for Galaxy, cụm camera sau 200MP + 50MP + 10MP + 50MP, dung lượng RAM 12GB. Máy có bộ nhớ trong dung lượng 512GB, màn hình Dynamic AMOLED 2X 6.9 inch với độ phân giải QHD+. Máy hỗ trợ kết nối 5G, sở hữu khung viền titan cao cấp.', 30700000, 2, '2025-04-20', 7, 0),
(9, 'Samsung Galaxy S24 FE 5G 8GB 128GB', 'img/68049aa60f669.jpg', 'Samsung Galaxy S24 FE trang bị chip Exynos 2400e, dung lượng RAM lên đến 8GB và ROM 128GB, pin 4.700 mAh kèm sạc nhanh đi kèm. Trang bị camera chính 50MP, cùng với camera góc siêu rộng 12MP rõ nét, camera zoom quang rõ nét 3X 8MP. Bên cạnh đó, kết hợp màn hình AMOLED 2X 6.7 inches Full HD+ khi sử dụng.', 12900000, 2, '2025-04-20', 56, 0),
(10, 'iPhone 16 Pro Max 256GB', 'img/6808c0a738f86.jpg', 'tô', 15000000, 4, '2024-02-04', 34, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `email`, `role`) VALUES
(1, 'admin1', '123', 'admin1@example.com', 'admin'),
(2, 'user1', '12345', 'user1@example.com', 'user'),
(8, 'user', '123456', 'user@example.com', 'user'),
(9, 'trieu', '234', 'trieu123@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chamsoc`
--
ALTER TABLE `chamsoc`
  ADD PRIMARY KEY (`ma_chamsoc`);

--
-- Indexes for table `loai`
--
ALTER TABLE `loai`
  ADD PRIMARY KEY (`maloai`);

--
-- Indexes for table `magiamgia`
--
ALTER TABLE `magiamgia`
  ADD PRIMARY KEY (`id_ma`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ma`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chamsoc`
--
ALTER TABLE `chamsoc`
  MODIFY `ma_chamsoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `magiamgia`
--
ALTER TABLE `magiamgia`
  MODIFY `id_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
