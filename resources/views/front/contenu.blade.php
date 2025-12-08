{{-- resources/views/front/contenu.blade.php --}}
@extends('layouts.layout_front')

@section('title', ($contenu->titre ?? 'Contenu') . ' - Bénin Culture')

@push('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --success-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .hero-content-detail {
        position: relative;
        padding: 8rem 0 4rem;
        background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.9)),
                    url('{{ $contenu->cover_image ?? asset('adminlte/img/collage.png') }}') center/cover no-repeat;
        clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        margin-top: -80px;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.2), rgba(118, 75, 162, 0.2));
    }

    .content-metadata {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin: 25px 0;
    }

    .meta-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        padding: 8px 20px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .meta-badge:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
    }

    .author-card-sidebar {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: none;
    }

    .author-card-sidebar:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .author-header {
        background: var(--primary-gradient);
        padding: 2.5rem 1.5rem;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .author-avatar-large {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        margin-bottom: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .author-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        padding: 20px;
        background: #f8f9fa;
    }

    .stat-item {
        text-align: center;
        padding: 10px;
    }

    .stat-number {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3748;
        display: block;
    }

    .stat-label {
        font-size: 0.8rem;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-subscribe {
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-subscribe:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin: 30px 0;
    }

    .action-btn {
        padding: 15px 30px;
        border-radius: 15px;
        font-weight: 600;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .action-btn:hover::before {
        left: 100%;
    }

    .btn-like {
        background: var(--primary-gradient);
        color: white;
    }

    .btn-like:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-comment {
        background: var(--accent-gradient);
        color: white;
    }

    .btn-comment:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(79, 172, 254, 0.4);
    }

    .btn-favorite {
        background: var(--secondary-gradient);
        color: white;
    }

    .btn-favorite:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(240, 147, 251, 0.4);
    }

    .btn-share {
        background: var(--success-gradient);
        color: white;
    }

    .btn-share:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(67, 233, 123, 0.4);
    }

    .badge-count {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-left: 8px;
    }

    .media-gallery-pinterest {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin: 30px 0;
    }

    .media-thumbnail {
        border-radius: 15px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 150px;
        position: relative;
    }

    .media-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .media-thumbnail:hover img {
        transform: scale(1.1);
    }

    .media-thumbnail::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 60%, rgba(0, 0, 0, 0.7));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .media-thumbnail:hover::after {
        opacity: 1;
    }

    .content-body {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #2d3748;
    }

    .content-body img {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
        margin: 25px 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .content-body h2, .content-body h3 {
        color: #2d3748;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .content-body blockquote {
        border-left: 4px solid var(--primary);
        padding-left: 1.5rem;
        font-style: italic;
        color: #4a5568;
        margin: 2rem 0;
    }

    .similar-card-pinterest {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
    }

    .similar-card-pinterest:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .similar-card-img {
        height: 180px;
        overflow: hidden;
    }

    .similar-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .similar-card-pinterest:hover .similar-card-img img {
        transform: scale(1.1);
    }

    .comment-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        border-left: 4px solid var(--primary);
        transition: all 0.3s ease;
    }

    .comment-card:hover {
        transform: translateX(5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .comment-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--primary);
    }

    .comment-actions {
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }

    .comment-action-btn {
        background: none;
        border: none;
        color: #718096;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
        padding: 5px 10px;
        border-radius: 15px;
    }

    .comment-action-btn:hover {
        background: #f7fafc;
        color: var(--primary);
    }

    .stats-card-sidebar {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    }

    .stat-progress {
        height: 8px;
        border-radius: 4px;
        background: #e2e8f0;
        overflow: hidden;
        margin-top: 5px;
    }

    .stat-progress-bar {
        height: 100%;
        border-radius: 4px;
        background: var(--primary-gradient);
        transition: width 1s ease-in-out;
    }

    .tag-bubble {
        display: inline-block;
        background: #edf2f7;
        color: #4a5568;
        padding: 8px 20px;
        border-radius: 25px;
        margin: 5px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .tag-bubble:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .translation-card {
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        border-radius: 15px;
        padding: 20px;
        margin: 15px 0;
        border-left: 4px solid #764ba2;
    }

    /* Styles pour la section premium */
    .premium-offer-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 30px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
        margin: 40px 0;
        transition: all 0.3s ease;
    }

    .premium-offer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(102, 126, 234, 0.4);
    }

    .premium-badge {
        background: rgba(255, 255, 255, 0.2);
        display: inline-block;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: bold;
        backdrop-filter: blur(10px);
        margin-bottom: 20px;
        animation: pulse 2s infinite;
    }

    .cta-section {
        margin: 40px 0;
    }

    .cta-card {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border-radius: 20px;
        color: white;
        box-shadow: 0 15px 35px rgba(240, 147, 251, 0.3);
        padding: 40px;
        transition: all 0.3s ease;
    }

    .cta-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(240, 147, 251, 0.4);
    }

    .pricing-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 25px;
    }

    .current-price {
        font-size: 3rem;
        font-weight: bold;
        color: white;
    }

    .old-price {
        font-size: 1.2rem;
        opacity: 0.8;
    }

    .savings-badge {
        background: #4CAF50;
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        display: inline-block;
        font-weight: bold;
        margin: 10px 0;
    }

    .btn-en-savoir-plus {
        background: white;
        color: #667eea;
        border: none;
        padding: 15px 30px;
        border-radius: 15px;
        font-weight: bold;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
        width: 100%;
    }

    .btn-en-savoir-plus:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(255, 255, 255, 0.3);
        color: #667eea;
    }

    .premium-features .d-flex {
        color: rgba(255, 255, 255, 0.9);
    }

    .offer-options {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        padding: 20px;
    }

    .offer-item {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 100%;
    }

    .offer-item:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-3px);
    }

    .offer-item .price {
        font-size: 1.5rem;
        font-weight: bold;
        margin-top: 10px;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    @media (max-width: 768px) {
        .hero-content-detail {
            padding: 6rem 0 3rem;
            clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%);
        }

        .action-buttons {
            justify-content: center;
        }

        .action-btn {
            padding: 12px 20px;
            font-size: 0.9rem;
        }

        .media-gallery-pinterest {
            grid-template-columns: repeat(2, 1fr);
        }

        .premium-offer-card {
            padding: 20px !important;
        }

        .current-price {
            font-size: 2.5rem !important;
        }

        .cta-card {
            padding: 25px !important;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-content-detail">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('front.explorer') }}" class="text-white text-decoration-none">Explorer</a></li>
                        <li class="breadcrumb-item active text-white">{{ $contenu->typeContenu->nom_contenu ?? 'Contenu' }}</li>
                    </ol>
                </nav>

                <h1 class="display-4 fw-bold text-white mb-4" style="text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">
                    {{ $contenu->titre ?? 'Titre du contenu' }}
                </h1>

                <div class="content-metadata">
                    @if(isset($contenu->typeContenu))
                    <span class="meta-badge" style="background: {{ $typeIcons[$contenu->typeContenu->id_type_contenu]['color'] ?? '#667eea' }}">
                        <i class="bi {{ $typeIcons[$contenu->typeContenu->id_type_contenu]['icon'] ?? 'bi-grid' }}"></i>
                        {{ $contenu->typeContenu->nom_contenu }}
                    </span>
                    @endif

                    @if(isset($contenu->region))
                    <span class="meta-badge">
                        <i class="bi bi-geo-alt-fill"></i>
                        {{ $contenu->region->nom_region }}
                    </span>
                    @endif

                    <span class="meta-badge">
                        <i class="bi bi-clock"></i>
                        {{ $readingTime ?? 5 }} min de lecture
                    </span>

                    <span class="meta-badge">
                        <i class="bi bi-calendar3"></i>
                        {{ $contenu->date_creation ? \Carbon\Carbon::parse($contenu->date_creation)->format('d F Y') : 'Date inconnue' }}
                    </span>
                </div>

                <div class="d-flex align-items-center gap-3 text-white mt-4">
                    @if(isset($contenu->author_photo_url) && $contenu->author_photo_url)
                    <img src="{{ $contenu->author_photo_url }}"
                         alt="Photo de {{ $contenu->auteur->name ?? 'Auteur' }}"
                         class="rounded-circle border border-3 border-white"
                         style="width: 70px; height: 70px; object-fit: cover;">
                    @else
                    <div class="rounded-circle bg-gradient d-flex align-items-center justify-content-center border border-3 border-white"
                         style="width: 70px; height: 70px; background: var(--primary-gradient);">
                        <i class="bi bi-person text-white fs-4"></i>
                    </div>
                    @endif
                    <div>
                        <h5 class="mb-1">{{ $contenu->auteur->name ?? 'Auteur inconnu' }}</h5>
                        <p class="mb-0 text-white-50">
                            {{ $contenu->auteur->role->nom_role ?? 'Contributeur' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="d-flex justify-content-center justify-content-lg-end gap-5">
                    <div class="text-center text-white">
                        <div class="display-5 fw-bold" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.5);">
                            {{ $stats['vues'] ?? '1.5K' }}
                        </div>
                        <small class="text-white-50">Vues</small>
                    </div>
                    <div class="text-center text-white">
                        <div class="display-5 fw-bold" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.5);">
                            {{ $stats['likes'] ?? '356' }}
                        </div>
                        <small class="text-white-50">Likes</small>
                    </div>
                    <div class="text-center text-white">
                        <div class="display-5 fw-bold" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.5);">
                            {{ $stats['commentaires'] ?? '42' }}
                        </div>
                        <small class="text-white-50">Commentaires</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <!-- Contenu Principal -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg mb-5">
                <div class="card-body p-4 p-md-5">
                    <!-- Galerie Pinterest -->
                    @if(isset($contenu->media_urls) && count($contenu->media_urls) > 0)
                    <div class="mb-5">
                        <div class="text-center mb-4">
                            <img src="{{ is_array($contenu->media_urls[0]) ? $contenu->media_urls[0]['url'] : $contenu->media_urls[0] }}"
                                 alt="{{ $contenu->titre ?? 'Image principale' }}"
                                 class="img-fluid rounded-3 shadow-lg w-100"
                                 style="max-height: 500px; object-fit: cover;"
                                 id="mainImage">
                        </div>

                        @if(count($contenu->media_urls) > 1)
                        <div class="media-gallery-pinterest">
                            @foreach($contenu->media_urls as $index => $media)
                            <div class="media-thumbnail" onclick="document.getElementById('mainImage').src = '{{ is_array($media) ? $media['url'] : $media }}'">
                                <img src="{{ is_array($media) ? $media['url'] : $media }}"
                                     alt="Image {{ $index + 1 }}">
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Contenu texte enrichi -->
                    <div class="content-body mb-5">
                        {!! $contenu->texte ?? '<p class="text-muted fst-italic">Aucun contenu disponible pour le moment.</p>' !!}
                    </div>

                    <!-- Section "En savoir plus" avec offre -->
                    @if($isPremium ?? false)
                    <div class="premium-offer-card">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="premium-badge">
                                    <i class="bi bi-star-fill me-2"></i> CONTENU PREMIUM
                                </div>

                                <h3 class="fw-bold mb-3">Accédez à la version complète</h3>
                                <p class="mb-4 opacity-90">
                                    Débloquez toutes les informations détaillées, les analyses exclusives
                                    et les ressources supplémentaires de ce contenu.
                                </p>

                                <div class="premium-features mb-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                                                <span>Contenu intégral détaillé</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                                                <span>Sources et références</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                                                <span>Médias exclusifs</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                                                <span>Support de l'auteur</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 text-center">
                                <div class="pricing-card">
                                    <div class="price-display mb-3">
                                        <span class="old-price text-decoration-line-through opacity-75 me-2">
                                            {{ ($contenu->prix_fictif ?? 15) + 5 }} €
                                        </span>
                                        <span class="current-price">
                                            {{ $contenu->prix_fictif ?? 15 }} €
                                        </span>
                                        <div class="text-sm opacity-90 mt-2">une seule fois</div>
                                    </div>

                                    <div class="savings-badge mb-4">
                                        <i class="bi bi-arrow-down me-1"></i>
                                        Économisez 5€
                                    </div>

                                    <a href="{{ route('boutique.index') }}?contenu_id={{ $contenu->id_contenu }}&type=premium"
                                       class="btn-en-savoir-plus">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                        En savoir plus
                                    </a>

                                    <div class="mt-3 text-sm opacity-75">
                                        <i class="bi bi-shield-check me-1"></i>
                                        Paiement 100% sécurisé
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="cta-section">
                        <div class="cta-card">
                            <h3 class="fw-bold mb-3">Vous aimez ce contenu ?</h3>
                            <p class="mb-4 opacity-90">
                                Découvrez d'autres trésors culturels et soutenez notre mission de préservation.
                            </p>

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="offer-options mb-4">
                                        <h5 class="fw-bold mb-3">Nos offres spéciales</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="offer-item" onclick="window.location.href='{{ route('boutique.index') }}?type=pack'">
                                                    <i class="bi bi-collection-play display-6 mb-3"></i>
                                                    <h6 class="fw-bold">Pack Culturel</h6>
                                                    <small>Accès à 10 contenus</small>
                                                    <div class="price">2500 FCFA</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="offer-item" onclick="window.location.href='{{ route('boutique.index') }}?type=abonnement'">
                                                    <i class="bi bi-infinity display-6 mb-3"></i>
                                                    <h6 class="fw-bold">Abonnement</h6>
                                                    <small>Accès illimité</small>
                                                    <div class="price">5000 FCFA<small>/mois</small></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('boutique.index') }}"
                                   class="btn-en-savoir-plus" style="max-width: 300px;">
                                    <i class="bi bi-gem"></i>
                                    Explorer nos offres
                                </a>

                                <div class="mt-4 text-sm opacity-75">
                                    <i class="bi bi-award me-1"></i>
                                    Soutenez la culture béninoise
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Boutons d'action Pinterest -->
                    <div class="action-buttons">
                        <button class="action-btn btn-like">
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                            <span>J'aime</span>
                            <span class="badge-count">{{ $stats['likes'] ?? 356 }}</span>
                        </button>

                        <button class="action-btn btn-comment" data-bs-toggle="modal" data-bs-target="#commentModal">
                            <i class="bi bi-chat-dots-fill"></i>
                            <span>Commenter</span>
                            <span class="badge-count">{{ $stats['commentaires'] ?? 42 }}</span>
                        </button>

                        <button class="action-btn btn-favorite">
                            <i class="bi bi-heart-fill"></i>
                            <span>Favori</span>
                            <span class="badge-count">{{ $stats['favoris'] ?? 89 }}</span>
                        </button>

                        <button class="action-btn btn-share" onclick="shareContent()">
                            <i class="bi bi-share-fill"></i>
                            <span>Partager</span>
                            <span class="badge-count">{{ $stats['partages'] ?? 45 }}</span>
                        </button>
                    </div>

                    <!-- Tags et langues -->
                    <div class="border-top pt-4 mt-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-tags-fill me-2" style="color: var(--primary);"></i>
                            Mots-clés & Langues
                        </h5>
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
                            @if(isset($contenu->langue))
                            <a href="#" class="tag-bubble">
                                <i class="bi bi-translate me-1"></i>
                                {{ $contenu->langue->nom_langue ?? 'Français' }}
                            </a>
                            @endif

                            @if(isset($auteurLangues) && is_array($auteurLangues))
                                @foreach($auteurLangues as $langue)
                                <a href="#" class="tag-bubble">{{ $langue }}</a>
                                @endforeach
                            @endif

                            <a href="#" class="tag-bubble">Bénin</a>
                            <a href="#" class="tag-bubble">Culture</a>
                            <a href="#" class="tag-bubble">Tradition</a>
                            <a href="#" class="tag-bubble">Patrimoine</a>
                        </div>

                        <!-- Traductions -->
                        @if(isset($traductions) && count($traductions) > 0)
                        <div class="mt-4">
                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-translate me-2"></i>
                                Disponible en d'autres langues
                            </h6>
                            @foreach($traductions as $traduction)
                            <div class="translation-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge bg-primary mb-2">{{ $traduction['langue'] }}</span>
                                        <p class="mb-0 small">{{ $traduction['texte'] }}</p>
                                    </div>
                                    <small class="text-muted">Traduit par {{ $traduction['traducteur'] }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Section Commentaires -->
            <div class="card border-0 shadow-lg mb-5">
                <div class="card-header bg-white border-0 py-4" style="background: var(--primary-gradient); color: white;">
                    <h4 class="mb-0">
                        <i class="bi bi-chat-left-text-fill me-2"></i>
                        Commentaires ({{ $stats['commentaires'] ?? 42 }})
                    </h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    <!-- Formulaire commentaire Pinterest -->
                    @auth
                    <div class="mb-5">
                        <div class="d-flex gap-3 align-items-start">
                            @if(Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                 alt="Photo de profil"
                                 class="rounded-circle border border-3 border-primary"
                                 style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                            <div class="rounded-circle bg-gradient d-flex align-items-center justify-content-center border border-3 border-primary"
                                 style="width: 60px; height: 60px; background: var(--primary-gradient);">
                                <i class="bi bi-person text-white fs-5"></i>
                            </div>
                            @endif
                            <div class="flex-grow-1">
                                <textarea class="form-control" rows="4" placeholder="Partagez vos pensées sur ce contenu..."
                                          style="border-radius: 15px; border: 2px solid #e2e8f0; resize: none;"></textarea>
                                <div class="mt-3 d-flex justify-content-end gap-2">
                                    <button class="btn btn-outline-secondary">Annuler</button>
                                    <button class="btn btn-primary" style="border-radius: 15px; padding: 10px 25px;">
                                        <i class="bi bi-send me-2"></i>Publier
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info border-0 shadow-sm" style="border-radius: 15px; background: var(--accent-gradient); color: white;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Connectez-vous pour commenter</h6>
                                <p class="mb-0">Rejoignez la communauté pour partager vos réflexions.</p>
                            </div>
                        </div>
                    </div>
                    @endauth

                    <!-- Liste des commentaires -->
                    <div class="comments-list">
                        @if(isset($contenu->commentaires) && $contenu->commentaires->count() > 0)
                            @foreach($contenu->commentaires as $commentaire)
                            <div class="comment-card">
                                <div class="d-flex gap-3">
                                    @if($commentaire->utilisateur && $commentaire->utilisateur->photo)
                                    <img src="{{ asset('storage/' . $commentaire->utilisateur->photo) }}"
                                         alt="Photo de {{ $commentaire->utilisateur->name }}"
                                         class="comment-avatar">
                                    @else
                                    <div class="comment-avatar bg-gradient d-flex align-items-center justify-content-center"
                                         style="background: var(--secondary-gradient);">
                                        <i class="bi bi-person text-white"></i>
                                    </div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <h6 class="fw-bold mb-0">{{ $commentaire->utilisateur->name ?? 'Utilisateur' }}</h6>
                                                <small class="text-muted">
                                                    {{ $commentaire->utilisateur->role->nom_role ?? 'Membre' }}
                                                </small>
                                            </div>
                                            <small class="text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ \Carbon\Carbon::parse($commentaire->date)->diffForHumans() }}
                                            </small>
                                        </div>
                                        <p class="mb-3">{{ $commentaire->texte }}</p>

                                        <div class="comment-actions">
                                            <button class="comment-action-btn">
                                                <i class="bi bi-hand-thumbs-up"></i> {{ rand(1, 50) }}
                                            </button>
                                            <button class="comment-action-btn">
                                                <i class="bi bi-reply"></i> Répondre
                                            </button>
                                            <button class="comment-action-btn">
                                                <i class="bi bi-flag"></i> Signaler
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <div class="text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-chat-dots display-1 text-muted mb-4"></i>
                                <h4 class="mb-3">Soyez le premier à commenter</h4>
                                <p class="text-muted mb-4">
                                    Partagez vos réflexions et démarrez la conversation !
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Auteur - Carte Pinterest -->
            <div class="author-card-sidebar mb-5">
                <div class="author-header">
                    @if(isset($contenu->author_photo_url) && $contenu->author_photo_url)
                    <img src="{{ $contenu->author_photo_url }}"
                         alt="Photo de {{ $contenu->auteur->name ?? 'Auteur' }}"
                         class="author-avatar-large">
                    @else
                    <div class="author-avatar-large bg-gradient d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="background: var(--primary-gradient);">
                        <i class="bi bi-person text-white fs-2"></i>
                    </div>
                    @endif

                    <h4 class="fw-bold mb-2">{{ $contenu->auteur->name ?? 'Auteur' }}</h4>
                    <p class="mb-0 opacity-90">
                        <i class="bi bi-award me-1"></i>
                        {{ $contenu->auteur->role->nom_role ?? 'Contributeur Premium' }}
                    </p>
                </div>

                <div class="author-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $auteurStats['contenus'] ?? 24 }}</span>
                        <span class="stat-label">Contenus</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $auteurStats['followers'] ?? '1.2K' }}</span>
                        <span class="stat-label">Abonnés</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $auteurStats['total_likes'] ?? '4.5K' }}</span>
                        <span class="stat-label">Likes</span>
                    </div>
                </div>

                <div class="p-4 text-center">
                    <button class="btn-subscribe mb-3 w-100">
                        <i class="bi bi-plus-circle"></i>
                        S'abonner
                    </button>

                    <div class="d-flex justify-content-center gap-4 text-muted small">
                        <div>
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $auteurStats['inscrit_depuis'] ?? '2 ans' }}
                        </div>
                        <div>
                            <i class="bi bi-globe me-1"></i>
                            {{ $contenu->region->nom_region ?? 'Bénin' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenus similaires Pinterest -->
            <div class="card border-0 shadow-lg mb-5">
                <div class="card-header bg-white border-0 py-4" style="background: var(--secondary-gradient); color: white;">
                    <h4 class="mb-0">
                        <i class="bi bi-collection-play-fill me-2"></i>
                        Vous aimerez aussi
                    </h4>
                </div>
                <div class="card-body p-4">
                    @if(isset($contenusSimilaires) && $contenusSimilaires->count() > 0)
                        @foreach($contenusSimilaires as $similar)
                        <a href="{{ route('front.contenu', ['id' => $similar->id_contenu]) }}" class="text-decoration-none text-dark">
                            <div class="similar-card-pinterest mb-4">
                                <div class="similar-card-img">
                                    @if(isset($similar->cover_image))
                                    <img src="{{ $similar->cover_image }}"
                                         alt="{{ $similar->titre }}">
                                    @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                        <i class="bi bi-image text-muted fs-1"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="p-3">
                                    <h6 class="fw-bold mb-2">{{ Str::limit($similar->titre ?? 'Sans titre', 40) }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-{{ $typeIcons[$similar->typeContenu->id_type_contenu ?? 1]['icon'] ?? 'grid' }} me-1"></i>
                                            {{ $similar->typeContenu->nom_contenu ?? 'Général' }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="bi bi-eye me-1"></i>
                                            {{ $similar->vues_count ?? 0 }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    @else
                    <div class="text-center py-4">
                        <div class="empty-state">
                            <i class="bi bi-info-circle display-4 text-muted mb-3"></i>
                            <p class="text-muted mb-0">Aucun contenu similaire</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Stats détaillées Pinterest -->
            <div class="stats-card-sidebar">
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-bar-chart-fill me-2" style="color: var(--primary);"></i>
                    Statistiques détaillées
                </h5>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold">Vues totales</span>
                        <span class="fw-bold text-primary">{{ $stats['vues'] ?? '2.5K' }}</span>
                    </div>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: {{ min(100, (($stats['vues'] ?? 2500) / 5000 * 100)) }}%"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold">Taux d'engagement</span>
                        <span class="fw-bold text-success">{{ rand(15, 85) }}%</span>
                    </div>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: {{ rand(15, 85) }}%; background: var(--success-gradient);"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-share-fill me-2" style="color: var(--primary);"></i>
                            <span>Partages</span>
                        </div>
                        <span class="fw-bold">{{ $stats['partages'] ?? 45 }}</span>
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-heart-fill me-2" style="color: #f5576c;"></i>
                            <span>Ajouté aux favoris</span>
                        </div>
                        <span class="fw-bold text-danger">{{ $stats['favoris'] ?? 89 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour les commentaires -->
<div class="modal fade" id="commentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: var(--primary-gradient); color: white; border-radius: 20px 20px 0 0;">
                <h5 class="modal-title">
                    <i class="bi bi-chat-left-text-fill me-2"></i>
                    Ajouter un commentaire
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <textarea class="form-control" rows="5" placeholder="Écrivez votre commentaire ici..."
                          style="border-radius: 15px; border: 2px solid #e2e8f0; resize: none;"></textarea>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 15px;">Annuler</button>
                <button type="button" class="btn btn-primary" style="border-radius: 15px;">
                    <i class="bi bi-send me-2"></i>Publier
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page contenu chargée avec succès');

    // Animation des statistiques
    animateStats();

    // Gestion des images miniatures
    const thumbnails = document.querySelectorAll('.media-thumbnail');
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            const mainImage = document.getElementById('mainImage');
            if (mainImage) {
                mainImage.style.opacity = '0.7';
                setTimeout(() => {
                    const imgSrc = this.querySelector('img').src;
                    mainImage.src = imgSrc;
                    mainImage.style.opacity = '1';
                }, 200);
            }
        });
    });

    // Animation des badges
    const badges = document.querySelectorAll('.meta-badge, .tag-bubble');
    badges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 10px 20px rgba(0,0,0,0.2)';
        });

        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });

    // Gestion des boutons d'action
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const badge = this.querySelector('.badge-count');
            if (badge) {
                let count = parseInt(badge.textContent);
                badge.textContent = count + 1;
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            }
        });
    });

    // Animation des cartes similaires
    const similarCards = document.querySelectorAll('.similar-card-pinterest');
    similarCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = '0 20px 40px rgba(0,0,0,0.15)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 10px 30px rgba(0,0,0,0.08)';
        });
    });

    // Gestion des offres
    const offerItems = document.querySelectorAll('.offer-item');
    offerItems.forEach(item => {
        item.addEventListener('click', function() {
            const onclickAttr = this.getAttribute('onclick');
            if (onclickAttr) {
                const url = onclickAttr.match(/'([^']+)'/)?.[1];
                if (url) {
                    window.location.href = url;
                }
            }
        });
    });

    // Animation pour la carte premium
    const premiumCard = document.querySelector('.premium-offer-card');
    if (premiumCard) {
        premiumCard.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
            this.style.boxShadow = '0 30px 60px rgba(102, 126, 234, 0.4)';
        });

        premiumCard.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 25px 50px rgba(102, 126, 234, 0.4)';
        });
    }

    // Animation pour la carte CTA
    const ctaCard = document.querySelector('.cta-card');
    if (ctaCard) {
        ctaCard.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
            this.style.boxShadow = '0 25px 50px rgba(240, 147, 251, 0.4)';
        });

        ctaCard.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 20px 40px rgba(240, 147, 251, 0.4)';
        });
    }
});

