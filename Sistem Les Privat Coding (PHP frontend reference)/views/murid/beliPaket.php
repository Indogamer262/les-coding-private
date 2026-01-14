<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Beli Paket</h1>
            <p class="text-sm text-gray-600 mt-1">Pilih paket les yang tersedia</p>
        </div>
    </div>

    <!-- Packages Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="packageGrid">
        <!-- Package Card 1 -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-xl font-bold text-white">Paket 4 Pertemuan</h3>
                <p class="text-blue-100 text-sm mt-1">Cocok untuk pemula</p>
            </div>
            <div class="p-6">
                <div class="text-center mb-4">
                    <span class="text-3xl font-bold text-gray-800">Rp 250.000</span>
                </div>
                <ul class="space-y-3 mb-4">
                    <li class="flex items-center gap-2 text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500"><polyline points="20 6 9 17 4 12"/></svg>
                        4 Pertemuan
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500"><polyline points="20 6 9 17 4 12"/></svg>
                        Masa aktif 14 hari
                    </li>
                </ul>
                <button onclick="openBeliModal(1, 'Paket 4 Pertemuan', 250000)" class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                    Beli Sekarang
                </button>
            </div>
        </div>

        <!-- Package Card 2 -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-xl font-bold text-white">Paket 8 Pertemuan</h3>
                <p class="text-blue-100 text-sm mt-1">Paling diminati</p>
            </div>
            <div class="p-6">
                <div class="text-center mb-4">
                    <span class="text-3xl font-bold text-gray-800">Rp 450.000</span>
                </div>
                <ul class="space-y-3 mb-4">
                    <li class="flex items-center gap-2 text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500"><polyline points="20 6 9 17 4 12"/></svg>
                        8 Pertemuan
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500"><polyline points="20 6 9 17 4 12"/></svg>
                        Masa aktif 28 hari
                    </li>
                </ul>
                <button onclick="openBeliModal(2, 'Paket 8 Pertemuan', 450000)" class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                    Beli Sekarang
                </button>
            </div>
        </div>

        <!-- Package Card 3 -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-xl font-bold text-white">Paket 12 Pertemuan</h3>
                <p class="text-blue-100 text-sm mt-1">Untuk belajar intensif</p>
            </div>
            <div class="p-6">
                <div class="text-center mb-4">
                    <span class="text-3xl font-bold text-gray-800">Rp 600.000</span>
                </div>
                <ul class="space-y-3 mb-4">
                    <li class="flex items-center gap-2 text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500"><polyline points="20 6 9 17 4 12"/></svg>
                        12 Pertemuan
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500"><polyline points="20 6 9 17 4 12"/></svg>
                        Masa aktif 45 hari
                    </li>
                </ul>
                <button onclick="openBeliModal(3, 'Paket 12 Pertemuan', 600000)" class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                    Beli Sekarang
                </button>
            </div>
        </div>
    </div>

    <!-- Riwayat Pembelian Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Riwayat Pembelian</h2>

            <!-- Filters -->
            <div id="pembelianDtFilters" class="hidden flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <label class="text-sm whitespace-nowrap">Status</label>
                    <select id="filterStatus" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" selected>Semua</option>
                        <option value="pending">Menunggu Pembayaran</option>
                        <option value="verifikasi">Menunggu Verifikasi</option>
                        <option value="lunas">Lunas</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="px-6 py-6">
            <table id="tablePembelianMurid" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">ID Pembelian</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Paket</th>
                        <th class="px-6 py-3">Harga</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Beli Paket Modal -->
<div id="beliModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Konfirmasi Pembelian</h3>
            <button type="button" onclick="closeBeliModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Paket:</span>
                    <span id="modalPaketNama" class="font-semibold text-gray-800">-</span>
                </div>
                <div class="flex justify-between border-t border-gray-200 pt-2">
                    <span class="text-gray-600">Total:</span>
                    <span id="modalPaketHarga" class="font-bold text-blue-600 text-lg">-</span>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="font-semibold text-blue-800 mb-2">Informasi Pembayaran</h4>
                <p class="text-sm text-blue-700">Transfer ke rekening berikut:</p>
                <div class="mt-2 space-y-1 text-sm">
                    <p class="font-medium text-blue-800">Bank BCA - 1234567890</p>
                    <p class="text-blue-700">a.n. Les Privat Coding</p>
                </div>
            </div>

            <p class="text-sm text-gray-600">
                Setelah melakukan pembayaran, silakan upload bukti pembayaran untuk diverifikasi oleh admin.
            </p>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button type="button" onclick="closeBeliModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button type="button" onclick="konfirmasiBeli()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Beli Paket</button>
        </div>
    </div>
</div>

<!-- Upload Bukti Modal -->
<div id="uploadBuktiModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Upload Bukti Pembayaran</h3>
            <button type="button" onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form id="uploadBuktiForm" class="p-6 space-y-4" onsubmit="handleUploadBukti(event)">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Bukti Pembayaran</label>
                <input type="file" name="bukti" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, maksimal 2MB</p>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button type="button" onclick="closeUploadModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button type="submit" form="uploadBuktiForm" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Upload</button>
        </div>
    </div>
</div>

