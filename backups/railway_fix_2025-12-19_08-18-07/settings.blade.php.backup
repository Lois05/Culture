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
                                    $hasPhoto = $user->photo && Storage::disk('public')->exists($user->photo);
                                @endphp

                                @if($hasPhoto)
                                    <img src="{{ asset('storage/' . $user->photo) }}"
                                         alt="Photo de profil"
                                         class="rounded-circle mb-3"
                                         style="width: 150px; height: 150px; object-fit: cover; border: 3px solid var(--accent-color);"
                                         id="profileImage">
                                @else
                                    <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center"
                                         style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); border: 3px solid var(--accent-color); color: white; font-size: 2rem; font-weight: bold;"
                                         id="defaultAvatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif

                                <label for="photo" class="btn btn-sm btn-primary-custom btn-icon rounded-circle"
                                       style="position: absolute; bottom: 10px; right: 10px; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;"
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
                                       class="form-control"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       required>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Prénom -->
                            <div class="col-md-6 mb-3">
                                <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       id="prenom"
                                       name="prenom"
                                       value="{{ old('prenom', $user->prenom ?? '') }}"
                                       required>
                                @error('prenom')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email"
                                       class="form-control"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       required>
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sexe -->
                            <div class="col-md-6 mb-3">
                                <label for="sexe" class="form-label">Sexe <span class="text-danger">*</span></label>
                                <select class="form-select" id="sexe" name="sexe" required>
                                    <option value="">Sélectionnez...</option>
                                    <option value="M" {{ old('sexe', $user->sexe ?? '') == 'M' ? 'selected' : '' }}>Masculin</option>
                                    <option value="F" {{ old('sexe', $user->sexe ?? '') == 'F' ? 'selected' : '' }}>Féminin</option>
                                </select>
                                @error('sexe')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date de naissance -->
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                                <input type="date"
                                       class="form-control"
                                       id="date_naissance"
                                       name="date_naissance"
                                       value="{{ old('date_naissance', $user->date_naissance ? $user->date_naissance->format('Y-m-d') : '') }}"
                                       required>
                                @error('date_naissance')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Langue préférée -->
                            <div class="col-md-6 mb-3">
                                <label for="id_langue" class="form-label">Langue préférée</label>
                                <select class="form-select" id="id_langue" name="id_langue">
                                    <option value="">Sélectionnez une langue...</option>
                                    @foreach($langues as $langue)
                                        <option value="{{ $langue->id_langue }}"
                                                {{ old('id_langue', $user->id_langue ?? '') == $langue->id_langue ? 'selected' : '' }}>
                                            {{ $langue->nom_langue }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_langue')
                                    <div class="text-danger small">{{ $message }}</div>
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
                           class="form-control"
                           id="current_password"
                           name="current_password"
                           required>
                    @error('current_password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Nouveau mot de passe <span class="text-danger">*</span></label>
                    <input type="password"
                           class="form-control"
                           id="new_password"
                           name="new_password"
                           required
                           minlength="8">
                    @error('new_password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
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

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
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
                    <input type="text" class="form-control" id="confirmDelete" required>
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
            alert('La taille de l\'image ne doit pas dépasser 2MB');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('profileImage');
            const defaultAvatar = document.getElementById('defaultAvatar');

            if (img) {
                img.src = e.target.result;
            } else if (defaultAvatar) {
                // Remplacer l'avatar par défaut par une image
                defaultAvatar.outerHTML = `
                    <img src="${e.target.result}"
                         alt="Photo de profil"
                         class="rounded-circle mb-3"
                         style="width: 150px; height: 150px; object-fit: cover; border: 3px solid var(--accent-color);"
                         id="profileImage">
                `;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Gestion de la suppression du compte
document.addEventListener('DOMContentLoaded', function() {
    const confirmDeleteInput = document.getElementById('confirmDelete');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const deleteForm = document.getElementById('deleteForm');

    // Activer/désactiver le bouton de suppression
    if (confirmDeleteInput) {
        confirmDeleteInput.addEventListener('input', function() {
            if (confirmDeleteBtn) {
                confirmDeleteBtn.disabled = this.value.toUpperCase() !== 'SUPPRIMER';
            }
        });
    }

    // Confirmation avant soumission
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (confirmDeleteInput && confirmDeleteInput.value.toUpperCase() === 'SUPPRIMER') {
                if (confirm('Êtes-vous ABSOLUMENT SÛR de vouloir supprimer votre compte ? Cette action ne peut pas être annulée.')) {
                    this.submit();
                }
            }
        });
    }

    // Validation du formulaire de mot de passe
    const passwordForm = document.getElementById('passwordForm');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            const currentPassword = document.getElementById('current_password').value;
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('new_password_confirmation').value;

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas.');
                return false;
            }

            if (newPassword.length < 8) {
                e.preventDefault();
                alert('Le mot de passe doit contenir au moins 8 caractères.');
                return false;
            }

            if (newPassword === currentPassword) {
                e.preventDefault();
                alert('Le nouveau mot de passe doit être différent de l\'actuel.');
                return false;
            }
        });
    }

    // Validation du formulaire de profil
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const prenom = document.getElementById('prenom').value.trim();
            const email = document.getElementById('email').value.trim();
            const sexe = document.getElementById('sexe').value;
            const dateNaissance = document.getElementById('date_naissance').value;

            // Validation basique côté client
            if (!name || !prenom || !email || !sexe || !dateNaissance) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs obligatoires.');
                return false;
            }

            // Validation de l'email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Veuillez entrer une adresse email valide.');
                return false;
            }

            // Validation de la date de naissance
            const birthDate = new Date(dateNaissance);
            const today = new Date();
            if (birthDate >= today) {
                e.preventDefault();
                alert('La date de naissance doit être dans le passé.');
                return false;
            }
        });
    }
});
</script>
@endpush
@endsection
