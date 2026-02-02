<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-3">
                <!-- Header -->
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Modifier l'association
                    </h4>
                    <a href="<?php echo e(route('parler.index')); ?>" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <form action="<?php echo e(route('parler.update', $parler->id_parler)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3">
                            <label for="region_id" class="form-label fw-bold">
                                <i class="bi bi-geo-alt"></i> Région
                            </label>
                            <select name="region_id" id="region_id" class="form-select shadow-sm" required>
                                <option value="">-- Sélectionner une région --</option>
                                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($region->id_region); ?>"
                                        <?php echo e($parler->region_id == $region->id_region ? 'selected' : ''); ?>>
                                        <?php echo e($region->nom_region); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="langue_id" class="form-label fw-bold">
                                <i class="bi bi-translate"></i> Langue
                            </label>
                            <select name="langue_id" id="langue_id" class="form-select shadow-sm" required>
                                <option value="">-- Sélectionner une langue --</option>
                                <?php $__currentLoopData = $langues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($langue->id_langue); ?>"
                                        <?php echo e($parler->langue_id == $langue->id_langue ? 'selected' : ''); ?>>
                                        <?php echo e($langue->nom_langue); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Boutons -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-gradient shadow">
                                <i class="bi bi-check-circle"></i> Mettre à jour
                            </button>
                            <a href="<?php echo e(route('parler.index')); ?>" class="btn btn-secondary shadow">
                                <i class="bi bi-x-circle"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #0d6efd, #6610f2);
    }
    .form-select, .form-control {
        transition: all 0.3s ease;
    }
    .form-select:focus, .form-control:focus {
        border-color: #6610f2;
        box-shadow: 0 0 0 0.2rem rgba(102,16,242,.25);
    }
    .btn-gradient {
        background: linear-gradient(45deg, #0d6efd, #6610f2);
        color: #fff;
        border: none;
        transition: 0.3s;
    }
    .btn-gradient:hover { transform: scale(1.05); opacity: 0.9; }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\parler\edit.blade.php ENDPATH**/ ?>