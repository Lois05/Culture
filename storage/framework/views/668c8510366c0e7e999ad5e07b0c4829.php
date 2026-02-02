<?php $__env->startSection('title', ($contenu->titre ?? 'Contenu') . ' - Bénin Culture'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lucide-icons@latest/dist/umd/lucide.min.css">
<style>
    :root {
        --primary: #E8112D;
        --primary-light: rgba(232, 17, 45, 0.1);
        --primary-gradient: linear-gradient(135deg, #E8112D 0%, #FF3366 100%);
        --secondary: #FCD116;
        --accent: #008751;
        --dark: #0F172A;
        --light: #F8FAFC;
        --gray-100: #F1F5F9;
        --gray-200: #E2E8F0;
        --gray-300: #CBD5E1;
        --gray-800: #1E293B;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        --radius-lg: 16px;
        --radius-md: 12px;
        --radius-sm: 8px;
    }

    body {
        background: var(--light);
        padding-top: 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
        scroll-behavior: smooth;
    }

    /* ============ HERO SECTION MODERN ============ */
    .article-hero-modern {
        position: relative;
        height: 70vh;
        min-height: 500px;
        overflow: hidden;
        display: flex;
        align-items: flex-end;
    }

    .hero-gradient-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to bottom,
            transparent 0%,
            transparent 40%,
            rgba(15, 23, 42, 0.7) 70%,
            rgba(15, 23, 42, 0.95) 100%
        );
        z-index: 2;
    }

    .hero-image-parallax {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 120%;
        object-fit: cover;
        will-change: transform;
        animation: parallaxEffect 30s ease-in-out infinite alternate;
    }

    @keyframes parallaxEffect {
        0% { transform: scale(1.1) translateY(0); }
        100% { transform: scale(1) translateY(-5%); }
    }

    .hero-content-modern {
        position: relative;
        z-index: 10;
        padding-bottom: 4rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .meta-chip {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: white;
        transition: all 0.3s ease;
    }

    .meta-chip:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
    }

    .article-title-modern {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        color: white;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    /* ============ FLOATING ACTION BAR ============ */
    .floating-action-bar {
        position: fixed;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        box-shadow: var(--shadow-xl);
        display: flex;
        gap: 1rem;
        align-items: center;
        z-index: 1000;
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .fab-btn {
        position: relative;
        background: transparent;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: var(--gray-800);
    }

    .fab-btn:hover {
        background: var(--primary-light);
        color: var(--primary);
        transform: translateY(-2px);
    }

    .fab-btn.active {
        background: var(--primary);
        color: white;
    }

    .fab-btn-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: var(--primary);
        color: white;
        font-size: 0.7rem;
        padding: 2px 6px;
        border-radius: 10px;
        min-width: 18px;
        text-align: center;
    }

    /* ============ AUTHOR CARD MODERN ============ */
    .author-card-glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-top: -60px;
        position: relative;
        z-index: 20;
        box-shadow: var(--shadow-xl);
    }

    .author-avatar-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        margin-right: 1.5rem;
        flex-shrink: 0;
        overflow: hidden;
        border: 4px solid white;
        box-shadow: var(--shadow);
    }

    .author-avatar-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-follow-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .author-follow-btn:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .author-follow-btn:hover:before {
        width: 300px;
        height: 300px;
    }

    /* ============ CONTENT SECTION ============ */
    .content-modern {
        max-width: 800px;
        margin: 3rem auto;
        padding: 0 1rem;
    }

    .content-body-modern {
        font-size: 1.125rem;
        line-height: 1.8;
        color: var(--gray-800);
    }

    .content-body-modern h2 {
        font-size: 2rem;
        font-weight: 700;
        margin: 3rem 0 1.5rem;
        color: var(--dark);
        position: relative;
        padding-left: 1.5rem;
    }

    .content-body-modern h2:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.5rem;
        bottom: 0.5rem;
        width: 4px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    .content-body-modern h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 2.5rem 0 1rem;
        color: var(--gray-800);
    }

    .content-body-modern p {
        margin-bottom: 1.8rem;
    }

    .content-body-modern blockquote {
        border-left: 4px solid var(--primary);
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: var(--gray-800);
        background: var(--gray-100);
        padding: 2rem;
        border-radius: var(--radius-md);
        position: relative;
    }

    .content-body-modern blockquote:before {
        content: '"';
        font-size: 4rem;
        color: var(--primary);
        opacity: 0.2;
        position: absolute;
        top: -1rem;
        left: 1rem;
        font-family: serif;
    }

    .content-image-gallery {
        margin: 3rem 0;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-xl);
    }

    /* ============ STATS CARDS ============ */
    .stats-modern {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin: 3rem 0;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-md);
        padding: 1.5rem;
        text-align: center;
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .stat-card:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    /* ============ INTERACTIVE TAGS ============ */
    .tags-modern {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin: 2rem 0;
    }

    .tag-modern {
        background: var(--gray-100);
        color: var(--gray-800);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tag-modern:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow);
        border-color: var(--primary);
    }

    .tag-modern i {
        font-size: 0.8rem;
    }

    /* ============ COMMENTS MODERN ============ */
    .comments-modern {
        background: white;
        border-radius: var(--radius-lg);
        padding: 2.5rem;
        margin: 4rem 0;
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
    }

    .comment-card-modern {
        background: var(--gray-100);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .comment-card-modern:hover {
        background: white;
        border-color: var(--gray-300);
        transform: translateX(4px);
    }

    .comment-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        border: 3px solid white;
        box-shadow: var(--shadow);
    }

    .comment-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .comment-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: white;
        border: 1px solid var(--gray-300);
        border-radius: 50px;
        font-size: 0.875rem;
        color: var(--gray-800);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .comment-action-btn:hover {
        background: var(--gray-100);
        border-color: var(--primary);
        color: var(--primary);
    }

    .comment-action-btn.liked {
        background: var(--primary-light);
        color: var(--primary);
        border-color: var(--primary);
    }

    /* ============ RELATED CONTENT SLIDER ============ */
    .related-slider {
        margin: 4rem 0;
        position: relative;
    }

    .related-card-modern {
        background: white;
        border-radius: var(--radius-md);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
        border: 1px solid var(--gray-200);
    }

    .related-card-modern:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
        color: inherit;
    }

    .related-card-modern:hover .related-image-overlay {
        transform: scale(1.1);
    }

    .related-image-container {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .related-image-overlay {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .related-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: var(--primary);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* ============ PROGRESS BAR ============ */
    .reading-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: transparent;
        z-index: 9999;
    }

    .reading-progress-bar {
        height: 100%;
        background: var(--primary-gradient);
        width: 0%;
        transition: width 0.3s ease;
        box-shadow: 0 0 10px var(--primary);
    }

    /* ============ MODALS ============ */
    .modal-custom {
        backdrop-filter: blur(10px);
        background: rgba(15, 23, 42, 0.7);
    }

    .modal-content-custom {
        background: white;
        border-radius: var(--radius-lg);
        border: none;
        box-shadow: var(--shadow-xl);
    }

    /* ============ ANIMATIONS ============ */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    .floating {
        animation: float 3s ease-in-out infinite;
    }

    .pulse {
        animation: pulse 2s ease-in-out infinite;
    }

    /* ============ RESPONSIVE DESIGN ============ */
    @media (max-width: 1200px) {
        .article-title-modern {
            font-size: 3rem;
        }
    }

    @media (max-width: 992px) {
        .article-hero-modern {
            height: 60vh;
        }
        .article-title-modern {
            font-size: 2.5rem;
        }
        .author-card-glass {
            padding: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .article-hero-modern {
            height: 50vh;
        }
        .article-title-modern {
            font-size: 2rem;
        }
        .floating-action-bar {
            width: 90%;
            justify-content: space-around;
        }
        .content-body-modern h2 {
            font-size: 1.75rem;
        }
        .content-body-modern h3 {
            font-size: 1.25rem;
        }
    }

    @media (max-width: 576px) {
        .article-hero-modern {
            height: 40vh;
            min-height: 300px;
        }
        .article-title-modern {
            font-size: 1.75rem;
        }
        .author-card-glass {
            flex-direction: column;
            text-align: center;
            margin-top: -40px;
        }
        .author-avatar-circle {
            margin-right: 0;
            margin-bottom: 1rem;
        }
        .stats-modern {
            grid-template-columns: 1fr;
        }
    }

    /* ============ DARK MODE SUPPORT ============ */
    @media (prefers-color-scheme: dark) {
        :root {
            --light: #0F172A;
            --dark: #F8FAFC;
            --gray-100: #1E293B;
            --gray-200: #334155;
            --gray-800: #F1F5F9;
        }

        body {
            background: var(--light);
            color: var(--gray-800);
        }

        .author-card-glass,
        .content-body-modern,
        .stat-card,
        .comments-modern,
        .comment-card-modern,
        .related-card-modern {
            background: var(--gray-100);
            color: var(--gray-800);
        }

        .floating-action-bar {
            background: rgba(30, 41, 59, 0.95);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .fab-btn {
            color: var(--gray-800);
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    use App\Helpers\ImageHelper;

    // Données de l'auteur
    $author = $contenu->auteur ?? null;
    $authorAvatar = ImageHelper::getUserAvatarInfo($author);
    $authorName = $authorAvatar['name'];
    $authorInitials = $authorAvatar['initials'];
    $authorPhoto = $authorAvatar['photo_url'];
    $hasAuthorPhoto = $authorAvatar['has_photo'];
    $authorColor = $authorAvatar['color'];

    // Images
    $mainImage = ImageHelper::getContentImage($contenu);
    $images = [$mainImage, 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800', 'https://images.unsplash.com/photo-1545569341-9eb8b30979d9?w-800'];

    // Statistiques
    $views = $contenu->vues_count ?? rand(1000, 50000);
    $likes = $contenu->likes_count ?? rand(500, 10000);
    $commentsCount = $contenu->commentaires_count ?? rand(50, 500);
    $readingTime = ceil(str_word_count(strip_tags($contenu->texte ?? '')) / 200);

    // Tags
    $tags = [
        ['icon' => 'map-marker-alt', 'text' => $contenu->region->nom_region ?? 'Bénin'],
        ['icon' => 'language', 'text' => $contenu->langue->nom_langue ?? 'Français'],
        ['icon' => 'tags', 'text' => $contenu->typeContenu->nom_contenu ?? 'Article'],
        ['icon' => 'star', 'text' => 'Culture'],
        ['icon' => 'heart', 'text' => 'Tradition'],
        ['icon' => 'music', 'text' => 'Patrimoine']
    ];

    // Contenu similaire
    $relatedContent = $contenusSimilaires ?? collect([]);
?>

<!-- Barre de progression de lecture -->
<div class="reading-progress">
    <div class="reading-progress-bar" id="readingProgress"></div>
</div>

<!-- Hero Section -->
<section class="article-hero-modern">
    <div class="hero-image-parallax" id="parallaxImage"></div>
    <div class="hero-gradient-overlay"></div>

    <div class="container hero-content-modern">
        <div class="article-meta">
            <a href="<?php echo e(route('front.explorer')); ?>" class="meta-chip">
                <i class="fas fa-compass"></i>
                Explorer
            </a>
            <?php if($contenu->region): ?>
            <a href="<?php echo e(route('front.regions', ['id' => $contenu->region->id_region])); ?>" class="meta-chip">
                <i class="fas fa-map-pin"></i>
                <?php echo e($contenu->region->nom_region); ?>

            </a>
            <?php endif; ?>
            <span class="meta-chip">
                <i class="far fa-clock"></i>
                <?php echo e($readingTime); ?> min de lecture
            </span>
        </div>

        <h1 class="article-title-modern" data-aos="fade-up" data-aos-delay="100">
            <?php echo e($contenu->titre); ?>

        </h1>

        <div class="article-meta" data-aos="fade-up" data-aos-delay="200">
            <span class="meta-chip">
                <i class="far fa-eye"></i>
                <?php echo e(number_format($views)); ?> vues
            </span>
            <span class="meta-chip">
                <i class="far fa-calendar"></i>
                <?php echo e($contenu->created_at->translatedFormat('d F Y')); ?>

            </span>
            <button class="meta-chip" onclick="shareContentModern()">
                <i class="fas fa-share-alt"></i>
                Partager
            </button>
        </div>
    </div>
</section>

<!-- Barre d'actions flottante -->
<div class="floating-action-bar" id="floatingActions">
    <button class="fab-btn" onclick="scrollToSection('content')" title="Lire">
        <i class="fas fa-book-open"></i>
    </button>
    <button class="fab-btn" onclick="toggleLikeModern()" id="likeBtnModern" title="J'aime">
        <i class="far fa-heart"></i>
        <span class="fab-btn-badge" id="likeCountBadge"><?php echo e($likes); ?></span>
    </button>
    <button class="fab-btn" onclick="toggleBookmarkModern()" id="bookmarkBtnModern" title="Sauvegarder">
        <i class="far fa-bookmark"></i>
    </button>
    <button class="fab-btn" onclick="scrollToSection('comments')" title="Commentaires">
        <i class="far fa-comment"></i>
        <span class="fab-btn-badge" id="commentCountBadge"><?php echo e($commentsCount); ?></span>
    </button>
    <button class="fab-btn" onclick="shareContentModern()" title="Partager">
        <i class="fas fa-share-alt"></i>
    </button>
</div>

<!-- Carte Auteur -->
<div class="container">
    <div class="author-card-glass" data-aos="fade-up">
        <div class="d-flex align-items-center">
            <div class="author-avatar-circle" style="background: <?php echo e($authorColor); ?>;">
                <?php if($hasAuthorPhoto && $authorPhoto): ?>
                    <img src="<?php echo e($authorPhoto); ?>" alt="<?php echo e($authorName); ?>"
                         onerror="this.style.display='none'; this.parentElement.innerHTML='<?php echo e($authorInitials); ?>';">
                <?php else: ?>
                    <?php echo e($authorInitials); ?>

                <?php endif; ?>
            </div>

            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h3 class="fw-bold mb-1"><?php echo e($authorName); ?></h3>
                        <p class="text-muted mb-2">
                            <?php echo e($author->role->nom_role ?? 'Contributeur Culturel'); ?>

                            <?php if($author->followers_count): ?>
                            <span class="ms-2">
                                <i class="fas fa-users me-1"></i>
                                <?php echo e($author->followers_count); ?> abonnés
                            </span>
                            <?php endif; ?>
                        </p>
                        <?php if($author->bio): ?>
                        <p class="mb-0 text-muted"><?php echo e(Str::limit($author->bio, 120)); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->id() != $author?->id): ?>
                        <button class="btn btn-primary author-follow-btn" id="followAuthorBtnModern">
                            <i class="fas fa-plus-circle me-2"></i>
                            <span id="followText">Suivre</span>
                        </button>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('front.connexion')); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-user-plus me-2"></i>Suivre
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contenu Principal -->
<main class="content-modern">
    <!-- Statistiques -->
    <div class="stats-modern" data-aos="fade-up">
        <div class="stat-card">
            <div class="stat-number" id="viewsStat"><?php echo e(number_format($views)); ?></div>
            <div class="stat-label">Vues</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" id="likesStat"><?php echo e(number_format($likes)); ?></div>
            <div class="stat-label">Likes</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" id="commentsStat"><?php echo e(number_format($commentsCount)); ?></div>
            <div class="stat-label">Commentaires</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo e($readingTime); ?> min</div>
            <div class="stat-label">Temps de lecture</div>
        </div>
    </div>

    <!-- Tags -->
    <div class="tags-modern" data-aos="fade-up">
        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('front.explorer', ['search' => $tag['text']])); ?>" class="tag-modern">
            <i class="fas fa-<?php echo e($tag['icon']); ?>"></i>
            <?php echo e($tag['text']); ?>

        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Gallerie d'images -->
    <div class="content-image-gallery" data-aos="fade-up">
        <div class="swiper" id="contentGallery">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                    <img src="<?php echo e($image); ?>"
                         alt="<?php echo e($contenu->titre); ?>"
                         class="w-100"
                         style="height: 400px; object-fit: cover;"
                         onerror="this.src='<?php echo e(ImageHelper::defaultContent()); ?>'">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <!-- Contenu textuel -->
    <article class="content-body-modern" id="content" data-aos="fade-up">
        <?php echo $contenu->texte; ?>

    </article>

    <!-- Actions de fin d'article -->
    <div class="d-flex justify-content-center gap-3 my-5" data-aos="fade-up">
        <button class="btn btn-lg btn-primary px-4" onclick="toggleLikeModern()">
            <i class="far fa-heart me-2"></i>
            <span id="likeText">J'aime</span>
            <span class="badge bg-white text-primary ms-2" id="likeBadge"><?php echo e($likes); ?></span>
        </button>
        <button class="btn btn-lg btn-outline-primary px-4" onclick="scrollToSection('comments')">
            <i class="far fa-comment me-2"></i>
            Commenter
            <span class="badge bg-primary text-white ms-2"><?php echo e($commentsCount); ?></span>
        </button>
        <button class="btn btn-lg btn-outline-secondary px-4" onclick="shareContentModern()">
            <i class="fas fa-share-alt me-2"></i>
            Partager
        </button>
    </div>

    <!-- Section Commentaires -->
    <section class="comments-modern" id="comments" data-aos="fade-up">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">
                    <i class="fas fa-comments text-primary me-2"></i>
                    Commentaires
                </h2>
                <p class="text-muted mb-0">Partagez votre avis sur ce contenu</p>
            </div>

            <?php if(auth()->guard()->check()): ?>
            <button class="btn btn-primary" onclick="showCommentFormModern()" id="newCommentBtn">
                <i class="fas fa-plus me-2"></i>
                Nouveau commentaire
            </button>
            <?php else: ?>
            <a href="<?php echo e(route('front.connexion')); ?>?redirect=<?php echo e(url()->current()); ?>" class="btn btn-primary">
                <i class="fas fa-sign-in-alt me-2"></i>
                Se connecter pour commenter
            </a>
            <?php endif; ?>
        </div>

        <!-- Formulaire de commentaire -->
        <?php if(auth()->guard()->check()): ?>
        <div class="comment-form-modern mb-4" id="commentFormModern" style="display: none;">
            <div class="d-flex gap-3">
                <?php
                    $currentUser = auth()->user();
                    $userAvatar = ImageHelper::getUserAvatarInfo($currentUser);
                ?>
                <div class="comment-avatar" style="background: <?php echo e($userAvatar['color']); ?>;">
                    <?php if($userAvatar['has_photo'] && $userAvatar['photo_url']): ?>
                        <img src="<?php echo e($userAvatar['photo_url']); ?>" alt="<?php echo e($currentUser->name); ?>">
                    <?php else: ?>
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white fw-bold">
                            <?php echo e($userAvatar['initials']); ?>

                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex-grow-1">
                    <form id="commentFormElModern">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <textarea class="form-control form-control-lg"
                                      rows="3"
                                      placeholder="Votre commentaire..."
                                      id="commentTextModern"
                                      style="border-radius: 12px; border: 2px solid var(--gray-200);"></textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-outline-secondary" onclick="hideCommentFormModern()">
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-paper-plane me-2"></i>
                                Publier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>

       <!-- Liste des commentaires -->
<div id="commentsListModern">
    <?php
        // Définir $comments s'il n'existe pas
        $comments = $comments ?? collect([]);
    ?>

    <?php if($comments->count() > 0): ?>
        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="comment-card-modern" id="comment-<?php echo e($comment->id); ?>">
            <div class="d-flex gap-3">
                <?php
                    $commentAuthor = $comment->auteur ?? null;
                    $commentAvatar = ImageHelper::getUserAvatarInfo($commentAuthor);
                ?>
                <div class="comment-avatar" style="background: <?php echo e($commentAvatar['color']); ?>;">
                    <?php if($commentAvatar['has_photo'] && $commentAvatar['photo_url']): ?>
                        <img src="<?php echo e($commentAvatar['photo_url']); ?>" alt="<?php echo e($commentAvatar['name']); ?>">
                    <?php else: ?>
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white fw-bold">
                            <?php echo e($commentAvatar['initials']); ?>

                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="fw-bold mb-0"><?php echo e($commentAvatar['name']); ?></h6>
                            <small class="text-muted">
                                <i class="far fa-clock me-1"></i>
                                <?php echo e($comment->created_at->diffForHumans()); ?>

                            </small>
                        </div>
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->id() == $comment->id_auteur): ?>
                            <button class="btn btn-sm btn-link text-danger" onclick="deleteCommentModern(<?php echo e($comment->id); ?>)">
                                <i class="fas fa-trash"></i>
                            </button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <p class="mb-2"><?php echo e($comment->texte); ?></p>

                    <div class="comment-actions">
                        <button class="comment-action-btn" onclick="likeCommentModern(<?php echo e($comment->id); ?>)" id="commentLikeBtn-<?php echo e($comment->id); ?>">
                            <i class="far fa-heart"></i>
                            <span id="commentLikeCount-<?php echo e($comment->id); ?>"><?php echo e($comment->likes_count ?? 0); ?></span>
                        </button>
                        <button class="comment-action-btn" onclick="replyToCommentModern(<?php echo e($comment->id); ?>)">
                            <i class="far fa-comment"></i>
                            Répondre
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="fas fa-comment-slash fa-3x text-muted"></i>
            </div>
            <h4 class="text-muted mb-2">Aucun commentaire</h4>
            <p class="text-muted">Soyez le premier à donner votre avis !</p>
        </div>
    <?php endif; ?>
</div>
    </section>

    <!-- Contenu Similaire -->
    <?php if($relatedContent->count() > 0): ?>
    <section class="related-slider" data-aos="fade-up">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">
                    <i class="fas fa-compass text-primary me-2"></i>
                    Contenus similaires
                </h2>
                <p class="text-muted mb-0">Découvrez d'autres contenus sur le même thème</p>
            </div>
            <a href="<?php echo e(route('front.explorer')); ?>" class="btn btn-link text-primary">
                Voir plus
                <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            <?php $__currentLoopData = $relatedContent->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <a href="<?php echo e(route('front.contenu', ['id' => $related->id_contenu])); ?>" class="related-card-modern">
                    <div class="related-image-container">
                        <img src="<?php echo e(ImageHelper::getContentImage($related)); ?>"
                             alt="<?php echo e($related->titre); ?>"
                             class="related-image-overlay">
                        <span class="related-badge">
                            <?php echo e($related->typeContenu->nom_contenu ?? 'Article'); ?>

                        </span>
                    </div>
                    <div class="p-3 flex-grow-1">
                        <h5 class="fw-bold mb-2" style="font-size: 1.1rem;">
                            <?php echo e(Str::limit($related->titre, 50)); ?>

                        </h5>
                        <p class="text-muted small mb-3">
                            <?php echo e(Str::limit(strip_tags($related->texte ?? ''), 80)); ?>

                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <?php
                                    $relatedAuthor = $related->auteur ?? null;
                                    $relatedAvatar = ImageHelper::getUserAvatarInfo($relatedAuthor);
                                ?>
                                <div class="me-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 24px; height: 24px; background: <?php echo e($relatedAvatar['color']); ?>; color: white; font-size: 0.7rem;">
                                        <?php echo e($relatedAvatar['initials']); ?>

                                    </div>
                                </div>
                                <span class="small"><?php echo e($relatedAvatar['name']); ?></span>
                            </div>
                            <small class="text-muted">
                                <i class="far fa-clock me-1"></i>
                                <?php echo e($related->created_at->diffForHumans()); ?>

                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/lucide-icons@latest/dist/umd/lucide.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialisations
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });

    // Variables globales
        // Variables globales - version simplifiée
    let liked = false;
    let bookmarked = false;
    let following = false;

    // Initialiser Swiper Gallery
    const gallerySwiper = new Swiper('#contentGallery', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        }
    });

    // Effet Parallax
    const parallaxImage = document.getElementById('parallaxImage');
    const images = <?php echo json_encode($images, 15, 512) ?>;
    if (parallaxImage && images.length > 0) {
        parallaxImage.src = images[0];
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * 0.5;
            parallaxImage.style.transform = `translate3d(0, ${rate}px, 0) scale(1.1)`;
        });
    }

    // Barre de progression de lecture
    const progressBar = document.getElementById('readingProgress');
    window.addEventListener('scroll', function() {
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight - windowHeight;
        const scrolled = window.scrollY;
        const progress = (scrolled / documentHeight) * 100;
        progressBar.style.width = progress + '%';
    });

    // Navigation flottante
    const floatingBar = document.getElementById('floatingActions');
    let lastScroll = 0;
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        if (currentScroll > lastScroll && currentScroll > 100) {
            floatingBar.style.transform = 'translateX(-50%) translateY(100px)';
        } else {
            floatingBar.style.transform = 'translateX(-50%) translateY(0)';
        }
        lastScroll = currentScroll;
    });

    // Initialiser les états des boutons
    updateButtonStates();

    // ============ FONCTIONS PRINCIPALES ============

    // Mettre à jour les états des boutons
    function updateButtonStates() {
        const likeBtn = document.getElementById('likeBtnModern');
        const bookmarkBtn = document.getElementById('bookmarkBtnModern');
        const followBtn = document.getElementById('followAuthorBtnModern');

        if (liked) {
            document.querySelectorAll('.fa-heart').forEach(icon => {
                icon.classList.remove('far');
                icon.classList.add('fas', 'text-primary');
            });
            if (likeBtn) likeBtn.classList.add('active');
        }

        if (bookmarked) {
            document.querySelectorAll('.fa-bookmark').forEach(icon => {
                icon.classList.remove('far');
                icon.classList.add('fas', 'text-primary');
            });
            if (bookmarkBtn) bookmarkBtn.classList.add('active');
        }

        if (following && followBtn) {
            followBtn.innerHTML = '<i class="fas fa-check me-2"></i><span id="followText">Suivi</span>';
            followBtn.classList.remove('btn-primary');
            followBtn.classList.add('btn-success');
        }
    }

    // Gérer les likes (optimisé)
    window.toggleLikeModern = async function() {
        if (!<?php echo e(auth()->check() ? 'true' : 'false'); ?>) {
            showNotification('Connectez-vous pour aimer ce contenu', 'warning', 'heart');
            setTimeout(() => {
                window.location.href = '<?php echo e(route("front.connexion")); ?>?redirect=' + encodeURIComponent(window.location.href);
            }, 1500);
            return;
        }

        const likeBtn = document.getElementById('likeBtnModern');
        const likeCountBadge = document.getElementById('likeCountBadge');
        const likesStat = document.getElementById('likesStat');
        const likeBadge = document.getElementById('likeBadge');
        const likeText = document.getElementById('likeText');

        // Animation immédiate
        likeBtn.classList.add('pulse');
        if (liked) {
            likeBtn.innerHTML = '<i class="far fa-heart"></i>';
            likeBtn.classList.remove('active');
            document.querySelectorAll('.fa-heart').forEach(icon => {
                icon.classList.remove('fas', 'text-primary');
                icon.classList.add('far');
            });
        } else {
            likeBtn.innerHTML = '<i class="fas fa-heart text-primary"></i>';
            likeBtn.classList.add('active');
            document.querySelectorAll('.fa-heart').forEach(icon => {
                icon.classList.remove('far');
                icon.classList.add('fas', 'text-primary');
            });
            createHeartsAnimation(likeBtn);
        }

        liked = !liked;

        // Mettre à jour les compteurs
        let currentLikes = parseInt(likeCountBadge.textContent);
        if (liked) {
            currentLikes++;
            likeText.textContent = 'J\'aime';
            showNotification('Merci pour votre like !', 'success', 'heart');
        } else {
            currentLikes--;
            likeText.textContent = 'Like';
            showNotification('Like retiré', 'info', 'heart-broken');
        }

        likeCountBadge.textContent = currentLikes;
        if (likesStat) likesStat.textContent = currentLikes.toLocaleString();
        if (likeBadge) likeBadge.textContent = currentLikes;

        // Envoyer la requête
        try {
            const response = await fetch('<?php echo e(route("like.toggle", ["id" => $contenu->id_contenu])); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            if (!data.success) {
                throw new Error('Erreur serveur');
            }
        } catch (error) {
            console.error('Erreur:', error);
            showNotification('Erreur lors de la mise à jour', 'warning', 'exclamation-triangle');
        }

        setTimeout(() => {
            likeBtn.classList.remove('pulse');
        }, 500);
    };

    // Gérer les favoris
    window.toggleBookmarkModern = async function() {
        if (!<?php echo e(auth()->check() ? 'true' : 'false'); ?>) {
            showNotification('Connectez-vous pour sauvegarder', 'warning', 'bookmark');
            return;
        }

        const bookmarkBtn = document.getElementById('bookmarkBtnModern');

        // Animation immédiate
        bookmarkBtn.classList.add('pulse');
        if (bookmarked) {
            bookmarkBtn.innerHTML = '<i class="far fa-bookmark"></i>';
            bookmarkBtn.classList.remove('active');
            document.querySelectorAll('.fa-bookmark').forEach(icon => {
                icon.classList.remove('fas', 'text-primary');
                icon.classList.add('far');
            });
            showNotification('Retiré des favoris', 'info', 'bookmark');
        } else {
            bookmarkBtn.innerHTML = '<i class="fas fa-bookmark text-primary"></i>';
            bookmarkBtn.classList.add('active');
            document.querySelectorAll('.fa-bookmark').forEach(icon => {
                icon.classList.remove('far');
                icon.classList.add('fas', 'text-primary');
            });
            showNotification('Contenu sauvegardé !', 'success', 'bookmark');
        }

        bookmarked = !bookmarked;

        // Envoyer la requête
        try {
            const response = await fetch('<?php echo e(route("favorite.toggle", ["id" => $contenu->id_contenu])); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            if (!data.success) {
                throw new Error('Erreur serveur');
            }
        } catch (error) {
            console.error('Erreur:', error);
            showNotification('Erreur lors de la sauvegarde', 'warning', 'exclamation-triangle');
        }

        setTimeout(() => {
            bookmarkBtn.classList.remove('pulse');
        }, 500);
    };

    // Suivre l'auteur
    document.getElementById('followAuthorBtnModern')?.addEventListener('click', async function() {
        if (!<?php echo e(auth()->check() ? 'true' : 'false'); ?>) {
            showNotification('Connectez-vous pour suivre', 'warning', 'user-plus');
            return;
        }

        const followBtn = this;
        const followText = document.getElementById('followText');

        // Animation
        followBtn.classList.add('pulse');

        if (following) {
            followBtn.innerHTML = '<i class="fas fa-plus-circle me-2"></i><span id="followText">Suivre</span>';
            followBtn.classList.remove('btn-success');
            followBtn.classList.add('btn-primary');
            showNotification('Vous ne suivez plus cet auteur', 'info', 'user-minus');
        } else {
            followBtn.innerHTML = '<i class="fas fa-check me-2"></i><span id="followText">Suivi</span>';
            followBtn.classList.remove('btn-primary');
            followBtn.classList.add('btn-success');
            showNotification('Vous suivez maintenant cet auteur', 'success', 'user-check');
        }

        following = !following;

        // Envoyer la requête
        try {
            const response = await fetch('<?php echo e(route("follow.toggle", ["authorId" => $author->id])); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            if (!data.success) {
                throw new Error('Erreur serveur');
            }
        } catch (error) {
            console.error('Erreur:', error);
            showNotification('Erreur lors du suivi', 'warning', 'exclamation-triangle');
        }

        setTimeout(() => {
            followBtn.classList.remove('pulse');
        }, 500);
    });

    // Partager le contenu (Web Share API)
    window.shareContentModern = function() {
        const shareData = {
            title: '<?php echo e($contenu->titre); ?>',
            text: 'Découvrez ce contenu sur Bénin Culture : <?php echo e(Str::limit($contenu->titre, 100)); ?>',
            url: window.location.href,
        };

        if (navigator.share) {
            navigator.share(shareData)
                .then(() => showNotification('Contenu partagé avec succès', 'success', 'share-alt'))
                .catch(err => {
                    if (err.name !== 'AbortError') {
                        copyToClipboard(window.location.href);
                    }
                });
        } else {
            copyToClipboard(window.location.href);
        }
    };

    // Gestion des commentaires
    window.showCommentFormModern = function() {
        const form = document.getElementById('commentFormModern');
        const newCommentBtn = document.getElementById('newCommentBtn');
        if (form) {
            form.style.display = 'block';
            newCommentBtn.style.display = 'none';
            document.getElementById('commentTextModern').focus();
            form.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    };

    window.hideCommentFormModern = function() {
        const form = document.getElementById('commentFormModern');
        const newCommentBtn = document.getElementById('newCommentBtn');
        if (form) {
            form.style.display = 'none';
            newCommentBtn.style.display = 'block';
        }
    };

    // Soumettre un commentaire
    document.getElementById('commentFormElModern')?.addEventListener('submit', async function(e) {
        e.preventDefault();
        const textarea = document.getElementById('commentTextModern');
        const commentText = textarea.value.trim();

        if (!commentText) {
            showNotification('Veuillez écrire un commentaire', 'warning', 'comment');
            textarea.focus();
            return;
        }

        try {
            const response = await fetch('<?php echo e(route("comment.add", ["id" => $contenu->id_contenu])); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ texte: commentText })
            });

            const data = await response.json();

            if (data.success) {
                addCommentModern(data.comment);
                textarea.value = '';
                hideCommentFormModern();
                showNotification('Commentaire publié !', 'success', 'comment-check');
            } else {
                throw new Error(data.message || 'Erreur serveur');
            }
        } catch (error) {
            console.error('Erreur:', error);
            showNotification('Erreur lors de la publication', 'warning', 'exclamation-triangle');
        }
    });

    // Ajouter un commentaire
    function addCommentModern(comment) {
        const commentsList = document.getElementById('commentsListModern');
        const commentsStat = document.getElementById('commentsStat');
        const commentCountBadge = document.getElementById('commentCountBadge');

        // Mettre à jour les compteurs
        let currentCount = parseInt(commentCountBadge.textContent);
        currentCount++;
        commentCountBadge.textContent = currentCount;
        if (commentsStat) commentsStat.textContent = currentCount.toLocaleString();

        // Créer l'élément du commentaire
        const commentElement = document.createElement('div');
        commentElement.className = 'comment-card-modern';
        commentElement.id = `comment-${comment.id}`;

        // Préparer les données de l'avatar
        const userName = comment.user?.name || 'Utilisateur';
        const words = userName.split(' ');
        let initials = '';
        if (words.length >= 2) {
            initials = (words[0].charAt(0) + words[1].charAt(0)).toUpperCase();
        } else {
            initials = userName.charAt(0).toUpperCase();
        }

        const colors = ['#E8112D', '#FCD116', '#008751', '#8B5CF6', '#6366F1'];
        const colorIndex = initials.charCodeAt(0) % colors.length;
        const color = colors[colorIndex];

        commentElement.innerHTML = `
            <div class="d-flex gap-3">
                <div class="comment-avatar" style="background: ${color};">
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white fw-bold">
                        ${initials}
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="fw-bold mb-0">${userName}</h6>
                            <small class="text-muted">
                                <i class="far fa-clock me-1"></i>
                                À l'instant
                            </small>
                        </div>
                        <button class="btn btn-sm btn-link text-danger" onclick="deleteCommentModern(${comment.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <p class="mb-2">${comment.texte}</p>

                    <div class="comment-actions">
                        <button class="comment-action-btn" onclick="likeCommentModern(${comment.id})" id="commentLikeBtn-${comment.id}">
                            <i class="far fa-heart"></i>
                            <span id="commentLikeCount-${comment.id}">0</span>
                        </button>
                        <button class="comment-action-btn" onclick="replyToCommentModern(${comment.id})">
                            <i class="far fa-comment"></i>
                            Répondre
                        </button>
                    </div>
                </div>
            </div>
        `;

        // Ajouter en haut de la liste
        commentsList.prepend(commentElement);

        // Supprimer le message "Aucun commentaire" si présent
        const emptyMessage = commentsList.querySelector('.text-center');
        if (emptyMessage) {
            emptyMessage.remove();
        }

        // Animation d'entrée
        commentElement.style.opacity = '0';
        commentElement.style.transform = 'translateY(-20px)';
        setTimeout(() => {
            commentElement.style.transition = 'all 0.3s ease';
            commentElement.style.opacity = '1';
            commentElement.style.transform = 'translateY(0)';
        }, 10);
    }

    // Liker un commentaire
    window.likeCommentModern = async function(commentId) {
        if (!<?php echo e(auth()->check() ? 'true' : 'false'); ?>) {
            showNotification('Connectez-vous pour aimer', 'warning', 'heart');
            return;
        }

        const likeBtn = document.getElementById(`commentLikeBtn-${commentId}`);
        const likeCount = document.getElementById(`commentLikeCount-${commentId}`);

        if (!likeBtn || !likeCount) return;

        // Animation
        likeBtn.classList.add('pulse');
        const isLiked = likeBtn.classList.contains('liked');

        if (isLiked) {
            likeBtn.classList.remove('liked');
            likeBtn.innerHTML = '<i class="far fa-heart"></i> <span>' + likeCount.textContent + '</span>';
        } else {
            likeBtn.classList.add('liked');
            likeBtn.innerHTML = '<i class="fas fa-heart text-primary"></i> <span>' + likeCount.textContent + '</span>';
        }

        // Envoyer la requête
        try {
            const response = await fetch(`/api/comment/${commentId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            if (data.success) {
                likeCount.textContent = data.likes;
            }
        } catch (error) {
            console.error('Erreur:', error);
        }

        setTimeout(() => {
            likeBtn.classList.remove('pulse');
        }, 500);
    };

    // Supprimer un commentaire
    window.deleteCommentModern = async function(commentId) {
        if (!confirm('Voulez-vous vraiment supprimer ce commentaire ?')) return;

        const commentElement = document.getElementById(`comment-${commentId}`);
        if (!commentElement) return;

        // Animation de suppression
        commentElement.style.transition = 'all 0.3s ease';
        commentElement.style.opacity = '0';
        commentElement.style.transform = 'translateY(-20px)';

        try {
            const response = await fetch(`/comment/${commentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            if (data.success) {
                // Mettre à jour les compteurs
                const commentCountBadge = document.getElementById('commentCountBadge');
                const commentsStat = document.getElementById('commentsStat');
                let currentCount = parseInt(commentCountBadge.textContent);
                currentCount = Math.max(0, currentCount - 1);
                commentCountBadge.textContent = currentCount;
                if (commentsStat) commentsStat.textContent = currentCount.toLocaleString();

                // Supprimer l'élément après l'animation
                setTimeout(() => {
                    commentElement.remove();

                    // Vérifier s'il reste des commentaires
                    const commentsList = document.getElementById('commentsListModern');
                    if (!commentsList.children.length) {
                        commentsList.innerHTML = `
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-comment-slash fa-3x text-muted"></i>
                                </div>
                                <h4 class="text-muted mb-2">Aucun commentaire</h4>
                                <p class="text-muted">Soyez le premier à donner votre avis !</p>
                            </div>
                        `;
                    }
                }, 300);

                showNotification('Commentaire supprimé', 'success', 'trash');
            }
        } catch (error) {
            console.error('Erreur:', error);
            // Annuler l'animation en cas d'erreur
            commentElement.style.opacity = '1';
            commentElement.style.transform = 'translateY(0)';
            showNotification('Erreur lors de la suppression', 'warning', 'exclamation-triangle');
        }
    };

    // Répondre à un commentaire
    window.replyToCommentModern = function(commentId) {
        showCommentFormModern();
        const textarea = document.getElementById('commentTextModern');
        const commentAuthor = document.querySelector(`#comment-${commentId} h6`).textContent;
        textarea.value = `@${commentAuthor} `;
        textarea.focus();
    };

    // ============ FONCTIONS UTILITAIRES ============

    // Animation de cœurs
    function createHeartsAnimation(element) {
        for (let i = 0; i < 5; i++) {
            setTimeout(() => {
                const heart = document.createElement('div');
                heart.innerHTML = '❤️';
                heart.style.position = 'fixed';
                heart.style.fontSize = '20px';
                heart.style.pointerEvents = 'none';
                heart.style.zIndex = '9999';

                const rect = element.getBoundingClientRect();
                const offsetX = (Math.random() - 0.5) * 40;
                heart.style.left = rect.left + rect.width/2 + offsetX + 'px';
                heart.style.top = rect.top + 'px';

                document.body.appendChild(heart);

                const animation = heart.animate([
                    { transform: 'translateY(0) scale(1)', opacity: 1 },
                    { transform: `translateY(-${80 + Math.random() * 40}px) scale(${1.2 + Math.random() * 0.3})`, opacity: 0 }
                ], {
                    duration: 800 + Math.random() * 400,
                    easing: 'cubic-bezier(0.215, 0.610, 0.355, 1)'
                });

                animation.onfinish = () => heart.remove();
            }, i * 100);
        }
    }

    // Copier dans le presse-papier
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            showNotification('Lien copié dans le presse-papier', 'success', 'copy');
        });
    }

    // Notification moderne
    function showNotification(message, type = 'info', icon = 'info-circle') {
        const notification = document.createElement('div');
        notification.className = 'notification-modern';

        const typeClass = {
            success: 'bg-success',
            warning: 'bg-warning',
            info: 'bg-info',
            error: 'bg-danger'
        }[type] || 'bg-info';

        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            color: var(--dark);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-xl);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            z-index: 9999;
            transform: translateX(150%);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-left: 4px solid var(--${type});
            min-width: 300px;
            max-width: 400px;
        `;

        notification.innerHTML = `
            <div class="notification-icon" style="color: var(--${type}); font-size: 1.25rem;">
                <i class="fas fa-${icon}"></i>
            </div>
            <div class="flex-grow-1">
                <div class="fw-semibold">${message}</div>
            </div>
            <button onclick="this.parentElement.remove()" style="background: transparent; border: none; color: var(--gray-400); cursor: pointer;">
                <i class="fas fa-times"></i>
            </button>
        `;

        document.body.appendChild(notification);

        // Animation d'entrée
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);

        // Auto-remove
        setTimeout(() => {
            notification.style.transform = 'translateX(150%)';
            setTimeout(() => notification.remove(), 400);
        }, 3000);
    }

    // Navigation par ancres
    window.scrollToSection = function(sectionId) {
        const element = document.getElementById(sectionId);
        if (element) {
            const offset = 80;
            const elementPosition = element.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    };

    // Mode lecture
    window.toggleReadingMode = function() {
        document.body.classList.toggle('reading-mode');
        const content = document.querySelector('.content-body-modern');
        if (content) {
            content.classList.toggle('reading-mode');
        }
        showNotification(
            document.body.classList.contains('reading-mode')
                ? 'Mode lecture activé'
                : 'Mode lecture désactivé',
            'info',
            'book-reader'
        );
    };
});

// Gestion du rechargement de la page (conserver la position)
window.addEventListener('beforeunload', function() {
    sessionStorage.setItem('scrollPosition', window.pageYOffset);
});

window.addEventListener('load', function() {
    const savedPosition = sessionStorage.getItem('scrollPosition');
    if (savedPosition) {
        window.scrollTo(0, parseInt(savedPosition));
        sessionStorage.removeItem('scrollPosition');
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\front\contenu.blade.php ENDPATH**/ ?>