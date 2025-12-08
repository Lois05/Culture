@extends('layouts.layout')

@section('page-title', 'Modifier l\'Utilisateur')

@section('content')
<main class="app-main">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-person-gear"></i> Modifier l'utilisateur
            </h3>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Nom -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nom</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Prénom -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}"
                                   class="form-control @error('prenom') is-invalid @enderror">
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Rôle -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Rôle</label>
                            <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                                <option value="">Sélectionner un rôle</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ (old('role_id', $user->role_id) == $role->id) ? 'selected' : '' }}>
                                        {{ $role->nom_role }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Langue -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Langue</label>
                            <select name="langue_id" class="form-select @error('langue_id') is-invalid @enderror">
                                <option value="">Sélectionner une langue</option>
                                @foreach($langues as $langue)
                                    <option value="{{ $langue->id }}"
                                        {{ (old('langue_id', $user->langue_id) == $langue->id) ? 'selected' : '' }}>
                                        {{ $langue->nom_langue ?? $langue->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('langue_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Statut -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Statut</label>
                            <select name="statut" class="form-select @error('statut') is-invalid @enderror">
                                <option value="actif" {{ old('statut', $user->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                                <option value="inactif" {{ old('statut', $user->statut) == 'inactif' ? 'selected' : '' }}>Inactif</option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photo -->
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Photo de profil</label>
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($user->photo)
                                <div class="mt-2">
                                    <p class="text-muted small">Photo actuelle :</p>
                                    <img src="{{ asset('storage/'.$user->photo) }}" alt="Photo de {{ $user->name }}"
                                         class="rounded shadow-sm" width="100" height="100" style="object-fit: cover;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Mettre à jour
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
