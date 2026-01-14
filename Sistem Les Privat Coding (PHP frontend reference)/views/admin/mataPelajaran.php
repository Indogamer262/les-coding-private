<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Mata Pelajaran</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola daftar mata pelajaran yang tersedia</p>
        </div>
        <button type="button" onclick="openAddSubjectModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                <line x1="12" y1="6" x2="12" y2="14"></line>
                <line x1="8" y1="10" x2="16" y2="10"></line>
            </svg>
            Tambah Mata Pelajaran
        </button>
    </div>

    <!-- Subjects Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Mata Pelajaran</h2>
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="inline-flex rounded-lg border border-gray-300 overflow-hidden">
                        <button type="button" id="filterStatusActive" onclick="setStatusFilter('active')" class="px-4 py-2 text-sm font-medium bg-blue-600 text-white">Aktif</button>
                        <button type="button" id="filterStatusInactive" onclick="setStatusFilter('inactive')" class="px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50">Nonaktif</button>
                    </div>
                    <input type="text" id="searchSubject" placeholder="Cari mata pelajaran..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="applyFilters()">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table id="tableMapelAdmin" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Nama Mata Pelajaran</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Subject Modal -->
<div id="subjectModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800" id="subjectModalTitle">Tambah Mata Pelajaran</h3>
            <button type="button" onclick="closeSubjectModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form id="subjectForm" class="p-6 space-y-4" onsubmit="handleSubjectSubmit(event)">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Mata Pelajaran</label>
                <input name="subjectName" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Python" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Deskripsi singkat mata pelajaran..."></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                </select>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button type="button" onclick="closeSubjectModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button type="submit" form="subjectForm" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Simpan</button>
        </div>
    </div>
</div>

<script>
let selectedStatusFilter = 'active';
let tableMapelAdmin;

function escapeHtml(value) {
    if (value === null || value === undefined) return '';
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

// Dummy data mengikuti nama kolom dari DB `mata_pelajaran`
// - id_mapel, nama_mapel, deskripsiMapel, status (1 aktif, 0 nonaktif)
const mapelAdminData = [
    { id_mapel: 1, nama_mapel: 'Python', deskripsiMapel: 'Pemrograman Python dasar hingga lanjutan', status_db: 1, status: 'active' },
    { id_mapel: 2, nama_mapel: 'JavaScript', deskripsiMapel: 'Pemrograman web dengan JavaScript', status_db: 1, status: 'active' },
    { id_mapel: 3, nama_mapel: 'HTML & CSS', deskripsiMapel: 'Dasar-dasar pembuatan website', status_db: 1, status: 'active' },
    { id_mapel: 4, nama_mapel: 'React.js', deskripsiMapel: 'Framework JavaScript untuk membangun UI', status_db: 1, status: 'active' },
    { id_mapel: 5, nama_mapel: 'Node.js', deskripsiMapel: 'Backend development dengan Node.js', status_db: 0, status: 'inactive' }
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
    if (!tableMapelAdmin) return;

    const searchInput = document.getElementById('searchSubject');
    const searchValue = (searchInput ? searchInput.value : '');
    tableMapelAdmin.search(searchValue).draw();
}

function searchSubjects(value) {
    const input = document.getElementById('searchSubject');
    if (input) input.value = value;
    applyFilters();
}

function openAddSubjectModal() {
    openSubjectModal('Tambah Mata Pelajaran');
}

function openSubjectModal(title) {
    const modal = document.getElementById('subjectModal');
    const form = document.getElementById('subjectForm');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.getElementById('subjectModalTitle').textContent = title;

    if (form) form.reset();
}

function closeSubjectModal() {
    const modal = document.getElementById('subjectModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function handleSubjectSubmit(event) {
    event.preventDefault();
    alert('Mata pelajaran berhasil disimpan!');
    closeSubjectModal();
}

function editSubject(id) {
    openSubjectModal('Edit Mata Pelajaran');
    // Load subject data here
}

function toggleSubjectStatus(id, btnEl) {
    if (!tableMapelAdmin) return;

    const rowNode = btnEl ? btnEl.closest('tr') : null;
    const dtRow = rowNode ? tableMapelAdmin.row(rowNode) : null;
    const current = dtRow ? dtRow.data() : null;
    if (!current) return;

    const currentStatus = current.status;
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    const action = newStatus === 'active' ? 'mengaktifkan' : 'menonaktifkan';
    if (!confirm('Apakah Anda yakin ingin ' + action + ' mata pelajaran ini?')) return;

    current.status = newStatus;
    current.status_db = newStatus === 'active' ? 1 : 0;
    dtRow.data(current).invalidate();
    tableMapelAdmin.draw(false);

    alert('Status berhasil diubah!');
}

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('subjectModal');

    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeSubjectModal();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            closeSubjectModal();
        }
    });

    // Custom filter: status
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        if (!tableMapelAdmin || settings.nTable !== tableMapelAdmin.table().node()) return true;
        const rowData = tableMapelAdmin.row(dataIndex).data();
        if (!rowData) return true;
        return rowData.status === selectedStatusFilter;
    });

    tableMapelAdmin = $('#tableMapelAdmin').DataTable({
        data: mapelAdminData,
        columns: [
            {
                data: 'nama_mapel',
                render: (val, type) => {
                    if (type !== 'display') return val;
                    return `<p class="font-medium text-gray-800">${escapeHtml(val)}</p>`;
                }
            },
            {
                data: 'deskripsiMapel',
                render: (val, type) => {
                    if (type !== 'display') return val;
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
                    return `<span class="subject-status-badge px-4 py-1 rounded-full text-xs font-medium ${cls}">${label}</span>`;
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
                            <button type="button" onclick="editSubject(${row.id_mapel})" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">Edit</button>
                            <button type="button" onclick="toggleSubjectStatus(${row.id_mapel}, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium ${toggleClass} transition-colors" title="${toggleLabel}">${toggleLabel}</button>
                        </div>
                    `;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-status', data.status);
            row.setAttribute('data-subject-id', String(data.id_mapel));
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
