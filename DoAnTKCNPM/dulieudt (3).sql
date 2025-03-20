-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 20, 2025 lúc 06:12 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dulieudt`
--
CREATE DATABASE IF NOT EXISTS `dulieudt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `dulieudt`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai`
--

CREATE TABLE `loai` (
  `maloa` int(11) NOT NULL,
  `tenloai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loai`
--

INSERT INTO `loai` (`maloa`, `tenloai`) VALUES
(1, 'Điện thoại'),
(2, 'Máy tính bảng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `ma` int(11) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `anh` varchar(255) NOT NULL,
  `mota` text NOT NULL,
  `gia` float NOT NULL,
  `maloai` int(11) NOT NULL,
  `ngaytao` date NOT NULL DEFAULT '2024-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`ma`, `ten`, `anh`, `mota`, `gia`, `maloai`, `ngaytao`) VALUES
(1, 'SamSung S25U', 'img/67db9fceafaba.jpg', 'Điện thoại di động là thiết bị cầm tay thông minh, giúp người dùng liên lạc, giải trí, làm việc và truy cập internet. Với sự phát triển của công nghệ, điện thoại ngày nay được trang bị nhiều tính năng hiện đại như camera chất lượng cao, màn hình cảm ứng sắc nét, pin dung lượng lớn và khả năng kết nối 5G.', 40000, 1, '2024-01-01'),
(2, 'SamSung S24U', 'img/67dba13ba89c6.jpg', 'Điện thoại thông minh hiện đại được trang bị màn hình cảm ứng độ phân giải cao, bộ vi xử lý mạnh mẽ và camera chất lượng tốt. Hệ điều hành phổ biến như Android và iOS mang đến trải nghiệm mượt mà, hỗ trợ hàng triệu ứng dụng hữu ích.', 20000, 1, '2024-01-01'),
(3, 'iPhone 15 Pro Max', '', 'Thiết kế: Khung titanium siêu nhẹ, viền mỏng hơn.\r\nMàn hình: OLED 6.7 inch, ProMotion 120Hz, Dynamic Island.\r\nChip xử lý: Apple A17 Pro, 3nm, mạnh mẽ nhất hiện tại.\r\nRAM & ROM: 8GB RAM, bộ nhớ 256GB - 1TB.\r\nCamera:\r\nChính: 48MP, hỗ trợ ProRAW.\r\nTele: 12MP zoom 5x, chống rung tiên tiến.\r\nGóc rộng: 12MP.\r\nPin: Khoảng 4500mAh, sạc nhanh USB-C 35W.\r\nTính năng đặc biệt: Cổng USB-C, nút Action có thể tùy chỉnh, vỏ titanium nhẹ.', 132424, 2, '2025-03-14'),
(121, 'a', '', '11', 12, 2, '2025-03-14'),
(123, 'Samsung Galaxy Z Fold5', '', 'Thiết kế: Màn hình gập dọc, bản lề bền hơn, trọng lượng nhẹ hơn so với Z Fold4.\r\nMàn hình:\r\nNgoài: 6.2 inch AMOLED, 120Hz.\r\nTrong: 7.6 inch AMOLED, 120Hz, hỗ trợ bút S-Pen.\r\nChip xử lý: Snapdragon 8 Gen 2 for Galaxy.\r\nRAM & ROM: 12GB RAM, bộ nhớ 256GB - 1TB.\r\nCamera: 50MP (chính) + 12MP (góc siêu rộng) + 10MP (tele 3x).\r\nPin: 4400mAh, sạc nhanh 25W.\r\nTính năng đặc biệt: Đa nhiệm trên màn hình lớn, hỗ trợ bút S-Pen, gập không khe hở.', 122340000, 2, '2025-03-10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `email`, `role`) VALUES
(1, 'admin1', '123', 'admin1@example.com', 'admin'),
(2, 'user1', '12345', 'user1@example.com', 'user'),
(3, 'admin2', 'hashed_password_3', 'admin2@example.com', 'admin'),
(4, 'user2', 'hashed_password_4', 'user2@example.com', 'user'),
(5, 'Hoang Huy', '12345', 'hoanghuy123@gmail.com', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `loai`
--
ALTER TABLE `loai`
  ADD PRIMARY KEY (`maloa`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ma`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12334;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
