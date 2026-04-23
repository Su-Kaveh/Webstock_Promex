<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0"><i class="bi bi-box-seam"></i> Produits</h1>
    <a href="index.php?page=produits&action=create" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Nouveau produit
    </a>
</div>

<?php if (isset($_GET['succes'])): ?>
    <?php $msg = ['1'=>'Produit créé.','2'=>'Produit modifié.','3'=>'Produit supprimé.']; ?>
    <div class="alert alert-success py-2">
        <i class="bi bi-check-circle"></i> <?= $msg[$_GET['succes']] ?? '' ?>
    </div>
<?php endif; ?>

<!-- Filtres -->
<form method="GET" action="index.php" class="row g-2 mb-3">
    <input type="hidden" name="page" value="produits">
    <input type="hidden" name="action" value="index">
    <div class="col-sm-5">
        <input type="text" class="form-control form-control-sm" name="search"
               placeholder="Rechercher par désignation ou référence..."
               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    </div>
    <div class="col-sm-4">
        <select name="id_categorie" class="form-select form-select-sm">
            <option value="">Toutes les catégories</option>
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id_categorie'] ?>"
                    <?= ($_GET['id_categorie'] ?? '') == $c['id_categorie'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['libelle']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-secondary btn-sm">
            <i class="bi bi-search"></i> Filtrer
        </button>
        <a href="index.php?page=produits&action=index" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-x"></i> Reset
        </a>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover table-sm mb-0">
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Désignation</th>
                    <th>Catégorie</th>
                    <th class="text-end">Prix HT</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Min.</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($produits)): ?>
                    <tr><td colspan="7" class="text-center text-muted py-3">Aucun produit trouvé.</td></tr>
                <?php else: ?>
                    <?php foreach ($produits as $p): ?>
                    <tr>
                        <td><code><?= htmlspecialchars($p['reference']) ?></code></td>
                        <td><?= htmlspecialchars($p['designation']) ?></td>
                        <td><?= htmlspecialchars($p['categorie']) ?></td>
                        <td class="text-end"><?= number_format($p['prix_unitaire'], 2, ',', ' ') ?> €</td>
                        <td class="text-center">
                            <?php
                            if ($p['stock_actuel'] == 0) $cls = 'badge-stock-vide';
                            elseif ($p['stock_actuel'] <= $p['stock_minimum']) $cls = 'badge-stock-bas';
                            else $cls = 'badge-stock-ok';
                            ?>
                            <span class="badge <?= $cls ?>"><?= $p['stock_actuel'] ?></span>
                        </td>
                        <td class="text-center text-muted"><?= $p['stock_minimum'] ?></td>
                        <td class="text-center">
                            <a href="index.php?page=produits&action=edit&id=<?= $p['id_produit'] ?>"
                               class="btn btn-outline-primary btn-sm py-0">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="index.php?page=produits&action=delete&id=<?= $p['id_produit'] ?>"
                               class="btn btn-outline-danger btn-sm py-0"
                               onclick="return confirm('Supprimer ce produit ?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
