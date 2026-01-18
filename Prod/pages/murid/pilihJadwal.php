<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Pilih Jadwal</title>
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

            .info-box { background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 16px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
            .info-box h3 { margin: 0; color: #1e40af; font-size: 16px; }
            .info-box p { margin: 4px 0 0 0; color: #1e40af; font-size: 14px; }
            .info-box a { color: #2563eb; font-size: 14px; }

            .tableCard { background-color: white; box-shadow: 0 0 10px 0 lightgray; border-radius: 8px; padding: 24px; margin-bottom: 20px; }
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

            .btn-pilih { background-color: #f97316; color: white; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .btn-pilih:hover { background-color: #ea580c; }
            .btn-batal { background-color: #dc2626; color: white; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .btn-batal:hover { background-color: #b91c1c; }

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

            .warning-box { background-color: #fffbeb; border: 1px solid #fbbf24; border-radius: 8px; padding: 12px; margin-bottom: 16px; }
            .warning-box p { margin: 0; font-size: 13px; color: #92400e; }
            .success-box { background-color: #dcfce7; border: 1px solid #86efac; border-radius: 8px; padding: 12px; margin-bottom: 16px; }
            .success-box p { margin: 0; font-size: 13px; color: #166534; }

            .btn-cancel { background: white; border: 1px solid #ddd; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-cancel:hover { background: #f9fafb; }
            .btn-save { background-color: #f97316; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-save:hover { background-color: #ea580c; }
            .btn-danger { background-color: #dc2626; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-danger:hover { background-color: #b91c1c; }

            @media only screen and (max-width: 800px) {
                body { display: block; }
                .main { padding: 20px; overflow: visible; }
                .filterRow { flex-direction: column; align-items: stretch; }
            }
        </style>
    </head>
    <body>
        <?php include('occurence/navbar.php'); ?>
        <?php include('pages/murid/sidebar.php'); ?>
        
        <div class="main poppins-regular">
            <div class="pageHeader">
                <h2>Pilih Jadwal</h2>
                <p>Pilih jadwal les dari paket yang telah dibeli</p>
            </div>

            <div class="info-box">
                <div>
                    <h3>Paket Aktif: <?php echo "Paket 8 Pertemuan"; ?></h3>
                    <p>Sisa pertemuan: <strong><?php echo "5"; ?></strong> dari <strong><?php echo "8"; ?></strong> | Masa aktif: <strong><?php echo "28"; ?> hari lagi</strong></p>
                </div>
                <a href="?page=paketSaya">Lihat semua paket →</a>
            </div>

            <div class="tableCard">
                <h3>Jadwal Tersedia</h3>
                <div class="filterRow">
                    <div class="filterGroup">
                        <label>Periode</label>
                        <select id="filterPeriode" onchange="applyFiltersTersedia()">
                            <option value="all">Semua</option>
                            <option value="today">Hari Ini</option>
                            <option value="week" selected>Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
                        </select>
                    </div>
                    <div class="filterGroup">
                        <label>Mata Pelajaran</label>
                        <select id="filterMapel" onchange="applyFiltersTersedia()">
                            <option value="all">Semua</option>
                            <option value="python">Python</option>
                            <option value="javascript">JavaScript</option>
                            <option value="react">React.js</option>
                            <option value="nodejs">Node.js</option>
                        </select>
                    </div>
                    <div class="spacer"></div>
                </div>
                <table id="tersediaTb" class="display">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hari & Waktu</th>
                            <th>Pengajar</th>
                            <th>Mata Pelajaran</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tersediaTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("murid","jadwaltersedia"); ?>
                    </tbody>
                </table>
            </div>

            <div class="tableCard">
                <h3>Jadwal Saya</h3>
                <table id="dipilihTb" class="display">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hari & Waktu</th>
                            <th>Pengajar</th>
                            <th>Mata Pelajaran</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dipilihTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("murid","jadwaldipilih"); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Pilih Jadwal -->
        <div class="modal-overlay" id="pilihModal">
            <div class="modal">
                <div class="modal-header">
                    <h3>Konfirmasi Pilih Jadwal</h3>
                    <button class="modal-close" onclick="closePilihModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="detail-box">
                        <div class="detail-row"><span>Tanggal:</span><span id="modalTanggal">-</span></div>
                        <div class="detail-row"><span>Waktu:</span><span id="modalWaktu">-</span></div>
                        <div class="detail-row"><span>Pengajar:</span><span id="modalPengajar">-</span></div>
                        <div class="detail-row"><span>Mata Pelajaran:</span><span id="modalMapel">-</span></div>
                    </div>
                    <div class="warning-box">
                        <p><strong>Perhatian:</strong> Setelah memilih jadwal, pertemuan ini akan mengurangi sisa pertemuan paket Anda.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" onclick="closePilihModal()">Batal</button>
                    <button class="btn-save" onclick="konfirmasiPilih()">Pilih Jadwal</button>
                </div>
            </div>
        </div>

        <!-- Modal Batalkan Jadwal -->
        <div class="modal-overlay" id="batalModal">
            <div class="modal">
                <div class="modal-header">
                    <h3>Batalkan Jadwal</h3>
                    <button class="modal-close" onclick="closeBatalModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <p style="margin-bottom: 16px;">Apakah Anda yakin ingin membatalkan jadwal ini?</p>
                    <div class="detail-box">
                        <div class="detail-row"><span>Tanggal:</span><span id="modalBatalTanggal">-</span></div>
                        <div class="detail-row"><span>Waktu:</span><span id="modalBatalWaktu">-</span></div>
                        <div class="detail-row"><span>Mata Pelajaran:</span><span id="modalBatalMapel">-</span></div>
                    </div>
                    <div class="success-box">
                        <p>Sisa pertemuan Anda akan dikembalikan setelah pembatalan.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" onclick="closeBatalModal()">Tidak</button>
                    <button class="btn-danger" onclick="konfirmasiBatal()">Ya, Batalkan</button>
                </div>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        let currentJadwalId = null;
        let currentBatalId = null;

        $(document).ready(function() {
            new DataTable('#tersediaTb', { scrollX: true });
            new DataTable('#dipilihTb', { scrollX: true });
        });

        function applyFiltersTersedia() {
            const mapel = document.getElementById('filterMapel').value;
            const rows = document.querySelectorAll('#tersediaTableBody tr');
            rows.forEach(row => {
                const rowMapel = row.getAttribute('data-mapel');
                row.style.display = (mapel === 'all' || rowMapel === mapel) ? '' : 'none';
            });
        }

        function openPilihModal(id, tanggal, waktu, pengajar, mapel) {
            currentJadwalId = id;
            document.getElementById('modalTanggal').textContent = tanggal;
            document.getElementById('modalWaktu').textContent = waktu;
            document.getElementById('modalPengajar').textContent = pengajar;
            document.getElementById('modalMapel').textContent = mapel;
            document.getElementById('pilihModal').classList.add('show');
        }

        function closePilihModal() {
            document.getElementById('pilihModal').classList.remove('show');
        }

        function konfirmasiPilih() {
            alert('Jadwal berhasil dipilih!');
            closePilihModal();
        }

        function openBatalModal(id, tanggal, waktu, mapel) {
            currentBatalId = id;
            document.getElementById('modalBatalTanggal').textContent = tanggal;
            document.getElementById('modalBatalWaktu').textContent = waktu;
            document.getElementById('modalBatalMapel').textContent = mapel;
            document.getElementById('batalModal').classList.add('show');
        }

        function closeBatalModal() {
            document.getElementById('batalModal').classList.remove('show');
        }

        function konfirmasiBatal() {
            alert('Jadwal berhasil dibatalkan!');
            closeBatalModal();
        }

        document.getElementById('pilihModal').addEventListener('click', function(e) { if (e.target === this) closePilihModal(); });
        document.getElementById('batalModal').addEventListener('click', function(e) { if (e.target === this) closeBatalModal(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closePilihModal(); closeBatalModal(); } });
    </script>
</html>
