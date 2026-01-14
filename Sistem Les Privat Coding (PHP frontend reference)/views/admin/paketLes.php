<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Paket Les</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola nama paket, harga, jumlah pertemuan, dan status dijual</p>
        </div>
        <button type="button" onclick="openAddPackageModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m7.5 4.27 9 5.15"></path>
                <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                <path d="m3.3 7 8.7 5 8.7-5"></path>
                <path d="M12 22V12"></path>
            </svg>
            Tambah Paket
        </button>
    </div>

    <!-- Packages Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Paket</h2>
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="inline-flex rounded-lg border border-gray-300 overflow-hidden">
                        <button type="button" id="filterStatusActive" onclick="setStatusFilter('active')" class="px-4 py-2 text-sm font-medium bg-blue-600 text-white">Aktif</button>
                        <button type="button" id="filterStatusInactive" onclick="setStatusFilter('inactive')" class="px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50">Nonaktif</button>
                    </div>
                    <input type="text" id="searchPackage" placeholder="Cari nama paket..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="applyFilters()">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table id="tablePaketAdmin" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Nama Paket</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4 text-center">Jumlah Pertemuan</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Add Package Modal -->
<div id="packageModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800" id="packageModalTitle">Tambah Paket Baru</h3>
            <button type="button" onclick="closePackageModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form id="packageForm" class="p-6 space-y-4" onsubmit="handlePackageSubmit(event)">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Paket</label>
                <input name="packageName" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Paket 4 Pertemuan" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Pertemuan</label>
                    <input name="meetingCount" type="number" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: 4" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                    <input name="price" type="number" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: 250000" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="sellStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                </select>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button type="button" onclick="closePackageModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button type="submit" form="packageForm" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Simpan</button>
        </div>
    </div>
</div>

<script>
let selectedStatusFilter = 'active';
let tablePaketAdmin;

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

// Dummy data mengikuti nama kolom dari DB `katalogpaket`
// - id_paket, nama_paket, jml_pertemuan, masa_aktif_hari, harga, status_dijual (1 dijual, 0 tidak)
const paketAdminData = [
    { id_paket: 1, nama_paket: 'Paket 4 Pertemuan', jml_pertemuan: 4, masa_aktif_hari: 14, harga: 250000, status_dijual: 1, status: 'active' },
    { id_paket: 2, nama_paket: 'Paket 8 Pertemuan', jml_pertemuan: 8, masa_aktif_hari: 28, harga: 450000, status_dijual: 1, status: 'active' },
    { id_paket: 3, nama_paket: 'Paket 12 Pertemuan', jml_pertemuan: 12, masa_aktif_hari: 45, harga: 600000, status_dijual: 0, status: 'inactive' }
];

function setStatusFilter(status) {
    selectedStatusFilter = status;
    updateStatusFilterButtons();
    applyFilters();
}

function updateStatusFilterButtons() {
    const activeBtn = document.getElementById('filterStatusActive');
    const inactiveBtn = document.getElementById('filterStatusInactive');
    if (!activeBtn || !inactiveBtn) return;

    if (selectedStatusFilter === 'active') {
        activeBtn.className = 'px-4 py-2 text-sm font-medium bg-blue-600 text-white';
        inactiveBtn.className = 'px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50';
    } else {
        activeBtn.className = 'px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50';
        inactiveBtn.className = 'px-4 py-2 text-sm font-medium bg-blue-600 text-white';
    }
}

function applyFilters() {
    if (!tablePaketAdmin) return;
    const searchInput = document.getElementById('searchPackage');
    const searchValue = (searchInput ? searchInput.value : '');
    tablePaketAdmin.search(searchValue).draw();
}

function openAddPackageModal() {
    openPackageModal('Tambah Paket Baru');
}

function openPackageModal(title) {
    const modal = document.getElementById('packageModal');
    const form = document.getElementById('packageForm');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.getElementById('packageModalTitle').textContent = title;

    if (form) form.reset();
}

function closePackageModal() {
    const modal = document.getElementById('packageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function handlePackageSubmit(event) {
    event.preventDefault();
    alert('Paket berhasil disimpan!');
    closePackageModal();
}

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('packageModal');

    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closePackageModal();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            closePackageModal();
        }
    });

    updateStatusFilterButtons();
    applyFilters();
});

function editPackage(id) {
    openPackageModal('Edit Paket');
    // Load package data here
}

function searchPackages(value) {
    const input = document.getElementById('searchPackage');
    if (input) input.value = value;
    applyFilters();
}

function togglePackageStatus(id, btnEl) {
    if (!tablePaketAdmin) return;
    const rowNode = btnEl ? btnEl.closest('tr') : null;
    const dtRow = rowNode ? tablePaketAdmin.row(rowNode) : null;
    const current = dtRow ? dtRow.data() : null;
    if (!current) return;

    const currentStatus = current.status;
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    const action = newStatus === 'active' ? 'mengaktifkan' : 'menonaktifkan';
    if (!confirm('Apakah Anda yakin ingin ' + action + ' paket ini?')) return;

    current.status = newStatus;
    current.status_dijual = newStatus === 'active' ? 1 : 0;
    dtRow.data(current).invalidate();
    tablePaketAdmin.draw(false);

    alert('Status berhasil diubah!');
}

document.addEventListener('DOMContentLoaded', () => {
    // Custom filter: status
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        if (!tablePaketAdmin || settings.nTable !== tablePaketAdmin.table().node()) return true;
        const rowData = tablePaketAdmin.row(dataIndex).data();
        if (!rowData) return true;
        return rowData.status === selectedStatusFilter;
    });

    tablePaketAdmin = $('#tablePaketAdmin').DataTable({
        data: paketAdminData,
        columns: [
            {
                data: 'nama_paket',
                render: (val, type) => {
                    if (type !== 'display') return val;
                    return `<p class="font-medium text-gray-800">${escapeHtml(val)}</p>`;
                }
            },
            {
                data: 'harga',
                render: (val, type) => {
                    if (type !== 'display') return Number(val || 0);
                    return `<span class="text-gray-700">${escapeHtml(formatRupiah(val))}</span>`;
                }
            },
            {
                data: 'jml_pertemuan',
                className: 'text-center',
                render: (val, type) => {
                    if (type !== 'display') return Number(val || 0);
                    return `<span class="text-gray-700">${escapeHtml(val)}</span>`;
                }
            },
            {
                data: 'status',
                className: 'text-center',
                render: (val, type) => {
                    if (type !== 'display') return val;
                    const isActive = val === 'active';
                    const label = isActive ? 'Aktif' : 'Nonaktif';
                    const cls = isActive ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700';
                    return `<span class="package-status-badge px-4 py-1 rounded-full text-xs font-medium ${cls}">${label}</span>`;
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: (data, type, row) => {
                    if (type !== 'display') return '';
                    const isActive = row.status === 'active';
                    const toggleLabel = isActive ? 'Nonaktifkan' : 'Aktifkan';
                    const toggleClass = isActive
                        ? 'bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50'
                        : 'bg-blue-600 text-white hover:bg-blue-700';

                    return `
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" onclick="editPackage(${row.id_paket})" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">Edit</button>
                            <button type="button" onclick="togglePackageStatus(${row.id_paket}, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium ${toggleClass} transition-colors" title="${toggleLabel}">${toggleLabel}</button>
                        </div>
                    `;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-status', data.status);
            row.setAttribute('data-package-id', String(data.id_paket));
            if (data.status !== 'active') $(row).addClass('opacity-60');
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
        order: [[0, 'asc']]
    });

    updateStatusFilterButtons();
    applyFilters();
});
</script>
