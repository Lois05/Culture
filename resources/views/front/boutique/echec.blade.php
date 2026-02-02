@extends('layouts.layout_front')

@section('title', 'Paiement échoué - Bénin Culture')

@push('styles')
<style>
    :root {
        --benin-red: #E8112D;
        --benin-yellow: #FCD116;
        --benin-green: #008751;
        --benin-dark: #0A0F2D;
    }

    .failure-container {
        min-height: 80vh;
        background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
        display: flex;
        align-items: center;
        padding: 4rem 0;
    }

    .failure-card {
        background: white;
        border-radius: 30px;
        box-shadow: 0 30px 60px rgba(232, 17, 45, 0.1);
        padding: 3rem;
        text-align: center;
        border-top: 5px solid var(--benin-red);
    }

    .failure-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--benin-red), #ff5252);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        margin: 0 auto 2rem;
    }

    .error-details {
        background: #fff5f5;
        border-radius: 15px;
        padding: 1.5rem;
        margin: 2rem 0;
        text-align: left;
    }

    .solution-card {
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        border-radius: 20px;
        padding: 1.5rem;
        border-left: 5px solid var(--benin-yellow);
        margin-bottom: 1rem;
    }

    .retry-btn {
        background: linear-gradient(135deg, var(--benin-red), var(--benin-yellow));
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .retry-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(232, 17, 45, 0.3);
    }

    .contact-support {
        background: linear-gradient(135deg, var(--benin-dark), #2d3a6e);
        color: white;
        border-radius: 20px;
        padding: 2rem;
        margin-top: 2rem;
    }
</style>
@endpush

@section('content')
<div class="failure-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="failure-card">
                    <div class="failure-icon">
                        <i class="bi bi-x-circle"></i>
                    </div>

                    <h1 class="display-5 fw-bold mb-3 text-danger">Paiement Échoué</h1>
                    <p class="lead text-muted mb-4">
                        Une erreur est survenue lors du traitement de votre paiement
                    </p>

                    <!-- Détails de l'erreur -->
                    <div class="error-details">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Référence</small>
                                <div class="fw-bold">{{ $reference ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Date</small>
                                <div class="fw-bold">{{ now()->format('d/m/Y H:i') }}</div>
                            </div>
                            <div class="col-12">
                                <small class="text-muted">Statut</small>
                                <div class="fw-bold text-danger">
                                    <i class="bi bi-x-circle-fill me-2"></i>
                                    Échec du paiement
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Solutions possibles -->
                    <div class="mb-5">
                        <h4 class="fw-bold mb-4">
                            <i class="bi bi-lightbulb text-warning me-2"></i>
                            Solutions recommandées
                        </h4>

                        <div class="solution-card">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-credit-card text-primary fs-4 me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">Vérifiez votre carte</h6>
                                    <p class="small text-muted mb-0">
                                        Assurez-vous que votre carte est valide et que les fonds sont suffisants
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="solution-card">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-arrow-clockwise text-warning fs-4 me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">Réessayez le paiement</h6>
                                    <p class="small text-muted mb-0">
                                        Cliquez sur le bouton ci-dessous pour réessayer
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="solution-card">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-phone text-success fs-4 me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">Utilisez Mobile Money</h6>
                                    <p class="small text-muted mb-0">
                                        Essayez avec Orange Money ou MTN Mobile Money
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-grid gap-3 d-md-flex justify-content-center mb-4">
                        <a href="{{ route('boutique.paiement') }}" class="btn btn-danger btn-lg px-5">
                            <i class="bi bi-arrow-clockwise me-2"></i>
                            Réessayer le paiement
                        </a>

                        <a href="{{ route('boutique.choisir') }}" class="btn btn-outline-dark btn-lg px-5">
                            <i class="bi bi-arrow-left me-2"></i>
                            Changer d'offre
                        </a>
                    </div>

                    <!-- Support -->
                    <div class="contact-support">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-headset fs-1 me-3"></i>
                            <div>
                                <h4 class="fw-bold mb-0">Besoin d'aide ?</h4>
                                <p class="mb-0 opacity-90">Notre équipe support est là pour vous</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-envelope me-3"></i>
                                    <div>
                                        <small class="opacity-75">Email</small>
                                        <div class="fw-bold">support@beninculture.com</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-whatsapp me-3"></i>
                                    <div>
                                        <small class="opacity-75">WhatsApp</small>
                                        <div class="fw-bold">+229 XX XX XX XX</div>
                                    </div>
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
    // Animation de l'icône d'erreur
    const failureIcon = document.querySelector('.failure-icon');
    failureIcon.style.animation = 'shake 0.5s ease';

    // Redirection automatique après 30 secondes
    setTimeout(() => {
        window.location.href = "{{ route('boutique.paiement') }}";
    }, 30000);
});
</script>
@endpush
