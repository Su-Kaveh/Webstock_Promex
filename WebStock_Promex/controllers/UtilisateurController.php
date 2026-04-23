<?php
class UtilisateurController {
    private $utilisateur;

    public function __construct() {
        $this->utilisateur = new Utilisateur();
    }

    public function index() {
        $utilisateurs = $this->utilisateur->getAll();
        require __DIR__ . '/../views/utilisateurs/index.php';
    }

    public function create() {
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom'          => trim($_POST['nom'] ?? ''),
                'prenom'       => trim($_POST['prenom'] ?? ''),
                'email'        => trim($_POST['email'] ?? ''),
                'mot_de_passe' => trim($_POST['mot_de_passe'] ?? ''),
                'role'         => $_POST['role'] ?? 'commercial',
            ];

            if (empty($data['nom']) || empty($data['email']) || empty($data['mot_de_passe'])) {
                $erreur = "Les champs nom, email et mot de passe sont obligatoires.";
            } elseif ($this->utilisateur->emailExiste($data['email'])) {
                $erreur = "Cet email est déjà utilisé.";
            } else {
                $this->utilisateur->create($data);
                header('Location: index.php?page=utilisateurs&action=index&succes=1');
                exit;
            }
        }

        require __DIR__ . '/../views/utilisateurs/form.php';
    }

    public function edit($id) {
        $utilisateur = $this->utilisateur->getById($id);
        $erreur = '';

        if (!$utilisateur) {
            header('Location: index.php?page=utilisateurs');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom'    => trim($_POST['nom'] ?? ''),
                'prenom' => trim($_POST['prenom'] ?? ''),
                'email'  => trim($_POST['email'] ?? ''),
                'role'   => $_POST['role'] ?? 'commercial',
            ];

            if (empty($data['nom']) || empty($data['email'])) {
                $erreur = "Les champs nom et email sont obligatoires.";
            } elseif ($this->utilisateur->emailExiste($data['email'], $id)) {
                $erreur = "Cet email est déjà utilisé.";
            } else {
                $this->utilisateur->update($id, $data);
                header('Location: index.php?page=utilisateurs&action=index&succes=2');
                exit;
            }
        }

        require __DIR__ . '/../views/utilisateurs/form.php';
    }

    public function delete($id) {
        // Empêcher la suppression de son propre compte
        if ($id == $_SESSION['utilisateur']['id_utilisateur']) {
            header('Location: index.php?page=utilisateurs&action=index&erreur=1');
            exit;
        }
        $this->utilisateur->delete($id);
        header('Location: index.php?page=utilisateurs&action=index&succes=3');
        exit;
    }
}
