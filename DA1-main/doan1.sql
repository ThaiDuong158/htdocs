-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 05:28 AM
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
-- Database: `doan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Useradmin` varchar(20) NOT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Mail` varchar(50) DEFAULT NULL,
  `SDT` varchar(10) DEFAULT NULL,
  `HoTen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Useradmin`, `Password`, `Mail`, `SDT`, `HoTen`) VALUES
('admin1', '1', 'admin1@ad.vlute.edu.vn', '0937483927', 'admin1'),
('admin2', '2', 'admin2@ad.vlute.edu.vn', '0937483927', 'admin2'),
('admin3', '3', 'admin3@ad.vlute.edu.vn', '0937483927', 'admin3'),
('admin4', '4', 'admin4@ad.vlute.edu.vn', '0937483927', 'admin4'),
('admin5', '5', 'admin5@ad.vlute.edu.vn', '0937483927', 'admin5');

-- --------------------------------------------------------

--
-- Table structure for table `baikiemtra`
--

CREATE TABLE `baikiemtra` (
  `MaBaiKiemTra` varchar(8) NOT NULL,
  `MaSV` varchar(8) DEFAULT NULL,
  `NgayKiemTRa` datetime DEFAULT NULL,
  `Mamon` varchar(8) DEFAULT NULL,
  `LoaiBaiKiemTra` varchar(50) DEFAULT NULL,
  `FileBaiLam` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baikiemtra`
--

INSERT INTO `baikiemtra` (`MaBaiKiemTra`, `MaSV`, `NgayKiemTRa`, `Mamon`, `LoaiBaiKiemTra`, `FileBaiLam`) VALUES
('BKT001', '21004276', '2023-10-26 00:00:00', 'TH1314', 'Kiểm tra 15 phút', NULL),
('BKT002', '21004276', '2023-11-15 00:00:00', 'TH1316', 'Kiểm tra giữa kỳ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diemdanh`
--

CREATE TABLE `diemdanh` (
  `MaDiemDanh` varchar(8) NOT NULL,
  `NgayDiemDanh` datetime DEFAULT NULL,
  `MaSV` varchar(8) DEFAULT NULL,
  `MaGV` varchar(8) DEFAULT NULL,
  `TrangThai` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diemdanh`
--

INSERT INTO `diemdanh` (`MaDiemDanh`, `NgayDiemDanh`, `MaSV`, `MaGV`, `TrangThai`) VALUES
('DD001', '2023-10-25 00:00:00', '21004276', 'GV00004', 'Có mặt'),
('DD002', '2023-11-14 00:00:00', '21004276', 'GV00004', 'Vắng');

-- --------------------------------------------------------

--
-- Table structure for table `diemkiemtra`
--

CREATE TABLE `diemkiemtra` (
  `MaDiem` varchar(8) NOT NULL,
  `MaSV` varchar(8) DEFAULT NULL,
  `MaMon` varchar(8) NOT NULL,
  `MaHK` varchar(8) NOT NULL,
  `DiemCC` float DEFAULT NULL,
  `DiemGK` float DEFAULT NULL,
  `DiemCK` float DEFAULT NULL,
  `DiemTong` float DEFAULT NULL,
  `DiemChu` varchar(1) NOT NULL,
  `DiemHeSo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diemkiemtra`
--

INSERT INTO `diemkiemtra` (`MaDiem`, `MaSV`, `MaMon`, `MaHK`, `DiemCC`, `DiemGK`, `DiemCK`, `DiemTong`, `DiemChu`, `DiemHeSo`) VALUES
('D0001', '21004276', 'TH1314', 'HK12023', 9, 8, 7, 7.5, 'B', 3),
('D0002', '21004276', 'TH1507', 'HK12023', 8, 6, 8, 7.4, 'B', 3),
('D0003', '21004276', 'TH1316', 'HK12023', 5, 7, 9, 8, 'B', 3);

-- --------------------------------------------------------

--
-- Table structure for table `giangvien`
--

CREATE TABLE `giangvien` (
  `MaGV` varchar(8) NOT NULL,
  `TenGV` varchar(50) DEFAULT NULL,
  `SoDienThoai` varchar(50) DEFAULT NULL,
  `Mail` varchar(50) DEFAULT NULL,
  `Chucvu` varchar(50) DEFAULT NULL,
  `Makhoa` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `giangvien`
--

INSERT INTO `giangvien` (`MaGV`, `TenGV`, `SoDienThoai`, `Mail`, `Chucvu`, `Makhoa`) VALUES
('GV00001', 'Lê Thị Hạnh Hiền', '0972937841', 'hienlth@vlute.edu.vn', 'Cố vấn học tập', 'CNTT'),
('GV00002', 'Phan Anh Cang', '0972937841', 'cangpa@vlute.edu.vn', 'Trưởng khoa', 'CNTT'),
('GV00003', 'Đào Thị Trúc Mai', '0972937841', 'maidtt@vlute.edu.vn', 'Giáo viên quản lý', 'CNTT'),
('GV00004', 'Trần Thị Kim Ngân', '0972937841', 'nganttk@vlute.edu.vn', 'Giảng Viên Môn', 'CNTT'),
('GV00005', 'Trần thái bảo', '0972937841', 'baott@vlute.edu.vn', 'Giảng Viên Môn', 'CNTT'),
('GV00006', 'Nguyễn Vạn Năng', '0972937841', 'nangnv@vlute.edu.vn', 'Giảng Viên Môn', 'CNTT');

-- --------------------------------------------------------

--
-- Table structure for table `hocki`
--

CREATE TABLE `hocki` (
  `MaHK` varchar(8) NOT NULL,
  `TenHK` varchar(50) DEFAULT NULL,
  `NamHoc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hocki`
--

INSERT INTO `hocki` (`MaHK`, `TenHK`, `NamHoc`) VALUES
('HK12023', 'Học kỳ 1', 2023),
('HK22023', 'Học kỳ 2', 2023);

-- --------------------------------------------------------

--
-- Table structure for table `hocphi`
--

CREATE TABLE `hocphi` (
  `MaMon` varchar(8) NOT NULL,
  `SoTien` int(11) DEFAULT NULL,
  `MaSV` varchar(8) NOT NULL,
  `TrangThai` varchar(50) DEFAULT NULL,
  `MaHK` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hocphi`
--

INSERT INTO `hocphi` (`MaMon`, `SoTien`, `MaSV`, `TrangThai`, `MaHK`) VALUES
('TH1314', 500000, '21004276', 'Đã thanh toán', 'HK12023'),
('TH1316', 600000, '21004276', 'Đã thanh toán', 'HK12023');

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `Makhoa` varchar(8) NOT NULL,
  `TenKhoa` varchar(50) DEFAULT NULL,
  `MaVanPhongKhoa` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`Makhoa`, `TenKhoa`, `MaVanPhongKhoa`) VALUES
('CNTT', 'Khoa Công nghệ thông tin', 'A203');

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `malop` varchar(8) NOT NULL,
  `TenLop` varchar(50) DEFAULT NULL,
  `CVHT` varchar(8) DEFAULT NULL,
  `GVQL` varchar(8) DEFAULT NULL,
  `MaKhoa` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`malop`, `TenLop`, `CVHT`, `GVQL`, `MaKhoa`) VALUES
