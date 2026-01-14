<?php
    session_start();

    if (empty($_SESSION["loginStat"])) {
        $loginStat = 0;

        // however, check for new login
        include_once("util/dbLesCoding.php");
        $lesCodingUtil = new DBLesCoding();

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
                width: 300px;
                padding: 25px;
                background-color: #004fa8ff;
                height: 100%;
                box-sizing: border-box;
                grid-area: sidebar;
            }
            .sidebar>a {
                display: block;
                border-radius: 8px;
                padding: 12px;
                text-align: left;
                color: white;
                text-decoration: none;
                font-size: 14px;
                margin-bottom: 4px;
            }
            .sidebar>a:hover {
                background-color: #0070f0ff;
            }
            .sidebar>.active {
                background-color: #006be6ff;
                color: white;
            }
            .main {
                grid-area: content;
                
            }
            .navbar {
                grid-area: header;
                background-color: white;
                box-shadow: 0 0 4px 0 lightgray;
                padding: 12px;
                text-align: right;
            }
        </style>
    </head>
    <body>
        <!-- Header bar layout -->
        <?php include('occurence/navbar.php'); ?>

        <!-- Sidebar Layout -->
        <div class="sidebar poppins-regular">
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
        
        <!-- Main content layout -->
        <div class="main poppins-regular">
            <p>Lorem ipsum</p>
        </div>
    </body>
</html>