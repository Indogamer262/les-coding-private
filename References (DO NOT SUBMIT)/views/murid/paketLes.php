<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Paket Saya</h1>
            <p class="text-sm text-gray-600 mt-1">Lihat seluruh paket les yang telah dibeli</p>
        </div>
    </div>

    <!-- Purchases Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Paket</h2>

            <!-- Filters -->
            <div id="paketMuridDtFilters" class="hidden flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <label class="text-sm whitespace-nowrap">Periode</label>
                    <select id="filterPeriode" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all">Semua</option>
                        <option value="today">Hari Ini</option>
                        <option value="week" selected>Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-sm whitespace-nowrap">Status</label>
                    <select id="filterStatus" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" selected>Semua</option>
                        <option value="aktif">Aktif</option>
                        <option value="kadaluarsa">Kadaluarsa</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="px-6 py-6">
            <table id="tablePaketMurid" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">ID Pembelian</th>
                        <th class="px-6 py-3">Tanggal Pemesanan</th>
                        <th class="px-6 py-3">Paket</th>
                        <th class="px-6 py-3 text-center">Sisa Pertemuan</th>
                        <th class="px-6 py-3">Masa Aktif</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Detail Sisa Pertemuan Modal -->
<div id="detailPertemuanModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50" onclick="closeDetailModal()">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Detail Pertemuan</h3>
            <button type="button" onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="p-6 space-y-4">
            <!-- Ringkasan -->
            <div class="bg-gray-50 rounded-lg p-4 space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">ID Pembelian:</span>
                    <span id="detailModalPembelian" class="font-mono font-semibold text-gray-800">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Paket:</span>
                    <span id="detailModalPaket" class="font-medium text-gray-800">-</span>
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
                    <table id="tableDetailTerpakai" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                                <th class="px-4 py-3">Ke-</th>
                                <th class="px-4 py-3">Tanggal & Waktu</th>
                                <th class="px-4 py-3">Pengajar</th>
                                <th class="px-4 py-3">Mata Pelajaran</th>
                                <th class="px-4 py-3">Materi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let tablePaketMurid;
let selectedPeriodeFilter = 'week';
let selectedStatusFilter = 'all';
let currentPaketData = null;

function escapeHtml(value) {
    if (value === null || value === undefined) return '';
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

// Dummy data for paket murid
const paketMuridData = [
    {
        paket_id: 1,
        id_pembelian: 'PL-0001',
        tanggal_pesan: '2026-01-02',
        tanggal_pesan_display: '02 Jan 2026, 09:30',
        paket: 'Paket 8 Pertemuan',
        total_pertemuan: 8,
        sisa_pertemuan: 5,
        masa_aktif: '28 hari',
        status: 'aktif',
        pertemuan_terpakai: [
            { tanggal: '03 Jan 2026', waktu: '14:00 - 16:00', pengajar: 'Ahmad Wijaya', mapel: 'Python', materi: 'Python Functions & Modules' },
            { tanggal: '04 Jan 2026', waktu: '10:00 - 12:00', pengajar: 'Dewi Kusuma', mapel: 'JavaScript', materi: 'DOM Manipulation' },
            { tanggal: '06 Jan 2026', waktu: '14:00 - 16:00', pengajar: 'Ahmad Wijaya', mapel: 'React.js', materi: 'React Components & Props' }
        ]
    },
    {
        paket_id: 2,
        id_pembelian: 'PL-0012',
        tanggal_pesan: '2025-12-28',
        tanggal_pesan_display: '28 Des 2025, 10:45',
        paket: 'Paket 4 Pertemuan',
        total_pertemuan: 4,
        sisa_pertemuan: 2,
        masa_aktif: '3 hari',
        status: 'aktif',
        pertemuan_terpakai: [
            { tanggal: '29 Des 2025', waktu: '14:00 - 16:00', pengajar: 'Ahmad Wijaya', mapel: 'Python', materi: 'Pengenalan Python' },
            { tanggal: '01 Jan 2026', waktu: '10:00 - 12:00', pengajar: 'Eko Prasetyo', mapel: 'Node.js', materi: 'Express.js Basics' }
        ]
    },
    {
        paket_id: 3,
        id_pembelian: 'PL-0008',
        tanggal_pesan: '2025-12-15',
        tanggal_pesan_display: '15 Des 2025, 08:15',
        paket: 'Paket 12 Pertemuan',
        total_pertemuan: 12,
        sisa_pertemuan: 9,
        masa_aktif: null,
        status: 'kadaluarsa',
        pertemuan_terpakai: [
            { tanggal: '16 Des 2025', waktu: '14:00 - 16:00', pengajar: 'Ahmad Wijaya', mapel: 'Python', materi: 'OOP in Python' },
            { tanggal: '18 Des 2025', waktu: '10:00 - 12:00', pengajar: 'Dewi Kusuma', mapel: 'JavaScript', materi: 'Async/Await' },
            { tanggal: '20 Des 2025', waktu: '14:00 - 16:00', pengajar: 'Eko Prasetyo', mapel: 'Node.js', materi: 'REST API' }
        ]
    }
];

function applyFilters() {
    if (!tablePaketMurid) return;
    tablePaketMurid.draw();
}

function getStatusBadge(status) {
    if (status === 'aktif') {
        return '<span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>';
    } else {
        return '<span class="px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">Kadaluarsa</span>';
    }
}

let tableDetailTerpakai;

function openDetailModal(paketId) {
    const paket = paketMuridData.find(p => p.paket_id === paketId);
    if (!paket) return;
    
    currentPaketData = paket;
    
    document.getElementById('detailModalPembelian').textContent = paket.id_pembelian;
    document.getElementById('detailModalPaket').textContent = paket.paket;
    document.getElementById('detailModalSisa').textContent = `${paket.sisa_pertemuan}/${paket.total_pertemuan}`;
    
    // Build data array for DataTable
    const terpakaiData = paket.pertemuan_terpakai.map((item, index) => ({
        ke: index + 1,
        tanggal: item.tanggal,
        waktu: item.waktu,
        pengajar: item.pengajar,
        mapel: item.mapel,
        materi: item.materi
    }));

    // Destroy existing DataTable if exists
    if (tableDetailTerpakai) {
        tableDetailTerpakai.destroy();
        tableDetailTerpakai = null;
    }

    // Initialize DataTable for modal
    tableDetailTerpakai = $('#tableDetailTerpakai').DataTable({
        data: terpakaiData,
        columns: [
            {
                data: 'ke',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="font-medium text-gray-800">${data}</span>`;
                }
            },
            {
                data: null,
                render: (data, type, row) => {
                    if (type !== 'display') return row.tanggal + ' ' + row.waktu;
                    return `
                        <div>
                            <p class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(row.tanggal)}</p>
                            <p class="text-sm text-gray-600">${escapeHtml(row.waktu)}</p>
                        </div>
                    `;
                }
            },
            {
                data: 'pengajar',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: 'mapel',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: 'materi',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="text-sm text-gray-800">${escapeHtml(data)}</span>`;
                }
            }
        ],
        createdRow: (row) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
        },
        dom: 't',
        paging: false,
        info: false,
        searching: false,
        ordering: true,
        order: [[0, 'asc']],
        language: {
            zeroRecords: "Belum ada pertemuan terpakai"
        }
    });
    
    document.getElementById('detailPertemuanModal').classList.remove('hidden');
    document.getElementById('detailPertemuanModal').classList.add('flex');
}

