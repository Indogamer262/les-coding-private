<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Jadwal Mengajar</h1>
            <p class="text-sm text-gray-600 mt-1">Jadwal les untuk pengajar</p>
        </div>
    </div>

    <!-- Schedules Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Jadwal</h2>
            <div class="mt-4 flex flex-wrap items-end gap-3">
                <div class="w-40">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Periode</label>
                    <select id="filterPeriode" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="all">Semua Periode</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month" selected>Bulan Ini</option>
                    </select>
                </div>
                <div class="w-36">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Urutkan</label>
                    <select id="sortBy" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="terbaru">Terbaru</option>
                        <option value="terlama">Terlama</option>
                    </select>
                </div>
                <div class="flex-1"></div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Cari</label>
                    <input type="text" id="searchMuridPembayaran" placeholder="Cari mata pelajaran atau murid..." class="px-2 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="applyFilters()">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table id="tableJadwalMurid" class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Hari & Waktu</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                        <th class="px-6 py-4">Pengajar</th>
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
                            <p class="font-medium text-gray-800 whitespace-nowrap">Python</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Budi Santoso</p>
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
                            <p class="font-medium text-gray-800 whitespace-nowrap">JavaScript</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Budi Santoso</p>
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
                            <p class="font-medium text-gray-800 whitespace-nowrap">React.js</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Ani Susanti</p>
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

function applyFilters() {
    const searchValue = document.getElementById('searchMuridPembayaran').value.toLowerCase();
    const rows = document.querySelectorAll('#schedulesTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const matchesSearch = text.includes(searchValue);
        row.style.display = matchesSearch ? '' : 'none';
    });
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

// Initialize DataTable
let tableJadwalMurid = new DataTable('#tableJadwalMurid');
</script>
