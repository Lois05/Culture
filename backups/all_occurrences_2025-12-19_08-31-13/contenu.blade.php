@extends('layouts.layout_front')

@section('title', ($contenu->titre ?? 'Contenu') . ' - Bénin Culture')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
        --gray-100: #f8f9fa;
        --gray-800: #343a40;
    }

    body {
        background: var(--light);
        padding-top: 80px;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }

    .theme-dark {
        --dark: #ffffff;
        --light: #121212;
        background: #121212;
    }

    /* ============ HERO SECTION CORRIGÉ ============ */
    .article-hero {
        position: relative;
        height: 70vh;
        min-height: 500px;
        max-height: 800px;
        display: flex;
        align-items: flex-end;
        overflow: hidden;
        margin-top: -80px;
    }

    .hero-image-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            to bottom,
            rgba(0, 0, 0, 0.2) 0%,
            rgba(0, 0, 0, 0.6) 50%,
            rgba(0, 0, 0, 0.9) 100%
        );
        z-index: 2;
    }

    .hero-content {
        position: relative;
        z-index: 3;
        color: white;
        text-shadow: 0 2px 30px rgba(0, 0, 0, 0.5);
        padding-bottom: 4rem;
        width: 100%;
    }

    .article-breadcrumb {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 50px;
        padding: 0.8rem 1.5rem;
        display: inline-flex;
        margin-bottom: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .article-title {
        font-size: 3.5rem;
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #fff 0%, #FCD116 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* ============ AUTHOR CARD AMÉLIORÉ ============ */
    .author-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        margin-top: -60px;
        position: relative;
        z-index: 10;
        border: 1px solid rgba(232, 17, 45, 0.1);
    }

    .theme-dark .author-card {
        background: #1a1a1a;
        border-color: rgba(255, 255, 255, 0.1);
    }

    .author-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary);
    }

    .avatar-initials {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-gradient);
        color: white;
        font-size: 1.8rem;
        font-weight: bold;
        border: 3px solid white;
    }

    /* ============ PAYMENT WALL ============ */
    .payment-wall {
        background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
        border-radius: 20px;
        padding: 3rem;
        margin: 2rem 0;
        text-align: center;
        border: 1px solid rgba(232, 17, 45, 0.3);
        position: relative;
        overflow: hidden;
    }

    .payment-wall::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: var(--primary-gradient);
    }

    .premium-badge {
        background: linear-gradient(45deg, #FFD700, #FFA500);
        color: #000;
        font-weight: bold;
        padding: 8px 20px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 1.5rem;
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
    }

    .payment-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .payment-option {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        padding: 2rem;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .payment-option:hover {
        border-color: var(--primary);
        transform: translateY(-5px);
    }

    .payment-option.recommended {
        border-color: var(--secondary);
        position: relative;
        overflow: hidden;
    }

    .payment-option.recommended::after {
        content: 'RECOMMANDÉ';
        position: absolute;
        top: 10px;
        right: -30px;
        background: var(--secondary);
        color: #000;
        font-size: 0.7rem;
        font-weight: bold;
        padding: 3px 30px;
        transform: rotate(45deg);
    }

    /* ============ BOUTON BOUTIQUE ============ */
    .shop-btn {
        background: linear-gradient(45deg, #8B5CF6, #6366F1);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .shop-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
        color: white;
    }

    .shop-icon {
        animation: pulseShop 2s infinite;
    }

    @keyframes pulseShop {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* ============ CONTENT SECTION ============ */
    .content-wrapper {
        background: white;
        border-radius: 30px 30px 0 0;
        margin-top: -30px;
        position: relative;
        z-index: 5;
        padding: 3rem 0;
    }

    .theme-dark .content-wrapper {
        background: #1a1a1a;
    }

    .content-excerpt {
        font-size: 1.3rem;
        line-height: 1.8;
        color: #555;
        padding: 2rem;
        background: rgba(232, 17, 45, 0.05);
        border-radius: 15px;
        margin: 2rem 0;
        border-left: 5px solid var(--primary);
    }

    .theme-dark .content-excerpt {
        background: rgba(255, 255, 255, 0.05);
        color: #ccc;
    }

    .content-full {
        display: none;
    }

    .content-full.visible {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* ============ STATS GRID ============ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin: 2rem 0;
    }

    .stat-item {
        text-align: center;
        padding: 1.5rem;
        background: rgba(232, 17, 45, 0.05);
        border-radius: 15px;
        transition: all 0.3s ease;
    }

    .theme-dark .stat-item {
        background: rgba(255, 255, 255, 0.05);
    }

    .stat-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(232, 17, 45, 0.1);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 900;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .theme-dark .stat-number {
        color: var(--secondary);
    }

    /* ============ ACTION BUTTONS ============ */
    .action-buttons {
        position: fixed;
        right: 2rem;
        bottom: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        z-index: 1000;
    }

    .action-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        transform: translateY(-5px) scale(1.1);
        background: var(--primary);
        color: white;
    }

    .action-btn.premium {
        background: linear-gradient(45deg, #FFD700, #FFA500);
        color: #000;
    }

    .action-btn.premium:hover {
        background: linear-gradient(45deg, #FFA500, #FF8C00);
    }

    /* ============ COMMENTS SECTION ============ */
    .comments-section {
        background: rgba(248, 249, 250, 0.5);
        border-radius: 20px;
        padding: 2rem;
        margin: 3rem 0;
    }

    .theme-dark .comments-section {
        background: rgba(255, 255, 255, 0.05);
    }

    .comment-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .theme-dark .comment-card {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .comment-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .comment-initials {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary);
        color: white;
        font-weight: bold;
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 992px) {
        .article-title {
            font-size: 2.5rem;
        }
        .article-hero {
            height: 60vh;
        }
    }

    @media (max-width: 768px) {
        .article-title {
            font-size: 2rem;
        }
        .article-hero {
            height: 50vh;
        }
        .author-card {
            margin-top: -40px;
            padding: 1.5rem;
        }
        .payment-options {
            grid-template-columns: 1fr;
        }
        .action-buttons {
            right: 1rem;
            bottom: 1rem;
        }
    }

    @media (max-width: 576px) {
        .article-title {
            font-size: 1.8rem;
        }
        .article-hero {
            height: 40vh;
        }
        .payment-wall {
            padding: 2rem 1rem;
        }
    }
</style>
@endpush

@section('content')
@php
    // Données fictives pour ce contenu spécifique
    $contenu->views = $contenu->views ?? rand(1000, 50000);
    $contenu->likes = $contenu->likes ?? rand(500, 10000);
    $contenu->comments = $contenu->comments ?? rand(50, 500);
    $contenu->shares = $contenu->shares ?? rand(100, 2000);

    // Déterminer si c'est un contenu premium
    $isPremium = false;
    if (isset($contenu->typeContenu)) {
        $isPremium = in_array($contenu->typeContenu->nom_contenu, [
            'Document Exclusif',
            'Archive Historique',
            'Recueil Sacré'
        ]);
    }

    // Si pas déterminé par type, 30% de chance d'être premium
    if (!$isPremium) {
        $isPremium = (mt_rand(1, 100) <= 30);
    }

    // Données de l'auteur
    $author = $contenu->auteur ?? (object)[
        'name' => 'Auteur inconnu',
        'role' => (object)['nom_role' => 'Contributeur'],
        'bio' => 'Passionné par la culture béninoise',
        'photo' => null
    ];

    // Initiales de l'auteur
    $authorInitials = strtoupper(substr($author->name, 0, 2));

    // Image principale
    $mainImage = $contenu->main_image ??
                 (isset($contenu->medias) && $contenu->medias->count() > 0 ? $contenu->medias->first()->url :
                 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=2070');

    // Contenu tronqué pour l'excerpt
    $fullText = $contenu->texte ?? '';
    $excerpt = Str::limit(strip_tags($fullText), 300);

    // URL de la boutique - SOLUTION TEMPORAIRE
    // Si la route existe, l'utiliser, sinon créer une URL simple
    $shopUrl = '';
    try {
        $shopUrl = route('front.boutique.index') . '?ref=contenu-' . ($contenu->id_contenu ?? 'premium');
    } catch (Exception $e) {
        $shopUrl = url('/boutique') . '?ref=contenu-' . ($contenu->id_contenu ?? 'premium');
    }
@endphp

<!-- Hero Section -->
<section class="article-hero">
    <div class="hero-image-container">
        <img src="{{ $mainImage }}"
             alt="{{ $contenu->titre }}"
             class="hero-image"
             onerror="this.src='https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=2070'">
        <div class="hero-overlay"></div>
    </div>

    <div class="container hero-content">
        <nav class="article-breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none">
                        <i class="fas fa-home me-1"></i>Accueil
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('front.explorer') }}" class="text-white text-decoration-none">
                        Explorer
                    </a>
                </li>
                @if(isset($contenu->region) && $contenu->region)
                <li class="breadcrumb-item">
                    <a href="{{ route('front.regions', ['id' => $contenu->region->id_region]) }}"
                       class="text-white text-decoration-none">
                        {{ $contenu->region->nom_region }}
                    </a>
                </li>
                @endif
                <li class="breadcrumb-item active text-white">
                    {{ Str::limit($contenu->titre, 30) }}
                </li>
            </ol>
        </nav>

        <h1 class="article-title" data-aos="fade-up" data-aos-delay="200">
            {{ $contenu->titre }}
        </h1>

        <div class="d-flex align-items-center gap-3 text-white" data-aos="fade-up" data-aos-delay="300">
            <div class="d-flex align-items-center gap-2">
                <i class="far fa-eye"></i>
                <span>{{ number_format($contenu->views) }} vues</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="far fa-clock"></i>
                <span>{{ \Carbon\Carbon::parse($contenu->date_creation ?? now())->diffForHumans() }}</span>
            </div>
            @if(isset($contenu->typeContenu) && $contenu->typeContenu)
            <span class="badge bg-white text-primary">
                {{ $contenu->typeContenu->nom_contenu }}
            </span>
            @endif
        </div>
    </div>
</section>

<!-- Carte Auteur -->
<div class="container">
    <div class="author-card" data-aos="fade-up" data-aos-delay="400">
        <div class="row align-items-center">
            <div class="col-auto">
                @if(isset($author->photo) && $author->photo)
                <img src="@if(isset($author) && $author->has_cloudinary && $author->cloudinary_url)
    {{ $author->cloudinary_url }}
@elseif(isset($author) && $author->photo)
@if(auth()->user()->has_cloudinary && auth()->user()->cloudinary_url)
    <img src="{{ auth()->user()->cloudinary_url }}"
@elseif(auth()->user()->photo)
    <img src="{{ asset('storage/' . auth()->user()->photo) }}"
@else
    <div class="avatar-default">{{ substr(auth()->user()->name, 0, 1) }}</div>
@endif
@elseif(isset($author))
    <div class="avatar-default">{{ substr($author->name, 0, 1) }}</div>
@endif"
                     alt="{{ $author->name }}"
                     class="author-avatar">
                @else
                <div class="avatar-initials">
                    {{ $authorInitials }}
                </div>
                @endif
            </div>
            <div class="col">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $author->name }}</h3>
                        <p class="text-muted mb-2">
                            {{ isset($author->role) && is_object($author->role) ? $author->role->nom_role : 'Contributeur' }}
                        </p>
                        <p class="mb-0 text-muted">{{ $author->bio ?? 'Passionné de culture béninoise' }}</p>
                    </div>
                    <button class="btn btn-outline-primary" id="followAuthorBtn">
                        <i class="fas fa-plus-circle me-2"></i>Suivre
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contenu Principal -->
<div class="content-wrapper">
    <div class="container">
        <!-- Actions flottantes -->
        <div class="action-buttons">
            <button class="action-btn" onclick="toggleLike()" id="likeBtn">
                <i class="far fa-heart"></i>
            </button>
            <button class="action-btn" onclick="toggleBookmark()" id="bookmarkBtn">
                <i class="far fa-bookmark"></i>
            </button>
            <button class="action-btn" onclick="shareContent()">
                <i class="fas fa-share-alt"></i>
            </button>
            <!-- BOUTON COURONNE QUI REDIRIGE VERS LA BOUTIQUE -->
            <a href="{{ $shopUrl }}" class="action-btn premium" title="Découvrir nos offres premium">
                <i class="fas fa-crown"></i>
            </a>
        </div>

        <!-- Statistiques -->
        <div class="stats-grid" data-aos="fade-up">
            <div class="stat-item">
                <div class="stat-number" id="viewsCount">{{ number_format($contenu->views) }}</div>
                <div class="stat-label">Vues</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="likesCount">{{ number_format($contenu->likes) }}</div>
                <div class="stat-label">Likes</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="commentsCount">{{ number_format($contenu->comments) }}</div>
                <div class="stat-label">Commentaires</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ number_format($contenu->shares) }}</div>
                <div class="stat-label">Partages</div>
            </div>
        </div>

        <!-- Excerpt (contenu visible gratuitement) -->
        <div class="content-excerpt" data-aos="fade-up">
            <h4 class="fw-bold mb-3">
                <i class="fas fa-book-open me-2 text-primary"></i>
                Aperçu du contenu
            </h4>
            <p class="mb-0">{{ $excerpt }}...</p>
        </div>

        <!-- Payment Wall (pour contenu premium) -->
        @if($isPremium)
        <div class="payment-wall" data-aos="fade-up">
            <div class="premium-badge">
                <i class="fas fa-crown me-2"></i>
                CONTENU PREMIUM
            </div>

            <h3 class="text-white fw-bold mb-3">
                Découvrez la suite de cet article exclusif
            </h3>

            <p class="text-white-50 mb-4">
                Accédez à l'intégralité de ce contenu et à tous les avantages premium
            </p>

            <div class="payment-options">
                <div class="payment-option" data-plan="single" onclick="selectPlan('single')">
                    <h4 class="text-white fw-bold">500 FCFA</h4>
                    <p class="text-white-50 mb-2">Accès unique à cet article</p>
                    <ul class="text-white-50 text-start small">
                        <li>Lecture complète</li>
                        <li>Téléchargement PDF</li>
                        <li>Accès à vie</li>
                    </ul>
                </div>

                <div class="payment-option recommended" data-plan="monthly" onclick="selectPlan('monthly')">
                    <h4 class="text-white fw-bold">3 000 FCFA/mois</h4>
                    <p class="text-white-50 mb-2">Accès illimité à tous les contenus</p>
                    <ul class="text-white-50 text-start small">
                        <li>Tous les articles premium</li>
                        <li>Téléchargements illimités</li>
                        <li>Support prioritaire</li>
                        <li>Contenus exclusifs</li>
                    </ul>
                </div>

                <div class="payment-option" data-plan="yearly" onclick="selectPlan('yearly')">
                    <h4 class="text-white fw-bold">30 000 FCFA/an</h4>
                    <p class="text-white-50 mb-2">Économisez 16%</p>
                    <ul class="text-white-50 text-start small">
                        <li>Tous les avantages premium</li>
                        <li>2 mois gratuits</li>
                        <li>Badge "Soutien Culturel"</li>
                        <li>Accès early aux nouveautés</li>
                    </ul>
                </div>
            </div>

            <!-- BOUTON QUI REDIRIGE VERS LA BOUTIQUE -->
            <a href="{{ $shopUrl }}" class="btn btn-lg btn-warning px-5 py-3 fw-bold shop-btn">
                <i class="fas fa-store-alt shop-icon me-2"></i>
                DÉCOUVRIR NOS OFFRES
            </a>

            <p class="text-white-50 mt-3 small">
                <i class="fas fa-shield-alt me-1"></i>
                Paiement 100% sécurisé - Annulation possible à tout moment
            </p>
        </div>
        @endif

        <!-- Contenu complet (visible après paiement ou si non-premium) -->
        <div class="content-full {{ !$isPremium ? 'visible' : '' }}"
             id="fullContent">
            <div class="content-body" data-aos="fade-up">
                {!! $fullText !!}
            </div>

            <!-- Tags -->
            <div class="mt-4" data-aos="fade-up">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-tags me-2 text-primary"></i>
                    Tags
                </h6>
                <div class="d-flex flex-wrap gap-2">
                    @if(isset($contenu->langue) && $contenu->langue)
                    <span class="badge bg-primary">{{ $contenu->langue->nom_langue }}</span>
                    @endif
                    @if(isset($contenu->region) && $contenu->region)
                    <span class="badge bg-success">{{ $contenu->region->nom_region }}</span>
                    @endif
                    @if(isset($contenu->typeContenu) && $contenu->typeContenu)
                    <span class="badge bg-warning text-dark">{{ $contenu->typeContenu->nom_contenu }}</span>
                    @endif
                    <span class="badge bg-info">Culture Béninoise</span>
                    <span class="badge bg-dark">Patrimoine</span>
                </div>
            </div>
        </div>

        <!-- Section commentaires -->
        <div class="comments-section" id="commentsSection" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">
                    <i class="fas fa-comments text-primary me-2"></i>
                    Commentaires
                    <span class="text-primary">({{ $contenu->comments }})</span>
                </h3>

                <button class="btn btn-primary" onclick="showCommentForm()">
                    <i class="fas fa-plus me-2"></i>Ajouter un commentaire
                </button>
            </div>

            @auth
            <!-- Formulaire de commentaire (caché par défaut) -->
            <div class="comment-form mb-4" id="commentForm" style="display: none;">
                <div class="d-flex gap-3">
                    <div>
                        @if(auth()->user()->photo ?? false)
                        @if(auth()->user()->has_cloudinary && auth()->user()->cloudinary_url)
        <img src="{{ auth()->user()->cloudinary_url }}"
    @elseif(auth()->user()->photo)
        <img src="{{ asset('storage/' . auth()->user()->photo) }}"
    @else
        <div class="avatar-default">{{ substr(auth()->user()->name, 0, 1) }}</div>
    @endif
                             alt="{{ auth()->user()->name }}"
                             class="comment-avatar">
                        @else
                        <div class="comment-initials">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <form id="commentFormEl">
                            @csrf
                            <div class="mb-3">
                                <textarea class="form-control"
                                          rows="3"
                                          placeholder="Partagez votre pensée..."
                                          id="commentText"></textarea>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-outline-secondary"
                                        onclick="hideCommentForm()">
                                    Annuler
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Publier
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-primary">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle fa-2x me-3"></i>
                    <div>
                        <strong>Connectez-vous pour commenter</strong>
                        <p class="mb-0">Rejoignez la discussion et partagez vos pensées.</p>
                        <a href="{{ route('front.connexion') }}" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="fas fa-sign-in-alt me-1"></i>Se connecter
                        </a>
                    </div>
                </div>
            </div>
            @endauth

            <!-- Liste des commentaires fictifs -->
            <div id="commentsList">
                @php
                    $commentNames = ['Jean Dupont', 'Marie Koné', 'Koffi Johnson', 'Amina Salami', 'David Gbaguidi'];
                    $comments = [];
                    $commentCount = min(5, $contenu->comments);
                    for ($i = 0; $i < $commentCount; $i++) {
                        $comments[] = [
                            'id' => $i + 1,
                            'user' => [
                                'name' => $commentNames[$i % count($commentNames)],
                                'initials' => strtoupper(substr($commentNames[$i % count($commentNames)], 0, 1))
                            ],
                            'text' => 'Commentaire fictif sur ce contenu intéressant. Je trouve cet article très instructif sur la culture béninoise.',
                            'time' => now()->subHours(rand(1, 48))->diffForHumans(),
                            'likes' => rand(0, 50)
                        ];
                    }
                @endphp

                @foreach($comments as $comment)
                <div class="comment-card">
                    <div class="d-flex gap-3">
                        <div>
                            <div class="comment-initials">
                                {{ $comment['user']['initials'] }}
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <h6 class="fw-bold mb-0">{{ $comment['user']['name'] }}</h6>
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i>
                                        {{ $comment['time'] }}
                                    </small>
                                </div>
                                <button class="btn btn-sm btn-link text-muted comment-like-btn"
                                        onclick="likeComment({{ $comment['id'] }})"
                                        id="commentLike-{{ $comment['id'] }}">
                                    <i class="far fa-heart me-1"></i>
                                    <span id="commentLikes-{{ $comment['id'] }}">{{ $comment['likes'] }}</span>
                                </button>
                            </div>
                            <p class="mb-0">{{ $comment['text'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Contenu similaire -->
        @if(isset($contenusSimilaires) && $contenusSimilaires->count() > 0)
        <div class="mt-5" data-aos="fade-up">
            <h3 class="fw-bold mb-4">
                <i class="fas fa-compass text-primary me-2"></i>
                Contenus similaires
            </h3>
            <div class="row g-4">
                @foreach($contenusSimilaires->take(3) as $similar)
                @php
                    $similarImage = $similar->medias->first()->url ??
                                   'https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=2070';
                @endphp
                <div class="col-md-4">
                    <a href="{{ route('front.contenu', ['id' => $similar->id_contenu]) }}"
                       class="card text-decoration-none h-100 border-0 shadow-sm">
                        <div class="card-img-top" style="height: 200px; overflow: hidden;">
                            <img src="{{ $similarImage }}"
                                 alt="{{ $similar->titre }}"
                                 class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ Str::limit($similar->titre, 60) }}</h5>
                            <div class="d-flex justify-content-between text-muted small mt-3">
                                <span><i class="far fa-eye me-1"></i>{{ number_format(rand(1000, 50000)) }}</span>
                                <span><i class="far fa-clock me-1"></i>{{ \Carbon\Carbon::parse($similar->date_creation ?? now())->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser AOS
    AOS.init({
        duration: 1000,
        once: true
    });

    // Variables globales
    let liked = false;
    let bookmarked = false;
    let following = false;

    // Données fictives pour les compteurs
    let views = {{ $contenu->views }};
    let likes = {{ $contenu->likes }};
    let comments = {{ $contenu->comments }};

    // Simuler des vues en direct
    setInterval(() => {
        if (Math.random() > 0.7) { // 30% de chance d'incrémenter
            views++;
            updateCounter('viewsCount', views);
        }
    }, 10000); // Toutes les 10 secondes

    // Gérer les likes
    window.toggleLike = function() {
        const likeBtn = document.getElementById('likeBtn');
        liked = !liked;

        if (liked) {
            likes++;
            likeBtn.innerHTML = '<i class="fas fa-heart"></i>';
            likeBtn.style.background = 'var(--primary)';
            likeBtn.style.color = 'white';
            showToast('Merci pour votre like ! ❤️', 'success');

            // Animation
            createHeartAnimation(likeBtn);
        } else {
            likes--;
            likeBtn.innerHTML = '<i class="far fa-heart"></i>';
            likeBtn.style.background = '';
            likeBtn.style.color = '';
            showToast('Like retiré', 'info');
        }

        updateCounter('likesCount', likes);
    };

    // Gérer les bookmarks
    window.toggleBookmark = function() {
        const bookmarkBtn = document.getElementById('bookmarkBtn');
        bookmarked = !bookmarked;

        if (bookmarked) {
            bookmarkBtn.innerHTML = '<i class="fas fa-bookmark"></i>';
            bookmarkBtn.style.background = 'var(--primary)';
            bookmarkBtn.style.color = 'white';
            showToast('Contenu sauvegardé 📌', 'success');
        } else {
            bookmarkBtn.innerHTML = '<i class="far fa-bookmark"></i>';
            bookmarkBtn.style.background = '';
            bookmarkBtn.style.color = '';
            showToast('Retiré des favoris', 'info');
        }
    };

    // Suivre l'auteur
    document.getElementById('followAuthorBtn').addEventListener('click', function() {
        const btn = this;
        following = !following;

        if (following) {
            btn.classList.remove('btn-outline-primary');
            btn.classList.add('btn-primary');
            btn.innerHTML = '<i class="fas fa-check me-2"></i>Suivi';
            showToast('Vous suivez maintenant cet auteur 👤', 'success');
        } else {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-outline-primary');
            btn.innerHTML = '<i class="fas fa-plus-circle me-2"></i>Suivre';
            showToast('Vous ne suivez plus cet auteur', 'info');
        }
    });

    // Partager le contenu
    window.shareContent = function() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $contenu->titre }}',
                text: 'Découvrez ce contenu sur Bénin Culture',
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(window.location.href).then(() => {
                showToast('Lien copié dans le presse-papier 📋', 'success');
            });
        }
    };

    // Gérer les commentaires
    window.showCommentForm = function() {
        const commentForm = document.getElementById('commentForm');
        if (commentForm) {
            commentForm.style.display = 'block';
            document.getElementById('commentText').focus();
        }
    };

    window.hideCommentForm = function() {
        const commentForm = document.getElementById('commentForm');
        if (commentForm) {
            commentForm.style.display = 'none';
        }
    };

    document.getElementById('commentFormEl')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const commentText = document.getElementById('commentText');

        if (commentText && commentText.value.trim()) {
            // Ajouter un nouveau commentaire fictif
            addComment(commentText.value);
            commentText.value = '';
            hideCommentForm();
            showToast('Commentaire publié 💬', 'success');
        }
    });

    // Ajouter un commentaire
    function addComment(text) {
        comments++;
        updateCounter('commentsCount', comments);

        const commentList = document.getElementById('commentsList');
        const newComment = document.createElement('div');
        newComment.className = 'comment-card';
        newComment.innerHTML = `
            <div class="d-flex gap-3">
                <div>
                    <div class="comment-initials">
                        {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 1)) : "U" }}
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <h6 class="fw-bold mb-0">{{ auth()->check() ? auth()->user()->name : "Utilisateur" }}</h6>
                            <small class="text-muted">
                                <i class="far fa-clock me-1"></i>
                                À l'instant
                            </small>
                        </div>
                        <button class="btn btn-sm btn-link text-muted comment-like-btn"
                                onclick="likeComment('new')"
                                id="commentLike-new">
                            <i class="far fa-heart me-1"></i>
                            <span id="commentLikes-new">0</span>
                        </button>
                    </div>
                    <p class="mb-0">${text}</p>
                </div>
            </div>
        `;

        commentList.prepend(newComment);
    }

    // Liker un commentaire
    window.likeComment = function(commentId) {
        const likeBtn = document.getElementById(`commentLike-${commentId}`);
        const likesSpan = document.getElementById(`commentLikes-${commentId}`);

        if (likeBtn && likesSpan) {
            let currentLikes = parseInt(likesSpan.textContent);
            const liked = likeBtn.classList.contains('liked');

            if (!liked) {
                currentLikes++;
                likeBtn.classList.add('liked');
                likeBtn.innerHTML = '<i class="fas fa-heart me-1"></i>' + currentLikes;
            } else {
                currentLikes--;
                likeBtn.classList.remove('liked');
                likeBtn.innerHTML = '<i class="far fa-heart me-1"></i>' + currentLikes;
            }

            likesSpan.textContent = currentLikes;
        }
    };

    // Fonctions utilitaires
    function updateCounter(elementId, value) {
        const element = document.getElementById(elementId);
        if (element) {
            const formatted = new Intl.NumberFormat().format(value);
            element.textContent = formatted;

            // Animation
            element.style.transform = 'scale(1.2)';
            setTimeout(() => {
                element.style.transform = 'scale(1)';
            }, 300);
        }
    }

    function createHeartAnimation(element) {
        const heart = document.createElement('div');
        heart.innerHTML = '❤️';
        heart.style.position = 'fixed';
        heart.style.fontSize = '20px';
        heart.style.pointerEvents = 'none';
        heart.style.zIndex = '9999';

        const rect = element.getBoundingClientRect();
        heart.style.left = rect.left + rect.width/2 + 'px';
        heart.style.top = rect.top + 'px';

        document.body.appendChild(heart);

        const animation = heart.animate([
            { transform: 'translateY(0) scale(1)', opacity: 1 },
            { transform: 'translateY(-100px) scale(2)', opacity: 0 }
        ], {
            duration: 1000,
            easing: 'cubic-bezier(0.215, 0.610, 0.355, 1)'
        });

        animation.onfinish = () => heart.remove();
    }

    function showToast(message, type = 'info') {
        // Créer le toast
        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            transform: translateX(150%);
            transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 9999;
            border-left: 4px solid ${type === 'success' ? '#28a745' : '#007bff'};
            max-width: 300px;
        `;

        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-3"></i>
                <div>${message}</div>
            </div>
        `;

        document.body.appendChild(toast);

        // Afficher
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 10);

        // Cacher après 3 secondes
        setTimeout(() => {
            toast.style.transform = 'translateX(150%)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Initialiser les likes des commentaires (quelques likes aléatoires)
    setTimeout(() => {
        document.querySelectorAll('.comment-like-btn').forEach(btn => {
            if (Math.random() > 0.5 && !btn.classList.contains('liked')) {
                btn.click();
            }
        });
    }, 1000);
});
</script>
@endpush
