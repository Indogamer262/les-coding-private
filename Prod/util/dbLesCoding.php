<?php
    include_once("util/dbUtil.php");

    class DBLesCoding {
        public DBUtil $db;
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
                $hashRaw = $this->db->readingQuery("SELECT password FROM $safe_roles WHERE email = '$safe_username' AND status = 1");
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

        public function editAccount($id, $roles, $name, $email) {
            $safe_email = str_replace("'", "", $email);
            $safe_name = str_replace("'", "", $name);
            $safe_id = str_replace("'", "", $id);
            if($roles == "murid" || $roles == "pengajar" || $roles == "admin") {
                $safe_roles = str_replace("'", "", $roles);
            }
            else {
                $safe_roles = 0;
            }

            $this->db->nonReadingQuery("CALL SP_EditAkun ('$safe_roles', '$safe_id', '$safe_name', '$safe_email')");
        }

        public function editAccountPassword($id, $roles, $password) {
            $safe_id = str_replace("'", "", $id);
            if($roles == "murid" || $roles == "pengajar" || $roles == "admin") {
                $safe_roles = str_replace("'", "", $roles);
            }
            else {
                $safe_roles = 0;
            }

            // create new password hash
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $this->db->nonReadingQuery("UPDATE $safe_roles SET password = '$hashed_password' WHERE id_$safe_roles = '$safe_id'");
        }

        public function editAccountStatus($id, $roles, $targetStatus) {
            $safe_id = str_replace("'", "", $id);
            if($roles == "murid" || $roles == "pengajar" || $roles == "admin") {
                $safe_roles = str_replace("'", "", $roles);
            }
            else {
                $safe_roles = 0;
            }
            $safe_targetStatus = str_replace("'", "", $targetStatus);
            
            // update the status
            $this->db->nonReadingQuery("CALL SP_UbahStatusAkun('$safe_roles', '$safe_id', $safe_targetStatus)");
        }

        public function renderTableBody($roles, $type, $filters = []) {
            if($roles == "admin") {

                // VIEW LIHAT TABEL

                if($type == "dashboard") {
                    $result = $this->db->readingQuery("SELECT * FROM view_dashboardadmin_jadwalterisi");
                    
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

                else if($type == "accounts") {
                    // TODO: Implement accounts table query
                    // Query should return: id, nama, email, role, status
                    $result = $this->db->readingQuery("CALL SP_LihatAkun ('SEMUA', 'SEMUA')");

                    foreach($result as $row) {
                        if ($row['status']) {
                            $showStatus = "AKTIF";
                            $buttonToggle = "<button class='btn-toggle' onclick='alihStatus(\"".strtolower($row['role_akun'])."\", \"".$row['id_akun']."\",0)'>Nonaktifkan</button>";
                        }
                        else {
                            $showStatus = "NON-AKTIF";
                            $buttonToggle = "<button class='btn-toggle aktifkan' onclick='alihStatus(\"".strtolower($row['role_akun'])."\", \"".$row['id_akun']."\",1)'>Aktifkan</button>";
                        }
                        echo "<tr>" . 
                            "<td>" . $row['id_akun'] . "</td>" .
                            "<td>" . $row['nama'] . "</td>" .
                            "<td>" . $row['email'] . "</td>" .
                            "<td>" . $row['role_akun'] . "</td>" .
                            "<td>" . $showStatus . "</td>" .
                            "<td>" . "<div class=\"actionBtns\"><button class='btn-edit' onclick='editAccount(\"".$row['id_akun']."\", [\"".$row['nama']."\",\"".$row['email']."\",\"".strtolower($row['role_akun'])."\"])'>Edit</button> $buttonToggle" . "</div></td>";
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
                    // Filter handling
                    $periodeMap = [
                        'today' => 'HARI_INI',
                        'week' => 'MINGGU_INI',
                        'month' => 'BULAN_INI',
                        'all' => 'SEMUA'
                    ];
                    $statusMap = [
                        'terisi' => 'TERISI',
                        'belum' => 'KOSONG',
                        'all' => 'SEMUA'
                    ];
                    $sortMap = [
                        'terbaru' => 'TERBARU',
                        'terlama' => 'TERLAMA'
                    ];

                    $p_periode = isset($filters['periode']) ? ($periodeMap[$filters['periode']] ?? 'BULAN_INI') : 'BULAN_INI';
                    $p_status = isset($filters['status']) ? ($statusMap[$filters['status']] ?? 'SEMUA') : 'SEMUA';
                    $p_urut = isset($filters['sort']) ? ($sortMap[$filters['sort']] ?? 'TERBARU') : 'TERBARU';

                    $result = $this->db->readingQuery("CALL SP_LihatJadwal_Admin('$p_periode', '$p_status', '$p_urut')");

                    foreach($result as $row) {
                        $waktu = substr($row['jam_mulai'], 0, 5) . ' - ' . substr($row['jam_akhir'], 0, 5);
                        $formattedDate = date('d M Y', strtotime($row['tanggal']));
                        $muridDisplay = !empty($row['nama_murid']) ? 
                            '<span class="font-medium text-gray-800 whitespace-nowrap">' . htmlspecialchars($row['nama_murid']) . '</span>' : 
                            '<span class="text-xs text-blue-500 italic">Belum terisi</span>';
                        $dataStatus = !empty($row['nama_murid']) ? 'terisi' : 'belum';
                        
                        echo "<tr data-status='$dataStatus' class='hover:bg-gray-50 transition-colors'>" . 
                            "<td><span class='font-medium text-gray-800 whitespace-nowrap'>" . $formattedDate . "</span></td>" .
                            "<td><div><p class='font-medium text-gray-800'>" . $row['hari'] . "</p><p class='text-sm text-gray-600'>". $waktu ."</p></div></td>" .
                            "<td><span class='font-medium text-gray-800 whitespace-nowrap'>" . htmlspecialchars($row['nama_pengajar'] ?? '') . "</span></td>" .
                            "<td><span class='font-medium text-gray-800 whitespace-nowrap'>" . htmlspecialchars($row['nama_mapel'] ?? '') . "</span></td>" .
                            "<td>" . $muridDisplay . "</td>" .
                            "<td><div class='flex items-center justify-center gap-2'>" .
                                "<button type='button' onclick='editJadwal(\"".$row['kode_jadwal']."\", \"".$row['tanggal']."\", \"".$row['jam_mulai']."\", \"".$row['jam_akhir']."\")' class='inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors'>Edit</button>" .
                                "<button type='button' onclick='deleteJadwal(\"".$row['kode_jadwal']."\")' class='inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-red-600 text-white hover:bg-red-700 transition-colors'>Hapus</button>" .
                            "</div></td>" .
                            "</tr>";
                    }
                }
                else if($type == "absensi") {
                    // TODO: Implement absensi table query
                    // Query should return: tanggal, hari, waktu, pengajar, mapel, murid
                }
                else if($type == "kehadiran") {
                    // TODO: Implement kehadiran/riwayat table query
                    // Query should return: tanggal, waktu, pengajar, mapel, murid, materi, status
                }                
                else if($type == "verifikasi") {
                    $result = $this->db->readingQuery("CALL SP_LihatPembelianPaket('SEMUA', 'MENUNGGU_BUKTI')");

                    foreach($result as $row) {
                        $formattedJumlah = "Rp " . number_format($row['jumlah'], 0, ',', '.');
                        echo "<tr data-bukti='belum' data-murid='" . htmlspecialchars($row['nama_murid'] ?? '') . "' data-tanggal='" . htmlspecialchars($row['tgl_pemesanan'] ?? '') . "'>" . 
                            "<td>" . htmlspecialchars($row['id_pembelian'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['tgl_pemesanan'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_murid'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_paket'] ?? '') . "</td>" .
                            "<td>" . $formattedJumlah . "</td>" .
                            "<td> <i>Menunggu bukti</i> </td>" .
                            "</tr>";
                    }

                    $result2 = $this->db->readingQuery("CALL SP_LihatPembelianPaket('SEMUA', 'MENUNGGU_VERIFIKASI')");

                    foreach($result2 as $row) {
                        $bukti = $this->db->readSingleValue("SELECT gambar_bukti_pembayaran FROM paketdibeli WHERE id_pembelian = '" . $row['id_pembelian'] . "'");
                        $formattedJumlah = "Rp " . number_format($row['jumlah'], 0, ',', '.');

                        echo "<tr data-id='" . htmlspecialchars($row['id_pembelian'] ?? '') . "' " .
                             "data-pembelian='" . htmlspecialchars($row['id_pembelian'] ?? '') . "' " .
                             "data-murid='" . htmlspecialchars($row['nama_murid'] ?? '') . "' " .
                             "data-paket='" . htmlspecialchars($row['nama_paket'] ?? '') . "' " .
                             "data-jumlah='" . $formattedJumlah . "' " .
                             "data-bukti-url='" . htmlspecialchars($bukti ?? '') . "' " .
                             "data-bukti='ada' " .
                             "data-tanggal='" . htmlspecialchars($row['tgl_pemesanan'] ?? '') . "'>" . 
                            "<td>" . htmlspecialchars($row['id_pembelian'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['tgl_pemesanan'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_murid'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_paket'] ?? '') . "</td>" .
                            "<td>" . $formattedJumlah . "</td>" .
                            "<td><button class='btn-view' onclick='openBuktiModal(\"" . htmlspecialchars($row['id_pembelian'] ?? '') . "\")'>Lihat Bukti</button></td>" .
                            "</tr>";
                    }
                }

                else if($type == "pembelian") {                    
                    $result = $this->db->readingQuery("CALL SP_LihatRiwayatPembelian('SEMUA', 'SEMUA')");

                    foreach($result as $row) {
                        // Get detail for this pembelian
                        $detail = $this->getDetailPembelianPaket($row['id_pembelian']);
                        $totalPertemuan = $detail['total_pertemuan'] ?? 0;
                        $sisaPertemuan = $detail['sisa_pertemuan'] ?? 0;
                        
                        // Get list pertemuan terpakai 
                        $listPertemuan = $this->getListPertemuanTerpakai($row['id_pembelian']);
                        $jsonPertemuan = base64_encode(json_encode($listPertemuan));

                        $formattedJumlah = "Rp " . number_format($row['harga'], 0, ',', '.');
                        $isExpired = ($row['status'] == 'KEDALUWARSA') ? 'row-expired' : '';
                        
                        echo "<tr class='$isExpired' data-id='" . htmlspecialchars($row['id_pembelian'] ?? '') . "' " .
                             "data-murid='" . htmlspecialchars($row['nama_murid'] ?? '') . "' " .
                             "data-total='$totalPertemuan' " .
                             "data-sisa='$sisaPertemuan' " .
                             "data-terpakai='$jsonPertemuan' " .
                             "data-tanggal='" . htmlspecialchars($row['tgl_pemesanan'] ?? '') . "'>" . 
                            "<td style='text-align:center;'>" . htmlspecialchars($row['id_pembelian'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['tgl_pemesanan'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['tgl_pembayaran'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_murid'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_paket'] ?? '') . "</td>" .
                            "<td class='text-harga'>" . $formattedJumlah . "</td>" .
                            "<td>" . ($row['status'] == 'KEDALUWARSA' ? '<span class="text-expired">Kadaluarsa</span>' : htmlspecialchars($row['masa_aktif'] ?? '')) . "</td>" .
                            "<td style='text-align:center;'><button class='btn-view' onclick='openDetailModal(this)'>Lihat Detail</button></td>" .
                            "</tr>";
                    }

                }

                else if($type == "") {
                    
                }
            }
            else if($roles == "murid") {
                if($type == "dashboard") {
                    $result = $this->db->readingQuery("SELECT * FROM view_dashboardmurid_jadwalmendatang WHERE id_murid = '".$_SESSION["loginID"]."'");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['tanggal'] . "</td>" .
                            "<td>" . $row['hari'] . "<br>". $row['waktu'] ."</td>" .
                            "<td>" . $row['nama_mapel'] . "</td>" .
                            "<td>" . $row['nama_pengajar'] . "</td>";
                    }
                }  
                else if($type == "paketdijual") {

                    $result = $this->db->readingQuery("CALL SP_LihatPaketDijual ()");

                    foreach($result as $row) {
                        echo "<div class='paketCard'>" .
                                "<div class='paketHeader'>" .
                                    "<h3>" . $row['nama_paket'] . "</h3>" .
                                "</div>" .
                                "<div class='paketBody'>" .
                                    "<div class='paketPrice'>Rp " . number_format($row['harga'], 0, ',', '.') . "</div>" .
                                    "<ul class='paketFeatures'>" .
                                        "<li>" .
                                            "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polyline points='20 6 9 17 4 12'/></svg>" .
                                            $row['jml_pertemuan'] . " Pertemuan" .
                                        "</li>" .
                                        "<li>" .
                                            "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polyline points='20 6 9 17 4 12'/></svg>" .
                                            "Masa aktif " . $row['masa_aktif_hari'] . " hari" .
                                        "</li>" .
                                    "</ul>" .

                                    // need to make this work...
                                    "<button class='btn-beli' onclick='openBeliModal(\"".$row['id_paket']."\", \"".addslashes($row['nama_paket'] ?? '')."\", ".$row['harga'].")'>Beli Paket</button>" .
                                "</div>" .
                             "</div>";
                    }

                

                }
                else if($type == "riwayatPembelianMurid") {
 
                    $result = $this->db->readingQuery("CALL SP_LihatRiwayatPembelianMurid ('" . $_SESSION['loginID'] . "', 'SEMUA')");

                    foreach($result as $row) {
                        $statusClass = 'badge-pending';
                        $dataStatus = 'pending';
                        $statusText = 'Menunggu Pembayaran';
                        
                        // Map status to UI
                        if ($row['status_ui'] == 'LUNAS') {
                            $statusClass = 'badge-lunas';
                            $dataStatus = 'lunas';
                            $statusText = 'Lunas';
                        } else if ($row['status_ui'] == 'MENUNGGU_VERIFIKASI') {
                            $statusClass = 'badge-verifikasi';
                            $dataStatus = 'verifikasi';
                            $statusText = 'Menunggu Verifikasi';
                        }

                        echo "<tr data-status='" . $dataStatus . "'>" .
                                "<td>" . $row['id_pembelian'] . "</td>" .
                                "<td>" . $row['tanggal'] . "</td>" .
                                "<td>" . $row['nama_paket'] . "</td>" .
                                "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>" .
                                "<td style='text-align:center;'><span class='badge " . $statusClass . "'>" . $statusText . "</span></td>";
                                
                        if($row['status_ui'] == 'MENUNGGU_PEMBAYARAN') {
                            echo "<td style='text-align:center;'><button class='btn-upload' onclick='openUploadModal(\"".$row['id_pembelian']."\")'>Upload Bukti</button></td>";
                        }
                        else {
                            echo "<td style='text-align:center;'>-</td>";
                        }
                        echo "</tr>";
                    }
                }
                else if($type == "jadwal") {
                    // Map UI filters to SP parameters
                    $periodeMap = [
                        'today' => 'HARI_INI',
                        'week' => 'MINGGU_INI',
                        'month' => 'BULAN_INI',
                        'all' => 'SEMUA'
                    ];
                    $statusMap = [
                        'selesai' => 'SELESAI',
                        'mendatang' => 'MENDATANG',
                        'all' => 'SEMUA'
                    ];

                    $p_periode = isset($filters['periode']) ? ($periodeMap[$filters['periode']] ?? 'SEMUA') : 'SEMUA';
                    $p_status = isset($filters['status']) ? ($statusMap[$filters['status']] ?? 'SEMUA') : 'SEMUA';

                    $result = $this->db->readingQuery("CALL SP_LihatJadwalMurid('".$_SESSION["loginID"]."', '$p_periode', '$p_status')");

                    foreach($result as $row) {
                        $waktu = substr($row['jam_mulai'], 0, 5) . ' - ' . substr($row['jam_akhir'], 0, 5);
                        $badgeClass = ($row['status_ui'] == 'SELESAI') ? 'badge-selesai' : 'badge-mendatang';
                        
                        echo "<tr>" . 
                            "<td>" . htmlspecialchars($row['tanggal'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['hari'] ?? '') . "<br>". $waktu ."</td>" .
                            "<td>" . htmlspecialchars($row['nama_mapel'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_pengajar'] ?? '') . "</td>" .
                            "<td style='text-align:center;'><span class='badge " . $badgeClass . "'>" . $row['status_ui'] . "</span></td>" .
                            "</tr>";
                    }
                }
                else if($type == "kehadiran") {
                    // SP_RiwayatKehadiranMurid(p_id_murid, p_periode, p_status, p_urut)
                    // Using 'SEMUA' for periode and status, 'TERBARU' for sort order
                    $result = $this->db->readingQuery("CALL SP_RiwayatKehadiranMurid('".$_SESSION["loginID"]."', 'SEMUA', 'SEMUA', 'TERBARU')");
                    
                    foreach($result as $row) {
                        $waktu = substr($row['jam_mulai'], 0, 5) . ' - ' . substr($row['jam_akhir'], 0, 5);
                        $tanggalWaktu = $row['tanggal_ui'] . "<br>" . $row['hari'] . " " . $waktu;
                        
                        $statusUI = $row['status_kehadiran_ui'];
                        if($statusUI == 'Hadir') {
                            $badgeClass = 'badge-hadir';
                            $statusText = 'Hadir';
                            $dataStatus = 'hadir';
                        } else {
                            $badgeClass = 'badge-tidak-hadir';
                            $statusText = 'Tidak Hadir';
                            $dataStatus = 'tidak-hadir';
                        }
                        
                        $materi = !empty($row['deskripsiMateri']) && $row['deskripsiMateri'] != '-' ? $row['deskripsiMateri'] : '-';
                        
                        echo "<tr data-status='" . $dataStatus . "' data-tanggal='" . htmlspecialchars($row['tanggal'] ?? '') . "'>" . 
                            "<td>" . $tanggalWaktu . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_pengajar'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_mapel'] ?? '') . "</td>" .
                            "<td>" . $materi . "</td>" .
                            "<td style='text-align:center;'><span class='badge " . $badgeClass . "'>" . $statusText . "</span></td>" .
                            "</tr>";
                    }
                }
                else if($type == "paketsaya") {
                    $result = $this->db->readingQuery("CALL SP_LihatRiwayatPembelianMurid ('" . $_SESSION['loginID'] . "', 'LUNAS')");

                    foreach($result as $row) {
                        $isExpired = false;
                        $masaAktif = '-';
                        
                        if (!empty($row['tgl_kedaluwarsa'])) {
                            $tglExp = new DateTime($row['tgl_kedaluwarsa']);
                            $today = new DateTime();
                            $today->setTime(0,0,0); // reset time part
                            
                            if ($tglExp < $today) {
                                $isExpired = true;
                                $masaAktif = 'Kadaluarsa';
                            } else {
                                $diff = $today->diff($tglExp);
                                $masaAktif = $diff->days . ' hari';
                            }
                        }
                        
                        $rowClass = $isExpired ? 'row-expired' : '';
                        $sisa = $row['jml_pertemuan'] - $row['pertemuan_terpakai'];
                        
                        // Get list pertemuan terpakai for detail modal
                        $listPertemuan = $this->getListPertemuanTerpakai($row['id_pembelian']);
                        $jsonPertemuan = base64_encode(json_encode($listPertemuan));
                        
                        echo "<tr class='" . $rowClass . "' " . 
                             "data-id='" . $row['id_pembelian'] . "' " .
                             "data-paket='" . htmlspecialchars($row['nama_paket'] ?? '') . "' " .
                             "data-sisa='" . $sisa . "' " .
                             "data-total='" . $row['jml_pertemuan'] . "' " .
                             "data-terpakai='" . $jsonPertemuan . "'>" .
                                "<td>" . $row['id_pembelian'] . "</td>" .
                                "<td>" . $row['tanggal'] . "</td>" .
                                "<td>" . $row['nama_paket'] . "</td>" .
                                "<td style='text-align:center;'><span class='text-sisa'>" . $sisa . "</span> / " . $row['jml_pertemuan'] . "</td>" .
                                "<td>" . ($isExpired ? '<span class="text-expired">Kadaluarsa</span>' : $masaAktif) . "</td>" .
                                "<td style='text-align:center;'><button class='btn-view' onclick='openDetailModal(this)'>Lihat Detail</button></td>" .
                             "</tr>";
                    }
                }
                else if($type == "jadwaltersedia") {
                    $periodeMap = [
                        'today' => 'HARI_INI',
                        'week' => 'MINGGU_INI',
                        'month' => 'BULAN_INI',
                        'all' => 'SEMUA'
                    ];
                    
                    $p_periode = isset($filters['periode']) ? ($periodeMap[$filters['periode']] ?? 'MINGGU_INI') : 'MINGGU_INI';
                    $p_mapel = isset($filters['mapel']) && $filters['mapel'] != 'all' ? $filters['mapel'] : '';
                    
                    // We need to resolve mapel name to ID if needed, or pass string if SP accepts string.
                    // SP_LihatJadwalTersediaMurid accepts p_id_mapel. Frontend passes 'python' (string key).
                    // In real app, we should pass ID. For now assuming name matching or empty logic.
                    // Let's assume frontend sends something that SP can handle OR we ignore mapel filter at DB level 
                    // and rely on frontend JS filtering (which is what the JS code did).
                    // So we pass '' for mapel ID to get all and let JS filter.
                    
                    $result = $this->db->readingQuery("CALL SP_LihatJadwalTersediaMurid('$p_periode', '')");

                    foreach($result as $row) {
                        $waktu = substr($row['jam_mulai'], 0, 5) . ' - ' . substr($row['jam_akhir'], 0, 5);
                        $formattedDate = date('d M Y', strtotime($row['tanggal']));
                        $mapelKey = strtolower($row['nama_mapel']); // For frontend filtering
                        
                        echo "<tr data-mapel='" . $mapelKey . "' class='hover:bg-gray-50 transition-colors'>" . 
                            "<td><span class='font-medium text-gray-800 whitespace-nowrap'>" . $formattedDate . "</span></td>" .
                            "<td><div><p class='font-medium text-gray-800'>" . $row['hari'] . "</p><p class='text-sm text-gray-600'>". $waktu ."</p></div></td>" .
                            "<td><span class='font-medium text-gray-800 whitespace-nowrap'>" . htmlspecialchars($row['nama_pengajar'] ?? '') . "</span></td>" .
                            "<td><span class='font-medium text-gray-800 whitespace-nowrap'>" . htmlspecialchars($row['nama_mapel'] ?? '') . "</span></td>" .
                            "<td style='text-align:center;'><button type='button' onclick='openPilihModal(\"".$row['kode_jadwal']."\", \"$formattedDate\", \"$waktu\", \"".addslashes($row['nama_pengajar'])."\", \"".addslashes($row['nama_mapel'])."\")' class='inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-orange-500 hover:bg-orange-600 text-white transition-colors'>Pilih</button></td>" .
                            "</tr>";
                    }
                }
                else if($type == "jadwaldipilih") {
                    $result = $this->db->readingQuery("CALL SP_LihatJadwalSayaMurid('" . $_SESSION['loginID'] . "', 'SEMUA')");

                    foreach($result as $row) {
                        $waktu = substr($row['jam_mulai'], 0, 5) . ' - ' . substr($row['jam_akhir'], 0, 5);
                        $formattedDate = date('d M Y', strtotime($row['tanggal']));
                        
                        echo "<tr class='hover:bg-gray-50 transition-colors'>" . 
                            "<td><span class='font-medium text-gray-800 whitespace-nowrap'>" . $formattedDate . "</span></td>" .
                            "<td><div><p class='font-medium text-gray-800'>" . $row['hari'] . "</p><p class='text-sm text-gray-600'>". $waktu ."</p></div></td>" .
                            "<td><span class='font-medium text-gray-800 whitespace-nowrap'>" . htmlspecialchars($row['nama_pengajar'] ?? '') . "</span></td>" .
                            "<td><span class='font-medium text-gray-800 whitespace-nowrap'>" . htmlspecialchars($row['nama_mapel'] ?? '') . "</span></td>" .
                             "<td style='text-align:center;'><button type='button' onclick='openBatalModal(\"".$row['kode_jadwal']."\", \"$formattedDate\", \"$waktu\", \"".addslashes($row['nama_mapel'])."\")' class='inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-red-600 text-white hover:bg-red-700 transition-colors'>Batalkan</button></td>" .
                            "</tr>";
                    }
                }
            }
            else if($roles == "pengajar") {
                if($type == "dashboard") {
                    $result = $this->db->readingQuery("SELECT * FROM view_dashboardpengajar_jadwalmendatang WHERE id_pengajar = '".$_SESSION["loginID"]."'");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['tanggal'] . "</td>" .
                            "<td>" . $row['hari'] . "<br>". $row['waktu'] ."</td>" .
                            "<td>" . $row['nama_mapel'] . "</td>" .
                            "<td>" . $row['nama_murid'] . "</td>";
                    }
                }
                else if($type == "jadwal") {
                    // Map UI filters to SP parameters
                    $periodeMap = [
                        'today' => 'HARI_INI',
                        'week' => 'MINGGU_INI',
                        'month' => 'BULAN_INI',
                        'all' => 'SEMUA'
                    ];
                    $statusMap = [
                        'selesai' => 'SELESAI',
                        'mendatang' => 'MENDATANG',
                        'all' => 'SEMUA'
                    ];
                    $sortMap = [
                        'terbaru' => 'TERBARU',
                        'terlama' => 'TERLAMA'
                    ];

                    $p_periode = isset($filters['periode']) ? ($periodeMap[$filters['periode']] ?? 'SEMUA') : 'SEMUA';
                    $p_status = isset($filters['status']) ? ($statusMap[$filters['status']] ?? 'SEMUA') : 'SEMUA';
                    $p_urut = isset($filters['sort']) ? ($sortMap[$filters['sort']] ?? 'TERBARU') : 'TERBARU';
                    
                    // SP_JadwalMengajarPengajar(p_id_pengajar, p_periode, p_status, p_urut)
                    $result = $this->db->readingQuery("CALL SP_JadwalMengajarPengajar('".$_SESSION["loginID"]."', '$p_periode', '$p_status', '$p_urut')");
                    
                    foreach($result as $row) {
                        $waktu = substr($row['jam_mulai'], 0, 5) . ' - ' . substr($row['jam_akhir'], 0, 5);
                        $statusUI = strtoupper($row['status_jadwal_ui']);
                        $badgeClass = ($statusUI == 'SELESAI') ? 'badge-selesai' : 'badge-mendatang';
                        
                        echo "<tr>" . 
                            "<td>" . htmlspecialchars($row['tanggal'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['hari'] ?? '') . "<br>" . $waktu . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_mapel'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_murid'] ?? '') . "</td>" .
                            "<td style='text-align:center;'><span class='badge " . $badgeClass . "'>" . $statusUI . "</span></td>" .
                            "</tr>";
                    }
                }
                else if($type == "absensi") {
                    // SP_LihatAbsensi_Pengajar(p_id_pengajar, p_periode, p_status, p_urut)
                    // Using 'SEMUA' for periode and status, 'TERBARU' for sort order
                    $result = $this->db->readingQuery("CALL SP_LihatAbsensi_Pengajar('".$_SESSION["loginID"]."', 'SEMUA', 'SEMUA', 'TERBARU')");
                    
                    foreach($result as $row) {
                        $waktu = substr($row['jam_mulai'], 0, 5) . ' - ' . substr($row['jam_akhir'], 0, 5);
                        $dataStatus = ($row['status_kehadiran'] == null) ? 'belum' : 'sudah';
                        
                        // Only show InputAbsensi button if status_kehadiran is NULL (belum diisi)
                        if($row['status_kehadiran'] == null) {
                            $aksiBtn = "<button class='btn-input' onclick='openAbsensiModal(\"" . $row['kode_jadwal'] . "\", \"" . $row['tanggal'] . "\", \"" . $waktu . "\", \"" . addslashes($row['nama_murid'] ?? '') . "\", \"" . addslashes($row['nama_mapel'] ?? '') . "\")'>Input Absensi</button>";
                        } else {
                            // Show badge "Sudah Absen" like reference
                            $aksiBtn = "<span class='badge badge-sudah'>Sudah Absen</span>";
                        }
                        
                        echo "<tr data-status='" . $dataStatus . "' data-tanggal='" . htmlspecialchars($row['tanggal'] ?? '') . "'>" . 
                            "<td>" . htmlspecialchars($row['tanggal'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['hari'] ?? '') . "<br>" . $waktu . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_mapel'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_murid'] ?? '') . "</td>" .
                            "<td style='text-align:center;'>" . $aksiBtn . "</td>" .
                            "</tr>";
                    }
                }
                else if($type == "kehadiran") {
                    // SP_RiwayatKehadiranPengajar(p_id_pengajar, p_periode, p_status, p_urut)
                    // Using 'SEMUA' for periode and status, 'TERBARU' for sort order
                    $result = $this->db->readingQuery("CALL SP_RiwayatKehadiranPengajar('".$_SESSION["loginID"]."', 'SEMUA', 'SEMUA', 'TERBARU')");
                    
                    foreach($result as $row) {
                        $waktu = substr($row['jam_mulai'], 0, 5) . ' - ' . substr($row['jam_akhir'], 0, 5);
                        $tanggalWaktu = $row['tanggal'] . "<br>" . $row['hari'] . " " . $waktu;
                        
                        $statusUI = $row['status_kehadiran_ui'];
                        if($statusUI == 'HADIR') {
                            $badgeClass = 'badge-hadir';
                            $statusText = 'Hadir';
                            $dataStatus = 'hadir';
                        } else {
                            $badgeClass = 'badge-tidak-hadir';
                            $statusText = 'Tidak Hadir';
                            $dataStatus = 'tidak-hadir';
                        }
                        
                        $materi = !empty($row['deskripsiMateri']) ? $row['deskripsiMateri'] : '-';
                        
                        echo "<tr data-status='" . $dataStatus . "' data-tanggal='" . htmlspecialchars($row['tanggal'] ?? '') . "'>" . 
                            "<td>" . $tanggalWaktu . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_murid'] ?? '') . "</td>" .
                            "<td>" . htmlspecialchars($row['nama_mapel'] ?? '') . "</td>" .
                            "<td>" . $materi . "</td>" .
                            "<td style='text-align:center;'><span class='badge " . $badgeClass . "'>" . $statusText . "</span></td>" .
                            "</tr>";
                    }
                }
            }
        }

        // =============================================
        // BELI PAKET & PEMBAYARAN METHODS
        // =============================================

        /**
         * Beli paket untuk murid
         * @param string $id_murid ID murid yang membeli
         * @param string $id_paket ID paket yang dibeli
         * @return string|bool Success message or false on failure
         */
        public function beliPaket($id_murid, $id_paket) {
            $safe_id_murid = str_replace("'", "", $id_murid);
            $safe_id_paket = str_replace("'", "", $id_paket);
            
            return $this->db->nonReadingQuery("CALL SP_BeliPaket('$safe_id_murid', '$safe_id_paket')");
        }

        /**
         * Upload bukti pembayaran
         * @param string $id_pembelian ID pembelian
         * @param string $id_murid ID murid yang upload
         * @param string $filename Nama file bukti pembayaran
         * @return string|bool Success message or error
         */
        public function uploadBuktiPembayaran($id_pembelian, $id_murid, $filename) {
            $safe_id_pembelian = str_replace("'", "", $id_pembelian);
            $safe_id_murid = str_replace("'", "", $id_murid);
            $safe_filename = str_replace("'", "", $filename);
            
            return $this->db->nonReadingQuery("CALL SP_UploadBuktiPembayaran('$safe_id_pembelian', '$safe_id_murid', '$safe_filename')");
        }

        /**
         * Tandai pembayaran sebagai lunas (admin only)
         * @param string $id_pembelian ID pembelian yang ditandai lunas
         * @return string|bool Success message or error
         */
        public function tandaiLunas($id_pembelian) {
            $safe_id_pembelian = str_replace("'", "", $id_pembelian);
            
            return $this->db->nonReadingQuery("CALL SP_TandaiLunas('$safe_id_pembelian')");
        }

        // =============================================
        // DETAIL PEMBELIAN METHODS
        // =============================================

        /**
         * Get detail pembelian paket (total pertemuan, terpakai, sisa)
         * @param string $id_pembelian ID pembelian
         * @return array|null Detail pembelian or null
         */
        public function getDetailPembelianPaket($id_pembelian) {
            $safe_id = str_replace("'", "", $id_pembelian);
            $result = $this->db->readingQuery("CALL SP_DetailPembelianPaket('$safe_id')");
            return $result[0] ?? null;
        }

        /**
         * Get list pertemuan terpakai for a pembelian
         * @param string $id_pembelian ID pembelian
         * @return array List of pertemuan terpakai
         */
        public function getListPertemuanTerpakai($id_pembelian) {
            $safe_id = str_replace("'", "", $id_pembelian);
            return $this->db->readingQuery("CALL SP_ListPertemuanTerpakai('$safe_id')");
        }

        // =============================================
        // ABSENSI PENGAJAR METHODS
        // =============================================

        /**
         * Input absensi kehadiran oleh pengajar
         * @param string $kode_jadwal Kode jadwal
         * @param string $id_pengajar ID pengajar yang input
         * @param int $status_kehadiran 1 = Hadir, 0 = Tidak Hadir
         * @param string $deskripsi_materi Materi yang diajarkan
         * @return string|bool Success message or error
         */
        public function inputAbsensi($kode_jadwal, $id_pengajar, $status_kehadiran, $deskripsi_materi) {
            $safe_kode_jadwal = str_replace("'", "", $kode_jadwal);
            $safe_id_pengajar = str_replace("'", "", $id_pengajar);
            $safe_status = intval($status_kehadiran);
            $safe_materi = str_replace("'", "", $deskripsi_materi);
            
            return $this->db->nonReadingQuery("CALL SP_InputAbsensi_Pengajar('$safe_kode_jadwal', '$safe_id_pengajar', $safe_status, '$safe_materi')");
        }

        // =============================================
        // KELOLA JADWAL (ADMIN) METHODS
        // =============================================

        public function tambahJadwalAdmin($mapel, $pengajar, $tanggal, $p_jam_mulai, $p_jam_akhir) {
            $safe_mapel = str_replace("'", "", $mapel);
            $safe_pengajar = str_replace("'", "", $pengajar);
            $safe_tanggal = str_replace("'", "", $tanggal);
            $safe_jam_mulai = str_replace("'", "", $p_jam_mulai);
            $safe_jam_akhir = str_replace("'", "", $p_jam_akhir);

            return $this->db->nonReadingQuery("CALL SP_TambahJadwal_Admin('$safe_mapel', '$safe_pengajar', '$safe_tanggal', '$safe_jam_mulai', '$safe_jam_akhir')");
        }

        public function editJadwalAdmin($kode, $tanggal, $p_jam_mulai, $p_jam_akhir) {
            $safe_kode = str_replace("'", "", $kode);
            $safe_tanggal = str_replace("'", "", $tanggal);
            $safe_jam_mulai = str_replace("'", "", $p_jam_mulai);
            $safe_jam_akhir = str_replace("'", "", $p_jam_akhir);

            return $this->db->nonReadingQuery("CALL SP_EditJadwal_Admin('$safe_kode', '$safe_tanggal', '$safe_jam_mulai', '$safe_jam_akhir')");
        }

        public function hapusJadwalAdmin($kode) {
            $safe_kode = str_replace("'", "", $kode);
            
            return $this->db->nonReadingQuery("CALL SP_HapusJadwal_Admin('$safe_kode')");
        }

        // =============================================
        // PILIH JADWAL (MURID) METHODS
        // =============================================

        public function pilihJadwal($kode_jadwal, $id_murid, $id_pembelian) {
            $safe_kode = str_replace("'", "", $kode_jadwal);
            $safe_murid = str_replace("'", "", $id_murid);
            $safe_pembelian = str_replace("'", "", $id_pembelian);

            return $this->db->nonReadingQuery("CALL SP_PilihJadwal('$safe_kode', '$safe_murid', '$safe_pembelian')");
        }

        public function batalJadwal($kode_jadwal, $id_murid) {
            $safe_kode = str_replace("'", "", $kode_jadwal);
            $safe_murid = str_replace("'", "", $id_murid);
            
            return $this->db->nonReadingQuery("CALL SP_BatalPilihJadwal('$safe_kode', '$safe_murid')");
        }
    }
?>