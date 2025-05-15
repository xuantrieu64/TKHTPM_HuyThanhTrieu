-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 12:17 PM
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
-- Database: `xobjhnrc_dulieudt`
--

-- --------------------------------------------------------

--
-- Table structure for table `chamsoc`
--

CREATE TABLE `chamsoc` (
  `ma_chamsoc` int(11) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `van_de` text NOT NULL,
  `sdt` varchar(15) NOT NULL,
  `y_kien` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chamsoc`
--

INSERT INTO `chamsoc` (`ma_chamsoc`, `ho_ten`, `email`, `van_de`, `sdt`, `y_kien`) VALUES
(1, 'Tran van xuan trieu', 'trieu@gmail.com', 'rrf', '1234567', 'fffff');

-- --------------------------------------------------------

--
-- Table structure for table `danhgiasanpham`
--

CREATE TABLE `danhgiasanpham` (
  `madanhgia` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `sao` int(5) NOT NULL,
  `noidung` text NOT NULL,
  `ngaydanhgia` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhgiasanpham`
--

INSERT INTO `danhgiasanpham` (`madanhgia`, `user_id`, `sp_id`, `sao`, `noidung`, `ngaydanhgia`) VALUES
(6, 2, 0, 4, 'fefefe', '2025-05-11'),
(7, 2, 0, 4, 'fefefe', '2025-05-11'),
(8, 2, 0, 4, 'fefefe', '2025-05-11'),
(9, 2, 0, 4, 'fefefe', '2025-05-11'),
(10, 2, 0, 2, 'haha', '2025-05-11'),
(11, 0, 8, 5, 'test1', '2025-05-11'),
(12, 0, 2, 3, 'test2', '2025-05-11'),
(13, 0, 2, 2, 'test3', '2025-05-11'),
(14, 0, 8, 5, 'test4', '2025-05-11'),
(15, 0, 2, 5, 'test5', '2025-05-11'),
(16, 0, 5, 5, 'test6', '2025-05-11'),
(17, 2, 8, 5, 'Tuyệt', '2025-05-11'),
(18, 2, 8, 5, 'Tuyệt', '2025-05-11'),
(19, 2, 6, 5, 'Tuyệt vời', '2025-05-12'),
(20, 2, 2, 5, 'dia', '2025-05-12'),
(21, 2, 1, 4, 'len nào', '2025-05-12'),
(22, 2, 2, 5, 'ttt', '2025-05-12'),
(23, 2, 8, 5, 'thu', '2025-05-12'),
(24, 8, 2, 5, 'san phẩm tuyệt vời', '2025-05-12');

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL,
  `pay_method` varchar(50) NOT NULL,
  `total_money` decimal(15,2) NOT NULL,
  `status` enum('Chờ xác nhận','Đang giao hàng','Đã giao') NOT NULL DEFAULT 'Chờ xác nhận'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `created_at`, `address`, `pay_method`, `total_money`, `status`) VALUES
