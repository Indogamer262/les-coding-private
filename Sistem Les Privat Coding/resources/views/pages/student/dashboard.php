<?php $title = 'Dashboard Murid'; ?>

<?php ob_start(); ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Welcome Card -->
    <div class="card lg:col-span-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white border-0">
        <div class="card-content">
            <h2 class="text-2xl font-bold mb-2">Halo, John Doe! 👋</h2>
            <p class="mb-6 opacity-90">Kamu memiliki jadwal belajar hari ini. Siapkan dirimu untuk materi selanjutnya!</p>
            <button class="btn bg-white text-blue-600 hover:bg-gray-100 border-0">
                Lihat Jadwal Lengkap
            </button>
        </div>
    </div>

    <!-- Active Package -->
    <div class="card">
        <div class="card-header border-0 pb-0">
            <h3 class="card-title text-sm uppercase tracking-wider text-gray-500">Paket Aktif</h3>
        </div>
        <div class="card-content pt-2">
            <div class="text-2xl font-bold text-gray-800 mb-1">Paket Premium</div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2 mt-2">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
            </div>
            <div class="flex justify-between text-xs text-gray-500">
                <span>5 Sesi Terpakai</span>
                <span>Total 12 Sesi</span>
            </div>
        </div>
    </div>
</div>

<h3 class="text-lg font-bold mb-4">Jadwal Mendatang</h3>
<div class="card">
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th>Pengajar</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-medium">Laravel Framework Basic</td>
                    <td>Jane Smith</td>
                    <td>12 Jan 2024</td>
                    <td>14:00 - 15:30</td>
                    <td><span class="badge badge-blue">Upcoming</span></td>
                    <td><button class="btn btn-outline btn-sm">Join Link</button></td>
                </tr>
                 <tr>
                    <td class="font-medium">Database Design</td>
                    <td>Jane Smith</td>
                    <td>14 Jan 2024</td>
                    <td>14:00 - 15:30</td>
                    <td><span class="badge badge-gray">Scheduled</span></td>
                    <td><button class="btn btn-ghost btn-sm" disabled>Belum Mulai</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php include __DIR__ . '/../../layouts/app.php'; ?>
