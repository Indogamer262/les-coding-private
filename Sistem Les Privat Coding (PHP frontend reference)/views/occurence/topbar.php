<header class="bg-white border-b border-gray-200 px-6 py-4 shadow-sm">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="p-2 -ml-2 text-gray-600 hover:bg-gray-100 rounded-lg lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
            </button>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-medium text-gray-700">
                    <?php 
                        if ($role === 'admin') echo 'Admin User';
                        elseif ($role === 'murid') echo 'John Doe';
                        elseif ($role === 'pengajar') echo 'Jane Smith';
                    ?>
                </p>
                <div class="flex items-center justify-end gap-2">
                    <p class="text-xs text-gray-500">
                        <?php 
                            if ($role === 'admin') echo 'Administrator';
                            elseif ($role === 'murid') echo 'Siswa';
                            elseif ($role === 'pengajar') echo 'Pengajar';
                        ?>
                    </p>
                    <span class="text-xs text-gray-300">|</span>
                    <a href="dashboard.php?action=logout" class="text-xs text-red-500 hover:text-red-700">Logout</a>
                </div>
            </div>
            <div class="avatar bg-blue-900 h-10 w-10 rounded-full flex items-center justify-center text-white font-bold">
                <?php 
                    if ($role === 'admin') echo 'A';
                    elseif ($role === 'murid') echo 'J';
                    elseif ($role === 'pengajar') echo 'J';
                ?>
            </div>
        </div>
    </div>
</header>
