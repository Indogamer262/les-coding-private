<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Riwayat Kehadiran</title>
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
            .pageHeader { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
            .pageHeader h2 { margin: 0; }
            .pageHeader p { margin: 5px 0 0 0; color: #666; font-size: 14px; }

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
            .badge-hadir { background-color: #dcfce7; color: #15803d; }
            .badge-tidak-hadir { background-color: #fee2e2; color: #dc2626; }

            @media only screen and (max-width: 800px) {
                body { display: block; }
                .main { padding: 20px; overflow: visible; }
                .filterRow { flex-direction: column; align-items: stretch; }
            }
        </style>
    </head>
    <body>
        <?php include('occurence/navbar.php'); ?>
        <?php include('pages/admin/sidebar.php'); ?>
        
        <div class="main poppins-regular">
            <div class="pageHeader">
                <div>
                    <h2>Riwayat Kehadiran</h2>
                    <p>Lihat seluruh riwayat kehadiran murid</p>
                </div>
            </div>

            <div class="tableCard">
                <h3>Daftar Kehadiran</h3>
                <div class="filterRow">
                    <div class="filterGroup">
                        <label>Periode</label>
                        <select id="filterPeriode" onchange="applyFilters()">
                            <option value="all">Semua Periode</option>
                            <option value="today">Hari Ini</option>
                            <option value="week">Minggu Ini</option>
                            <option value="month" selected>Bulan Ini</option>
                        </select>
                    </div>
                    <div class="filterGroup">
                        <label>Status</label>
                        <select id="filterStatus" onchange="applyFilters()">
                            <option value="all">Semua</option>
                            <option value="hadir">Hadir</option>
                            <option value="tidak-hadir">Tidak Hadir</option>
                        </select>
                    </div>
                    <div class="filterGroup">
                        <label>Urutkan</label>
                        <select id="sortBy" onchange="applyFilters()">
                            <option value="terbaru">Terbaru</option>
                            <option value="terlama">Terlama</option>
                        </select>
                    </div>
                    <div class="spacer"></div>
                    <div class="filterGroup">
                        <label>Cari</label>
                        <input type="text" id="searchInput" placeholder="Cari kehadiran..." oninput="applyFilters()">
                    </div>
                </div>
                <table id="kehadiranTb" class="display">
                    <thead>
                        <tr>
                            <th>Tanggal & Waktu</th>
                            <th>Pengajar</th>
                            <th>Mata Pelajaran</th>
                            <th>Murid</th>
                            <th>Materi</th>
                            <th style="text-align:center;">Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody id="kehadiranTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("admin","kehadiran"); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#kehadiranTb', { scrollX: true });
        });

        function applyFilters() {
            const searchQuery = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('filterStatus').value;
            const rows = document.querySelectorAll('#kehadiranTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const status = row.getAttribute('data-status') || '';
                
                let visible = true;
                if (searchQuery && !text.includes(searchQuery)) visible = false;
                if (statusFilter !== 'all' && status !== statusFilter) visible = false;
                
                row.style.display = visible ? '' : 'none';
            });
        }
    </script>
</html>