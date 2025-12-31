<?php $title = 'Admin Dashboard'; ?>

<?php ob_start(); ?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <!-- Stat Card 1 -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Total Murid</h3>
            <span class="text-primary bg-indigo-50 p-2 rounded-full">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </span>
        </div>
        <div class="text-2xl font-bold mb-1">124</div>
        <div class="text-xs text-green-600 font-medium">+12% bulan ini</div>
    </div>

    <!-- Stat Card 2 -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Total Pengajar</h3>
            <span class="text-primary bg-indigo-50 p-2 rounded-full">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
            </span>
        </div>
        <div class="text-2xl font-bold mb-1">12</div>
        <div class="text-xs text-gray-500 font-medium">Aktif mengajar</div>
    </div>

    <!-- Stat Card 3 -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Sesi Bulan Ini</h3>
            <span class="text-primary bg-indigo-50 p-2 rounded-full">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            </span>
        </div>
        <div class="text-2xl font-bold mb-1">450</div>
        <div class="text-xs text-green-600 font-medium">+5% dari bulan lalu</div>
    </div>

    <!-- Stat Card 4 -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Pendapatan</h3>
            <span class="text-primary bg-indigo-50 p-2 rounded-full">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </span>
        </div>
        <div class="text-2xl font-bold mb-1">Rp 45M</div>
        <div class="text-xs text-gray-500 font-medium">+18% bulan ini</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Chart or Activity Section -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Aktivitas Terbaru</h3>
            <p class="card-description">Pendaftaran murid dan transaksi terbaru</p>
        </div>
        <div class="card-content">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">JD</div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">John Doe mendaftar paket Basic</p>
                        <p class="text-xs text-gray-500">2 jam yang lalu</p>
                    </div>
                    <span class="badge badge-green">Lunas</span>
                </div>
                <!-- More items -->
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold">AS</div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">Alice Smith menyelesaikan sesi</p>
                        <p class="text-xs text-gray-500">4 jam yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Aksi Cepat</h3>
        </div>
        <div class="card-content">
            <div class="grid grid-cols-2 gap-4">
                <a href="/admin/users/create" class="btn btn-outline justify-center h-full py-6 flex-col gap-2">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    Tambah Murid
                </a>
                <button class="btn btn-outline justify-center h-full py-6 flex-col gap-2">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    Buat Jadwal
                </button>
                <button class="btn btn-outline justify-center h-full py-6 flex-col gap-2">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    Laporan
                </button>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php include __DIR__ . '/../../layouts/app.php'; ?>
