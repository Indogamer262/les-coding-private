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
    <script>
        if (location.protocol === 'file:') {
            document.write('<link rel="stylesheet" href="../../public/css/style.css">');
        }
    </script>
</head>
<body>
    <div class="app-layout">
        @include('layouts.sidebar')

        <div class="main-content" id="main-content">
            @include('layouts.topbar')

            <main class="content-wrapper">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Simple Vanilla JS for Sidebar Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            
            // On mobile, sidebar is hidden by default (CSS media query)
            // On desktop, it's visible.
            // We'll toggle a class.
            
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('open');
                
                // For desktop logic if needed later
                // sidebar.classList.toggle('closed'); 
            });
        });
    </script>
</body>
</html>
