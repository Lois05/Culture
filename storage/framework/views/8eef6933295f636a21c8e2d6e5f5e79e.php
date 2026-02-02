<?php $__env->startSection('page-title', 'Mon Profil'); ?>

<?php $__env->startSection('content'); ?>
<main class="app-main min-vh-100">
    <div class="container-fluid mt-4">
        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-6 fw-bold text-primary">
                    <i class="bi bi-person-circle me-2"></i> Mon Profil
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.tableaudebord')); ?>">Tableau de bord</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Mon Profil</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="<?php echo e(route('admin.profile.edit')); ?>" class="btn btn-primary">
                    <i class="bi bi-pencil me-2"></i> Modifier le profil
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Colonne gauche - Informations personnelles -->
            <div class="col-lg-8">
                <!-- Carte principale -->
                <div class="card shadow-lg border-0 rounded-3 mb-4">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-person-lines-fill me-2"></i> Informations Personnelles
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Photo de profil -->
                            <div class="col-md-4 text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <?php
                                        $initial = strtoupper(substr($user->name ?? 'U', 0, 1));
                                        if ($user->photo) {
                                            $photoPath = 'adminlte/img/' . $user->photo;
                                            $photoUrl = asset($photoPath);
                                            $photoExists = file_exists(public_path($photoPath));
                                        }
                                    ?>

                                    <?php if($user->photo && ($photoExists ?? false)): ?>
                                        <img src="<?php echo e($photoUrl); ?>"
                                             class="profile-photo rounded-circle border-4 border-primary shadow-lg"
                                             width="150" height="150"
                                             alt="<?php echo e($user->name); ?>"
                                             onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <?php endif; ?>

                                    <div class="profile-photo rounded-circle border-4 border-primary shadow-lg d-flex align-items-center justify-content-center
                                               <?php echo e(($user->photo && ($photoExists ?? false)) ? 'd-none' : ''); ?>"
                                         style="width: 150px; height: 150px; background: linear-gradient(45deg, #4e73df, #224abe);">
                                        <span class="text-white fw-bold display-4"><?php echo e($initial); ?></span>
                                    </div>

                                    <!-- Badge statut -->
                                    <div class="position-absolute bottom-0 end-0">
                                        <span class="badge rounded-pill <?php echo e($user->statut == 'actif' ? 'bg-success' : 'bg-danger'); ?> p-2">
                                            <i class="bi <?php echo e($user->statut == 'actif' ? 'bi-check-circle' : 'bi-x-circle'); ?> me-1"></i>
                                            <?php echo e(ucfirst($user->statut)); ?>

                                        </span>
                                    </div>
                                </div>

                                <?php if($user->photo): ?>
                                    <div class="mt-3">
                                        <small class="text-muted">Photo actuelle</small>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Informations -->
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Nom complet</label>
                                        <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                            <i class="bi bi-person me-3 text-primary fs-5"></i>
                                            <div>
                                                <h5 class="mb-0 fw-bold"><?php echo e($user->name); ?> <?php echo e($user->prenom); ?></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Email</label>
                                        <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                            <i class="bi bi-envelope me-3 text-primary fs-5"></i>
                                            <div>
                                                <h6 class="mb-0"><?php echo e($user->email); ?></h6>
                                                <small class="text-muted">
                                                    <?php if($user->email_verified_at): ?>
                                                        <span class="text-success">
                                                            <i class="bi bi-check-circle me-1"></i>Vérifié
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="text-danger">
                                                            <i class="bi bi-x-circle me-1"></i>Non vérifié
                                                        </span>
                                                    <?php endif; ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Rôle</label>
                                        <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                            <i class="bi bi-shield-check me-3 text-primary fs-5"></i>
                                            <span class="badge
                                                <?php switch($user->role->nom_role ?? ''):
                                                    case ('Administrateur'): ?> bg-danger
                                                    <?php case ('Modérateur'): ?> bg-warning text-dark
                                                    <?php case ('Contributeur'): ?> bg-info
                                                    <?php default: ?> bg-secondary
                                                <?php endswitch; ?> fs-6 px-3 py-2">
                                                <?php echo e($user->role->nom_role ?? 'Aucun rôle'); ?>

                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Langue</label>
                                        <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                            <i class="bi bi-translate me-3 text-primary fs-5"></i>
                                            <span class="badge bg-white text-dark border fs-6 px-3 py-2">
                                                <?php echo e($user->langue->nom_langue ?? 'Français'); ?>

                                            </span>
                                        </div>
                                    </div>

                                    <?php if($user->telephone): ?>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small mb-1">Téléphone</label>
                                        <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                            <i class="bi bi-telephone me-3 text-primary fs-5"></i>
                                            <h6 class="mb-0"><?php echo e($user->telephone); ?></h6>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if($user->adresse): ?>
                                    <div class="col-12 mb-3">
                                        <label class="form-label text-muted small mb-1">Adresse</label>
                                        <div class="d-flex p-3 bg-light rounded-3">
                                            <i class="bi bi-geo-alt me-3 text-primary fs-5"></i>
                                            <h6 class="mb-0"><?php echo e($user->adresse); ?></h6>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
