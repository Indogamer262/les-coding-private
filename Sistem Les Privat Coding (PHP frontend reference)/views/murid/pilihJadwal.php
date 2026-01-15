<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Pilih Jadwal</h1>
            <p class="text-sm text-gray-600 mt-1">Pilih jadwal les dari paket yang telah dibeli</p>
        </div>
    </div>

    <!-- Paket Aktif Info -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h3 class="font-semibold text-blue-800">Paket Aktif: Paket 8 Pertemuan</h3>
                <p class="text-sm text-blue-600 mt-1">Sisa pertemuan: <span class="font-bold">5 dari 8</span> | Masa aktif: <span class="font-bold">28 hari lagi</span></p>
            </div>
            <a href="dashboard.php?page=paketLes" class="text-sm text-blue-600 hover:text-blue-800 underline">Lihat semua paket →</a>
        </div>
    </div>

    <!-- Jadwal Tersedia Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Jadwal Tersedia</h2>

            <!-- Filters -->
            <div id="jadwalDtFilters" class="hidden flex flex-wrap items-center gap-3">
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
                    <label class="text-sm whitespace-nowrap">Mata Pelajaran</label>
                    <select id="filterMapel" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" selected>Semua</option>
                        <option value="python">Python</option>
                        <option value="javascript">JavaScript</option>
                        <option value="react">React.js</option>
                        <option value="html-css">HTML & CSS</option>
                        <option value="nodejs">Node.js</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="px-6 py-6">
            <table id="tableJadwalTersedia" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Hari & Waktu</th>
                        <th class="px-6 py-3">Pengajar</th>
                        <th class="px-6 py-3">Mata Pelajaran</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Jadwal yang Sudah Dipilih -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Jadwal Saya</h2>

            <!-- Filters -->
            <div id="jadwalDipilihDtFilters" class="hidden flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <label class="text-sm whitespace-nowrap">Periode</label>
                    <select id="filterPeriodeDipilih" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all">Semua</option>
                        <option value="today">Hari Ini</option>
                        <option value="week" selected>Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="px-6 py-6">
            <table id="tableJadwalDipilih" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Hari & Waktu</th>
                        <th class="px-6 py-3">Pengajar</th>
                        <th class="px-6 py-3">Mata Pelajaran</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Konfirmasi Pilih Jadwal Modal -->
<div id="pilihJadwalModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Konfirmasi Pilih Jadwal</h3>
            <button type="button" onclick="closePilihModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Tanggal:</span>
                    <span id="modalJadwalTanggal" class="font-semibold text-gray-800">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Waktu:</span>
                    <span id="modalJadwalWaktu" class="font-medium text-gray-800">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Pengajar:</span>
                    <span id="modalJadwalPengajar" class="font-medium text-gray-800">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Mata Pelajaran:</span>
                    <span id="modalJadwalMapel" class="font-medium text-gray-800">-</span>
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-sm text-yellow-800">
                    <strong>Perhatian:</strong> Setelah memilih jadwal, pertemuan ini akan mengurangi sisa pertemuan paket Anda.
                </p>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button type="button" onclick="closePilihModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button type="button" onclick="konfirmasiPilihJadwal()" class="px-4 py-2 btn-orange rounded-lg font-medium transition-colors">Pilih Jadwal</button>
        </div>
    </div>
</div>

<!-- Konfirmasi Batalkan Jadwal Modal -->
<div id="batalJadwalModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Batalkan Jadwal</h3>
            <button type="button" onclick="closeBatalModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <p class="text-gray-700">Apakah Anda yakin ingin membatalkan jadwal ini?</p>
            
            <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Tanggal:</span>
                    <span id="modalBatalTanggal" class="font-semibold text-gray-800">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Waktu:</span>
                    <span id="modalBatalWaktu" class="font-medium text-gray-800">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Mata Pelajaran:</span>
                    <span id="modalBatalMapel" class="font-medium text-gray-800">-</span>
                </div>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <p class="text-sm text-green-800">
                    Sisa pertemuan Anda akan dikembalikan setelah pembatalan.
                </p>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button type="button" onclick="closeBatalModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Tidak</button>
            <button type="button" onclick="konfirmasiBatalJadwal()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">Ya, Batalkan</button>
        </div>
    </div>
