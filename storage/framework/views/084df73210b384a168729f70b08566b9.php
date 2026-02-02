<?php $__env->startSection('title', 'Boutique Premium - Bénin Culture'); ?>

<?php $__env->startPush('styles'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    :root {
        --benin-red: #E8112D;
        --benin-yellow: #FCD116;
        --benin-green: #008751;
        --benin-dark: #0A0F2D;
        --benin-gold: #FFD700;
        --benin-purple: #764ba2;
        --neon-glow: 0 0 20px rgba(232, 17, 45, 0.4),
                     0 0 40px rgba(252, 209, 22, 0.3),
                     0 0 60px rgba(0, 135, 81, 0.2);
        --gradient-premium: linear-gradient(135deg,
                        #E8112D 0%,
                        #FF3366 25%,
                        #FCD116 50%,
                        #FFD700 75%,
                        #008751 100%);
    }

    /* Cinematic Hero */
    .cinematic-hero {
        position: relative;
        min-height: 100vh;
        background: linear-gradient(rgba(10, 15, 45, 0.95), rgba(10, 15, 45, 0.9)),
                    url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        overflow: hidden;
        margin-top: -80px;
        padding-top: 80px;
    }

    .hero-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80vw;
        height: 80vw;
        background: radial-gradient(circle, rgba(232, 17, 45, 0.3), transparent 70%);
        animation: glowPulse 8s ease-in-out infinite;
        filter: blur(40px);
    }

    @keyframes glowPulse {
        0%, 100% { opacity: 0.3; transform: translate(-50%, -50%) scale(1); }
        50% { opacity: 0.5; transform: translate(-50%, -50%) scale(1.1); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 4.5rem;
        font-weight: 900;
        background: var(--gradient-premium);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: var(--neon-glow);
        line-height: 1.1;
        margin-bottom: 1.5rem;
    }

    /* Interactive Cards */
    .premium-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border-radius: 30px;
        overflow: hidden;
        position: relative;
        transform-style: preserve-3d;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(232, 17, 45, 0.1);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        height: 100%;
        cursor: pointer;
    }

    .premium-card:hover {
        transform: translateY(-25px) rotateX(5deg) scale(1.02);
        box-shadow: var(--neon-glow),
                    0 50px 100px -20px rgba(232, 17, 45, 0.25);
    }

    .card-glow {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: var(--gradient-premium);
        z-index: 2;
    }

    .card-header-glow {
        background: linear-gradient(135deg, var(--benin-red), var(--benin-purple));
        padding: 4rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .card-header-glow::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: 0.6s;
    }

    .premium-card:hover .card-header-glow::before {
        left: 100%;
    }

    /* Popular Badge */
    .popular-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--gradient-premium);
        color: white;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: bold;
        transform: rotate(15deg);
        box-shadow: 0 10px 30px rgba(232, 17, 45, 0.3);
        animation: badgeFloat 3s ease-in-out infinite;
        z-index: 3;
    }

    @keyframes badgeFloat {
        0%, 100% { transform: rotate(15deg) translateY(0); }
        50% { transform: rotate(15deg) translateY(-10px); }
    }

    /* Price Display */
    .price-display {
        font-size: 4.5rem;
        font-weight: 900;
        background: var(--gradient-premium);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        line-height: 1;
        margin: 2rem 0;
        position: relative;
    }

    .price-display::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: var(--gradient-premium);
        border-radius: 3px;
    }

    /* Feature Icons */
    .feature-icon {
        width: 40px;
        height: 40px;
        background: var(--gradient-premium);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 15px;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .premium-card:hover .feature-icon {
        transform: rotate(15deg) scale(1.1);
    }

    /* Interactive Comparison */
    .comparison-container {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
        position: relative;
    }

    .comparison-header {
        background: linear-gradient(135deg, rgba(232, 17, 45, 0.1), rgba(252, 209, 22, 0.1));
        padding: 2rem;
        border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    }

    .feature-row {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .feature-row:hover {
        background: rgba(232, 17, 45, 0.1);
        transform: translateX(10px);
    }

    .feature-badge {
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .feature-badge:hover {
        transform: scale(1.1);
    }

    /* Testimonials Carousel */
    .testimonial-carousel {
        position: relative;
        padding: 4rem 0;
    }

    .swiper-testimonial {
        padding: 3rem 0;
    }

    .testimonial-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 3rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        transition: all 0.6s ease;
        height: auto;
        border: 1px solid rgba(232, 17, 45, 0.1);
    }

    .testimonial-card:hover {
        transform: translateY(-15px) rotateY(5deg);
        box-shadow: var(--neon-glow);
    }

    .testimonial-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid transparent;
        background: linear-gradient(45deg, var(--benin-red), var(--benin-yellow), var(--benin-green)) border-box;
        padding: 3px;
        margin: 0 auto 2rem;
        overflow: hidden;
    }

    .avatar-inner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.5rem;
        color: var(--benin-red);
    }

    /* Floating CTA */
    .floating-cta {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
        animation: ctaFloat 3s ease-in-out infinite;
    }

    @keyframes ctaFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .cta-button {
        background: var(--gradient-premium);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 15px 30px;
        font-weight: bold;
        box-shadow: var(--neon-glow);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cta-button:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 0 30px rgba(232, 17, 45, 0.6);
    }

    /* Stats Counter */
    .stat-counter {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-counter:hover {
        transform: translateY(-10px);
        box-shadow: var(--neon-glow);
    }

    .counter-number {
        font-size: 3rem;
        font-weight: 900;
        background: var(--gradient-premium);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    /* Progress Bar Animation */
    .progress-glow {
        height: 10px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        overflow: hidden;
        position: relative;
    }

    .progress-glow::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: var(--progress, 0%);
        background: var(--gradient-premium);
        border-radius: 5px;
        animation: progressShine 2s infinite linear;
    }

    @keyframes progressShine {
        0% { background-position: -200px 0; }
        100% { background-position: 200px 0; }
    }

    /* Payment Methods */
    .payment-methods {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 2rem;
    }

    .payment-method {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .payment-method:hover {
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 15px 35px rgba(232, 17, 45, 0.2);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .hero-title {
            font-size: 3.5rem;
        }

        .price-display {
            font-size: 3.5rem;
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .cinematic-hero {
            background-attachment: scroll;
            min-height: 80vh;
        }

        .price-display {
            font-size: 2.8rem;
        }

        .floating-cta {
            bottom: 20px;
            right: 20px;
        }
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(10, 15, 45, 0.1);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--gradient-premium);
        border-radius: 5px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Cinematic Hero -->
<section class="cinematic-hero">
    <div class="hero-glow"></div>
    <div class="container hero-content">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-8">
                <h1 class="hero-title" data-aos="fade-up" data-aos-duration="1500">
                    Élevez Votre <span class="text-warning">Expérience</span><br>
                    Culturelle
                </h1>

                <p class="lead text-white fs-3 mb-5" data-aos="fade-up" data-aos-delay="300">
                    Accédez à des contenus exclusifs, soutenez la préservation<br>
                    du patrimoine et rejoignez une communauté d'élite.
                </p>

                <!-- Interactive Stats -->
                <div class="row mb-5" data-aos="fade-up" data-aos-delay="500">
                    <div class="col-md-3 col-6 mb-4">
                        <div class="stat-counter text-center">
                            <div class="counter-number" data-count="12500">12,500+</div>
                            <p class="text-white-50 mb-0">Membres Premium</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="stat-counter text-center">
                            <div class="counter-number" data-count="98">98%</div>
                            <p class="text-white-50 mb-0">Satisfaction</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="stat-counter text-center">
                            <div class="counter-number" data-count="2458">2,458+</div>
                            <p class="text-white-50 mb-0">Contenus Exclusifs</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="stat-counter text-center">
                            <div class="counter-number" data-count="24">24/7</div>
                            <p class="text-white-50 mb-0">Support Premium</p>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="mb-5" data-aos="fade-up" data-aos-delay="700">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white">Places disponibles</span>
                        <span class="text-warning fw-bold">85%</span>
                    </div>
                    <div class="progress-glow" style="--progress: 85%"></div>
                </div>

                <!-- CTA Buttons -->
                <div class="d-flex flex-wrap gap-3" data-aos="fade-up" data-aos-delay="900">
                    <?php if(auth()->guard()->check()): ?>
                    <a href="#abonnements" class="btn btn-lg px-5 py-3 fw-bold rounded-pill"
                       style="background: var(--gradient-premium); color: white;">
                       <i class="bi bi-stars me-2"></i>Voir les offres
                    </a>
                    <a href="<?php echo e(route('front.explorer')); ?>" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                        <i class="bi bi-compass me-2"></i>Explorer gratuitement
                    </a>
                    <?php else: ?>
                    <a href="<?php echo e(route('front.inscription')); ?>" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                        <i class="bi bi-person-plus me-2"></i>S'inscrire gratuitement
                    </a>
                    <a href="<?php echo e(route('front.connexion')); ?>" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    $upsellContent = null;
    if(request()->has('content_id')) {
        $upsellContent = \App\Models\Contenu::find(request('content_id'));
    }
?>

<?php if(request()->has('upsell') && $upsellContent): ?>
<section class="contextual-upsell py-5" style="background: linear-gradient(135deg, #fff9e6, #fff);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2 text-center mb-4 mb-md-0">
                <div class="icon-circle bg-warning rounded-circle p-3 shadow d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-unlock-fill text-dark fs-1"></i>
                </div>
            </div>

            <div class="col-md-7">
                <h3 class="fw-bold mb-2">
                    <i class="bi bi-book text-primary me-2"></i>
                    Vous souhaitez lire :
                    <span class="text-primary">"<?php echo e(Str::limit($upsellContent->titre, 60)); ?>"</span>
                </h3>
                <p class="text-muted mb-2">
                    Cet article premium nécessite un abonnement. Choisissez une offre pour le débloquer
                    et accéder à toute notre bibliothèque.
                </p>
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <span class="badge bg-light text-dark">
                        <i class="bi bi-clock me-1"></i> <?php echo e($upsellContent->reading_time); ?>

                    </span>
                    <?php if($upsellContent->region): ?>
                    <span class="badge bg-light text-dark">
                        <i class="bi bi-geo-alt me-1"></i> <?php echo e($upsellContent->region->nom); ?>

                    </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-3 text-md-end">
                <a href="#abonnements" class="btn btn-warning btn-lg px-4">
                    <i class="bi bi-stars me-2"></i>
                    Voir les offres
                </a>
                <div class="mt-2">
                    <a href="<?php echo e(route('front.contenu', $upsellContent->id_contenu)); ?>"
                       class="text-muted small">
                        <i class="bi bi-arrow-left me-1"></i> Retour à l'article
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.contextual-upsell {
    border-bottom: 3px solid #FCD116;
    box-shadow: 0 5px 25px rgba(252, 209, 22, 0.1);
}
.icon-circle {
    width: 70px;
    height: 70px;
}
</style>
<?php endif; ?>

<!-- Premium Abonnements -->
<section id="abonnements" class="py-6 bg-dark">
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-3 fw-bold text-white mb-4" data-aos="fade-up">
                    Nos <span class="text-warning">Abonnements</span>
                </h2>
                <p class="text-white-50 lead" data-aos="fade-up" data-aos-delay="200">
                    Choisissez l'offre qui correspond à vos ambitions culturelles
                </p>
            </div>
        </div>

        <div class="row g-4">
            <?php $__currentLoopData = $abonnements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abonnement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo e(($loop->index + 1) * 100); ?>">
                <div class="premium-card">
                    <?php if($abonnement['nom'] == 'Passionné' || $abonnement['recommandé']): ?>
                    <div class="popular-badge">
                        <i class="bi bi-fire me-2"></i>LE PLUS POPULAIRE
                    </div>
                    <?php endif; ?>

                    <div class="card-glow"></div>

                    <!-- Header -->
                    <div class="card-header-glow text-white">
                        <i class="bi <?php echo e($abonnement['icon']); ?> display-1 mb-3"></i>
                        <h3 class="fw-bold mb-2"><?php echo e($abonnement['nom']); ?></h3>
                        <p class="opacity-75"><?php echo e($abonnement['description']); ?></p>
                    </div>

                    <!-- Body -->
                    <div class="p-4">
                        <!-- Price -->
                        <div class="text-center mb-4">
                            <div class="price-display">
                                <?php echo e(number_format($abonnement['prix'], 0, ',', ' ')); ?>

                            </div>
                            <div class="h4 text-muted"><?php echo e($abonnement['devise']); ?> / mois</div>
                        </div>

                        <!-- Features -->
                        <div class="mb-5">
                            <?php $__currentLoopData = $abonnement['features_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-center mb-3">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <span><?php echo e($feature); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- CTA Button -->
                        <div class="text-center">
                            <?php if(auth()->guard()->check()): ?>
                            <form action="<?php echo e(route('boutique.process.choix')); ?>" method="POST" id="form-<?php echo e($abonnement['id']); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id_abonnement" value="<?php echo e($abonnement['id']); ?>">
                                <input type="hidden" name="period" value="monthly">

                                <button type="submit" class="btn w-100 py-3 fw-bold rounded-pill
                                    <?php echo e($abonnement['nom'] == 'Passionné' ? 'btn-warning' : ''); ?>

                                    <?php echo e($abonnement['nom'] == 'Professionnel' ? 'btn-primary' : ''); ?>

                                    <?php echo e($abonnement['nom'] == 'Découverte' ? 'btn-dark' : ''); ?>"
                                    style="<?php echo e($abonnement['nom'] == 'Passionné' ? 'background: var(--gradient-premium); color: white;' : ''); ?>">

                                    <?php if($abonnement['nom'] == 'Passionné'): ?>
                                        <i class="bi bi-star-fill me-2"></i>Sélectionner cette offre
                                    <?php elseif($abonnement['nom'] == 'Professionnel'): ?>
                                        <i class="bi bi-award-fill me-2"></i>Devenir Expert
                                    <?php else: ?>
                                        <i class="bi bi-rocket-takeoff me-2"></i>Commencer l'aventure
                                    <?php endif; ?>
                                </button>
                            </form>
                            <?php else: ?>
                            <a href="<?php echo e(route('front.connexion')); ?>" class="btn btn-outline-dark w-100 py-3 rounded-pill">
                                <i class="bi bi-person-fill me-2"></i>Se connecter pour souscrire
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Comparison Table -->
<section class="py-6" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-3 fw-bold mb-4" data-aos="fade-up">
                    Comparaison <span class="text-primary">Détaillée</span>
                </h2>
                <p class="text-muted lead" data-aos="fade-up" data-aos-delay="200">
                    Tout ce que vous devez savoir pour faire le bon choix
                </p>
            </div>
        </div>

        <div class="comparison-container" data-aos="zoom-in">
            <div class="comparison-header text-center">
                <h4 class="text-dark fw-bold">Tableau Comparatif</h4>
                <p class="text-muted">Comparez toutes les fonctionnalités</p>
            </div>

            <div class="row g-0">
                <?php $__currentLoopData = [
                    ['feature' => 'Contenus Premium', 'decouverte' => '10/mois', 'passionne' => 'Illimité', 'professionnel' => 'Illimité +'],
                    ['feature' => 'Téléchargements HD', 'decouverte' => 'Non', 'passionne' => 'Oui', 'professionnel' => 'Oui 4K'],
                    ['feature' => 'Support Prioritaire', 'decouverte' => 'Email', 'passionne' => 'Prioritaire', 'professionnel' => '24/7 + Téléphone'],
                    ['feature' => 'Certificat', 'decouverte' => 'Standard', 'passionne' => 'Premium', 'professionnel' => 'Expert'],
                    ['feature' => 'Accès API', 'decouverte' => 'Non', 'passionne' => 'Non', 'professionnel' => 'Oui'],
                    ['feature' => 'Formations Exclusives', 'decouverte' => '1/mois', 'passionne' => '4/mois', 'professionnel' => 'Illimité'],
                    ['feature' => 'Statut', 'decouverte' => 'Basique', 'passionne' => 'Premium', 'professionnel' => 'Expert']
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="feature-row">
                    <div class="col-md-3">
                        <span class="fw-bold text-dark"><?php echo e($feature['feature']); ?></span>
                    </div>
                    <div class="col-md-3 text-center">
                        <span class="<?php echo e($feature['decouverte'] == 'Non' ? 'text-danger' : ''); ?>">
                            <?php echo e($feature['decouverte']); ?>

                        </span>
                    </div>
                    <div class="col-md-3 text-center">
                        <span class="<?php echo e(in_array($feature['passionne'], ['Oui', 'Premium', 'Illimité']) ? 'text-warning fw-bold' : ''); ?>">
                            <?php echo e($feature['passionne']); ?>

                        </span>
                    </div>
                    <div class="col-md-3 text-center">
                        <span class="<?php echo e(in_array($feature['professionnel'], ['Oui', 'Expert', 'Illimité +']) ? 'text-primary fw-bold' : ''); ?>">
                            <?php echo e($feature['professionnel']); ?>

                        </span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Carousel -->
<section class="py-6 bg-dark">
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-3 fw-bold text-white mb-4" data-aos="fade-up">
                    Ils Nous <span class="text-warning">Font Confiance</span>
                </h2>
                <p class="text-white-50 lead" data-aos="fade-up" data-aos-delay="200">
                    Découvrez ce que pensent nos membres premium
                </p>
            </div>
        </div>

        <div class="testimonial-carousel">
            <div class="swiper swiper-testimonial" data-aos="fade-up">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-avatar">
                                <div class="avatar-inner">KD</div>
                            </div>
                            <h5 class="fw-bold text-center mb-2">Koffi Dan</h5>
                            <p class="text-center text-muted mb-4">Historien</p>
                            <p class="text-center mb-4">
                                "Grâce à l'abonnement Passionné, j'ai accès à des archives historiques rares qui ont transformé mes recherches universitaires."
                            </p>
                            <div class="text-center text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-avatar">
                                <div class="avatar-inner">AT</div>
                            </div>
                            <h5 class="fw-bold text-center mb-2">Amina Traoré</h5>
                            <p class="text-center text-muted mb-4">Professeure</p>
                            <p class="text-center mb-4">
                                "Les ressources pédagogiques sont exceptionnelles pour mes étudiants. Les vidéos en haute définition ont enrichi mon enseignement."
                            </p>
                            <div class="text-center text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-avatar">
                                <div class="avatar-inner">JD</div>
                            </div>
                            <h5 class="fw-bold text-center mb-2">Jean Duval</h5>
                            <p class="text-center text-muted mb-4">Chercheur</p>
                            <p class="text-center mb-4">
                                "Cette plateforme m'a permis de découvrir la culture béninoise comme jamais auparavant. L'abonnement Professionnel est un investissement précieux."
                            </p>
                            <div class="text-center text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="py-6" style="background: linear-gradient(135deg, var(--benin-red), var(--benin-purple));">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <h2 class="display-4 fw-bold text-white mb-4" data-aos="fade-up">
                    Prêt à Rejoindre <span class="text-warning">l'Élite Culturelle</span> ?
                </h2>
                <p class="text-white fs-5 mb-5 opacity-90" data-aos="fade-up" data-aos-delay="200">
                    Votre abonnement contribue directement à la préservation et à la valorisation<br>
                    du patrimoine culturel béninois pour les générations futures.
                </p>

                <div class="d-flex flex-wrap justify-content-center gap-4 mb-5" data-aos="fade-up" data-aos-delay="400">
                    <?php if(auth()->guard()->check()): ?>
                    <a href="#abonnements" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold">
                        <i class="bi bi-stars me-2"></i>Choisir mon abonnement
                    </a>
                    <a href="<?php echo e(route('dashboard.contribuer')); ?>" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                        <i class="bi bi-plus-circle me-2"></i>Devenir contributeur
                    </a>
                    <?php else: ?>
                    <a href="<?php echo e(route('front.inscription')); ?>" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold">
                        <i class="bi bi-person-plus me-2"></i>Créer un compte gratuit
                    </a>
                    <a href="<?php echo e(route('front.connexion')); ?>" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Payment Methods -->
                <div class="payment-methods" data-aos="fade-up" data-aos-delay="600">
                    <div class="payment-method">
                        <i class="bi bi-credit-card fs-4"></i>
                    </div>
                    <div class="payment-method">
                        <i class="fab fa-cc-paypal fs-4"></i>
                    </div>
                    <div class="payment-method">
                        <i class="fab fa-cc-mastercard fs-4"></i>
                    </div>
                    <div class="payment-method">
                        <i class="fab fa-cc-visa fs-4"></i>
                    </div>
                    <div class="payment-method">
                        <i class="bi bi-cash-coin fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Floating CTA -->
<?php if(auth()->guard()->check()): ?>
<div class="floating-cta">
    <button class="cta-button" onclick="document.getElementById('abonnements').scrollIntoView({behavior: 'smooth'})">
        <i class="bi bi-gem"></i>
        <span>Voir les offres</span>
    </button>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser AOS
    AOS.init({
        duration: 1000,
        once: true,
        mirror: false
    });

    // Animer les compteurs
    const counters = document.querySelectorAll('.counter-number');
    counters.forEach(counter => {
        const text = counter.textContent;
        const target = parseInt(text.replace(/[^0-9]/g, '')) || 0;
        const hasPlus = text.includes('+');
        let current = 0;
        const increment = target / 60;

        const updateCounter = () => {
            current += increment;
            if (current >= target) {
                counter.textContent = target.toLocaleString() + (hasPlus ? '+' : '');
            } else {
                counter.textContent = Math.floor(current).toLocaleString();
                requestAnimationFrame(updateCounter);
            }
        };
        updateCounter();
    });

    // Initialiser le swiper des témoignages
    const testimonialSwiper = new Swiper('.swiper-testimonial', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        },
    });

    // Gérer la soumission des formulaires avec CSRF
    document.querySelectorAll('form[id^="form-"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            // Vérifier que le token CSRF est présent
            const token = this.querySelector('input[name="_token"]');
            if (!token || !token.value) {
                console.error('Token CSRF manquant');
                e.preventDefault();
                alert('Erreur de sécurité. Veuillez rafraîchir la page.');
                return;
            }

            // Désactiver le bouton pour éviter les double-clics
            const button = this.querySelector('button[type="submit"]');
            if (button) {
                button.disabled = true;
                button.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Traitement...';
            }
        });
    });

    // Effet de parallaxe sur le hero
    window.addEventListener('scroll', () => {
        const hero = document.querySelector('.cinematic-hero');
        if (hero) {
            const scrolled = window.pageYOffset;
            const rate = scrolled * 0.5;
            hero.style.backgroundPositionY = rate + 'px';
        }
    });

    // Animation de la progress bar
    const progressBar = document.querySelector('.progress-glow');
    if (progressBar) {
        let progress = 0;
        const target = 85;
        const interval = setInterval(() => {
            progress++;
            progressBar.style.setProperty('--progress', `${progress}%`);
            if (progress >= target) {
                clearInterval(interval);
            }
        }, 20);
    }

    // Rafraîchir le token CSRF
    function refreshCsrfToken() {
        fetch('/sanctum/csrf-cookie', {
            credentials: 'include'
        });
    }

    // Rafraîchir le token toutes les 30 minutes
    setInterval(refreshCsrfToken, 30 * 60 * 1000);
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\front\boutique\index.blade.php ENDPATH**/ ?>