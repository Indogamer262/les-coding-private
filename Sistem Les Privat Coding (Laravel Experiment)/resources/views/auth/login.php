<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Les Privat Coding</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Selamat Datang</h1>
            <p class="text-gray-500 mt-2">Silakan pilih peran Anda untuk masuk</p>
        </div>

        <!-- Role Selection -->
        <div id="role-selection" class="space-y-3">
            <button onclick="selectRole('murid')" class="w-full flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-all group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10v6"/><path d="M22 16a6 6 0 0 1-12 0L3 16a6 6 0 0 1 12 0l7 0Z"/><path d="M2 10h20"/><path d="M12 4v6"/></svg>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-blue-700">Masuk sebagai Murid</span>
                </div>
                <svg class="text-gray-400 group-hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>

            <button onclick="selectRole('pengajar')" class="w-full flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition-all group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-purple-700">Masuk sebagai Pengajar</span>
                </div>
                <svg class="text-gray-400 group-hover:text-purple-500" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>

            <button onclick="selectRole('admin')" class="w-full flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-gray-800 hover:bg-gray-50 transition-all group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 group-hover:bg-gray-800 group-hover:text-white transition-colors">
                         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-gray-900">Masuk sebagai Admin</span>
                </div>
                <svg class="text-gray-400 group-hover:text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>
        </div>

        <!-- Login Form -->
        <div id="login-form-container" class="hidden">
            <button onclick="backToRoles()" class="text-sm text-gray-500 hover:text-gray-700 mb-6 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Kembali
            </button>

            <h2 id="role-title" class="text-xl font-bold text-gray-800 mb-4">Login</h2>

            <form onsubmit="handleLogin(event)" class="space-y-4">
                <input type="hidden" name="role" id="selected-role">

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all placeholder-gray-400" placeholder="nama@email.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all placeholder-gray-400" placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-gray-500">
                        <input type="checkbox" class="mr-2 border-gray-300 rounded text-blue-600 focus:ring-blue-500"> Ingat saya
                    </label>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Lupa password?</a>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition-colors shadow-sm flex items-center justify-center gap-2">
                    <span>Masuk</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                </button>
            </form>
        </div>

    </div>

    <script>
        const roleSelection = document.getElementById('role-selection');
        const loginFormContainer = document.getElementById('login-form-container');
        const selectedRoleInput = document.getElementById('selected-role');
        const roleTitle = document.getElementById('role-title');

        const roleNames = {
            'murid': 'Murid',
            'pengajar': 'Pengajar',
            'admin': 'Admin'
        };

        function selectRole(role) {
            selectedRoleInput.value = role;
            roleTitle.textContent = `Login ${roleNames[role]}`;
            
            roleSelection.classList.add('hidden');
            loginFormContainer.classList.remove('hidden');
            
            // Auto focus email
            document.getElementById('email').focus();
        }

        function backToRoles() {
            loginFormContainer.classList.add('hidden');
            roleSelection.classList.remove('hidden');
            selectedRoleInput.value = '';
        }

        function handleLogin(e) {
            e.preventDefault(); // Prevent actual form submission
            
            const role = selectedRoleInput.value;
            const email = document.getElementById('email').value;
            
            // Simulate button loading (optional visual feedback)
            const btn = e.target.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;
            btn.innerHTML = 'Memproses...';
            btn.disabled = true;

            // Direct redirect to mimic login
            // Using query params to let index.php handle the session creation
            setTimeout(() => {
                window.location.href = `?action=login&role=${role}&email=${encodeURIComponent(email)}`;
            }, 500); // 500ms delay for effect
        }
    </script>
</body>
</html>
