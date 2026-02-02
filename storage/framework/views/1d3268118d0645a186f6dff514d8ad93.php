<?php $__env->startSection('page-title', 'Modifier la Langue'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-translate me-2"></i> Modifier la langue
                    </h4>
                    <a href="<?php echo e(route('admin.langues.index')); ?>" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo e(route('admin.langues.update', $langue)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-4">
                            <label for="nom_langue" class="form-label fw-bold">Nom de la langue</label>
                            <input type="text"
                                   class="form-control form-control-lg <?php $__errorArgs = ['nom_langue'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="nom_langue"
                                   name="nom_langue"
                                   value="<?php echo e(old('nom_langue', $langue->nom_langue)); ?>"
                                   required
                                   autofocus>
                            <?php $__errorArgs = ['nom_langue'];
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

                        <div class="mb-4">
                            <label for="code_langue" class="form-label fw-bold">Code de la langue</label>
                            <input type="text"
                                   class="form-control <?php $__errorArgs = ['code_langue'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="code_langue"
                                   name="code_langue"
                                   value="<?php echo e(old('code_langue', $langue->code_langue)); ?>"
                                   placeholder="ex: fr, en, es">
                            <?php $__errorArgs = ['code_langue'];
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

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                      id="description"
                                      name="description"
                                      rows="4"
                                      placeholder="Description de la langue..."><?php echo e(old('description', $langue->description)); ?></textarea>
                            <?php $__errorArgs = ['description'];
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

                        <div class="d-flex gap-3 justify-content-end pt-3">
                            <a href="<?php echo e(route('admin.langues.index')); ?>" class="btn btn-secondary btn-lg px-4">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4 shadow">
                                <i class="bi bi-check-circle me-2"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\langues\edit.blade.php ENDPATH**/ ?>