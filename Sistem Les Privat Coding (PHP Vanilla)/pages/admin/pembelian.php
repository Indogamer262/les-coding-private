<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Pembelian</h1>
            <p class="text-sm text-gray-600 mt-1">Lihat seluruh riwayat pembelian paket les</p>
        </div>
    </div>

    <!-- Purchases Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Pembelian</h2>
            <div class="mt-4 flex flex-wrap items-end gap-3">
                <div class="w-40">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Periode</label>
                    <select id="filterPeriode" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="all">Semua Periode</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month" selected>Bulan Ini</option>
                    </select>
                </div>
                <div class="w-40">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Status Paket</label>
                    <select id="filterStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="all">Semua</option>
                        <option value="aktif">Aktif</option>
                        <option value="kadaluarsa">Kadaluarsa</option>
                    </select>
                </div>
                <div class="w-36">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Urutkan</label>
                    <select id="sortBy" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="terbaru">Terbaru</option>
                        <option value="terlama">Terlama</option>
                    </select>
                </div>
                <div class="flex-1"></div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Cari</label>
                    <input type="text" id="searchMuridPembayaran" placeholder="Cari nama murid..." class="px-2 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="applyFilters()">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-5 py-4 whitespace-nowrap text-center w-56">ID Pembelian</th>
                        <th class="px-5 py-4 whitespace-nowrap">Tanggal Pemesanan</th>
                        <th class="px-5 py-4 whitespace-nowrap">Tanggal Pembayaran</th>
                        <th class="px-5 py-4 whitespace-nowrap">Nama Murid</th>
                        <th class="px-3 py-4 whitespace-nowrap">Paket</th>
                        <th class="px-5 py-4">Harga</th>
                        <th class="px-5 py-4 whitespace-nowrap">Masa Aktif</th>
                        <th class="px-3 py-4 whitespace-nowrap text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="purchasesTableBody" class="divide-y divide-gray-100">
                    <!-- Row 1 - Active Package -->
                    <tr class="hover:bg-gray-50 transition-colors" data-murid="Budi Santoso" data-total="8" data-sisa="5" data-terpakai-dates="03 Jan 2026|04 Jan 2026|06 Jan 2026">
                        <td class="px-6 py-4 whitespace-nowrap text-center w-56">
                            <span class="font-mono text-sm font-medium text-gray-800">PL-0001</span>
                        </td>
                        <td class="px-4 py-4 text-gray-700 whitespace-nowrap">02 Jan 2026, 09:30</td>
                        <td class="px-4 py-4 text-gray-700 whitespace-nowrap">02 Jan 2026, 09:45</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Budi Santoso</p>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <p class="px-2 font-medium text-gray-800 whitespace-nowrap">Paket 8 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-600 whitespace-nowrap">Rp 450.000</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-medium text-gray-800 whitespace-nowrap">28 hari</span>
                        </td>
                        <td class="px-2 py-4 text-center">
                            <button type="button" onclick="openDetailModal(this)" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors whitespace-nowrap">
                                View Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2 - Expiring Soon -->
                    <tr class="hover:bg-gray-50 transition-colors" data-murid="Ani Susanti" data-total="4" data-sisa="2" data-terpakai-dates="29 Des 2025|01 Jan 2026">
                        <td class="px-6 py-4 whitespace-nowrap text-center w-56">
                            <span class="font-mono text-sm font-medium text-gray-800">PL-0012</span>
                        </td>
                        <td class="px-4 py-4 text-gray-700 whitespace-nowrap">28 Des 2025, 10:45</td>
                        <td class="px-4 py-4 text-gray-700 whitespace-nowrap">28 Des 2025, 10:50</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Ani Susanti</p>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <p class="px-2 font-medium text-gray-800 whitespace-nowrap">Paket 4 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-600 whitespace-nowrap">Rp 250.000</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-medium text-gray-800 whitespace-nowrap">3 hari</span>
                        </td>
                        <td class="px-2 py-4 text-center">
                            <button type="button" onclick="openDetailModal(this)" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors whitespace-nowrap">
                                View Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Row 3 - Expired Package -->
                    <tr class="hover:bg-gray-50 transition-colors opacity-60" data-murid="Dedi Prasetyo" data-total="12" data-sisa="9" data-terpakai-dates="16 Des 2025|18 Des 2025|20 Des 2025">
                        <td class="px-6 py-4 whitespace-nowrap text-center w-56">
                            <span class="font-mono text-sm font-medium text-gray-800">PL-0008</span>
                        </td>
                        <td class="px-4 py-4 text-gray-700 whitespace-nowrap">15 Des 2025, 08:15</td>
                        <td class="px-4 py-4 text-gray-700 whitespace-nowrap">15 Des 2025, 08:20</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Dedi Prasetyo</p>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <p class="px-2 font-medium text-gray-800 whitespace-nowrap">Paket 12 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-600 whitespace-nowrap">Rp 600.000</span>
                        </td>
                        <td class="px-2 py-4 text-center">
                            <span class="text-xs text-orange-600 italic">Kadaluarsa</span>
                        </td>
                        <td class="px-2 py-4 text-center">
                            <button type="button" onclick="openDetailModal(this)" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors whitespace-nowrap">
                                View Detail
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Detail Sisa Pertemuan Modal -->
<div id="detailPertemuanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" onclick="closeDetailModal()">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800">Detail Sisa Pertemuan</h3>
        </div>

        <div class="p-6 space-y-4">
            <!-- Ringkasan -->
            <div class="bg-gray-50 rounded-lg p-4 space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">ID Pembelian:</span>
                    <span id="detailModalPembelian" class="font-mono font-semibold text-gray-800">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Murid:</span>
                    <span id="detailModalMurid" class="font-medium text-gray-800">-</span>
                </div>
                <div class="flex justify-between border-t border-gray-200 pt-2">
                    <span class="text-gray-600">Sisa Pertemuan:</span>
                    <span id="detailModalSisa" class="font-bold text-blue-600">-</span>
                </div>
            </div>

            <!-- Tabel pertemuan terpakai -->
            <div>
                <h4 class="text-sm font-semibold text-gray-800 mb-2">Pertemuan Terpakai</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                                <th class="px-6 py-4">Ke-</th>
                                <th class="px-6 py-4">Tanggal & Waktu</th>
                                <th class="px-6 py-4">Pengajar</th>
                                <th class="px-6 py-4">Mata Pelajaran</th>
                                <th class="px-6 py-4">Materi</th>
                            </tr>
                        </thead>
                        <tbody id="detailModalTerpakaiBody" class="divide-y divide-gray-100">
                            <tr>
                                <td class="px-6 py-4 text-gray-600" colspan="5">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function applyFilters() {
    const searchValue = document.getElementById('searchMuridPembayaran').value.toLowerCase();
    const statusFilter = document.getElementById('filterStatus').value;
    const rows = document.querySelectorAll('#purchasesTableBody tr');
    
    rows.forEach(row => {
        const namaMurid = (row.dataset.murid || '').toLowerCase();
        const isExpired = row.classList.contains('opacity-60');
        const rowStatus = isExpired ? 'kadaluarsa' : 'aktif';
        
        let matchesSearch = namaMurid.includes(searchValue);
        let matchesStatus = statusFilter === 'all' || rowStatus === statusFilter;
        
        row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
    });
}

