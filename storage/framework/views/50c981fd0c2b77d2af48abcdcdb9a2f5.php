<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Modifier le Contenu</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.contenus.update', $contenu->id_contenu)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Titre -->
        <div class="mb-3">
            <label>Titre *</label>
            <input type="text" name="titre" class="form-control" value="<?php echo e(old('titre', $contenu->titre)); ?>" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"><?php echo e(old('description', $contenu->description)); ?></textarea>
        </div>

        <!-- Contenu -->
        <div class="mb-3">
            <label>Contenu *</label>
            <textarea name="texte" class="form-control" rows="10" required><?php echo e(old('texte', $contenu->texte)); ?></textarea>
        </div>

        <!-- Métadonnées -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label>Type de contenu *</label>
                <select name="id_type_contenu" class="form-control" required>
                    <?php $__currentLoopData = $typesContenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type->id_type_contenu); ?>" <?php echo e($contenu->id_type_contenu == $type->id_type_contenu ? 'selected' : ''); ?>>
                            <?php echo e($type->nom_contenu); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-4">
                <label>Région *</label>
                <select name="id_region" class="form-control" required>
                    <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($region->id_region); ?>" <?php echo e($contenu->id_region == $region->id_region ? 'selected' : ''); ?>>
                            <?php echo e($region->nom_region); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-4">
                <label>Langue *</label>
                <select name="id_langue" class="form-control" required>
                    <?php $__currentLoopData = $langues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($langue->id_langue); ?>" <?php echo e($contenu->id_langue == $langue->id_langue ? 'selected' : ''); ?>>
                            <?php echo e($langue->nom_langue); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <!-- Média actuel -->
        <?php if($contenu->medias->count() > 0): ?>
            <?php $media = $contenu->medias->first(); ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Média actuel</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?php if($media->id_type_media == 1): ?> 
                                <img src="<?php echo e(asset('adminlte/img/' . $media->chemin)); ?>"
                                     class="img-fluid"
                                     alt="Image actuelle"
                                     style="max-height: 200px;">
                            <?php elseif($media->id_type_media == 2): ?> 
                                <div class="bg-dark text-white p-4 text-center">
                                    <i class="bi bi-play-circle fs-1"></i>
                                    <p class="mb-0">Vidéo</p>
                                </div>
                            <?php else: ?> 
                                <div class="bg-secondary text-white p-4 text-center">
                                    <i class="bi bi-music-note-beamed fs-1"></i>
                                    <p class="mb-0">Audio</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <p><strong>Fichier :</strong> <?php echo e($media->chemin); ?></p>
                            <p><strong>Description :</strong> <?php echo e($media->description); ?></p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remove_media" id="remove_media" value="1">
                                <label class="form-check-label text-danger" for="remove_media">
                                    Supprimer ce média
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Nouveau média -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Nouveau média (optionnel)</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Fichier média</label>
                    <input type="file" name="media_file" class="form-control">
                    <small class="text-muted">Images (JPG, PNG, GIF, WEBP), Vidéos (MP4, AVI, MOV), Audio (MP3, WAV, OGG) - Max 100MB</small>
                </div>

                <div class="mb-3">
                    <label>Description du média (optionnel)</label>
                    <textarea name="media_description" class="form-control" rows="2"><?php echo e(old('media_description', $contenu->medias->first()->description ?? '')); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Statut (admin/modo seulement) -->
        <?php if(auth()->user()->isAdmin() || auth()->user()->isModerator()): ?>
            <div class="mb-3">
                <label>Statut</label>
                <select name="statut" class="form-control">
                    <option value="en attente" <?php echo e($contenu->statut == 'en attente' ? 'selected' : ''); ?>>En attente</option>
                    <option value="validé" <?php echo e($contenu->statut == 'validé' ? 'selected' : ''); ?>>Validé</option>
                    <option value="rejeté" <?php echo e($contenu->statut == 'rejeté' ? 'selected' : ''); ?>>Rejeté</option>
                </select>
            </div>
        <?php endif; ?>

        <!-- Boutons -->
        <div class="d-flex justify-content-between">
            <a href="<?php echo e(route('admin.contenus.index')); ?>" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>

<script>
// Désactiver la validation HTML5 pour permettre les gros fichiers
document.querySelector('form').setAttribute('novalidate', 'novalidate');
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\contenus\edit.blade.php ENDPATH**/ ?>