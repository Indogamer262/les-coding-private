<?php
    include_once("util/dbUtil.php");

    class DBLesCoding {
        private DBUtil $db;
        private $servername;
        private $username;
        private $password;
        private $dbname;

        // ===========================================
        // CONFIGURE YOUR MySQL LOGIN CREDENTIALS HERE
        // ===========================================
        public function __construct() {
            $this->servername = "localhost:3306";
            $this->username = "christi5_lesCoding";
            $this->password = "Gavin123@admin";
            $this->dbname = "les_coding";
            $this->db = new DBUtil($this->servername, $this->username, $this->password, $this->dbname);
        }

        public function verifyLogin($roles, $email, $password) {
            // sanitize the input
            $safe_username = str_replace("'", "", $email);
            if($roles == "murid" || $roles == "pengajar" || $roles == "admin") {
                $safe_roles = str_replace("'", "", $roles);
            }
            else {
                $safe_roles = 0;
            }

            // Do all of these only if roles is correct
            if($safe_roles != 0) {
                // firstly get the username
                $hashRaw = $this->db->readingQuery("SELECT password FROM $safe_roles WHERE email = '$safe_username'");
                $hash = $hashRaw[0]['password'] ?? null;
                // after we got the username, we shall verify the password it cames with
                // but return false immediately if there's no username tied to it
                if(!empty($hash)) {
                    return password_verify($password, $hash);
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        
        public function getAccountUsername($roles, $email) {
            $safe_email = str_replace("'", "", $email);
            if($roles == "murid" || $roles == "pengajar" || $roles == "admin") {
                $safe_roles = str_replace("'", "", $roles);
            }
            else {
                $safe_roles = 0;
            }
            
            //echo "getting account USN for $safe_roles with email $safe_email";
            
            // get the USN from DB
            $rawUsn = $this->db->readingQuery("SELECT nama_$safe_roles FROM $safe_roles WHERE email = '$safe_email'");
            $usn = $rawUsn[0]["nama_$safe_roles"] ?? null;
            
            return $usn;
        }
        public function getAccountId($roles, $email) {
            $safe_email = str_replace("'", "", $email);
            if($roles == "murid" || $roles == "pengajar" || $roles == "admin") {
                $safe_roles = str_replace("'", "", $roles);
            }
            else {
                $safe_roles = 0;
            }
            
            //echo "getting account USN for $safe_roles with email $safe_email";
            
            // get the USN from DB
            $rawId = $this->db->readingQuery("SELECT id_$safe_roles FROM $safe_roles WHERE email = '$safe_email'");
            $id = $rawId[0]["id_$safe_roles"] ?? null;
            
            return $id;
        }
        public function getValueStatistic($type, $role_id = null) {
            // admins dashboard
            
            if($type == "jumlahMurid") {
                return $this->db->readSingleValue("SELECT FC_getTotalMurid()");
            }
            else if ($type == "jumlahPengajar") {
                return $this->db->readSingleValue("SELECT FC_getTotalPengajar()");
            }
            else if ($type == "totalPendapatanBulan") {
                return $this->db->readSingleValue("SELECT FC_getPendapatanBulanIni()");
            }
            else if ($type == "pembelianPaketBelumLunas") {
                return $this->db->readSingleValue("SELECT FC_getTotalPembelianPaket()");
            }
            // murid dashboard
            else if ($type == "paketLesAktifMurid") {
                return $this->db->readSingleValue("SELECT FC_getJumlahPaketAktifMurid('$role_id')");//
            }
            else if ($type == "sisaPertemuanMurid") {
                return $this->db->readSingleValue("SELECT FC_getTotalSisaPertemuanMurid('$role_id')");
            }
            else if ($type == "jadwalHariIniMurid") {
                return $this->db->readSingleValue("SELECT FC_getTotalJadwalHariIniMurid('$role_id')");//
            }
            else if ($type == "jadwalMingguIniMurid") {
                return $this->db->readSingleValue("SELECT FC_getTotalJadwalMingguIniMurid('$role_id')");//
            }
            // pengajar dashboard
            else if ($type == "muridDiajar") {
                return $this->db->readSingleValue("SELECT FC_getTotalMuridDiajar('$role_id')");
            }
            else if ($type == "jadwalHariIniPengajar") {
                return $this->db->readSingleValue("SELECT FC_getTotalJadwalHariIniPengajar('$role_id')");//
            }
            else if ($type == "jadwalMingguIniPengajar") {
                return $this->db->readSingleValue("SELECT FC_getTotalJadwalMingguIniPengajar('$role_id')");//
            }
            else {
                return null;
            }
        }

        public function insertAccount($roles, $name, $email, $password) {
            $safe_email = str_replace("'", "", $email);
            $safe_name = str_replace("'", "", $name);
            if($roles == "murid" || $roles == "pengajar" || $roles == "admin") {
                $safe_roles = str_replace("'", "", $roles);
            }
            else {
                $safe_roles = 0;
            }

            // create password hash
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert to database
            $this->db->nonReadingQuery("CALL SP_TambahAkun ('$safe_roles','$safe_name','$safe_email','$hashed_password')");
        }

        public function editAccount($id, $name, $email, $password) {
            $safe_email = str_replace("'", "", $email);
            $safe_name = str_replace("'", "", $name);
            $safe_id = str_replace("'", "", $id);

            // Something is wrong: SP does not change password
            // thus i cannot create this method
        }

        public function renderTableBody($roles, $type) {
            if($roles == "admin") {

                // VIEW LIHAT TABEL

                if($type == "dashboard") {
                    $result = $this->db->readingQuery("SELECT * FROM view_DashboardAdmin_JadwalTerisi");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['tanggal'] . "</td>" .
                            "<td>" . $row['hari'] . "<br>". $row['waktu'] ."</td>" .
                            "<td>" . $row['nama_pengajar'] . "</td>" .
                            "<td>" . $row['nama_mapel'] . "</td>" .
                            "<td>" . $row['nama_murid'] . "</td>";
                    }
                }

                else if($type == "matapelajaranaktif") {
                    $result = $this->db->readingQuery("SELECT * FROM view_matapelajaranaktif");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['nama_mapel'] . "</td>" .
                            "<td>" . $row['deskripsiMapel'] . "</td>" .
                            // pengajar somehow
                            "<td>" . $row['status'] . "</td>";
                            // aksi somehow
                    }
                }
                else if($type == "matapelajarannonaktif") {
                    $result = $this->db->readingQuery("SELECT * FROM view_matapelajarannonaktif");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['nama_mapel'] . "</td>" .
                            "<td>" . $row['deskripsiMapel'] . "</td>" .
                            // pengajar somehow
                            "<td>" . $row['status'] . "</td>";
                            // aksi somehow
                    }
                }
                else if($type == "paketlesaktif") {
                    $result = $this->db->readingQuery("SELECT * FROM view_paketlesaktif");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['nama_paket'] . "</td>" .
                            "<td>" . $row['harga'] . "</td>" .
                            "<td>" . $row['jml_pertemuan'] . "</td>" .
                            "<td>" . $row['status'] . "</td>";
                            // aksi somehow
                    }
                }
                else if($type == "paketlesnonaktif") {
                    $result = $this->db->readingQuery("SELECT * FROM view_paketlesnonaktif");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['nama_paket'] . "</td>" .
                            "<td>" . $row['harga'] . "</td>" .
                            "<td>" . $row['jml_pertemuan'] . "</td>" .
                            "<td>" . $row['status'] . "</td>";
                            // aksi somehow
                    }
                }

                else if($type == "logsemua") {
                    $result = $this->db->readingQuery("SELECT * FROM view_logsemua");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['id_log'] . "</td>" .
                            "<td>" . $row['tanggal'] . "</td>" .
                            "<td>" . $row['aktivitas'] . "</td>" .
                            "<td>" . $row['id_akun'] . "</td>";
                    }
                }
                else if($type == "logmurid") {
                    $result = $this->db->readingQuery("SELECT * FROM view_logsistem WHERE role = 'Murid'");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['id_log'] . "</td>" .
                            "<td>" . $row['tanggal'] . "</td>" .
                            "<td>" . $row['aktivitas'] . "</td>" .
                            "<td>" . $row['id_akun'] . "</td>";
                    }
                }
                else if($type == "logpengajar") {
                    $result = $this->db->readingQuery("SELECT * FROM view_logsistem WHERE role = 'Pengajar'");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['id_log'] . "</td>" .
                            "<td>" . $row['tanggal'] . "</td>" .
                            "<td>" . $row['aktivitas'] . "</td>" .
                            "<td>" . $row['id_akun'] . "</td>";
                    }
                }
                else if($type == "logadmin") {
                    $result = $this->db->readingQuery("SELECT * FROM view_logsistem WHERE role = 'Admin'");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['id_log'] . "</td>" .
                            "<td>" . $row['tanggal'] . "</td>" .
                            "<td>" . $row['aktivitas'] . "</td>" .
                            "<td>" . $row['id_akun'] . "</td>";
                    }
                }

                // SP LIHAT TABEL

                // Stub functions for new admin pages (to be filled in later)
                else if($type == "accounts") {
                    // TODO: Implement accounts table query
                    // Query should return: id, nama, email, role, status
                    $result = $this->db->readingQuery("CALL SP_LihatAkun ('SEMUA', 'SEMUA')");

                    foreach($result as $row) {
                        if ($row['status']) {
                            $showStatus = "AKTIF";
                        }
                        else {
                            $showStatus = "NON-AKTIF";
                        }
                        echo "<tr>" . 
                            "<td>" . $row['id_akun'] . "</td>" .
                            "<td>" . $row['nama'] . "</td>" .
                            "<td>" . $row['email'] . "</td>" .
                            "<td>" . $row['role_akun'] . "</td>" .
                            "<td>" . $showStatus . "</td>" .
                            "<td>" . "<div class=\"actionBtns\"><button class='btn-edit' onclick='editAccount(\"".$row['id_akun']."\", [\"".$row['nama']."\",\"".$row['email']."\",\"".strtolower($row['role_akun'])."\"])'>Edit</button> <button class='btn-toggle'>Nonaktifkan</button>" . "</div></td>";
                    }

                }
                else if($type == "matapelajaran") {
                    // TODO: Implement mata pelajaran table query (combined aktif/nonaktif)
                    // Query should return: nama_mapel, deskripsi, status
                }
                else if($type == "paketles") {
                    // TODO: Implement paket les table query (combined aktif/nonaktif)
                    // Query should return: nama_paket, harga, jml_pertemuan, status
                }
                else if($type == "jadwal") {
                    // TODO: Implement jadwal table query
                    // Query should return: tanggal, hari, waktu, pengajar, mapel, murid
                }
                else if($type == "absensi") {
                    // TODO: Implement absensi table query
                    // Query should return: tanggal, hari, waktu, pengajar, mapel, murid
                }
                else if($type == "kehadiran") {
                    // TODO: Implement kehadiran/riwayat table query
                    // Query should return: tanggal, waktu, pengajar, mapel, murid, materi, status
                }
                else if($type == "pembelian") {
                    // TODO: Implement pembelian table query
                    // Query should return: id_pembelian, tanggal_pesan, tanggal_bayar, murid, paket, harga, masa_aktif
                }
                else if($type == "verifikasi") {
                    // TODO: Implement verifikasi pembayaran table query
                    // Query should return: id_pembelian, tanggal, murid, paket, jumlah, bukti_url
                }

            }
            else if($roles == "murid") {
                if($type == "dashboard") {
                    $result = $this->db->readingQuery("SELECT * FROM view_DashboardMurid_JadwalMendatang WHERE id_murid = '".$_SESSION["loginID"]."'");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['tanggal'] . "</td>" .
                            "<td>" . $row['hari'] . "<br>". $row['waktu'] ."</td>" .
                            "<td>" . $row['nama_mapel'] . "</td>" .
                            "<td>" . $row['nama_pengajar'] . "</td>";
                    }
                }
                // Stub functions for murid pages (to be filled in later)
                else if($type == "belipaket") {
                    // TODO: Render paket cards for purchase
                    // Should return paket cards HTML
                }
                else if($type == "riwayatpembelian") {
                    // TODO: Query riwayat pembelian murid
                    // Query should return: id_pembelian, tanggal, paket, harga, status
                }
                else if($type == "jadwal") {
                    // TODO: Query jadwal les murid
                    // Query should return: tanggal, hari, waktu, mapel, pengajar, status
                }
                else if($type == "kehadiran") {
                    // TODO: Query riwayat kehadiran murid
                    // Query should return: tanggal, waktu, pengajar, mapel, materi, status
                }
                else if($type == "paketsaya") {
                    // TODO: Query paket yang dibeli murid
                    // Query should return: id_pembelian, tanggal, paket, sisa, total, masa_aktif
                }
                else if($type == "jadwaltersedia") {
                    // TODO: Query jadwal tersedia untuk dipilih
                    // Query should return: tanggal, hari, waktu, pengajar, mapel
                }
                else if($type == "jadwaldipilih") {
                    // TODO: Query jadwal yang sudah dipilih murid
                    // Query should return: tanggal, hari, waktu, pengajar, mapel
                }
            }
            else if($roles == "pengajar") {
                if($type == "dashboard") {
                    $result = $this->db->readingQuery("SELECT * FROM view_DashboardPengajar_JadwalMendatang WHERE id_pengajar = '".$_SESSION["loginID"]."'");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['tanggal'] . "</td>" .
                            "<td>" . $row['hari'] . "<br>". $row['waktu'] ."</td>" .
                            "<td>" . $row['nama_mapel'] . "</td>" .
                            "<td>" . $row['nama_murid'] . "</td>";
                    }
                }
                // Stub functions for pengajar pages (to be filled in later)
                else if($type == "absensi") {
                    // TODO: Query jadwal untuk input absensi
                    // Query should return: tanggal, hari, waktu, mapel, murid
                }
                else if($type == "jadwal") {
                    // TODO: Query jadwal mengajar pengajar
                    // Query should return: tanggal, hari, waktu, mapel, murid, status
                }
                else if($type == "kehadiran") {
                    // TODO: Query riwayat kehadiran murid yang diajar
                    // Query should return: tanggal, waktu, murid, mapel, materi, status
                }
            }
        }
    }
?>