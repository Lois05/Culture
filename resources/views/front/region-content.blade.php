@extends('layouts.layout_front')

@section('title', $region->nom_region . ' - Bénin Culture')

@push('styles')
<style>
    .region-detail-hero {
        background: linear-gradient(135deg, rgba(26, 26, 46, 0.9), rgba(26, 26, 46, 0.95)),
                    url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?auto=format&fit=crop&w=1600&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 8rem 0 4rem;
        margin-top: -80px;
        position: relative;
    }

    .region-flag {
        width: 100px;
        height: 70px;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .region-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin: 2rem 0;
    }

    .stat-card-region {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .region-tabs {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-top: -50px;
        position: relative;
        z-index: 10;
    }

    .nav-tabs-custom {
        border: none;
        padding: 1.5rem 1.5rem 0;
        background: #f8f9fa;
    }

    .nav-tabs-custom .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 600;
        padding: 1rem 1.5rem;
        border-radius: 15px 15px 0 0;
        margin-right: 5px;
        transition: all 0.3s ease;
    }

    .nav-tabs-custom .nav-link:hover {
        color: var(--primary);
        background: rgba(232, 17, 45, 0.1);
    }

    .nav-tabs-custom .nav-link.active {
        color: var(--primary);
        background: white;
        border-bottom: 3px solid var(--primary);
    }

    .tab-content-custom {
        padding: 2.5rem;
    }

    .culture-highlight {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 20px;
        padding: 3rem;
        margin: 2rem 0;
    }

    .tradition-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        height: 100%;
        border-left: 5px solid var(--primary);
    }

    .tradition-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .language-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        border-top: 4px solid var(--secondary);
    }

    .content-filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 2rem 0;
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 15px;
    }

    .filter-btn-region {
        padding: 8px 20px;
        border-radius: 20px;
        border: 2px solid #dee2e6;
        background: white;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: inline-flex;
        align-items: center;
    }

    .filter-btn-region:hover,
    .filter-btn-region.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        text-decoration: none;
    }

    .map-mini {
        height: 300px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .contributor-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: all 0.3s ease;
    }

    .contributor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .contributor-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 1rem;
        border: 3px solid var(--primary);
    }

    .region-sidebar {
        position: sticky;
        top: 100px;
    }

    .sidebar-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .culture-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
    }

    .culture-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .culture-card-img {
        height: 200px;
        overflow: hidden;
    }

    .culture-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .culture-card:hover .culture-card-img img {
        transform: scale(1.05);
    }

    .culture-card-body {
        padding: 1.5rem;
    }

    .culture-card-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        color: white;
        z-index: 1;
    }

    @media (max-width: 768px) {
        .region-tabs {
            margin-top: 0;
        }

        .region-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .tab-content-custom {
            padding: 1.5rem 1rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="region-detail-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="region-flag" style="background: var(--primary);"></div>
                <h1 class="display-3 fw-bold mb-3">Région de {{ $region->nom_region }}</h1>
                @if($region->description)
                <p class="lead mb-4">
                    {{ $region->description }}
                </p>
                @endif

                <div class="d-flex flex-wrap gap-3">
                    <a href="#contents" class="btn btn-primary-custom">
                        <i class="bi bi-book me-2"></i>Explorer les contenus
                    </a>
                    <a href="#carte" class="btn btn-outline-light">
                        <i class="bi bi-map me-2"></i>Voir sur la carte
                    </a>
                    <a href="{{ route('dashboard.contribuer') }}?region={{ $region->id_region }}" class="btn btn-outline-light">
                        <i class="bi bi-plus-circle me-2"></i>Contribuer
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Region Stats -->
<section class="py-5">
    <div class="container">
        <div class="region-stats">
            <div class="stat-card-region">
                <div class="display-6 fw-bold text-primary">{{ number_format($stats['contenus_count'], 0, ',', ' ') }}</div>
                <div>Contenus culturels</div>
            </div>
            <div class="stat-card-region">
                <div class="display-6 fw-bold text-secondary">{{ $stats['groupes_count'] }}</div>
                <div>Groupes ethniques</div>
            </div>
            <div class="stat-card-region">
                <div class="display-6 fw-bold text-accent">{{ $stats['contributeurs_count'] }}</div>
                <div>Contributeurs actifs</div>
            </div>
            <div class="stat-card-region">
                <div class="display-6 fw-bold text-primary">{{ $stats['langues_count'] }}</div>
                <div>Langues principales</div>
            </div>
            <div class="stat-card-region">
                <div class="display-6 fw-bold text-secondary">{{ $stats['types_count'] }}</div>
                <div>Types de contenus</div>
            </div>
        </div>
    </div>
</section>

<!-- Region Tabs -->
<section class="region-tabs">
    <div class="container">
        <ul class="nav nav-tabs nav-tabs-custom" id="regionTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview">
                    <i class="bi bi-info-circle me-2"></i>Vue d'ensemble
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contents-tab" data-bs-toggle="tab" data-bs-target="#contents">
                    <i class="bi bi-book me-2"></i>Contenus ({{ number_format($contenus->total(), 0, ',', ' ') }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="traditions-tab" data-bs-toggle="tab" data-bs-target="#traditions">
                    <i class="bi bi-calendar3 me-2"></i>Traditions
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="languages-tab" data-bs-toggle="tab" data-bs-target="#languages">
                    <i class="bi bi-translate me-2"></i>Langues
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contributors-tab" data-bs-toggle="tab" data-bs-target="#contributors">
                    <i class="bi bi-people me-2"></i>Contributeurs
                </button>
            </li>
        </ul>

        <div class="tab-content tab-content-custom" id="regionTabContent">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="fw-bold mb-4">La richesse culturelle de {{ $region->nom_region }}</h3>

                        @if($region->description)
                        <p>{{ $region->description }}</p>
                        @else
                        <p>Découvrez la richesse culturelle unique de la région {{ $region->nom_region }},
                           avec ses traditions ancestrales et son patrimoine exceptionnel.</p>
                        @endif

                        <div class="culture-highlight">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="fw-bold mb-3">Patrimoine culturel</h4>
                                    <p class="mb-0">
                                        Cette région possède un riche patrimoine culturel avec {{ $stats['contenus_count'] }} contenus documentés
                                        par {{ $stats['contributeurs_count'] }} contributeurs passionnés.
                                    </p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <i class="bi bi-award fs-1 text-primary"></i>
                                </div>
                            </div>
                        </div>

                        <h4 class="fw-bold mt-5 mb-3">Informations sur la région</h4>
                        <div class="row g-4">
                            @if($region->superficie)
                            <div class="col-md-6">
                                <div class="tradition-card">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary rounded-circle p-2 me-3">
                                            <i class="bi bi-geo text-white"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">Superficie</h5>
                                            <small class="text-muted">{{ number_format($region->superficie, 0, ',', ' ') }} km²</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">{{ $region->localisation ?? 'Localisation non spécifiée' }}</p>
                                </div>
                            </div>
                            @endif

                            @if($region->population)
                            <div class="col-md-6">
                                <div class="tradition-card">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-secondary rounded-circle p-2 me-3">
                                            <i class="bi bi-people text-white"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">Population</h5>
                                            <small class="text-muted">{{ number_format($region->population, 0, ',', ' ') }} habitants</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">Riche diversité culturelle et linguistique</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="region-sidebar">
                            <div class="sidebar-card">
                                <h5 class="fw-bold mb-3">
                                    <i class="bi bi-map me-2"></i>Carte de la région
                                </h5>
                                <div class="map-mini" id="region-map-mini"></div>
                            </div>

                            <div class="sidebar-card">
                                <h5 class="fw-bold mb-3">
                                    <i class="bi bi-pie-chart me-2"></i>Répartition des contenus
                                </h5>
                                @php
                                    $topTypes = $types->sortByDesc('contenus_count')->take(5);
                                    $maxCount = $topTypes->isNotEmpty() ? $topTypes->max('contenus_count') : 1;
                                @endphp

                                @if($topTypes->isNotEmpty())
                                    @foreach($topTypes as $type)
                                    <div class="mb-2">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="small">
                                                <i class="bi {{ $typeIcons[$type->id_type_contenu]['icon'] ?? 'bi-grid' }} me-1"></i>
                                                {{ $type->nom_contenu }}
                                            </span>
                                            <span class="small fw-bold">{{ $type->contenus_count }}</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar"
                                                 role="progressbar"
                                                 style="width: {{ $type->contenus_count > 0 ? ($type->contenus_count / $maxCount * 100) : 0 }}%;
                                                        background-color: {{ $typeIcons[$type->id_type_contenu]['color'] ?? '#6c757d' }};">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-3">
                                        <p class="text-muted small mb-0">Aucun contenu disponible</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contents Tab -->
            <div class="tab-pane fade" id="contents" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold mb-0">{{ number_format($contenus->total(), 0, ',', ' ') }} contenus culturels</h3>
                        <p class="text-muted mb-0">Explorez la richesse documentaire de la région</p>
                    </div>
                    <div>
                        <a href="{{ route('front.explorer', ['region' => $region->id_region]) }}" class="btn btn-primary-custom">
                            <i class="bi bi-compass me-2"></i>Explorer tous
                        </a>
                    </div>
                </div>

                <!-- Filter by type -->
                <div class="content-filter-bar">
                    <a href="{{ route('front.explorer', ['region' => $region->id_region]) }}"
                       class="filter-btn-region {{ !request('type') ? 'active' : '' }}">
                        <i class="bi bi-grid-3x3 me-1"></i>Tous
                    </a>

                    @foreach($types as $type)
                    @if($type->contenus_count > 0)
                    <a href="{{ route('front.explorer', ['region' => $region->id_region, 'type' => $type->id_type_contenu]) }}"
                       class="filter-btn-region {{ request('type') == $type->id_type_contenu ? 'active' : '' }}"
                       style="border-left: 4px solid {{ $typeIcons[$type->id_type_contenu]['color'] ?? '#6c757d' }};">
                        <i class="bi {{ $typeIcons[$type->id_type_contenu]['icon'] ?? 'bi-grid' }} me-1"></i>
                        {{ $type->nom_contenu }}
                        <span class="badge bg-secondary ms-1">{{ $type->contenus_count }}</span>
                    </a>
                    @endif
                    @endforeach
                </div>

                <!-- Content Grid -->
                @if($contenus->count() > 0)
                <div class="row" id="region-contents-grid">
                    @foreach($contenus as $contenu)
                    @php
                        $type = $contenu->typeContenu;
                        $typeColor = isset($typeIcons[$type->id_type_contenu]['color']) ? $typeIcons[$type->id_type_contenu]['color'] : '#E8112D';
                        $typeIcon = isset($typeIcons[$type->id_type_contenu]['icon']) ? $typeIcons[$type->id_type_contenu]['icon'] : 'bi-book';
                        $typeName = $type ? $type->nom_contenu : 'Type inconnu';

                        // Générer des stats fictives
                        $vues = rand(300, 5000);
                        $commentaires = (int) ($vues * (rand(1, 5) / 100));
                    @endphp

                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="{{ route('front.contenu', ['id' => $contenu->id_contenu]) }}" class="text-decoration-none">
                            <div class="culture-card h-100">
                              <div class="culture-card-img position-relative">
    <img src="{{ $contenu->image_url ?? asset('adminlte/img/collage.png') }}"
         class="img-fluid" alt="{{ $contenu->titre }}">
    <div class="culture-card-badge" style="background-color: {{ $typeColor }};">
        <i class="bi {{ $typeIcon }} me-1"></i>
        {{ $typeName }}
    </div>
</div>
                                <div class="culture-card-body">
                                    <h5 class="fw-bold mb-2">{{ $contenu->titre }}</h5>
                                    <p class="text-muted small mb-3" style="min-height: 60px;">
                                        {{ Str::limit(strip_tags($contenu->texte), 100) }}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if($contenu->auteur)
                                            <small class="text-muted">
                                                <i class="bi bi-person-circle me-1"></i>
                                                {{ $contenu->auteur->name }}
                                            </small>
                                            @endif
                                        </div>
                                        <div class="d-flex gap-3">
                                            <small class="text-muted">
                                                <i class="bi bi-eye me-1"></i>
                                                {{ number_format($vues, 0, ',', ' ') }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="bi bi-chat me-1"></i>
                                                {{ $commentaires }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($contenus->hasPages())
                <nav aria-label="Page navigation" class="mt-5">
                    <ul class="pagination justify-content-center">
                        @if($contenus->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $contenus->previousPageUrl() }}">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>
                        @endif

                        @foreach(range(1, $contenus->lastPage()) as $i)
                        @if($i == $contenus->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $contenus->url($i) }}">{{ $i }}</a>
                        </li>
                        @endif
                        @endforeach

                        @if($contenus->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $contenus->nextPageUrl() }}">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
                @endif
                @else
                <!-- Aucun contenu -->
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-book display-1 text-muted mb-4"></i>
                        <h3 class="mb-3">Aucun contenu disponible</h3>
                        <p class="text-muted mb-4">
                            Aucun contenu n'est disponible pour cette région pour le moment.
                        </p>
                        <a href="{{ route('dashboard.contribuer') }}?region={{ $region->id_region }}" class="btn btn-primary-custom">
                            <i class="bi bi-plus-circle me-2"></i>Être le premier à contribuer
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Traditions Tab -->
            <div class="tab-pane fade" id="traditions" role="tabpanel">
                <h3 class="fw-bold mb-4">Traditions & Patrimoine</h3>

                <div class="row g-4">
                    @foreach($traditions as $tradition)
                    <div class="col-lg-6">
                        <div class="tradition-card">
                            <div class="d-flex align-items-start mb-3">
                                <div class="bg-primary rounded-circle p-2 me-3">
                                   <i class="bi {{ $tradition['icon'] ?? 'bi-star' }} text-white"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $tradition['title'] }}</h5>
                                </div>
                            </div>
                            <p class="text-muted mb-3">
                                {{ $tradition['description'] }}
                            </p>
                            <div class="d-flex align-items-center">
                                @foreach($tradition['tags'] as $tag)
                                <span class="badge bg-secondary me-2">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Languages Tab -->
            <div class="tab-pane fade" id="languages" role="tabpanel">
                <h3 class="fw-bold mb-4">Diversité linguistique</h3>

                @if(!empty($langues))
                <div class="row mb-5">
                    @foreach($langues as $index => $langue)
                    <div class="col-lg-6">
                        <div class="language-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0">{{ $langue }}</h5>
                                @if($index == 0)
                                <span class="badge bg-primary">Langue principale</span>
                                @else
                                <span class="badge bg-secondary">Langue locale</span>
                                @endif
                            </div>
                            <p class="text-muted mb-3">
                                Langue traditionnelle parlée dans la région {{ $region->nom_region }}.
                                Fait partie du patrimoine culturel immatériel de la région.
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-info-circle fs-4 me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-2">Information linguistique</h6>
                            <p class="mb-0">
                                Les données linguistiques pour cette région ne sont pas encore disponibles.
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Contributors Tab -->
            <div class="tab-pane fade" id="contributors" role="tabpanel">
                <h3 class="fw-bold mb-4">Contributeurs de la région</h3>
                <p class="text-muted mb-4">{{ $contributeurs->count() }} contributeurs actifs documentent la culture de {{ $region->nom_region }}</p>

                @if($contributeurs->count() > 0)
                <div class="row g-4">
                    @foreach($contributeurs as $contributeur)
                    <div class="col-lg-4 col-md-6">
                        <div class="contributor-card">
                            @if($contributeur->photo)
                            <img src="{{ asset($contributeur->photo) }}"
                                 class="contributor-avatar"
                                 alt="{{ $contributeur->name }}">
                            @else
                            <div class="contributor-avatar bg-primary d-flex align-items-center justify-content-center text-white">
                                <i class="bi bi-person fs-3"></i>
                            </div>
                            @endif
                            <h5 class="fw-bold mb-1">{{ $contributeur->name }}</h5>
                            <p class="text-muted small mb-3">Contributeur actif</p>

                            <div class="d-flex justify-content-center gap-3 mb-3">
                                <div class="text-center">
                                    <div class="fw-bold">{{ $contributeur->contenus_count }}</div>
                                    <small class="text-muted">Contenus</small>
                                </div>
                                <div class="text-center">
                                    <div class="fw-bold">{{ rand(10, 500) }}</div>
                                    <small class="text-muted">Followers</small>
                                </div>
                            </div>

                            <a href="#" class="btn btn-outline-primary btn-sm w-100">
                                <i class="bi bi-person-plus me-2"></i>Suivre
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-people display-1 text-muted mb-4"></i>
                        <h3 class="mb-3">Aucun contributeur</h3>
                        <p class="text-muted mb-4">
                            Aucun contributeur n'a encore publié de contenu pour cette région.
                        </p>
                        <a href="{{ route('dashboard.contribuer') }}?region={{ $region->id_region }}" class="btn btn-primary-custom">
                            <i class="bi bi-plus-circle me-2"></i>Devenir le premier contributeur
                        </a>
                    </div>
                </div>
                @endif

                <div class="text-center mt-5">
                    <a href="{{ route('dashboard.contribuer') }}?region={{ $region->id_region }}" class="btn btn-primary-custom px-5 py-3">
                        <i class="bi bi-plus-circle me-2"></i>Devenir contributeur pour {{ $region->nom_region }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <div class="cta-content">
                    <h2 class="cta-title mb-4">Connaissez-vous bien {{ $region->nom_region }} ?</h2>
                    <p class="lead mb-5 opacity-90" style="font-size: 1.3rem;">
                        Partagez vos connaissances sur cette région et contribuez
                        à préserver son patrimoine pour les générations futures.
                    </p>
                    <div class="cta-buttons">
                        <a href="{{ route('dashboard.contribuer') }}?region={{ $region->id_region }}" class="btn btn-cta-primary">
                            <i class="bi bi-plus-circle me-2"></i>Ajouter un contenu
                        </a>
                        <a href="{{ route('front.explorer', ['region' => $region->id_region]) }}" class="btn btn-cta-outline">
                            <i class="bi bi-compass me-2"></i>Explorer davantage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser la carte si l'élément existe
    if (document.getElementById('region-map-mini')) {
        initRegionMap();
    }
});

function initRegionMap() {
    try {
        // Coordonnées approximatives pour centrer sur le Bénin
        const map = L.map('region-map-mini').setView([9.3077, 2.3158], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 12,
        }).addTo(map);

        // Ajouter un marqueur pour la région
        L.marker([9.3077, 2.3158]).addTo(map)
            .bindPopup('<b>{{ $region->nom_region }}</b><br>Région culturelle');
    } catch (error) {
        console.log('Erreur lors de l\'initialisation de la carte:', error);
        document.getElementById('region-map-mini').innerHTML = `
            <div class="text-center py-5">
                <i class="bi bi-map text-muted fs-1"></i>
                <p class="text-muted mt-2">Carte non disponible</p>
            </div>
        `;
    }
}
</script>
@endpush
