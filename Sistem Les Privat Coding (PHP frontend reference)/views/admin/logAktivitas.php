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
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Log</h2>

            <!-- Filters -->
            <div id="logDtFilters" class="hidden flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <label class="text-sm whitespace-nowrap">Role</label>
                    <select id="filterRole" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" selected>Semua</option>
                        <option value="murid">Murid</option>
                        <option value="pengajar">Pengajar</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="px-6 py-6">
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
let tableLogAdmin;
let selectedRoleFilter = 'all';

function escapeHtml(value) {
    if (value === null || value === undefined) return '';
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function applyFilters() {
    if (!tableLogAdmin) return;
    tableLogAdmin.draw();
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

document.addEventListener('DOMContentLoaded', () => {
    // Custom filter untuk Role
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        if (!tableLogAdmin || settings.nTable !== tableLogAdmin.table().node()) return true;
        if (selectedRoleFilter === 'all') return true;
        const rowData = tableLogAdmin.row(dataIndex).data();
        return rowData && rowData.role === selectedRoleFilter;
    });

    const roleSelect = document.getElementById('filterRole');
    if (roleSelect) {
        selectedRoleFilter = roleSelect.value || 'all';
        roleSelect.addEventListener('change', () => {
            selectedRoleFilter = roleSelect.value || 'all';
            applyFilters();
        });
    }

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

    // Pindahkan filter select ke area "Tampilkan ... data"
    const wrapper = document.getElementById('tableLogAdmin_wrapper');
    const lengthEl = wrapper?.querySelector('.dt-length') || wrapper?.querySelector('.dataTables_length');
    const filterEl = document.getElementById('logDtFilters');
    if (lengthEl && filterEl) {
        lengthEl.classList.add('flex', 'items-end', 'gap-3', 'flex-wrap');
        filterEl.classList.remove('hidden');
        lengthEl.appendChild(filterEl);
    }

    applyFilters();
});
</script>
