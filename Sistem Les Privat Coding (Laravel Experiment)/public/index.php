<?php
session_start();

// helpers.php inline for simplicity
function base_path($path = '') {
    return __DIR__ . '/../' . $path;
}

function public_path($path = '') {
    return __DIR__ . '/' . $path;
}

function asset($path) {
    $base = dirname($_SERVER['SCRIPT_NAME']);
    $base = str_replace('\\', '/', $base);
    if ($base !== '/' && substr($base, -1) === '/') {
        $base = substr($base, 0, -1);
    }
    $path = ltrim($path, '/');
    return $base . '/' . $path;
}

function url($path) {
    return asset($path);
}

function view($name, $data = []) {
    extract($data);
    $path = base_path("resources/views/{$name}.php");
    if (file_exists($path)) {
        require $path;
    } else {
        echo '<div class="flex flex-col items-center justify-center h-64 text-center">';
        echo '<div class="text-4xl font-bold text-gray-300 mb-4">WIP</div>';
        echo '<h2 class="text-xl font-semibold text-gray-700">Halaman Belum Tersedia</h2>';
        echo '<p class="text-gray-500 mt-2">Halaman "'.htmlspecialchars($name).'" sedang dalam pengembangan.</p>';
        echo '</div>';
    }
}

// Router Logic
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: ' . url(''));
    exit;
}

// Handle Login Submission (Simplified for testing)
// Supports both GET (link) and POST (form)
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'login') {
    $role = $_REQUEST['role'] ?? 'murid';
    $email = $_REQUEST['email'] ?? 'user@example.com';
    
    // Normalize roles just in case
    if ($role === 'student') $role = 'murid';
    if ($role === 'teacher') $role = 'pengajar';
    
    // Dummy Auth: Accept any credentials
    $_SESSION['user_role'] = $role;
    $_SESSION['user_email'] = $email;
    $_SESSION['logged_in'] = true;
    
    header('Location: ' . url(''));
    exit;
}

// Check Authentication
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Show Login Page if not logged in
    view('auth/login');
    exit;
}

// Logged In Logic
$role = $_SESSION['user_role'] ?? 'murid';

// Basic Routing
$page = $_GET['page'] ?? 'dashboard';
$subpage = $_GET['subpage'] ?? null;

// Determine View
$viewName = "{$role}/dashboard";
if ($subpage) {
    $viewName = "{$role}/{$subpage}";
}

// Capture content
ob_start();
view($viewName, ['role' => $role]);
$content = ob_get_clean();

// Render Main Layout
view('layouts/main', [
    'title' => ucfirst($role) . ' Dashboard - Sistem Les Privat',
    'content' => $content,
    'role' => $role
]);
