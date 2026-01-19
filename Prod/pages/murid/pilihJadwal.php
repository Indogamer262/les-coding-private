<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<?php
    // Frontend by 2472008, member of "Les Coding Private" Team
    
    // Check if called directly or via controller
    if (!isset($lesCodingUtil)) {
        header("Location: ../../index.php");
        exit;
    }

    $role = $_SESSION['loginRoles'] ?? '';
    if ($role != 'murid') {
        header("Location: ../../index.php");
        exit;
    }
    
    $id_murid = $_SESSION['loginID'];
    // Logic to get active package info
    $packageDetails = $lesCodingUtil->db->readingQuery("SELECT k.nama_paket, (k.jml_pertemuan - p.pertemuan_terpakai) as sisa, k.jml_pertemuan, DATEDIFF(p.tgl_kedaluwarsa, CURDATE()) as sisa_hari FROM paketdibeli p JOIN katalogpaket k ON p.id_paket = k.id_paket WHERE id_murid = '$id_murid' AND tgl_kedaluwarsa >= CURDATE() AND (jml_pertemuan - pertemuan_terpakai) > 0 ORDER BY tgl_kedaluwarsa ASC LIMIT 1");
    
    $activePackage = $packageDetails[0]['nama_paket'] ?? null;
    $sisa = $packageDetails[0]['sisa'] ?? 0;
    $total = $packageDetails[0]['jml_pertemuan'] ?? 0;
    $hari = $packageDetails[0]['sisa_hari'] ?? 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pilih Jadwal</title>
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
            
            .btn-orange {
                 /* mimicking tailwind-like custom class if needed, but mostly using bg-orange-500 in HTML now */
            }
        </style>
    </head>
    <body>
        <?php include('occurence/navbar.php'); ?>
        <?php include('pages/murid/sidebar.php'); ?>
        
        <div class="main poppins-regular">
            <div class="flex flex-col gap-6">
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Pilih Jadwal</h1>
                        <p class="text-sm text-gray-600 mt-1">Pilih jadwal les dari paket yang telah dibeli</p>
                    </div>
                </div>

                <!-- Paket Aktif Info -->
                <?php if($activePackage): ?>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <h3 class="font-semibold text-blue-800">Paket Aktif: <?php echo htmlspecialchars($activePackage); ?></h3>
                            <p class="text-sm text-blue-600 mt-1">Sisa pertemuan: <span class="font-bold"><?php echo $sisa; ?> dari <?php echo $total; ?></span> | Masa aktif: <span class="font-bold"><?php echo $hari; ?> hari lagi</span></p>
                        </div>
                        <a href="?page=paketSaya" class="text-sm text-blue-600 hover:text-blue-800 underline">Lihat semua paket →</a>
                    </div>
                </div>
                <?php else: ?>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                     <p class="text-sm text-yellow-800">Anda belum memiliki paket aktif. Silakan <a href="?page=paketLes" class="underline font-bold">beli paket</a> terlebih dahulu.</p>
                </div>
                <?php endif; ?>

                <!-- Jadwal Tersedia Table -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <h2 class="text-lg font-semibold text-gray-800">Jadwal Tersedia</h2>

                        <!-- Filters -->
                         <div id="jadwalDtFilters" class="flex flex-wrap items-center gap-3">
                            <div class="flex items-center gap-2">
                                <label class="text-sm whitespace-nowrap">Periode</label>
                                <select id="filterPeriode" onchange="applyFiltersTersedia()" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="all" <?php echo ($_GET['periode'] ?? '') == 'all' ? 'selected' : ''; ?>>Semua</option>
                                    <option value="today" <?php echo ($_GET['periode'] ?? '') == 'today' ? 'selected' : ''; ?>>Hari Ini</option>
                                    <option value="week" <?php echo ($_GET['periode'] ?? 'week') == 'week' ? 'selected' : ''; ?>>Minggu Ini</option>
                                    <option value="month" <?php echo ($_GET['periode'] ?? '') == 'month' ? 'selected' : ''; ?>>Bulan Ini</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="px-6 py-6">
                        <table id="tableJadwalTersedia" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Hari & Waktu</th>
                                    <th class="px-6 py-3">Pengajar</th>
                                    <th class="px-6 py-3">Mata Pelajaran</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tersediaTableBody">
                                <?php 
                                    $filters = ['periode' => $_GET['periode'] ?? 'week'];
                                    echo $lesCodingUtil->renderTableBody("murid", "jadwaltersedia", $filters); 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Jadwal yang Sudah Dipilih -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <h2 class="text-lg font-semibold text-gray-800">Jadwal Saya</h2>
                    </div>
                    <div class="px-6 py-6">
                        <table id="tableJadwalDipilih" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Hari & Waktu</th>
                                    <th class="px-6 py-3">Pengajar</th>
                                    <th class="px-6 py-3">Mata Pelajaran</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $lesCodingUtil->renderTableBody("murid","jadwaldipilih"); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konfirmasi Pilih Jadwal Modal -->
        <div id="pilihJadwalModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full mx-4">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-800">Konfirmasi Pilih Jadwal</h3>
                    <button type="button" onclick="closePilihModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form action="../../submissionHandler.php" method="POST">
                    <input type="hidden" name="handlerType" value="pilihJadwal">
                    <input type="hidden" name="kodeJadwal" id="pilihKodeJadwal" value="">

                    <div class="p-6 space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal:</span>
                                <span id="modalJadwalTanggal" class="font-semibold text-gray-800">-</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Waktu:</span>
                                <span id="modalJadwalWaktu" class="font-medium text-gray-800">-</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pengajar:</span>
                                <span id="modalJadwalPengajar" class="font-medium text-gray-800">-</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Mata Pelajaran:</span>
                                <span id="modalJadwalMapel" class="font-medium text-gray-800">-</span>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-sm text-yellow-800">
                                <strong>Perhatian:</strong> Setelah memilih jadwal, pertemuan ini akan mengurangi sisa pertemuan paket Anda.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                        <button type="button" onclick="closePilihModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-medium transition-colors">Pilih Jadwal</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Konfirmasi Batalkan Jadwal Modal -->
        <div id="batalJadwalModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full mx-4">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-800">Batalkan Jadwal</h3>
                    <button type="button" onclick="closeBatalModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form action="../../submissionHandler.php" method="POST">
                    <input type="hidden" name="handlerType" value="batalJadwal">
                    <input type="hidden" name="kodeJadwal" id="batalKodeJadwal" value="">
                    
                    <div class="p-6 space-y-4">
                        <p class="text-gray-700">Apakah Anda yakin ingin membatalkan jadwal ini?</p>
                        
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal:</span>
                                <span id="modalBatalTanggal" class="font-semibold text-gray-800">-</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Waktu:</span>
                                <span id="modalBatalWaktu" class="font-medium text-gray-800">-</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Mata Pelajaran:</span>
                                <span id="modalBatalMapel" class="font-medium text-gray-800">-</span>
                            </div>
                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="text-sm text-green-800">
                                Sisa pertemuan Anda akan dikembalikan setelah pembatalan.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                        <button type="button" onclick="closeBatalModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Tidak</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">Ya, Batalkan</button>
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
                            if($_GET['msg'] == 'success') echo "Jadwal berhasil dipilih!";
                            else if($_GET['msg'] == 'canceled') echo "Jadwal berhasil dibatalkan!";
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
            $(document).ready(function() {
                // Initialize DataTable but we'll use custom search filtering
                var tableTersedia = $('#tableJadwalTersedia').DataTable({
                    scrollX: true,
                    ordering: false
                });
                
                var tableDipilih = $('#tableJadwalDipilih').DataTable({
                    scrollX: true,
                    ordering: false
                });
                

            });
            


            function applyFiltersTersedia() {
                var period = document.getElementById('filterPeriode').value;
                // Reload for period (server side filter)
                window.location.href = `?periode=${period}`;
            }
            
            // For Mapel, we can just redraw table to trigger client side filter


            function openPilihModal(id, tanggal, waktu, pengajar, mapel) {
                document.getElementById('pilihKodeJadwal').value = id;
                document.getElementById('modalJadwalTanggal').textContent = tanggal;
                document.getElementById('modalJadwalWaktu').textContent = waktu;
                document.getElementById('modalJadwalPengajar').textContent = pengajar;
                document.getElementById('modalJadwalMapel').textContent = mapel;
                
                document.getElementById('pilihJadwalModal').classList.remove('hidden');
                document.getElementById('pilihJadwalModal').classList.add('flex');
            }

            function closePilihModal() {
                document.getElementById('pilihJadwalModal').classList.add('hidden');
                document.getElementById('pilihJadwalModal').classList.remove('flex');
            }

            function openBatalModal(id, tanggal, waktu, mapel) {
                document.getElementById('batalKodeJadwal').value = id;
                document.getElementById('modalBatalTanggal').textContent = tanggal;
                document.getElementById('modalBatalWaktu').textContent = waktu;
                document.getElementById('modalBatalMapel').textContent = mapel;
                
                document.getElementById('batalJadwalModal').classList.remove('hidden');
                document.getElementById('batalJadwalModal').classList.add('flex');
            }

            function closeBatalModal() {
                document.getElementById('batalJadwalModal').classList.add('hidden');
                document.getElementById('batalJadwalModal').classList.remove('flex');
            }
            
            function closeMsgModal() {
                const url = new URL(window.location.href);
                url.searchParams.delete("msg");
                window.history.replaceState({}, document.title, url.toString());
                document.getElementById('msgModal').remove();
            }

            document.getElementById('pilihJadwalModal').addEventListener('click', function(e) { if (e.target === this) closePilihModal(); });
            document.getElementById('batalJadwalModal').addEventListener('click', function(e) { if (e.target === this) closeBatalModal(); });
            document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closePilihModal(); closeBatalModal(); } });
        </script>
    </body>
</html>
