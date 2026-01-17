<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Dashboard Pengajar</h2>
            <p class="text-sm text-gray-600 mt-1">Selamat datang kembali, <span class="font-semibold">Ahmad Wijaya</span>!</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Murid</p>
                    <p class="text-2xl font-bold text-gray-800">12</p>
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
                    <p class="text-sm text-gray-600">Jadwal Hari Ini</p>
                    <p class="text-2xl font-bold text-emerald-600">5</p>
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
                    <p class="text-sm text-gray-600">Selesai Hari Ini</p>
                    <p class="text-2xl font-bold text-purple-600">3</p>
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
                    <p class="text-sm text-gray-600">Menunggu</p>
                    <p class="text-2xl font-bold text-orange-600">2</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Jadwal Hari Ini -->
        <div class="lg:col-span-1 bg-white rounded-lg shadow-md border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="font-semibold text-gray-800 text-lg">Jadwal Hari Ini</h3>
                <span class="text-sm text-gray-500">5 sesi</span>
            </div>
            <div class="divide-y divide-gray-100 max-h-[500px] overflow-y-auto">
                <!-- Schedule Item 1 - Completed -->
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex gap-4">
                        <div class="text-center min-w-[60px]">
                            <p class="text-lg font-bold text-gray-400 line-through">09:00</p>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">Ahmad Fauzi</h4>
                            <p class="text-sm text-gray-600">Python Programming</p>
                            <div class="mt-2">
                                <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">✓ Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Item 2 - Completed -->
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex gap-4">
                        <div class="text-center min-w-[60px]">
                            <p class="text-lg font-bold text-gray-400 line-through">11:00</p>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">Siti Nurhaliza</h4>
                            <p class="text-sm text-gray-600">JavaScript</p>
                            <div class="mt-2">
                                <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">✓ Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Item 3 - Completed -->
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex gap-4">
                        <div class="text-center min-w-[60px]">
                            <p class="text-lg font-bold text-gray-400 line-through">13:00</p>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">Dewi Lestari</h4>
                            <p class="text-sm text-gray-600">React.js</p>
                            <div class="mt-2">
                                <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">✓ Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Item 4 - Current/Pending -->
                <div class="p-4 bg-blue-50 border-l-4 border-blue-500">
                    <div class="flex gap-4">
                        <div class="text-center min-w-[60px]">
                            <p class="text-lg font-bold text-blue-600">15:00</p>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <h4 class="font-semibold text-gray-800">Rahman Hidayat</h4>
                                <span class="px-2 py-0.5 bg-blue-600 text-white text-xs font-medium rounded-full animate-pulse">Sekarang</span>
                            </div>
                            <p class="text-sm text-gray-600">Python Programming</p>
                            <div class="mt-2">
                                <button class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full hover:bg-blue-700 transition-colors">
                                    Mulai Absensi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Item 5 - Pending -->
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex gap-4">
                        <div class="text-center min-w-[60px]">
                            <p class="text-lg font-bold text-blue-600">17:00</p>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">Lisa Wijaya</h4>
                            <p class="text-sm text-gray-600">UI/UX Design</p>
                            <div class="mt-2">
                                <span class="inline-block px-2 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full">Menunggu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jadwal Mendatang -->
        <div class="lg:col-span-1 bg-white rounded-lg shadow-md border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="font-semibold text-gray-800 text-lg">Jadwal Mendatang</h3>
                <a href="?page=jadwalLes" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100 max-h-[500px] overflow-y-auto">
                <!-- Upcoming Item 1 -->
                <div class="p-4 hover:bg-purple-50 transition-colors border-l-4 border-purple-500">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                            <path d="M16 2v4"></path>
                            <path d="M8 2v4"></path>
                            <path d="M3 10h18"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-purple-600 font-medium">Besok • 09:00</p>
                            <h4 class="font-semibold text-gray-800 mt-1">Ahmad Fauzi</h4>
                            <p class="text-sm text-gray-600">Python Programming</p>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Item 2 -->
                <div class="p-4 hover:bg-purple-50 transition-colors border-l-4 border-purple-500">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                            <path d="M16 2v4"></path>
                            <path d="M8 2v4"></path>
                            <path d="M3 10h18"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-purple-600 font-medium">Besok • 14:00</p>
                            <h4 class="font-semibold text-gray-800 mt-1">Dewi Lestari</h4>
                            <p class="text-sm text-gray-600">React.js</p>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Item 3 -->
                <div class="p-4 hover:bg-purple-50 transition-colors border-l-4 border-purple-500">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                            <path d="M16 2v4"></path>
                            <path d="M8 2v4"></path>
                            <path d="M3 10h18"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-purple-600 font-medium">Jumat, 10 Jan • 11:00</p>
                            <h4 class="font-semibold text-gray-800 mt-1">Siti Nurhaliza</h4>
                            <p class="text-sm text-gray-600">JavaScript</p>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Item 4 -->
                <div class="p-4 hover:bg-purple-50 transition-colors border-l-4 border-purple-500">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                            <path d="M16 2v4"></path>
                            <path d="M8 2v4"></path>
                            <path d="M3 10h18"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-purple-600 font-medium">Sabtu, 11 Jan • 09:00</p>
                            <h4 class="font-semibold text-gray-800 mt-1">Budi Santoso</h4>
                            <p class="text-sm text-gray-600">Python Programming</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Catatan Pertemuan Terakhir -->
        <div class="lg:col-span-1 bg-white rounded-lg shadow-md border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="font-semibold text-gray-800 text-lg">Catatan Pertemuan Terakhir</h3>
                <a href="?page=riwayatKehadiran" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100 max-h-[500px] overflow-y-auto">
                <!-- Note Item 1 -->
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-semibold text-blue-600">
                            AF
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-semibold text-gray-800">Ahmad Fauzi</h4>
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full">Hadir</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Python Functions • Hari ini, 09:00</p>
                            <p class="text-sm text-gray-700 mt-2 line-clamp-2">Pemahaman bagus tentang fungsi rekursif. Perlu latihan lebih untuk lambda.</p>
                        </div>
                    </div>
                </div>

                <!-- Note Item 2 -->
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center font-semibold text-purple-600">
                            DL
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-semibold text-gray-800">Dewi Lestari</h4>
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full">Hadir</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">React Hooks • Hari ini, 13:00</p>
                            <p class="text-sm text-gray-700 mt-2 line-clamp-2">Sudah menguasai useState. Lanjut ke useEffect minggu depan.</p>
                        </div>
                    </div>
                </div>

                <!-- Note Item 3 -->
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center font-semibold text-emerald-600">
                            SN
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-semibold text-gray-800">Siti Nurhaliza</h4>
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full">Hadir</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">JavaScript Async • Hari ini, 11:00</p>
                            <p class="text-sm text-gray-700 mt-2 line-clamp-2">Sudah menguasai konsep Promise dengan baik. Siap untuk async/await.</p>
                        </div>
                    </div>
                </div>

                <!-- Note Item 4 - Absent -->
                <div class="p-4 hover:bg-gray-50 transition-colors opacity-75">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center font-semibold text-orange-600">
                            BS
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-semibold text-gray-800">Budi Santoso</h4>
                                <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs rounded-full">Tidak Hadir</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Python OOP • Kemarin, 14:00</p>
                            <p class="text-sm text-gray-500 mt-2 italic">Murid tidak hadir - sakit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
