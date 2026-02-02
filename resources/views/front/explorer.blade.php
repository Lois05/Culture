@extends('layouts.layout_front')

@section('title', 'Explorer - Bénin Culture')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
            --success: #28a745;
            --warning: #ffc107;
            --grid-gap: 1.5rem;
            --card-radius: 16px;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        body {
            background: #f8f9fa;
            overflow-x: hidden;
        }

        /* ============ HERO SECTION ============ */
        .explorer-hero {
            position: relative;
            min-height: 70vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: linear-gradient(rgba(26, 26, 26, 0.9), rgba(26, 26, 26, 0.9)),
                        url('{{ asset("adminlte/img/fresque.jpg") }}') center/cover;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            color: white;
            text-align: center;
            padding: 3rem 1rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #FFFFFF, #FCD116);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        /* ============ SEARCH BAR ============ */
        .search-container {
            max-width: 700px;
            margin: 0 auto;
            position: relative;
        }

        .search-wrapper {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-input {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.1rem;
            padding: 1rem 1.5rem;
            width: 100%;
            outline: none;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-btn {
            background: var(--primary-gradient);
            border: none;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .search-btn:hover {
            transform: scale(1.05);
        }

        /* ============ STATS ============ */
        .stats-section {
            background: white;
            padding: 3rem 0;
            border-bottom: 1px solid #eee;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            text-align: center;
            padding: 1.5rem;
            border-radius: 12px;
            background: #f8f9fa;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ============ FILTRES ============ */
        .filters-section {
            background: white;
            padding: 2rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #eee;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .filter-scroll {
            display: flex;
            gap: 1rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
            -webkit-overflow-scrolling: touch;
        }

        .filter-scroll::-webkit-scrollbar {
            height: 4px;
        }

        .filter-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .filter-scroll::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        .filter-tab {
            background: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
            color: #666;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-tab:hover {
            background: #e9ecef;
        }

        .filter-tab.active {
            background: var(--primary-gradient);
            color: white;
            border-color: var(--primary);
        }

        .filter-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.2rem 0.6rem;
            border-radius: 10px;
            font-size: 0.8rem;
        }

        /* ============ PINTEREST GRID (MÊME QUE HOME) ============ */
        .contents-section {
            padding: 3rem 0;
        }

        .pinterest-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: var(--grid-gap);
        }

        .pin-card {
            background: white;
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            break-inside: avoid;
            margin-bottom: var(--grid-gap);
        }

        .pin-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow-hover);
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
            z-index: 2;
        }

        .pin-actions {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            gap: 0.5rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
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
            background: var(--primary);
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
            z-index: 2;
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
            transition: color 0.3s ease;
        }

        .pin-title a:hover {
            color: var(--primary);
        }

        .pin-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ============ AVATAR AUTEUR (MÊME QUE HOME) ============ */

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


        /* ============ STATISTIQUES ============ */
        .pin-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #eee;
            margin-bottom: 1rem;
        }

        .pin-stat {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #666;
            font-size: 0.9rem;
        }

        .pin-stat i {
            font-size: 1rem;
        }

        .pin-stat-count {
            font-weight: 600;
        }

        .pin-read-btn {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            width: 100%;
            text-align: center;
        }

        .pin-read-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(232, 17, 45, 0.2);
        }

        /* ============ PAGINATION ============ */
        .pagination-section {
            padding: 3rem 0;
            text-align: center;
        }

        .pagination {
            display: inline-flex;
            gap: 0.5rem;
        }

        .page-link {
            min-width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            color: #333;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .page-link.active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .page-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 1200px) {
            .pinterest-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .explorer-hero {
                min-height: 60vh;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .pinterest-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .pinterest-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .filter-tab {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }
    </style>
@endpush

@section('content')
    @php
        $totalContents = $contenus->total();
        $totalContributors = 150;
    @endphp

    <!-- Hero Section -->
    <section class="explorer-hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Explorez la culture<br>
                    du <span class="text-warning">Bénin</span>
                </h1>

                <p class="hero-subtitle">
                    Découvrez des milliers d'histoires, traditions et richesses culturelles
                    partagées par notre communauté.
                </p>

                <div class="search-container">
                    <form action="{{ route('front.explorer') }}" method="GET" class="search-wrapper d-flex align-items-center">
                        <input type="text"
                               name="q"
                               class="search-input flex-grow-1"
                               placeholder="Rechercher une histoire, une tradition, une recette..."
                               value="{{ request('q') }}"
                               autocomplete="off">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <div class="search-hints">
                        <div class="search-hint" onclick="setSearch('Danse traditionnelle')">
                            💃 Danse traditionnelle
                        </div>
                        <div class="search-hint" onclick="setSearch('Recette béninoise')">
                            🍲 Recette béninoise
                        </div>
                        <div class="search-hint" onclick="setSearch('Histoire du Dahomey')">
                            📜 Histoire du Dahomey
                        </div>
                        <div class="search-hint" onclick="setSearch('Artisanat')">
                            🎨 Artisanat
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($totalContents, 0, ',', ' ') }}</div>
                    <div class="stat-label">Contenus</div>
                </div>

                <div class="stat-card">
                    <div class="stat-number">{{ count($regions) }}</div>
                    <div class="stat-label">Régions</div>
                </div>

                <div class="stat-card">
                    <div class="stat-number">{{ number_format($totalContributors, 0, ',', ' ') }}</div>
                    <div class="stat-label">Contributeurs</div>
                </div>

                <div class="stat-card">
                    <div class="stat-number">{{ count($typesContenus) }}</div>
                    <div class="stat-label">Catégories</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filtres Section -->
    <section class="filters-section">
        <div class="container">
            <div class="filter-scroll">
                <button class="filter-tab {{ !request('type') ? 'active' : '' }}"
                        onclick="updateFilter('type', '')">
                    <i class="fas fa-th-large"></i>
                    Tous les types
                    @if(!request('type'))
                        <span class="filter-badge">{{ $totalContents }}</span>
                    @endif
                </button>

                @foreach($typesContenus as $type)
                    <button class="filter-tab {{ request('type') == $type->id_type_contenu ? 'active' : '' }}"
                            onclick="updateFilter('type', '{{ $type->id_type_contenu }}')">
                        <i class="fas {{ $type->icone ?? 'fa-star' }}"></i>
                        {{ $type->nom_contenu }}
                        @if(request('type') == $type->id_type_contenu)
                            <span class="filter-badge">{{ $typeCounts[$type->id_type_contenu] ?? 0 }}</span>
                        @endif
                    </button>
                @endforeach

                <button class="filter-tab {{ !request('region') ? 'active' : '' }}"
                        onclick="updateFilter('region', '')">
                    <i class="fas fa-map-marker-alt"></i>
                    Toutes régions
                </button>

                @foreach($regions as $region)
                    <button class="filter-tab {{ request('region') == $region->id_region ? 'active' : '' }}"
                            onclick="updateFilter('region', '{{ $region->id_region }}')">
                        <i class="fas fa-map-pin"></i>
                        {{ $region->nom_region }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contenus Section - MÊME ARCHITECTURE PINTEREST QUE HOME -->
    <section class="contents-section">
        <div class="container">
            @if($contenus->count() > 0)
                <div class="pinterest-grid">
                    @foreach($contenus as $contenu)
                        @php
                            // Données de base
                            $titre = $contenu->titre ?? 'Titre non disponible';
                            $description = strip_tags($contenu->texte ?? 'Description non disponible');
                            $typeNom = $contenu->typeContenu->nom_contenu ?? 'Général';
                            $regionNom = $contenu->region->nom_region ?? 'Bénin';
                            $langueNom = $contenu->langue->nom_langue ?? 'Français';

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
                            $typeIcon = $contenu->typeContenu->icon ?? 'bi-star';
                            $typeColor = $contenu->typeContenu->color ?? '#FCD116';

                            // Date
                            $dateFormatted = 'Il y a quelque temps';
                            if($contenu->created_at && $contenu->created_at instanceof \Carbon\Carbon) {
                                $dateFormatted = $contenu->created_at->diffForHumans();
                            }

                            // Statistiques
                            $vuesCount = $contenu->vues_count ?? rand(100, 5000);
                            $likesCount = $contenu->likes_count ?? rand(0, 500);
                            $commentsCount = $contenu->commentaires_count ?? rand(0, 100);
                        @endphp

                        <!-- Carte Pinterest -->
                        <div class="pin-card">
                            <!-- Image du contenu -->
                            <div class="pin-image">
                                <img src="{{ $imageUrl }}"
                                     alt="{{ $titre }}"
                                     class="card-image"
                                     loading="lazy"
                                     onerror="this.src='{{ App\Helpers\ImageHelper::defaultContent() }}'">

                                <div class="pin-type-badge" style="color: {{ $typeColor }};">
                                    <i class="bi {{ $typeIcon }}"></i>
                                    {{ $typeNom }}
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
                                    {{ $regionNom }}
                                </div>
                            </div>

                            <div class="pin-content">
                             <!-- Auteur - MÊME STRUCTURE QUE HOME -->
<div class="pin-author">
    <div class="pin-author-avatar">
        @php
            // Même logique de couleur que Home
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

            $hasPhoto = $hasRealPhoto && !empty($authorPhoto) && filter_var($authorPhoto, FILTER_VALIDATE_URL);
        @endphp

        @if($hasPhoto)
            <img src="{{ $authorPhoto }}"
                 alt="{{ $authorName }}"
                 class="author-photo"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="author-initials {{ $avatarClass }}" style="display: none !important;">
                {{ $authorInitials }}
            </div>
        @else
            <div class="author-initials {{ $avatarClass }}">
                {{ $authorInitials }}
            </div>
        @endif
    </div>
    <div class="pin-author-info">
        <h6>{{ $authorName }}</h6>
        <p>{{ $dateFormatted }}</p>
    </div>
</div>

                                <h3 class="pin-title">
                                   <a href="{{ route('front.contenu', $contenu->id_contenu) }}"></a>
                                        {{ \Illuminate\Support\Str::limit($titre, 70) }}
                                    </a>
                                </h3>

                                <p class="pin-description">
                                    {{ \Illuminate\Support\Str::limit($description, 150) }}
                                </p>

                                <!-- Tags -->
                                <div class="card-tags mb-3">
                                    <span class="tag">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $regionNom }}
                                    </span>
                                    <span class="tag">
                                        <i class="fas fa-language me-1"></i>{{ $langueNom }}
                                    </span>
                                </div>

                                <!-- Statistiques -->
                                <div class="pin-stats">
                                    <div class="pin-stat" title="Vues">
                                        <i class="fas fa-eye"></i>
                                        <span class="pin-stat-count">{{ number_format($vuesCount) }}</span>
                                    </div>
                                    <div class="pin-stat" title="Likes">
                                        <i class="fas fa-heart"></i>
                                        <span class="pin-stat-count">{{ $likesCount }}</span>
                                    </div>
                                    <div class="pin-stat" title="Commentaires">
                                        <i class="fas fa-comment"></i>
                                        <span class="pin-stat-count">{{ $commentsCount }}</span>
                                    </div>
                                </div>

                                <!-- Bouton Lire -->
                            <a href="{{ route('front.contenu', $contenu->id_contenu) }}" class="pin-read-btn mt-3">
                                  
                                    <i class="bi bi-book me-2"></i>Lire l'article
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($contenus->hasPages())
                    <div class="pagination-section">
                        <div class="pagination">
                            {{-- Previous Page Link --}}
                            @if($contenus->onFirstPage())
                                <span class="page-link disabled">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $contenus->previousPageUrl() }}" class="page-link">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @php
                                $start = max(1, $contenus->currentPage() - 2);
                                $end = min($contenus->lastPage(), $contenus->currentPage() + 2);
                            @endphp

                            @if($start > 1)
                                <a href="{{ $contenus->url(1) }}" class="page-link">1</a>
                                @if($start > 2)
                                    <span class="page-link disabled">...</span>
                                @endif
                            @endif

                            @for($i = $start; $i <= $end; $i++)
                                <a href="{{ $contenus->url($i) }}"
                                   class="page-link {{ $contenus->currentPage() == $i ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor

                            @if($end < $contenus->lastPage())
                                @if($end < $contenus->lastPage() - 1)
                                    <span class="page-link disabled">...</span>
                                @endif
                                <a href="{{ $contenus->url($contenus->lastPage()) }}" class="page-link">
                                    {{ $contenus->lastPage() }}
                                </a>
                            @endif

                            {{-- Next Page Link --}}
                            @if($contenus->hasMorePages())
                                <a href="{{ $contenus->nextPageUrl() }}" class="page-link">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="page-link disabled">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif

            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="empty-state-icon mb-4">
                        <i class="fas fa-search fa-4x text-muted"></i>
                    </div>
                    <h3 class="mb-3">Aucun contenu trouvé</h3>
                    <p class="text-muted mb-4">
                        @if(request()->anyFilled(['q', 'type', 'region', 'langue', 'sort']))
                            Essayez d'élargir vos critères de recherche.
                        @else
                            Il n'y a pas encore de contenu à afficher.
                        @endif
                    </p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('front.explorer') }}" class="btn btn-primary">
                            <i class="fas fa-redo me-2"></i>Tout afficher
                        </a>
                        <a href="{{ route('dashboard.contribuer') }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus me-2"></i>Créer du contenu
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-dark text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3">Partagez votre histoire</h3>
                    <p class="mb-0">
                        Contribuez à préserver et promouvoir la culture béninoise en partageant vos connaissances.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('dashboard.contribuer') }}" class="btn btn-light btn-lg px-4">
                        <i class="fas fa-pen-alt me-2"></i>Contribuer
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialiser AOS
            AOS.init({
                duration: 800,
                once: true,
                offset: 100
            });

            // Gestion des erreurs d'images
            document.querySelectorAll('.pin-image img').forEach(img => {
                img.addEventListener('error', function() {
                    this.src = '{{ App\Helpers\ImageHelper::defaultContent() }}';
                });
            });

            // Gestion des erreurs d'avatar
            document.querySelectorAll('.author-photo').forEach(img => {
                img.addEventListener('error', function() {
                    this.style.display = 'none';
                    const initialsDiv = this.nextElementSibling;
                    if (initialsDiv && initialsDiv.classList.contains('author-initials')) {
                        initialsDiv.style.display = 'flex';
                    }
                });
            });
        });

        // Fonctions globales
        window.setSearch = function(text) {
            const input = document.querySelector('.search-input');
            if (input) {
                input.value = text;
                input.focus();
            }
        };

        window.updateFilter = function(type, value) {
            const url = new URL(window.location.href);

            if (value === '') {
                url.searchParams.delete(type);
            } else {
                url.searchParams.set(type, value);
            }

            url.searchParams.delete('page');
            window.location.href = url.toString();
        };
    </script>
@endpush
