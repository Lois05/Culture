<?php $__env->startSection('title', 'À propos - Bénin Culture'); ?>

<?php $__env->startPush('styles'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    :root {
        --benin-red: #E8112D;
        --benin-yellow: #FCD116;
        --benin-green: #008751;
        --benin-dark: #0A0F2D;
        --gradient-benin: linear-gradient(135deg, #E8112D, #FCD116, #008751);
        --neon-glow: 0 0 20px rgba(232, 17, 45, 0.4),
                     0 0 40px rgba(252, 209, 22, 0.3),
                     0 0 60px rgba(0, 135, 81, 0.2);
    }

    /* Cinematic Hero */
    .cinematic-hero {
        position: relative;
        min-height: 100vh;
        background: linear-gradient(135deg,
                    rgba(10, 15, 45, 0.95) 0%,
                    rgba(232, 17, 45, 0.85) 40%,
                    rgba(252, 209, 22, 0.8) 100%),
                    url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        overflow: hidden;
        margin-top: -80px;
        padding-top: 80px;
    }

    .hero-particles {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        padding: 8rem 0;
    }

    .hero-title {
        font-size: 5rem;
        font-weight: 900;
        background: linear-gradient(135deg, #fff, #FCD116, #E8112D);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        margin-bottom: 1.5rem;
        line-height: 1.1;
    }

    /* Interactive Counter Cards */
    .counter-3d {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        transform-style: preserve-3d;
    }

    .counter-3d::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: 0.5s;
    }

    .counter-3d:hover::before {
        left: 100%;
    }

    .counter-3d:hover {
        transform: translateY(-20px) rotateX(5deg);
        box-shadow: var(--neon-glow);
    }

    .counter-number {
        font-size: 4.5rem;
        font-weight: 900;
        background: var(--gradient-benin);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    /* Holographic Value Cards */
    .holographic-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        padding: 3rem;
        border: 1px solid rgba(232, 17, 45, 0.1);
        position: relative;
        overflow: hidden;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }

    .holographic-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(232, 17, 45, 0.1), transparent);
        transition: 0.5s;
    }

    .holographic-card:hover::before {
        left: 100%;
    }

    .holographic-card:hover {
        transform: translateY(-15px) rotateY(5deg);
        box-shadow: 0 40px 80px rgba(232, 17, 45, 0.2);
    }

    .card-icon-3d {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        font-size: 3rem;
        position: relative;
        transition: all 0.6s ease;
    }

    .holographic-card:hover .card-icon-3d {
        transform: scale(1.2) rotate(360deg);
    }

    /* Interactive Timeline */
    .interactive-timeline {
        position: relative;
        padding: 4rem 0;
    }

    .timeline-beam {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 100%;
        background: var(--gradient-benin);
        box-shadow: var(--neon-glow);
    }

    .timeline-node {
        position: relative;
        margin-bottom: 4rem;
        width: 45%;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .timeline-node.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .timeline-node:nth-child(odd) {
        margin-left: 55%;
    }

    .timeline-node:nth-child(even) {
        margin-right: 55%;
    }

    .timeline-dot {
        position: absolute;
        top: 20px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: white;
        border: 4px solid var(--benin-red);
        box-shadow: var(--neon-glow);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .timeline-node:nth-child(odd) .timeline-dot {
        left: -45px;
    }

    .timeline-node:nth-child(even) .timeline-dot {
        right: -45px;
    }

    .timeline-dot:hover {
        transform: scale(1.5);
        background: var(--gradient-benin);
    }

    /* Team Swiper */
    .team-swiper {
        padding: 3rem 0;
    }

    .swiper-slide-team {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        transition: all 0.6s ease;
        height: auto;
    }

    .swiper-slide-team:hover {
        transform: translateY(-20px) scale(1.05);
        box-shadow: 0 40px 100px rgba(232, 17, 45, 0.2);
    }

    .team-image-hover {
        height: 300px;
        position: relative;
        overflow: hidden;
    }

    .team-image-hover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .swiper-slide-team:hover .team-image-hover img {
        transform: scale(1.1);
    }

    .team-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
        padding: 2rem;
        transform: translateY(100%);
        transition: transform 0.6s ease;
    }

    .swiper-slide-team:hover .team-overlay {
        transform: translateY(0);
    }

    /* Particle Partners */
    .partners-container {
        position: relative;
        height: 400px;
        perspective: 1000px;
    }

    .partner-particle {
        position: absolute;
        width: 120px;
        height: 120px;
        background: white;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.6s ease;
        animation: floatPartner 20s infinite ease-in-out;
        cursor: pointer;
    }

    @keyframes floatPartner {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(100px, -50px) rotate(90deg); }
        50% { transform: translate(0, -100px) rotate(180deg); }
        75% { transform: translate(-100px, -50px) rotate(270deg); }
    }

    .partner-particle:hover {
        transform: scale(1.5) rotate(360deg) !important;
        box-shadow: var(--neon-glow);
        z-index: 100;
    }

    /* Interactive CTA */
    .interactive-cta {
        position: relative;
        padding: 8rem 0;
        overflow: hidden;
    }

    .cta-portal {
        position: relative;
        width: 400px;
        height: 400px;
        margin: 0 auto;
        border-radius: 50%;
        background: var(--gradient-benin);
        display: flex;
        align-items: center;
        justify-content: center;
        animation: portalSpin 20s linear infinite,
                   portalPulse 3s ease-in-out infinite;
        box-shadow: var(--neon-glow),
                    inset 0 0 100px rgba(0, 0, 0, 0.5);
    }

    @keyframes portalSpin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes portalPulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.9; }
    }

    .portal-content {
        background: rgba(10, 15, 45, 0.95);
        width: 350px;
        height: 350px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 3rem;
        backdrop-filter: blur(20px);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .hero-title {
            font-size: 4rem;
        }

        .counter-number {
            font-size: 3.5rem;
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.8rem;
        }

        .cinematic-hero {
            min-height: 80vh;
            background-attachment: scroll;
        }

        .timeline-beam {
            left: 30px;
        }

        .timeline-node {
            width: 85%;
            margin-left: 15% !important;
            margin-right: 0 !important;
        }

        .timeline-node:nth-child(odd) .timeline-dot,
        .timeline-node:nth-child(even) .timeline-dot {
            left: -40px;
            right: auto;
        }

        .cta-portal {
            width: 300px;
            height: 300px;
        }

        .portal-content {
            width: 250px;
            height: 250px;
        }
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 12px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(10, 15, 45, 0.5);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--gradient-benin);
        border-radius: 6px;
        box-shadow: var(--neon-glow);
    }

    /* Loading Animation */
    .loading-spiral {
        width: 80px;
        height: 80px;
        border: 4px solid transparent;
        border-top: 4px solid var(--benin-red);
        border-right: 4px solid var(--benin-yellow);
        border-bottom: 4px solid var(--benin-green);
        border-radius: 50%;
        animation: spiralSpin 2s linear infinite;
    }

    @keyframes spiralSpin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Cinematic Hero -->
