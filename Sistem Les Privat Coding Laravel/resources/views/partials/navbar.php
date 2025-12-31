<header class="topbar">
    <div class="page-title">
        <h1>Dashboard</h1>
        <p>Selamat datang di Sistem Les Privat Coding</p>
    </div>
    
    <div class="topbar-actions">
        <div class="user-profile">
            <div class="user-info">
                <?php 
                $name = "Admin User";
                $roleLabel = "Administrator";
                $initial = "A";
                
                if (isset($role)) {
                    if ($role === 'student') {
                        $name = "John Doe";
                        $roleLabel = "Siswa";
                        $initial = "J";
                    } elseif ($role === 'teacher') {
                        $name = "Jane Smith";
                        $roleLabel = "Pengajar";
                        $initial = "S";
                    }
                }
                ?>
                <p class="user-name"><?= $name ?></p>
                <p class="user-role"><?= $roleLabel ?></p>
            </div>
            <div class="user-avatar">
                <?= $initial ?>
            </div>
        </div>
    </div>
</header>
