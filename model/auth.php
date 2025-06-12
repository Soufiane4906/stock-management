<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'connexion.php';

function login($username, $password) {
    global $connexion;
    
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $req = $connexion->prepare($sql);
    $req->execute(array($username, $username));
    $user = $req->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        // Update last login
        $update_sql = "UPDATE users SET last_login = NOW() WHERE id = ?";
        $update_req = $connexion->prepare($update_sql);
        $update_req->execute(array($user['id']));
        
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['logged_in'] = true;
        
        return true;
    }
    
    return false;
}

function logout() {
    session_destroy();
    header('Location: ../auth/login.php');
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ../auth/login.php');
        exit();
    }
}

function getUserInfo() {
    if (isLoggedIn()) {
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'full_name' => $_SESSION['full_name'],
            'role' => $_SESSION['role']
        ];
    }
    return null;
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['role'] === 'admin';
}

function requireAdmin() {
    if (!isAdmin()) {
        header('Location: ../vue/dashboard.php');
        exit();
    }
}
?> 