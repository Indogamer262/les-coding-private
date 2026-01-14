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
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Pembelian Menunggu Verifikasi</h2>

            <!-- Filters -->
            <div id="pembayaranDtFilters" class="hidden flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <label class="text-sm whitespace-nowrap">Periode</label>
                    <select id="filterPeriode" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all">Semua</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month" selected>Bulan Ini</option>
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-sm whitespace-nowrap">Status Bukti</label>
                    <select id="filterBukti" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" selected>Semua</option>
                        <option value="ada">Sudah Upload</option>
                        <option value="belum">Belum Upload</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="px-6 py-6">
            <table id="tablePembayaranAdmin" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">ID Pembelian</th>
                        <th class="px-6 py-3">Tanggal Pemesanan</th>
                        <th class="px-6 py-3">Nama Murid</th>
                        <th class="px-6 py-3">Paket</th>
                        <th class="px-6 py-3">Jumlah</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
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
let tablePembayaranAdmin;
let selectedPeriodeFilter = 'month';
let selectedBuktiFilter = 'all';
let currentPurchaseId = null;

function escapeHtml(value) {
    if (value === null || value === undefined) return '';
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function formatRupiah(amount) {
    const num = Number(amount || 0);
    return 'Rp ' + num.toLocaleString('id-ID');
}

// Dummy data
const pembayaranAdminData = [
    {
        pembayaran_id: 1,
        id_pembelian: 'PL-0001',
        tanggal: '2026-01-06T09:30:00',
        tanggal_display: '06 Jan 2026, 09:30',
        murid: 'Budi Santoso',
        paket: 'Paket 8 Pertemuan',
        jumlah: 450000,
        bukti: 'ada',
        bukti_url: 'https://placehold.co/400x600/e2e8f0/475569?text=Bukti+Transfer%0ABudi+Santoso'
    },
    {
        pembayaran_id: 2,
        id_pembelian: 'PL-0002',
        tanggal: '2026-01-06T10:15:00',
        tanggal_display: '06 Jan 2026, 10:15',
        murid: 'Ani Susanti',
        paket: 'Paket 4 Pertemuan',
        jumlah: 250000,
        bukti: 'belum',
        bukti_url: ''
    },
    {
        pembayaran_id: 3,
        id_pembelian: 'PL-0003',
        tanggal: '2026-01-06T10:45:00',
        tanggal_display: '06 Jan 2026, 10:45',
        murid: 'Dedi Prasetyo',
        paket: 'Paket 12 Pertemuan',
        jumlah: 600000,
        bukti: 'ada',
        bukti_url: 'https://placehold.co/400x600/e2e8f0/475569?text=Bukti+Transfer%0ADedi+Prasetyo'
    },
    {
        pembayaran_id: 4,
        id_pembelian: 'PL-0004',
        tanggal: '2026-01-05T14:20:00',
        tanggal_display: '05 Jan 2026, 14:20',
        murid: 'Siti Rahma',
        paket: 'Paket 8 Pertemuan',
        jumlah: 450000,
        bukti: 'ada',
        bukti_url: 'https://placehold.co/400x600/e2e8f0/475569?text=Bukti+Transfer%0ASiti+Rahma'
    }
];

function applyFilters() {
    if (!tablePembayaranAdmin) return;
    tablePembayaranAdmin.draw();
}

function openBuktiModal(id) {
    currentPurchaseId = id;
    const rowData = pembayaranAdminData.find(r => r.pembayaran_id === id);
    if (!rowData) return;
    
    document.getElementById('buktiModalPembelian').textContent = rowData.id_pembelian;
    document.getElementById('buktiModalMurid').textContent = rowData.murid;
    document.getElementById('buktiModalPaket').textContent = rowData.paket;
    document.getElementById('buktiModalJumlah').textContent = formatRupiah(rowData.jumlah);
    document.getElementById('buktiImage').src = rowData.bukti_url;
    
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
        // Remove from data array and redraw
        const index = pembayaranAdminData.findIndex(r => r.pembayaran_id === currentPurchaseId);
        if (index > -1) {
            pembayaranAdminData.splice(index, 1);
            tablePembayaranAdmin.clear().rows.add(pembayaranAdminData).draw();
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

document.addEventListener('DOMContentLoaded', () => {
    // Custom filter (Periode + Bukti)
    $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
        if (!settings?.nTable || settings.nTable.id !== 'tablePembayaranAdmin') return true;
        if (!tablePembayaranAdmin) return true;

        const row = tablePembayaranAdmin.row(dataIndex).data();
        if (!row) return true;

        const buktiOk = selectedBuktiFilter === 'all' || row.bukti === selectedBuktiFilter;
        return buktiOk;
    });

    tablePembayaranAdmin = $('#tablePembayaranAdmin').DataTable({
        data: pembayaranAdminData,
        columns: [
            {
                data: 'id_pembelian',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="font-mono text-sm font-medium text-gray-800">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: 'tanggal_display',
                render: (data, type, row) => {
                    if (type === 'sort' || type === 'type') return row.tanggal;
                    return `<span class="text-gray-700 whitespace-nowrap">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: 'murid',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: 'paket',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: 'jumlah',
                render: (data, type) => {
                    if (type !== 'display') return Number(data || 0);
                    return `<span class="font-bold text-emerald-600 whitespace-nowrap">${formatRupiah(data)}</span>`;
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: (data, type, row) => {
                    if (type !== 'display') return '';
                    if (row.bukti === 'belum') {
                        return `<span class="text-gray-400 text-xs italic">Menunggu bukti</span>`;
                    }
                    return `
                        <button onclick="openBuktiModal(${row.pembayaran_id})" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-all whitespace-nowrap" title="Lihat Bukti">
                            Lihat Bukti
                        </button>
                    `;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-bukti', data.bukti);
            row.setAttribute('data-pembayaran-id', String(data.pembayaran_id));
        },
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            zeroRecords: "Tidak ada data yang cocok",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
        ordering: true,
        order: [[1, 'desc']]
    });

    // Move filters next to length menu
    const wrapper = document.getElementById('tablePembayaranAdmin_wrapper');
    const lengthEl = wrapper?.querySelector('.dt-length') || wrapper?.querySelector('.dataTables_length');
    const filterEl = document.getElementById('pembayaranDtFilters');
    if (lengthEl && filterEl) {
        lengthEl.classList.add('flex', 'items-end', 'gap-3', 'flex-wrap');
        filterEl.classList.remove('hidden');
        lengthEl.appendChild(filterEl);
    }

    const periodeSelect = document.getElementById('filterPeriode');
    const buktiSelect = document.getElementById('filterBukti');

    if (periodeSelect) {
        selectedPeriodeFilter = periodeSelect.value || 'month';
        periodeSelect.addEventListener('change', () => {
            selectedPeriodeFilter = periodeSelect.value || 'month';
            applyFilters();
        });
    }

    if (buktiSelect) {
        selectedBuktiFilter = buktiSelect.value || 'all';
        buktiSelect.addEventListener('change', () => {
            selectedBuktiFilter = buktiSelect.value || 'all';
            applyFilters();
        });
    }

    applyFilters();
});
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