function animateStats() {
    const stats = document.querySelectorAll('.stat-number');
    stats.forEach(stat => {
        const finalValue = parseInt(stat.textContent.replace(/[^\d]/g, ''));
        let startValue = 0;
        const duration = 2000;
        const increment = finalValue / (duration / 16);

        const timer = setInterval(() => {
            startValue += increment;
            if (startValue >= finalValue) {
                stat.textContent = finalValue.toLocaleString();
                clearInterval(timer);
            } else {
                stat.textContent = Math.floor(startValue).toLocaleString();
            }
        }, 16);
    });
}

function shareContent() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $contenu->titre }}',
            text: 'Découvrez ce contenu sur Bénin Culture',
            url: window.location.href,
        })
        .then(() => console.log('Contenu partagé avec succès'))
        .catch((error) => console.log('Erreur de partage:', error));
    } else {
        const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`;
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
}

function redirectToBoutique(type = 'premium', contenuId = null) {
    let url = '/boutique';

    if (contenuId) {
        url += `?contenu_id=${contenuId}&type=${type}`;
    } else if (type) {
        url += `?type=${type}`;
    }

    const loader = document.createElement('div');
    loader.innerHTML = `
        <div style="
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        ">
            <div style="
                background: white;
                padding: 30px;
                border-radius: 15px;
                text-align: center;
            ">
                <div class="spinner-border text-primary mb-3" role="status"></div>
                <p class="mb-0">Redirection vers la boutique...</p>
            </div>
        </div>
    `;
    document.body.appendChild(loader);

    setTimeout(() => {
        window.location.href = url;
    }, 1000);
}
</script>
@endpush
