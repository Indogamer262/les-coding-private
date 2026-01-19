<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<?php
    if (!isset($lesCodingUtil)) {
        header("Location: ../../index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Beli Paket</title>
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

            .paketGrid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-bottom: 24px; }
            .paketCard { background: white; border-radius: 10px; box-shadow: 0 0 10px 0 lightgray; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s; }
            .paketCard:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
            .paketHeader { background: #2563eb; color: white; padding: 16px 20px; }
            .paketHeader h3 { margin: 0; font-size: 18px; }
            .paketHeader p { margin: 4px 0 0 0; font-size: 12px; opacity: 0.9; }
            .paketBody { padding: 20px; }
            .paketPrice { font-size: 28px; font-weight: 700; color: #1f2937; text-align: center; margin-bottom: 16px; }
            .paketFeatures { list-style: none; padding: 0; margin: 0 0 16px 0; }
            .paketFeatures li { display: flex; align-items: center; gap: 8px; padding: 6px 0; font-size: 14px; color: #4b5563; }
            .paketFeatures li svg { color: #10b981; flex-shrink: 0; }
            .btn-beli { width: 100%; background: #2563eb; color: white; border: none; padding: 12px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; }
            .btn-beli:hover { background: #1d4ed8; }

            .tableCard { background-color: white; box-shadow: 0 0 10px 0 lightgray; border-radius: 8px; padding: 24px; }
            .tableCard h3 { margin: 0 0 16px 0; }

            .filterRow { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; margin-bottom: 16px; }
            .filterGroup { display: flex; flex-direction: column; gap: 4px; }
            .filterGroup label { font-size: 12px; color: #666; }
            .filterGroup select { padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
            .filterGroup select:focus { outline: none; border-color: #2563eb; }
            .spacer { flex: 1; }

            table.dataTable { width: 100% !important; border-collapse: collapse; }
            table.dataTable th, table.dataTable td { border: none; padding: 12px; text-align: left; }
            table.dataTable thead th { background-color: #f9fafb; font-weight: 600; font-size: 12px; text-transform: uppercase; color: #666; }
            table.dataTable tbody tr:hover { background-color: #f9fafb; }

            .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
            .badge-pending { background-color: #fef3c7; color: #b45309; }
            .badge-verifikasi { background-color: #dbeafe; color: #1d4ed8; }
            .badge-lunas { background-color: #dcfce7; color: #15803d; }
            .badge-ditolak { background-color: #fee2e2; color: #dc2626; }

            .btn-upload { background-color: #2563eb; color: white; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
            .btn-upload:hover { background-color: #1d4ed8; }

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
            .detail-row.border-top { border-top: 1px solid #ddd; padding-top: 10px; margin-top: 6px; }

            .info-box { background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 12px; margin-bottom: 16px; }
            .info-box h4 { margin: 0 0 8px 0; color: #1e40af; font-size: 14px; }
            .info-box p { margin: 0; font-size: 13px; color: #1e40af; }

            .form-group { margin-bottom: 16px; }
            .form-group label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 500; }
            .form-group input { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box; }

            .btn-cancel { background: white; border: 1px solid #ddd; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-cancel:hover { background: #f9fafb; }
            .btn-save { background-color: #2563eb; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; }
            .btn-save:hover { background-color: #1d4ed8; }

            @media only screen and (max-width: 800px) {
                body { display: block; }
                .main { padding: 20px; overflow: visible; }
                .paketGrid { grid-template-columns: 1fr; }
            }
        </style>
    </head>
    <body>
        <?php include('occurence/navbar.php'); ?>
        <?php include('pages/murid/sidebar.php'); ?>
        
        <div class="main poppins-regular">
            <div class="pageHeader">
                <h2>Beli Paket</h2>
                <p>Pilih paket les yang tersedia</p>
            </div>

            <div class="paketGrid">
                <?php echo $lesCodingUtil->renderTableBody("murid","paketdijual"); ?>
            </div>

            <div class="tableCard">
                <h3>Riwayat Pembelian</h3>
                <div class="filterRow">
                    <div class="filterGroup">
                        <label>Status</label>
                        <select id="filterStatus" onchange="applyFilters()">
                            <option value="all">Semua</option>
                            <option value="pending">Menunggu Pembayaran</option>
                            <option value="verifikasi">Menunggu Verifikasi</option>
                            <option value="lunas">Lunas</option>
                        </select>
                    </div>
                    <div class="spacer"></div>
                </div>
                <table id="pembelianTb" class="display">
                    <thead>
                        <tr>
                            <th>ID Pembelian</th>
                            <th>Tanggal</th>
                            <th>Paket</th>
                            <th>Harga</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pembelianTableBody">
                        <?php echo $lesCodingUtil->renderTableBody("murid","riwayatPembelianMurid"); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Beli -->
        <div class="modal-overlay" id="beliModal">
            <div class="modal">
                <div class="modal-header">
                    <h3>Konfirmasi Pembelian</h3>
                    <button class="modal-close" onclick="closeBeliModal()">&times;</button>
                </div>
                <form id="beliForm" method="POST" action="submissionHandler.php">
                    <input type="hidden" name="handlerType" value="beliPaket">
                    <input type="hidden" name="id_paket" id="modalPaketId" value="">
                    <div class="modal-body">
                        <div class="detail-box">
                            <div class="detail-row">
                                <span>Paket:</span>
                                <span id="modalPaketNama">-</span>
                            </div>
                            <div class="detail-row border-top">
                                <span>Total:</span>
                                <span id="modalPaketHarga" style="color: #2563eb; font-weight: 600;">-</span>
                            </div>
                        </div>
                        <div class="info-box">
                            <h4>Informasi Pembayaran</h4>
                            <p>Transfer ke rekening berikut:</p>
                            <p style="font-weight: 600; margin-top: 8px;">Bank BCA - 1234567890</p>
                            <p>a.n. Les Privat Coding</p>
                        </div>
                        <p style="font-size: 13px; color: #666;">Setelah melakukan pembayaran, silakan upload bukti pembayaran untuk diverifikasi oleh admin.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" onclick="closeBeliModal()">Batal</button>
                        <button type="submit" class="btn-save">Beli Paket</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Upload Bukti -->
        <div class="modal-overlay" id="uploadModal">
            <div class="modal">
                <div class="modal-header">
                    <h3>Upload Bukti Pembayaran</h3>
                    <button class="modal-close" onclick="closeUploadModal()">&times;</button>
                </div>
                <form id="uploadForm" method="POST" action="submissionHandler.php" enctype="multipart/form-data">
                    <input type="hidden" name="handlerType" value="uploadBukti">
                    <input type="hidden" name="id_pembelian" id="uploadPembelianId" value="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Bukti Pembayaran</label>
                            <input type="file" name="bukti" accept="image/*" required>
                            <p style="font-size: 12px; color: #999; margin-top: 4px;">Format: JPG, PNG, GIF maksimal 2MB</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" onclick="closeUploadModal()">Batal</button>
                        <button type="submit" class="btn-save">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        let currentPaketId = null;
        let currentPaketNama = '';
        let currentPaketHarga = 0;
        let currentUploadId = null;

        $(document).ready(function() {
            new DataTable('#pembelianTb', { scrollX: true });
            
            // Show alert messages if any
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.get('beli') === 'success') {
                alert('Pembelian berhasil dibuat! Silakan lakukan pembayaran dan upload bukti.');
            } else if(urlParams.get('beli') === 'error') {
                alert('Gagal membeli paket: ' + (urlParams.get('msg') || 'Unknown error'));
            }
            if(urlParams.get('upload') === 'success') {
                alert('Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.');
            } else if(urlParams.get('upload') === 'error') {
                alert('Gagal upload bukti: ' + (urlParams.get('msg') || 'Unknown error'));
            }
        });

        function formatRupiah(amount) {
            return 'Rp ' + Number(amount).toLocaleString('id-ID');
        }

        function applyFilters() {
            const status = document.getElementById('filterStatus').value;
            const rows = document.querySelectorAll('#pembelianTableBody tr');
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                row.style.display = (status === 'all' || rowStatus === status) ? '' : 'none';
            });
        }

        function openBeliModal(id, nama, harga) {
            currentPaketId = id;
            currentPaketNama = nama;
            currentPaketHarga = harga;
            document.getElementById('modalPaketId').value = id;
            document.getElementById('modalPaketNama').textContent = nama;
            document.getElementById('modalPaketHarga').textContent = formatRupiah(harga);
            document.getElementById('beliModal').classList.add('show');
        }

        function closeBeliModal() {
            document.getElementById('beliModal').classList.remove('show');
        }

        function openUploadModal(id) {
            currentUploadId = id;
            document.getElementById('uploadPembelianId').value = id;
            document.getElementById('uploadForm').reset();
            document.getElementById('uploadPembelianId').value = id; // Re-set after reset
            document.getElementById('uploadModal').classList.add('show');
        }

        function closeUploadModal() {
            document.getElementById('uploadModal').classList.remove('show');
        }

        document.getElementById('beliModal').addEventListener('click', function(e) { if (e.target === this) closeBeliModal(); });
        document.getElementById('uploadModal').addEventListener('click', function(e) { if (e.target === this) closeUploadModal(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closeBeliModal(); closeUploadModal(); } });
    </script>
</html>