function openDetailModal(buttonEl) {
    const row = buttonEl ? buttonEl.closest('tr') : null;
    if (!row) return;

    const idPembelian = row.querySelector('td span.font-mono') ? row.querySelector('td span.font-mono').textContent.trim() : '-';
    const murid = row.dataset.murid || '-';
    const total = parseInt(row.dataset.total || '0', 10);
    const sisa = parseInt(row.dataset.sisa || '0', 10);
    const terpakaiDatesRaw = row.dataset.terpakaiDates || '';
    const terpakaiDates = terpakaiDatesRaw
        ? terpakaiDatesRaw.split('|').map((v) => v.trim()).filter(Boolean)
        : [];

    document.getElementById('detailModalPembelian').textContent = idPembelian;
    document.getElementById('detailModalMurid').textContent = murid;
    document.getElementById('detailModalSisa').textContent = `${sisa}/${total}`;

    const body = document.getElementById('detailModalTerpakaiBody');
    body.innerHTML = '';

    // Sample data for pengajar, mapel, materi - in real app this would come from database
    const samplePengajar = ['Ahmad Wijaya', 'Dewi Kusuma', 'Eko Prasetyo'];
    const sampleMapel = ['Python', 'JavaScript', 'React.js', 'HTML & CSS', 'Node.js'];
    const sampleMateri = ['Pengenalan Dasar', 'Variabel dan Tipe Data', 'Fungsi dan Modul', 'OOP Basics', 'Project Latihan'];

    if (terpakaiDates.length === 0) {
        body.innerHTML = `
            <tr>
                <td class="px-6 py-4 text-gray-600" colspan="5">Belum ada pertemuan terpakai</td>
            </tr>
        `;
    } else {
        terpakaiDates.forEach((tanggal, index) => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50 transition-colors';
            const pengajar = samplePengajar[index % samplePengajar.length];
            const mapel = sampleMapel[index % sampleMapel.length];
            const materi = sampleMateri[index % sampleMateri.length];
            tr.innerHTML = `
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-800">${index + 1}</p>
                </td>
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-800 whitespace-nowrap">${tanggal}</p>
                    <p class="text-sm text-gray-600">14:00 - 16:00</p>
                </td>
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-800 whitespace-nowrap">${pengajar}</p>
                </td>
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-800 whitespace-nowrap">${mapel}</p>
                </td>
                <td class="px-6 py-4">
                    <p class="text-sm text-gray-800">${materi}</p>
                </td>
            `;
            body.appendChild(tr);
        });
    }

    const modal = document.getElementById('detailPertemuanModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDetailModal() {
    const modal = document.getElementById('detailPertemuanModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function searchMuridPembelian(value) {
    const searchValue = value.toLowerCase();
    const rows = document.querySelectorAll('#purchasesTableBody tr');

    rows.forEach(row => {
        const namaMurid = row.dataset.murid || '';
        row.style.display = namaMurid.toLowerCase().includes(searchValue) ? '' : 'none';
    });
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const modal = document.getElementById('detailPertemuanModal');
        if (modal && !modal.classList.contains('hidden')) closeDetailModal();
    }
});
</script>