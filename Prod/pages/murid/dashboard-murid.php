<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Dashboard Murid</h2>
            <p class="text-sm text-gray-600 mt-1">Selamat datang kembali di Sistem Les Privat Coding General</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Paket Aktif -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Paket Aktif</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">2</p>
                    <p class="text-xs text-gray-500 mt-1">Sedang berjalan</p>
                </div>
                <div class="w-14 h-14 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Sisa Pertemuan -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Sisa Pertemuan</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">11</p>
                    <p class="text-xs text-gray-500 mt-1">Dari paket aktif</p>
                </div>
                <div class="w-14 h-14 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#047857" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Jadwal Hari Ini -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Jadwal Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">1</p>
                    <p class="text-xs text-gray-500 mt-1">Pertemuan terjadwal</p>
                </div>
                <div class="w-14 h-14 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Jadwal Minggu Ini -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Jadwal Minggu Ini</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">3</p>
                    <p class="text-xs text-gray-500 mt-1">Pertemuan terjadwal</p>
                </div>
                <div class="w-14 h-14 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                        <path d="m9 16 2 2 4-4"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Mendatang (Table) -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Jadwal Mendatang</h2>
            <a href="dashboard.php?page=jadwalLes" class="text-sm text-blue-600 font-medium hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto p-6">
            <table id="tableDashboardJadwal" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead>
                    <tr class="bg-gray-50 text-xs uppercase text-gray-600 font-semibold tracking-wide border-b border-gray-200">
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Hari & Waktu</th>
                        <th class="px-6 py-4">Pengajar</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
function escapeHtml(value) {
    if (value === null || value === undefined) return '';
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

// Dummy data untuk jadwal mendatang murid
const dashboardJadwalData = [
    {
        tanggal: '2026-01-15',
        tanggal_display: '15 Jan 2026',
        hari: 'Kamis',
        waktu: '14:00 - 16:00',
        pengajar: 'Ahmad Wijaya',
        mapel: 'Python'
    },
    {
        tanggal: '2026-01-17',
        tanggal_display: '17 Jan 2026',
        hari: 'Sabtu',
        waktu: '09:00 - 11:00',
        pengajar: 'Ahmad Wijaya',
        mapel: 'React.js'
    },
    {
        tanggal: '2026-01-20',
        tanggal_display: '20 Jan 2026',
        hari: 'Selasa',
        waktu: '10:00 - 12:00',
        pengajar: 'Dewi Kusuma',
        mapel: 'JavaScript'
    }
];

document.addEventListener('DOMContentLoaded', () => {
    $('#tableDashboardJadwal').DataTable({
        data: dashboardJadwalData,
        columns: [
            {
                data: 'tanggal_display',
                render: (data, type, row) => {
                    if (type === 'sort' || type === 'type') return row.tanggal;
                    return `<p class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(data)}</p>`;
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
                data: 'pengajar',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="font-medium text-gray-800">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: 'mapel',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    return `<span class="text-gray-600">${escapeHtml(data)}</span>`;
                }
            }
        ],
        order: [[0, 'asc']],
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
        responsive: true
    });
});
</script>
