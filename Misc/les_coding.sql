-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
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
-- Database: `les_coding`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(10) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `password`, `email`, `status`) VALUES
('A00001', 'Gavin Malik Setiawan', '$2y$10$3ReuY0KcUSANi6NvPpl8e.7Fj6z0iXBr5PTvaiCzJahmRqdmuqgTq', 'gavin@gavin.com', 1),
('A00002', 'Admin One', '123', 'admin1@mail.com', 1),
('A00003', 'Admin Two', '123', 'admin2@mail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `diajar`
--

CREATE TABLE `diajar` (
  `id_diajar` bigint(20) NOT NULL,
  `id_mapel` varchar(10) NOT NULL,
  `id_pengajar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `diajar`
--

INSERT INTO `diajar` (`id_diajar`, `id_mapel`, `id_pengajar`) VALUES
(1, 'MP00001', 'P00001'),
(2, 'MP00002', 'P00001'),
(3, 'MP00003', 'P00002'),
(4, 'MP00005', 'P00004');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `kode_jadwal` varchar(10) NOT NULL,
  `id_mapel` varchar(10) DEFAULT NULL,
  `id_pengajar` varchar(10) DEFAULT NULL,
  `id_murid` varchar(10) DEFAULT NULL,
  `id_pembelian` varchar(10) DEFAULT NULL,
  `deskripsiMateri` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `status_kehadiran` tinyint(1) DEFAULT NULL
) ;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`kode_jadwal`, `id_mapel`, `id_pengajar`, `id_murid`, `id_pembelian`, `deskripsiMateri`, `tanggal`, `jam_mulai`, `jam_akhir`, `status_kehadiran`) VALUES
('JD00001', 'MP00001', 'P00001', 'M00001', 'PB00001', 'Variabel, Tipe Data, dan Operator', '2026-01-14', '08:00:00', '09:00:00', 1),
('JD00002', 'MP00001', 'P00001', 'M00001', 'PB00001', NULL, '2026-01-13', '08:00:00', '09:00:00', 0),
('JD00003', 'MP00002', 'P00001', 'M00002', 'PB00003', NULL, '2026-01-14', '09:00:00', '10:00:00', 0),
('JD00004', 'MP00002', 'P00001', NULL, NULL, NULL, '2026-01-14', '10:00:00', '11:00:00', NULL),
('JD00005', 'MP00003', 'P00002', 'M00003', 'PB00006', 'Form, Table, dan Layout Web', '2026-01-11', '08:00:00', '09:00:00', 1),
('JD00006', 'MP00003', 'P00002', 'M00003', 'PB00006', NULL, '2026-01-04', '08:00:00', '09:00:00', 0),
('JD00007', 'MP00005', 'P00004', 'M00004', 'PB00014', 'Materi', '2025-12-25', '08:00:00', '09:00:00', 1),
('JD00008', 'MP00005', 'P00004', NULL, NULL, 'Pengenalan Database dan Tabel', '2025-12-25', '09:00:00', '10:00:00', NULL),
('JD00009', 'MP00001', 'P00001', 'M00005', 'PB00008', 'Variabel, Tipe Data, dan Operator', '2026-01-14', '13:00:00', '14:00:00', 1),
('JD00010', 'MP00001', 'P00001', 'M00006', 'PB00010', NULL, '2025-12-14', '08:00:00', '09:00:00', 0),
('JD00011', 'MP00002', 'P00001', 'M00001', 'PB00001', 'Percabangan dan Perulangan', '2026-01-09', '08:00:00', '09:00:00', 1),
('JD00012', 'MP00002', 'P00001', 'M00002', 'PB00003', NULL, '2026-01-07', '08:00:00', '09:00:00', 0),
('JD00013', 'MP00003', 'P00002', 'M00003', 'PB00006', 'Form, Table, dan Layout Web', '2025-12-30', '08:00:00', '09:00:00', 1),
('JD00014', 'MP00005', 'P00004', 'M00005', 'PB00008', 'Pengenalan Database dan Tabel', '2026-01-12', '08:00:00', '09:00:00', 0),
('JD00015', 'MP00001', 'P00001', NULL, NULL, NULL, '2026-01-12', '10:00:00', '11:00:00', NULL),
('JD00016', 'MP00001', 'P00001', 'M00001', 'PB00001', 'Percabangan dan Perulangan', '2026-01-15', '08:00:00', '09:00:00', 0),
('JD00017', 'MP00002', 'P00001', 'M00002', 'PB00003', NULL, '2026-01-16', '08:00:00', '09:00:00', 0),
('JD00018', 'MP00003', 'P00002', NULL, NULL, NULL, '2026-01-17', '08:00:00', '09:00:00', NULL),
('JD00019', 'MP00005', 'P00004', 'M00003', 'PB00006', 'JOIN dan Query Lanjutan', '2026-01-14', '15:00:00', '16:00:00', 1),
('JD00020', 'MP00005', 'P00004', 'M00005', 'PB00008', 'Pengenalan Database dan Tabel', '2026-01-08', '15:00:00', '16:00:00', 0),
('JD00021', 'MP00001', 'P00001', 'M00002', 'PB00003', 'Variabel, Tipe Data, dan Operator', '2026-01-06', '08:00:00', '09:00:00', 1),
('JD00022', 'MP00002', 'P00001', 'M00003', 'PB00006', 'Sorting dan Searching', '2026-01-02', '08:00:00', '09:00:00', 1),
('JD00023', 'MP00003', 'P00002', 'M00004', 'PB00014', NULL, '2025-12-20', '08:00:00', '09:00:00', 0),
('JD00024', 'MP00005', 'P00004', NULL, NULL, 'Pengenalan Database dan Tabel', '2025-12-20', '09:00:00', '10:00:00', NULL),
('JD00025', 'MP00001', 'P00001', 'M00005', 'PB00008', 'Variabel, Tipe Data, dan Operator', '2025-12-15', '08:00:00', '09:00:00', 1),
('JD00026', 'MP00002', 'P00001', 'M00006', 'PB00010', NULL, '2025-12-15', '08:00:00', '09:00:00', 0),
('JD00027', 'MP00003', 'P00002', 'M00001', 'PB00001', 'Fungsi dan Prosedur', '2026-01-10', '08:00:00', '09:00:00', 1),
('JD00028', 'MP00005', 'P00004', 'M00002', 'PB00003', 'Pengenalan Database dan Tabel', '2026-01-05', '08:00:00', '09:00:00', 0),
('JD00029', 'MP00001', 'P00001', NULL, NULL, NULL, '2025-12-31', '10:00:00', '11:00:00', NULL),
('JD00030', 'MP00002', 'P00001', 'M00003', 'PB00006', 'JOIN dan Query Lanjutan', '2026-01-14', '11:00:00', '12:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `katalogpaket`
--

CREATE TABLE `katalogpaket` (
  `id_paket` varchar(10) NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `jml_pertemuan` int(11) NOT NULL,
  `masa_aktif_hari` int(11) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `status_dijual` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `katalogpaket`
--

INSERT INTO `katalogpaket` (`id_paket`, `nama_paket`, `jml_pertemuan`, `masa_aktif_hari`, `harga`, `status_dijual`) VALUES
('PK00001', 'Paket 4x', 4, 30, 400000.00, 1),
('PK00002', 'Paket 8x', 8, 60, 700000.00, 1),
('PK00003', 'Paket 12x', 12, 90, 1000000.00, 1),
('PK00004', 'Paket 4x Promo', 4, 30, 300000.00, 0),
('PK00005', 'Paket 6x', 6, 45, 550000.00, 1),
('PK00006', 'Paket Lama', 10, 60, 800000.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_sistem`
--

CREATE TABLE `log_sistem` (
  `id_log` bigint(20) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `aktivitas` text NOT NULL,
  `id_akun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mapel` varchar(10) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `deskripsiMapel` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mapel`, `nama_mapel`, `deskripsiMapel`, `status`) VALUES
('MP00001', 'Dasar Pemrograman', 'Belajar logika dasar, variabel, dan alur program', 1),
('MP00002', 'Web Development', 'Belajar HTML, CSS, dan dasar JavaScript', 1),
('MP00003', 'PHP & MySQL', 'Membangun website dinamis dengan PHP dan database MySQL', 1),
('MP00004', 'Java OOP', 'Belajar pemrograman berorientasi objek menggunakan Java', 0),
('MP00005', 'Python Programming', 'Belajar Python untuk pemula sampai menengah', 1),
('MP00006', 'Algoritma & Struktur Data', 'Belajar algoritma, array, stack, queue, dan sorting', 0);

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `id_murid` varchar(10) NOT NULL,
  `nama_murid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`id_murid`, `nama_murid`, `email`, `password`, `status`) VALUES
('M00001', 'Andika Saputra', 'andika.saputra@gmail.com', '123', 1),
('M00002', 'Budi Hartono', 'budi.hartono@gmail.com', '123', 1),
('M00003', 'Caca Ramadhani', 'caca.ramadhani@gmail.com', '123', 1),
('M00004', 'Doni Kurniawan', 'doni.kurniawan@gmail.com', '123', 0),
('M00005', 'Eka Puspita', 'eka.puspita@gmail.com', '123', 1),
('M00006', 'Fani Wulandari', 'fani.wulandari@gmail.com', '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `paketdibeli`
--

CREATE TABLE `paketdibeli` (
  `id_pembelian` varchar(10) NOT NULL,
  `id_murid` varchar(10) NOT NULL,
  `id_paket` varchar(10) NOT NULL,
  `tgl_pemesanan` datetime NOT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `gambar_bukti_pembayaran` text DEFAULT NULL,
  `tgl_kedaluwarsa` datetime DEFAULT NULL,
  `pertemuan_terpakai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `paketdibeli`
--

INSERT INTO `paketdibeli` (`id_pembelian`, `id_murid`, `id_paket`, `tgl_pemesanan`, `tgl_pembayaran`, `gambar_bukti_pembayaran`, `tgl_kedaluwarsa`, `pertemuan_terpakai`) VALUES
('PB00001', 'M00001', 'PK00001', '2026-01-14 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-13 21:38:00', 4),
('PB00002', 'M00001', 'PK00002', '2026-01-11 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-03-15 21:38:00', 0),
('PB00003', 'M00002', 'PK00001', '2026-01-04 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-13 21:38:00', 4),
('PB00004', 'M00002', 'PK00003', '2025-12-05 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-04-14 21:38:00', 0),
('PB00005', 'M00003', 'PK00002', '2026-01-14 21:38:00', NULL, NULL, NULL, 0),
('PB00006', 'M00003', 'PK00001', '2025-12-25 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-13 21:38:00', 4),
('PB00007', 'M00004', 'PK00005', '2026-01-12 21:38:00', NULL, NULL, NULL, 0),
('PB00008', 'M00005', 'PK00001', '2026-01-14 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-13 21:38:00', 4),
('PB00009', 'M00005', 'PK00002', '2026-01-07 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-03-15 21:38:00', 0),
('PB00010', 'M00006', 'PK00003', '2025-12-30 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-04-14 21:38:00', 2),
('PB00011', 'M00001', 'PK00005', '2026-01-13 21:38:00', NULL, NULL, NULL, 0),
('PB00012', 'M00002', 'PK00005', '2026-01-14 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-28 21:38:00', 0),
('PB00013', 'M00003', 'PK00001', '2026-01-09 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-13 21:38:00', 0),
('PB00014', 'M00004', 'PK00002', '2025-11-15 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-03-15 21:38:00', 2),
('PB00015', 'M00005', 'PK00003', '2026-01-14 21:38:00', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengajar`
--

CREATE TABLE `pengajar` (
  `id_pengajar` varchar(10) NOT NULL,
  `nama_pengajar` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengajar`
--

INSERT INTO `pengajar` (`id_pengajar`, `nama_pengajar`, `email`, `password`, `status`) VALUES
('P00001', 'Dr. Budi Santoso, S.Kom', 'budi.santoso@gmail.com', '123', 1),
('P00002', 'Andi Pratama, M.T.', 'andi.pratama@gmail.com', '123', 1),
('P00003', 'Citra Lestari, M.Kom', 'citra.lestari@gmail.com', '123', 0),
('P00004', 'Dewi Anggraini, S.Kom', 'dewi.anggraini@gmail.com', '123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `diajar`
--
ALTER TABLE `diajar`
  ADD PRIMARY KEY (`id_diajar`),
  ADD KEY `diajar_id_pengajar_foreign` (`id_pengajar`),
  ADD KEY `diajar_id_mapel_foreign` (`id_mapel`) USING BTREE;

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kode_jadwal`),
  ADD KEY `jadwal_id_mapel_index` (`id_mapel`),
  ADD KEY `jadwal_id_murid_index` (`id_murid`),
  ADD KEY `fk_jadwal_paketdibeli` (`id_pembelian`),
  ADD KEY `idx_jadwal_pengajar` (`id_pengajar`);

--
-- Indexes for table `katalogpaket`
--
ALTER TABLE `katalogpaket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `log_sistem`
--
ALTER TABLE `log_sistem`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`id_murid`);

--
-- Indexes for table `paketdibeli`
--
ALTER TABLE `paketdibeli`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `paketdibeli_id_murid_index` (`id_murid`),
  ADD KEY `paketdibeli_id_paket_index` (`id_paket`);

--
-- Indexes for table `pengajar`
--
ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`id_pengajar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diajar`
--
ALTER TABLE `diajar`
  MODIFY `id_diajar` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `log_sistem`
--
ALTER TABLE `log_sistem`
  MODIFY `id_log` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diajar`
--
ALTER TABLE `diajar`
  ADD CONSTRAINT `diajar_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id_mapel`),
  ADD CONSTRAINT `diajar_id_pengajar_foreign` FOREIGN KEY (`id_pengajar`) REFERENCES `pengajar` (`id_pengajar`);

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_jadwal_paketdibeli` FOREIGN KEY (`id_pembelian`) REFERENCES `paketdibeli` (`id_pembelian`),
  ADD CONSTRAINT `fk_jadwal_pengajar` FOREIGN KEY (`id_pengajar`) REFERENCES `pengajar` (`id_pengajar`),
  ADD CONSTRAINT `jadwal_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id_mapel`),
  ADD CONSTRAINT `jadwal_id_murid_foreign` FOREIGN KEY (`id_murid`) REFERENCES `murid` (`id_murid`);

--
-- Constraints for table `paketdibeli`
--
ALTER TABLE `paketdibeli`
  ADD CONSTRAINT `paketdibeli_id_murid_foreign` FOREIGN KEY (`id_murid`) REFERENCES `murid` (`id_murid`),
  ADD CONSTRAINT `paketdibeli_id_paket_foreign` FOREIGN KEY (`id_paket`) REFERENCES `katalogpaket` (`id_paket`);

-- --------------------------------------------------------
-- Functions
-- --------------------------------------------------------

-- ==============================
-- Dashboard Admin
-- ==============================

-- [01] FC_getTotalMurid (dashboard admin)
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalMurid`$$
CREATE FUNCTION `FC_getTotalMurid`()
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(*) FROM murid
)$$
DELIMITER ;

-- [02] FC_getTotalPengajar (dashboard admin)
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalPengajar`$$
CREATE FUNCTION `FC_getTotalPengajar`()
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(*) FROM pengajar
)$$
DELIMITER ;

-- [03] FC_getPendapatanBulanIni (dashboard admin)
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getPendapatanBulanIni`$$
CREATE FUNCTION `FC_getPendapatanBulanIni`()
RETURNS DECIMAL(12,2)
READS SQL DATA
RETURN (
  SELECT IFNULL(SUM(k.harga), 0)
  FROM paketdibeli pd
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  WHERE pd.tgl_pembayaran IS NOT NULL
    AND MONTH(pd.tgl_pembayaran) = MONTH(CURDATE())
    AND YEAR(pd.tgl_pembayaran) = YEAR(CURDATE())
)$$
DELIMITER ;

-- [04] FC_getTotalPembelianPaket (dashboard admin)
-- Jumlah pembelian yang perlu verifikasi: bukti ada, tapi belum ditandai lunas.
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalPembelianPaket`$$
CREATE FUNCTION `FC_getTotalPembelianPaket`()
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(*)
  FROM paketdibeli
  WHERE tgl_pembayaran IS NULL
    AND gambar_bukti_pembayaran IS NOT NULL
)$$
DELIMITER ;

-- ==============================
-- Dashboard Murid
-- ==============================

-- [05] FC_getJumlahPaketAktifMurid (dashboard murid)
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getJumlahPaketAktifMurid`$$
CREATE FUNCTION `FC_getJumlahPaketAktifMurid`(p_id_murid VARCHAR(10))
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(*)
  FROM paketdibeli
  WHERE id_murid = p_id_murid
    AND tgl_kedaluwarsa IS NOT NULL
    AND tgl_kedaluwarsa >= CURDATE()
)$$
DELIMITER ;

-- [06] FC_getTotalSisaPertemuanMurid (dashboard murid)
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalSisaPertemuanMurid`$$
CREATE FUNCTION `FC_getTotalSisaPertemuanMurid`(p_id_murid VARCHAR(10))
RETURNS INT
READS SQL DATA
RETURN (
  SELECT IFNULL(SUM((k.jml_pertemuan - pd.pertemuan_terpakai)), 0)
  FROM paketdibeli pd
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  WHERE pd.id_murid = p_id_murid
    AND pd.tgl_kedaluwarsa IS NOT NULL
    AND pd.tgl_kedaluwarsa >= CURDATE()
)$$
DELIMITER ;

-- [07] FC_getTotalJadwalHariIniMurid (dashboard murid)
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalJadwalHariIniMurid`$$
CREATE FUNCTION `FC_getTotalJadwalHariIniMurid`(p_id_murid VARCHAR(10))
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(*)
  FROM jadwal
  WHERE id_murid = p_id_murid
    AND tanggal = CURDATE()
)$$
DELIMITER ;

