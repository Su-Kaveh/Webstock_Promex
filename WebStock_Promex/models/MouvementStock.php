<?php
require_once __DIR__ . '/../config/database.php';

class MouvementStock {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnexion();
    }

    public function getAll() {
        $stmt = $this->db->query("
            SELECT m.*, p.designation AS produit, p.reference,
                   u.nom AS utilisateur_nom, u.prenom AS utilisateur_prenom
            FROM mouvements_stock m
            LEFT JOIN produits p ON m.id_produit = p.id_produit
            LEFT JOIN utilisateurs u ON m.id_utilisateur = u.id_utilisateur
            ORDER BY m.date_mouvement DESC
        ");
        return $stmt->fetchAll();
    }

    public function getByProduit($id_produit) {
        $stmt = $this->db->prepare("
            SELECT m.*, u.nom AS utilisateur_nom, u.prenom AS utilisateur_prenom
            FROM mouvements_stock m
            LEFT JOIN utilisateurs u ON m.id_utilisateur = u.id_utilisateur
            WHERE m.id_produit = ?
            ORDER BY m.date_mouvement DESC
        ");
        $stmt->execute([$id_produit]);
        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO mouvements_stock (type_mouvement, quantite, motif, id_produit, id_utilisateur)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['type_mouvement'],
            $data['quantite'],
            $data['motif'],
            $data['id_produit'],
            $data['id_utilisateur']
        ]);
    }
}
