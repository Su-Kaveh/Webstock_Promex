<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0"><i class="bi bi-arrow-left-right"></i> Mouvements de stock</h1>
    <a href="index.php?page=mouvements&action=create" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Nouveau mouvement
    </a>
</div>

<?php if (isset($_GET['succes'])): ?>
    <div class="alert alert-success py-2">
        <i class="bi bi-check-circle"></i> Mouvement enregistré.
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover table-sm mb-0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Produit</th>
                    <th>Référence</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Quantité</th>
                    <th>Motif</th>
                    <th>Utilisateur</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($mouvements)): ?>
                    <tr><td colspan="7" class="text-center text-muted py-3">Aucun mouvement enregistré.</td></tr>
                <?php else: ?>
                    <?php foreach ($mouvements as $m): ?>
                    <tr>
                        <td class="text-muted small"><?= date('d/m/Y H:i', strtotime($m['date_mouvement'])) ?></td>
                        <td><?= htmlspecialchars($m['produit']) ?></td>
                        <td><code><?= htmlspecialchars($m['reference']) ?></code></td>
                        <td class="text-center">
                            <?php if ($m['type_mouvement'] === 'entree'): ?>
                                <span class="badge bg-success"><i class="bi bi-arrow-down"></i> Entrée</span>
                            <?php else: ?>
                                <span class="badge bg-danger"><i class="bi bi-arrow-up"></i> Sortie</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center fw-semibold"><?= $m['quantite'] ?></td>
                        <td class="text-muted"><?= htmlspecialchars($m['motif'] ?? '—') ?></td>
                        <td class="text-muted small">
                            <?= htmlspecialchars($m['utilisateur_prenom'] . ' ' . $m['utilisateur_nom']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
