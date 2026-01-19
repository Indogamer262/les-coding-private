<?php
/**
 * =========================================================
 * PHP BACKEND FUNCTIONS - Kelola Mata Pelajaran + Pengajar
 * =========================================================
 * 
 * CONTOH IMPLEMENTASI PHP (mysqli) - Uncomment saat integrasi backend
 * 
 * --- Load Pengajar Aktif ---
 * function getPengajarAktif($conn) {
 *     $sql = "SELECT id_pengajar, nama_pengajar FROM pengajar WHERE status = 1 ORDER BY nama_pengajar ASC";
 *     $result = $conn->query($sql);
 *     $pengajar = [];
 *     while ($row = $result->fetch_assoc()) {
 *         $pengajar[] = $row;
 *     }
 *     return $pengajar;
 * }
 * 
 * --- Load Pengajar yang Mengajar Mapel (untuk Edit) ---
 * function getPengajarMapel($conn, $id_mapel) {
 *     $sql = "SELECT d.id_diajar, d.id_pengajar, p.nama_pengajar 
 *             FROM diajar d 
 *             JOIN pengajar p ON d.id_pengajar = p.id_pengajar 
 *             WHERE d.id_mapel = ?";
 *     $stmt = $conn->prepare($sql);
 *     $stmt->bind_param("s", $id_mapel);
 *     $stmt->execute();
 *     $result = $stmt->get_result();
 *     $pengajar = [];
 *     while ($row = $result->fetch_assoc()) {
 *         $pengajar[] = $row;
 *     }
 *     return $pengajar;
 * }
 * 
 * --- Simpan Relasi Diajar (Tambah Mapel Baru) ---
 * function simpanRelasiDiajar($conn, $id_mapel, $pengajar_ids) {
 *     foreach ($pengajar_ids as $id_pengajar) {
 *         $stmt = $conn->prepare("CALL SP_TambahDiajar(?, ?)");
 *         $stmt->bind_param("ss", $id_mapel, $id_pengajar);
 *         $stmt->execute();
 *         $stmt->close();
 *         $conn->next_result(); // Clear result set from SP
 *     }
 * }
 * 
 * --- Update Relasi Diajar (Edit Mapel) ---
 * function updateRelasiDiajar($conn, $id_mapel, $pengajar_baru_ids) {
 *     // 1. Ambil pengajar lama
 *     $pengajar_lama = getPengajarMapel($conn, $id_mapel);
 *     $id_pengajar_lama = array_column($pengajar_lama, 'id_pengajar');
 *     $id_diajar_map = array_column($pengajar_lama, 'id_diajar', 'id_pengajar');
 *     
 *     // 2. Pengajar yang perlu ditambahkan (ada di baru, tidak ada di lama)
 *     $to_add = array_diff($pengajar_baru_ids, $id_pengajar_lama);
 *     foreach ($to_add as $id_pengajar) {
 *         $stmt = $conn->prepare("CALL SP_TambahDiajar(?, ?)");
 *         $stmt->bind_param("ss", $id_mapel, $id_pengajar);
 *         $stmt->execute();
 *         $stmt->close();
 *         $conn->next_result();
 *     }
 *     
 *     // 3. Pengajar yang perlu dihapus (ada di lama, tidak ada di baru)
 *     $to_remove = array_diff($id_pengajar_lama, $pengajar_baru_ids);
 *     foreach ($to_remove as $id_pengajar) {
 *         $id_diajar = $id_diajar_map[$id_pengajar];
 *         $stmt = $conn->prepare("CALL SP_HapusDiajar(?)");
 *         $stmt->bind_param("i", $id_diajar);
 *         $stmt->execute();
 *         $stmt->close();
 *         $conn->next_result();
 *     }
 * }
 */
?>

