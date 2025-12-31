<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Sistem Les Privat Coding</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="/css/variables.css">
    <link rel="stylesheet" href="/css/utilities.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/components.css">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <?php include __DIR__ . '/../partials/sidebar.php'; ?>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Topbar -->
            <?php include __DIR__ . '/../partials/navbar.php'; ?>
            
            <!-- Page Content -->
            <div class="page-content">
                <?= $content ?? '' ?>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="/js/main.js"></script>
</body>
</html>
