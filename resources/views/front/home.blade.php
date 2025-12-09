@extends('layouts.layout_front')

@section('title', 'Accueil - Bénin Culture')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="hero-content">
                        <h1 class="hero-title mb-4">
                            Découvrez la richesse<br>culturelle du Bénin
                        </h1>
                        <p class="lead mb-5" style="font-size: 1.5rem; opacity: 0.9;">
                            {{ $stats['total_contenus'] }} contenus, {{ $stats['total_regions'] }} régions,
                            {{ $stats['total_utilisateurs'] }} contributeurs
                        </p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="#populaires" class="btn btn-primary-custom btn-lg px-5 py-3">
                                <i class="bi bi-compass me-2"></i>Explorer
                            </a>
                            <a href="{{ route('dashboard.contribuer') }}" class="btn btn-outline-light btn-lg px-5 py-3">
                                <i class="bi bi-plus-circle me-2"></i>Contribuer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-5">
            <a href="#histoire" class="text-white text-decoration-none">
                <div class="d-flex flex-column align-items-center">
                    <span class="mb-2">Découvrir</span>
                    <i class="bi bi-chevron-down fs-4 floating"></i>
                </div>
            </a>
        </div>
    </section>

    <!-- Histoire du Bénin -->
    <section id="histoire" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">L'Histoire du Bénin à travers les âges</h2>
                    <p class="section-subtitle">Un voyage à travers les périodes qui ont façonné la culture béninoise</p>
                </div>
            </div>

            <!-- Timeline -->
            <div class="timeline">
                @php
                    $periods = [
                        [
                            'icon' => 'bi-castle',
                            'title' => 'Royaumes pré-coloniaux',
                            'period' => 'Avant 1894',
                            'color' => 'primary',
                            'content' =>
                                'Les grands royaumes de Danxomè, Porto-Novo et divers royaumes Yoruba établissent les fondements de la culture béninoise moderne avec leurs systèmes politiques, artistiques et spirituels complexes.',
                        ],
                        [
                            'icon' => 'bi-flag',
                            'title' => 'Période coloniale',
                            'period' => '1894-1960',
                            'color' => 'secondary',
                            'content' =>
                                'Le Dahomey français marque une période de transformation culturelle, avec l\'introduction de nouvelles langues, systèmes éducatifs et structures administratives qui influenceront durablement la société.',
                        ],
                        [
                            'icon' => 'bi-star',
                            'title' => 'Indépendance',
                            'period' => '1960-1972',
                            'color' => 'accent',
                            'content' =>
                                'Le 1er août 1960, le Dahomey accède à l\'indépendance. Une période de construction nationale et de redéfinition identitaire s\'ensuit, avec la recherche d\'un équilibre entre tradition et modernité.',
                        ],
                        [
                            'icon' => 'bi-arrow-repeat',
                            'title' => 'Renaissance culturelle',
                            'period' => '1972-1990',
                            'color' => 'warning',
                            'content' =>
                                'La période révolutionnaire met l\'accent sur la valorisation des cultures locales, avec des réformes éducatives et culturelles visant à promouvoir les langues et traditions nationales.',
                        ],
                        [
                            'icon' => 'bi-globe',
                            'title' => 'Bénin contemporain',
                            'period' => '1990 à aujourd\'hui',
                            'color' => 'success',
                            'content' =>
                                'Le renouveau démocratique ouvre une ère de revitalisation culturelle, avec une reconnaissance internationale croissante du patrimoine béninois et un dynamisme artistique et intellectuel remarquable.',
                        ],
                    ];
                @endphp

                @foreach ($periods as $index => $period)
                    <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}">
                        <div class="culture-card p-4 h-100">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-{{ $period['color'] }} rounded-circle p-3 me-3">
                                    <i class="bi {{ $period['icon'] }} fs-3 text-white"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0">{{ $period['title'] }}</h4>
                                    <span class="text-muted">{{ $period['period'] }}</span>
                                </div>
                            </div>
                            <p class="mb-0">{{ $period['content'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Mission du site -->
    <section id="mission" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="position-relative">
                        <div class="rounded-4 overflow-hidden shadow-lg">
                            <img src="{{ asset('adminlte/img/mamaafrica.jpg') }}" alt="Mission Bénin Culture"
                                class="img-fluid w-100" style="min-height: 500px; object-fit: cover;">
                        </div>
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary opacity-10 rounded-4">
                        </div>

                        <!-- Élément décoratif -->
                        <div class="position-absolute bottom-0 end-0 translate-middle-y me-n5">
                            <div class="bg-primary rounded-circle p-4 floating" style="animation-delay: 0.5s;">
                                <i class="bi bi-mic fs-2 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ps-lg-5">
                        <span class="badge bg-primary-custom mb-3 px-3 py-2"
                            style="background: var(--gradient-bg); color: white;">Notre Mission</span>
                        <h2 class="display-6 fw-bold mb-4">Préserver et partager le patrimoine immatériel</h2>

                        <div class="mission-item mb-4">
                            <div class="d-flex align-items-start mb-3">
                                <div class="bg-light rounded-circle p-3 me-3 shadow-sm">
                                    <i class="bi bi-translate text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold">Valoriser les langues locales</h5>
                                    <p class="text-muted mb-0">Donner une place centrale au Fon, Yoruba, Dendi, Goun et
                                        autres langues nationales comme vecteurs authentiques de transmission culturelle.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mission-item mb-4">
                            <div class="d-flex align-items-start mb-3">
                                <div class="bg-light rounded-circle p-3 me-3 shadow-sm">
                                    <i class="bi bi-people text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold">Favoriser la participation communautaire</h5>
                                    <p class="text-muted mb-0">Créer un espace où chaque Béninois peut contribuer à enrichir
                                        la mémoire collective et partager ses connaissances.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mission-item mb-4">
                            <div class="d-flex align-items-start mb-3">
                                <div class="bg-light rounded-circle p-3 me-3 shadow-sm">
                                    <i class="bi bi-shield-check text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold">Garantir l'authenticité</h5>
                                    <p class="text-muted mb-0">Mettre en place un processus de validation rigoureux pour
                                        assurer la fiabilité et l'exactitude des contenus partagés.</p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('dashboard.contribuer') }}" class="btn btn-primary-custom px-5 py-3 mt-3">
                            <i class="bi bi-plus-circle me-2"></i>Devenir contributeur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Carte interactive des régions -->
    <section id="carte" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Explorez la diversité régionale</h2>
                    <p class="section-subtitle">Cliquez sur une région pour découvrir ses spécificités culturelles</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div id="benin-map" style="height: 500px; border-radius: 12px; overflow: hidden; background: #f8f9fa;"></div>
                </div>

                <div class="col-lg-4">
                    <div class="culture-card p-4 h-100">
                        <h4 class="fw-bold mb-4">Régions culturelles du Bénin</h4>

                        <div class="region-list mb-4">
                            @foreach ($regionsPopulaires as $region)
                                <div class="region-item mb-3">
                                    <div class="d-flex align-items-center justify-content-between p-3 rounded-3"
                                        style="background: rgba(252, 209, 22, 0.1);">
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $region->nom_region }}</h6>
                                            <small class="text-muted">{{ $region->contenus_count }} contenus</small>
                                        </div>
                                        <span class="badge bg-primary">{{ $region->contenus_count }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Statistiques culturelles</h6>
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="display-6 fw-bold text-primary">{{ $stats['total_regions'] }}</div>
                                    <small class="text-muted">Régions</small>
                                </div>
                                <div class="col-4">
                                    <div class="display-6 fw-bold text-secondary">{{ $stats['total_contenus'] }}</div>
                                    <small class="text-muted">Contenus</small>
                                </div>
                                <div class="col-4">
                                    <div class="display-6 fw-bold text-accent">{{ $stats['total_utilisateurs'] }}</div>
                                    <small class="text-muted">Contributeurs</small>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('front.regions') }}" class="btn btn-outline-primary w-100 mt-4">
                            <i class="bi bi-map me-2"></i>Voir toutes les régions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contenus populaires -->
    <section id="populaires" class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Contenus les plus populaires</h2>
                    <p class="section-subtitle">Découvrez les trésors culturels les plus appréciés par la communauté</p>
                </div>
            </div>

            @if ($contenusPopulaires->count() > 0)
                <div class="row g-4">
                    @foreach ($contenusPopulaires as $contenu)
                        <div class="col-lg-4 col-md-6">
                            <div class="contenu-card h-100">
                                <!-- En-tête de la carte avec image -->
                                <div class="contenu-card-header position-relative overflow-hidden">
                                    <!-- Image -->
                                    <div class="contenu-card-img-container" style="height: 200px;">
                                        @if ($contenu->medias && $contenu->medias->first())
                                            <img src="{{ asset('storage/' . $contenu->medias->first()->chemin) }}"
                                                 class="contenu-card-img"
                                                 alt="{{ $contenu->titre }}"
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        @elseif ($contenu->cover_image)
                                            <img src="{{ asset('adminlte/img/' . $contenu->cover_image) }}"
                                                 class="contenu-card-img"
                                                 alt="{{ $contenu->titre }}"
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('adminlte/img/collage.png') }}"
                                                 class="contenu-card-img"
                                                 alt="{{ $contenu->titre }}"
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        @endif

                                        <!-- Overlay gradient -->
                                        <div class="contenu-card-overlay"></div>
                                    </div>

                                    <!-- Badge type -->
                                    <div class="contenu-card-badge">
                                        <span class="badge" style="background: {{ $contenu->typeContenu->couleur ?? '#FCD116' }}; color: white;">
                                            <i class="bi {{ $contenu->typeContenu->icone ?? 'bi-star' }} me-1"></i>
                                            {{ $contenu->typeContenu->nom_contenu ?? 'Général' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Corps de la carte -->
                                <div class="contenu-card-body p-4">
                                    <!-- Auteur -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="contenu-author-avatar me-3">
                                            @if ($contenu->author_photo_url)
                                                <img src="{{ asset('adminlte/img/' . $contenu->author_photo_url) }}"
                                                     alt="{{ $contenu->auteur->name ?? 'Auteur' }}"
                                                     style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                            @else
                                                <div class="contenu-avatar-initials"
                                                     style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--accent)); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                                    {{ substr($contenu->auteur->prenom ?? 'A', 0, 1) }}{{ substr($contenu->auteur->name ?? 'B', 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="contenu-author-info">
                                            <h6 class="contenu-author-name mb-0" style="font-size: 0.95rem; font-weight: 600;">
                                                {{ $contenu->auteur->prenom ?? '' }} {{ $contenu->auteur->name ?? 'Anonyme' }}
                                            </h6>
                                            <small class="contenu-post-date text-muted" style="font-size: 0.8rem;">
                                                {{ $contenu->created_at ? $contenu->created_at->diffForHumans() : '' }}
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Titre -->
                                    <h5 class="contenu-card-title mb-3" style="font-size: 1.25rem; font-weight: 700;">
                                        <a href="{{ route('front.contenu', ['id' => $contenu->id_contenu]) }}"
                                           class="text-decoration-none text-dark">
                                            {{ Str::limit($contenu->titre, 60) }}
                                        </a>
                                    </h5>

                                    <!-- Description -->
                                    <p class="contenu-card-text text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6;">
                                        {{ Str::limit(strip_tags($contenu->texte), 120) }}
                                    </p>

                                    <!-- Métadonnées -->
                                    <div class="contenu-card-meta d-flex justify-content-between align-items-center">
                                        <!-- Statistiques -->
                                        <div class="contenu-stats d-flex align-items-center gap-3">
                                            <span class="contenu-stat-item" style="font-size: 0.9rem;">
                                                <i class="bi bi-eye me-1"></i>
                                                <span>{{ $contenu->vues_count ?? 0 }}</span>
                                            </span>
                                            <span class="contenu-stat-item" style="font-size: 0.9rem;">
                                                <i class="bi bi-chat me-1"></i>
                                                <span>{{ $contenu->commentaires_count ?? 0 }}</span>
                                            </span>
                                            <span class="contenu-stat-item" style="font-size: 0.9rem;">
                                                <i class="bi bi-heart me-1"></i>
                                                <span id="like-count-{{ $contenu->id_contenu }}">
                                                    {{ $contenu->likes_count ?? 0 }}
                                                </span>
                                            </span>
                                        </div>

                                        <!-- Langue -->
                                        <div class="contenu-language-badge">
                                            <span class="badge bg-light text-dark">
                                                <i class="bi bi-translate me-1"></i>
                                                {{ $contenu->langue->nom_langue ?? 'Français' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Région -->
                                    <div class="contenu-region mt-3 pt-3 border-top">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-geo-alt text-primary me-2"></i>
                                            <span class="contenu-region-name" style="font-size: 0.9rem;">
                                                {{ $contenu->region->nom_region ?? 'Bénin' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-book display-1 text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Aucun contenu populaire pour le moment</h4>
                    <p class="text-muted mb-4">Soyez le premier à contribuer !</p>
                    <a href="{{ route('dashboard.contribuer') }}" class="btn btn-primary-custom">
                        <i class="bi bi-plus-circle me-2"></i>Ajouter un contenu
                    </a>
                </div>
            @endif

            <div class="text-center mt-5">
                <a href="{{ route('front.explorer') }}" class="btn btn-primary-custom px-5 py-3">
                    <i class="bi bi-compass me-2"></i>Explorer tous les contenus
                </a>
            </div>
        </div>
    </section>

    <!-- Quiz culturel -->
    <section id="quiz" class="py-5 bg-dark">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title text-white">Testez vos connaissances</h2>
                    <p class="section-subtitle text-white-50">Découvrez la culture béninoise à travers notre quiz
                        interactif</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="quiz-section">
                        <div class="quiz-content">
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <i class="bi bi-trophy-fill fs-1" style="color: var(--primary);"></i>
                                </div>
                                <h3 class="mb-3">Quiz Culture Béninoise</h3>
                                <p class="opacity-75 mb-4">Répondez correctement aux questions pour débloquer des badges et
                                    gagner des points !</p>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-primary" id="quiz-progress">Prêt à commencer ?</span>
                                    <span class="badge" style="background: var(--primary);">Culture Générale</span>
                                </div>
                                <div class="progress" style="height: 8px; background: rgba(255,255,255,0.1);">
                                    <div class="progress-bar" style="width: 0%; background: var(--primary);"></div>
                                </div>
                            </div>

                            <h4 class="quiz-question mb-4" id="quiz-question">
                                Cliquez sur "Commencer" pour tester vos connaissances !
                            </h4>

                            <div id="quiz-options">
                                <!-- Les options seront générées dynamiquement -->
                            </div>

                            <div class="mt-5 text-center">
                                <button onclick="initCulturalQuiz()" class="btn btn-cta-primary px-5">
                                    <i class="bi bi-play-fill me-2"></i>Commencer le quiz
                                </button>
                            </div>
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
                        <h2 class="cta-title mb-4">
                            Contribuez à préserver<br>notre héritage culturel
                        </h2>
                        <p class="lead mb-5 opacity-90" style="font-size: 1.3rem;">
                            Partagez vos connaissances, traduisez des contenus, ou enrichissez notre base avec vos
                            médias.<br>
                            Ensemble, bâtissons la plus grande bibliothèque numérique de la culture béninoise.
                        </p>
                        <div class="cta-buttons">
                            <a href="{{ route('front.inscription') }}" class="btn btn-cta-primary">
                                <i class="bi bi-person-plus me-2"></i>Rejoindre la communauté
                            </a>
                            <a href="{{ route('dashboard.contribuer') }}" class="btn btn-cta-outline">
                                <i class="bi bi-plus-circle me-2"></i>Ajouter un contenu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Styles spécifiques pour les cartes de contenu */
    .contenu-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #e9ecef;
    }

    .contenu-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    /* Header de la carte */
    .contenu-card-header {
        position: relative;
    }

    .contenu-card-img-container {
        position: relative;
        overflow: hidden;
    }

    .contenu-card-img {
        transition: transform 0.5s ease;
    }

    .contenu-card:hover .contenu-card-img {
        transform: scale(1.05);
    }

    .contenu-card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50px;
        background: linear-gradient(to top, rgba(0,0,0,0.2), transparent);
    }

    /* Badge type */
    .contenu-card-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        z-index: 2;
    }

    .contenu-card-badge .badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    /* Corps de la carte */
    .contenu-card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .contenu-author-avatar {
        flex-shrink: 0;
    }

    .contenu-author-name {
        color: #333;
    }

    .contenu-card-title a:hover {
        color: var(--primary) !important;
    }

    .contenu-card-text {
        flex: 1;
    }

    .contenu-card-meta {
        margin-top: auto;
    }

    .contenu-stats {
        font-size: 0.9rem;
    }

    .contenu-stat-item {
        display: inline-flex;
        align-items: center;
        color: #666;
    }

    .contenu-stat-item i {
        font-size: 0.9rem;
    }

    .contenu-region-name {
        color: #555;
    }

    /* Styles pour la timeline */
    .timeline {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 0;
    }

    .timeline::after {
        content: '';
        position: absolute;
        width: 6px;
        background: linear-gradient(180deg, var(--primary), var(--accent));
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -3px;
        border-radius: 3px;
    }

    .timeline-item {
        padding: 10px 40px;
        position: relative;
        width: 50%;
        box-sizing: border-box;
        margin-bottom: 30px;
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        background: var(--primary);
        border: 4px solid white;
        top: 15px;
        border-radius: 50%;
        z-index: 1;
        box-shadow: 0 0 0 4px var(--primary-light);
    }

    .timeline-item.left {
        left: 0;
    }

    .timeline-item.left::after {
        right: -12px;
    }

    .timeline-item.right {
        left: 50%;
    }

    .timeline-item.right::after {
        left: -12px;
    }

    /* Styles pour le quiz */
    .quiz-section {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 40px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .quiz-question {
        font-size: 1.5rem;
        color: white;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        color: white;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("{{ asset('adminlte/img/pattern.png') }}");
        opacity: 0.1;
        pointer-events: none;
    }

    .cta-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
    }

    .btn-cta-primary {
        background: white;
        color: var(--primary);
        border: none;
        padding: 15px 40px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-cta-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-cta-outline {
        background: transparent;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 15px 40px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-cta-outline:hover {
        border-color: white;
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-3px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .timeline::after {
            left: 31px;
        }

        .timeline-item {
            width: 100%;
            padding-left: 70px;
            padding-right: 25px;
        }

        .timeline-item::after {
            left: 20px;
        }

        .timeline-item.right {
            left: 0;
        }

        .cta-title {
            font-size: 2.5rem;
        }

        .contenu-card-header {
            height: 180px;
        }
    }

    @media (max-width: 576px) {
        .contenu-card-header {
            height: 160px;
        }

        .contenu-card-title {
            font-size: 1.1rem;
        }

        .contenu-card-text {
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<script>
    // Initialiser la carte du Bénin
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('benin-map')) {
            const map = L.map('benin-map').setView([9.3077, 2.3158], 7);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 12,
                minZoom: 6
            }).addTo(map);

            // Ajouter des marqueurs pour les régions populaires
            const regionCoordinates = {
                'Atacora': [10.3, 1.67],
                'Donga': [9.19, 1.67],
                'Borgou': [9.97, 2.72],
                'Alibori': [11.13, 2.94],
                'Collines': [8.0, 2.2],
                'Zou': [7.37, 2.07],
                'Plateau': [6.87, 2.72],
                'Ouémé': [6.5, 2.6],
                'Littoral': [6.37, 2.42],
                'Atlantique': [6.58, 2.15],
                'Mono': [6.65, 1.72],
                'Couffo': [7.03, 1.75]
            };

            @foreach ($regionsPopulaires as $region)
                const coords = regionCoordinates['{{ $region->nom_region }}'] || [9.3, 2.3];
                L.marker(coords)
                    .addTo(map)
                    .bindPopup(`
                        <div style="min-width: 200px;">
                            <h5 class="fw-bold mb-2">{{ $region->nom_region }}</h5>
                            <p class="mb-2">{{ Str::limit($region->description ?? 'Découvrez cette région culturelle', 100) }}</p>
                            <div class="mb-2">
                                <small class="fw-bold">Contenus :</small>
                                <div class="badge bg-primary">{{ $region->contenus_count }}</div>
                            </div>
                            <a href="{{ route('front.regions', ['slug' => Str::slug($region->nom_region)]) }}"
                               class="btn btn-sm btn-primary w-100 mt-2">
                                <i class="bi bi-compass me-1"></i>Explorer
                            </a>
                        </div>
                    `);
            @endforeach
        }
    });

    // Quiz culturel
    function initCulturalQuiz() {
        const questions = [
            {
                question: "Quel est le nom du dernier roi indépendant du Dahomey ?",
                options: ["Kpêto Gbêdê", "Béhanzin", "Gakpé", "Glèlè"],
                answer: 1
            },
            {
                question: "Quelle langue est principalement parlée dans la région du Zou ?",
                options: ["Yoruba", "Fon", "Dendi", "Bariba"],
                answer: 1
            },
            {
                question: "Où se trouve la célèbre Porte du Non-Retour ?",
                options: ["Abomey", "Ouidah", "Porto-Novo", "Cotonou"],
                answer: 1
            }
        ];

        let currentQuestion = 0;
        let score = 0;

        function showQuestion() {
            const question = questions[currentQuestion];
            document.getElementById('quiz-question').textContent = question.question;

            const optionsContainer = document.getElementById('quiz-options');
            optionsContainer.innerHTML = '';

            question.options.forEach((option, index) => {
                const button = document.createElement('button');
                button.className = 'btn btn-outline-light w-100 mb-2 text-start py-3';
                button.innerHTML = `<span class="me-3">${String.fromCharCode(65 + index)}.</span> ${option}`;
                button.onclick = () => selectAnswer(index);
                optionsContainer.appendChild(button);
            });

            // Mettre à jour la barre de progression
            const progress = ((currentQuestion + 1) / questions.length) * 100;
            document.querySelector('.progress-bar').style.width = `${progress}%`;
            document.getElementById('quiz-progress').textContent =
                `Question ${currentQuestion + 1} sur ${questions.length}`;
        }

        function selectAnswer(selectedIndex) {
            const question = questions[currentQuestion];
            const options = document.querySelectorAll('#quiz-options button');

            // Désactiver tous les boutons
            options.forEach(btn => btn.disabled = true);

            // Marquer la bonne réponse en vert
            options[question.answer].classList.remove('btn-outline-light');
            options[question.answer].classList.add('btn-success');

            // Si la réponse est incorrecte, marquer en rouge
            if (selectedIndex !== question.answer) {
                options[selectedIndex].classList.remove('btn-outline-light');
                options[selectedIndex].classList.add('btn-danger');
            } else {
                score++;
            }

            // Passer à la question suivante après 1.5 secondes
            setTimeout(() => {
                currentQuestion++;
                if (currentQuestion < questions.length) {
                    showQuestion();
                } else {
                    showResults();
                }
            }, 1500);
        }

        function showResults() {
            const scorePercentage = Math.round((score / questions.length) * 100);
            let message = '';

            if (scorePercentage >= 80) {
                message = 'Excellent ! Vous êtes un expert de la culture béninoise 🏆';
            } else if (scorePercentage >= 60) {
                message = 'Très bien ! Vous avez de bonnes connaissances 👍';
            } else {
                message = 'Continuez à explorer pour en savoir plus ! 📚';
            }

            document.getElementById('quiz-question').innerHTML = `
                <div class="text-center">
                    <h4 class="mb-3">Quiz terminé !</h4>
                    <div class="display-1 fw-bold mb-3" style="color: var(--primary);">${scorePercentage}%</div>
                    <p class="mb-3">${message}</p>
                    <small class="text-muted">Score : ${score} sur ${questions.length}</small>
                </div>
            `;

            document.getElementById('quiz-options').innerHTML = `
                <div class="text-center mt-4">
                    <button onclick="initCulturalQuiz()" class="btn btn-primary me-2">
                        <i class="bi bi-arrow-repeat me-2"></i>Recommencer
                    </button>
                    <a href="{{ route('front.explorer') }}" class="btn btn-outline-light">
                        <i class="bi bi-compass me-2"></i>Explorer les contenus
                    </a>
                </div>
            `;

            document.querySelector('.progress-bar').style.width = '100%';
            document.getElementById('quiz-progress').textContent = 'Quiz terminé';
        }

        // Cacher le bouton "Commencer"
        document.querySelector('.quiz-content button').style.display = 'none';

        // Afficher la première question
        showQuestion();
    }
</script>
@endpush
