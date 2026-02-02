<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-3">
                <!-- Header -->
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-translate"></i> Détails de la langue
                    </h4>
                    <a href="<?php echo e(route('langues.index')); ?>" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-flag-fill display-1 text-primary"></i>
                        <h3 class="fw-bold mt-2"><?php echo e($langue->nom_langue); ?></h3>
                        <span class="badge bg-info text-dark fs-6 px-3 py-2">
                            <?php echo e(strtoupper($langue->code_langue)); ?>

                        </span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-card shadow-sm p-3 rounded bg-light">
                                <h6 class="text-muted"><i class="bi bi-hash"></i> ID</h6>
                                <p class="fw-bold"><?php echo e($langue->id_langue); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card shadow-sm p-3 rounded bg-light">
                                <h6 class="text-muted"><i class="bi bi-translate"></i> Nom</h6>
                                <p class="fw-bold"><?php echo e($langue->nom_langue); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card shadow-sm p-3 rounded bg-light">
                                <h6 class="text-muted"><i class="bi bi-code-slash"></i> Code</h6>
                                <p class="fw-bold"><?php echo e(strtoupper($langue->code_langue)); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card shadow-sm p-3 rounded bg-light">
                                <h6 class="text-muted"><i class="bi bi-calendar-check"></i> Date de création</h6>
                                <p class="fw-bold"><?php echo e($langue->created_at->format('d/m/Y H:i')); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card shadow-sm p-3 rounded bg-light">
                                <h6 class="text-muted"><i class="bi bi-calendar-event"></i> Dernière mise à jour</h6>
                                <p class="fw-bold"><?php echo e($langue->updated_at->format('d/m/Y H:i')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer text-end">
                    <a href="<?php echo e(route('langues.edit', $langue->id_langue)); ?>" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Modifier
                    </a>
                    <form action="<?php echo e(route('langues.destroy', $langue->id_langue)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Voulez-vous supprimer cette langue ?')">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
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
    .info-card {
        transition: all 0.3s ease;
    }
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\langues\show.blade.php ENDPATH**/ ?>