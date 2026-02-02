<?php $__env->startSection('page-title', 'Modifier Utilisateur'); ?>

<?php $__env->startSection('content'); ?>
<main class="app-main min-vh-100">
    <div class="container-fluid mt-4">
        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.tableaudebord')); ?>">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.users.index')); ?>">Utilisateurs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier <?php echo e($user->name); ?></li>
                    </ol>
                </nav>
                <h1 class="display-6 fw-bold text-primary">
                    <i class="bi bi-person-gear me-2"></i> Modifier l'Utilisateur
                </h1>
            </div>
            <div>
                <a href="<?php echo e(route('admin.users.show', $user->id)); ?>" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-arrow-left me-2"></i> Retour
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Formulaire principal -->
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-pencil-square me-2"></i> Informations de l'Utilisateur
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST" enctype="multipart/form-data" id="editUserForm">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <!-- Section Informations de base -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-person-vcard me-2"></i> Informations de base
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
                                                   placeholder="Entrez le nom"
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
                                        <label for="prenom" class="form-label fw-semibold">Prénom *</label>
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
                                                   value="<?php echo e(old('prenom', $user->prenom)); ?>"
                                                   placeholder="Entrez le prénom"
                                                   required>
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
                                                   placeholder="exemple@email.com"
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
                                                   value="<?php echo e(old('telephone', $user->telephone)); ?>"
                                                   placeholder="+212 6XX XX XX XX">
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
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-geo-alt"></i>
                                        </span>
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
                                                  rows="2"
                                                  placeholder="Entrez l'adresse complète"><?php echo e(old('adresse', $user->adresse)); ?></textarea>
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
                            </div>

                            <!-- Section Rôle et Statut -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-shield-check me-2"></i> Rôle et Statut
                                </h6>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="role_id" class="form-label fw-semibold">Rôle *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person-badge"></i>
                                            </span>
                                            <select class="form-select <?php $__errorArgs = ['role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="role_id"
                                                    name="role_id"
                                                    required>
                                                <option value="">Sélectionnez un rôle</option>
                                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($role->id); ?>"
                                                            <?php echo e(old('role_id', $user->role_id) == $role->id ? 'selected' : ''); ?>

                                                            data-color="<?php echo e($role->color ?? ''); ?>">
                                                        <?php echo e($role->nom_role); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['role_id'];
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
                                        <label for="langue_id" class="form-label fw-semibold">Langue</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-translate"></i>
                                            </span>
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
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold d-block">Statut *</label>
                                        <div class="btn-group" role="group">
                                            <input type="radio"
                                                   class="btn-check"
                                                   name="statut"
                                                   id="statut_actif"
                                                   value="actif"
                                                   <?php echo e(old('statut', $user->statut) == 'actif' ? 'checked' : ''); ?>

                                                   required>
                                            <label class="btn btn-outline-success" for="statut_actif">
                                                <i class="bi bi-check-circle me-2"></i> Actif
                                            </label>

                                            <input type="radio"
                                                   class="btn-check"
                                                   name="statut"
                                                   id="statut_inactif"
                                                   value="inactif"
                                                   <?php echo e(old('statut', $user->statut) == 'inactif' ? 'checked' : ''); ?>>
                                            <label class="btn btn-outline-danger" for="statut_inactif">
                                                <i class="bi bi-x-circle me-2"></i> Inactif
                                            </label>
                                        </div>
                                        <?php $__errorArgs = ['statut'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Email vérifié</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   role="switch"
                                                   id="email_verified"
                                                   name="email_verified_at"
                                                   <?php echo e($user->email_verified_at ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="email_verified">
                                                <?php if($user->email_verified_at): ?>
                                                    <span class="text-success">Vérifié le <?php echo e($user->email_verified_at->format('d/m/Y')); ?></span>
                                                <?php else: ?>
                                                    <span class="text-danger">Non vérifié</span>
                                                <?php endif; ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section Photo de profil -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-camera me-2"></i> Photo de Profil
                                </h6>

                                <div class="row align-items-center">
                                    <div class="col-md-3 mb-3">
                                        <!-- Photo actuelle -->
                                        <div class="text-center">
                                            <div class="position-relative d-inline-block">
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
                                                         class="current-photo rounded-circle border shadow"
                                                         width="100" height="100"
                                                         alt="Photo actuelle"
                                                         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <?php endif; ?>

                                                <div class="current-photo rounded-circle border shadow d-flex align-items-center justify-content-center <?php echo e(($user->photo && ($photoExists ?? false)) ? 'd-none' : ''); ?>"
                                                     style="width: 100px; height: 100px; background: linear-gradient(45deg,
                                                     <?php switch($user->id % 5):
                                                         case (0): ?> #4e73df, #224abe <?php break; ?>
                                                         <?php case (1): ?> #1cc88a, #13855c <?php break; ?>
                                                         <?php case (2): ?> #36b9cc, #258391 <?php break; ?>
                                                         <?php case (3): ?> #f6c23e, #dda20a <?php break; ?>
                                                         <?php default: ?> #e74a3b, #be2617
                                                     <?php endswitch; ?>);">
                                                    <span class="text-white fw-bold fs-4"><?php echo e($initial); ?></span>
                                                </div>

                                                <small class="text-muted d-block mt-2">Photo actuelle</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9 mb-3">
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

                                        <!-- Aperçu de la nouvelle photo -->
                                        <div id="photoPreview" class="d-none">
                                            <div class="d-flex align-items-center gap-3">
                                                <img id="previewImage"
                                                     class="rounded-circle border shadow"
                                                     width="80" height="80"
                                                     alt="Aperçu">
                                                <div>
                                                    <h6 class="mb-1">Nouvelle photo</h6>
                                                    <small class="text-muted">Cette photo remplacera l'ancienne</small>
                                                </div>
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger ms-auto"
                                                        onclick="removePhoto()">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Option pour supprimer la photo -->
                                        <?php if($user->photo && ($photoExists ?? false)): ?>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="remove_photo"
                                                   name="remove_photo">
                                            <label class="form-check-label text-danger" for="remove_photo">
                                                <i class="bi bi-trash me-1"></i> Supprimer la photo actuelle
                                            </label>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Section Réinitialisation du mot de passe -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-key me-2"></i> Mot de passe (optionnel)
                                </h6>

                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Laissez ces champs vides si vous ne souhaitez pas modifier le mot de passe.
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label fw-semibold">Nouveau mot de passe</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-lock"></i>
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
                                                   placeholder="Laisser vide pour ne pas changer">
                                            <button class="btn btn-outline-secondary"
                                                    type="button"
                                                    id="togglePassword">
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
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label fw-semibold">Confirmer le mot de passe</label>
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
                                                   placeholder="Confirmez le mot de passe">
                                            <button class="btn btn-outline-secondary"
                                                    type="button"
                                                    id="togglePasswordConfirmation">
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
                                </div>

                                <!-- Indicateur de force du mot de passe -->
                                <div class="password-strength mb-3 d-none">
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                    </div>
                                    <small class="password-strength-text mt-1 d-block"></small>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <div>
                                    <a href="<?php echo e(route('admin.users.show', $user->id)); ?>" class="btn btn-outline-secondary">
                                        <i class="bi bi-x-circle me-2"></i> Annuler
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check-circle me-2"></i> Mettre à jour
                                    </button>
                                    <button type="button"
                                            class="btn btn-primary btn-lg dropdown-toggle dropdown-toggle-split"
                                            data-bs-toggle="dropdown">
                                        <span class="visually-hidden">Options</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <button type="submit" name="save_and_continue" value="1" class="dropdown-item">
                                                <i class="bi bi-save me-2"></i> Enregistrer et continuer
                                            </button>
                                        </li>
                                        <li>
                                            <button type="submit" name="save_and_new" value="1" class="dropdown-item">
                                                <i class="bi bi-plus-circle me-2"></i> Enregistrer et nouveau
                                            </button>
                                        </li>
                                        <li>
                                            <button type="submit" name="save_and_exit" value="1" class="dropdown-item">
                                                <i class="bi bi-box-arrow-right me-2"></i> Enregistrer et quitter
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Panneau latéral -->
            <div class="col-lg-4">
                <!-- Aperçu de l'utilisateur -->
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-eye me-2"></i> Aperçu
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div id="previewAvatar" class="mx-auto">
                                <!-- Avatar initial -->
                                <?php
                                    $initial = strtoupper(substr($user->name ?? 'U', 0, 1));
                                ?>
                                <div class="user-avatar rounded-circle border shadow d-flex align-items-center justify-content-center mx-auto"
                                     style="width: 80px; height: 80px; background: linear-gradient(45deg,
                                     <?php switch($user->id % 5):
                                         case (0): ?> #4e73df, #224abe <?php break; ?>
                                         <?php case (1): ?> #1cc88a, #13855c <?php break; ?>
                                         <?php case (2): ?> #36b9cc, #258391 <?php break; ?>
                                         <?php case (3): ?> #f6c23e, #dda20a <?php break; ?>
                                         <?php default: ?> #e74a3b, #be2617
                                     <?php endswitch; ?>);">
                                    <span class="text-white fw-bold fs-3"><?php echo e($initial); ?></span>
                                </div>
                            </div>
                            <h5 id="previewName" class="mt-3 mb-1"><?php echo e($user->name); ?> <?php echo e($user->prenom); ?></h5>
                            <div id="previewEmail" class="text-muted"><?php echo e($user->email); ?></div>
                        </div>

                        <div class="preview-info">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Rôle :</span>
                                <span id="previewRole" class="badge
                                    <?php switch($user->role->nom_role ?? ''):
                                        case ('Administrateur'): ?> bg-danger
                                        <?php case ('Modérateur'): ?> bg-warning text-dark
                                        <?php case ('Contributeur'): ?> bg-info
                                        <?php default: ?> bg-secondary
                                    <?php endswitch; ?>">
                                    <?php echo e($user->role->nom_role ?? 'Aucun rôle'); ?>

                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Statut :</span>
                                <span id="previewStatut" class="badge <?php echo e($user->statut == 'actif' ? 'bg-success' : 'bg-danger'); ?>">
                                    <?php echo e(ucfirst($user->statut)); ?>

                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Langue :</span>
                                <span id="previewLangue" class="badge bg-light text-dark border">
                                    <?php echo e($user->langue->nom_langue ?? 'FR'); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations système -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-info-circle me-2"></i> Informations Système
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <span class="text-muted">ID :</span>
                                <strong>#<?php echo e($user->id); ?></strong>
                            </li>
                            <li class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <span class="text-muted">Créé le :</span>
                                <span><?php echo e($user->created_at->format('d/m/Y H:i')); ?></span>
                            </li>
                            <li class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <span class="text-muted">Modifié le :</span>
                                <span><?php echo e($user->updated_at->format('d/m/Y H:i')); ?></span>
                            </li>
                            <?php if($user->email_verified_at): ?>
                            <li class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <span class="text-muted">Email vérifié :</span>
                                <span class="text-success"><?php echo e($user->email_verified_at->format('d/m/Y')); ?></span>
                            </li>
                            <?php endif; ?>
                            <?php if($user->last_login_at): ?>
                            <li class="d-flex justify-content-between">
                                <span class="text-muted">Dernière connexion :</span>
                                <span><?php echo e(\Carbon\Carbon::parse($user->last_login_at)->format('d/m/Y H:i')); ?></span>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Aperçu en temps réel
    function updatePreview() {
        // Mettre à jour le nom
        const name = $('#name').val() || '';
        const prenom = $('#prenom').val() || '';
        const fullName = name + (name && prenom ? ' ' : '') + prenom;
        $('#previewName').text(fullName || 'Non défini');

        // Mettre à jour l'email
        $('#previewEmail').text($('#email').val() || 'Non défini');

        // Mettre à jour le rôle
        const roleSelect = $('#role_id');
        const selectedRole = roleSelect.find('option:selected');
        const roleBadge = $('#previewRole');
        const roleColor = selectedRole.data('color');

        if (selectedRole.text()) {
            roleBadge.text(selectedRole.text());
            roleBadge.removeClass().addClass('badge');

            // Appliquer la couleur personnalisée ou par défaut
            if (roleColor) {
                roleBadge.css('background-color', roleColor);
                roleBadge.css('color', getContrastColor(roleColor));
            } else {
                // Couleurs par défaut basées sur le texte
                const roleText = selectedRole.text().toLowerCase();
                if (roleText.includes('admin')) roleBadge.addClass('bg-danger');
                else if (roleText.includes('mod')) roleBadge.addClass('bg-warning text-dark');
                else if (roleText.includes('cont')) roleBadge.addClass('bg-info');
                else roleBadge.addClass('bg-secondary');
            }
        } else {
            roleBadge.text('Aucun rôle').addClass('bg-secondary');
        }

        // Mettre à jour la langue
        const langueSelect = $('#langue_id');
        const langueText = langueSelect.find('option:selected').text();
        $('#previewLangue').text(langueText || 'FR');

        // Mettre à jour le statut
        const statut = $('input[name="statut"]:checked').val();
        const statutBadge = $('#previewStatut');
        if (statut === 'actif') {
            statutBadge.text('Actif').removeClass('bg-danger').addClass('bg-success');
        } else if (statut === 'inactif') {
            statutBadge.text('Inactif').removeClass('bg-success').addClass('bg-danger');
        }

        // Mettre à jour l'avatar avec initiales
        const initial = name ? name.charAt(0).toUpperCase() : 'U';
        const colors = [
            ['#4e73df', '#224abe'],
            ['#1cc88a', '#13855c'],
            ['#36b9cc', '#258391'],
            ['#f6c23e', '#dda20a'],
            ['#e74a3b', '#be2617']
        ];
        const colorIndex = name.charCodeAt(0) % colors.length || 0;
        const [color1, color2] = colors[colorIndex];

        const avatarHtml = `
            <div class="user-avatar rounded-circle border shadow d-flex align-items-center justify-content-center mx-auto"
                 style="width: 80px; height: 80px; background: linear-gradient(45deg, ${color1}, ${color2});">
                <span class="text-white fw-bold fs-3">${initial}</span>
            </div>
        `;
        $('#previewAvatar').html(avatarHtml);
    }

    // Fonction utilitaire pour déterminer la couleur du texte
    function getContrastColor(hexcolor) {
        const r = parseInt(hexcolor.substr(1,2), 16);
        const g = parseInt(hexcolor.substr(3,2), 16);
        const b = parseInt(hexcolor.substr(5,2), 16);
        const yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
        return (yiq >= 128) ? '#000000' : '#ffffff';
    }

    // Écouter les changements
    $('#name, #prenom, #email, #role_id, #langue_id, input[name="statut"]').on('input change', updatePreview);

    // Initialiser l'aperçu
    updatePreview();

    // Gestion de la photo
    const photoInput = document.getElementById('photo');
    const previewContainer = document.getElementById('photoPreview');
    const previewImage = document.getElementById('previewImage');
    const currentPhoto = document.querySelector('.current-photo');

    if (photoInput) {
        photoInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('d-none');

                    // Masquer la photo actuelle
                    if (currentPhoto) {
                        currentPhoto.style.opacity = '0.5';
                    }
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Fonction pour supprimer l'aperçu de la photo
    window.removePhoto = function() {
        if (photoInput) {
            photoInput.value = '';
        }
        previewContainer.classList.add('d-none');

        // Restaurer la photo actuelle
        if (currentPhoto) {
            currentPhoto.style.opacity = '1';
        }
    }

    // Basculer la visibilité du mot de passe
    $('#togglePassword').click(function() {
        const passwordInput = $('#password');
        const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
        passwordInput.attr('type', type);
        $(this).find('i').toggleClass('bi-eye bi-eye-slash');
    });

    $('#togglePasswordConfirmation').click(function() {
        const passwordInput = $('#password_confirmation');
        const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
        passwordInput.attr('type', type);
        $(this).find('i').toggleClass('bi-eye bi-eye-slash');
    });

    // Vérification de la force du mot de passe
    $('#password').on('input', function() {
        const password = $(this).val();
        const strengthBar = $('.password-strength .progress-bar');
        const strengthText = $('.password-strength-text');
        const strengthContainer = $('.password-strength');

        if (password.length === 0) {
            strengthContainer.addClass('d-none');
            return;
        }

        strengthContainer.removeClass('d-none');

        // Calculer la force
        let score = 0;
        if (password.length >= 8) score += 1;
        if (/[A-Z]/.test(password)) score += 1;
        if (/[0-9]/.test(password)) score += 1;
        if (/[^A-Za-z0-9]/.test(password)) score += 1;
        if (password.length >= 12) score += 1;

        const percent = (score / 5) * 100;
        strengthBar.css('width', percent + '%');

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

        strengthBar.removeClass().addClass('progress-bar ' + color);
        strengthText.text(text);
    });

    // Validation du formulaire
    $('#editUserForm').on('submit', function(e) {
        const password = $('#password').val();
        const confirmPassword = $('#password_confirmation').val();

        if (password && password !== confirmPassword) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Les mots de passe ne correspondent pas.',
                confirmButtonColor: '#4e73df'
            });
            return false;
        }

        // Désactiver le bouton pour éviter les double-clics
        $('button[type="submit"]').prop('disabled', true).html('<i class="bi bi-hourglass-split me-2"></i> Enregistrement...');
    });

    // Gestion des boutons d'action
    $('button[name="save_and_continue"], button[name="save_and_new"], button[name="save_and_exit"]').click(function() {
        const action = $(this).attr('name');
        $('#editUserForm').append(`<input type="hidden" name="${action}" value="1">`);
    });
});
</script>

<style>
/* Styles pour le formulaire */
.form-label {
    font-weight: 600;
    color: #495057;
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.current-photo {
    transition: opacity 0.3s;
}

/* Boutons radio personnalisés */
.btn-check:checked + .btn-outline-success {
    background-color: #1cc88a;
    border-color: #1cc88a;
    color: white;
}

.btn-check:checked + .btn-outline-danger {
    background-color: #e74a3b;
    border-color: #e74a3b;
    color: white;
}

/* Aperçu */
.preview-info {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

/* Indicateur de force du mot de passe */
.password-strength .progress {
    background-color: #e9ecef;
}

/* Avatar personnalisé */
.user-avatar {
    transition: all 0.3s ease;
}

.user-avatar:hover {
    transform: scale(1.05);
}

/* Responsive */
@media (max-width: 768px) {
    .btn-group {
        width: 100%;
    }

    .btn-group .btn {
        flex: 1;
    }

    .preview-info {
        font-size: 0.9rem;
    }
}

/* Animation pour l'aperçu */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

#previewAvatar, #previewName, #previewEmail {
    animation: fadeIn 0.3s ease-out;
}
</style>


<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\users\edit.blade.php ENDPATH**/ ?>