function closeDetailModal() {
    document.getElementById('detailPertemuanModal').classList.add('hidden');
    document.getElementById('detailPertemuanModal').classList.remove('flex');
    currentPaketData = null;
}

document.addEventListener('DOMContentLoaded', () => {
    // Custom filter for status
    $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
        if (!settings?.nTable || settings.nTable.id !== 'tablePaketMurid') return true;
        if (!tablePaketMurid) return true;

        const row = tablePaketMurid.row(dataIndex).data();
        if (!row) return true;

        const statusOk = selectedStatusFilter === 'all' || row.status === selectedStatusFilter;
        return statusOk;
    });

    tablePaketMurid = $('#tablePaketMurid').DataTable({
        data: paketMuridData,
        columns: [
            {
                data: 'id_pembelian',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="font-mono text-sm font-medium text-gray-800">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: 'tanggal_pesan_display',
                render: (data, type, row) => {
                    if (type === 'sort' || type === 'type') return row.tanggal_pesan;
                    // Split tanggal dan waktu untuk 2 baris
                    const parts = data ? data.split(', ') : ['', ''];
                    const tanggal = parts[0] || '';
                    const waktu = parts[1] || '';
                    return `
                        <div>
                            <p class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(tanggal)}</p>
                            <p class="text-sm text-gray-600">${escapeHtml(waktu)}</p>
                        </div>
                    `;
                }
            },
            {
                data: 'paket',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="font-medium text-gray-800">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: null,
                className: 'text-center',
                render: (data, type, row) => {
                    if (type !== 'display') return row.sisa_pertemuan;
                    return `<span class="font-semibold text-blue-600">${row.sisa_pertemuan}/${row.total_pertemuan}</span>`;
                }
            },
            {
                data: null,
                render: (data, type, row) => {
                    if (type !== 'display') return row.masa_aktif || '';
                    if (row.status === 'kadaluarsa') {
                        return `<span class="text-xs text-orange-600 italic">Kadaluarsa</span>`;
                    }
                    return `<span class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(row.masa_aktif)}</span>`;
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: (data, type, row) => {
                    if (type !== 'display') return '';
                    return `
                        <button type="button" onclick="openDetailModal(${row.paket_id})" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors whitespace-nowrap">
                            View Detail
                        </button>
                    `;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            if (data.status === 'kadaluarsa') {
                $(row).addClass('opacity-60');
            }
            row.setAttribute('data-paket-id', String(data.paket_id));
        },
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            zeroRecords: "Tidak ada paket ditemukan",
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
    const wrapper = document.getElementById('tablePaketMurid_wrapper');
    const lengthEl = wrapper?.querySelector('.dt-length') || wrapper?.querySelector('.dataTables_length');
    const filterEl = document.getElementById('paketMuridDtFilters');
    if (lengthEl && filterEl) {
        lengthEl.classList.add('flex', 'items-end', 'gap-3', 'flex-wrap');
        filterEl.classList.remove('hidden');
        lengthEl.appendChild(filterEl);
    }

    const periodeSelect = document.getElementById('filterPeriode');
    const statusSelect = document.getElementById('filterStatus');

    if (periodeSelect) {
        selectedPeriodeFilter = periodeSelect.value || 'week';
        periodeSelect.addEventListener('change', () => {
            selectedPeriodeFilter = periodeSelect.value || 'week';
            applyFilters();
        });
    }

    if (statusSelect) {
        selectedStatusFilter = statusSelect.value || 'all';
        statusSelect.addEventListener('change', () => {
            selectedStatusFilter = statusSelect.value || 'all';
            applyFilters();
        });
    }

    applyFilters();
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const modal = document.getElementById('detailPertemuanModal');
        if (modal && !modal.classList.contains('hidden')) closeDetailModal();
    }
});
</script>