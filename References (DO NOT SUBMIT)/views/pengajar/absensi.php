<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Absensi</h1>
            <p class="text-sm text-gray-600 mt-1">Input absensi kehadiran murid</p>
        </div>
    </div>

    <!-- Absensi Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Jadwal</h2>

            <!-- Filters -->
            <div id="absensiDtFilters" class="hidden flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <label class="text-sm whitespace-nowrap">Periode</label>
                    <select id="filterPeriode" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all">Semua</option>
                        <option value="today" selected>Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-sm whitespace-nowrap">Status</label>
                    <select id="filterStatus" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" selected>Semua</option>
                        <option value="belum">Belum Absen</option>
                        <option value="sudah">Sudah Absen</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="px-6 py-6">
            <table id="tableAbsensiPengajar" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Hari & Waktu</th>
                        <th class="px-6 py-3">Mata Pelajaran</th>
                        <th class="px-6 py-3">Murid</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Absensi Modal -->
<div id="absensiModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Input Absensi</h3>
            <button type="button" onclick="closeAbsensiModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form id="absensiForm" class="p-6 space-y-4" onsubmit="handleAbsensiSubmit(event)">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kehadiran</label>
                <select name="kehadiran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kehadiran --</option>
                    <option value="hadir">Hadir</option>
                    <option value="tidak-hadir">Tidak Hadir</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Materi</label>
                <textarea name="materi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan materi yang diajarkan..."></textarea>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button type="button" onclick="closeAbsensiModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button type="submit" form="absensiForm" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Simpan</button>
        </div>
    </div>
</div>

<script>
let tableAbsensiPengajar;
let selectedPeriodeFilter = 'today';
let selectedStatusFilter = 'all';
let currentAbsensiId = null;

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
const absensiPengajarData = [
    {
        absensi_id: 1,
        tanggal: '2026-01-06',
        tanggal_display: '06 Jan 2026',
        hari: 'Senin',
        waktu: '14:00 - 16:00',
        mapel: 'Python',
        murid: 'Budi Santoso',
        status: 'belum'
    },
    {
        absensi_id: 2,
        tanggal: '2026-01-06',
        tanggal_display: '06 Jan 2026',
        hari: 'Senin',
        waktu: '10:00 - 12:00',
        mapel: 'JavaScript',
        murid: 'Citra Dewi',
        status: 'sudah'
    },
    {
        absensi_id: 3,
        tanggal: '2026-01-06',
        tanggal_display: '06 Jan 2026',
        hari: 'Senin',
        waktu: '16:00 - 18:00',
        mapel: 'React.js',
        murid: 'Ani Susanti',
        status: 'belum'
    }
];

function applyFilters() {
    if (!tableAbsensiPengajar) return;
    tableAbsensiPengajar.draw();
}

function openAbsensiModal(id) {
    currentAbsensiId = id;
    document.getElementById('absensiForm').reset();
    document.getElementById('absensiModal').classList.remove('hidden');
    document.getElementById('absensiModal').classList.add('flex');
}

function closeAbsensiModal() {
    document.getElementById('absensiModal').classList.add('hidden');
    document.getElementById('absensiModal').classList.remove('flex');
    currentAbsensiId = null;
}

function handleAbsensiSubmit(event) {
    event.preventDefault();
    alert('Absensi berhasil disimpan!');
    closeAbsensiModal();
}

document.addEventListener('DOMContentLoaded', () => {
    // Custom filter (Periode + Status)
    $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
        if (!settings?.nTable || settings.nTable.id !== 'tableAbsensiPengajar') return true;
        if (!tableAbsensiPengajar) return true;

        const row = tableAbsensiPengajar.row(dataIndex).data();
        if (!row) return true;

        const statusOk = selectedStatusFilter === 'all' || row.status === selectedStatusFilter;
        return statusOk;
    });

    tableAbsensiPengajar = $('#tableAbsensiPengajar').DataTable({
        data: absensiPengajarData,
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
                    if (!data) {
                        return `<span class="text-xs text-blue-500 italic">Belum terisi</span>`;
                    }
                    return `<span class="font-medium text-gray-800 whitespace-nowrap">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: (data, type, row) => {
                    if (type !== 'display') return '';
                    if (!row.murid) {
                        return `<span class="text-gray-400 text-xs italic">Tidak ada murid</span>`;
                    }
                    if (row.status === 'sudah') {
                        return `<span class="px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Sudah Absen</span>`;
                    }
                    return `
                        <button type="button" onclick="openAbsensiModal(${row.absensi_id})" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors" title="Input Absensi">
                            Input Absensi
                        </button>
                    `;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-status', data.status);
            row.setAttribute('data-absensi-id', String(data.absensi_id));
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
    const wrapper = document.getElementById('tableAbsensiPengajar_wrapper');
    const lengthEl = wrapper?.querySelector('.dt-length') || wrapper?.querySelector('.dataTables_length');
    const filterEl = document.getElementById('absensiDtFilters');
    if (lengthEl && filterEl) {
        lengthEl.classList.add('flex', 'items-end', 'gap-3', 'flex-wrap');
        filterEl.classList.remove('hidden');
        lengthEl.appendChild(filterEl);
    }

    const periodeSelect = document.getElementById('filterPeriode');
    const statusSelect = document.getElementById('filterStatus');

    if (periodeSelect) {
        selectedPeriodeFilter = periodeSelect.value || 'today';
        periodeSelect.addEventListener('change', () => {
            selectedPeriodeFilter = periodeSelect.value || 'today';
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
