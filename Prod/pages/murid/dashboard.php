<!-- Frontend by 2472042, member of "Les Coding Private" Team -->
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
                height: 100vh;
                box-sizing: border-box;
                background-color: #004fa8ff;
                overflow-y: auto;
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
                overflow-y: auto;
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
            .jadwalDashboard {
                background-color: white;
                box-shadow: 0 0 10px 0 lightgray;
                border-radius: 8px;
                padding: 24px;
                margin: 10px;
            }

            @media only screen and (max-width: 900px) {
                .summaryBoard {
                    display:grid;
                    grid-template-columns: 1fr 1fr;
                }
            }
            @media only screen and (max-width: 800px) {
                body {
                    display: block;
                }

                .sidebar {
                    height: auto;
                    box-sizing: border-box;
                    background-color: #004fa8ff;
                    overflow: unset;
                    position: absolute;
                    z-index: 3;
                    display: none;
                }

                .main {
                    grid-area: content;
                    padding: 20px;
                    overflow: visible;
                }

                .summaryBoard {
                    display:grid;
                    grid-template-columns: 1fr;
                }
            }
            
        </style>
    </head>
    <body>
        <!-- Header bar layout -->
        <?php include('occurence/navbar.php'); ?>

        <!-- Sidebar Layout -->
        <?php include('pages/murid/sidebar.php'); ?>
        
        <!-- Main content layout -->
        <div class="main poppins-regular">
        
            <h2 style="margin-bottom:0;">Dashboard Murid</h2>
            Selamat datang di Sistem Les Privat Coding
            
            <!-- summary board -->
            <div class="summaryBoard">
                <div>
                    <p>
                        Paket Les Aktif<br>
                        <span style="font-size:40px;"><?php echo $lesCodingUtil->getValueStatistic("paketLesAktifMurid"); ?></span><br> <!-- FC_getJumlahPaketAktifMurid -->
                        Sedang Berjalan
                    </p>
                </div>

                <div>
                    <p>
                        Sisa Pertemuan<br>
                        <span style="font-size:40px;"><?php echo $lesCodingUtil->getValueStatistic("sisaPertemuanMurid"); ?></span><br> <!-- FC_getTotalSisaPertemuanMurid -->
                        Dari paket aktif
                    </p>
                </div>

                <div>
                    <p>
                        Jadwal Hari Ini<br>
                        <span style="font-size:40px;"><?php echo $lesCodingUtil->getValueStatistic("jadwalHariIniMurid"); ?></span><br> <!-- FC_getTotalJadwalHariIniMurid -->
                        Pertemuan Terjadwal
                    </p>
                </div>

                <div>
                    <p>
                        Jadwal Minggu Ini<br>
                        <span style="font-size:40px;"><?php echo $lesCodingUtil->getValueStatistic("jadwalMingguIniMurid"); ?></span><br> <!-- FC_getTotalJadwalMingguIniMurid -->
                        Pertemuan Terjadwal
                    </p>
                </div>    
            </div>

            <div class="jadwalDashboard">
                <div style="display:flex;justify-content: space-between;">
                    <span style="font-size:20px;"><b>Jadwal Mendatang</b></span>
                    <a href="">Lihat Semua</a>
                </div>
                <hr>
                <table id="dashboardTb" class="display">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hari & Waktu</th>
                            <th>Pengajar</th>
                            <th>Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $lesCodingUtil->renderTableBody("murid","dashboard"); ?> <!-- view_dashboardmurid_jadwalmendatang -->
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
            ],
            scrollX: true
        });

        let state = false;
        function sidebarToggle() {
            if(state) {
                document.getElementsByClassName("sidebar")[0].style.display = null;
                state = false;
            }
            else {
                document.getElementsByClassName("sidebar")[0].style.display = "block";
                state = true;
            }
        }
    </script>
</html>