<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Mata Pelajaran</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola daftar mata pelajaran yang tersedia</p>
        </div>
        <button type="button" onclick="openAddSubjectModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                <line x1="12" y1="6" x2="12" y2="14"></line>
                <line x1="8" y1="10" x2="16" y2="10"></line>
            </svg>
            Tambah Mata Pelajaran
        </button>
    </div>

    <!-- Subjects Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Mata Pelajaran</h2>
            </div>
        </div>
        <!-- Filter buttons will be moved here via JS -->
        <div id="mapelDtFilters" class="hidden flex items-center gap-3 flex-wrap">
            <div class="inline-flex rounded-lg border border-gray-300 overflow-hidden">
                <button type="button" id="filterStatusActive" onclick="setStatusFilter('active')" class="h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-blue-600 text-white">Aktif</button>
                <button type="button" id="filterStatusInactive" onclick="setStatusFilter('inactive')" class="h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-white text-gray-700 hover:bg-gray-50">Nonaktif</button>
            </div>
        </div>
        <div class="px-6 py-6">
            <table id="tableMapelAdmin" class="display w-full text-sm text-left rtl:text-right text-gray-500">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Nama Mata Pelajaran</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4">Pengajar</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Subject Modal -->
<div id="subjectModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full mx-4 max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between flex-shrink-0">
            <h3 class="text-xl font-semibold text-gray-800" id="subjectModalTitle">Tambah Mata Pelajaran</h3>
            <button type="button" onclick="closeSubjectModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form id="subjectForm" class="p-6 space-y-4 overflow-y-auto flex-grow" onsubmit="handleSubjectSubmit(event)">
            <!-- Hidden field untuk menyimpan ID mapel saat edit -->
            <input type="hidden" name="id_mapel" id="input_id_mapel" value="">
            <input type="hidden" name="mode" id="input_mode" value="add">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Mata Pelajaran</label>
                <input name="subjectName" id="input_subjectName" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Python" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="input_description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Deskripsi singkat mata pelajaran..."></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="input_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                </select>
            </div>
            
            <!-- Section Pengajar yang Mengajar -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Pengajar yang Mengajar
                    <span class="text-gray-400 font-normal">(pilih satu atau lebih)</span>
                </label>
                <div id="pengajarCheckboxContainer" class="border border-gray-300 rounded-lg p-3 max-h-48 overflow-y-auto bg-gray-50">
                    <!-- Checkbox pengajar akan dimuat di sini via JS / PHP -->
                    <div id="pengajarLoading" class="text-sm text-gray-500 italic">Memuat daftar pengajar...</div>
                    <div id="pengajarList" class="space-y-2 hidden"></div>
                    <div id="pengajarEmpty" class="text-sm text-gray-500 italic hidden">Tidak ada pengajar aktif</div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Centang pengajar yang akan mengajar mata pelajaran ini</p>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3 flex-shrink-0">
            <button type="button" onclick="closeSubjectModal()" class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
            <button type="submit" form="subjectForm" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Simpan</button>
        </div>
    </div>
</div>

<script>
let selectedStatusFilter = 'active';
let tableMapelAdmin;

