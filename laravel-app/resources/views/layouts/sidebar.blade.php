<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <span class="text-primary" style="margin-right: 8px;">⚡</span> Les Privat
    </div>
    
    <nav class="sidebar-nav">
        <!-- Admin Menu -->
        @if(isset($role) && $role === 'admin')
            <a href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                <span>🏠</span> Dashboard
            </a>
            <a href="/admin/accounts" class="nav-link {{ request()->is('admin/accounts') ? 'active' : '' }}">
                <span>👥</span> Kelola Akun
            </a>
            <a href="/admin/packages" class="nav-link {{ request()->is('admin/packages') ? 'active' : '' }}">
                <span>📦</span> Paket Les
            </a>
            <a href="/admin/schedules" class="nav-link {{ request()->is('admin/schedules') ? 'active' : '' }}">
                <span>📅</span> Jadwal
            </a>
            <a href="/admin/attendance" class="nav-link {{ request()->is('admin/attendance') ? 'active' : '' }}">
                <span>📝</span> Riwayat Absensi
            </a>
        @endif

        <!-- Student Menu -->
        @if(isset($role) && $role === 'student')
            <a href="/student" class="nav-link {{ request()->is('student') ? 'active' : '' }}">
                <span>🏠</span> Dashboard
            </a>
            <a href="/student/packages" class="nav-link {{ request()->is('student/packages') ? 'active' : '' }}">
                <span>📦</span> Paket Saya
            </a>
            <a href="/student/schedule" class="nav-link {{ request()->is('student/schedule') ? 'active' : '' }}">
                <span>📅</span> Jadwal Les
            </a>
            <a href="/student/history" class="nav-link {{ request()->is('student/history') ? 'active' : '' }}">
                <span>📜</span> Riwayat
            </a>
        @endif

        <!-- Teacher Menu -->
        @if(isset($role) && $role === 'teacher')
            <a href="/teacher" class="nav-link {{ request()->is('teacher') ? 'active' : '' }}">
                <span>🏠</span> Dashboard
            </a>
            <a href="/teacher/schedule" class="nav-link {{ request()->is('teacher/schedule') ? 'active' : '' }}">
                <span>📅</span> Jadwal Mengajar
            </a>
            <a href="/teacher/attendance" class="nav-link {{ request()->is('teacher/attendance') ? 'active' : '' }}">
                <span>📝</span> Input Absensi
            </a>
        @endif
        
        <!-- Shared Menu -->
        <div style="margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem;">
            <a href="/logout" class="nav-link text-danger">
                <span>🚪</span> Keluar
            </a>
        </div>
    </nav>
</aside>
