@extends('layouts.layout_front')

@section('title', 'Choisir votre abonnement - Bénin Culture')

@push('styles')
<style>
    :root {
        --benin-red: #E8112D;
        --benin-yellow: #FCD116;
        --benin-green: #008751;
        --benin-dark: #1A1A2E;
    }

    .choix-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 100px 0 50px;
    }

    /* Header */
    .choix-header {
        background: linear-gradient(135deg, var(--benin-dark), var(--benin-red));
        color: white;
        padding: 3rem 0;
        border-radius: 0 0 30px 30px;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .choix-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
    }

    /* Cartes de sélection */
    .plan-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        cursor: pointer;
        border: 3px solid transparent;
    }

    .plan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .plan-card.selected {
        border-color: var(--benin-red);
        box-shadow: 0 0 0 3px rgba(232, 17, 45, 0.2);
    }

    .plan-header {
        padding: 2rem;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .plan-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.2);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
    }

    /* Périodes */
    .period-selector {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 2rem 0;
    }

    .period-btn {
        padding: 12px 25px;
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        text-align: center;
    }

    .period-btn:hover {
        border-color: var(--benin-red);
        color: var(--benin-red);
    }

    .period-btn.active {
        background: var(--benin-red);
        color: white;
        border-color: var(--benin-red);
    }

    .period-btn .saving {
        font-size: 0.8rem;
        color: var(--benin-green);
        font-weight: bold;
    }

    /* Features */
    .feature-check {
        color: var(--benin-green);
        margin-right: 10px;
    }

    /* Bouton continuer */
    .btn-continuer {
        background: linear-gradient(135deg, var(--benin-red), var(--benin-yellow));
        color: white;
        border: none;
        padding: 1.2rem 3rem;
        border-radius: 15px;
        font-weight: bold;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .btn-continuer:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(232, 17, 45, 0.3);
    }

    /* Prix */
    .price-display {
        text-align: center;
        margin: 1rem 0;
    }

    .price-amount {
        font-size: 2.5rem;
        font-weight: 900;
        line-height: 1;
    }

    .price-period {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .choix-container {
            padding: 80px 0 30px;
        }

        .period-selector {
            flex-direction: column;
            gap: 5px;
        }

        .plan-card {
            margin-bottom: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="choix-container">
    <!-- Header -->
    <div class="choix-header">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb breadcrumb-light">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('boutique.index') }}" class="text-white text-decoration-none">Boutique</a></li>
                    <li class="breadcrumb-item active text-white">Choisir</li>
                </ol>
            </nav>

            <div class="text-center">
                <h1 class="display-5 fw-bold mb-3">Choisissez votre formule</h1>
                <p class="lead mb-0" style="opacity: 0.9;">
                    Sélectionnez la période et l'abonnement qui vous conviennent
                </p>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="container">
        <!-- Sélecteur de période -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 text-center">
                            <i class="bi bi-calendar-range me-2 text-primary"></i>
                            Choisissez la durée
                        </h5>

                        <div class="period-selector">
                            <div class="period-btn active" data-period="monthly">
                                <div>Mensuel</div>
                                <small class="text-muted">Flexible</small>
                            </div>
                            <div class="period-btn" data-period="yearly">
                                <div>Annuel</div>
                                <small class="saving">Économisez 20%</small>
                            </div>
                            <div class="period-btn" data-period="lifetime">
                                <div>À vie</div>
                                <small class="saving">Meilleure offre</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cartes d'abonnement -->
        <form id="choixForm" action="{{ route('paiement.process-choix') }}" method="POST">
            @csrf
            <input type="hidden" id="selectedPeriod" name="period" value="monthly">

            @if($abonnements->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-emoji-frown display-1 text-muted mb-3"></i>
                    <h3 class="mb-3">Aucun abonnement disponible</h3>
                    <p class="text-muted mb-4">
                        Les abonnements seront bientôt disponibles.
                    </p>
                    <a href="{{ route('boutique.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-2"></i>Retour à la boutique
                    </a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($abonnements as $abonnement)
                        @php
                            $color = $abonnement->couleur ?? '#667eea';
                            $darkColor = $this->adjustColor($color, -30);
                        @endphp

                        <div class="col-lg-4">
                            <input type="radio"
                                   name="id_abonnement"
                                   id="plan_{{ $abonnement->id }}"
                                   value="{{ $abonnement->id }}"
                                   class="d-none"
                                   {{ $loop->first ? 'checked' : '' }}>

                            <label for="plan_{{ $abonnement->id }}">
                                <div class="plan-card">
                                    <div class="plan-header" style="background: linear-gradient(135deg, {{ $color }}, {{ $darkColor }});">
                                        @if($abonnement->nom == 'Passionné')
                                            <span class="plan-badge">
                                                <i class="bi bi-star-fill me-1"></i>Populaire
                                            </span>
                                        @endif

                                        <div class="mb-3">
                                            <i class="bi {{ $abonnement->icon }} display-4"></i>
                                        </div>

                                        <h4 class="fw-bold mb-2">{{ $abonnement->nom }}</h4>

                                        <div class="price-display">
                                            <div class="price-amount monthly-price">
                                                {{ number_format($abonnement->prix, 0, ',', ' ') }}
                                            </div>
                                            <div class="price-amount yearly-price d-none">
                                                {{ number_format($abonnement->prix * 10, 0, ',', ' ') }}
                                            </div>
                                            <div class="price-amount lifetime-price d-none">
                                                {{ number_format($abonnement->prix * 100, 0, ',', ' ') }}
                                            </div>
                                            <div class="price-period">{{ $abonnement->devise }}</div>
                                        </div>

                                        <small>{{ $abonnement->description_courte }}</small>
                                    </div>

                                    <div class="p-4">
                                        @foreach($abonnement->features_list as $feature)
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-check-circle-fill feature-check"></i>
                                                <span>{{ $feature }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>

                <!-- Actions -->
                <div class="text-center mt-5 pt-4">
                    <a href="{{ route('boutique.index') }}" class="btn btn-outline-secondary btn-lg me-3">
                        <i class="bi bi-arrow-left me-2"></i>Retour
                    </a>

                    <button type="submit" class="btn-continuer btn-lg">
                        <i class="bi bi-arrow-right me-2"></i>Continuer vers le paiement
                    </button>
                </div>
            @endif
        </form>

        <!-- Garanties -->
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 bg-light">
                    <div class="card-body p-4 text-center">
                        <div class="row">
                            <div class="col-md-3">
                                <i class="bi bi-shield-check display-6 text-success mb-3"></i>
                                <h6>Sécurisé</h6>
                            </div>
                            <div class="col-md-3">
                                <i class="bi bi-arrow-counterclockwise display-6 text-primary mb-3"></i>
                                <h6>30 jours</h6>
                            </div>
                            <div class="col-md-3">
                                <i class="bi bi-headset display-6 text-warning mb-3"></i>
                                <h6>Support 24/7</h6>
                            </div>
                            <div class="col-md-3">
                                <i class="bi bi-award display-6 text-danger mb-3"></i>
                                <h6>Certifié</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    function adjustColor($hex, $percent) {
        $hex = str_replace('#', '', $hex);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        $r = max(0, min(255, $r + $percent));
        $g = max(0, min(255, $g + $percent));
        $b = max(0, min(255, $b + $percent));

        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }
@endphp
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des périodes
    const periodBtns = document.querySelectorAll('.period-btn');
    const periodInput = document.getElementById('selectedPeriod');

    // Prix par période
    const monthlyPrices = document.querySelectorAll('.monthly-price');
    const yearlyPrices = document.querySelectorAll('.yearly-price');
    const lifetimePrices = document.querySelectorAll('.lifetime-price');

    periodBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Retirer active de tous
            periodBtns.forEach(b => b.classList.remove('active'));

            // Activer le bouton cliqué
            this.classList.add('active');

            const period = this.dataset.period;
            periodInput.value = period;

            // Afficher/Masquer les prix
            monthlyPrices.forEach(p => p.classList.add('d-none'));
            yearlyPrices.forEach(p => p.classList.add('d-none'));
            lifetimePrices.forEach(p => p.classList.add('d-none'));

            switch(period) {
                case 'monthly':
                    monthlyPrices.forEach(p => p.classList.remove('d-none'));
                    break;
                case 'yearly':
                    yearlyPrices.forEach(p => p.classList.remove('d-none'));
                    break;
                case 'lifetime':
                    lifetimePrices.forEach(p => p.classList.remove('d-none'));
                    break;
            }
        });
    });

    // Gestion de la sélection des plans
    const planCards = document.querySelectorAll('.plan-card');
    const planInputs = document.querySelectorAll('input[name="id_abonnement"]');

    planInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Retirer selected de toutes les cartes
            planCards.forEach(card => card.classList.remove('selected'));

            // Ajouter selected à la carte correspondante
            const label = document.querySelector(`label[for="${this.id}"]`);
            if (label) {
                label.querySelector('.plan-card').classList.add('selected');
            }
        });
    });

    // Initialiser la première carte comme sélectionnée
    const firstChecked = document.querySelector('input[name="id_abonnement"]:checked');
    if (firstChecked) {
        const firstLabel = document.querySelector(`label[for="${firstChecked.id}"]`);
        if (firstLabel) {
            firstLabel.querySelector('.plan-card').classList.add('selected');
        }
    }

    // Animation au survol
    planCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            if (!this.classList.contains('selected')) {
                this.style.transform = 'translateY(-5px)';
            }
        });

        card.addEventListener('mouseleave', function() {
            if (!this.classList.contains('selected')) {
                this.style.transform = 'translateY(0)';
            }
        });
    });
});
</script>
@endpush
