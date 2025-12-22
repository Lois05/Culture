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
                        url('{{ \App\Helpers\CloudinaryHelper::static("fresque.jpg") }}') center/cover;
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

        .search-hints {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 1.5rem;
        }

        .search-hint {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 0.4rem 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-hint:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
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

        /* ============ PINTEREST-STYLE GRID ============ */
        .contents-section {
            padding: 2rem 0;
        }

        .contents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: var(--grid-gap);
            grid-auto-flow: dense;
        }

        /* Style Pinterest avec hauteurs variables */
        .content-card {
            background: white;
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            break-inside: avoid;
            margin-bottom: var(--grid-gap);
        }

        .content-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow-hover);
        }

        /* Images de différentes hauteurs pour l'effet Pinterest */
        .content-card:nth-child(3n+1) .card-image {
            height: 280px;
        }

        .content-card:nth-child(3n+2) .card-image {
            height: 320px;
        }

        .content-card:nth-child(3n+3) .card-image {
            height: 250px;
        }

        .card-image-container {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }

        .content-card:hover .card-image {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .content-card:hover .image-overlay {
            opacity: 1;
        }

        .card-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
        }

        .favorite-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .favorite-btn:hover {
            background: white;
            color: var(--primary);
        }

        .favorite-btn.active {
            background: var(--primary);
            color: white;
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .card-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .card-title a:hover {
            color: var(--primary);
        }

        .card-excerpt {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ============ AVATAR AUTEUR (STYLES CSS) ============ */
        .author-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
            border: 2px solid rgba(232, 17, 45, 0.2);
        }

        .author-avatar img {
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
            font-weight: bold;
            color: white;
            font-size: 14px;
        }

        /* Couleurs dynamiques pour les initiales */
        .avatar-color-red { background: #E8112D; }
        .avatar-color-yellow { background: #FCD116; }
        .avatar-color-green { background: #008751; }
        .avatar-color-purple { background: #8B5CF6; }
        .avatar-color-blue { background: #6366F1; }

        .author-info {
            flex: 1;
            min-width: 0;
        }

        .author-name {
            font-weight: 600;
            font-size: 0.95rem;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .author-date {
            font-size: 0.8rem;
            color: #888;
        }

        /* ============ TAGS ============ */
        .card-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .tag {
            background: #f0f2f5;
            color: #666;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .tag:hover {
            background: var(--primary);
            color: white;
        }

        /* ============ CARD STATS ============ */
        .card-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #666;
            font-size: 0.9rem;
        }

        .stat-item i {
            font-size: 1rem;
        }

        .read-btn {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .read-btn:hover {
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

        /* ============ LOADING ============ */
        .loading-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: var(--grid-gap);
        }

        .card-skeleton {
            background: white;
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .skeleton-image {
            height: 250px;
            background: #f0f2f5;
        }

        .skeleton-content {
            padding: 1.5rem;
        }

        .skeleton-line {
            height: 12px;
            background: #f0f2f5;
            border-radius: 6px;
            margin-bottom: 0.75rem;
        }

        .skeleton-line.short {
            width: 60%;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 1200px) {
            .contents-grid {
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

            .contents-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .contents-grid {
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
        // Statistiques
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

    <!-- Contenus Section -->
    <section class="contents-section">
        <div class="container">
            @if($contenus->count() > 0)
                <div class="contents-grid">
                    @foreach($contenus as $contenu)
                        @php
                            // Données de base
                            $titre = $contenu->titre ?? 'Titre non disponible';
                            $description = strip_tags($contenu->texte ?? 'Description non disponible');
                            $typeNom = $contenu->typeContenu->nom_contenu ?? 'Général';
                            $regionNom = $contenu->region->nom_region ?? 'Bénin';
                            $langueNom = $contenu->langue->nom_langue ?? 'Français';

                            // Image
                            $imageUrl = \App\Helpers\CloudinaryHelper::getContentImage($contenu);

                            // Auteur - TOUJOURS utiliser l'helper amélioré
                            $author = $contenu->auteur ?? null;

                            // Utiliser la méthode getAvatarInfo() qui retourne TOUT
                            $avatarInfo = \App\Helpers\CloudinaryHelper::getUserAvatarInfo($author);

                            // Vérifier si on a une vraie photo
                            $hasRealPhoto = $avatarInfo['has_photo'];
                            $authorPhotoUrl = $avatarInfo['photo_url'];
                            $authorName = $avatarInfo['name'];
                            $initials = $avatarInfo['initials'];
                            $avatarColor = $avatarInfo['color'];

                            // Mapper la couleur au nom de classe CSS
                            $colorClasses = [
                                '#E8112D' => 'avatar-color-red',
                                '#FCD116' => 'avatar-color-yellow',
                                '#008751' => 'avatar-color-green',
                                '#8B5CF6' => 'avatar-color-purple',
                                '#6366F1' => 'avatar-color-blue',
                            ];
                            $avatarColorClass = $colorClasses[$avatarColor] ?? 'avatar-color-red';

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

                        <div class="content-card">
                            <div class="card-image-container">
                                <img src="{{ $imageUrl }}"
                                     alt="{{ $titre }}"
                                     class="card-image"
                                     loading="lazy"
                                     onerror="this.onerror=null; this.src='{{ \App\Helpers\CloudinaryHelper::static('default-content.jpg') }}'">
                                <div class="image-overlay"></div>

                                <div class="card-badge">
                                    {{ $typeNom }}
                                </div>

                                <button class="favorite-btn" onclick="toggleFavorite({{ $contenu->id_contenu }}, this)">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>

                            <div class="card-content">
                                <!-- Auteur - VERSION GARANTIE -->
                                <div class="author-section">
                                    <div class="author-avatar">
                                        @if($hasRealPhoto && $authorPhotoUrl)
                                            <!-- Photo réelle -->
                                            <img src="{{ $authorPhotoUrl }}"
                                                 alt="{{ $authorName }}"
                                                 class="author-photo"
                                                 onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <!-- Fallback initiales -->
                                            <div class="avatar-initials {{ $avatarColorClass }}" style="display: none;">
                                                {{ $initials }}
                                            </div>
                                        @else
                                            <!-- Initiales seulement -->
                                            <div class="avatar-initials {{ $avatarColorClass }}">
                                                {{ $initials }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="author-info">
                                        <div class="author-name">{{ $authorName }}</div>
                                        <div class="author-date">{{ $dateFormatted }}</div>
                                    </div>
                                </div>

                                <h3 class="card-title">
                                    <a href="{{ route('front.contenu', ['id' => $contenu->id_contenu]) }}">
                                        {{ \Illuminate\Support\Str::limit($titre, 70) }}
                                    </a>
                                </h3>

                                <p class="card-excerpt">
                                    {{ \Illuminate\Support\Str::limit($description, 150) }}
                                </p>

                                <div class="card-tags">
                                    <span class="tag">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $regionNom }}
                                    </span>
                                    <span class="tag">
                                        <i class="fas fa-language me-1"></i>{{ $langueNom }}
                                    </span>
                                </div>

                                <div class="card-stats">
                                    <div class="d-flex gap-3">
                                        <div class="stat-item" title="Vues">
                                            <i class="fas fa-eye"></i>
                                            <span>{{ number_format($vuesCount) }}</span>
                                        </div>
                                        <div class="stat-item" title="Likes">
                                            <i class="fas fa-heart"></i>
                                            <span>{{ $likesCount }}</span>
                                        </div>
                                        <div class="stat-item" title="Commentaires">
                                            <i class="fas fa-comment"></i>
                                            <span>{{ $commentsCount }}</span>
                                        </div>
                                    </div>

                                    <a href="{{ route('front.contenu', ['id' => $contenu->id_contenu]) }}"
                                       class="read-btn">
                                        Lire
                                    </a>
                                </div>
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

            // Infinite scroll pour l'effet Pinterest
            let isLoading = false;
            let nextPageUrl = '{{ $contenus->nextPageUrl() }}';

            window.addEventListener('scroll', function() {
                if (isLoading || !nextPageUrl) return;

                const scrollPosition = window.innerHeight + window.scrollY;
                const pageHeight = document.documentElement.scrollHeight - 200;

                if (scrollPosition >= pageHeight) {
                    loadMoreContent();
                }
            });

            async function loadMoreContent() {
                isLoading = true;

                try {
                    const response = await fetch(nextPageUrl);
                    const html = await response.text();

                    // Extraire le HTML des cartes et la pagination
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newCards = doc.querySelector('.contents-grid')?.innerHTML;
                    const newPagination = doc.querySelector('.pagination-section')?.innerHTML;
                    const newNextPage = doc.querySelector('link[rel="next"]')?.href;

                    // Ajouter les nouvelles cartes
                    if (newCards) {
                        const grid = document.querySelector('.contents-grid');
                        const temp = document.createElement('div');
                        temp.innerHTML = newCards;

                        temp.querySelectorAll('.content-card').forEach(card => {
                            grid.appendChild(card);
                        });
                    }

                    // Mettre à jour la pagination
                    if (newPagination && document.querySelector('.pagination-section')) {
                        document.querySelector('.pagination-section').innerHTML = newPagination;
                    }

                    // Mettre à jour l'URL de la page suivante
                    nextPageUrl = newNextPage || null;

                } catch (error) {
                    console.error('Erreur lors du chargement:', error);
                } finally {
                    isLoading = false;
                    AOS.refresh(); // Rafraîchir AOS pour les nouvelles cartes
                }
            }

            // Gestion des erreurs d'images d'avatar
            document.querySelectorAll('.author-photo').forEach(img => {
                img.addEventListener('error', function() {
                    this.style.display = 'none';
                    const initialsDiv = this.nextElementSibling;
                    if (initialsDiv && initialsDiv.classList.contains('avatar-initials')) {
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

            // Réinitialiser la pagination
            url.searchParams.delete('page');

            window.location.href = url.toString();
        };

        window.toggleFavorite = function(contentId, button) {
            const icon = button.querySelector('i');

            if (icon.classList.contains('far')) {
                // AJAX call pour ajouter aux favoris
                fetch(`/api/favorites/${contentId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        button.classList.add('active');
                        showToast('Ajouté aux favoris ❤️', 'success');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showToast('Erreur lors de l\'ajout', 'error');
                });
            } else {
                // AJAX call pour retirer des favoris
                fetch(`/api/favorites/${contentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        button.classList.remove('active');
                        showToast('Retiré des favoris', 'info');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showToast('Erreur lors du retrait', 'error');
                });
            }
        };

        window.shareContent = function(contentId, title) {
            const shareUrl = `${window.location.origin}/contenu/${contentId}`;

            if (navigator.share) {
                navigator.share({
                    title: title,
                    text: 'Découvrez ce contenu sur Bénin Culture',
                    url: shareUrl,
                })
                .then(() => showToast('Partagé avec succès !', 'success'))
                .catch(() => copyToClipboard(shareUrl));
            } else {
                copyToClipboard(shareUrl);
            }
        };

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                showToast('Lien copié dans le presse-papier 📋', 'success');
            });
        }

        function showToast(message, type = 'info') {
            // Créer le toast
            const toast = document.createElement('div');
            toast.className = `toast-notification toast-${type}`;
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                    <div>${message}</div>
                </div>
            `;

            // Style du toast
            Object.assign(toast.style, {
                position: 'fixed',
                top: '20px',
                right: '20px',
                background: type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#17a2b8',
                color: 'white',
                padding: '15px 20px',
                borderRadius: '10px',
                boxShadow: '0 5px 20px rgba(0,0,0,0.2)',
                transform: 'translateX(150%)',
                transition: 'transform 0.3s ease',
                zIndex: '9999',
                maxWidth: '350px'
            });

            document.body.appendChild(toast);

            // Animation d'entrée
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 10);

            // Animation de sortie après 3 secondes
            setTimeout(() => {
                toast.style.transform = 'translateX(150%)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Effet de compteur sur les stats
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            const target = parseInt(stat.textContent.replace(/\s/g, ''));
            const duration = 1500;
            const increment = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                stat.textContent = Math.floor(current).toLocaleString();
            }, 16);
        });
    </script>
@endpush
