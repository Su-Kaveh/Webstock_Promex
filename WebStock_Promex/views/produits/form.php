<?php require __DIR__ . '/../layout/header.php';
$edit = isset($produit);
$titre = $edit ? 'Modifier le produit' : 'Nouveau produit';
?>

<div class="d-flex align-items-center gap-2 mb-3">
    <a href="index.php?page=produits&action=index" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h1 class="page-title mb-0"><i class="bi bi-box-seam"></i> <?= $titre ?></h1>
</div>

<?php if (!empty($erreur)): ?>
    <div class="alert alert-danger py-2"><i class="bi bi-exclamation-circle"></i> <?= htmlspecialchars($erreur) ?></div>
<?php endif; ?>

<div class="form-card">
    <form method="POST">
        <div class="row g-3">
            <div class="col-sm-4">
                <label class="form-label fw-semibold">Référence <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="reference"
                       value="<?= htmlspecialchars($produit['reference'] ?? $_POST['reference'] ?? '') ?>" required>
            </div>
            <div class="col-sm-8">
                <label class="form-label fw-semibold">Désignation <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="designation"
                       value="<?= htmlspecialchars($produit['designation'] ?? $_POST['designation'] ?? '') ?>" required>
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Description</label>
                <textarea class="form-control" name="description" rows="2"><?= htmlspecialchars($produit['description'] ?? $_POST['description'] ?? '') ?></textarea>
            </div>
            <div class="col-sm-4">
                <label class="form-label fw-semibold">Catégorie <span class="text-danger">*</span></label>
                <select class="form-select" name="id_categorie" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= $c['id_categorie'] ?>"
                            <?= ($produit['id_categorie'] ?? $_POST['id_categorie'] ?? '') == $c['id_categorie'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['libelle']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-4">
                <label class="form-label fw-semibold">Prix unitaire HT (€)</label>
                <input type="number" step="0.01" min="0" class="form-control" name="prix_unitaire"
                       value="<?= htmlspecialchars($produit['prix_unitaire'] ?? $_POST['prix_unitaire'] ?? '0') ?>">
            </div>
            <div class="col-sm-2">
                <label class="form-label fw-semibold">Stock actuel</label>
                <input type="number" min="0" class="form-control" name="stock_actuel"
                       value="<?= htmlspecialchars($produit['stock_actuel'] ?? $_POST['stock_actuel'] ?? '0') ?>">
            </div>
            <div class="col-sm-2">
                <label class="form-label fw-semibold">Stock minimum</label>
                <input type="number" min="0" class="form-control" name="stock_minimum"
                       value="<?= htmlspecialchars($produit['stock_minimum'] ?? $_POST['stock_minimum'] ?? '5') ?>">
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> <?= $edit ? 'Enregistrer' : 'Créer' ?>
            </button>
            <a href="index.php?page=produits&action=index" class="btn btn-outline-secondary">Annuler</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
