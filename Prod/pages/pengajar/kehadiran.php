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
            .pageHeader { margin-bottom: 20px; }
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
        <?php include('pages/pengajar/sidebar.php'); ?>
        
        <div class="main poppins-regular">
            <div class="pageHeader">
                <h2>Riwayat Kehadiran</h2>
                <p>Lihat riwayat kehadiran murid yang Anda ajar</p>
            </div>

            <div class="tableCard">
                <h3>Daftar Kehadiran</h3>
                <div class="filterRow">
                    <div class="filterGroup">
                        <label>Periode</label>
                        <select id="filterPeriode" onchange="applyFilters()">
                            <option value="all">Semua</option>
                            <option value="today">Hari Ini</option>
                            <option value="week" selected>Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
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

                </div>
                <table id="kehadiranTb" class="display">
                    <thead>
                        <tr>
                            <th>Tanggal & Waktu</th>
                            <th>Murid</th>
                            <th>Mata Pelajaran</th>
                            <th>Materi</th>
                            <th style="text-align:center;">Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody id="kehadiranTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("pengajar","kehadiran"); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        let kehadiranTable = null;

        $(document).ready(function() {
            kehadiranTable = new DataTable('#kehadiranTb', { 
                scrollX: true,
                order: [[0, 'desc']] // Default sort by tanggal descending (terbaru)
            });
            
            // Apply initial filter
            applyFilters();
        });

        function applyFilters() {
            const periodeFilter = document.getElementById('filterPeriode').value;
            const statusFilter = document.getElementById('filterStatus').value;
            const sortBy = document.getElementById('sortBy').value;
            
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            // Calculate week start (Monday)
            const weekStart = new Date(today);
            const dayOfWeek = today.getDay();
            const diffToMonday = dayOfWeek === 0 ? 6 : dayOfWeek - 1;
            weekStart.setDate(today.getDate() - diffToMonday);
            
            // Calculate month start
            const monthStart = new Date(today.getFullYear(), today.getMonth(), 1);
            
            const rows = document.querySelectorAll('#kehadiranTableBody tr');
            
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const tanggalStr = row.getAttribute('data-tanggal') || '';
                
                let visible = true;
                
                // Filter by status
                if (statusFilter !== 'all' && rowStatus !== statusFilter) {
                    visible = false;
                }
                
                // Filter by periode
                if (visible && periodeFilter !== 'all' && tanggalStr) {
                    const rowDate = parseDate(tanggalStr);
                    if (rowDate) {
                        rowDate.setHours(0, 0, 0, 0);
                        
                        if (periodeFilter === 'today') {
                            visible = rowDate.getTime() === today.getTime();
                        } else if (periodeFilter === 'week') {
                            visible = rowDate >= weekStart && rowDate <= today;
                        } else if (periodeFilter === 'month') {
                            visible = rowDate >= monthStart && rowDate <= today;
                        }
                    }
                }

                row.style.display = visible ? '' : 'none';
            });
            
            // Apply sorting using DataTables
            if (kehadiranTable) {
                const sortOrder = sortBy === 'terbaru' ? 'desc' : 'asc';
                kehadiranTable.order([0, sortOrder]).draw();
            }
        }
        
        // Parse date string (supports YYYY-MM-DD and DD-MM-YYYY formats)
        function parseDate(dateStr) {
            if (!dateStr) return null;
            
            // Try YYYY-MM-DD format first
            if (/^\d{4}-\d{2}-\d{2}/.test(dateStr)) {
                return new Date(dateStr.substring(0, 10));
            }
            
            // Try DD-MM-YYYY or DD/MM/YYYY format
            const parts = dateStr.split(/[-\/]/);
            if (parts.length >= 3) {
                if (parts[0].length === 4) {
                    return new Date(parts[0], parseInt(parts[1]) - 1, parts[2]);
                } else {
                    return new Date(parts[2], parseInt(parts[1]) - 1, parts[0]);
                }
            }
            
            return new Date(dateStr);
        }
    </script>
</html>