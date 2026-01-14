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
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Pembelian</h2>

            <!-- Filters -->
            <div id="pembelianDtFilters" class="hidden flex flex-wrap items-center gap-3">
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
            <table id="tablePembelianAdmin" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">ID Pembelian</th>
                        <th class="px-6 py-3">Tanggal Pemesanan</th>
                        <th class="px-6 py-3">Tanggal Pembayaran</th>
                        <th class="px-6 py-3">Nama Murid</th>
                        <th class="px-6 py-3">Paket</th>
                        <th class="px-6 py-3">Harga</th>
                        <th class="px-6 py-3">Masa Aktif</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
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
                    <table id="tableDetailTerpakai" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                                <th class="px-6 py-4">Ke-</th>
                                <th class="px-6 py-4">Tanggal & Waktu</th>
                                <th class="px-6 py-4">Pengajar</th>
                                <th class="px-6 py-4">Mata Pelajaran</th>
                                <th class="px-6 py-4">Materi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let tablePembelianAdmin;
let tableDetailTerpakai;
let selectedPeriodeFilter = 'month';
let selectedStatusFilter = 'all';

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
const pembelianAdminData = [
    {
        pembelian_id: 1,
        id_pembelian: 'PL-0001',
        tanggal_pesan: '2026-01-02T09:30:00',
        tanggal_pesan_display: '02 Jan 2026, 09:30',
        tanggal_bayar: '02 Jan 2026, 09:45',
        murid: 'Budi Santoso',
        paket: 'Paket 8 Pertemuan',
        harga: 450000,
        masa_aktif: '28 hari',
        status: 'aktif',
        total: 8,
        sisa: 5,
        terpakai_dates: ['03 Jan 2026', '04 Jan 2026', '06 Jan 2026']
    },
    {
        pembelian_id: 2,
        id_pembelian: 'PL-0012',
        tanggal_pesan: '2025-12-28T10:45:00',
        tanggal_pesan_display: '28 Des 2025, 10:45',
        tanggal_bayar: '28 Des 2025, 10:50',
        murid: 'Ani Susanti',
        paket: 'Paket 4 Pertemuan',
        harga: 250000,
        masa_aktif: '3 hari',
        status: 'aktif',
        total: 4,
        sisa: 2,
        terpakai_dates: ['29 Des 2025', '01 Jan 2026']
    },
    {
        pembelian_id: 3,
        id_pembelian: 'PL-0008',
        tanggal_pesan: '2025-12-15T08:15:00',
        tanggal_pesan_display: '15 Des 2025, 08:15',
        tanggal_bayar: '15 Des 2025, 08:20',
        murid: 'Dedi Prasetyo',
        paket: 'Paket 12 Pertemuan',
        harga: 600000,
        masa_aktif: null,
        status: 'kadaluarsa',
        total: 12,
        sisa: 9,
        terpakai_dates: ['16 Des 2025', '18 Des 2025', '20 Des 2025']
    }
];

function applyFilters() {
    if (!tablePembelianAdmin) return;
    tablePembelianAdmin.draw();
}

function openDetailModal(btnOrId) {
    let rowData;
    if (typeof btnOrId === 'number') {
        rowData = pembelianAdminData.find(r => r.pembelian_id === btnOrId);
    } else {
        // Find from button click
        const row = btnOrId.closest('tr');
        const dtRow = tablePembelianAdmin.row(row);
        rowData = dtRow.data();
    }
    if (!rowData) return;

    document.getElementById('detailModalPembelian').textContent = rowData.id_pembelian;
    document.getElementById('detailModalMurid').textContent = rowData.murid;
    document.getElementById('detailModalSisa').textContent = `${rowData.sisa}/${rowData.total}`;

    // Sample data for pengajar, mapel, materi
    const samplePengajar = ['Ahmad Wijaya', 'Dewi Kusuma', 'Eko Prasetyo'];
    const sampleMapel = ['Python', 'JavaScript', 'React.js', 'HTML & CSS', 'Node.js'];
    const sampleMateri = ['Pengenalan Dasar', 'Variabel dan Tipe Data', 'Fungsi dan Modul', 'OOP Basics', 'Project Latihan'];

    const terpakaiDates = rowData.terpakai_dates || [];

    // Build data array for DataTable
    const terpakaiData = terpakaiDates.map((tanggal, index) => ({
        ke: index + 1,
        tanggal: tanggal,
        waktu: '14:00 - 16:00',
        pengajar: samplePengajar[index % samplePengajar.length],
        mapel: sampleMapel[index % sampleMapel.length],
        materi: sampleMateri[index % sampleMateri.length]
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
                    return `<p class="font-medium text-gray-800">${data}</p>`;
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
                    return `<p class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(data)}</p>`;
                }
            },
            {
                data: 'mapel',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<p class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(data)}</p>`;
                }
            },
            {
                data: 'materi',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<p class="text-sm text-gray-800">${escapeHtml(data)}</p>`;
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

    const modal = document.getElementById('detailPertemuanModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDetailModal() {
    const modal = document.getElementById('detailPertemuanModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const modal = document.getElementById('detailPertemuanModal');
        if (modal && !modal.classList.contains('hidden')) closeDetailModal();
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Custom filter (Periode + Status)
    $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
        if (!settings?.nTable || settings.nTable.id !== 'tablePembelianAdmin') return true;
        if (!tablePembelianAdmin) return true;

        const row = tablePembelianAdmin.row(dataIndex).data();
        if (!row) return true;

        const statusOk = selectedStatusFilter === 'all' || row.status === selectedStatusFilter;
        return statusOk;
    });

    tablePembelianAdmin = $('#tablePembelianAdmin').DataTable({
        data: pembelianAdminData,
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
                data: 'tanggal_bayar',
                render: (data, type, row) => {
                    if (type !== 'display') return data;
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
                data: 'harga',
                render: (data, type) => {
                    if (type !== 'display') return Number(data || 0);
                    return `
                        <div>
                            <p class="font-bold text-emerald-600 whitespace-nowrap">${formatRupiah(data)}</p>
                        </div>
                    `;
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
                        <button type="button" onclick="openDetailModal(this)" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors whitespace-nowrap">
                            View Detail
                        </button>
                    `;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-status', data.status);
            row.setAttribute('data-pembelian-id', String(data.pembelian_id));
            if (data.status === 'kadaluarsa') $(row).addClass('opacity-60');
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
    const wrapper = document.getElementById('tablePembelianAdmin_wrapper');
    const lengthEl = wrapper?.querySelector('.dt-length') || wrapper?.querySelector('.dataTables_length');
    const filterEl = document.getElementById('pembelianDtFilters');
    if (lengthEl && filterEl) {
        lengthEl.classList.add('flex', 'items-end', 'gap-3', 'flex-wrap');
        filterEl.classList.remove('hidden');
        lengthEl.appendChild(filterEl);
    }

    const periodeSelect = document.getElementById('filterPeriode');
    const statusSelect = document.getElementById('filterStatus');

    if (periodeSelect) {
        selectedPeriodeFilter = periodeSelect.value || 'month';
        periodeSelect.addEventListener('change', () => {
            selectedPeriodeFilter = periodeSelect.value || 'month';
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
</script>