('1CTT21A3', 'ĐH Công nghệ thông tin 2021 (Lớp 3)', 'GV00001', 'GV00003', 'CNTT');

-- --------------------------------------------------------

--
-- Table structure for table `lophp`
--

CREATE TABLE `lophp` (
  `MaLopHP` varchar(8) NOT NULL,
  `SoLuongSV` int(11) DEFAULT NULL,
  `MaMon` varchar(8) DEFAULT NULL,
  `phonghoc` varchar(8) DEFAULT NULL,
  `MaHK` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lophp`
--

INSERT INTO `lophp` (`MaLopHP`, `SoLuongSV`, `MaMon`, `phonghoc`, `MaHK`) VALUES
('LHP001', 25, 'TH1314', 'A201', 'HK12023'),
('LHP002', 20, 'TH1316', 'A202', 'HK12023'),
('LHP003', 15, 'TH1507', 'A203', 'HK22023');

-- --------------------------------------------------------

--
-- Table structure for table `mon`
--

CREATE TABLE `mon` (
  `MaMon` varchar(8) NOT NULL,
  `TenMon` varchar(50) DEFAULT NULL,
  `Nganh` varchar(8) DEFAULT NULL,
  `MaGV` varchar(8) DEFAULT NULL,
  `SoChi` int(11) DEFAULT NULL,
  `SoChiLT` int(11) DEFAULT NULL,
  `SoChiTH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mon`
--

INSERT INTO `mon` (`MaMon`, `TenMon`, `Nganh`, `MaGV`, `SoChi`, `SoChiLT`, `SoChiTH`) VALUES
('TH1314', 'Lập trình mạng', 'MMT', 'GV00004', 3, 2, 1),
('TH1316', 'Thiết kế mạng máy tính ', 'MMT', 'GV00004', 3, 2, 1),
('TH1507', 'Đồ án công nghệ thông tin 1', 'MMT', 'GV00006', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nganh`
--

CREATE TABLE `nganh` (
  `MaChuyenNganh` varchar(8) NOT NULL,
  `TenChuyenNganh` varchar(50) DEFAULT NULL,
  `MaKhoa` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nganh`
--

INSERT INTO `nganh` (`MaChuyenNganh`, `TenChuyenNganh`, `MaKhoa`) VALUES
('IOT', 'Internet vạn vật', 'CNTT'),
('MMT', 'Mạng Máy tính và truyền thông', 'CNTT');

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `MaPhong` varchar(8) NOT NULL,
  `TenPhong` varchar(50) DEFAULT NULL,
  `LoaiPhong` varchar(50) DEFAULT NULL,
  `SucChua` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`MaPhong`, `TenPhong`, `LoaiPhong`, `SucChua`) VALUES
('A201', 'phòng máy tính', 'phòng học', 30),
('A202', 'phòng máy tính', 'phòng học', 30),
('A203', 'Phòng khoa', 'phòng họp', 10),
('A204', 'phòng máy tính', 'phòng học', 30),
('A205', 'phòng máy tính', 'phòng học', 30);

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MaSV` varchar(8) NOT NULL,
  `TenSV` varchar(50) DEFAULT NULL,
  `NamSinh` date DEFAULT NULL,
  `CCCD_CMND` varchar(12) DEFAULT NULL,
  `NamNhaphoc` int(11) DEFAULT NULL,
  `NienKhoa` int(11) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `MaLop` varchar(8) DEFAULT NULL,
  `MaChuyenNganh` varchar(8) DEFAULT NULL,
  `FileHinh` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`MaSV`, `TenSV`, `NamSinh`, `CCCD_CMND`, `NamNhaphoc`, `NienKhoa`, `Email`, `MaLop`, `MaChuyenNganh`, `FileHinh`) VALUES
('21004276', 'Lê Ngọc Khánh Huy', '2003-04-15', '086203005171', 2021, 46, '21004276@st.vlute.edu.vn', '1CTT21A3', 'MMT', 'uploads/R.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tkb`
--

CREATE TABLE `tkb` (
  `MaLopHP` varchar(8) DEFAULT NULL,
  `MaSV` varchar(8) DEFAULT NULL,
  `Tuanhoc` int(11) DEFAULT NULL,
  `TuanBatDau` int(11) NOT NULL,
  `TuanKetThuc` int(11) NOT NULL,
  `Thu` varchar(10) NOT NULL,
  `Tiet` int(11) NOT NULL,
  `TietBatDau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tkb`
--

INSERT INTO `tkb` (`MaLopHP`, `MaSV`, `Tuanhoc`, `TuanBatDau`, `TuanKetThuc`, `Thu`, `Tiet`, `TietBatDau`) VALUES
('LHP001', '21004276', 11, 10, 21, 'Thứ 2', 2, 1),
('LHP002', '21004276', 11, 10, 21, 'Thứ 5', 4, 1),
('LHP003', '21004276', 11, 10, 21, 'Thứ 7', 5, 6),
('LHP003', '21004276', 7, 15, 22, 'Chủ nhật', 3, 2),
('LHP003', '21004276', 7, 15, 22, 'Chủ nhật', 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Useradmin`);

--
-- Indexes for table `baikiemtra`
--
ALTER TABLE `baikiemtra`
  ADD PRIMARY KEY (`MaBaiKiemTra`),
  ADD KEY `pk_BKT` (`Mamon`),
  ADD KEY `PK_SV_BKT` (`MaSV`);

--
-- Indexes for table `diemdanh`
--
ALTER TABLE `diemdanh`
  ADD PRIMARY KEY (`MaDiemDanh`),
  ADD KEY `PK_SV_DD` (`MaSV`),
  ADD KEY `PK_GV_DD` (`MaGV`);

--
-- Indexes for table `diemkiemtra`
--
ALTER TABLE `diemkiemtra`
  ADD PRIMARY KEY (`MaDiem`),
  ADD KEY `PK` (`MaMon`),
  ADD KEY `PK_MaHK_Mon` (`MaHK`);

--
-- Indexes for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`MaGV`),
  ADD KEY `PK_Khoa_GV` (`Makhoa`);

--
-- Indexes for table `hocki`
--
ALTER TABLE `hocki`
  ADD PRIMARY KEY (`MaHK`);

--
-- Indexes for table `hocphi`
--
ALTER TABLE `hocphi`
  ADD PRIMARY KEY (`MaMon`,`MaHK`,`MaSV`),
  ADD KEY `PK_MAHK` (`MaHK`),
  ADD KEY `PK_MSV` (`MaSV`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`Makhoa`),
  ADD KEY `PK_VPKHOA` (`MaVanPhongKhoa`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`malop`),
  ADD KEY `PK_CVHT` (`CVHT`),
  ADD KEY `PK_GVQL` (`GVQL`),
  ADD KEY `PK_Khoa` (`MaKhoa`);

--
-- Indexes for table `lophp`
--
ALTER TABLE `lophp`
  ADD PRIMARY KEY (`MaLopHP`),
  ADD KEY `PK_MAMON` (`MaMon`),
  ADD KEY `PK_Phong` (`phonghoc`),
  ADD KEY `PK_HK` (`MaHK`);

--
-- Indexes for table `mon`
--
ALTER TABLE `mon`
  ADD PRIMARY KEY (`MaMon`),
  ADD KEY `PK_MON_GV` (`MaGV`),
  ADD KEY `PK_MON_NGANH` (`Nganh`);

--
-- Indexes for table `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`MaChuyenNganh`),
  ADD KEY `PK_NGANH` (`MaKhoa`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`MaPhong`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MaSV`),
  ADD KEY `PK_SV` (`MaChuyenNganh`),
  ADD KEY `PK_MaLop` (`MaLop`);

--
-- Indexes for table `tkb`
--
ALTER TABLE `tkb`
  ADD KEY `PK_TKB_SV` (`MaSV`),
  ADD KEY `PK_TKB_LHP` (`MaLopHP`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `baikiemtra`
--
ALTER TABLE `baikiemtra`
  ADD CONSTRAINT `PK_SV_BKT` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`),
  ADD CONSTRAINT `pk_BKT` FOREIGN KEY (`Mamon`) REFERENCES `mon` (`MaMon`);

--
-- Constraints for table `diemdanh`
--
ALTER TABLE `diemdanh`
  ADD CONSTRAINT `PK_GV_DD` FOREIGN KEY (`MaGV`) REFERENCES `giangvien` (`MaGV`),
  ADD CONSTRAINT `PK_SV_DD` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);

--
-- Constraints for table `diemkiemtra`
--
ALTER TABLE `diemkiemtra`
  ADD CONSTRAINT `PK` FOREIGN KEY (`MaMon`) REFERENCES `mon` (`MaMon`),
  ADD CONSTRAINT `PK_MaHK_Mon` FOREIGN KEY (`MaHK`) REFERENCES `hocki` (`MaHK`);

--
-- Constraints for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD CONSTRAINT `PK_Khoa_GV` FOREIGN KEY (`Makhoa`) REFERENCES `khoa` (`Makhoa`);

--
-- Constraints for table `hocphi`
--
ALTER TABLE `hocphi`
  ADD CONSTRAINT `PK_MAHK` FOREIGN KEY (`MaHK`) REFERENCES `hocki` (`MaHK`),
  ADD CONSTRAINT `PK_MSV` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`),
  ADD CONSTRAINT `PK_Mon` FOREIGN KEY (`MaMon`) REFERENCES `mon` (`MaMon`);

--
-- Constraints for table `khoa`
--
ALTER TABLE `khoa`
  ADD CONSTRAINT `PK_VPKHOA` FOREIGN KEY (`MaVanPhongKhoa`) REFERENCES `phong` (`MaPhong`);

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `PK_CVHT` FOREIGN KEY (`CVHT`) REFERENCES `giangvien` (`MaGV`),
  ADD CONSTRAINT `PK_GVQL` FOREIGN KEY (`GVQL`) REFERENCES `giangvien` (`MaGV`),
  ADD CONSTRAINT `PK_Khoa` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`Makhoa`);

--
-- Constraints for table `lophp`
--
ALTER TABLE `lophp`
  ADD CONSTRAINT `PK_HK` FOREIGN KEY (`MaHK`) REFERENCES `hocki` (`MaHK`),
  ADD CONSTRAINT `PK_MAMON` FOREIGN KEY (`MaMon`) REFERENCES `mon` (`MaMon`),
  ADD CONSTRAINT `PK_Phong` FOREIGN KEY (`phonghoc`) REFERENCES `phong` (`MaPhong`);

--
-- Constraints for table `mon`
--
ALTER TABLE `mon`
  ADD CONSTRAINT `PK_MON_GV` FOREIGN KEY (`MaGV`) REFERENCES `giangvien` (`MaGV`),
  ADD CONSTRAINT `PK_MON_NGANH` FOREIGN KEY (`Nganh`) REFERENCES `nganh` (`MaChuyenNganh`);

--
-- Constraints for table `nganh`
--
ALTER TABLE `nganh`
  ADD CONSTRAINT `PK_NGANH` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`Makhoa`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `PK_MaLop` FOREIGN KEY (`MaLop`) REFERENCES `lop` (`malop`),
  ADD CONSTRAINT `PK_SV` FOREIGN KEY (`MaChuyenNganh`) REFERENCES `nganh` (`MaChuyenNganh`);

--
-- Constraints for table `tkb`
--
ALTER TABLE `tkb`
  ADD CONSTRAINT `PK_TKB_LHP` FOREIGN KEY (`MaLopHP`) REFERENCES `lophp` (`MaLopHP`),
  ADD CONSTRAINT `PK_TKB_SV` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
