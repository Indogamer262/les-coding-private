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
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Log</h2>
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="inline-flex rounded-lg border border-gray-300 overflow-hidden">
                        <button type="button" id="filterSemua" onclick="setLogFilter('semua')" class="px-4 py-2 text-sm font-medium bg-blue-600 text-white">Semua</button>
                        <button type="button" id="filterMurid" onclick="setLogFilter('murid')" class="px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50">Murid</button>
                        <button type="button" id="filterPengajar" onclick="setLogFilter('pengajar')" class="px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50">Pengajar</button>
                        <button type="button" id="filterAdmin" onclick="setLogFilter('admin')" class="px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50">Admin</button>
                    </div>
                    <input type="text" id="searchLog" placeholder="Cari aktivitas..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="applyFilters()">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">ID Log</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Aktivitas</th>
                        <th class="px-6 py-4">ID Akun</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="logTableBody">
                    <!-- Sample Row 1 - Admin -->
                    <tr class="hover:bg-gray-50 transition-colors" data-role="admin" data-log-id="1">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-medium text-gray-800">LOG-0001</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">13 Jan 2026, 09:15</td>
                        <td class="px-6 py-4">
                            <p class="text-gray-800">Admin menambahkan paket baru "Paket 16 Pertemuan"</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm text-gray-700">USR-0001</span>
                        </td>
                    </tr>

                    <!-- Sample Row 2 - Murid -->
                    <tr class="hover:bg-gray-50 transition-colors" data-role="murid" data-log-id="2">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-medium text-gray-800">LOG-0002</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">13 Jan 2026, 08:45</td>
                        <td class="px-6 py-4">
                            <p class="text-gray-800">Murid Budi Santoso melakukan pembelian paket</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm text-gray-700">USR-0012</span>
                        </td>
                    </tr>

                    <!-- Sample Row 3 - Pengajar -->
                    <tr class="hover:bg-gray-50 transition-colors" data-role="pengajar" data-log-id="3">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-medium text-gray-800">LOG-0003</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">12 Jan 2026, 16:30</td>
                        <td class="px-6 py-4">
                            <p class="text-gray-800">Pengajar Ahmad Wijaya mengisi absensi jadwal JDW-0045</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm text-gray-700">USR-0005</span>
                        </td>
                    </tr>

                    <!-- Sample Row 4 - Admin -->
                    <tr class="hover:bg-gray-50 transition-colors" data-role="admin" data-log-id="4">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-medium text-gray-800">LOG-0004</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">12 Jan 2026, 14:20</td>
                        <td class="px-6 py-4">
                            <p class="text-gray-800">Admin memverifikasi pembayaran PL-0015</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm text-gray-700">USR-0001</span>
                        </td>
                    </tr>

                    <!-- Sample Row 5 - Murid -->
                    <tr class="hover:bg-gray-50 transition-colors" data-role="murid" data-log-id="5">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-medium text-gray-800">LOG-0005</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">12 Jan 2026, 10:00</td>
                        <td class="px-6 py-4">
                            <p class="text-gray-800">Murid Ani Susanti login ke sistem</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm text-gray-700">USR-0018</span>
                        </td>
                    </tr>

                    <!-- Sample Row 6 - Pengajar -->
                    <tr class="hover:bg-gray-50 transition-colors" data-role="pengajar" data-log-id="6">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-medium text-gray-800">LOG-0006</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">11 Jan 2026, 15:45</td>
                        <td class="px-6 py-4">
                            <p class="text-gray-800">Pengajar Dewi Kusuma memperbarui profil</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm text-gray-700">USR-0007</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
let selectedLogFilter = 'semua';

function setLogFilter(filter) {
    selectedLogFilter = filter;
    updateLogFilterButtons();
    applyFilters();
}

function updateLogFilterButtons() {
    const buttons = ['Semua', 'Murid', 'Pengajar', 'Admin'];
    const ids = ['filterSemua', 'filterMurid', 'filterPengajar', 'filterAdmin'];
    const values = ['semua', 'murid', 'pengajar', 'admin'];

    ids.forEach((id, index) => {
        const btn = document.getElementById(id);
        if (!btn) return;

        if (values[index] === selectedLogFilter) {
            btn.className = 'px-4 py-2 text-sm font-medium bg-blue-600 text-white';
        } else {
            btn.className = 'px-4 py-2 text-sm font-medium bg-white text-gray-700 hover:bg-gray-50';
        }
    });
}

function applyFilters() {
    const searchInput = document.getElementById('searchLog');
    const searchValue = (searchInput ? searchInput.value : '').toLowerCase();
    const rows = document.querySelectorAll('#logTableBody tr');

    rows.forEach(row => {
        const rowRole = row.getAttribute('data-role');
        const aktivitas = row.querySelector('td:nth-child(3) p');
        const aktivitasText = aktivitas ? aktivitas.textContent.toLowerCase() : '';

        const matchesFilter = selectedLogFilter === 'semua' || rowRole === selectedLogFilter;
        const matchesSearch = aktivitasText.includes(searchValue);
        row.style.display = (matchesFilter && matchesSearch) ? '' : 'none';
    });
}

document.addEventListener('DOMContentLoaded', () => {
    updateLogFilterButtons();
    applyFilters();
});
</script>
