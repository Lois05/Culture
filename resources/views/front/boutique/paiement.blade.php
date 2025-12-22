@extends('layouts.layout_front')

@section('title', 'Paiement sécurisé - Bénin Culture')

@push('styles')
<style>
    :root {
        --benin-red: #E8112D;
        --benin-yellow: #FCD116;
        --benin-green: #008751;
        --benin-dark: #1A1A2E;
        --mtn-yellow: #FFD100;
        --moov-orange: #FF6B00;
    }

    .paiement-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        padding: 100px 0 50px;
    }

    /* Header */
    .paiement-header {
        background: linear-gradient(135deg, var(--benin-dark), var(--benin-red));
        color: white;
        padding: 3rem 0;
        border-radius: 0 0 30px 30px;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    /* Carte principale */
    .payment-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        transition: transform 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .payment-summary {
        background: linear-gradient(135deg, var(--benin-green), #00a86b);
        color: white;
        padding: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    /* Opérateurs */
    .operator-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin: 2rem 0;
    }

    .operator-card {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
    }

    .operator-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .operator-card.selected {
        border-color: transparent;
        color: white;
    }

    .operator-card.mtn.selected {
        background: linear-gradient(135deg, var(--mtn-yellow), #FFA500);
        box-shadow: 0 10px 20px rgba(255, 209, 0, 0.2);
    }

    .operator-card.moov.selected {
        background: linear-gradient(135deg, var(--moov-orange), #FF8C00);
        box-shadow: 0 10px 20px rgba(255, 107, 0, 0.2);
    }

    /* Formulaire téléphone */
    .phone-form-container {
        max-width: 400px;
        margin: 0 auto;
    }

    .phone-input-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .country-code {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--benin-green);
        color: white;
        padding: 8px 15px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 0.9rem;
        z-index: 10;
    }

    .phone-input {
        padding-left: 90px;
        height: 55px;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        font-size: 1rem;
        font-family: monospace;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .phone-input:focus {
        border-color: var(--benin-red);
        box-shadow: 0 0 0 3px rgba(232, 17, 45, 0.1);
    }

    /* Bouton de paiement */
    .btn-payer {
        background: linear-gradient(135deg, var(--benin-red), var(--benin-yellow));
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: bold;
        font-size: 1.1rem;
        width: 100%;
        max-width: 400px;
        margin: 2rem auto;
        display: block;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-payer:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(232, 17, 45, 0.2);
    }

    .btn-payer:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: linear-gradient(135deg, #6c757d, #adb5bd);
    }

    .btn-payer.ready {
        background: linear-gradient(135deg, var(--benin-green), #28a745);
    }

    .spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
        margin-right: 10px;
        vertical-align: middle;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Messages */
    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: none;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Animation pour validation */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
    }

    .valid-pulse {
        animation: pulse 0.5s ease;
    }
</style>
@endpush

@section('content')
<div class="paiement-page">
    <!-- Header -->
    <div class="paiement-header">
        <div class="container">
            <div class="text-center">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="bi bi-lock-fill me-2"></i>Paiement sécurisé
                </h1>
                <p class="lead mb-0 opacity-90">
                    Finalisez votre abonnement en toute sécurité
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Colonne gauche : Formulaire de paiement -->
            <div class="col-lg-8 mb-4">
                <div class="payment-card">
                    <!-- Récapitulatif -->
                    <div class="payment-summary">
                        <div class="row align-items-center">
                            <div class="col-md-8 text-md-start text-center">
                                <h3 class="fw-bold mb-2">
                                    <i class="bi bi-{{ $achat['icon'] ?? 'star' }} me-2"></i>
                                    {{ $achat['nom'] }}
                                </h3>
                                <p class="mb-0 opacity-90">
                                    @if($achat['period'] == 'monthly')
                                        <i class="bi bi-calendar-week me-1"></i>Abonnement mensuel
                                    @elseif($achat['period'] == 'yearly')
                                        <i class="bi bi-calendar-month me-1"></i>Abonnement annuel
                                    @else
                                        <i class="bi bi-infinity me-1"></i>Abonnement à vie
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-4 text-md-end text-center mt-3 mt-md-0">
                                <div class="display-4 fw-bold">
                                    {{ number_format($achat['prix'], 0, ',', ' ') }}
                                </div>
                                <div class="h5">{{ $achat['devise'] }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire -->
                    <div class="p-4">
                        <!-- Sélecteur d'opérateur -->
                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-phone-vibrate me-2"></i>
                            Choisissez votre opérateur
                        </h5>

                        <div class="operator-grid">
                            <div class="operator-card mtn" onclick="selectOperator('mtn')" id="operator-mtn">
                                <div class="operator-icon">
                                    <i class="bi bi-phone fs-1"></i>
                                </div>
                                <h6 class="fw-bold mb-2">MTN Mobile Money</h6>
                                <p class="small mb-0 opacity-75">Paiement instantané</p>
                            </div>

                            <div class="operator-card moov" onclick="selectOperator('moov')" id="operator-moov">
                                <div class="operator-icon">
                                    <i class="bi bi-phone fs-1"></i>
                                </div>
                                <h6 class="fw-bold mb-2">Moov Money</h6>
                                <p class="small mb-0 opacity-75">Paiement sécurisé</p>
                            </div>
                        </div>

                        <!-- Formulaire téléphone -->
                        <div id="phone-form" style="display: none;">
                            <h5 class="fw-bold mb-4 mt-5">
                                <i class="bi bi-telephone-forward me-2"></i>
                                Votre numéro de téléphone
                            </h5>

                            <div class="phone-form-container">
                                <div class="phone-input-group">
                                    <span class="country-code">+229</span>
                                    <input type="tel"
                                           id="phone-number"
                                           class="form-control phone-input"
                                           placeholder="01 23 45 67 89"
                                           maxlength="14"
                                           oninput="validatePhoneNumber(this)"
                                           required>
                                </div>

                                <div class="phone-format-hint text-center mb-3">
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Format : <strong>01 23 45 67 89</strong> (10 chiffres)
                                    </small>
                                </div>

                                <div id="phone-error" class="error-message text-center">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    <span id="error-text"></span>
                                </div>

                                <!-- Indicateur de validation -->
                                <div id="phone-success" class="text-center mb-3" style="display: none;">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <small class="text-success fw-bold">Numéro valide ✓</small>
                                </div>
                            </div>
                        </div>

                        <!-- Bouton de paiement -->
                        <form id="payment-form" action="{{ route('paiement.fedapay.process') }}" method="POST">
                            @csrf
                            <input type="hidden" name="operator" id="operator-input">
                            <input type="hidden" name="phone_number" id="phone-number-input">

                            <button type="submit"
                                    id="pay-button"
                                    class="btn-payer"
                                    disabled>
                                <i class="bi bi-lock-fill me-2"></i>
                                Payer {{ number_format($achat['prix'], 0, ',', ' ') }} {{ $achat['devise'] }}
                            </button>
                        </form>

                        <!-- Conditions -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="bi bi-shield-check me-1"></i>
                                Paiement 100% sécurisé
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne droite : Récapitulatif -->
            <div class="col-lg-4">
                <div class="payment-card">
                    <div class="card-header bg-light">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-receipt me-2"></i>
                            Votre commande
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>{{ $achat['nom'] }}</span>
                            <span class="fw-bold">{{ number_format($achat['prix'], 0, ',', ' ') }} {{ $achat['devise'] }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Durée</span>
                            <span>
                                @if($achat['period'] == 'monthly')
                                    1 mois
                                @elseif($achat['period'] == 'yearly')
                                    12 mois
                                @else
                                    À vie
                                @endif
                            </span>
                        </div>

                        <hr class="my-3">

                        <div class="d-flex justify-content-between mb-4">
                            <span class="h5 fw-bold">Total</span>
                            <span class="h4 fw-bold text-primary">
                                {{ number_format($achat['prix'], 0, ',', ' ') }} {{ $achat['devise'] }}
                            </span>
                        </div>

                        <!-- Support -->
                        <div class="text-center mt-4">
                            <p class="small text-muted mb-2">
                                <i class="bi bi-headset me-1"></i>
                                Besoin d'aide ?
                            </p>
                            <a href="https://wa.me/229XXXXXXXXX" target="_blank" class="btn btn-success btn-sm w-100">
                                <i class="bi bi-whatsapp me-2"></i>Support WhatsApp
                            </a>
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
    let selectedOperator = null;
    let isPhoneValid = false;
    const payButton = document.getElementById('pay-button');
    const phoneError = document.getElementById('phone-error');
    const phoneSuccess = document.getElementById('phone-success');
    const errorText = document.getElementById('error-text');
    const paymentForm = document.getElementById('payment-form');

    // Sélectionner un opérateur
    window.selectOperator = function(operator) {
        selectedOperator = operator;

        // Retirer la sélection de tous
        document.querySelectorAll('.operator-card').forEach(card => {
            card.classList.remove('selected');
        });

        // Ajouter la sélection
        document.getElementById(`operator-${operator}`).classList.add('selected');

        // Afficher le formulaire téléphone
        const phoneForm = document.getElementById('phone-form');
        phoneForm.style.display = 'block';

        // Mettre à jour le champ caché
        document.getElementById('operator-input').value = operator;

        // Focus sur le champ téléphone
        setTimeout(() => {
            document.getElementById('phone-number').focus();
        }, 300);

        // Animation
        phoneForm.style.opacity = '0';
        phoneForm.style.transform = 'translateY(20px)';
        setTimeout(() => {
            phoneForm.style.transition = 'all 0.4s ease';
            phoneForm.style.opacity = '1';
            phoneForm.style.transform = 'translateY(0)';
        }, 100);

        // Si un numéro est déjà saisi, revalider
        const phoneInput = document.getElementById('phone-number');
        if (phoneInput.value) {
            validatePhoneNumber(phoneInput);
        }
    };

    // Valider le numéro de téléphone
    window.validatePhoneNumber = function(input) {
        let value = input.value.replace(/\D/g, '');

        // Cacher tous les messages
        phoneError.style.display = 'none';
        phoneSuccess.style.display = 'none';

        // Vérifier si le champ est vide
        if (value.length === 0) {
            isPhoneValid = false;
            updatePayButton();
            return;
        }

        // Validation basique
        if (value.length !== 10) {
            showError('Le numéro doit contenir 10 chiffres');
            isPhoneValid = false;
            updatePayButton();
            return;
        }

        // Vérifier le préfixe selon l'opérateur
        if (selectedOperator === 'mtn' && !value.startsWith('01')) {
            showError('MTN Mobile Money commence par 01');
            isPhoneValid = false;
            updatePayButton();
            return;
        }

        if (selectedOperator === 'moov' && !value.startsWith('02')) {
            showError('Moov Money commence par 02');
            isPhoneValid = false;
            updatePayButton();
            return;
        }

        // Vérifier format général (01 ou 02)
        if (!value.startsWith('01') && !value.startsWith('02')) {
            showError('Le numéro doit commencer par 01 (MTN) ou 02 (Moov)');
            isPhoneValid = false;
            updatePayButton();
            return;
        }

        // Numéro valide !
        isPhoneValid = true;

        // Mettre à jour le champ caché
        document.getElementById('phone-number-input').value = '+229' + value;

        // Afficher le succès
        phoneSuccess.style.display = 'block';
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');

        // Activer le bouton
        updatePayButton();

        // Animation de succès
        payButton.classList.add('valid-pulse');
        setTimeout(() => payButton.classList.remove('valid-pulse'), 500);
    };

    // Afficher une erreur
    function showError(message) {
        errorText.textContent = message;
        phoneError.style.display = 'block';

        const phoneInput = document.getElementById('phone-number');
        phoneInput.classList.add('is-invalid');
        phoneInput.classList.remove('is-valid');
    }

    // Mettre à jour l'état du bouton de paiement
    function updatePayButton() {
        if (isPhoneValid && selectedOperator) {
            payButton.disabled = false;
            payButton.classList.add('ready');
        } else {
            payButton.disabled = true;
            payButton.classList.remove('ready');
        }
    }

    // Gérer la soumission du formulaire
    paymentForm.addEventListener('submit', function(e) {
        if (!isPhoneValid || !selectedOperator) {
            e.preventDefault();
            alert('Veuillez entrer un numéro de téléphone valide');
            return false;
        }

        // Désactiver le bouton et afficher le chargement
        payButton.disabled = true;
        payButton.innerHTML = '<span class="spinner"></span> Traitement en cours...';

        return true;
    });

    // Auto-sélectionner MTN par défaut
    setTimeout(() => {
        if (!selectedOperator) {
            selectOperator('mtn');
        }
    }, 500);

    // Formater le numéro pendant la saisie
    const phoneInput = document.getElementById('phone-number');
    phoneInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        value = value.substring(0, 10);

        let formatted = '';
        for (let i = 0; i < value.length; i++) {
            if (i > 0 && i % 2 === 0) {
                formatted += ' ';
            }
            formatted += value[i];
        }

        this.value = formatted;
    });
});
</script>
@endpush
