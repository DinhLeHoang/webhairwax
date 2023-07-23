-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 18, 2023 lúc 09:55 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_sap2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`account_id`, `username`, `password`, `role_id`, `status`, `create_date`) VALUES
(7, 'truonsinh', '0123456789', 0, 1, '2023-05-01'),
(8, 'ManagerTest', '123456', 3, 1, '2023-05-01'),
(9, 'StaffTest', '123456', 2, 1, '2023-05-01'),
(10, 'TestBlocked', '123456', 0, 0, '2023-05-07'),
(12, 'admin', '123456', 1, 1, '2023-05-07'),
(13, 'abc', 'abc', 0, 1, '2023-05-15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `ma_don_hang` int(11) DEFAULT NULL,
  `id_sanpham` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `don_gia` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`ma_don_hang`, `id_sanpham`, `size`, `so_luong`, `don_gia`) VALUES
(1, 4, 39, 3, 900000),
(1, 8, 40, 2, 900000),
(6, 7, 39, 2, 900000),
(6, 12, 40, 1, 900000),
(46, 3, 39, 1, 900000),
(47, 10, 41, 1, 900000),
(81, 8, 40, 3, 900000),
(81, 2, 41, 1, 600000),
(87, 8, 0, 1, 900000),
(88, 4, 0, 2, 900000),
(88, 3, 0, 3, 900000),
(89, 4, 0, 2, 900000),
(89, 3, 0, 3, 900000),
(89, 2, 0, 1, 900000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_gio_hang`
--

CREATE TABLE `chi_tiet_gio_hang` (
  `id_gio_hang` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `so_luong` int(30) DEFAULT NULL,
  `ngay_gio_them_vao_gio` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_gio_hang`
--

INSERT INTO `chi_tiet_gio_hang` (`id_gio_hang`, `id_sanpham`, `size`, `so_luong`, `ngay_gio_them_vao_gio`) VALUES
(71, 4, 0, 2, '2023-05-15 13:13:29'),
(72, 3, 0, 3, '2023-05-15 15:30:35'),
(73, 2, 0, 1, '2023-05-15 15:38:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_nhap_kho`
--

CREATE TABLE `chi_tiet_nhap_kho` (
  `ma_nhap_kho` int(11) DEFAULT NULL,
  `id_sanpham` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `so_luong_cua_size` int(30) DEFAULT NULL,
  `don_gia` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_nhap_kho`
--

INSERT INTO `chi_tiet_nhap_kho` (`ma_nhap_kho`, `id_sanpham`, `size`, `so_luong_cua_size`, `don_gia`) VALUES
(6, 3, 40, 3, 900000),
(6, 5, 39, 3, 900000),
(9, 8, 39, 10, 900000),
(10, 10, 40, 5, 900000),
(11, 13, 39, 4, 1000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_xuat_kho`
--

CREATE TABLE `chi_tiet_xuat_kho` (
  `ma_xuat_kho` int(11) DEFAULT NULL,
  `id_sanpham` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `so_luong_cua_size` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_xuat_kho`
--

INSERT INTO `chi_tiet_xuat_kho` (`ma_xuat_kho`, `id_sanpham`, `size`, `so_luong_cua_size`) VALUES
(1, 2, 39, 10),
(1, 3, 40, 9),
(2, 2, 39, 10),
(2, 3, 39, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `ma_don_hang` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tong_tien` int(50) DEFAULT NULL,
  `ngay_gio_thanh_toan` varchar(100) DEFAULT NULL,
  `tinh_trang` varchar(50) NOT NULL,
  `ten_nguoinhan` varchar(50) NOT NULL,
  `sdt_nguoinhan` varchar(50) NOT NULL,
  `diachi_giaohang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`ma_don_hang`, `user_id`, `tong_tien`, `ngay_gio_thanh_toan`, `tinh_trang`, `ten_nguoinhan`, `sdt_nguoinhan`, `diachi_giaohang`) VALUES
(1, 9, 4500000, '2022-09-13 13:41:47', 'Shipped', 'Hồng Quý Văn', '0923683724', '1506/4 vo van kiet'),
(6, 9, 2700000, '2022-09-15 21:42:53', 'Shipped', 'Hồng Quý Văn', '0909696182', 'sbdkjsaj'),
(46, 9, 2700000, '', 'Processing', '', '', ''),
(47, 9, 900000, '', 'Processing', '', '', ''),
(81, 9, 3300000, '2022-10-16 13:21:09', 'Shipped', 'sadasda', '0920939', 'dasdsadas'),
(87, 9, 900000, '', 'Processing', '', '', ''),
(88, 9, 4500000, '', 'Processing', '', '', ''),
(89, 9, 5400000, '', 'Processing', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `function`
--

CREATE TABLE `function` (
  `func_id` int(11) NOT NULL,
  `func_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `function`
--

INSERT INTO `function` (`func_id`, `func_name`) VALUES
(1, 'Thêm sản phẩm'),
(2, 'Quản lí tài khoản'),
(3, 'Thông tin đơn hàng'),
(4, 'Thống kê'),
(5, 'Quản lý phân quyền');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `func_role`
--

CREATE TABLE `func_role` (
  `role_id` int(11) NOT NULL,
  `func_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `func_role`
--

INSERT INTO `func_role` (`role_id`, `func_id`, `status`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 0),
(1, 4, 0),
(1, 5, 1),
(2, 1, 1),
(2, 2, 0),
(2, 3, 1),
(2, 4, 0),
(2, 5, 0),
(3, 1, 1),
(3, 2, 1),
(3, 3, 1),
(3, 4, 1),
(3, 5, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id_gio_hang` int(11) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `gio_hang`
--

INSERT INTO `gio_hang` (`id_gio_hang`, `user_id`) VALUES
(71, 9),
(72, 9),
(73, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kich_co`
--

CREATE TABLE `kich_co` (
  `id_sanpham` int(11) NOT NULL,
  `size` varchar(150) DEFAULT NULL,
  `so_luong_ton_kho_ban` int(50) DEFAULT NULL,
  `so_luong_ton_kho_tong` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `kich_co`
--

INSERT INTO `kich_co` (`id_sanpham`, `size`, `so_luong_ton_kho_ban`, `so_luong_ton_kho_tong`) VALUES
(2, 'M', 99, 280),
(2, 'L', 99, 300),
(2, 'XL', 99, 400),
(3, 'M', 94, 300),
(3, 'L', 94, 294),
(3, 'XL', 94, 400),
(4, 'M', 96, 300),
(4, 'L', 96, 300),
(4, 'XL', 96, 400),
(5, 'M', 100, 303),
(5, 'L', 100, 300),
(5, 'XL', 100, 400),
(6, 'M', 100, 300),
(6, 'L', 100, 300),
(6, 'XL', 100, 400),
(8, 'M', 99, 310),
(8, 'L', 99, 300),
(8, 'XL', 99, 400),
(9, 'M', 100, 300),
(9, 'L', 100, 300),
(9, 'XL', 100, 400),
(10, 'M', 100, 300),
(10, '40', 100, 305),
(10, '41', 100, 400),
(11, 'M', 100, 300),
(11, 'M', 100, 300),
(11, '41', 100, 400),
(12, 'M', 100, 300),
(12, 'M', 100, 300),
(12, '41', 100, 400),
(13, '39', 100, 304),
(13, 'M', 100, 300),
(13, '41', 100, 400),
(18, 'L', 80, 80),
(20, 'M', 12, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhap_kho`
--

CREATE TABLE `nhap_kho` (
  `ma_nhap_kho` int(11) NOT NULL,
  `ma_nha_cung_cap` int(11) DEFAULT NULL,
  `ngay_gio_nhap_kho` varchar(100) DEFAULT NULL,
  `so_luong_hang_nhap` int(30) DEFAULT NULL,
  `tong_tien_nhap_kho` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhap_kho`
--

INSERT INTO `nhap_kho` (`ma_nhap_kho`, `ma_nha_cung_cap`, `ngay_gio_nhap_kho`, `so_luong_hang_nhap`, `tong_tien_nhap_kho`) VALUES
(6, 1, '2022-10-07 17:39:32', 6, 5400000),
(9, 2, '2022-10-16 15:51:28', 10, 9000000),
(10, 3, '2022-10-16 15:52:56', 5, 4500000),
(11, 3, '2022-10-16 15:53:35', 4, 4000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nha_cung_cap`
--

CREATE TABLE `nha_cung_cap` (
  `ma_nha_cung_cap` int(11) NOT NULL,
  `ten_nha_cung_cap` varchar(150) DEFAULT NULL,
  `dia_chi` varchar(200) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nha_cung_cap`
--

INSERT INTO `nha_cung_cap` (`ma_nha_cung_cap`, `ten_nha_cung_cap`, `dia_chi`, `sdt`) VALUES
(1, 'MorrisMotley', '65 abcxyz defgh', '8398129'),
(2, 'Osis', '66 abcxyz defgh', '8398129'),
(3, 'KenvinMurphy', '67 abcxyz defgh', '8398129');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(0, 'guest'),
(1, 'admin'),
(2, 'staff'),
(3, 'manager');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id_sanpham` int(11) NOT NULL,
  `ma_nha_cung_cap` int(11) NOT NULL,
  `ten` varchar(150) DEFAULT NULL,
  `phan_loai` varchar(100) DEFAULT NULL,
  `don_gia` int(50) DEFAULT NULL,
  `hinh1` varchar(100) DEFAULT NULL,
  `hinh2` varchar(100) DEFAULT NULL,
  `hinh3` varchar(100) DEFAULT NULL,
  `mo_ta` varchar(300) DEFAULT NULL,
  `so_luong_ton_kho_ban` int(50) DEFAULT NULL,
  `so_luong_ton_kho_tong` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id_sanpham`, `ma_nha_cung_cap`, `ten`, `phan_loai`, `don_gia`, `hinh1`, `hinh2`, `hinh3`, `mo_ta`, `so_luong_ton_kho_ban`, `so_luong_ton_kho_tong`) VALUES
(2, 1, 'Morris Motley Chrome', 'Thể thao', 900000, 'img/MorrisMotley/sap-vuot-toc-nam-morris-motley-treatment-styling-balm.jpg', 'img/MorrisMotley/morris-motley-treatment-styling-balm-sap-vuot-toc-nam-cao-cap-den-tu-uc-1-300x300-1', 'img/MorrisMotley/sap-vuot-toc-nam-morris-motley-chrome-1.jpg', 'Sản phẩm luôn thuộc vào một trong những thương hiệu thời trang hàng đầu được thiết kế vô cùng trẻ trung và năng động. Với kiểu dáng gọn gàng, màu sắc cá tính và kiểu dáng thanh thoát các dòng sản phẩm luôn giữ cho mình một sức hút riêng. Sự mạnh mẽ vốn có', 298, 980),
(3, 1, 'Morris Motley Pomade', 'Wax', 900000, 'img/MorrisMotley/41iUefDTJL.jpg', 'img/MorrisMotley/1596537740-morris-motley-strong-matte-styling-balm-02.jpg', 'img/MorrisMotley/morris_motley_hair_styling_pom_1608131467_55ba56c6_progressive.jpg', 'Sản phẩm luôn thuộc vào một trong những thương hiệu thời trang hàng đầu được thiết kế vô cùng trẻ trung và năng động. Với kiểu dáng gọn gàng, màu sắc cá tính và kiểu dáng thanh thoát các dòng sản phẩm luôn giữ cho mình một sức hút riêng. Sự mạnh mẽ vốn có', 294, 994),
(4, 1, 'Morris Motley Shampoo', 'Shampoo', 900000, 'img/MorrisMotley/7a4875e72a9c9ff3ceeaf142919cfd23.jpg', 'img/MorrisMotley/Morris-Motley-Clay-Conditioning-Shampoo-1.jpg', 'img/MorrisMotley/web6.jpg', 'Sản phẩm luôn thuộc vào một trong những thương hiệu thời trang hàng đầu được thiết kế vô cùng trẻ trung và năng động. Với kiểu dáng gọn gàng, màu sắc cá tính và kiểu dáng thanh thoát các dòng sản phẩm luôn giữ cho mình một sức hút riêng. Sự mạnh mẽ vốn có', 296, 1000),
(5, 1, 'Morris Motley Cleansing Oil', 'Shampoo', 900000, 'img/MorrisMotley/dau-goi-nam-morris-motley-treatment-cleansing-oil-1-1.jpg', 'img/MorrisMotley/IMG_8178-e1505663224158-scaled.jpg', 'img/MorrisMotley/dau-goi-nam-morris-motley-treatment-cleansing-oil-2-1.jpg', 'Sản phẩm luôn thuộc vào một trong những thương hiệu thời trang hàng đầu được thiết kế vô cùng trẻ trung và năng động. Với kiểu dáng gọn gàng, màu sắc cá tính và kiểu dáng thanh thoát các dòng sản phẩm luôn giữ cho mình một sức hút riêng. Sự mạnh mẽ vốn có', 300, 1003),
(6, 2, 'Osis Thrill 3', 'Sáp', 900000, 'img/Osis/vhOyDrgRfX9J4OTPeUC3.jpg', 'img/Osis/dcd78d09a3e8c3cd13e202607d9bcd88.jpg', 'img/Osis/Sap-vuot-toc-nam-osis-thrill-3-100ml-cao-cap-100ml-710x710.jpg', 'Sản phẩm luôn thuộc vào một trong những thương hiệu thời trang hàng đầu được thiết kế vô cùng trẻ trung và năng động. Với kiểu dáng gọn gàng, màu sắc cá tính và kiểu dáng thanh thoát các dòng sản phẩm luôn giữ cho mình một sức hút riêng. Sự mạnh mẽ vốn có', 300, 1000),
(8, 2, 'Osis +', 'Sáp', 900000, 'img/Osis/SÁP-VUỐT-TÓC-NAM-OSIS-THRILL-3-1-510x510.jpg', 'img/Osis/sg-11134201-23020-g8azcj2svinv4f_tn.jpg', 'img/Osis/sg-11134201-22120-3txrr4lsfmlvdc.jpg', 'Sản phẩm luôn thuộc vào một trong những thương hiệu thời trang hàng đầu được thiết kế vô cùng trẻ trung và năng động. Với kiểu dáng gọn gàng, màu sắc cá tính và kiểu dáng thanh thoát các dòng sản phẩm luôn giữ cho mình một sức hút riêng. Sự mạnh mẽ vốn có', 296, 1010),
(9, 2, 'Osis Dust It', 'Sáp', 1500000, 'img/Osis/bot-tao-phong-OSIS-dust-it.jpg', 'img/Osis/images.jpg', 'img/Osis/Schwarzkopf-Professional-OSiS-Dust-It-Mattifying-Powder3-FILEminimizer-1200x1200.jpg', 'Sản phẩm luôn thuộc vào một trong những thương hiệu thời trang hàng đầu được thiết kế vô cùng trẻ trung và năng động. Với kiểu dáng gọn gàng, màu sắc cá tính và kiểu dáng thanh thoát các dòng sản phẩm luôn giữ cho mình một sức hút riêng. Sự mạnh mẽ vốn có', 300, 1000),
(10, 3, 'Kenvin Murphy Rough Rider', 'Sáp', 900000, 'img/KenvinMurphy/123123123123-e1626508675603.jpg', 'img/KenvinMurphy/kevin-murphy-rough-rider-03.jpg', 'img/KenvinMurphy/vnpomade-20180304122550n.jpg', 'Sản phẩm luôn thuộc vào một trong những thương hiệu thời trang hàng đầu được thiết kế vô cùng trẻ trung và năng động. Với kiểu dáng gọn gàng, màu sắc cá tính và kiểu dáng thanh thoát các dòng sản phẩm luôn giữ cho mình một sức hút riêng. Sự mạnh mẽ vốn có', 300, 1005),
(11, 3, 'Kenvin Murphy Hydrate', 'Sáp', 900000, 'img/KenvinMurphy/HMW_website.jpg', 'img/KenvinMurphy/ScreenShot2022-02-24at4.44.51PM.jpg', 'img/KenvinMurphy/1611468732.442981568523.jpg', 'Sản phẩm luôn thuộc vào một trong những thương hiệu thời trang hàng đầu được thiết kế vô cùng trẻ trung và năng động. Với kiểu dáng gọn gàng, màu sắc cá tính và kiểu dáng thanh thoát các dòng sản phẩm luôn giữ cho mình một sức hút riêng. Sự mạnh mẽ vốn có', 300, 1000),
(12, 3, 'Kenvin Murphy Plumping', 'Shampoo', 900000, 'img/KenvinMurphy/kevin-murphy-plumping-paket-1462-911-0500_1.jpg', 'img/KenvinMurphy/81p5uEXT+CL._AC_SL1500_.jpg', 'img/KenvinMurphy/images.jpg', 'Sản phẩm luôn thuộc vào một trong những thương hiệu thời trang hàng đầu được thiết kế vô cùng trẻ trung và năng động. Với kiểu dáng gọn gàng, màu sắc cá tính và kiểu dáng thanh thoát các dòng sản phẩm luôn giữ cho mình một sức hút riêng. Sự mạnh mẽ vốn có', 300, 1000),
(13, 3, 'Kenvin Murphy Fresh Hair', 'Sáp', 1000000, 'img/KenvinMurphy/BB_website.jpg', 'img/KenvinMurphy/1618519674.540682641749.jpg', 'img/KenvinMurphy/1629452761.644636475380.jpg', 'Sản phẩm luôn thuộc vào một trong những thương hiệu thời trang hàng đầu được thiết kế vô cùng trẻ trung và năng động. Với kiểu dáng gọn gàng, màu sắc cá tính và kiểu dáng thanh thoát các dòng sản phẩm luôn giữ cho mình một sức hút riêng. Sự mạnh mẽ vốn có', 300, 1004),
(18, 2, 'test', 'Sáp', 67000, 'img/Osis/Sap-vuot-toc-nam-osis-thrill-3-100ml-cao-cap-100ml-710x710.jpg', 'img/Osis/sg-11134201-22120-3txrr4lsfmlvdc.jpg', 'img/Osis/1dbbf96c4fd4ee411574f70c76ff6889_tn.jpg', 'testtttttttttttttt', 80, 80),
(20, 1, 'Test vip', 'Sáp', 123, 'img/MorrisMotley/download.jpg', 'img/MorrisMotley/usericon.png', 'img/MorrisMotley/kevin-murphy-logo.jpg', 'KaAK', 12, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `email`, `pass`, `sdt`, `role`) VALUES
(9, '123@gmail.com', '123456', '0909090909', 'guest'),
(11, 'admin@gmail.com', '123456', '0902664256', 'admin'),
(13, 'adminkho@gmail.com', '123456', '0589345983', 'kho'),
(18, 'huhu@gmail.com', '123456', '123456', 'admin'),
(19, '111@gmail.com', '123456', '123', 'guest');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_new`
--

CREATE TABLE `user_new` (
  `user_id` int(11) NOT NULL,
  `user_key` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user_new`
--

INSERT INTO `user_new` (`user_id`, `user_key`, `name`, `address`, `phone`, `email`) VALUES
(9, 'truonsinh', 'Trường Sinh', 'Q12', '0312378945', 'b@gmail.com'),
(11, 'admin', 'Lê Hoàng An Đình', '63/3', '01234567', 'a@gmail.com'),
(12, 'abc', 'abc', 'abc', '0312345678', 'abc@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xuat_kho`
--

CREATE TABLE `xuat_kho` (
  `ma_xuat_kho` int(11) NOT NULL,
  `so_luong_xuat_kho` int(30) DEFAULT NULL,
  `ngay_gio_xuat_kho` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `xuat_kho`
--

INSERT INTO `xuat_kho` (`ma_xuat_kho`, `so_luong_xuat_kho`, `ngay_gio_xuat_kho`) VALUES
(1, 19, '2022-10-16 14:57:40'),
(2, 20, '2022-10-16 17:36:09');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `role` (`role_id`);

--
-- Chỉ mục cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD KEY `ma_don_hang` (`ma_don_hang`);

--
-- Chỉ mục cho bảng `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD PRIMARY KEY (`id_gio_hang`,`id_sanpham`),
  ADD KEY `id_gio_hang` (`id_gio_hang`,`id_sanpham`);

--
-- Chỉ mục cho bảng `chi_tiet_nhap_kho`
--
ALTER TABLE `chi_tiet_nhap_kho`
  ADD KEY `ma_nhap_kho` (`ma_nhap_kho`);

--
-- Chỉ mục cho bảng `chi_tiet_xuat_kho`
--
ALTER TABLE `chi_tiet_xuat_kho`
  ADD KEY `ma_xuat_kho` (`ma_xuat_kho`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`ma_don_hang`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `function`
--
ALTER TABLE `function`
  ADD PRIMARY KEY (`func_id`);

--
-- Chỉ mục cho bảng `func_role`
--
ALTER TABLE `func_role`
  ADD PRIMARY KEY (`role_id`,`func_id`),
  ADD KEY `func_id` (`func_id`);

--
-- Chỉ mục cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id_gio_hang`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `kich_co`
--
ALTER TABLE `kich_co`
  ADD KEY `id_giay` (`id_sanpham`);

--
-- Chỉ mục cho bảng `nhap_kho`
--
ALTER TABLE `nhap_kho`
  ADD PRIMARY KEY (`ma_nhap_kho`),
  ADD KEY `ma_nha_cung_cap` (`ma_nha_cung_cap`);

--
-- Chỉ mục cho bảng `nha_cung_cap`
--
ALTER TABLE `nha_cung_cap`
  ADD PRIMARY KEY (`ma_nha_cung_cap`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_sanpham`),
  ADD KEY `ma_nha_cung_cap` (`ma_nha_cung_cap`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `user_new`
--
ALTER TABLE `user_new`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `a` (`user_key`);

--
-- Chỉ mục cho bảng `xuat_kho`
--
ALTER TABLE `xuat_kho`
  ADD PRIMARY KEY (`ma_xuat_kho`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `ma_don_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id_gio_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT cho bảng `nhap_kho`
--
ALTER TABLE `nhap_kho`
  MODIFY `ma_nhap_kho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `nha_cung_cap`
--
ALTER TABLE `nha_cung_cap`
  MODIFY `ma_nha_cung_cap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_sanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `user_new`
--
ALTER TABLE `user_new`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `xuat_kho`
--
ALTER TABLE `xuat_kho`
  MODIFY `ma_xuat_kho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Các ràng buộc cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`ma_don_hang`) REFERENCES `don_hang` (`ma_don_hang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD CONSTRAINT `chi_tiet_gio_hang_ibfk_1` FOREIGN KEY (`id_gio_hang`) REFERENCES `gio_hang` (`id_gio_hang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chi_tiet_nhap_kho`
--
ALTER TABLE `chi_tiet_nhap_kho`
  ADD CONSTRAINT `chi_tiet_nhap_kho_ibfk_2` FOREIGN KEY (`ma_nhap_kho`) REFERENCES `nhap_kho` (`ma_nhap_kho`);

--
-- Các ràng buộc cho bảng `chi_tiet_xuat_kho`
--
ALTER TABLE `chi_tiet_xuat_kho`
  ADD CONSTRAINT `chi_tiet_xuat_kho_ibfk_2` FOREIGN KEY (`ma_xuat_kho`) REFERENCES `xuat_kho` (`ma_xuat_kho`);

--
-- Các ràng buộc cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_new` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `func_role`
--
ALTER TABLE `func_role`
  ADD CONSTRAINT `func_role_ibfk_1` FOREIGN KEY (`func_id`) REFERENCES `function` (`func_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `func_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_new` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `kich_co`
--
ALTER TABLE `kich_co`
  ADD CONSTRAINT `kich_co_ibfk_1` FOREIGN KEY (`id_sanpham`) REFERENCES `sanpham` (`id_sanpham`);

--
-- Các ràng buộc cho bảng `nhap_kho`
--
ALTER TABLE `nhap_kho`
  ADD CONSTRAINT `nhap_kho_ibfk_1` FOREIGN KEY (`ma_nha_cung_cap`) REFERENCES `nha_cung_cap` (`ma_nha_cung_cap`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`ma_nha_cung_cap`) REFERENCES `nha_cung_cap` (`ma_nha_cung_cap`);

--
-- Các ràng buộc cho bảng `user_new`
--
ALTER TABLE `user_new`
  ADD CONSTRAINT `user_new_ibfk_1` FOREIGN KEY (`user_key`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
