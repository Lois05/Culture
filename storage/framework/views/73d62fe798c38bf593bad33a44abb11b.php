<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Modifier le rôle</h4>
                    <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('roles.update', $role->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label for="nom_role" class="form-label fw-bold"><i class="bi bi-person-badge"></i> Nom du rôle</label>
                            <input type="text" name="nom_role" id="nom_role"
                                   value="<?php echo e(old('nom_role', $role->nom_role)); ?>"
                                   class="form-control shadow-sm" required>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-gradient shadow">
                                <i class="bi bi-check-circle"></i> Mettre à jour
                            </button>
                            <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-secondary shadow">
                                <i class="bi bi-x-circle"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\roles\edit.blade.php ENDPATH**/ ?>