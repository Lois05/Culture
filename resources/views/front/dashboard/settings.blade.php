@extends('layouts.dashboard')

@section('title', 'Paramètres du compte')
@section('page-title', 'Paramètres du compte')
@section('page-subtitle', 'Gérez vos informations personnelles')

@section('content')
<div class="row fade-in">
    <!-- Informations personnelles -->
    <div class="col-lg-8">
        <div class="dashboard-card mb-4">
            <h3 class="card-title mb-4">
                <i class="bi bi-person-circle"></i>
                Informations personnelles
            </h3>

            <form method="POST" action="{{ route('dashboard.settings.profile.update') }}" enctype="multipart/form-data" id="profileForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Photo de profil -->
                    <div class="col-md-4 mb-4">
                        <div class="text-center">
                            <div class="position-relative d-inline-block">
                                @php
                                    $user = Auth::user();
                                    $hasPhoto = false;
                                    $photoUrl = null;
                                    $userInitial = strtoupper(substr($user->name, 0, 1));

                                    // Priorité 1 : Cloudinary URL directe
                                    if (!empty($user->cloudinary_url)) {
                                        $hasPhoto = true;
                                        $photoUrl = $user->cloudinary_url;
                                    }
                                    // Priorité 2 : Photo Cloudinary stockée
                                    elseif (!empty($user->photo) && (str_contains($user->photo, 'cloudinary.com') || str_contains($user->photo, 'res.cloudinary.com'))) {
                                        $hasPhoto = true;
                                        $photoUrl = $user->photo;
                                    }
                                    // Priorité 3 : Photo locale
                                    elseif (!empty($user->photo) && Storage::disk('public')->exists($user->photo)) {
                                        $hasPhoto = true;
                                        $photoUrl = asset('storage/' . $user->photo);
                                    }
                                @endphp

                                @if($hasPhoto && $photoUrl)
                                    <img src="{{ $photoUrl }}"
                                         alt="Photo de profil de {{ $user->name }}"
                                         class="rounded-circle mb-3"
                                         style="width: 150px; height: 150px; object-fit: cover; border: 3px solid var(--accent-color);"
                                         id="profileImage"
                                         onerror="this.onerror=null; this.style.display='none'; document.getElementById('defaultAvatar').style.display='flex';">
                                @endif

                                <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center {{ $hasPhoto && $photoUrl ? 'd-none' : 'd-flex' }}"
                                     style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); border: 3px solid var(--accent-color); color: white; font-size: 3rem; font-weight: bold;"
                                     id="defaultAvatar">
                                    {{ $userInitial }}
                                </div>

                                <label for="photo" class="btn btn-sm btn-primary-custom btn-icon rounded-circle"
                                       style="position: absolute; bottom: 10px; right: 10px; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center; cursor: pointer;"
                                       title="Changer la photo">
                                    <i class="bi bi-camera"></i>
                                </label>
                                <input type="file"
                                       id="photo"
                                       name="photo"
                                       class="d-none"
                                       accept="image/*"
                                       onchange="previewImage(this)">
                            </div>
                            <div class="form-text">PNG, JPG max 2MB</div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <!-- Nom -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Prénom -->
                            <div class="col-md-6 mb-3">
                                <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('prenom') is-invalid @enderror"
                                       id="prenom"
                                       name="prenom"
                                       value="{{ old('prenom', $user->prenom ?? '') }}"
                                       required>
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sexe -->
                            <div class="col-md-6 mb-3">
                                <label for="sexe" class="form-label">Sexe <span class="text-danger">*</span></label>
                                <select class="form-select @error('sexe') is-invalid @enderror" id="sexe" name="sexe" required>
                                    <option value="">Sélectionnez...</option>
                                    <option value="M" {{ old('sexe', $user->sexe ?? '') == 'M' ? 'selected' : '' }}>Masculin</option>
                                    <option value="F" {{ old('sexe', $user->sexe ?? '') == 'F' ? 'selected' : '' }}>Féminin</option>
                                </select>
                                @error('sexe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date de naissance -->
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                                <input type="date"
                                       class="form-control @error('date_naissance') is-invalid @enderror"
                                       id="date_naissance"
                                       name="date_naissance"
                                      value="{{ old('date_naissance', $user->date_naissance ? (\Carbon\Carbon::parse($user->date_naissance)->format('Y-m-d')) : '') }}"
                                @error('date_naissance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Langue préférée -->
                            <div class="col-md-6 mb-3">
                                <label for="id_langue" class="form-label">Langue préférée</label>
                                <select class="form-select @error('id_langue') is-invalid @enderror" id="id_langue" name="id_langue">
                                    <option value="">Sélectionnez une langue...</option>
                                    @foreach($langues ?? [] as $langue)
                                        <option value="{{ $langue->id_langue ?? '' }}"
                                                {{ old('id_langue', $user->id_langue ?? '') == ($langue->id_langue ?? '') ? 'selected' : '' }}>
                                            {{ $langue->nom_langue ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_langue')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Téléphone (optionnel) -->
                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="tel"
                                       class="form-control @error('telephone') is-invalid @enderror"
                                       id="telephone"
                                       name="telephone"
                                       value="{{ old('telephone', $user->telephone ?? '') }}">
                                @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Adresse (optionnel) -->
                            <div class="col-md-6 mb-3">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text"
                                       class="form-control @error('adresse') is-invalid @enderror"
                                       id="adresse"
                                       name="adresse"
                                       value="{{ old('adresse', $user->adresse ?? '') }}">
                                @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary-custom px-4">
                        <i class="bi bi-save me-2"></i>Enregistrer les informations
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mot de passe et suppression -->
    <div class="col-lg-4">
        <!-- Changement de mot de passe -->
        <div class="dashboard-card mb-4">
            <h3 class="card-title mb-4">
                <i class="bi bi-shield-lock"></i>
                Mot de passe
            </h3>

            <form method="POST" action="{{ route('dashboard.settings.password.update') }}" id="passwordForm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label">Mot de passe actuel <span class="text-danger">*</span></label>
                    <input type="password"
                           class="form-control @error('current_password') is-invalid @enderror"
                           id="current_password"
                           name="current_password"
                           required>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Nouveau mot de passe <span class="text-danger">*</span></label>
                    <input type="password"
                           class="form-control @error('new_password') is-invalid @enderror"
                           id="new_password"
                           name="new_password"
                           required
                           minlength="8">
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text small">Minimum 8 caractères</div>
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                    <input type="password"
                           class="form-control"
                           id="new_password_confirmation"
                           name="new_password_confirmation"
                           required
                           minlength="8">
                </div>

                <button type="submit" class="btn btn-outline-custom w-100">
                    <i class="bi bi-key me-2"></i>Changer le mot de passe
                </button>
            </form>
        </div>

        <!-- Section Suppression du compte -->
        <div class="dashboard-card fade-in border-danger">
            <div class="card-body">
                <h3 class="card-title mb-4 text-danger">
                    <i class="bi bi-exclamation-triangle"></i>
                    Zone dangereuse
                </h3>

                <p class="mb-4">La suppression de votre compte est irréversible. Toutes vos données seront perdues.</p>

                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    <i class="bi bi-trash me-2"></i>Supprimer mon compte
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Confirmation de suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer votre compte ?</p>
                <p class="text-danger"><strong>Cette action est irréversible !</strong></p>

                <div class="mb-3">
                    <label for="confirmDelete" class="form-label">
                        Tapez "SUPPRIMER" pour confirmer
                    </label>
                    <input type="text" class="form-control" id="confirmDelete" placeholder="SUPPRIMER" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form method="POST" action="{{ route('dashboard.settings.delete') }}" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="confirmDeleteBtn" disabled>
                        <i class="bi bi-trash me-2"></i>Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Prévisualisation de l'image
function previewImage(input) {
    if (input.files && input.files[0]) {
        // Vérification de la taille (max 2MB)
        if (input.files[0].size > 2 * 1024 * 1024) {
            showAlert('error', 'La taille de l\'image ne doit pas dépasser 2MB');
            input.value = '';
            return;
        }

        // Vérification du type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!validTypes.includes(input.files[0].type)) {
            showAlert('error', 'Seuls les formats JPEG, PNG et GIF sont autorisés');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const defaultAvatar = document.getElementById('defaultAvatar');
            let profileImage = document.getElementById('profileImage');

            if (!profileImage) {
                // Créer l'élément image s'il n'existe pas
                profileImage = document.createElement('img');
                profileImage.id = 'profileImage';
                profileImage.className = 'rounded-circle mb-3';
                profileImage.style.cssText = 'width: 150px; height: 150px; object-fit: cover; border: 3px solid var(--accent-color);';
                profileImage.alt = 'Photo de profil';
                profileImage.onerror = function() {
                    this.style.display = 'none';
                    if (defaultAvatar) defaultAvatar.style.display = 'flex';
                };

                // Insérer avant l'avatar par défaut
                defaultAvatar.parentNode.insertBefore(profileImage, defaultAvatar);
            }

            // Mettre à jour l'image
            profileImage.src = e.target.result;
            profileImage.style.display = 'block';

            // Cacher l'avatar par défaut
            if (defaultAvatar) {
                defaultAvatar.style.display = 'none';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Fonction pour afficher des alertes
function showAlert(type, message) {
    // Créer une alerte Bootstrap
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
    alertDiv.style.zIndex = '1050';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(alertDiv);

    // Auto-supprimer après 5 secondes
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

// Gestion de la suppression du compte
document.addEventListener('DOMContentLoaded', function() {
    const confirmDeleteInput = document.getElementById('confirmDelete');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const deleteForm = document.getElementById('deleteForm');

    // Activer/désactiver le bouton de suppression
    if (confirmDeleteInput && confirmDeleteBtn) {
        confirmDeleteInput.addEventListener('input', function() {
            const confirmText = 'SUPPRIMER';
            confirmDeleteBtn.disabled = this.value.toUpperCase() !== confirmText;

            // Ajouter/supprimer la classe de validation
            if (this.value.toUpperCase() === confirmText) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
            }
        });
    }

    // Confirmation avant soumission
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (confirmDeleteInput && confirmDeleteInput.value.toUpperCase() === 'SUPPRIMER') {
                if (confirm('⚠️ ATTENTION : Cette action est définitive.\n\nÊtes-vous ABSOLUMENT SÛR de vouloir supprimer votre compte ?\n\nToutes vos données seront PERMANENTEMENT effacées.')) {
                    // Afficher un indicateur de chargement
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Suppression en cours...';
                    submitBtn.disabled = true;

                    this.submit();
                }
            }
        });
    }

    // Validation du formulaire de mot de passe
    const passwordForm = document.getElementById('passwordForm');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            const currentPassword = document.getElementById('current_password');
            const newPassword = document.getElementById('new_password');
            const confirmPassword = document.getElementById('new_password_confirmation');

            // Réinitialiser les états d'erreur
            [currentPassword, newPassword, confirmPassword].forEach(input => {
                input.classList.remove('is-invalid');
            });

            let hasError = false;

            if (newPassword.value !== confirmPassword.value) {
                newPassword.classList.add('is-invalid');
                confirmPassword.classList.add('is-invalid');
                showAlert('error', 'Les mots de passe ne correspondent pas.');
                hasError = true;
            }

            if (newPassword.value.length < 8) {
                newPassword.classList.add('is-invalid');
                showAlert('error', 'Le mot de passe doit contenir au moins 8 caractères.');
                hasError = true;
            }

            if (newPassword.value === currentPassword.value) {
                newPassword.classList.add('is-invalid');
                showAlert('error', 'Le nouveau mot de passe doit être différent de l\'actuel.');
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
                return false;
            }
        });
    }

    // Validation du formulaire de profil
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            const requiredFields = [
                { id: 'name', label: 'Nom' },
                { id: 'prenom', label: 'Prénom' },
                { id: 'email', label: 'Email' },
                { id: 'sexe', label: 'Sexe' },
                { id: 'date_naissance', label: 'Date de naissance' }
            ];

            let hasError = false;

            // Vérifier les champs requis
            requiredFields.forEach(field => {
                const element = document.getElementById(field.id);
                if (element) {
                    element.classList.remove('is-invalid');

                    if (!element.value.trim()) {
                        element.classList.add('is-invalid');
                        showAlert('error', `Le champ "${field.label}" est requis`);
                        hasError = true;
                    }
                }
            });

            // Validation de l'email
            const emailField = document.getElementById('email');
            if (emailField && emailField.value.trim()) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value)) {
                    emailField.classList.add('is-invalid');
                    showAlert('error', 'Veuillez entrer une adresse email valide.');
                    hasError = true;
                }
            }

            // Validation de la date de naissance
            const birthDateField = document.getElementById('date_naissance');
            if (birthDateField && birthDateField.value) {
                const birthDate = new Date(birthDateField.value);
                const today = new Date();
                const minAgeDate = new Date();
                minAgeDate.setFullYear(today.getFullYear() - 120); // 120 ans max

                if (birthDate > today) {
                    birthDateField.classList.add('is-invalid');
                    showAlert('error', 'La date de naissance doit être dans le passé.');
                    hasError = true;
                } else if (birthDate < minAgeDate) {
                    birthDateField.classList.add('is-invalid');
                    showAlert('error', 'La date de naissance doit être raisonnable (moins de 120 ans).');
                    hasError = true;
                }
            }

            if (hasError) {
                e.preventDefault();
                return false;
            }
        });
    }

    // Validation en temps réel pour l'email
    const emailField = document.getElementById('email');
    if (emailField) {
        emailField.addEventListener('blur', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value.trim() && !emailRegex.test(this.value)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    }

    // Validation en temps réel pour la date de naissance
    const birthDateField = document.getElementById('date_naissance');
    if (birthDateField) {
        birthDateField.addEventListener('blur', function() {
            if (this.value) {
                const birthDate = new Date(this.value);
                const today = new Date();
                const minAgeDate = new Date();
                minAgeDate.setFullYear(today.getFullYear() - 120);

                if (birthDate > today || birthDate < minAgeDate) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            }
        });
    }
});
</script>

<style>
/* Styles additionnels */
.rounded-circle {
    transition: transform 0.3s ease;
}

.rounded-circle:hover {
    transform: scale(1.02);
}

.btn-primary-custom {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border: none;
    color: white;
    transition: all 0.3s ease;
}

.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(var(--primary-color-rgb), 0.3);
}

.btn-outline-custom {
    border-color: var(--accent-color);
    color: var(--accent-color);
    transition: all 0.3s ease;
}

.btn-outline-custom:hover {
    background-color: var(--accent-color);
    color: white;
    transform: translateY(-2px);
}

.dashboard-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.dashboard-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.card-title {
    color: var(--primary-color);
    border-bottom: 2px solid var(--accent-color);
    padding-bottom: 0.5rem;
}

.is-valid {
    border-color: #198754 !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in {
    animation: fadeIn 0.5s ease-out;
}
</style>
@endpush
@endsection
