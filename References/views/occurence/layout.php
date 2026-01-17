<?php
/**
 * Layout wrapper (vanilla-style): sidebar + topbar + content.
 * Expects: $title, $role, $content
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Sistem Les Privat Coding') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">
</head>
<body>
    <div class="flex h-screen bg-gray-50">
        <?php require view_path('occurence/sidebar.php'); ?>

        <div id="main-content" class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ml-64">
            <?php require view_path('occurence/topbar.php'); ?>

            <main class="flex-1 overflow-y-auto p-6">
                <?php if (isset($content)) echo $content; ?>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script>
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.getElementById('main-content');

        function toggleSidebar() {
            if (!sidebar) return;
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
