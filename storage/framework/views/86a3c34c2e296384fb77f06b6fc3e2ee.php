<?php $__env->startSection('title', 'Toutes les catégories'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h1 class="mb-4">Toutes les catégories</h1>
    <p class="lead mb-5">Découvrez notre région à travers différentes thématiques</p>

    <div class="row">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas <?php echo e($categorie->icone); ?> fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title"><?php echo e($categorie->nom); ?></h5>
                        <p class="card-text text-muted small"><?php echo e($categorie->description); ?></p>
                        <a href="<?php echo e(route('categorie.show', $categorie->id)); ?>" class="btn btn-primary btn-sm mt-2">
                            Explorer <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\front\categorie\index.blade.php ENDPATH**/ ?>