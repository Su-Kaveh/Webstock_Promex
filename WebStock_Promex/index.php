<?php
session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Utilisateur.php';
require_once __DIR__ . '/models/Produit.php';
require_once __DIR__ . '/models/Categorie.php';
require_once __DIR__ . '/models/MouvementStock.php';

$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

// Pages publiques (sans auth)
$pages_publiques = ['auth'];

// Vérification session
if (!isset($_SESSION['utilisateur']) && !in_array($page, $pages_publiques)) {
    header('Location: index.php?page=auth&action=login');
    exit;
}

// Routeur
switch ($page) {
    case 'auth':
        require_once __DIR__ . '/controllers/AuthController.php';
        $controller = new AuthController();
        if ($action === 'login')  $controller->login();
        if ($action === 'logout') $controller->logout();
        break;

    case 'dashboard':
        require_once __DIR__ . '/controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        break;

    case 'produits':
        require_once __DIR__ . '/controllers/ProduitController.php';
        $controller = new ProduitController();
        if ($action === 'index')  $controller->index();
        if ($action === 'create') $controller->create();
        if ($action === 'edit')   $controller->edit($_GET['id'] ?? 0);
        if ($action === 'delete') $controller->delete($_GET['id'] ?? 0);
        break;

    case 'categories':
        require_once __DIR__ . '/controllers/CategorieController.php';
        $controller = new CategorieController();
        if ($action === 'index')  $controller->index();
        if ($action === 'create') $controller->create();
        if ($action === 'edit')   $controller->edit($_GET['id'] ?? 0);
        if ($action === 'delete') $controller->delete($_GET['id'] ?? 0);
        break;

    case 'mouvements':
        require_once __DIR__ . '/controllers/MouvementController.php';
        $controller = new MouvementController();
        if ($action === 'index')  $controller->index();
        if ($action === 'create') $controller->create();
        break;

    case 'utilisateurs':
        // Réservé admin
        if ($_SESSION['utilisateur']['role'] !== 'admin') {
            header('Location: index.php?page=dashboard');
            exit;
        }
        require_once __DIR__ . '/controllers/UtilisateurController.php';
        $controller = new UtilisateurController();
        if ($action === 'index')  $controller->index();
        if ($action === 'create') $controller->create();
        if ($action === 'edit')   $controller->edit($_GET['id'] ?? 0);
        if ($action === 'delete') $controller->delete($_GET['id'] ?? 0);
        break;

    default:
        header('Location: index.php?page=dashboard');
        exit;
}
