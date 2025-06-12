<?php

include_once '../model/function.php';
include_once '../model/auth.php';

// Require login for all pages
requireLogin();

$userInfo = getUserInfo();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>
        <?php
        echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
        ?> -  Stc-MNGM Stock
    </title>
    <link rel="stylesheet" href="../public/css/style.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <div class="sidebar hidden-print">
        <div class="logo-details">
            <img src="../public/images/logo.png" alt=" Stc-MNGM Logo">
            <i class="bx bxl-c-plus-plus"></i>
            <span class="logo_name"> Stc-MNGM</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="dashboard.php" ? "active" : "" ?> ">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="vente.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="vente.php" ? "active" : "" ?> ">
                    <i class='bx bx-shopping-bag'></i>
                    <span class="links_name">Vente</span>
                </a>
            </li>
            <li>
                <a href="client.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="client.php" ? "active" : "" ?> ">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Client</span>
                </a>
            </li>
            <li>
                <a href="article.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="article.php" ? "active" : "" ?> ">
                    <i class="bx bx-box"></i>
                    <span class="links_name">Article</span>
                </a>
            </li>
            <li>
                <a href="fournisseur.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="fournisseur.php" ? "active" : "" ?> ">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Fournisseur</span>
                </a>
            </li>
            <li>
                <a href="commande.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="commande.php" ? "active" : "" ?> ">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Commandes</span>
                </a>
            </li>
            <li>
                <a href="categorie.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="categorie.php" ? "active" : "" ?> ">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Catégorie</span>
                </a>
            </li>
            <?php if (isAdmin()): ?>
            <li>
                <a href="#">
                    <i class="bx bx-pie-chart-alt-2"></i>
                    <span class="links_name">Analyses</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-coin-stack"></i>
                    <span class="links_name">Stock</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-book-alt"></i>
                    <span class="links_name">Toutes les commandes</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Utilisateur</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-cog"></i>
                    <span class="links_name">Configuration</span>
                </a>
            </li>
            <?php endif; ?>
            <li class="log_out">
                <a href="../model/logout.php">
                    <i class="bx bx-log-out"></i>
                    <span class="links_name">Déconnexion</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav class="hidden-print">
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">
                    <?php
                    echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
                    ?>
                </span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Recherche..." />
                <i class="bx bx-search"></i>
            </div>
            <div class="profile-details">
                <img src="../public/images/logo.png" alt="Profile">
                <span class="admin_name"><?= htmlspecialchars($userInfo['full_name']) ?></span>
                <i class="bx bx-chevron-down"></i>
            </div>
        </nav>