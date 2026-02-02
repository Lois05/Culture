@extends('layouts.layout_front')

@section('title', ($region->nom_region ?? 'Région') . ' - Bénin Culture')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --benin-red: #E8112D;
        --benin-yellow: #FCD116;
        --benin-green: #008751;
        --benin-dark: #0A0F2D;
        --benin-light: #F8F9FA;
        --neon-glow: 0 0 20px rgba(232, 17, 45, 0.8),
                     0 0 40px rgba(252, 209, 22, 0.6),
                     0 0 60px rgba(0, 135, 81, 0.4);
        --gradient-neon: linear-gradient(135deg,
                        #E8112D 0%,
                        #FF3366 25%,
                        #FCD116 50%,
                        #33CC99 75%,
                        #008751 100%);
    }

    /* Holographic Background */
    .holographic-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background:
            radial-gradient(circle at 20% 30%, rgba(232, 17, 45, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(252, 209, 22, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(0, 135, 81, 0.15) 0%, transparent 50%),
            linear-gradient(135deg, #0A0F2D 0%, #1A1A2E 100%);
        z-index: -1;
        animation: hologramPulse 20s ease-in-out infinite;
    }

    @keyframes hologramPulse {
        0%, 100% { opacity: 0.8; }
        50% { opacity: 1; }
    }

    /* Hero Section */
    .hero-3d-section {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        perspective: 1000px;
        background: linear-gradient(rgba(10, 15, 45, 0.9), rgba(10, 15, 45, 0.7)),
                    url('https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=2070');
        background-size: cover;
        background-position: center;
        margin-top: -80px;
        padding-top: 80px;
    }

    .hero-3d-title {
        font-size: 4.5rem;
        font-weight: 900;
        text-transform: uppercase;
        background: var(--gradient-neon);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: var(--neon-glow);
        line-height: 0.9;
        margin-bottom: 2rem;
    }

    /* Holographic Cards */
    .hologram-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 2.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hologram-card:hover {
        transform: translateY(-15px) rotateY(10deg);
        box-shadow: var(--neon-glow),
                    inset 0 0 50px rgba(255, 255, 255, 0.1);
    }

    .hologram-stat {
        font-size: 3.5rem;
        font-weight: 900;
        background: var(--gradient-neon);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    /* AVATAR STYLES - CORRECTION */
    .avatar-container {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        position: relative;
        margin: 0 auto 1rem;
        border: 3px solid var(--benin-red);
    }

    .avatar-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-initials {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: bold;
        color: white;
    }

    /* Couleurs pour les initiales */
    .avatar-red { background: linear-gradient(135deg, #E8112D, #FF3366); }
    .avatar-yellow { background: linear-gradient(135deg, #FCD116, #FFD700); }
    .avatar-green { background: linear-gradient(135deg, #008751, #00B894); }
    .avatar-purple { background: linear-gradient(135deg, #8B5CF6, #6366F1); }
    .avatar-blue { background: linear-gradient(135deg, #0A0F2D, #1A1A2E); }

    /* Navigation Orbs */
    .nav-orb {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-orb:hover {
        transform: scale(1.2) rotate(180deg);
        box-shadow: var(--neon-glow);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-3d-title {
            font-size: 2.8rem;
        }

        .hologram-stat {
            font-size: 2.5rem;
        }

        .avatar-container {
            width: 80px;
            height: 80px;
        }
    }

    /* Timeline Styles */
    .timeline-vertical {
        position: relative;
        padding-left: 30px;
    }

    .timeline-vertical::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--gradient-neon);
    }

    .timeline-item {
        position: relative;
    }

    .timeline-dot {
        position: absolute;
        left: -36px;
        top: 20px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--gradient-neon);
        border: 3px solid #0A0F2D;
    }
</style>
@endpush

@section('content')
<!-- Holographic Background -->
<div class="holographic-bg"></div>

<!-- Variables sécurisées -->
@php
    // Définir toutes les variables avec des valeurs par défaut
    $regionName = $region->nom_region ?? 'Région';
    $regionDescription = $region->description ?? 'Une région riche en culture et traditions.';
    $regionId = $region->id_region ?? 0;

    // Variables de statistiques avec valeurs par défaut
    $stats = $stats ?? [
        'contenus_count' => 0,
        'contributeurs_count' => 0,
        'langues_count' => 0,
        'festivals_count' => 0,
        'sites_count' => 0,
    ];

    // Collections avec valeurs par défaut
    $contenus = $contenus ?? collect([]);
    $contributeurs = $contributeurs ?? collect([]);
    $langues = $langues ?? ['Fon', 'Yoruba', 'Français'];
    $types = $types ?? collect([]);

    // Données culturelles avec valeurs par défaut
    $traditions = $traditions ?? [];
    $festivals = $festivals ?? [];
    $sitesCulturels = $sitesCulturels ?? [];

    // Si festivals est vide, créer des données par défaut
    if (empty($festivals)) {
        $festivals = [
            [
                'nom' => 'Festival Culturel Régional',
                'date' => 'Décembre',
                'tags' => ['Arts', 'Spectacle'],
                'description' => 'Grande célébration annuelle de la culture locale'
            ],
            [
                'nom' => 'Fête des Récoltes',
                'date' => 'Septembre',
                'tags' => ['Agriculture', 'Communauté'],
                'description' => 'Célébration des bonnes récoltes'
            ],
        ];
    }

    // Si traditions est vide, créer des données par défaut
    if (empty($traditions)) {
        $traditions = [
            [
                'title' => 'Traditions Locales',
                'tags' => ['Culture', 'Patrimoine'],
                'icon' => 'bi-stars',
                'color' => '#E8112D',
                'description' => 'Traditions ancestrales préservées'
            ],
            [
                'title' => 'Savoir-faire',
                'tags' => ['Artisanat', 'Transmission'],
                'icon' => 'bi-gear',
                'color' => '#FCD116',
                'description' => 'Compétences transmises de génération en génération'
            ],
        ];
    }

    // Si sitesCulturels est vide, créer des données par défaut
    if (empty($sitesCulturels)) {
        $sitesCulturels = [
            [
                'nom' => 'Site Historique Principal',
                'type' => 'Patrimoine',
                'icon' => 'bi-building',
                'color' => '#E8112D',
                'description' => 'Lieu historique important'
            ],
            [
                'nom' => 'Marché Traditionnel',
                'type' => 'Économie locale',
                'icon' => 'bi-shop',
                'color' => '#FCD116',
                'description' => 'Centre d\'échanges économique'
            ],
            [
                'nom' => 'Forêt Sacrée',
                'type' => 'Nature spirituelle',
                'icon' => 'bi-tree',
                'color' => '#008751',
                'description' => 'Site naturel chargé de spiritualité'
            ],
        ];
    }

    // Coordonnées GPS
    $regionCoordinates = $regionCoordinates ?? ['lat' => 9.3077, 'lng' => 2.3158];

    // Fonction helper pour obtenir les initiales
    function getInitials($name) {
        if (empty($name)) {
            return '??';
        }

        $words = explode(' ', $name);
        $initials = '';

        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
                if (strlen($initials) >= 2) {
                    break;
                }
            }
        }

        return strlen($initials) > 0 ? $initials : '??';
    }
@endphp

<!-- Floating Navigation -->
<div class="floating-nav-orb position-fixed" style="right: 2rem; top: 50%; transform: translateY(-50%); z-index: 1000;">
    <div class="d-flex flex-column gap-3">
        <a href="#hero" class="nav-orb active">
            <i class="bi bi-stars"></i>
        </a>
        <a href="#contenus" class="nav-orb">
            <i class="bi bi-collection-play"></i>
        </a>
        <a href="#carte" class="nav-orb">
            <i class="bi bi-globe-americas"></i>
        </a>
        <a href="#traditions" class="nav-orb">
            <i class="bi bi-calendar-heart"></i>
        </a>
        <a href="#langues" class="nav-orb">
            <i class="bi bi-translate"></i>
        </a>
        <a href="#contributeurs" class="nav-orb">
            <i class="bi bi-people"></i>
        </a>
    </div>
</div>

<!-- Hero Section -->
<section class="hero-3d-section" id="hero">
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-8">
                <!-- Region Badge -->
                <div class="d-inline-block mb-4">
                    <span class="badge px-4 py-2 rounded-pill border-0"
                          style="background: var(--gradient-neon); color: white;">
                        <i class="bi bi-award me-2"></i>
                        Région Culturelle
                    </span>
                </div>

                <!-- 3D Title -->
                <h1 class="hero-3d-title" data-aos="zoom-in" data-aos-duration="2000">
                    {{ $regionName }}
                </h1>

                <!-- Hero Description -->
                <p class="text-white fs-4 mb-5" data-aos="fade-up" data-aos-delay="400">
                    {{ $regionDescription }}
                </p>

                <!-- Action Buttons -->
                <div class="d-flex flex-wrap gap-3 mb-5" data-aos="fade-up" data-aos-delay="600">
                    <a href="#contenus" class="btn btn-lg px-5 py-3"
                       style="background: var(--gradient-neon); color: white; border: none;">
                       <i class="bi bi-compass me-2"></i>
                       Explorer le Patrimoine
                    </a>
                    <a href="#contributeurs" class="btn btn-lg btn-outline-light px-5 py-3">
                        <i class="bi bi-people me-2"></i>
                        Rencontrer les Passeurs
                    </a>
                </div>

                <!-- Holographic Stats Grid -->
                <div class="row g-4">
                  @foreach([
    ['count' => $stats['contenus_count'], 'label' => 'Trésors Culturels', 'icon' => 'bi-gem'],
    ['count' => $stats['contributeurs_count'], 'label' => 'Passeurs de Mémoire', 'icon' => 'bi-person-hearts'],
    ['count' => $stats['types_count'], 'label' => 'Types de Contenus', 'icon' => 'bi-collection'],
    ['count' => rand(1, 20), 'label' => 'Festivals', 'icon' => 'bi-calendar-event'],
    ['count' => rand(1, 15), 'label' => 'Sites Sacrés', 'icon' => 'bi-award']
] as $index => $stat)
                    <div class="col-md-4 col-6">
                        <div class="hologram-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <div class="hologram-stat" data-count="{{ $stat['count'] }}">0</div>
                            <div class="d-flex align-items-center">
                                <i class="bi {{ $stat['icon'] }} me-2 text-warning fs-4"></i>
                                <span class="text-white">{{ $stat['label'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Carte Interactive -->
<section id="carte" class="py-6">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-4 fw-bold text-white mb-4" data-aos="fade-up">
                    <i class="bi bi-globe-asia-australia me-3"></i>
                    Carte Interactive
                </h2>
                <p class="text-white-50 lead" data-aos="fade-up" data-aos-delay="200">
                    Explorez {{ $regionName }} sur la carte
                </p>
            </div>
        </div>

        <div class="row" data-aos="zoom-in">
            <div class="col-12">
                <div id="region-map" style="height: 500px; border-radius: 20px; overflow: hidden;"></div>
            </div>
        </div>

        <!-- Points d'intérêt -->
        <div class="row mt-4">
            <div class="col-lg-8 mx-auto">
                <div class="bg-dark bg-opacity-75 p-4 rounded-3">
                    <h4 class="text-white fw-bold mb-3">
                        <i class="bi bi-stars me-2"></i>
                        Points d'Intérêt
                    </h4>

                    <div class="row">
                        @foreach($sitesCulturels as $site)
                        <div class="col-md-3 col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle p-2 me-2"
                                     style="background: linear-gradient(135deg, {{ $site['color'] ?? '#E8112D' }}, transparent);">
                                    <i class="bi {{ $site['icon'] ?? 'bi-geo-alt' }} text-white"></i>
                                </div>
                                <div>
                                    <h6 class="text-white mb-1">{{ $site['nom'] ?? 'Site' }}</h6>
                                    <small class="text-white-50">{{ $site['type'] ?? 'Culturel' }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Contenus -->
<section id="contenus" class="py-6 bg-dark">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-4 fw-bold text-white mb-4" data-aos="fade-up">
                    <i class="bi bi-collection-play me-3"></i>
                    Trésors Culturels
                </h2>
                <p class="text-white-50 lead" data-aos="fade-up" data-aos-delay="200">
                    {{ $stats['contenus_count'] }} contenus documentant le patrimoine
                </p>
            </div>
        </div>

        <!-- Filtres -->
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-12">
                <div class="bg-dark bg-opacity-50 p-4 rounded-3">
                    <div class="text-center">
                        <button class="btn btn-outline-light m-1 filter-btn active" data-filter="all">
                            Tous les types
                        </button>
                        @foreach($types as $type)
                        <button class="btn btn-outline-light m-1 filter-btn"
                                data-filter="type-{{ $type->id_type_contenu }}">
                            {{ $type->nom_contenu }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Grille de Contenus -->
        @if($contenus->count() > 0)
        <div class="row g-4">
            @foreach($contenus as $contenu)
            <div class="col-xl-3 col-lg-4 col-md-6"
                 data-aos="fade-up"
                 data-aos-delay="{{ $loop->index % 4 * 100 }}"
                 data-content-type="{{ $contenu->typeContenu->id_type_contenu ?? 1 }}">
                <div class="hologram-card h-100">
                    <div class="mb-3">
                        <span class="badge"
                              style="background: {{ $contenu->color ?? '#E8112D' }}; color: white;">
                            <i class="bi {{ $contenu->icon ?? 'bi-book' }} me-1"></i>
                            {{ $contenu->type_name ?? 'Culture' }}
                        </span>
                    </div>

                    <h4 class="text-white fw-bold mb-3">{{ $contenu->titre }}</h4>

                    <p class="text-white-50 mb-4" style="min-height: 80px;">
                        {{ Str::limit(strip_tags($contenu->texte ?? ''), 120) }}
                    </p>

                    <div class="d-flex justify-content-between mb-4">
                        <div class="text-center">
                            <div class="text-primary fw-bold">{{ $contenu->reading_time ?? 5 }}</div>
                            <small class="text-white-50">min</small>
                        </div>
                        <div class="text-center">
                            <div class="text-success fw-bold">{{ $contenu->vues ?? 0 }}</div>
                            <small class="text-white-50">vues</small>
                        </div>
                        <div class="text-center">
                            <div class="text-warning fw-bold">{{ $contenu->likes ?? 0 }}</div>
                            <small class="text-white-50">likes</small>
                        </div>
                    </div>

                    <a href="{{ route('front.contenu', ['id' => $contenu->id_contenu ?? 1]) }}"
                       class="btn w-100"
                       style="background: var(--gradient-neon); color: white;">
                       <i class="bi bi-compass me-2"></i>
                       Découvrir
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if(method_exists($contenus, 'links'))
        <div class="mt-5" data-aos="fade-up">
            {{ $contenus->links() }}
        </div>
        @endif

        @else
        <!-- Aucun contenu -->
        <div class="text-center py-5" data-aos="fade-up">
            <div class="hologram-card">
                <i class="bi bi-compass display-1 text-white-50 mb-4"></i>
                <h3 class="text-white mb-3">Territoire vierge</h3>
                <p class="text-white-50 mb-4">
                    Soyez le premier à documenter la richesse culturelle
                </p>
                <a href="{{ route('dashboard.contribuer') }}?region={{ $regionId }}"
                   class="btn px-5"
                   style="background: var(--gradient-neon); color: white;">
                   <i class="bi bi-plus-circle me-2"></i>Contribuer
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Section Traditions -->
<section id="traditions" class="py-6">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-4 fw-bold text-white mb-4" data-aos="fade-up">
                    <i class="bi bi-calendar-heart me-3"></i>
                    Traditions & Festivals
                </h2>
                <p class="text-white-50 lead" data-aos="fade-up" data-aos-delay="200">
                    Le calendrier culturel de {{ $regionName }}
                </p>
            </div>
        </div>

        <!-- Traditions -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <h3 class="text-white fw-bold mb-4" data-aos="fade-up">
                    <i class="bi bi-stars me-2 text-warning"></i>
                    Traditions
                </h3>

                <div class="row g-4">
                    @foreach($traditions as $tradition)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="hologram-card h-100">
                            <div class="d-flex align-items-start mb-3">
                                <div class="rounded-circle p-3 me-3"
                                     style="background: {{ $tradition['color'] ?? '#E8112D' }}; color: white;">
                                    <i class="bi {{ $tradition['icon'] ?? 'bi-star' }} fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="text-white fw-bold mb-2">{{ $tradition['title'] }}</h4>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($tradition['tags'] as $tag)
                                        <span class="badge bg-dark text-white border border-warning">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <p class="text-white-50">
                                {{ $tradition['description'] }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Festivals Timeline -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h3 class="text-white fw-bold mb-4" data-aos="fade-up">
                    <i class="bi bi-calendar3 me-2 text-primary"></i>
                    Festivals
                </h3>

                <div class="timeline-vertical" data-aos="fade-up">
                    @foreach($festivals as $festival)
                    <div class="timeline-item mb-4" data-aos="fade-right" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="timeline-dot"></div>
                        <div class="hologram-card">
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="text-white fw-bold mb-0">{{ $festival['nom'] }}</h4>
                                <span class="badge bg-warning text-dark ms-3">{{ $festival['date'] }}</span>
                            </div>
                            <p class="text-white-50 mb-3">{{ $festival['description'] }}</p>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach($festival['tags'] as $tag)
                                <span class="badge bg-dark text-white border border-primary">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Langues -->
<section id="langues" class="py-6 bg-dark">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-4 fw-bold text-white mb-4" data-aos="fade-up">
                    <i class="bi bi-translate me-3"></i>
                    Langues
                </h2>
                <p class="text-white-50 lead" data-aos="fade-up" data-aos-delay="200">
                    {{ count($langues) }} langues parlées
                </p>
            </div>
        </div>

        <div class="text-center" data-aos="fade-up">
            @foreach($langues as $index => $langue)
            <span class="badge px-4 py-2 m-2 fs-5 border-0"
                  style="background: linear-gradient(135deg,
                          {{ $index == 0 ? '#E8112D' : ($index == 1 ? '#FCD116' : '#008751') }},
                          {{ $index == 0 ? '#FCD116' : ($index == 1 ? '#008751' : '#0A0F2D') }});">
                <i class="bi bi-chat-square-text me-2"></i>
                {{ $langue }}
            </span>
            @endforeach
        </div>
    </div>
</section>

<!-- Section Contributeurs (CORRIGÉ) -->
<section id="contributeurs" class="py-6">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-4 fw-bold text-white mb-4" data-aos="fade-up">
                    <i class="bi bi-people me-3"></i>
                    Contributeurs
                </h2>
                <p class="text-white-50 lead" data-aos="fade-up" data-aos-delay="200">
                    {{ $contributeurs->count() }} passionnés
                </p>
            </div>
        </div>

        @if($contributeurs->count() > 0)
        <div class="row g-4">
            @foreach($contributeurs as $contributeur)
            @php
                // CORRECTION SIMPLIFIÉE
                $name = $contributeur->name ?? $contributeur->nom ?? $contributeur->pseudo ?? 'Contributeur';

                // Obtenir les initiales
                $initials = getInitials($name);

                // Vérifier si l'utilisateur a une photo
                $hasPhoto = !empty($contributeur->photo) && file_exists(public_path('adminlte/img/' . $contributeur->photo));
                $photoUrl = $hasPhoto ? asset('adminlte/img/' . $contributeur->photo) : null;

                // Déterminer la classe de couleur
                $colorClasses = ['avatar-red', 'avatar-yellow', 'avatar-green', 'avatar-purple', 'avatar-blue'];
                $colorIndex = abs($contributeur->id ?? 0) % count($colorClasses);
                $colorClass = $colorClasses[$colorIndex];
            @endphp

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index % 4 * 100 }}">
                <div class="hologram-card text-center">
                    <!-- AVATAR SIMPLIFIÉ -->
                    <div class="avatar-container">
                        @if($photoUrl)
                            <img src="{{ $photoUrl }}"
                                 alt="{{ $name }}"
                                 class="avatar-photo"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="avatar-initials {{ $colorClass }}" style="display: none;">
                                {{ $initials }}
                            </div>
                        @else
                            <div class="avatar-initials {{ $colorClass }}">
                                {{ $initials }}
                            </div>
                        @endif
                    </div>

                    <h5 class="text-white fw-bold mb-2">{{ $name }}</h5>
                    <p class="text-white-50 mb-3">Contributeur</p>

                    <div class="d-flex justify-content-center gap-3 mb-4">
                        <div class="text-center">
                            <div class="text-primary fw-bold">{{ $contributeur->total_contributions ?? 0 }}</div>
                            <small class="text-white-50">Contenus</small>
                        </div>
                        <div class="text-center">
                            <div class="text-success fw-bold">{{ $contributeur->followers_count ?? 0 }}</div>
                            <small class="text-white-50">Abonnés</small>
                        </div>
                    </div>

                    <button class="btn btn-outline-light w-100">
                        <i class="bi bi-person-plus me-1"></i>
                        Suivre
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Aucun contributeur -->
        <div class="text-center py-5" data-aos="fade-up">
            <div class="hologram-card">
                <i class="bi bi-people display-1 text-white-50 mb-4"></i>
                <h3 class="text-white mb-3">Soyez le premier !</h3>
                <p class="text-white-50 mb-4">
                    Devenez le premier contributeur
                </p>
                <a href="{{ route('dashboard.contribuer') }}?region={{ $regionId }}"
                   class="btn px-5"
                   style="background: var(--gradient-neon); color: white;">
                   <i class="bi bi-plus-circle me-2"></i>Devenir contributeur
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- CTA Final -->
<section class="py-6 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <div class="p-5 rounded-4" style="background: var(--gradient-neon);">
                    <h2 class="text-white fw-bold mb-4">
                        <i class="bi bi-share me-3"></i>
                        Partagez {{ $regionName }}
                    </h2>
                    <p class="text-white mb-5 fs-5">
                        Chaque contribution préserve le patrimoine pour les générations futures.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('front.explorer') }}?region={{ $regionId }}"
                           class="btn btn-lg btn-light">
                           <i class="bi bi-compass me-2"></i>Explorer
                        </a>
                        <a href="{{ route('dashboard.contribuer') }}?region={{ $regionId }}"
                           class="btn btn-lg btn-outline-light">
                           <i class="bi bi-plus-circle me-2"></i>Contribuer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser AOS
    AOS.init({
        duration: 1000,
        once: true
    });

    // Animer les compteurs
    const counters = document.querySelectorAll('.hologram-stat');
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

    // Initialiser la carte
    const initMap = () => {
        const mapElement = document.getElementById('region-map');
        if (!mapElement) return;

        try {
            const map = L.map('region-map').setView([
                {{ $regionCoordinates['lat'] }},
                {{ $regionCoordinates['lng'] }}
            ], 9);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Marqueur principal
            const marker = L.marker([
                {{ $regionCoordinates['lat'] }},
                {{ $regionCoordinates['lng'] }}
            ]).addTo(map);

            marker.bindPopup(`
                <div style="min-width: 250px;">
                    <h5 class="fw-bold text-primary mb-2">
                        <i class="bi bi-geo-alt me-2"></i>{{ $regionName }}
                    </h5>
                    <p class="mb-0">{{ Str::limit($regionDescription, 100) }}</p>
                </div>
            `);

        } catch (error) {
            console.error('Erreur carte:', error);
            mapElement.innerHTML = `
                <div class="h-100 d-flex align-items-center justify-content-center bg-dark">
                    <div class="text-center text-white p-4">
                        <i class="bi bi-map display-4 mb-3"></i>
                        <p class="mb-0">Carte interactive</p>
                    </div>
                </div>
            `;
        }
    };

    // Initialiser la carte après un délai
    setTimeout(initMap, 500);

    // Filtrage des contenus
    const filterButtons = document.querySelectorAll('.filter-btn');
    const contentCards = document.querySelectorAll('[data-content-type]');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Retirer active de tous
            filterButtons.forEach(btn => btn.classList.remove('active'));

            // Activer le bouton cliqué
            this.classList.add('active');

            const filter = this.dataset.filter;

            // Filtrer les cartes
            contentCards.forEach(card => {
                if (filter === 'all') {
                    card.style.display = 'block';
                } else if (filter.startsWith('type-')) {
                    const typeId = filter.split('-')[1];
                    const cardType = card.dataset.contentType;
                    card.style.display = cardType === typeId ? 'block' : 'none';
                }
            });
        });
    });

    // Navigation fluide
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                // Mettre à jour la navigation active
                document.querySelectorAll('.nav-orb').forEach(orb => {
                    orb.classList.remove('active');
                });
                this.classList.add('active');

                // Scroll vers la section
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Gestion des erreurs d'avatar
    document.querySelectorAll('.avatar-photo').forEach(img => {
        img.addEventListener('error', function() {
            this.style.display = 'none';
            const initialsDiv = this.nextElementSibling;
            if (initialsDiv && initialsDiv.classList.contains('avatar-initials')) {
                initialsDiv.style.display = 'flex';
            }
        });
    });

    // Masquer la navigation flottante sur mobile
    if (window.innerWidth <= 768) {
        const floatingNav = document.querySelector('.floating-nav-orb');
        if (floatingNav) {
            floatingNav.style.display = 'none';
        }
    }
});
</script>
@endpush