</div>

<script>
let tableJadwalTersedia;
let tableJadwalDipilih;
let selectedPeriodeFilter = 'week';
let selectedMapelFilter = 'all';
let selectedPeriodeDipilihFilter = 'week';
let currentJadwalData = null;
let currentBatalJadwalData = null;

function escapeHtml(value) {
    if (value === null || value === undefined) return '';
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

// Dummy data - Jadwal Tersedia
const jadwalTersediaData = [
    {
        jadwal_id: 1,
        tanggal: '2026-01-15',
        tanggal_display: '15 Jan 2026',
        hari: 'Kamis',
        waktu: '14:00 - 16:00',
        pengajar: 'Ahmad Wijaya',
        mapel: 'Python',
        mapel_key: 'python'
    },
    {
        jadwal_id: 2,
        tanggal: '2026-01-16',
        tanggal_display: '16 Jan 2026',
        hari: 'Jumat',
        waktu: '10:00 - 12:00',
        pengajar: 'Dewi Kusuma',
        mapel: 'JavaScript',
        mapel_key: 'javascript'
    },
    {
        jadwal_id: 3,
        tanggal: '2026-01-17',
        tanggal_display: '17 Jan 2026',
        hari: 'Sabtu',
        waktu: '09:00 - 11:00',
        pengajar: 'Ahmad Wijaya',
        mapel: 'React.js',
        mapel_key: 'react'
    },
    {
        jadwal_id: 4,
        tanggal: '2026-01-18',
        tanggal_display: '18 Jan 2026',
        hari: 'Minggu',
        waktu: '14:00 - 16:00',
        pengajar: 'Eko Prasetyo',
        mapel: 'Node.js',
        mapel_key: 'nodejs'
    }
];

// Dummy data - Jadwal yang sudah dipilih
const jadwalDipilihData = [
    {
        jadwal_id: 10,
        tanggal: '2026-01-20',
        tanggal_display: '20 Jan 2026',
        hari: 'Senin',
        waktu: '14:00 - 16:00',
        pengajar: 'Ahmad Wijaya',
        mapel: 'Python'
    },
    {
        jadwal_id: 11,
        tanggal: '2026-01-22',
        tanggal_display: '22 Jan 2026',
        hari: 'Rabu',
        waktu: '10:00 - 12:00',
        pengajar: 'Dewi Kusuma',
        mapel: 'JavaScript'
    }
];

function applyFiltersTersedia() {
    if (!tableJadwalTersedia) return;
    tableJadwalTersedia.draw();
}

function applyFiltersDipilih() {
    if (!tableJadwalDipilih) return;
    tableJadwalDipilih.draw();
}

function openPilihModal(jadwalId) {
    const jadwal = jadwalTersediaData.find(j => j.jadwal_id === jadwalId);
    if (!jadwal) return;
    
    currentJadwalData = jadwal;
    
    document.getElementById('modalJadwalTanggal').textContent = jadwal.tanggal_display + ', ' + jadwal.hari;
    document.getElementById('modalJadwalWaktu').textContent = jadwal.waktu;
    document.getElementById('modalJadwalPengajar').textContent = jadwal.pengajar;
    document.getElementById('modalJadwalMapel').textContent = jadwal.mapel;
    
    document.getElementById('pilihJadwalModal').classList.remove('hidden');
    document.getElementById('pilihJadwalModal').classList.add('flex');
}

function closePilihModal() {
    document.getElementById('pilihJadwalModal').classList.add('hidden');
    document.getElementById('pilihJadwalModal').classList.remove('flex');
    currentJadwalData = null;
}

function konfirmasiPilihJadwal() {
    alert('Jadwal berhasil dipilih!');
    closePilihModal();
}

function openBatalModal(jadwalId) {
    const jadwal = jadwalDipilihData.find(j => j.jadwal_id === jadwalId);
    if (!jadwal) return;
    
    currentBatalJadwalData = jadwal;
    
    document.getElementById('modalBatalTanggal').textContent = jadwal.tanggal_display + ', ' + jadwal.hari;
    document.getElementById('modalBatalWaktu').textContent = jadwal.waktu;
    document.getElementById('modalBatalMapel').textContent = jadwal.mapel;
    
    document.getElementById('batalJadwalModal').classList.remove('hidden');
    document.getElementById('batalJadwalModal').classList.add('flex');
}

function closeBatalModal() {
    document.getElementById('batalJadwalModal').classList.add('hidden');
    document.getElementById('batalJadwalModal').classList.remove('flex');
    currentBatalJadwalData = null;
}

function konfirmasiBatalJadwal() {
    alert('Jadwal berhasil dibatalkan!');
    closeBatalModal();
}

document.addEventListener('DOMContentLoaded', () => {
    // Custom filter for Jadwal Tersedia (Mapel)
    $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
        if (!settings?.nTable || settings.nTable.id !== 'tableJadwalTersedia') return true;
        if (!tableJadwalTersedia) return true;

        const row = tableJadwalTersedia.row(dataIndex).data();
        if (!row) return true;

        const mapelOk = selectedMapelFilter === 'all' || row.mapel_key === selectedMapelFilter;
        return mapelOk;
    });

    tableJadwalTersedia = $('#tableJadwalTersedia').DataTable({
        data: jadwalTersediaData,
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
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: (data, type, row) => {
                    if (type !== 'display') return '';
                    return `
                        <button type="button" onclick="openPilihModal(${row.jadwal_id})" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium btn-orange transition-colors">
                            Pilih
                        </button>
                    `;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-jadwal-id', String(data.jadwal_id));
        },
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            zeroRecords: "Tidak ada jadwal tersedia",
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

    tableJadwalDipilih = $('#tableJadwalDipilih').DataTable({
        data: jadwalDipilihData,
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
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: (data, type, row) => {
                    if (type !== 'display') return '';
                    return `
                        <button type="button" onclick="openBatalModal(${row.jadwal_id})" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-red-600 text-white hover:bg-red-700 transition-colors">
                            Batalkan
                        </button>
                    `;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-jadwal-id', String(data.jadwal_id));
        },
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            zeroRecords: "Belum ada jadwal yang dipilih",
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

    // Move filters next to length menu - Jadwal Tersedia
    const wrapper1 = document.getElementById('tableJadwalTersedia_wrapper');
    const lengthEl1 = wrapper1?.querySelector('.dt-length') || wrapper1?.querySelector('.dataTables_length');
    const filterEl1 = document.getElementById('jadwalDtFilters');
    if (lengthEl1 && filterEl1) {
        lengthEl1.classList.add('flex', 'items-end', 'gap-3', 'flex-wrap');
        filterEl1.classList.remove('hidden');
        lengthEl1.appendChild(filterEl1);
    }

    // Move filters next to length menu - Jadwal Dipilih
    const wrapper2 = document.getElementById('tableJadwalDipilih_wrapper');
    const lengthEl2 = wrapper2?.querySelector('.dt-length') || wrapper2?.querySelector('.dataTables_length');
    const filterEl2 = document.getElementById('jadwalDipilihDtFilters');
    if (lengthEl2 && filterEl2) {
        lengthEl2.classList.add('flex', 'items-end', 'gap-3', 'flex-wrap');
        filterEl2.classList.remove('hidden');
        lengthEl2.appendChild(filterEl2);
    }

    const periodeSelect = document.getElementById('filterPeriode');
    const mapelSelect = document.getElementById('filterMapel');
    const periodeDipilihSelect = document.getElementById('filterPeriodeDipilih');

    if (periodeSelect) {
        selectedPeriodeFilter = periodeSelect.value || 'week';
        periodeSelect.addEventListener('change', () => {
            selectedPeriodeFilter = periodeSelect.value || 'week';
            applyFiltersTersedia();
        });
    }

    if (mapelSelect) {
        selectedMapelFilter = mapelSelect.value || 'all';
        mapelSelect.addEventListener('change', () => {
            selectedMapelFilter = mapelSelect.value || 'all';
            applyFiltersTersedia();
        });
    }

    if (periodeDipilihSelect) {
        selectedPeriodeDipilihFilter = periodeDipilihSelect.value || 'week';
        periodeDipilihSelect.addEventListener('change', () => {
            selectedPeriodeDipilihFilter = periodeDipilihSelect.value || 'week';
            applyFiltersDipilih();
        });
    }

    applyFiltersTersedia();
    applyFiltersDipilih();
});
</script>
