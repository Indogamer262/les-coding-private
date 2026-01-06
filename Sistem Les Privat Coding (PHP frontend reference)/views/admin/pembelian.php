<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Pembelian</h1>
            <p class="text-sm text-gray-600 mt-1">Lihat seluruh riwayat pembelian paket les</p>
        </div>
    </div>

    <!-- Purchases Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Pembelian</h2>
                <input type="text" id="searchMuridPembelian" placeholder="Cari nama murid..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="searchMuridPembelian(this.value)">
            </div>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600 font-semibold tracking-wide">
                        <th class="px-5 py-4 whitespace-nowrap text-center w-56">ID Pembelian</th>
                        <th class="px-5 py-4 whitespace-nowrap">Tanggal Pembelian</th>
                        <th class="px-5 py-4 whitespace-nowrap">Nama Murid</th>
                        <th class="px-3 py-4 whitespace-nowrap">Paket</th>
                        <th class="px-5 py-4">Harga</th>
                        <th class="px-5 py-4 whitespace-nowrap">Masa Aktif</th>
                        <th class="px-5 py-4 whitespace-nowrap text-center">Sisa Pertemuan</th>
                    </tr>
                </thead>
                <tbody id="purchasesTableBody" class="divide-y divide-gray-100">
                    <!-- Row 1 - Active Package -->
                    <tr class="hover:bg-gray-50 transition-colors" data-murid="Budi Santoso">
                        <td class="px-6 py-4 whitespace-nowrap text-center w-56">
                            <span class="font-mono text-sm font-medium text-gray-800">PL-0001</span>
                        </td>
                        <td class="px-4 py-4 text-gray-700 whitespace-nowrap">02 Jan 2026, 09:30</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Budi Santoso</p>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <p class="px-2 font-medium text-gray-800 whitespace-nowrap">Paket 8 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-600 whitespace-nowrap">Rp 450.000</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-medium text-gray-800 whitespace-nowrap">28 hari</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="max-w-xs mx-auto">
                                <div class="flex items-center justify-center mb-1">
                                    <span class="text-sm font-semibold text-blue-600">5/8</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 62.5%"></div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 - Expiring Soon -->
                    <tr class="hover:bg-gray-50 transition-colors" data-murid="Ani Susanti">
                        <td class="px-6 py-4 whitespace-nowrap text-center w-56">
                            <span class="font-mono text-sm font-medium text-gray-800">PL-0012</span>
                        </td>
                        <td class="px-4 py-4 text-gray-700 whitespace-nowrap">28 Des 2025, 10:45</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Ani Susanti</p>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <p class="px-2 font-medium text-gray-800 whitespace-nowrap">Paket 4 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-600 whitespace-nowrap">Rp 250.000</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-medium text-gray-800 whitespace-nowrap">3 hari</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="max-w-xs mx-auto">
                                <div class="flex items-center justify-center mb-1">
                                    <span class="text-sm font-semibold text-blue-600">2/4</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 50%"></div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 - Expired Package -->
                    <tr class="hover:bg-gray-50 transition-colors opacity-60" data-murid="Dedi Prasetyo">
                        <td class="px-6 py-4 whitespace-nowrap text-center w-56">
                            <span class="font-mono text-sm font-medium text-gray-800">PL-0008</span>
                        </td>
                        <td class="px-4 py-4 text-gray-700 whitespace-nowrap">15 Des 2025, 08:15</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 whitespace-nowrap">Dedi Prasetyo</p>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <p class="px-2 font-medium text-gray-800 whitespace-nowrap">Paket 12 Pertemuan</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-600 whitespace-nowrap">Rp 600.000</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-medium text-gray-800 whitespace-nowrap">0 hari</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="max-w-xs mx-auto">
                                <div class="flex items-center justify-center mb-1">
                                    <span class="text-sm font-semibold text-blue-600">9/12</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function searchMuridPembelian(value) {
    const searchValue = value.toLowerCase();
    const rows = document.querySelectorAll('#purchasesTableBody tr');

    rows.forEach(row => {
        const namaMurid = row.dataset.murid || '';
        row.style.display = namaMurid.toLowerCase().includes(searchValue) ? '' : 'none';
    });
}
</script>