<?php $__env->startSection('content'); ?>
<main class="app-main">
    <div class="container-fluid">
        <h3>Ajouter une région</h3>
        <form action="<?php echo e(route('admin.regions.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="nom_region" class="form-label">Nom de la région</label>
                <input type="text" name="nom_region" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="population" class="form-label">Population</label>
                <input type="number" name="population" class="form-control">
            </div>
            <div class="mb-3">
                <label for="superficie" class="form-label">Superficie</label>
                <input type="text" name="superficie" class="form-control">
            </div>
            <div class="mb-3">
                <label for="localisation" class="form-label">Localisation</label>
                <input type="text" name="localisation" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </form>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\regions\create.blade.php ENDPATH**/ ?>