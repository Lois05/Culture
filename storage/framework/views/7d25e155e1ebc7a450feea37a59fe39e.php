<?php $__env->startSection('title', 'Tableau de bord'); ?>
<?php $__env->startSection('page-title', 'Tableau de bord'); ?>
<?php $__env->startSection('page-subtitle', 'Bienvenue dans votre espace personnel'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --primary-color: #E8112D;
        --accent-color: #FCD116;
        --success-color: #008751;
        --dark-color: #0A0F2D;
        --light-color: #F8F9FA;
        --primary-color-rgb: 232, 17, 45;
    }

    /* Correction des avatars */
    .avatar-container {
        position: relative;
        margin: 0 auto;
    }

    .avatar-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--primary-color);
        display: block;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    }

    .avatar-fallback {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        font-size: 2.5rem;
        font-weight: bold;
        border: 4px solid var(--primary-color);
        text-transform: uppercase;
    }

    /* Dashboard cards */
    .dashboard-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .dashboard-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--light-color);
    }

    .card-title {
        font-weight: 700;
        color: var(--dark-color);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-title i {
        color: var(--primary-color);
    }

    /* Stats cards */
    .stat-card {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        text-align: center;
        padding: 2rem 1rem;
        border-radius: 15px;
        height: 100%;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(var(--primary-color-rgb), 0.3);
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        font-family: 'Poppins', sans-serif;
    }

    .stat-label {
        font-size: 0.95rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state p {
        margin-bottom: 1rem;
    }

    /* Buttons */
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(var(--primary-color-rgb), 0.3);
        color: white;
    }

    .btn-outline-custom {
        background: transparent;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-outline-custom:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    /* Profile section */
    .profile-info-item {
        background: var(--light-color);
        border-radius: 15px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        border-left: 4px solid var(--primary-color);
    }

    .profile-info-item i {
        color: var(--primary-color);
        font-size: 1.25rem;
        width: 30px;
    }

    /* Animations */
    .fade-in {
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Quick actions */
    .quick-action-card {
        height: 100%;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .quick-action-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-5px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-card {
            padding: 1.5rem;
        }

        .stat-number {
            font-size: 2rem;
        }

        .avatar-image,
        .avatar-fallback {
            width: 100px;
            height: 100px;
            font-size: 2rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="row fade-in">
    <!-- Statistiques -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card stat-card">
            <div class="stat-icon">
                <i class="bi bi-journal-text"></i>
            </div>
            <div class="stat-number"><?php echo e($stats['total_contributions'] ?? 0); ?></div>
            <div class="stat-label">Contributions</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card stat-card">
            <div class="stat-icon">
                <i class="bi bi-heart-fill"></i>
            </div>
            <div class="stat-number"><?php echo e($stats['total_likes_received'] ?? 0); ?></div>
            <div class="stat-label">J'aime reçus</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card stat-card">
            <div class="stat-icon">
                <i class="bi bi-chat-dots"></i>
            </div>
            <div class="stat-number"><?php echo e($stats['total_comments_received'] ?? 0); ?></div>
            <div class="stat-label">Commentaires</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card stat-card">
            <div class="stat-icon">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-number"><?php echo e($stats['total_views'] ?? 0); ?></div>
            <div class="stat-label">Vues totales</div>
        </div>
    </div>
</div>

<div class="row fade-in">
    <!-- Dernières contributions -->
    <div class="col-lg-6 mb-4">
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-clock-history"></i>
                    Dernières contributions
                </h3>
                <a href="<?php echo e(route('dashboard.contributions')); ?>" class="btn btn-outline-custom btn-sm">
                    Voir tout
                </a>
            </div>

            <?php if($recent_contributions->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $recent_contributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(route('front.contenu', $contribution->id_contenu)); ?>"
                                       class="text-decoration-none">
                                        <?php echo e(Str::limit($contribution->titre, 30)); ?>

                                    </a>
                                </td>
                                <td>
                                    <span class="badge" style="background: var(--primary-color); color: white;">
                                        <?php echo e($contribution->typeContenu->nom_contenu ?? 'Général'); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php switch($contribution->statut):
                                        case ('validé'): ?>
                                            <span class="badge bg-success">Validé</span>
                                            <?php break; ?>
                                        <?php case ('en_attente'): ?>
                                            <span class="badge bg-warning text-dark">En attente</span>
                                            <?php break; ?>
                                        <?php case ('rejeté'): ?>
                                            <span class="badge bg-danger">Rejeté</span>
                                            <?php break; ?>
                                        <?php default: ?>
                                            <span class="badge bg-secondary"><?php echo e($contribution->statut); ?></span>
                                    <?php endswitch; ?>
                                </td>
                                <td><?php echo e($contribution->date_creation->format('d/m/Y')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-journal-x"></i>
                    <p>Aucune contribution pour le moment</p>
                    <a href="<?php echo e(route('dashboard.contribuer')); ?>" class="btn btn-primary-custom btn-sm mt-2">
                        <i class="bi bi-plus-circle me-2"></i>Créer une contribution
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Vos contenus populaires -->
    <div class="col-lg-6 mb-4">
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-star-fill"></i>
                    Vos contenus populaires
                </h3>
            </div>

            <?php if($popular_contents->count() > 0): ?>
                <div class="list-group list-group-flush">
                    <?php $__currentLoopData = $popular_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <!-- Avatar du contenu -->
                            <?php
                                $mediaUrl = null;
                                $hasMedia = false;
                                $initial = strtoupper(substr($content->titre, 0, 1));

                                if ($content->medias && $content->medias->count() > 0) {
                                    $media = $content->medias->first();

                                    // Priorité 1: Cloudinary
                                    if (!empty($media->chemin ? asset('adminlte/img/' . $media->chemin) : asset('adminlte/img/default.jpg'))) {
                                        $hasMedia = true;
                                        $mediaUrl = $media->chemin ? asset('adminlte/img/' . $media->chemin) : asset('adminlte/img/default.jpg');
                                    }
                                    // Priorité 2: URL complète
                                    elseif (!empty($media->chemin) && filter_var($media->chemin, FILTER_VALIDATE_URL)) {
                                        $hasMedia = true;
                                        $mediaUrl = $media->chemin;
                                    }
                                    // Priorité 3: Chemin local
                                    elseif (!empty($media->chemin)) {
                                        $hasMedia = true;
                                        $mediaUrl = asset('storage/' . $media->chemin);
                                    }
                                }
                            ?>

                            <div class="avatar-container me-3">
                                <?php if($hasMedia && $mediaUrl): ?>
                                    <img src="<?php echo e($mediaUrl); ?>"
                                         alt="<?php echo e($content->titre); ?>"
                                         class="avatar-image"
                                         data-initial="<?php echo e($initial); ?>"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <?php endif; ?>
                                <div class="avatar-fallback <?php echo e($hasMedia && $mediaUrl ? 'd-none' : ''); ?>">
                                    <?php echo e($initial); ?>

                                </div>
                            </div>

                            <div>
                                <h6 class="mb-1">
                                    <a href="<?php echo e(route('front.contenu', $content->id_contenu)); ?>"
                                       class="text-decoration-none text-dark fw-bold">
                                        <?php echo e(Str::limit($content->titre, 40)); ?>

                                    </a>
                                </h6>
                                <small class="text-muted">
                                    <?php echo e($content->typeContenu->nom_contenu ?? 'Général'); ?>

                                </small>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="d-flex gap-3">
                                <span class="text-muted" title="J'aime">
                                    <i class="bi bi-heart me-1"></i><?php echo e($content->likes_count ?? 0); ?>

                                </span>
                                <span class="text-muted" title="Vues">
                                    <i class="bi bi-eye me-1"></i><?php echo e($content->vues_count ?? 0); ?>

                                </span>
                                <span class="text-muted" title="Commentaires">
                                    <i class="bi bi-chat me-1"></i><?php echo e($content->commentaires_count ?? 0); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-bar-chart"></i>
                    <p>Aucune statistique disponible</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Actions rapides -->
<div class="dashboard-card fade-in">
    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-lightning-fill"></i>
            Actions rapides
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 mb-3">
            <a href="<?php echo e(route('dashboard.contribuer')); ?>" class="quick-action-card dashboard-card text-decoration-none text-center">
                <i class="bi bi-plus-circle display-6 mb-3 text-primary"></i>
                <h5 class="fw-bold">Nouvelle contribution</h5>
                <small class="text-muted">Partagez votre savoir</small>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <a href="<?php echo e(route('front.explorer')); ?>" class="quick-action-card dashboard-card text-decoration-none text-center">
                <i class="bi bi-compass display-6 mb-3 text-primary"></i>
                <h5 class="fw-bold">Explorer</h5>
                <small class="text-muted">Découvrez du contenu</small>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <a href="<?php echo e(route('front.regions')); ?>" class="quick-action-card dashboard-card text-decoration-none text-center">
                <i class="bi bi-globe display-6 mb-3 text-primary"></i>
                <h5 class="fw-bold">Régions</h5>
                <small class="text-muted">Explorez par région</small>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <a href="<?php echo e(route('dashboard.settings')); ?>" class="quick-action-card dashboard-card text-decoration-none text-center">
                <i class="bi bi-gear display-6 mb-3 text-primary"></i>
                <h5 class="fw-bold">Paramètres</h5>
                <small class="text-muted">Gérez votre compte</small>
            </a>
        </div>
    </div>
</div>

<!-- Section profil améliorée -->
<div class="dashboard-card fade-in mt-4">
    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-person-circle"></i>
            Mon profil
        </h3>
    </div>

    <div class="row align-items-center">
        <div class="col-md-3 text-center mb-4 mb-md-0">
            <?php
    use App\Helpers\ImageHelper;
    $user = Auth::user();

    // Utiliser l'helper ImageHelper pour obtenir l'URL de l'avatar
    $avatarInfo = ImageHelper::getUserAvatarInfo($user);
    $hasPhoto = $avatarInfo['has_photo'];
    $photoUrl = $avatarInfo['photo_url'];
    $initials = $avatarInfo['initials'];
?>
            <div class="avatar-container">
                <?php if($hasPhoto && $photoUrl): ?>
                    <img src="<?php echo e($photoUrl); ?>"
                         alt="Photo de profil de <?php echo e($user->name); ?>"
                         class="avatar-image"
                         id="userAvatarImage"
                         onerror="this.style.display='none'; document.getElementById('userAvatarFallback').style.display='flex';">
                <?php endif; ?>

                <div class="avatar-fallback <?php echo e($hasPhoto && $photoUrl ? 'd-none' : ''); ?>"
                     id="userAvatarFallback">
                    <?php echo e($initials); ?>

                </div>
            </div>

            <div class="mt-3">
                <a href="<?php echo e(route('dashboard.settings')); ?>#avatar"
                   class="btn btn-outline-custom btn-sm">
                    <i class="bi bi-camera me-1"></i>Changer la photo
                </a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="profile-info-item">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person"></i>
                            <div class="ms-3">
                                <div class="text-muted small">Nom complet</div>
                                <div class="fw-bold fs-5"><?php echo e($user->name); ?> <?php echo e($user->prenom ?? ''); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="profile-info-item">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-envelope"></i>
                            <div class="ms-3">
                                <div class="text-muted small">Email</div>
                                <div class="fw-bold"><?php echo e($user->email); ?></div>
                                <?php if($user->email_verified_at): ?>
                                    <span class="badge bg-success mt-1">
                                        <i class="bi bi-check-circle me-1"></i>Vérifié
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger mt-1">
                                        <i class="bi bi-x-circle me-1"></i>Non vérifié
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="profile-info-item">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-check"></i>
                            <div class="ms-3">
                                <div class="text-muted small">Membre depuis</div>
                                <div class="fw-bold"><?php echo e($user->created_at->format('d/m/Y')); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="profile-info-item">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-history"></i>
                            <div class="ms-3">
                                <div class="text-muted small">Dernière connexion</div>
                                <div class="fw-bold"><?php echo e($user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Jamais'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3 flex-wrap">
                <a href="<?php echo e(route('dashboard.settings')); ?>" class="btn btn-primary-custom">
                    <i class="bi bi-pencil me-2"></i>Modifier le profil
                </a>
                <a href="<?php echo e(route('dashboard.contributions')); ?>" class="btn btn-outline-custom">
                    <i class="bi bi-journal-text me-2"></i>Mes contributions
                </a>
                <a href="<?php echo e(route('front.connexion')); ?>"
                   class="btn btn-outline-secondary"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard loaded');

    // Gestion améliorée des erreurs d'images
    document.querySelectorAll('img.avatar-image').forEach(img => {
        // Vérifier si l'image est déjà chargée
        if (img.complete) {
            if (img.naturalHeight === 0) {
                // Image a échoué
                img.style.display = 'none';
                const fallback = img.nextElementSibling;
                if (fallback && fallback.classList.contains('avatar-fallback')) {
                    fallback.style.display = 'flex';
                }
            }
        } else {
            // Ajouter un écouteur d'erreur
            img.addEventListener('error', function() {
                console.log('Image failed to load:', this.src);
                this.style.display = 'none';
                const fallback = this.nextElementSibling;
                if (fallback && fallback.classList.contains('avatar-fallback')) {
                    fallback.style.display = 'flex';
                }
            });

            // Ajouter un écouteur de chargement
            img.addEventListener('load', function() {
                console.log('Image loaded successfully:', this.src);
            });
        }
    });

    // Vérification périodique de l'avatar (pour les changements en temps réel)
    let avatarCheckAttempts = 0;
    const maxAvatarChecks = 10;

    function checkAvatarUpdate() {
        if (avatarCheckAttempts >= maxAvatarChecks) return;

        const avatarImage = document.getElementById('userAvatarImage');
        if (!avatarImage) return;

        // Ajouter un timestamp pour éviter le cache
        const timestamp = new Date().getTime();
        const currentSrc = avatarImage.src;
        const newSrc = currentSrc.split('?')[0] + '?t=' + timestamp;

        // Créer une nouvelle image pour vérifier si elle existe
        const testImage = new Image();
        testImage.onload = function() {
            if (currentSrc !== newSrc) {
                avatarImage.src = newSrc;
            }
            avatarCheckAttempts++;
            setTimeout(checkAvatarUpdate, 2000);
        };
        testImage.onerror = function() {
            avatarCheckAttempts++;
            setTimeout(checkAvatarUpdate, 2000);
        };
        testImage.src = newSrc;
    }

    // Démarrer la vérification après un délai
    setTimeout(checkAvatarUpdate, 3000);

    // Animation des cartes
    const cards = document.querySelectorAll('.dashboard-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 15px 35px rgba(0,0,0,0.1)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 5px 20px rgba(0,0,0,0.08)';
        });
    });

    // Rafraîchissement automatique des statistiques toutes les 30 secondes
    function refreshStats() {
        fetch('/api/dashboard/stats', {
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Mettre à jour les compteurs
            const statElements = {
                'total_contributions': document.querySelectorAll('.stat-number')[0],
                'total_likes_received': document.querySelectorAll('.stat-number')[1],
                'total_comments_received': document.querySelectorAll('.stat-number')[2],
                'total_views': document.querySelectorAll('.stat-number')[3]
            };

            Object.keys(statElements).forEach((key, index) => {
                if (data[key] && statElements[key]) {
                    const current = parseInt(statElements[key].textContent.replace(/\D/g, ''));
                    const target = data[key];

                    if (current !== target) {
                        // Animation du compteur
                        animateCounter(statElements[key], current, target);
                    }
                }
            });
        })
        .catch(error => console.error('Error refreshing stats:', error));
    }

    // Animation des compteurs
    function animateCounter(element, start, end) {
        const duration = 1000;
        const stepTime = 20;
        const steps = duration / stepTime;
        const increment = (end - start) / steps;
        let current = start;
        let step = 0;

        const timer = setInterval(() => {
            current += increment;
            step++;

            if (step >= steps) {
                current = end;
                clearInterval(timer);
            }

            element.textContent = Math.floor(current).toLocaleString();
        }, stepTime);
    }

    // Démarrer le rafraîchissement automatique
    setInterval(refreshStats, 30000);

    // Notification pour les nouvelles contributions
    <?php if(session('success')): ?>
        showNotification('<?php echo e(session('success')); ?>', 'success');
    <?php endif; ?>

    <?php if(session('error')): ?>
        showNotification('<?php echo e(session('error')); ?>', 'error');
    <?php endif; ?>
});

// Fonction pour afficher les notifications
function showNotification(message, type = 'info') {
    // Supprimer les anciennes notifications
    const oldNotifications = document.querySelectorAll('.dashboard-notification');
    oldNotifications.forEach(notification => notification.remove());

    // Créer la notification
    const notification = document.createElement('div');
    notification.className = `dashboard-notification alert alert-${type} alert-dismissible fade show`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        animation: slideInRight 0.3s ease;
        max-width: 400px;
    `;

    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}-fill me-3 fs-4"></i>
            <div>${message}</div>
        </div>
        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
    `;

    document.body.appendChild(notification);

    // Supprimer automatiquement après 5 secondes
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// CSS pour l'animation des notifications
const notificationStyle = document.createElement('style');
notificationStyle.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
`;
document.head.appendChild(notificationStyle);
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\front\dashboard\index.blade.php ENDPATH**/ ?>