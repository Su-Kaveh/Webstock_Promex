<?php
class ProduitController {
    private $produit;
    private $categorie;

    public function __construct() {
        $this->produit   = new Produit();
        $this->categorie = new Categorie();
    }

    public function index() {
        $search       = trim($_GET['search'] ?? '');
        $id_categorie = $_GET['id_categorie'] ?? null;
        $produits     = $this->produit->getAll($search, $id_categorie);
        $categories   = $this->categorie->getAll();
        require __DIR__ . '/../views/produits/index.php';
    }

    public function create() {
        $categories = $this->categorie->getAll();
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'reference'     => trim($_POST['reference'] ?? ''),
                'designation'   => trim($_POST['designation'] ?? ''),
                'description'   => trim($_POST['description'] ?? ''),
                'prix_unitaire' => $_POST['prix_unitaire'] ?? 0,
                'stock_actuel'  => $_POST['stock_actuel'] ?? 0,
                'stock_minimum' => $_POST['stock_minimum'] ?? 5,
                'id_categorie'  => $_POST['id_categorie'] ?? null,
            ];

            if (empty($data['reference']) || empty($data['designation']) || empty($data['id_categorie'])) {
                $erreur = "Les champs référence, désignation et catégorie sont obligatoires.";
            } else {
                $this->produit->create($data);
                header('Location: index.php?page=produits&action=index&succes=1');
                exit;
            }
        }

        require __DIR__ . '/../views/produits/form.php';
    }

    public function edit($id) {
        $produit    = $this->produit->getById($id);
        $categories = $this->categorie->getAll();
        $erreur = '';

        if (!$produit) {
            header('Location: index.php?page=produits');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'reference'     => trim($_POST['reference'] ?? ''),
                'designation'   => trim($_POST['designation'] ?? ''),
                'description'   => trim($_POST['description'] ?? ''),
                'prix_unitaire' => $_POST['prix_unitaire'] ?? 0,
                'stock_actuel'  => $_POST['stock_actuel'] ?? 0,
                'stock_minimum' => $_POST['stock_minimum'] ?? 5,
                'id_categorie'  => $_POST['id_categorie'] ?? null,
            ];

            if (empty($data['reference']) || empty($data['designation']) || empty($data['id_categorie'])) {
                $erreur = "Les champs référence, désignation et catégorie sont obligatoires.";
            } else {
                $this->produit->update($id, $data);
                header('Location: index.php?page=produits&action=index&succes=2');
                exit;
            }
        }

        require __DIR__ . '/../views/produits/form.php';
    }

    public function delete($id) {
        $this->produit->delete($id);
        header('Location: index.php?page=produits&action=index&succes=3');
        exit;
    }
}