-- [08] FC_getTotalJadwalMingguIniMurid (dashboard murid)
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalJadwalMingguIniMurid`$$

CREATE FUNCTION `FC_getTotalJadwalMingguIniMurid`(p_id_murid VARCHAR(10))
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(*)
  FROM jadwal
  WHERE id_murid = p_id_murid
    AND YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)
)$$
DELIMITER ;

-- [09] FC_getTotalKehadiranMurid (dashboard murid)
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalKehadiranMurid`$$
CREATE FUNCTION `FC_getTotalKehadiranMurid`(p_id_murid VARCHAR(10))
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(*)
  FROM jadwal
  WHERE id_murid = p_id_murid
    AND status_kehadiran = 1
)$$
DELIMITER ;

-- ==============================
-- Dashboard Pengajar
-- ==============================

-- [10] FC_getTotalMuridDiajar (dashboard pengajar)
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalMuridDiajar`$$

CREATE FUNCTION `FC_getTotalMuridDiajar`(p_id_pengajar VARCHAR(10))
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(DISTINCT id_murid)
  FROM jadwal
  WHERE id_pengajar = p_id_pengajar
    AND id_murid IS NOT NULL
)$$
DELIMITER ;

-- [11] FC_getTotalJadwalHariIniPengajar (dashboard pengajar)
-- Jadwal terisi untuk pengajar hari ini.
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalJadwalHariIniPengajar`$$

