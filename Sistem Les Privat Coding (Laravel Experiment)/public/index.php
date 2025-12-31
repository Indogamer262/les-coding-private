<?php
// helpers.php inline for simplicity
function base_path($path = '') {
    return __DIR__ . '/../' . $path;
}

function public_path($path = '') {
    return __DIR__ . '/' . $path;
}

function asset($path) {
    // Basic asset helper for XAMPP compatibility
    // If we are in /subdir/public/index.php, dirname is /subdir/public
    $base = dirname($_SERVER['SCRIPT_NAME']);
    // Normalize slashes
    $base = str_replace('\\', '/', $base);
    // Remove trailing slash if present (except root)
    if ($base !== '/' && substr($base, -1) === '/') {
        $base = substr($base, 0, -1);
    }
    
    // Ensure path doesn't start with /
    $path = ltrim($path, '/');
    
    return $base . '/' . $path;
}

function url($path) {
    return asset($path); // For this simple setup, url and asset behave similarly
}

function view($name, $data = []) {
    extract($data);
    $path = base_path("resources/views/{$name}.php");
    if (file_exists($path)) {
        require $path;
    } else {
        // Fallback for demo purposes
        echo '<div class="flex flex-col items-center justify-center h-64 text-center">';
        echo '<div class="text-4xl font-bold text-gray-300 mb-4">WIP</div>';
        echo '<h2 class="text-xl font-semibold text-gray-700">Halaman Belum Tersedia</h2>';
        echo '<p class="text-gray-500 mt-2">Halaman "'.htmlspecialchars($name).'" sedang dalam pengembangan.</p>';
        echo '</div>';
    }
}

// Router Logic
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME'];
$base_dir = dirname($script_name);

// Remove query string
$path = parse_url($request_uri, PHP_URL_PATH);

// Simple query param routing or path based routing?
// Let's use specific paths if possible, but for XAMPP simplicity, usually query params are easiest unless .htaccess is set.
// However, the user asked for sidebar links. I'll make the sidebar links point to `?page=admin` or similar.
// Better: make sidebar links go to `/project/public/admin`.
// To support both, I will check the path.

// Current basic routing by query param 'page' for absolute simplicity without .htaccess config
$page = $_GET['page'] ?? 'dashboard';
$role = $_GET['role'] ?? 'admin'; // admin, student, teacher

// Whitelist roles
if (!in_array($role, ['admin', 'student', 'teacher'])) {
    $role = 'admin';
}

// Prepare view name
// E.g. admin/dashboard
$viewName = "{$role}/dashboard";

// If specific other pages are requested
if (isset($_GET['subpage'])) {
    $viewName = "{$role}/" . $_GET['subpage'];
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
