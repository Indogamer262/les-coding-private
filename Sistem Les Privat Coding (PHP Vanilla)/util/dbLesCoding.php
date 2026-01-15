<?php
    include_once("util/dbUtil.php");

    class DBLesCoding {
        private DBUtil $db;
        private $servername;//= "localhost";
        private $username; //= "root";
        private $password; //= "root";
        private $dbname; //= "les_coding";

        public function __construct() {
            $this->servername = "127.0.0.1";
            $this->username = "root";
            $this->password = "root";
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

        public function getValueStatistic($type) {
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
            else {
                return null;
            }
        }

        public function renderTableBody($roles, $type) {
            if($roles == "admin") {
                if($type == "dashboard") {
                    $result = $this->db->readingQuery("SELECT * FROM view_DashboardAdmin_JadwalTerisi");
                    
                    foreach($result as $row) {
                        echo "<tr>" . 
                            "<td>" . $row['tanggal'] . "</td>" .
                            "<td>" . $row['hari'] . "<br>". $row['waktu'] ."</td>" .
                            "<td>" . $row['nama_pengajar'] . "</td>" .
                            "<td>" . $row['nama_pengajar'] . "</td>" .
                            "<td>" . $row['nama_murid'] . "</td>";
                    }
                }
            }
        }
    }
?>