<?php
require_once __DIR__ . '/../config/database.php';

class Utilisateur {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnexion();
    }

    public function authentifier($email, $mot_de_passe) {
        // VULNERABILITE CONNUE : mot de passe en clair (à corriger avec password_hash)
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE email = ? AND mot_de_passe = ?");
        $stmt->execute([$email, $mot_de_passe]);
        return $stmt->fetch();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM utilisateurs ORDER BY nom, prenom");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['mot_de_passe'],
            $data['role']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE utilisateurs SET nom=?, prenom=?, email=?, role=?
            WHERE id_utilisateur=?
        ");
        return $stmt->execute([
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['role'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM utilisateurs WHERE id_utilisateur = ?");
        return $stmt->execute([$id]);
    }

    public function emailExiste($email, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT id_utilisateur FROM utilisateurs WHERE email = ? AND id_utilisateur != ?");
            $stmt->execute([$email, $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT id_utilisateur FROM utilisateurs WHERE email = ?");
            $stmt->execute([$email]);
        }
        return $stmt->fetch() !== false;
    }
}
