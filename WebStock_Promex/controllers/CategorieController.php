<?php
class CategorieController {
    private $categorie;

    public function __construct() {
        $this->categorie = new Categorie();
    }

    public function index() {
        $categories = $this->categorie->getAll();
        require __DIR__ . '/../views/categories/index.php';
    }

    public function create() {
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'libelle'     => trim($_POST['libelle'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
            ];

            if (empty($data['libelle'])) {
                $erreur = "Le libellé est obligatoire.";
            } else {
                $this->categorie->create($data);
                header('Location: index.php?page=categories&action=index&succes=1');
                exit;
            }
        }

        require __DIR__ . '/../views/categories/form.php';
    }

    public function edit($id) {
        $categorie = $this->categorie->getById($id);
        $erreur = '';

        if (!$categorie) {
            header('Location: index.php?page=categories');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'libelle'     => trim($_POST['libelle'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
            ];

            if (empty($data['libelle'])) {
                $erreur = "Le libellé est obligatoire.";
            } else {
                $this->categorie->update($id, $data);
                header('Location: index.php?page=categories&action=index&succes=2');
                exit;
            }
        }

        require __DIR__ . '/../views/categories/form.php';
    }

    public function delete($id) {
        $this->categorie->delete($id);
        header('Location: index.php?page=categories&action=index&succes=3');
        exit;
    }
}
