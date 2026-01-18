<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Verifikasi Pembayaran</title>
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
            .text-muted { color: #9ca3af; font-style: italic; font-size: 12px; }

            .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); display: none; justify-content: center; align-items: center; z-index: 100; }
            .modal-overlay.show { display: flex; }
            .modal { background: white; border-radius: 10px; width: 90%; max-width: 500px; max-height: 90vh; overflow-y: auto; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
            .modal-header { padding: 16px 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
            .modal-header h3 { margin: 0; }
            .modal-close { background: none; border: none; font-size: 24px; cursor: pointer; color: #999; }
            .modal-close:hover { color: #333; }
            .modal-body { padding: 20px; }
            .modal-footer { padding: 16px 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-end; gap: 10px; }

            .detail-box { background-color: #f9fafb; border-radius: 8px; padding: 16px; margin-bottom: 16px; }
            .detail-row { display: flex; justify-content: space-between; padding: 6px 0; }
            .detail-row span:first-child { color: #666; }
            .detail-row span:last-child { font-weight: 500; }
            .detail-row.border-top { border-top: 1px solid #ddd; padding-top: 10px; margin-top: 6px; }

            .bukti-img { width: 100%; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 16px; }

            .warning-box { background-color: #fffbeb; border: 1px solid #fbbf24; border-radius: 8px; padding: 12px; display: flex; gap: 10px; align-items: flex-start; }
            .warning-box svg { flex-shrink: 0; color: #d97706; }
            .warning-box p { margin: 0; font-size: 13px; color: #92400e; }

            .btn-cancel { background: white; border: 1px solid #ddd; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-cancel:hover { background: #f9fafb; }
            .btn-lunas { background-color: #059669; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px; }
            .btn-lunas:hover { background-color: #047857; }

            .toast { position: fixed; top: 20px; right: 20px; background-color: #059669; color: white; padding: 16px 20px; border-radius: 8px; display: none; align-items: center; gap: 10px; z-index: 200; box-shadow: 0 4px 12px rgba(0,0,0,0.2); }
            .toast.show { display: flex; }
            .toast p { margin: 0; }
            .toast p:first-of-type { font-weight: 600; }
            .toast p:last-of-type { font-size: 12px; opacity: 0.9; }

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
                    <h2>Verifikasi Pembayaran</h2>
                    <p>Verifikasi pembayaran pembelian paket les</p>
                </div>
            </div>

            <div class="tableCard">
                <h3>Daftar Pembelian Menunggu Verifikasi</h3>
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
                        <label>Status Bukti</label>
                        <select id="filterBukti" onchange="applyFilters()">
                            <option value="all">Semua</option>
                            <option value="ada">Sudah Upload</option>
                            <option value="belum">Belum Upload</option>
                        </select>
                    </div>
                    <div class="filterGroup">
                        <label>Urutkan</label>
                        <select id="sortBy" onchange="applyFilters()">
                            <option value="terbaru">Terbaru</option>
                            <option value="terlama">Terlama</option>
                        </select>
                    </div>
                </div>
                <table id="verifikasiTb" class="display">
                    <thead>
                        <tr>
                            <th>ID Pembelian</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Nama Murid</th>
                            <th>Paket</th>
                            <th>Jumlah</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="verifikasiTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("admin","verifikasi"); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bukti Modal -->
        <div class="modal-overlay" id="buktiModal">
            <div class="modal">
                <div class="modal-header">
                    <h3>Bukti Pembayaran</h3>
                    <button class="modal-close" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="detail-box">
                        <div class="detail-row">
                            <span>ID Pembelian:</span>
                            <span id="buktiId" style="font-family: monospace;">-</span>
                        </div>
                        <div class="detail-row">
                            <span>Murid:</span>
                            <span id="buktiMurid">-</span>
                        </div>
                        <div class="detail-row">
                            <span>Paket:</span>
                            <span id="buktiPaket">-</span>
                        </div>
                        <div class="detail-row border-top">
                            <span>Jumlah:</span>
                            <span id="buktiJumlah" style="color: #047857; font-weight: 600;">-</span>
                        </div>
                    </div>
                    
                    <img id="buktiImage" class="bukti-img" src="" alt="Bukti Pembayaran">

                    <div class="warning-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        <p>Pastikan bukti transfer sudah sesuai sebelum menandai lunas!</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" onclick="closeModal()">Tutup</button>
                    <form id="lunasForm" method="POST" action="submissionHandler.php" style="display: inline;">
                        <input type="hidden" name="handlerType" value="tandaiLunas">
                        <input type="hidden" name="id_pembelian" id="lunasIdPembelian" value="">
                        <button type="submit" id="btnLunas" class="btn-lunas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Tandai Lunas
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Toast -->
        <div class="toast" id="successToast">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <div>
                <p>Pembayaran sudah Lunas!</p>
                <p>Pembelian paket berhasil ditandai lunas.</p>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        let currentId = null;
        let verifikasiTable = null;

        $(document).ready(function() {
            verifikasiTable = new DataTable('#verifikasiTb', { 
                scrollX: true,
                order: [[1, 'desc']] // Default sort by tanggal descending (terbaru)
            });
            
            // Apply initial filter (bulan ini is selected by default)
            applyFilters();
            
            // Show alert messages if any
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.get('lunas') === 'success') {
                showToast();
            } else if(urlParams.get('lunas') === 'error') {
                alert('Gagal menandai lunas: ' + (urlParams.get('msg') || 'Unknown error'));
            }
        });

        function applyFilters() {
            const periodeFilter = document.getElementById('filterPeriode').value;
            const buktiFilter = document.getElementById('filterBukti').value;
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
            
            const rows = document.querySelectorAll('#verifikasiTableBody tr');
            
            rows.forEach(row => {
                const bukti = row.dataset.bukti || '';
                const tanggalStr = row.dataset.tanggal || '';
                
                let visible = true;
                
                // Filter by bukti status
                if (buktiFilter !== 'all' && bukti !== buktiFilter) {
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
            if (verifikasiTable) {
                const sortOrder = sortBy === 'terbaru' ? 'desc' : 'asc';
                verifikasiTable.order([1, sortOrder]).draw();
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

        function openBuktiModal(id) {
            currentId = id;
            const row = document.querySelector('tr[data-id="' + id + '"]');
            if (!row) return;

            document.getElementById('buktiId').textContent = row.dataset.pembelian || '-';
            document.getElementById('buktiMurid').textContent = row.dataset.murid || '-';
            document.getElementById('buktiPaket').textContent = row.dataset.paket || '-';
            document.getElementById('buktiJumlah').textContent = row.dataset.jumlah || '-';
            document.getElementById('buktiImage').src = row.dataset.buktiUrl || '';
            document.getElementById('lunasIdPembelian').value = id;

            document.getElementById('buktiModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('buktiModal').classList.remove('show');
        }

        function showToast() {
            const toast = document.getElementById('successToast');
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);
        }

        document.getElementById('buktiModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</html>
