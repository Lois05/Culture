@extends('layouts.layout_front')

@section('title', 'Régions du Bénin - Bénin Culture')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --primary: #E8112D;
        --primary-light: rgba(232, 17, 45, 0.1);
        --primary-gradient: linear-gradient(135deg, #E8112D, #FF3366);
        --secondary: #FCD116;
        --accent: #008751;
        --dark: #1a1a1a;
        --light: #f8f9fa;
    }

    body {
        background: #f8f9fa;
        overflow-x: hidden;
    }

    /* ============ HERO SECTION ÉPIQUE ============ */
    .regions-hero-epic {
        position: relative;
        min-height: 85vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: linear-gradient(135deg,
                    rgba(26, 26, 26, 0.95) 0%,
                    rgba(232, 17, 45, 0.85) 40%,
                    rgba(252, 209, 22, 0.8) 100%);
        margin-top: -80px;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    }

    .hero-particles-2 {
        position: absolute;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .hero-content-regions {
        position: relative;
        z-index: 10;
        color: white;
        text-align: center;
        padding: 6rem 0 8rem;
    }

    .hero-title-regions {
        font-size: 4.5rem;
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #ffffff 0%, #FCD116 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    /* ============ MAP SECTION INTERACTIVE ============ */
    .map-section {
        position: relative;
        margin-top: -100px;
        z-index: 20;
        padding-bottom: 4rem;
    }

    .map-container-epic {
        background: white;
        border-radius: 30px;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        position: relative;
        height: 600px;
    }

    #interactiveMap {
        width: 100%;
        height: 100%;
        border-radius: 30px;
    }

    .map-overlay {
        position: absolute;
        top: 20px;
        left: 20px;
        right: 20px;
        display: flex;
        justify-content: space-between;
        z-index: 1000;
        pointer-events: none;
    }

    .map-search {
        width: 400px;
        pointer-events: auto;
    }

    .search-input-map {
        width: 100%;
        padding: 1rem 1.5rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(232, 17, 45, 0.2);
        border-radius: 15px;
        font-size: 1rem;
        color: var(--dark);
        transition: all 0.3s ease;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .search-input-map:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 20px 50px rgba(232, 17, 45, 0.3);
    }

    .map-controls {
        display: flex;
        gap: 10px;
        pointer-events: auto;
    }

    .map-btn {
        width: 50px;
        height: 50px;
        background: white;
        border: none;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .map-btn:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(232, 17, 45, 0.3);
    }

    /* ============ REGIONS GRID STYLÉ ============ */
    .regions-section {
        padding: 6rem 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .regions-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-title-epic {
        font-size: 3rem;
        font-weight: 900;
        color: var(--dark);
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
    }

    .section-title-epic::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 5px;
        background: var(--primary-gradient);
        border-radius: 5px;
    }

    /* ============ FILTERS MODERNES ============ */
    .filters-modern {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 3rem;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
    }

    .filter-tabs-modern {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        overflow-x: auto;
        padding-bottom: 1rem;
    }

    .filter-tab-modern {
        background: #f8f9fa;
        border: 2px solid transparent;
        border-radius: 15px;
        padding: 1rem 2rem;
        color: #666;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-tab-modern:hover {
        border-color: var(--primary-light);
        color: var(--primary);
    }

    .filter-tab-modern.active {
        background: var(--primary-gradient);
        color: white;
        border-color: var(--primary);
        box-shadow: 0 10px 30px rgba(232, 17, 45, 0.2);
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .stat-card-modern {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .stat-card-modern:hover {
        border-color: var(--primary);
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .stat-number-modern {
        font-size: 2.5rem;
        font-weight: 900;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    /* ============ REGION CARDS PREMIUM ============ */
    .regions-grid-premium {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .region-card-premium {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.06);
    }

    .region-card-premium:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
    }

    .card-header-premium {
        position: relative;
        height: 200px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        overflow: hidden;
    }

    .card-header-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
background: url('{{ asset('adminlte/img/pattern.png') }}');
        opacity: 0.1;
    }

    .region-badge-premium {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(255, 255, 255, 0.95);
        color: var(--primary);
        padding: 0.5rem 1.5rem;
        border-radius: 20px;
        font-weight: 800;
        font-size: 1.1rem;
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .region-icon-premium {
        position: absolute;
        bottom: 20px;
        right: 20px;
        width: 70px;
        height: 70px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--primary);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }

    .card-body-premium {
        padding: 2rem;
    }

    .region-name-premium {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    .region-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .region-stats {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #f1f3f5;
    }

    .stat-item-premium {
        text-align: center;
    }

    .stat-number-premium {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
    }

    .stat-label-premium {
        font-size: 0.8rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .region-languages {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .language-tag {
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.5rem 1rem;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .explore-btn-premium {
        width: 100%;
        padding: 1rem;
        background: var(--primary-gradient);
        border: none;
        border-radius: 15px;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .explore-btn-premium:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(232, 17, 45, 0.3);
    }

    /* ============ EMPTY STATE ============ */
    .empty-state-regions {
        text-align: center;
        padding: 5rem 2rem;
        background: white;
        border-radius: 30px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.05);
        margin: 3rem auto;
        max-width: 600px;
    }

    .empty-state-icon {
        font-size: 5rem;
        color: #e9ecef;
        margin-bottom: 2rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 1200px) {
        .hero-title-regions {
            font-size: 3.5rem;
        }
        .regions-grid-premium {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }
    }

    @media (max-width: 992px) {
        .hero-title-regions {
            font-size: 2.8rem;
        }
        .map-container-epic {
            height: 500px;
        }
        .map-search {
            width: 300px;
        }
    }

    @media (max-width: 768px) {
        .regions-hero-epic {
            min-height: 70vh;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        }
        .hero-title-regions {
            font-size: 2.2rem;
        }
        .map-overlay {
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }
        .map-search {
            width: 100%;
        }
        .filter-tabs-modern {
            flex-wrap: wrap;
            justify-content: center;
        }
        .regions-grid-premium {
            grid-template-columns: 1fr;
        }
        .section-title-epic {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 576px) {
        .hero-title-regions {
            font-size: 1.8rem;
        }
        .region-card-premium {
            margin: 0 1rem;
        }
        .card-header-premium {
            height: 150px;
        }
        .stats-cards {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section Épique -->
<section class="regions-hero-epic">
    <div class="hero-particles-2" id="heroParticles"></div>
    <div class="container hero-content-regions">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="hero-title-regions" data-aos="fade-up">
                    Explorez les Régions du Bénin
                </h1>

                <p class="lead text-white mb-5 fs-4" data-aos="fade-up" data-aos-delay="200">
                    Découvrez la diversité culturelle à travers {{ $stats['total_regions'] ?? 12 }} régions uniques
                </p>

                <!-- Statistiques animées -->
                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="col-md-3 col-6 mb-4">
                        <div class="stat-card-modern text-center">
                            <div class="stat-number-modern" id="regionsCount">{{ $stats['total_regions'] ?? 12 }}</div>
                            <div class="stat-label-premium">Régions</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="stat-card-modern text-center">
                                <div class="stat-number-modern" id="culturesCount">50</div>
                            <div class="stat-label-premium">Cultures</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="stat-card-modern text-center">
                            <div class="stat-number-modern" id="contributorsCount">{{ $stats['total_utilisateurs'] ?? 150 }}</div>
                            <div class="stat-label-premium">Contributeurs</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="stat-card-modern text-center">
                            <div class="stat-number-modern" id="contentsCount">{{ $stats['total_contenus'] ?? 1000 }}</div>
                            <div class="stat-label-premium">Contenus</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Carte Interactive -->
<section class="map-section">
    <div class="container">
        <div class="map-container-epic" data-aos="zoom-in">
            <div id="interactiveMap"></div>
            <div class="map-overlay">
                <div class="map-search">
                    <input type="text"
                           class="search-input-map"
                           placeholder="🔍 Rechercher une région..."
                           id="regionSearchMap">
                </div>
                <div class="map-controls">
                    <button class="map-btn" id="mapZoomIn" title="Zoomer">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="map-btn" id="mapZoomOut" title="Dézoomer">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button class="map-btn" id="mapReset" title="Réinitialiser">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <button class="map-btn" id="mapFullscreen" title="Plein écran">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filtres et Statistiques -->
<section class="regions-section">
    <div class="container">
        <!-- En-tête -->
        <div class="regions-header" data-aos="fade-up">
            <h2 class="section-title-epic">
                Trésors Culturels Régionaux
            </h2>
            <p class="text-muted fs-5">
                Chaque région raconte une histoire unique
            </p>
        </div>

        <!-- Filtres modernes -->
        <div class="filters-modern" data-aos="fade-up" data-aos-delay="200">
            <div class="filter-tabs-modern">
                <button class="filter-tab-modern active" data-filter="all">
                    <i class="fas fa-globe-africa"></i>
                    Toutes les régions
                </button>
                <button class="filter-tab-modern" data-filter="nord">
                    <i class="fas fa-mountain"></i>
                    Nord
                </button>
                <button class="filter-tab-modern" data-filter="sud">
                    <i class="fas fa-umbrella-beach"></i>
                    Sud
                </button>
                <button class="filter-tab-modern" data-filter="centrale">
                    <i class="fas fa-tree"></i>
                    Centrale
                </button>
            </div>

            <div class="stats-cards">
                <div class="stat-card-modern">
                    <div class="stat-number-modern">{{ $stats['total_regions'] ?? 12 }}</div>
                    <div class="stat-label-premium">Régions actives</div>
                    <small class="text-muted">Tout le Bénin</small>
                </div>
                <div class="stat-card-modern">
                        <div class="stat-number-modern" id="culturesCount">50</div>
                    <div class="stat-label-premium">Langues locales</div>
                    <small class="text-muted">Dialectes uniques</small>
                </div>
                <div class="stat-card-modern">
                    <div class="stat-number-modern">{{ $stats['total_contenus'] ?? 1000 }}</div>
                    <div class="stat-label-premium">Histoires</div>
                    <small class="text-muted">Contenus culturels</small>
                </div>
                <div class="stat-card-modern">
                    <div class="stat-number-modern">{{ $stats['total_utilisateurs'] ?? 150 }}+</div>
                    <div class="stat-label-premium">Passionnés</div>
                    <small class="text-muted">Contributeurs actifs</small>
                </div>
            </div>
        </div>

        <!-- Grid des régions -->
        @if($regions && $regions->count() > 0)
            <div class="regions-grid-premium" id="regionsGrid">
                @foreach($regions as $region)
                    @php
                        $slug = Str::slug($region->nom_region);
                        $contributeurs = $region->contributeurs_count ?? rand(5, 50);
                        $langues = $regionLangues[$region->id_region] ?? ['Français', 'Fon', 'Yoruba'];
                        $typesRegion = $typesCountByRegion[$region->id_region] ?? [];
                        $delay = ($loop->index % 3) * 100;

                        // Générer une couleur unique pour la région avec une version plus foncée
    $colors = [
        ['base' => '#E8112D', 'dark' => '#C20A24'],
        ['base' => '#FCD116', 'dark' => '#E6B800'],
        ['base' => '#008751', 'dark' => '#006B40'],
        ['base' => '#6f42c1', 'dark' => '#5936A0'],
        ['base' => '#20c997', 'dark' => '#1AA67D'],
        ['base' => '#fd7e14', 'dark' => '#E66C00']
    ];
    $colorPair = $colors[$loop->index % count($colors)];
    $regionColor = $colorPair['base'];
    $regionColorDark = $colorPair['dark'];
                    @endphp

                    <div class="region-card-premium"
                         data-aos="fade-up"
                         data-aos-delay="{{ $delay }}"
                         data-region-name="{{ strtolower($region->nom_region) }}"
                         data-region-zone="{{ $loop->index <= 6 ? 'nord' : 'sud' }}">
                        <!-- En-tête de la carte -->
                        <div class="card-header-premium"style="background: linear-gradient(135deg, {{ $regionColor }}, {{ $regionColorDark }});">
                            <div class="region-badge-premium">
                                {{ $region->nom_region }}
                            </div>
                            <div class="region-icon-premium">
                                <i class="fas fa-landmark"></i>
                            </div>
                        </div>

                        <!-- Corps de la carte -->
                        <div class="card-body-premium">
                            <h3 class="region-name-premium">
                                {{ $region->nom_region }}
                            </h3>

                            @if($region->description)
                                <p class="region-description">
                                    {{ Str::limit($region->description, 120) }}
                                </p>
                            @else
                                <p class="region-description text-muted">
                                    Découvrez les richesses culturelles de cette région...
                                </p>
                            @endif

                            <!-- Statistiques -->
                            <div class="region-stats">
                                <div class="stat-item-premium">
                                    <div class="stat-number-premium">{{ $region->contenus_count ?? 0 }}</div>
                                    <div class="stat-label-premium">Contenus</div>
                                </div>
                                <div class="stat-item-premium">
                                    <div class="stat-number-premium">{{ $contributeurs }}</div>
                                    <div class="stat-label-premium">Contributeurs</div>
                                </div>
                                <div class="stat-item-premium">
                                    <div class="stat-number-premium">{{ count($langues) }}</div>
                                    <div class="stat-label-premium">Langues</div>
                                </div>
                            </div>

                            <!-- Langues -->
                            <div class="region-languages">
                                @foreach(array_slice($langues, 0, 3) as $langue)
                                    <span class="language-tag">
                                        <i class="fas fa-comment-dots me-1"></i>{{ $langue }}
                                    </span>
                                @endforeach
                                @if(count($langues) > 3)
                                    <span class="language-tag">
                                        +{{ count($langues) - 3 }}
                                    </span>
                                @endif
                            </div>

                            <!-- Bouton d'exploration -->
                            <a href="{{ route('front.region', ['slug' => $slug]) }}"
                               class="explore-btn-premium">
                                <i class="fas fa-compass me-2"></i>
                                Explorer cette région
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- État vide -->
            <div class="empty-state-regions" data-aos="zoom-in">
                <div class="empty-state-icon">
                    <i class="fas fa-globe-africa"></i>
                </div>
                <h3 class="mb-3">Aucune région disponible</h3>
                <p class="text-muted mb-4">
                    Les régions seront bientôt disponibles. Revenez plus tard !
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('front.explorer') }}" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i>Explorer les contenus
                    </a>
                    <a href="{{ route('dashboard.contribuer') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Devenir contributeur
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Section Call to Action -->
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">Votre région n'est pas représentée ?</h2>
                <p class="mb-0">
                    Partagez la culture de votre région et contribuez à préserver notre patrimoine commun.
                    Chaque histoire compte !
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('dashboard.contribuer') }}" class="btn btn-light btn-lg px-5">
                    <i class="fas fa-pen-alt me-2"></i>Partager mon histoire
                </a>
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
        once: true,
        offset: 100
    });

    // Animer les compteurs
    animateCounters();

    // Initialiser la carte interactive
    initInteractiveMap();

    // Initialiser les filtres
    initFilters();

    // Initialiser les particules
    initParticles();

    // Fonction pour ajuster les couleurs
    function adjustColor(color, amount) {
        return color; // Simplifié pour l'exemple
    }

    // Animation des compteurs
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number-modern');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace('+', '')) || 0;
            const increment = target / 100;
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target + (counter.textContent.includes('+') ? '+' : '');
                } else {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                }
            };
            updateCounter();
        });
    }

    // Initialiser la carte Leaflet
    function initInteractiveMap() {
        const mapElement = document.getElementById('interactiveMap');
        if (!mapElement) return;

        try {
            // Créer la carte centrée sur le Bénin
            const map = L.map('interactiveMap', {
                center: [9.3077, 2.3158],
                zoom: 7,
                zoomControl: false,
                attributionControl: false
            });

            // Ajouter le fond de carte
            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '© OpenStreetMap, © CartoDB'
            }).addTo(map);

            // Contrôles de la carte
            const zoomInBtn = document.getElementById('mapZoomIn');
            const zoomOutBtn = document.getElementById('mapZoomOut');
            const resetBtn = document.getElementById('mapReset');
            const fullscreenBtn = document.getElementById('mapFullscreen');

            zoomInBtn?.addEventListener('click', () => map.zoomIn());
            zoomOutBtn?.addEventListener('click', () => map.zoomOut());
            resetBtn?.addEventListener('click', () => {
                map.setView([9.3077, 2.3158], 7, {
                    animate: true,
                    duration: 1
                });
            });

            fullscreenBtn?.addEventListener('click', () => {
                if (!document.fullscreenElement) {
                    mapElement.requestFullscreen().catch(err => {
                        console.log(`Erreur fullscreen: ${err.message}`);
                    });
                } else {
                    document.exitFullscreen();
                }
            });

            // Coordonnées approximatives des régions du Bénin
            const regionCoordinates = {
                'atlantique': [6.3654, 2.4185],
                'littoral': [6.3804, 2.4400],
                'oueme': [6.6149, 2.4991],
                'plateau': [7.3463, 2.5396],
                'zou': [7.1907, 2.0665],
                'collines': [8.1079, 2.1053],
                'borgou': [9.9100, 2.7100],
                'alibori': [11.1252, 2.9396],
                'atacora': [10.3049, 1.3784],
                'donga': [9.7192, 1.6778],
                'couffo': [7.1852, 1.9916],
                'mono': [6.4965, 1.7553]
            };

            // Ajouter des marqueurs pour chaque région
            const regionCards = document.querySelectorAll('.region-card-premium');
            regionCards.forEach((card, index) => {
                const regionName = card.dataset.regionName;
                const coordinates = regionCoordinates[regionName] || [
                    9.3077 + ((index - 6) * 0.5),
                    2.3158 + ((index - 6) * 0.5)
                ];

                // Créer un marqueur personnalisé
                const customIcon = L.divIcon({
                    className: 'custom-marker',
                    html: `
                        <div style="
                            width: 40px;
                            height: 40px;
                            background: ${getRegionColor(index)};
                            border-radius: 50%;
                            border: 3px solid white;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: white;
                            font-size: 14px;
                            font-weight: bold;
                            box-shadow: 0 3px 10px rgba(0,0,0,0.3);
                            cursor: pointer;
                            transition: all 0.3s ease;
                        ">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                    `,
                    iconSize: [40, 40],
                    iconAnchor: [20, 40]
                });

                const marker = L.marker(coordinates, { icon: customIcon }).addTo(map);

                // Popup d'information
                const regionTitle = card.querySelector('.region-name-premium')?.textContent || 'Région';
                const regionLink = card.querySelector('.explore-btn-premium')?.href || '#';

                marker.bindPopup(`
                    <div style="min-width: 200px; padding: 10px;">
                        <h6 style="font-weight: bold; margin-bottom: 10px; color: #333;">${regionTitle}</h6>
                        <a href="${regionLink}"
                           style="
                                display: block;
                                text-align: center;
                                padding: 8px 15px;
                                background: var(--primary);
                                color: white;
                                text-decoration: none;
                                border-radius: 10px;
                                font-weight: 600;
                                transition: all 0.3s ease;
                           "
                           onmouseover="this.style.background='#C20A24'"
                           onmouseout="this.style.background='var(--primary)'">
                            <i class="fas fa-compass me-1"></i>
                            Explorer
                        </a>
                    </div>
                `);

                // Interaction
                marker.on('click', function() {
                    // Scroller vers la carte correspondante
                    card.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    // Animation de la carte
                    card.style.transform = 'scale(1.05)';
                    setTimeout(() => {
                        card.style.transform = 'scale(1)';
                    }, 300);

                    // Ouvrir le popup
                    this.openPopup();
                });

                // Survol de la carte => survol du marqueur
                card.addEventListener('mouseenter', () => {
                    marker.getElement().style.transform = 'scale(1.2)';
                    marker.getElement().style.boxShadow = '0 5px 20px rgba(0,0,0,0.4)';
                });

                card.addEventListener('mouseleave', () => {
                    marker.getElement().style.transform = 'scale(1)';
                    marker.getElement().style.boxShadow = '0 3px 10px rgba(0,0,0,0.3)';
                });
            });

            // Recherche sur la carte
            const searchInput = document.getElementById('regionSearchMap');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase().trim();

                    regionCards.forEach(card => {
                        const regionName = card.dataset.regionName || '';
                        if (regionName.includes(query)) {
                            card.style.display = 'block';
                            card.style.animation = 'fadeIn 0.5s ease';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }

            // Gestion du plein écran
            document.addEventListener('fullscreenchange', () => {
                map.invalidateSize();
            });

        } catch (error) {
            console.error('Erreur initialisation carte:', error);
            mapElement.innerHTML = `
                <div class="h-100 d-flex flex-column align-items-center justify-content-center bg-dark text-white rounded">
                    <i class="fas fa-map-marked-alt mb-3" style="font-size: 4rem;"></i>
                    <h4>Carte temporairement indisponible</h4>
                    <p class="text-center">Explorez les régions via les cartes ci-dessous</p>
                </div>
            `;
        }
    }

    // Couleurs pour les régions
    function getRegionColor(index) {
        const colors = [
            '#E8112D', '#FCD116', '#008751',
            '#6f42c1', '#20c997', '#fd7e14',
            '#dc3545', '#0d6efd', '#198754',
            '#ffc107', '#0dcaf0', '#6c757d'
        ];
        return colors[index % colors.length];
    }

    // Initialiser les filtres
    function initFilters() {
        const filterTabs = document.querySelectorAll('.filter-tab-modern');
        const regionCards = document.querySelectorAll('.region-card-premium');
        const searchInput = document.getElementById('regionSearchMap');

        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Retirer active de tous
                filterTabs.forEach(t => t.classList.remove('active'));
                // Activer le tab cliqué
                this.classList.add('active');

                const filter = this.dataset.filter;

                // Filtrer les cartes
                regionCards.forEach(card => {
                    const regionZone = card.dataset.regionZone || '';

                    if (filter === 'all' || filter === regionZone) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeIn 0.5s ease';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Recherche globale
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                const activeFilter = document.querySelector('.filter-tab-modern.active')?.dataset.filter || 'all';

                regionCards.forEach(card => {
                    const regionName = card.dataset.regionName || '';
                    const regionZone = card.dataset.regionZone || '';

                    const matchesSearch = regionName.includes(query);
                    const matchesFilter = activeFilter === 'all' || activeFilter === regionZone;

                    if (matchesSearch && matchesFilter) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeIn 0.5s ease';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    }

    // Initialiser les particules
    function initParticles() {
        const particlesContainer = document.getElementById('heroParticles');
        if (!particlesContainer) return;

        for (let i = 0; i < 50; i++) {
            createParticle(particlesContainer);
        }
    }

    function createParticle(container) {
        const particle = document.createElement('div');
        particle.style.cssText = `
            position: absolute;
            width: ${Math.random() * 8 + 2}px;
            height: ${Math.random() * 8 + 2}px;
            background: #FCD116;
            border-radius: 50%;
            top: ${Math.random() * 100}%;
            left: ${Math.random() * 100}%;
            opacity: ${Math.random() * 0.4 + 0.1};
            animation: floatParticle ${Math.random() * 20 + 10}s linear infinite;
        `;

        const style = document.createElement('style');
        if (!document.querySelector('#particles-style')) {
            style.id = 'particles-style';
            style.textContent = `
                @keyframes floatParticle {
                    0% { transform: translate(0, 0) rotate(0deg); opacity: 0.5; }
                    50% { opacity: 1; }
                    100% { transform: translate(${Math.random() * 100 - 50}px, -100vh) rotate(${Math.random() * 360}deg); opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        }

        container.appendChild(particle);

        // Recycler les particules
        setTimeout(() => {
            if (particle.parentNode === container) {
                container.removeChild(particle);
                createParticle(container);
            }
        }, (Math.random() * 20 + 10) * 1000);
    }

    // Animation au scroll
    window.addEventListener('scroll', function() {
        const cards = document.querySelectorAll('.region-card-premium');
        const windowHeight = window.innerHeight;

        cards.forEach(card => {
            const cardTop = card.getBoundingClientRect().top;
            if (cardTop < windowHeight - 100) {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }
        });
    });

    // Effet de parallaxe sur les cartes
    window.addEventListener('mousemove', function(e) {
        const cards = document.querySelectorAll('.region-card-premium');
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;

        cards.forEach((card, index) => {
            const speed = 0.3;
            const x = (mouseX * speed * 20) - 10;
            const y = (mouseY * speed * 20) - 10;

            card.style.transform = `
                translateY(-15px)
                perspective(1000px)
                rotateY(${x}deg)
                rotateX(${-y}deg)
            `;
        });
    });
});
</script>

<style>
    /* Animation fadeIn pour les cartes */
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

    .region-card-premium {
        animation: fadeIn 0.5s ease;
    }

    /* Personnalisation des popups Leaflet */
    .leaflet-popup-content-wrapper {
        border-radius: 15px !important;
        box-shadow: 0 15px 40px rgba(0,0,0,0.2) !important;
        border: 2px solid var(--primary);
    }

    .leaflet-popup-content {
        margin: 10px !important;
    }

    .leaflet-popup-tip {
        background: var(--primary) !important;
    }

    /* Amélioration de l'apparence des marqueurs */
    .custom-marker {
        transition: all 0.3s ease !important;
    }
</style>
@endpush

