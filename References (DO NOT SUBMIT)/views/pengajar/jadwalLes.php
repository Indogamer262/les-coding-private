<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Jadwal Mengajar</h1>
            <p class="text-sm text-gray-600 mt-1">Jadwal les untuk pengajar</p>
        </div>
    </div>

    <!-- Schedules Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Jadwal</h2>

            <!-- Filters -->
            <div id="jadwalDtFilters" class="hidden flex flex-wrap items-center gap-3">
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
                        <option value="selesai">Selesai</option>
                        <option value="mendatang">Mendatang</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="px-6 py-6">
            <table id="tableJadwalPengajar" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Hari & Waktu</th>
                        <th class="px-6 py-3">Mata Pelajaran</th>
                        <th class="px-6 py-3">Murid</th>
                        <th class="px-6 py-3 text-center">Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
let tableJadwalPengajar;
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

// Dummy data
const jadwalPengajarData = [
    {
        jadwal_id: 1,
        tanggal: '2026-01-06',
        tanggal_display: '06 Jan 2026',
        hari: 'Senin',
        waktu: '14:00 - 16:00',
        mapel: 'Python',
        murid: 'Budi Santoso',
        status: 'selesai'
    },
    {
        jadwal_id: 2,
        tanggal: '2026-01-07',
        tanggal_display: '07 Jan 2026',
        hari: 'Selasa',
        waktu: '10:00 - 12:00',
        mapel: 'JavaScript',
        murid: 'Ani Susanti',
        status: 'selesai'
    },
    {
        jadwal_id: 3,
        tanggal: '2026-01-08',
        tanggal_display: '08 Jan 2026',
        hari: 'Rabu',
        waktu: '16:00 - 18:00',
        mapel: 'React.js',
        murid: 'Dewi Lestari',
        status: 'mendatang'
    },
    {
        jadwal_id: 4,
        tanggal: '2026-01-10',
        tanggal_display: '10 Jan 2026',
        hari: 'Jumat',
        waktu: '09:00 - 11:00',
        mapel: 'Node.js',
        murid: 'Ahmad Fauzi',
        status: 'mendatang'
    }
];

function applyFilters() {
    if (!tableJadwalPengajar) return;
    tableJadwalPengajar.draw();
}

function getStatusBadge(status) {
    const isSelesai = status === 'selesai';
    const label = isSelesai ? 'Selesai' : 'Mendatang';
    const cls = isSelesai ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700';
    return `<span class="px-4 py-1 rounded-full text-xs font-medium ${cls}">${label}</span>`;
}

document.addEventListener('DOMContentLoaded', () => {
    // Custom filter (Periode + Status)
    $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
        if (!settings?.nTable || settings.nTable.id !== 'tableJadwalPengajar') return true;
        if (!tableJadwalPengajar) return true;

        const row = tableJadwalPengajar.row(dataIndex).data();
        if (!row) return true;

        const statusOk = selectedStatusFilter === 'all' || row.status === selectedStatusFilter;
        return statusOk;
    });

    tableJadwalPengajar = $('#tableJadwalPengajar').DataTable({
        data: jadwalPengajarData,
        columns: [
            {
                data: 'tanggal_display',
                render: (data, type, row) => {
                    if (type === 'sort' || type === 'type') return row.tanggal;
                    return `<span class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: null,
                render: (data, type, row) => {
                    if (type !== 'display') return row.hari + ' ' + row.waktu;
                    return `
                        <div>
                            <p class="font-medium text-gray-800">${escapeHtml(row.hari)}</p>
                            <p class="text-sm text-gray-600">${escapeHtml(row.waktu)}</p>
                        </div>
                    `;
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
                data: 'murid',
                render: (data, type) => {
                    if (type !== 'display') return data || '';
                    return `<span class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: 'status',
                className: 'text-center',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return getStatusBadge(data);
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-status', data.status);
            row.setAttribute('data-jadwal-id', String(data.jadwal_id));
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
        order: [[0, 'asc']]
    });

    // Move filters next to length menu
    const wrapper = document.getElementById('tableJadwalPengajar_wrapper');
    const lengthEl = wrapper?.querySelector('.dt-length') || wrapper?.querySelector('.dataTables_length');
    const filterEl = document.getElementById('jadwalDtFilters');
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
