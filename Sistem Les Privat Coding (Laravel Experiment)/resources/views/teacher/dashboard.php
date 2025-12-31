<div class="flex flex-col gap-6">
    <h2 class="text-xl font-bold text-gray-800">Dashboard Pengajar</h2>
    
    <div class="flex gap-6 overflow-x-auto pb-2">
        <div class="min-w-[200px] bg-white p-4 rounded-lg border border-gray-200">
            <p class="text-sm text-gray-500">Kelas Minggu Ini</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">8</p>
        </div>
        <div class="min-w-[200px] bg-white p-4 rounded-lg border border-gray-200">
            <p class="text-sm text-gray-500">Total Murid</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">24</p>
        </div>
        <div class="min-w-[200px] bg-white p-4 rounded-lg border border-gray-200">
            <p class="text-sm text-gray-500">Hours Taught</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">126h</p>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-800">Jadwal Mengajar Hari Ini</h3>
        </div>
        <div class="divide-y divide-gray-100">
            <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="text-center min-w-[60px]">
                        <p class="text-lg font-bold text-gray-800">14:00</p>
                        <p class="text-xs text-gray-500">WIB</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">React JS Fundamentals</h4>
                        <p class="text-sm text-gray-600">Murid: John Doe</p>
                        <p class="text-sm text-gray-500 mt-1">Link: <a href="#" class="text-blue-600 hover:underline">meet.google.com/abc-defg-hij</a></p>
                    </div>
                </div>
                <button class="px-4 py-2 border border-blue-600 text-blue-600 font-medium rounded hover:bg-blue-50">Mulai Kelas</button>
            </div>

             <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="text-center min-w-[60px]">
                        <p class="text-lg font-bold text-gray-800">16:30</p>
                        <p class="text-xs text-gray-500">WIB</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Advanced Laravel</h4>
                        <p class="text-sm text-gray-600">Murid: Sarah Connor</p>
                         <p class="text-sm text-gray-500 mt-1">Link: <a href="#" class="text-blue-600 hover:underline">meet.google.com/xyz-wdas-qwe</a></p>
                    </div>
                </div>
                <button class="px-4 py-2 border border-gray-300 text-gray-600 font-medium rounded hover:bg-gray-50" disabled>Belum Mulai</button>
            </div>
        </div>
    </div>
</div>
