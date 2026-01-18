<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Kelola Jadwal</title>
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

            .btn-primary { background-color: #2563eb; color: white; border: none; padding: 10px 16px; border-radius: 8px; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 8px; }
            .btn-primary:hover { background-color: #1d4ed8; }

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

            .btn-edit { background-color: #eab308; color: white; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .btn-edit:hover { background-color: #ca8a04; }
            .btn-delete { background-color: #dc2626; color: white; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .btn-delete:hover { background-color: #b91c1c; }
            .actionBtns { display: flex; gap: 8px; justify-content: center; }

            .text-belum { color: #3b82f6; font-style: italic; font-size: 12px; }

            .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); display: none; justify-content: center; align-items: center; z-index: 100; }
            .modal-overlay.show { display: flex; }
            .modal { background: white; border-radius: 10px; width: 90%; max-width: 550px; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
            .modal-header { padding: 16px 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
            .modal-header h3 { margin: 0; }
            .modal-close { background: none; border: none; font-size: 24px; cursor: pointer; color: #999; }
            .modal-close:hover { color: #333; }
            .modal-body { padding: 20px; }
            .form-group { margin-bottom: 16px; }
            .form-group label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 500; }
            .form-group input, .form-group select { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box; }
            .form-group input:focus, .form-group select:focus { outline: none; border-color: #2563eb; }
            .form-group input[readonly] { background-color: #f3f4f6; color: #666; }
            .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
            .modal-footer { padding: 16px 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-end; gap: 10px; }
            .btn-cancel { background: white; border: 1px solid #ddd; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-cancel:hover { background: #f9fafb; }
            .btn-save { background-color: #2563eb; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-save:hover { background-color: #1d4ed8; }

            @media only screen and (max-width: 800px) {
                body { display: block; }
                .main { padding: 20px; overflow: visible; }
                .pageHeader { flex-direction: column; align-items: flex-start; gap: 12px; }
                .filterRow { flex-direction: column; align-items: stretch; }
                .form-row { grid-template-columns: 1fr; }
            }
        </style>
    </head>
    <body>
        <?php include('occurence/navbar.php'); ?>
        <?php include('pages/admin/sidebar.php'); ?>
        
        <div class="main poppins-regular">
            <div class="pageHeader">
                <div>
                    <h2>Kelola Jadwal</h2>
                    <p>Kelola jadwal les untuk pengajar dan murid</p>
                </div>
                <button class="btn-primary" onclick="openAddModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                        <line x1="16" x2="16" y1="2" y2="6"></line>
                        <line x1="8" x2="8" y1="2" y2="6"></line>
                        <line x1="3" x2="21" y1="10" y2="10"></line>
                    </svg>
                    Buat Jadwal Baru
                </button>
            </div>

            <div class="tableCard">
                <h3>Daftar Jadwal</h3>
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
                            <option value="terisi">Terisi</option>
                            <option value="belum">Belum Terisi</option>
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
                <table id="jadwalTb" class="display">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hari & Waktu</th>
                            <th>Pengajar</th>
                            <th>Mata Pelajaran</th>
                            <th>Murid</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="jadwalTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("admin","jadwal"); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal-overlay" id="jadwalModal">
            <div class="modal">
                <div class="modal-header">
                    <h3 id="modalTitle">Buat Jadwal Baru</h3>
                    <button class="modal-close" onclick="closeModal()">&times;</button>
                </div>
                <form id="jadwalForm" onsubmit="handleSubmit(event)">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Pengajar</label>
                                <select name="pengajar" required>
                                    <option value="">-- Pilih Pengajar --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mata Pelajaran</label>
                                <select name="mapel" required>
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" id="inputTanggal" required onchange="updateHari()">
                            </div>
                            <div class="form-group">
                                <label>Hari</label>
                                <input type="text" name="hari" id="inputHari" placeholder="Otomatis dari tanggal" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Jam Mulai</label>
                                <input type="time" name="jamMulai" required>
                            </div>
                            <div class="form-group">
                                <label>Jam Selesai</label>
                                <input type="time" name="jamSelesai" required>
                            </div>
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
        const hariNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $(document).ready(function() {
            new DataTable('#jadwalTb', { scrollX: true });
        });

        function updateHari() {
            const tanggal = document.getElementById('inputTanggal').value;
            if (tanggal) {
                const date = new Date(tanggal);
                document.getElementById('inputHari').value = hariNames[date.getDay()];
            } else {
                document.getElementById('inputHari').value = '';
            }
        }

        function applyFilters() {

            const statusFilter = document.getElementById('filterStatus').value;
            const rows = document.querySelectorAll('#jadwalTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const muridCell = row.cells[4];
                const isBelum = muridCell && muridCell.textContent.includes('Belum terisi');
                const status = isBelum ? 'belum' : 'terisi';
                
                let visible = true;

                if (statusFilter !== 'all' && status !== statusFilter) visible = false;
                
                row.style.display = visible ? '' : 'none';
            });
        }

        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Buat Jadwal Baru';
            document.getElementById('jadwalForm').reset();
            document.getElementById('inputHari').value = '';
            document.getElementById('jadwalModal').classList.add('show');
        }

        function editJadwal(id) {
            document.getElementById('modalTitle').textContent = 'Edit Jadwal';
            document.getElementById('jadwalModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('jadwalModal').classList.remove('show');
        }

        function handleSubmit(event) {
            event.preventDefault();
            alert('Jadwal berhasil disimpan!');
            closeModal();
        }

        function deleteJadwal(id) {
            if (confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
                alert('Jadwal berhasil dihapus!');
            }
        }

        document.getElementById('jadwalModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</html>
