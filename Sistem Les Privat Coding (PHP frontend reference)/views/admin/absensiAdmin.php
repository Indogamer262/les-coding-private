<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Absensi</h1>
            <p class="text-sm text-gray-600 mt-1">Input absensi kehadiran murid</p>
        </div>
    </div>

    <!-- Absensi Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <h2 class="text-lg font-semibold text-gray-800">Jadwal Hari Ini</h2>
                <input type="text" id="searchAbsensi" placeholder="Cari jadwal..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="searchAbsensi(this.value)">
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
                <tbody class="divide-y divide-gray-100" id="absensiTableBody">
                    <!-- Row 1 - Belum Absen -->
                    <tr class="hover:bg-gray-50 transition-colors" data-absensi-id="1">
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
                                <button type="button" onclick="openAbsensiModal(1)" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors" title="Input Absensi">
                                    Input Absensi
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 - Belum Ada Murid -->
                    <tr class="hover:bg-gray-50 transition-colors" data-absensi-id="2">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">06 Jan 2026</p>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Senin</p>
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
                                <span class="text-gray-400 text-xs italic">Tidak ada murid</span>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 - Belum Absen -->
                    <tr class="hover:bg-gray-50 transition-colors" data-absensi-id="3">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 whitespace-nowrap">06 Jan 2026</p>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Senin</p>
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
                                <button type="button" onclick="openAbsensiModal(3)" class="inline-flex items-center justify-center px-4 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors" title="Input Absensi">
                                    Input Absensi
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Absensi Modal -->
<div id="absensiModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Input Absensi</h3>
            <button type="button" onclick="closeAbsensiModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form id="absensiForm" class="p-6 space-y-4" onsubmit="handleAbsensiSubmit(event)">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kehadiran</label>
                <select name="kehadiran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kehadiran --</option>
                    <option value="hadir">Hadir</option>
                    <option value="tidak-hadir">Tidak Hadir</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Materi</label>
                <textarea name="materi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan materi yang diajarkan..."></textarea>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button type="button" onclick="closeAbsensiModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button type="submit" form="absensiForm" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Simpan</button>
        </div>
    </div>
</div>

<script>
let currentAbsensiId = null;

function searchAbsensi(value) {
    const searchValue = value.toLowerCase();
    const rows = document.querySelectorAll('#absensiTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
}

function openAbsensiModal(id) {
    currentAbsensiId = id;
    document.getElementById('absensiForm').reset();
    document.getElementById('absensiModal').classList.remove('hidden');
    document.getElementById('absensiModal').classList.add('flex');
}

function closeAbsensiModal() {
    document.getElementById('absensiModal').classList.add('hidden');
    document.getElementById('absensiModal').classList.remove('flex');
    currentAbsensiId = null;
}

function handleAbsensiSubmit(event) {
    event.preventDefault();
    alert('Absensi berhasil disimpan!');
    closeAbsensiModal();
}
</script>
