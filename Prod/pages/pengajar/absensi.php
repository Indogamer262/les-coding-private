<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Input Absensi</title>
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

            .btn-input { background-color: #059669; color: white; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .btn-input:hover { background-color: #047857; }

            .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); display: none; justify-content: center; align-items: center; z-index: 100; }
            .modal-overlay.show { display: flex; }
            .modal { background: white; border-radius: 10px; width: 90%; max-width: 500px; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
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

            .form-group { margin-bottom: 16px; }
            .form-group label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 500; }
            .form-group select, .form-group textarea { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box; }
            .form-group textarea { min-height: 80px; resize: vertical; }

            .btn-cancel { background: white; border: 1px solid #ddd; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-cancel:hover { background: #f9fafb; }
            .btn-save { background-color: #059669; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-save:hover { background-color: #047857; }

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
                <h2>Input Absensi</h2>
                <p>Input absensi kehadiran untuk jadwal mengajar Anda</p>
            </div>

            <div class="tableCard">
                <h3>Jadwal Hari Ini</h3>
                <div class="filterRow">
                    <div class="filterGroup">
                        <label>Tanggal</label>
                        <input type="date" id="filterTanggal" onchange="applyFilters()">
                    </div>
                    <div class="filterGroup">
                        <label>Status</label>
                        <select id="filterStatus" onchange="applyFilters()">
                            <option value="all">Semua</option>
                            <option value="belum">Belum Absen</option>
                            <option value="sudah">Sudah Absen</option>
                        </select>
                    </div>
                    <div class="spacer"></div>

                </div>
                <table id="absensiTb" class="display">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hari & Waktu</th>
                            <th>Mata Pelajaran</th>
                            <th>Murid</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="absensiTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("pengajar","absensi"); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Input Absensi -->
        <div class="modal-overlay" id="absensiModal">
            <div class="modal">
                <div class="modal-header">
                    <h3>Input Absensi</h3>
                    <button class="modal-close" onclick="closeModal()">&times;</button>
                </div>
                <form id="absensiForm" onsubmit="handleAbsensi(event)">
                    <div class="modal-body">
                        <div class="detail-box">
                            <div class="detail-row"><span>Tanggal:</span><span id="modalTanggal">-</span></div>
                            <div class="detail-row"><span>Waktu:</span><span id="modalWaktu">-</span></div>
                            <div class="detail-row"><span>Murid:</span><span id="modalMurid">-</span></div>
                            <div class="detail-row"><span>Mata Pelajaran:</span><span id="modalMapel">-</span></div>
                        </div>
                        <div class="form-group">
                            <label>Status Kehadiran</label>
                            <select name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="hadir">Hadir</option>
                                <option value="tidak-hadir">Tidak Hadir</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Materi Pembelajaran</label>
                            <textarea name="materi" placeholder="Materi yang diajarkan..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                        <button type="submit" class="btn-save">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        let currentJadwalId = null;

        $(document).ready(function() {
            new DataTable('#absensiTb', { scrollX: true });
            document.getElementById('filterTanggal').valueAsDate = new Date();
        });

        function applyFilters() {
            const status = document.getElementById('filterStatus').value;

            const rows = document.querySelectorAll('#absensiTableBody tr');
            
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const text = row.textContent.toLowerCase();
                let visible = true;
                if (status !== 'all' && rowStatus !== status) visible = false;

                row.style.display = visible ? '' : 'none';
            });
        }

        function openAbsensiModal(id, tanggal, waktu, murid, mapel) {
            currentJadwalId = id;
            document.getElementById('modalTanggal').textContent = tanggal;
            document.getElementById('modalWaktu').textContent = waktu;
            document.getElementById('modalMurid').textContent = murid;
            document.getElementById('modalMapel').textContent = mapel;
            document.getElementById('absensiForm').reset();
            document.getElementById('absensiModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('absensiModal').classList.remove('show');
        }

        function handleAbsensi(event) {
            event.preventDefault();
            alert('Absensi berhasil disimpan!');
            closeModal();
        }

        document.getElementById('absensiModal').addEventListener('click', function(e) { if (e.target === this) closeModal(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeModal(); });
    </script>
</html>
