<header class="bg-white border-b border-gray-200 px-6 py-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="p-2 -ml-2 text-gray-600 hover:bg-gray-100 rounded-lg lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
            </button>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    <?php 
                        if ($role === 'admin') echo 'Dashboard Admin';
                        elseif ($role === 'student') echo 'Dashboard Murid';
                        elseif ($role === 'teacher') echo 'Dashboard Pengajar';
                    ?>
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Selamat datang di Sistem Les Privat Coding
                </p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-medium text-gray-700">
                    <?php 
                        if ($role === 'admin') echo 'Admin User';
                        elseif ($role === 'student') echo 'John Doe';
                        elseif ($role === 'teacher') echo 'Jane Smith';
                    ?>
                </p>
                <p class="text-xs text-gray-500">
                    <?php 
                        if ($role === 'admin') echo 'Administrator';
                        elseif ($role === 'student') echo 'Siswa';
                        elseif ($role === 'teacher') echo 'Pengajar';
                    ?>
                </p>
            </div>
            <div class="avatar bg-blue-600">
                <?php 
                    if ($role === 'admin') echo 'A';
                    elseif ($role === 'student') echo 'J';
                    elseif ($role === 'teacher') echo 'J';
                ?>
            </div>
        </div>
    </div>
</header>
