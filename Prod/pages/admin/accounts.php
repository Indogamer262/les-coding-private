<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Kelola Akun</title>
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

            .pageHeader h2 {
                margin: 0;
            }

            .pageHeader p {
                margin: 5px 0 0 0;
                color: #666;
                font-size: 14px;
            }

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

            .btn-primary:hover {
                background-color: #1d4ed8;
            }

            .tableCard {
                background-color: white;
                box-shadow: 0 0 10px 0 lightgray;
                border-radius: 8px;
                padding: 24px;
            }

            .tableCard h3 {
                margin: 0 0 16px 0;
            }

            .filterRow {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                align-items: flex-end;
                margin-bottom: 16px;
            }

            .filterGroup {
                display: flex;
                flex-direction: column;
                gap: 4px;
            }

            .filterGroup label {
                font-size: 12px;
                color: #666;
            }

            .filterGroup select, .filterGroup input {
                padding: 8px 12px;
                border: 1px solid #ddd;
                border-radius: 6px;
                font-size: 14px;
            }

            .filterGroup select:focus, .filterGroup input:focus {
                outline: none;
                border-color: #2563eb;
            }

            .spacer {
                flex: 1;
            }

            table.dataTable {
                width: 100% !important;
                border-collapse: collapse;
            }

            table.dataTable th, table.dataTable td {
                border: none;
                padding: 12px;
                text-align: left;
            }

            table.dataTable thead th {
                background-color: #f9fafb;
                font-weight: 600;
                font-size: 12px;
                text-transform: uppercase;
                color: #666;
            }

            table.dataTable tbody tr:hover {
                background-color: #f9fafb;
            }

            .badge {
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 500;
            }

            .badge-murid { background-color: #dbeafe; color: #1d4ed8; }
            .badge-pengajar { background-color: #d1fae5; color: #047857; }
            .badge-admin { background-color: #e9d5ff; color: #7c3aed; }
            .badge-aktif { background-color: #dcfce7; color: #15803d; }
            .badge-nonaktif { background-color: #f3f4f6; color: #374151; }

            .btn-edit {
                background-color: #eab308;
                color: white;
                border: none;
                padding: 4px 12px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 12px;
            }

            .btn-edit:hover {
                background-color: #ca8a04;
            }

            .btn-toggle {
                background-color: #f3f4f6;
                color: #374151;
                border: 1px solid #ddd;
                padding: 4px 12px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 12px;
            }

            .btn-toggle:hover {
                background-color: #e5e7eb;
            }

            .btn-toggle.aktifkan {
                background-color: #2563eb;
                color: white;
                border: none;
            }

            .btn-toggle.aktifkan:hover {
                background-color: #1d4ed8;
            }

            .actionBtns {
                display: flex;
                gap: 8px;
                justify-content: center;
            }

            /* Modal Styles */
            .modal-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0,0,0,0.5);
                display: none;
                justify-content: center;
                align-items: center;
                z-index: 100;
            }

            .modal-overlay.show {
                display: flex;
            }

            .modal {
                background: white;
                border-radius: 10px;
                width: 90%;
                max-width: 500px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            }

            .modal-header {
                padding: 16px 20px;
                border-bottom: 1px solid #eee;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .modal-header h3 {
                margin: 0;
            }

            .modal-close {
                background: none;
                border: none;
                font-size: 24px;
                cursor: pointer;
                color: #999;
            }

            .modal-close:hover {
                color: #333;
            }

            .modal-body {
                padding: 20px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-group label {
                display: block;
                margin-bottom: 6px;
                font-size: 14px;
                font-weight: 500;
            }

            .form-group input, .form-group select {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #ddd;
                border-radius: 6px;
                font-size: 14px;
                box-sizing: border-box;
            }

            .form-group input:focus, .form-group select:focus {
                outline: none;
                border-color: #2563eb;
            }

            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .modal-footer {
                padding: 16px 20px;
                border-top: 1px solid #eee;
                display: flex;
                justify-content: flex-end;
                gap: 10px;
            }

            .btn-cancel {
                background: white;
                border: 1px solid #ddd;
                padding: 8px 16px;
                border-radius: 6px;
                cursor: pointer;
            }

            .btn-cancel:hover {
                background: #f9fafb;
            }

            .btn-save {
                background-color: #2563eb;
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 6px;
                cursor: pointer;
            }

            .btn-save:hover {
                background-color: #1d4ed8;
            }

            .row-inactive {
                opacity: 0.6;
            }

            @media only screen and (max-width: 800px) {
                body {
                    display: block;
                }

                .main {
                    padding: 20px;
                    overflow: visible;
                }

                .pageHeader {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 12px;
                }

                .filterRow {
                    flex-direction: column;
                    align-items: stretch;
                }

                .form-row {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <!-- Header bar layout -->
        <?php include('occurence/navbar.php'); ?>

        <!-- Sidebar Layout -->
        <?php include('pages/admin/sidebar.php'); ?>
        
        <!-- Main content layout -->
        <div class="main poppins-regular">
            <div class="pageHeader">
                <div>
                    <h2>Kelola Akun</h2>
                    <p>Kelola akun Murid dan Pengajar</p>
                </div>
                <button class="btn-primary" onclick="openAddModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <line x1="19" x2="19" y1="8" y2="14"></line>
                        <line x1="22" x2="16" y1="11" y2="11"></line>
                    </svg>
                    Tambah Akun
                </button>
            </div>

            <div class="tableCard">
                <h3>Daftar Akun</h3>
                <div class="filterRow">
                    <div class="filterGroup">
                        <label>Akun</label>
                        <select id="filterRole" onchange="applyFilters()">
                            <option value="all">Semua</option>
                            <option value="murid">Murid</option>
                            <option value="pengajar">Pengajar</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="filterGroup">
                        <label>Status</label>
                        <select id="filterStatus" onchange="applyFilters()">
                            <option value="all">Semua</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <div class="spacer"></div>
                    <div class="filterGroup">
                        <label>Cari</label>
                        <input type="text" id="searchInput" placeholder="Cari nama atau email..." oninput="applyFilters()">
                    </div>
                </div>
                <table id="accountsTb" class="display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th style="text-align:center;">Role</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="accountsTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("admin","accounts"); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah/Edit Akun -->
        <div class="modal-overlay" id="accountModal">
            <div class="modal">
                <div class="modal-header">
                    <h3 id="modalTitle">Tambah Akun Baru</h3>
                    <button class="modal-close" onclick="closeModal()">&times;</button>
                </div>
                <form id="accountForm" onsubmit="handleSubmit(event)">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" required>
                                    <option value="murid">Murid</option>
                                    <option value="pengajar">Pengajar</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="email@example.com" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Minimal 8 karakter">
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="confirm_password" placeholder="Ulangi password">
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
        let dataTable;

        $(document).ready(function() {
            dataTable = new DataTable('#accountsTb', {
                scrollX: true,
                pageLength: 10,
                language: {
                    search: "",
                    searchPlaceholder: "Cari...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });

        function applyFilters() {
            const roleFilter = document.getElementById('filterRole').value;
            const statusFilter = document.getElementById('filterStatus').value;
            const searchQuery = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#accountsTableBody tr');
            
            rows.forEach(row => {
                const role = row.getAttribute('data-role');
                const status = row.getAttribute('data-status');
                const text = row.textContent.toLowerCase();
                
                let visible = true;
                
                if (roleFilter !== 'all' && role !== roleFilter) visible = false;
                if (statusFilter !== 'all' && status !== statusFilter) visible = false;
                if (searchQuery && !text.includes(searchQuery)) visible = false;
                
                row.style.display = visible ? '' : 'none';
            });
        }

        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Akun Baru';
            document.getElementById('accountForm').reset();
            document.getElementById('accountModal').classList.add('show');
        }

        function editAccount(id) {
            document.getElementById('modalTitle').textContent = 'Edit Akun';
            document.getElementById('accountModal').classList.add('show');
            // TODO: Load account data
        }

        function closeModal() {
            document.getElementById('accountModal').classList.remove('show');
        }

        function handleSubmit(event) {
            event.preventDefault();
            alert('Akun berhasil disimpan!');
            closeModal();
        }

        function toggleStatus(id, btn) {
            const row = btn.closest('tr');
            const currentStatus = row.getAttribute('data-status');
            const newStatus = currentStatus === 'aktif' ? 'nonaktif' : 'aktif';
            const action = newStatus === 'aktif' ? 'mengaktifkan' : 'menonaktifkan';
            
            if (!confirm('Apakah Anda yakin ingin ' + action + ' akun ini?')) return;

            row.setAttribute('data-status', newStatus);
            row.classList.toggle('row-inactive', newStatus === 'nonaktif');

            const badge = row.querySelector('.badge-aktif, .badge-nonaktif');
            if (badge) {
                badge.textContent = newStatus === 'aktif' ? 'Aktif' : 'Nonaktif';
                badge.className = 'badge ' + (newStatus === 'aktif' ? 'badge-aktif' : 'badge-nonaktif');
            }

            btn.textContent = newStatus === 'aktif' ? 'Nonaktifkan' : 'Aktifkan';
            btn.classList.toggle('aktifkan', newStatus === 'nonaktif');

            alert('Status berhasil diubah!');
            applyFilters();
        }

        // Close modal on overlay click
        document.getElementById('accountModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</html>
