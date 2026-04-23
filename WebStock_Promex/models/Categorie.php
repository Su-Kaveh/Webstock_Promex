<?php
require_once __DIR__ . '/../config/database.php';

class Categorie {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnexion();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM categories ORDER BY libelle");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id_categorie = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO categories (libelle, description) VALUES (?, ?)");
        return $stmt->execute([$data['libelle'], $data['description']]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE categories SET libelle=?, description=? WHERE id_categorie=?");
        return $stmt->execute([$data['libelle'], $data['description'], $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id_categorie = ?");
        return $stmt->execute([$id]);
    }
}
