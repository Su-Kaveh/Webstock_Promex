<?php require __DIR__ . '/../layout/header.php';
$edit  = isset($utilisateur);
$titre = $edit ? 'Modifier l\'utilisateur' : 'Nouvel utilisateur';
?>

<div class="d-flex align-items-center gap-2 mb-3">
    <a href="index.php?page=utilisateurs&action=index" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h1 class="page-title mb-0"><i class="bi bi-person"></i> <?= $titre ?></h1>
</div>

<?php if (!empty($erreur)): ?>
    <div class="alert alert-danger py-2"><i class="bi bi-exclamation-circle"></i> <?= htmlspecialchars($erreur) ?></div>
<?php endif; ?>

<div class="form-card">
    <form method="POST">
        <div class="row g-3">
            <div class="col-sm-6">
                <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nom"
                       value="<?= htmlspecialchars($utilisateur['nom'] ?? $_POST['nom'] ?? '') ?>" required>
            </div>
            <div class="col-sm-6">
                <label class="form-label fw-semibold">Prénom</label>
                <input type="text" class="form-control" name="prenom"
                       value="<?= htmlspecialchars($utilisateur['prenom'] ?? $_POST['prenom'] ?? '') ?>">
            </div>
            <div class="col-sm-8">
                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email"
                       value="<?= htmlspecialchars($utilisateur['email'] ?? $_POST['email'] ?? '') ?>" required>
            </div>
            <div class="col-sm-4">
                <label class="form-label fw-semibold">Rôle</label>
                <select class="form-select" name="role">
                    <?php foreach (['admin','commercial','acheteur'] as $r): ?>
                        <option value="<?= $r ?>"
                            <?= ($utilisateur['role'] ?? $_POST['role'] ?? 'commercial') === $r ? 'selected' : '' ?>>
                            <?= ucfirst($r) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php if (!$edit): ?>
            <div class="col-sm-6">
                <label class="form-label fw-semibold">Mot de passe <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="mot_de_passe" required>
            </div>
            <?php endif; ?>
        </div>
        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> <?= $edit ? 'Enregistrer' : 'Créer' ?>
            </button>
            <a href="index.php?page=utilisateurs&action=index" class="btn btn-outline-secondary">Annuler</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
