<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Les Privat')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Fallback if asset() not working in direct file view, uses relative path -->
    <script>
        // Simple helper to load CSS if 'asset' helper fails (for pure HTML file viewing)
        if (location.protocol === 'file:') {
            document.write('<link rel="stylesheet" href="../../public/css/style.css">');
        }
    </script>
    <style>
        body {
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="w-full" style="max-width: 400px; padding: 1rem;">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-primary">Les Privat Coding</h1>
            <p class="text-muted">Masuk untuk melanjutkan</p>
        </div>
        
        <div class="card shadow-md">
            @yield('content')
        </div>

        <div class="text-center mt-6 text-sm text-muted">
            &copy; {{ date('Y') }} Sistem Les Privat Coding General
        </div>
    </div>
</body>
</html>
