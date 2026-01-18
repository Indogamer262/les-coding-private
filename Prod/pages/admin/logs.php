<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Log Aktivitas</title>
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

            .filterRow { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; margin-bottom: 16px; }
            .filterGroup { display: flex; flex-direction: column; gap: 4px; }
            .filterGroup input { padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
            .filterGroup input:focus { outline: none; border-color: #2563eb; }
            .spacer { flex: 1; }

            .roleTabs { display: flex; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
            .roleTabs button { padding: 8px 16px; border: none; background: white; cursor: pointer; font-size: 14px; }
            .roleTabs button:hover { background-color: #f9fafb; }
            .roleTabs button.active { background-color: #2563eb; color: white; }

            table.dataTable { width: 100% !important; border-collapse: collapse; }
            table.dataTable th, table.dataTable td { border: none; padding: 12px; text-align: left; }
            table.dataTable thead th { background-color: #f9fafb; font-weight: 600; font-size: 12px; text-transform: uppercase; color: #666; }
            table.dataTable tbody tr:hover { background-color: #f9fafb; }

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
                    <h2>Log Aktivitas</h2>
                    <p>Lihat seluruh log aktivitas sistem</p>
                </div>
            </div>

            <div class="tableCard">
                <h3>Daftar Log</h3>
                <div class="filterRow">
                    <div class="roleTabs">
                        <button id="filterSemua" class="active" onclick="setRoleFilter('semua')">Semua</button>
                        <button id="filterMurid" onclick="setRoleFilter('murid')">Murid</button>
                        <button id="filterPengajar" onclick="setRoleFilter('pengajar')">Pengajar</button>
                        <button id="filterAdmin" onclick="setRoleFilter('admin')">Admin</button>
                    </div>
                    <div class="spacer"></div>
                    <div class="filterGroup">
                        <input type="text" id="searchInput" placeholder="Cari aktivitas..." oninput="applyFilters()">
                    </div>
                </div>
                <table id="logsTb" class="display">
                    <thead>
                        <tr>
                            <th>ID Log</th>
                            <th>Tanggal</th>
                            <th>Aktivitas</th>
                            <th>ID Akun</th>
                        </tr>
                    </thead>
                    <tbody id="logsTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("admin","logsemua"); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        let selectedRole = 'semua';

        $(document).ready(function() {
            new DataTable('#logsTb', { scrollX: true });
        });

        function setRoleFilter(role) {
            selectedRole = role;
            
            // Update button states
            ['Semua', 'Murid', 'Pengajar', 'Admin'].forEach(r => {
                const btn = document.getElementById('filter' + r);
                if (btn) btn.classList.toggle('active', r.toLowerCase() === role);
            });
            
            applyFilters();
        }

        function applyFilters() {
            const searchQuery = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#logsTableBody tr');
            
            rows.forEach(row => {
                const role = row.getAttribute('data-role') || '';
                const text = row.textContent.toLowerCase();
                
                let visible = true;
                if (selectedRole !== 'semua' && role !== selectedRole) visible = false;
                if (searchQuery && !text.includes(searchQuery)) visible = false;
                
                row.style.display = visible ? '' : 'none';
            });
        }
    </script>
</html>
