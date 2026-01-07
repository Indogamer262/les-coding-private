<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Akun</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola akun Murid dan Pengajar</p>
        </div>
        <button onclick="openAddAccountModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <line x1="19" x2="19" y1="8" y2="14"></line>
                <line x1="22" x2="16" y1="11" y2="11"></line>
            </svg>
            Tambah Akun
        </button>
    </div>

    <!-- Accounts Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Akun</h2>
            <div class="mt-4 flex flex-wrap items-end gap-3">
                <div class="w-40">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Akun</label>
                    <select id="filterRole" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="all">Semua</option>
                        <option value="murid">Murid</option>
                        <option value="pengajar">Pengajar</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="w-40">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                    <select id="filterStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="all">Semua</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
                <div class="flex-1"></div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Cari</label>
                    <input type="text" id="searchAccount" placeholder="Cari nama atau email..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="applyFilters()">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Role</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="accountsTableBody">
                    <!-- Sample Row 1 - Murid Active -->
                    <tr class="hover:bg-gray-50 transition-colors" data-role="murid" data-status="active">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div>
                                    <p class="font-medium text-gray-800">Budi Santoso</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700">budi.santoso@gmail.com</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-4 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Murid</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="account-status-badge px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editAccount(1)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="toggleStatus(1, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50 transition-colors" title="Nonaktifkan">
                                    Nonaktifkan
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Sample Row 2 - Pengajar Active -->
                    <tr class="hover:bg-gray-50 transition-colors" data-role="pengajar" data-status="active">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div>
                                    <p class="font-medium text-gray-800">Ahmad Wijaya</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700">ahmad.wijaya@gmail.com</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-4 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-medium">Pengajar</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="account-status-badge px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editAccount(2)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="toggleStatus(2, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50 transition-colors" title="Nonaktifkan">
                                    Nonaktifkan
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Sample Row 3 - Murid Inactive -->
                    <tr class="hover:bg-gray-50 transition-colors opacity-60" data-role="murid" data-status="inactive">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div>
                                    <p class="font-medium text-gray-800">Siti Rahma</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700">siti.rahma@gmail.com</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-4 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Murid</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="account-status-badge px-4 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">Nonaktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editAccount(3)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="toggleStatus(3, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors" title="Aktifkan">
                                    Aktifkan
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Sample Row 4 - Admin Active -->
                    <tr class="hover:bg-gray-50 transition-colors" data-role="admin" data-status="active">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div>
                                    <p class="font-medium text-gray-800">Admin 1</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700">admin1@gmail.com</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-4 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-medium">Admin</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="account-status-badge px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editAccount(4)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="toggleStatus(4, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50 transition-colors" title="Nonaktifkan">
                                    Nonaktifkan
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Account Modal -->
<div id="accountModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800" id="modalTitle">Tambah Akun Baru</h3>
            <button onclick="closeAccountModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form id="accountForm" class="p-6 space-y-4" onsubmit="handleAccountSubmit(event)">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama lengkap">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="murid">Murid</option>
                        <option value="pengajar">Pengajar</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="email@example.com">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Minimal 8 karakter">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ulangi password">
                </div>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button type="button" onclick="closeAccountModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button type="submit" form="accountForm" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Simpan</button>
        </div>
    </div>
</div>

<script>
function applyFilters() {
    const roleFilter = document.getElementById('filterRole').value;
    const statusFilter = document.getElementById('filterStatus').value;
    const searchQuery = document.getElementById('searchAccount').value.toLowerCase();
    const rows = document.querySelectorAll('#accountsTableBody tr');
    
    rows.forEach(row => {
        const role = row.getAttribute('data-role');
        const status = row.getAttribute('data-status');
        const text = row.textContent.toLowerCase();
        
        let visible = true;
        
        // Role filter
        if (roleFilter !== 'all' && role !== roleFilter) {
            visible = false;
        }
        
        // Status filter
        if (statusFilter !== 'all' && status !== statusFilter) {
            visible = false;
        }
        
        // Search filter
        if (searchQuery && !text.includes(searchQuery)) {
            visible = false;
        }
        
        row.style.display = visible ? '' : 'none';
    });
}

// Expose refresh hook for other handlers (e.g., toggle status)
window.refreshAccountsTable = applyFilters;

function openAddAccountModal() {
    openAccountModal('Tambah Akun Baru');
}

function editAccount(id) {
    openAccountModal('Edit Akun');
    // Load account data here
}

function closeAccountModal() {
    const modal = document.getElementById('accountModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function openAccountModal(title) {
    const modal = document.getElementById('accountModal');
    const form = document.getElementById('accountForm');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.getElementById('modalTitle').textContent = title;

    if (form) form.reset();
}

function handleAccountSubmit(event) {
    event.preventDefault();
    alert('Akun berhasil disimpan!');
    closeAccountModal();
}

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('accountModal');

    // Klik area gelap (overlay) untuk menutup modal.
    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeAccountModal();
        });
    }

    // Tombol Esc untuk menutup modal.
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            closeAccountModal();
        }
    });
});

function toggleStatus(id, btnEl) {
    const row = btnEl ? btnEl.closest('tr') : null;
    if (!row) return;
    
    const currentStatus = row.getAttribute('data-status');
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    const action = newStatus === 'active' ? 'mengaktifkan' : 'menonaktifkan';
    
    if (!confirm('Apakah Anda yakin ingin ' + action + ' akun ini?')) {
        return;
    }

    row.setAttribute('data-status', newStatus);
    row.classList.toggle('opacity-60', newStatus !== 'active');

    const badge = row.querySelector('.account-status-badge');
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

    if (typeof window.refreshAccountsTable === 'function') {
        window.refreshAccountsTable();
    }

    alert('Status berhasil diubah!');
}
</script>
