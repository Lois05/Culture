@extends('layouts.layout')

@section('page-title', 'Modifier mon Profil')

@section('content')
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.tableaudebord') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.profile.show') }}">Mon Profil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('admin.profile.show') }}" class="btn btn-outline-secondary">
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
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

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
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   id="name"
                                                   name="name"
                                                   value="{{ old('name', $user->name) }}"
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="prenom" class="form-label fw-semibold">Prénom</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person"></i>
                                            </span>
                                            <input type="text"
                                                   class="form-control @error('prenom') is-invalid @enderror"
                                                   id="prenom"
                                                   name="prenom"
                                                   value="{{ old('prenom', $user->prenom) }}">
                                            @error('prenom')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   id="email"
                                                   name="email"
                                                   value="{{ old('email', $user->email) }}"
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-telephone"></i>
                                            </span>
                                            <input type="tel"
                                                   class="form-control @error('telephone') is-invalid @enderror"
                                                   id="telephone"
                                                   name="telephone"
                                                   value="{{ old('telephone', $user->telephone) }}">
                                            @error('telephone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="adresse" class="form-label fw-semibold">Adresse</label>
                                    <textarea class="form-control @error('adresse') is-invalid @enderror"
                                              id="adresse"
                                              name="adresse"
                                              rows="3">{{ old('adresse', $user->adresse) }}</textarea>
                                    @error('adresse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Langue -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-translate me-2"></i> Préférences
                                </h6>

                                <div class="mb-3">
                                    <label for="langue_id" class="form-label fw-semibold">Langue préférée</label>
                                    <select class="form-select @error('langue_id') is-invalid @enderror"
                                            id="langue_id"
                                            name="langue_id">
                                        <option value="">Sélectionnez une langue</option>
                                        @foreach($langues as $langue)
                                            <option value="{{ $langue->id }}"
                                                    {{ old('langue_id', $user->langue_id) == $langue->id ? 'selected' : '' }}>
                                                {{ $langue->nom_langue }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('langue_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                            @php
                                                $initial = strtoupper(substr($user->name ?? 'U', 0, 1));
                                                if ($user->photo) {
                                                    $photoPath = 'adminlte/img/' . $user->photo;
                                                    $photoUrl = asset($photoPath);
                                                    $photoExists = file_exists(public_path($photoPath));
                                                }
                                            @endphp

                                            @if($user->photo && ($photoExists ?? false))
                                                <img src="{{ $photoUrl }}"
                                                     class="rounded-circle border shadow mb-2"
                                                     width="100" height="100"
                                                     alt="Photo actuelle">
                                                <p class="text-muted small mb-0">Photo actuelle</p>
                                            @else
                                                <div class="rounded-circle border shadow d-flex align-items-center justify-content-center mb-2"
                                                     style="width: 100px; height: 100px; background: linear-gradient(45deg, #4e73df, #224abe);">
                                                    <span class="text-white fw-bold fs-3">{{ $initial }}</span>
                                                </div>
                                                <p class="text-muted small mb-0">Aucune photo</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-8 mb-3">
                                        <div class="mb-3">
                                            <label for="photo" class="form-label fw-semibold">Changer la photo</label>
                                            <input type="file"
                                                   class="form-control @error('photo') is-invalid @enderror"
                                                   id="photo"
                                                   name="photo"
                                                   accept="image/*">
                                            @error('photo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                Formats acceptés : JPG, PNG, GIF. Taille max : 2MB
                                            </div>
                                        </div>

                                        @if($user->photo && ($photoExists ?? false))
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
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="d-flex justify-content-between pt-3 border-top">
                                <a href="{{ route('admin.profile.show') }}" class="btn btn-outline-secondary">
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
                            <a href="{{ route('admin.profile.change-password') }}" class="btn btn-outline-warning">
                                <i class="bi bi-key me-2"></i> Changer le mot de passe
                            </a>
                            <a href="{{ route('2fa.enable') }}" class="btn btn-outline-info">
                                <i class="bi bi-shield-check me-2"></i> Authentification à deux facteurs
                            </a>
                            <a href="{{ route('admin.profile.show') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-eye me-2"></i> Voir mon profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

