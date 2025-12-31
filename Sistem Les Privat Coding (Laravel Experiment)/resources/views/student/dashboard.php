<div class="flex flex-col gap-6">
    <div class="bg-blue-600 rounded-lg p-6 text-white shadow-lg">
        <h2 class="text-2xl font-bold">Halo, John!</h2>
        <p class="mt-2 opacity-90">Siap untuk belajar coding hari ini? Kamu memiliki 1 jadwal kelas hari ini.</p>
        <button class="mt-4 px-4 py-2 bg-white text-blue-600 font-semibold rounded-lg text-sm hover:bg-gray-50">Lihat Jadwal</button>
    </div>

    <div class="flex flex-wrap gap-6">
        <!-- Upcoming Class -->
         <div class="flex-1 min-w-[300px] bg-white rounded-lg border border-gray-200 p-6">
             <h3 class="text-lg font-bold text-gray-800 mb-4">Kelas Selanjutnya</h3>
             <div class="flex items-start gap-4">
                 <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
                 </div>
                 <div>
                     <h4 class="font-semibold text-gray-900">React JS Fundamentals</h4>
                     <p class="text-sm text-gray-500 mt-1">Hari ini, 14:00 - 16:00 WIB</p>
                     <p class="text-sm text-gray-500">Pengajar: Jane Smith</p>
                     <button class="mt-3 w-full py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">Masuk Kelas</button>
                 </div>
             </div>
         </div>

         <!-- Progress -->
         <div class="flex-1 min-w-[300px] bg-white rounded-lg border border-gray-200 p-6">
             <h3 class="text-lg font-bold text-gray-800 mb-4">Progress Belajar</h3>
             <div class="space-y-4">
                 <div>
                     <div class="flex justify-between text-sm mb-1">
                         <span class="font-medium text-gray-700">React JS Fundamentals</span>
                         <span class="text-gray-500">75%</span>
                     </div>
                     <div class="w-full bg-gray-100 rounded-full h-2">
                         <div class="bg-blue-500 h-2 rounded-full" style="width: 75%"></div>
                     </div>
                 </div>
                 <div>
                     <div class="flex justify-between text-sm mb-1">
                         <span class="font-medium text-gray-700">Laravel for Beginners</span>
                         <span class="text-gray-500">30%</span>
                     </div>
                     <div class="w-full bg-gray-100 rounded-full h-2">
                         <div class="bg-orange-500 h-2 rounded-full" style="width: 30%"></div>
                     </div>
                 </div>
             </div>
         </div>
    </div>
</div>
