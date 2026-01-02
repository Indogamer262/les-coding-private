<div class="flex flex-col gap-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-6 text-white">
        <h2 class="text-2xl font-bold">Absensi Murid ✓</h2>
        <p class="mt-2 text-blue-100">Catat kehadiran dan materi pertemuan</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md border border-blue-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Pertemuan Hari Ini</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">3</p>
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

        <div class="bg-white rounded-lg shadow-md border border-green-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Sudah Diabsen</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">1</p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-orange-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Belum Diabsen</p>
                    <p class="text-3xl font-bold text-orange-600 mt-2">2</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-purple-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Minggu Ini</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">5</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9333ea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 3v18h18"></path>
                        <path d="m19 9-5 5-4-4-3 3"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance List -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Pertemuan Hari Ini</h2>
                <div class="text-sm text-gray-600">Kamis, 02 Jan 2026</div>
            </div>
        </div>
        <div class="p-6 space-y-4">
            <!-- Attendance Card 1 - Completed -->
            <div class="border-2 border-green-200 bg-green-50 rounded-lg p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-3 py-1 bg-green-600 text-white rounded-full text-xs font-semibold">✓ Selesai</span>
                            <span class="text-lg font-bold text-gray-800">14:00 - 16:00</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Python Programming</h3>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-semibold text-blue-600">
                                BS
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Budi Santoso</p>
                                <p class="text-xs text-gray-500">#MRD001</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-3 border border-green-200 mb-3">
                    <p class="text-xs text-gray-600 mb-1"><strong>Status:</strong> <span class="text-green-700">Hadir</span></p>
                    <p class="text-xs text-gray-600"><strong>Materi:</strong> Python Functions & Modules, praktik membuat calculator sederhana</p>
                </div>
                <div class="flex gap-2">
                    <button onclick="viewAttendance(1)" class="flex-1 px-4 py-2 bg-white border border-green-300 text-green-700 rounded-lg font-medium hover:bg-green-50 transition-colors">
                        Lihat Detail
                    </button>
                    <button onclick="editAttendance(1)" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                        Edit Absensi
                    </button>
                </div>
            </div>

            <!-- Attendance Card 2 - Pending -->
            <div class="border-2 border-orange-200 bg-orange-50 rounded-lg p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-3 py-1 bg-orange-600 text-white rounded-full text-xs font-semibold">⏱ Belum Diabsen</span>
                            <span class="text-lg font-bold text-gray-800">16:00 - 18:00</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">React.js Development</h3>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center font-semibold text-purple-600">
                                AS
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Ani Susanti</p>
                                <p class="text-xs text-gray-500">#MRD003</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-3 border border-orange-200 mb-3">
                    <p class="text-xs text-orange-800">⚠️ Harap isi absensi dan materi setelah pertemuan selesai</p>
                </div>
                <button onclick="openAttendanceModal(2)" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    Isi Absensi
                </button>
            </div>

            <!-- Attendance Card 3 - Upcoming -->
            <div class="border-2 border-gray-200 bg-gray-50 rounded-lg p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-3 py-1 bg-gray-600 text-white rounded-full text-xs font-semibold">⏰ Mendatang</span>
                            <span class="text-lg font-bold text-gray-800">19:00 - 21:00</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">JavaScript Fundamentals</h3>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center font-semibold text-emerald-600">
                                DP
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Dedi Prasetyo</p>
                                <p class="text-xs text-gray-500">#MRD005</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-3 border border-gray-200">
                    <p class="text-xs text-gray-600">Absensi dapat diisi setelah pertemuan dimulai</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Attendance Modal -->
<div id="attendanceModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Isi Absensi Murid</h3>
            <button onclick="closeAttendanceModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form class="p-6 space-y-4">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm text-blue-800"><strong>Jadwal:</strong> Kamis, 16:00 - 18:00</p>
                <p class="text-sm text-blue-800"><strong>Murid:</strong> Ani Susanti (#MRD003)</p>
                <p class="text-sm text-blue-800"><strong>Mata Pelajaran:</strong> React.js Development</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Kehadiran</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-green-500 transition-colors has-[:checked]:border-green-500 has-[:checked]:bg-green-50">
                        <input type="radio" name="status" value="hadir" class="mr-3 w-4 h-4 text-green-600" checked>
                        <div>
                            <p class="font-semibold text-gray-800">Hadir</p>
                            <p class="text-xs text-gray-600">Murid hadir mengikuti les</p>
                        </div>
                    </label>
                    <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-red-500 transition-colors has-[:checked]:border-red-500 has-[:checked]:bg-red-50">
                        <input type="radio" name="status" value="tidak-hadir" class="mr-3 w-4 h-4 text-red-600">
                        <div>
                            <p class="font-semibold text-gray-800">Tidak Hadir</p>
                            <p class="text-xs text-gray-600">Murid tidak hadir</p>
                        </div>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Materi Pertemuan</label>
                <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="5" placeholder="Tuliskan materi yang diajarkan pada pertemuan ini...&#10;&#10;Contoh:&#10;- Introduction to React Hooks&#10;- useState dan useEffect basics&#10;- Praktik membuat counter app"></textarea>
                <p class="text-xs text-gray-500 mt-1">Deskripsikan topik dan aktivitas pembelajaran yang dilakukan</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan (Opsional)</label>
                <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Tambahkan catatan jika diperlukan, misalnya progres murid atau hal penting lainnya..."></textarea>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button onclick="closeAttendanceModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button onclick="saveAttendance()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Simpan Absensi</button>
        </div>
    </div>
</div>

<script>
function openAttendanceModal(id) {
    document.getElementById('attendanceModal').classList.remove('hidden');
    document.getElementById('attendanceModal').classList.add('flex');
}

function closeAttendanceModal() {
    document.getElementById('attendanceModal').classList.add('hidden');
    document.getElementById('attendanceModal').classList.remove('flex');
}

function saveAttendance() {
    alert('Absensi berhasil disimpan!');
    closeAttendanceModal();
    location.reload();
}

function viewAttendance(id) {
    alert('Viewing attendance details for ID: ' + id);
}

function editAttendance(id) {
    openAttendanceModal(id);
}
</script>
