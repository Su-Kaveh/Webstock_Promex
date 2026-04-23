<?php
require_once __DIR__ . '/../config/database.php';

class Produit {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnexion();
    }

    public function getAll($search = '', $id_categorie = null) {
        $sql = "
            SELECT p.*, c.libelle AS categorie
            FROM produits p
            LEFT JOIN categories c ON p.id_categorie = c.id_categorie
            WHERE 1=1
        ";
        $params = [];
        if ($search) {
            $sql .= " AND (p.designation LIKE ? OR p.reference LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
        if ($id_categorie) {
            $sql .= " AND p.id_categorie = ?";
            $params[] = $id_categorie;
        }
        $sql .= " ORDER BY p.designation";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT p.*, c.libelle AS categorie
            FROM produits p
            LEFT JOIN categories c ON p.id_categorie = c.id_categorie
            WHERE p.id_produit = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO produits (reference, designation, description, prix_unitaire, stock_actuel, stock_minimum, id_categorie)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['reference'],
            $data['designation'],
            $data['description'],
            $data['prix_unitaire'],
            $data['stock_actuel'],
            $data['stock_minimum'],
            $data['id_categorie']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE produits SET reference=?, designation=?, description=?,
            prix_unitaire=?, stock_actuel=?, stock_minimum=?, id_categorie=?
            WHERE id_produit=?
        ");
        return $stmt->execute([
            $data['reference'],
            $data['designation'],
            $data['description'],
            $data['prix_unitaire'],
            $data['stock_actuel'],
            $data['stock_minimum'],
            $data['id_categorie'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM produits WHERE id_produit = ?");
        return $stmt->execute([$id]);
    }

    public function updateStock($id, $quantite) {
        $stmt = $this->db->prepare("
            UPDATE produits SET stock_actuel = stock_actuel + ? WHERE id_produit = ?
        ");
        return $stmt->execute([$quantite, $id]);
    }

    public function getStockBas() {
        $stmt = $this->db->query("
            SELECT p.*, c.libelle AS categorie
            FROM produits p
            LEFT JOIN categories c ON p.id_categorie = c.id_categorie
            WHERE p.stock_actuel <= p.stock_minimum
            ORDER BY p.stock_actuel ASC
        ");
        return $stmt->fetchAll();
    }
}
