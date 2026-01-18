<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Kelola Mata Pelajaran</title>
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

            .pageHeader {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .pageHeader h2 { margin: 0; }
            .pageHeader p { margin: 5px 0 0 0; color: #666; font-size: 14px; }

            .btn-primary {
                background-color: #2563eb;
                color: white;
                border: none;
                padding: 10px 16px;
                border-radius: 8px;
                cursor: pointer;
                font-size: 14px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .btn-primary:hover { background-color: #1d4ed8; }

            .tableCard {
                background-color: white;
                box-shadow: 0 0 10px 0 lightgray;
                border-radius: 8px;
                padding: 24px;
            }

            .tableCard h3 { margin: 0 0 16px 0; }

            .filterRow {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                align-items: center;
                margin-bottom: 16px;
            }

            .filterGroup {
                display: flex;
                flex-direction: column;
                gap: 4px;
            }

            .filterGroup input {
                padding: 8px 12px;
                border: 1px solid #ddd;
                border-radius: 6px;
                font-size: 14px;
            }

            .filterGroup input:focus {
                outline: none;
                border-color: #2563eb;
            }

            .spacer { flex: 1; }

            .statusTabs {
                display: flex;
                border: 1px solid #ddd;
                border-radius: 8px;
                overflow: hidden;
            }

            .statusTabs button {
                padding: 8px 16px;
                border: none;
                background: white;
                cursor: pointer;
                font-size: 14px;
            }

            .statusTabs button:hover { background-color: #f9fafb; }
            .statusTabs button.active { background-color: #2563eb; color: white; }

            table.dataTable { width: 100% !important; border-collapse: collapse; }
            table.dataTable th, table.dataTable td { border: none; padding: 12px; text-align: left; }
            table.dataTable thead th { background-color: #f9fafb; font-weight: 600; font-size: 12px; text-transform: uppercase; color: #666; }
            table.dataTable tbody tr:hover { background-color: #f9fafb; }

            .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
            .badge-aktif { background-color: #dcfce7; color: #15803d; }
            .badge-nonaktif { background-color: #f3f4f6; color: #374151; }

            .btn-edit { background-color: #eab308; color: white; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .btn-edit:hover { background-color: #ca8a04; }

            .btn-toggle { background-color: #f3f4f6; color: #374151; border: 1px solid #ddd; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .btn-toggle:hover { background-color: #e5e7eb; }
            .btn-toggle.aktifkan { background-color: #2563eb; color: white; border: none; }
            .btn-toggle.aktifkan:hover { background-color: #1d4ed8; }

            .actionBtns { display: flex; gap: 8px; justify-content: center; }

            .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); display: none; justify-content: center; align-items: center; z-index: 100; }
            .modal-overlay.show { display: flex; }
            .modal { background: white; border-radius: 10px; width: 90%; max-width: 500px; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
            .modal-header { padding: 16px 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
            .modal-header h3 { margin: 0; }
            .modal-close { background: none; border: none; font-size: 24px; cursor: pointer; color: #999; }
            .modal-close:hover { color: #333; }
            .modal-body { padding: 20px; }
            .form-group { margin-bottom: 16px; }
            .form-group label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 500; }
            .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box; font-family: inherit; }
            .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #2563eb; }
            .modal-footer { padding: 16px 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-end; gap: 10px; }
            .btn-cancel { background: white; border: 1px solid #ddd; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-cancel:hover { background: #f9fafb; }
            .btn-save { background-color: #2563eb; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-save:hover { background-color: #1d4ed8; }

            .row-inactive { opacity: 0.6; }

            @media only screen and (max-width: 800px) {
                body { display: block; }
                .main { padding: 20px; overflow: visible; }
                .pageHeader { flex-direction: column; align-items: flex-start; gap: 12px; }
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
                    <h2>Kelola Mata Pelajaran</h2>
                    <p>Kelola daftar mata pelajaran yang tersedia</p>
                </div>
                <button class="btn-primary" onclick="openAddModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                        <line x1="12" y1="6" x2="12" y2="14"></line>
                        <line x1="8" y1="10" x2="16" y2="10"></line>
                    </svg>
                    Tambah Mata Pelajaran
                </button>
            </div>

            <div class="tableCard">
                <h3>Daftar Mata Pelajaran</h3>
                <div class="filterRow">
                    <div class="statusTabs">
                        <button id="filterAktif" class="active" onclick="setStatusFilter('aktif')">Aktif</button>
                        <button id="filterNonaktif" onclick="setStatusFilter('nonaktif')">Nonaktif</button>
                    </div>
                    <div class="spacer"></div>

                </div>
                <table id="mapelTb" class="display">
                    <thead>
                        <tr>
                            <th>Nama Mata Pelajaran</th>
                            <th>Deskripsi</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="mapelTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("admin","matapelajaran"); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal-overlay" id="mapelModal">
            <div class="modal">
                <div class="modal-header">
                    <h3 id="modalTitle">Tambah Mata Pelajaran</h3>
                    <button class="modal-close" onclick="closeModal()">&times;</button>
                </div>
                <form id="mapelForm" onsubmit="handleSubmit(event)">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Mata Pelajaran</label>
                            <input type="text" name="nama" placeholder="Contoh: Python" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat mata pelajaran..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
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
        let selectedStatus = 'aktif';

        $(document).ready(function() {
            new DataTable('#mapelTb', { scrollX: true });
            applyFilters();
        });

        function setStatusFilter(status) {
            selectedStatus = status;
            document.getElementById('filterAktif').classList.toggle('active', status === 'aktif');
            document.getElementById('filterNonaktif').classList.toggle('active', status === 'nonaktif');
            applyFilters();
        }

        function applyFilters() {

            const rows = document.querySelectorAll('#mapelTableBody tr');
            
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                const text = row.textContent.toLowerCase();
                
                let visible = status === selectedStatus;

                
                row.style.display = visible ? '' : 'none';
            });
        }

        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Mata Pelajaran';
            document.getElementById('mapelForm').reset();
            document.getElementById('mapelModal').classList.add('show');
        }

        function editMapel(id) {
            document.getElementById('modalTitle').textContent = 'Edit Mata Pelajaran';
            document.getElementById('mapelModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('mapelModal').classList.remove('show');
        }

        function handleSubmit(event) {
            event.preventDefault();
            alert('Mata pelajaran berhasil disimpan!');
            closeModal();
        }

        function toggleStatus(id, btn) {
            const row = btn.closest('tr');
            const currentStatus = row.getAttribute('data-status');
            const newStatus = currentStatus === 'aktif' ? 'nonaktif' : 'aktif';
            const action = newStatus === 'aktif' ? 'mengaktifkan' : 'menonaktifkan';
            
            if (!confirm('Apakah Anda yakin ingin ' + action + ' mata pelajaran ini?')) return;

            row.setAttribute('data-status', newStatus);
            row.classList.toggle('row-inactive', newStatus === 'nonaktif');

            const badge = row.querySelector('.badge');
            if (badge) {
                badge.textContent = newStatus === 'aktif' ? 'Aktif' : 'Nonaktif';
                badge.className = 'badge ' + (newStatus === 'aktif' ? 'badge-aktif' : 'badge-nonaktif');
            }

            btn.textContent = newStatus === 'aktif' ? 'Nonaktifkan' : 'Aktifkan';
            btn.classList.toggle('aktifkan', newStatus === 'nonaktif');

            alert('Status berhasil diubah!');
            applyFilters();
        }

        document.getElementById('mapelModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</html>
