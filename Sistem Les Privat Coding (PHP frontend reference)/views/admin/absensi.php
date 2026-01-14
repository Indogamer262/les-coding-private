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
            <h2 class="text-lg font-semibold text-gray-800">Daftar Jadwal</h2>
            <div class="mt-4 flex flex-wrap items-end gap-3">
                <div class="w-40">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Periode</label>
                    <select id="filterPeriode" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="all">Semua Periode</option>
                        <option value="today" selected>Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                    </select>
                </div>
                <div class="w-40">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                    <select id="filterStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                        <option value="all">Semua</option>
                        <option value="belum">Belum Terisi</option>
                        <option value="sudah">Terisi</option>
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
                    <input type="text" id="searchMuridPembayaran" placeholder="Cari pengajar atau murid..." class="px-2 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="applyFilters()">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table id="tableAbsensiAdmin" class="w-full text-left text-sm">
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
                            <span class="text-xs text-blue-500 italic">Belum terisi</span>
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

function applyFilters() {
    const searchValue = document.getElementById('searchMuridPembayaran').value.toLowerCase();
    const statusFilter = document.getElementById('filterStatus').value;
    const rows = document.querySelectorAll('#absensiTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const aksiCell = row.querySelectorAll('td')[5]; // Column 6 is aksi
        const hasMurid = aksiCell && aksiCell.querySelector('button'); // Has input button means has murid
        const rowStatus = hasMurid ? 'belum' : 'sudah';
        
        // Check if murid column has "Belum terisi"
        const muridCell = row.querySelectorAll('td')[4]; // Column 5 is murid
        const isBelumTerisi = muridCell && muridCell.textContent.includes('Belum terisi');
        const actualStatus = isBelumTerisi ? 'sudah' : (hasMurid ? 'belum' : 'sudah');
        
        let matchesSearch = text.includes(searchValue);
        let matchesStatus = statusFilter === 'all' || actualStatus === statusFilter;
        
        row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
    });
}

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

// Initialize DataTable
let tableAbsensiAdmin = new DataTable('#tableAbsensiAdmin');
</script>
