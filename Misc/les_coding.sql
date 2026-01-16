-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jan 2026 pada 11.16
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `les_coding`
--

/* =========================================================
   DATABASE SISTEM LES – FORMAT KODE BARU
   MySQL 8.x
   PREFIX-YYMMXXX (AKUN & TRANSAKSI)
   PREFIX-XXXXX   (MASTER DATA)
   ========================================================= */

SET FOREIGN_KEY_CHECKS = 0;

/* =========================================================
   TABEL AKUN
   ========================================================= */

CREATE TABLE admin (
  id_admin VARCHAR(20) NOT NULL,
  nama_admin VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  status TINYINT(1) NOT NULL,
  PRIMARY KEY (id_admin)
) ENGINE=InnoDB;

CREATE TABLE log_sistem ( 
  id_log bigint(20) UNSIGNED NOT NULL,
  tanggal datetime NOT NULL, aktivitas text NOT NULL, 
  id_akun varchar(10) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE murid (
  id_murid VARCHAR(20) NOT NULL,
  nama_murid VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  status TINYINT(1) NOT NULL,
  PRIMARY KEY (id_murid)
) ENGINE=InnoDB;

CREATE TABLE pengajar (
  id_pengajar VARCHAR(20) NOT NULL,
  nama_pengajar VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  status TINYINT(1) NOT NULL,
  PRIMARY KEY (id_pengajar)
) ENGINE=InnoDB;

/* =========================================================
   MASTER DATA
   ========================================================= */

CREATE TABLE katalogpaket (
  id_paket VARCHAR(20) NOT NULL,
  nama_paket VARCHAR(255) NOT NULL,
  jml_pertemuan INT NOT NULL,
  masa_aktif_hari INT NOT NULL,
  harga DECIMAL(12,2) NOT NULL,
  status_dijual TINYINT(1) NOT NULL,
  PRIMARY KEY (id_paket)
) ENGINE=InnoDB;

CREATE TABLE mata_pelajaran (
  id_mapel VARCHAR(20) NOT NULL,
  nama_mapel VARCHAR(255) NOT NULL,
  deskripsiMapel TEXT NOT NULL,
  status TINYINT(1) NOT NULL,
  PRIMARY KEY (id_mapel)
) ENGINE=InnoDB;

/* =========================================================
   TRANSAKSI
   ========================================================= */

CREATE TABLE paketdibeli (
  id_pembelian VARCHAR(20) NOT NULL,
  id_murid VARCHAR(20) NOT NULL,
  id_paket VARCHAR(20) NOT NULL,
  tgl_pemesanan DATETIME NOT NULL,
  tgl_pembayaran DATETIME DEFAULT NULL,
  gambar_bukti_pembayaran TEXT DEFAULT NULL,
  tgl_kedaluwarsa DATETIME DEFAULT NULL,
  pertemuan_terpakai INT NOT NULL,
  PRIMARY KEY (id_pembelian),
  CONSTRAINT fk_paketdibeli_murid
    FOREIGN KEY (id_murid) REFERENCES murid(id_murid),
  CONSTRAINT fk_paketdibeli_paket
    FOREIGN KEY (id_paket) REFERENCES katalogpaket(id_paket)
) ENGINE=InnoDB;

CREATE TABLE jadwal (
  kode_jadwal VARCHAR(20) NOT NULL,
  id_mapel VARCHAR(20),
  id_pengajar VARCHAR(20),
  id_murid VARCHAR(20),
  id_pembelian VARCHAR(20),
  deskripsiMateri TEXT,
  tanggal DATE NOT NULL,
  jam_mulai TIME NOT NULL,
  jam_akhir TIME NOT NULL,
  status_kehadiran TINYINT(1),
  PRIMARY KEY (kode_jadwal),
  CONSTRAINT fk_jadwal_mapel
    FOREIGN KEY (id_mapel) REFERENCES mata_pelajaran(id_mapel),
  CONSTRAINT fk_jadwal_pengajar
    FOREIGN KEY (id_pengajar) REFERENCES pengajar(id_pengajar),
  CONSTRAINT fk_jadwal_murid
    FOREIGN KEY (id_murid) REFERENCES murid(id_murid),
  CONSTRAINT fk_jadwal_pembelian
    FOREIGN KEY (id_pembelian) REFERENCES paketdibeli(id_pembelian)
) ENGINE=InnoDB;

CREATE TABLE diajar (
  id_diajar BIGINT AUTO_INCREMENT PRIMARY KEY,
  id_mapel VARCHAR(20) NOT NULL,
  id_pengajar VARCHAR(20) NOT NULL,
  CONSTRAINT fk_diajar_mapel
    FOREIGN KEY (id_mapel) REFERENCES mata_pelajaran(id_mapel),
  CONSTRAINT fk_diajar_pengajar
    FOREIGN KEY (id_pengajar) REFERENCES pengajar(id_pengajar)
) ENGINE=InnoDB;

/* =========================================================
   INSERT DATA
   ========================================================= */

/* =========================================================
   ADMIN
   ========================================================= */
INSERT INTO admin (id_admin, nama_admin, password, email, status) VALUES
('A-2601001', 'Gavin Malik Setiawan', '$2y$10$3ReuY0KcUSANi6NvPpl8e.7Fj6z0iXBr5PTvaiCzJahmRqdmuqgTq', 'gavin@gavin.com', 1),
('A-2601002', 'Admin One', '123', 'admin1@mail.com', 1),
('A-2601003', 'Admin Two', '123', 'admin2@mail.com', 1);

/* =========================================================
   MURID
   ========================================================= */
INSERT INTO murid (id_murid, nama_murid, email, password, status) VALUES
('M-2601001', 'Andika Saputra', 'andika.saputra@gmail.com', '123', 1),
('M-2601002', 'Budi Hartono', 'budi.hartono@gmail.com', '123', 1),
('M-2601003', 'Caca Ramadhani', 'caca.ramadhani@gmail.com', '123', 1),
('M-2601004', 'Doni Kurniawan', 'doni.kurniawan@gmail.com', '123', 0),
('M-2601005', 'Eka Puspita', 'eka.puspita@gmail.com', '123', 1),
('M-2601006', 'Fani Wulandari', 'fani.wulandari@gmail.com', '123', 0);

/* =========================================================
   MATA PELAJARAN
   ========================================================= */
INSERT INTO mata_pelajaran (id_mapel, nama_mapel, deskripsiMapel, status) VALUES
('MP-00001', 'Dasar Pemrograman', 'Belajar logika dasar, variabel, dan alur program', 1),
('MP-00002', 'Web Development', 'Belajar HTML, CSS, dan dasar JavaScript', 1),
('MP-00003', 'PHP & MySQL', 'Membangun website dinamis dengan PHP dan database MySQL', 1),
('MP-00004', 'Java OOP', 'Belajar pemrograman berorientasi objek menggunakan Java', 0),
('MP-00005', 'Python Programming', 'Belajar Python untuk pemula sampai menengah', 1),
('MP-00006', 'Algoritma & Struktur Data', 'Belajar algoritma, array, stack, queue, dan sorting', 0);

/* =========================================================
   KATALOG PAKET
   ========================================================= */
INSERT INTO katalogpaket (id_paket, nama_paket, jml_pertemuan, masa_aktif_hari, harga, status_dijual) VALUES
('PK-00001', 'Paket 4x', 4, 30, 400000.00, 1),
('PK-00002', 'Paket 8x', 8, 60, 700000.00, 1),
('PK-00003', 'Paket 12x', 12, 90, 1000000.00, 1),
('PK-00004', 'Paket 4x Promo', 4, 30, 300000.00, 0),
('PK-00005', 'Paket 6x', 6, 45, 550000.00, 1),
('PK-00006', 'Paket Lama', 10, 60, 800000.00, 0);


/* =========================================================
   PAKET DIBELI
   ========================================================= */
INSERT INTO paketdibeli (id_pembelian, id_murid, id_paket, tgl_pemesanan, tgl_pembayaran, gambar_bukti_pembayaran, tgl_kedaluwarsa, pertemuan_terpakai) VALUES
('PB-2601001', 'M-2601001', 'PK-00001', '2026-01-14 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-02-13 21:38:00', 4),
('PB-2601002', 'M-2601001', 'PK-00002', '2026-01-11 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-03-15 21:38:00', 0),
('PB-2601003', 'M-2601002', 'PK-00001', '2026-01-04 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-02-13 21:38:00', 4),
('PB-2512001', 'M-2601002', 'PK-00003', '2025-12-05 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-04-14 21:38:00', 0),
('PB-2601004', 'M-2601003', 'PK-00002', '2026-01-14 21:38:00', NULL, NULL, NULL, 0),
('PB-2512002', 'M-2601003', 'PK-00001', '2025-12-25 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-02-13 21:38:00', 4),
('PB-2601005', 'M-2601004', 'PK-00005', '2026-01-12 21:38:00', NULL, NULL, NULL, 0),
('PB-2601006', 'M-2601005', 'PK-00001', '2026-01-14 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-02-13 21:38:00', 4),
('PB-2601007', 'M-2601005', 'PK-00002', '2026-01-07 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-03-15 21:38:00', 0),
('PB-2512003', 'M-2601006', 'PK-00003', '2025-12-30 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-04-14 21:38:00', 2);

/* =========================================================
   JADWAL
   ========================================================= */
INSERT INTO jadwal (kode_jadwal, id_mapel, id_pengajar, id_murid, id_pembelian, deskripsiMateri, tanggal, jam_mulai, jam_akhir, status_kehadiran) VALUES
('JD-2601001', 'MP-00001', 'P-2601001', 'M-2601001', 'PB-2601001', 'Variabel, Tipe Data, dan Operator', '2026-01-14', '08:00:00', '09:00:00', 1),
('JD-2601002', 'MP-00001', 'P-2601001', 'M-2601001', 'PB-2601001', NULL, '2026-01-13', '08:00:00', '09:00:00', 0),
('JD-2601003', 'MP-00002', 'P-2601001', 'M-2601002', 'PB-2601003', NULL, '2026-01-14', '09:00:00', '10:00:00', 0),
('JD-2601004', 'MP-00002', 'P-2601001', NULL, NULL, NULL, '2026-01-14', '10:00:00', '11:00:00', NULL),
('JD-2512001', 'MP-00005', 'P-2601004', 'M-2601004', 'PB-2512003', 'Materi', '2025-12-25', '08:00:00', '09:00:00', 1),
('JD-2601005', 'MP-00003', 'P-2601002', 'M-2601003', 'PB-2512002', 'Form, Table, dan Layout Web', '2026-01-11', '08:00:00', '09:00:00', 1),
('JD-2601006', 'MP-00003', 'P-2601002', 'M-2601003', 'PB-2512002', NULL, '2026-01-04', '08:00:00', '09:00:00', 0),
('JD-2512002', 'MP-00005', 'P-2601004', 'M-2601004', 'PB-2512003', 'Materi', '2025-12-25', '08:00:00', '09:00:00', 1),
('JD-2512003', 'MP-00005', 'P-2601004', NULL, NULL, 'Pengenalan Database dan Tabel', '2025-12-25', '09:00:00', '10:00:00', NULL),
('JD-2601007', 'MP-00001', 'P-2601001', 'M-2601005', 'PB-2601006', 'Variabel, Tipe Data, dan Operator', '2026-01-14', '13:00:00', '14:00:00', 1),
('JD-2512004', 'MP-00001', 'P-2601001', 'M-2601006', 'PB-2512003', NULL, '2025-12-14', '08:00:00', '09:00:00', 0),
('JD-2601008', 'MP-00002', 'P-2601001', 'M-2601001', 'PB-2601001', 'Percabangan dan Perulangan', '2026-01-09', '08:00:00', '09:00:00', 1),
('JD-2601009', 'MP-00002', 'P-2601001', 'M-2601002', 'PB-2601003', NULL, '2026-01-07', '08:00:00', '09:00:00', 0),
('JD-2512005', 'MP-00003', 'P-2601002', 'M-2601003', 'PB-2512002', 'Form, Table, dan Layout Web', '2025-12-30', '08:00:00', '09:00:00', 1),
('JD-2601010', 'MP-00005', 'P-2601004', 'M-2601005', 'PB-2601006', 'Pengenalan Database dan Tabel', '2026-01-12', '08:00:00', '09:00:00', 0),
('JD-2601011', 'MP-00001', 'P-2601001', NULL, NULL, NULL, '2026-01-12', '10:00:00', '11:00:00', NULL),
('JD-2601012', 'MP-00001', 'P-2601001', 'M-2601001', 'PB-2601001', 'Percabangan dan Perulangan', '2026-01-15', '08:00:00', '09:00:00', 0),
('JD-2601013', 'MP-00002', 'P-2601001', 'M-2601002', 'PB-2601003', NULL, '2026-01-16', '08:00:00', '09:00:00', 0),
('JD-2601014', 'MP-00003', 'P-2601002', NULL, NULL, NULL, '2026-01-17', '08:00:00', '09:00:00', NULL),
('JD-2601015', 'MP-00005', 'P-2601004', 'M-2601003', 'PB-2512002', 'JOIN dan Query Lanjutan', '2026-01-14', '15:00:00', '16:00:00', 1),
('JD-2601016', 'MP-00005', 'P-2601004', 'M-2601005', 'PB-2601006', 'Pengenalan Database dan Tabel', '2026-01-08', '15:00:00', '16:00:00', 0),
('JD-2601017', 'MP-00001', 'P-2601001', 'M-2601002', 'PB-2601003', 'Variabel, Tipe Data, dan Operator', '2026-01-06', '08:00:00', '09:00:00', 1),
('JD-2601018', 'MP-00002', 'P-2601001', 'M-2601003', 'PB-2512002', 'Sorting dan Searching', '2026-01-02', '08:00:00', '09:00:00', 1),
('JD-2512006', 'MP-00003', 'P-2601002', 'M-2601004', 'PB-2512003', NULL, '2025-12-20', '08:00:00', '09:00:00', 0),
('JD-2512007', 'MP-00005', 'P-2601004', NULL, NULL, 'Pengenalan Database dan Tabel', '2025-12-20', '09:00:00', '10:00:00', NULL),
('JD-2512008', 'MP-00001', 'P-2601001', 'M-2601005', 'PB-2601006', 'Variabel, Tipe Data, dan Operator', '2025-12-15', '08:00:00', '09:00:00', 1),
('JD-2512009', 'MP-00002', 'P-2601001', 'M-2601006', 'PB-2512003', NULL, '2025-12-15', '08:00:00', '09:00:00', 0),
('JD-2601019', 'MP-00003', 'P-2601002', 'M-2601001', 'PB-2601001', 'Fungsi dan Prosedur', '2026-01-10', '08:00:00', '09:00:00', 1),
('JD-2601020', 'MP-00005', 'P-2601004', 'M-2601002', 'PB-2601003', 'Pengenalan Database dan Tabel', '2026-01-05', '08:00:00', '09:00:00', 0),
('JD-2512010', 'MP-00001', 'P-2601001', NULL, NULL, NULL, '2025-12-31', '10:00:00', '11:00:00', NULL),
('JD-2601021', 'MP-00002', 'P-2601001', 'M-2601003', 'PB-2512002', 'JOIN dan Query Lanjutan', '2026-01-14', '11:00:00', '12:00:00', 1);

-- --------------------------------------------------------
-- PENGAJAR
-- --------------------------------------------------------

INSERT INTO pengajar (id_pengajar, nama_pengajar, email, password, status) VALUES
('P-2601001', 'Pengajar Andi', 'andi.pengajar@mail.com', '123', 1),
('P-2601002', 'Pengajar Bima', 'bima.pengajar@mail.com', '123', 1),
('P-2601003', 'Pengajar Citra', 'citra.pengajar@mail.com', '123', 0),
('P-2601004', 'Pengajar Dewa', 'dewa.pengajar@mail.com', '123', 1);

-- --------------------------------------------------------
-- DIAJAR
-- --------------------------------------------------------

INSERT INTO diajar (id_diajar, id_mapel, id_pengajar) VALUES
(1, 'MP-00001', 'P-2601001'),
(2, 'MP-00002', 'P-2601001'),
(3, 'MP-00003', 'P-2601002'),
(4, 'MP-00005', 'P-2601004');

-- --------------------------------------------------------
-- LOG_SISTEM
-- --------------------------------------------------------

INSERT INTO log_sistem (id_log, tanggal, aktivitas, id_akun) VALUES
(1, '2026-01-14 21:40:00', 'Admin menambahkan data jadwal', 'A-00001'),
(2, '2026-01-14 21:42:00', 'Murid melakukan pembelian paket', 'M-2601001'),
(3, '2026-01-14 21:45:00', 'Admin memverifikasi pembayaran', 'A-00001'),
(4, '2026-01-15 08:05:00', 'Pengajar mengisi materi jadwal', 'P-2601001');


SET FOREIGN_KEY_CHECKS = 1;

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
  m.id_mapel,
  m.nama_mapel,
  m.deskripsiMapel,
  m.status,
  GROUP_CONCAT(p.nama_pengajar SEPARATOR ', ') AS daftar_pengajar
FROM mata_pelajaran m
LEFT JOIN diajar d ON d.id_mapel = m.id_mapel
LEFT JOIN pengajar p ON p.id_pengajar = d.id_pengajar
WHERE m.status = 1
GROUP BY m.id_mapel;

-- [05] view_MataPelajaranNonaktif (admin)
DROP VIEW IF EXISTS `view_MataPelajaranNonaktif`;

CREATE VIEW `view_MataPelajaranNonaktif` AS
SELECT
  m.id_mapel,
  m.nama_mapel,
  m.deskripsiMapel,
  m.status,
  GROUP_CONCAT(p.nama_pengajar SEPARATOR ', ') AS daftar_pengajar
FROM mata_pelajaran m
LEFT JOIN diajar d ON d.id_mapel = m.id_mapel
LEFT JOIN pengajar p ON p.id_pengajar = d.id_pengajar
WHERE m.status = 0
GROUP BY m.id_mapel;

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
  DECLARE v_new_id VARCHAR(20);
  DECLARE v_ym VARCHAR(4);

  SET v_ym = DATE_FORMAT(CURDATE(), '%y%m');

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

    SELECT IFNULL(
      MAX(CAST(RIGHT(id_murid, 3) AS UNSIGNED)), 0
    )
    INTO v_last_id
    FROM murid
    WHERE id_murid LIKE CONCAT('M-', v_ym, '%');

    SET v_new_id = CONCAT('M-', v_ym, LPAD(v_last_id + 1, 3, '0'));

    INSERT INTO murid (id_murid, nama_murid, email, password, status)
    VALUES (v_new_id, p_nama, p_email, p_password, 1);

  -- ROLE: PENGAJAR
  ELSEIF LOWER(p_role) = 'pengajar' THEN

    SELECT IFNULL(
      MAX(CAST(RIGHT(id_pengajar, 3) AS UNSIGNED)), 0
    )
    INTO v_last_id
    FROM pengajar
    WHERE id_pengajar LIKE CONCAT('P-', v_ym, '%');

    SET v_new_id = CONCAT('P-', v_ym, LPAD(v_last_id + 1, 3, '0'));

    INSERT INTO pengajar (id_pengajar, nama_pengajar, email, password, status)
    VALUES (v_new_id, p_nama, p_email, p_password, 1);

  -- ROLE: ADMIN
  ELSEIF LOWER(p_role) = 'admin' THEN

    SELECT IFNULL(
      MAX(CAST(RIGHT(id_admin, 3) AS UNSIGNED)), 0
    )
    INTO v_last_id
    FROM admin
    WHERE id_admin LIKE CONCAT('A-', v_ym, '%');

    SET v_new_id = CONCAT('A-', v_ym, LPAD(v_last_id + 1, 3, '0'));

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
  IN p_id VARCHAR(20),
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
  IN p_id VARCHAR(20),
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
  IN p_id VARCHAR(20),
  IN p_nama VARCHAR(255),
  IN p_jml INT,
  IN p_masa INT,
  IN p_harga DECIMAL(12,2),
  IN p_status TINYINT(1)
)
BEGIN
  INSERT INTO katalogpaket (
    id_paket,
    nama_paket,
    jml_pertemuan,
    masa_aktif_hari,
    harga,
    status_dijual
  )
  VALUES (
    p_id,
    p_nama,
    p_jml,
    p_masa,
    p_harga,
    p_status
  );
