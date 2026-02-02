<?php $__env->startSection('title', 'Détails du contenu - Modération'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <!-- Contenu principal -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center py-3">
                    <div>
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-file-alt me-2"></i>
                            Détails du contenu
                        </h4>
                        <small class="opacity-75">ID: #<?php echo e($contenu->id_contenu); ?></small>
                    </div>
                    <span class="badge bg-white text-primary fs-6 px-3 py-2 shadow-sm">
                        <i class="fas fa-clock me-1"></i>
                        <?php echo e(ucfirst($contenu->statut)); ?>

                    </span>
                </div>

                <div class="card-body">
                    <!-- Titre -->
                    <h3 class="mb-4 text-primary"><?php echo e($contenu->titre); ?></h3>

                    <!-- Description -->
                    <div class="mb-5">
                        <h5 class="mb-3 border-bottom pb-2">
                            <i class="fas fa-align-left me-2 text-muted"></i>Description
                        </h5>
                        <div class="bg-light p-4 rounded-3 border">
                            <div class="content-text">
                                <?php echo $contenu->texte; ?>

                            </div>
                        </div>
                    </div>

                    <!-- Médias associés -->
                    <?php if(!$contenu->medias->isEmpty()): ?>
                    <div class="mb-5">
                        <h5 class="mb-3 border-bottom pb-2">
                            <i class="fas fa-images me-2 text-muted"></i>Médias associés
                        </h5>
                        <div class="row g-3">
                            <?php $__currentLoopData = $contenu->medias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card border h-100">
                                    <?php if($media->id_type_media == 1): ?> <!-- Image -->
                                        <img src="<?php if($media->has_cloudinary && $media->chemin ? asset('adminlte/img/' . $media->chemin) : asset('adminlte/img/default.jpg')): ?>
    <?php echo e($media->chemin ? asset('adminlte/img/' . $media->chemin) : asset('adminlte/img/default.jpg')); ?>

<?php elseif($media->chemin): ?>
<?php if($media->has_cloudinary && $media->chemin ? asset('adminlte/img/' . $media->chemin) : asset('adminlte/img/default.jpg')): ?>
    <img src="<?php echo e($media->chemin ? asset('adminlte/img/' . $media->chemin) : asset('adminlte/img/default.jpg')); ?>" alt="<?php echo e($media->description ?? 'Image'); ?>"
<?php elseif($media->chemin): ?>
    <?php if($media->has_cloudinary && $media->chemin ? asset('adminlte/img/' . $media->chemin) : asset('adminlte/img/default.jpg')): ?>
    <img src="<?php echo e($media->chemin ? asset('adminlte/img/' . $media->chemin) : asset('adminlte/img/default.jpg')); ?>" alt="<?php echo e($media->description ?? 'Image'); ?>"
<?php elseif($media->chemin): ?>
    <?php if($media->has_cloudinary && $media->chemin ? asset('adminlte/img/' . $media->chemin) : asset('adminlte/img/default.jpg')): ?>
    <img src="<?php echo e($media->chemin ? asset('adminlte/img/' . $media->chemin) : asset('adminlte/img/default.jpg')); ?>" alt="<?php echo e($media->description ?? 'Image'); ?>"
<?php elseif($media->chemin): ?>
<?php if($media->has_cloudinary && $media->chemin ? asset('adminlte/img/' . $media->chemin) : asset('adminlte/img/default.jpg')): ?>
<?php elseif($media->chemin): ?>
    <img src="<?php echo e(asset('storage/' . $media->
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>"
                                             class="card-img-top"
                                             alt="{{ $media->description); ?>"
                                             style="height: 200px; object-fit: cover;">
                                    <?php elseif($media->id_type_media == 2): ?> <!-- Vidéo -->
                                        <div class="card-body text-center py-5">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center p-4">
                                                <i class="fas fa-play-circle text-primary fa-3x"></i>
                                            </div>
                                            <h6 class="mt-3 mb-1">Vidéo</h6>
                                            <small class="text-muted">Contenu multimédia</small>
                                        </div>
                                    <?php elseif($media->id_type_media == 3): ?> <!-- Audio -->
                                        <div class="card-body text-center py-5">
                                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center p-4">
                                                <i class="fas fa-music text-success fa-3x"></i>
                                            </div>
                                            <h6 class="mt-3 mb-1">Audio</h6>
                                            <small class="text-muted">Contenu sonore</small>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($media->description): ?>
                                        <div class="card-footer bg-transparent border-top">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                <?php echo e($media->description); ?>

                                            </small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar avec informations et actions -->
        <div class="col-lg-4">
            <!-- Carte Informations -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-info text-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-info-circle me-2"></i>Informations
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Auteur -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">
                            <i class="fas fa-user-edit me-1"></i>Auteur
                        </h6>
                        <?php if($contenu->auteur): ?>
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3"
                                 style="width: 50px; height: 50px;">
                                <?php if($contenu->auteur->photo): ?>
<?php if($contenu->auteur->has_cloudinary && $contenu->auteur->cloudinary_url): ?>
    <img src="<?php echo e($contenu->auteur->cloudinary_url); ?>"
<?php elseif($contenu->auteur->photo): ?>
    <?php if($contenu->auteur->has_cloudinary && $contenu->auteur->cloudinary_url): ?>
    <img src="<?php echo e($contenu->auteur->cloudinary_url); ?>"
<?php elseif($contenu->auteur->photo): ?>
    <?php if($contenu->auteur->has_cloudinary && $contenu->auteur->cloudinary_url): ?>
    <img src="<?php echo e($contenu->auteur->cloudinary_url); ?>"
<?php elseif($contenu->auteur->photo): ?>
<?php if($contenu->auteur->has_cloudinary && $contenu->auteur->cloudinary_url): ?>
<?php elseif($contenu->auteur->photo): ?>
    <img src="<?php echo e(asset('storage/' . $contenu->
<?php else: ?>
    <div class="avatar-default">{{ substr($contenu->auteur->name, 0, 1)); ?></div>
<?php endif; ?>
<?php else: ?>
    <div class="avatar-default"><?php echo e(substr($contenu->auteur->name, 0, 1)); ?></div>
<?php endif; ?><?php echo e(substr($contenu->auteur->name, 0, 1)); ?></div>
<?php endif; ?>
<?php else: ?>
    <div class="avatar-default"><?php echo e(substr($contenu->auteur->name, 0, 1)); ?></div>
<?php endif; ?>
                                         class="rounded-circle"
                                         style="width: 46px; height: 46px; object-fit: cover;"
                                         alt="<?php echo e($contenu->auteur->name); ?>">
                                <?php else: ?>
                                    <span class="text-primary fw-bold fs-5">
                                        <?php echo e(strtoupper(substr($contenu->auteur->prenom ?? $contenu->auteur->name, 0, 1))); ?>

                                    </span>
                                <?php endif; ?>
                            </div>
                            <div>
                                <strong class="d-block"><?php echo e($contenu->auteur->prenom); ?> <?php echo e($contenu->auteur->name); ?></strong>
                                <small class="text-muted"><?php echo e($contenu->auteur->email); ?></small>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="text-center py-2">
                            <i class="fas fa-user-slash text-danger fa-2x mb-2"></i>
                            <p class="text-danger mb-0">Auteur supprimé</p>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Métadonnées -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">
                            <i class="fas fa-tags me-1"></i>Métadonnées
                        </h6>
                        <div class="d-flex flex-wrap gap-2">
                            <?php if($contenu->region): ?>
                            <span class="badge bg-info bg-opacity-10 text-info border border-info">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                <?php echo e($contenu->region->nom_region); ?>

                            </span>
                            <?php endif; ?>

                            <?php if($contenu->typeContenu): ?>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary">
                                <i class="fas fa-tag me-1"></i>
                                <?php echo e($contenu->typeContenu->nom_contenu); ?>

                            </span>
                            <?php endif; ?>

                            <?php if($contenu->langue): ?>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary">
                                <i class="fas fa-language me-1"></i>
                                <?php echo e($contenu->langue->nom_langue); ?>

                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Dates -->
                    <div>
                        <h6 class="text-muted mb-2">
                            <i class="fas fa-calendar-alt me-1"></i>Dates
                        </h6>
                        <div class="timeline">
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <small class="text-muted d-block">Création</small>
                                    <strong><?php echo e($contenu->date_creation->format('d/m/Y à H:i')); ?></strong>
                                </div>
                            </div>

                            <?php if($contenu->date_validation): ?>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <small class="text-muted d-block">Validation</small>
                                    <strong><?php echo e($contenu->date_validation->format('d/m/Y à H:i')); ?></strong>
                                    <?php if($contenu->moderateur): ?>
                                    <small class="text-muted d-block">
                                        Par: <?php echo e($contenu->moderateur->prenom); ?> <?php echo e($contenu->moderateur->name); ?>

                                    </small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte Actions -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-success text-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-cogs me-2"></i>Actions de modération
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <!-- Bouton Retour -->
                        <a href="<?php echo e(route('admin.moderateur.index')); ?>"
                           class="btn btn-outline-secondary btn-lg d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left me-3 fs-5"></i>
                            <span class="flex-grow-1 text-start">Retour à la liste</span>
                        </a>

                        <?php if($contenu->statut === 'en_attente'): ?>
                        <!-- Bouton Valider -->
                        <form action="<?php echo e(route('admin.moderateur.valider', $contenu->id_contenu)); ?>"
                              method="POST"
                              class="d-grid">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('POST'); ?>
                            <button type="submit"
                                    class="btn btn-success btn-lg d-flex align-items-center justify-content-center"
                                    onclick="return confirm('Confirmer la validation de ce contenu ? Il sera publié publiquement.')">
                                <i class="fas fa-check-circle me-3 fs-5"></i>
                                <span class="flex-grow-1 text-start">Valider le contenu</span>
                            </button>
                        </form>

                        <!-- Bouton Rejeter -->
                        <form action="<?php echo e(route('admin.moderateur.rejeter', $contenu->id_contenu)); ?>"
                              method="POST"
                              class="d-grid">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('POST'); ?>
                            <button type="submit"
                                    class="btn btn-danger btn-lg d-flex align-items-center justify-content-center"
                                    onclick="return confirm('Confirmer le rejet de ce contenu ?')">
                                <i class="fas fa-times-circle me-3 fs-5"></i>
                                <span class="flex-grow-1 text-start">Rejeter le contenu</span>
                            </button>
                        </form>

                        <!-- Boutons rapides (icônes seulement) -->
                        <div class="text-center mt-3 pt-3 border-top">
                            <h6 class="text-muted mb-3">Actions rapides</h6>
                            <div class="d-flex justify-content-center gap-3">
                                <!-- Valider (icône) -->
                                <form action="<?php echo e(route('admin.moderateur.valider', $contenu->id_contenu)); ?>"
                                      method="POST"
                                      class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('POST'); ?>
                                    <button type="submit"
                                            class="btn btn-outline-success btn-lg rounded-circle"
                                            title="Valider rapidement"
                                            onclick="return confirm('Valider ce contenu ?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>

                                <!-- Rejeter (icône) -->
                                <form action="<?php echo e(route('admin.moderateur.rejeter', $contenu->id_contenu)); ?>"
                                      method="POST"
                                      class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('POST'); ?>
                                    <button type="submit"
                                            class="btn btn-outline-danger btn-lg rounded-circle"
                                            title="Rejeter rapidement"
                                            onclick="return confirm('Rejeter ce contenu ?')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>

                                <!-- Voir dans l'admin (si route existe) -->
                                <?php if(route('admin.contenus.show', false)): ?>
                                <a href="<?php echo e(route('admin.contenus.show', $contenu->id_contenu)); ?>"
                                   class="btn btn-outline-primary btn-lg rounded-circle"
                                   title="Voir dans l'administration">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="alert alert-<?php echo e($contenu->statut === 'validé' ? 'success' : 'danger'); ?> text-center">
                            <i class="fas fa-<?php echo e($contenu->statut === 'validé' ? 'check-circle' : 'ban'); ?> fa-2x mb-3"></i>
                            <h5 class="mb-2">
                                Ce contenu a été <?php echo e($contenu->statut === 'validé' ? 'validé' : 'rejeté'); ?>

                            </h5>
                            <p class="mb-0">
                                <?php if($contenu->date_validation): ?>
                                    Le <?php echo e($contenu->date_validation->format('d/m/Y à H:i')); ?>

                                <?php endif; ?>
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .bg-gradient-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .bg-gradient-success {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .content-text {
        line-height: 1.8;
        font-size: 1.05rem;
    }
    .content-text p {
        margin-bottom: 1rem;
    }
    .content-text img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1rem 0;
    }

    .timeline {
        position: relative;
        padding-left: 30px;
    }
    .timeline:before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }
    .timeline-marker {
        position: absolute;
        left: -30px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 0 0 3px #e9ecef;
    }
    .timeline-content {
        padding-left: 10px;
    }

    .btn-lg.rounded-circle {
        width: 60px;
        height: 60px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .badge {
        padding: 0.5em 1em;
        font-weight: 500;
    }

    .card {
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: none;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirmation améliorée pour les actions
        const confirmActions = (form, message) => {
            if (confirm(message)) {
                form.submit();
            }
        };

        // Gestion des boutons d'action rapide
        const quickActions = document.querySelectorAll('.btn-outline-success, .btn-outline-danger');
        quickActions.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                const isValidate = this.classList.contains('btn-outline-success');
                const message = isValidate
                    ? 'Confirmer la validation de ce contenu ?'
                    : 'Confirmer le rejet de ce contenu ?';

                if (confirm(message)) {
                    form.submit();
                }
            });
        });

        // Ajout d'effets visuels
        const actionButtons = document.querySelectorAll('.btn');
        actionButtons.forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'all 0.2s ease';
            });
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\moderateur\details.blade.php ENDPATH**/ ?>