<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<?php
    // Frontend by 2472008, member of "Les Coding Private" Team
    
    // Check if called directly or via controller
    if (!isset($lesCodingUtil)) {
        header("Location: ../../index.php");
        exit;
    }

    $role = $_SESSION['loginRoles'] ?? '';
    if ($role != 'admin') {
        header("Location: ../../index.php");
        exit;
    }

    // Fetch Lists for Dropdowns
    $listPengajar = $lesCodingUtil->db->readingQuery("SELECT id_pengajar, nama_pengajar FROM pengajar WHERE status = 1 ORDER BY nama_pengajar ASC");
    $listMapel = $lesCodingUtil->db->readingQuery("SELECT id_mapel, nama_mapel FROM mata_pelajaran WHERE status = 1 ORDER BY nama_mapel ASC");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Kelola Jadwal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>

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
                font-family: "Poppins", sans-serif;
            }
            
            .main { grid-area: content; padding: 20px; overflow-y: auto; }
            .pageHeader { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }

            /* Overrides/Fixes for DataTables with Tailwind */
            .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
                color: #374151; /* gray-700 */
                margin-top: 1rem;
                font-size: 0.875rem;
            }
            .dataTables_wrapper .dataTables_length select {
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                padding: 0.25rem 2rem 0.25rem 0.5rem;
                background-color: #fff;
            }
            .dataTables_wrapper .dataTables_filter input {
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                padding: 0.25rem 0.5rem;
                margin-left: 0.5rem;
            }
             table.dataTable.no-footer {
                border-bottom: 1px solid #e5e7eb;
            }

            @media only screen and (max-width: 800px) {
                body { display: block; }
                .main { padding: 20px; overflow: visible; }
            }
        </style>
    </head>
    <body>
        <?php include('occurence/navbar.php'); ?>
        <?php include('pages/admin/sidebar.php'); ?>
        
        <div class="main poppins-regular">
            <div class="flex flex-col gap-6">
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Kelola Jadwal</h1>
                        <p class="text-sm text-gray-600 mt-1">Kelola jadwal les untuk pengajar dan murid</p>
                    </div>
                    <button onclick="openScheduleModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                            <line x1="16" x2="16" y1="2" y2="6"></line>
                            <line x1="8" x2="8" y1="2" y2="6"></line>
                            <line x1="3" x2="21" y1="10" y2="10"></line>
                            <path d="M8 14h.01"></path>
                            <path d="M12 14h.01"></path>
                            <path d="M16 14h.01"></path>
                        </svg>
                        Buat Jadwal Baru
                    </button>
                </div>

                <!-- Schedules Table -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <h2 class="text-lg font-semibold text-gray-800">Daftar Jadwal</h2>

                        <!-- Filters -->
                        <div id="jadwalDtFilters" class="flex flex-wrap items-center gap-3">
                            <div class="flex items-center gap-2">
                                <label class="text-sm whitespace-nowrap">Periode</label>
                                <select id="filterPeriode" onchange="applyFilters()" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="all" <?php echo ($_GET['periode'] ?? '') == 'all' ? 'selected' : ''; ?>>Semua</option>
                                    <option value="today" <?php echo ($_GET['periode'] ?? '') == 'today' ? 'selected' : ''; ?>>Hari Ini</option>
                                    <option value="week" <?php echo ($_GET['periode'] ?? '') == 'week' ? 'selected' : ''; ?>>Minggu Ini</option>
                                    <option value="month" <?php echo ($_GET['periode'] ?? 'month') == 'month' ? 'selected' : ''; ?>>Bulan Ini</option>
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <label class="text-sm whitespace-nowrap">Status</label>
                                <select id="filterStatus" onchange="applyFilters()" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="all" <?php echo ($_GET['status'] ?? '') == 'all' ? 'selected' : ''; ?>>Semua</option>
                                    <option value="terisi" <?php echo ($_GET['status'] ?? '') == 'terisi' ? 'selected' : ''; ?>>Terisi</option>
                                    <option value="belum" <?php echo ($_GET['status'] ?? '') == 'belum' ? 'selected' : ''; ?>>Belum Terisi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-6">
                        <table id="tableJadwalAdmin" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Hari & Waktu</th>
                                    <th class="px-6 py-3">Pengajar</th>
                                    <th class="px-6 py-3">Mata Pelajaran</th>
                                    <th class="px-6 py-3">Murid</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="jadwalTableBody">
                                <?php 
                                    // Pass filters from GET to renderTableBody
                                    $filters = [
                                        'periode' => $_GET['periode'] ?? 'month',
                                        'status' => $_GET['status'] ?? 'all',
                                        'sort' => $_GET['sort'] ?? 'terbaru'
                                    ];
                                    echo $lesCodingUtil->renderTableBody("admin", "jadwal", $filters); 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schedule Modal -->
        <div id="scheduleModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full mx-4">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-800" id="scheduleModalTitle">Buat Jadwal Baru</h3>
                    <button type="button" onclick="closeScheduleModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form id="scheduleForm" class="p-6 space-y-4" action="../../submissionHandler.php" method="POST">
                    <input type="hidden" name="handlerType" id="handlerType" value="tambahJadwal">
                    <input type="hidden" name="kodeJadwal" id="kodeJadwal" value="">

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pengajar</label>
                            <select name="pengajar" id="inputPengajar" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">-- Pilih Pengajar --</option>
                                <?php foreach($listPengajar as $p): ?>
                                    <option value="<?php echo $p['id_pengajar']; ?>"><?php echo htmlspecialchars($p['nama_pengajar']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                            <select name="mapel" id="inputMapel" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                <?php foreach($listMapel as $m): ?>
                                    <option value="<?php echo $m['id_mapel']; ?>"><?php echo htmlspecialchars($m['nama_mapel']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                            <input type="date" name="tanggal" id="scheduleTanggal" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="updateHariFromTanggal(this.value)">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Hari</label>
                            <input type="text" name="hari" id="scheduleHari" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600" placeholder="Otomatis dari tanggal" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                            <input type="time" name="jamMulai" id="inputJamMulai" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                            <input type="time" name="jamSelesai" id="inputJamSelesai" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                    
                     <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3 -mx-6 -mb-6 mt-4">
                        <button type="button" onclick="closeScheduleModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        
         <!-- Modal Delete Confirmation -->
         <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-2xl max-w-sm w-full mx-4">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-800">Hapus Jadwal</h3>
                    <button type="button" onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form action="../../submissionHandler.php" method="POST">
                    <input type="hidden" name="handlerType" value="hapusJadwal">
                    <input type="hidden" name="kodeJadwal" id="deleteKodeJadwal" value="">
                    
                    <div class="p-6">
                        <p class="text-gray-700">Apakah Anda yakin ingin menghapus jadwal ini? Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                        <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Success/Error Modal -->
        <?php if(isset($_GET['msg'])): ?>
        <div id="msgModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-2xl max-w-sm w-full mx-4">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-800">Informasi</h3>
                    <button type="button" onclick="closeMsgModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <p class="text-gray-700">
                        <?php 
                            if($_GET['msg'] == 'success') echo "Jadwal berhasil ditambahkan!";
                            else if($_GET['msg'] == 'edit') echo "Jadwal berhasil diperbarui!";
                            else if($_GET['msg'] == 'delete') echo "Jadwal berhasil dihapus!";
                            else echo "Terjadi kesalahan: " . htmlspecialchars(urldecode($_GET['msg']));
                        ?>
                    </p>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
                    <button type="button" onclick="closeMsgModal()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">OK</button>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
        <script>
            const hariNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            $(document).ready(function() {
                $('#tableJadwalAdmin').DataTable({
                    scrollX: true,
                    ordering: false // Sorting handled by backend filter
                });
            });

            function updateHariFromTanggal(dateValue) {
                if (!dateValue) {
                    document.getElementById('scheduleHari').value = '';
                    return;
                }
                const date = new Date(dateValue);
                const dayIndex = date.getDay();
                document.getElementById('scheduleHari').value = hariNames[dayIndex];
            }

            function applyFilters() {
                const period = document.getElementById('filterPeriode').value;
                const status = document.getElementById('filterStatus').value;
                
                // Reload page with query params
                window.location.href = `?periode=${period}&status=${status}`;
            }

            function openScheduleModal() {
                document.getElementById('scheduleForm').reset();
                document.getElementById('handlerType').value = 'tambahJadwal';
                document.getElementById('kodeJadwal').value = '';
                document.getElementById('scheduleHari').value = '';
                
                document.getElementById('inputPengajar').disabled = false;
                document.getElementById('inputMapel').disabled = false;
                
                document.getElementById('scheduleModal').classList.remove('hidden');
                document.getElementById('scheduleModal').classList.add('flex');
                document.getElementById('scheduleModalTitle').textContent = 'Buat Jadwal Baru';
            }

            function editSchedule(kode, tanggal, jamMulai, jamSelesai) {
                // Note: param names in click handler: editJadwal
                // I renamed function to editSchedule to match Reference style but careful with DB output
                // The DB output PHP calls 'editJadwal'. I should name this function 'editJadwal'.
            }

             function editJadwal(kode, tanggal, jamMulai, jamSelesai) {
                document.getElementById('scheduleModal').classList.remove('hidden');
                document.getElementById('scheduleModal').classList.add('flex');
                document.getElementById('scheduleModalTitle').textContent = 'Edit Jadwal';
                
                document.getElementById('handlerType').value = 'editJadwal';
                document.getElementById('kodeJadwal').value = kode;
                
                document.getElementById('scheduleTanggal').value = tanggal;
                document.getElementById('inputJamMulai').value = jamMulai;
                document.getElementById('inputJamSelesai').value = jamSelesai;
                updateHariFromTanggal(tanggal);

                // Admin cannot edit Pengajar/Mapel via SP_EditJadwal_Admin currently
                document.getElementById('inputPengajar').disabled = true;
                document.getElementById('inputMapel').disabled = true;
             }

            function closeScheduleModal() {
                document.getElementById('scheduleModal').classList.add('hidden');
                document.getElementById('scheduleModal').classList.remove('flex');
            }
            
            function deleteJadwal(kode) {
                 document.getElementById('deleteKodeJadwal').value = kode;
                 document.getElementById('deleteModal').classList.remove('hidden');
                 document.getElementById('deleteModal').classList.add('flex');
            }
            
            function closeDeleteModal() {
                 document.getElementById('deleteModal').classList.add('hidden');
                 document.getElementById('deleteModal').classList.remove('flex');
            }

            function closeMsgModal() {
                const url = new URL(window.location.href);
                url.searchParams.delete("msg");
                window.history.replaceState({}, document.title, url.toString());
                document.getElementById('msgModal').remove();
            }

            document.getElementById('scheduleModal').addEventListener('click', function(e) { if (e.target === this) closeScheduleModal(); });
            document.getElementById('deleteModal').addEventListener('click', function(e) { if (e.target === this) closeDeleteModal(); });
            document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closeScheduleModal(); closeDeleteModal(); } });
        </script>
    </body>
</html>