function escapeHtml(value) {
    if (value === null || value === undefined) return '';
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

// =========================================================
// DUMMY DATA - Ganti dengan data dari database saat integrasi
// =========================================================

// Data pengajar aktif (status = 1)
const pengajarAktifData = [
    { id_pengajar: 'P-2601001', nama_pengajar: 'Budi Santoso' },
    { id_pengajar: 'P-2601002', nama_pengajar: 'Dewi Lestari' },
    { id_pengajar: 'P-2601003', nama_pengajar: 'Ahmad Fauzi' },
    { id_pengajar: 'P-2601004', nama_pengajar: 'Siti Nurhaliza' },
    { id_pengajar: 'P-2601005', nama_pengajar: 'Rudi Hermawan' }
];

// Data relasi diajar (mapel <-> pengajar)
let diajarData = [
    { id_diajar: 1, id_mapel: 'MP-00001', id_pengajar: 'P-2601001' },
    { id_diajar: 2, id_mapel: 'MP-00001', id_pengajar: 'P-2601002' },
    { id_diajar: 3, id_mapel: 'MP-00002', id_pengajar: 'P-2601003' },
    { id_diajar: 4, id_mapel: 'MP-00003', id_pengajar: 'P-2601001' },
    { id_diajar: 5, id_mapel: 'MP-00003', id_pengajar: 'P-2601004' },
    { id_diajar: 6, id_mapel: 'MP-00003', id_pengajar: 'P-2601005' }
];

let nextDiajarId = 7; // Auto-increment untuk dummy

// Dummy data mengikuti nama kolom dari DB `mata_pelajaran`
// - id_mapel, nama_mapel, deskripsiMapel, status (1 aktif, 0 nonaktif)
const mapelAdminData = [
    { id_mapel: 'MP-00001', nama_mapel: 'Dasar Pemrograman', deskripsiMapel: 'Belajar logika dasar, variabel, dan alur program', status_db: 1, status: 'active' },
    { id_mapel: 'MP-00002', nama_mapel: 'Web Development', deskripsiMapel: 'Belajar HTML, CSS, dan dasar JavaScript', status_db: 1, status: 'active' },
    { id_mapel: 'MP-00003', nama_mapel: 'PHP & MySQL', deskripsiMapel: 'Membangun website dinamis dengan PHP dan database MySQL', status_db: 1, status: 'active' },
    { id_mapel: 'MP-00004', nama_mapel: 'Java OOP', deskripsiMapel: 'Belajar pemrograman berorientasi objek menggunakan Java', status_db: 0, status: 'inactive' },
    { id_mapel: 'MP-00005', nama_mapel: 'Python Programming', deskripsiMapel: 'Belajar Python untuk pemula sampai menengah', status_db: 1, status: 'active' }
];

// =========================================================
// HELPER FUNCTIONS
// =========================================================

/**
 * Mendapatkan daftar pengajar yang mengajar mapel tertentu
 */
function getPengajarByMapel(id_mapel) {
    return diajarData
        .filter(d => d.id_mapel === id_mapel)
        .map(d => {
            const pengajar = pengajarAktifData.find(p => p.id_pengajar === d.id_pengajar);
            return {
                id_diajar: d.id_diajar,
                id_pengajar: d.id_pengajar,
                nama_pengajar: pengajar ? pengajar.nama_pengajar : 'Unknown'
            };
        });
}

/**
 * Mendapatkan nama-nama pengajar untuk ditampilkan di tabel
 */
function getNamaPengajarMapel(id_mapel) {
    const pengajars = getPengajarByMapel(id_mapel);
    if (pengajars.length === 0) return '<span class="text-gray-400 italic">Belum ada</span>';
    return pengajars.map(p => escapeHtml(p.nama_pengajar)).join(', ');
}

/**
 * Render checkbox pengajar di dalam modal
 */
function renderPengajarCheckboxes(selectedPengajarIds = []) {
    const container = document.getElementById('pengajarList');
    const loading = document.getElementById('pengajarLoading');
    const empty = document.getElementById('pengajarEmpty');

    loading.classList.add('hidden');
    container.innerHTML = '';

    if (pengajarAktifData.length === 0) {
        empty.classList.remove('hidden');
        container.classList.add('hidden');
        return;
    }

    empty.classList.add('hidden');
    container.classList.remove('hidden');

    pengajarAktifData.forEach(pengajar => {
        const isChecked = selectedPengajarIds.includes(pengajar.id_pengajar);
        const checkboxHtml = `
            <label class="flex items-center gap-3 p-2 rounded-lg hover:bg-white cursor-pointer transition-colors">
                <input type="checkbox" 
                       name="pengajar_ids[]" 
                       value="${escapeHtml(pengajar.id_pengajar)}" 
                       ${isChecked ? 'checked' : ''}
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <span class="text-sm text-gray-700">${escapeHtml(pengajar.nama_pengajar)}</span>
            </label>
        `;
        container.insertAdjacentHTML('beforeend', checkboxHtml);
    });
}

/**
 * Mendapatkan ID pengajar yang dicentang dari form
 */
function getSelectedPengajarIds() {
    const checkboxes = document.querySelectorAll('input[name="pengajar_ids[]"]:checked');
    return Array.from(checkboxes).map(cb => cb.value);
}

// =========================================================
// MOCK STORED PROCEDURES (simulasi backend)
// =========================================================

/**
 * Simulasi CALL SP_TambahDiajar(id_mapel, id_pengajar)
 */
function mockTambahDiajar(id_mapel, id_pengajar) {
    // Cek duplikat
    const exists = diajarData.some(d => d.id_mapel === id_mapel && d.id_pengajar === id_pengajar);
    if (exists) {
        console.log(`Relasi diajar sudah ada: ${id_mapel} - ${id_pengajar}`);
        return false;
    }
    diajarData.push({
        id_diajar: nextDiajarId++,
        id_mapel: id_mapel,
        id_pengajar: id_pengajar
    });
    console.log(`Ditambahkan relasi: ${id_mapel} - ${id_pengajar}`);
    return true;
}

/**
 * Simulasi CALL SP_HapusDiajar(id_diajar)
 */
function mockHapusDiajar(id_diajar) {
    const index = diajarData.findIndex(d => d.id_diajar === id_diajar);
    if (index !== -1) {
        console.log(`Dihapus relasi id_diajar: ${id_diajar}`);
        diajarData.splice(index, 1);
        return true;
    }
    return false;
}

// =========================================================
// FILTER & TABLE FUNCTIONS
// =========================================================

function setStatusFilter(status) {
    selectedStatusFilter = status;
    updateStatusFilterButtons();
    applyFilters();
}

function updateStatusFilterButtons() {
    const activeBtn = document.getElementById('filterStatusActive');
    const inactiveBtn = document.getElementById('filterStatusInactive');
    if (!activeBtn || !inactiveBtn) return;

    if (selectedStatusFilter === 'active') {
        activeBtn.className = 'h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-blue-600 text-white';
        inactiveBtn.className = 'h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-white text-gray-700 hover:bg-gray-50';
    } else {
        activeBtn.className = 'h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-white text-gray-700 hover:bg-gray-50';
        inactiveBtn.className = 'h-9 px-4 inline-flex items-center justify-center text-sm font-medium bg-blue-600 text-white';
    }
}

function applyFilters() {
    if (!tableMapelAdmin) return;
    tableMapelAdmin.draw();
}

// =========================================================
// MODAL FUNCTIONS
// =========================================================

function openAddSubjectModal() {
    document.getElementById('input_mode').value = 'add';
    document.getElementById('input_id_mapel').value = '';
    openSubjectModal('Tambah Mata Pelajaran');
    renderPengajarCheckboxes([]); // Tidak ada yang dicentang
}

function openSubjectModal(title) {
    const modal = document.getElementById('subjectModal');
    const form = document.getElementById('subjectForm');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.getElementById('subjectModalTitle').textContent = title;

    if (form && document.getElementById('input_mode').value === 'add') {
        form.reset();
        document.getElementById('input_mode').value = 'add';
    }
}

function closeSubjectModal() {
    const modal = document.getElementById('subjectModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    
    // Reset form
    const form = document.getElementById('subjectForm');
    if (form) form.reset();
    document.getElementById('input_mode').value = 'add';
    document.getElementById('input_id_mapel').value = '';
}

// =========================================================
// SUBMIT HANDLER
// =========================================================

function handleSubjectSubmit(event) {
    event.preventDefault();
    
    const mode = document.getElementById('input_mode').value;
    const id_mapel = document.getElementById('input_id_mapel').value;
    const nama_mapel = document.getElementById('input_subjectName').value.trim();
    const deskripsiMapel = document.getElementById('input_description').value.trim();
    const statusVal = document.getElementById('input_status').value;
    const status_db = statusVal === 'active' ? 1 : 0;
    
    const selectedPengajarIds = getSelectedPengajarIds();
    
    if (mode === 'add') {
        // =============================================
        // MODE TAMBAH MAPEL BARU
        // =============================================
        
        // Generate ID baru (dalam real app, ini dari SP/database)
        const newId = 'MP-' + String(mapelAdminData.length + 1).padStart(5, '0');
        
        // Tambah ke data mapel
        const newMapel = {
            id_mapel: newId,
            nama_mapel: nama_mapel,
            deskripsiMapel: deskripsiMapel,
            status_db: status_db,
            status: statusVal
        };
        mapelAdminData.push(newMapel);
        
        // LOOP: Tambah relasi diajar untuk setiap pengajar yang dipilih
        // Dalam real app: CALL SP_TambahDiajar(id_mapel, id_pengajar)
        selectedPengajarIds.forEach(id_pengajar => {
            mockTambahDiajar(newId, id_pengajar);
        });
        
        // Refresh DataTable
        tableMapelAdmin.row.add(newMapel).draw(false);
        
        alert('Mata pelajaran berhasil ditambahkan!');
        
    } else if (mode === 'edit') {
        // =============================================
        // MODE EDIT MAPEL
        // =============================================
        
        // Update data mapel
        const mapelIndex = mapelAdminData.findIndex(m => m.id_mapel === id_mapel);
        if (mapelIndex !== -1) {
            mapelAdminData[mapelIndex].nama_mapel = nama_mapel;
            mapelAdminData[mapelIndex].deskripsiMapel = deskripsiMapel;
            mapelAdminData[mapelIndex].status_db = status_db;
            mapelAdminData[mapelIndex].status = statusVal;
        }
        
        // Bandingkan pengajar lama vs baru
        const pengajarLama = getPengajarByMapel(id_mapel);
        const idPengajarLama = pengajarLama.map(p => p.id_pengajar);
        
        // Pengajar yang perlu DITAMBAHKAN (ada di baru, tidak ada di lama)
        const toAdd = selectedPengajarIds.filter(id => !idPengajarLama.includes(id));
        toAdd.forEach(id_pengajar => {
            // Dalam real app: CALL SP_TambahDiajar(id_mapel, id_pengajar)
            mockTambahDiajar(id_mapel, id_pengajar);
        });
        
        // Pengajar yang perlu DIHAPUS (ada di lama, tidak ada di baru)
        const toRemove = pengajarLama.filter(p => !selectedPengajarIds.includes(p.id_pengajar));
        toRemove.forEach(p => {
            // Dalam real app: CALL SP_HapusDiajar(id_diajar)
            mockHapusDiajar(p.id_diajar);
        });
        
        // Refresh DataTable row
        tableMapelAdmin.rows().every(function() {
            const data = this.data();
            if (data.id_mapel === id_mapel) {
                this.data(mapelAdminData[mapelIndex]).invalidate();
            }
        });
        tableMapelAdmin.draw(false);
        
        alert('Mata pelajaran berhasil diperbarui!');
    }
    
    closeSubjectModal();
}

// =========================================================
// EDIT & TOGGLE FUNCTIONS
// =========================================================

function editSubject(id) {
    const mapel = mapelAdminData.find(m => m.id_mapel === id);
    if (!mapel) {
        alert('Mata pelajaran tidak ditemukan!');
        return;
    }
    
    // Set mode edit
    document.getElementById('input_mode').value = 'edit';
    document.getElementById('input_id_mapel').value = mapel.id_mapel;
    
    // Isi form dengan data mapel
    document.getElementById('input_subjectName').value = mapel.nama_mapel;
    document.getElementById('input_description').value = mapel.deskripsiMapel || '';
    document.getElementById('input_status').value = mapel.status;
    
    // Load pengajar yang sudah mengajar mapel ini
    const pengajarMapel = getPengajarByMapel(mapel.id_mapel);
    const selectedIds = pengajarMapel.map(p => p.id_pengajar);
    
    // Render checkbox dengan pengajar yang sudah ter-centang
    renderPengajarCheckboxes(selectedIds);
    
    openSubjectModal('Edit Mata Pelajaran');
}

function toggleSubjectStatus(id, btnEl) {
    if (!tableMapelAdmin) return;

    const rowNode = btnEl ? btnEl.closest('tr') : null;
    const dtRow = rowNode ? tableMapelAdmin.row(rowNode) : null;
    const current = dtRow ? dtRow.data() : null;
    if (!current) return;

    const currentStatus = current.status;
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    const action = newStatus === 'active' ? 'mengaktifkan' : 'menonaktifkan';
    if (!confirm('Apakah Anda yakin ingin ' + action + ' mata pelajaran ini?')) return;

    current.status = newStatus;
    current.status_db = newStatus === 'active' ? 1 : 0;
    dtRow.data(current).invalidate();
    tableMapelAdmin.draw(false);

    alert('Status berhasil diubah!');
}

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('subjectModal');

    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeSubjectModal();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            closeSubjectModal();
        }
    });

    // Custom filter: status
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        if (!tableMapelAdmin || settings.nTable !== tableMapelAdmin.table().node()) return true;
        const rowData = tableMapelAdmin.row(dataIndex).data();
        if (!rowData) return true;
        return rowData.status === selectedStatusFilter;
    });

    tableMapelAdmin = $('#tableMapelAdmin').DataTable({
        data: mapelAdminData,
        columns: [
            {
                data: 'nama_mapel',
                render: (val, type) => {
                    if (type !== 'display') return val;
                    return `<p class="font-medium text-gray-800">${escapeHtml(val)}</p>`;
                }
            },
            {
                data: 'deskripsiMapel',
                render: (val, type) => {
                    if (type !== 'display') return val;
                    return `<span class="text-gray-700">${escapeHtml(val)}</span>`;
                }
            },
            {
                data: 'id_mapel',
                orderable: false,
                render: (val, type, row) => {
                    if (type !== 'display') return '';
                    return `<span class="text-gray-700 text-sm">${getNamaPengajarMapel(row.id_mapel)}</span>`;
                }
            },
            {
                data: 'status',
                className: 'text-center',
                render: (val, type) => {
                    if (type !== 'display') return val;
                    const isActive = val === 'active';
                    const label = isActive ? 'Aktif' : 'Nonaktif';
                    const cls = isActive ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700';
                    return `<span class="subject-status-badge px-4 py-1 rounded-full text-xs font-medium ${cls}">${label}</span>`;
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: (data, type, row) => {
                    if (type !== 'display') return '';
                    const isActive = row.status === 'active';
                    const toggleLabel = isActive ? 'Nonaktifkan' : 'Aktifkan';
                    const toggleClass = isActive
                        ? 'bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-50'
                        : 'bg-blue-600 text-white hover:bg-blue-700';
                    return `
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" onclick="editSubject('${escapeHtml(row.id_mapel)}')" class="inline-flex items-center justify-center w-16 px-4 py-1 rounded text-xs font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors" title="Edit">Edit</button>
                            <button type="button" onclick="toggleSubjectStatus('${escapeHtml(row.id_mapel)}', this)" class="status-toggle-btn inline-flex items-center justify-center w-20 px-4 py-1 rounded text-xs font-medium ${toggleClass} transition-colors" title="${toggleLabel}">${toggleLabel}</button>
                        </div>
                    `;
                }
            }
        ],
        createdRow: (row, data) => {
            $(row).addClass('hover:bg-gray-50 transition-colors');
            row.setAttribute('data-status', data.status);
            row.setAttribute('data-subject-id', String(data.id_mapel));
            if (data.status !== 'active') $(row).addClass('opacity-60');
        },
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            zeroRecords: "Tidak ada data yang cocok",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
        ordering: true,
        order: [[0, 'asc']]
    });

    // Move filters next to length menu
    const wrapper = document.getElementById('tableMapelAdmin_wrapper');
    const lengthEl = wrapper?.querySelector('.dt-length') || wrapper?.querySelector('.dataTables_length');
    const filterEl = document.getElementById('mapelDtFilters');
    if (lengthEl && filterEl) {
        lengthEl.classList.add('flex', 'items-end', 'gap-3', 'flex-wrap');
        filterEl.classList.remove('hidden');
        lengthEl.appendChild(filterEl);
    }

    updateStatusFilterButtons();
    applyFilters();
});
</script>
