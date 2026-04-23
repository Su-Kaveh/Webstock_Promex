<?php require __DIR__ . '/layout/header.php'; ?>

<h1 class="page-title"><i class="bi bi-speedometer2"></i> Tableau de bord</h1>

<!-- Cartes statistiques -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card card-stat p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">Produits</p>
                    <h3 class="fw-bold mb-0"><?= count($tous_produits) ?></h3>
                </div>
                <span class="stat-icon text-primary"><i class="bi bi-box-seam"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-stat p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">Catégories</p>
                    <h3 class="fw-bold mb-0"><?= $nb_categories ?></h3>
                </div>
                <span class="stat-icon text-success"><i class="bi bi-tags"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-stat p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">Stock bas</p>
                    <h3 class="fw-bold mb-0 <?= count($stock_bas) > 0 ? 'text-warning' : '' ?>">
                        <?= count($stock_bas) ?>
                    </h3>
                </div>
                <span class="stat-icon text-warning"><i class="bi bi-exclamation-triangle"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-stat p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">Mouvements</p>
                    <h3 class="fw-bold mb-0"><?= count($derniers_mouvements) ?></h3>
                </div>
                <span class="stat-icon text-info"><i class="bi bi-arrow-left-right"></i></span>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <!-- Alertes stock bas -->
    <?php if (count($stock_bas) > 0): ?>
    <div class="col-lg-6">
        <div class="card border-warning">
            <div class="card-header bg-warning bg-opacity-10 fw-semibold">
                <i class="bi bi-exclamation-triangle text-warning"></i> Produits en stock bas
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Désignation</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Minimum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stock_bas as $p): ?>
                        <tr>
                            <td><code><?= htmlspecialchars($p['reference']) ?></code></td>
                            <td><?= htmlspecialchars($p['designation']) ?></td>
                            <td class="text-center">
                                <span class="badge <?= $p['stock_actuel'] == 0 ? 'badge-stock-vide' : 'badge-stock-bas' ?>">
                                    <?= $p['stock_actuel'] ?>
                                </span>
                            </td>
                            <td class="text-center text-muted"><?= $p['stock_minimum'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Derniers mouvements -->
    <div class="col-lg-<?= count($stock_bas) > 0 ? '6' : '12' ?>">
        <div class="card">
            <div class="card-header fw-semibold">
                <i class="bi bi-clock-history"></i> Derniers mouvements
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Produit</th>
                            <th>Type</th>
                            <th class="text-center">Qté</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($derniers_mouvements as $m): ?>
                        <tr>
                            <td class="text-muted small"><?= date('d/m/Y H:i', strtotime($m['date_mouvement'])) ?></td>
                            <td><?= htmlspecialchars($m['produit']) ?></td>
                            <td>
                                <?php if ($m['type_mouvement'] === 'entree'): ?>
                                    <span class="badge bg-success">Entrée</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Sortie</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?= $m['quantite'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>
