<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'model/auth.php';

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    header('Location: vue/dashboard.php');
    exit();
}

// Otherwise redirect to login
header('Location: auth/login.php');
exit();
?> 