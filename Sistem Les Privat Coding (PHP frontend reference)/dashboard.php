<?php
session_start();
require __DIR__ . '/util/helpers.php';

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: index.php');
    exit;
}

if (empty($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit;
}

$role = $_SESSION['user_role'] ?? 'murid';
$page = $_GET['page'] ?? 'dashboard';

// basic allow-list for page names
if (!preg_match('/^[a-zA-Z0-9_-]+$/', $page)) {
    $page = 'dashboard';
}

// Map dashboard page to role-specific dashboard view
if ($page === 'dashboard') {
    $dashboardPageByRole = [
        'admin' => 'dashboard-admin',
        'murid' => 'dashboard-murid',
        'pengajar' => 'dashboard-pengajar',
    ];

    $page = $dashboardPageByRole[$role] ?? 'dashboard-murid';
}

$viewPath = $role . '/' . $page . '.php';

ob_start();
require_view($viewPath);
$content = ob_get_clean();

$title = ucfirst($role) . ' - ' . ucfirst($page) . ' - Sistem Les Privat';

require view_path('occurence/layout.php');
