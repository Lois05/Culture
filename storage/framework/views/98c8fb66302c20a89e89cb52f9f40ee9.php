<?php $__env->startSection('title', 'Contenus aimés - Bénin Culture'); ?>
<?php $__env->startSection('page-title', 'Contenus aimés'); ?>
<?php $__env->startSection('page-subtitle', 'Vos contenus favoris'); ?>

<?php $__env->startSection('content'); ?>
<div class="fade-in">
    <?php if($likedContents && count($likedContents) > 0): ?>
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-heart-fill text-danger me-2"></i>
                    <?php echo e(count($likedContents)); ?> contenus aimés
                </h3>
                <div class="badge bg-primary-custom"><?php echo e($stats['total_likes_given'] ?? 0); ?> likes</div>
            </div>

            <div class="row">
                <?php $__currentLoopData = $likedContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-secondary"><?php echo e($content->typeContenu->nom_contenu ?? 'Non défini'); ?></span>
                                <small class="text-muted"><?php echo e($content->liked_at->format('d/m/Y')); ?></small>
                            </div>

                            <h5 class="card-title"><?php echo e($content->titre); ?></h5>

                            <p class="card-text text-muted small">
                                <?php echo e(Str::limit(strip_tags($content->texte ?? ''), 100)); ?>

                            </p>

                            <div class="mt-3">
                                <div class="d-flex justify-content-between text-muted small mb-2">
                                    <span><i class="bi bi-eye me-1"></i> <?php echo e(number_format($content->vues_count ?? 0, 0, ',', ' ')); ?></span>
                                    <span><i class="bi bi-heart-fill text-danger me-1"></i> <?php echo e(number_format($content->likes_count ?? 0, 0, ',', ' ')); ?></span>
                                    <span><i class="bi bi-chat-left me-1"></i> <?php echo e(number_format($content->commentaires_count ?? 0, 0, ',', ' ')); ?></span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i> Voir
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger unlike-btn">
                                    <i class="bi bi-heartbreak me-1"></i> Retirer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Statistiques -->
            <div class="card-footer bg-light">
                <div class="row text-center">
                    <div class="col-md-4 mb-2">
                        <div class="text-muted small">Catégorie préférée</div>
                        <div class="h6 fw-bold"><?php echo e($stats['most_liked_category'] ?? 'Aucune'); ?></div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="text-muted small">Moyenne de likes</div>
                        <div class="h6 fw-bold">
                            <?php
                                $avgLikes = count($likedContents) > 0
                                    ? number_format($likedContents->avg('likes_count') ?? 0, 0, ',', ' ')
                                    : 0;
                            ?>
                            <?php echo e($avgLikes); ?>

                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="text-muted small">Dernier like</div>
                        <div class="h6 fw-bold">
                            <?php if(count($likedContents) > 0): ?>
                                <?php echo e($likedContents->sortByDesc('liked_at')->first()->liked_at->diffForHumans()); ?>

                            <?php else: ?>
                                Jamais
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- État vide -->
        <div class="dashboard-card">
            <div class="empty-state text-center py-5">
                <i class="bi bi-heart display-1 text-muted mb-3"></i>
                <h4 class="mb-3">Aucun contenu aimé</h4>
                <p class="text-muted mb-4">Vous n'avez pas encore aimé de contenu.</p>
                <a href="<?php echo e(route('front.explorer')); ?>" class="btn btn-primary-custom me-2">
                    <i class="bi bi-compass me-2"></i>Explorer les contenus
                </a>
                <a href="<?php echo e(route('dashboard.contributions')); ?>" class="btn btn-outline-primary">
                    <i class="bi bi-journal-text me-2"></i>Voir mes contributions
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .hover-lift {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>

<script>
    // Simuler le retrait d'un like
    document.addEventListener('DOMContentLoaded', function() {
        const unlikeButtons = document.querySelectorAll('.unlike-btn');

        unlikeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.col-md-6');
                if (confirm('Voulez-vous vraiment retirer ce like ?')) {
                    // Animation de suppression
                    card.style.opacity = '0.5';
                    card.style.transform = 'scale(0.95)';

                    setTimeout(() => {
                        card.remove();

                        // Mettre à jour le compteur dans le header
                        const likeCountElement = document.querySelector('.card-title');
                        if (likeCountElement) {
                            const text = likeCountElement.textContent;
                            const currentCount = parseInt(text.match(/\d+/)[0]);
                            likeCountElement.innerHTML = `<i class="bi bi-heart-fill text-danger me-2"></i> ${currentCount - 1} contenus aimés`;
                        }

                        // Mettre à jour le badge
                        const badgeElement = document.querySelector('.badge.bg-primary-custom');
                        if (badgeElement) {
                            const badgeText = badgeElement.textContent;
                            const badgeCount = parseInt(badgeText.match(/\d+/)[0]);
                            badgeElement.textContent = `${badgeCount - 1} likes`;
                        }

                        // Si plus de contenus, afficher l'état vide
                        const remainingCards = document.querySelectorAll('.col-md-6').length;
                        if (remainingCards === 0) {
                            location.reload(); // Recharger pour afficher l'état vide
                        }
                    }, 300);
                }
            });
        });

        // Simuler l'ajout d'un like (pour démo)
        const seeButtons = document.querySelectorAll('.btn-outline-primary');
        seeButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Cette fonctionnalité sera disponible bientôt !');
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\front\dashboard\likes.blade.php ENDPATH**/ ?>