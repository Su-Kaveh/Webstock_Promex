<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0"><i class="bi bi-tags"></i> Catégories</h1>
    <a href="index.php?page=categories&action=create" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Nouvelle catégorie
    </a>
</div>

<?php if (isset($_GET['succes'])): ?>
    <?php $msg = ['1'=>'Catégorie créée.','2'=>'Catégorie modifiée.','3'=>'Catégorie supprimée.']; ?>
    <div class="alert alert-success py-2">
        <i class="bi bi-check-circle"></i> <?= $msg[$_GET['succes']] ?? '' ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover table-sm mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categories)): ?>
                    <tr><td colspan="4" class="text-center text-muted py-3">Aucune catégorie.</td></tr>
                <?php else: ?>
                    <?php foreach ($categories as $c): ?>
                    <tr>
                        <td class="text-muted"><?= $c['id_categorie'] ?></td>
                        <td class="fw-semibold"><?= htmlspecialchars($c['libelle']) ?></td>
                        <td class="text-muted"><?= htmlspecialchars($c['description'] ?? '—') ?></td>
                        <td class="text-center">
                            <a href="index.php?page=categories&action=edit&id=<?= $c['id_categorie'] ?>"
                               class="btn btn-outline-primary btn-sm py-0">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="index.php?page=categories&action=delete&id=<?= $c['id_categorie'] ?>"
                               class="btn btn-outline-danger btn-sm py-0"
                               onclick="return confirm('Supprimer cette catégorie ?')">
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