<section class="cinematic-hero">
    <div class="hero-particles" id="heroParticles"></div>
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="hero-title" data-aos="zoom-in" data-aos-duration="1500">
                    Bénin Culture
                </h1>
                <p class="lead text-white fs-2 mb-5" data-aos="fade-up" data-aos-delay="300">
                    <span class="text-warning">Préserver</span> • <span class="text-primary">Valoriser</span> • <span class="text-success">Transmettre</span>
                </p>
                <p class="text-white fs-4 mb-5" data-aos="fade-up" data-aos-delay="500" style="max-width: 800px; margin: 0 auto;">
                    La plateforme numérique immersive dédiée à la documentation et à la célébration
                    de la richesse culturelle et linguistique du Bénin.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-4" data-aos="fade-up" data-aos-delay="700">
                    <a href="#mission" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">
                        <i class="bi bi-compass me-2"></i>Découvrir notre mission
                    </a>
                    <a href="#equipe" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                        <i class="bi bi-people me-2"></i>Rencontrer l'équipe
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Counter Section -->
<section class="py-6 bg-dark">
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-3 fw-bold text-white mb-4" data-aos="fade-up">
                    Impact <span class="text-warning">Mesurable</span>
                </h2>
                <p class="text-white-50 lead" data-aos="fade-up" data-aos-delay="200">
                    Des chiffres qui racontent notre aventure collective
                </p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="counter-3d text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="counter-number" data-count="2458">0</div>
                    <p class="text-white mb-0">Trésors culturels documentés</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-3d text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="counter-number" data-count="1247">0</div>
                    <p class="text-white mb-0">Passeurs de mémoire actifs</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-3d text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="counter-number" data-count="12">0</div>
                    <p class="text-white mb-0">Régions explorées</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-3d text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="counter-number" data-count="53">0</div>
                    <p class="text-white mb-0">Langues préservées</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Holographic Mission Section -->
