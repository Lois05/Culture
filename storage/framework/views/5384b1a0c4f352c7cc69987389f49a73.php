<?php $__env->startSection('page-title', 'Modifier mon Profil'); ?>

<?php $__env->startSection('content'); ?>
<main class="app-main min-vh-100">
    <div class="container-fluid mt-4">
        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-6 fw-bold text-primary">
                    <i class="bi bi-person-gear me-2"></i> Modifier mon Profil
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.tableaudebord')); ?>">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.profile.show')); ?>">Mon Profil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="<?php echo e(route('admin.profile.show')); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Retour
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-pencil-square me-2"></i> Modifier les informations
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <!-- Informations de base -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-person-vcard me-2"></i> Informations personnelles
                                </h6>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label fw-semibold">Nom *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person"></i>
                                            </span>
                                            <input type="text"
                                                   class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   id="name"
                                                   name="name"
                                                   value="<?php echo e(old('name', $user->name)); ?>"
                                                   required>
                                            <?php $__errorArgs = ['name'];
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

                                    <div class="col-md-6 mb-3">
                                        <label for="prenom" class="form-label fw-semibold">Prénom</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person"></i>
                                            </span>
                                            <input type="text"
                                                   class="form-control <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   id="prenom"
                                                   name="prenom"
                                                   value="<?php echo e(old('prenom', $user->prenom)); ?>">
                                            <?php $__errorArgs = ['prenom'];
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
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label fw-semibold">Email *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope"></i>
                                            </span>
                                            <input type="email"
                                                   class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   id="email"
                                                   name="email"
                                                   value="<?php echo e(old('email', $user->email)); ?>"
                                                   required>
                                            <?php $__errorArgs = ['email'];
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

                                    <div class="col-md-6 mb-3">
                                        <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-telephone"></i>
                                            </span>
                                            <input type="tel"
                                                   class="form-control <?php $__errorArgs = ['telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   id="telephone"
                                                   name="telephone"
                                                   value="<?php echo e(old('telephone', $user->telephone)); ?>">
                                            <?php $__errorArgs = ['telephone'];
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
                                </div>

                                <div class="mb-3">
                                    <label for="adresse" class="form-label fw-semibold">Adresse</label>
                                    <textarea class="form-control <?php $__errorArgs = ['adresse'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                              id="adresse"
                                              name="adresse"
                                              rows="3"><?php echo e(old('adresse', $user->adresse)); ?></textarea>
                                    <?php $__errorArgs = ['adresse'];
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

                            <!-- Langue -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-translate me-2"></i> Préférences
                                </h6>

                                <div class="mb-3">
                                    <label for="langue_id" class="form-label fw-semibold">Langue préférée</label>
                                    <select class="form-select <?php $__errorArgs = ['langue_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="langue_id"
                                            name="langue_id">
                                        <option value="">Sélectionnez une langue</option>
                                        <?php $__currentLoopData = $langues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($langue->id); ?>"
                                                    <?php echo e(old('langue_id', $user->langue_id) == $langue->id ? 'selected' : ''); ?>>
                                                <?php echo e($langue->nom_langue); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['langue_id'];
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

                            <!-- Photo de profil -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-camera me-2"></i> Photo de profil
                                </h6>

                                <div class="row align-items-center">
                                    <div class="col-md-4 mb-3">
                                        <div class="text-center">
                                            <?php
                                                $initial = strtoupper(substr($user->name ?? 'U', 0, 1));
                                                if ($user->photo) {
                                                    $photoPath = 'adminlte/img/' . $user->photo;
                                                    $photoUrl = asset($photoPath);
                                                    $photoExists = file_exists(public_path($photoPath));
                                                }
                                            ?>

                                            <?php if($user->photo && ($photoExists ?? false)): ?>
                                                <img src="<?php echo e($photoUrl); ?>"
                                                     class="rounded-circle border shadow mb-2"
                                                     width="100" height="100"
                                                     alt="Photo actuelle">
                                                <p class="text-muted small mb-0">Photo actuelle</p>
                                            <?php else: ?>
                                                <div class="rounded-circle border shadow d-flex align-items-center justify-content-center mb-2"
                                                     style="width: 100px; height: 100px; background: linear-gradient(45deg, #4e73df, #224abe);">
                                                    <span class="text-white fw-bold fs-3"><?php echo e($initial); ?></span>
                                                </div>
                                                <p class="text-muted small mb-0">Aucune photo</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-8 mb-3">
                                        <div class="mb-3">
                                            <label for="photo" class="form-label fw-semibold">Changer la photo</label>
                                            <input type="file"
                                                   class="form-control <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   id="photo"
                                                   name="photo"
                                                   accept="image/*">
                                            <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <div class="form-text">
                                                Formats acceptés : JPG, PNG, GIF. Taille max : 2MB
                                            </div>
                                        </div>

                                        <?php if($user->photo && ($photoExists ?? false)): ?>
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="remove_photo"
                                                   name="remove_photo"
                                                   value="1">
                                            <label class="form-check-label text-danger" for="remove_photo">
                                                <i class="bi bi-trash me-1"></i> Supprimer la photo actuelle
                                            </label>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="d-flex justify-content-between pt-3 border-top">
                                <a href="<?php echo e(route('admin.profile.show')); ?>" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i> Annuler
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i> Enregistrer les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Aide -->
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-info-circle me-2"></i> Informations
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="bi bi-lightbulb me-2"></i>
                            <strong>Astuce :</strong> Utilisez une photo de profil claire pour faciliter votre identification.
                        </div>
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Note :</strong> Si vous changez votre email, vous devrez le re-vérifier.
                        </div>
                    </div>
                </div>

                <!-- Liens rapides -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-link me-2"></i> Liens rapides
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="<?php echo e(route('admin.profile.change-password')); ?>" class="btn btn-outline-warning">
                                <i class="bi bi-key me-2"></i> Changer le mot de passe
                            </a>
                            <a href="<?php echo e(route('2fa.enable')); ?>" class="btn btn-outline-info">
                                <i class="bi bi-shield-check me-2"></i> Authentification à deux facteurs
                            </a>
                            <a href="<?php echo e(route('admin.profile.show')); ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-eye me-2"></i> Voir mon profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\profile\edit.blade.php ENDPATH**/ ?>