<?php $__env->startSection('title', 'Choisir votre abonnement - Bénin Culture'); ?>

<?php $__env->startPush('styles'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    :root {
        --benin-red: #E8112D;
        --benin-yellow: #FCD116;
        --benin-green: #008751;
        --benin-dark: #0A0F2D;
        --gradient-premium: linear-gradient(135deg, #E8112D 0%, #FCD116 50%, #008751 100%);
        --glow-shadow: 0 0 30px rgba(232, 17, 45, 0.3);
    }

    .hero-choix {
        min-height: 60vh;
        background: linear-gradient(135deg, var(--benin-dark) 0%, #1a1f3c 100%);
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .hero-choix::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path fill="%23ffffff05" d="M0,0h1000v1000H0V0z M250,250h500v500H250V250z"/></svg>');
        opacity: 0.1;
    }

    .plan-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        border: 2px solid transparent;
        height: 100%;
    }

    .plan-card:hover {
        transform: translateY(-15px);
        box-shadow: var(--glow-shadow);
        border-color: var(--benin-red);
    }

    .plan-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--gradient-premium);
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 0.9rem;
        z-index: 2;
    }

    .plan-header {
        background: linear-gradient(135deg, var(--benin-dark) 0%, #2d3a6e 100%);
        padding: 3rem 2rem;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .plan-header::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: rotate(45deg);
        animation: shine 3s infinite;
    }

    @keyframes shine {
        0% { transform: rotate(45deg) translateX(-100%); }
        100% { transform: rotate(45deg) translateX(100%); }
    }

    .plan-price {
        font-size: 4rem;
        font-weight: 900;
        background: var(--gradient-premium);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        line-height: 1;
        margin: 1rem 0;
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--benin-red), var(--benin-purple));
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .comparison-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .period-selector {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin: 2rem 0;
    }

    .period-btn {
        padding: 1rem 2rem;
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .period-btn.active {
        background: var(--gradient-premium);
        color: white;
        border-color: transparent;
        box-shadow: var(--glow-shadow);
    }

    .benefit-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 15px;
        padding: 1.5rem;
        border-left: 5px solid var(--benin-green);
        transition: all 0.3s ease;
    }

    .benefit-card:hover {
        transform: translateX(10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .action-panel {
        position: sticky;
        bottom: 0;
        background: white;
        padding: 2rem;
        box-shadow: 0 -10px 40px rgba(0,0,0,0.1);
        border-radius: 25px 25px 0 0;
    }

    .countdown-timer {
        background: linear-gradient(135deg, var(--benin-red), var(--benin-yellow));
        color: white;
        padding: 1rem;
        border-radius: 15px;
        text-align: center;
        margin: 1rem 0;
    }

    .timer-digit {
        font-size: 2rem;
        font-weight: bold;
        margin: 0 5px;
        background: rgba(255,255,255,0.2);
        padding: 0.5rem;
        border-radius: 10px;
        display: inline-block;
        min-width: 60px;
    }

    .guarantee-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #008751, #00c853);
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .plan-price {
            font-size: 3rem;
        }

        .period-selector {
            flex-direction: column;
        }

        .timer-digit {
            font-size: 1.5rem;
            min-width: 50px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="hero-choix py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold text-white mb-4" data-aos="fade-up">
                    Choisissez <span class="text-warning">Votre Offre</span>
                </h1>
                <p class="lead text-white-80 mb-5" data-aos="fade-up" data-aos-delay="200">
                    Sélectionnez la formule qui correspond à vos ambitions culturelles
                </p>

                <!-- Période de facturation -->
                <div class="period-selector" data-aos="fade-up" data-aos-delay="400">
                    <div class="period-btn <?php echo e($achat['period'] == 'monthly' ? 'active' : ''); ?>" data-period="monthly">
                        <i class="bi bi-calendar-month me-2"></i>
                        Mensuel
                        <div class="small">Facturé chaque mois</div>
                    </div>
                    <div class="period-btn <?php echo e($achat['period'] == 'yearly' ? 'active' : ''); ?>" data-period="yearly">
                        <i class="bi bi-calendar-check me-2"></i>
                        Annuel
                        <div class="small">Économisez 2 mois</div>
                    </div>
                    <div class="period-btn <?php echo e($achat['period'] == 'lifetime' ? 'active' : ''); ?>" data-period="lifetime">
                        <i class="bi bi-infinity me-2"></i>
                        À vie
                        <div class="small">Paiement unique</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Détails de l'offre -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="plan-card" data-aos="zoom-in">
                    <?php if($achat['recommandé'] ?? false): ?>
                    <div class="plan-badge">
                        <i class="bi bi-fire me-2"></i>LE PLUS POPULAIRE
                    </div>
                    <?php endif; ?>

                    <div class="plan-header">
                        <div class="mb-4">
                            <i class="bi <?php echo e($achat['icon'] ?? 'bi-star'); ?> display-1"></i>
                        </div>
                        <h2 class="fw-bold mb-2"><?php echo e($achat['nom']); ?></h2>
                        <p class="opacity-90"><?php echo e($achat['description']); ?></p>
                    </div>

                    <div class="p-5">
                        <!-- Prix dynamique selon période -->
                        <div class="text-center mb-5">
                            <div class="plan-price" id="dynamic-price">
                                <?php echo e(number_format($achat['prix'], 0, ',', ' ')); ?> FCFA
                            </div>
                            <div class="text-muted" id="period-label">
                                <?php echo e($achat['period'] == 'monthly' ? 'Par mois' : ''); ?>

                                <?php echo e($achat['period'] == 'yearly' ? 'Par an' : ''); ?>

                                <?php echo e($achat['period'] == 'lifetime' ? 'Paiement unique' : ''); ?>

                            </div>
                            <div class="small text-muted mt-2" id="savings-info"></div>
                        </div>

                        <!-- Contextuel pour débloquer un article -->
                        <?php if(isset($contenu)): ?>
                        <div class="alert alert-warning" data-aos="fade-up">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-unlock-fill fs-3 me-3"></i>
                                <div>
                                    <h5 class="mb-1">Débloquez cet article</h5>
                                    <p class="mb-0">"<?php echo e($contenu->titre); ?>" sera immédiatement accessible avec cet abonnement</p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Liste des fonctionnalités -->
                        <div class="mb-5">
                            <h4 class="fw-bold mb-4">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Ce que vous obtenez :
                            </h4>
                            <?php $__currentLoopData = $achat['features']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-center mb-3" data-aos="fade-right" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                                <div class="feature-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <span class="fs-5"><?php echo e($feature); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Garantie -->
                        <div class="text-center mb-5" data-aos="fade-up">
                            <div class="guarantee-badge d-inline-flex">
                                <i class="bi bi-shield-check"></i>
                                Garantie satisfait ou remboursé 30 jours
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Avantages supplémentaires -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-5 fw-bold mb-4" data-aos="fade-up">
                    Pourquoi <span class="text-primary">Nous Choisir</span> ?
                </h2>
            </div>
        </div>

        <div class="comparison-grid">
            <div class="benefit-card" data-aos="fade-up">
                <div class="d-flex align-items-start mb-3">
                    <i class="bi bi-lightning-charge-fill text-warning fs-1 me-3"></i>
                    <div>
                        <h5 class="fw-bold">Accès Immédiat</h5>
                        <p class="text-muted mb-0">Débloquez instantanément tous les contenus premium</p>
                    </div>
                </div>
            </div>

            <div class="benefit-card" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-items-start mb-3">
                    <i class="bi bi-arrow-clockwise text-primary fs-1 me-3"></i>
                    <div>
                        <h5 class="fw-bold">Annulation Simple</h5>
                        <p class="text-muted mb-0">Annulez à tout moment, sans frais cachés</p>
                    </div>
                </div>
            </div>

            <div class="benefit-card" data-aos="fade-up" data-aos-delay="200">
                <div class="d-flex align-items-start mb-3">
                    <i class="bi bi-headset text-success fs-1 me-3"></i>
                    <div>
                        <h5 class="fw-bold">Support Premium</h5>
                        <p class="text-muted mb-0">Assistance dédiée 24h/24, 7j/7</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Panel d'action fixe -->
<div class="action-panel">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="countdown-timer" data-aos="fade-right">
                    <div class="small mb-2">OFFRE SPÉCIALE - FINIT DANS :</div>
                    <div id="countdown">
                        <span class="timer-digit" id="hours">12</span>:
                        <span class="timer-digit" id="minutes">34</span>:
                        <span class="timer-digit" id="seconds">56</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 text-md-end" data-aos="fade-left">
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-end">
                    <a href="<?php echo e(route('boutique.annuler')); ?>" class="btn btn-outline-dark btn-lg px-4">
                        <i class="bi bi-arrow-left me-2"></i>
                        Retour
                    </a>

                    <form action="<?php echo e(route('boutique.paiement')); ?>" method="GET" class="d-inline">
                        <input type="hidden" name="period" value="<?php echo e($achat['period']); ?>">
                        <button type="submit" class="btn btn-warning btn-lg px-5 fw-bold">
                            <i class="bi bi-lock-fill me-2"></i>
                            Procéder au paiement
                        </button>
                    </form>
                </div>
                <div class="mt-2 text-muted small">
                    <i class="bi bi-shield-lock me-1"></i>
                    Paiement sécurisé - Vos données sont protégées
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser AOS
    AOS.init({
        duration: 800,
        once: true
    });

    // Prix dynamique selon la période
    const basePrice = <?php echo e($achat['prix']); ?>;
    const prices = {
        monthly: basePrice,
        yearly: basePrice * 10, // 10 mois pour 1 an
        lifetime: basePrice * 50 // 50 mois pour la vie
    };

    const periodLabels = {
        monthly: 'Par mois',
        yearly: 'Par an',
        lifetime: 'Paiement unique'
    };

    const savingsInfo = {
        monthly: '',
        yearly: `Économisez ${(basePrice * 2).toLocaleString()} FCFA (2 mois gratuits)`,
        lifetime: `Économisez ${(basePrice * 100).toLocaleString()} FCFA (accès à vie)`
    };

    // Gestion du sélecteur de période
    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Retirer la classe active de tous les boutons
            document.querySelectorAll('.period-btn').forEach(b => {
                b.classList.remove('active');
            });

            // Ajouter la classe active au bouton cliqué
            this.classList.add('active');

            // Récupérer la période sélectionnée
            const period = this.dataset.period;

            // Mettre à jour le prix
            const priceElement = document.getElementById('dynamic-price');
            const periodElement = document.getElementById('period-label');
            const savingsElement = document.getElementById('savings-info');

            priceElement.textContent = prices[period].toLocaleString() + ' FCFA';
            periodElement.textContent = periodLabels[period];
            savingsElement.textContent = savingsInfo[period];

            // Mettre à jour le formulaire de paiement
            document.querySelector('input[name="period"]').value = period;
        });
    });

    // Compte à rebours
    function updateCountdown() {
        const now = new Date();
        const end = new Date();
        end.setHours(23, 59, 59, 999); // Fin du jour

        const diff = end - now;

        const hours = Math.floor(diff / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }

    // Mettre à jour le compte à rebours toutes les secondes
    updateCountdown();
    setInterval(updateCountdown, 1000);

    // Animation au scroll
    window.addEventListener('scroll', function() {
        const actionPanel = document.querySelector('.action-panel');
        const scrollTop = window.pageYOffset;

        if (scrollTop > 100) {
            actionPanel.style.transform = 'translateY(0)';
            actionPanel.style.opacity = '1';
        }
    });

    // Confirmation avant paiement
    const paymentForm = document.querySelector('form[action*="paiement"]');
    if (paymentForm) {
        paymentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Animation de confirmation
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;

            button.innerHTML = '<i class="bi bi-lock-fill me-2"></i> Redirection vers le paiement...';
            button.disabled = true;

            // Petit délai pour l'animation
            setTimeout(() => {
                this.submit();
            }, 1000);
        });
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views/front/boutique/choisir.blade.php ENDPATH**/ ?>