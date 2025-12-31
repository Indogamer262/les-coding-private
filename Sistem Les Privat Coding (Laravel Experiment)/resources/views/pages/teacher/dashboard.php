<?php $title = 'Dashboard Pengajar'; ?>

<?php ob_start(); ?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="card p-6">
        <div class="text-sm text-gray-500 font-medium mb-1">Total Mengajar Bulan Ini</div>
        <div class="text-3xl font-bold">24 Jam</div>
    </div>
    <div class="card p-6">
        <div class="text-sm text-gray-500 font-medium mb-1">Sesi Akan Datang</div>
        <div class="text-3xl font-bold">5</div>
    </div>
    <div class="card p-6">
        <div class="text-sm text-gray-500 font-medium mb-1">Rating Rata-rata</div>
        <div class="text-3xl font-bold flex items-center gap-2">
            4.9 
            <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="card lg:col-span-2">
        <div class="card-header border-b border-gray-100 flex justify-between items-center">
            <h3 class="card-title">Jadwal Mengajar Hari Ini</h3>
            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">31 Des 2025</span>
        </div>
        <div class="card-content">
             <div class="flex flex-col gap-4">
                 <!-- Schedule Item -->
                <div class="flex items-start gap-4 p-4 border border-gray-100 rounded-lg bg-blue-50/50">
                    <div class="flex flex-col items-center justify-center bg-white border border-gray-200 rounded p-2 min-w-[3.5rem]">
                        <span class="text-xs text-gray-500 font-bold uppercase">Jan</span>
                        <span class="text-xl font-bold text-gray-800">12</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-gray-900">Laravel Framework Basic</h4>
                                <p class="text-sm text-gray-600 mt-1">Murid: John Doe</p>
                            </div>
                            <span class="badge badge-blue">14:00 - 15:30</span>
                        </div>
                        <div class="mt-3 flex gap-2">
                            <button class="btn btn-primary btn-sm">Mulai Kelas</button>
                            <button class="btn btn-outline btn-sm">Detail</button>
                        </div>
                    </div>
                </div>
                
                 <!-- Schedule Item -->
                <div class="flex items-start gap-4 p-4 border border-gray-100 rounded-lg">
                    <div class="flex flex-col items-center justify-center bg-white border border-gray-200 rounded p-2 min-w-[3.5rem]">
                        <span class="text-xs text-gray-500 font-bold uppercase">Jan</span>
                        <span class="text-xl font-bold text-gray-800">12</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-gray-900">React JS Fundamentals</h4>
                                <p class="text-sm text-gray-600 mt-1">Murid: Sarah Conner</p>
                            </div>
                             <span class="badge badge-gray">16:00 - 17:30</span>
                        </div>
                        <div class="mt-3 flex gap-2">
                            <button class="btn btn-outline btn-sm">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header border-b border-gray-100">
             <h3 class="card-title">Pending Review</h3>
        </div>
         <div class="card-content">
            <div class="flex flex-col gap-4">
                <div class="p-3 bg-yellow-50 rounded border border-yellow-100">
                    <p class="text-sm font-medium text-yellow-800">Laporan Absensi</p>
                    <p class="text-xs text-yellow-600 mt-1">Kelas PHP Basic - 30 Des</p>
                    <button class="text-xs text-yellow-700 underline mt-2">Isi Laporan</button>
                </div>
            </div>
         </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php include __DIR__ . '/../../layouts/app.php'; ?>
