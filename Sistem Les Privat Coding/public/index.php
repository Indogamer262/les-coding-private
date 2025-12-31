<?php
// Simple Router for Mock Laravel Environment

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');

// 1. Static File Handling (Critical for PHP Built-in Server)
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // Serve the requested resource as-is.
}

// Helper to render view
function view($name, $data = []) {
    extract($data);
    $path = str_replace('.', '/', $name);
    $file = __DIR__ . '/../resources/views/' . $path . '.php';
    
    if (file_exists($file)) {
        require $file;
    } else {
        echo "View [$name] not found at $file";
    }
}

// Redirect root to admin for demo
if ($uri === '' || $uri === 'index.php') {
    header('Location: /admin');
    exit;
}

// Basic Routing
// Admin Routes
if ($uri === 'admin') {
    return view('pages.admin.dashboard');
}
if ($uri === 'admin/users/create') {
    return view('pages.admin.form_demo');
}
if ($uri === 'admin/accounts') {
    return view('pages.admin.accounts');
}
if ($uri === 'admin/packages') {
    return view('pages.admin.packages');
}

// Student Routes
if ($uri === 'student') {
    return view('pages.student.dashboard');
}

// Teacher Routes
if ($uri === 'teacher') {
    return view('pages.teacher.dashboard');
}

// 404
http_response_code(404);
echo "404 - Page Not Found";
