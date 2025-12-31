<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistem Les Privat Coding' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?= asset('css/style.css') ?>"> -->
     <link rel="stylesheet" href="/css/style.css">

</head>
<body>
    <div class="flex h-screen bg-gray-50">
        
        <?php include base_path('resources/views/partials/sidebar.php'); ?>

        <div id="main-content" class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ml-64">
            
            <?php include base_path('resources/views/partials/topbar.php'); ?>

            <main class="flex-1 overflow-y-auto p-6">
                <!-- Content Injection -->
                <?php if (isset($content)) echo $content; ?>
            </main>
        </div>
    </div>

    <script>
        // Simple Sidebar Toggle Logic
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.getElementById('main-content');
        
        // Function to be called from Topbar button
        function toggleSidebar() {
            sidebar.classList.toggle('closed');
            if (sidebar.classList.contains('closed')) {
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-0');
            } else {
                mainContent.classList.remove('ml-0');
                mainContent.classList.add('ml-64');
            }
        }
    </script>
</body>
</html>