END$$
DELIMITER ;


-- [06] SP_EditPaketLes (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_EditPaketLes`$$
CREATE PROCEDURE `SP_EditPaketLes`(
  IN p_id VARCHAR(20),
  IN p_nama VARCHAR(255),
  IN p_jml INT,
  IN p_masa INT,
  IN p_harga DECIMAL(12,2),
  IN p_status TINYINT(1)
)
BEGIN
  UPDATE katalogpaket
  SET nama_paket = p_nama,
      jml_pertemuan = p_jml,
      masa_aktif_hari = p_masa,
      harga = p_harga,
      status_dijual = p_status
  WHERE id_paket = p_id;
END$$
DELIMITER ;

-- [07] SP_UbahStatusPaketLes (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_UbahStatusPaketLes`$$
CREATE PROCEDURE `SP_UbahStatusPaketLes`(
  IN p_id VARCHAR(20),
  IN p_status TINYINT(1)
)
BEGIN
  UPDATE katalogpaket
  SET status_dijual = p_status
  WHERE id_paket = p_id;
END$$
DELIMITER ;

-- [08] SP_TambahMapel (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_TambahMapel`$$
CREATE PROCEDURE `SP_TambahMapel`(
  IN p_id VARCHAR(20),
  IN p_nama VARCHAR(255),
  IN p_desc TEXT,
  IN p_status TINYINT(1)
)
BEGIN
  IF EXISTS(SELECT 1 FROM mata_pelajaran WHERE nama_mapel = p_nama) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Nama mata pelajaran sudah ada';
  END IF;

  INSERT INTO mata_pelajaran (
    id_mapel,
    nama_mapel,
    deskripsiMapel,
    status
  )
  VALUES (
    p_id,
    p_nama,
    p_desc,
    p_status
  );
END$$
DELIMITER ;

-- [08A] SP_TambahDiajar (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_TambahDiajar`$$
CREATE PROCEDURE `SP_TambahDiajar`(
  IN p_id_mapel VARCHAR(20),
  IN p_id_pengajar VARCHAR(20)
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

-- [08B] SP_HapusDiajar (admin)
DROP PROCEDURE IF EXISTS `SP_HapusDiajar`$$
CREATE PROCEDURE `SP_HapusDiajar`(
  IN p_id_mapel VARCHAR(20),
  IN p_id_pengajar VARCHAR(20)
)
BEGIN
  DELETE FROM diajar 
  WHERE id_mapel = p_id_mapel 
    AND id_pengajar = p_id_pengajar;
END$$
DELIMITER ;

-- [09] SP_EditMapel (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_EditMapel`$$
CREATE PROCEDURE `SP_EditMapel`(
  IN p_id VARCHAR(20),
  IN p_nama VARCHAR(255),
  IN p_desc TEXT,
  IN p_status TINYINT(1)
)
BEGIN
  UPDATE mata_pelajaran
  SET 
    nama_mapel = p_nama,
    deskripsiMapel = p_desc,
    status = p_status
  WHERE id_mapel = p_id;
END$$
DELIMITER ;

-- [10] SP_UbahStatusMapel (admin)
DELIMITER $$
DROP PROCEDURE IF EXISTS `SP_UbahStatusMapel`$$
CREATE PROCEDURE `SP_UbahStatusMapel`(
  IN p_id VARCHAR(20),
  IN p_status TINYINT(1)
)
BEGIN
  UPDATE mata_pelajaran
  SET status = p_status
  WHERE id_mapel = p_id;
END$$
DELIMITER ;

-- [11] SP_LihatPembelianPaket (admin)
DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_LihatPembelianPaket`$$
CREATE PROCEDURE `SP_LihatPembelianPaket`(
  IN p_periode VARCHAR(20),
  IN p_status_bukti VARCHAR(20)
)
BEGIN
  SELECT
    pd.id_pembelian,
    pd.tgl_pemesanan,
    m.nama_murid,
    k.nama_paket,
    k.harga AS jumlah,
    CASE
      WHEN pd.gambar_bukti_pembayaran IS NULL OR pd.gambar_bukti_pembayaran = ''
        THEN 'MENUNGGU_BUKTI'
      WHEN pd.status_pembayaran = 'LUNAS'
        THEN 'LUNAS'
      ELSE 'MENUNGGU_VERIFIKASI'
    END AS status_bukti
  FROM paketdibeli pd
  JOIN murid m ON pd.id_murid = m.id_murid
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  WHERE (
    UPPER(p_periode) = 'SEMUA'
    OR (UPPER(p_periode) = 'HARI_INI' AND DATE(pd.tgl_pemesanan) = CURDATE())
    OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(pd.tgl_pemesanan, 1) = YEARWEEK(CURDATE(), 1))
    OR (UPPER(p_periode) = 'BULAN_INI'
        AND MONTH(pd.tgl_pemesanan) = MONTH(CURDATE())
        AND YEAR(pd.tgl_pemesanan) = YEAR(CURDATE()))
  )
  AND (
    UPPER(p_status_bukti) = 'SEMUA'
    OR (UPPER(p_status_bukti) = 'SUDAH'
        AND pd.gambar_bukti_pembayaran IS NOT NULL
        AND pd.gambar_bukti_pembayaran <> '')
    OR (UPPER(p_status_bukti) = 'BELUM'
        AND (pd.gambar_bukti_pembayaran IS NULL
        OR pd.gambar_bukti_pembayaran = ''))
  )
  ORDER BY pd.tgl_pemesanan DESC;
END$$

DELIMITER ;

-- <select name="status_bukti">
--   <option value="SEMUA">Semua</option>
--   <option value="SUDAH">Sudah Upload</option>
--   <option value="BELUM">Belum Upload</option>
-- </select>

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
  SET
    pd.status_pembayaran = 'LUNAS',
    pd.tgl_pembayaran = NOW(),
    pd.tgl_kedaluwarsa = DATE_ADD(NOW(), INTERVAL k.masa_aktif_hari DAY)
  WHERE pd.id_pembelian = p_id
    AND pd.gambar_bukti_pembayaran IS NOT NULL
    AND pd.gambar_bukti_pembayaran <> '';
END$$

DELIMITER ;

-- [14] SP_LihatRiwayatPembelian (admin)

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_LihatRiwayatPembelian`$$
CREATE PROCEDURE `SP_LihatRiwayatPembelian`(
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20)
)
BEGIN
  SELECT
    pd.id_pembelian,
    pd.tgl_pemesanan,
    pd.tgl_pembayaran,
    m.nama_murid,
    k.nama_paket,
    k.harga,
    CASE
      WHEN pd.tgl_kedaluwarsa IS NULL THEN NULL
      WHEN pd.tgl_kedaluwarsa < CURDATE() THEN 'KADALUWARSA'
      ELSE CONCAT(DATEDIFF(pd.tgl_kedaluwarsa, CURDATE()), ' hari')
    END AS masa_aktif,
    CASE
      WHEN pd.tgl_kedaluwarsa IS NOT NULL
           AND pd.tgl_kedaluwarsa >= CURDATE()
        THEN 'AKTIF'
      ELSE 'KEDALUWARSA'
    END AS status
  FROM paketdibeli pd
  JOIN murid m ON pd.id_murid = m.id_murid
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  WHERE pd.tgl_pembayaran IS NOT NULL
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND DATE(pd.tgl_pembayaran) = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI'
          AND YEARWEEK(pd.tgl_pembayaran, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI'
          AND MONTH(pd.tgl_pembayaran) = MONTH(CURDATE())
          AND YEAR(pd.tgl_pembayaran) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'AKTIF'
          AND pd.tgl_kedaluwarsa >= CURDATE())
      OR (UPPER(p_status) = 'KEDALUWARSA'
          AND pd.tgl_kedaluwarsa < CURDATE())
    )
  ORDER BY pd.tgl_pembayaran DESC;
END$$

DELIMITER ;

-- [15] SP_DetailPembelianPaket (admin)
-- Untuk header modal detail sisa pertemuan

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_DetailPembelianPaket`$$
CREATE PROCEDURE `SP_DetailPembelianPaket`(IN p_id VARCHAR(10))
BEGIN
  SELECT
    pd.id_pembelian,
    m.nama_murid,
    k.jumlah_pertemuan,
    (
      k.jumlah_pertemuan -
      IFNULL((
        SELECT COUNT(*)
        FROM pertemuan
        WHERE id_pembelian = pd.id_pembelian
      ), 0)
    ) AS sisa_pertemuan
  FROM paketdibeli pd
  JOIN murid m ON pd.id_murid = m.id_murid
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  WHERE pd.id_pembelian = p_id;
END$$

DELIMITER ;

-- [16] SP_ListPertemuanTerpakai (admin)
-- List pertemuan yang sudah dipakai

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_ListPertemuanTerpakai`$$
CREATE PROCEDURE `SP_ListPertemuanTerpakai`(IN p_id VARCHAR(10))
BEGIN
  SELECT
    ROW_NUMBER() OVER (ORDER BY p.tgl_pertemuan) AS ke,
    CONCAT(
      DATE_FORMAT(p.tgl_pertemuan, '%d %b %Y'),
      ' ',
      TIME_FORMAT(p.jam_mulai, '%H:%i'),
      ' - ',
      TIME_FORMAT(p.jam_selesai, '%H:%i')
    ) AS tanggal_waktu,
    g.nama_pengajar,
    mp.nama_mapel,
    p.materi
  FROM pertemuan p
  JOIN pengajar g ON p.id_pengajar = g.id_pengajar
  JOIN matapelajaran mp ON p.id_mapel = mp.id_mapel
  WHERE p.id_pembelian = p_id
  ORDER BY p.tgl_pertemuan;
END$$

DELIMITER ;

/* =========================================================
   STORED PROCEDURE – KELOLA JADWAL (ADMIN)
   ========================================================= */

-- [17] SP_LihatJadwal_Admin (admin)
-- Menampilkan jadwal sesuai tampilan tabel UI (JOIN + filter)
DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_LihatJadwal_Admin`$$
CREATE PROCEDURE `SP_LihatJadwal_Admin`(
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    DAYNAME(j.tanggal) AS hari,
    j.jam_mulai,
    j.jam_akhir,
    mp.nama_mapel,
    pg.nama_pengajar,
    m.nama_murid
  FROM jadwal j
  LEFT JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  LEFT JOIN pengajar pg ON j.id_pengajar = pg.id_pengajar
  LEFT JOIN murid m ON j.id_murid = m.id_murid
  WHERE
    (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI'
          AND MONTH(j.tanggal) = MONTH(CURDATE())
          AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND
    (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'TERISI' AND j.id_murid IS NOT NULL)
      OR (UPPER(p_status) = 'KOSONG' AND j.id_murid IS NULL)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC;
END$$

DELIMITER ;

-- [18] SP_TambahJadwal_Admin (admin)
-- Digunakan pada form "Buat Jadwal Baru"
DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_TambahJadwal_Admin`$$
CREATE PROCEDURE `SP_TambahJadwal_Admin`(
  IN p_kode_jadwal VARCHAR(20),
  IN p_id_mapel VARCHAR(20),
  IN p_id_pengajar VARCHAR(20),
  IN p_tanggal DATE,
  IN p_jam_mulai TIME,
  IN p_jam_akhir TIME
)
BEGIN
  -- Validasi jam
  IF p_jam_akhir <= p_jam_mulai THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Jam selesai harus lebih besar dari jam mulai';
  END IF;

  -- Validasi pengajar boleh mengajar mapel
  IF NOT EXISTS (
    SELECT 1 FROM diajar
    WHERE id_pengajar = p_id_pengajar
      AND id_mapel = p_id_mapel
  ) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Pengajar tidak mengajar mapel ini';
  END IF;

  -- Validasi bentrok jadwal pengajar
  IF EXISTS (
    SELECT 1
    FROM jadwal
    WHERE id_pengajar = p_id_pengajar
      AND tanggal = p_tanggal
      AND p_jam_mulai < jam_akhir
      AND p_jam_akhir > jam_mulai
  ) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Pengajar sudah memiliki jadwal pada waktu tersebut';
  END IF;

  INSERT INTO jadwal (
    kode_jadwal,
    id_mapel,
    id_pengajar,
    id_murid,
    id_pembelian,
    deskripsiMateri,
    tanggal,
    jam_mulai,
    jam_akhir,
    status_kehadiran
  )
  VALUES (
    p_kode_jadwal,
    p_id_mapel,
    p_id_pengajar,
    NULL,
    NULL,
    NULL,
    p_tanggal,
    p_jam_mulai,
    p_jam_akhir,
    NULL
  );
END$$

DELIMITER ;

-- [19] SP_EditJadwal_Admin (admin)
-- Digunakan tombol Edit pada tabel jadwal
DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_EditJadwal_Admin`$$
CREATE PROCEDURE `SP_EditJadwal_Admin`(
  IN p_kode_jadwal VARCHAR(20),
  IN p_tanggal DATE,
  IN p_jam_mulai TIME,
  IN p_jam_akhir TIME
)
BEGIN
  UPDATE jadwal
  SET
    tanggal = p_tanggal,
    jam_mulai = p_jam_mulai,
    jam_akhir = p_jam_akhir
  WHERE kode_jadwal = p_kode_jadwal;
END$$

DELIMITER ;

-- [20] SP_HapusJadwal_Admin (admin)
-- Digunakan tombol Hapus pada tabel jadwal
DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_HapusJadwal_Admin`$$
CREATE PROCEDURE `SP_HapusJadwal_Admin`(
  IN p_kode_jadwal VARCHAR(20)
)
BEGIN
  DELETE FROM jadwal
  WHERE kode_jadwal = p_kode_jadwal;
END$$

DELIMITER ;

-- [21] SP_LihatAbsensi
-- Digunakan pada halaman Absensi (Admin & Pengajar)
DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_LihatAbsensi`$$
CREATE PROCEDURE `SP_LihatAbsensi`(
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    DAYNAME(j.tanggal) AS hari,
    j.jam_mulai,
    j.jam_akhir,
    pg.nama_pengajar,
    mp.nama_mapel,
    m.nama_murid,
    j.status_kehadiran,
    j.deskripsiMateri
  FROM jadwal j
  INNER JOIN pengajar pg ON j.id_pengajar = pg.id_pengajar
  INNER JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  INNER JOIN murid m ON j.id_murid = m.id_murid
  WHERE
    -- Hanya jadwal yang sudah ada murid
    j.id_murid IS NOT NULL
    AND
    (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI'
          AND MONTH(j.tanggal) = MONTH(CURDATE())
          AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND
    (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'TERISI' AND j.status_kehadiran IS NOT NULL)
      OR (UPPER(p_status) = 'KOSONG' AND j.status_kehadiran IS NULL)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC;
END$$

DELIMITER ;



-- [22] SP_InputAbsensi
-- Digunakan pada modal "Input Absensi" (Admin & Pengajar)
DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_InputAbsensi`$$
CREATE PROCEDURE `SP_InputAbsensi`(
  IN p_kode_jadwal VARCHAR(20),
  IN p_status_kehadiran TINYINT(1),
  IN p_deskripsi_materi TEXT
)
BEGIN
  UPDATE jadwal
  SET
    status_kehadiran = p_status_kehadiran,
    deskripsiMateri = p_deskripsi_materi
  WHERE kode_jadwal = p_kode_jadwal;
END$$

DELIMITER ;

-- [23] SP_LihatRiwayatKehadiran
-- Digunakan pada halaman "Daftar Kehadiran" (Admin / Pengajar / Murid)
DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_LihatRiwayatKehadiran`$$
CREATE PROCEDURE `SP_LihatRiwayatKehadiran`(
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20),
  IN p_urut VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    DAYNAME(j.tanggal) AS hari,
    j.jam_mulai,
    j.jam_akhir,
    pg.nama_pengajar,
    mp.nama_mapel,
    m.nama_murid,
    j.deskripsiMateri,
    j.status_kehadiran
  FROM jadwal j
  INNER JOIN pengajar pg ON j.id_pengajar = pg.id_pengajar
  INNER JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  INNER JOIN murid m ON j.id_murid = m.id_murid
  WHERE
    -- Hanya jadwal yang sudah ada murid & sudah diabsen
    j.id_murid IS NOT NULL
    AND j.status_kehadiran IS NOT NULL
    AND
    (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI'
          AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI'
          AND MONTH(j.tanggal) = MONTH(CURDATE())
          AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND
    (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'HADIR' AND j.status_kehadiran = 1)
      OR (UPPER(p_status) = 'TIDAK_HADIR' AND j.status_kehadiran = 0)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC;
END$$

DELIMITER ;

-- [24] SP_LihatJadwalMendatang (murid)
-- Menampilkan jadwal yang belum dipesan & tanggal >= hari ini

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_LihatJadwalMendatang`$$
CREATE PROCEDURE `SP_LihatJadwalMendatang`(
  IN p_periode VARCHAR(20),
  IN p_id_mapel VARCHAR(20),
  IN p_id_pengajar VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    DAYNAME(j.tanggal) AS hari,
    j.jam_mulai,
    j.jam_akhir,
    mp.nama_mapel,
    p.nama_pengajar
  FROM jadwal j
  JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  JOIN pengajar p ON j.id_pengajar = p.id_pengajar
  WHERE j.id_murid IS NULL
    AND j.tanggal >= CURDATE()
    AND (
      p_id_mapel IS NULL OR p_id_mapel = '' OR j.id_mapel = p_id_mapel
    )
    AND (
      p_id_pengajar IS NULL OR p_id_pengajar = '' OR j.id_pengajar = p_id_pengajar
    )
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'MINGGU_INI'
          AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI'
          AND MONTH(j.tanggal) = MONTH(CURDATE())
          AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
  ORDER BY j.tanggal ASC, j.jam_mulai ASC;
END$$

DELIMITER ;


-- [25] SP_LihatPaketDijual (murid)
-- Menampilkan paket yang masih dijual (Untuk card daftar paket)

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_LihatPaketDijual`$$
CREATE PROCEDURE `SP_LihatPaketDijual`()
BEGIN
  SELECT
    id_paket,
    nama_paket,
    jml_pertemuan,
    masa_aktif_hari,
    harga
  FROM katalogpaket
  WHERE status_dijual = 1
  ORDER BY jml_pertemuan ASC;
END$$

DELIMITER ;

-- [26] SP_BeliPaket (murid)
-- Membuat data pembelian paket (belum dibayar) Saat klik “Beli Paket”

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_BeliPaket`$$
CREATE PROCEDURE `SP_BeliPaket`(
  IN p_id_pembelian VARCHAR(20),
  IN p_id_murid VARCHAR(20),
  IN p_id_paket VARCHAR(20)
)
BEGIN
  INSERT INTO paketdibeli (
    id_pembelian,
    id_murid,
    id_paket,
    tgl_pemesanan,
    pertemuan_terpakai
  )
  VALUES (
    p_id_pembelian,
    p_id_murid,
    p_id_paket,
    NOW(),
    0
  );
END$$

DELIMITER ;

-- [27] SP_LihatRiwayatPembelianMurid (murid)
-- Menampilkan riwayat pembelian sesuai status UI

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_LihatRiwayatPembelianMurid`$$
CREATE PROCEDURE `SP_LihatRiwayatPembelianMurid`(
  IN p_id_murid VARCHAR(20),
  IN p_status VARCHAR(20)
)
BEGIN
  SELECT
    pd.id_pembelian,
    DATE(pd.tgl_pemesanan) AS tanggal,
    k.nama_paket,
    k.harga,

    CASE
      WHEN pd.tgl_pembayaran IS NOT NULL THEN 'LUNAS'
      WHEN pd.gambar_bukti_pembayaran IS NOT NULL THEN 'MENUNGGU_VERIFIKASI'
      ELSE 'MENUNGGU_PEMBAYARAN'
    END AS status_ui

  FROM paketdibeli pd
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  WHERE pd.id_murid = p_id_murid
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'LUNAS' AND pd.tgl_pembayaran IS NOT NULL)
      OR (UPPER(p_status) = 'MENUNGGU_PEMBAYARAN'
          AND pd.tgl_pembayaran IS NULL
          AND pd.gambar_bukti_pembayaran IS NULL)
      OR (UPPER(p_status) = 'MENUNGGU_VERIFIKASI'
          AND pd.tgl_pembayaran IS NULL
          AND pd.gambar_bukti_pembayaran IS NOT NULL)
    )
  ORDER BY pd.tgl_pemesanan DESC;
END$$

DELIMITER ;

-- [28] SP_UploadBuktiPembayaran (murid)
-- Upload bukti pembayaran, hanya jika belum lunas

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_UploadBuktiPembayaran`$$
CREATE PROCEDURE `SP_UploadBuktiPembayaran`(
  IN p_id_pembelian VARCHAR(20),
  IN p_id_murid VARCHAR(20),
  IN p_filename TEXT
)
BEGIN
  UPDATE paketdibeli
  SET gambar_bukti_pembayaran = p_filename
  WHERE id_pembelian = p_id_pembelian
    AND id_murid = p_id_murid
    AND tgl_pembayaran IS NULL;

  IF ROW_COUNT() = 0 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Upload gagal: paket tidak ditemukan atau sudah lunas';
  END IF;
END$$

DELIMITER ;

/* =========================================================
   JADWAL MURID
   ========================================================= */

-- [29] SP_LihatJadwalTersediaMurid (murid)
-- Menampilkan jadwal yang tersedia untuk dipilih murid

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_LihatJadwalTersediaMurid`$$
CREATE PROCEDURE `SP_LihatJadwalTersediaMurid`(
  IN p_periode VARCHAR(20),
  IN p_id_mapel VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    DAYNAME(j.tanggal) AS hari,
    j.jam_mulai,
    j.jam_akhir,
    pg.nama_pengajar,
    mp.nama_mapel
  FROM jadwal j
  JOIN pengajar pg ON j.id_pengajar = pg.id_pengajar
  JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  WHERE j.id_murid IS NULL
    AND j.tanggal >= CURDATE()
    AND (
      p_id_mapel IS NULL OR p_id_mapel = '' OR j.id_mapel = p_id_mapel
    )
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'MINGGU_INI'
          AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
    )
  ORDER BY j.tanggal ASC, j.jam_mulai ASC;
END$$

DELIMITER ;


-- [30] SP_LihatJadwalSayaMurid (murid)
-- Menampilkan jadwal yang sudah dipilih oleh murid

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_LihatJadwalSayaMurid`$$
CREATE PROCEDURE `SP_LihatJadwalSayaMurid`(
  IN p_id_murid VARCHAR(20),
  IN p_periode VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    DAYNAME(j.tanggal) AS hari,
    j.jam_mulai,
    j.jam_akhir,
    pg.nama_pengajar,
    mp.nama_mapel
  FROM jadwal j
  JOIN pengajar pg ON j.id_pengajar = pg.id_pengajar
  JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  WHERE j.id_murid = p_id_murid
    AND j.tanggal >= CURDATE()
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'MINGGU_INI'
          AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
    )
  ORDER BY j.tanggal ASC, j.jam_mulai ASC;
END$$

DELIMITER ;


-- [31] SP_PilihJadwal (murid)
-- Murid memilih jadwal jika paket masih aktif dan sisa pertemuan tersedia

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_PilihJadwal`$$
CREATE PROCEDURE `SP_PilihJadwal`(
  IN p_kode_jadwal VARCHAR(20),
  IN p_id_murid VARCHAR(20),
  IN p_id_pembelian VARCHAR(20)
)
BEGIN
  -- Validasi paket aktif dan sisa pertemuan
  IF NOT EXISTS (
    SELECT 1
    FROM paketdibeli pd
    JOIN katalogpaket k ON pd.id_paket = k.id_paket
    WHERE pd.id_pembelian = p_id_pembelian
      AND pd.id_murid = p_id_murid
      AND pd.tgl_kedaluwarsa >= CURDATE()
      AND pd.pertemuan_terpakai < k.jml_pertemuan
  ) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Paket tidak aktif atau pertemuan telah habis';
  END IF;

  UPDATE jadwal
  SET id_murid = p_id_murid,
      id_pembelian = p_id_pembelian
  WHERE kode_jadwal = p_kode_jadwal
    AND id_murid IS NULL
    AND tanggal >= CURDATE();

  IF ROW_COUNT() = 0 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Jadwal tidak tersedia atau sudah terisi';
  END IF;
END$$

DELIMITER ;


-- [32] SP_BatalPilihJadwal (murid, admin)
-- Membatalkan jadwal yang belum berlangsung

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_BatalPilihJadwal`$$
CREATE PROCEDURE `SP_BatalPilihJadwal`(
  IN p_kode_jadwal VARCHAR(20),
  IN p_id_murid VARCHAR(20)
)
BEGIN
  UPDATE jadwal
  SET id_murid = NULL,
      id_pembelian = NULL,
      status_kehadiran = NULL,
      deskripsiMateri = NULL
  WHERE kode_jadwal = p_kode_jadwal
    AND id_murid = p_id_murid
    AND tanggal >= CURDATE();

  IF ROW_COUNT() = 0 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Jadwal tidak bisa dibatalkan';
  END IF;
END$$

DELIMITER ;


-- [33] SP_LihatJadwalMurid (murid)

DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_LihatJadwalMurid`$$
CREATE PROCEDURE `SP_LihatJadwalMurid`(
  IN p_id_murid VARCHAR(20),
  IN p_periode VARCHAR(20),
  IN p_status VARCHAR(20)
)
BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    DAYNAME(j.tanggal) AS hari,
    j.jam_mulai,
    j.jam_akhir,
    mp.nama_mapel,
    p.nama_pengajar,

    CASE
      WHEN j.tanggal > CURDATE() THEN 'MENDATANG'
      ELSE 'SELESAI'
    END AS status_ui

  FROM jadwal j
  JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  JOIN pengajar p ON j.id_pengajar = p.id_pengajar
  WHERE j.id_murid = p_id_murid
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'MINGGU_INI'
          AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI'
          AND MONTH(j.tanggal) = MONTH(CURDATE())
          AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'MENDATANG' AND j.tanggal > CURDATE())
      OR (UPPER(p_status) = 'SELESAI' AND j.tanggal <= CURDATE())
    )
  ORDER BY j.tanggal DESC, j.jam_mulai DESC;
END$$

DELIMITER ;

-- [34] SP_RiwayatKehadiranMurid (murid)
-- Menampilkan riwayat kehadiran les sesuai tampilan UI

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
    DAYNAME(j.tanggal) AS hari,
    j.jam_mulai,
    j.jam_akhir,
    p.nama_pengajar,
    mp.nama_mapel,
    j.deskripsiMateri,
    CASE
      WHEN j.status_kehadiran = 1 THEN 'HADIR'
      WHEN j.status_kehadiran = 0 THEN 'TIDAK_HADIR'
    END AS status_kehadiran_ui
  FROM jadwal j
  JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  JOIN pengajar p ON j.id_pengajar = p.id_pengajar
  WHERE j.id_murid = p_id_murid
    -- hanya jadwal yang sudah ada kehadirannya (riwayat)
    AND j.status_kehadiran IS NOT NULL
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI'
          AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI'
          AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI'
          AND MONTH(j.tanggal) = MONTH(CURDATE())
          AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (UPPER(p_status) = 'HADIR' AND j.status_kehadiran = 1)
      OR (UPPER(p_status) = 'TIDAK_HADIR' AND j.status_kehadiran = 0)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC,
    CASE WHEN UPPER(p_urut) = 'TERBARU' OR p_urut IS NULL THEN j.tanggal END DESC,
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