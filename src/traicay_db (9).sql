-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 07, 2026 lúc 01:05 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `traicay_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customer_id`, `fullname`, `phone`, `address`, `payment_method`) VALUES
(1, 'Anh', '0382236877', 'DA', 'Thanh toán khi nhận hàng'),
(2, 'Anh', '0382236877', 'AS', 'Chuyển khoản ngân hàng'),
(3, 'Anh', '0382236877', 'AS', 'bank'),
(4, 'Anh', '0382236877', 'Huyền Hội', 'bank'),
(5, 'Anh', '0382236877', 'AS', 'cod'),
(6, 'Anh', '0382236877', 'AS', 'bank');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `user_id`, `total_amount`, `order_date`, `fullname`, `phone`, `address`, `payment_method`) VALUES
(17, 0, 5, 200000, '2025-12-11 18:01:42', '', '', '', ''),
(18, 0, 2, 1244000, '2025-12-11 18:07:46', '', '', '', ''),
(19, 0, 2, 60000, '2025-12-11 18:20:27', '', '', '', ''),
(20, 0, 2, 200000, '2025-12-11 18:24:10', 'Anh', '0382236877', 'AS', 'cod'),
(21, 0, 2, 1000000, '2025-12-24 13:34:44', 'Hậu', '0382236877', 'AS', 'cod'),
(22, 0, 2, 1000000, '2025-12-25 07:03:03', 'Anh', '0382236877', 'AS', 'bank'),
(23, 0, 2, 824000, '2025-12-29 19:13:35', 'Anh', '0382236877', 'Giồng Bèn', 'bank'),
(24, 0, 2, 1000000, '2026-01-05 09:12:10', 'Anh', '0382236877', 'Giồng Bèn', 'cod');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `image`, `product_name`, `price`, `quantity`) VALUES
(24, 17, NULL, NULL, 'Táo Envy', 200000, 1),
(25, 18, NULL, NULL, 'Nho Mỹ', 200000, 1),
(26, 18, NULL, NULL, 'Kiwi úc', 300000, 3),
(27, 18, NULL, NULL, 'Lê nam phi', 12000, 12),
(28, 19, NULL, NULL, 'Lê nam phi', 12000, 5),
(29, 20, NULL, NULL, 'Dâu tây Hàn Quốc', 200000, 1),
(30, 21, NULL, NULL, 'Táo Envy', 200000, 5),
(31, 22, NULL, NULL, 'Nho Mỹ', 200000, 5),
(32, 23, NULL, NULL, 'Dâu tây Hàn Quốc', 200000, 1),
(33, 23, NULL, NULL, 'Kiwi úc', 300000, 2),
(34, 23, NULL, NULL, 'Lê nam phi', 12000, 2),
(35, 24, NULL, NULL, 'Táo Envy', 200000, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `qr_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `origin`, `description`, `qr_link`) VALUES
(1, 'Táo Envy', 200000, 'images/tao.jpg', 'New Zealand', 'Táo Envy là giống táo cao cấp, vị ngọt đậm, giòn và thơm.', 'https://en.wikipedia.org/wiki/Apple'),
(2, 'Nho Mỹ', 180000, 'images/nho.webp', 'Mỹ', 'Nho Mỹ thơm ngon, thanh ngọt', 'https://en.wikipedia.org/wiki/Grape'),
(3, 'Dâu tây Hàn Quốc', 200000, 'images/dautay.webp', 'Hàn Quốc', 'Dâu tây Hàn Quốc có màu đỏ tươi, vị ngọt dịu, ít chua.', 'https://en.wikipedia.org/wiki/Strawberry'),
(6, 'Quýt Úc', 200000, 'images/quy.jpg', 'Úc', 'Quýt Úc mọng nước, vị ngọt thanh, giàu vitamin C.', 'https://en.wikipedia.org/wiki/Mandarin_orange'),
(15, 'Lê nam phi', 120000, 'images/le.jpg', 'Nam phi', 'Lê Nam Phi có vỏ mỏng, thịt giòn, nhiều nước, vị ngọt mát.', 'https://en.wikipedia.org/wiki/Pear'),
(16, 'Kiwi úc', 300000, 'images/kiwi.jpg', 'Úc', 'Kiwi Úc giàu vitamin C, hỗ trợ tiêu hóa, vị chua ngọt dễ ăn', 'https://en.wikipedia.org/wiki/Kiwifruit'),
(17, 'Táo Fuji', 150000, 'images/taofuji.png', 'Nhật Bản', 'Táo Fuji có vị ngọt đậm, giòn, bảo quản được lâu.', 'https://en.wikipedia.org/wiki/Fuji_apple'),
(18, 'Táo Gala', 130000, 'images/taogala.jpeg', 'New Zealand', 'Táo Fuji có vị ngọt đậm, giòn, bảo quản được lâu.', 'https://en.wikipedia.org/wiki/Gala_apple'),
(19, 'Chuối Cavendish', 40000, 'images/cavendish.jpg', 'Đông Nam Á', 'Chuối Cavendish phổ biến, giàu kali, tốt cho tim mạch.', 'https://en.wikipedia.org/wiki/Banana'),
(20, 'Cam Navel', 70000, 'images/camnavel.jpg', 'Địa Trung Hải', 'Cam Navel nhiều nước, vị ngọt, ít hạt.', 'https://en.wikipedia.org/wiki/Orange_(fruit)'),
(21, 'Cam Cara Cara', 110000, 'images/camcara.jpg', 'Venezuela', 'Cam ruột hồng, vị ngọt dịu, giàu vitamin C.', 'https://en.wikipedia.org/wiki/Cara_cara_orange'),
(22, 'Xoài Cát', 80000, 'images/xoaicat.png', 'Nam Á', 'Xoài cát thơm, thịt mịn, vị ngọt đậm.', 'https://en.wikipedia.org/wiki/Mango'),
(23, 'Cherry', 450000, 'images/cherry.jpg', 'Châu Âu', 'Cherry đỏ mọng, vị ngọt, giàu vitamin và khoáng chất.', 'https://en.wikipedia.org/wiki/Cherry'),
(24, 'Việt Quất', 380000, 'images/vietquat.jpg', 'Bắc Mỹ', 'Việt quất chứa nhiều chất chống oxy hóa, tốt cho trí não.', 'https://en.wikipedia.org/wiki/Blueberry'),
(25, 'Lựu Trung Đông', 160000, 'images/luutrungdong.png', 'Trung Đông', 'Lựu giàu chất chống oxy hóa, tốt cho tim mạch.', 'https://en.wikipedia.org/wiki/Pomegranate');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `role`) VALUES
(1, 'Anh', 'haunguyen@gmail.com', '$2y$10$.nDTkTs/LyjP33/VkUKA5.k5rti/gwjBeNnZ/5CXA4Vkrwxrp5Vt.', 'user'),
(2, 'Anh', 'quocanh@gmail.com', '$2y$10$nd5Fjk2VTm3JWqtu5e1HPuejuJ9wGdLELVHLLJSVqafZqupNusEyS', 'user'),
(5, 'Admin Name', 'admin@gmail.com', '$2y$10$7YPPy6Z2vil783VP7FLkpe9Eok66zNIOll7uKK8MJ5BahSq6wPz2e', 'admin');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_items_order` (`order_id`),
  ADD KEY `fk_order_items_product` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_order_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
