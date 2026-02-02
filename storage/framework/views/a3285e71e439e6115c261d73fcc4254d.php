<?php $__env->startSection('page-title', 'Changer le mot de passe'); ?>

<?php $__env->startSection('content'); ?>
<main class="app-main min-vh-100">
    <div class="container-fluid mt-4">
        <!-- En-tête -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="display-6 fw-bold text-primary">
                            <i class="bi bi-key me-2"></i> Changer le mot de passe
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.tableaudebord')); ?>">Tableau de bord</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.profile.show')); ?>">Mon Profil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Changer mot de passe</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="<?php echo e(route('admin.profile.show')); ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-shield-lock me-2"></i> Sécurité du compte
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.profile.change-password.post')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <!-- Mot de passe actuel -->
                            <div class="mb-4">
                                <label for="current_password" class="form-label fw-semibold">
                                    Mot de passe actuel *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password"
                                           class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="current_password"
                                           name="current_password"
                                           required>
                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            onclick="togglePassword('current_password')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Nouveau mot de passe -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">
                                    Nouveau mot de passe *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password"
                                           class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="password"
                                           name="password"
                                           required>
                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            onclick="togglePassword('password')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-text">
                                    Le mot de passe doit contenir au moins 8 caractères.
                                </div>
                            </div>

                            <!-- Confirmation -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    Confirmer le nouveau mot de passe *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password"
                                           class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           required>
                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            onclick="togglePassword('password_confirmation')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Indicateur de force -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Force du mot de passe</label>
                                <div class="password-strength">
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" id="passwordStrengthBar" role="progressbar" style="width: 0%"></div>
                                    </div>
                                    <small id="passwordStrengthText" class="mt-1 d-block"></small>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="d-flex justify-content-between pt-3 border-top">
                                <a href="<?php echo e(route('admin.profile.show')); ?>" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i> Annuler
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i> Changer le mot de passe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Conseils de sécurité -->
                <div class="card shadow-sm border-0 rounded-3 mt-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-lightbulb me-2"></i> Conseils de sécurité
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="mb-0">
                            <li>Utilisez au moins 8 caractères</li>
                            <li>Combine lettres majuscules et minuscules</li>
                            <li>Ajoutez des chiffres et des caractères spéciaux</li>
                            <li>Évitez les mots de passe courants</li>
                            <li>Ne réutilisez pas d'anciens mots de passe</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function togglePassword(fieldId) {
    const input = document.getElementById(fieldId);
    const icon = input.nextElementSibling.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

// Vérification de la force du mot de passe
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthText = document.getElementById('passwordStrengthText');

    if (password.length === 0) {
        strengthBar.style.width = '0%';
        strengthBar.className = 'progress-bar';
        strengthText.textContent = '';
        return;
    }

    // Calculer la force
    let score = 0;
    if (password.length >= 8) score += 1;
    if (/[A-Z]/.test(password)) score += 1;
    if (/[0-9]/.test(password)) score += 1;
    if (/[^A-Za-z0-9]/.test(password)) score += 1;
    if (password.length >= 12) score += 1;

    const percent = (score / 5) * 100;
    strengthBar.style.width = percent + '%';

    // Définir la couleur et le texte
    let color = 'bg-danger';
    let text = 'Très faible';

    if (score >= 4) {
        color = 'bg-success';
        text = 'Très fort';
    } else if (score === 3) {
        color = 'bg-info';
        text = 'Fort';
    } else if (score === 2) {
        color = 'bg-warning';
        text = 'Moyen';
    } else if (score === 1) {
        color = 'bg-danger';
        text = 'Faible';
    }

    strengthBar.className = 'progress-bar ' + color;
    strengthText.textContent = text;
    strengthText.className = strengthText.className.replace(/text-\w+/, '') + ' ' + color.replace('bg-', 'text-');
});
</script>

<style>
.password-strength .progress {
    background-color: #e9ecef;
    border-radius: 4px;
}

.password-strength .progress-bar {
    border-radius: 4px;
    transition: width 0.5s ease;
}

.text-danger { color: #e74a3b; }
.text-warning { color: #f6c23e; }
.text-info { color: #36b9cc; }
.text-success { color: #1cc88a; }

.card {
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views/profile/change-password.blade.php ENDPATH**/ ?>