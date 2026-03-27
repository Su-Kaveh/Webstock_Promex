# Promex — Dossier E6 BTS SIO SLAM
 
> Projets de développement applicatif interne réalisés dans le cadre de l'épreuve E6 — BTS Services Informatiques aux Organisations, option SLAM — Session 2026.
 
---
 
## 🏢 Contexte
 
**Promex** est une PME spécialisée dans la distribution de matériel professionnel (outillage industriel, fournitures de bureau, équipements de sécurité) auprès d'une clientèle B2B, basée à Villejuif (94).
 
Face à une gestion reposant sur des fichiers Excel non synchronisés, la direction a confié au développeur interne la conception et le développement de deux applications métier complémentaires, s'appuyant sur une base de données MySQL partagée : **promex_db**.
 
 
## 🌐 SP1 — WebStock (Client léger)
 
Application web de gestion des stocks accessible via navigateur.
 
| Élément | Détail |
|---|---|
| **Langages** | HTML5, CSS3, PHP 8.x |
| **Base de données** | MySQL 8.0 (promex_db) |
| **Serveur** | Apache via XAMPP |
| **IDE** | VS Code |
| **Versioning** | Git / GitHub |
 
### Fonctionnalités
 
- Authentification avec gestion des rôles (Commercial / Administrateur)
- Consultation et recherche des produits par désignation ou catégorie
- CRUD complet sur les produits et catégories
- Enregistrement des mouvements de stock (entrées / sorties)
- Gestion des utilisateurs (réservée à l'administrateur)
 
 
## 🖥️ SP2 — LogiDesk (Client lourd)
 
Application desktop de gestion des commandes fournisseurs.
 
| Élément | Détail |
|---|---|
| **Langage** | Python 3.12 |
| **Framework GUI** | PySide6 |
| **Base de données** | MySQL 8.0 (promex_db) |
| **Connecteur BDD** | mysql-connector-python |
| **IDE** | VS Code / PyCharm |
| **Versioning** | Git / GitHub |
 
### Fonctionnalités
 
- Authentification avec gestion des rôles (Acheteur / Administrateur)
- CRUD complet sur les fournisseurs
- Création et suivi des commandes fournisseurs
- Gestion des lignes de commande
- Modification du statut d'une commande (En cours / Validée / Livrée)
- Gestion des utilisateurs (réservée à l'administrateur)
 
 
### Comptes de test
 
| Rôle | Email | Mot de passe |
|---|---|---|
| Administrateur | admin@promex.fr | admin123 |
| Acheteur | acheteur@promex.fr | user123 |
 
---
 
## 🗄️ Base de données — promex_db
 
Base de données MySQL partagée entre WebStock et LogiDesk.
 
### Schéma
 
| Table | Description |
|---|---|
| `utilisateurs` | Comptes utilisateurs et rôles |
| `categories` | Catégories de produits |
| `produits` | Catalogue produits avec niveaux de stock |
| `fournisseurs` | Référentiel fournisseurs |
| `commandes` | En-têtes de commandes fournisseurs |
| `lignes_commande` | Détail des lignes par commande |
| `mouvements_stock` | Historique des entrées/sorties de stock |
 
 
## 👤 Auteur
 
**Kaveh Ostad** — Développeur interne Promex  
BTS SIO option SLAM — Session 2026
