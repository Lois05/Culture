<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Créer un nouveau contenu</h1>

    <form action="<?php echo e(route('admin.contenus.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <!-- Titre -->
        <div class="mb-3">
            <label>Titre *</label>
            <input type="text" name="titre" class="form-control" value="<?php echo e(old('titre')); ?>" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label>Description (optionnel)</label>
            <textarea name="description" class="form-control" rows="3"><?php echo e(old('description')); ?></textarea>
        </div>

        <!-- Contenu -->
        <div class="mb-3">
            <label>Contenu *</label>
            <textarea name="texte" class="form-control" rows="10" required><?php echo e(old('texte')); ?></textarea>
        </div>

        <!-- Métadonnées -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label>Type de contenu *</label>
                <select name="id_type_contenu" class="form-control" required>
                    <option value="">Sélectionnez...</option>
                    <?php $__currentLoopData = $typesContenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type->id_type_contenu); ?>" <?php echo e(old('id_type_contenu') == $type->id_type_contenu ? 'selected' : ''); ?>>
                            <?php echo e($type->nom_contenu); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-4">
                <label>Région *</label>
                <select name="id_region" class="form-control" required>
                    <option value="">Sélectionnez...</option>
                    <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($region->id_region); ?>" <?php echo e(old('id_region') == $region->id_region ? 'selected' : ''); ?>>
                            <?php echo e($region->nom_region); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-4">
                <label>Langue *</label>
                <select name="id_langue" class="form-control" required>
                    <option value="">Sélectionnez...</option>
                    <?php $__currentLoopData = $langues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($langue->id_langue); ?>" <?php echo e(old('id_langue') == $langue->id_langue ? 'selected' : ''); ?>>
                            <?php echo e($langue->nom_langue); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <!-- Média (obligatoire pour la création) -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Média *</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Fichier média *</label>
                    <input type="file" name="media_file" class="form-control" required>
                    <small class="text-muted">Images (JPG, PNG, GIF, WEBP), Vidéos (MP4, AVI, MOV), Audio (MP3, WAV, OGG) - Max 100MB</small>
                </div>

                <div class="mb-3">
                    <label>Description du média (optionnel)</label>
                    <textarea name="media_description" class="form-control" rows="2"><?php echo e(old('media_description')); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Boutons -->
        <div class="d-flex justify-content-between">
            <a href="<?php echo e(route('admin.contenus.index')); ?>" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Créer le contenu</button>
        </div>
    </form>
</div>

<script>
// Désactiver la validation HTML5
document.querySelector('form').setAttribute('novalidate', 'novalidate');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\contenus\create.blade.php ENDPATH**/ ?>