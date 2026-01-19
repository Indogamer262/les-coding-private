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
            
            .main { grid-area: content; padding: 20px; overflow-y: auto; }
            .pageHeader { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
            .pageHeader h2 { margin: 0; }
            .pageHeader p { margin: 5px 0 0 0; color: #666; font-size: 14px; }

            .btn-primary { background-color: #2563eb; color: white; border: none; padding: 10px 16px; border-radius: 8px; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 8px; }
            .btn-primary:hover { background-color: #1d4ed8; }

            .tableCard { background-color: white; box-shadow: 0 0 10px 0 lightgray; border-radius: 8px; padding: 24px; }
            .tableCard h3 { margin: 0 0 16px 0; }

            .filterRow { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; margin-bottom: 16px; }
            .filterGroup { display: flex; flex-direction: column; gap: 4px; }
            .filterGroup input { padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
            .filterGroup input:focus { outline: none; border-color: #2563eb; }
            .spacer { flex: 1; }

            .statusTabs { display: flex; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
            .statusTabs button { padding: 8px 16px; border: none; background: white; cursor: pointer; font-size: 14px; }
            .statusTabs button:hover { background-color: #f9fafb; }
            .statusTabs button.active { background-color: #2563eb; color: white; }

            table.dataTable { width: 100% !important; border-collapse: collapse; }
            table.dataTable th, table.dataTable td { border: none; padding: 12px; text-align: left; }
            table.dataTable thead th { background-color: #f9fafb; font-weight: 600; font-size: 12px; text-transform: uppercase; color: #666; }
            table.dataTable tbody tr:hover { background-color: #f9fafb; }

            /* Badge Styles */
            .item-status-badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
            .bg-green-100 { background-color: #dcfce7; }
            .text-green-700 { color: #15803d; }
            .bg-gray-100 { background-color: #f3f4f6; }
            .text-gray-700 { color: #374151; }

            .btn-edit { background-color: #eab308; color: white; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .btn-edit:hover { background-color: #ca8a04; }
            
            .status-toggle-btn.bg-gray-100 { background-color: #f3f4f6; color: #374151; border: 1px solid #ddd; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .status-toggle-btn.bg-blue-600 { background-color: #2563eb; color: white; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .status-toggle-btn.bg-gray-100:hover { background-color: #e5e7eb; }
            .status-toggle-btn.bg-blue-600:hover { background-color: #1d4ed8; }

            .actionBtns { display: flex; gap: 8px; justify-content: center; }

            .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); display: none; justify-content: center; align-items: center; z-index: 100; }
            .modal-overlay.show { display: flex; }
            .modal { background: white; border-radius: 10px; width: 90%; max-width: 500px; box-shadow: 0 4px 20px rgba(0,0,0,0.2); max-height: 90vh; display: flex; flex-direction: column; }
            .modal-header { padding: 16px 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
            .modal-header h3 { margin: 0; }
            .modal-close { background: none; border: none; font-size: 24px; cursor: pointer; color: #999; }
            .modal-close:hover { color: #333; }
            .modal-body { padding: 20px; overflow-y: auto; }
            .form-group { margin-bottom: 16px; }
            .form-group label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 500; }
            .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box; }
            .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #2563eb; }
            .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
            .modal-footer { padding: 16px 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-end; gap: 10px; }
            .btn-cancel { background: white; border: 1px solid #ddd; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-cancel:hover { background: #f9fafb; }
            .btn-save { background-color: #2563eb; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-save:hover { background-color: #1d4ed8; }
            .row-inactive { opacity: 0.6; }

            /* Checkbox List Styling */
            #pengajarCheckboxContainer { border: 1px solid #ddd; border-radius: 6px; padding: 12px; max-height: 200px; overflow-y: auto; background-color: #f9fafb; }
            .checkbox-item { display: flex; align-items: center; gap: 10px; padding: 8px; border-radius: 4px; cursor: pointer; }
            .checkbox-item:hover { background-color: white; }
            .checkbox-item input { width: 16px; height: 16px; margin: 0; cursor: pointer; }

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
        
        <?php
            // Fetch pengajar data for the modal
            $pengajarAktif = $lesCodingUtil->getPengajarAktif();
            $pengajarJson = json_encode($pengajarAktif);
        ?>

        <div class="main poppins-regular">
            <div class="pageHeader">
                <div>
                    <h2>Kelola Mata Pelajaran</h2>
                    <p>Kelola daftar mata pelajaran yang tersedia</p>
                </div>
                <button class="btn-primary" onclick="openAddSubjectModal()">
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
                        <button id="filterActive" class="active" onclick="setStatusFilter('active')">Aktif</button>
                        <button id="filterInactive" onclick="setStatusFilter('inactive')">Nonaktif</button>
                    </div>
                </div>
                <table id="tableMapelAdmin" class="display">
                    <thead>
                        <tr>
                            <th>Nama Mata Pelajaran</th>
                            <th>Deskripsi</th>
                            <th>Pengajar</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="mapelTableBody">
                        <?php $lesCodingUtil->renderTableBody("admin", "matapelajaran"); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Subject Modal -->
        <div class="modal-overlay" id="subjectModal">
            <div class="modal">
                <div class="modal-header">
                    <h3 id="subjectModalTitle">Tambah Mata Pelajaran</h3>
                    <button class="modal-close" onclick="closeSubjectModal()">&times;</button>
                </div>
                <form id="subjectForm" action="submissionHandler.php" method="POST">
                    <input type="hidden" name="handlerType" id="input_handlerType" value="tambahMapel">
                    <input type="hidden" name="id_mapel" id="input_id_mapel" value="">
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Mata Pelajaran</label>
                            <input name="subjectName" id="input_subjectName" type="text" placeholder="Contoh: Python" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" id="input_description" rows="3" placeholder="Deskripsi singkat mata pelajaran..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="input_status">
                                <option value="active">Aktif</option>
                                <option value="inactive">Nonaktif</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Pengajar yang Mengajar <span style="font-weight:normal; color:#888;">(pilih satu atau lebih)</span></label>
                            <div id="pengajarCheckboxContainer">
                                <div id="pengajarList"></div>
                                <div id="pengajarEmpty" style="display:none; color:#999; font-style:italic;">Tidak ada pengajar aktif</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" onclick="closeSubjectModal()">Batal</button>
                        <button type="submit" class="btn-save">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Hidden form for toggling status -->
        <form id="toggleStatusForm" action="submissionHandler.php" method="POST" style="display:none;">
            <input type="hidden" name="handlerType" value="toggleStatusMapel">
            <input type="hidden" name="id_mapel" id="toggle_id_mapel">
            <input type="hidden" name="status" id="toggle_status_val">
        </form>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        let selectedStatusFilter = 'active';
        let tableMapelAdmin;
        const pengajarAktifData = <?php echo $pengajarJson ?: '[]'; ?>;

        function escapeHtml(value) {
            if (value === null || value === undefined) return '';
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        $(document).ready(function() {
            // Initialize DataTable
            tableMapelAdmin = new DataTable('#tableMapelAdmin', { scrollX: true });
            
            // Initial filter
            applyFilters();

            // Modal outside click close
            document.getElementById('subjectModal').addEventListener('click', function(e) {
                if (e.target === this) closeSubjectModal();
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeSubjectModal();
            });
            
            // Check messages
            const urlParams = new URLSearchParams(window.location.search);
            const msg = urlParams.get('msg');
            
            if (msg === 'success') {
                alert('Mata pelajaran berhasil ditambahkan!');
                window.history.replaceState({}, document.title, window.location.pathname);
            } else if (msg === 'edit') {
                alert('Mata pelajaran berhasil diperbarui!');
                window.history.replaceState({}, document.title, window.location.pathname);
            } else if (msg === 'status') {
                alert('Status mata pelajaran berhasil diubah!');
                window.history.replaceState({}, document.title, window.location.pathname);
            } else if (msg) {
                alert('Pesan: ' + decodeURIComponent(msg));
            }
        });

        function setStatusFilter(status) {
            selectedStatusFilter = status;
            document.getElementById('filterActive').classList.toggle('active', status === 'active');
            document.getElementById('filterInactive').classList.toggle('active', status === 'inactive');
            applyFilters();
        }

        function applyFilters() {
            // Apply filtering manually to match DataTable or just row visibility if using raw JS
            // But since we use DataTable, we should use its search API if possible, OR if we want to filter by attribute like in paketLes.php:
            // The previous implementation used DataTables custom search extension.
            // Let's stick to the previous robust logical approach but using the new UI triggers.
            
            // We need to re-add the custom search function for DataTables
            $.fn.dataTable.ext.search.pop(); // Remove old if any
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                 // Get the row node to access custom attributes
                 const row = tableMapelAdmin.row(dataIndex).node();
                 const status = row.getAttribute('data-status');
                 return status === selectedStatusFilter;
            });
            
            if(tableMapelAdmin) tableMapelAdmin.draw();
        }

        // =========================================================
        // RENDER HELPERS
        // =========================================================

        function renderPengajarCheckboxes(selectedPengajarIds = []) {
            const container = document.getElementById('pengajarList');
            const empty = document.getElementById('pengajarEmpty');

            container.innerHTML = '';

            if (pengajarAktifData.length === 0) {
                empty.style.display = 'block';
                return;
            }

            empty.style.display = 'none';

            pengajarAktifData.forEach(pengajar => {
                const pId = String(pengajar.id_pengajar);
                const isChecked = selectedPengajarIds.some(id => String(id) === pId);
                
                const checkboxHtml = `
                    <label class="checkbox-item">
                        <input type="checkbox" 
                               name="pengajar_ids[]" 
                               value="${escapeHtml(pengajar.id_pengajar)}" 
                               ${isChecked ? 'checked' : ''}>
                        <span>${escapeHtml(pengajar.nama_pengajar)}</span>
                    </label>
                `;
                container.insertAdjacentHTML('beforeend', checkboxHtml);
            });
        }

        // =========================================================
        // MODAL FUNCTIONS
        // =========================================================

        function openAddSubjectModal() {
            document.getElementById('input_handlerType').value = 'tambahMapel';
            document.getElementById('input_id_mapel').value = '';
            document.getElementById('subjectModalTitle').textContent = 'Tambah Mata Pelajaran';
            
            // Reset fields
            document.getElementById('input_subjectName').value = '';
            document.getElementById('input_description').value = '';
            document.getElementById('input_status').value = 'active';

            renderPengajarCheckboxes([]); // No checked items
            
            document.getElementById('subjectModal').classList.add('show');
        }

        function editSubject(btnEl) {
            const row = btnEl.closest('tr');
            if (!row) return;

            const id = row.getAttribute('data-id');
            const nama = row.getAttribute('data-nama');
            const desc = row.getAttribute('data-deskripsi');
            const status = row.getAttribute('data-status');
            const pengajarIdsJson = row.getAttribute('data-pengajar-ids');
            let pengajarIds = [];
            
            try {
                pengajarIds = JSON.parse(pengajarIdsJson) || [];
            } catch (e) {
                console.error("Invalid pengajar JSON", e);
            }
            
            // Set form for edit
            document.getElementById('input_handlerType').value = 'editMapel';
            document.getElementById('input_id_mapel').value = id;
            document.getElementById('subjectModalTitle').textContent = 'Edit Mata Pelajaran';
            
            // Fill fields
            document.getElementById('input_subjectName').value = nama;
            document.getElementById('input_description').value = desc;
            document.getElementById('input_status').value = status;
            
            // Render checkboxes with selected IDs
            renderPengajarCheckboxes(pengajarIds);
            
            document.getElementById('subjectModal').classList.add('show');
        }

        function closeSubjectModal() {
            document.getElementById('subjectModal').classList.remove('show');
        }

        // =========================================================
        // TOGGLE STATUS
        // =========================================================

        function toggleSubjectStatus(id, newStatusVal) {
            const action = newStatusVal === 1 ? 'mengaktifkan' : 'menonaktifkan';
            if (!confirm('Apakah Anda yakin ingin ' + action + ' mata pelajaran ini?')) return;

            document.getElementById('toggle_id_mapel').value = id;
            document.getElementById('toggle_status_val').value = newStatusVal;
            
            document.getElementById('toggleStatusForm').submit();
        }
    </script>
</html>
