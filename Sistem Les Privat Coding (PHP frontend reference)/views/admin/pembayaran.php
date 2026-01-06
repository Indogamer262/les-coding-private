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
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Pembelian</h2>
                <input type="text" id="searchMuridPembayaran" placeholder="Cari nama murid..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="searchMuridPembayaran(this.value)">
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4 whitespace-nowrap">ID Pembelian</th>
                        <th class="px-6 py-4 whitespace-nowrap w-56">Tanggal</th>
                        <th class="px-6 py-4 whitespace-nowrap">Nama Murid</th>
                        <th class="px-6 py-4">Paket</th>
                        <th class="px-6 py-4">Jumlah</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody id="paymentTableBody" class="divide-y divide-gray-100">
                    <!-- Row 1: Menunggu Konfirmasi -->
                    <tr class="hover:bg-gray-50 transition-colors" data-id="1" data-paid="0" data-pembelian="PL-0001" data-murid="Budi Santoso" data-paket="Paket 8 Pertemuan" data-jumlah="Rp 450.000" data-tanggal="06 Jan 2026, 09:30">
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
                        <td class="px-6 py-4 w-44">
                            <div class="flex items-center justify-center">
                                <button onclick="openConfirmModal(1)" class="mark-paid-btn inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-emerald-600 text-white hover:bg-emerald-800 hover:shadow-md transition-all whitespace-nowrap" title="Tandai lunas">
                                    Tandai lunas
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Menunggu Konfirmasi -->
                    <tr class="hover:bg-gray-50 transition-colors" data-id="3" data-paid="0" data-pembelian="PL-0003" data-murid="Dedi Prasetyo" data-paket="Paket 12 Pertemuan" data-jumlah="Rp 600.000" data-tanggal="06 Jan 2026, 10:45">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-mono text-sm font-medium text-gray-800">PL-0003</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap w-56">06 Jan 2026, 10:45</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Dedi Prasetyo</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Paket 12 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-600 whitespace-nowrap">Rp 600.000</span>
                        </td>
                        <td class="px-6 py-4 w-44">
                            <div class="flex items-center justify-center">
                                <button onclick="openConfirmModal(3)" class="mark-paid-btn inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-emerald-600 text-white hover:bg-emerald-800 hover:shadow-md transition-all whitespace-nowrap" title="Tandai lunas">
                                    Tandai lunas
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

<!-- Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Konfirmasi Pembayaran</h3>
            <button onclick="closeConfirmModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="p-6">
            <!-- Warning Box -->
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-4">
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    <p class="text-amber-800 font-medium text-sm">Pastikan pembayaran sudah diterima sebelum konfirmasi!</p>
                </div>
            </div>

            <!-- Transaction Details -->
            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Detail Pembelian</h4>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">ID Pembelian:</span>
                        <span id="modalPembelian" class="font-mono font-semibold text-gray-800">PL-0001</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal:</span>
                        <span id="modalTanggal" class="font-medium text-gray-800">06 Jan 2026, 09:30</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Murid:</span>
                        <span id="modalMurid" class="font-medium text-gray-800">Budi Santoso</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Paket:</span>
                        <span id="modalPaket" class="font-medium text-gray-800">Paket 8 Pertemuan</span>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-2 mt-2">
                        <span class="text-gray-600">Jumlah:</span>
                        <span id="modalJumlah" class="font-bold text-lg text-emerald-600">Rp 450.000</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button onclick="closeConfirmModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button id="confirmBtn" onclick="confirmPayment()" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                Ya, Konfirmasi Pembayaran sudah Lunas
            </button>
        </div>
    </div>
</div>

<script>
let currentPurchaseId = null;

function searchMuridPembayaran(value) {
    const searchValue = value.toLowerCase();
    const rows = document.querySelectorAll('#paymentTableBody tr');
    
    rows.forEach(row => {
        const namaMurid = row.dataset.murid;
        if (namaMurid) {
            const text = namaMurid.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        }
    });
}

function openConfirmModal(id) {
    currentPurchaseId = id;
    const row = document.querySelector(`tr[data-id="${id}"]`);

    // Prevent opening modal for already paid rows
    if (row && row.dataset.paid === '1') return;
    
    // Populate modal with purchase data
    document.getElementById('modalPembelian').textContent = row.dataset.pembelian;
    document.getElementById('modalTanggal').textContent = row.dataset.tanggal;
    document.getElementById('modalMurid').textContent = row.dataset.murid;
    document.getElementById('modalPaket').textContent = row.dataset.paket;
    document.getElementById('modalJumlah').textContent = row.dataset.jumlah;
    
    // Reset confirm button state
    const confirmBtn = document.getElementById('confirmBtn');
    confirmBtn.disabled = false;
    confirmBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    
    document.getElementById('confirmModal').classList.remove('hidden');
    document.getElementById('confirmModal').classList.add('flex');
}

function closeConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
    document.getElementById('confirmModal').classList.remove('flex');
    currentPurchaseId = null;
}

function confirmPayment() {
    if (!currentPurchaseId) return;
    
    const confirmBtn = document.getElementById('confirmBtn');
    
    // Disable button to prevent double click
    confirmBtn.disabled = true;
    confirmBtn.classList.add('opacity-50', 'cursor-not-allowed');
    confirmBtn.innerHTML = `
        <svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12a9 9 0 1 1-6.219-8.56"></path>
        </svg>
        Memproses...
    `;
    
    // Simulate API call
    setTimeout(() => {
        const row = document.querySelector(`tr[data-id="${currentPurchaseId}"]`);
        if (!row) return;

        // Mark paid and remove row (halaman ini hanya menampilkan yang belum lunas)
        row.dataset.paid = '1';
        row.remove();
        
        // Close modal
        closeConfirmModal();
        
        // Show success toast
        showSuccessToast();
    }, 800);
}

function showSuccessToast() {
    const toast = document.getElementById('successToast');
    toast.classList.remove('hidden', 'translate-x-full');
    toast.classList.add('flex', 'translate-x-0');
    
    // Auto hide after 3 seconds
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
