-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 25, 2023 lúc 05:36 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopquanao`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cthanghoa`
--

CREATE TABLE `tbl_cthanghoa` (
  `idhanghoa` int(11) NOT NULL,
  `idmau` int(11) NOT NULL,
  `idsize` int(11) NOT NULL,
  `dongia` double(10,0) NOT NULL DEFAULT 0,
  `soluongton` int(11) NOT NULL,
  `hinh` varchar(255) NOT NULL,
  `giamgia` double(10,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cthanghoa`
--

INSERT INTO `tbl_cthanghoa` (`idhanghoa`, `idmau`, `idsize`, `dongia`, `soluongton`, `hinh`, `giamgia`) VALUES
(1, 3, 3, 200000, 100, 'sh7.jpg', 100000),
(2, 7, 2, 300000, 300, 'sh2.jpg', 100000),
(3, 5, 2, 120000, 100, 'sh11.jpg', 0),
(4, 2, 3, 300000, 100, 'sh12.jpg', 0),
(9, 9, 4, 300000, 100, 'p1.jpg', 0),
(10, 2, 4, 200000, 300, 'p4.jpg', 199000),
(11, 1, 2, 350000, 100, 'p7.jpg', 0),
(12, 1, 3, 250000, 100, 'p10.jpg', 200000),
(17, 1, 3, 230000, 100, 'sk1.jpg', 0),
(18, 4, 3, 200000, 300, 'sk11.jpg', 199000),
(19, 2, 2, 180000, 100, 'sk14.jpg', 0),
(21, 10, 2, 450000, 200, 'sk20.jpg', 400000),
(25, 3, 5, 500000, 200, 'd1.jpg', 0),
(26, 4, 3, 450000, 200, 'd5.jpg', 400000),
(28, 1, 2, 250000, 100, 'd11.jpg', 0),
(29, 3, 1, 300000, 300, 'd14.jpg', 290000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_hanghoa`
--

CREATE TABLE `tbl_hanghoa` (
  `mahh` int(11) NOT NULL,
  `tenhh` varchar(60) NOT NULL,
  `id_loai` int(11) NOT NULL,
  `dacbiet` tinyint(1) NOT NULL DEFAULT 0,
  `soluotxem` int(6) NOT NULL DEFAULT 0,
  `ngaylap` date NOT NULL DEFAULT curdate(),
  `mota` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_hanghoa`
--

INSERT INTO `tbl_hanghoa` (`mahh`, `tenhh`, `id_loai`, `dacbiet`, `soluotxem`, `ngaylap`, `mota`) VALUES
(1, 'Áo croptop', 1, 0, 0, '0000-00-00', 'Áo CROPTOP in hình gấu rút eo cực xinh, áo Croptop phong cách Hàn Quốc\r\nÁo style CROTOP sexy hình gấu rút eo xinh, cực tôn dáng'),
(2, 'Áo len', 1, 0, 0, '0000-00-00', 'Áo Len in hình gấu rút eo cực xinh, áo Croptop phong cách Hàn Quốc\r\nÁo style CROTOP sexy hình gấu rút eo xinh, cực tôn dáng'),
(3, 'Áo thun cổ tròn', 1, 0, 0, '0000-00-00', 'Áo CROPTOP in hình gấu rút eo cực xinh, áo Croptop phong cách Hàn Quốc\r\nÁo style CROTOP sexy hình gấu rút eo xinh, cực tôn dáng'),
(4, 'Áo thun cổ trái tim', 1, 0, 0, '0000-00-00', 'Áo CROPTOP in hình gấu rút eo cực xinh, áo Croptop phong cách Hàn Quốc\r\nÁo style CROTOP sexy hình gấu rút eo xinh, cực tôn dáng'),
(5, 'Áo Hoodie', 1, 0, 0, '0000-00-00', ''),
(6, 'Áo Sweater croptop', 1, 0, 0, '0000-00-00', ''),
(7, 'Áo Polo Kẻ Kim', 1, 0, 0, '0000-00-00', ''),
(8, 'Áo yếm croptop', 1, 0, 0, '0000-00-00', ''),
(9, 'Quần jean ống rộng', 2, 0, 0, '0000-00-00', NULL),
(10, 'Quần dài tim Hồng hai bên gối', 2, 0, 0, '0000-00-00', NULL),
(11, 'Quần yếm vải siêu cute, dễ thương', 2, 0, 0, '0000-00-00', NULL),
(12, 'Quần baggy jean thun ', 2, 0, 0, '0000-00-00', NULL),
(13, 'Quần kaki túi hộp kèm dây xích siêu truất', 2, 0, 0, '0000-00-00', NULL),
(14, 'Quần 1 sọc suông ', 2, 0, 0, '0000-00-00', NULL),
(15, 'Quần ống rộng Cullotes vải, cạp cao, dài suông', 2, 0, 0, '0000-00-00', NULL),
(16, 'Quần short kaki co giãn sắn gấu', 2, 0, 0, '0000-00-00', NULL),
(17, 'Chân váy ngắn chữ A, xẻ cạnh trơn', 3, 0, 0, '0000-00-00', NULL),
(18, 'Chân váy ren, xòe mềm', 3, 0, 0, '0000-00-00', NULL),
(19, 'Chân váy xếp ly lưng cao dáng ngắn ', 3, 0, 0, '0000-00-00', NULL),
(20, 'Chân váy lưới hai lớp dày mịn hot 2023', 3, 0, 0, '0000-00-00', NULL),
(21, 'Chân váy tennis trơn', 3, 0, 0, '0000-00-00', NULL),
(22, 'Chân váy caro xếp ly dáng xòe', 3, 0, 0, '0000-00-00', NULL),
(23, 'Chân váy nữ dáng dài ôm sát cơ thể tôn dáng', 3, 0, 0, '0000-00-00', NULL),
(24, 'Chân váy đuôi cá tà lệch caro', 3, 0, 0, '0000-00-00', NULL),
(25, 'Đầm suông chéo ngực thời trang', 4, 0, 0, '0000-00-00', NULL),
(26, 'Đầm váy sơ mi nút eo', 4, 0, 0, '0000-00-00', NULL),
(27, 'Đầm nữ dáng xòe họa tiết chất voan cao cấp', 4, 0, 0, '0000-00-00', NULL),
(28, 'Đầm sơ mi ôm body rút dây tay dài', 4, 0, 0, '0000-00-00', NULL),
(29, 'Đầm sọc caro đính nút tay dài kiểu trể vai', 4, 0, 0, '0000-00-00', NULL),
(30, 'Đầm xòe xếp ly đan dây ngực cổ vuông hot 2023', 4, 0, 0, '0000-00-00', NULL),
(31, 'Đầm UMI phối voan trễ vai bèo ', 4, 0, 0, '0000-00-00', NULL),
(32, 'Đầm nữ maxi tay bèo cổ vuông dáng xòe thiết kế', 4, 0, 0, '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_khachhang`
--

CREATE TABLE `tbl_khachhang` (
  `makh` int(11) NOT NULL,
  `tenkh` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `diachi` text DEFAULT NULL,
  `sodienthoai` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_khachhang`
--

INSERT INTO `tbl_khachhang` (`makh`, `tenkh`, `username`, `matkhau`, `email`, `diachi`, `sodienthoai`) VALUES
(1, 'tú trần', 'tutran', '8f8e2909a8f683c31159ee51d593a642', 'tu@gmail.com', 'hcm', '9090789678'),
(2, 'minh minh', 'minhminh', '8f8e2909a8f683c31159ee51d593a642', 'minh@gmail.com', 'bình định', '90907896789'),
(3, 'teo', 'teoteo', '3ff19fad9f5844248f601ab23381cc88', 'teo123@gmail.com', 'hcm', '9090789698'),
(4, 'ý nhi', 'nhinhi', '87f038af05196e3dfa958a521f6f400e', 'ngvynhi.itc@gmail.com', 'thoại ngọc hầu', '9090789699'),
(5, 'tran thi thu', 'hanghang', '5320cf35653f1c06b303424eec637b2d', 'user@gmail.com', '324, Hoàng Sa, Quận 3', '023 4546 466');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_mausac`
--

CREATE TABLE `tbl_mausac` (
  `Idmau` int(11) NOT NULL,
  `mausac` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_mausac`
--

INSERT INTO `tbl_mausac` (`Idmau`, `mausac`) VALUES
(1, 'màu đen'),
(2, 'màu trắng'),
(3, 'màu be'),
(4, 'màu hồng'),
(5, 'màu vàng'),
(6, 'màu xanh lá pastel'),
(7, 'màu hồng nhạt'),
(8, 'màu xám'),
(9, 'màu xanh đen'),
(10, 'màu đỏ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `idmenu` int(11) NOT NULL,
  `tenmenu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_menu`
--

INSERT INTO `tbl_menu` (`idmenu`, `tenmenu`) VALUES
(1, 'Trang Chủ'),
(2, 'Cửa Hàng'),
(3, 'Blog'),
(4, 'Giới Thiệu'),
(5, 'Liên Hệ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_size`
--

CREATE TABLE `tbl_size` (
  `Idsize` int(11) NOT NULL,
  `size` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_size`
--

INSERT INTO `tbl_size` (`Idsize`, `size`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_loai`
--

CREATE TABLE `tb_loai` (
  `id_loai` int(6) NOT NULL,
  `tenloai` varchar(50) NOT NULL,
  `idmenu` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tb_loai`
--

INSERT INTO `tb_loai` (`id_loai`, `tenloai`, `idmenu`) VALUES
(1, 'Áo nữ', 2),
(2, 'Quần nữ', 2),
(3, 'Chân váy nữ', 2),
(4, 'Đầm nữ', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_cthanghoa`
--
ALTER TABLE `tbl_cthanghoa`
  ADD PRIMARY KEY (`idhanghoa`,`idmau`,`idsize`),
  ADD KEY `idmau` (`idmau`),
  ADD KEY `idsize` (`idsize`);

--
-- Chỉ mục cho bảng `tbl_hanghoa`
--
ALTER TABLE `tbl_hanghoa`
  ADD PRIMARY KEY (`mahh`),
  ADD KEY `maloai` (`id_loai`);

--
-- Chỉ mục cho bảng `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  ADD PRIMARY KEY (`makh`);

--
-- Chỉ mục cho bảng `tbl_mausac`
--
ALTER TABLE `tbl_mausac`
  ADD PRIMARY KEY (`Idmau`);

--
-- Chỉ mục cho bảng `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Chỉ mục cho bảng `tbl_size`
--
ALTER TABLE `tbl_size`
  ADD PRIMARY KEY (`Idsize`);

--
-- Chỉ mục cho bảng `tb_loai`
--
ALTER TABLE `tb_loai`
  ADD PRIMARY KEY (`id_loai`),
  ADD KEY `fk_loai_menu` (`idmenu`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_hanghoa`
--
ALTER TABLE `tbl_hanghoa`
  MODIFY `mahh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  MODIFY `makh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_mausac`
--
ALTER TABLE `tbl_mausac`
  MODIFY `Idmau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_size`
--
ALTER TABLE `tbl_size`
  MODIFY `Idsize` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tb_loai`
--
ALTER TABLE `tb_loai`
  MODIFY `id_loai` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cthanghoa`
--
ALTER TABLE `tbl_cthanghoa`
  ADD CONSTRAINT `tbl_cthanghoa_ibfk_1` FOREIGN KEY (`idhanghoa`) REFERENCES `tbl_hanghoa` (`mahh`),
  ADD CONSTRAINT `tbl_cthanghoa_ibfk_2` FOREIGN KEY (`idmau`) REFERENCES `tbl_mausac` (`Idmau`),
  ADD CONSTRAINT `tbl_cthanghoa_ibfk_3` FOREIGN KEY (`idsize`) REFERENCES `tbl_size` (`Idsize`);

--
-- Các ràng buộc cho bảng `tbl_hanghoa`
--
ALTER TABLE `tbl_hanghoa`
  ADD CONSTRAINT `tbl_hanghoa_ibfk_1` FOREIGN KEY (`id_loai`) REFERENCES `tb_loai` (`id_loai`);

--
-- Các ràng buộc cho bảng `tb_loai`
--
ALTER TABLE `tb_loai`
  ADD CONSTRAINT `fk_loai_menu` FOREIGN KEY (`idmenu`) REFERENCES `tbl_menu` (`idmenu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
