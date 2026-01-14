<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Log Aktivitas</h1>
            <p class="text-sm text-gray-600 mt-1">Lihat seluruh log aktivitas sistem</p>
        </div>
    </div>

    <!-- Log Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Log</h2>
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="inline-flex rounded-lg border border-gray-300 overflow-hidden">
                        <button type="button" id="filterSemua" onclick="setLogFilter('semua')" class="px-4 py-2 text-sm font-medium bg-blue-600 text-white">Semua</button>
                        <button type="button" id="filterMurid" onclick="setLogFilter('murid')" class="px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50">Murid</button>
                        <button type="button" id="filterPengajar" onclick="setLogFilter('pengajar')" class="px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50">Pengajar</button>
                        <button type="button" id="filterAdmin" onclick="setLogFilter('admin')" class="px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50">Admin</button>
                    </div>
                    <input type="text" id="searchLog" placeholder="Cari aktivitas..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="applyFilters()">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table id="tableLogAdmin" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">ID Log</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Aktivitas</th>
                        <th class="px-6 py-4">ID Akun</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
let selectedLogFilter = 'semua';
let tableLogAdmin;

function escapeHtml(value) {
    if (value === null || value === undefined) return '';
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

// Logs: dummy dibuat sendiri (sesuai permintaan)
const logAdminData = [
    {
        log_id: 1,
        id_log: 'LOG-0001',
        tanggal: '2026-01-13T09:15:00',
        tanggal_display: '13 Jan 2026, 09:15',
        aktivitas: 'Admin menambahkan paket baru "Paket 16 Pertemuan"',
        id_akun: 'USR-0001',
        role: 'admin'
    },
    {
        log_id: 2,
        id_log: 'LOG-0002',
        tanggal: '2026-01-13T08:45:00',
        tanggal_display: '13 Jan 2026, 08:45',
        aktivitas: 'Murid Budi Santoso melakukan pembelian paket',
        id_akun: 'USR-0012',
        role: 'murid'
    },
    {
        log_id: 3,
        id_log: 'LOG-0003',
        tanggal: '2026-01-12T16:30:00',
        tanggal_display: '12 Jan 2026, 16:30',
        aktivitas: 'Pengajar Ahmad Wijaya mengisi absensi jadwal JDW-0045',
        id_akun: 'USR-0005',
        role: 'pengajar'
    },
    {
        log_id: 4,
        id_log: 'LOG-0004',
        tanggal: '2026-01-12T14:20:00',
        tanggal_display: '12 Jan 2026, 14:20',
        aktivitas: 'Admin memverifikasi pembayaran PL-0015',
        id_akun: 'USR-0001',
        role: 'admin'
    },
    {
        log_id: 5,
        id_log: 'LOG-0005',
        tanggal: '2026-01-12T10:00:00',
        tanggal_display: '12 Jan 2026, 10:00',
        aktivitas: 'Murid Ani Susanti login ke sistem',
        id_akun: 'USR-0018',
        role: 'murid'
    },
    {
        log_id: 6,
        id_log: 'LOG-0006',
        tanggal: '2026-01-11T15:45:00',
        tanggal_display: '11 Jan 2026, 15:45',
        aktivitas: 'Pengajar Dewi Kusuma memperbarui profil',
        id_akun: 'USR-0007',
        role: 'pengajar'
    }
];

function setLogFilter(filter) {
    selectedLogFilter = filter;
    updateLogFilterButtons();
    applyFilters();
}

function updateLogFilterButtons() {
    const buttons = ['Semua', 'Murid', 'Pengajar', 'Admin'];
    const ids = ['filterSemua', 'filterMurid', 'filterPengajar', 'filterAdmin'];
    const values = ['semua', 'murid', 'pengajar', 'admin'];

    ids.forEach((id, index) => {
        const btn = document.getElementById(id);
        if (!btn) return;

        if (values[index] === selectedLogFilter) {
            btn.className = 'px-4 py-2 text-sm font-medium bg-blue-600 text-white';
        } else {
            btn.className = 'px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50';
        }
    });
}

function applyFilters() {
    if (!tableLogAdmin) return;

    const searchInput = document.getElementById('searchLog');
    const searchValue = (searchInput ? searchInput.value : '');

    // Cari hanya berdasarkan kolom Aktivitas
    const escape = $.fn.dataTable.util.escapeRegex;
    tableLogAdmin
        .column(2)
        .search(searchValue ? escape(searchValue) : '', false, true)
        .draw();
}

document.addEventListener('DOMContentLoaded', () => {
    updateLogFilterButtons();

    // Custom filter untuk Role
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        if (!tableLogAdmin || settings.nTable !== tableLogAdmin.table().node()) return true;
        if (selectedLogFilter === 'semua') return true;
        const rowData = tableLogAdmin.row(dataIndex).data();
        return rowData && rowData.role === selectedLogFilter;
    });

    tableLogAdmin = $('#tableLogAdmin').DataTable({
        data: logAdminData,
        columns: [
            {
                data: 'id_log',
                render: (val, type) => {
                    if (type !== 'display') return val;
                    return `<span class="font-mono text-sm font-medium text-gray-800">${escapeHtml(val)}</span>`;
                }
            },
            {
                data: 'tanggal_display',
                render: (val, type, row) => {
                    // gunakan ISO untuk sorting
                    if (type === 'sort' || type === 'type') return row.tanggal;
                    return `<span class="text-gray-700 whitespace-nowrap">${escapeHtml(val)}</span>`;
                }
            },
            {
                data: 'aktivitas',
                render: (val, type) => {
                    if (type !== 'display') return val;
                    return `<p class="text-gray-800">${escapeHtml(val)}</p>`;
                }
            },
            {
                data: 'id_akun',
                render: (val, type) => {
                    if (type !== 'display') return val;
                    return `<span class="font-mono text-sm text-gray-700">${escapeHtml(val)}</span>`;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-role', data.role);
            row.setAttribute('data-log-id', String(data.log_id));
        },
        dom: 'rt<"dt-bottom"ip>',
        language: {
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
        ordering: true,
        order: [[1, 'desc']]
    });

    applyFilters();
});
</script>