(1, 'Vui lòng nhập họ tên', '2025-05-11 14:08:02', 'Vui lòng nhập địa chỉ', 'Momo', 23715000.00, 'Đã giao'),
(2, 'Vui lòng nhập họ tên', '2025-05-11 14:08:34', 'Vui lòng nhập địa chỉ', 'Thanh toán khi nhận hàng', 209500000.00, 'Đang giao hàng'),
(3, 'Vui lòng nhập họ tên', '2025-05-11 14:36:07', 'Vui lòng nhập địa chỉ', 'Momo', 184200000.00, 'Đang giao hàng'),
(4, 'Vui lòng nhập họ tên', '2025-05-11 14:41:13', 'Vui lòng nhập địa chỉ', 'Momo', 29000000.00, 'Đã giao'),
(5, 'Vui lòng nhập họ tên', '2025-05-11 14:50:33', 'Vui lòng nhập địa chỉ', 'Momo', 184200000.00, 'Đang giao hàng'),
(6, 'Vui lòng nhập họ tên', '2025-05-11 14:51:31', 'Vui lòng nhập địa chỉ', 'Momo', 32500000.00, 'Đang giao hàng'),
(7, 'Vui lòng nhập họ tên', '2025-05-11 15:03:06', 'Vui lòng nhập địa chỉ', 'Momo', 74150000.00, 'Đang giao hàng'),
(8, 'Vui lòng nhập họ tên', '2025-05-11 15:50:11', 'Vui lòng nhập địa chỉ', 'Momo', 15000000.00, 'Đã giao'),
(9, 'Vui lòng nhập họ tên', '2025-05-11 15:56:17', 'Vui lòng nhập địa chỉ', 'Thanh toán khi nhận hàng', 23460000.00, 'Chờ xác nhận'),
(10, 'Trieu', '2025-05-11 15:59:26', '123 HCM', 'Momo', 25500000.00, 'Đang giao hàng'),
(11, 'Vui lòng nhập họ tên', '2025-05-12 09:13:08', 'Vui lòng nhập địa chỉ', 'Momo', 17850000.00, 'Chờ xác nhận'),
(12, 'Vui lòng nhập họ tên', '2025-05-12 09:29:26', 'Vui lòng nhập địa chỉ', 'Momo', 40500000.00, 'Chờ xác nhận'),
(13, 'trieu', '2025-05-12 11:32:58', '12/9/12 duong 12 thu duc hcm', 'Momo', 27800000.00, 'Chờ xác nhận'),
(14, 'trieu', '2025-05-12 13:35:19', '12/9/12 duong 12 thu duc hcm', 'Thanh toán khi nhận hàng', 43524000.00, 'Đang giao hàng'),
(15, 'trieu', '2025-05-12 14:30:57', '12/9/12 duong 12 thu duc hcm', 'Momo', 83400000.00, 'Đã giao'),
(16, 'Vui lòng nhập họ tên', '2025-05-13 10:03:16', 'Vui lòng nhập địa chỉ', 'Thanh toán khi nhận hàng', 58776000.00, 'Đã giao'),
(17, 'trieu', '2025-05-13 10:09:26', '12/9/12 duong 12 thu duc hcm', 'Ngân hàng', 48750000.00, 'Đã giao'),
(18, 'trieu', '2025-05-13 10:57:14', '12/9/12 duong 12 thu duc hcm', 'Momo', 260000000.00, 'Đã giao'),
(19, 'trieu', '2025-05-13 11:06:09', '12/9/12 duong 12 thu duc hcm', 'Momo', 61400000.00, 'Đã giao'),
(20, 'trieu', '2025-05-13 11:06:59', '12/9/12 duong 12 thu duc hcm', 'Momo', 61400000.00, 'Đã giao'),
(21, 'trieu', '2025-05-13 11:12:23', '12/9/12 duong 12 thu duc hcm', 'Ngân hàng', 69000000.00, 'Đã giao'),
(22, 'trieu', '2025-05-13 11:19:55', '12/9/12 duong 12 thu duc hcm', 'Momo', 319000000.00, 'Đã giao'),
(23, 'Vui lòng nhập họ tên', '2025-05-15 16:42:30', 'Vui lòng nhập địa chỉ', 'Momo', 51200000.00, 'Chờ xác nhận'),
(24, 'Vui lòng nhập họ tên', '2025-05-15 16:44:42', 'Vui lòng nhập địa chỉ', 'Momo', 25500000.00, 'Chờ xác nhận');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `ma` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `ma`, `quantity`, `price`) VALUES
(1, 1, 2, 1, 25500000.00),
(2, 2, 2, 1, 25500000.00),
(3, 2, 1, 2, 30600000.00),
(4, 2, 8, 4, 30700000.00),
(5, 3, 8, 6, 30700000.00),
(6, 4, 5, 1, 29000000.00),
(7, 5, 8, 6, 30700000.00),
(8, 6, 7, 1, 32500000.00),
(9, 7, 2, 1, 25500000.00),
(10, 7, 1, 1, 30600000.00),
(11, 7, 8, 1, 30700000.00),
(12, 7, 5, 1, 29000000.00),
(13, 7, 7, 1, 32500000.00),
(14, 8, 10, 1, 15000000.00),
(15, 9, 2, 1, 25500000.00),
(16, 10, 2, 1, 25500000.00),
(17, 11, 2, 1, 25500000.00),
(18, 12, 2, 1, 25500000.00),
(19, 12, 10, 1, 15000000.00),
(20, 13, 6, 1, 27800000.00),
(21, 14, 4, 2, 23400000.00),
(22, 15, 6, 3, 27800000.00),
(23, 16, 7, 1, 32500000.00),
(24, 16, 8, 1, 30700000.00),
(25, 17, 7, 3, 32500000.00),
(26, 18, 7, 8, 32500000.00),
(27, 19, 8, 2, 30700000.00),
(28, 20, 8, 2, 30700000.00),
(29, 21, 1, 1, 30600000.00),
(30, 21, 4, 1, 23400000.00),
(31, 21, 10, 1, 15000000.00),
(32, 22, 5, 11, 29000000.00),
(33, 23, 4, 1, 23400000.00),
(34, 23, 6, 1, 27800000.00),
(35, 24, 2, 1, 25500000.00);

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
  `ngaytao` timestamp NOT NULL DEFAULT current_timestamp(),
  `soluong` int(11) NOT NULL,
  `daban` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`ma`, `ten`, `anh`, `mota`, `gia`, `maloai`, `ngaytao`, `soluong`, `daban`) VALUES