CREATE FUNCTION `FC_getTotalJadwalHariIniPengajar`(p_id_pengajar VARCHAR(10))
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(*)
  FROM jadwal
  WHERE id_pengajar = p_id_pengajar
    AND id_murid IS NOT NULL
    AND tanggal = CURDATE()
)$$
DELIMITER ;

-- [12] FC_getTotalJadwalMingguIniPengajar (dashboard pengajar)
-- Jadwal terisi untuk pengajar minggu ini.
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalJadwalMingguIniPengajar`$$

CREATE FUNCTION `FC_getTotalJadwalMingguIniPengajar`(p_id_pengajar VARCHAR(10))
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(*)
  FROM jadwal
  WHERE id_pengajar = p_id_pengajar
    AND id_murid IS NOT NULL
    AND YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)
)$$
DELIMITER ;

-- ==============================
-- Util
-- ==============================

-- [13] FC_getTotalJadwalMurid (util)
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalJadwalMurid`$$

CREATE FUNCTION `FC_getTotalJadwalMurid`(p_id_murid VARCHAR(10))
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(*)
  FROM jadwal
  WHERE id_murid = p_id_murid
)$$
DELIMITER ;

-- [14] FC_getTotalJadwalPengajar (util)
DELIMITER $$
DROP FUNCTION IF EXISTS `FC_getTotalJadwalPengajar`$$
CREATE FUNCTION `FC_getTotalJadwalPengajar`(p_id_pengajar VARCHAR(10))
RETURNS INT
READS SQL DATA
RETURN (
  SELECT COUNT(*)
  FROM jadwal
  WHERE id_pengajar = p_id_pengajar
)$$
DELIMITER ;

-- --------------------------------------------------------
-- Views
-- --------------------------------------------------------

-- [01] view_DashboardAdmin_JadwalTerisi (admin dashboard)
DROP VIEW IF EXISTS `view_DashboardAdmin_JadwalTerisi`;

CREATE VIEW `view_DashboardAdmin_JadwalTerisi` AS
SELECT
  j.kode_jadwal,
  j.tanggal,
  DAYNAME(j.tanggal) AS hari,
  CONCAT(
    DATE_FORMAT(j.jam_mulai, '%H:%i'),
    ' - ',
    DATE_FORMAT(j.jam_akhir, '%H:%i')
  ) AS waktu,
  p.nama_pengajar,
  mp.nama_mapel,
  m.nama_murid,
  j.deskripsiMateri,
  j.status_kehadiran
FROM jadwal j
JOIN murid m ON j.id_murid = m.id_murid
JOIN pengajar p ON j.id_pengajar = p.id_pengajar
JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
WHERE j.id_murid IS NOT NULL;

-- [02] view_DashboardMurid_JadwalMendatang (murid dashboard)
DROP VIEW IF EXISTS `view_DashboardMurid_JadwalMendatang`;

CREATE VIEW `view_DashboardMurid_JadwalMendatang` AS
SELECT
  j.kode_jadwal,
  j.id_murid,
  m.nama_murid,

  j.tanggal,
  DAYNAME(j.tanggal) AS hari,

  CONCAT(
    DATE_FORMAT(j.jam_mulai, '%H:%i'),
    ' - ',
    DATE_FORMAT(j.jam_akhir, '%H:%i')
  ) AS waktu,

  j.id_mapel,
  mp.nama_mapel,

  j.id_pengajar,
  p.nama_pengajar

FROM jadwal j
JOIN murid m ON j.id_murid = m.id_murid
JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
JOIN pengajar p ON j.id_pengajar = p.id_pengajar

WHERE j.id_murid IS NOT NULL
  AND j.tanggal >= CURDATE();


-- [03] view_DashboardPengajar_JadwalMendatang (pengajar dashboard)
DROP VIEW IF EXISTS `view_DashboardPengajar_JadwalMendatang`;

CREATE VIEW `view_DashboardPengajar_JadwalMendatang` AS
SELECT
  j.kode_jadwal,

  j.id_pengajar,
  p.nama_pengajar,

  j.tanggal,
  DAYNAME(j.tanggal) AS hari,

  CONCAT(
    DATE_FORMAT(j.jam_mulai, '%H:%i'),
    ' - ',
    DATE_FORMAT(j.jam_akhir, '%H:%i')
  ) AS waktu,

  j.id_mapel,
  mp.nama_mapel,

  j.id_murid,
  m.nama_murid

FROM jadwal j
JOIN pengajar p ON j.id_pengajar = p.id_pengajar
JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
JOIN murid m ON j.id_murid = m.id_murid

WHERE j.id_murid IS NOT NULL
  AND j.tanggal >= CURDATE();

-- [04] view_MataPelajaranAktif (admin)
DROP VIEW IF EXISTS `view_MataPelajaranAktif`;

CREATE VIEW `view_MataPelajaranAktif` AS
SELECT
  id_mapel,
  nama_mapel,
  deskripsiMapel,
  status
FROM mata_pelajaran
WHERE status = 1;

-- [05] view_MataPelajaranNonaktif (admin)
DROP VIEW IF EXISTS `view_MataPelajaranNonaktif`;

CREATE VIEW `view_MataPelajaranNonaktif` AS
SELECT
  id_mapel,
  nama_mapel,
  deskripsiMapel,
  status
FROM mata_pelajaran
WHERE status = 0;

-- [06] view_PaketLesAktif (admin)
DROP VIEW IF EXISTS `view_PaketLesAktif`;

CREATE VIEW `view_PaketLesAktif` AS
SELECT
  id_paket,
  nama_paket,
  jml_pertemuan,
  masa_aktif_hari,
  harga,
  status_dijual
FROM katalogpaket
WHERE status_dijual = 1;


-- [07] view_PaketLesNonaktif (admin)
DROP VIEW IF EXISTS `view_PaketLesNonaktif`;

CREATE VIEW `view_PaketLesNonaktif` AS
SELECT
  id_paket,
  nama_paket,
  jml_pertemuan,
  masa_aktif_hari,
  harga,
  status_dijual
FROM katalogpaket
WHERE status_dijual = 0;

-- [08] view_logSemua (admin)
-- Catatan: ORDER BY sebaiknya dipakai saat SELECT dari view.
DROP VIEW IF EXISTS `view_logSemua`;
CREATE VIEW `view_logSemua` AS
SELECT
  id_log,
  tanggal,
  aktivitas,
  id_akun
FROM log_sistem;

-- [09] view_LogSistem (admin)
DROP VIEW IF EXISTS `view_LogSistem`;

CREATE VIEW `view_LogSistem` AS
SELECT
  l.id_log,
  l.tanggal,
  l.aktivitas,
  l.id_akun,
  'Murid' AS role,
  m.nama_murid AS nama_pengguna
FROM log_sistem l
JOIN murid m ON l.id_akun = m.id_murid

UNION ALL

SELECT
  l.id_log,
  l.tanggal,
  l.aktivitas,
  l.id_akun,
  'Pengajar' AS role,
  p.nama_pengajar AS nama_pengguna
FROM log_sistem l
JOIN pengajar p ON l.id_akun = p.id_pengajar

UNION ALL

SELECT
  l.id_log,
  l.tanggal,
  l.aktivitas,
  l.id_akun,
  'Admin' AS role,
  a.nama_admin AS nama_pengguna
FROM log_sistem l
JOIN admin a ON l.id_akun = a.id_admin;

-- Ambil semua:
-- SELECT * FROM view_LogSistem ORDER BY tanggal DESC;

