@extends('layouts.layout_front')

@section('title', 'Explorer - Bénin Culture')

@section('content')
    <section class="hero-section" style="height: 60vh; min-height: 400px;">
        <div class="container">
            <div class="row align-items-center h-100">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="hero-content">
                        <h1 class="hero-title mb-4">Explorez la richesse culturelle</h1>
                        <p class="lead mb-5" style="font-size: 1.3rem; opacity: 0.9;">
                            Découvrez des milliers de contenus culturels, historiques et traditionnels
                        </p>

                        <!-- Barre de recherche -->
                        <form action="{{ route('front.explorer') }}" method="GET">
                            <div class="search-bar mb-5">
                                <div class="input-group input-group-lg shadow-lg">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="bi bi-search text-primary"></i>
                                    </span>
                                    <input type="text" name="q" class="form-control border-0"
                                        placeholder="Rechercher un contenu, une région, une langue..."
                                        value="{{ request('q') }}">
                                    <button class="btn btn-primary-custom px-4" type="submit">
                                        Explorer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filtres -->
    <section class="py-4 bg-light">
        <div class="container">
            <form action="{{ route('front.explorer') }}" method="GET" id="filter-form">
                <input type="hidden" name="q" value="{{ request('q') }}">
                <div class="row g-3">
                    <!-- Filtre Type de contenu -->
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button
                                class="btn btn-light w-100 text-start d-flex justify-content-between align-items-center py-3 shadow-sm"
                                type="button" data-bs-toggle="dropdown">
                                <span>
                                    <i class="bi bi-grid-3x3-gap me-2"></i>
                                    Type de contenu
                                    @if (request('type'))
                                        <span class="badge bg-primary ms-2">Filtré</span>
                                    @endif
                                </span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu w-100 p-3">
                                <li>
                                    <a class="dropdown-item {{ !request('type') ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['type' => null]) }}">
                                        <i class="bi bi-grid me-2"></i> Tous les types
                                    </a>
                                </li>
                                @foreach ($typesContenus as $type)
                                    <li>
                                        <a class="dropdown-item {{ request('type') == $type->id_type_contenu ? 'active' : '' }}"
                                            href="{{ request()->fullUrlWithQuery(['type' => $type->id_type_contenu]) }}">
                                            <i class="bi {{ $typeIcons[$type->id_type_contenu] ?? 'bi-grid' }} me-2"></i>
                                            {{ $type->nom_contenu }}
                                            <span
                                                class="badge bg-secondary float-end">{{ $typeCounts[$type->id_type_contenu] ?? 0 }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Filtre Région -->
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button
                                class="btn btn-light w-100 text-start d-flex justify-content-between align-items-center py-3 shadow-sm"
                                type="button" data-bs-toggle="dropdown">
                                <span>
                                    <i class="bi bi-geo-alt me-2"></i>
                                    Régions
                                    @if (request('region'))
                                        <span class="badge bg-primary ms-2">Filtré</span>
                                    @endif
                                </span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu w-100 p-3">
                                <li>
                                    <a class="dropdown-item {{ !request('region') ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['region' => null]) }}">
                                        <i class="bi bi-geo me-2"></i> Toutes les régions
                                    </a>
                                </li>
                                @foreach ($regions as $region)
                                    <li>
                                        <a class="dropdown-item {{ request('region') == $region->id_region ? 'active' : '' }}"
                                            href="{{ request()->fullUrlWithQuery(['region' => $region->id_region]) }}">
                                            <i class="bi bi-geo me-2"></i> {{ $region->nom_region }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Filtre Tri -->
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button
                                class="btn btn-light w-100 text-start d-flex justify-content-between align-items-center py-3 shadow-sm"
                                type="button" data-bs-toggle="dropdown">
                                <span>
                                    <i class="bi bi-sort-down me-2"></i>
                                    Trier par
                                    @if (request('sort'))
                                        <span class="badge bg-primary ms-2">Trié</span>
                                    @endif
                                </span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu w-100 p-3">
                                <li>
                                    <a class="dropdown-item {{ request('sort') == 'recent' || !request('sort') ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'recent']) }}">
                                        <i class="bi bi-clock me-2"></i> Plus récents
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request('sort') == 'popular' ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}">
                                        <i class="bi bi-fire me-2"></i> Plus populaires
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Résultats -->
    <section class="py-5">
        <div class="container">
            <!-- Stats -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ number_format($contenus->total(), 0, ',', ' ') }} contenus
                                culturels</h3>
                            <p class="text-muted mb-0">Découvrez notre collection complète</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary">
                                <i class="bi bi-grid-3x3-gap"></i>
                            </button>
                            <button class="btn btn-outline-secondary active">
                                <i class="bi bi-grid"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="bi bi-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Types de contenus rapides -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ request()->fullUrlWithQuery(['type' => null]) }}"
                            class="badge {{ !request('type') ? 'bg-primary' : 'bg-light text-dark' }} py-2 px-3 text-decoration-none"
                            style="border-left: 3px solid var(--primary);">
                            <i class="bi bi-grid me-1"></i>Tous
                            <span class="badge bg-secondary ms-1">{{ $contenus->total() }}</span>
                        </a>
                        @foreach ($typesContenus as $type)
                            <a href="{{ request()->fullUrlWithQuery(['type' => $type->id_type_contenu]) }}"
                                class="badge {{ request('type') == $type->id_type_contenu ? 'bg-primary' : 'bg-light text-dark' }} py-2 px-3 text-decoration-none"
                                style="border-left: 3px solid var(--primary);">
                                <i
                                    class="bi {{ $typeIcons[$type->id_type_contenu] ?? 'bi-grid' }} me-1"></i>{{ $type->nom_contenu }}
                                <span
                                    class="badge bg-secondary ms-1">{{ $typeCounts[$type->id_type_contenu] ?? 0 }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Masonry Grid -->
            @if ($contenus->count() > 0)
                <div class="row">
                    @foreach ($contenus as $contenu)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="{{ route('front.contenu', ['id' => $contenu->id_contenu]) }}"
                                class="text-decoration-none">
                                <div class="culture-card h-100">
                                    <!-- Badge Type -->
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge py-2 px-3 text-white"
                                            style="background-color: {{ $contenu->color ?? '#E8112D' }}; font-size: 0.8rem;">
                                            <i class="bi {{ $contenu->icon ?? 'bi-book' }} me-1"></i>
                                            {{ $contenu->typeContenu->nom_contenu ?? 'Histoire' }}
                                        </span>
                                    </div>

                                    <!-- Image -->
                                    <div class="culture-card-img">
                                        @if ($contenu->medias && $contenu->medias->isNotEmpty())
                                            <img src="{{ $contenu->cover_image ?? '/adminlte/img/collage.png' }}"
                                                class="img-fluid" alt="{{ $contenu->titre }}">
                                        @else
                                            <img src="{{ asset('/adminlte/img/mikwabo.jpg') }}" class="img-fluid"
                                                alt="{{ $contenu->titre }}">
                                        @endif
                                    </div>

                                    <!-- Content -->
                                    <div class="culture-card-body p-4">
                                        <h4 class="culture-card-title mb-3">{{ $contenu->titre }}</h4>
                                        <p class="culture-card-text mb-3">
                                            {{ Str::limit(strip_tags($contenu->texte), 120) }}
                                        </p>

                                        <!-- Metadata -->
                                        <div
                                            class="culture-card-meta d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center">
                                                @if ($contenu->auteur)
                                                    <div class="me-2">
                                                        @if ($contenu->auteur->photo && $contenu->author_photo_url)
                                                            <img src="{{ $contenu->author_photo_url }}"
                                                                class="rounded-circle me-2" width="30"
                                                                height="30"
                                                                alt="{{ $contenu->auteur->name }}">
                                                        @else
                                                            <div class="rounded-circle me-2 d-flex align-items-center justify-content-center"
                                                                style="width: 30px; height: 30px; background: {{ $contenu->color ?? '#E8112D' }}; color: white; font-weight: bold;">
                                                                {{ substr($contenu->auteur->prenom, 0, 1) }}{{ substr($contenu->auteur->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <small class="fw-bold d-block">
                                                            {{ $contenu->auteur->prenom }}
                                                            {{ $contenu->auteur->name }}
                                                        </small>
                                                        <small class="text-muted">
                                                            {{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') }}
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-end">
                                                <small class="text-muted d-block" style="font-size: 0.85rem;">
                                                    <i class="bi bi-calendar me-1"></i>
                                                    @php
                                                        try {
                                                            echo \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y');
                                                        } catch (\Exception $e) {
                                                            echo date('d/m/Y', strtotime($contenu->date_creation));
                                                        }
                                                    @endphp
                                                </small>
                                                <span class="badge bg-light text-dark">
                                                    <i class="bi bi-clock me-1"></i>{{ $contenu->reading_time ?? 5 }} min
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Stats -->
                                        <div
                                            class="culture-card-stats d-flex justify-content-between border-top pt-3">
                                            <div class="text-center">
                                                <small class="d-block text-muted" style="font-size: 0.75rem;">
                                                    <i class="bi bi-eye"></i> Vues
                                                </small>
                                                <span
                                                    class="fw-bold">{{ number_format($contenu->vues_count ?? 0, 0, ',', ' ') }}</span>
                                            </div>
                                            <div class="text-center">
                                                <small class="d-block text-muted" style="font-size: 0.75rem;">
                                                    <i class="bi bi-heart"></i> Likes
                                                </small>
                                                <span
                                                    class="fw-bold">{{ number_format($contenu->likes_count ?? 0, 0, ',', ' ') }}</span>
                                            </div>
                                            <div class="text-center">
                                                <small class="d-block text-muted" style="font-size: 0.75rem;">
                                                    <i class="bi bi-chat"></i> Commentaires
                                                </small>
                                                <span
                                                    class="fw-bold">{{ number_format($contenu->commentaires_count ?? 0, 0, ',', ' ') }}</span>
                                            </div>
                                            <div class="text-center">
                                                <small class="d-block text-muted" style="font-size: 0.75rem;">
                                                    <i class="bi bi-star"></i> Favoris
                                                </small>
                                                <span
                                                    class="fw-bold">{{ number_format($contenu->favorites_count ?? 0, 0, ',', ' ') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($contenus->hasPages())
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            <!-- Previous Page Link -->
                            @if ($contenus->onFirstPage())
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

                            <!-- Pagination Elements -->
                            @foreach (range(1, $contenus->lastPage()) as $i)
                                @if ($i == $contenus->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $contenus->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endif
                            @endforeach

                            <!-- Next Page Link -->
                            @if ($contenus->hasMorePages())
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
                <!-- Aucun résultat -->
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <div class="empty-state">
                            <i class="bi bi-search display-1 text-muted mb-4"></i>
                            <h3 class="mb-3">Aucun contenu trouvé</h3>
                            <p class="text-muted mb-4">
                                @if (request()->has('q') || request()->has('type') || request()->has('region'))
                                    Essayez de modifier vos critères de recherche ou de filtrage.
                                @else
                                    Aucun contenu n'est disponible pour le moment.
                                @endif
                            </p>
                            @if (request()->has('q') || request()->has('type') || request()->has('region'))
                                <a href="{{ route('front.explorer') }}" class="btn btn-primary-custom">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Réinitialiser les filtres
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="cta-title mb-4">Vous avez une histoire à partager ?</h2>
                    <p class="lead mb-5 opacity-90">
                        Rejoignez notre communauté de contributeurs et enrichissez notre patrimoine culturel
                    </p>
                    <a href="{{ route('dashboard.contribuer') }}" class="btn btn-cta-primary px-5 py-3">
                        <i class="bi bi-plus-circle me-2"></i>Contribuer maintenant
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
