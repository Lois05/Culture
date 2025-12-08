@extends('layouts.layout_front')

@section('title', 'Boutique - Offres Premium - Bénin Culture')

@push('styles')
<style>
    :root {
        --primary: #667eea;
        --primary-dark: #5a67d8;
        --secondary: #f093fb;
        --success: #43e97b;
        --warning: #ffd166;
        --danger: #f5576c;
        --dark: #2d3748;
        --light: #f8f9fa;
    }

    /* Hero Section Boutique */
    .hero-boutique {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9)),
                    url('{{ asset('adminlte/img/collage.png') }}') center/cover no-repeat;
        padding: 8rem 0 4rem;
        color: white;
        clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        margin-top: -80px;
        position: relative;
    }

    .hero-boutique::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 25%, transparent 25%),
                    linear-gradient(-45deg, rgba(255,255,255,0.1) 25%, transparent 25%);
        background-size: 60px 60px;
        opacity: 0.1;
    }

    /* Cartes d'offres */
    .pricing-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        border: 2px solid transparent;
        height: 100%;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .pricing-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 50px rgba(102, 126, 234, 0.2);
        text-decoration: none;
        color: inherit;
    }

    .pricing-card.popular {
        border-color: var(--primary);
        transform: scale(1.05);
        z-index: 2;
    }

    .pricing-card.popular:hover {
        transform: scale(1.05) translateY(-15px);
    }

    .card-header-gradient {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        padding: 2.5rem 2rem;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .popular-badge {
        position: absolute;
        top: 20px;
        right: -35px;
        background: var(--warning);
        color: var(--dark);
        padding: 8px 40px;
        transform: rotate(45deg);
        font-weight: bold;
        font-size: 0.8rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .price-display {
        margin: 1.5rem 0;
    }

    .price-amount {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1;
    }

    .price-period {
        font-size: 1rem;
        opacity: 0.8;
    }

    .price-old {
        text-decoration: line-through;
        color: rgba(255,255,255,0.7);
        font-size: 1.2rem;
    }

    .price-saving {
        background: rgba(255,255,255,0.2);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        display: inline-block;
        margin-top: 10px;
    }

    /* Liste des features */
    .features-list {
        padding: 2rem;
    }

    .feature-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: 0.8rem;
        border-radius: 10px;
        transition: background 0.3s ease;
    }

    .feature-item:hover {
        background: rgba(102, 126, 234, 0.05);
    }

    .feature-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .feature-text {
        flex: 1;
    }

    /* Bouton d'achat */
    .btn-acheter {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: bold;
        font-size: 1.1rem;
        width: 100%;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 1.5rem;
        cursor: pointer;
    }

    .btn-acheter:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-acheter.secondary {
        background: linear-gradient(135deg, var(--secondary), var(--danger));
    }

    .btn-acheter.success {
        background: linear-gradient(135deg, var(--success), #38f9d7);
    }

    /* Section FAQ */
    .faq-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 30px;
        padding: 4rem;
        margin: 4rem 0;
    }

    .faq-item {
        background: white;
        border-radius: 15px;
        margin-bottom: 1rem;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .faq-question {
        padding: 1.5rem;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, #f8f9fa, white);
    }

    .faq-answer {
        padding: 0 1.5rem;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-item.active .faq-answer {
        padding: 1.5rem;
        max-height: 500px;
    }

    /* Avantages */
    .avantage-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .avantage-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }

    .avantage-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
    }

    /* Animation des prix */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .pricing-card.popular .card-header-gradient {
        animation: pulse 2s infinite;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-boutique {
            padding: 6rem 0 3rem;
            clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%);
        }

        .pricing-card.popular {
            transform: scale(1);
            margin: 2rem 0;
        }

        .pricing-card.popular:hover {
            transform: translateY(-15px);
        }

        .faq-section {
            padding: 2rem;
        }

        .price-amount {
            font-size: 2.5rem;
        }
    }

    /* Progress bar pour les offres limitées */
    .offer-progress {
        background: #e2e8f0;
        height: 8px;
        border-radius: 4px;
        overflow: hidden;
        margin: 1rem 0;
    }

    .offer-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--success), #38f9d7);
        border-radius: 4px;
        transition: width 1s ease;
    }

    /* Bouton "Choisir cette offre" */
    .choose-btn-container {
        padding: 0 2rem 2rem 2rem;
    }
