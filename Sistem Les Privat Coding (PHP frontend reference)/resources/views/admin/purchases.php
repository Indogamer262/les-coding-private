<div class="flex flex-col gap-6">
    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Pembelian</h1>
            <p class="text-gray-600 mt-1">Lihat seluruh riwayat pembelian paket les</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Periode</option>
                    <option value="today">Hari Ini</option>
                    <option value="week">Minggu Ini</option>
                    <option value="month" selected>Bulan Ini</option>
                    <option value="year">Tahun Ini</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Murid</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Murid</option>
                    <option value="1">Budi Santoso</option>
                    <option value="2">Siti Rahma</option>
                    <option value="3">Ani Susanti</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Paket</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Paket</option>
                    <option value="4">Paket 4 Pertemuan</option>
                    <option value="8">Paket 8 Pertemuan</option>
                    <option value="12">Paket 12 Pertemuan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="expired">Kadaluarsa</option>
                    <option value="used">Terpakai Habis</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md border border-blue-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Pembelian</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">156</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-blue-600 mt-3 font-medium">Sepanjang masa</p>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-emerald-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Paket Aktif</p>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">89</p>
                </div>
                <div class="bg-emerald-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-emerald-600 mt-3 font-medium">Sedang berjalan</p>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-orange-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Kadaluarsa</p>
                    <p class="text-3xl font-bold text-orange-600 mt-2">45</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-orange-600 mt-3 font-medium">Masa aktif habis</p>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-purple-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-purple-600 mt-2">Rp 68 Jt</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9333ea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="2" x2="12" y2="22"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-purple-600 mt-3 font-medium">Total keseluruhan</p>
        </div>
    </div>

    <!-- Purchases Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Pembelian</h2>
                <div class="flex gap-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        Export
                    </button>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-6 py-4">No. Transaksi</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Murid</th>
                        <th class="px-6 py-4">Paket</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4">Masa Aktif</th>
                        <th class="px-6 py-4">Sisa/Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <!-- Row 1 - Active Package -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-medium text-gray-800">#TRX20260102001</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700">02 Jan 2026</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center font-semibold text-blue-600 text-xs">
                                    BS
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Budi Santoso</p>
                                    <p class="text-xs text-gray-500">#MRD001</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Paket 8 Pertemuan</p>
                                <p class="text-xs text-gray-500">30 hari masa aktif</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-emerald-600">Rp 450.000</span>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm text-gray-800">02 Jan - 01 Feb 2026</p>
                                <p class="text-xs text-blue-600 font-medium">28 hari lagi</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-semibold text-blue-600">5/8</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: 62.5%"></div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Aktif</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewPurchaseDetail(1)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 - Expiring Soon -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-medium text-gray-800">#TRX20251228012</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700">28 Des 2025</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center font-semibold text-purple-600 text-xs">
                                    AS
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Ani Susanti</p>
                                    <p class="text-xs text-gray-500">#MRD003</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Paket 4 Pertemuan</p>
                                <p class="text-xs text-gray-500">30 hari masa aktif</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-emerald-600">Rp 250.000</span>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm text-gray-800">28 Des - 27 Jan 2026</p>
                                <p class="text-xs text-orange-600 font-medium">⚠️ 3 hari lagi</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-semibold text-orange-600">2/4</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-orange-600 h-2 rounded-full" style="width: 50%"></div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-medium">Segera Kadaluarsa</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewPurchaseDetail(2)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 - Expired Package -->
                    <tr class="hover:bg-gray-50 transition-colors opacity-60">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-medium text-gray-800">#TRX20251215008</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700">15 Des 2025</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center font-semibold text-gray-600 text-xs">
                                    DP
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Dedi Prasetyo</p>
                                    <p class="text-xs text-gray-500">#MRD005</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">Paket 12 Pertemuan</p>
                                <p class="text-xs text-gray-500">30 hari masa aktif</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-emerald-600">Rp 600.000</span>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm text-gray-800">15 Des - 14 Jan 2026</p>
                                <p class="text-xs text-red-600 font-medium">❌ Kadaluarsa</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-semibold text-gray-600">9/12</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gray-400 h-2 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Kadaluarsa</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewPurchaseDetail(3)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
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
        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <p class="text-sm text-gray-600">Menampilkan <span class="font-medium">3</span> dari <span class="font-medium">156</span> pembelian</p>
            <div class="flex gap-2">
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Previous</button>
                <button class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm font-medium">1</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">2</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">3</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Next</button>
            </div>
        </div>
    </div>
</div>

<script>
function viewPurchaseDetail(id) {
    alert('Viewing purchase details for ID: ' + id);
}
</script>
