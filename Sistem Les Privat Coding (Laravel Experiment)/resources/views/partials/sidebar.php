<?php
// Define menu items based on role
$menu = [];

if ($role === 'admin') {
    $menu = [
        ['label' => 'Dashboard', 'url' => '?role=admin&page=dashboard', 'icon' => 'home'],
        ['label' => 'Manajemen Akun', 'url' => '?role=admin&subpage=accounts', 'icon' => 'users'],
        ['label' => 'Paket Belajar', 'url' => '?role=admin&subpage=packages', 'icon' => 'package'],
        ['label' => 'Riwayat Pembelian', 'url' => '?role=admin&subpage=purchases', 'icon' => 'shopping-cart'],
        ['label' => 'Jadwal Kursus', 'url' => '?role=admin&subpage=schedules', 'icon' => 'calendar'],
        ['label' => 'Riwayat Absensi', 'url' => '?role=admin&subpage=attendance', 'icon' => 'clock'],
    ];
} elseif ($role === 'student') {
    $menu = [
        ['label' => 'Dashboard', 'url' => '?role=student&page=dashboard', 'icon' => 'home'],
        ['label' => 'Paket Saya', 'url' => '?role=student&subpage=packages', 'icon' => 'package'],
        ['label' => 'Jadwal Belajar', 'url' => '?role=student&subpage=schedule', 'icon' => 'calendar'],
        ['label' => 'Riwayat Belajar', 'url' => '?role=student&subpage=history', 'icon' => 'clock'],
    ];
} elseif ($role === 'teacher') {
    $menu = [
        ['label' => 'Dashboard', 'url' => '?role=teacher&page=dashboard', 'icon' => 'home'],
        ['label' => 'Jadwal Mengajar', 'url' => '?role=teacher&subpage=schedule', 'icon' => 'calendar'],
        ['label' => 'Absensi Murid', 'url' => '?role=teacher&subpage=attendance', 'icon' => 'check-square'],
    ];
}

// Helper to check active state
function isActive($url) {
    // Simple check: if active query param matches
    // In real app, robust URL checking needed
    $current_page = $_GET['subpage'] ?? 'dashboard';
    if (strpos($url, 'subpage=' . $current_page) !== false) return 'active';
    if ($current_page === 'dashboard' && strpos($url, 'page=dashboard') !== false) return 'active';
    return '';
}
?>

<aside class="sidebar bg-white border-r border-gray-200">
    <div class="sidebar-header">
        <div class="flex items-center gap-2 font-bold text-xl text-primary">
            <span class="p-1 bg-primary text-white rounded">LC</span>
            <span>Les Coding</span>
        </div>
    </div>
    
    <nav class="flex-1 overflow-y-auto py-4">
        <div class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
            Menu Utama
        </div>
        
        <?php foreach ($menu as $item): ?>
        <a href="<?= $item['url'] ?>" class="nav-link <?= isActive($item['url']) ?>">
            <!-- Simple SVG Handling -->
            <?php if($item['icon'] === 'home'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            <?php elseif($item['icon'] === 'users'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <?php elseif($item['icon'] === 'package'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
            <?php elseif($item['icon'] === 'shopping-cart'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            <?php elseif($item['icon'] === 'calendar'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
            <?php elseif($item['icon'] === 'clock'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
             <?php elseif($item['icon'] === 'check-square'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
            <?php else: ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/></svg>
            <?php endif; ?>
            <span><?= htmlspecialchars($item['label']) ?></span>
        </a>
        <?php endforeach; ?>

        <!-- Role Switcher for Demo -->
        <div class="mt-8 px-4">
             <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Switch Role (Demo)</div>
             <div class="flex flex-col gap-1">
                 <a href="?role=admin" class="text-sm text-gray-600 hover:text-primary">Admin</a>
                 <a href="?role=student" class="text-sm text-gray-600 hover:text-primary">Murid</a>
                 <a href="?role=teacher" class="text-sm text-gray-600 hover:text-primary">Pengajar</a>
             </div>
        </div>
    </nav>
</aside>
