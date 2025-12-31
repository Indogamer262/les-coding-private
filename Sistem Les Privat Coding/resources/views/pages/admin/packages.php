<?php $title = 'Manajemen Paket'; ?>

<?php ob_start(); ?>

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold">Paket Belajar</h2>
        <p class="text-sm text-gray-500">Atur harga dan kuota paket belajar.</p>
    </div>
    <button class="btn btn-primary">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
        Tambah Paket
    </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Basic Package -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Paket Basic</h3>
            <div class="text-2xl font-bold mt-2">Rp 500.000</div>
            <p class="text-sm text-gray-500">per bulan</p>
        </div>
        <div class="card-content">
            <ul class="flex flex-col gap-2 text-sm">
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    4 Sesi Pertemuan
                </li>
                 <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Akses Materi Dasar
                </li>
                 <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    Konsultasi PR
                </li>
            </ul>
        </div>
        <div class="p-4 border-t border-gray-200 flex justify-end gap-2">
            <button class="btn btn-ghost btn-sm">Hapus</button>
            <button class="btn btn-outline btn-sm">Edit</button>
        </div>
    </div>

     <!-- Premium Package -->
     <div class="card border-2 border-blue-500 relative">
        <div class="absolute top-0 right-0 bg-blue-500 text-white text-xs px-2 py-1 rounded-bl">Populer</div>
        <div class="card-header">
            <h3 class="card-title text-blue-700">Paket Premium</h3>
            <div class="text-2xl font-bold mt-2">Rp 1.200.000</div>
            <p class="text-sm text-gray-500">per bulan</p>
        </div>
        <div class="card-content">
            <ul class="flex flex-col gap-2 text-sm">
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    12 Sesi Pertemuan
                </li>
                 <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Akses Materi Lengkap
                </li>
                 <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Konsultasi PR Unlimited
                </li>
            </ul>
        </div>
        <div class="p-4 border-t border-gray-200 flex justify-end gap-2">
            <button class="btn btn-ghost btn-sm">Hapus</button>
            <button class="btn btn-primary btn-sm">Edit</button>
        </div>
    </div>
    
     <!-- BootCamp Package -->
     <div class="card">
        <div class="card-header">
            <h3 class="card-title">Intensive Bootcamp</h3>
            <div class="text-2xl font-bold mt-2">Rp 3.500.000</div>
            <p class="text-sm text-gray-500">sekali bayar</p>
        </div>
        <div class="card-content">
             <ul class="flex flex-col gap-2 text-sm">
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    30 Sesi Pertemuan (Intensif)
                </li>
                 <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Jaminan Penyaluran Kerja
                </li>
                 <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Sertifikat Kompetensi
                </li>
            </ul>
        </div>
        <div class="p-4 border-t border-gray-200 flex justify-end gap-2">
            <button class="btn btn-ghost btn-sm">Hapus</button>
            <button class="btn btn-outline btn-sm">Edit</button>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php include __DIR__ . '/../../layouts/app.php'; ?>
