@extends('layouts.layout_front')

@section('title', 'Explorer - Bénin Culture')

@section('content')
    <section class="hero-section" style="height: 60vh; min-height: 400px; background: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(0,0,0,0.4)), url('{{ asset('adminlte/img/collage.png') }}') center/cover no-repeat;">
        <div class="container">
            <div class="row align-items-center h-100">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="hero-content">
                        <h1 class="hero-title mb-4 text-white">Explorez la richesse culturelle</h1>
                        <p class="lead mb-5 text-white-50" style="font-size: 1.3rem;">
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

            <!-- Grid des contenus -->
            @if ($contenus->count() > 0)
                <div class="row">
                    @foreach ($contenus as $contenu)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="contenu-card-explorer h-100">
                                <!-- Image avec badge -->
                                <div class="contenu-card-image-container">
                                    @if ($contenu->medias && $contenu->medias->isNotEmpty())
                                        @php
                                            $media = $contenu->medias->first();
                                            $imageUrl = Str::startsWith($media->chemin, ['http://', 'https://'])
                                                ? $media->chemin
                                                : (Storage::exists($media->chemin)
                                                    ? Storage::url($media->chemin)
                                                    : asset('adminlte/img/mikwabo.jpg'));
                                        @endphp
                                        <img src="{{ $imageUrl }}"
                                             alt="{{ $contenu->titre }}"
                                             class="contenu-card-image">
                                    @elseif($contenu->cover_image)
                                        @php
                                            $coverImage = Str::startsWith($contenu->cover_image, ['http://', 'https://'])
                                                ? $contenu->cover_image
                                                : asset('adminlte/img/' . $contenu->cover_image);
                                        @endphp
                                        <img src="{{ $coverImage }}"
                                             alt="{{ $contenu->titre }}"
                                             class="contenu-card-image">
                                    @else
                                        <img src="{{ asset('adminlte/img/mikwabo.jpg') }}"
                                             alt="{{ $contenu->titre }}"
                                             class="contenu-card-image">
                                    @endif

                                    <!-- Badge Type -->
                                    <div class="contenu-card-badge">
                                        <span class="badge py-2 px-3 text-white"
                                            style="background-color: {{ $contenu->typeContenu->couleur ?? '#E8112D' }};">
                                            <i class="bi {{ $contenu->typeContenu->icone ?? 'bi-book' }} me-1"></i>
                                            {{ $contenu->typeContenu->nom_contenu ?? 'Histoire' }}
                                        </span>
                                    </div>

                                    <!-- Overlay pour le lien -->
                                    <a href="{{ route('front.contenu', ['id' => $contenu->id_contenu]) }}"
                                       class="contenu-card-link-overlay"></a>
                                </div>

                                <!-- Content -->
                                <div class="contenu-card-content p-4">
                                    <h4 class="contenu-card-title mb-3">
                                        <a href="{{ route('front.contenu', ['id' => $contenu->id_contenu]) }}"
                                           class="text-decoration-none text-dark">
                                            {{ Str::limit($contenu->titre, 70) }}
                                        </a>
                                    </h4>
                                    <p class="contenu-card-text mb-3 text-muted">
                                        {{ Str::limit(strip_tags($contenu->texte), 120) }}
                                    </p>

                                    <!-- Auteur et date -->
                                    <div class="contenu-card-meta d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            @if ($contenu->author_photo_url)
                                                @php
                                                    $authorPhoto = Str::startsWith($contenu->author_photo_url, ['http://', 'https://'])
                                                        ? $contenu->author_photo_url
                                                        : asset('adminlte/img/' . $contenu->author_photo_url);
                                                @endphp
                                                <img src="{{ $authorPhoto }}"
                                                     alt="{{ $contenu->auteur->name ?? 'Auteur' }}"
                                                     class="contenu-author-avatar me-2">
                                            @else
                                                <div class="contenu-avatar-initials me-2">
                                                    {{ substr($contenu->auteur->prenom ?? 'A', 0, 1) }}{{ substr($contenu->auteur->name ?? 'U', 0, 1) }}
                                                </div>
                                            @endif
                                            <div>
                                                <small class="d-block fw-bold">
                                                    {{ $contenu->auteur->prenom ?? '' }} {{ $contenu->auteur->name ?? 'Anonyme' }}
                                                </small>
                                                <small class="text-muted">
                                                    @php
                                                        try {
                                                            $date = \Carbon\Carbon::parse($contenu->date_creation);
                                                            echo $date->translatedFormat('d F Y');
                                                        } catch (\Exception $e) {
                                                            echo 'Date inconnue';
                                                        }
                                                    @endphp
                                                </small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-light text-dark">
                                                <i class="bi bi-clock me-1"></i>{{ $contenu->reading_time ?? 5 }} min
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Stats -->
                                    <div class="contenu-card-stats d-flex justify-content-between border-top pt-3">
                                        <div class="text-center">
                                            <small class="d-block text-muted" style="font-size: 0.75rem;">
                                                <i class="bi bi-eye"></i> Vues
                                            </small>
                                            <span class="fw-bold">{{ $contenu->vues_count ?? 0 }}</span>
                                        </div>
                                        <div class="text-center">
                                            <small class="d-block text-muted" style="font-size: 0.75rem;">
                                                <i class="bi bi-heart"></i> Likes
                                            </small>
                                            <span class="fw-bold">{{ $contenu->likes_count ?? 0 }}</span>
                                        </div>
                                        <div class="text-center">
                                            <small class="d-block text-muted" style="font-size: 0.75rem;">
                                                <i class="bi bi-chat"></i> Commentaires
                                            </small>
                                            <span class="fw-bold">{{ $contenu->commentaires_count ?? 0 }}</span>
                                        </div>
                                        <div class="text-center">
                                            <small class="d-block text-muted" style="font-size: 0.75rem;">
                                                <i class="bi bi-star"></i> Favoris
                                            </small>
                                            <span class="fw-bold">{{ $contenu->favorites_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

@push('styles')
<style>
    /* Styles pour les cartes de la page explorer */
    .contenu-card-explorer {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .contenu-card-explorer:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    /* Conteneur image */
    .contenu-card-image-container {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .contenu-card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .contenu-card-explorer:hover .contenu-card-image {
        transform: scale(1.05);
    }

    /* Badge sur l'image */
    .contenu-card-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 2;
    }

    .contenu-card-badge .badge {
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    /* Overlay pour le lien */
    .contenu-card-link-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        background: transparent;
        transition: background 0.3s ease;
    }

    .contenu-card-link-overlay:hover {
        background: rgba(0, 0, 0, 0.05);
    }

    /* Contenu de la carte */
    .contenu-card-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .contenu-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.4;
        color: #1a1a1a;
    }

    .contenu-card-title a:hover {
        color: var(--primary) !important;
    }

    .contenu-card-text {
        font-size: 0.95rem;
        line-height: 1.6;
        flex: 1;
    }

    /* Avatar auteur */
    .contenu-author-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--primary-light);
    }

    .contenu-avatar-initials {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
        border: 2px solid var(--primary-light);
    }

    /* Stats */
    .contenu-card-stats {
        margin-top: auto;
    }

    /* Hero section améliorée */
    .hero-section {
        background-attachment: fixed;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .contenu-card-image-container {
            height: 180px;
        }

        .contenu-card-title {
            font-size: 1.1rem;
        }

        .contenu-card-text {
            font-size: 0.9rem;
        }

        .contenu-card-stats div {
            padding: 0 5px;
        }
    }

    @media (max-width: 576px) {
        .contenu-card-image-container {
            height: 160px;
        }
    }

    /* Styles pour les badges de filtres */
    .badge.bg-light:hover {
        background-color: var(--primary-light) !important;
        color: var(--primary-dark) !important;
    }

    /* Pagination améliorée */
    .page-link {
        padding: 0.5rem 1rem;
        border: none;
        color: var(--primary);
        margin: 0 2px;
        border-radius: 8px !important;
    }

    .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .page-link:hover {
        background-color: var(--primary-light);
        color: var(--primary-dark);
    }
</style>
@endpush
