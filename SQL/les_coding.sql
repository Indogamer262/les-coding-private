-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 18, 2026 at 03:36 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BatalPilihJadwal` (IN `p_kode_jadwal` VARCHAR(20), IN `p_id_murid` VARCHAR(20))   BEGIN
  DECLARE v_id_pembelian VARCHAR(20);

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    ROLLBACK;
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Gagal membatalkan jadwal';
  END;

  START TRANSACTION;

  SELECT id_pembelian
  INTO v_id_pembelian
  FROM jadwal
  WHERE kode_jadwal = p_kode_jadwal
    AND id_murid = p_id_murid
    AND tanggal >= CURDATE()
  FOR UPDATE;

  IF v_id_pembelian IS NULL THEN
    ROLLBACK;
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Jadwal tidak bisa dibatalkan';
  END IF;

  UPDATE jadwal
  SET id_murid = NULL,
      id_pembelian = NULL,
      status_kehadiran = NULL,
      deskripsiMateri = NULL
  WHERE kode_jadwal = p_kode_jadwal;

  UPDATE paketdibeli
  SET pertemuan_terpakai = pertemuan_terpakai - 1
  WHERE id_pembelian = v_id_pembelian
    AND pertemuan_terpakai > 0;

  INSERT INTO log_sistem (tanggal, aktivitas, id_akun)
  VALUES (
    NOW(),
    CONCAT('Murid ', p_id_murid, ' membatalkan jadwal ', p_kode_jadwal),
    p_id_murid
  );


  COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BeliPaket` (IN `p_id_murid` VARCHAR(20), IN `p_id_paket` VARCHAR(20))   BEGIN
  DECLARE v_prefix VARCHAR(20);
  DECLARE v_last INT DEFAULT 0;
  DECLARE v_id VARCHAR(20);

  IF EXISTS (
    SELECT 1
    FROM paketdibeli
    WHERE id_murid = p_id_murid
      AND id_paket = p_id_paket
      AND tgl_pembayaran IS NOT NULL
      AND tgl_kedaluwarsa >= CURDATE()
  ) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Anda masih punya paket aktif yang sama';
  END IF;

  SET v_prefix = CONCAT('PB-', DATE_FORMAT(NOW(), '%y%m'));

  SELECT IFNULL(
           MAX(CAST(RIGHT(id_pembelian, 3) AS UNSIGNED)),
           0
         )
  INTO v_last
  FROM paketdibeli
  WHERE id_pembelian LIKE CONCAT(v_prefix, '%');

  SET v_id = CONCAT(v_prefix, LPAD(v_last + 1, 3, '0'));

  INSERT INTO paketdibeli (
    id_pembelian,
    id_murid,
    id_paket,
    tgl_pemesanan,
    pertemuan_terpakai,
    tgl_pembayaran,
    tgl_kedaluwarsa,
    gambar_bukti_pembayaran
  )
  VALUES (
    v_id,
    p_id_murid,
    p_id_paket,
    NOW(),
    0,
    NULL,
    NULL,
    NULL
  );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DetailPembelianPaket` (IN `p_id` VARCHAR(20))   BEGIN
  SELECT
    pd.id_pembelian,
    m.nama_murid,
    k.jml_pertemuan AS total_pertemuan,
    pd.pertemuan_terpakai,
    (k.jml_pertemuan - pd.pertemuan_terpakai) AS sisa_pertemuan
  FROM paketdibeli pd
  JOIN murid m ON pd.id_murid = m.id_murid
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  WHERE pd.id_pembelian = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_EditAkun` (IN `p_role` VARCHAR(20), IN `p_id` VARCHAR(20), IN `p_nama` VARCHAR(255), IN `p_email` VARCHAR(255))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_EditJadwal_Admin` (IN `p_kode_jadwal` VARCHAR(20), IN `p_tanggal` DATE, IN `p_jam_mulai` TIME, IN `p_jam_akhir` TIME)   BEGIN
  UPDATE jadwal
  SET
    tanggal = p_tanggal,
    jam_mulai = p_jam_mulai,
    jam_akhir = p_jam_akhir
  WHERE kode_jadwal = p_kode_jadwal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_EditMapel` (IN `p_id` VARCHAR(20), IN `p_nama` VARCHAR(255), IN `p_desc` TEXT, IN `p_status` TINYINT(1))   BEGIN
  UPDATE mata_pelajaran
  SET 
    nama_mapel = p_nama,
    deskripsiMapel = p_desc,
    status = p_status
  WHERE id_mapel = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_EditPaketLes` (IN `p_id` VARCHAR(20), IN `p_nama` VARCHAR(255), IN `p_jml` INT, IN `p_masa` INT, IN `p_harga` DECIMAL(12,2), IN `p_status` TINYINT(1))   BEGIN
  UPDATE katalogpaket
  SET nama_paket = p_nama,
      jml_pertemuan = p_jml,
      masa_aktif_hari = p_masa,
      harga = p_harga,
      status_dijual = p_status
  WHERE id_paket = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_HapusDiajar` (IN `p_id_mapel` VARCHAR(20), IN `p_id_pengajar` VARCHAR(20))   BEGIN
  DELETE FROM diajar 
  WHERE id_mapel = p_id_mapel 
    AND id_pengajar = p_id_pengajar;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_HapusJadwal_Admin` (IN `p_kode_jadwal` VARCHAR(20))   BEGIN
  DELETE FROM jadwal
  WHERE kode_jadwal = p_kode_jadwal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InputAbsensi_Admin` (IN `p_kode_jadwal` VARCHAR(20), IN `p_status_kehadiran` TINYINT(1), IN `p_deskripsi_materi` TEXT)   BEGIN
  UPDATE jadwal
  SET
    status_kehadiran = p_status_kehadiran,
    deskripsiMateri = p_deskripsi_materi
  WHERE kode_jadwal = p_kode_jadwal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InputAbsensi_Pengajar` (IN `p_kode_jadwal` VARCHAR(20), IN `p_id_pengajar` VARCHAR(20), IN `p_status_kehadiran` TINYINT(1), IN `p_deskripsi_materi` TEXT)   BEGIN
  UPDATE jadwal
  SET
    status_kehadiran = p_status_kehadiran,
    deskripsiMateri = p_deskripsi_materi
  WHERE kode_jadwal = p_kode_jadwal
    AND id_pengajar = p_id_pengajar;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_JadwalMengajarPengajar` (IN `p_id_pengajar` VARCHAR(20), IN `p_periode` VARCHAR(20), IN `p_status` VARCHAR(20), IN `p_urut` VARCHAR(20))   BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    DAYNAME(j.tanggal) AS hari,
    j.jam_mulai,
    j.jam_akhir,
    j.status_kehadiran,
    j.deskripsiMateri,
    mp.nama_mapel,
    m.nama_murid,
    CASE
      WHEN j.tanggal < CURDATE() OR j.status_kehadiran IS NOT NULL THEN 'SELESAI'
      ELSE 'MENDATANG'
    END AS status_jadwal_ui
  FROM jadwal j
  LEFT JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  LEFT JOIN murid m ON j.id_murid = m.id_murid
  WHERE j.id_pengajar = p_id_pengajar

    -- Filter periode
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(j.tanggal) = MONTH(CURDATE()) AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )

    -- Filter status UI
    AND (
      UPPER(p_status) = 'SEMUA'
      OR (
        UPPER(p_status) = 'SELESAI'
        AND (j.tanggal < CURDATE() OR j.status_kehadiran IS NOT NULL)
      )
      OR (
        UPPER(p_status) = 'MENDATANG'
        AND j.tanggal >= CURDATE()
        AND j.status_kehadiran IS NULL
      )
    )

  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC,
    j.jam_mulai ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatAbsensi_Admin` (IN `p_periode` VARCHAR(20), IN `p_status` VARCHAR(20), IN `p_urut` VARCHAR(20))   BEGIN
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
    IFNULL(j.deskripsiMateri, '-') AS deskripsiMateri
  FROM jadwal j
  JOIN pengajar pg ON j.id_pengajar = pg.id_pengajar
  JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  JOIN murid m ON j.id_murid = m.id_murid
  WHERE
    j.id_murid IS NOT NULL
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR p_periode IS NULL
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI'
          AND MONTH(j.tanggal) = MONTH(CURDATE())
          AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR p_status IS NULL
      OR (UPPER(p_status) = 'TERISI' AND j.status_kehadiran IS NOT NULL)
      OR (UPPER(p_status) = 'KOSONG' AND j.status_kehadiran IS NULL)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC,
    j.jam_mulai ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatAbsensi_Pengajar` (IN `p_id_pengajar` VARCHAR(20), IN `p_periode` VARCHAR(20), IN `p_status` VARCHAR(20), IN `p_urut` VARCHAR(20))   BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    DAYNAME(j.tanggal) AS hari,
    j.jam_mulai,
    j.jam_akhir,
    mp.nama_mapel,
    m.nama_murid,
    j.status_kehadiran,
    IFNULL(j.deskripsiMateri, '-') AS deskripsiMateri
  FROM jadwal j
  JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  JOIN murid m ON j.id_murid = m.id_murid
  WHERE
    j.id_murid IS NOT NULL
    AND j.id_pengajar = p_id_pengajar
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR p_periode IS NULL
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI'
          AND MONTH(j.tanggal) = MONTH(CURDATE())
          AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )
    AND (
      UPPER(p_status) = 'SEMUA'
      OR p_status IS NULL
      OR (UPPER(p_status) = 'TERISI' AND j.status_kehadiran IS NOT NULL)
      OR (UPPER(p_status) = 'KOSONG' AND j.status_kehadiran IS NULL)
    )
  ORDER BY
    CASE WHEN UPPER(p_urut) = 'TERBARU' THEN j.tanggal END DESC,
    CASE WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal END ASC,
    j.jam_mulai ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatAkun` (IN `p_role` VARCHAR(20), IN `p_status` VARCHAR(20))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatBuktiPembayaran` (IN `p_id` VARCHAR(20))   BEGIN
  SELECT gambar_bukti_pembayaran
  FROM paketdibeli
  WHERE id_pembelian = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatJadwalMurid` (IN `p_id_murid` VARCHAR(20), IN `p_periode` VARCHAR(20), IN `p_status` VARCHAR(20))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatJadwalSayaMurid` (IN `p_id_murid` VARCHAR(20), IN `p_periode` VARCHAR(20))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatJadwalTersediaMurid` (IN `p_periode` VARCHAR(20), IN `p_id_mapel` VARCHAR(20))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatJadwal_Admin` (IN `p_periode` VARCHAR(20), IN `p_status` VARCHAR(20), IN `p_urut` VARCHAR(20))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatPaketDijual` ()   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatPembelianPaket` (IN `p_periode` VARCHAR(20), IN `p_status_bukti` VARCHAR(20))   BEGIN
  SELECT
    pd.id_pembelian,
    pd.tgl_pemesanan,
    m.nama_murid,
    k.nama_paket,
    k.harga AS jumlah,
    CASE
      WHEN pd.gambar_bukti_pembayaran IS NULL OR pd.gambar_bukti_pembayaran = ''
        THEN 'MENUNGGU_BUKTI'
      WHEN pd.tgl_pembayaran IS NOT NULL
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
    OR (UPPER(p_status_bukti) = 'LUNAS'
        AND pd.gambar_bukti_pembayaran IS NOT NULL
        AND pd.gambar_bukti_pembayaran <> ''
        AND pd.tgl_pembayaran IS NOT NULL)
    OR (UPPER(p_status_bukti) = 'MENUNGGU_BUKTI'
        AND (pd.gambar_bukti_pembayaran IS NULL
        OR pd.gambar_bukti_pembayaran = ''))
    OR (UPPER(p_status_bukti) = 'MENUNGGU_VERIFIKASI'
        AND pd.gambar_bukti_pembayaran IS NOT NULL
        AND pd.gambar_bukti_pembayaran <> ''
        AND pd.tgl_pembayaran IS NULL)
  )
  ORDER BY pd.tgl_pemesanan DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatRiwayatKehadiran` (IN `p_periode` VARCHAR(20), IN `p_status` VARCHAR(20), IN `p_urut` VARCHAR(20))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatRiwayatPembelian` (IN `p_periode` VARCHAR(20), IN `p_status` VARCHAR(20))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LihatRiwayatPembelianMurid` (IN `p_id_murid` VARCHAR(20), IN `p_status` VARCHAR(20))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ListPertemuanTerpakai` (IN `p_id` VARCHAR(20))   BEGIN
  SELECT
    ROW_NUMBER() OVER (ORDER BY j.tanggal, j.jam_mulai) AS `Ke-`,
    DATE_FORMAT(j.tanggal, '%d %b %Y') AS `Tanggal`,
    CONCAT(
      TIME_FORMAT(j.jam_mulai, '%H:%i'),
      ' - ',
      TIME_FORMAT(j.jam_akhir, '%H:%i')
    ) AS `Waktu`,
    g.nama_pengajar AS `Pengajar`,
    mp.nama_mapel AS `Mata Pelajaran`,
    IFNULL(j.deskripsiMateri, '-') AS `Materi`
  FROM jadwal j
  JOIN pengajar g ON j.id_pengajar = g.id_pengajar
  JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  WHERE j.id_pembelian = p_id
  ORDER BY j.tanggal, j.jam_mulai;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PilihJadwal` (IN `p_kode_jadwal` VARCHAR(20), IN `p_id_murid` VARCHAR(20), IN `p_id_pembelian` VARCHAR(20))   BEGIN
  DECLARE v_sisa INT;
  DECLARE v_dummy INT;

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    ROLLBACK;
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Gagal memilih jadwal';
  END;

  START TRANSACTION;

  SELECT (k.jml_pertemuan - pd.pertemuan_terpakai)
  INTO v_sisa
  FROM paketdibeli pd
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  WHERE pd.id_pembelian = p_id_pembelian
    AND pd.id_murid = p_id_murid
    AND pd.tgl_pembayaran IS NOT NULL
    AND pd.tgl_kedaluwarsa >= CURDATE()
  FOR UPDATE;

  IF v_sisa IS NULL THEN
    ROLLBACK;
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Paket tidak valid atau tidak aktif';
  END IF;

  IF v_sisa <= 0 THEN
    ROLLBACK;
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Kuota pertemuan sudah habis';
  END IF;

  SELECT 1
  INTO v_dummy
  FROM jadwal
  WHERE kode_jadwal = p_kode_jadwal
    AND id_murid IS NULL
    AND tanggal >= CURDATE()
  FOR UPDATE;

  IF v_dummy IS NULL THEN
    ROLLBACK;
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Jadwal tidak tersedia atau sudah terisi';
  END IF;

  UPDATE jadwal
  SET id_murid = p_id_murid,
      id_pembelian = p_id_pembelian
  WHERE kode_jadwal = p_kode_jadwal;

  UPDATE paketdibeli
  SET pertemuan_terpakai = pertemuan_terpakai + 1
  WHERE id_pembelian = p_id_pembelian;

  INSERT INTO log_sistem (tanggal, aktivitas, id_akun)
  VALUES (
    NOW(),
    CONCAT('Murid ', p_id_murid, ' memilih jadwal ', p_kode_jadwal, ' (paket ', p_id_pembelian, ')'),
    p_id_murid
  );

  COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RiwayatKehadiranMurid` (IN `p_id_murid` VARCHAR(20), IN `p_periode` VARCHAR(20), IN `p_status` VARCHAR(20), IN `p_urut` VARCHAR(20))   BEGIN
  SELECT
    j.kode_jadwal,

    -- untuk sorting & kebutuhan backend
    j.tanggal,
    j.jam_mulai,
    j.jam_akhir,

    -- untuk UI
    DATE_FORMAT(j.tanggal, '%d %b %Y') AS tanggal_ui,
    DAYNAME(j.tanggal) AS hari,
    CONCAT(
      DATE_FORMAT(j.jam_mulai, '%H:%i'),
      ' - ',
      DATE_FORMAT(j.jam_akhir, '%H:%i')
    ) AS jam_ui,

    p.nama_pengajar,
    mp.nama_mapel,
    IFNULL(j.deskripsiMateri, '-') AS deskripsiMateri,

    j.status_kehadiran,

    CASE
      WHEN j.status_kehadiran = 1 THEN 'Hadir'
      WHEN j.status_kehadiran = 0 THEN 'Tidak Hadir'
    END AS status_kehadiran_ui

  FROM jadwal j
  JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  JOIN pengajar p ON j.id_pengajar = p.id_pengajar

  WHERE j.id_murid = p_id_murid

    -- hanya yang sudah ada kehadirannya (riwayat)
    AND j.status_kehadiran IS NOT NULL

    -- FILTER PERIODE
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR p_periode IS NULL
      OR (UPPER(p_periode) = 'HARI_INI'
          AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI'
          AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI'
          AND MONTH(j.tanggal) = MONTH(CURDATE())
          AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )

    -- FILTER STATUS
    AND (
      UPPER(p_status) = 'SEMUA'
      OR p_status IS NULL
      OR (UPPER(p_status) = 'HADIR' AND j.status_kehadiran = 1)
      OR (UPPER(p_status) = 'TIDAK_HADIR' AND j.status_kehadiran = 0)
    )

  ORDER BY
    -- sorting utama: tanggal + jam
    CASE 
      WHEN UPPER(p_urut) = 'TERLAMA' THEN j.tanggal 
    END ASC,

    CASE 
      WHEN UPPER(p_urut) = 'TERBARU' OR p_urut IS NULL THEN j.tanggal 
    END DESC,

    j.jam_mulai DESC;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RiwayatKehadiranPengajar` (IN `p_id_pengajar` VARCHAR(20), IN `p_periode` VARCHAR(20), IN `p_status` VARCHAR(20), IN `p_urut` VARCHAR(20))   BEGIN
  SELECT
    j.kode_jadwal,
    j.tanggal,
    DAYNAME(j.tanggal) AS hari,
    j.jam_mulai,
    j.jam_akhir,
    mp.nama_mapel,
    m.nama_murid,
    j.deskripsiMateri,
    CASE
      WHEN j.status_kehadiran = 1 THEN 'HADIR'
      WHEN j.status_kehadiran = 0 THEN 'TIDAK_HADIR'
    END AS status_kehadiran_ui
  FROM jadwal j
  JOIN mata_pelajaran mp ON j.id_mapel = mp.id_mapel
  JOIN murid m ON j.id_murid = m.id_murid
  WHERE j.id_pengajar = p_id_pengajar
    AND j.status_kehadiran IS NOT NULL

    -- Filter periode
    AND (
      UPPER(p_periode) = 'SEMUA'
      OR (UPPER(p_periode) = 'HARI_INI' AND j.tanggal = CURDATE())
      OR (UPPER(p_periode) = 'MINGGU_INI' AND YEARWEEK(j.tanggal, 1) = YEARWEEK(CURDATE(), 1))
      OR (UPPER(p_periode) = 'BULAN_INI' AND MONTH(j.tanggal) = MONTH(CURDATE()) AND YEAR(j.tanggal) = YEAR(CURDATE()))
    )

    -- Filter status kehadiran
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TambahAkun` (IN `p_role` VARCHAR(20), IN `p_nama` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TambahDiajar` (IN `p_id_mapel` VARCHAR(20), IN `p_id_pengajar` VARCHAR(20))   BEGIN
IF EXISTS (
SELECT 1 FROM diajar
WHERE id_mapel = p_id_mapel
AND id_pengajar = p_id_pengajar
) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Relasi diajar sudah ada';
END IF;

INSERT INTO diajar (id_mapel, id_pengajar)
VALUES (p_id_mapel, p_id_pengajar);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TambahJadwal_Admin` (IN `p_id_mapel` VARCHAR(20), IN `p_id_pengajar` VARCHAR(20), IN `p_tanggal` DATE, IN `p_jam_mulai` TIME, IN `p_jam_akhir` TIME)   BEGIN
DECLARE v_last INT;
DECLARE v_kode VARCHAR(20);
DECLARE v_ym VARCHAR(4);

IF p_jam_akhir <= p_jam_mulai THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Jam selesai harus lebih besar dari jam mulai';
END IF;

IF NOT EXISTS (
SELECT 1 FROM diajar
WHERE id_mapel = p_id_mapel
AND id_pengajar = p_id_pengajar
) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Pengajar tidak mengajar mapel ini';
END IF;

IF EXISTS (
SELECT 1 FROM jadwal
WHERE id_pengajar = p_id_pengajar
AND tanggal = p_tanggal
AND p_jam_mulai < jam_akhir
AND p_jam_akhir > jam_mulai
) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Pengajar sudah memiliki jadwal bentrok';
END IF;

SET v_ym = DATE_FORMAT(p_tanggal, '%y%m');

SELECT IFNULL(MAX(CAST(RIGHT(kode_jadwal,3) AS UNSIGNED)),0)
INTO v_last
FROM jadwal
WHERE kode_jadwal LIKE CONCAT('JD-', v_ym, '%');

SET v_kode = CONCAT('JD-', v_ym, LPAD(v_last+1,3,'0'));

INSERT INTO jadwal
(kode_jadwal, id_mapel, id_pengajar, id_murid, id_pembelian,
deskripsiMateri, tanggal, jam_mulai, jam_akhir, status_kehadiran)
VALUES
(v_kode, p_id_mapel, p_id_pengajar, NULL, NULL,
NULL, p_tanggal, p_jam_mulai, p_jam_akhir, NULL);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TambahMapel` (IN `p_nama` VARCHAR(255), IN `p_desc` TEXT, IN `p_status` TINYINT(1))   BEGIN
DECLARE v_last INT;
DECLARE v_id VARCHAR(20);

IF EXISTS (SELECT 1 FROM mata_pelajaran WHERE nama_mapel = p_nama) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Nama mata pelajaran sudah ada';
END IF;

SELECT IFNULL(MAX(CAST(RIGHT(id_mapel,5) AS UNSIGNED)), 0)
INTO v_last
FROM mata_pelajaran
WHERE id_mapel LIKE 'MP-%';

SET v_id = CONCAT('MP-', LPAD(v_last + 1, 5, '0'));

INSERT INTO mata_pelajaran
(id_mapel, nama_mapel, deskripsiMapel, status)
VALUES
(v_id, p_nama, p_desc, p_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TambahPaketLes` (IN `p_nama` VARCHAR(255), IN `p_jml` INT, IN `p_masa` INT, IN `p_harga` DECIMAL(12,2), IN `p_status` TINYINT(1))   BEGIN
DECLARE v_last INT;
DECLARE v_id VARCHAR(20);

IF EXISTS (SELECT 1 FROM katalogpaket WHERE nama_paket = p_nama) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Nama paket sudah ada';
END IF;

SELECT IFNULL(MAX(CAST(RIGHT(id_paket,5) AS UNSIGNED)), 0)
INTO v_last
FROM katalogpaket
WHERE id_paket LIKE 'PK-%';

SET v_id = CONCAT('PK-', LPAD(v_last + 1, 5, '0'));

INSERT INTO katalogpaket
(id_paket, nama_paket, jml_pertemuan, masa_aktif_hari, harga, status_dijual)
VALUES
(v_id, p_nama, p_jml, p_masa, p_harga, p_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TandaiLunas` (IN `p_id` VARCHAR(20))   BEGIN
  DECLARE v_rows INT;

  START TRANSACTION;

  UPDATE paketdibeli pd
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  SET
    pd.tgl_pembayaran = NOW(),
    pd.tgl_kedaluwarsa = DATE_ADD(NOW(), INTERVAL k.masa_aktif_hari DAY)
  WHERE pd.id_pembelian = p_id
    AND pd.gambar_bukti_pembayaran IS NOT NULL
    AND pd.gambar_bukti_pembayaran <> ''
    AND pd.tgl_pembayaran IS NULL;

  SET v_rows = ROW_COUNT();

  IF v_rows = 0 THEN
    ROLLBACK;
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Paket tidak bisa ditandai lunas (sudah lunas atau belum upload bukti)';
  END IF;

  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (
    NOW(),
    CONCAT('Admin menandai lunas pembelian paket: ', p_id),
    COALESCE(@current_user_id, 'SYSTEM')
  );

  COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UbahStatusAkun` (IN `p_role` VARCHAR(20), IN `p_id` VARCHAR(20), IN `p_status` TINYINT(1))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UbahStatusMapel` (IN `p_id` VARCHAR(20), IN `p_status` TINYINT(1))   BEGIN
  UPDATE mata_pelajaran
  SET status = p_status
  WHERE id_mapel = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UbahStatusPaketLes` (IN `p_id` VARCHAR(20), IN `p_status` TINYINT(1))   BEGIN
  UPDATE katalogpaket
  SET status_dijual = p_status
  WHERE id_paket = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UploadBuktiPembayaran` (IN `p_id_pembelian` VARCHAR(20), IN `p_id_murid` VARCHAR(20), IN `p_filename` TEXT)   BEGIN
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

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `FC_getJumlahPaketAktifMurid` (`p_id_murid` VARCHAR(20)) RETURNS INT(11) READS SQL DATA RETURN (
  SELECT COUNT(*)
  FROM paketdibeli
  WHERE id_murid = p_id_murid
    AND tgl_kedaluwarsa IS NOT NULL
    AND tgl_kedaluwarsa >= CURDATE()
)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `FC_getPendapatanBulanIni` () RETURNS DECIMAL(12,2) READS SQL DATA RETURN (
  SELECT IFNULL(SUM(k.harga), 0)
  FROM paketdibeli pd
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  WHERE pd.tgl_pembayaran IS NOT NULL
    AND MONTH(pd.tgl_pembayaran) = MONTH(CURDATE())
    AND YEAR(pd.tgl_pembayaran) = YEAR(CURDATE())
)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `FC_getTotalJadwalHariIniMurid` (`p_id_murid` VARCHAR(20)) RETURNS INT(11) READS SQL DATA RETURN (
  SELECT COUNT(*)
  FROM jadwal
  WHERE id_murid = p_id_murid
    AND tanggal = CURDATE()
)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `FC_getTotalJadwalHariIniPengajar` (`p_id_pengajar` VARCHAR(20)) RETURNS INT(11) READS SQL DATA RETURN (
  SELECT COUNT(*)
  FROM jadwal
  WHERE id_pengajar = p_id_pengajar
    AND id_murid IS NOT NULL
    AND tanggal = CURDATE()
)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `FC_getTotalJadwalMingguIniMurid` (`p_id_murid` VARCHAR(20)) RETURNS INT(11) READS SQL DATA RETURN (
  SELECT COUNT(*)
  FROM jadwal
  WHERE id_murid = p_id_murid
    AND YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)
)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `FC_getTotalJadwalMingguIniPengajar` (`p_id_pengajar` VARCHAR(20)) RETURNS INT(11) READS SQL DATA RETURN (
  SELECT COUNT(*)
  FROM jadwal
  WHERE id_pengajar = p_id_pengajar
    AND id_murid IS NOT NULL
    AND YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)
)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `FC_getTotalMurid` () RETURNS INT(11) READS SQL DATA RETURN (
  SELECT COUNT(*) FROM murid
)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `FC_getTotalMuridDiajar` (`p_id_pengajar` VARCHAR(20)) RETURNS INT(11) READS SQL DATA RETURN (
  SELECT COUNT(DISTINCT id_murid)
  FROM jadwal
  WHERE id_pengajar = p_id_pengajar
    AND id_murid IS NOT NULL
)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `FC_getTotalPembelianPaket` () RETURNS INT(11) READS SQL DATA RETURN (
  SELECT COUNT(*)
  FROM paketdibeli
  WHERE tgl_pembayaran IS NULL
    AND gambar_bukti_pembayaran IS NOT NULL
)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `FC_getTotalPengajar` () RETURNS INT(11) READS SQL DATA RETURN (
  SELECT COUNT(*) FROM pengajar
)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `FC_getTotalSisaPertemuanMurid` (`p_id_murid` VARCHAR(20)) RETURNS INT(11) READS SQL DATA RETURN (
  SELECT IFNULL(SUM((k.jml_pertemuan - pd.pertemuan_terpakai)), 0)
  FROM paketdibeli pd
  JOIN katalogpaket k ON pd.id_paket = k.id_paket
  WHERE pd.id_murid = p_id_murid
    AND pd.tgl_kedaluwarsa IS NOT NULL
    AND pd.tgl_kedaluwarsa >= CURDATE()
)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(20) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `password`, `status`) VALUES
('A-2601001', 'Gavin Malik Setiawan', 'gavin@gavin.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('A-2601002', 'Admin One', 'admin1@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('A-2601003', 'Admin Two', 'admin2@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1);

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `TG_LogEditAkun_Admin` AFTER UPDATE ON `admin` FOR EACH ROW BEGIN
  IF (NOT (OLD.nama_admin <=> NEW.nama_admin)
      OR NOT (OLD.email <=> NEW.email)
      OR NOT (OLD.password <=> NEW.password)) THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Edit akun admin: ', NEW.id_admin), COALESCE(@current_user_id, NEW.id_admin, 'SYSTEM'));
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_LogTambahAkun_Admin` AFTER INSERT ON `admin` FOR EACH ROW BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Tambah akun admin: ', NEW.id_admin), COALESCE(@current_user_id, NEW.id_admin, 'SYSTEM'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_LogUbahStatusAkun_Admin` AFTER UPDATE ON `admin` FOR EACH ROW BEGIN
  IF OLD.status <> NEW.status THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Ubah status akun admin: ', NEW.id_admin), COALESCE(@current_user_id, NEW.id_admin, 'SYSTEM'));
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `diajar`
--

CREATE TABLE `diajar` (
  `id_diajar` bigint(20) NOT NULL,
  `id_mapel` varchar(20) NOT NULL,
  `id_pengajar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diajar`
--

INSERT INTO `diajar` (`id_diajar`, `id_mapel`, `id_pengajar`) VALUES
(1, 'MP-00001', 'P-2601001'),
(5, 'MP-00001', 'P-2601005'),
(2, 'MP-00002', 'P-2601001'),
(6, 'MP-00002', 'P-2601005'),
(3, 'MP-00003', 'P-2601002'),
(4, 'MP-00005', 'P-2601004');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `kode_jadwal` varchar(20) NOT NULL,
  `id_mapel` varchar(20) DEFAULT NULL,
  `id_pengajar` varchar(20) DEFAULT NULL,
  `id_murid` varchar(20) DEFAULT NULL,
  `id_pembelian` varchar(20) DEFAULT NULL,
  `deskripsiMateri` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `status_kehadiran` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`kode_jadwal`, `id_mapel`, `id_pengajar`, `id_murid`, `id_pembelian`, `deskripsiMateri`, `tanggal`, `jam_mulai`, `jam_akhir`, `status_kehadiran`) VALUES
('JD-2601001', 'MP-00001', 'P-2601001', 'M-2601001', 'PB-2601001', 'Variabel, Tipe Data, dan Operator', '2026-01-17', '08:00:00', '09:00:00', 1),
('JD-2601002', 'MP-00001', 'P-2601001', 'M-2601001', 'PB-2601001', NULL, '2026-01-13', '08:00:00', '09:00:00', NULL),
('JD-2601003', 'MP-00002', 'P-2601001', 'M-2601002', 'PB-2601003', NULL, '2026-01-14', '09:00:00', '10:00:00', NULL),
('JD-2601004', 'MP-00002', 'P-2601001', NULL, NULL, NULL, '2026-01-14', '10:00:00', '11:00:00', NULL),
('JD-2601005', 'MP-00003', 'P-2601002', 'M-2601003', 'PB-2612002', 'Form, Table, dan Layout Web', '2026-01-11', '08:00:00', '09:00:00', 1),
('JD-2601006', 'MP-00003', 'P-2601002', 'M-2601003', 'PB-2612002', '', '2026-01-04', '08:00:00', '09:00:00', 0),
('JD-2601007', 'MP-00001', 'P-2601001', 'M-2601005', 'PB-2601006', 'Variabel, Tipe Data, dan Operator', '2026-01-14', '13:00:00', '14:00:00', 1),
('JD-2601008', 'MP-00002', 'P-2601001', 'M-2601001', 'PB-2601001', 'Percabangan dan Perulangan', '2026-01-09', '08:00:00', '09:00:00', 1),
('JD-2601009', 'MP-00002', 'P-2601001', 'M-2601002', 'PB-2601003', NULL, '2026-01-07', '08:00:00', '09:00:00', NULL),
('JD-2601010', 'MP-00005', 'P-2601004', 'M-2601005', 'PB-2601006', 'Pengenalan Database dan Tabel', '2026-01-12', '08:00:00', '09:00:00', 0),
('JD-2601011', 'MP-00001', 'P-2601001', NULL, NULL, NULL, '2026-01-12', '10:00:00', '11:00:00', NULL),
('JD-2601012', 'MP-00001', 'P-2601001', 'M-2601001', 'PB-2601001', 'Percabangan dan Perulangan', '2026-01-15', '08:00:00', '09:00:00', NULL),
('JD-2601013', 'MP-00002', 'P-2601001', 'M-2601002', 'PB-2601003', NULL, '2026-01-16', '08:00:00', '09:00:00', NULL),
('JD-2601014', 'MP-00003', 'P-2601002', NULL, NULL, NULL, '2026-01-17', '08:00:00', '09:00:00', NULL),
('JD-2601015', 'MP-00005', 'P-2601004', 'M-2601003', 'PB-2612002', 'JOIN dan Query Lanjutan', '2026-01-14', '15:00:00', '16:00:00', 1),
('JD-2601016', 'MP-00005', 'P-2601004', 'M-2601005', 'PB-2601006', 'Pengenalan Database dan Tabel', '2026-01-08', '15:00:00', '16:00:00', 0),
('JD-2601017', 'MP-00001', 'P-2601001', 'M-2601002', 'PB-2601003', 'Variabel, Tipe Data, dan Operator', '2026-01-06', '08:00:00', '09:00:00', 1),
('JD-2601018', 'MP-00002', 'P-2601001', 'M-2601003', 'PB-2612002', 'Sorting dan Searching', '2026-01-02', '08:00:00', '09:00:00', 1),
('JD-2601019', 'MP-00003', 'P-2601002', 'M-2601001', 'PB-2601001', 'Fungsi dan Prosedur', '2026-01-10', '08:00:00', '09:00:00', 1),
('JD-2601020', 'MP-00005', 'P-2601004', 'M-2601002', 'PB-2601003', 'Pengenalan Database dan Tabel', '2026-01-05', '08:00:00', '09:00:00', 0),
('JD-2601021', 'MP-00002', 'P-2601001', 'M-2601003', 'PB-2612002', 'JOIN dan Query Lanjutan', '2026-01-14', '11:00:00', '12:00:00', 1),
('JD-2609001', 'MP-00001', 'P-2601005', 'M-2601001', 'PB-2601001', 'Materi Lama 1', '2025-09-10', '08:00:00', '09:00:00', 1),
('JD-2609002', 'MP-00002', 'P-2601005', 'M-2601002', 'PB-2601003', 'Materi Lama 2', '2025-09-12', '09:00:00', '10:00:00', 0),
('JD-2612001', 'MP-00005', 'P-2601004', 'M-2601004', 'PB-2612003', 'Materi', '2026-12-25', '08:00:00', '09:00:00', NULL),
('JD-2612002', 'MP-00005', 'P-2601004', 'M-2601004', 'PB-2612003', 'Materi', '2026-12-25', '08:00:00', '09:00:00', NULL),
('JD-2612003', 'MP-00005', 'P-2601004', NULL, NULL, 'Pengenalan Database dan Tabel', '2026-12-25', '09:00:00', '10:00:00', NULL),
('JD-2612004', 'MP-00001', 'P-2601001', 'M-2601006', 'PB-2612003', NULL, '2026-12-14', '08:00:00', '09:00:00', NULL),
('JD-2612005', 'MP-00003', 'P-2601002', 'M-2601003', 'PB-2612002', 'Form, Table, dan Layout Web', '2026-12-30', '08:00:00', '09:00:00', NULL),
('JD-2612006', 'MP-00003', 'P-2601002', 'M-2601004', 'PB-2612003', NULL, '2026-12-20', '08:00:00', '09:00:00', NULL),
('JD-2612007', 'MP-00005', 'P-2601004', NULL, NULL, 'Pengenalan Database dan Tabel', '2026-12-20', '09:00:00', '10:00:00', NULL),
('JD-2612008', 'MP-00001', 'P-2601001', 'M-2601005', 'PB-2601006', 'Variabel, Tipe Data, dan Operator', '2026-12-15', '08:00:00', '09:00:00', NULL),
('JD-2612009', 'MP-00002', 'P-2601001', 'M-2601006', 'PB-2612003', NULL, '2026-12-15', '08:00:00', '09:00:00', NULL),
('JD-2612010', 'MP-00001', 'P-2601001', NULL, NULL, NULL, '2026-12-31', '10:00:00', '11:00:00', NULL);

--
-- Triggers `jadwal`
--
DELIMITER $$
CREATE TRIGGER `TG_Jadwal_Proteksi_Insert` BEFORE INSERT ON `jadwal` FOR EACH ROW BEGIN
  IF (NEW.id_murid IS NULL AND NEW.id_pembelian IS NOT NULL)
     OR (NEW.id_murid IS NOT NULL AND NEW.id_pembelian IS NULL) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'id_murid dan id_pembelian harus diisi bersamaan';
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_Jadwal_Proteksi_Update` BEFORE UPDATE ON `jadwal` FOR EACH ROW BEGIN
  IF (NEW.id_murid IS NULL AND NEW.id_pembelian IS NOT NULL)
     OR (NEW.id_murid IS NOT NULL AND NEW.id_pembelian IS NULL) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'id_murid dan id_pembelian harus diisi bersamaan';
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_LogEditJadwal` AFTER UPDATE ON `jadwal` FOR EACH ROW BEGIN
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
    VALUES (NOW(), CONCAT('Edit jadwal: ', NEW.kode_jadwal),
            COALESCE(@current_user_id, NEW.id_pengajar, NEW.id_murid, 'SYSTEM'));
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_LogHapusJadwal` BEFORE DELETE ON `jadwal` FOR EACH ROW BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Hapus jadwal: ', OLD.kode_jadwal),
          COALESCE(@current_user_id, OLD.id_pengajar, OLD.id_murid, 'SYSTEM'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_LogInputAbsensi` AFTER UPDATE ON `jadwal` FOR EACH ROW BEGIN
  IF (NOT (OLD.status_kehadiran <=> NEW.status_kehadiran)
      OR NOT (OLD.deskripsiMateri <=> NEW.deskripsiMateri)) THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Input absensi jadwal: ', NEW.kode_jadwal),
            COALESCE(@current_user_id, NEW.id_pengajar, NEW.id_murid, 'SYSTEM'));
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_LogTambahJadwal` AFTER INSERT ON `jadwal` FOR EACH ROW BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Tambah jadwal: ', NEW.kode_jadwal),
          COALESCE(@current_user_id, NEW.id_pengajar, NEW.id_murid, 'SYSTEM'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `katalogpaket`
--

CREATE TABLE `katalogpaket` (
  `id_paket` varchar(20) NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `jml_pertemuan` int(11) NOT NULL,
  `masa_aktif_hari` int(11) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `status_dijual` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `katalogpaket`
--

INSERT INTO `katalogpaket` (`id_paket`, `nama_paket`, `jml_pertemuan`, `masa_aktif_hari`, `harga`, `status_dijual`) VALUES
('PK-00001', 'Paket 4x', 4, 30, 400000.00, 1),
('PK-00002', 'Paket 8x', 8, 60, 700000.00, 1),
('PK-00003', 'Paket 12x', 12, 90, 1000000.00, 1),
('PK-00004', 'Paket 4x Promo', 4, 30, 300000.00, 0),
('PK-00005', 'Paket 6x', 6, 45, 550000.00, 1),
('PK-00006', 'Paket Lama', 10, 60, 800000.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_sistem`
--

CREATE TABLE `log_sistem` (
  `id_log` bigint(20) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `aktivitas` text NOT NULL,
  `id_akun` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_sistem`
--

INSERT INTO `log_sistem` (`id_log`, `tanggal`, `aktivitas`, `id_akun`) VALUES
(1, '2026-01-14 21:40:00', 'Admin menambahkan data jadwal', 'A-00001'),
(2, '2026-01-14 21:42:00', 'Murid melakukan pembelian paket', 'M-2601001'),
(3, '2026-01-14 21:45:00', 'Admin memverifikasi pembayaran', 'A-00001'),
(4, '2026-01-15 08:05:00', 'Pengajar mengisi materi jadwal', 'P-2601001'),
(5, '2026-01-17 17:04:12', 'Edit akun admin: A-2601001', 'A-2601001'),
(6, '2026-01-17 17:04:12', 'Edit akun admin: A-2601002', 'A-2601002'),
(7, '2026-01-17 17:04:12', 'Edit akun admin: A-2601003', 'A-2601003'),
(8, '2026-01-17 17:04:12', 'Edit akun pengajar: P-2601001', 'P-2601001'),
(9, '2026-01-17 17:04:12', 'Edit akun pengajar: P-2601002', 'P-2601002'),
(10, '2026-01-17 17:04:12', 'Edit akun pengajar: P-2601003', 'P-2601003'),
(11, '2026-01-17 17:04:12', 'Edit akun pengajar: P-2601004', 'P-2601004'),
(12, '2026-01-17 17:04:12', 'Edit akun pengajar: P-2601005', 'P-2601005'),
(13, '2026-01-17 17:04:12', 'Edit akun murid: M-2601001', 'M-2601001'),
(14, '2026-01-17 17:04:12', 'Edit akun murid: M-2601002', 'M-2601002'),
(15, '2026-01-17 17:04:12', 'Edit akun murid: M-2601003', 'M-2601003'),
(16, '2026-01-17 17:04:12', 'Edit akun murid: M-2601004', 'M-2601004'),
(17, '2026-01-17 17:04:12', 'Edit akun murid: M-2601005', 'M-2601005'),
(18, '2026-01-17 17:04:12', 'Edit akun murid: M-2601006', 'M-2601006'),
(19, '2026-01-17 17:04:12', 'Edit akun murid: M-2601007', 'M-2601007'),
(20, '2026-01-17 17:04:12', 'Edit akun murid: M-2601008', 'M-2601008'),
(21, '2026-01-17 17:04:12', 'Edit akun murid: M-2601009', 'M-2601009'),
(22, '2026-01-17 17:04:12', 'Edit akun murid: M-2601010', 'M-2601010'),
(23, '2026-01-18 20:55:12', 'Ubah status akun murid: M-2601004', 'M-2601004'),
(24, '2026-01-18 20:55:28', 'Admin menandai lunas pembelian paket: PB-2601006', 'SYSTEM'),
(25, '2026-01-18 21:01:50', 'Pembelian paket: PB-2601016', 'M-2601005'),
(26, '2026-01-18 21:04:18', 'Input absensi jadwal: JD-2601006', 'P-2601002'),
(27, '2026-01-18 21:33:15', 'Edit akun admin: A-2601002', 'A-2601002'),
(28, '2026-01-18 21:33:22', 'Edit akun admin: A-2601003', 'A-2601003');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mapel` varchar(20) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `deskripsiMapel` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mapel`, `nama_mapel`, `deskripsiMapel`, `status`) VALUES
('MP-00001', 'Dasar Pemrograman', 'Belajar logika dasar, variabel, dan alur program', 1),
('MP-00002', 'Web Development', 'Belajar HTML, CSS, dan dasar JavaScript', 1),
('MP-00003', 'PHP & MySQL', 'Membangun website dinamis dengan PHP dan database MySQL', 1),
('MP-00004', 'Java OOP', 'Belajar pemrograman berorientasi objek menggunakan Java', 0),
('MP-00005', 'Python Programming', 'Belajar Python untuk pemula sampai menengah', 1),
('MP-00006', 'Algoritma & Struktur Data', 'Belajar algoritma, array, stack, queue, dan sorting', 0);

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `id_murid` varchar(20) NOT NULL,
  `nama_murid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`id_murid`, `nama_murid`, `email`, `password`, `status`) VALUES
('M-2601001', 'Andika Saputra', 'andika.saputra@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('M-2601002', 'Budi Hartono', 'budi.hartono@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('M-2601003', 'Caca Ramadhani', 'caca.ramadhani@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('M-2601004', 'Doni Kurniawan', 'doni.kurniawan@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('M-2601005', 'Eka Puspita', 'eka.puspita@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('M-2601006', 'Fani Wulandari', 'fani.wulandari@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 0),
('M-2601007', 'Gilang Pratama', 'gilang@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('M-2601008', 'Hendra Wijaya', 'hendra@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('M-2601009', 'Intan Permata', 'intan@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('M-2601010', 'Joko Santoso', 'joko@gmail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1);

--
-- Triggers `murid`
--
DELIMITER $$
CREATE TRIGGER `TG_LogEditAkun_Murid` AFTER UPDATE ON `murid` FOR EACH ROW BEGIN
  IF (NOT (OLD.nama_murid <=> NEW.nama_murid)
      OR NOT (OLD.email <=> NEW.email)
      OR NOT (OLD.password <=> NEW.password)) THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Edit akun murid: ', NEW.id_murid), COALESCE(@current_user_id, NEW.id_murid, 'SYSTEM'));
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_LogTambahAkun_Murid` AFTER INSERT ON `murid` FOR EACH ROW BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Tambah akun murid: ', NEW.id_murid), COALESCE(@current_user_id, NEW.id_murid, 'SYSTEM'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_LogUbahStatusAkun_Murid` AFTER UPDATE ON `murid` FOR EACH ROW BEGIN
  IF OLD.status <> NEW.status THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Ubah status akun murid: ', NEW.id_murid), COALESCE(@current_user_id, NEW.id_murid, 'SYSTEM'));
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `paketdibeli`
--

CREATE TABLE `paketdibeli` (
  `id_pembelian` varchar(20) NOT NULL,
  `id_murid` varchar(20) NOT NULL,
  `id_paket` varchar(20) NOT NULL,
  `tgl_pemesanan` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_pembayaran` datetime DEFAULT NULL,
  `gambar_bukti_pembayaran` text DEFAULT NULL,
  `tgl_kedaluwarsa` datetime DEFAULT NULL,
  `pertemuan_terpakai` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paketdibeli`
--

INSERT INTO `paketdibeli` (`id_pembelian`, `id_murid`, `id_paket`, `tgl_pemesanan`, `tgl_pembayaran`, `gambar_bukti_pembayaran`, `tgl_kedaluwarsa`, `pertemuan_terpakai`) VALUES
('PB-2601001', 'M-2601001', 'PK-00002', '2026-01-14 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-02-13 21:38:00', 6),
('PB-2601002', 'M-2601001', 'PK-00002', '2026-01-11 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-03-15 21:38:00', 0),
('PB-2601003', 'M-2601002', 'PK-00002', '2026-01-04 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-02-13 21:38:00', 6),
('PB-2601004', 'M-2601003', 'PK-00002', '2026-01-14 21:38:00', NULL, NULL, NULL, 0),
('PB-2601005', 'M-2601004', 'PK-00005', '2026-01-12 21:38:00', NULL, NULL, NULL, 0),
('PB-2601006', 'M-2601005', 'PK-00002', '2026-01-14 21:38:00', '2026-01-18 20:55:28', 'bukti.jpg', '2026-03-19 20:55:28', 4),
('PB-2601007', 'M-2601005', 'PK-00002', '2026-01-07 21:38:00', NULL, 'bukti.jpg', '2026-03-15 21:38:00', 0),
('PB-2601011', 'M-2601002', 'PK-00002', '2026-01-12 09:02:42', '2026-01-17 09:02:42', 'bukti.jpg', '2026-02-26 09:02:42', 0),
('PB-2601012', 'M-2601009', 'PK-00002', '2026-01-07 09:02:42', '2026-01-17 09:02:42', 'bukti.jpg', '2026-02-06 09:02:42', 0),
('PB-2601013', 'M-2601008', 'PK-00002', '2025-10-09 09:02:42', '2026-01-17 09:02:42', 'bukti.jpg', '2026-01-07 09:02:42', 0),
('PB-2601014', 'M-2601010', 'PK-00003', '2026-01-17 09:02:42', NULL, NULL, NULL, 0),
('PB-2601015', 'M-2601005', 'PK-00002', '2026-01-15 09:02:42', NULL, 'bukti_pending.jpg', NULL, 0),
('PB-2601016', 'M-2601005', 'PK-00001', '2026-01-18 21:01:50', NULL, NULL, NULL, 0),
('PB-2602001', 'M-2601007', 'PK-00001', '2026-01-16 09:02:42', NULL, NULL, NULL, 0),
('PB-2602002', 'M-2601007', 'PK-00002', '2026-01-14 09:02:42', NULL, 'bukti_pending_2601007.jpg', NULL, 0),
('PB-2602003', 'M-2601007', 'PK-00003', '2026-01-07 09:02:42', '2026-01-17 09:02:42', 'bukti.jpg', '2026-04-07 09:02:42', 0),
('PB-2612001', 'M-2601002', 'PK-00003', '2026-12-05 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-04-14 21:38:00', 0),
('PB-2612002', 'M-2601003', 'PK-00002', '2026-12-25 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-02-13 21:38:00', 6),
('PB-2612003', 'M-2601006', 'PK-00002', '2026-12-30 21:38:00', '2026-01-14 21:38:00', 'bukti.jpg', '2026-04-14 21:38:00', 3);

--
-- Triggers `paketdibeli`
--
DELIMITER $$
CREATE TRIGGER `TG_LogPembelianPaket` AFTER INSERT ON `paketdibeli` FOR EACH ROW BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Pembelian paket: ', NEW.id_pembelian),
          COALESCE(@current_user_id, NEW.id_murid, 'SYSTEM'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_LogUploadBuktiPembayaran` AFTER UPDATE ON `paketdibeli` FOR EACH ROW BEGIN
  IF NOT (OLD.gambar_bukti_pembayaran <=> NEW.gambar_bukti_pembayaran) THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Upload bukti pembayaran: ', NEW.id_pembelian),
            COALESCE(@current_user_id, NEW.id_murid, 'SYSTEM'));
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_Paket_MaxKuota_Insert` BEFORE INSERT ON `paketdibeli` FOR EACH ROW BEGIN
  DECLARE v_max INT;

  SELECT jml_pertemuan
  INTO v_max
  FROM katalogpaket
  WHERE id_paket = NEW.id_paket;

  IF NEW.pertemuan_terpakai > v_max THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'pertemuan_terpakai melebihi kuota paket';
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_Paket_MaxKuota_Update` BEFORE UPDATE ON `paketdibeli` FOR EACH ROW BEGIN
  DECLARE v_max INT;

  SELECT jml_pertemuan
  INTO v_max
  FROM katalogpaket
  WHERE id_paket = NEW.id_paket;

  IF NEW.pertemuan_terpakai > v_max THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'pertemuan_terpakai melebihi kuota paket';
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_Paket_NonNegatif_Insert` BEFORE INSERT ON `paketdibeli` FOR EACH ROW BEGIN
  IF NEW.pertemuan_terpakai < 0 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'pertemuan_terpakai tidak boleh negatif';
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_Paket_NonNegatif_Update` BEFORE UPDATE ON `paketdibeli` FOR EACH ROW BEGIN
  IF NEW.pertemuan_terpakai < 0 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'pertemuan_terpakai tidak boleh negatif';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengajar`
--

CREATE TABLE `pengajar` (
  `id_pengajar` varchar(20) NOT NULL,
  `nama_pengajar` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajar`
--

INSERT INTO `pengajar` (`id_pengajar`, `nama_pengajar`, `email`, `password`, `status`) VALUES
('P-2601001', 'Pengajar Andi', 'andi.pengajar@mail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('P-2601002', 'Pengajar Bima', 'bima.pengajar@mail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('P-2601003', 'Pengajar Citra', 'citra.pengajar@mail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 0),
('P-2601004', 'Pengajar Dewa', 'dewa.pengajar@mail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 1),
('P-2601005', 'Pengajar Eko', 'eko.pengajar@mail.com', '$2y$10$8qmd9YCXNtFzABM.V9tOdu9Lbnl7i3AQbMUzypNjUwJdUuAC8Hrii', 0);

--
-- Triggers `pengajar`
--
DELIMITER $$
CREATE TRIGGER `TG_LogEditAkun_Pengajar` AFTER UPDATE ON `pengajar` FOR EACH ROW BEGIN
  IF (NOT (OLD.nama_pengajar <=> NEW.nama_pengajar)
      OR NOT (OLD.email <=> NEW.email)
      OR NOT (OLD.password <=> NEW.password)) THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Edit akun pengajar: ', NEW.id_pengajar), COALESCE(@current_user_id, NEW.id_pengajar, 'SYSTEM'));
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_LogTambahAkun_Pengajar` AFTER INSERT ON `pengajar` FOR EACH ROW BEGIN
  INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
  VALUES (NOW(), CONCAT('Tambah akun pengajar: ', NEW.id_pengajar), COALESCE(@current_user_id, NEW.id_pengajar, 'SYSTEM'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TG_LogUbahStatusAkun_Pengajar` AFTER UPDATE ON `pengajar` FOR EACH ROW BEGIN
  IF OLD.status <> NEW.status THEN
    INSERT INTO log_sistem(tanggal, aktivitas, id_akun)
    VALUES (NOW(), CONCAT('Ubah status akun pengajar: ', NEW.id_pengajar), COALESCE(@current_user_id, NEW.id_pengajar, 'SYSTEM'));
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_dashboardadmin_jadwalterisi`
-- (See below for the actual view)
--
CREATE TABLE `view_dashboardadmin_jadwalterisi` (
`kode_jadwal` varchar(20)
,`tanggal` date
,`hari` varchar(9)
,`waktu` varchar(23)
,`nama_pengajar` varchar(255)
,`nama_mapel` varchar(255)
,`nama_murid` varchar(255)
,`deskripsiMateri` text
,`status_kehadiran` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_dashboardmurid_jadwalmendatang`
-- (See below for the actual view)
--
CREATE TABLE `view_dashboardmurid_jadwalmendatang` (
`kode_jadwal` varchar(20)
,`id_murid` varchar(20)
,`nama_murid` varchar(255)
,`tanggal` date
,`hari` varchar(9)
,`waktu` varchar(23)
,`id_mapel` varchar(20)
,`nama_mapel` varchar(255)
,`id_pengajar` varchar(20)
,`nama_pengajar` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_dashboardpengajar_jadwalmendatang`
-- (See below for the actual view)
--
CREATE TABLE `view_dashboardpengajar_jadwalmendatang` (
`kode_jadwal` varchar(20)
,`id_pengajar` varchar(20)
,`nama_pengajar` varchar(255)
,`tanggal` date
,`hari` varchar(9)
,`waktu` varchar(23)
,`id_mapel` varchar(20)
,`nama_mapel` varchar(255)
,`id_murid` varchar(20)
,`nama_murid` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_logsemua`
-- (See below for the actual view)
--
CREATE TABLE `view_logsemua` (
`id_log` bigint(20) unsigned
,`tanggal` datetime
,`aktivitas` text
,`id_akun` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_logsistem`
-- (See below for the actual view)
--
CREATE TABLE `view_logsistem` (
`id_log` bigint(20) unsigned
,`tanggal` datetime
,`aktivitas` mediumtext
,`id_akun` varchar(20)
,`role` varchar(8)
,`nama_pengguna` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_matapelajaranaktif`
-- (See below for the actual view)
--
CREATE TABLE `view_matapelajaranaktif` (
`id_mapel` varchar(20)
,`nama_mapel` varchar(255)
,`deskripsiMapel` text
,`status` tinyint(1)
,`daftar_pengajar` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_matapelajarannonaktif`
-- (See below for the actual view)
--
CREATE TABLE `view_matapelajarannonaktif` (
`id_mapel` varchar(20)
,`nama_mapel` varchar(255)
,`deskripsiMapel` text
,`status` tinyint(1)
,`daftar_pengajar` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_paketlesaktif`
-- (See below for the actual view)
--
CREATE TABLE `view_paketlesaktif` (
`id_paket` varchar(20)
,`nama_paket` varchar(255)
,`jml_pertemuan` int(11)
,`masa_aktif_hari` int(11)
,`harga` decimal(12,2)
,`status_dijual` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_paketlesnonaktif`
-- (See below for the actual view)
--
CREATE TABLE `view_paketlesnonaktif` (
`id_paket` varchar(20)
,`nama_paket` varchar(255)
,`jml_pertemuan` int(11)
,`masa_aktif_hari` int(11)
,`harga` decimal(12,2)
,`status_dijual` tinyint(1)
);

-- --------------------------------------------------------

--
-- Structure for view `view_dashboardadmin_jadwalterisi`
--
DROP TABLE IF EXISTS `view_dashboardadmin_jadwalterisi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_dashboardadmin_jadwalterisi`  AS SELECT `j`.`kode_jadwal` AS `kode_jadwal`, `j`.`tanggal` AS `tanggal`, dayname(`j`.`tanggal`) AS `hari`, concat(date_format(`j`.`jam_mulai`,'%H:%i'),' - ',date_format(`j`.`jam_akhir`,'%H:%i')) AS `waktu`, `p`.`nama_pengajar` AS `nama_pengajar`, `mp`.`nama_mapel` AS `nama_mapel`, `m`.`nama_murid` AS `nama_murid`, `j`.`deskripsiMateri` AS `deskripsiMateri`, `j`.`status_kehadiran` AS `status_kehadiran` FROM (((`jadwal` `j` join `murid` `m` on(`j`.`id_murid` = `m`.`id_murid`)) join `pengajar` `p` on(`j`.`id_pengajar` = `p`.`id_pengajar`)) join `mata_pelajaran` `mp` on(`j`.`id_mapel` = `mp`.`id_mapel`)) WHERE `j`.`id_murid` is not null ;

-- --------------------------------------------------------

--
-- Structure for view `view_dashboardmurid_jadwalmendatang`
--
DROP TABLE IF EXISTS `view_dashboardmurid_jadwalmendatang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_dashboardmurid_jadwalmendatang`  AS SELECT `j`.`kode_jadwal` AS `kode_jadwal`, `j`.`id_murid` AS `id_murid`, `m`.`nama_murid` AS `nama_murid`, `j`.`tanggal` AS `tanggal`, dayname(`j`.`tanggal`) AS `hari`, concat(date_format(`j`.`jam_mulai`,'%H:%i'),' - ',date_format(`j`.`jam_akhir`,'%H:%i')) AS `waktu`, `j`.`id_mapel` AS `id_mapel`, `mp`.`nama_mapel` AS `nama_mapel`, `j`.`id_pengajar` AS `id_pengajar`, `p`.`nama_pengajar` AS `nama_pengajar` FROM (((`jadwal` `j` join `murid` `m` on(`j`.`id_murid` = `m`.`id_murid`)) join `mata_pelajaran` `mp` on(`j`.`id_mapel` = `mp`.`id_mapel`)) join `pengajar` `p` on(`j`.`id_pengajar` = `p`.`id_pengajar`)) WHERE `j`.`id_murid` is not null AND `j`.`tanggal` >= curdate() ;

-- --------------------------------------------------------

--
-- Structure for view `view_dashboardpengajar_jadwalmendatang`
--
DROP TABLE IF EXISTS `view_dashboardpengajar_jadwalmendatang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_dashboardpengajar_jadwalmendatang`  AS SELECT `j`.`kode_jadwal` AS `kode_jadwal`, `j`.`id_pengajar` AS `id_pengajar`, `p`.`nama_pengajar` AS `nama_pengajar`, `j`.`tanggal` AS `tanggal`, dayname(`j`.`tanggal`) AS `hari`, concat(date_format(`j`.`jam_mulai`,'%H:%i'),' - ',date_format(`j`.`jam_akhir`,'%H:%i')) AS `waktu`, `j`.`id_mapel` AS `id_mapel`, `mp`.`nama_mapel` AS `nama_mapel`, `j`.`id_murid` AS `id_murid`, `m`.`nama_murid` AS `nama_murid` FROM (((`jadwal` `j` join `pengajar` `p` on(`j`.`id_pengajar` = `p`.`id_pengajar`)) join `mata_pelajaran` `mp` on(`j`.`id_mapel` = `mp`.`id_mapel`)) join `murid` `m` on(`j`.`id_murid` = `m`.`id_murid`)) WHERE `j`.`id_murid` is not null AND `j`.`tanggal` >= curdate() ;

-- --------------------------------------------------------

--
-- Structure for view `view_logsemua`
--
DROP TABLE IF EXISTS `view_logsemua`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_logsemua`  AS SELECT `log_sistem`.`id_log` AS `id_log`, `log_sistem`.`tanggal` AS `tanggal`, `log_sistem`.`aktivitas` AS `aktivitas`, `log_sistem`.`id_akun` AS `id_akun` FROM `log_sistem` ;

-- --------------------------------------------------------

--
-- Structure for view `view_logsistem`
--
DROP TABLE IF EXISTS `view_logsistem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_logsistem`  AS SELECT `l`.`id_log` AS `id_log`, `l`.`tanggal` AS `tanggal`, `l`.`aktivitas` AS `aktivitas`, `l`.`id_akun` AS `id_akun`, 'Murid' AS `role`, `m`.`nama_murid` AS `nama_pengguna` FROM (`log_sistem` `l` join `murid` `m` on(`l`.`id_akun` = `m`.`id_murid`))union all select `l`.`id_log` AS `id_log`,`l`.`tanggal` AS `tanggal`,`l`.`aktivitas` AS `aktivitas`,`l`.`id_akun` AS `id_akun`,'Pengajar' AS `role`,`p`.`nama_pengajar` AS `nama_pengguna` from (`log_sistem` `l` join `pengajar` `p` on(`l`.`id_akun` = `p`.`id_pengajar`)) union all select `l`.`id_log` AS `id_log`,`l`.`tanggal` AS `tanggal`,`l`.`aktivitas` AS `aktivitas`,`l`.`id_akun` AS `id_akun`,'Admin' AS `role`,`a`.`nama_admin` AS `nama_pengguna` from (`log_sistem` `l` join `admin` `a` on(`l`.`id_akun` = `a`.`id_admin`))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_matapelajaranaktif`
--
DROP TABLE IF EXISTS `view_matapelajaranaktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_matapelajaranaktif`  AS SELECT `m`.`id_mapel` AS `id_mapel`, `m`.`nama_mapel` AS `nama_mapel`, `m`.`deskripsiMapel` AS `deskripsiMapel`, `m`.`status` AS `status`, group_concat(`p`.`nama_pengajar` separator ', ') AS `daftar_pengajar` FROM ((`mata_pelajaran` `m` left join `diajar` `d` on(`d`.`id_mapel` = `m`.`id_mapel`)) left join `pengajar` `p` on(`p`.`id_pengajar` = `d`.`id_pengajar`)) WHERE `m`.`status` = 1 GROUP BY `m`.`id_mapel` ;

-- --------------------------------------------------------

--
-- Structure for view `view_matapelajarannonaktif`
--
DROP TABLE IF EXISTS `view_matapelajarannonaktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_matapelajarannonaktif`  AS SELECT `m`.`id_mapel` AS `id_mapel`, `m`.`nama_mapel` AS `nama_mapel`, `m`.`deskripsiMapel` AS `deskripsiMapel`, `m`.`status` AS `status`, group_concat(`p`.`nama_pengajar` separator ', ') AS `daftar_pengajar` FROM ((`mata_pelajaran` `m` left join `diajar` `d` on(`d`.`id_mapel` = `m`.`id_mapel`)) left join `pengajar` `p` on(`p`.`id_pengajar` = `d`.`id_pengajar`)) WHERE `m`.`status` = 0 GROUP BY `m`.`id_mapel` ;

-- --------------------------------------------------------

--
-- Structure for view `view_paketlesaktif`
--
DROP TABLE IF EXISTS `view_paketlesaktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_paketlesaktif`  AS SELECT `katalogpaket`.`id_paket` AS `id_paket`, `katalogpaket`.`nama_paket` AS `nama_paket`, `katalogpaket`.`jml_pertemuan` AS `jml_pertemuan`, `katalogpaket`.`masa_aktif_hari` AS `masa_aktif_hari`, `katalogpaket`.`harga` AS `harga`, `katalogpaket`.`status_dijual` AS `status_dijual` FROM `katalogpaket` WHERE `katalogpaket`.`status_dijual` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `view_paketlesnonaktif`
--
DROP TABLE IF EXISTS `view_paketlesnonaktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_paketlesnonaktif`  AS SELECT `katalogpaket`.`id_paket` AS `id_paket`, `katalogpaket`.`nama_paket` AS `nama_paket`, `katalogpaket`.`jml_pertemuan` AS `jml_pertemuan`, `katalogpaket`.`masa_aktif_hari` AS `masa_aktif_hari`, `katalogpaket`.`harga` AS `harga`, `katalogpaket`.`status_dijual` AS `status_dijual` FROM `katalogpaket` WHERE `katalogpaket`.`status_dijual` = 0 ;

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
  ADD UNIQUE KEY `uk_pengajar_mapel` (`id_mapel`,`id_pengajar`),
  ADD KEY `fk_diajar_pengajar` (`id_pengajar`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kode_jadwal`),
  ADD KEY `fk_jadwal_mapel` (`id_mapel`),
  ADD KEY `fk_jadwal_pengajar` (`id_pengajar`),
  ADD KEY `fk_jadwal_murid` (`id_murid`),
  ADD KEY `fk_jadwal_pembelian` (`id_pembelian`);

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
  ADD KEY `fk_paketdibeli_murid` (`id_murid`),
  ADD KEY `fk_paketdibeli_paket` (`id_paket`);

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
  MODIFY `id_diajar` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log_sistem`
--
ALTER TABLE `log_sistem`
  MODIFY `id_log` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diajar`
--
ALTER TABLE `diajar`
  ADD CONSTRAINT `fk_diajar_mapel` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id_mapel`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_diajar_pengajar` FOREIGN KEY (`id_pengajar`) REFERENCES `pengajar` (`id_pengajar`) ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_jadwal_mapel` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id_mapel`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_murid` FOREIGN KEY (`id_murid`) REFERENCES `murid` (`id_murid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `paketdibeli` (`id_pembelian`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_pengajar` FOREIGN KEY (`id_pengajar`) REFERENCES `pengajar` (`id_pengajar`) ON UPDATE CASCADE;

--
-- Constraints for table `paketdibeli`
--
ALTER TABLE `paketdibeli`
  ADD CONSTRAINT `fk_paketdibeli_murid` FOREIGN KEY (`id_murid`) REFERENCES `murid` (`id_murid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_paketdibeli_paket` FOREIGN KEY (`id_paket`) REFERENCES `katalogpaket` (`id_paket`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