<div class="card shadow-lg border-0 rounded-3">
    <div class="card-header bg-white border-bottom py-3">
        <h5 class="mb-0 fw-bold text-primary">
            <i class="bi bi-graph-up me-2"></i> Statistiques
        </h5>
    </div>
    <div class="card-body">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-3">
                <div class="p-3 border rounded-3">
                    <h3 class="text-primary mb-1">
                        <?php echo e(isset($user->contenus) ? $user->contenus->count() : 0); ?>

                    </h3>
                    <small class="text-muted">Contenus</small>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="p-3 border rounded-3">
                    <h3 class="text-success mb-1">
                        <?php echo e(isset($user->commentaires) ? $user->commentaires->count() : 0); ?>

                    </h3>
                    <small class="text-muted">Commentaires</small>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="p-3 border rounded-3">
                    <h3 class="text-warning mb-1">
                        <?php echo e(isset($user->medias) ? $user->medias->count() : 0); ?>

                    </h3>
                    <small class="text-muted">Médias</small>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="p-3 border rounded-3">
                    <?php if($user->last_login_at): ?>
                        <h6 class="text-info mb-1"><?php echo e(\Carbon\Carbon::parse($user->last_login_at)->format('d/m/Y')); ?></h6>
                    <?php else: ?>
                        <h6 class="text-muted mb-1">Jamais</h6>
                    <?php endif; ?>
                    <small class="text-muted">Dernière connexion</small>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>

            <!-- Colonne droite - Actions et informations -->
            <div class="col-lg-4">
                <!-- Actions rapides -->
                <div class="card shadow-lg border-0 rounded-3 mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-lightning-charge me-2"></i> Actions Rapides
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="<?php echo e(route('admin.profile.edit')); ?>" class="btn btn-primary">
                                <i class="bi bi-pencil me-2"></i> Modifier le profil
                            </a>
                            <a href="<?php echo e(route('admin.profile.change-password')); ?>" class="btn btn-outline-warning">
                                <i class="bi bi-key me-2"></i> Changer le mot de passe
                            </a>
                            <a href="<?php echo e(route('admin.tableaudebord')); ?>" class="btn btn-outline-info">
                                <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
                            </a>
                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                <i class="bi bi-trash me-2"></i> Supprimer le compte
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Informations du compte -->
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-info-circle me-2"></i> Informations du Compte
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                                <span class="text-muted">ID :</span>
                                <strong>#<?php echo e($user->id); ?></strong>
                            </li>
                            <li class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                                <span class="text-muted">Créé le :</span>
                                <span><?php echo e($user->created_at->format('d/m/Y H:i')); ?></span>
                            </li>
                            <li class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                                <span class="text-muted">Modifié le :</span>
                                <span><?php echo e($user->updated_at->format('d/m/Y H:i')); ?></span>
                            </li>
                            <?php if($user->email_verified_at): ?>
                            <li class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                                <span class="text-muted">Email vérifié :</span>
                               <span class="text-success"><?php echo e(\Carbon\Carbon::parse($user->email_verified_at)->format('d/m/Y H:i')); ?></span>
                            </li>
                            <?php endif; ?>
                            <?php if($user->two_factor_secret): ?>
                            <li class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                                <span class="text-muted">2FA :</span>
                                <span class="text-success">
                                    <i class="bi bi-shield-check me-1"></i> Activé
                                </span>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal de suppression de compte -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i> Supprimer le compte
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer votre compte ?</p>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-octagon me-2"></i>
                    <strong>Attention !</strong> Cette action est irréversible. Toutes vos données seront définitivement supprimées.
                </div>
                <form action="<?php echo e(route('profile.destroy')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirmez votre mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i> Supprimer mon compte
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    // Animation des cartes
    $('.card').hover(
        function() {
            $(this).css('transform', 'translateY(-5px)');
            $(this).css('box-shadow', '0 10px 25px rgba(0,0,0,0.15)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
            $(this).css('box-shadow', '');
        }
    );
});
</script>

<style>
.profile-photo {
    object-fit: cover;
    transition: all 0.3s ease;
}

.profile-photo:hover {
    transform: scale(1.05);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
}

.card {
    transition: all 0.3s ease;
}

.badge {
    font-size: 0.85em;
    padding: 5px 10px;
}

@media (max-width: 768px) {
    .profile-photo {
        width: 120px !important;
        height: 120px !important;
    }
}
</style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views/profile/show.blade.php ENDPATH**/ ?>