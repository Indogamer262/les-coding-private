<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Paket Les Saya</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola dan pantau paket les Anda</p>
        </div>
    </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-white rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Sisa Pertemuan</p>
                        <p class="text-2xl font-bold text-orange-600">2 / 4</p>
                    </div>
                    <div class="bg-white rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Masa Aktif</p>
                        <p class="text-lg font-bold text-orange-600">3 hari lagi</p>
                        <p class="text-xs text-gray-500">s/d 27 Jan 2026</p>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">Progress</span>
                        <span class="text-sm font-semibold text-orange-600">50%</span>
                    </div>
                    <div class="w-full bg-white rounded-full h-3">
                        <div class="bg-orange-500 h-3 rounded-full" style="width: 50%"></div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-3 border border-orange-200">
                    <p class="text-xs text-orange-800 font-medium mb-1">💡 Peringatan:</p>
                    <p class="text-xs text-orange-700">Paket Anda akan kadaluarsa dalam 3 hari. Segera gunakan sisa pertemuan Anda!</p>
                </div>
            </div>

            <!-- Package Card 2 - Active -->
            <div class="border-2 border-blue-200 bg-blue-50 rounded-lg p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <h3 class="text-lg font-bold text-gray-800">Paket 8 Pertemuan</h3>
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">✓ Aktif</span>
                        </div>
                        <p class="text-sm text-gray-600">Dibeli: 02 Jan 2026</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-blue-600">Rp 450.000</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-white rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Sisa Pertemuan</p>
                        <p class="text-2xl font-bold text-blue-600">5 / 8</p>
                    </div>
                    <div class="bg-white rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Masa Aktif</p>
                        <p class="text-lg font-bold text-blue-600">28 hari lagi</p>
                        <p class="text-xs text-gray-500">s/d 01 Feb 2026</p>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">Progress</span>
                        <span class="text-sm font-semibold text-blue-600">37.5%</span>
                    </div>
                    <div class="w-full bg-white rounded-full h-3">
                        <div class="bg-blue-500 h-3 rounded-full" style="width: 37.5%"></div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-3 border border-blue-200">
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-blue-600 font-medium">💰 Hemat 12%</span>
                        <span class="text-gray-600">•</span>
                        <span class="text-gray-700">Dari harga normal Rp 500.000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Purchase History -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Riwayat Pembelian</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Paket</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Sisa/Total</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">02 Jan 2026</td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Paket 8 Pertemuan</p>
                                <p class="text-xs text-gray-500">Masa aktif: 30 hari</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-emerald-600">Rp 450.000</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Aktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-blue-600">5 / 8</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewDetail(1)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">28 Des 2025</td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Paket 4 Pertemuan</p>
                                <p class="text-xs text-gray-500">Masa aktif: 30 hari</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-emerald-600">Rp 250.000</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-medium">Segera Kadaluarsa</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-orange-600">2 / 4</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewDetail(2)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors opacity-60">
                        <td class="px-6 py-4">15 Des 2025</td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Paket 12 Pertemuan</p>
                                <p class="text-xs text-gray-500">Masa aktif: 30 hari</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-emerald-600">Rp 600.000</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Kadaluarsa</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-gray-600">9 / 12</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewDetail(3)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
        <div class="flex items-start gap-4">
            <div class="bg-blue-100 p-3 rounded-lg flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-blue-900 mb-2">Informasi Penggunaan Paket</h3>
                <ul class="space-y-2 text-sm text-blue-800">
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600">•</span>
                        <span>Saat memilih jadwal, sistem otomatis menggunakan paket dengan masa aktif paling pendek terlebih dahulu</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600">•</span>
                        <span>Paket yang kadaluarsa tidak dapat digunakan lagi</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600">•</span>
                        <span>Anda dapat memiliki lebih dari satu paket aktif</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function viewDetail(id) {
    alert('Viewing package details for ID: ' + id);
}
</script>
