<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Vérification en deux étapes</h4>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-shield-lock display-4 text-primary"></i>
                        <p class="mt-3">Veuillez entrer le code depuis votre application d'authentification</p>
                    </div>

                    <form method="POST" action="<?php echo e(route('2fa.verify.post')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="code" class="form-label">Code à 6 chiffres</label>
                            <input type="text"
                                   class="form-control form-control-lg text-center <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="code"
                                   name="code"
                                   required
                                   autocomplete="off"
                                   maxlength="6"
                                   pattern="[0-9]{6}"
                                   placeholder="000000"
                                   autofocus>
                            <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Vérifier et continuer
                            </button>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#backupOptions">
                                Problème avec votre code ?
                            </button>

                            <div id="backupOptions" class="collapse mt-3">
                                <div class="card card-body">
                                    <h6>Utiliser un code de secours</h6>
                                    <p class="text-muted small mb-3">
                                        Les codes de secours sont à usage unique.
                                        Après utilisation, ils seront désactivés.
                                    </p>
                                    <a href="<?php echo e(route('2fa.backup-codes')); ?>" class="btn btn-outline-secondary btn-sm">
                                        Voir mes codes de secours
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const codeInput = document.getElementById('code');

    // Auto-soumettre quand 6 chiffres sont entrés
    codeInput.addEventListener('input', function(e) {
        if (e.target.value.length === 6) {
            e.target.form.submit();
        }
    });

    // Permettre uniquement les chiffres
    codeInput.addEventListener('keypress', function(e) {
        if (!/[0-9]/.test(e.key)) {
            e.preventDefault();
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\auth\verify-2fa.blade.php ENDPATH**/ ?>