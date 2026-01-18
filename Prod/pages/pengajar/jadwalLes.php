<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Jadwal Mengajar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css" rel="stylesheet">

        <style>
            body, html {box-sizing: border-box; margin: 0; height: 100%;}
            .poppins-regular {font-family: "Poppins", sans-serif;font-weight: 400;}
            .poppins-bold {font-family: "Poppins", sans-serif;font-weight: 700;}

            body {
                display: grid;
                grid-template-areas: "sidebar header" "sidebar content";
                grid-template-columns: auto 1fr;
                grid-template-rows: auto 1fr;
                background-color: #ededed;
            }
            
            .main { grid-area: content; padding: 20px; overflow-y: auto; }
            .pageHeader { margin-bottom: 20px; }
            .pageHeader h2 { margin: 0; }
            .pageHeader p { margin: 5px 0 0 0; color: #666; font-size: 14px; }

            .summaryBoard { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 20px; }
            .summaryCard { background-color: white; box-shadow: 0 0 10px 0 lightgray; border-radius: 8px; padding: 16px; }
            .summaryCard .label { font-size: 14px; color: #666; margin-bottom: 4px; }
            .summaryCard .value { font-size: 32px; font-weight: 700; color: #1f2937; }
            .summaryCard .sub { font-size: 12px; color: #999; margin-top: 4px; }

            .tableCard { background-color: white; box-shadow: 0 0 10px 0 lightgray; border-radius: 8px; padding: 24px; }
            .tableCard h3 { margin: 0 0 16px 0; }

            .filterRow { display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end; margin-bottom: 16px; }
            .filterGroup { display: flex; flex-direction: column; gap: 4px; }
            .filterGroup label { font-size: 12px; color: #666; }
            .filterGroup select, .filterGroup input { padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
            .filterGroup select:focus, .filterGroup input:focus { outline: none; border-color: #2563eb; }
            .spacer { flex: 1; }

            table.dataTable { width: 100% !important; border-collapse: collapse; }
            table.dataTable th, table.dataTable td { border: none; padding: 12px; text-align: left; }
            table.dataTable thead th { background-color: #f9fafb; font-weight: 600; font-size: 12px; text-transform: uppercase; color: #666; }
            table.dataTable tbody tr:hover { background-color: #f9fafb; }

            .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
            .badge-selesai { background-color: #dcfce7; color: #15803d; }
            .badge-mendatang { background-color: #dbeafe; color: #1d4ed8; }

            @media only screen and (max-width: 900px) {
                .summaryBoard { grid-template-columns: 1fr 1fr; }
            }
            @media only screen and (max-width: 800px) {
                body { display: block; }
                .main { padding: 20px; overflow: visible; }
                .summaryBoard { grid-template-columns: 1fr; }
                .filterRow { flex-direction: column; align-items: stretch; }
            }
        </style>
    </head>
    <body>
        <?php include('occurence/navbar.php'); ?>
        <?php include('pages/pengajar/sidebar.php'); ?>
        
        <?php
            // Get current filters from URL or default to 'all'
            $selectedPeriode = $_GET['periode'] ?? 'all';
            $selectedStatus = $_GET['status'] ?? 'all';
            $selectedSort = $_GET['sort'] ?? 'terbaru';
        ?>

        <div class="main poppins-regular">
            <div class="pageHeader">
                <h2>Jadwal Mengajar</h2>
                <p>Lihat semua jadwal mengajar Anda</p>
            </div>           

            <div class="tableCard">
                <h3>Daftar Jadwal</h3>
                <div class="filterRow">
                    <div class="filterGroup">
                        <label>Periode</label>
                        <select id="filterPeriode" onchange="updateFilters()">
                            <option value="all" <?php echo $selectedPeriode == 'all' ? 'selected' : ''; ?>>Semua</option>
                            <option value="today" <?php echo $selectedPeriode == 'today' ? 'selected' : ''; ?>>Hari Ini</option>
                            <option value="week" <?php echo $selectedPeriode == 'week' ? 'selected' : ''; ?>>Minggu Ini</option>
                            <option value="month" <?php echo $selectedPeriode == 'month' ? 'selected' : ''; ?>>Bulan Ini</option>
                        </select>
                    </div>
                    <div class="filterGroup">
                        <label>Status</label>
                        <select id="filterStatus" onchange="updateFilters()">
                            <option value="all" <?php echo $selectedStatus == 'all' ? 'selected' : ''; ?>>Semua</option>
                            <option value="selesai" <?php echo $selectedStatus == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                            <option value="mendatang" <?php echo $selectedStatus == 'mendatang' ? 'selected' : ''; ?>>Mendatang</option>
                        </select>
                    </div>
                    <div class="filterGroup">
                        <label>Urutkan</label>
                        <select id="sortBy" onchange="updateFilters()">
                            <option value="terbaru" <?php echo $selectedSort == 'terbaru' ? 'selected' : ''; ?>>Terbaru</option>
                            <option value="terlama" <?php echo $selectedSort == 'terlama' ? 'selected' : ''; ?>>Terlama</option>
                        </select>
                    </div>
                </div>
                <table id="jadwalTb" class="display">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hari & Waktu</th>
                            <th>Mata Pelajaran</th>
                            <th>Murid</th>
                            <th style="text-align:center;">Status</th>
                        </tr>
                    </thead>
                    <tbody id="jadwalTableBody">
                        <?php 
                            // Pass filters to the render function
                            $filters = [
                                'periode' => $selectedPeriode,
                                'status' => $selectedStatus,
                                'sort' => $selectedSort
                            ];
                            echo $lesCodingUtil->renderTableBody("pengajar", "jadwal", $filters); 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#jadwalTb', { 
                scrollX: true,
                ordering: false // Disable DataTables sorting since we do it server-side/manually
            });
        });

        function updateFilters() {
            const periode = document.getElementById('filterPeriode').value;
            const status = document.getElementById('filterStatus').value;
            const sort = document.getElementById('sortBy').value;
            
            // Reload page with new parameters
            window.location.href = `?page=jadwalLes&periode=${periode}&status=${status}&sort=${sort}`;
        }
    </script>
</html>