<section id="mission" class="py-6">
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-3 fw-bold mb-4" data-aos="fade-up">
                    Notre <span class="text-primary">Mission</span> & <span class="text-success">Valeurs</span>
                </h2>
                <p class="text-muted lead" data-aos="fade-up" data-aos-delay="200">
                    Les principes qui illuminent notre chemin
                </p>
            </div>
        </div>

        <div class="row g-4">
            <?php $__currentLoopData = [
                [
                    'title' => 'Valorisation Linguistique',
                    'description' => 'Donner une voix aux langues nationales comme véhicules authentiques de transmission culturelle et de préservation du patrimoine immatériel.',
                    'icon' => 'bi-translate',
                    'color' => 'linear-gradient(135deg, #E8112D, #FF3366)'
                ],
                [
                    'title' => 'Participation Communautaire',
                    'description' => 'Créer un espace collaboratif où chaque citoyen peut contribuer à enrichir la mémoire collective et partager ses connaissances traditionnelles.',
                    'icon' => 'bi-people',
                    'color' => 'linear-gradient(135deg, #FCD116, #FFD700)'
                ],
                [
                    'title' => 'Authenticité & Fiabilité',
                    'description' => 'Mettre en place des processus rigoureux de validation pour garantir l\'exactitude et la fiabilité des contenus partagés sur la plateforme.',
                    'icon' => 'bi-shield-check',
                    'color' => 'linear-gradient(135deg, #008751, #33CC99)'
                ],
                [
                    'title' => 'Accessibilité Universelle',
                    'description' => 'Rendre le patrimoine culturel béninois accessible à tous, partout dans le monde, grâce aux technologies numériques modernes.',
                    'icon' => 'bi-globe',
                    'color' => 'linear-gradient(135deg, #0D6EFD, #3366FF)'
                ],
                [
                    'title' => 'Transmission Intergénérationnelle',
                    'description' => 'Faciliter le dialogue entre les générations pour préserver les savoirs ancestraux et les adapter au monde contemporain.',
                    'icon' => 'bi-heart',
                    'color' => 'linear-gradient(135deg, #E8112D, #FCD116)'
                ],
                [
                    'title' => 'Innovation Numérique',
                    'description' => 'Utiliser les technologies les plus récentes pour documenter, archiver et diffuser le patrimoine culturel de manière innovante.',
                    'icon' => 'bi-lightbulb',
                    'color' => 'linear-gradient(135deg, #6F42C1, #9933CC)'
                ]
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo e(($index % 3) * 100); ?>">
                <div class="holographic-card">
                    <div class="card-icon-3d" style="background: <?php echo e($value['color']); ?>; color: white;">
                        <i class="bi <?php echo e($value['icon']); ?>"></i>
                    </div>
                    <h3 class="fw-bold mb-3 text-center"><?php echo e($value['title']); ?></h3>
                    <p class="text-muted mb-0 text-center"><?php echo e($value['description']); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Interactive Timeline -->
<section class="py-6 bg-dark">
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-3 fw-bold text-white mb-4" data-aos="fade-up">
                    Notre <span class="text-warning">Histoire</span>
                </h2>
                <p class="text-white-50 lead" data-aos="fade-up" data-aos-delay="200">
                    Le voyage qui nous a façonnés
                </p>
            </div>
        </div>

        <div class="interactive-timeline">
            <div class="timeline-beam"></div>

            <?php $__currentLoopData = [
                [
                    'date' => 'Janvier 2023',
                    'title' => 'L\'Inspiration',
                    'description' => 'Un groupe de passionnés se réunit autour d\'une vision commune : préserver la richesse culturelle béninoise grâce au numérique.',
                    'icon' => 'bi-lightbulb'
                ],
                [
                    'date' => 'Mars 2023',
                    'title' => 'Premières Consultations',
                    'description' => 'Rencontres avec les communautés locales, les gardiens de traditions et les experts pour co-construire notre approche.',
                    'icon' => 'bi-people'
                ],
                [
                    'date' => 'Juillet 2023',
                    'title' => 'Développement Immersif',
                    'description' => 'Création de la plateforme avec une équipe de développeurs béninois, en intégrant réalité augmentée et intelligence artificielle.',
                    'icon' => 'bi-code-slash'
                ],
                [
                    'date' => 'Novembre 2023',
                    'title' => 'Lancement Beta',
                    'description' => 'Version pilote avec 100 contributeurs et 500 contenus validés par notre comité scientifique interdisciplinaire.',
                    'icon' => 'bi-rocket-takeoff'
                ],
                [
                    'date' => 'Février 2024',
                    'title' => 'Révélation Publique',
                    'description' => 'Lancement officiel avec plus de 2,000 contenus culturels, couvrant l\'ensemble du territoire béninois.',
                    'icon' => 'bi-globe'
                ],
                [
                    'date' => 'Aujourd\'hui',
                    'title' => 'Impact Grandissant',
                    'description' => 'Communauté en pleine expansion, partenariats stratégiques et reconnaissance internationale.',
                    'icon' => 'bi-award'
                ]
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="timeline-node" data-aos="fade-<?php echo e($index % 2 == 0 ? 'left' : 'right'); ?>" data-aos-delay="<?php echo e($index * 100); ?>">
                <div class="timeline-dot" onclick="showTimelineDetails(<?php echo e($index); ?>)"></div>
                <div class="holographic-card">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle p-3 me-3" style="background: var(--gradient-benin);">
                            <i class="bi <?php echo e($milestone['icon']); ?> text-white fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1"><?php echo e($milestone['title']); ?></h4>
                            <span class="text-primary"><?php echo e($milestone['date']); ?></span>
                        </div>
                    </div>
                    <p class="text-muted mb-0"><?php echo e($milestone['description']); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Team Swiper -->
<section id="equipe" class="py-6">
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-3 fw-bold mb-4" data-aos="fade-up">
                    L\'Âme de <span class="text-primary">Bénin Culture</span>
                </h2>
                <p class="text-muted lead" data-aos="fade-up" data-aos-delay="200">
                    Les passionnés qui donnent vie à notre mission
                </p>
            </div>
        </div>

        <div class="team-swiper" data-aos="zoom-in">
            <div class="swiper teamSwiper">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = [
                        [
                            'name' => 'Kofi Adjo',
                            'role' => 'Directeur & Historien',
                            'bio' => 'Spécialiste du Royaume de Danxomè, auteur de plusieurs ouvrages sur les traditions béninoises.',
                            'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80',
                            'social' => ['facebook', 'twitter', 'linkedin']
                        ],
                        [
                            'name' => 'Amina Sika',
                            'role' => 'Responsable Linguistique',
                            'bio' => 'Linguiste spécialisée dans les langues goun et fon, experte en documentation des langues en danger.',
                            'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?auto=format&fit=crop&w=800&q=80',
                            'social' => ['facebook', 'twitter', 'linkedin']
                        ],
                        [
                            'name' => 'Sekou Touré',
                            'role' => 'Responsable Technologie',
                            'bio' => 'Développeur full-stack avec 10 ans d\'expérience, passionné par l\'utilisation de la tech pour la culture.',
                            'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=800&q=80',
                            'social' => ['github', 'twitter', 'linkedin']
                        ],
                        [
                            'name' => 'Fatou Diop',
                            'role' => 'Responsable Communauté',
                            'bio' => 'Anthropologue sociale, spécialiste des communautés rurales et des méthodes de collecte participative.',
                            'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=800&q=80',
                            'social' => ['facebook', 'instagram', 'linkedin']
                        ],
                        [
                            'name' => 'Chukwuma Okoro',
                            'role' => 'Designer Immersif',
                            'bio' => 'Designer UX/UI spécialisé dans les expériences interactives et la réalité augmentée.',
                            'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=800&q=80',
                            'social' => ['dribbble', 'behance', 'linkedin']
                        ],
                        [
                            'name' => 'Zara Bello',
                            'role' => 'Archiviste Numérique',
                            'bio' => 'Experte en préservation numérique et gestion de contenu culturel.',
                            'image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80',
                            'social' => ['twitter', 'instagram', 'linkedin']
                        ]
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide swiper-slide-team">
                        <div class="team-image-hover">
                            <img src="<?php echo e($member['image']); ?>" alt="<?php echo e($member['name']); ?>">
                            <div class="team-overlay">
                                <div class="d-flex gap-2">
                                    <?php $__currentLoopData = $member['social']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="#" class="rounded-circle bg-white p-2 text-dark">
                                        <i class="bi bi-<?php echo e($platform); ?>"></i>
                                    </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h5 class="fw-bold mb-1"><?php echo e($member['name']); ?></h5>
                            <p class="text-primary mb-3"><?php echo e($member['role']); ?></p>
                            <p class="text-muted small mb-0"><?php echo e($member['bio']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>

<!-- Floating Partners -->
<section class="py-6 bg-dark">
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-3 fw-bold text-white mb-4" data-aos="fade-up">
                    Nos <span class="text-warning">Alliés</span>
                </h2>
                <p class="text-white-50 lead" data-aos="fade-up" data-aos-delay="200">
                    Des institutions qui croient en notre vision
                </p>
            </div>
        </div>

        <div class="partners-container" data-aos="fade-up">
            <?php $__currentLoopData = [
                ['name' => 'Ministère de la Culture', 'icon' => 'bi-building'],
                ['name' => 'Université d\'Abomey-Calavi', 'icon' => 'bi-book'],
                ['name' => 'UNESCO Bénin', 'icon' => 'bi-globe'],
                ['name' => 'Fondation Culture Bénin', 'icon' => 'bi-bank'],
                ['name' => 'Radio Nationale', 'icon' => 'bi-megaphone'],
                ['name' => 'TV Bénin Culture', 'icon' => 'bi-camera-reels'],
                ['name' => 'Archives Nationales', 'icon' => 'bi-archive'],
                ['name' => 'Associations Culturelles', 'icon' => 'bi-people']
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="partner-particle" style="
                top: <?php echo e(rand(10, 70)); ?>%;
                left: <?php echo e(rand(10, 80)); ?>%;
                animation-delay: <?php echo e($index * 2.5); ?>s;
                z-index: <?php echo e($index); ?>;
            ">
                <i class="bi <?php echo e($partner['icon']); ?> fs-1" style="color: <?php echo e($index == 0 ? '#E8112D' :
                    ($index == 1 ? '#FCD116' :
                    ($index == 2 ? '#008751' :
                    ($index == 3 ? '#0D6EFD' :
                    ($index == 4 ? '#6F42C1' :
                    ($index == 5 ? '#20C997' :
                    ($index == 6 ? '#FD7E14' : '#000000'))))))); ?>"></i>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Interactive CTA Portal -->
<section class="interactive-cta bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-4 fw-bold text-white mb-5" data-aos="fade-up">
                    Prêt à <span class="text-warning">Rejoindre</span> l\'Aventure ?
                </h2>

                <div class="cta-portal" data-aos="zoom-in" data-aos-duration="2000">
                    <div class="portal-content">
                        <i class="bi bi-rocket-takeoff display-1 text-white mb-4"></i>
                        <h3 class="text-white fw-bold mb-3">Décollage Immédiat</h3>
                        <p class="text-white-50 mb-4">
                            Contribuez à préserver le patrimoine béninois
                        </p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="<?php echo e(route('front.inscription')); ?>" class="btn btn-light rounded-pill px-4">
                                <i class="bi bi-person-plus me-2"></i>S'inscrire
                            </a>
                            <a href="<?php echo e(route('dashboard.contribuer')); ?>" class="btn btn-outline-light rounded-pill px-4">
                                <i class="bi bi-chat me-2"></i>Nous contacter
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row mt-6">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="counter-3d text-center">
                            <i class="bi bi-people display-4 text-warning mb-3"></i>
                            <h5 class="text-white fw-bold">Communauté Active</h5>
                            <p class="text-white-50">1,247 contributeurs passionnés</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="counter-3d text-center">
                            <i class="bi bi-award display-4 text-primary mb-3"></i>
                            <h5 class="text-white fw-bold">Reconnaissance</h5>
                            <p class="text-white-50">Prix d'excellence culturelle 2024</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                        <div class="counter-3d text-center">
                            <i class="bi bi-globe-americas display-4 text-success mb-3"></i>
                            <h5 class="text-white fw-bold">Portée Internationale</h5>
                            <p class="text-white-50">Visiteurs de 85 pays différents</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser AOS
    AOS.init({
        duration: 1200,
        once: false,
        mirror: true
    });

    // Initialiser les particules
    if (document.getElementById('heroParticles')) {
        particlesJS('heroParticles', {
            particles: {
                number: { value: 100, density: { enable: true, value_area: 800 } },
                color: { value: ["#E8112D", "#FCD116", "#008751"] },
                shape: { type: "circle" },
                opacity: { value: 0.5, random: true },
                size: { value: 4, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#FCD116",
                    opacity: 0.2,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 3,
                    direction: "none",
                    random: true,
                    straight: false,
                    out_mode: "out",
                    bounce: false
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: { enable: true, mode: "repulse" },
                    onclick: { enable: true, mode: "push" }
                }
            }
        });
    }

    // Animer les compteurs
    const counters = document.querySelectorAll('.counter-number');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-count')) || 0;
        let current = 0;
        const increment = target / 60;

        const updateCounter = () => {
            current += increment;
            if (current >= target) {
                counter.textContent = target.toLocaleString();
            } else {
                counter.textContent = Math.floor(current).toLocaleString();
                requestAnimationFrame(updateCounter);
            }
        };
        updateCounter();
    });

    // Initialiser le swiper de l'équipe
    const teamSwiper = new Swiper('.teamSwiper', {
        loop: true,
        autoplay: {
            delay: 3000,
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
            640: { slidesPerView: 2 },
            768: { slidesPerView: 3 },
            1024: { slidesPerView: 4 },
        },
    });

    // Timeline interactive
    const timelineNodes = document.querySelectorAll('.timeline-node');
    const timelineObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.2 });

    timelineNodes.forEach(node => timelineObserver.observe(node));

    // Fonction pour afficher les détails de la timeline
    window.showTimelineDetails = function(index) {
        const milestones = [
            {
                title: 'L\'Inspiration',
                details: 'Inspirés par la richesse culturelle du Bénin et constatant la fragilité de sa transmission, nous avons imaginé une plateforme qui utilise la technologie pour préserver et célébrer notre patrimoine.',
                image: 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?auto=format&fit=crop&w=800&q=80'
            },
            {
                title: 'Premières Consultations',
                details: 'Nous avons parcouru les 12 régions du Bénin pour rencontrer les gardiens de traditions, les anciens, les artistes et les communautés locales. Ces échanges ont formé le socle de notre approche collaborative.',
                image: 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=800&q=80'
            },
            {
                title: 'Développement Immersif',
                details: 'Notre équipe de développeurs béninois a travaillé pendant 6 mois pour créer une plateforme intuitive, multilingue et immersive, intégrant les dernières technologies pour une expérience utilisateur exceptionnelle.',
                image: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80'
            },
            {
                title: 'Lancement Beta',
                details: 'Avec 100 contributeurs pilotes sélectionnés pour leur expertise, nous avons testé et amélioré la plateforme pendant 3 mois, validant plus de 500 contenus culturels authentiques.',
                image: 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?auto=format&fit=crop&w=800&q=80'
            },
            {
                title: 'Révélation Publique',
                details: 'Le lancement officiel a été célébré dans les 12 chefs-lieux de région avec des cérémonies traditionnelles, marquant le début d\'une nouvelle ère pour la préservation numérique du patrimoine béninois.',
                image: 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80'
            },
            {
                title: 'Impact Grandissant',
                details: 'Notre communauté s\'étend chaque jour, avec des partenariats internationaux et une reconnaissance croissante pour notre approche innovante de préservation culturelle.',
                image: 'https://images.unsplash.com/photo-1530099486328-02157378201b?auto=format&fit=crop&w=800&q=80'
            }
        ];

        const milestone = milestones[index];
        const modalHTML = `
            <div class="modal fade" id="timelineModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px);">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold">${milestone.title}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <img src="${milestone.image}" class="img-fluid h-100" style="object-fit: cover;">
                                </div>
                                <div class="col-md-6 p-4">
                                    <p class="text-muted">${milestone.details}</p>
                                    <div class="mt-4">
                                        <h6 class="fw-bold mb-3">Impact de cette étape :</h6>
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Validation de notre modèle</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Expansion de notre réseau</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Renforcement des partenariats</li>
                                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Amélioration continue</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Créer et afficher le modal
        const modalContainer = document.getElementById('timelineModalContainer');
        if (!modalContainer) {
            const container = document.createElement('div');
            container.id = 'timelineModalContainer';
            document.body.appendChild(container);
        }
        document.getElementById('timelineModalContainer').innerHTML = modalHTML;

        const modal = new bootstrap.Modal(document.getElementById('timelineModal'));
        modal.show();
    };

    // Animation des particules partenaires
    const partnerParticles = document.querySelectorAll('.partner-particle');
    partnerParticles.forEach(particle => {
        particle.addEventListener('mouseenter', function() {
            this.style.animationPlayState = 'paused';
        });

        particle.addEventListener('mouseleave', function() {
            this.style.animationPlayState = 'running';
        });
    });

    // Effet de parallaxe sur le défilement
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.parallax');

        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.5;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });

        // Animer les cartes au défilement
        const cards = document.querySelectorAll('.holographic-card');
        cards.forEach((card, index) => {
            const cardTop = card.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (cardTop < windowHeight * 0.8) {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0) rotateY(0)';
            }
        });
    });

    // Effet de son pour les interactions
    const clickSound = new Audio('https://assets.mixkit.co/sfx/preview/mixkit-select-click-1109.mp3');
    clickSound.volume = 0.3;

    document.querySelectorAll('.counter-3d, .timeline-dot, .partner-particle').forEach(element => {
        element.addEventListener('click', () => {
            clickSound.currentTime = 0;
            clickSound.play();
        });
    });

    // Mode sombre/clair (optionnel)
    const themeToggle = document.createElement('button');
    themeToggle.className = 'btn btn-primary position-fixed bottom-3 right-3 rounded-circle p-3 z-3';
    themeToggle.innerHTML = '<i class="bi bi-moon-stars"></i>';
    themeToggle.style.zIndex = '1000';
    document.body.appendChild(themeToggle);

    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('light-mode');
        themeToggle.innerHTML = document.body.classList.contains('light-mode')
            ? '<i class="bi bi-sun"></i>'
            : '<i class="bi bi-moon-stars"></i>';
    });

    // CSS pour le mode clair
    const lightModeStyle = document.createElement('style');
    lightModeStyle.textContent = `
        .light-mode .holographic-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(232, 17, 45, 0.2);
        }

        .light-mode .counter-3d {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(232, 17, 45, 0.1);
        }
    `;
    document.head.appendChild(lightModeStyle);
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\front\apropos.blade.php ENDPATH**/ ?>