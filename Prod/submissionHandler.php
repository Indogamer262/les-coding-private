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
            $role = $_POST["role"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $lesCodingUtil->editAccount($id, $nama, $email, $password);

            // fallback to previous page
            header("Location: accounts.php?addAccount=success");
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
        else {
            header("Location: dashboard.php");
        }
    }
?>