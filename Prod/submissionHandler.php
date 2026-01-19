<?php 
    session_start();

    include_once("util/dbLesCoding.php");
    $lesCodingUtil = new DBLesCoding();

    if (empty($_SESSION["loginStat"])) {
        $loginStat = 0;
    }
    else {
        $loginStat = $_SESSION["loginStat"];
    }

    // don't come here if haven't logged in
    if($loginStat == 0) {
        header("Location: .");
    }
    else {
        $handlerType = $_POST["handlerType"] ?? null;
        if($handlerType == "tambahAkun") {
            // get all the data this handler needs
            $nama = $_POST["nama"];
            $role = $_POST["role"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $lesCodingUtil->insertAccount($role, $nama, $email, $password);

            // fallback to previous page
            header("Location: accounts.php?addAccount=success");
        }
        else if($handlerType == "editAkun") {
            // get all the data this handler needs
            $nama = $_POST["nama"];
            $role = $_POST["editRoles"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $id = $_POST["editId"];

            $lesCodingUtil->editAccount($id, $role, $nama, $email);

            // only update password if password field was filled
            if(!empty($password)) {
                $lesCodingUtil->editAccountPassword($id, $role, $password);
            }

            // fallback to previous page
            header("Location: accounts.php?addAccount=edit");
        }
        else if($handlerType == "alihStatusAkun") {
            // get all the data this handler needs
            $role = $_POST["role"];
            $id = $_POST["editId"];
            $targetStatus = $_POST["targetStatus"];

            $lesCodingUtil->editAccountStatus($id, $role, $targetStatus);

            // fallback to previous page
            header("Location: accounts.php?addAccount=status");
        }
        // =============================================
        // BELI PAKET HANDLER
        // =============================================
        else if($handlerType == "beliPaket") {
            $id_murid = $_SESSION["loginID"];
            $id_paket = $_POST["id_paket"] ?? null;

            if($id_paket) {
                $result = $lesCodingUtil->beliPaket($id_murid, $id_paket);
                if($result == "success") {
                    header("Location: beliPaket.php?beli=success");
                } else {
                    header("Location: beliPaket.php?beli=error&msg=" . urlencode($result));
                }
            } else {
                header("Location: beliPaket.php?beli=error&msg=ID+paket+tidak+valid");
            }
        }
        // =============================================
        // UPLOAD BUKTI PEMBAYARAN HANDLER
        // =============================================
        else if($handlerType == "uploadBukti") {
            $id_murid = $_SESSION["loginID"];
            $id_pembelian = $_POST["id_pembelian"] ?? null;

            if($id_pembelian && isset($_FILES["bukti"]) && $_FILES["bukti"]["error"] == 0) {
                // Upload directory
                $uploadDir = "uploads/bukti/";
                
                // Create directory if not exists
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // File validation
                $allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
                $maxSize = 2 * 1024 * 1024; // 2MB
                
                $fileType = $_FILES["bukti"]["type"];
                $fileSize = $_FILES["bukti"]["size"];
                $fileName = $_FILES["bukti"]["name"];
                $fileTmp = $_FILES["bukti"]["tmp_name"];
                
                // Validate file type
                if(!in_array($fileType, $allowedTypes)) {
                    header("Location: beliPaket.php?upload=error&msg=Format+file+tidak+valid.+Hanya+JPG,+PNG,+GIF+yang+diperbolehkan");
                    exit;
                }
                
                // Validate file size
                if($fileSize > $maxSize) {
                    header("Location: beliPaket.php?upload=error&msg=Ukuran+file+terlalu+besar.+Maksimal+2MB");
                    exit;
                }

                // Generate unique filename
                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $newFileName = $id_pembelian . "_" . date("Ymd") . "." . $fileExt;
                $targetFile = $uploadDir . $newFileName;

                // Move uploaded file
                if(move_uploaded_file($fileTmp, $targetFile)) {
                    // Save to database
                    $result = $lesCodingUtil->uploadBuktiPembayaran($id_pembelian, $id_murid, $targetFile);
                    if($result == "success") {
                        header("Location: beliPaket.php?upload=success");
                    } else {
                        // Remove uploaded file if database update failed
                        unlink($targetFile);
                        header("Location: beliPaket.php?upload=error&msg=" . urlencode($result));
                    }
                } else {
                    header("Location: beliPaket.php?upload=error&msg=Gagal+mengupload+file");
                }
            } else {
                header("Location: beliPaket.php?upload=error&msg=Data+tidak+lengkap+atau+file+tidak+valid");
            }
        }
        // =============================================
        // TANDAI LUNAS HANDLER (Admin only)
        // =============================================
        else if($handlerType == "tandaiLunas") {
            // Check if user is admin
            if($_SESSION["loginRoles"] == "admin") {
                $id_pembelian = $_POST["id_pembelian"] ?? null;
                
                if($id_pembelian) {
                    $result = $lesCodingUtil->tandaiLunas($id_pembelian);
                    if($result == "success") {
                        header("Location: verifikasiPembayaran.php?lunas=success");
                    } else {
                        header("Location: verifikasiPembayaran.php?lunas=error&msg=" . urlencode($result));
                    }
                } else {
                    header("Location: verifikasiPembayaran.php?lunas=error&msg=ID+pembelian+tidak+valid");
                }
            } else {
                header("Location: dashboard.php");
            }
        }
        // =============================================
        // JADWAL HANDLERS (Admin)
        // =============================================
        else if($handlerType == "tambahJadwal") {
            if($_SESSION["loginRoles"] == "admin") {
                $pengajar = $_POST['pengajar'];
                $mapel = $_POST['mapel'];
                $tanggal = $_POST['tanggal'];
                $jamMulai = $_POST['jamMulai'];
                $jamSelesai = $_POST['jamSelesai'];

                $result = $lesCodingUtil->tambahJadwalAdmin($mapel, $pengajar, $tanggal, $jamMulai, $jamSelesai);
                
                if($result == "success") {
                    header("Location: jadwalLes.php?msg=success");
                } else {
                    header("Location: jadwalLes.php?msg=" . urlencode($result));
                }
            }
        }
        else if($handlerType == "editJadwal") {
            if($_SESSION["loginRoles"] == "admin") {
                $kode = $_POST['kodeJadwal'];
                $tanggal = $_POST['tanggal'];
                $jamMulai = $_POST['jamMulai'];
                $jamSelesai = $_POST['jamSelesai'];

                $result = $lesCodingUtil->editJadwalAdmin($kode, $tanggal, $jamMulai, $jamSelesai);
                
                if($result == "success") {
                    header("Location: jadwalLes.php?msg=edit");
                } else {
                    header("Location: jadwalLes.php?msg=" . urlencode($result));
                }
            }
        }
        else if($handlerType == "hapusJadwal") {
            if($_SESSION["loginRoles"] == "admin") {
                $kode = $_POST['kodeJadwal'];

                $result = $lesCodingUtil->hapusJadwalAdmin($kode);
                
                if($result == "success") {
                    header("Location: jadwalLes.php?msg=delete");
                } else {
                    header("Location: jadwalLes.php?msg=" . urlencode($result));
                }
            }
        }
        else if($handlerType == "pilihJadwal") {
            if($_SESSION["loginRoles"] == "murid") {
                $id_murid = $_SESSION["loginID"];
                $kode_jadwal = $_POST['kodeJadwal'];
                $id_pembelian = $lesCodingUtil->db->readSingleValue("SELECT pd.id_pembelian FROM paketdibeli pd JOIN katalogpaket k ON pd.id_paket = k.id_paket WHERE pd.id_murid = '$id_murid' AND pd.tgl_kedaluwarsa >= CURDATE() AND (k.jml_pertemuan - pd.pertemuan_terpakai) > 0 ORDER BY pd.tgl_kedaluwarsa ASC LIMIT 1");

                if($id_pembelian) {
                     $result = $lesCodingUtil->pilihJadwal($kode_jadwal, $id_murid, $id_pembelian);
                     if($result == "success") {
                        header("Location: pilihJadwal.php?msg=success");
                     } else {
                        header("Location: pilihJadwal.php?msg=" . urlencode($result));
                     }
                } else {
                     header("Location: pilihJadwal.php?msg=" . urlencode("Tidak ada paket aktif yang valid"));
                }
            }
        }
        else if($handlerType == "batalJadwal") {
            if($_SESSION["loginRoles"] == "murid") {
                $id_murid = $_SESSION["loginID"];
                $kode_jadwal = $_POST['kodeJadwal'];
                
                $result = $lesCodingUtil->batalJadwal($kode_jadwal, $id_murid);
                
                if($result == "success") {
                    header("Location: pilihJadwal.php?msg=canceled");
                } else {
                    header("Location: pilihJadwal.php?msg=" . urlencode($result));
                }
            }
        }
        else if($handlerType == "tambahPaketLes") {
            if($_SESSION["loginRoles"] == "admin") {
                $nama = $_POST["nama"] ?? "";
                $jumlah = $_POST["jumlah"] ?? 0;
                $masa = $_POST["masa"] ?? 0;
                $harga = $_POST["harga"] ?? 0;
                $status = $_POST["status"] == "aktif" ? 1 : 0;
                
                $result = $lesCodingUtil->tambahPaketLes($nama, $jumlah, $masa, $harga, $status);
                
                if($result == "success") {
                    header("Location: paketLes.php?msg=success");
                } else {
                    header("Location: paketLes.php?msg=" . urlencode($result));
                }
            } else {
                header("Location: dashboard.php");
            }
        }
        else if($handlerType == "editPaketLes") {
            if($_SESSION["loginRoles"] == "admin") {
                $id = $_POST["id_paket"] ?? "";
                $nama = $_POST["nama"] ?? "";
                $jumlah = $_POST["jumlah"] ?? 0;
                $masa = $_POST["masa"] ?? 0;
                $harga = $_POST["harga"] ?? 0;
                $status = $_POST["status"] == "aktif" ? 1 : 0;
                
                $result = $lesCodingUtil->editPaketLes($id, $nama, $jumlah, $masa, $harga, $status);
                
                if($result == "success") {
                    header("Location: paketLes.php?msg=edit");
                } else {
                    header("Location: paketLes.php?msg=" . urlencode($result));
                }
            } else {
                header("Location: dashboard.php");
            }
        }
        else if($handlerType == "ubahStatusPaketLes") {
            if($_SESSION["loginRoles"] == "admin") {
                $id = $_POST["id_paket"] ?? "";
                $status = intval($_POST["status"] ?? 0);
                
                $result = $lesCodingUtil->ubahStatusPaketLes($id, $status);
                
                if($result == "success") {
                    header("Location: paketLes.php?msg=status");
                } else {
                    header("Location: paketLes.php?msg=" . urlencode($result));
                }
            } else {
                header("Location: dashboard.php");
            }
        }
        else if($handlerType == "tambahMapel") {
            if($_SESSION["loginRoles"] == "admin") {
                $nama = $_POST["subjectName"] ?? "";
                $desc = $_POST["description"] ?? "";
                $status = ($_POST["status"] == "active") ? 1 : 0;
                $pengajarIds = $_POST["pengajar_ids"] ?? [];
                
                if (!is_array($pengajarIds)) $pengajarIds = [];

                $result = $lesCodingUtil->tambahMapel($nama, $desc, $status, $pengajarIds);
                
                if($result == "success") {
                    header("Location: mataPelajaran.php?msg=success");
                } else {
                    header("Location: mataPelajaran.php?msg=" . urlencode($result));
                }
            } else {
                header("Location: dashboard.php");
            }
        }
        else if($handlerType == "editMapel") {
            if($_SESSION["loginRoles"] == "admin") {
                $id = $_POST["id_mapel"] ?? "";
                $nama = $_POST["subjectName"] ?? "";
                $desc = $_POST["description"] ?? "";
                $status = ($_POST["status"] == "active") ? 1 : 0;
                $pengajarIds = $_POST["pengajar_ids"] ?? [];
                 
                if (!is_array($pengajarIds)) $pengajarIds = [];

                $result = $lesCodingUtil->editMapel($id, $nama, $desc, $status, $pengajarIds);
                
                if($result == "success") {
                    header("Location: mataPelajaran.php?msg=edit");
                } else {
                    header("Location: mataPelajaran.php?msg=" . urlencode($result));
                }
            } else {
                header("Location: dashboard.php");
            }
        }
        else if($handlerType == "toggleStatusMapel") {
            if($_SESSION["loginRoles"] == "admin") {
                $id = $_POST["id_mapel"] ?? "";
                $status = intval($_POST["status"] ?? 0);
                
                $result = $lesCodingUtil->toggleStatusMapel($id, $status);
                
                if($result == "success") {
                    header("Location: mataPelajaran.php?msg=status");
                } else {
                    header("Location: mataPelajaran.php?msg=" . urlencode($result));
                }
            } else {
                header("Location: dashboard.php");
            }
        }
        else {
            header("Location: dashboard.php");
        }
    }
?>