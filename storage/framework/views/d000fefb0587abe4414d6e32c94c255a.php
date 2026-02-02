<?php $__env->startSection('page-title', 'Détail du Contenu'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-3">
                <!-- Header -->
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="bi bi-journal-text me-2"></i> Détail du Contenu
                        </h4>
                        <div>
                            <a href="<?php echo e(route('admin.contenus.index')); ?>" class="btn btn-light btn-sm me-2">
                                <i class="bi bi-arrow-left me-1"></i> Retour
                            </a>
                            <?php
                                $user = Auth::user();
                                $userRole = optional($user->role)->nom_role;
                                $canEdit = $contenu->id_auteur == $user->id ||
                                          in_array($userRole, ['Administrateur', 'Modérateur']);
                                $canDelete = $contenu->id_auteur == $user->id ||
                                            $userRole === 'Administrateur';
                            ?>

                            <?php if($canEdit): ?>
                                <a href="<?php echo e(route('admin.contenus.edit', $contenu->id_contenu)); ?>"
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil me-1"></i> Modifier
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Messages d'alert -->
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle"></i> <?php echo e(session('error')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <!-- Colonne gauche : Média et informations principales -->
                        <div class="col-lg-4 mb-4">
                            <!-- Carte Média -->
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="bi bi-file-earmark-image me-2"></i> Média
                                    </h5>
                                </div>
                                <div class="card-body text-center">
                                    <?php if($contenu->medias && $contenu->medias->count() > 0): ?>
                                        <?php
                                            $media = $contenu->medias->first();
                                            $mediaType = $media->id_type_media ?? 1;
                                            $isImage = $mediaType == 1;
                                            $isVideo = $mediaType == 2;
                                            $isAudio = $mediaType == 3;

                                            // UTILISER ImageHelper POUR L'URL
                                            $fileUrl = \App\Helpers\ImageHelper::content($media->chemin);
                                            $isExternalUrl = str_starts_with($media->chemin, 'http');
                                        ?>

                                        <?php if($isImage): ?>
                                            <div class="mb-3">
                                                <img src="<?php echo e($fileUrl); ?>"
                                                     class="img-fluid rounded border"
                                                     style="max-height: 300px; object-fit: contain;"
                                                     alt="<?php echo e($contenu->titre); ?>"
                                                     onerror="this.onerror=null; this.src='<?php echo e(\App\Helpers\ImageHelper::defaultContent()); ?>'">
                                            </div>
                                            <div class="d-flex justify-content-center mb-2">
                                                <a href="<?php echo e($fileUrl); ?>"
                                                   target="_blank"
                                                   class="btn btn-sm btn-outline-primary me-2">
                                                    <i class="bi bi-arrows-fullscreen me-1"></i> Agrandir
                                                </a>
                                                <a href="<?php echo e(route('admin.medias.show', $media->id_media)); ?>"
                                                   class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-info-circle me-1"></i> Détails média
                                                </a>
                                            </div>
                                        <?php elseif($isVideo): ?>
                                            <div class="bg-dark rounded p-4 mb-3">
                                                <i class="bi bi-play-circle text-white fs-1 mb-2"></i>
                                                <p class="text-white mb-0">Fichier vidéo</p>
                                            </div>
                                            <a href="<?php echo e($fileUrl); ?>"
                                               target="_blank"
                                               class="btn btn-primary">
                                                <i class="bi bi-play-fill me-1"></i> Lire la vidéo
                                            </a>
                                        <?php elseif($isAudio): ?>
                                            <div class="bg-secondary rounded p-4 mb-3">
                                                <i class="bi bi-music-note-beamed text-white fs-1 mb-2"></i>
                                                <p class="text-white mb-0">Fichier audio</p>
                                            </div>
                                            <audio controls class="w-100">
                                                <source src="<?php echo e($fileUrl); ?>" type="audio/mpeg">
                                                Votre navigateur ne supporte pas l'élément audio.
                                            </audio>
                                        <?php endif; ?>

                                        <div class="mt-3">
                                            <h6 class="mb-2">Informations du média</h6>
                                            <table class="table table-sm">
                                                <tr>
                                                    <td><strong>Type :</strong></td>
                                                    <td>
                                                        <span class="badge
                                                            <?php if($isImage): ?> bg-success
                                                            <?php elseif($isVideo): ?> bg-danger
                                                            <?php else: ?> bg-warning text-dark
                                                            <?php endif; ?>">
                                                            <?php if($isImage): ?> Image
                                                            <?php elseif($isVideo): ?> Vidéo
                                                            <?php else: ?> Audio
                                                            <?php endif; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Source :</strong></td>
                                                    <td>
                                                        <?php if($isExternalUrl): ?>
                                                            <span class="badge bg-info">Externe</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-success">Local</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Chemin :</strong></td>
                                                    <td>
                                                        <small><code><?php echo e(Str::limit($media->chemin, 40)); ?></code></small>
                                                    </td>
                                                </tr>
                                                <?php if($media->description): ?>
                                                <tr>
                                                    <td><strong>Description :</strong></td>
                                                    <td><?php echo e($media->description); ?></td>
                                                </tr>
                                                <?php endif; ?>
                                            </table>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-center py-4">
                                            <i class="bi bi-image text-muted fs-1 mb-3"></i>
                                            <p class="text-muted">Aucun média associé</p>
                                            <a href="<?php echo e(route('admin.medias.create')); ?>?contenu_id=<?php echo e($contenu->id_contenu); ?>"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-plus-circle me-1"></i> Ajouter un média
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Informations générales -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="bi bi-info-circle me-2"></i> Informations générales
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <td><strong>ID :</strong></td>
                                            <td><span class="badge bg-secondary">#<?php echo e($contenu->id_contenu); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Statut :</strong></td>
                                            <td>
                                                <?php switch($contenu->statut):
                                                    case ('validé'): ?>
                                                        <span class="badge bg-success">Validé</span>
                                                        <?php break; ?>
                                                    <?php case ('en attente'): ?>
                                                        <span class="badge bg-warning text-dark">En attente</span>
                                                        <?php break; ?>
                                                    <?php case ('rejeté'): ?>
                                                        <span class="badge bg-danger">Rejeté</span>
                                                        <?php break; ?>
                                                    <?php default: ?>
                                                        <span class="badge bg-secondary"><?php echo e($contenu->statut); ?></span>
                                                <?php endswitch; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Date création :</strong></td>
                                            <td><?php echo e($contenu->date_creation ? \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y H:i') : 'N/A'); ?></td>
                                        </tr>
                                        <?php if($contenu->date_modification): ?>
                                        <tr>
                                            <td><strong>Dernière modif :</strong></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($contenu->date_modification)->format('d/m/Y H:i')); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Colonne droite : Détails du contenu -->
                        <div class="col-lg-8">
                            <!-- Titre et badges -->
                            <div class="mb-4">
                                <h1 class="h2 mb-3"><?php echo e($contenu->titre); ?></h1>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-dark">
                                        <i class="bi bi-tag me-1"></i>
                                        <?php echo e($contenu->typeContenu->nom_contenu ?? 'Non défini'); ?>

                                    </span>
                                    <span class="badge bg-info">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        <?php echo e($contenu->region->nom_region ?? 'Non défini'); ?>

                                    </span>
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-translate me-1"></i>
                                        <?php echo e($contenu->langue->nom_langue ?? 'Non défini'); ?>

                                    </span>
                                </div>

                                <?php if($contenu->description): ?>
                                <div class="alert alert-light border">
                                    <h6 class="mb-2">Description courte :</h6>
                                    <p class="mb-0"><?php echo e($contenu->description); ?></p>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Contenu principal -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="bi bi-text-paragraph me-2"></i> Contenu
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="content-text">
                                        <?php echo nl2br(e($contenu->texte)); ?>

                                    </div>
                                </div>
                            </div>

                            <!-- Informations auteur -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="bi bi-person-circle me-2"></i> Auteur
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $authorInfo = \App\Helpers\ImageHelper::getUserAvatarInfo($contenu->auteur);
                                    ?>
                                    <div class="d-flex align-items-center">
                                        <?php if($authorInfo['has_photo']): ?>
                                            <img src="<?php echo e($authorInfo['photo_url']); ?>"
                                                 class="rounded-circle me-3"
                                                 style="width: 50px; height: 50px; object-fit: cover;"
                                                 alt="<?php echo e($authorInfo['name']); ?>"
                                                 onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                 style="width: 50px; height: 50px; font-size: 1.2rem; display: none;">
                                                <?php echo e($authorInfo['initials']); ?>

                                            </div>
                                        <?php else: ?>
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                 style="width: 50px; height: 50px; font-size: 1.2rem;">
                                                <?php echo e($authorInfo['initials']); ?>

                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <h5 class="mb-1"><?php echo e($authorInfo['name']); ?></h5>
                                            <p class="text-muted mb-0">
                                                <i class="bi bi-envelope me-1"></i> <?php echo e($contenu->auteur->email ?? 'N/A'); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions modération (pour admins/mods) -->
                            <?php if(in_array($userRole, ['Administrateur', 'Modérateur'])): ?>
                                <div class="card border-0 shadow-sm mt-4">
                                    <div class="card-header bg-warning text-dark">
                                        <h5 class="mb-0">
                                            <i class="bi bi-shield-check me-2"></i> Actions de modération
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php if($contenu->statut != 'validé'): ?>
                                            <div class="col-md-6 mb-2">
                                                <form action="<?php echo e(route('admin.contenus.valider', $contenu->id_contenu)); ?>"
                                                      method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-success w-100">
                                                        <i class="bi bi-check-circle me-1"></i> Valider ce contenu
                                                    </button>
                                                </form>
                                            </div>
                                            <?php endif; ?>

                                            <?php if($contenu->statut != 'rejeté'): ?>
                                            <div class="col-md-6 mb-2">
                                                <form action="<?php echo e(route('admin.contenus.rejeter', $contenu->id_contenu)); ?>"
                                                      method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-danger w-100">
                                                        <i class="bi bi-x-circle me-1"></i> Rejeter ce contenu
                                                    </button>
                                                </form>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Footer avec boutons d'action -->
                <div class="card-footer bg-light border-top py-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="<?php echo e(route('admin.contenus.index')); ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                            </a>
                        </div>
                        <div class="btn-group">
                            <?php if($canDelete): ?>
                                <button type="button"
                                        class="btn btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                    <i class="bi bi-trash me-1"></i> Supprimer
                                </button>
                            <?php endif; ?>

                            <?php if($canEdit): ?>
                                <a href="<?php echo e(route('admin.contenus.edit', $contenu->id_contenu)); ?>"
                                   class="btn btn-primary">
                                    <i class="bi bi-pencil me-1"></i> Modifier
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<?php if($canDelete): ?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i> Supprimer le contenu
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce contenu ?</p>
                <p><strong><?php echo e($contenu->titre); ?></strong></p>

                <?php if($contenu->medias->count() > 0): ?>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        <strong>Attention :</strong>
                        <?php echo e($contenu->medias->count()); ?> média(s) associé(s) seront également supprimé(s).
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="<?php echo e(route('admin.contenus.destroy', $contenu->id_contenu)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
.content-text {
    line-height: 1.6;
    font-size: 1.1rem;
}
.content-text p {
    margin-bottom: 1rem;
}
.table-sm td {
    padding: 0.5rem;
    vertical-align: middle;
}
.badge {
    font-size: 0.9em;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\contenus\show.blade.php ENDPATH**/ ?>