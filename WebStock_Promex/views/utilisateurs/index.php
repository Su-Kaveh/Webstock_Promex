<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0"><i class="bi bi-people"></i> Utilisateurs</h1>
    <a href="index.php?page=utilisateurs&action=create" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Nouvel utilisateur
    </a>
</div>

<?php if (isset($_GET['succes'])): ?>
    <?php $msg = ['1'=>'Utilisateur créé.','2'=>'Utilisateur modifié.','3'=>'Utilisateur supprimé.']; ?>
    <div class="alert alert-success py-2">
        <i class="bi bi-check-circle"></i> <?= $msg[$_GET['succes']] ?? '' ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['erreur']) && $_GET['erreur'] == 1): ?>
    <div class="alert alert-danger py-2">
        <i class="bi bi-exclamation-circle"></i> Vous ne pouvez pas supprimer votre propre compte.
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover table-sm mb-0">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th class="text-center">Rôle</th>
                    <th>Créé le</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($utilisateurs)): ?>
                    <tr><td colspan="6" class="text-center text-muted py-3">Aucun utilisateur.</td></tr>
                <?php else: ?>
                    <?php foreach ($utilisateurs as $u): ?>
                    <tr>
                        <td class="fw-semibold"><?= htmlspecialchars($u['nom']) ?></td>
                        <td><?= htmlspecialchars($u['prenom']) ?></td>
                        <td class="text-muted"><?= htmlspecialchars($u['email']) ?></td>
                        <td class="text-center">
                            <?php
                            $badgeClass = match($u['role']) {
                                'admin'      => 'bg-danger',
                                'acheteur'   => 'bg-warning text-dark',
                                default      => 'bg-secondary'
                            };
                            ?>
                            <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($u['role']) ?></span>
                        </td>
                        <td class="text-muted small"><?= date('d/m/Y', strtotime($u['created_at'])) ?></td>
                        <td class="text-center">
                            <a href="index.php?page=utilisateurs&action=edit&id=<?= $u['id_utilisateur'] ?>"
                               class="btn btn-outline-primary btn-sm py-0">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <?php if ($u['id_utilisateur'] != $_SESSION['utilisateur']['id_utilisateur']): ?>
                            <a href="index.php?page=utilisateurs&action=delete&id=<?= $u['id_utilisateur'] ?>"
                               class="btn btn-outline-danger btn-sm py-0"
                               onclick="return confirm('Supprimer cet utilisateur ?')">
                                <i class="bi bi-trash"></i>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
