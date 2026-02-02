<?php $__env->startSection('title', 'Paiement sécurisé - Bénin Culture'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --benin-red: #E8112D;
        --benin-yellow: #FCD116;
        --benin-green: #008751;
        --benin-dark: #0A0F2D;
    }

    .payment-container {
        min-height: 80vh;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 4rem 0;
    }

    .payment-card {
        background: white;
        border-radius: 25px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .payment-header {
        background: linear-gradient(135deg, var(--benin-dark) 0%, #2d3a6e 100%);
        padding: 2.5rem;
        color: white;
        text-align: center;
    }

    .payment-logo {
        width: 80px;
        height: 80px;
        background: rgba(255,255,255,0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
    }

    .payment-method {
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .payment-method:hover {
        border-color: var(--benin-green);
        background: rgba(0, 135, 81, 0.05);
    }

    .payment-method.selected {
        border-color: var(--benin-green);
        background: rgba(0, 135, 81, 0.1);
        box-shadow: 0 5px 20px rgba(0, 135, 81, 0.1);
    }

    .payment-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--benin-red), var(--benin-yellow));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .form-control-payment {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 1rem;
        transition: all 0.3s ease;
    }

    .form-control-payment:focus {
        border-color: var(--benin-green);
        box-shadow: 0 0 0 3px rgba(0, 135, 81, 0.1);
    }

    .payment-summary {
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        border-radius: 15px;
        padding: 1.5rem;
        border-left: 5px solid var(--benin-yellow);
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .summary-item.total {
        border-bottom: none;
        font-weight: bold;
        font-size: 1.2rem;
        color: var(--benin-dark);
    }

    .security-badge {
        display: flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #008751, #00c853);
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
    }

    .loader {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid var(--benin-green);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @media (max-width: 768px) {
        .payment-container {
            padding: 2rem 0;
        }

        .payment-header {
            padding: 1.5rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="payment-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="payment-card">
                    <div class="payment-header">
                        <div class="payment-logo">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h1 class="fw-bold mb-3">Paiement Sécurisé</h1>
                        <p class="opacity-90 mb-0">
                            <i class="bi bi-check-circle me-2"></i>
                            Transaction cryptée SSL 256-bit
                        </p>
                    </div>

                    <div class="p-4 p-md-5">
                        <div class="row">
                            <!-- Formulaire de paiement -->
                            <div class="col-lg-7">
                                <form id="payment-form" action="<?php echo e(route('boutique.process.paiement')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>

                                    <!-- Résumé de la commande -->
                                    <div class="mb-5">
                                        <h4 class="fw-bold mb-4">
                                            <i class="bi bi-receipt text-primary me-2"></i>
                                            Votre commande
                                        </h4>
                                        <div class="payment-summary">
                                            <div class="summary-item">
                                                <span>Abonnement :</span>
                                                <strong><?php echo e($achat['nom']); ?></strong>
                                            </div>
                                            <div class="summary-item">
                                                <span>Durée :</span>
                                                <span>
                                                    <?php echo e($achat['period'] == 'monthly' ? '1 mois' : ''); ?>

                                                    <?php echo e($achat['period'] == 'yearly' ? '1 an' : ''); ?>

                                                    <?php echo e($achat['period'] == 'lifetime' ? 'À vie' : ''); ?>

                                                </span>
                                            </div>
                                            <div class="summary-item">
                                                <span>Prix :</span>
                                                <span class="fw-bold"><?php echo e(number_format($achat['prix'], 0, ',', ' ')); ?> FCFA</span>
                                            </div>
                                            <?php if($achat['period'] == 'yearly' || $achat['period'] == 'lifetime'): ?>
                                            <div class="summary-item text-success">
                                                <span>Économie :</span>
                                                <span class="fw-bold">
                                                    <?php echo e(number_format($achat['prix_mensuel'] * 12 - $achat['prix'], 0, ',', ' ')); ?> FCFA
                                                </span>
                                            </div>
                                            <?php endif; ?>
                                            <div class="summary-item total">
                                                <span>Total à payer :</span>
                                                <span class="text-primary"><?php echo e(number_format($achat['prix'], 0, ',', ' ')); ?> FCFA</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Méthode de paiement -->
                                    <div class="mb-5">
                                        <h4 class="fw-bold mb-4">
                                            <i class="bi bi-credit-card text-primary me-2"></i>
                                            Méthode de paiement
                                        </h4>

                                        <div class="payment-method selected" data-method="fedapay">
                                            <div class="payment-icon">
                                                <i class="bi bi-shield-check"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-1">Fedapay - Paiement sécurisé</h6>
                                                <p class="small text-muted mb-0">
                                                    Carte bancaire, Mobile Money, Orange Money, MTN Mobile Money
                                                </p>
                                            </div>
                                            <div>
                                                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informations personnelles -->
                                    <div class="mb-5">
                                        <h4 class="fw-bold mb-4">
                                            <i class="bi bi-person-check text-primary me-2"></i>
                                            Vos informations
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Nom</label>
                                                <input type="text"
                                                       class="form-control form-control-payment"
                                                       value="<?php echo e($user->nom); ?>"
                                                       readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Prénom</label>
                                                <input type="text"
                                                       class="form-control form-control-payment"
                                                       value="<?php echo e($user->prenom); ?>"
                                                       readonly>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Email</label>
                                                <input type="email"
                                                       class="form-control form-control-payment"
                                                       value="<?php echo e($user->email); ?>"
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Conditions -->
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="terms" required>
                                            <label class="form-check-label" for="terms">
                                                J'accepte les
                                                <a href="#" class="text-primary">conditions générales</a>
                                                et la
                                                <a href="#" class="text-primary">politique de confidentialité</a>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Bouton de paiement -->
                                    <div class="d-grid gap-3">
                                        <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold" id="submit-btn">
                                            <i class="bi bi-lock-fill me-2"></i>
                                            Payer maintenant
                                            <span id="amount-display"><?php echo e(number_format($achat['prix'], 0, ',', ' ')); ?> FCFA</span>
                                        </button>

                                        <a href="<?php echo e(route('boutique.annuler')); ?>" class="btn btn-outline-dark btn-lg py-3">
                                            <i class="bi bi-x-circle me-2"></i>
                                            Annuler la commande
                                        </a>
                                    </div>
                                </form>
                            </div>

                            <!-- Sécurité & Garanties -->
                            <div class="col-lg-5">
                                <div class="sticky-top" style="top: 20px;">
                                    <div class="mb-4">
                                        <div class="security-badge mb-3">
                                            <i class="bi bi-shield-check"></i>
                                            Paiement 100% sécurisé
                                        </div>
                                        <p class="text-muted">
                                            <i class="bi bi-check-circle text-success me-2"></i>
                                            Vos données bancaires sont cryptées
                                        </p>
                                        <p class="text-muted">
                                            <i class="bi bi-check-circle text-success me-2"></i>
                                            Aucune information n'est stockée sur nos serveurs
                                        </p>
                                        <p class="text-muted">
                                            <i class="bi bi-check-circle text-success me-2"></i>
                                            Transaction certifiée PCI DSS
                                        </p>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="fw-bold mb-3">
                                            <i class="bi bi-shield-exclamation text-warning me-2"></i>
                                            Garanties incluses
                                        </h5>
                                        <div class="card border-0 bg-light">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start mb-3">
                                                    <i class="bi bi-arrow-counterclockwise text-primary fs-4 me-3"></i>
                                                    <div>
                                                        <h6 class="fw-bold">Remboursement sous 30 jours</h6>
                                                        <p class="small text-muted mb-0">Insatisfait ? Remboursement intégral</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-start">
                                                    <i class="bi bi-headset text-success fs-4 me-3"></i>
                                                    <div>
                                                        <h6 class="fw-bold">Support prioritaire</h6>
                                                        <p class="small text-muted mb-0">Assistance dédiée pour les membres premium</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <img src="https://fedapay.com/images/logo.svg" alt="Fedapay" class="img-fluid mb-3" style="max-height: 40px;">
                                        <div class="small text-muted">
                                            Paiement sécurisé par Fedapay<br>
                                            <small>Certification de sécurité niveau 1 PCI DSS</small>
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
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('payment-form');
    const submitBtn = document.getElementById('submit-btn');

    // Animation lors du paiement
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Désactiver le bouton
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="loader me-2"></span>
            Traitement du paiement en cours...
        `;

        // Simuler un délai (à remplacer par le vrai appel Fedapay)
        setTimeout(() => {
            // Soumettre le formulaire
            this.submit();
        }, 2000);
    });

    // Validation en temps réel
    const termsCheckbox = document.getElementById('terms');
    termsCheckbox.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
    });

    // Animation des méthodes de paiement
    document.querySelectorAll('.payment-method').forEach(method => {
        method.addEventListener('click', function() {
            // Retirer la sélection de toutes les méthodes
            document.querySelectorAll('.payment-method').forEach(m => {
                m.classList.remove('selected');
                m.querySelector('.bi-check-circle-fill')?.classList.replace('bi-check-circle-fill', 'bi-circle');
            });

            // Ajouter la sélection à la méthode cliquée
            this.classList.add('selected');
            const checkIcon = this.querySelector('.bi-circle');
            if (checkIcon) {
                checkIcon.classList.replace('bi-circle', 'bi-check-circle-fill');
                checkIcon.classList.add('text-success');
            }
        });
    });

    // Affichage dynamique du montant
    function updateAmountDisplay() {
        const amount = <?php echo e($achat['prix']); ?>;
        document.getElementById('amount-display').textContent =
            amount.toLocaleString() + ' FCFA';
    }

    // Initialiser l'affichage du montant
    updateAmountDisplay();

    // Confirmation avant de quitter la page
    window.addEventListener('beforeunload', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.returnValue = 'Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?';
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views/front/boutique/paiement.blade.php ENDPATH**/ ?>