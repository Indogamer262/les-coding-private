<header class="topbar">
    <div class="flex items-center">
        <button id="sidebar-toggle" class="btn btn-outline" style="padding: 0.5rem; margin-right: 1rem; border: none;">
            <span style="font-size: 1.5rem;">☰</span>
        </button>
        <h1 class="text-xl font-bold text-gray-800">
            @yield('header', 'Dashboard')
        </h1>
    </div>
    
    <div class="flex items-center gap-4">
        <div class="text-right">
            <p class="text-sm font-medium text-gray-700">
                @if(isset($role) && $role === 'admin') Admin User @endif
                @if(isset($role) && $role === 'student') Budi Santoso @endif
                @if(isset($role) && $role === 'teacher') Pak Eko @endif
                @if(!isset($role)) Guest @endif
            </p>
            <p class="text-xs text-muted">
                @if(isset($role) && $role === 'admin') Administrator @endif
                @if(isset($role) && $role === 'student') Siswa @endif
                @if(isset($role) && $role === 'teacher') Pengajar @endif
            </p>
        </div>
        <div class="w-10 h-10 rounded bg-primary flex items-center justify-center text-white font-bold" style="width: 40px; height: 40px; border-radius: 50%;">
            @if(isset($role) && $role === 'admin') A @endif
            @if(isset($role) && $role === 'student') B @endif
            @if(isset($role) && $role === 'teacher') P @endif
            @if(!isset($role)) ? @endif
        </div>
    </div>
</header>
