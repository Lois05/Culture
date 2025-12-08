{{-- resources/views/users/show.blade.php --}}
@extends('layouts.layout')

@section('content')
<main class="app-main bg-light min-vh-100">
    <div class="container-fluid mt-4">

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succès</strong> — {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Erreur</strong> — Veuillez corriger les champs ci-dessous.
            </div>
        @endif

        <div class="card shadow-lg border-0 rounded-3">
            {{-- Header --}}
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-person-badge"></i> Profil Utilisateur
                </h4>
                <div>
                    <a href="{{ route('users.index') }}" class="btn btn-light btn-sm shadow-sm me-2">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm shadow-sm">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                </div>
            </div>

            {{-- Body --}}
            <div class="card-body">
                <div class="row g-4">
                    {{-- Col gauche : avatar + upload --}}
                    <div class="col-md-4 text-center">
                        <div class="position-relative d-inline-block">
                            <img id="previewImage"
                                 src="{{ $user->photo ? asset('storage/'.$user->photo) : asset('assets/img/default-user.png') }}"
                                 alt="Photo de {{ $user->name }} {{ $user->prenom }}"
                                 class="rounded-circle shadow-lg border border-3 border-primary profile-img"
                                 width="160" height="160" loading="lazy">
                        </div>

                        <h5 class="mt-3 fw-bold">{{ $user->name }} {{ $user->prenom }}</h5>
                        <p class="text-muted mb-2">{{ $user->email }}</p>

                        {{-- Upload form --}}
                        <form action="{{ route('users.updatePhoto', $user->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                            @csrf
                            @method('PUT')

                            <div class="mb-2">
                                <label for="photoInput" class="form-label visually-hidden">Choisir une photo</label>
                                <input type="file" name="photo" id="photoInput"
                                       class="form-control @error('photo') is-invalid @enderror"
                                       accept="image/*" aria-describedby="photoHelp">
                                @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div id="photoHelp" class="form-text">Formats acceptés : jpg, jpeg, png, webp — max 2MB.</div>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <button type="submit" class="btn btn-gradient">
                                    <i class="bi bi-upload"></i> Mettre à jour la photo
                                </button>

                                @if($user->photo)
                                    <button type="button" class="btn btn-outline-danger" id="btnRemovePhoto">
                                        <i class="bi bi-trash"></i> Supprimer la photo
                                    </button>
                                @endif
                            </div>
                        </form>

                        <small class="text-muted d-block mt-2">Prévisualisation avant envoi</small>
                    </div>

                    {{-- Col droite : informations --}}
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-card shadow-sm p-3 rounded bg-white">
                                    <h6 class="text-muted mb-1"><i class="bi bi-hash"></i> ID</h6>
                                    <p class="fw-bold mb-0">{{ $user->id }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card shadow-sm p-3 rounded bg-white">
                                    <h6 class="text-muted mb-1"><i class="bi bi-shield-lock"></i> Rôle</h6>
                                    <p class="mb-0">
                                        <span class="badge bg-primary">{{ $user->role->nom_role ?? '-' }}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card shadow-sm p-3 rounded bg-white">
                                    <h6 class="text-muted mb-1"><i class="bi bi-translate"></i> Langue</h6>
                                    <p class="mb-0">
                                        <span class="badge bg-warning text-dark">{{ $user->langue->nom_langue ?? '-' }}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card shadow-sm p-3 rounded bg-white">
                                    <h6 class="text-muted mb-1"><i class="bi bi-circle-fill"></i> Statut</h6>
                                    <p class="mb-0">
                                        <span class="badge {{ $user->statut == 'actif' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($user->statut ?? 'inactif') }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card shadow-sm p-3 rounded bg-white">
                                    <h6 class="text-muted mb-1"><i class="bi bi-calendar-check"></i> Date d'inscription</h6>
                                    <p class="fw-bold mb-0">
                                        {{ $user->date_inscription ?? ($user->created_at ? $user->created_at->format('d/m/Y') : '-') }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card shadow-sm p-3 rounded bg-white">
                                    <h6 class="text-muted mb-1"><i class="bi bi-calendar-heart"></i> Date de naissance</h6>
                                    <p class="fw-bold mb-0">{{ $user->date_naissance ?? '-' }}</p>
                                </div>
                            </div>

                            {{-- Description ou autres infos --}}
                            <div class="col-12">
                                <div class="info-card shadow-sm p-3 rounded bg-white">
                                    <h6 class="text-muted mb-2"><i class="bi bi-info-circle"></i> Informations complémentaires</h6>
                                    <p class="mb-0 text-muted">
                                        {{-- Exemple : afficher sexe, téléphone, adresse si présents --}}
                                        Sexe : <strong>{{ $user->sexe ?? '-' }}</strong><br>
                                        Téléphone : <strong>{{ $user->telephone ?? '-' }}</strong><br>
                                        Adresse : <strong>{{ $user->adresse ?? '-' }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- row --}}
            </div> {{-- card-body --}}
        </div> {{-- card --}}
    </div> {{-- container --}}
</main>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #0d6efd, #6610f2);
    }
    .profile-img {
        transition: transform 0.25s ease;
        object-fit: cover;
    }
    .profile-img:hover { transform: scale(1.03); }
    .info-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .info-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
    .btn-gradient {
        background: linear-gradient(45deg, #0d6efd, #6610f2);
        color: #fff;
        border: none;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const photoInput = document.getElementById('photoInput');
    const previewImage = document.getElementById('previewImage');

    if (photoInput) {
        photoInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (!file) return;
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    // Supprimer la photo via requête fetch (optionnel)
   const btnRemove = document.getElementById('btnRemovePhoto');
if (btnRemove) {
    btnRemove.addEventListener('click', function () {
        if (!confirm('Supprimer la photo de profil ?')) return;

        fetch("{{ route('users.removePhoto', $user->id) }}", {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        }).then(res => {
            if (res.ok) {
                location.reload();
            } else {
                res.json().then(data => {
                    alert(data.message || 'Impossible de supprimer la photo.');
                }).catch(() => alert('Impossible de supprimer la photo.'));
            }
        }).catch(() => alert('Erreur réseau.'));
    });
}

});
</script>
@endpush
