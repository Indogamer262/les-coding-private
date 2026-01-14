<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Kehadiran</h1>
            <p class="text-sm text-gray-600 mt-1">Lihat seluruh riwayat kehadiran murid</p>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Kehadiran</h2>
            <div class="mt-4 flex flex-wrap items-end gap-3">
                <div class="w-40">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Periode</label>
                    <select id="filterPeriode" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="all">Semua Periode</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month" selected>Bulan Ini</option>
                    </select>
                </div>
                <div class="w-40">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                    <select id="filterStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="all">Semua</option>
                        <option value="hadir">Hadir</option>
                        <option value="tidak-hadir">Tidak Hadir</option>
                    </select>
                </div>
                <div class="w-36">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Urutkan</label>
                    <select id="sortBy" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="terbaru">Terbaru</option>
                        <option value="terlama">Terlama</option>
                    </select>
                </div>
                <div class="flex-1"></div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Cari</label>
                    <input type="text" id="searchAttendance" placeholder="Cari kehadiran..." class="px-2 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="applyFilters()">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table id="tableKehadiranAdmin" class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Tanggal & Waktu</th>
                        <th class="px-6 py-4">Pengajar</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                        <th class="px-6 py-4">Murid</th>
                        <th class="px-6 py-4">Materi</th>
                        <th class="px-6 py-4 text-center">Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="attendanceTableBody">
                    <!-- Row 1 - Present -->
                    <tr class="hover:bg-gray-50 transition-colors" data-status="hadir">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">30 Des 2025, Senin</p>
                            <p class="text-sm text-gray-600">14:00 - 16:00</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Ahmad Wijaya</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Python</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Budi Santoso</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-800">Python Functions & Modules</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="status-badge status-hadir">Hadir</span>
                        </td>
                    </tr>

                    <!-- Row 2 - Absent -->
                    <tr class="hover:bg-gray-50 transition-colors" data-status="tidak-hadir">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">31 Des 2025, Selasa</p>
                            <p class="text-sm text-gray-600">10:00 - 12:00</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Dewi Kusuma</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">JavaScript</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Ani Susanti</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-800">-</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="status-badge status-tidak-hadir">Tidak Hadir</span>
                        </td>
                    </tr>

                    <!-- Row 3 - Present -->
                    <tr class="hover:bg-gray-50 transition-colors" data-status="hadir">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">02 Jan 2026, Kamis</p>
                            <p class="text-sm text-gray-600">14:00 - 16:00</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Ahmad Wijaya</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">React.js</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Budi Santoso</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-800">React Components & Props</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="status-badge status-hadir">Hadir</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function applyFilters() {
    const searchValue = document.getElementById('searchAttendance').value.toLowerCase();
    const statusFilter = document.getElementById('filterStatus').value;
    const rows = document.querySelectorAll('#attendanceTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const rowStatus = row.getAttribute('data-status') || '';
        
        let matchesSearch = text.includes(searchValue);
        let matchesStatus = statusFilter === 'all' || rowStatus === statusFilter;
        
        row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
    });
}

// Initialize DataTable
let tableKehadiranAdmin = new DataTable('#tableKehadiranAdmin');
</script>