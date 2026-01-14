-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2026 at 02:54 AM
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
-- Error reading structure for table les_coding.admin: #1932 - Table &#039;les_coding.admin&#039; doesn&#039;t exist in engine
-- Error reading data for table les_coding.admin: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `les_coding`.`admin`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `diajar`
--
-- Error reading structure for table les_coding.diajar: #1932 - Table &#039;les_coding.diajar&#039; doesn&#039;t exist in engine
-- Error reading data for table les_coding.diajar: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `les_coding`.`diajar`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--
-- Error reading structure for table les_coding.jadwal: #1932 - Table &#039;les_coding.jadwal&#039; doesn&#039;t exist in engine
-- Error reading data for table les_coding.jadwal: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `les_coding`.`jadwal`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `katalogpaket`
--
-- Error reading structure for table les_coding.katalogpaket: #1932 - Table &#039;les_coding.katalogpaket&#039; doesn&#039;t exist in engine
-- Error reading data for table les_coding.katalogpaket: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `les_coding`.`katalogpaket`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `log_sistem`
--
-- Error reading structure for table les_coding.log_sistem: #1932 - Table &#039;les_coding.log_sistem&#039; doesn&#039;t exist in engine
-- Error reading data for table les_coding.log_sistem: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `les_coding`.`log_sistem`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--
-- Error reading structure for table les_coding.mata_pelajaran: #1932 - Table &#039;les_coding.mata_pelajaran&#039; doesn&#039;t exist in engine
-- Error reading data for table les_coding.mata_pelajaran: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `les_coding`.`mata_pelajaran`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--
-- Error reading structure for table les_coding.murid: #1932 - Table &#039;les_coding.murid&#039; doesn&#039;t exist in engine
-- Error reading data for table les_coding.murid: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `les_coding`.`murid`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `paketdibeli`
--
-- Error reading structure for table les_coding.paketdibeli: #1932 - Table &#039;les_coding.paketdibeli&#039; doesn&#039;t exist in engine
-- Error reading data for table les_coding.paketdibeli: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `les_coding`.`paketdibeli`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pengajar`
--
-- Error reading structure for table les_coding.pengajar: #1932 - Table &#039;les_coding.pengajar&#039; doesn&#039;t exist in engine
-- Error reading data for table les_coding.pengajar: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `les_coding`.`pengajar`&#039; at line 1

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_logmurid`
-- (See below for the actual view)
--
CREATE TABLE `view_logmurid` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_logsemua`
-- (See below for the actual view)
--
CREATE TABLE `view_logsemua` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_matapelajaranaktif`
-- (See below for the actual view)
--
CREATE TABLE `view_matapelajaranaktif` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_matapelajarannonaktif`
-- (See below for the actual view)
--
CREATE TABLE `view_matapelajarannonaktif` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_paketlesaktif`
-- (See below for the actual view)
--
CREATE TABLE `view_paketlesaktif` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_paketlesnonaktif`
-- (See below for the actual view)
--
CREATE TABLE `view_paketlesnonaktif` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_semuajadwalterisimingguini`
-- (See below for the actual view)
--
CREATE TABLE `view_semuajadwalterisimingguini` (
);

-- --------------------------------------------------------

--
-- Structure for view `view_logmurid`
--
DROP TABLE IF EXISTS `view_logmurid`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_logmurid`  AS SELECT `l`.`id_log` AS `id_log`, `l`.`tanggal` AS `tanggal`, `l`.`aktivitas` AS `aktivitas`, `l`.`id_akun` AS `id_akun`, `m`.`nama_murid` AS `nama_murid` FROM (`log_sistem` `l` join `murid` `m` on(`l`.`id_akun` = `m`.`id_murid`)) ORDER BY `l`.`tanggal` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `view_logsemua`
--
DROP TABLE IF EXISTS `view_logsemua`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_logsemua`  AS SELECT `log_sistem`.`id_log` AS `id_log`, `log_sistem`.`tanggal` AS `tanggal`, `log_sistem`.`aktivitas` AS `aktivitas`, `log_sistem`.`id_akun` AS `id_akun` FROM `log_sistem` ORDER BY `log_sistem`.`tanggal` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `view_matapelajaranaktif`
--
DROP TABLE IF EXISTS `view_matapelajaranaktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_matapelajaranaktif`  AS SELECT `mata_pelajaran`.`id_mapel` AS `id_mapel`, `mata_pelajaran`.`nama_mapel` AS `nama_mapel`, `mata_pelajaran`.`deskripsiMapel` AS `deskripsiMapel` FROM `mata_pelajaran` WHERE `mata_pelajaran`.`status` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `view_matapelajarannonaktif`
--
DROP TABLE IF EXISTS `view_matapelajarannonaktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_matapelajarannonaktif`  AS SELECT `mata_pelajaran`.`id_mapel` AS `id_mapel`, `mata_pelajaran`.`nama_mapel` AS `nama_mapel`, `mata_pelajaran`.`deskripsiMapel` AS `deskripsiMapel` FROM `mata_pelajaran` WHERE `mata_pelajaran`.`status` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `view_paketlesaktif`
--
DROP TABLE IF EXISTS `view_paketlesaktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_paketlesaktif`  AS SELECT `katalogpaket`.`id_paket` AS `id_paket`, `katalogpaket`.`nama_paket` AS `nama_paket`, `katalogpaket`.`jml_pertemuan` AS `jml_pertemuan`, `katalogpaket`.`masa_aktif_hari` AS `masa_aktif_hari`, `katalogpaket`.`harga` AS `harga` FROM `katalogpaket` WHERE `katalogpaket`.`status_dijual` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `view_paketlesnonaktif`
--
DROP TABLE IF EXISTS `view_paketlesnonaktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_paketlesnonaktif`  AS SELECT `katalogpaket`.`id_paket` AS `id_paket`, `katalogpaket`.`nama_paket` AS `nama_paket`, `katalogpaket`.`jml_pertemuan` AS `jml_pertemuan`, `katalogpaket`.`masa_aktif_hari` AS `masa_aktif_hari`, `katalogpaket`.`harga` AS `harga` FROM `katalogpaket` WHERE `katalogpaket`.`status_dijual` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `view_semuajadwalterisimingguini`
--
DROP TABLE IF EXISTS `view_semuajadwalterisimingguini`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_semuajadwalterisimingguini`  AS SELECT `j`.`kode_jadwal` AS `kode_jadwal`, `mp`.`nama_mapel` AS `nama_mapel`, `m`.`nama_murid` AS `nama_murid`, `j`.`deskripsiMateri` AS `deskripsiMateri`, `j`.`tanggal` AS `tanggal`, `j`.`jam_mulai` AS `jam_mulai`, `j`.`jam_akhir` AS `jam_akhir`, `j`.`status_kehadiran` AS `status_kehadiran` FROM ((`jadwal` `j` join `murid` `m` on(`j`.`id_murid` = `m`.`id_murid`)) join `mata_pelajaran` `mp` on(`j`.`id_mapel` = `mp`.`id_mapel`)) WHERE `j`.`id_murid` is not null AND yearweek(`j`.`tanggal`,1) = yearweek(curdate(),1) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
