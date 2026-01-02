<div class="flex flex-col gap-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg shadow-lg p-6 text-white">
        <h2 class="text-2xl font-bold">Jadwal Les 📅</h2>
        <p class="mt-2 text-purple-100">Pilih jadwal dan pantau pertemuan Anda</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md border border-blue-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Jadwal Saya</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">4</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                        <line x1="16" x2="16" y1="2" y2="6"></line>
                        <line x1="8" x2="8" y1="2" y2="6"></line>
                        <line x1="3" x2="21" y1="10" y2="10"></line>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-emerald-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Jadwal Tersedia</p>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">12</p>
                </div>
                <div class="bg-emerald-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-emerald-600 mt-3 font-medium">Dapat dipilih</p>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-purple-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Pertemuan Minggu Ini</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">2</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9333ea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="16"></line>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- My Schedules -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Jadwal Les Saya</h2>
        </div>
        <div class="p-6 space-y-3">
            <!-- Schedule Card 1 -->
            <div class="border-2 border-blue-200 bg-blue-50 rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-3 py-1 bg-blue-600 text-white rounded-full text-xs font-semibold">Senin</span>
                            <span class="text-lg font-bold text-gray-800">14:00 - 16:00</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Python Programming</h3>
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span>Ahmad Wijaya</span>
                            </div>
                        </div>
                    </div>
                    <button onclick="cancelSchedule(1)" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors">
                        Batalkan
                    </button>
                </div>
                <div class="bg-white rounded-lg p-3 border border-blue-200">
                    <p class="text-xs text-blue-800"><strong>Pertemuan berikutnya:</strong> Senin, 06 Jan 2026</p>
                </div>
            </div>

            <!-- Schedule Card 2 -->
            <div class="border-2 border-purple-200 bg-purple-50 rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-3 py-1 bg-purple-600 text-white rounded-full text-xs font-semibold">Rabu</span>
                            <span class="text-lg font-bold text-gray-800">16:00 - 18:00</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">React.js Development</h3>
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span>Ahmad Wijaya</span>
                            </div>
                        </div>
                    </div>
                    <button onclick="cancelSchedule(2)" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors">
                        Batalkan
                    </button>
                </div>
                <div class="bg-white rounded-lg p-3 border border-purple-200">
                    <p class="text-xs text-purple-800"><strong>Pertemuan berikutnya:</strong> Rabu, 08 Jan 2026</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Schedules -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Jadwal Tersedia</h2>
                <div class="flex gap-2">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all">Semua Mata Pelajaran</option>
                        <option value="python">Python</option>
                        <option value="javascript">JavaScript</option>
                        <option value="react">React.js</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Hari & Waktu</th>
                        <th class="px-6 py-4">Pengajar</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Selasa</p>
                                <p class="text-sm text-gray-600">10:00 - 12:00</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center font-semibold text-purple-600 text-xs">
                                    DK
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Dewi Kusuma</p>
                                    <p class="text-xs text-gray-500">#PGJ002</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">JavaScript</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Tersedia</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <button onclick="selectSchedule(1)" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                                    Pilih Jadwal
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Kamis</p>
                                <p class="text-sm text-gray-600">14:00 - 16:00</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center font-semibold text-emerald-600 text-xs">
                                    EP
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Eko Prasetyo</p>
                                    <p class="text-xs text-gray-500">#PGJ003</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Python</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Tersedia</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <button onclick="selectSchedule(2)" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                                    Pilih Jadwal
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Jumat</p>
                                <p class="text-sm text-gray-600">09:00 - 11:00</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center font-semibold text-purple-600 text-xs">
                                    DK
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Dewi Kusuma</p>
                                    <p class="text-xs text-gray-500">#PGJ002</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">HTML & CSS</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Tersedia</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <button onclick="selectSchedule(3)" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                                    Pilih Jadwal
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
        <div class="flex items-start gap-4">
            <div class="bg-blue-100 p-3 rounded-lg flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-blue-900 mb-2">Informasi Penting</h3>
                <ul class="space-y-2 text-sm text-blue-800">
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600">•</span>
                        <span>Sistem otomatis menggunakan paket dengan masa aktif paling pendek saat Anda memilih jadwal</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600">•</span>
                        <span>Pastikan Anda memiliki paket aktif sebelum memilih jadwal</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600">•</span>
                        <span>Anda dapat membatalkan jadwal maksimal 24 jam sebelum pertemuan</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function selectSchedule(id) {
    if (confirm('Pilih jadwal ini? Sistem akan otomatis menggunakan paket dengan masa aktif paling pendek.')) {
        alert('Jadwal berhasil dipilih! Sisa pertemuan Anda telah dikurangi.');
        location.reload();
    }
}

function cancelSchedule(id) {
    if (confirm('Batalkan jadwal ini? Kuota pertemuan akan dikembalikan ke paket Anda.')) {
        alert('Jadwal berhasil dibatalkan!');
        location.reload();
    }
}
</script>
