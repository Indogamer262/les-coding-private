<?php $title = 'Manajemen Akun'; ?>

<?php ob_start(); ?>

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold">Daftar Pengguna</h2>
        <p class="text-sm text-gray-500">Kelola data murid, pengajar, dan admin.</p>
    </div>
    <button class="btn btn-primary">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
        Tambah Pengguna
    </button>
</div>

<div class="card">
    <div class="card-header flex items-center justify-between">
        <h3 class="card-title">Semua Pengguna</h3>
        <div class="flex gap-2">
            <input type="text" placeholder="Cari..." class="input" style="width: 200px;">
            <button class="btn btn-outline">Filter</button>
        </div>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Tanggal Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">AD</div>
                            <span class="font-medium">Admin User</span>
                        </div>
                    </td>
                    <td>admin@example.com</td>
                    <td><span class="badge badge-gray">Admin</span></td>
                    <td><span class="badge badge-green">Aktif</span></td>
                    <td>1 Jan 2024</td>
                    <td>
                        <button class="btn btn-ghost btn-sm">Edit</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold text-xs">JS</div>
                            <span class="font-medium">Jane Smith</span>
                        </div>
                    </td>
                    <td>teacher@example.com</td>
                    <td><span class="badge badge-blue">Pengajar</span></td>
                    <td><span class="badge badge-green">Aktif</span></td>
                    <td>5 Jan 2024</td>
                    <td>
                        <button class="btn btn-ghost btn-sm">Edit</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 font-bold text-xs">JD</div>
                            <span class="font-medium">John Doe</span>
                        </div>
                    </td>
                    <td>student@example.com</td>
                    <td><span class="badge badge-gray">Murid</span></td>
                    <td><span class="badge badge-green">Aktif</span></td>
                    <td>10 Jan 2024</td>
                    <td>
                        <button class="btn btn-ghost btn-sm">Edit</button>
                    </td>
                </tr>
                 <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-xs">RJ</div>
                            <span class="font-medium">Robert Johnson</span>
                        </div>
                    </td>
                    <td>robert@example.com</td>
                    <td><span class="badge badge-gray">Murid</span></td>
                    <td><span class="badge badge-gray">Non-aktif</span></td>
                    <td>12 Jan 2024</td>
                    <td>
                        <button class="btn btn-ghost btn-sm">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination (Simple) -->
    <div class="p-4 border-t border-gray-200 flex items-center justify-between">
        <span class="text-sm text-gray-500">Menampilkan 1-4 dari 45 data</span>
        <div class="flex gap-1">
            <button class="btn btn-outline btn-sm" disabled>Prev</button>
            <button class="btn btn-outline btn-sm active" style="background-color: var(--secondary);">1</button>
            <button class="btn btn-outline btn-sm">2</button>
            <button class="btn btn-outline btn-sm">3</button>
            <button class="btn btn-outline btn-sm">Next</button>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php include __DIR__ . '/../../layouts/app.php'; ?>
