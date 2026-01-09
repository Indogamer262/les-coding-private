<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Dashboard Murid</h2>
            <p class="text-sm text-gray-600 mt-1">Selamat datang kembali, <span class="font-semibold">Budi Santoso</span>!</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Paket Aktif</p>
                    <p class="text-2xl font-bold text-gray-800">2</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                        <line x1="16" x2="16" y1="2" y2="6"></line>
                        <line x1="8" x2="8" y1="2" y2="6"></line>
                        <line x1="3" x2="21" y1="10" y2="10"></line>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Sisa Pertemuan</p>
                    <p class="text-2xl font-bold text-emerald-600">11</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9333ea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tingkat Kehadiran</p>
                    <p class="text-2xl font-bold text-purple-600">92%</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Jadwal Minggu Ini</p>
                    <p class="text-2xl font-bold text-orange-600">3</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Main Sections Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Paket Aktif Saya Section -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Paket Aktif Saya</h2>
            </div>
            <div class="p-6 space-y-4">
                <!-- Paket Card 1 - Dengan Warning -->
                <div class="border border-orange-300 bg-orange-50 rounded-lg p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-gray-800 text-lg">Paket 4 Pertemuan (30 Hari)</h3>
                                <span class="px-2 py-1 bg-orange-500 text-white text-xs font-medium rounded-full">Segera Berakhir</span>
                            </div>
                            <p class="text-sm text-orange-700 mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                                Kadaluwarsa dalam 3 hari
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Dibeli: 28 Des 2025</p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-gray-700">Sisa Pertemuan</span>
                            <span class="text-gray-800 font-semibold">0 / 4 (Habis)</span>
                        </div>
                        <div class="w-full bg-orange-200 rounded-full h-2.5">
                            <div class="bg-orange-500 h-2.5 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                <!-- Paket Card 2 -->
                <div class="border border-gray-200 rounded-lg p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-gray-800 text-lg">Paket 12 Pertemuan (30 Hari)</h3>
                                <span class="px-2 py-1 bg-green-500 text-white text-xs font-medium rounded-full">Aktif</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Berlaku hingga 14 Feb 2026</p>
                            <p class="text-xs text-gray-500 mt-1">Dibeli: 15 Jan 2026</p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-gray-700">Sisa Pertemuan</span>
                            <span class="text-gray-800 font-semibold">11 / 12</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 8.3%"></div>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-gray-600 mt-3 bg-blue-50 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline mr-1">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 16v-4"></path>
                        <path d="M12 8h.01"></path>
                    </svg>
                    Saat Anda memilih jadwal, sistem akan otomatis menggunakan dari paket yang masa aktifnya lebih pendek dahulu.
                </p>
            </div>
        </div>

        <!-- Jadwal Mendatang Section -->
        <div class="bg-white rounded-lg shadow-md border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Jadwal Mendatang</h2>
                <a href="?page=jadwalLes" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</a>
            </div>
            <div class="p-6 space-y-4">
                <!-- Jadwal Card 1 - Hari Ini -->
                <div class="border border-blue-200 bg-blue-50 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <div class="bg-blue-600 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <m18 16 4-4-4-4"></path>
                                <path d="m6 8-4 4 4 4"></path>
                                <path d="m14.5 4-5 16"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="px-2 py-0.5 bg-blue-600 text-white text-xs font-medium rounded-full">Hari Ini</span>
                            <h4 class="font-semibold text-gray-800 mt-1">Python Programming</h4>
                            <p class="text-sm text-gray-600 mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                14:00 - 16:00
                            </p>
                            <p class="text-sm text-gray-600 mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Ahmad Wijaya
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Card 2 -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <div class="bg-purple-600 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m18 16 4-4-4-4"></path>
                                <path d="m6 8-4 4 4 4"></path>
                                <path d="m14.5 4-5 16"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="px-2 py-0.5 bg-gray-200 text-gray-700 text-xs font-medium rounded-full">Besok</span>
                            <h4 class="font-semibold text-gray-800 mt-1">React.js</h4>
                            <p class="text-sm text-gray-600 mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                16:00 - 18:00
                            </p>
                            <p class="text-sm text-gray-600 mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Ahmad Wijaya
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Card 3 -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <div class="bg-emerald-600 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m18 16 4-4-4-4"></path>
                                <path d="m6 8-4 4 4 4"></path>
                                <path d="m14.5 4-5 16"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="px-2 py-0.5 bg-gray-200 text-gray-700 text-xs font-medium rounded-full">Jumat, 10 Jan</span>
                            <h4 class="font-semibold text-gray-800 mt-1">JavaScript</h4>
                            <p class="text-sm text-gray-600 mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                10:00 - 12:00
                            </p>
                            <p class="text-sm text-gray-600 mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Dewi Kusuma
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