-- Filter role:
-- SELECT * FROM view_LogSistem WHERE role = 'Murid';
-- SELECT * FROM view_LogSistem WHERE role = 'Pengajar';
-- SELECT * FROM view_LogSistem WHERE role = 'Admin';

-- --------------------------------------------------------
-- Stored Procedures
-- --------------------------------------------------------

-- [01] SP_TambahAkun (admin)
DELIMITER $$

DROP PROCEDURE IF EXISTS SP_TambahAkun$$
CREATE PROCEDURE SP_TambahAkun(
  IN p_role VARCHAR(20),
  IN p_nama VARCHAR(255),
  IN p_email VARCHAR(255),
  IN p_password VARCHAR(255)
)
BEGIN
  DECLARE v_last_id INT;
  DECLARE v_new_id VARCHAR(10);

  -- Cek email sudah ada atau belum (global)
  IF EXISTS (
    SELECT 1 FROM murid WHERE email = p_email
    UNION
    SELECT 1 FROM pengajar WHERE email = p_email
    UNION
    SELECT 1 FROM admin WHERE email = p_email
  ) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Email sudah terdaftar';
  END IF;

  -- ROLE: MURID
  IF LOWER(p_role) = 'murid' THEN

    SELECT IFNULL(MAX(CAST(SUBSTRING(id_murid, 2) AS UNSIGNED)), 0)
    INTO v_last_id
    FROM murid;

    SET v_new_id = CONCAT('M', LPAD(v_last_id + 1, 5, '0'));

    INSERT INTO murid (id_murid, nama_murid, email, password, status)
    VALUES (v_new_id, p_nama, p_email, p_password, 1);

  -- ROLE: PENGAJAR
  ELSEIF LOWER(p_role) = 'pengajar' THEN

    SELECT IFNULL(MAX(CAST(SUBSTRING(id_pengajar, 2) AS UNSIGNED)), 0)
    INTO v_last_id
    FROM pengajar;

    SET v_new_id = CONCAT('P', LPAD(v_last_id + 1, 5, '0'));

    INSERT INTO pengajar (id_pengajar, nama_pengajar, email, password, status)
    VALUES (v_new_id, p_nama, p_email, p_password, 1);

  -- ROLE: ADMIN
  ELSEIF LOWER(p_role) = 'admin' THEN

    SELECT IFNULL(MAX(CAST(SUBSTRING(id_admin, 2) AS UNSIGNED)), 0)
    INTO v_last_id
    FROM admin;

    SET v_new_id = CONCAT('A', LPAD(v_last_id + 1, 5, '0'));

    INSERT INTO admin (id_admin, nama_admin, password, email, status)
    VALUES (v_new_id, p_nama, p_password, p_email, 1);

  ELSE
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Role tidak valid';
  END IF;

END$$
DELIMITER ;

-- [02] SP_EditAkun (admin)
DELIMITER $$

DROP PROCEDURE IF EXISTS SP_EditAkun$$
CREATE PROCEDURE SP_EditAkun(
  IN p_role VARCHAR(20),
  IN p_id VARCHAR(10),
  IN p_nama VARCHAR(255),
  IN p_email VARCHAR(255)
)
BEGIN
  DECLARE v_count INT;

  -- Cek email sudah dipakai akun lain atau belum
  IF EXISTS (
    SELECT 1 FROM murid WHERE email = p_email AND id_murid <> p_id
    UNION
    SELECT 1 FROM pengajar WHERE email = p_email AND id_pengajar <> p_id
    UNION
    SELECT 1 FROM admin WHERE email = p_email AND id_admin <> p_id
  ) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Email sudah digunakan oleh akun lain';
  END IF;

  -- ROLE: MURID
  IF LOWER(p_role) = 'murid' THEN

    SELECT COUNT(*) INTO v_count FROM murid WHERE id_murid = p_id;
    IF v_count = 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'ID murid tidak ditemukan';
    END IF;

    UPDATE murid
    SET nama_murid = p_nama,
        email = p_email
    WHERE id_murid = p_id;

  -- ROLE: PENGAJAR
  ELSEIF LOWER(p_role) = 'pengajar' THEN

    SELECT COUNT(*) INTO v_count FROM pengajar WHERE id_pengajar = p_id;
    IF v_count = 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'ID pengajar tidak ditemukan';
    END IF;

    UPDATE pengajar
    SET nama_pengajar = p_nama,
        email = p_email
    WHERE id_pengajar = p_id;

  -- ROLE: ADMIN
  ELSEIF LOWER(p_role) = 'admin' THEN

    SELECT COUNT(*) INTO v_count FROM admin WHERE id_admin = p_id;
    IF v_count = 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'ID admin tidak ditemukan';
    END IF;

    UPDATE admin
    SET nama_admin = p_nama,
        email = p_email
    WHERE id_admin = p_id;

  ELSE
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Role tidak valid';
  END IF;

END$$
DELIMITER ;