<script>
let tablePembelianMurid;
let selectedStatusFilter = 'all';
let currentPaketId = null;
let currentPaketNama = '';
let currentPaketHarga = 0;
let currentUploadPembelianId = null;

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
const pembelianMuridData = [
    {
        pembelian_id: 1,
        id_pembelian: 'PL-0001',
        tanggal: '2026-01-02',
        tanggal_display: '02 Jan 2026',
        paket: 'Paket 8 Pertemuan',
        harga: 450000,
        status: 'lunas'
    },
    {
        pembelian_id: 2,
        id_pembelian: 'PL-0015',
        tanggal: '2026-01-10',
        tanggal_display: '10 Jan 2026',
        paket: 'Paket 4 Pertemuan',
        harga: 250000,
        status: 'pending'
    },
    {
        pembelian_id: 3,
        id_pembelian: 'PL-0018',
        tanggal: '2026-01-12',
        tanggal_display: '12 Jan 2026',
        paket: 'Paket 8 Pertemuan',
        harga: 450000,
        status: 'verifikasi'
    }
];

function applyFilters() {
    if (!tablePembelianMurid) return;
    tablePembelianMurid.draw();
}

function openBeliModal(id, nama, harga) {
    currentPaketId = id;
    currentPaketNama = nama;
    currentPaketHarga = harga;
    
    document.getElementById('modalPaketNama').textContent = nama;
    document.getElementById('modalPaketHarga').textContent = formatRupiah(harga);
    
    document.getElementById('beliModal').classList.remove('hidden');
    document.getElementById('beliModal').classList.add('flex');
}

function closeBeliModal() {
    document.getElementById('beliModal').classList.add('hidden');
    document.getElementById('beliModal').classList.remove('flex');
    currentPaketId = null;
}

function konfirmasiBeli() {
    alert('Pembelian berhasil dibuat! Silakan lakukan pembayaran dan upload bukti pembayaran.');
    closeBeliModal();
    // Reload table or add new row
}

function openUploadModal(pembelianId) {
    currentUploadPembelianId = pembelianId;
    document.getElementById('uploadBuktiForm').reset();
    document.getElementById('uploadBuktiModal').classList.remove('hidden');
    document.getElementById('uploadBuktiModal').classList.add('flex');
}

function closeUploadModal() {
    document.getElementById('uploadBuktiModal').classList.add('hidden');
    document.getElementById('uploadBuktiModal').classList.remove('flex');
    currentUploadPembelianId = null;
}

function handleUploadBukti(event) {
    event.preventDefault();
    alert('Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.');
    closeUploadModal();
}

document.addEventListener('DOMContentLoaded', () => {
    // Custom filter (Status)
    $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
        if (!settings?.nTable || settings.nTable.id !== 'tablePembelianMurid') return true;
        if (!tablePembelianMurid) return true;

        const row = tablePembelianMurid.row(dataIndex).data();
        if (!row) return true;

        const statusOk = selectedStatusFilter === 'all' || row.status === selectedStatusFilter;
        return statusOk;
    });

    tablePembelianMurid = $('#tablePembelianMurid').DataTable({
        data: pembelianMuridData,
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
                data: 'harga',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="font-medium text-gray-800">${formatRupiah(data)}</span>`;
                }
            },
            {
                data: 'status',
                className: 'text-center',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    let cls = '';
                    let label = '';
                    switch(data) {
                        case 'pending':
                            cls = 'bg-yellow-100 text-yellow-700';
                            label = 'Menunggu Pembayaran';
                            break;
                        case 'verifikasi':
                            cls = 'bg-blue-100 text-blue-700';
                            label = 'Menunggu Verifikasi';
                            break;
                        case 'lunas':
                            cls = 'bg-green-100 text-green-700';
                            label = 'Lunas';
                            break;
                        case 'ditolak':
                            cls = 'bg-red-100 text-red-700';
                            label = 'Ditolak';
                            break;
                        default:
                            cls = 'bg-gray-100 text-gray-700';
                            label = data;
                    }
                    return `<span class="status-badge ${cls}">${label}</span>`;
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: (data, type, row) => {
                    if (type !== 'display') return '';
                    if (row.status === 'pending') {
                        return `
                            <button type="button" onclick="openUploadModal(${row.pembelian_id})" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                                Upload Bukti
                            </button>
                        `;
                    }
                    if (row.status === 'ditolak') {
                        return `
                            <button type="button" onclick="openUploadModal(${row.pembelian_id})" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-orange-500 text-white hover:bg-orange-600 transition-colors">
                                Upload Ulang
                            </button>
                        `;
                    }
                    return `<span class="text-gray-400 text-xs">-</span>`;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-status', data.status);
            row.setAttribute('data-pembelian-id', String(data.pembelian_id));
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
    const wrapper = document.getElementById('tablePembelianMurid_wrapper');
    const lengthEl = wrapper?.querySelector('.dt-length') || wrapper?.querySelector('.dataTables_length');
    const filterEl = document.getElementById('pembelianDtFilters');
    if (lengthEl && filterEl) {
        lengthEl.classList.add('flex', 'items-end', 'gap-3', 'flex-wrap');
        filterEl.classList.remove('hidden');
        lengthEl.appendChild(filterEl);
    }

    const statusSelect = document.getElementById('filterStatus');
    if (statusSelect) {
        selectedStatusFilter = statusSelect.value || 'all';
        statusSelect.addEventListener('change', () => {
            selectedStatusFilter = statusSelect.value || 'all';
            applyFilters();
        });
    }

    applyFilters();
});
</script>
