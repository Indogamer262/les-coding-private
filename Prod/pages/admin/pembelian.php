<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Riwayat Pembelian</title>
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

            .btn-view { background-color: #2563eb; color: white; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .btn-view:hover { background-color: #1d4ed8; }
            .text-harga { color: #047857; font-weight: 600; }
            .text-expired { color: #ea580c; font-style: italic; font-size: 12px; }
            .row-expired { opacity: 0.6; }

            .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); display: none; justify-content: center; align-items: center; z-index: 100; }
            .modal-overlay.show { display: flex; }
            .modal { background: white; border-radius: 10px; width: 90%; max-width: 650px; max-height: 90vh; overflow-y: auto; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
            .modal-header { padding: 16px 20px; border-bottom: 1px solid #eee; }
            .modal-header h3 { margin: 0; }
            .modal-body { padding: 20px; }

            .detail-box { background-color: #f9fafb; border-radius: 8px; padding: 16px; margin-bottom: 16px; }
            .detail-row { display: flex; justify-content: space-between; padding: 6px 0; }
            .detail-row span:first-child { color: #666; }
            .detail-row span:last-child { font-weight: 500; }
            .detail-row.border-top { border-top: 1px solid #ddd; padding-top: 10px; margin-top: 6px; }

            .detail-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            .detail-table th, .detail-table td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
            .detail-table th { background-color: #f9fafb; font-size: 12px; text-transform: uppercase; color: #666; }

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
                    <h2>Riwayat Pembelian</h2>
                    <p>Lihat seluruh riwayat pembelian paket les</p>
                </div>
            </div>

            <div class="tableCard">
                <h3>Daftar Pembelian</h3>
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
                        <label>Status Paket</label>
                        <select id="filterStatus" onchange="applyFilters()">
                            <option value="all">Semua</option>
                            <option value="aktif">Aktif</option>
                            <option value="kadaluarsa">Kadaluarsa</option>
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
                <table id="pembelianTb" class="display">
                    <thead>
                        <tr>
                            <th style="text-align:center;">ID Pembelian</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Nama Murid</th>
                            <th>Paket</th>
                            <th>Harga</th>
                            <th>Masa Aktif</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pembelianTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("admin","pembelian"); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Detail Modal -->
        <div class="modal-overlay" id="detailModal" onclick="closeModal()">
            <div class="modal" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h3>Detail Sisa Pertemuan</h3>
                </div>
                <div class="modal-body">
                    <div class="detail-box">
                        <div class="detail-row">
                            <span>ID Pembelian:</span>
                            <span id="detailId" style="font-family: monospace;">-</span>
                        </div>
                        <div class="detail-row">
                            <span>Murid:</span>
                            <span id="detailMurid">-</span>
                        </div>
                        <div class="detail-row border-top">
                            <span>Sisa Pertemuan:</span>
                            <span id="detailSisa" style="color: #2563eb; font-weight: 600;">-</span>
                        </div>
                    </div>
                    
                    <h4 style="margin: 0 0 10px 0; font-size: 14px;">Pertemuan Terpakai</h4>
                    <table class="detail-table">
                        <thead>
                            <tr>
                                <th>Ke-</th>
                                <th>Tanggal & Waktu</th>
                                <th>Pengajar</th>
                                <th>Mata Pelajaran</th>
                                <th>Materi</th>
                            </tr>
                        </thead>
                        <tbody id="detailTerpakaiBody">
                            <tr><td colspan="5" style="color: #999;">Belum ada pertemuan terpakai</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        let pembelianTable = null;
        
        $(document).ready(function() {
            pembelianTable = new DataTable('#pembelianTb', { 
                scrollX: true,
                order: [[1, 'desc']] // Default sort by tanggal pemesanan descending (terbaru)
            });
            
            // Apply initial filter (bulan ini is selected by default)
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
            
            const rows = document.querySelectorAll('#pembelianTableBody tr');
            
            rows.forEach(row => {
                const isExpired = row.classList.contains('row-expired');
                const status = isExpired ? 'kadaluarsa' : 'aktif';
                const tanggalStr = row.dataset.tanggal || '';
                
                let visible = true;
                
                // Filter by status
                if (statusFilter !== 'all' && status !== statusFilter) {
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
            if (pembelianTable) {
                const sortOrder = sortBy === 'terbaru' ? 'desc' : 'asc';
                pembelianTable.order([1, sortOrder]).draw();
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

        function openDetailModal(btn) {
            const row = btn.closest('tr');
            const idCell = row.querySelector('td:first-child');
            const idPembelian = row.dataset.id || (idCell ? idCell.textContent.trim() : '');
            
            document.getElementById('detailId').textContent = idPembelian || '-';
            document.getElementById('detailMurid').textContent = row.dataset.murid || '-';
            
            const total = parseInt(row.dataset.total || '0');
            const sisa = parseInt(row.dataset.sisa || '0');
            document.getElementById('detailSisa').textContent = sisa + '/' + total;
            
            // Reset table body
            const tbody = document.getElementById('detailTerpakaiBody');
            tbody.innerHTML = ''; // Clear existing
            
            // Show modal
            document.getElementById('detailModal').classList.add('show');
            
            // Get data from attribute (Pre-loaded, NO AJAX)
            try {
                const rawData = row.dataset.terpakai;
                if (rawData) {
                    // Decode base64 then parse JSON
                    const jsonStr = atob(rawData);
                    const data = JSON.parse(jsonStr);
                    
                    if (data && data.length > 0) {
                        let html = '';
                        data.forEach(item => {
                            html += '<tr>' +
                                '<td>' + escapeHtml(item['Ke-'] || '-') + '</td>' +
                                '<td>' + escapeHtml(item['Tanggal'] || '-') + '<br><span style="color:#666;font-size:12px;">' + escapeHtml(item['Waktu'] || '') + '</span></td>' +
                                '<td>' + escapeHtml(item['Pengajar'] || '-') + '</td>' +
                                '<td>' + escapeHtml(item['Mata Pelajaran'] || '-') + '</td>' +
                                '<td>' + escapeHtml(item['Materi'] || '-') + '</td>' +
                            '</tr>';
                        });
                        tbody.innerHTML = html;
                    } else {
                        tbody.innerHTML = '<tr><td colspan="5" style="color: #999; text-align: center;">Belum ada pertemuan terpakai</td></tr>';
                    }
                } else {
                    tbody.innerHTML = '<tr><td colspan="5" style="color: #999; text-align: center;">Belum ada pertemuan terpakai</td></tr>';
                }
            } catch (e) {
                console.error("Error parsing data:", e);
                tbody.innerHTML = '<tr><td colspan="5" style="color: #dc2626; text-align: center;">Gagal memuat data</td></tr>';
            }
        }

        function escapeHtml(text) {
            if (text === null || text === undefined) return '';
            const div = document.createElement('div');
            div.textContent = String(text);
            return div.innerHTML;
        }

        function closeModal() {
            document.getElementById('detailModal').classList.remove('show');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</html>