# WebStock — Promex
 
> SP1 - Client léger / Épreuve E6 BTS SIO SLAM - Session 2026
 
Application web de gestion des stocks développée pour **Promex**, PME de distribution de matériel professionnel basée à Villejuif (94).
 
---
 
## Contexte
 
Promex gérait ses stocks via des fichiers Excel partagés sur le réseau local, engendrant des erreurs de saisie, des doublons et une absence de traçabilité. WebStock centralise la gestion des stocks dans une application web accessible depuis tous les postes de l'entreprise, sans installation préalable.
 
---
 
## Fonctionnalités
 
- Authentification sécurisée avec gestion des rôles (Commercial / Administrateur)
- Consultation et recherche des produits par désignation ou catégorie
- CRUD complet sur les produits et catégories
- Enregistrement des mouvements de stock (entrées / sorties) avec motif
- Gestion des utilisateurs réservée à l'administrateur
 
---

 
## Comptes de test
 
| Rôle | Email | Mot de passe |
|---|---|---|
| Administrateur | admin@promex.fr | admin123 |
| Commercial | commercial@promex.fr | user123 |
 
---
 
## Base de données
 
WebStock utilise la base **promex_db**, partagée avec LogiDesk (SP2).
 
| Table | Description |
|---|---|
| `utilisateurs` | Comptes et rôles |
| `categories` | Catégories de produits |
| `produits` | Catalogue avec niveaux de stock |
| `mouvements_stock` | Historique entrées / sorties |
 
> Les tables `commandes`, `lignes_commande` et `fournisseurs` sont présentes dans promex_db mais gérées par LogiDesk (SP2).
 
---
 
## Architecture
 
Le projet suit le patron **MVC** (Modèle - Vue - Contrôleur) :
 
- **Modèles** : classes PHP gérant l'accès aux données via PDO
- **Vues** : fichiers PHP générant le HTML affiché à l'utilisateur
- **Contrôleurs** : logique métier entre les modèles et les vues
- **Database** : classe Singleton assurant une instance unique de connexion PDO
 
---

---
 
## Projet associé
 
| Situation | Repo | Description |
|---|---|---|
| SP2 | [LogiDesk_Promex](https://github.com/kaveh-ostad/LogiDesk_Promex) | Client lourd — Gestion des commandes fournisseurs (Python / PySide6) |
 
---
 

