<?php $__env->startSection('title', 'Accueil - Bénin Culture'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Carousel Hero -->
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="hero-slide-image"
                         style="background-image: url('<?php echo e(App\Helpers\ImageHelper::local('hero1')); ?>');">
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="hero-slide-image"
                         style="background-image: url('<?php echo e(asset('adminlte/img/ouidah.jpeg')); ?>');">
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="hero-slide-image"
                         style="background-image: url('<?php echo e(App\Helpers\ImageHelper::local('hero3')); ?>');">
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="carousel-item">
                    <div class="hero-slide-image"
                         style="background-image: url('<?php echo e(App\Helpers\ImageHelper::local('hero4')); ?>');">
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="carousel-item">
                    <div class="hero-slide-image"
                         style="background-image: url('<?php echo e(App\Helpers\ImageHelper::local('hero5')); ?>');">
                    </div>
                </div>
            </div>

            <!-- Contrôles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>

            <!-- Indicateurs -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4"></button>
            </div>
        </div>

        <!-- Contenu Hero -->
        <div class="hero-content-container">
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title animate__animated animate__fadeInDown">
                        La richesse culturelle<br>du Bénin réinventée
                    </h1>

                    <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                        Explorez les trésors d'une civilisation millénaire, des traditions ancestrales
                        aux expressions contemporaines
                    </p>

                    <!-- Statistiques -->
                    <div class="hero-statistics animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="row text-center">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="stat-item">
                                    <div class="stat-number"><?php echo e($stats['total_contenus'] ?? 0); ?></div>
                                    <div class="stat-label">Contenus</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="stat-item">
                                    <div class="stat-number"><?php echo e($stats['total_regions'] ?? 0); ?></div>
                                    <div class="stat-label">Régions</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-item">
                                    <div class="stat-number"><?php echo e($stats['total_utilisateurs'] ?? 0); ?></div>
                                    <div class="stat-label">Contributeurs</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="hero-actions animate__animated animate__fadeInUp animate__delay-3s">
                        <a href="#populaires" class="btn btn-hero-primary">
                            <i class="bi bi-compass me-2"></i>Explorer la culture
                        </a>
                        <a href="<?php echo e(route('dashboard.contribuer')); ?>" class="btn btn-hero-secondary">
                            <i class="bi bi-plus-circle me-2"></i>Contribuer
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="scroll-indicator">
            <a href="#histoire">
                <span>Découvrir l'histoire</span>
                <i class="bi bi-chevron-down fs-4"></i>
            </a>
        </div>
    </section>

    <!-- Timeline -->
    <section id="histoire" class="timeline-section">
        <div class="container">
            <div class="timeline-header">
                <span class="badge">
                    <i class="bi bi-clock-history me-2"></i>Chronologie historique
                </span>
                <h2>L'Histoire du Bénin à travers les âges</h2>
                <p>Explorez les périodes fascinantes qui ont façonné l'identité culturelle béninoise</p>
            </div>

            <!-- Navigation Timeline -->
            <div class="timeline-navigation">
                <div class="timeline-nav-buttons">
                    <button class="timeline-nav-btn active" data-period="0">
                        <i class="bi bi-castle"></i>
                        <span>Royaumes pré-coloniaux</span>
                    </button>
                    <button class="timeline-nav-btn" data-period="1">
                        <i class="bi bi-flag"></i>
                        <span>Période coloniale</span>
                    </button>
                    <button class="timeline-nav-btn" data-period="2">
                        <i class="bi bi-star"></i>
                        <span>Indépendance</span>
                    </button>
                    <button class="timeline-nav-btn" data-period="3">
                        <i class="bi bi-arrow-repeat"></i>
                        <span>Renaissance culturelle</span>
                    </button>
                    <button class="timeline-nav-btn" data-period="4">
                        <i class="bi bi-globe"></i>
                        <span>Bénin contemporain</span>
                    </button>
                </div>
            </div>

            <!-- Contenu Timeline -->
            <div class="timeline-content-wrapper">
                <?php
                    $periods = [
                        [
                            'title' => 'Royaumes pré-coloniaux',
                            'period' => 'Avant 1894',
                            'icon' => 'bi-castle',
                            'image' => 'ancientemps.jpg',
                            'color' => '#E8112D',
                            'description' => 'Les grands royaumes de Danxomè, Porto-Novo et divers royaumes Yoruba établissent les fondations de la culture béninoise moderne avec leurs systèmes politiques, artistiques et spirituels complexes.',
                            'highlights' => [
                                ['icon' => 'bi-shield-check', 'text' => 'Fondation des royaumes'],
                                ['icon' => 'bi-people', 'text' => 'Systèmes politiques complexes'],
                                ['icon' => 'bi-magic', 'text' => 'Traditions spirituelles']
                            ]
                        ],
                        [
                            'title' => 'Période coloniale',
                            'period' => '1894-1960',
                            'icon' => 'bi-flag',
                            'image' => 'coloniale.jpeg',
                            'color' => '#FCD116',
                            'description' => 'Le Dahomey français marque une période de transformation culturelle, avec l\'introduction de nouvelles langues, systèmes éducatifs et structures administratives qui influenceront durablement la société.',
                            'highlights' => [
                                ['icon' => 'bi-translate', 'text' => 'Introduction du français'],
                                ['icon' => 'bi-book', 'text' => 'Système éducatif'],
                                ['icon' => 'bi-building', 'text' => 'Structures administratives']
                            ]
                        ],
                        [
                            'title' => 'Indépendance',
                            'period' => '1960-1972',
                            'icon' => 'bi-star',
                            'image' => 'independancegraph.jpg',
                            'color' => '#0DCAF0',
                            'description' => 'Le 1er août 1960, le Dahomey accède à l\'indépendance. Une période de construction nationale et de redéfinition identitaire s\'ensuit, avec la recherche d\'un équilibre entre tradition et modernité.',
                            'highlights' => [
                                ['icon' => 'bi-flag', 'text' => 'Souveraineté nationale'],
                                ['icon' => 'bi-heart', 'text' => 'Identité culturelle'],
                                ['icon' => 'bi-arrow-left-right', 'text' => 'Tradition vs modernité']
                            ]
                        ],
                        [
                            'title' => 'Renaissance culturelle',
                            'period' => '1972-1990',
                            'icon' => 'bi-arrow-repeat',
                            'image' => 'renaissance.webp',
                            'color' => '#FD7E14',
                            'description' => 'La période révolutionnaire met l\'accent sur la valorisation des cultures locales, avec des réformes éducatives et culturelles visant à promouvoir les langues et traditions nationales.',
                            'highlights' => [
                                ['icon' => 'bi-megaphone', 'text' => 'Valorisation culturelle'],
                                ['icon' => 'bi-translate', 'text' => 'Langues nationales'],
                                ['icon' => 'bi-book', 'text' => 'Réformes éducatives']
                            ]
                        ],
                        [
                            'title' => 'Bénin contemporain',
                            'period' => '1990 à aujourd\'hui',
                            'icon' => 'bi-globe',
                            'image' => 'contemporain.webp',
                            'color' => '#198754',
                            'description' => 'Le renouveau démocratique ouvre une ère de revitalisation culturelle, avec une reconnaissance internationale croissante du patrimoine béninois et un dynamisme artistique et intellectuel remarquable.',
                            'highlights' => [
                                ['icon' => 'bi-globe', 'text' => 'Reconnaissance internationale'],
                                ['icon' => 'bi-palette', 'text' => 'Dynamisme artistique'],
                                ['icon' => 'bi-lightbulb', 'text' => 'Renaissance intellectuelle']
                            ]
                        ]
                    ];
                ?>

                <?php $__currentLoopData = $periods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="timeline-content <?php echo e($index === 0 ? 'active' : ''); ?>" id="period-<?php echo e($index); ?>">
                        <div class="timeline-card">
                            <div class="row g-0">
                                <!-- Image -->
                                <div class="col-lg-6">
                                    <div class="timeline-image-container">
                                        <img src="<?php echo e(asset('adminlte/img/' . $period['image'])); ?>"
                                             alt="<?php echo e($period['title']); ?>"
                                             onerror="this.src='<?php echo e(App\Helpers\ImageHelper::defaultContent()); ?>'">
                                        <div class="period-badge" style="background: <?php echo e($period['color']); ?>;">
                                            <i class="bi <?php echo e($period['icon']); ?> me-2"></i>
                                            <?php echo e($period['period']); ?>

                                        </div>
                                    </div>
                                </div>

                                <!-- Contenu -->
                                <div class="col-lg-6">
                                    <div class="timeline-text-content">
                                        <h3 class="timeline-title" style="color: <?php echo e($period['color']); ?>;">
                                            <?php echo e($period['title']); ?>

                                        </h3>

                                        <div class="period-info">
                                            <div class="period-icon" style="border-color: <?php echo e($period['color']); ?>20; color: <?php echo e($period['color']); ?>;">
                                                <i class="bi <?php echo e($period['icon']); ?>"></i>
                                            </div>
                                            <span class="period-date" style="border-color: <?php echo e($period['color']); ?>20; color: <?php echo e($period['color']); ?>;">
                                                <?php echo e($period['period']); ?>

                                            </span>
                                        </div>

                                        <div class="timeline-description">
                                            <p><?php echo e($period['description']); ?></p>
                                        </div>

                                        <!-- Points clés -->
                                        <div class="timeline-highlights" style="border-color: <?php echo e($period['color']); ?>20;">
                                            <h5 style="color: <?php echo e($period['color']); ?>;">
                                                <i class="bi bi-stars me-2"></i>
                                                Points clés de cette période
                                            </h5>
                                            <?php $__currentLoopData = $period['highlights']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="highlight-item">
                                                    <div class="highlight-icon" style="background: <?php echo e($period['color']); ?>10; color: <?php echo e($period['color']); ?>;">
                                                        <i class="bi <?php echo e($highlight['icon']); ?>"></i>
                                                    </div>
                                                    <span class="fw-medium"><?php echo e($highlight['text']); ?></span>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Contrôles de navigation -->
            <div class="timeline-controls">
                <button class="btn-prev-period">
                    <i class="bi bi-chevron-left me-2"></i>
                    Période précédente
                </button>
                <button class="btn-next-period">
                    Période suivante
                    <i class="bi bi-chevron-right ms-2"></i>
                </button>
            </div>

            <!-- Barre de progression -->
            <div class="timeline-progress">
                <div class="progress-info">
                    <div class="progress-label">
                        <span>Exploration historique</span>
                        <span id="current-period">1/<?php echo e(count($periods)); ?></span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 20%"></div>
                    </div>
                    <div class="progress-dates">
                        <span>Royaumes pré-coloniaux</span>
                        <span>Bénin contemporain</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission -->
    <section id="mission" class="mission-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <span class="badge bg-primary mb-3 px-4 py-2">
                        <i class="bi bi-bullseye me-2"></i>Notre Mission
                    </span>
                    <h2 class="display-5 fw-bold mb-3">Préserver et partager le patrimoine immatériel</h2>
                    <p class="lead text-muted fs-5">Notre engagement pour la valorisation de la culture béninoise</p>
                </div>
            </div>

            <div class="row g-5 align-items-center">
                <!-- Image Mission -->
                <div class="col-lg-6">
                    <div class="mission-image">
                        <img src="<?php echo e(asset('adminlte/img/beninwest.jpg') ?: App\Helpers\ImageHelper::defaultContent()); ?>"
                             alt="Mission Bénin Culture"
                             onerror="this.src='<?php echo e(App\Helpers\ImageHelper::defaultContent()); ?>'">
                        <div class="mission-image-overlay">
                            <h4>Culture Vivante</h4>
                            <p>Transmettre aux générations futures</p>
                        </div>
                    </div>
                </div>

                <!-- Cartes Mission -->
                <div class="col-lg-6">
                    <div class="row g-4">
                        <!-- Carte 1 -->
                        <div class="col-md-6">
                            <div class="mission-card">
                                <div class="mission-icon">
                                    <i class="bi bi-translate"></i>
                                </div>
                                <h4>Valoriser les langues locales</h4>
                                <p>Donner une place centrale au Fon, Yoruba, Dendi, Goun et autres langues nationales comme vecteurs authentiques de transmission culturelle.</p>
                                <ul class="mission-features">
                                    <li><i class="bi bi-check-circle-fill"></i>Traductions multilingues</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Audio et vidéo en langues locales</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Documentation linguistique</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Carte 2 -->
                        <div class="col-md-6">
                            <div class="mission-card">
                                <div class="mission-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h4>Participation communautaire</h4>
                                <p>Créer un espace où chaque Béninois peut contribuer à enrichir la mémoire collective et partager ses connaissances.</p>
                                <ul class="mission-features">
                                    <li><i class="bi bi-check-circle-fill"></i>Contributions ouvertes à tous</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Validation par les sages</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Récompenses et reconnaissance</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Carte 3 -->
                        <div class="col-12">
                            <div class="mission-card">
                                <div class="mission-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h4>Garantir l'authenticité</h4>
                                <p>Mettre en place un processus de validation rigoureux pour assurer la fiabilité et l'exactitude des contenus partagés.</p>
                                <ul class="mission-features">
                                    <li><i class="bi bi-check-circle-fill"></i>Vérification par experts</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Sources authentifiées</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Mise à jour continue</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bouton CTA -->
            <div class="text-center mt-5">
                <a href="<?php echo e(route('dashboard.contribuer')); ?>" class="btn btn-primary btn-lg px-5 py-3">
                    <i class="bi bi-plus-circle me-2"></i>Devenir contributeur
                </a>
            </div>
        </div>
    </section>

  <!-- Contenus Populaires - Home -->
<section id="populaires" class="contenus-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Contenus les plus populaires</h2>
                <p class="section-subtitle">Découvrez les trésors culturels les plus appréciés par la communauté</p>
            </div>
        </div>

        <?php if(isset($contenusPopulaires) && $contenusPopulaires->count() > 0): ?>
            <!-- Grille Pinterest -->
            <div class="pinterest-grid">
                <?php $__currentLoopData = $contenusPopulaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // IMAGE DU CONTENU
                        $imageUrl = App\Helpers\ImageHelper::getContentImage($contenu);

                        // INFOS AUTEUR
                        $author = $contenu->auteur ?? null;
                        $avatarInfo = App\Helpers\ImageHelper::getUserAvatarInfo($author);

                        $authorName = $avatarInfo['name'];
                        $authorInitials = $avatarInfo['initials'];
                        $authorPhoto = $avatarInfo['photo_url'];
                        $hasRealPhoto = $avatarInfo['has_photo'];
                        $avatarColor = $avatarInfo['color'];

                        // TYPE DE CONTENU
                        $typeName = $contenu->typeContenu->nom_contenu ?? 'Général';
                        $typeIcon = $contenu->typeContenu->icon ?? 'bi-star';
                        $typeColor = $contenu->typeContenu->color ?? '#FCD116';

                        // STATISTIQUES
                        $vuesCount = $contenu->vues_count ?? rand(500, 5000);
                        $commentairesCount = $contenu->commentaires_count ?? rand(5, 50);
                        $likesCount = $contenu->likes_count ?? rand(10, 200);
                        $sharesCount = rand(5, 100);

                        // RÉGION
                        $regionName = $contenu->region->nom_region ?? 'Bénin';

                        // DATE
                        $dateCreation = $contenu->date_creation ?? $contenu->created_at;
                        $dateFormatted = $dateCreation ? \Carbon\Carbon::parse($dateCreation)->diffForHumans() : '';

                        // DESCRIPTION
                        $description = \Illuminate\Support\Str::limit(strip_tags($contenu->texte ?? ''), 120);
                    ?>

                    <!-- Carte Pinterest -->
                    <div class="pin-card">
                        <!-- Image du contenu -->
                        <div class="pin-image">
                            <img src="<?php echo e($imageUrl); ?>"
                                 alt="<?php echo e($contenu->titre); ?>"
                                 onerror="this.src='<?php echo e(App\Helpers\ImageHelper::defaultContent()); ?>'">

                            <!-- Badge type -->
                            <div class="pin-type-badge" style="color: <?php echo e($typeColor); ?>;">
                                <i class="bi <?php echo e($typeIcon); ?>"></i>
                                <?php echo e($typeName); ?>

                            </div>

                            <!-- Actions Pinterest -->
                            <div class="pin-actions">
                                <button class="pin-action-btn like-btn" title="J'aime">
                                    <i class="bi bi-heart"></i>
                                </button>
                                <button class="pin-action-btn save-btn" title="Sauvegarder">
                                    <i class="bi bi-bookmark"></i>
                                </button>
                                <button class="pin-action-btn share-btn" title="Partager">
                                    <i class="bi bi-share"></i>
                                </button>
                            </div>

                            <!-- Badge région -->
                            <div class="pin-region-badge">
                                <i class="bi bi-geo-alt"></i>
                                <?php echo e($regionName); ?>

                            </div>
                        </div>

                        <!-- Contenu -->
                        <div class="pin-content">
                            <!-- Titre -->
                            <h4 class="pin-title">
                                <a href="<?php echo e(route('front.contenu', $contenu->id_contenu)); ?>"></a>
                                    <?php echo e(\Illuminate\Support\Str::limit($contenu->titre, 70)); ?>

                                </a>
                            </h4>

                            <!-- Description -->
                            <p class="pin-description">
                                <?php echo e($description); ?>

                            </p>

                           <!-- Auteur - VERSION SIMPLIFIÉE ET FONCTIONNELLE -->
<div class="pin-author">
    <div class="pin-author-avatar">
        <?php
            // Déterminer la classe de couleur basée sur la première lettre
            $colorMap = [
                'A' => 'avatar-initials-red',
                'B' => 'avatar-initials-yellow',
                'C' => 'avatar-initials-green',
                'D' => 'avatar-initials-purple',
                'E' => 'avatar-initials-blue',
                'F' => 'avatar-initials-red',
                'G' => 'avatar-initials-yellow',
                'H' => 'avatar-initials-green',
                'I' => 'avatar-initials-purple',
                'J' => 'avatar-initials-blue',
                'K' => 'avatar-initials-red',
                'L' => 'avatar-initials-yellow',
                'M' => 'avatar-initials-green',
                'N' => 'avatar-initials-purple',
                'O' => 'avatar-initials-blue',
                'P' => 'avatar-initials-red',
                'Q' => 'avatar-initials-yellow',
                'R' => 'avatar-initials-green',
                'S' => 'avatar-initials-purple',
                'T' => 'avatar-initials-blue',
                'U' => 'avatar-initials-red',
                'V' => 'avatar-initials-yellow',
                'W' => 'avatar-initials-green',
                'X' => 'avatar-initials-purple',
                'Y' => 'avatar-initials-blue',
                'Z' => 'avatar-initials-red'
            ];

            $firstLetter = strtoupper(substr($authorName, 0, 1));
            $avatarClass = $colorMap[$firstLetter] ?? 'avatar-initials-red';

            // Vérifier si on a une vraie photo
            $hasPhoto = $hasRealPhoto && !empty($authorPhoto) && filter_var($authorPhoto, FILTER_VALIDATE_URL);
        ?>

        <?php if($hasPhoto): ?>
            <img src="<?php echo e($authorPhoto); ?>"
                 alt="<?php echo e($authorName); ?>"
                 class="author-photo"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="author-initials <?php echo e($avatarClass); ?>" style="display: none !important;">
                <?php echo e($authorInitials); ?>

            </div>
        <?php else: ?>
            <div class="author-initials <?php echo e($avatarClass); ?>">
                <?php echo e($authorInitials); ?>

            </div>
        <?php endif; ?>
    </div>
    <div class="pin-author-info">
        <h6><?php echo e($authorName); ?></h6>
        <p><?php echo e($dateFormatted); ?></p>
    </div>
</div>

                            <!-- Statistiques -->
                            <div class="pin-stats">
                                <div class="pin-stat like-stat">
                                    <i class="bi bi-heart"></i>
                                    <span class="pin-stat-count"><?php echo e($likesCount); ?></span>
                                    <span>J'aime</span>
                                </div>
                                <div class="pin-stat comment-stat">
                                    <i class="bi bi-chat"></i>
                                    <span class="pin-stat-count"><?php echo e($commentairesCount); ?></span>
                                    <span>Commentaires</span>
                                </div>
                                <div class="pin-stat share-stat">
                                    <i class="bi bi-share"></i>
                                    <span class="pin-stat-count"><?php echo e($sharesCount); ?></span>
                                    <span>Partages</span>
                                </div>
                            </div>

                            <!-- Bouton Voir plus -->
                            <a href="<?php echo e(route('front.contenu', ['id' => $contenu->id_contenu])); ?>" class="pin-read-btn">
                                <i class="bi bi-book me-2"></i>Lire l'article
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Bouton Voir plus de contenus -->
            <div class="text-center mt-5">
                <a href="<?php echo e(route('front.explorer')); ?>" class="btn btn-primary btn-lg px-5 py-3">
                    <i class="bi bi-compass me-2"></i>Explorer tous les contenus
                </a>
            </div>
        <?php else: ?>
            <!-- Message quand il n'y a pas de contenus -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-stars display-1 text-muted"></i>
                </div>
                <h4 class="text-muted mb-3">Aucun contenu populaire pour le moment</h4>
                <p class="text-muted mb-4">Soyez le premier à contribuer !</p>
                <a href="<?php echo e(route('dashboard.contribuer')); ?>" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-plus-circle me-2"></i>Ajouter un contenu
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Styles spécifiques pour les avatars dans HOME */
.pin-author {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.pin-author-avatar {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
}

.author-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid rgba(232, 17, 45, 0.2);
    display: block;
}

.author-initials {
    width: 100%;
    height: 100%;
    display: flex !important; /* FORCER l'affichage */
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: white;
    font-size: 14px;
    border-radius: 50%;
    text-transform: uppercase;
}

/* Couleurs spécifiques pour les initiales */
.avatar-initials-red { background: #E8112D; }
.avatar-initials-yellow { background: #FCD116; color: #333 !important; }
.avatar-initials-green { background: #008751; }
.avatar-initials-purple { background: #8B5CF6; }
.avatar-initials-blue { background: #6366F1; }

.pin-author-info h6 {
    font-size: 0.95rem;
    margin-bottom: 0.1rem;
    color: #333;
    font-weight: 600;
}

.pin-author-info p {
    font-size: 0.8rem;
    color: #888;
    margin-bottom: 0;
}
</style>

<style>
/* Styles CSS pour la section Pinterest */
.pinterest-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
}

.pin-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.pin-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.pin-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.pin-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease;
}

.pin-card:hover .pin-image img {
    transform: scale(1.05);
}

.pin-type-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255, 255, 255, 0.9);
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.pin-actions {
    position: absolute;
    top: 15px;
    right: 15px;
    display: flex;
    gap: 0.5rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.pin-card:hover .pin-actions {
    opacity: 1;
}

.pin-action-btn {
    background: white;
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
}

.pin-action-btn:hover {
    background: var(--primary, #E8112D);
    color: white;
}

.pin-region-badge {
    position: absolute;
    bottom: 15px;
    left: 15px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.pin-content {
    padding: 1.5rem;
}

.pin-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.pin-title a {
    color: #333;
    text-decoration: none;
}

.pin-title a:hover {
    color: var(--primary, #E8112D);
}

.pin-description {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 1.25rem;
}

.pin-read-btn {
    background: linear-gradient(135deg, #E8112D, #FF3366);
    color: white;
    text-decoration: none;
    font-weight: 600;
    display: block;
    width: 100%;
    text-align: center;
    padding: 0.75rem;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.pin-read-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(232, 17, 45, 0.2);
    color: white;
}

/* Styles pour les statistiques */
.pin-stats {
    border-top: 1px solid #eee;
}

.pin-stat {
    font-size: 0.9rem;
}

.pin-stat-count {
    font-weight: 600;
    color: #333;
}
</style>
    <!-- Quiz Culturel -->
    <section id="quiz" class="quiz-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="quiz-container">
                        <div class="quiz-header">
                            <i class="bi bi-trophy-fill"></i>
                            <h3>Quiz Culture Béninoise</h3>
                            <p>Répondez correctement aux questions pour débloquer des badges et gagner des points !</p>
                        </div>

                        <div class="quiz-progress mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary" id="quiz-progress">Prêt à commencer ?</span>
                                <span class="badge bg-primary">Culture Générale</span>
                            </div>
                            <div class="progress" style="height: 8px; background: rgba(255,255,255,0.1);">
                                <div class="progress-bar" style="width: 0%; background: var(--primary);"></div>
                            </div>
                        </div>

                        <h4 class="quiz-question" id="quiz-question">
                            Cliquez sur "Commencer" pour tester vos connaissances !
                        </h4>

                        <div id="quiz-options">
                            <!-- Les options seront générées dynamiquement -->
                        </div>

                        <div class="text-center mt-5">
                            <button onclick="initCulturalQuiz()" class="btn btn-primary px-5 py-3 quiz-start-btn">
                                <i class="bi bi-play-fill me-2"></i>Commencer le quiz
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Appel à l'action -->
    <section id="contribuer" class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <div class="cta-content">
                        <h2 class="cta-title">
                            Contribuez à préserver<br>notre héritage culturel
                        </h2>
                        <p class="lead mb-5 opacity-90" style="font-size: 1.3rem;">
                            Partagez vos connaissances, traduisez des contenus, ou enrichissez notre base avec vos médias.<br>
                            Ensemble, bâtissons la plus grande bibliothèque numérique de la culture béninoise.
                        </p>
                        <div class="cta-buttons">
                            <a href="<?php echo e(route('front.inscription')); ?>" class="btn btn-light btn-lg px-5 py-3 me-3 mb-3">
                                <i class="bi bi-person-plus me-2"></i>Rejoindre la communauté
                            </a>
                            <a href="<?php echo e(route('dashboard.contribuer')); ?>" class="btn btn-outline-light btn-lg px-5 py-3 mb-3">
                                <i class="bi bi-plus-circle me-2"></i>Ajouter un contenu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des erreurs d'images des contenus
    document.querySelectorAll('.pin-image img').forEach(img => {
        img.addEventListener('error', function() {
            this.src = '<?php echo e(App\Helpers\ImageHelper::defaultContent()); ?>';
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\front\home.blade.php ENDPATH**/ ?>