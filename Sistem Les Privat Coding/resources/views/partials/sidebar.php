<?php
// Determine Role from URL if not set (Mock logic)
// In real Laravel, this would be Auth::user()->role
$uri = $_SERVER['REQUEST_URI'];
$role = 'admin'; // default because of redirect
if (strpos($uri, '/student') !== false) $role = 'student';
if (strpos($uri, '/teacher') !== false) $role = 'teacher';

// Navigation Items
$navItems = [];

if ($role === 'admin') {
    $navItems = [
        ['label' => 'Dashboard', 'url' => '/admin', 'icon' => 'squares-2x2'],
        ['label' => 'Manajemen Akun', 'url' => '/admin/accounts', 'icon' => 'users'],
        ['label' => 'Manajemen Paket', 'url' => '/admin/packages', 'icon' => 'archive-box'],
        ['label' => 'Pembelian', 'url' => '/admin/purchases', 'icon' => 'shopping-cart'],
        ['label' => 'Jadwal', 'url' => '/admin/schedules', 'icon' => 'calendar'],
        ['label' => 'Riwayat Absensi', 'url' => '/admin/attendance', 'icon' => 'clock'],
    ];
} elseif ($role === 'student') {
    $navItems = [
        ['label' => 'Dashboard', 'url' => '/student', 'icon' => 'squares-2x2'],
        ['label' => 'Beli Paket', 'url' => '/student/packages', 'icon' => 'shopping-bag'],
        ['label' => 'Jadwal Belajar', 'url' => '/student/schedule', 'icon' => 'calendar'],
        ['label' => 'Riwayat', 'url' => '/student/history', 'icon' => 'clock'],
    ];
} elseif ($role === 'teacher') {
    $navItems = [
        ['label' => 'Dashboard', 'url' => '/teacher', 'icon' => 'squares-2x2'],
        ['label' => 'Jadwal Mengajar', 'url' => '/teacher/schedule', 'icon' => 'calendar'],
        ['label' => 'Absensi', 'url' => '/teacher/attendance', 'icon' => 'user-check'],
    ];
}
?>

<aside class="sidebar">
    <div class="sidebar-header">
        <a href="/" class="sidebar-logo">
            <div style="width: 24px; height: 24px; background: var(--primary); border-radius: 6px;"></div>
            <span>Les Coding</span>
        </a>
    </div>
    
    <div class="sidebar-content">
        <p class="text-xs font-bold text-gray-500 uppercase px-4 mb-2 mt-4 tracking-wider">Menu</p>
        <nav class="sidebar-nav">
            <?php foreach ($navItems as $item): ?>
                <?php 
                $isActive = $uri === $item['url'] || (strlen($item['url']) > 1 && strpos($uri, $item['url']) === 0);
                ?>
                <a href="<?= $item['url'] ?>" class="nav-link <?= $isActive ? 'active' : '' ?>">
                    <!-- Simple SVG Icons -->
                    <span class="nav-icon">
                        <?php if ($item['icon'] === 'squares-2x2'): ?>
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                        <?php elseif ($item['icon'] === 'users'): ?>
                             <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                        <?php else: ?>
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5" /></svg>
                        <?php endif; ?>
                    </span>
                    <?= $item['label'] ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
    
    <div class="sidebar-footer">
        <a href="/logout" class="btn btn-outline w-full text-xs">
            Logout
        </a>
    </div>
</aside>
