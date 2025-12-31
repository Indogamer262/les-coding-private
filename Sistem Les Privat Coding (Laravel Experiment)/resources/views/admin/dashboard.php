<div class="flex flex-col gap-6">
    <!-- Stats Cards -->
    <div class="flex flex-wrap gap-6">
        <div class="flex-1 min-w-[240px] bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-sm font-medium text-gray-500">Total Murid</h3>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-3xl font-bold text-gray-800">124</span>
                <span class="text-sm text-green-600">+12%</span>
            </div>
        </div>
        <div class="flex-1 min-w-[240px] bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-sm font-medium text-gray-500">Total Pengajar</h3>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-3xl font-bold text-gray-800">12</span>
                <span class="text-sm text-gray-600">Aktif</span>
            </div>
        </div>
        <div class="flex-1 min-w-[240px] bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-sm font-medium text-gray-500">Pendapatan Bulan Ini</h3>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-3xl font-bold text-gray-800">Rp 45.2Jt</span>
                <span class="text-sm text-green-600">+8%</span>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h2>
            <button class="text-sm text-blue-600 font-medium hover:underline">Lihat Semua</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase text-gray-500 font-semibold tracking-wide">
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Aktivitas</th>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-800">Budi Santoso</td>
                        <td class="px-6 py-4 text-gray-600">Membeli Paket React Basic</td>
                        <td class="px-6 py-4 text-gray-500">2 jam yang lalu</td>
                        <td class="px-6 py-4"><span class="px-2 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700">Sukses</span></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-800">Siti Aminah</td>
                        <td class="px-6 py-4 text-gray-600">Absensi Kelas Python</td>
                        <td class="px-6 py-4 text-gray-500">4 jam yang lalu</td>
                        <td class="px-6 py-4"><span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">Hadir</span></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-800">John Doe</td>
                        <td class="px-6 py-4 text-gray-600">Daftar Baru</td>
                        <td class="px-6 py-4 text-gray-500">1 hari yang lalu</td>
                        <td class="px-6 py-4"><span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
