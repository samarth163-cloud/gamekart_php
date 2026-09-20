<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Clear all session variables
$_SESSION = array();

// If session cookie is used, destroy it
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy session
session_unset();
session_destroy();

// Redirect to login or home
header("Location: clogin.php?msg=logged_out");
exit;
?>