</style>
@endpush

@section('content')
<!-- Hero Section Boutique -->
<section class="hero-boutique">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Accueil</a></li>
                        <li class="breadcrumb-item active text-white">Boutique</li>
                    </ol>
                </nav>

                <h1 class="display-3 fw-bold mb-4" style="text-shadow: 2px 2px 10px rgba(0,0,0,0.3);">
                    Accédez à l'excellence culturelle
                </h1>
                <p class="lead mb-4" style="max-width: 600px; opacity: 0.9;">
                    Débloquez des contenus premium, soutenez la préservation du patrimoine béninois
                    et accédez à des ressources exclusives. Choisissez l'offre qui vous correspond.
                </p>

                <div class="d-flex flex-wrap gap-3">
                    <span class="badge bg-light text-dark p-3">
                        <i class="bi bi-shield-check me-2"></i>Paiement 100% sécurisé
                    </span>
                    <span class="badge bg-light text-dark p-3">
                        <i class="bi bi-arrow-clockwise me-2"></i>Garantie satisfait ou remboursé
                    </span>
                    <span class="badge bg-light text-dark p-3">
                        <i class="bi bi-headset me-2"></i>Support 7j/7
                    </span>
                </div>
            </div>

            <div class="col-lg-4 text-center mt-4 mt-lg-0">
                <div class="hero-stats p-4" style="
                    background: rgba(255,255,255,0.1);
                    backdrop-filter: blur(10px);
                    border-radius: 20px;
                    border: 1px solid rgba(255,255,255,0.2);
                ">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="display-6 fw-bold">500+</div>
                            <small>Contenus Premium</small>
                        </div>
                        <div class="col-4">
                            <div class="display-6 fw-bold">95%</div>
                            <small>Clients satisfaits</small>
                        </div>
                        <div class="col-4">
                            <div class="display-6 fw-bold">24h</div>
                            <small>Support rapide</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Offres Principales -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5 mb-3">Choisissez votre formule</h2>
            <p class="text-muted lead">Des options adaptées à tous les passionnés de culture</p>
        </div>

        <div class="row align-items-end">
            @foreach($abonnements as $abonnement)
            <div class="col-lg-4 mb-4">
                <div class="pricing-card {{ $abonnement->nom == 'Passionné' ? 'popular' : '' }}">
                    @if($abonnement->nom == 'Passionné')
                    <div class="popular-badge">POPULAIRE</div>
                    @endif

                    <div class="card-header-gradient {{ $abonnement->nom == 'Professionnel' ? 'bg-dark' : '' }}"
                         style="{{ $abonnement->nom == 'Professionnel' ? 'background: linear-gradient(135deg, #2d3748, #4a5568) !important;' : '' }}">
                        <h4 class="fw-bold">{{ $abonnement->nom }}</h4>
                        <div class="price-display">
                            <div class="price-amount">{{ number_format($abonnement->prix, 0, ',', ' ') }}</div>
                            <div class="price-period">{{ $abonnement->devise ?? 'FCFA' }}</div>
                            <small>{{ $abonnement->description_courte ?? '' }}</small>
                        </div>
                    </div>

                    <div class="features-list">
                        @if($abonnement->features)
                            @foreach(json_decode($abonnement->features, true) as $feature)
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">{{ $feature }}</div>
                            </div>
                            @endforeach
                        @else
                            <!-- Features par défaut selon le type d'abonnement -->
                            @if($abonnement->nom == 'Découverte')
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">
                                    <strong>5 contenus premium</strong> par mois
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">Accès aux contenus gratuits</div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">Support par email</div>
                            </div>
                            @elseif($abonnement->nom == 'Passionné')
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">
                                    <strong>Contenus premium illimités</strong>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">Accès aux masters class</div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">Téléchargements HD</div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">Support prioritaire</div>
                            </div>
                            @elseif($abonnement->nom == 'Professionnel')
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">
                                    <strong>Tous les avantages Passionné</strong>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">Licence commerciale</div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">Formations personnalisées</div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="feature-text">Support dédié 24/7</div>
                            </div>
                            @endif
                        @endif
                    </div>

                    <div class="choose-btn-container">
                        <!-- FORMULAIRE POUR CHOISIR L'ABONNEMENT -->
                        <form action="{{ route('paiement.process-choix') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_abonnement" value="{{ $abonnement->id }}">

                            @if(auth()->check())
                            <button type="submit" class="btn-acheter {{ $abonnement->nom == 'Passionné' ? 'success' : ($abonnement->nom == 'Professionnel' ? 'bg-dark' : '') }}"
                                    style="{{ $abonnement->nom == 'Professionnel' ? 'background: linear-gradient(135deg, #2d3748, #4a5568) !important;' : '' }}">
                                @if($abonnement->nom == 'Passionné')
                                <i class="bi bi-star-fill"></i>
                                Choisir cette offre
                                @elseif($abonnement->nom == 'Professionnel')
                                <i class="bi bi-briefcase-fill"></i>
                                Contactez-nous
                                @else
                                <i class="bi bi-cart-plus"></i>
                                Commencer
                                @endif
                            </button>
                            @else
                            <a href="{{ route('front.connexion') }}" class="btn-acheter">
                                <i class="bi bi-person-fill"></i>
                                Connectez-vous pour acheter
                            </a>
                            @endif
                        </form>

                        @if($abonnement->nom == 'Passionné')
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="bi bi-people-fill me-1"></i>
                                2,500+ membres satisfaits
                            </small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Achats à l'unité -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold">Contenus à l'unité</h3>
            <p class="text-muted">Achetez uniquement ce qui vous intéresse</p>
        </div>

        <div class="row">
            @if(isset($singleContent) && $singleContent)
            <div class="col-md-6 mb-4">
                <div class="pricing-card">
                    <div class="card-header-gradient">
                        <h4 class="fw-bold">{{ $singleContent->titre ?? 'Contenu Premium' }}</h4>
                        <div class="price-display">
                            <div class="price-amount">{{ $singleContent->prix ?? '9.99' }} €</div>
                            <div class="price-period">une seule fois</div>
                        </div>
                    </div>
                    <div class="features-list">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div class="feature-text">Accès complet au contenu</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div class="feature-text">Téléchargement des médias</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div class="feature-text">Accès à vie</div>
                        </div>

                        <form action="{{ route('paiement.process-choix') }}" method="POST">
                            @csrf
                            <input type="hidden" name="contenu_id" value="{{ $singleContent->id_contenu }}">
                            <input type="hidden" name="type" value="single">

                            @if(auth()->check())
                            <button type="submit" class="btn-acheter">
                                <i class="bi bi-unlock-fill"></i>
                                Acheter ce contenu
                            </button>
                            @else
                            <a href="{{ route('front.connexion') }}" class="btn-acheter">
                                <i class="bi bi-person-fill"></i>
                                Connectez-vous pour acheter
                            </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-md-6 mb-4">
                <div class="pricing-card">
                    <div class="card-header-gradient" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
                        <h4 class="fw-bold">Pack Découverte</h4>
                        <div class="price-display">
                            <div class="price-old">5000 FCFA</div>
                            <div class="price-amount">2500 FCFA</div>
                            <div class="price-saving">Économisez 40%</div>
                        </div>
                    </div>
                    <div class="features-list">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div class="feature-text">
                                <strong>10 contenus premium</strong> au choix
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div class="feature-text">Accès pendant 1 an</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div class="feature-text">Guide culturel offert</div>
                        </div>

                        <form action="{{ route('paiement.process-choix') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="pack">
                            <input type="hidden" name="pack_name" value="Pack Découverte">
                            <input type="hidden" name="pack_price" value="2500">

                            @if(auth()->check())
                            <button type="submit" class="btn-acheter success">
                                <i class="bi bi-gift-fill"></i>
                                Acheter le pack
                            </button>
                            @else
                            <a href="{{ route('front.connexion') }}" class="btn-acheter success">
                                <i class="bi bi-person-fill"></i>
                                Connectez-vous pour acheter
                            </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Avantages -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Pourquoi choisir Bénin Culture Premium ?</h2>
            <p class="text-muted">Des avantages exclusifs pour nos membres</p>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="avantage-card">
                    <div class="avantage-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-bold">Garantie 30 jours</h5>
                    <p class="text-muted">Satisfait ou remboursé sans condition</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="avantage-card">
                    <div class="avantage-icon">
                        <i class="bi bi-infinity"></i>
                    </div>
                    <h5 class="fw-bold">Accès illimité</h5>
                    <p class="text-muted">Tous les contenus, toutes les régions</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="avantage-card">
                    <div class="avantage-icon">
                        <i class="bi bi-download"></i>
                    </div>
                    <h5 class="fw-bold">Téléchargements</h5>
                    <p class="text-muted">Gardez les ressources pour toujours</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="avantage-card">
                    <div class="avantage-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h5 class="fw-bold">Communauté</h5>
                    <p class="text-muted">Rencontrez d'autres passionnés</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="faq-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Questions fréquentes</h2>
            <p class="text-muted">Toutes les réponses à vos questions</p>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="faq-item active">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Comment fonctionne l'abonnement ?
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Votre abonnement est renouvelé automatiquement chaque mois/année. Vous pouvez annuler à tout moment, l'accès restera actif jusqu'à la fin de la période payée.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Puis-je changer de formule ?
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Oui, vous pouvez passer à une formule supérieure à tout moment. Le prix sera ajusté au prorata. Pour passer à une formule inférieure, attendez la fin de votre période en cours.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Comment fonctionne la garantie satisfait ou remboursé ?
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Si vous n'êtes pas satisfait dans les 30 premiers jours, contactez-nous et nous vous rembourserons intégralement, sans condition.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Quels modes de paiement acceptez-vous ?
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Nous acceptons les cartes bancaires (Visa, Mastercard), PayPal, FedaPay (Mobile Money et cartes) et les virements bancaires pour les entreprises.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-5 text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="cta-final p-5 rounded-4" style="
                    background: linear-gradient(135deg, #667eea, #764ba2);
                    color: white;
                    box-shadow: 0 20px 60px rgba(102, 126, 234, 0.4);
                ">
                    <h2 class="fw-bold mb-4">Prêt à explorer la culture béninoise ?</h2>
                    <p class="lead mb-4">Rejoignez plus de 10,000 membres qui préservent et célèbrent notre patrimoine.</p>

                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="#offres" class="btn btn-light btn-lg fw-bold px-4">
                            <i class="bi bi-eye-fill me-2"></i>Voir les offres
                        </a>
                        @if(!auth()->check())
                        <a href="{{ route('front.connexion') }}" class="btn btn-outline-light btn-lg fw-bold px-4">
                            <i class="bi bi-person-fill me-2"></i>Créer un compte gratuit
                        </a>
                        @endif
                    </div>

                    <div class="mt-4">
                        <small>
                            <i class="bi bi-lock-fill me-1"></i>
                            Vos données sont sécurisées. Nous ne les partageons jamais.
                        </small>
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
    // Initialisation des tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Animation des cartes au scroll
    animateCardsOnScroll();
});

function toggleFaq(element) {
    const faqItem = element.closest('.faq-item');
    faqItem.classList.toggle('active');

    // Fermer les autres FAQ
    const allFaqItems = document.querySelectorAll('.faq-item');
    allFaqItems.forEach(item => {
        if (item !== faqItem) {
            item.classList.remove('active');
        }
    });
}

function animateCardsOnScroll() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observer les cartes
    document.querySelectorAll('.pricing-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(card);
    });
}

// Scroll vers les offres
document.querySelectorAll('a[href="#offres"]').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const offersSection = document.querySelector('.pricing-card');
        if (offersSection) {
            offersSection.scrollIntoView({ behavior: 'smooth' });
        }
    });
});
</script>
@endpush