-- [03] SP_LihatAkun (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatAkun`$$
CREATE PROCEDURE `SP_LihatAkun`(
  IN p_role VARCHAR(20),
  IN p_status VARCHAR(20)
)
BEGIN
  SELECT 'MURID' AS role_akun, id_murid AS id_akun, nama_murid AS nama, email, status
  FROM murid
  WHERE (UPPER(p_role) = 'SEMUA' OR UPPER(p_role) = 'MURID')
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'AKTIF' AND status = 1)
      OR (UPPER(p_status) = 'NONAKTIF' AND status = 0)
    )

  UNION ALL

  SELECT 'PENGAJAR', id_pengajar, nama_pengajar, email, status
  FROM pengajar
  WHERE (UPPER(p_role) = 'SEMUA' OR UPPER(p_role) = 'PENGAJAR')
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'AKTIF' AND status = 1)
      OR (UPPER(p_status) = 'NONAKTIF' AND status = 0)
    )

  UNION ALL

  SELECT 'ADMIN', id_admin, nama_admin, email, status
  FROM admin
  WHERE (UPPER(p_role) = 'SEMUA' OR UPPER(p_role) = 'ADMIN')
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'AKTIF' AND status = 1)
      OR (UPPER(p_status) = 'NONAKTIF' AND status = 0)
    );
END$$
DELIMITER ;

-- Cara Pakai di PHP (mysqli)
-- $role   = $_GET['role']   ?? 'SEMUA';
-- $status = $_GET['status'] ?? 'AKTIF';

-- $stmt = $conn->prepare("CALL SP_LihatAkun(?, ?)");
-- $stmt->bind_param("ss", $role, $status);
-- $stmt->execute();

-- $result = $stmt->get_result();

-- while ($row = $result->fetch_assoc()) {
--     echo $row['id_akun'];
--     echo $row['nama'];
--     echo $row['email'];
--     echo $row['role_akun'];
--     echo $row['status'];
-- }


-- [04] SP_UbahStatusAkun (admin)
DELIMITER $$

DROP PROCEDURE IF EXISTS SP_UbahStatusAkun$$
CREATE PROCEDURE SP_UbahStatusAkun(
  IN p_role VARCHAR(20),
  IN p_id VARCHAR(10),
  IN p_status TINYINT(1)
)
BEGIN
  DECLARE v_count INT;

  IF LOWER(p_role) = 'murid' THEN

    SELECT COUNT(*) INTO v_count FROM murid WHERE id_murid = p_id;
    IF v_count = 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'ID murid tidak ditemukan';
    END IF;

    UPDATE murid SET status = p_status WHERE id_murid = p_id;

  ELSEIF LOWER(p_role) = 'pengajar' THEN

    SELECT COUNT(*) INTO v_count FROM pengajar WHERE id_pengajar = p_id;
    IF v_count = 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'ID pengajar tidak ditemukan';
    END IF;

    UPDATE pengajar SET status = p_status WHERE id_pengajar = p_id;

  ELSEIF LOWER(p_role) = 'admin' THEN

    SELECT COUNT(*) INTO v_count FROM admin WHERE id_admin = p_id;
    IF v_count = 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'ID admin tidak ditemukan';
    END IF;

    UPDATE admin SET status = p_status WHERE id_admin = p_id;

  ELSE
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Role tidak valid';
  END IF;

END$$
DELIMITER ;

-- Flow di PHP (contoh singkat)
-- $role = $_POST['role'];
-- $id   = $_POST['id'];
-- $status = $_POST['status']; // 1 atau 0

-- $stmt = $conn->prepare("CALL SP_UbahStatusAkun(?, ?, ?)");
-- $stmt->bind_param("ssi", $role, $id, $status);
-- $stmt->execute();

-- [05] SP_TambahPaketLes (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_TambahPaketLes`$$
CREATE PROCEDURE `SP_TambahPaketLes`(
  IN p_id VARCHAR(10),
  IN p_nama VARCHAR(255),
  IN p_jml INT,
  IN p_masa INT,
  IN p_harga DECIMAL(12,2)
)
BEGIN
  INSERT INTO katalogpaket (id_paket, nama_paket, jml_pertemuan, masa_aktif_hari, harga, status_dijual)
  VALUES (p_id, p_nama, p_jml, p_masa, p_harga, 1);
END$$
DELIMITER ;

-- [06] SP_EditPaketLes (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_EditPaketLes`$$
CREATE PROCEDURE `SP_EditPaketLes`(
  IN p_id VARCHAR(10),
  IN p_nama VARCHAR(255),
  IN p_jml INT,
  IN p_masa INT,
  IN p_harga DECIMAL(12,2)
)
BEGIN
  UPDATE katalogpaket
  SET nama_paket = p_nama,
      jml_pertemuan = p_jml,
      masa_aktif_hari = p_masa,
      harga = p_harga
  WHERE id_paket = p_id;
END$$
DELIMITER ;

-- [07] SP_UbahStatusPaketLes (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_UbahStatusPaketLes`$$
CREATE PROCEDURE `SP_UbahStatusPaketLes`(
  IN p_id VARCHAR(10),
  IN p_status BOOLEAN
)
BEGIN
  UPDATE katalogpaket SET status_dijual = p_status WHERE id_paket = p_id;
END$$
DELIMITER ;

-- [08] SP_TambahMapel (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_TambahMapel`$$
CREATE PROCEDURE `SP_TambahMapel`(
  IN p_id VARCHAR(10),
  IN p_nama VARCHAR(255),
  IN p_desc TEXT
)
BEGIN
  INSERT INTO mata_pelajaran (id_mapel, nama_mapel, deskripsiMapel, status)
  VALUES (p_id, p_nama, p_desc, 1);
END$$
DELIMITER ;

-- [09] SP_EditMapel (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_EditMapel`$$
CREATE PROCEDURE `SP_EditMapel`(
  IN p_id VARCHAR(10),
  IN p_nama VARCHAR(255),
  IN p_desc TEXT
)
BEGIN
  UPDATE mata_pelajaran
  SET nama_mapel = p_nama, deskripsiMapel = p_desc
  WHERE id_mapel = p_id;
END$$
DELIMITER ;

-- [10] SP_UbahStatusMapel (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_UbahStatusMapel`$$
CREATE PROCEDURE `SP_UbahStatusMapel`(
  IN p_id VARCHAR(10),
  IN p_status BOOLEAN
)
BEGIN
  UPDATE mata_pelajaran SET status = p_status WHERE id_mapel = p_id;
END$$
DELIMITER ;

-- [11] SP_LihatPembelianPaket (admin) - Hapus p_urut karena tidak dipakai
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatPembelianPaket`$$
CREATE PROCEDURE `SP_LihatPembelianPaket`(
  IN p_periode VARCHAR(20),
  IN p_status_bukti VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT *
  FROM paketdibeli
  WHERE (
    UPPER(p_periode) = 'SEMUA'
    OR (UPPER(p_periode) = 'HARI_INI' AND DATE(tgl_pemesanan) = CURDATE())
    OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(tgl_pemesanan, 1) = YEARWEEK(CURDATE(), 1))
    OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(tgl_pemesanan) = MONTH(CURDATE()) AND YEAR(tgl_pemesanan) = YEAR(CURDATE()))
  )
  AND (
    UPPER(p_status_bukti) = 'SEMUA'
    OR (UPPER(p_status_bukti) = 'SUDAH' AND gambar_bukti_pembayaran IS NOT NULL AND gambar_bukti_pembayaran <> '')
    OR (UPPER(p_status_bukti) = 'BELUM' AND (gambar_bukti_pembayaran IS NULL OR gambar_bukti_pembayaran = ''))
  )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN tgl_pemesanan END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN tgl_pemesanan END ASC;
END$$
DELIMITER ;

-- [12] SP_LihatBuktiPembayaran (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatBuktiPembayaran`$$
CREATE PROCEDURE `SP_LihatBuktiPembayaran`(IN p_id VARCHAR(10))
BEGIN
  SELECT gambar_bukti_pembayaran
  FROM paketdibeli
  WHERE id_pembelian = p_id;
END$$
DELIMITER ;

-- [13] SP_TandaiLunas (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_TandaiLunas`$$
CREATE PROCEDURE `SP_TandaiLunas`(IN p_id VARCHAR(10))
BEGIN
  UPDATE paketdibeli pd
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  SET pd.tgl_pembayaran = NOW(),
      pd.tgl_kedaluwarsa = DATE_ADD(NOW(), INTERVAL k.masa_aktif_hari DAY)
  WHERE pd.id_pembelian = p_id;
END$$
DELIMITER ;

-- [14] SP_LihatRiwayatPembelian (admin) - Fix tidak usah ada p_urut karena tidak dipakai
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatRiwayatPembelian`$$
CREATE PROCEDURE `SP_LihatRiwayatPembelian`(
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT *
  FROM paketdibeli
  WHERE (
    UPPER(p_periode) = 'SEMUA'
    OR (UPPER(p_periode) = 'HARI_INI' AND tgl_pembayaran IS NOT NULL AND DATE(tgl_pembayaran) = CURDATE())
    OR (UPPER(p_periode) = 'MINGGU_INI' AND tgl_pembayaran IS NOT NULL AND YEARWEEK(tgl_pembayaran, 1) = YEARWEEK(CURDATE(), 1))
    OR (UPPER(p_periode) = 'BULAN_INI' AND tgl_pembayaran IS NOT NULL AND MONTH(tgl_pembayaran) = MONTH(CURDATE()) AND YEAR(tgl_pembayaran) = YEAR(CURDATE()))
  )
  AND (
    UPPER(p_status) = 'SEMUA'
    OR (UPPER(p_status) = 'AKTIF' AND tgl_kedaluwarsa IS NOT NULL AND tgl_kedaluwarsa >= CURDATE())
    OR (UPPER(p_status) = 'KEDALUWARSA' AND tgl_kedaluwarsa IS NOT NULL AND tgl_kedaluwarsa < CURDATE())
  )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN tgl_pembayaran END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN tgl_pembayaran END ASC;
END$$
DELIMITER ;

-- [15] SP_TambahJadwal (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_TambahJadwal`$$
CREATE PROCEDURE `SP_TambahJadwal`(
  IN p_kode VARCHAR(10),
  IN p_mapel VARCHAR(10),
  IN p_pengajar VARCHAR(10),
  IN p_tgl DATE,
  IN p_mulai TIME,
  IN p_akhir TIME
)
BEGIN
  INSERT INTO jadwal (
    kode_jadwal, id_mapel, id_pengajar, id_murid, id_pembelian,
    deskripsiMateri, tanggal, jam_mulai, jam_akhir, status_kehadiran
  )
  VALUES (p_kode, p_mapel, p_pengajar, NULL, NULL, NULL, p_tgl, p_mulai, p_akhir, NULL);
END$$
DELIMITER ;

-- [16] SP_LihatJadwal (admin)- Hapus p_urut karena tidak dipakai
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatJadwal`$$
CREATE PROCEDURE `SP_LihatJadwal`(
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT *
  FROM jadwal
  WHERE (
    UPPER(p_periode) = 'SEMUA'
    OR (UPPER(p_periode) = 'HARI_INI' AND tanggal = CURDATE())
    OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1))
    OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE()))
  )
  AND (
    UPPER(p_status) = 'SEMUA'
    OR (UPPER(p_status) = 'TERISI' AND id_murid IS NOT NULL)
    OR (UPPER(p_status) = 'KOSONG' AND id_murid IS NULL)
  )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN tanggal END ASC;
END$$
DELIMITER ;

-- [17] SP_EditJadwal (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_EditJadwal`$$
CREATE PROCEDURE `SP_EditJadwal`(
  IN p_kode VARCHAR(10),
  IN p_tgl DATE,
  IN p_mulai TIME,
  IN p_akhir TIME
)
BEGIN
  UPDATE jadwal
  SET tanggal = p_tgl, jam_mulai = p_mulai, jam_akhir = p_akhir
  WHERE kode_jadwal = p_kode;
END$$
DELIMITER ;

-- [18] SP_HapusJadwal (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_HapusJadwal`$$
CREATE PROCEDURE `SP_HapusJadwal`(IN p_kode VARCHAR(10))
BEGIN
  DELETE FROM jadwal WHERE kode_jadwal = p_kode;
END$$
DELIMITER ;

-- [19] SP_LihatAbsensi (admin)- Hapus p_urut karena tidak dipakai
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatAbsensi`$$
CREATE PROCEDURE `SP_LihatAbsensi`(
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT *
  FROM jadwal
  WHERE id_murid IS NOT NULL
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'TERISI' AND deskripsiMateri IS NOT NULL)
      OR (UPPER(p_status) = 'KOSONG' AND deskripsiMateri IS NULL)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN tanggal END ASC;
END$$
DELIMITER ;

-- [20] SP_InputAbsensi (admin, pengajar)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_InputAbsensi`$$
CREATE PROCEDURE `SP_InputAbsensi`(
  IN p_kode VARCHAR(10),
  IN p_status BOOLEAN,
  IN p_desc TEXT
)
BEGIN
  UPDATE jadwal
  SET status_kehadiran = p_status, deskripsiMateri = p_desc
  WHERE kode_jadwal = p_kode;
END$$
DELIMITER ;

-- [21] SP_LihatRiwayatKehadiran (admin) - Hapus p_urut karena tidak dipakai
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatRiwayatKehadiran`$$
CREATE PROCEDURE `SP_LihatRiwayatKehadiran`(
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT *
  FROM jadwal
  WHERE id_murid IS NOT NULL
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'HADIR' AND status_kehadiran = 1)
      OR (UPPER(p_status) = 'TIDAK_HADIR' AND status_kehadiran = 0)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN tanggal END ASC;
END$$
DELIMITER ;

-- [22] SP_LihatJadwalTersedia (murid)- Butuh cek isinya agar sesuai fungsinya
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatJadwalTersedia`$$
CREATE PROCEDURE `SP_LihatJadwalTersedia`(
  IN p_periode VARCHAR(20),
  IN p_urut VARCHAR(20),
  IN p_id_mapel VARCHAR(10),
  IN p_id_pengajar VARCHAR(10)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    j.jam_mulai,
    j.jam_akhir,
    j.id_mapel,
    mp.nama_mapel,
    j.id_pengajar,
    p.nama_pengajar
  FROM jadwal j
  LEFT JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  LEFT JOIN pengajar p ON j.id_pengajar = p.id_pengajar
  WHERE j.id_murid IS NULL
    AND (
      p_id_mapel IS NULL OR p_id_mapel = '' OR j.id_mapel = p_id_mapel
    )
    AND (
      p_id_pengajar IS NULL OR p_id_pengajar = '' OR j.id_pengajar = p_id_pengajar
    )
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(j.tanggal) = MONTH(CURDATE()) AND YEAR(j.tanggal) = YEAR(CURDATE()))
      OR (UPPER(p_periode) = 'MULAI_HARI_INI' AND j.tanggal >= CURDATE())
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC,
    j.jam_mulai ASC;
END$$
DELIMITER ;

-- [23] SP_LihatJadwalMurid (murid)- Hapus p_urut karena tidak dipakai
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatJadwalMurid`$$
CREATE PROCEDURE `SP_LihatJadwalMurid`(
  IN p_id_murid VARCHAR(10),
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    j.jam_mulai,
    j.jam_akhir,
    j.deskripsiMateri,
    j.status_kehadiran,
    j.id_mapel,
    mp.nama_mapel,
    j.id_pengajar,
    p.nama_pengajar,
    j.id_pembelian
  FROM jadwal j
  LEFT JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  LEFT JOIN pengajar p ON j.id_pengajar = p.id_pengajar
  WHERE j.id_murid = p_id_murid
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(j.tanggal) = MONTH(CURDATE()) AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'HADIR' AND j.status_kehadiran = 1)
      OR (UPPER(p_status) = 'TIDAK_HADIR' AND j.status_kehadiran = 0)
      OR (UPPER(p_status) = 'BELUM_DIISI' AND j.status_kehadiran IS NULL)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC,
    j.jam_mulai ASC;
END$$
DELIMITER ;

-- [24] SP_LihatJadwalPengajar (pengajar)- Hapus p_urut karena tidak dipakai
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatJadwalPengajar`$$
CREATE PROCEDURE `SP_LihatJadwalPengajar`(
  IN p_id_pengajar VARCHAR(10),
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    j.jam_mulai,
    j.jam_akhir,
    j.deskripsiMateri,
    j.status_kehadiran,
    j.id_mapel,
    mp.nama_mapel,
    j.id_murid,
    m.nama_murid
  FROM jadwal j
  LEFT JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  LEFT JOIN murid m ON j.id_murid = m.id_murid
  WHERE j.id_pengajar = p_id_pengajar
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(j.tanggal) = MONTH(CURDATE()) AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'TERISI' AND j.id_murid IS NOT NULL)
      OR (UPPER(p_status) = 'KOSONG' AND j.id_murid IS NULL)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC,
    j.jam_mulai ASC;
END$$
DELIMITER ;

-- [25] SP_PilihJadwal (murid)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_PilihJadwal`$$
CREATE PROCEDURE `SP_PilihJadwal`(
  IN p_kode_jadwal VARCHAR(10),
  IN p_id_murid VARCHAR(10),
  IN p_id_pembelian VARCHAR(10)
)
BEGIN
  UPDATE jadwal
  SET id_murid = p_id_murid,
      id_pembelian = p_id_pembelian
  WHERE kode_jadwal = p_kode_jadwal
    AND id_murid IS NULL;

  IF ROW_COUNT() = 0 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Jadwal tidak tersedia atau sudah terisi';
  END IF;
END$$
DELIMITER ;

-- [26] SP_BatalPilihJadwal (murid, admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_BatalPilihJadwal`$$
CREATE PROCEDURE `SP_BatalPilihJadwal`(
  IN p_kode_jadwal VARCHAR(10),
  IN p_id_murid VARCHAR(10)
)
BEGIN
  UPDATE jadwal
  SET id_murid = NULL,
      id_pembelian = NULL,
      status_kehadiran = NULL,
      deskripsiMateri = NULL
  WHERE kode_jadwal = p_kode_jadwal
    AND id_murid = p_id_murid;

  IF ROW_COUNT() = 0 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Jadwal tidak ditemukan untuk murid ini';
  END IF;
END$$
DELIMITER ;

-- [27] SP_LihatPaketMurid (murid)- Butuh cek isinya agar sesuai fungsinya
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatPaketMurid`$$
CREATE PROCEDURE `SP_LihatPaketMurid`(
  IN p_id_murid VARCHAR(10),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT
    pd.id_pembelian,
    pd.id_murid,
    pd.id_paket,
    k.nama_paket,
    k.jml_pertemuan,
    k.masa_aktif_hari,
    k.harga,
    pd.tgl_pemesanan,
    pd.tgl_pembayaran,
    pd.gambar_bukti_pembayaran,
    pd.tgl_kedaluwarsa,
    pd.pertemuan_terpakai,
    (k.jml_pertemuan - pd.pertemuan_terpakai) AS sisa_pertemuan
  FROM paketdibeli pd
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  WHERE pd.id_murid = p_id_murid
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'BELUM_BAYAR' AND pd.tgl_pembayaran IS NULL)
      OR (UPPER(p_status) = 'AKTIF' AND pd.tgl_kedaluwarsa IS NOT NULL AND pd.tgl_kedaluwarsa >= CURDATE())
      OR (UPPER(p_status) = 'KEDALUWARSA' AND pd.tgl_kedaluwarsa IS NOT NULL AND pd.tgl_kedaluwarsa < CURDATE())
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN pd.tgl_pemesanan END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN pd.tgl_pemesanan END ASC;
END$$
DELIMITER ;

-- [28] SP_LihatPaketSemua (admin) - Hapus p_urut karena tidak dipakai
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_LihatPaketSemua`$$
CREATE PROCEDURE `SP_LihatPaketSemua`(
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT
    pd.id_pembelian,
    pd.id_murid,
    m.nama_murid,
    pd.id_paket,
    k.nama_paket,
    k.jml_pertemuan,
    k.masa_aktif_hari,
    k.harga,
    pd.tgl_pemesanan,
    pd.tgl_pembayaran,
    pd.gambar_bukti_pembayaran,
    pd.tgl_kedaluwarsa,
    pd.pertemuan_terpakai,
    (k.jml_pertemuan - pd.pertemuan_terpakai) AS sisa_pertemuan
  FROM paketdibeli pd
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  JOIN murid m ON pd.id_murid = m.id_murid
  WHERE (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'BELUM_BAYAR' AND pd.tgl_pembayaran IS NULL)
      OR (UPPER(p_status) = 'AKTIF' AND pd.tgl_kedaluwarsa IS NOT NULL AND pd.tgl_kedaluwarsa >= CURDATE())
      OR (UPPER(p_status) = 'KEDALUWARSA' AND pd.tgl_kedaluwarsa IS NOT NULL AND pd.tgl_kedaluwarsa < CURDATE())
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN pd.tgl_pemesanan END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN pd.tgl_pemesanan END ASC;
END$$
DELIMITER ;

-- [29] SP_UploadBuktiPembayaran (murid)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_UploadBuktiPembayaran`$$
CREATE PROCEDURE `SP_UploadBuktiPembayaran`(
  IN p_id_pembelian VARCHAR(10),
  IN p_id_murid VARCHAR(10),
  IN p_filename TEXT
)
BEGIN
  UPDATE paketdibeli
  SET gambar_bukti_pembayaran = p_filename
  WHERE id_pembelian = p_id_pembelian
    AND id_murid = p_id_murid;

  IF ROW_COUNT() = 0 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Pembelian tidak ditemukan untuk murid ini';
  END IF;
END$$
DELIMITER ;

-- [30] SP_SetujuiPembayaran (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_SetujuiPembayaran`$$
CREATE PROCEDURE `SP_SetujuiPembayaran`(IN p_id_pembelian VARCHAR(10))
BEGIN
  CALL SP_TandaiLunas(p_id_pembelian);
END$$
DELIMITER ;

-- [31] SP_TolakPembayaran (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_TolakPembayaran`$$
CREATE PROCEDURE `SP_TolakPembayaran`(IN p_id_pembelian VARCHAR(10))
BEGIN
  UPDATE paketdibeli
  SET tgl_pembayaran = NULL,
      tgl_kedaluwarsa = NULL,
      gambar_bukti_pembayaran = NULL
  WHERE id_pembelian = p_id_pembelian;
END$$
DELIMITER ;

-- [32] SP_TambahDiajar (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_TambahDiajar`$$
CREATE PROCEDURE `SP_TambahDiajar`(
  IN p_id_mapel VARCHAR(10),
  IN p_id_pengajar VARCHAR(10)
)
BEGIN
  IF EXISTS(
    SELECT 1 FROM diajar WHERE id_mapel = p_id_mapel AND id_pengajar = p_id_pengajar
  ) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Relasi diajar sudah ada';
  END IF;

  INSERT INTO diajar (id_mapel, id_pengajar)
  VALUES (p_id_mapel, p_id_pengajar);
END$$
DELIMITER ;

-- [33] SP_HapusDiajar (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_HapusDiajar`$$
CREATE PROCEDURE `SP_HapusDiajar`(IN p_id_diajar BIGINT)
BEGIN
  DELETE FROM diajar WHERE id_diajar = p_id_diajar;
END$$
DELIMITER ;

-- [34] SP_RiwayatKehadiranAdmin (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_RiwayatKehadiranAdmin`$$
CREATE PROCEDURE `SP_RiwayatKehadiranAdmin`(
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    j.jam_mulai,
    j.jam_akhir,
    j.status_kehadiran,
    j.deskripsiMateri,
    j.id_mapel,
    mp.nama_mapel,
    j.id_pengajar,
    p.nama_pengajar,
    j.id_murid,
    m.nama_murid
  FROM jadwal j
  LEFT JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  LEFT JOIN pengajar p ON j.id_pengajar = p.id_pengajar
  LEFT JOIN murid m ON j.id_murid = m.id_murid
  WHERE j.id_murid IS NOT NULL
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(j.tanggal) = MONTH(CURDATE()) AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'HADIR' AND j.status_kehadiran = 1)
      OR (UPPER(p_status) = 'TIDAK_HADIR' AND j.status_kehadiran = 0)
      OR (UPPER(p_status) = 'BELUM_DIISI' AND j.status_kehadiran IS NULL)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC,
    j.jam_mulai ASC;
END$$
DELIMITER ;

-- [35] SP_RiwayatKehadiranPengajar (pengajar)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_RiwayatKehadiranPengajar`$$
CREATE PROCEDURE `SP_RiwayatKehadiranPengajar`(
  IN p_id_pengajar VARCHAR(10),
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    j.jam_mulai,
    j.jam_akhir,
    j.status_kehadiran,
    j.deskripsiMateri,
    j.id_mapel,
    mp.nama_mapel,
    j.id_murid,
    m.nama_murid
  FROM jadwal j
  LEFT JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  LEFT JOIN murid m ON j.id_murid = m.id_murid
  WHERE j.id_pengajar = p_id_pengajar
    AND j.id_murid IS NOT NULL
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(j.tanggal) = MONTH(CURDATE()) AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'HADIR' AND j.status_kehadiran = 1)
      OR (UPPER(p_status) = 'TIDAK_HADIR' AND j.status_kehadiran = 0)
      OR (UPPER(p_status) = 'BELUM_DIISI' AND j.status_kehadiran IS NULL)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC,
    j.jam_mulai ASC;
END$$
DELIMITER ;

-- [36] SP_RiwayatKehadiranMurid (murid)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_RiwayatKehadiranMurid`$$
CREATE PROCEDURE `SP_RiwayatKehadiranMurid`(
  IN p_id_murid VARCHAR(10),
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    j.jam_mulai,
    j.jam_akhir,
    j.status_kehadiran,
    j.deskripsiMateri,
    j.id_mapel,
    mp.nama_mapel,
    j.id_pengajar,
    p.nama_pengajar
  FROM jadwal j
  LEFT JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  LEFT JOIN pengajar p ON j.id_pengajar = p.id_pengajar
  WHERE j.id_murid = p_id_murid
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(j.tanggal) = MONTH(CURDATE()) AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'HADIR' AND j.status_kehadiran = 1)
      OR (UPPER(p_status) = 'TIDAK_HADIR' AND j.status_kehadiran = 0)
      OR (UPPER(p_status) = 'BELUM_DIISI' AND j.status_kehadiran IS NULL)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC,
    j.jam_mulai ASC;
END$$
DELIMITER ;

-- --------------------------------------------------------
-- Triggers
-- --------------------------------------------------------

-- [01] TG_KurangiSisaPertemuanSetelahMilihJadwal
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_KurangiSisaPertemuanSetelahMilihJadwal`$$
CREATE TRIGGER `TG_KurangiSisaPertemuanSetelahMilihJadwal` AFTER INSERT ON `jadwal` FOR EACH ROW BEGIN
  IF NEW.id_murid IS NOT NULL THEN
    UPDATE paketdibeli
    SET pertemuan_terpakai = pertemuan_terpakai + 1
    WHERE id_pembelian = NEW.id_pembelian;
  END IF;
END
$$
DELIMITER ;

-- [02] TG_ValidasiInsertJadwal
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_ValidasiInsertJadwal`$$
CREATE TRIGGER `TG_ValidasiInsertJadwal` BEFORE INSERT ON `jadwal` FOR EACH ROW BEGIN
  DECLARE sisa INT;

    
  IF NEW.id_murid IS NOT NULL AND NEW.id_pembelian IS NULL THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Jadwal bermurid wajib punya paket';
  END IF;

    
  IF NEW.id_murid IS NOT NULL THEN
    IF (SELECT status FROM murid WHERE id_murid = NEW.id_murid) = 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Murid nonaktif tidak boleh membuat jadwal baru';
    END IF;
  END IF;

    
  IF NEW.id_pembelian IS NOT NULL THEN
    SELECT (k.jml_pertemuan - pd.pertemuan_terpakai)
    INTO sisa
    FROM paketdibeli pd
    JOIN katalogpaket k ON pd.id_paket = k.id_paket
    WHERE pd.id_pembelian = NEW.id_pembelian;

    IF sisa <= 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Kuota paket sudah habis';
    END IF;

    IF (SELECT tgl_kedaluwarsa FROM paketdibeli WHERE id_pembelian = NEW.id_pembelian) < NEW.tanggal THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Paket sudah kedaluwarsa';
    END IF;
  END IF;
END
$$
DELIMITER ;

-- [03] TG_ValidasiUpdateJadwal
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_ValidasiUpdateJadwal`$$
CREATE TRIGGER `TG_ValidasiUpdateJadwal` BEFORE UPDATE ON `jadwal` FOR EACH ROW BEGIN
  DECLARE sisa INT;

  IF NEW.id_murid IS NOT NULL AND NEW.id_pembelian IS NULL THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Jadwal bermurid wajib punya paket';
  END IF;

  IF NEW.id_murid IS NOT NULL THEN
    IF (SELECT status FROM murid WHERE id_murid = NEW.id_murid) = 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Murid nonaktif tidak boleh dipakai';
    END IF;
  END IF;

  IF NEW.id_pembelian IS NOT NULL THEN
    SELECT (k.jml_pertemuan - pd.pertemuan_terpakai)
    INTO sisa
    FROM paketdibeli pd
    JOIN katalogpaket k ON pd.id_paket = k.id_paket
    WHERE pd.id_pembelian = NEW.id_pembelian;

    IF sisa < 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Kuota paket tidak cukup';
    END IF;
  END IF;
END
$$
DELIMITER ;

-- [04] TG_LogTambahAkun_Murid
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogTambahAkun_Murid`$$
CREATE TRIGGER `TG_LogTambahAkun_Murid`
AFTER INSERT ON `murid`
FOR EACH ROW
BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Tambah akun murid: ', NEW.id_murid), COALESCE(@current_user_id, NEW.id_murid, 'SYSTEM'));
END$$
DELIMITER ;

-- [05] TG_LogEditAkun_Murid
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogEditAkun_Murid`$$
CREATE TRIGGER `TG_LogEditAkun_Murid`
AFTER UPDATE ON `murid`
FOR EACH ROW
BEGIN
  IF (NOT (OLD.nama_murid <=> NEW.nama_murid)
      OR NOT (OLD.email <=> NEW.email)
      OR NOT (OLD.password <=> NEW.password)) THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Edit akun murid: ', NEW.id_murid), COALESCE(@current_user_id, NEW.id_murid, 'SYSTEM'));
  END IF;
END$$
DELIMITER ;

-- [06] TG_LogUbahStatusAkun_Murid
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogUbahStatusAkun_Murid`$$
CREATE TRIGGER `TG_LogUbahStatusAkun_Murid`
AFTER UPDATE ON `murid`
FOR EACH ROW
BEGIN
  IF OLD.status <> NEW.status THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Ubah status akun murid: ', NEW.id_murid), COALESCE(@current_user_id, NEW.id_murid, 'SYSTEM'));
  END IF;
END$$
DELIMITER ;

-- [07] TG_LogTambahAkun_Pengajar
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogTambahAkun_Pengajar`$$
CREATE TRIGGER `TG_LogTambahAkun_Pengajar`
AFTER INSERT ON `pengajar`
FOR EACH ROW
BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Tambah akun pengajar: ', NEW.id_pengajar), COALESCE(@current_user_id, NEW.id_pengajar, 'SYSTEM'));
END$$
DELIMITER ;

-- [08] TG_LogEditAkun_Pengajar
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogEditAkun_Pengajar`$$
CREATE TRIGGER `TG_LogEditAkun_Pengajar`
AFTER UPDATE ON `pengajar`
FOR EACH ROW
BEGIN
  IF (NOT (OLD.nama_pengajar <=> NEW.nama_pengajar)
      OR NOT (OLD.email <=> NEW.email)
      OR NOT (OLD.password <=> NEW.password)) THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Edit akun pengajar: ', NEW.id_pengajar), COALESCE(@current_user_id, NEW.id_pengajar, 'SYSTEM'));
  END IF;
END$$
DELIMITER ;

-- [09] TG_LogUbahStatusAkun_Pengajar
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogUbahStatusAkun_Pengajar`$$
CREATE TRIGGER `TG_LogUbahStatusAkun_Pengajar`
AFTER UPDATE ON `pengajar`
FOR EACH ROW
BEGIN
  IF OLD.status <> NEW.status THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Ubah status akun pengajar: ', NEW.id_pengajar), COALESCE(@current_user_id, NEW.id_pengajar, 'SYSTEM'));
  END IF;
END$$
DELIMITER ;

-- [10] TG_LogTambahAkun_Admin
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogTambahAkun_Admin`$$
CREATE TRIGGER `TG_LogTambahAkun_Admin`
AFTER INSERT ON `admin`
FOR EACH ROW
BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Tambah akun admin: ', NEW.id_admin), COALESCE(@current_user_id, NEW.id_admin, 'SYSTEM'));
END$$
DELIMITER ;

-- [11] TG_LogEditAkun_Admin
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogEditAkun_Admin`$$
CREATE TRIGGER `TG_LogEditAkun_Admin`
AFTER UPDATE ON `admin`
FOR EACH ROW
BEGIN
  IF (NOT (OLD.nama_admin <=> NEW.nama_admin)
      OR NOT (OLD.email <=> NEW.email)
      OR NOT (OLD.password <=> NEW.password)) THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Edit akun admin: ', NEW.id_admin), COALESCE(@current_user_id, NEW.id_admin, 'SYSTEM'));
  END IF;
END$$
DELIMITER ;

-- [12] TG_LogUbahStatusAkun_Admin
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogUbahStatusAkun_Admin`$$
CREATE TRIGGER `TG_LogUbahStatusAkun_Admin`
AFTER UPDATE ON `admin`
FOR EACH ROW
BEGIN
  IF OLD.status <> NEW.status THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Ubah status akun admin: ', NEW.id_admin), COALESCE(@current_user_id, NEW.id_admin, 'SYSTEM'));
  END IF;
END$$
DELIMITER ;

-- [13] TG_LogTambahJadwal
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogTambahJadwal`$$
CREATE TRIGGER `TG_LogTambahJadwal`
AFTER INSERT ON `jadwal`
FOR EACH ROW
BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Tambah jadwal: ', NEW.kode_jadwal), COALESCE(@current_user_id, NEW.id_pengajar, NEW.id_murid, 'SYSTEM'));
END$$
DELIMITER ;

-- [14] TG_LogEditJadwal
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogEditJadwal`$$
CREATE TRIGGER `TG_LogEditJadwal`
AFTER UPDATE ON `jadwal`
FOR EACH ROW
BEGIN
  IF (
    NOT (OLD.tanggal <=> NEW.tanggal)
    OR NOT (OLD.jam_mulai <=> NEW.jam_mulai)
    OR NOT (OLD.jam_akhir <=> NEW.jam_akhir)
    OR NOT (OLD.id_mapel <=> NEW.id_mapel)
    OR NOT (OLD.id_pengajar <=> NEW.id_pengajar)
    OR NOT (OLD.id_murid <=> NEW.id_murid)
    OR NOT (OLD.id_pembelian <=> NEW.id_pembelian)
  ) THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Edit jadwal: ', NEW.kode_jadwal), COALESCE(@current_user_id, NEW.id_pengajar, NEW.id_murid, 'SYSTEM'));
  END IF;
END$$
DELIMITER ;

-- [15] TG_LogHapusJadwal
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogHapusJadwal`$$
CREATE TRIGGER `TG_LogHapusJadwal`
BEFORE DELETE ON `jadwal`
FOR EACH ROW
BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Hapus jadwal: ', OLD.kode_jadwal), COALESCE(@current_user_id, OLD.id_pengajar, OLD.id_murid, 'SYSTEM'));
END$$
DELIMITER ;

-- [16] TG_LogInputAbsensi
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogInputAbsensi`$$
CREATE TRIGGER `TG_LogInputAbsensi`
AFTER UPDATE ON `jadwal`
FOR EACH ROW
BEGIN
  IF (NOT (OLD.status_kehadiran <=> NEW.status_kehadiran)
      OR NOT (OLD.deskripsiMateri <=> NEW.deskripsiMateri)) THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Input absensi jadwal: ', NEW.kode_jadwal), COALESCE(@current_user_id, NEW.id_pengajar, NEW.id_murid, 'SYSTEM'));
  END IF;
END$$
DELIMITER ;

-- [17] TG_LogPembelianPaket
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogPembelianPaket`$$
CREATE TRIGGER `TG_LogPembelianPaket`
AFTER INSERT ON `paketdibeli`
FOR EACH ROW
BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Pembelian paket: ', NEW.id_pembelian), COALESCE(@current_user_id, NEW.id_murid, 'SYSTEM'));
END$$
DELIMITER ;

-- [18] TG_TambahPertemuanTerpakai_SetelahPilihJadwal (update slot -> terisi)
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_TambahPertemuanTerpakai_SetelahPilihJadwal`$$
CREATE TRIGGER `TG_TambahPertemuanTerpakai_SetelahPilihJadwal`
AFTER UPDATE ON `jadwal`
FOR EACH ROW
BEGIN
  IF OLD.id_murid IS NULL
     AND NEW.id_murid IS NOT NULL
     AND NEW.id_pembelian IS NOT NULL THEN
    UPDATE paketdibeli
    SET pertemuan_terpakai = pertemuan_terpakai + 1
    WHERE id_pembelian = NEW.id_pembelian;
  END IF;
END$$
DELIMITER ;

-- [19] TG_KembalikanPertemuanTerpakai_SetelahBatalJadwal (terisi -> kosong)
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_KembalikanPertemuanTerpakai_SetelahBatalJadwal`$$
CREATE TRIGGER `TG_KembalikanPertemuanTerpakai_SetelahBatalJadwal`
BEFORE UPDATE ON `jadwal`
FOR EACH ROW
BEGIN
  IF OLD.id_murid IS NOT NULL
     AND NEW.id_murid IS NULL
     AND OLD.id_pembelian IS NOT NULL THEN
    UPDATE paketdibeli
    SET pertemuan_terpakai = GREATEST(pertemuan_terpakai - 1, 0)
    WHERE id_pembelian = OLD.id_pembelian;
  END IF;
END$$
DELIMITER ;

-- [20] TG_KembalikanPertemuanTerpakai_SebelumHapusJadwal (hapus jadwal terisi)
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_KembalikanPertemuanTerpakai_SebelumHapusJadwal`$$
CREATE TRIGGER `TG_KembalikanPertemuanTerpakai_SebelumHapusJadwal`
BEFORE DELETE ON `jadwal`
FOR EACH ROW
BEGIN
  IF OLD.id_murid IS NOT NULL
     AND OLD.id_pembelian IS NOT NULL THEN
    UPDATE paketdibeli
    SET pertemuan_terpakai = GREATEST(pertemuan_terpakai - 1, 0)
    WHERE id_pembelian = OLD.id_pembelian;
  END IF;
END$$
DELIMITER ;

-- [21] TG_LogUploadBuktiPembayaran (murid upload bukti)
DELIMITER $$
DROP TRIGGER IF EXISTS `TG_LogUploadBuktiPembayaran`$$
CREATE TRIGGER `TG_LogUploadBuktiPembayaran`
AFTER UPDATE ON `paketdibeli`
FOR EACH ROW
BEGIN
  IF NOT (OLD.gambar_bukti_pembayaran <=> NEW.gambar_bukti_pembayaran) THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Upload bukti pembayaran: ', NEW.id_pembelian), COALESCE(@current_user_id, NEW.id_murid, 'SYSTEM'));
  END IF;
END$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
