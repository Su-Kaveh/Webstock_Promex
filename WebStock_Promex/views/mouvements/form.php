<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex align-items-center gap-2 mb-3">
    <a href="index.php?page=mouvements&action=index" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h1 class="page-title mb-0"><i class="bi bi-arrow-left-right"></i> Nouveau mouvement</h1>
</div>

<?php if (!empty($erreur)): ?>
    <div class="alert alert-danger py-2"><i class="bi bi-exclamation-circle"></i> <?= htmlspecialchars($erreur) ?></div>
<?php endif; ?>

<div class="form-card">
    <form method="POST">
        <div class="mb-3">
            <label class="form-label fw-semibold">Produit <span class="text-danger">*</span></label>
            <select class="form-select" name="id_produit" required>
                <option value="">-- Choisir un produit --</option>
                <?php foreach ($produits as $p): ?>
                    <option value="<?= $p['id_produit'] ?>"
                        <?= ($_POST['id_produit'] ?? '') == $p['id_produit'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['reference'] . ' — ' . $p['designation']) ?>
                        (stock : <?= $p['stock_actuel'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-sm-6">
                <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                <select class="form-select" name="type_mouvement" required>
                    <option value="">-- Choisir --</option>
                    <option value="entree" <?= ($_POST['type_mouvement'] ?? '') === 'entree' ? 'selected' : '' ?>>
                        Entrée (réception)
                    </option>
                    <option value="sortie" <?= ($_POST['type_mouvement'] ?? '') === 'sortie' ? 'selected' : '' ?>>
                        Sortie (livraison / consommation)
                    </option>
                </select>
            </div>
            <div class="col-sm-6">
                <label class="form-label fw-semibold">Quantité <span class="text-danger">*</span></label>
                <input type="number" min="1" class="form-control" name="quantite"
                       value="<?= htmlspecialchars($_POST['quantite'] ?? '1') ?>" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Motif</label>
            <input type="text" class="form-control" name="motif"
                   placeholder="Ex : Réception commande CMD-2026-001, Livraison client..."
                   value="<?= htmlspecialchars($_POST['motif'] ?? '') ?>">
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> Enregistrer
            </button>
            <a href="index.php?page=mouvements&action=index" class="btn btn-outline-secondary">Annuler</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
