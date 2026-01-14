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
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Nama Mata Pelajaran</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="subjectsTableBody">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50 transition-colors" data-status="active" data-subject-id="1">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">Python</p>
                        </td>
                        <td class="px-6 py-4 text-gray-700">Pemrograman Python dasar hingga lanjutan</td>
                        <td class="px-6 py-4 text-center">
                            <span class="subject-status-badge px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editSubject(1)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="toggleSubjectStatus(1, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50 transition-colors" title="Nonaktifkan">
                                    Nonaktifkan
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50 transition-colors" data-status="active" data-subject-id="2">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">JavaScript</p>
                        </td>
                        <td class="px-6 py-4 text-gray-700">Pemrograman web dengan JavaScript</td>
                        <td class="px-6 py-4 text-center">
                            <span class="subject-status-badge px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editSubject(2)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="toggleSubjectStatus(2, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50 transition-colors" title="Nonaktifkan">
                                    Nonaktifkan
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="hover:bg-gray-50 transition-colors" data-status="active" data-subject-id="3">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">HTML & CSS</p>
                        </td>
                        <td class="px-6 py-4 text-gray-700">Dasar-dasar pembuatan website</td>
                        <td class="px-6 py-4 text-center">
                            <span class="subject-status-badge px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editSubject(3)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="toggleSubjectStatus(3, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50 transition-colors" title="Nonaktifkan">
                                    Nonaktifkan
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 4 -->
                    <tr class="hover:bg-gray-50 transition-colors" data-status="active" data-subject-id="4">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">React.js</p>
                        </td>
                        <td class="px-6 py-4 text-gray-700">Framework JavaScript untuk membangun UI</td>
                        <td class="px-6 py-4 text-center">
                            <span class="subject-status-badge px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editSubject(4)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="toggleSubjectStatus(4, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50 transition-colors" title="Nonaktifkan">
                                    Nonaktifkan
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 5 - Nonaktif -->
                    <tr class="hover:bg-gray-50 transition-colors opacity-60" data-status="inactive" data-subject-id="5">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">Node.js</p>
                        </td>
                        <td class="px-6 py-4 text-gray-700">Backend development dengan Node.js</td>
                        <td class="px-6 py-4 text-center">
                            <span class="subject-status-badge px-4 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">Nonaktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editSubject(5)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="toggleSubjectStatus(5, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors" title="Aktifkan">
                                    Aktifkan
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
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
    const searchInput = document.getElementById('searchSubject');
    const searchValue = (searchInput ? searchInput.value : '').toLowerCase();
    const rows = document.querySelectorAll('#subjectsTableBody tr');

    rows.forEach(row => {
        const rowStatus = row.getAttribute('data-status');
        const namaMapel = row.querySelector('td:first-child p');
        const nameText = namaMapel ? namaMapel.textContent.toLowerCase() : '';

        const matchesStatus = rowStatus === selectedStatusFilter;
        const matchesSearch = nameText.includes(searchValue);
        row.style.display = (matchesStatus && matchesSearch) ? '' : 'none';
    });
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
    const row = btnEl ? btnEl.closest('tr') : document.querySelector('[data-subject-id="' + id + '"]');
    if (!row) return;
    
    const currentStatus = row.getAttribute('data-status');
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    const action = newStatus === 'active' ? 'mengaktifkan' : 'menonaktifkan';
    
    if (!confirm('Apakah Anda yakin ingin ' + action + ' mata pelajaran ini?')) {
        return;
    }

    row.setAttribute('data-status', newStatus);
    row.classList.toggle('opacity-60', newStatus !== 'active');

    const badge = row.querySelector('.subject-status-badge');
    if (badge) {
        if (newStatus === 'active') {
            badge.textContent = 'Aktif';
            badge.classList.remove('bg-gray-100', 'text-gray-700');
            badge.classList.add('bg-green-100', 'text-green-700');
        } else {
            badge.textContent = 'Nonaktif';
            badge.classList.remove('bg-green-100', 'text-green-700');
            badge.classList.add('bg-gray-100', 'text-gray-700');
        }
    }
    
    // Update button text and style
    btnEl.classList.remove(
        'bg-gray-100', 'text-gray-800', 'border', 'border-gray-300', 'hover:bg-gray-50',
        'bg-blue-600', 'text-white', 'hover:bg-blue-700'
    );

    if (newStatus === 'active') {
        btnEl.textContent = 'Nonaktifkan';
        btnEl.title = 'Nonaktifkan';
        btnEl.classList.add('bg-gray-100', 'text-gray-800', 'border', 'border-gray-300', 'hover:bg-gray-50');
    } else {
        btnEl.textContent = 'Aktifkan';
        btnEl.title = 'Aktifkan';
        btnEl.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700');
    }

    alert('Status berhasil diubah!');

    applyFilters();
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

    updateStatusFilterButtons();
    applyFilters();
});
</script>
