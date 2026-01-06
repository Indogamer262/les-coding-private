<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Jadwal</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola jadwal les untuk pengajar dan murid</p>
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

    <!-- Schedules Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Jadwal</h2>
                <input type="text" id="searchSchedule" placeholder="Cari jadwal..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="searchSchedules(this.value)">
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
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="schedulesTableBody">
                    <!-- Row 1 - Filled Schedule -->
                    <tr class="hover:bg-gray-50 transition-colors" data-schedule-id="1">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">06 Jan 2026</p>
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
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editSchedule(1)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="deleteSchedule(1)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-red-600 text-white hover:bg-red-700 transition-colors" title="Hapus">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 - Empty Schedule (no student) -->
                    <tr class="hover:bg-gray-50 transition-colors" data-schedule-id="2">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">07 Jan 2026</p>
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
                            <p class="text-gray-500 italic whitespace-nowrap">Belum terisi</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editSchedule(2)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="deleteSchedule(2)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-red-600 text-white hover:bg-red-700 transition-colors" title="Hapus">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 - Another filled schedule -->
                    <tr class="hover:bg-gray-50 transition-colors" data-schedule-id="3">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">08 Jan 2026</p>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Rabu</p>
                                <p class="text-sm text-gray-600">16:00 - 18:00</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Ahmad Wijaya</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">React.js</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Ani Susanti</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="editSchedule(3)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">
                                    Edit
                                </button>
                                <button type="button" onclick="deleteSchedule(3)" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-red-600 text-white hover:bg-red-700 transition-colors" title="Hapus">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Schedule Modal -->
<div id="scheduleModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800" id="scheduleModalTitle">Buat Jadwal Baru</h3>
            <button type="button" onclick="closeScheduleModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form id="scheduleForm" class="p-6 space-y-4" onsubmit="handleScheduleSubmit(event)">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pengajar</label>
                    <select name="pengajar" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">-- Pilih Pengajar --</option>
                        <option value="1">Ahmad Wijaya</option>
                        <option value="2">Dewi Kusuma</option>
                        <option value="3">Eko Prasetyo</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                    <select name="mataPelajaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        <option value="python">Python</option>
                        <option value="javascript">JavaScript</option>
                        <option value="html-css">HTML & CSS</option>
                        <option value="react">React.js</option>
                        <option value="nodejs">Node.js</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" id="scheduleTanggal" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="updateHariFromTanggal(this.value)">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hari</label>
                    <input type="text" name="hari" id="scheduleHari" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600" placeholder="Otomatis dari tanggal" readonly>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                    <input type="time" name="jamMulai" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                    <input type="time" name="jamSelesai" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button type="button" onclick="closeScheduleModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button type="submit" form="scheduleForm" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Simpan</button>
        </div>
    </div>
</div>

<script>
const hariNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

function updateHariFromTanggal(dateValue) {
    if (!dateValue) {
        document.getElementById('scheduleHari').value = '';
        return;
    }
    const date = new Date(dateValue);
    const dayIndex = date.getDay();
    document.getElementById('scheduleHari').value = hariNames[dayIndex];
}

function searchSchedules(value) {
    const searchValue = value.toLowerCase();
    const rows = document.querySelectorAll('#schedulesTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
}

function openScheduleModal() {
    document.getElementById('scheduleForm').reset();
    document.getElementById('scheduleHari').value = '';
    document.getElementById('scheduleModal').classList.remove('hidden');
    document.getElementById('scheduleModal').classList.add('flex');
    document.getElementById('scheduleModalTitle').textContent = 'Buat Jadwal Baru';
}

function editSchedule(id) {
    document.getElementById('scheduleModal').classList.remove('hidden');
    document.getElementById('scheduleModal').classList.add('flex');
    document.getElementById('scheduleModalTitle').textContent = 'Edit Jadwal';
    // Pre-fill form with schedule data (mock)
}

function closeScheduleModal() {
    document.getElementById('scheduleModal').classList.add('hidden');
    document.getElementById('scheduleModal').classList.remove('flex');
}

function handleScheduleSubmit(event) {
    event.preventDefault();
    alert('Jadwal berhasil disimpan!');
    closeScheduleModal();
}

function deleteSchedule(id) {
    if (confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
        const row = document.querySelector(`tr[data-schedule-id="${id}"]`);
        if (row) row.remove();
        alert('Jadwal berhasil dihapus!');
    }
}
</script>
