<?php
class MouvementController {
    private $mouvement;
    private $produit;

    public function __construct() {
        $this->mouvement = new MouvementStock();
        $this->produit   = new Produit();
    }

    public function index() {
        $mouvements = $this->mouvement->getAll();
        require __DIR__ . '/../views/mouvements/index.php';
    }

    public function create() {
        $produits = $this->produit->getAll();
        $erreur   = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'type_mouvement' => $_POST['type_mouvement'] ?? '',
                'quantite'       => (int)($_POST['quantite'] ?? 0),
                'motif'          => trim($_POST['motif'] ?? ''),
                'id_produit'     => $_POST['id_produit'] ?? null,
                'id_utilisateur' => $_SESSION['utilisateur']['id_utilisateur'],
            ];

            if (empty($data['type_mouvement']) || $data['quantite'] <= 0 || empty($data['id_produit'])) {
                $erreur = "Veuillez remplir tous les champs obligatoires.";
            } else {
                // Vérification stock suffisant pour une sortie
                if ($data['type_mouvement'] === 'sortie') {
                    $produit = $this->produit->getById($data['id_produit']);
                    if ($produit['stock_actuel'] < $data['quantite']) {
                        $erreur = "Stock insuffisant. Stock disponible : " . $produit['stock_actuel'];
                    }
                }

                if (empty($erreur)) {
                    $qte = $data['type_mouvement'] === 'sortie' ? -$data['quantite'] : $data['quantite'];
                    $this->produit->updateStock($data['id_produit'], $qte);
                    $this->mouvement->create($data);
                    header('Location: index.php?page=mouvements&action=index&succes=1');
                    exit;
                }
            }
        }

        require __DIR__ . '/../views/mouvements/form.php';
    }
}
