<div class="flex flex-col gap-6">
    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Kelola Jadwal</h1>
                <p class="text-gray-600 mt-1">Kelola jadwal les untuk pengajar dan murid</p>
            </div>
            <button onclick="openScheduleModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                    <line x1="16" x2="16" y1="2" y2="6"></line>
                    <line x1="8" x2="8" y1="2" y2="6"></line>
                    <line x1="3" x2="21" y1="10" y2="10"></line>
                    <path d="M8 14h.01"></path>
                    <path d="M12 14h.01"></path>
                    <path d="M16 14h.01"></path>
                </svg>
                Buat Jadwal Baru
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md border border-blue-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Jadwal</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">45</p>
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
                    <p class="text-gray-600 text-sm font-medium">Minggu Ini</p>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">12</p>
                </div>
                <div class="bg-emerald-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-emerald-600 mt-3 font-medium">Jadwal aktif</p>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-purple-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Jadwal Terisi</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">38</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9333ea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <line x1="19" x2="19" y1="8" y2="14"></line>
                        <line x1="22" x2="16" y1="11" y2="11"></line>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-purple-600 mt-3 font-medium">Ada murid terdaftar</p>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-orange-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Slot Kosong</p>
                    <p class="text-3xl font-bold text-orange-600 mt-2">7</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-orange-600 mt-3 font-medium">Belum ada murid</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pengajar</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Pengajar</option>
                    <option value="1">Ahmad Wijaya</option>
                    <option value="2">Dewi Kusuma</option>
                    <option value="3">Eko Prasetyo</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Mata Pelajaran</option>
                    <option value="python">Python</option>
                    <option value="javascript">JavaScript</option>
                    <option value="html-css">HTML & CSS</option>
                    <option value="react">React.js</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Status</option>
                    <option value="filled">Terisi</option>
                    <option value="empty">Kosong</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Hari</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Hari</option>
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                    <option value="sabtu">Sabtu</option>
                    <option value="minggu">Minggu</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Schedules Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Jadwal</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Hari & Waktu</th>
                        <th class="px-6 py-4">Pengajar</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                        <th class="px-6 py-4">Murid</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <!-- Row 1 - Filled Schedule -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Senin</p>
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
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Terisi</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewSchedule(1)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                                <button onclick="editSchedule(1)" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteSchedule(1)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 - Empty Schedule -->
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
                            <span class="text-sm text-gray-500 italic">Belum ada murid</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-medium">Kosong</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewSchedule(2)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                                <button onclick="editSchedule(2)" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteSchedule(2)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 - Another filled schedule -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Rabu</p>
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
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center font-semibold text-purple-600 text-xs">
                                    AS
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Ani Susanti</p>
                                    <p class="text-xs text-gray-500">#MRD003</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Terisi</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewSchedule(3)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                                <button onclick="editSchedule(3)" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteSchedule(3)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <p class="text-sm text-gray-600">Menampilkan <span class="font-medium">3</span> dari <span class="font-medium">45</span> jadwal</p>
            <div class="flex gap-2">
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Previous</button>
                <button class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm font-medium">1</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">2</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Next</button>
            </div>
        </div>
    </div>
</div>

<!-- Schedule Modal -->
<div id="scheduleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800" id="scheduleModalTitle">Buat Jadwal Baru</h3>
            <button onclick="closeScheduleModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form class="p-6 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pengajar</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Pengajar --</option>
                        <option value="1">Ahmad Wijaya (#PGJ001)</option>
                        <option value="2">Dewi Kusuma (#PGJ002)</option>
                        <option value="3">Eko Prasetyo (#PGJ003)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        <option value="python">Python</option>
                        <option value="javascript">JavaScript</option>
                        <option value="html-css">HTML & CSS</option>
                        <option value="react">React.js</option>
                        <option value="nodejs">Node.js</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hari</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Hari --</option>
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                        <option value="minggu">Minggu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                    <input type="time" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                    <input type="time" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
                <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Catatan atau deskripsi jadwal..."></textarea>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button onclick="closeScheduleModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button onclick="saveSchedule()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Simpan</button>
        </div>
    </div>
</div>

<script>
function openScheduleModal() {
    document.getElementById('scheduleModal').classList.remove('hidden');
    document.getElementById('scheduleModal').classList.add('flex');
    document.getElementById('scheduleModalTitle').textContent = 'Buat Jadwal Baru';
}

function editSchedule(id) {
    document.getElementById('scheduleModal').classList.remove('hidden');
    document.getElementById('scheduleModal').classList.add('flex');
    document.getElementById('scheduleModalTitle').textContent = 'Edit Jadwal';
}

function closeScheduleModal() {
    document.getElementById('scheduleModal').classList.add('hidden');
    document.getElementById('scheduleModal').classList.remove('flex');
}

function saveSchedule() {
    alert('Jadwal berhasil disimpan!');
    closeScheduleModal();
    location.reload();
}

function viewSchedule(id) {
    alert('Viewing schedule details for ID: ' + id);
}

function deleteSchedule(id) {
    if (confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
        alert('Jadwal berhasil dihapus!');
        location.reload();
    }
}
</script>
