<?php
class DashboardController {
    private $produit;
    private $categorie;
    private $mouvement;

    public function __construct() {
        $this->produit   = new Produit();
        $this->categorie = new Categorie();
        $this->mouvement = new MouvementStock();
    }

    public function index() {
        $tous_produits    = $this->produit->getAll();
        $stock_bas        = $this->produit->getStockBas();
        $nb_categories    = count($this->categorie->getAll());
        $derniers_mouvements = array_slice($this->mouvement->getAll(), 0, 5);

        require __DIR__ . '/../views/dashboard.php';
    }
}
