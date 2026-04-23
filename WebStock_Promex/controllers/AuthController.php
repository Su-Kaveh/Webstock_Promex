<?php
class AuthController {
    private $utilisateur;

    public function __construct() {
        $this->utilisateur = new Utilisateur();
    }

    public function login() {
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $mdp   = trim($_POST['mot_de_passe'] ?? '');

            if (empty($email) || empty($mdp)) {
                $erreur = "Veuillez remplir tous les champs.";
            } else {
                $user = $this->utilisateur->authentifier($email, $mdp);
                if ($user) {
                    $_SESSION['utilisateur'] = $user;
                    header('Location: index.php?page=dashboard');
                    exit;
                } else {
                    $erreur = "Email ou mot de passe incorrect.";
                }
            }
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?page=auth&action=login');
        exit;
    }
}
