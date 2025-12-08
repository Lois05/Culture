@extends('layouts.layout_front')

@section('title', 'Paiement - Bénin Culture')

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

    .paiement-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 80px 0 40px;
    }

    /* Header de paiement */
    .payment-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 2rem;
        border-radius: 20px 20px 0 0;
        position: relative;
        overflow: hidden;
    }

    .payment-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
    }

    /* Cartes */
    .payment-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    /* Récapitulatif */
    .recap-item {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .recap-item.total {
        border-top: 2px solid var(--primary);
        border-bottom: none;
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--primary);
    }

    /* Formulaires */
    .form-payment .form-control {
        border-radius: 10px;
        padding: 0.8rem 1rem;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .form-payment .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    /* Méthodes de paiement */
    .payment-method {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .payment-method:hover {
        border-color: var(--primary);
        background: rgba(102, 126, 234, 0.05);
    }

    .payment-method.selected {
        border-color: var(--primary);
        background: rgba(102, 126, 234, 0.1);
    }

    .payment-method.selected::before {
        content: '✓';
        position: absolute;
        top: -10px;
        right: -10px;
        width: 25px;
        height: 25px;
        background: var(--primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    /* Bouton de paiement */
    .btn-payer {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        padding: 1.2rem 2.5rem;
        border-radius: 15px;
        font-weight: bold;
        font-size: 1.1rem;
        width: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-payer:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-payer:disabled {
        background: #ccc;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .btn-payer::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 0;
        border-radius: 100%;
        transform: scale(1, 1) translate(-50%);
        transform-origin: 50% 50%;
    }

    .btn-payer:focus:not(:active)::after {
        animation: ripple 1s ease-out;
    }

    @keyframes ripple {
        0% {
            transform: scale(0, 0);
            opacity: 0.5;
        }
        100% {
            transform: scale(20, 20);
            opacity: 0;
        }
    }

    /* Sécurité */
    .security-badges {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 2rem 0;
    }

    .security-badge {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .security-badge:hover {
        opacity: 1;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .paiement-container {
            padding: 60px 0 20px;
        }

        .payment-header {
            padding: 1.5rem;
        }

        .security-badges {
            flex-wrap: wrap;
        }

        .btn-payer {
            padding: 1rem 2rem;
        }
    }

    /* Éléments de garantie */
    .guarantee-item {
        background: rgba(102, 126, 234, 0.1);
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>
@endpush

@section('content')
@php
    // Récupérer l'achat de la session
    $achat = session('achat_choisi');

    // Déterminer le titre selon le type
    if ($achat['type'] == 'abonnement') {
        $titre = $achat['nom'];
        $description = $achat['description'] ?? 'Abonnement premium Bénin Culture';
    } elseif ($achat['type'] == 'contenu_single') {
        $titre = $achat['titre'] ?? 'Contenu Premium';
        $description = 'Accès à vie à ce contenu';
    } elseif ($achat['type'] == 'pack') {
        $titre = $achat['nom'] ?? 'Pack Découverte';
        $description = $achat['description'] ?? 'Pack de contenus premium';
    } else {
        $titre = 'Achat';
        $description = 'Produit Bénin Culture';
    }
@endphp

<div class="paiement-container">
    <div class="container">
        <!-- En-tête -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('boutique.index') }}">Boutique</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Paiement</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <!-- Colonne principale -->
            <div class="col-lg-8">
                <div class="payment-card">
                    <div class="payment-header">
                        <h1 class="h2 fw-bold mb-3">
                            <i class="bi bi-lock-fill me-2"></i>
                            Paiement sécurisé
                        </h1>
                        <p class="mb-0 opacity-90">
                            Vos informations sont protégées par un chiffrement SSL 256 bits
                        </p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <!-- Récapitulatif -->
                        <div class="alert alert-primary mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $titre }}</h5>
                                    <p class="mb-0">{{ $description }}</p>
                                </div>
                                <div class="text-end">
                                    <div class="h3 fw-bold">{{ number_format($achat['prix'], 0, ',', ' ') }} {{ $achat['devise'] ?? 'XOF' }}</div>
                                    <small>
                                        @if($achat['type'] == 'abonnement')
                                        pour {{ $achat['duree_jours'] ?? '30' }} jours
                                        @elseif($achat['type'] == 'contenu_single')
                                        accès à vie
                                        @elseif($achat['type'] == 'pack')
                                        pack de 10 contenus
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Sélection de la méthode de paiement -->
                        <h4 class="fw-bold mb-4">Méthode de paiement</h4>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="payment-method selected" onclick="selectPaymentMethod('carte')" id="method-carte">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-credit-card-2-front fs-3 me-3 text-primary"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1">Carte bancaire</h6>
                                            <p class="small text-muted mb-0">Visa, Mastercard, CB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="payment-method" onclick="selectPaymentMethod('paypal')" id="method-paypal">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-paypal fs-3 me-3" style="color: #003087;"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1">PayPal</h6>
                                            <p class="small text-muted mb-0">Paiement sécurisé PayPal</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Formulaire de carte bancaire -->
                        <div id="carte-form" class="payment-form">
                            <form id="payment-form" class="form-payment" action="{{ route('paiement.process') }}" method="POST">
                                @csrf
                                <input type="hidden" name="achat_type" value="{{ $achat['type'] }}">
                                <input type="hidden" name="achat_id" value="{{ $achat['id'] ?? '' }}">

                                <div class="mb-3">
                                    <label for="nom_titulaire" class="form-label fw-bold">Nom sur la carte</label>
                                    <input type="text"
                                           id="nom_titulaire"
                                           name="nom_titulaire"
                                           class="form-control"
                                           placeholder="Jean Dupont"
                                           value="{{ Auth::user()->name ?? '' }}"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="carte_numero" class="form-label fw-bold">Numéro de carte</label>
                                    <input type="text"
                                           id="carte_numero"
                                           name="carte_numero"
                                           class="form-control"
                                           placeholder="1234 5678 9012 3456"
                                           maxlength="19"
                                           oninput="formatCardNumber(this)"
                                           required>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="carte_expiration_mois" class="form-label fw-bold">Mois d'expiration</label>
                                        <select id="carte_expiration_mois" name="carte_expiration_mois" class="form-control" required>
                                            <option value="">Mois</option>
                                            @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="carte_expiration_annee" class="form-label fw-bold">Année d'expiration</label>
                                        <select id="carte_expiration_annee" name="carte_expiration_annee" class="form-control" required>
                                            <option value="">Année</option>
                                            @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="carte_cvc" class="form-label fw-bold">Code de sécurité (CVC)</label>
                                    <input type="text"
                                           id="carte_cvc"
                                           name="carte_cvc"
                                           class="form-control"
                                           placeholder="123"
                                           maxlength="4"
                                           required>
                                    <div class="form-text">
                                        3 ou 4 chiffres au dos de votre carte
                                    </div>
                                </div>

                                <button type="submit" class="btn-payer" id="submit-payment">
                                    <i class="bi bi-lock-fill me-2"></i>
                                    Payer maintenant {{ number_format($achat['prix'], 0, ',', ' ') }} {{ $achat['devise'] ?? 'XOF' }}
                                </button>
                            </form>
                        </div>

                        <!-- Badges de sécurité -->
                        <div class="security-badges mt-5">
                            <div class="security-badge">
                                <i class="bi bi-shield-check display-4 text-success"></i>
                                <small>SSL 256-bit</small>
                            </div>
                            <div class="security-badge">
                                <i class="bi bi-credit-card display-4 text-primary"></i>
                                <small>Paiement sécurisé</small>
                            </div>
                            <div class="security-badge">
                                <i class="bi bi-lock display-4 text-warning"></i>
                                <small>Données cryptées</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne latérale -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <!-- Récapitulatif de la commande -->
                    <div class="payment-card mb-4">
                        <div class="card-header bg-light py-3">
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-receipt me-2"></i>
                                Récapitulatif
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="recap-item">
                                <span>{{ $titre }}</span>
                                <span class="fw-bold">{{ number_format($achat['prix'], 0, ',', ' ') }} {{ $achat['devise'] ?? 'XOF' }}</span>
                            </div>

                            <div class="recap-item">
                                <span>Taxes</span>
                                <span>0,00 {{ $achat['devise'] ?? 'XOF' }}</span>
                            </div>

                            <div class="recap-item total">
                                <span>TOTAL</span>
                                <span class="h5 mb-0">{{ number_format($achat['prix'], 0, ',', ' ') }} {{ $achat['devise'] ?? 'XOF' }}</span>
                            </div>

                            <div class="mt-4">
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Facture disponible après paiement
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Garanties -->
                    <div class="payment-card">
                        <div class="card-header bg-light py-3">
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-award me-2"></i>
                                Nos garanties
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="guarantee-item">
                                <i class="bi bi-shield-check text-success"></i>
                                <div>
                                    <small class="fw-bold">Paiement 100% sécurisé</small>
                                    <div class="text-muted" style="font-size: 0.8rem;">Données cryptées</div>
                                </div>
                            </div>
                            <div class="guarantee-item">
                                <i class="bi bi-arrow-counterclockwise text-primary"></i>
                                <div>
                                    <small class="fw-bold">30 jours satisfait ou remboursé</small>
                                    <div class="text-muted" style="font-size: 0.8rem;">Sans condition</div>
                                </div>
                            </div>
                            <div class="guarantee-item">
                                <i class="bi bi-headset text-warning"></i>
                                <div>
                                    <small class="fw-bold">Support 7j/7</small>
                                    <div class="text-muted" style="font-size: 0.8rem;">Réponse sous 24h</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sélection par défaut carte
    selectPaymentMethod('carte');
});

function selectPaymentMethod(method) {
    // Désélectionner toutes les méthodes
    document.querySelectorAll('.payment-method').forEach(el => {
        el.classList.remove('selected');
    });

    // Sélectionner la méthode choisie
    document.getElementById(`method-${method}`).classList.add('selected');
}

function formatCardNumber(input) {
    let value = input.value.replace(/\D/g, '');
    let formatted = '';

    for (let i = 0; i < value.length; i++) {
        if (i > 0 && i % 4 === 0) {
            formatted += ' ';
        }
        formatted += value[i];
    }

    input.value = formatted.substring(0, 19);
}

// Validation du formulaire
document.getElementById('payment-form').addEventListener('submit', function(e) {
    const carteNumero = document.getElementById('carte_numero').value.replace(/\s/g, '');
    const carteCvc = document.getElementById('carte_cvc').value;

    if (carteNumero.length < 16) {
        e.preventDefault();
        alert('Veuillez entrer un numéro de carte valide (16 chiffres)');
        return false;
    }

    if (carteCvc.length < 3) {
        e.preventDefault();
        alert('Veuillez entrer un code CVC valide (3 ou 4 chiffres)');
        return false;
    }

    // Afficher un message de chargement
    const submitBtn = document.getElementById('submit-payment');
    submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise spin"></i> Traitement en cours...';
    submitBtn.disabled = true;

    return true;
});
</script>
@endpush
