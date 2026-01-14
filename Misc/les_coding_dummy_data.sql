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
('A001', 'Admin One', '123', 'admin1@mail.com', 1),
('A002', 'Admin Two', '123', 'admin2@mail.com', 1);

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
(1, 'MP001', 'P001'),
(2, 'MP002', 'P001'),
(3, 'MP003', 'P002'),
(4, 'MP005', 'P004');

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
('JD001', 'MP001', 'P001', 'M001', 'PB001', 'Variabel, Tipe Data, dan Operator', '2026-01-14', '08:00:00', '09:00:00', 1),
('JD002', 'MP001', 'P001', 'M001', 'PB001', NULL, '2026-01-13', '08:00:00', '09:00:00', 0),
('JD003', 'MP002', 'P001', 'M002', 'PB003', NULL, '2026-01-14', '09:00:00', '10:00:00', 0),
('JD004', 'MP002', 'P001', NULL, NULL, NULL, '2026-01-14', '10:00:00', '11:00:00', NULL),
('JD005', 'MP003', 'P002', 'M003', 'PB006', 'Form, Table, dan Layout Web', '2026-01-11', '08:00:00', '09:00:00', 1),
('JD006', 'MP003', 'P002', 'M003', 'PB006', NULL, '2026-01-04', '08:00:00', '09:00:00', 0),
('JD007', 'MP005', 'P004', 'M004', 'PB014', 'Materi', '2025-12-25', '08:00:00', '09:00:00', 1),
('JD008', 'MP005', 'P004', NULL, NULL, 'Pengenalan Database dan Tabel', '2025-12-25', '09:00:00', '10:00:00', NULL),
('JD009', 'MP001', 'P001', 'M005', 'PB008', 'Variabel, Tipe Data, dan Operator', '2026-01-14', '13:00:00', '14:00:00', 1),
('JD010', 'MP001', 'P001', 'M006', 'PB010', NULL, '2025-12-14', '08:00:00', '09:00:00', 0),
('JD011', 'MP002', 'P001', 'M001', 'PB001', 'Percabangan dan Perulangan', '2026-01-09', '08:00:00', '09:00:00', 1),
('JD012', 'MP002', 'P001', 'M002', 'PB003', NULL, '2026-01-07', '08:00:00', '09:00:00', 0),
('JD013', 'MP003', 'P002', 'M003', 'PB006', 'Form, Table, dan Layout Web', '2025-12-30', '08:00:00', '09:00:00', 1),
('JD014', 'MP005', 'P004', 'M005', 'PB008', 'Pengenalan Database dan Tabel', '2026-01-12', '08:00:00', '09:00:00', 0),
('JD015', 'MP001', 'P001', NULL, NULL, NULL, '2026-01-12', '10:00:00', '11:00:00', NULL),
('JD016', 'MP001', 'P001', 'M001', 'PB001', 'Percabangan dan Perulangan', '2026-01-15', '08:00:00', '09:00:00', 0),
('JD017', 'MP002', 'P001', 'M002', 'PB003', NULL, '2026-01-16', '08:00:00', '09:00:00', 0),
('JD018', 'MP003', 'P002', NULL, NULL, NULL, '2026-01-17', '08:00:00', '09:00:00', NULL),
('JD019', 'MP005', 'P004', 'M003', 'PB006', 'JOIN dan Query Lanjutan', '2026-01-14', '15:00:00', '16:00:00', 1),
('JD020', 'MP005', 'P004', 'M005', 'PB008', 'Pengenalan Database dan Tabel', '2026-01-08', '15:00:00', '16:00:00', 0),
('JD021', 'MP001', 'P001', 'M002', 'PB003', 'Variabel, Tipe Data, dan Operator', '2026-01-06', '08:00:00', '09:00:00', 1),
('JD022', 'MP002', 'P001', 'M003', 'PB006', 'Sorting dan Searching', '2026-01-02', '08:00:00', '09:00:00', 1),
('JD023', 'MP003', 'P002', 'M004', 'PB014', NULL, '2025-12-20', '08:00:00', '09:00:00', 0),
('JD024', 'MP005', 'P004', NULL, NULL, 'Pengenalan Database dan Tabel', '2025-12-20', '09:00:00', '10:00:00', NULL),
('JD025', 'MP001', 'P001', 'M005', 'PB008', 'Variabel, Tipe Data, dan Operator', '2025-12-15', '08:00:00', '09:00:00', 1),
('JD026', 'MP002', 'P001', 'M006', 'PB010', NULL, '2025-12-15', '08:00:00', '09:00:00', 0),
('JD027', 'MP003', 'P002', 'M001', 'PB001', 'Fungsi dan Prosedur', '2026-01-10', '08:00:00', '09:00:00', 1),
('JD028', 'MP005', 'P004', 'M002', 'PB003', 'Pengenalan Database dan Tabel', '2026-01-05', '08:00:00', '09:00:00', 0),
('JD029', 'MP001', 'P001', NULL, NULL, NULL, '2025-12-31', '10:00:00', '11:00:00', NULL),
('JD030', 'MP002', 'P001', 'M003', 'PB006', 'JOIN dan Query Lanjutan', '2026-01-14', '11:00:00', '12:00:00', 1);

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
('PK001', 'Paket 4x', 4, 30, 400000.00, 1),
('PK002', 'Paket 8x', 8, 60, 700000.00, 1),
('PK003', 'Paket 12x', 12, 90, 1000000.00, 1),
('PK004', 'Paket 4x Promo', 4, 30, 300000.00, 0),
('PK005', 'Paket 6x', 6, 45, 550000.00, 1),
('PK006', 'Paket Lama', 10, 60, 800000.00, 0);

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
('MP001', 'Dasar Pemrograman', 'Belajar logika dasar, variabel, dan alur program', 1),
('MP002', 'Web Development', 'Belajar HTML, CSS, dan dasar JavaScript', 1),
('MP003', 'PHP & MySQL', 'Membangun website dinamis dengan PHP dan database MySQL', 1),
('MP004', 'Java OOP', 'Belajar pemrograman berorientasi objek menggunakan Java', 0),
('MP005', 'Python Programming', 'Belajar Python untuk pemula sampai menengah', 1),
('MP006', 'Algoritma & Struktur Data', 'Belajar algoritma, array, stack, queue, dan sorting', 0);

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
('M001', 'Andika Saputra', 'andika.saputra@gmail.com', '123', 1),
('M002', 'Budi Hartono', 'budi.hartono@gmail.com', '123', 1),
('M003', 'Caca Ramadhani', 'caca.ramadhani@gmail.com', '123', 1),
('M004', 'Doni Kurniawan', 'doni.kurniawan@gmail.com', '123', 0),
('M005', 'Eka Puspita', 'eka.puspita@gmail.com', '123', 1),
('M006', 'Fani Wulandari', 'fani.wulandari@gmail.com', '123', 0);

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
('PB001', 'M001', 'PK001', '2026-01-14 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-13 21:38:00', 4),
('PB002', 'M001', 'PK002', '2026-01-11 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-03-15 21:38:00', 0),
('PB003', 'M002', 'PK001', '2026-01-04 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-13 21:38:00', 4),
('PB004', 'M002', 'PK003', '2025-12-05 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-04-14 21:38:00', 0),
('PB005', 'M003', 'PK002', '2026-01-14 21:38:00', NULL, NULL, NULL, 0),
('PB006', 'M003', 'PK001', '2025-12-25 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-13 21:38:00', 4),
('PB007', 'M004', 'PK005', '2026-01-12 21:38:00', NULL, NULL, NULL, 0),
('PB008', 'M005', 'PK001', '2026-01-14 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-13 21:38:00', 4),
('PB009', 'M005', 'PK002', '2026-01-07 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-03-15 21:38:00', 0),
('PB010', 'M006', 'PK003', '2025-12-30 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-04-14 21:38:00', 2),
('PB011', 'M001', 'PK005', '2026-01-13 21:38:00', NULL, NULL, NULL, 0),
('PB012', 'M002', 'PK005', '2026-01-14 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-28 21:38:00', 0),
('PB013', 'M003', 'PK001', '2026-01-09 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-02-13 21:38:00', 0),
('PB014', 'M004', 'PK002', '2025-11-15 21:38:00', '2026-01-14 21:38:00', 'bukti_20260114213800782000.jpg', '2026-03-15 21:38:00', 2),
('PB015', 'M005', 'PK003', '2026-01-14 21:38:00', NULL, NULL, NULL, 0);

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
('P001', 'Dr. Budi Santoso, S.Kom', 'budi.santoso@gmail.com', '123', 1),
('P002', 'Andi Pratama, M.T.', 'andi.pratama@gmail.com', '123', 1),
('P003', 'Citra Lestari, M.Kom', 'citra.lestari@gmail.com', '123', 0),
('P004', 'Dewi Anggraini, S.Kom', 'dewi.anggraini@gmail.com', '123', 1);

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

-- (isi nanti)

-- --------------------------------------------------------
-- Views
-- --------------------------------------------------------

-- (isi nanti)

-- --------------------------------------------------------
-- Stored Procedures
-- --------------------------------------------------------

-- (isi nanti)

-- --------------------------------------------------------
-- Triggers
-- --------------------------------------------------------

-- Triggers `jadwal`
DELIMITER $$
CREATE TRIGGER `TG_KurangiSisaPertemuanSetelahMilihJadwal` AFTER INSERT ON `jadwal` FOR EACH ROW BEGIN
  IF NEW.id_murid IS NOT NULL THEN
    UPDATE paketdibeli
    SET pertemuan_terpakai = pertemuan_terpakai + 1
    WHERE id_pembelian = NEW.id_pembelian;
  END IF;
END
$$
DELIMITER ;

DELIMITER $$
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

DELIMITER $$
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
