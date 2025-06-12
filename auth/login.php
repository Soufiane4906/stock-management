<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../model/auth.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: ../vue/dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Veuillez remplir tous les champs';
    } else {
        if (login($username, $password)) {
            header('Location: ../vue/dashboard.php');
            exit();
        } else {
            $error = 'Nom d\'utilisateur ou mot de passe incorrect';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>Connexion -  Stc-MNGM Stock</title>
    <link rel="stylesheet" href="../public/css/style.css" />
    <link rel="stylesheet" href="../public/css/auth.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body class="auth-body">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="../public/images/logo.png" alt=" Stc-MNGM Logo" class="auth-logo">
                <h1> Stc-MNGM Stock</h1>
                <p>Système de Gestion de Stock</p>
            </div>
            
            <form method="POST" class="auth-form">
                <?php if (!empty($error)): ?>
                    <div class="alert danger">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="username">
                        <i class='bx bx-user'></i>
                        Nom d'utilisateur ou Email
                    </label>
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        placeholder="Entrez votre nom d'utilisateur ou email"
                        value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="password">
                        <i class='bx bx-lock-alt'></i>
                        Mot de passe
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Entrez votre mot de passe"
                        required
                    >
                </div>
                
                <button type="submit" class="auth-btn">
                    <i class='bx bx-log-in'></i>
                    Se connecter
                </button>
            </form>
            
            <div class="auth-footer">
                <p>Développé avec ❤️ par <strong>Wissal</strong></p>
                <small>Version 2.0 - Système de Gestion de Stock</small>
            </div>
        </div>
    </div>
</body>
</html> 