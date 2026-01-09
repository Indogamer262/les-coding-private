<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Verifikasi Pembayaran</h1>
            <p class="text-sm text-gray-600 mt-1">Verifikasi pembayaran pembelian paket les</p>
        </div>
    </div>

    <!-- Purchases Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Pembelian Menunggu Verifikasi</h2>
            <div class="mt-4 flex flex-wrap items-end gap-3">
                <div class="w-48">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Periode</label>
                    <select id="filterPeriode" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="all">Semua Periode</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month" selected>Bulan Ini</option>
                    </select>
                </div>
                <div class="w-48">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Status Bukti</label>
                    <select id="filterBukti" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="all">Semua</option>
                        <option value="ada">Sudah Upload</option>
                        <option value="belum">Belum Upload</option>
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
                        <th class="px-6 py-4 whitespace-nowrap">ID Pembelian</th>
                        <th class="px-6 py-4 whitespace-nowrap">Tanggal</th>
                        <th class="px-6 py-4 whitespace-nowrap">Nama Murid</th>
                        <th class="px-6 py-4">Paket</th>
                        <th class="px-6 py-4">Jumlah</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody id="paymentTableBody" class="divide-y divide-gray-100">
                    <!-- Row 1: Ada bukti -->
                    <tr class="hover:bg-gray-50 transition-colors" data-id="1" data-paid="0" data-pembelian="PL-0001" data-murid="Budi Santoso" data-paket="Paket 8 Pertemuan" data-jumlah="Rp 450.000" data-jumlah-num="450000" data-tanggal="06 Jan 2026, 09:30" data-bukti="ada" data-bukti-url="https://placehold.co/400x600/e2e8f0/475569?text=Bukti+Transfer%0ABudi+Santoso">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-mono text-sm font-medium text-gray-800">PL-0001</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">06 Jan 2026, 09:30</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Budi Santoso</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Paket 8 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-600 whitespace-nowrap">Rp 450.000</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <button onclick="openBuktiModal(1)" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-all whitespace-nowrap" title="Lihat Bukti">
                                    Lihat Bukti
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: Belum ada bukti -->
                    <tr class="hover:bg-gray-50 transition-colors" data-id="2" data-paid="0" data-pembelian="PL-0002" data-murid="Ani Susanti" data-paket="Paket 4 Pertemuan" data-jumlah="Rp 250.000" data-jumlah-num="250000" data-tanggal="06 Jan 2026, 10:15" data-bukti="belum" data-bukti-url="">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-mono text-sm font-medium text-gray-800">PL-0002</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">06 Jan 2026, 10:15</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Ani Susanti</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Paket 4 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-600 whitespace-nowrap">Rp 250.000</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <span class="text-gray-400 text-xs italic">Menunggu bukti</span>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Ada bukti -->
                    <tr class="hover:bg-gray-50 transition-colors" data-id="3" data-paid="0" data-pembelian="PL-0003" data-murid="Dedi Prasetyo" data-paket="Paket 12 Pertemuan" data-jumlah="Rp 600.000" data-jumlah-num="600000" data-tanggal="06 Jan 2026, 10:45" data-bukti="ada" data-bukti-url="https://placehold.co/400x600/e2e8f0/475569?text=Bukti+Transfer%0ADedi+Prasetyo">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-mono text-sm font-medium text-gray-800">PL-0003</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">06 Jan 2026, 10:45</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Dedi Prasetyo</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Paket 12 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-600 whitespace-nowrap">Rp 600.000</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <button onclick="openBuktiModal(3)" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-all whitespace-nowrap" title="Lihat Bukti">
                                    Lihat Bukti
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 4: Ada bukti -->
                    <tr class="hover:bg-gray-50 transition-colors" data-id="4" data-paid="0" data-pembelian="PL-0004" data-murid="Siti Rahma" data-paket="Paket 8 Pertemuan" data-jumlah="Rp 450.000" data-jumlah-num="450000" data-tanggal="05 Jan 2026, 14:20" data-bukti="ada" data-bukti-url="https://placehold.co/400x600/e2e8f0/475569?text=Bukti+Transfer%0ASiti+Rahma">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-mono text-sm font-medium text-gray-800">PL-0004</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">05 Jan 2026, 14:20</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Siti Rahma</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Paket 8 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-600 whitespace-nowrap">Rp 450.000</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <button onclick="openBuktiModal(4)" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-all whitespace-nowrap" title="Lihat Bukti">
                                    Lihat Bukti
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Success Notification Toast -->
<div id="successToast" class="fixed top-4 right-4 bg-emerald-600 text-white px-6 py-4 rounded-lg shadow-lg hidden items-center gap-3 z-50 transition-all transform translate-x-full">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
        <polyline points="22 4 12 14.01 9 11.01"></polyline>
    </svg>
    <div>
        <p class="font-semibold">Pembayaran sudah Lunas!</p>
        <p class="text-sm text-emerald-100">Pembelian paket berhasil ditandai lunas.</p>
    </div>
