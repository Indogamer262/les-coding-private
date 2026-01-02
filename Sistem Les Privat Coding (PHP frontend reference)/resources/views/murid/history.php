<div class="flex flex-col gap-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-lg shadow-lg p-6 text-white">
        <h2 class="text-2xl font-bold">Riwayat Kehadiran 📝</h2>
        <p class="mt-2 text-emerald-100">Pantau perjalanan belajar Anda</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md border border-green-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Pertemuan</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">16</p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                        <line x1="16" x2="16" y1="2" y2="6"></line>
                        <line x1="8" x2="8" y1="2" y2="6"></line>
                        <line x1="3" x2="21" y1="10" y2="10"></line>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-blue-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Kehadiran</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">14</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-blue-600 mt-3 font-medium">87.5% tingkat kehadiran</p>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-red-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Tidak Hadir</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">2</p>
                </div>
                <div class="bg-red-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" x2="9" y1="9" y2="15"></line>
                        <line x1="9" x2="15" y1="9" y2="15"></line>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-red-600 mt-3 font-medium">12.5% ketidakhadiran</p>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-purple-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Mata Pelajaran</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">3</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9333ea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-purple-600 mt-3 font-medium">Topik yang dipelajari</p>
        </div>
    </div>

    <!-- Progress Section -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Progress Pembelajaran</h2>
        <div class="mb-2 flex items-center justify-between">
            <span class="text-sm text-gray-600">Total Progress</span>
            <span class="text-sm font-semibold text-blue-600">14 / 16 pertemuan selesai (87.5%)</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-blue-600 h-4 rounded-full transition-all" style="width: 87.5%"></div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Periode</option>
                    <option value="week">Minggu Ini</option>
                    <option value="month" selected>Bulan Ini</option>
                    <option value="year">Tahun Ini</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Pelajaran</option>
                    <option value="python">Python</option>
                    <option value="javascript">JavaScript</option>
                    <option value="react">React.js</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Status</option>
                    <option value="hadir">Hadir</option>
                    <option value="tidak-hadir">Tidak Hadir</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Attendance History -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Riwayat Pertemuan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Tanggal & Waktu</th>
                        <th class="px-6 py-4">Pengajar</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Materi</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <!-- Row 1 - Present -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Senin, 30 Des 2025</p>
                                <p class="text-sm text-gray-600">14:00 - 16:00</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center font-semibold text-emerald-600 text-xs">
                                    AW
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Ahmad Wijaya</p>
                                    <p class="text-xs text-gray-500">#PGJ001</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Python</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">✓ Hadir</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-800 max-w-xs">Python Functions & Modules, praktik membuat calculator sederhana</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <button onclick="viewDetail(1)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 - Present -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Rabu, 01 Jan 2026</p>
                                <p class="text-sm text-gray-600">16:00 - 18:00</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center font-semibold text-emerald-600 text-xs">
                                    AW
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Ahmad Wijaya</p>
                                    <p class="text-xs text-gray-500">#PGJ001</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">React.js</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">✓ Hadir</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-800 max-w-xs">Introduction to React Hooks, useState dan useEffect basics</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <button onclick="viewDetail(2)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 - Absent -->
                    <tr class="hover:bg-gray-50 transition-colors opacity-75">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Jumat, 27 Des 2025</p>
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
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">✕ Tidak Hadir</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-500 italic">Anda tidak hadir</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <button onclick="viewDetail(3)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <p class="text-sm text-gray-600">Menampilkan <span class="font-medium">3</span> dari <span class="font-medium">16</span> pertemuan</p>
            <div class="flex gap-2">
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Previous</button>
                <button class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm font-medium">1</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">2</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Next</button>
            </div>
        </div>
    </div>
</div>

<script>
function viewDetail(id) {
    alert('Viewing attendance detail for ID: ' + id);
}
</script>
