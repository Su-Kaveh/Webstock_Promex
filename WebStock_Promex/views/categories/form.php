<?php require __DIR__ . '/../layout/header.php';
$edit  = isset($categorie);
$titre = $edit ? 'Modifier la catégorie' : 'Nouvelle catégorie';
?>

<div class="d-flex align-items-center gap-2 mb-3">
    <a href="index.php?page=categories&action=index" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h1 class="page-title mb-0"><i class="bi bi-tags"></i> <?= $titre ?></h1>
</div>

<?php if (!empty($erreur)): ?>
    <div class="alert alert-danger py-2"><i class="bi bi-exclamation-circle"></i> <?= htmlspecialchars($erreur) ?></div>
<?php endif; ?>

<div class="form-card">
    <form method="POST">
        <div class="mb-3">
            <label class="form-label fw-semibold">Libellé <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="libelle"
                   value="<?= htmlspecialchars($categorie['libelle'] ?? $_POST['libelle'] ?? '') ?>"
                   required autofocus>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Description</label>
            <textarea class="form-control" name="description" rows="3"><?= htmlspecialchars($categorie['description'] ?? $_POST['description'] ?? '') ?></textarea>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> <?= $edit ? 'Enregistrer' : 'Créer' ?>
            </button>
            <a href="index.php?page=categories&action=index" class="btn btn-outline-secondary">Annuler</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
