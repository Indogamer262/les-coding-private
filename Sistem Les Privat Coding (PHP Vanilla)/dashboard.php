<?php
    session_start();

    include_once("util/dbLesCoding.php");
    $lesCodingUtil = new DBLesCoding();

    if (empty($_SESSION["loginStat"])) {
        $loginStat = 0;

        // however, check for new login
        

        // get data from client
        $roles = $_POST['roles'] ?? null;
        $username = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        // get roles number
        if($roles == "murid") {
            $roleNumber = 1;
            $_SESSION["loginRoles"] = "murid";
        }
        else if($roles == "pengajar") {
            $roleNumber = 2;
            $_SESSION["loginRoles"] = "pengajar";
        }
        else if($roles == "admin") {
            $roleNumber = 3;
            $_SESSION["loginRoles"] = "admin";
        }

        // check to database if not empty
        if(!empty($roles) && !empty($username) && !empty($password)) {
            if($lesCodingUtil->verifyLogin($roles, $username, $password)) {
                $loginStat = $roleNumber;
                $_SESSION["loginStat"] = $roleNumber;
                
                // get username and put it in session
                $_SESSION["loginUSN"] = $lesCodingUtil->getAccountUsername($roles, $username);
            }
            else {
                $loginStat = -1;
                header("Location: index.php?wrongLogin=$roleNumber");
            }
        }
    }
    else {
        $loginStat = $_SESSION["loginStat"];
    }

    // don't come here if haven't logged in
    if($loginStat == 0) {
        header("Location: .");
    }

    // import pages based on roles
    
?>

<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Library Import -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&display=swap" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css" rel="stylesheet">

        <style>
            body, html {box-sizing: border-box; margin: 0; height: 100%;}
            .poppins-light {font-family: "Poppins", sans-serif;font-weight: 300;font-style: normal;}
            .poppins-regular {font-family: "Poppins", sans-serif;font-weight: 400;font-style: normal;}
            .poppins-semibold {font-family: "Poppins", sans-serif;font-weight: 600;font-style: normal;}
            .poppins-bold {font-family: "Poppins", sans-serif;font-weight: 700;font-style: normal;}
            .poppins-light-italic {font-family: "Poppins", sans-serif;font-weight: 300;font-style: italic;}
            .poppins-regular-italic {font-family: "Poppins", sans-serif;font-weight: 400;font-style: italic;}

            body {
                display: grid;
                grid-template-areas:
                    "sidebar header"
                    "sidebar content";
                grid-template-columns: auto 1fr;
                grid-template-rows: auto 1fr;
                background-color: #ededed;
            }
            .sidebar {
                grid-area: sidebar;
                height: 100%;
                box-sizing: border-box;
                background-color: #004fa8ff;
            }
            .sidebar-content {
                width: 300px;
                padding: 25px;
                box-sizing: border-box;
            }
            .sidebar-content>a {
                display: block;
                border-radius: 8px;
                padding: 12px;
                text-align: left;
                color: white;
                text-decoration: none;
                font-size: 14px;
                margin-bottom: 4px;
            }
            .sidebar-content>a:hover {
                background-color: #0070f0ff;
            }
            .sidebar-content>.active {
                background-color: #006be6ff;
                color: white;
            }
            .main {
                grid-area: content;
                padding: 20px;
            }
            .summaryBoard {
                display:grid;
                grid-template-columns: 1fr 1fr 1fr 1fr;
            }
            .summaryBoard > div {
                background-color: white;
                box-shadow: 0 0 10px 0 lightgray;
                border-radius: 8px;
                padding: 12px;
                margin: 10px;
            }
            .jadwalTerisiDashboard {
                background-color: white;
                box-shadow: 0 0 10px 0 lightgray;
                border-radius: 8px;
                padding: 12px;
                margin: 10px;
            }

            @media only screen and (max-width: 900px) {
                .summaryBoard {
                    display:grid;
                    grid-template-columns: 1fr 1fr;
                }
            }
            
        </style>
    </head>
    <body>
        <!-- Header bar layout -->
        <?php include('occurence/navbar.php'); ?>

        <!-- Sidebar Layout -->
        <div class="sidebar poppins-regular">
            <div>
                <p style="font-size: 18px; color: white; text-align: center; margin-top: 25px; padding-bottom: 25px; border-bottom: 1px solid black; margin-bottom: 0; box-sizing: border-box;" class="poppins-bold"><b>Les Privat Coding</b></p>
            </div>
            <div class="sidebar-content">
                <a href="" class="active">Dashboard</a>
                <a href="">Kelola Akun</a>
                <a href="">Kelola Paket Les</a>
                <a href="">Kelola Mata Pelajaran</a>
                <a href="">Verifikasi Pembayaran</a>
                <a href="">Riwayat Pembelian</a>
                <a href="">Kelola Jadwal</a>
                <a href="">Absensi</a>
                <a href="">Riwayat Kehadiran</a>
                <a href="">Log Aktivitas</a>
            </div>
        </div>
        
        <!-- Main content layout -->
        <div class="main poppins-regular">
            <h2 style="margin-bottom:0;">Dashboard Admin</h2>
            Selamat datang di Sistem Les Privat Coding
            <!-- summary board -->
            <div class="summaryBoard">
                <div>
                    <p>
                        Total Murid<br>
                        <span style="font-size:40px;"><?php echo $lesCodingUtil->getValueStatistic("jumlahMurid"); ?></span><br>
                        Aktif belajar
                    </p>
                </div>

                <div>
                    <p>
                        Total Pengajar<br>
                        <span style="font-size:40px;"><?php echo $lesCodingUtil->getValueStatistic("jumlahPengajar"); ?></span><br>
                        Aktif mengajar
                    </p>
                </div>

                <div>
                    <p>
                        Pendapatan Bulan ini<br>
                        <span style="font-size:40px;"><?php echo $lesCodingUtil->getValueStatistic("totalPendapatanBulan"); ?></span><br>
                        Aktif belajar
                    </p>
                </div>

                <div>
                    <p>
                        Pembelian Paket<br>
                        <span style="font-size:40px;"><?php echo $lesCodingUtil->getValueStatistic("pembelianPaketBelumLunas"); ?></span><br>
                        Perlu verifikasi
                    </p>
                </div>    
            </div>

            <div class="jadwalTerisiDashboard">
                <span style="font-size:20px;"><b>Jadwal Terisi</b></span> <a href="">Lihat Semua</a>
                <hr>
                <table id="dashboardTb" class="display">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hari & Waktu</th>
                            <th>Pengajar</th>
                            <th>Mata Pelajaran</th>
                            <th>Murid</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $lesCodingUtil->renderTableBody("admin","dashboard"); ?>
                    </tbody>
                </table>
            </div>

        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        new DataTable('#dashboardTb', {
            columnDefs: [
                {
                    targets: [0],
                    orderData: [0, 1]
                },
                {
                    targets: [1],
                    orderData: [1, 0]
                },
                {
                    targets: [4],
                    orderData: [4, 0]
                }
            ]
        });
    </script>
</html>