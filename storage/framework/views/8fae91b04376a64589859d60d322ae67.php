<?php $__env->startSection('page-title', 'Modifier la Région'); ?> 

<?php $__env->startSection('content'); ?>
<main class="app-main">
    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-pencil-square"></i> Modifier la région
            </h3>
            <a href="<?php echo e(route('admin.regions.index')); ?>" class="btn btn-outline-secondary"> 
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                <form action="<?php echo e(route('admin.regions.update', $region)); ?>" method="POST"> 
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom_region" class="form-label fw-bold">Nom de la région</label>
                                <input type="text" name="nom_region" id="nom_region" class="form-control"
                                       value="<?php echo e(old('nom_region', $region->nom_region)); ?>" required>
                                <?php $__errorArgs = ['nom_region'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="population" class="form-label fw-bold">Population</label>
                                <input type="number" name="population" id="population" class="form-control"
                                       value="<?php echo e(old('population', $region->population)); ?>" required>
                                <?php $__errorArgs = ['population'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="superficie" class="form-label fw-bold">Superficie (km²)</label>
                                <input type="number" step="0.01" name="superficie" id="superficie" class="form-control"
                                       value="<?php echo e(old('superficie', $region->superficie)); ?>" required>
                                <?php $__errorArgs = ['superficie'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="localisation" class="form-label fw-bold">Localisation (Lat,Lng)</label>
                                <input type="text" name="localisation" id="localisation" class="form-control"
                                       value="<?php echo e(old('localisation', $region->localisation)); ?>"
                                       placeholder="Ex: 6.4969,2.6000" required>
                                <?php $__errorArgs = ['localisation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required><?php echo e(old('description', $region->description)); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Mettre à jour
                        </button>
                        <a href="<?php echo e(route('admin.regions.index')); ?>" class="btn btn-secondary"> 
                            <i class="bi bi-x-circle"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\regions\edit.blade.php ENDPATH**/ ?>