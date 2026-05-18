-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: sql305.infinityfree.com
-- Thời gian đã tạo: Th5 18, 2026 lúc 05:22 AM
-- Phiên bản máy phục vụ: 11.4.10-MariaDB
-- Phiên bản PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `if0_41585043_admin`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(255) NOT NULL,
  `GiaGoc` decimal(10,2) DEFAULT 0.00,
  `GiaBan` decimal(10,2) NOT NULL,
  `HinhAnh` varchar(255) DEFAULT NULL,
  `MaTH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `GiaGoc`, `GiaBan`, `HinhAnh`, `MaTH`) VALUES
(21, 'iPhone 15 Pro Max 256GB', '34990000.00', '29990000.00', 'iphone15pm.jpg', 1),
(23, 'iPhone 13 128GB', '15990000.00', '13590000.00', 'iphone13.jpg', 1),
(26, 'Samsung Galaxy A55 5G', '11490000.00', '9690000.00', 'samsung_a55.jpg', 2),
(27, 'OPPO Find N3 Flip', '24990000.00', '22990000.00', 'n3flip.jpg', 3),
(29, 'OPPO A78 256GB', '6990000.00', '6290000.00', 'oppo_a78.jpg', 3),
(30, 'Xiaomi 14 Ultra', '32990000.00', '29990000.00', 'xiaomi14u.jpg', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuonghieu`
--

CREATE TABLE `thuonghieu` (
  `MaTH` int(11) NOT NULL,
  `TenTH` varchar(100) NOT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `Website` varchar(100) DEFAULT NULL,
  `SoDienThoai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thuonghieu`
--

INSERT INTO `thuonghieu` (`MaTH`, `TenTH`, `DiaChi`, `Website`, `SoDienThoai`) VALUES
(1, 'iPhone', '1 Infinite Loop, Cupertino, CA, USA', 'https://www.apple.com/iphone', '+1 800 275 2273'),
(2, 'Samsung', 'Bitexco Financial Tower, Quận 1, TP.HCM', 'https://www.samsung.com ', '+82 2 2255 0114'),
(3, 'Oppo', '123 Nguyễn Trãi, Thanh Xuân, Hà Nội', 'https://www.oppo.com/vn', '+84 904567890'),
(4, 'Xiaomi', '456 Võ Văn Tần, Quận 3, TP.HCM', 'https://www.mi.com/vn', '+84 975678901');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '123', 1),
(2, 'nhanvien', '123', 2),
(3, 'khachhang', '123', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaTH` (`MaTH`);

--
-- Chỉ mục cho bảng `thuonghieu`
--
ALTER TABLE `thuonghieu`
  ADD PRIMARY KEY (`MaTH`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `thuonghieu`
--
ALTER TABLE `thuonghieu`
  MODIFY `MaTH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaTH`) REFERENCES `thuonghieu` (`MaTH`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
