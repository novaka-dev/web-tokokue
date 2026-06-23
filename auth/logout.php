<?php
// auth/logout.php
session_start();

// Hapus semua data session
$_SESSION = array();

// Hapus cookie remember me
if (isset($_COOKIE['user_email'])) {
    setcookie('user_email', '', time() - 3600, '/');
    setcookie('user_name', '', time() - 3600, '/');
}

// Hapus session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Hancurkan session
session_destroy();

// Redirect ke halaman login
header('Location: login.php');
exit;
?>