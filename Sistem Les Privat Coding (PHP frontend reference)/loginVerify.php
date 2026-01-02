<?php
session_start();

// don't come here if already logged in
if (!empty($_SESSION['logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$role = $_POST['role'] ?? 'murid';
$email = $_POST['email'] ?? 'user@example.com';

// Normalize
if ($role === 'student') $role = 'murid';
if ($role === 'teacher') $role = 'pengajar';

// Dummy auth: accept any credentials
$_SESSION['user_role'] = $role;
$_SESSION['user_email'] = $email;
$_SESSION['logged_in'] = true;

header('Location: dashboard.php');
exit;
