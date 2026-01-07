<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
            <p class="text-sm text-gray-600 mt-1">Selamat datang di Sistem Les Privat Coding General</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Murid -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Murid</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">24</p>
                    <p class="text-xs text-gray-500 mt-1">Aktif belajar</p>
                </div>
                <div class="w-14 h-14 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Pengajar -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Pengajar</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">8</p>
                    <p class="text-xs text-gray-500 mt-1">Aktif mengajar</p>
                </div>
                <div class="w-14 h-14 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#047857" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pendapatan Bulan Ini -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pendapatan Bulan Ini</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">Rp 12.5jt</p>
                    <p class="text-xs text-green-600 mt-1 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></svg>
                    </p>
                </div>
                <div class="w-14 h-14 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Menunggu Pembayaran -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pembelian Paket</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">5</p>
                    <p class="text-xs text-orange-600 mt-1">Perlu verifikasi    </p>
                </div>
                <div class="w-14 h-14 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="14" x="2" y="5" rx="2"/>
                        <line x1="2" x2="22" y1="10" y2="10"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Terisi Minggu Ini Section -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Jadwal Terisi Minggu Ini</h2>
            <a href="dashboard.php?page=jadwalLes" class="text-sm text-blue-600 font-medium hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs uppercase text-gray-600 font-semibold tracking-wide border-b border-gray-200">
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Hari & Waktu</th>
                        <th class="px-6 py-4">Pengajar</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                        <th class="px-6 py-4">Murid</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">06 Jan 2026</p>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Senin</p>
                                <p class="text-sm text-gray-600">14:00 - 16:00</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800">Ahmad Wijaya</td>
                        <td class="px-6 py-4 text-gray-600">Python</td>
                        <td class="px-6 py-4 font-medium text-gray-800">Budi Santoso</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">08 Jan 2026</p>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Rabu</p>
                                <p class="text-sm text-gray-600">16:00 - 18:00</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800">Ahmad Wijaya</td>
                        <td class="px-6 py-4 text-gray-600">React.js</td>
                        <td class="px-6 py-4 font-medium text-gray-800">Ani Susanti</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">09 Jan 2026</p>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Kamis</p>
                                <p class="text-sm text-gray-600">14:00 - 16:00</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800">Eko Prasetyo</td>
                        <td class="px-6 py-4 text-gray-600">Python</td>
                        <td class="px-6 py-4 font-medium text-gray-800">Dedi Prasetyo</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">10 Jan 2026</p>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Jumat</p>
                                <p class="text-sm text-gray-600">09:00 - 11:00</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800">Dewi Kusuma</td>
                        <td class="px-6 py-4 text-gray-600">HTML & CSS</td>
                        <td class="px-6 py-4 font-medium text-gray-800">Siti Rahma</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
