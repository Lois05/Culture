@extends('layouts.layout')

@section('content')
<main class="app-main bg-light min-vh-100">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-plus-circle"></i> Ajouter un utilisateur
            </h3>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg shadow">
                <i class="bi bi-arrow-left-circle"></i> Retour
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3 p-4">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Nom</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="prenom" class="form-label fw-bold">Prénom</label>
                        <input type="text" name="prenom" id="prenom"
                               class="form-control @error('prenom') is-invalid @enderror"
                               value="{{ old('prenom') }}">
                        @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="date_naissance" class="form-label fw-bold">Date de naissance</label>
                        <input type="date" name="date_naissance" id="date_naissance"
                               class="form-control @error('date_naissance') is-invalid @enderror"
                               value="{{ old('date_naissance') }}">
                        @error('date_naissance') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label fw-bold">Mot de passe</label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label fw-bold">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control @error('password') is-invalid @enderror" required>
                        <small class="text-muted">Veuillez confirmer votre mot de passe</small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="statut" class="form-label fw-bold">Statut</label>
                        <select name="statut" id="statut"
                                class="form-select @error('statut') is-invalid @enderror">
                            <option value="actif" {{ old('statut')=='actif' ? 'selected' : '' }}>Actif</option>
                            <option value="inactif" {{ old('statut')=='inactif' ? 'selected' : '' }}>Inactif</option>
                        </select>
                        @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="sexe" class="form-label fw-bold">Sexe</label>
                        <select name="sexe" id="sexe"
                                class="form-select @error('sexe') is-invalid @enderror">
                            <option value="">Sélectionner</option>
                            <option value="M" {{ old('sexe')=='M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ old('sexe')=='F' ? 'selected' : '' }}>Féminin</option>
                        </select>
                        @error('sexe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="role_id" class="form-label fw-bold">Rôle</label>
                        <select name="id_role" id="role_id"
                                class="form-select @error('id_role') is-invalid @enderror">
                            <option value="">Sélectionner un rôle</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('id_role')==$role->id ? 'selected' : '' }}>
                                    {{ $role->nom_role }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="langue_id" class="form-label fw-bold">Langue</label>
                        <select name="id_langue" id="langue_id"
                                class="form-select @error('id_langue') is-invalid @enderror">
                            <option value="">Sélectionner une langue</option>
                            @foreach($langues as $langue)
                                <option value="{{ $langue->id_langue }}" {{ old('id_langue')==$langue->id_langue ? 'selected' : '' }}>
                                    {{ $langue->nom_langue }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_langue') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label fw-bold">Photo</label>
                    <input type="file" name="photo" id="photo"
                           class="form-control @error('photo') is-invalid @enderror"
                           accept="image/*">
                    @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg">Annuler</a>
                    <button type="submit" class="btn btn-gradient btn-lg shadow">
                        <i class="bi bi-plus-circle"></i> Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validation du mot de passe en temps réel
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');

    function validatePassword() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Les mots de passe ne correspondent pas');
            confirmPassword.classList.add('is-invalid');
        } else {
            confirmPassword.setCustomValidity('');
            confirmPassword.classList.remove('is-invalid');
        }
    }

    password.addEventListener('input', validatePassword);
    confirmPassword.addEventListener('input', validatePassword);
});
</script>

<style>
    .btn-gradient {
        background: linear-gradient(45deg, #0d6efd, #6610f2);
        color: #fff;
        border: none;
        transition: 0.3s;
    }
    .btn-gradient:hover { transform: scale(1.05); opacity: 0.9; }
</style>
@endpush
@endsection
