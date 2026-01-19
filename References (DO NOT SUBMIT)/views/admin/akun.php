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

            <!-- Filters -->
            <div id="akunDtFilters" class="hidden flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <label class="text-sm whitespace-nowrap">Role</label>
                    <select id="filterRole" class="h-9 px-3 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" selected>Semua</option>
                        <option value="murid">Murid</option>
                        <option value="pengajar">Pengajar</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-sm whitespace-nowrap">Status</label>
                    <div class="h-9 inline-flex rounded-lg border border-gray-300 overflow-hidden">
                        <button type="button" id="filterStatusActive" onclick="setStatusFilter('active')" class="h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-blue-600 text-white">Aktif</button>
                        <button type="button" id="filterStatusInactive" onclick="setStatusFilter('inactive')" class="h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-white text-gray-700 hover:bg-gray-50">Nonaktif</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 py-6">
            <table id="tableAkunAdmin" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
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
let tableAkunAdmin;
let selectedRoleFilter = 'all';
let selectedStatusFilter = 'active';

function escapeHtml(value) {
    if (value === null || value === undefined) return '';
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function roleLabel(role) {
    if (role === 'pengajar') return 'Pengajar';
    if (role === 'admin') return 'Admin';
    return 'Murid';
}

function applyFilters() {
    if (!tableAkunAdmin) return;
    tableAkunAdmin.draw();
}

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
        activeBtn.className = 'h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-blue-600 text-white';
        inactiveBtn.className = 'h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-white text-gray-700 hover:bg-gray-50';
    } else {
        activeBtn.className = 'h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-white text-gray-700 hover:bg-gray-50';
        inactiveBtn.className = 'h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-blue-600 text-white';
    }
}

const akunAdminData = [
    {
        account_id: 1,
        id: 'USR-0001',
        nama: 'Budi Santoso',
        email: 'budi.santoso@gmail.com',
        role: 'murid',
        status: 'active'
    },
    {
        account_id: 2,
        id: 'USR-0002',
        nama: 'Ahmad Wijaya',
        email: 'ahmad.wijaya@gmail.com',
        role: 'pengajar',
        status: 'active'
    },
    {
        account_id: 3,
        id: 'USR-0003',
        nama: 'Siti Rahma',
        email: 'siti.rahma@gmail.com',
        role: 'murid',
        status: 'inactive'
    },
    {
        account_id: 4,
        id: 'USR-0004',
        nama: 'Admin 1',
        email: 'admin1@gmail.com',
        role: 'admin',
        status: 'active'
    }
];

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

    // DataTable dengan tampilan standar jQuery DataTables
    tableAkunAdmin = $('#tableAkunAdmin').DataTable({
        data: akunAdminData,
        columns: [
            {
                data: 'id',
                render: (data, type) => {
                    if (type === 'display') {
                        return `<span class="font-mono text-sm font-medium text-gray-800">${escapeHtml(data)}</span>`;
                    }
                    return data;
                }
            },
            {
                data: 'nama',
                render: (data, type) => {
                    if (type === 'display') {
                        return `<span class="font-medium text-gray-800">${escapeHtml(data)}</span>`;
                    }
                    return data;
                }
            },
            {
                data: 'email',
                render: (data, type) => {
                    if (type === 'display') {
                        return `<span class="text-gray-700">${escapeHtml(data)}</span>`;
                    }
                    return data;
                }
            },
            {
                data: 'role',
                className: 'text-center',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    const label = roleLabel(data);
                    const cls = data === 'admin'
                        ? 'bg-purple-100 text-purple-700'
                        : (data === 'pengajar' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700');
                    return `<span class="px-4 py-1 ${cls} rounded-full text-xs font-medium">${label}</span>`;
                }
            },
            {
                data: 'status',
                className: 'text-center',
                render: (data, type) => {
                    if (type !== 'display') return data;
                    const isActive = data === 'active';
                    const label = isActive ? 'Aktif' : 'Nonaktif';
                    const cls = isActive ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700';
                    return `<span class="account-status-badge px-4 py-1 rounded-full text-xs font-medium ${cls}">${label}</span>`;
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
                    const toggleTitle = toggleLabel;
                    const toggleClass = isActive
                        ? 'bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50'
                        : 'bg-blue-600 text-white hover:bg-blue-700';

                    return `
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" onclick="editAccount(${row.account_id})" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">Edit</button>
                            <button type="button" onclick="toggleStatus(${row.account_id}, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium ${toggleClass} transition-colors" title="${toggleTitle}">${toggleLabel}</button>
                        </div>
                    `;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-role', data.role);
            row.setAttribute('data-status', data.status);
            row.setAttribute('data-account-id', String(data.account_id));
            if (data.status !== 'active') $(row).addClass('opacity-60');
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

    // Custom filter (Role + Status)
    $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
        if (!settings?.nTable || settings.nTable.id !== 'tableAkunAdmin') return true;
        if (!tableAkunAdmin) return true;

        const row = tableAkunAdmin.row(dataIndex).data();
        if (!row) return true;

        const roleOk = selectedRoleFilter === 'all' || row.role === selectedRoleFilter;
        const statusOk = selectedStatusFilter === 'all' || row.status === selectedStatusFilter;
        return roleOk && statusOk;
    });

    const roleSelect = document.getElementById('filterRole');

    if (roleSelect) {
        selectedRoleFilter = roleSelect.value || 'all';
        roleSelect.addEventListener('change', () => {
            selectedRoleFilter = roleSelect.value || 'all';
            applyFilters();
        });
    }

    updateStatusFilterButtons();

    // Apply initial filters
    applyFilters();

    // Pindahkan filter select ke area "Tampilkan ... data"
    const wrapper = document.getElementById('tableAkunAdmin_wrapper');
    const lengthEl = wrapper?.querySelector('.dt-length') || wrapper?.querySelector('.dataTables_length');
    const filterEl = document.getElementById('akunDtFilters');
    if (lengthEl && filterEl) {
        lengthEl.classList.add('flex', 'items-end', 'gap-3', 'flex-wrap');
        filterEl.classList.remove('hidden');
        lengthEl.appendChild(filterEl);
    }

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
    $(row).toggleClass('opacity-60', newStatus !== 'active');

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

    // Update data di DataTable
    if (tableAkunAdmin) {
        const dtRow = tableAkunAdmin.row(row);
        if (dtRow) {
            const current = dtRow.data();
            if (current) {
                current.status = newStatus;
                dtRow.data(current).invalidate();
            }
        }
    }

    alert('Status berhasil diubah!');
}
</script>
