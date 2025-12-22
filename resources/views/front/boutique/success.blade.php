@extends('layouts.layout_front')

@section('title', 'Paiement réussi - Bénin Culture')

@push('styles')
<style>
    :root {
        --benin-red: #E8112D;
        --benin-yellow: #FCD116;
        --benin-green: #008751;
        --benin-dark: #1A1A2E;
    }

    .success-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 100px 0 50px;
    }

    .success-header {
        background: linear-gradient(135deg, var(--benin-green), #28a745);
        color: white;
        padding: 3rem 0;
        border-radius: 0 0 30px 30px;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .success-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 0 auto;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #28a745, #20c997);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        animation: successPulse 2s infinite;
    }

    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .details-list {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 1.5rem;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 0.8rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .detail-item:last-child {
        border-bottom: none;
    }
</style>
@endpush

@section('content')
<div class="success-page">
    <!-- Header -->
    <div class="success-header">
        <div class="container">
            <div class="text-center">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="bi bi-check-circle-fill me-2"></i>Paiement réussi !
                </h1>
                <p class="lead mb-0 opacity-90">
                    Votre abonnement a été activé avec succès
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="success-card">
            <div class="p-5 text-center">
                <!-- Icône de succès -->
                <div class="success-icon mb-4">
                    <i class="bi bi-check-lg display-4 text-white"></i>
                </div>

                <h2 class="fw-bold mb-3">Merci pour votre achat !</h2>

                <p class="text-muted mb-4">
                    Votre paiement a été traité avec succès.
                    <br>
                    Votre abonnement est maintenant actif.
                </p>

                <!-- Détails de la transaction -->
                <div class="details-list mb-5">
                    <div class="detail-item">
                        <span class="fw-bold">Référence</span>
                        <span class="text-primary fw-bold">{{ $paiement['reference'] }}</span>
                    </div>

                    <div class="detail-item">
                        <span>Date et heure</span>
                        <span>{{ $paiement['date'] }}</span>
                    </div>

                    <div class="detail-item">
                        <span>Montant</span>
                        <span class="fw-bold">{{ $paiement['montant'] }}</span>
                    </div>

                    <div class="detail-item">
                        <span>Statut</span>
                        <span class="badge bg-success">{{ $paiement['statut'] }}</span>
                    </div>

                    <div class="detail-item">
                        <span>Description</span>
                        <span>{{ $paiement['description'] }}</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-3 d-md-flex justify-content-center">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-speedometer2 me-2"></i>Accéder à mon tableau de bord
                    </a>

                    <a href="{{ route('front.explorer') }}" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-compass me-2"></i>Explorer les contenus
                    </a>
                </div>

                <!-- Info supplémentaire -->
                <div class="mt-5 pt-4 border-top">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-info-circle me-2"></i>Prochaines étapes
                    </h5>

                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-rocket-takeoff display-6 text-primary mb-2"></i>
                                <span class="fw-bold">Accès immédiat</span>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-envelope display-6 text-success mb-2"></i>
                                <span class="fw-bold">Email de confirmation</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-headset display-6 text-warning mb-2"></i>
                                <span class="fw-bold">Support disponible</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support -->
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 bg-light">
                    <div class="card-body p-4 text-center">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-question-circle me-2"></i>
                            Besoin d'aide ?
                        </h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="https://wa.me/229XXXXXXXXX" target="_blank" class="btn btn-success w-100">
                                    <i class="bi bi-whatsapp me-2"></i>Support WhatsApp
                                </a>
                            </div>

                            <div class="col-md-6">
                                <a href="mailto:support@beninculture.com" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-envelope me-2"></i>Email support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
