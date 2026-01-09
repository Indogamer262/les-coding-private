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
                <input type="text" id="searchPackage" placeholder="Cari nama paket..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="searchPackages(this.value)">
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Nama Paket</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4 text-center">Jumlah Pertemuan</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="packagesTableBody">
                    <tr class="hover:bg-gray-50 transition-colors" data-status="active" data-package-id="1">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">Paket 4 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 text-gray-700">Rp 250.000</td>
                        <td class="px-6 py-4 text-center text-gray-700">4</td>
                        <td class="px-6 py-4 text-center">
                            <span class="package-status-badge px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editPackage(1)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="togglePackageStatus(1, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50 transition-colors" title="Nonaktifkan">
                                    Nonaktifkan
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 transition-colors" data-status="active" data-package-id="2">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">Paket 8 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 text-gray-700">Rp 450.000</td>
                        <td class="px-6 py-4 text-center text-gray-700">8</td>
                        <td class="px-6 py-4 text-center">
                            <span class="package-status-badge px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editPackage(2)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="togglePackageStatus(2, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50 transition-colors" title="Nonaktifkan">
                                    Nonaktifkan
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 transition-colors opacity-60" data-status="inactive" data-package-id="3">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">Paket 12 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 text-gray-700">Rp 600.000</td>
                        <td class="px-6 py-4 text-center text-gray-700">12</td>
                        <td class="px-6 py-4 text-center">
                            <span class="package-status-badge px-4 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">Nonaktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editPackage(3)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="togglePackageStatus(3, this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors" title="Aktifkan">
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
});

function editPackage(id) {
    openPackageModal('Edit Paket');
    // Load package data here
}

function searchPackages(value) {
    const searchValue = value.toLowerCase();
    const rows = document.querySelectorAll('#packagesTableBody tr');
    
    rows.forEach(row => {
        const namaPaket = row.querySelector('td:first-child p');
        if (namaPaket) {
            const text = namaPaket.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        }
    });
}

function togglePackageStatus(id, btnEl) {
    const row = btnEl ? btnEl.closest('tr') : document.querySelector('[data-package-id="' + id + '"]');
    if (!row) return;
    
    const currentStatus = row.getAttribute('data-status');
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    const action = newStatus === 'active' ? 'mengaktifkan' : 'menonaktifkan';
    
    if (!confirm('Apakah Anda yakin ingin ' + action + ' paket ini?')) {
        return;
    }

    row.setAttribute('data-status', newStatus);
    row.classList.toggle('opacity-60', newStatus !== 'active');

    const badge = row.querySelector('.package-status-badge');
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
}
</script>
