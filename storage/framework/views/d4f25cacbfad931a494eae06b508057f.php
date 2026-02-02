<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Activer l'authentification à deux facteurs</h4>
                </div>

                <div class="card-body">
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(isset($qrCodeUrl)): ?>
                        <div class="alert alert-info">
                            <strong>Étape 1:</strong> Téléchargez Google Authenticator, Authy ou Microsoft Authenticator
                        </div>

                        <div class="text-center mb-4">
                            <div id="qrcode" class="d-inline-block p-3 bg-white border rounded"></div>
                        </div>

                        <div class="alert alert-secondary">
                            <strong>Secret manuel:</strong>
                            <code class="d-block mt-1 p-2 bg-light rounded"><?php echo e($secret); ?></code>
                            <small class="text-muted">(À utiliser si vous ne pouvez pas scanner le QR code)</small>
                        </div>

                        <hr>

                        <form method="POST" action="<?php echo e(route('2fa.activate')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="mb-3">
                                <label for="code" class="form-label">
                                    <strong>Étape 2:</strong> Entrez le code à 6 chiffres depuis l'application
                                </label>
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
                                       placeholder="000000">
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

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Activer l'authentification à deux facteurs
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="text-center">
                            <p class="mb-4">Sécurisez votre compte avec l'authentification à deux facteurs</p>
                            <a href="<?php echo e(route('2fa.generate')); ?>" class="btn btn-primary btn-lg">
                                Commencer la configuration
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(isset($qrCodeUrl)): ?>
<!-- Librairie QR Code JS -->
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Générer le QR code
    const qrCodeUrl = '<?php echo e($qrCodeUrl); ?>';
    QRCode.toCanvas(document.createElement('canvas'), qrCodeUrl, function(error, canvas) {
        if (error) {
            console.error(error);
            return;
        }

        // Ajouter le canvas au div qrcode
        const container = document.getElementById('qrcode');
        container.appendChild(canvas);

        // Style
        canvas.style.width = '200px';
        canvas.style.height = '200px';
    });

    // Auto-focus sur le champ code
    document.getElementById('code').focus();

    // Auto-soumettre quand 6 chiffres sont entrés
    document.getElementById('code').addEventListener('input', function(e) {
        if (e.target.value.length === 6) {
            e.target.form.submit();
        }
    });
});
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views/auth/enable-2fa.blade.php ENDPATH**/ ?>