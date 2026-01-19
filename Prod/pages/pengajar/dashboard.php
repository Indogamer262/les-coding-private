<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<?php
    if (!isset($lesCodingUtil)) {
        header("Location: ../../index.php");
        exit;
    }
?>
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
            .jadwalTerisiDashboard {
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
        <?php include('pages/pengajar/sidebar.php'); ?>
        
        <!-- Main content layout -->
        <div class="main poppins-regular">
            <h2 style="margin-bottom:0;">Dashboard Pengajar</h2>
            <p class="text-sm text-gray-600 mt-1">Selamat datang di Sistem Les Privat Coding<span class="font-semibold"></span>!</p>
            <!-- summary board -->
            <div class="summaryBoard">
                <div>
                    <p>
                        <p class="text-sm font-medium text-gray-600">Total Murid</p>
                        <span style="font-size:40px;"><?php echo $lesCodingUtil->getValueStatistic("muridDiajar", $_SESSION["loginID"]); ?></span><br>
                        <p class="text-xs text-gray-500 mt-1">Yang diajar saat ini</p>
                    </p>
                </div>

                <div>
                    <p>
                        <p class="text-sm font-medium text-gray-600">Jadwal hari ini</p>
                        <span style="font-size:40px;"><?php echo $lesCodingUtil->getValueStatistic("jadwalHariIniPengajar", $_SESSION["loginID"]); ?></span><br>
                        <p class="text-xs text-gray-500 mt-1">Sesi mengajar</p>
                    </p>
                </div>

                <div>
                    <p>
                        <p class="text-sm font-medium text-gray-600">Jadwal Minggu ini</p>
                        <span style="font-size:40px;"><?php echo $lesCodingUtil->getValueStatistic("jadwalMingguIniPengajar", $_SESSION["loginID"]); ?></span><br>
                        <p class="text-xs text-gray-500 mt-1">Sesi mengajar</p>
                    </p>
                </div>
            </div>

            <div class="jadwalTerisiDashboard">
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
                            <th>Mata Pelajaran</th>
                            <th>Murid</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $lesCodingUtil->renderTableBody("pengajar","dashboard"); ?> 
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
                    targets: [3],
                    orderData: [3, 0]
                }
            ],
            scrollX: true
        });
    </script>
</html>