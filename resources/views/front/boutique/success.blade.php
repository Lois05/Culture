@extends('layouts.layout_front')

@section('title', 'Paiement confirmé - Bénin Culture')

@push('styles')
<style>
    :root {
        --benin-red: #E8112D;
        --benin-yellow: #FCD116;
        --benin-green: #008751;
        --benin-dark: #0A0F2D;
    }

    .success-hero {
        min-height: 70vh;
        background: linear-gradient(135deg, var(--benin-dark) 0%, #1a1f3c 100%);
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .success-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path fill="%23ffffff05" d="M0,0h1000v1000H0V0z M500,500c138.1,0,250-111.9,250-250S638.1,0,500,0S250,111.9,250,250S361.9,500,500,500z"/></svg>');
        opacity: 0.1;
    }

    .success-card {
        background: white;
        border-radius: 30px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.1);
        padding: 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--benin-green), #00c853);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        margin: 0 auto 2rem;
        animation: bounceIn 1s ease;
    }

    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background: linear-gradient(45deg, var(--benin-red), var(--benin-yellow), var(--benin-green));
        border-radius: 50%;
        opacity: 0.7;
        animation: confettiFall 5s linear infinite;
    }

    @keyframes confettiFall {
        0% {
            transform: translateY(-100px) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(500px) rotate(360deg);
            opacity: 0;
        }
    }

    @keyframes bounceIn {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .detail-card {
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        border-radius: 20px;
        padding: 2rem;
        border-left: 5px solid var(--benin-yellow);
        transition: all 0.3s ease;
    }

    .detail-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .feature-unlocked {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: rgba(0, 135, 81, 0.1);
        border-radius: 15px;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .feature-unlocked:hover {
        transform: translateX(10px);
        background: rgba(0, 135, 81, 0.2);
    }

    .countdown-redirect {
        background: linear-gradient(135deg, var(--benin-red), var(--benin-yellow));
        color: white;
        padding: 1rem;
        border-radius: 15px;
        text-align: center;
        margin-top: 2rem;
    }

    .redirect-timer {
        font-size: 2rem;
        font-weight: bold;
        margin: 0 5px;
        background: rgba(255,255,255,0.2);
        padding: 0.5rem 1rem;
        border-radius: 10px;
        display: inline-block;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="success-hero py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="success-card" data-aos="zoom-in">
                    <!-- Confetti animation -->
                    <div id="confetti-container"></div>

                    <div class="success-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>

                    <h1 class="display-5 fw-bold mb-3">Paiement Confirmé !</h1>
                    <p class="lead text-muted mb-4">
                        Félicitations ! Votre abonnement premium est maintenant actif
                    </p>

                    <div class="detail-card mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="text-start">
                                    <small class="text-muted">Référence</small>
                                    <div class="fw-bold">{{ $paiement['reference'] ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="text-start">
                                    <small class="text-muted">Date</small>
                                    <div class="fw-bold">{{ $paiement['date'] ?? now()->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="text-start">
                                    <small class="text-muted">Montant</small>
                                    <div class="fw-bold">{{ $paiement['montant'] ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="text-start">
                                    <small class="text-muted">Statut</small>
                                    <div class="fw-bold text-success">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        {{ $paiement['statut'] ?? 'Payé' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Si c'est un article spécifique -->
                    @if(isset($contenu))
                    <div class="alert alert-success" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-unlock-fill fs-3 me-3"></i>
                            <div>
                                <h5 class="mb-1">Article débloqué !</h5>
                                <p class="mb-0">"{{ $contenu->titre }}" est maintenant accessible</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mb-5">
                        <h4 class="fw-bold mb-4">
                            <i class="bi bi-stars text-warning me-2"></i>
                            Ce qui vous attend
                        </h4>

                        <div class="feature-unlocked">
                            <div class="feature-icon bg-primary text-white rounded-circle p-2">
                                <i class="bi bi-play-circle"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Contenus premium débloqués</h6>
                                <p class="small text-muted mb-0">Accès immédiat à toute notre bibliothèque</p>
                            </div>
                        </div>

                        <div class="feature-unlocked">
                            <div class="feature-icon bg-warning text-white rounded-circle p-2">
                                <i class="bi bi-download"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Téléchargements HD</h6>
                                <p class="small text-muted mb-0">Téléchargez les documents en haute qualité</p>
                            </div>
                        </div>

                        <div class="feature-unlocked">
                            <div class="feature-icon bg-success text-white rounded-circle p-2">
                                <i class="bi bi-headset"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Support prioritaire</h6>
                                <p class="small text-muted mb-0">Notre équipe vous assiste en priorité</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-grid gap-3 d-md-flex justify-content-center">
                        <a href="{{ route('dashboard.index') }}" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-speedometer2 me-2"></i>
                            Aller au tableau de bord
                        </a>

                        <a href="{{ route('front.explorer') }}" class="btn btn-outline-dark btn-lg px-5">
                            <i class="bi bi-compass me-2"></i>
                            Explorer les contenus
                        </a>
                    </div>

                    <!-- Compte à rebours de redirection -->
                    <div class="countdown-redirect mt-4">
                        <p class="mb-2">
                            <i class="bi bi-clock me-2"></i>
                            Redirection automatique dans
                        </p>
                        <div class="redirect-timer" id="redirect-countdown">10</div>
                        <p class="small mt-2">vers votre tableau de bord</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Prochaines étapes -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-6 fw-bold mb-5">
                    Comment <span class="text-primary">bien commencer</span> ?
                </h2>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border-0 h-100">
                            <div class="card-body text-center">
                                <div class="feature-icon bg-primary text-white rounded-circle p-3 mb-3 mx-auto">
                                    <i class="bi bi-compass fs-3"></i>
                                </div>
                                <h5 class="fw-bold">Explorez</h5>
                                <p class="text-muted">Découvrez notre bibliothèque de contenus premium</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 h-100">
                            <div class="card-body text-center">
                                <div class="feature-icon bg-warning text-white rounded-circle p-3 mb-3 mx-auto">
                                    <i class="bi bi-download fs-3"></i>
                                </div>
                                <h5 class="fw-bold">Téléchargez</h5>
                                <p class="text-muted">Sauvegardez vos contenus préférés en haute qualité</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 h-100">
                            <div class="card-body text-center">
                                <div class="feature-icon bg-success text-white rounded-circle p-3 mb-3 mx-auto">
                                    <i class="bi bi-people fs-3"></i>
                                </div>
                                <h5 class="fw-bold">Participez</h5>
                                <p class="text-muted">Rejoignez notre communauté d'experts</p>
                            </div>
                        </div>
                    </div>
                </div>
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
        once: true
    });

    // Générer des confettis
    function createConfetti() {
        const container = document.getElementById('confetti-container');
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.width = Math.random() * 10 + 5 + 'px';
            confetti.style.height = confetti.style.width;
            confetti.style.animationDelay = Math.random() * 5 + 's';
            confetti.style.animationDuration = Math.random() * 3 + 3 + 's';
            container.appendChild(confetti);
        }
    }

    // Compte à rebours de redirection
    let countdown = 10;
    const countdownElement = document.getElementById('redirect-countdown');
    const countdownInterval = setInterval(() => {
        countdown--;
        countdownElement.textContent = countdown;

        if (countdown <= 0) {
            clearInterval(countdownInterval);
            window.location.href = "{{ route('dashboard.index') }}";
        }
    }, 1000);

    // Créer les confettis
    createConfetti();

    // Notification de succès
    if (!localStorage.getItem('payment_success_shown')) {
        // Créer une notification
        const notification = document.createElement('div');
        notification.className = 'alert alert-success alert-dismissible fade show position-fixed';
        notification.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        `;
        notification.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill fs-3 me-3"></i>
                <div>
                    <strong>Bienvenue premium !</strong>
                    <p class="mb-0">Votre abonnement est maintenant actif</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(notification);

        // Supprimer après 5 secondes
        setTimeout(() => {
            notification.remove();
        }, 5000);

        localStorage.setItem('payment_success_shown', 'true');
    }

    // Animation de l'icône de succès
    const successIcon = document.querySelector('.success-icon');
    successIcon.addEventListener('animationend', function() {
        this.style.animation = 'pulse 2s infinite';
    });
});
</script>
@endpush
