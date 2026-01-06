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
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Kehadiran</h2>
                <input type="text" id="searchAttendance" placeholder="Cari kehadiran..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="searchAttendance(this.value)">
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Hari & Waktu</th>
                        <th class="px-6 py-4">Pengajar</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                        <th class="px-6 py-4">Murid</th>
                        <th class="px-6 py-4">Materi</th>
                        <th class="px-6 py-4 text-center">Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="attendanceTableBody">
                    <!-- Row 1 - Present -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">30 Des 2025</p>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Senin</p>
                                <p class="text-sm text-gray-600">14:00 - 16:00</p>
                            </div>
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
                            <p class="font-medium text-gray-800">Hadir</p>
                        </td>
                    </tr>

                    <!-- Row 2 - Absent -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">31 Des 2025</p>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Selasa</p>
                                <p class="text-sm text-gray-600">10:00 - 12:00</p>
                            </div>
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
                            <p class="font-medium text-gray-800">Tidak hadir</p>
                        </td>
                    </tr>

                    <!-- Row 3 - Present -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">02 Jan 2026</p>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Kamis</p>
                                <p class="text-sm text-gray-600">14:00 - 16:00</p>
                            </div>
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
                            <p class="font-medium text-gray-800">Hadir</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function searchAttendance(value) {
    const searchValue = value.toLowerCase();
    const rows = document.querySelectorAll('#attendanceTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
}
</script>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Ani Susanti</p>
                                    <p class="text-xs text-gray-500">#MRD003</p>
                                </div>
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
                            <p class="text-sm text-gray-500 italic">Murid tidak hadir</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewAttendanceDetail(2)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 - Present -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Rabu, 01 Jan 2026</p>
                                <p class="text-sm text-gray-600">16:00 - 18:00</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center font-semibold text-blue-600 text-xs">
                                    BS
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Budi Santoso</p>
                                    <p class="text-xs text-gray-500">#MRD001</p>
                                </div>
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
                            <p class="text-sm text-gray-800 line-clamp-2">Introduction to React Hooks, useState dan useEffect basics</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewAttendanceDetail(3)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
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
            <p class="text-sm text-gray-600">Menampilkan <span class="font-medium">3</span> dari <span class="font-medium">124</span> pertemuan</p>
            <div class="flex gap-2">
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Previous</button>
                <button class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm font-medium">1</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">2</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">3</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Next</button>
            </div>
        </div>
    </div>
</div>

<script>
function viewAttendanceDetail(id) {
    alert('Viewing attendance details for ID: ' + id);
}
</script>
