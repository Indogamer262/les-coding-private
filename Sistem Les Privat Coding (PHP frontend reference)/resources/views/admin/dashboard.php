<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
            <p class="text-sm text-gray-600 mt-1">Selamat datang di Sistem Les Privat Coding General</p>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Murid Card -->
        <div class="bg-white rounded-lg shadow-md border border-blue-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Murid</p>
                    <p class="text-3xl font-bold text-blue-900 mt-2">156</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-green-600 mt-4 font-medium">↑ 12% dari bulan lalu</p>
        </div>

        <!-- Total Pengajar Card -->
        <div class="bg-white rounded-lg shadow-md border border-emerald-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Pengajar</p>
                    <p class="text-3xl font-bold text-emerald-700 mt-2">24</p>
                </div>
                <div class="bg-emerald-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#047857" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-emerald-600 mt-4 font-medium">✓ Semua aktif</p>
        </div>

        <!-- Paket Aktif Card -->
        <div class="bg-white rounded-lg shadow-md border border-purple-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Paket Aktif</p>
                    <p class="text-3xl font-bold text-purple-700 mt-2">89</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m7.5 4.27 9 5.15"></path>
                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                        <path d="m3.3 7 8.7 5 8.7-5"></path>
                        <path d="M12 22V12"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-purple-600 mt-4 font-medium">Terus meningkat</p>
        </div>

        <!-- Pembelian Bulan Ini Card -->
        <div class="bg-white rounded-lg shadow-md border border-orange-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Pembelian Bulan Ini</p>
                    <p class="text-3xl font-bold text-orange-600 mt-2">34</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-orange-600 mt-4 font-medium">↑ 8% dari bulan lalu</p>
        </div>
    </div>

    <!-- Two Main Sections Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Pembelian Terbaru Section -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Pembelian Terbaru</h2>
                <a href="#" class="text-sm text-blue-600 font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                            <th class="px-6 py-4">Murid</th>
                            <th class="px-6 py-4">Paket</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Ahmad Fauzi</td>
                            <td class="px-6 py-4 text-gray-600">React Intermediate</td>
                            <td class="px-6 py-4 text-gray-500">02 Jan 2026</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Siti Nurhaliza</td>
                            <td class="px-6 py-4 text-gray-600">Python Basics</td>
                            <td class="px-6 py-4 text-gray-500">01 Jan 2026</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Budi Santoso</td>
                            <td class="px-6 py-4 text-gray-600">JavaScript Pro</td>
                            <td class="px-6 py-4 text-gray-500">31 Des 2025</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Rini Wijaya</td>
                            <td class="px-6 py-4 text-gray-600">Web Development</td>
                            <td class="px-6 py-4 text-gray-500">30 Des 2025</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paket Mendekati Kadaluwarsa Section -->
        <div class="bg-white rounded-lg shadow-md border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Paket Mendekati Kadaluwarsa</h2>
            </div>
            <div class="p-6 space-y-4">
                <!-- Warning Card 1 -->
                <div class="bg-orange-50 border-l-4 border-orange-500 rounded p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">Rahman Hidayat</p>
                            <p class="text-sm text-gray-600 mt-1">React Advanced</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-xs font-medium text-orange-700">Sisa: 2 pertemuan</span>
                        <span class="text-xs text-orange-600">3 hari</span>
                    </div>
                </div>

                <!-- Warning Card 2 -->
                <div class="bg-orange-50 border-l-4 border-orange-500 rounded p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">Lisa Wijaya</p>
                            <p class="text-sm text-gray-600 mt-1">JavaScript Basics</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-xs font-medium text-orange-700">Sisa: 1 pertemuan</span>
                        <span class="text-xs text-orange-600">5 hari</span>
                    </div>
                </div>

                <!-- Warning Card 3 -->
                <div class="bg-orange-50 border-l-4 border-orange-500 rounded p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">Doni Sutrisno</p>
                            <p class="text-sm text-gray-600 mt-1">Python Pro</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-xs font-medium text-orange-700">Sisa: 3 pertemuan</span>
                        <span class="text-xs text-orange-600">7 hari</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Pertemuan Hari Ini Section -->
    <div class="bg-white rounded-lg shadow-md border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Statistik Pertemuan Hari Ini</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            <!-- Total Jadwal -->
            <div class="flex items-center gap-4">
                <div class="bg-blue-100 p-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                        <line x1="16" x2="16" y1="2" y2="6"></line>
                        <line x1="8" x2="8" y1="2" y2="6"></line>
                        <line x1="3" x2="21" y1="10" y2="10"></line>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Jadwal</p>
                    <p class="text-3xl font-bold text-blue-900">15</p>
                </div>
            </div>

            <!-- Selesai -->
            <div class="flex items-center gap-4">
                <div class="bg-emerald-100 p-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#047857" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">Selesai</p>
                    <p class="text-3xl font-bold text-emerald-700">8</p>
                </div>
            </div>

            <!-- Belum Dimulai -->
            <div class="flex items-center gap-4">
                <div class="bg-gray-100 p-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">Belum Dimulai</p>
                    <p class="text-3xl font-bold text-gray-700">7</p>
                </div>
            </div>
        </div>
    </div>
</div>
