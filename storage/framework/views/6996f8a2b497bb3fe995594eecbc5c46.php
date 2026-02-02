<?php $__env->startSection('content'); ?>
<main class="app-main">
    <div class="container-fluid mt-4">

        <!-- Header avec titre et bouton retour -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary"><i class="bi bi-globe-americas me-2"></i>Détails de la région</h3>
            <a href="<?php echo e(route('regions.index')); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Retour à la liste
            </a>
        </div>

        <!-- Carte principale de la région -->
        <div class="card shadow-sm border-primary">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><?php echo e($region->nom_region); ?></h4>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    <!-- Description -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded shadow-sm h-100 bg-light">
                            <h5 class="text-muted"><i class="bi bi-card-text me-2"></i>Description</h5>
                            <p class="mb-0"><?php echo e($region->description); ?></p>
                        </div>
                    </div>

                    <!-- Population -->
                    <div class="col-md-3">
                        <div class="p-3 border rounded shadow-sm h-100 text-center bg-white">
                            <h6 class="text-muted"><i class="bi bi-people-fill me-1"></i>Population</h6>
                            <span class="fs-4 fw-bold"><?php echo e(number_format($region->population, 0, ',', ' ')); ?></span>
                        </div>
                    </div>

                    <!-- Superficie -->
                    <div class="col-md-3">
                        <div class="p-3 border rounded shadow-sm h-100 text-center bg-white">
                            <h6 class="text-muted"><i class="bi bi-arrows-fullscreen me-1"></i>Superficie</h6>
                            <span class="fs-4 fw-bold"><?php echo e($region->superficie); ?> km²</span>
                        </div>
                    </div>

                    <!-- Localisation -->
                    <div class="col-12">
                        <div class="p-3 border rounded shadow-sm bg-light">
                            <h5 class="text-muted"><i class="bi bi-geo-alt-fill me-2"></i>Localisation</h5>
                            <p class="mb-0"><?php echo e($region->localisation); ?></p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="<?php echo e(route('regions.edit', $region)); ?>" class="btn btn-warning">
                    <i class="bi bi-pencil-square me-1"></i> Modifier
                </a>
                <a href="<?php echo e(route('regions.index')); ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle me-1"></i> Retour
                </a>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\regions\show.blade.php ENDPATH**/ ?>