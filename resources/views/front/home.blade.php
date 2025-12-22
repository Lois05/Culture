@extends('layouts.layout_front')

@section('title', 'Accueil - Bénin Culture')

@section('content')
    <!-- Hero Section Parfaite -->
    <section class="hero-section">
        <!-- Carousel Hero -->
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="hero-slide-image"
                         style="background-image: url('https://res.cloudinary.com/drzud4wye/image/upload/v1765979252/discoverbenin_vq9mik.jpg');">
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="hero-slide-image"
                         style="background-image: url('https://res.cloudinary.com/drzud4wye/image/upload/v1765979182/fresque_s4pcmz.jpg');">
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="hero-slide-image"
                         style="background-image: url('https://res.cloudinary.com/drzud4wye/image/upload/v1765979213/routeesclave_n5fo3i.webp');">
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="carousel-item">
                    <div class="hero-slide-image"
                         style="background-image: url('https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg');">
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="carousel-item">
                    <div class="hero-slide-image"
                         style="background-image: url('https://res.cloudinary.com/drzud4wye/image/upload/v1765979195/mosqueeporto_hdaiki.jpg');">
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

        <!-- Contenu Hero Positionné Séparément -->
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
                                    <div class="stat-number">{{ $stats['total_contenus'] ?? 0 }}</div>
                                    <div class="stat-label">Contenus</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="stat-item">
                                    <div class="stat-number">{{ $stats['total_regions'] ?? 0 }}</div>
                                    <div class="stat-label">Régions</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-item">
                                    <div class="stat-number">{{ $stats['total_utilisateurs'] ?? 0 }}</div>
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
                        <a href="{{ route('dashboard.contribuer') }}" class="btn btn-hero-secondary">
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

    <!-- Histoire du Bénin - Timeline Interactive -->
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
                @php
                    $periods = [
                        [
                            'title' => 'Royaumes pré-coloniaux',
                            'period' => 'Avant 1894',
                            'icon' => 'bi-castle',
                            'image' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980140/royaumeabo_hiduap.webp',
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
                            'image' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765978489/ancientemps_dqc9bc.jpg',
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
                            'image' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980111/independancegraph_erzbdw.jpg',
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
                            'image' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980053/renaissance_js7sja.webp',
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
                            'image' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980083/contemporain_qces9z.webp',
                            'color' => '#198754',
                            'description' => 'Le renouveau démocratique ouvre une ère de revitalisation culturelle, avec une reconnaissance internationale croissante du patrimoine béninois et un dynamisme artistique et intellectuel remarquable.',
                            'highlights' => [
                                ['icon' => 'bi-globe', 'text' => 'Reconnaissance internationale'],
                                ['icon' => 'bi-palette', 'text' => 'Dynamisme artistique'],
                                ['icon' => 'bi-lightbulb', 'text' => 'Renaissance intellectuelle']
                            ]
                        ]
                    ];
                @endphp

                @foreach ($periods as $index => $period)
                    <div class="timeline-content {{ $index === 0 ? 'active' : '' }}" id="period-{{ $index }}">
                        <div class="timeline-card">
                            <div class="row g-0">
                                <!-- Image -->
                                <div class="col-lg-6">
                                    <div class="timeline-image-container">
                                        <img src="{{ $period['image'] }}"
                                             alt="{{ $period['title'] }}"
                                             onerror="this.src='https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg'">
                                        <div class="period-badge" style="background: {{ $period['color'] }};">
                                            <i class="bi {{ $period['icon'] }} me-2"></i>
                                            {{ $period['period'] }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Contenu -->
                                <div class="col-lg-6">
                                    <div class="timeline-text-content">
                                        <h3 class="timeline-title" style="color: {{ $period['color'] }};">
                                            {{ $period['title'] }}
                                        </h3>

                                        <div class="period-info">
                                            <div class="period-icon" style="border-color: {{ $period['color'] }}20; color: {{ $period['color'] }};">
                                                <i class="bi {{ $period['icon'] }}"></i>
                                            </div>
                                            <span class="period-date" style="border-color: {{ $period['color'] }}20; color: {{ $period['color'] }};">
                                                {{ $period['period'] }}
                                            </span>
                                        </div>

                                        <div class="timeline-description">
                                            <p>{{ $period['description'] }}</p>
                                        </div>

                                        <!-- Points clés -->
                                        <div class="timeline-highlights" style="border-color: {{ $period['color'] }}20;">
                                            <h5 style="color: {{ $period['color'] }};">
                                                <i class="bi bi-stars me-2"></i>
                                                Points clés de cette période
                                            </h5>
                                            @foreach ($period['highlights'] as $highlight)
                                                <div class="highlight-item">
                                                    <div class="highlight-icon" style="background: {{ $period['color'] }}10; color: {{ $period['color'] }};">
                                                        <i class="bi {{ $highlight['icon'] }}"></i>
                                                    </div>
                                                    <span class="fw-medium">{{ $highlight['text'] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
                        <span id="current-period">1/{{ count($periods) }}</span>
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

    <!-- Mission Interactive -->
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
                        <img src="hhttps://res.cloudinary.com/drzud4wye/image/upload/v1766156970/mamaafrica_vmmpcb.jpg"
                             alt="Mission Bénin Culture"
                             onerror="this.src='https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg'">
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
                <a href="{{ route('dashboard.contribuer') }}" class="btn btn-primary btn-lg px-5 py-3">
                    <i class="bi bi-plus-circle me-2"></i>Devenir contributeur
                </a>
            </div>
        </div>
    </section>

    <!-- Contenus Populaires - Style Pinterest -->
    <section id="populaires" class="contenus-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Contenus les plus populaires</h2>
                    <p class="section-subtitle">Découvrez les trésors culturels les plus appréciés par la communauté</p>
                </div>
            </div>

            @if(isset($contenusPopulaires) && $contenusPopulaires->count() > 0)
                <!-- Grille Pinterest -->
                <div class="pinterest-grid">
                    @foreach ($contenusPopulaires as $contenu)
                        @php
                            // 1. Récupérer l'image principale du contenu
                            if ($contenu->medias && $contenu->medias->count() > 0) {
                                $mainMedia = $contenu->medias->first();
                                $imageUrl = $mainMedia->cloudinary_url ?? $mainMedia->chemin;
                            } else {
                                $imageUrl = 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg';
                            }

                            // 2. Récupérer les infos de l'auteur
                            $author = $contenu->auteur ?? null;
                            $authorName = ($author->prenom ?? '') . ' ' . ($author->name ?? 'Anonyme');
                            $authorName = trim($authorName) ?: 'Anonyme';
                            $authorInitials = strtoupper(substr($authorName, 0, 1));

                            // 3. Photo de l'auteur
                            $authorPhoto = null;
                            if ($author) {
                                if (!empty($author->cloudinary_url)) {
                                    $authorPhoto = $author->cloudinary_url;
                                } elseif (!empty($author->photo)) {
                                    if (filter_var($author->photo, FILTER_VALIDATE_URL)) {
                                        $authorPhoto = $author->photo;
                                    } elseif (strpos($author->photo, 'storage/') === 0) {
                                        $authorPhoto = asset($author->photo);
                                    } else {
                                        $authorPhoto = asset('storage/' . $author->photo);
                                    }
                                }
                            }

                            // 4. Type de contenu
                            $typeName = $contenu->typeContenu->nom_contenu ?? 'Général';
                            $typeIcon = $contenu->typeContenu->icon ?? 'bi-star';
                            $typeColor = $contenu->typeContenu->color ?? '#FCD116';

                            // 5. Statistiques
                            $vuesCount = $contenu->vues_count ?? rand(500, 5000);
                            $commentairesCount = $contenu->commentaires_count ?? rand(5, 50);
                            $likesCount = $contenu->likes_count ?? rand(10, 200);
                            $sharesCount = rand(5, 100);

                            // 6. Région
                            $regionName = $contenu->region->nom_region ?? 'Bénin';

                            // 7. Date
                            $dateCreation = $contenu->date_creation ?? $contenu->created_at;
                            $dateFormatted = $dateCreation ? \Carbon\Carbon::parse($dateCreation)->diffForHumans() : '';

                            // 8. Description tronquée
                            $description = \Illuminate\Support\Str::limit(strip_tags($contenu->texte ?? ''), 120);
                        @endphp

                        <!-- Carte Pinterest -->
                        <div class="pin-card">
                            <!-- Image -->
                            <div class="pin-image">
                                <img src="{{ $imageUrl }}"
                                     alt="{{ $contenu->titre }}"
                                     onerror="this.onerror=null; this.src='https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg'">

                                <!-- Badge type -->
                                <div class="pin-type-badge" style="color: {{ $typeColor }};">
                                    <i class="bi {{ $typeIcon }}"></i>
                                    {{ $typeName }}
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
                                    {{ $regionName }}
                                </div>
                            </div>

                            <!-- Contenu -->
                            <div class="pin-content">
                                <!-- Titre -->
                                <h4 class="pin-title">
                                    <a href="{{ route('front.contenu', ['id' => $contenu->id_contenu]) }}">
                                        {{ \Illuminate\Support\Str::limit($contenu->titre, 70) }}
                                    </a>
                                </h4>

                                <!-- Description -->
                                <p class="pin-description">
                                    {{ $description }}
                                </p>

                                <!-- Auteur -->
                                <div class="pin-author">
                                    @if($authorPhoto)
                                        <div class="pin-author-avatar">
                                            <img src="{{ $authorPhoto }}"
                                                 alt="{{ $authorName }}"
                                                 onerror="this.onerror=null; this.classList.add('d-none'); this.nextElementSibling?.classList.remove('d-none')">
                                            <div class="author-initials d-none">
                                                {{ $authorInitials }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="author-initials">
                                            {{ $authorInitials }}
                                        </div>
                                    @endif
                                    <div class="pin-author-info">
                                        <h6>{{ $authorName }}</h6>
                                        <p>{{ $dateFormatted }}</p>
                                    </div>
                                </div>

                                <!-- Statistiques interactives -->
                                <div class="pin-stats">
                                    <div class="pin-stat like-stat">
                                        <i class="bi bi-heart"></i>
                                        <span class="pin-stat-count">{{ $likesCount }}</span>
                                        <span>J'aime</span>
                                    </div>
                                    <div class="pin-stat comment-stat">
                                        <i class="bi bi-chat"></i>
                                        <span class="pin-stat-count">{{ $commentairesCount }}</span>
                                        <span>Commentaires</span>
                                    </div>
                                    <div class="pin-stat share-stat">
                                        <i class="bi bi-share"></i>
                                        <span class="pin-stat-count">{{ $sharesCount }}</span>
                                        <span>Partages</span>
                                    </div>
                                </div>

                                <!-- Bouton Voir plus -->
                                <a href="{{ route('front.contenu', ['id' => $contenu->id_contenu]) }}" class="pin-read-btn">
                                    <i class="bi bi-book me-2"></i>Lire l'article
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Bouton Voir plus de contenus -->
                <div class="text-center mt-5">
                    <a href="{{ route('front.explorer') }}" class="btn btn-primary btn-lg px-5 py-3">
                        <i class="bi bi-compass me-2"></i>Explorer tous les contenus
                    </a>
                </div>
            @else
                <!-- Message quand il n'y a pas de contenus -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-stars display-1 text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Aucun contenu populaire pour le moment</h4>
                    <p class="text-muted mb-4">Soyez le premier à contribuer !</p>
                    <a href="{{ route('dashboard.contribuer') }}" class="btn btn-primary px-4 py-2">
                        <i class="bi bi-plus-circle me-2"></i>Ajouter un contenu
                    </a>
                </div>
            @endif
        </div>
    </section>

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
                            <a href="{{ route('front.inscription') }}" class="btn btn-light btn-lg px-5 py-3 me-3 mb-3">
                                <i class="bi bi-person-plus me-2"></i>Rejoindre la communauté
                            </a>
                            <a href="{{ route('dashboard.contribuer') }}" class="btn btn-outline-light btn-lg px-5 py-3 mb-3">
                                <i class="bi bi-plus-circle me-2"></i>Ajouter un contenu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
// Gestion des erreurs d'images
document.addEventListener('DOMContentLoaded', function() {
    // Fallback pour les images d'articles
    document.querySelectorAll('.pin-image img').forEach(img => {
        img.addEventListener('error', function() {
            this.src = 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg';
        });
    });

    // Fallback pour les photos d'auteur
    document.querySelectorAll('.pin-author-avatar img').forEach(img => {
        img.addEventListener('error', function() {
            this.style.display = 'none';
            const initials = this.nextElementSibling;
            if (initials && initials.classList.contains('author-initials')) {
                initials.classList.remove('d-none');
            }
        });
    });
});
</script>
@endsection
