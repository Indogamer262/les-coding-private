<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
            <p class="text-sm text-gray-600 mt-1">Selamat datang di Sistem Les Privat Coding General</p>
        </div>
    </div>

    <!-- Two Main Sections Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Pembelian Terbaru Section -->
         <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200 shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Pembelian Terbaru</h2>
                <a href="dashboard.php?page=pembelian" class="text-sm text-blue-600 font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto p-6">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-xs uppercase text-gray-600 font-semibold tracking-wide border-b border-gray-200">
                            <th class="px-6 py-4">Murid</th>
                            <th class="px-6 py-4">Paket</th>
                            <th class="px-6 py-4">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Ahmad Fauzi</td>
                            <td class="px-6 py-4 text-gray-600">Paket 8 Pertemuan</td>
                            <td class="px-6 py-4 text-gray-800">02 Jan 2026</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Siti Nurhaliza</td>
                            <td class="px-6 py-4 text-gray-600">Paket 4 Pertemuan</td>
                            <td class="px-6 py-4 text-gray-800">01 Jan 2026</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Budi Santoso</td>
                            <td class="px-6 py-4 text-gray-600">Paket 12 Pertemuan</td>
                            <td class="px-6 py-4 text-gray-800">31 Des 2025</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Rini Wijaya</td>
                            <td class="px-6 py-4 text-gray-600">Paket 8 Pertemuan</td>
                            <td class="px-6 py-4 text-gray-800">30 Des 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>   

        

        <!-- Paket Mendekati Kadaluwarsa Section -->
        <div class="bg-white rounded-lg shadow-md border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Paket Mendekati Kadaluwarsa</h2>
            </div>
            <div class="p-6 space-y-4">
                <!-- Warning Card 1 -->
                <div class="bg-orange-50 border-l-4 border-orange-500 rounded p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">Rahman Hidayat</p>
                            <p class="text-sm text-gray-600 mt-1">Paket 4 Pertemuan</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-xs font-medium text-orange-700">Sisa: 2 pertemuan</span>
                        <span class="text-xs text-orange-600">3 hari</span>
                    </div>
                </div>

                <!-- Warning Card 2 -->
                <div class="bg-orange-50 border-l-4 border-orange-500 rounded p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">Lisa Wijaya</p>
                            <p class="text-sm text-gray-600 mt-1">Paket 8 Pertemuan</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-xs font-medium text-orange-700">Sisa: 1 pertemuan</span>
                        <span class="text-xs text-orange-600">5 hari</span>
                    </div>
                </div>

                <!-- Warning Card 3 -->
                <div class="bg-orange-50 border-l-4 border-orange-500 rounded p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">Doni Sutrisno</p>
                            <p class="text-sm text-gray-600 mt-1">Paket 12 Pertemuan</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-xs font-medium text-orange-700">Sisa: 3 pertemuan</span>
                        <span class="text-xs text-orange-600">7 hari</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
