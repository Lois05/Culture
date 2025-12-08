@extends('layouts.layout_front')

@section('title', 'Régions - Bénin Culture')

@push('styles')
<style>
    .region-hero {
        background: linear-gradient(135deg, rgba(26, 26, 46, 0.9), rgba(26, 26, 46, 0.95)),
                    url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?auto=format&fit=crop&w=1600&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 8rem 0 4rem;
        margin-top: -80px;
    }

    .region-card {
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .region-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .region-image {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .region-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        backdrop-filter: blur(10px);
        background: var(--primary);
        color: white;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 1.8rem;
    }

    .region-detail {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 20px;
        padding: 3rem;
    }

    .type-filter {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 2rem;
    }

    .type-btn {
        padding: 8px 20px;
        border-radius: 20px;
        border: 2px solid #e9ecef;
        background: white;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .type-btn:hover,
    .type-btn.active {
        background: var(--primary);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
    }

    .content-type-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .region-content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1A1A2E;
        margin-bottom: 1rem;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
    }

    .custom-marker {
        background: none !important;
        border: none !important;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="region-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Régions Culturelles du Bénin</h1>
                <p class="lead mb-4">
                    Explorez la diversité culturelle à travers les {{ $stats['total_regions'] }} régions du Bénin,
                    chacune avec ses traditions, langues et patrimoines uniques.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#carte" class="btn btn-primary-custom">
                        <i class="bi bi-map me-2"></i>Carte Interactive
                    </a>
                    <a href="#regions" class="btn btn-outline-light">
                        <i class="bi bi-grid-3x3 me-2"></i>Voir Toutes
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistiques -->
<section class="py-5">
    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(252, 209, 22, 0.1); color: #FCD116;">
                        <i class="bi bi-globe"></i>
                    </div>
                    <h3 class="fw-bold mb-2">{{ $stats['total_regions'] }}</h3>
                    <p class="text-muted mb-0">Régions</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(0, 135, 81, 0.1); color: #008751;">
                        <i class="bi bi-translate"></i>
                    </div>
                    <h3 class="fw-bold mb-2">{{ count($regionLangues, COUNT_RECURSIVE) - count($regionLangues) }}</h3>
                    <p class="text-muted mb-0">Langues locales</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(232, 17, 45, 0.1); color: #E8112D;">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="fw-bold mb-2">{{ $stats['total_utilisateurs'] }}</h3>
                    <p class="text-muted mb-0">Contributeurs</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(26, 26, 46, 0.1); color: #1A1A2E;">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <h3 class="fw-bold mb-2">{{ number_format($stats['total_contenus'], 0, ',', ' ') }}</h3>
                    <p class="text-muted mb-0">Contenus</p>
                </div>
            </div>
        </div>

        <!-- Filtres par type de contenu -->
        <div class="row mb-5">
            <div class="col-12">
                <h4 class="fw-bold mb-3">Filtrer par type de contenu :</h4>
                <div class="type-filter">
                    <button class="type-btn active" data-type="all">
                        <i class="bi bi-grid-3x3 me-1"></i>Tous les types
                    </button>

                    @foreach($typesContenus as $type)
                    <button class="type-btn" data-type="{{ $type->id_type_contenu }}"
                            style="border-left: 4px solid {{ $typeIcons[$type->id_type_contenu]['color'] ?? '#6c757d' }};">
                        <i class="bi {{ $typeIcons[$type->id_type_contenu]['icon'] ?? 'bi-grid' }} me-1"></i>
                        {{ $type->nom_contenu }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Carte Interactive -->
<section id="carte" class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Carte Interactive des Régions</h2>
                <p class="section-subtitle">Cliquez sur une région pour explorer sa culture</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="benin-map" style="height: 600px; border-radius: 20px; overflow: hidden;"></div>
            </div>
        </div>
    </div>
</section>

<!-- Liste des Régions -->
<section id="regions" class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Explorez par Région</h2>
                <p class="section-subtitle">Découvrez les spécificités culturelles de chaque région</p>
            </div>
        </div>

        @if($regions->count() > 0)
        <div class="row g-4">
            @foreach($regions as $region)
            @php
                // Slug pour l'URL
                $slug = Str::slug($region->nom_region);

                // Nombre de contributeurs uniques
                $contributeurs = $region->contenus()
                    ->where('statut', 'validé')
                    ->distinct('id_auteur')
                    ->count('id_auteur');

                // Langues de la région
                $langues = $regionLangues[$region->id_region] ?? ['Langue non spécifiée'];

                // Types de contenus pour cette région
                $typesRegion = $typesCountByRegion[$region->id_region] ?? [];

                // Couleur pour la région
                $colors = ['#E8112D', '#FCD116', '#008751', '#1A1A2E', '#6f42c1', '#fd7e14', '#20c997'];
                $color = $colors[$loop->index % count($colors)];
            @endphp

            <div class="col-lg-4 col-md-6">
                <a href="{{ route('front.region', ['slug' => $slug]) }}" class="text-decoration-none">
                    <div class="region-card">
                        <div class="position-relative">
                            <!-- Image de la région -->
                            <div class="region-image" style="background: {{ $color }}; display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="bi bi-geo-alt" style="font-size: 4rem;"></i>
                            </div>
                            <div class="region-badge" style="background: {{ $color }}; color: white;">
                                {{ $region->nom_region }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="fw-bold mb-2">{{ $region->nom_region }}</h4>
                            @if($region->description)
                            <p class="text-muted mb-3">{{ Str::limit($region->description, 80) }}</p>
                            @endif

                            <!-- Langues -->
                            <div class="mb-3">
                                <small class="fw-bold d-block mb-2">Langues principales :</small>
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($langues as $langue)
                                    <span class="badge bg-light text-dark">{{ $langue }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Types de contenus -->
                            <div class="mb-3">
                                <small class="fw-bold d-block mb-2">Types de contenus :</small>
                                <div class="d-flex flex-wrap">
                                    @foreach(array_slice($typesRegion, 0, 3) as $type)
                                    <span class="content-type-badge"
                                          style="background: {{ $typeIcons[$type['type_id']]['color'] ?? '#6c757d' }}10;
                                                 color: {{ $typeIcons[$type['type_id']]['color'] ?? '#6c757d' }};
                                                 border: 1px solid {{ $typeIcons[$type['type_id']]['color'] ?? '#6c757d' }}30;">
                                        <i class="bi {{ $typeIcons[$type['type_id']]['icon'] ?? 'bi-grid' }}"></i>
                                        {{ $type['count'] }} {{ Str::limit($type['nom'], 12) }}
                                    </span>
                                    @endforeach
                                    @if(count($typesRegion) > 3)
                                    <span class="badge bg-secondary ms-1">+{{ count($typesRegion) - 3 }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Stats -->
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <div>
                                    <small class="text-muted d-block">Contenus</small>
                                    <span class="fw-bold">{{ $region->contenus_count }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Contributeurs</small>
                                    <span class="fw-bold">{{ $contributeurs }}</span>
                                </div>
                                <span class="text-primary">
                                    Explorer <i class="bi bi-arrow-right ms-1"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <!-- Aucune région -->
        <div class="row">
            <div class="col-12 text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-globe display-1 text-muted mb-4"></i>
                    <h3 class="mb-3">Aucune région disponible</h3>
                    <p class="text-muted mb-4">
                        Aucune région n'est disponible pour le moment.
                    </p>
                </div>
            </div>
        </div>
        @endif

        <div class="text-center mt-5">
            <a href="#carte" class="btn btn-primary-custom px-5 py-3">
                <i class="bi bi-compass me-2"></i>Voir toutes les régions sur la carte
            </a>
        </div>
    </div>
</section>

<!-- Région en vedette -->
<section class="py-5 bg-light">
    <div class="container">
        @if($regions->count() > 0)
        @php
            // Prendre la région avec le plus de contenus
            $regionVedette = $regions->sortByDesc('contenus_count')->first();
            $slugVedette = Str::slug($regionVedette->nom_region);
            $typesVedette = $typesCountByRegion[$regionVedette->id_region] ?? [];
            $languesVedette = $regionLangues[$regionVedette->id_region] ?? ['Langue non spécifiée'];
        @endphp

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="region-detail">
                    <div class="row align-items-center">
                        <div class="col-lg-4 text-center mb-4 mb-lg-0">
                            <div class="rounded-circle overflow-hidden mx-auto d-flex align-items-center justify-content-center"
                                 style="width: 200px; height: 200px; background: var(--primary); color: white;">
                                <i class="bi bi-geo-alt" style="font-size: 4rem;"></i>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <h3 class="fw-bold mb-3">Région en Vedette : <span class="text-primary">{{ $regionVedette->nom_region }}</span></h3>
                            @if($regionVedette->description)
                            <p class="mb-4">{{ Str::limit($regionVedette->description, 200) }}</p>
                            @endif

                            <!-- Statistiques -->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="text-center">
                                            <h4 class="fw-bold text-primary">{{ $regionVedette->contenus_count }}</h4>
                                            <small class="text-muted">Contenus</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="text-center">
                                            <h4 class="fw-bold text-primary">{{ count($typesVedette) }}</h4>
                                            <small class="text-muted">Types de contenus</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="text-center">
                                            <h4 class="fw-bold text-primary">{{ count($languesVedette) }}</h4>
                                            <small class="text-muted">Langues</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-3">
                                <a href="{{ route('front.regions', ['slug' => $slugVedette]) }}" class="btn btn-primary-custom">
                                    <i class="bi bi-eye me-2"></i>Explorer la région
                                </a>
                                <a href="{{ route('front.explorer', ['region' => $regionVedette->id_region]) }}" class="btn btn-outline-primary">
                                    <i class="bi bi-book me-2"></i>Voir les contenus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<!-- Inclure Leaflet CSS et JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser la carte si l'élément existe
    if (document.getElementById('benin-map')) {
        initBeninMap();
    }

    // Filtrage par type de contenu
    const typeButtons = document.querySelectorAll('.type-btn');

    typeButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Retirer la classe active de tous les boutons
            typeButtons.forEach(btn => btn.classList.remove('active'));

            // Ajouter la classe active au bouton cliqué
            this.classList.add('active');

            const selectedType = this.dataset.type;

            // Ici, vous pouvez ajouter la logique de filtrage AJAX
            // Pour le moment, on redirige vers l'explorer avec le filtre
            if (selectedType !== 'all') {
                window.location.href = "{{ route('front.explorer') }}?type=" + selectedType;
            }
        });
    });
});

function initBeninMap() {
    // Initialiser la carte centrée sur le Bénin
    const map = L.map('benin-map').setView([9.3077, 2.3158], 7);

    // Ajouter les tuiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 18,
    }).addTo(map);

    // Coordonnées approximatives des régions du Bénin
    const regionsData = {
        @foreach($regions as $region)
        "{{ $region->id_region }}": {
            name: "{{ $region->nom_region }}",
            coords: [
                {{ 9.3077 + (($loop->index - 6) * 0.5) }},
                {{ 2.3158 + (($loop->index - 6) * 0.3) }}
            ],
            color: ['#E8112D', '#FCD116', '#008751', '#1A1A2E', '#6f42c1', '#fd7e14'][{{ $loop->index }} % 6],
            contenus: {{ $region->contenus_count }},
            slug: "{{ Str::slug($region->nom_region) }}",
            langues: {{ json_encode($regionLangues[$region->id_region] ?? ['Non spécifié']) }},
            types: {{ json_encode(array_column($typesCountByRegion[$region->id_region] ?? [], 'type_id')) }}
        },
        @endforeach
    };

    // Types de contenus pour les popups
    const typesContenus = {
        @foreach($typesContenus as $type)
        {{ $type->id_type_contenu }}: {
            nom: "{{ $type->nom_contenu }}",
            icon: "{{ $typeIcons[$type->id_type_contenu]['icon'] ?? 'bi-grid' }}",
            color: "{{ $typeIcons[$type->id_type_contenu]['color'] ?? '#6c757d' }}"
        },
        @endforeach
    };

    // Ajouter les marqueurs pour chaque région
    Object.entries(regionsData).forEach(([id, region]) => {
        const icon = L.divIcon({
            html: `
                <div style="
                    width: 40px;
                    height: 40px;
                    background: ${region.color};
                    border-radius: 50%;
                    border: 3px solid white;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-weight: bold;
                    font-size: 12px;
                ">
                    ${region.name.substring(0, 3)}
                </div>
            `,
            className: 'custom-marker',
            iconSize: [40, 40],
            iconAnchor: [20, 20]
        });

        const marker = L.marker(region.coords, { icon: icon }).addTo(map);

        // Construire le contenu du popup
        let typesList = '';
        if (region.types && region.types.length > 0) {
            region.types.forEach(typeId => {
                const type = typesContenus[typeId];
                if (type) {
                    typesList += `
                        <div class="d-flex align-items-center mb-1">
                            <i class="bi ${type.icon} me-2" style="color: ${type.color}"></i>
                            <span>${type.nom}</span>
                        </div>
                    `;
                }
            });
        }

        let languesList = '';
        region.langues.forEach(langue => {
            languesList += `<span class="badge bg-light text-dark me-1 mb-1">${langue}</span>`;
        });

        marker.bindPopup(`
            <div style="min-width: 300px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                <h5 class="fw-bold mb-2" style="color: ${region.color}">
                    <i class="bi bi-geo-alt me-2"></i>${region.name}
                </h5>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <small class="text-muted">
                            <i class="bi bi-file-text me-1"></i>${region.contenus} contenus
                        </small>
                        <small class="text-muted">
                            <i class="bi bi-people me-1"></i>${region.langues.length} langues
                        </small>
                    </div>
                </div>

                <div class="mb-3">
                    <small class="fw-bold d-block mb-2">Langues :</small>
                    <div class="d-flex flex-wrap">
                        ${languesList}
                    </div>
                </div>

                ${typesList ? `
                <div class="mb-3">
                    <small class="fw-bold d-block mb-2">Types de contenus :</small>
                    ${typesList}
                </div>
                ` : ''}

                <div class="text-center mt-4">
                    <button onclick="window.location.href='{{ url('/region') }}/${region.slug}'"
                            class="btn btn-sm w-100"
                            style="background: ${region.color}; color: white; border: none; border-radius: 10px; padding: 8px 0;">
                        <i class="bi bi-compass me-2"></i>Explorer ${region.name}
                    </button>
                </div>
            </div>
        `);

        // Animation au clic
        marker.on('click', function() {
            this.openPopup();
        });
    });

    // Ajouter un contrôleur de zoom
    L.control.zoom({
        position: 'topright'
    }).addTo(map);
}
</script>
@endpush
