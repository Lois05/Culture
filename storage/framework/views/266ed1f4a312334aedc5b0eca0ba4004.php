<?php $__env->startSection('content'); ?>
<main class="app-main">
    <div class="container-fluid mt-3">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-chat-left-text"></i> Commentaire de <?php echo e($commentaire->utilisateur->nom ?? '-'); ?></h4>
                <a href="<?php echo e(route('commentaires.index')); ?>" class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i> Retour</a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Utilisateur :</strong> <?php echo e($commentaire->utilisateur->nom ?? '-'); ?> <?php echo e($commentaire->utilisateur->prenom ?? ''); ?>

                </div>
                <div class="mb-3">
                    <strong>Contenu :</strong> <?php echo e($commentaire->contenu->titre ?? '-'); ?>

                </div>
                <div class="mb-3">
                    <strong>Texte :</strong>
                    <p class="border p-3 rounded bg-light"><?php echo e($commentaire->texte); ?></p>
                </div>
                <div class="mb-3">
                    <strong>Note :</strong>
                    <span class="badge bg-success"><?php echo e($commentaire->note); ?>/5</span>
                </div>
                <div class="mb-3">
                    <strong>Date :</strong> <?php echo e(\Carbon\Carbon::parse($commentaire->date)->format('d/m/Y')); ?>

                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\commentaires\show.blade.php ENDPATH**/ ?>