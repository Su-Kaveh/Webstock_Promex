<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebStock - Promex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">

        <!-- Logo + Nom -->
         <img src="assets/img/logo.png" alt="Promex" height="50">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= ($page === 'dashboard') ? 'active' : '' ?>"
                       href="index.php?page=dashboard">
                        <i class="bi bi-speedometer2"></i> Tableau de bord
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page === 'produits') ? 'active' : '' ?>"
                       href="index.php?page=produits&action=index">
                        <i class="bi bi-box-seam"></i> Produits
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page === 'categories') ? 'active' : '' ?>"
                       href="index.php?page=categories&action=index">
                        <i class="bi bi-tags"></i> Catégories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page === 'mouvements') ? 'active' : '' ?>"
                       href="index.php?page=mouvements&action=index">
                        <i class="bi bi-arrow-left-right"></i> Mouvements
                    </a>
                </li>
                <?php if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['role'] === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($page === 'utilisateurs') ? 'active' : '' ?>"
                       href="index.php?page=utilisateurs&action=index">
                        <i class="bi bi-people"></i> Utilisateurs
                    </a>
                </li>
                <?php endif; ?>
            </ul>

            <!-- Infos utilisateur + déconnexion -->
            <?php if (isset($_SESSION['utilisateur'])): ?>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white-50 small">
                    <i class="bi bi-person-circle"></i>
                    <?= htmlspecialchars($_SESSION['utilisateur']['prenom'] . ' ' . $_SESSION['utilisateur']['nom']) ?>
                    <span class="badge bg-light text-primary ms-1">
                        <?= htmlspecialchars($_SESSION['utilisateur']['role']) ?>
                    </span>
                </span>
                <a href="index.php?page=auth&action=logout" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container-fluid px-4 py-3">