</div>

<!-- Bukti Pembayaran Modal (Lihat Bukti) -->
<div id="buktiModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-lg w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Bukti Pembayaran</h3>
            <button onclick="closeBuktiModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="p-6">
            <!-- Transaction Info -->
            <div class="bg-gray-50 rounded-lg p-4 mb-4 space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">ID Pembelian:</span>
                    <span id="buktiModalPembelian" class="font-mono font-semibold text-gray-800">PL-0001</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Murid:</span>
                    <span id="buktiModalMurid" class="font-medium text-gray-800">Budi Santoso</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Paket:</span>
                    <span id="buktiModalPaket" class="font-medium text-gray-800">Paket 8 Pertemuan</span>
                </div>
                <div class="flex justify-between border-t border-gray-200 pt-2">
                    <span class="text-gray-600">Jumlah:</span>
                    <span id="buktiModalJumlah" class="font-bold text-emerald-600">Rp 450.000</span>
                </div>
            </div>

            <!-- Bukti Image -->
            <div class="border border-gray-200 rounded-lg overflow-hidden mb-4">
                <img id="buktiImage" src="" alt="Bukti Pembayaran" class="w-full h-auto">
            </div>

            <!-- Warning -->
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    <p class="text-amber-800 font-medium text-sm">Pastikan bukti transfer sudah sesuai sebelum menandai lunas!</p>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button onclick="closeBuktiModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Tutup</button>
            <button id="tandaiLunasBtn" onclick="confirmFromBukti()" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                Tandai Lunas
            </button>
        </div>
    </div>
</div>

<script>
let currentPurchaseId = null;

function applyFilters() {
    const searchValue = document.getElementById('searchMuridPembayaran').value.toLowerCase();
    const buktiFilter = document.getElementById('filterBukti').value;
    const rows = document.querySelectorAll('#paymentTableBody tr');
    
    rows.forEach(row => {
        const namaMurid = (row.dataset.murid || '').toLowerCase();
        const bukti = row.dataset.bukti;
        
        let visible = true;
        
        // Search filter
        if (searchValue && !namaMurid.includes(searchValue)) {
            visible = false;
        }
        
        // Bukti filter
        if (buktiFilter !== 'all' && bukti !== buktiFilter) {
            visible = false;
        }
        
        row.style.display = visible ? '' : 'none';
    });
}

function openBuktiModal(id) {
    currentPurchaseId = id;
    const row = document.querySelector(`tr[data-id="${id}"]`);
    if (!row) return;
    
    document.getElementById('buktiModalPembelian').textContent = row.dataset.pembelian;
    document.getElementById('buktiModalMurid').textContent = row.dataset.murid;
    document.getElementById('buktiModalPaket').textContent = row.dataset.paket;
    document.getElementById('buktiModalJumlah').textContent = row.dataset.jumlah;
    document.getElementById('buktiImage').src = row.dataset.buktiUrl;
    
    document.getElementById('buktiModal').classList.remove('hidden');
    document.getElementById('buktiModal').classList.add('flex');
}

function closeBuktiModal() {
    document.getElementById('buktiModal').classList.add('hidden');
    document.getElementById('buktiModal').classList.remove('flex');
}

function confirmFromBukti() {
    if (!currentPurchaseId) return;
    
    const btn = document.getElementById('tandaiLunasBtn');
    btn.disabled = true;
    btn.classList.add('opacity-50', 'cursor-not-allowed');
    btn.innerHTML = `
        <svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12a9 9 0 1 1-6.219-8.56"></path>
        </svg>
        Memproses...
    `;
    
    setTimeout(() => {
        const row = document.querySelector(`tr[data-id="${currentPurchaseId}"]`);
        if (row) {
            row.dataset.paid = '1';
            row.remove();
        }
        
        closeBuktiModal();
        showSuccessToast();
        
        // Reset button
        btn.disabled = false;
        btn.classList.remove('opacity-50', 'cursor-not-allowed');
        btn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            Tandai Lunas
        `;
        currentPurchaseId = null;
    }, 800);
}

function showSuccessToast() {
    const toast = document.getElementById('successToast');
    toast.classList.remove('hidden', 'translate-x-full');
    toast.classList.add('flex', 'translate-x-0');
    
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        toast.classList.remove('translate-x-0');
        setTimeout(() => {
            toast.classList.add('hidden');
            toast.classList.remove('flex');
        }, 300);
    }, 3000);
}
</script>

<style>
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.animate-spin {
    animation: spin 1s linear infinite;
}
#successToast {
    transition: transform 0.3s ease-in-out;
}
</style>
