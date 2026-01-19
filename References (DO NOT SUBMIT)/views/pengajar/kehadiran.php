<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Kehadiran</h1>
            <p class="text-sm text-gray-600 mt-1">Lihat seluruh riwayat kehadiran murid</p>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Kehadiran</h2>

            <!-- Filters -->
            <div id="kehadiranDtFilters" class="hidden flex flex-wrap items-center gap-3">
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
                        <option value="hadir">Hadir</option>
                        <option value="tidak-hadir">Tidak Hadir</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="px-6 py-6">
            <table id="tableKehadiranPengajar" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Tanggal & Waktu</th>
                        <th class="px-6 py-3">Mata Pelajaran</th>
                        <th class="px-6 py-3">Murid</th>
                        <th class="px-6 py-3">Materi</th>
                        <th class="px-6 py-3">Kehadiran</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
let tableKehadiranPengajar;
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
const kehadiranPengajarData = [
    {
        kehadiran_id: 1,
        tanggal: '2025-12-30',
        tanggal_display: '30 Des 2025, Senin',
        waktu: '14:00 - 16:00',
        mapel: 'Python',
        murid: 'Budi Santoso',
        materi: 'Python Functions & Modules',
        status: 'hadir'
    },
    {
        kehadiran_id: 2,
        tanggal: '2025-12-31',
        tanggal_display: '31 Des 2025, Selasa',
        waktu: '10:00 - 12:00',
        mapel: 'JavaScript',
        murid: 'Ani Susanti',
        materi: '-',
        status: 'tidak-hadir'
    },
    {
        kehadiran_id: 3,
        tanggal: '2026-01-02',
        tanggal_display: '02 Jan 2026, Kamis',
        waktu: '14:00 - 16:00',
        mapel: 'React.js',
        murid: 'Budi Santoso',
        materi: 'React Components & Props',
        status: 'hadir'
    }
];

function applyFilters() {
    if (!tableKehadiranPengajar) return;
    tableKehadiranPengajar.draw();
}

document.addEventListener('DOMContentLoaded', () => {
    // Custom filter (Periode + Status)
    $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
        if (!settings?.nTable || settings.nTable.id !== 'tableKehadiranPengajar') return true;
        if (!tableKehadiranPengajar) return true;

        const row = tableKehadiranPengajar.row(dataIndex).data();
        if (!row) return true;

        const statusOk = selectedStatusFilter === 'all' || row.status === selectedStatusFilter;
        return statusOk;
    });

    tableKehadiranPengajar = $('#tableKehadiranPengajar').DataTable({
        data: kehadiranPengajarData,
        columns: [
            {
                data: null,
                render: (data, type, row) => {
                    if (type === 'sort' || type === 'type') return row.tanggal;
                    return `
                        <div>
                            <p class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(row.tanggal_display)}</p>
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
            },
            {
                data: 'status',
                className: 'text-center',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    const isHadir = data === 'hadir';
                    const label = isHadir ? 'Hadir' : 'Tidak Hadir';
                    const cls = isHadir ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
                    return `<span class="px-4 py-1 rounded-full text-xs font-medium ${cls}">${label}</span>`;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-status', data.status);
            row.setAttribute('data-kehadiran-id', String(data.kehadiran_id));
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
        order: [[0, 'desc']]
    });

    // Move filters next to length menu
    const wrapper = document.getElementById('tableKehadiranPengajar_wrapper');
    const lengthEl = wrapper?.querySelector('.dt-length') || wrapper?.querySelector('.dataTables_length');
    const filterEl = document.getElementById('kehadiranDtFilters');
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