(1, 'iPhone 16 Pro Max 256GB', 'img/6804a8bd29842.jpg', 'iPhone 16 Pro Max sở hữu màn hình Super Retina XDR OLED 6.9 inch với công nghệ ProMotion, mang lại trải nghiệm hiển thị mượt mà và sắc nét, lý tưởng cho giải trí và làm việc. Với chipset A18 Pro mạnh mẽ, mẫu iPhone đời mới này cung cấp hiệu suất vượt trội, giúp xử lý mượt mà các tác vụ nặng như chơi game hay edit video. Chiếc điện thoại iPhone 16 mới này còn sở hữu hệ thống camera Ultra Wide 48MP cho khả năng chụp ảnh cực kỳ chi tiết, mang đến chất lượng hình ảnh ấn tượng trong mọi tình huống.', 30600000, 1, '2025-04-20 00:00:00', 49, 1),
(2, 'iPhone 15 128GB', 'img/68049e7c3f4ea.jpg', 'iPhone 15 128GB được trang bị màn hình Dynamic Island kích thước 6.1 inch với công nghệ hiển thị Super Retina XDR màn lại trải nghiệm hình ảnh vượt trội. Điện thoại với mặt lưng kính nhám chống bám mồ hôi cùng 5 phiên bản màu sắc lựa chọn: Hồng, Vàng, Xanh lá, Xanh dương và đen. Camera trên iPhone 15 series cũng được nâng cấp lên cảm biến 48MP cùng tính năng chụp zoom quang học tới 2x. Cùng với thiết kế cổng sạc thay đổi từ lightning sang USB-C vô cùng ấn tượng.', 25500000, 1, '2025-04-20 00:00:00', 11, 0),
(3, 'iPhone 15 Pro Max 256GB', 'img/68049e87c0e2d.jpg', 'iPhone 15 Pro Max 256GB cũ đẹp trang bị bộ vi xử lý A17 Pro 6 lõi, GPU 6 lõi và bộ nhớ trong 256GB, mặt sau sở hữu cụm 3 camera 48 + 12 + 12MP. Máy có màn hình 6.7 inch, 2796 x 1290 pixel, tốc độ làm mới 120Hz và kích thước tổng 159.9 x 76.7 x 8.25mm. Máy hỗ trợ sạc nhanh qua USB-C, sạc không dây 15W, nặng 221g và kháng nước IP68.', 23999000, 1, '2025-04-20 00:00:00', 10, 0),
(4, 'iPhone 14 Pro Max 512GB', 'img/68049e9920e43.jpg', 'Màn hình Dynamic Island - Sự biến mất của màn hình tai thỏ thay thế bằng thiết kế viên thuốc, OLED 6,7 inch, hỗ trợ always-on display. Cấu hình iPhone 14 Pro Max mạnh mẽ, hiệu năng cực khủng từ chipset A16 Bionic\r\nLàm chủ công nghệ nhiếp ảnh - Camera sau 48MP, cảm biến TOF sống động\r\nPin liền lithium-ion kết hợp cùng công nghệ sạc nhanh cải tiến', 23400000, 1, '2025-04-20 00:00:00', 39, 1),
(5, 'iPhone 13 128GB | Chính hãng VN/A', 'img/68049eae597a8.jpg', 'iPhone 13 thường được trang bị chip A15 Bionic mạnh mẽ với 6 nhân CPU và 4 nhân GPU, cung cấp mức hiệu năng vượt trội, giúp xử lý nhanh chóng các tác vụ nặng. Màn hình Super Retina XDR 6.1 inch trên máy cũng được đánh giá cao khi mang tới hình ảnh sắc nét với độ sáng cao, tối ưu hóa trải nghiệm xem nội dung dưới mọi điều kiện ánh sáng. Chưa hết, iPhone13 còn sở hữu hệ thống camera kép 12MP với công nghệ ổn định hình ảnh quang học (OIS) cải thiện khả năng quay film, chụp hình, ngay cả khi đang ở trong môi trường ánh sáng yếu.', 29000000, 1, '2025-04-20 00:00:00', 29, 11),
(6, 'Samsung Galaxy Z Flip6 12GB 256GB', 'img/68049ecaaf237.jpg', 'Samsung Z Flip 6 sở hữu nhiều nâng cấp ấn tượng nhờ được trang bị chip Snapdragon 8 Gen 3 for Galaxy, RAM 12GB, mang lại hiệu năng mạnh mẽ cho đa nhiệm và chơi game. Camera chính 50MP của máy giúp cải thiện khả năng quay chụp, đặc biệt trong môi trường thiếu sáng. Cùng với đó là pin 4.000mAh, hỗ trợ sạc nhanh 25W, giúp kéo dài thời gian sử dụng của người dùng.', 27800000, 2, '2025-04-20 00:00:00', 35, 0),
(7, 'Samsung Galaxy Z Fold 6 12GB 256GB', 'img/68049ed38c119.jpg', 'Samsung Z Fold 6 sở hữu thiết kế gập đẳng cấp cùng độ mỏng 12.1mm khi gập, 5.6mm khi mở và chỉ nặng 239g gọn nhẹ, linh hoạt cùng khung kim loại nhôm bền bỉ. Máy được tích hợp Snapdragon 8 thế hệ 3 tăng sức mạnh vượt trội. Pin 4400mAh cho trải nghiệm ấn tượng đến 12 giờ. Camera gồm 3 ống kính, quay phim đến chuẩn 8K quay chụp chuyên nghiệp hơn', 32500000, 2, '2025-04-20 00:00:00', 25, 0),
(8, 'Samsung Galaxy S25 Ultra 512GB', 'img/68049edfa20ed.jpg', 'Điện thoại S25 Ultra bản 512GB trang bị chip xử lý Snapdragon 8 Elite for Galaxy, cụm camera sau 200MP + 50MP + 10MP + 50MP, dung lượng RAM 12GB. Máy có bộ nhớ trong dung lượng 512GB, màn hình Dynamic AMOLED 2X 6.9 inch với độ phân giải QHD+. Máy hỗ trợ kết nối 5G, sở hữu khung viền titan cao cấp.', 30700000, 2, '2025-04-20 00:00:00', 3, 4),
(9, 'Samsung Galaxy S24 FE 5G 8GB 128GB', 'img/68049aa60f669.jpg', 'Samsung Galaxy S24 FE trang bị chip Exynos 2400e, dung lượng RAM lên đến 8GB và ROM 128GB, pin 4.700 mAh kèm sạc nhanh đi kèm. Trang bị camera chính 50MP, cùng với camera góc siêu rộng 12MP rõ nét, camera zoom quang rõ nét 3X 8MP. Bên cạnh đó, kết hợp màn hình AMOLED 2X 6.7 inches Full HD+ khi sử dụng.', 12900000, 2, '2025-04-20 00:00:00', 56, 0),
(10, 'iPhone 16 Pro Max 256GB', 'img/6808c0a738f86.jpg', 'tô', 15000000, 4, '2024-02-04 00:00:00', 33, 1),
(12, 'OPPO Reno10 Pro+ 5G 12GB 256GB', 'img/6822f684902c1.jpg', 'OPPO Reno10 Pro Plus 5G chính là phiên bản điện thoại mới nhất trong dòng OPPO Reno và rất được mong đợi. Đây là chiếc điện thoại thông minh có hỗ trợ 5G với những thông số gây ấn tượng mạnh. Cụ thể, Reno10 Pro+ tạo được điểm chú ý đầu tiên từ ngay trong thiết kế của sản phẩm. Những tính năng tuyệt vời được trang bị trên chiếc điện thoại này bao gồm bộ xử lý mạnh mẽ, màn hình lớn sống động và hệ thống 3 camera với độ phân giải rất đáng để mong đợi.', 190000000, 3, '2025-05-12 17:00:00', 40, 0),
(13, 'iPhone 16 Pro Max 256GB', 'img/6825970458b16.jpg', 'hyhyh', 350, 1, '2025-05-14 17:00:00', 66, 0);

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
(9, 'trieu', '234', 'trieu123@gmail.com', 'user'),
(10, 'ppp', '123456', 'ppp@gmail.com', 'user'),
(11, 'user99', '999', 'user99@gmail.com', 'user'),
(12, 'admin99', '123', 'admin99@gmail.com', 'user'),
(13, 'admin6', '123', 'admin@gmail.com', 'user'),
(14, 'admin7', '123', 'admin7@gmail.com', 'user'),
(15, 'i777', '123', 'i777@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chamsoc`
--
ALTER TABLE `chamsoc`
  ADD PRIMARY KEY (`ma_chamsoc`);

--
-- Indexes for table `danhgiasanpham`
--
ALTER TABLE `danhgiasanpham`
  ADD PRIMARY KEY (`madanhgia`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `ma` (`ma`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ma`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chamsoc`
--
ALTER TABLE `chamsoc`
  MODIFY `ma_chamsoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `danhgiasanpham`
--
ALTER TABLE `danhgiasanpham`
  MODIFY `madanhgia` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`ma`) REFERENCES `sanpham` (`ma`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
