<?php $__env->startSection('title', $categorie->nom_contenu . ' - Culture Bénin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-4 mb-3"><?php echo e($categorie->nom_contenu); ?></h1>
            <div class="d-flex gap-4 mb-4">
                <div class="stat">
                    <div class="stat-number"><?php echo e($stats['total_contents']); ?></div>
                    <div class="stat-label">Contenus</div>
                </div>
                <div class="stat">
                    <div class="stat-number"><?php echo e($stats['total_likes']); ?></div>
                    <div class="stat-label">Likes</div>
                </div>
                <div class="stat">
                    <div class="stat-number"><?php echo e($stats['total_views']); ?></div>
                    <div class="stat-label">Vues</div>
                </div>
            </div>
        </div>
    </div>

    <?php if($contents->count() > 0): ?>
        <div class="row">
            <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?php echo e($content->medias->first()->chemin ?? '/adminlte/img/collage.png'); ?>"
                         class="card-img-top"
                         alt="<?php echo e($content->titre); ?>"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($content->titre); ?></h5>
                        <p class="card-text text-muted">
                            <?php echo e(Str::limit(strip_tags($content->texte), 100)); ?>

                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo e(route('front.content.show', $content->id_contenu)); ?>" class="btn btn-primary btn-sm">
                            Voir plus
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4">
            <?php echo e($contents->links()); ?>

        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <h3>Aucun contenu dans cette catégorie</h3>
        </div>
    <?php endif; ?>
</div>

<style>
.stat {
    text-align: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    min-width: 120px;
}
.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: #008751;
}
.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
}
</style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\front\categorie.blade.php ENDPATH**/ ?>