@extends('layouts.layout')

@section('page-title', $contenu->titre)

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-eye me-2"></i> Détails du Contenu
                    </h4>
                    <div class="btn-group">
                        @php
                            $user = Auth::user();
                            $canEdit = $user && ($user->id == $contenu->id_auteur ||
                                     ($user->role && in_array($user->role->nom_role, ['Administrateur', 'Modérateur'])));
                        @endphp

                        @if($canEdit)
                            <a href="{{ route('admin.contenus.edit', $contenu->id_contenu) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil me-1"></i> Modifier
                            </a>
                        @endif
                        <a href="{{ route('admin.contenus.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- En-tête avec image et métadonnées -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <!-- Affichage des médias -->
                            @if($contenu->medias && $contenu->medias->count() > 0)
                                @foreach($contenu->medias as $media)
                                    <div class="mb-4">
                                        @if($media->id_type_media == 1) {{-- Image --}}
                                            <img src="{{ asset('adminlte/img/' . $media->chemin) }}"
                                                 class="img-fluid rounded"
                                                 alt="{{ $media->description }}"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                                 style="width: 100%; height: 200px; display: none;">
                                                <i class="bi bi-image text-muted display-4"></i>
                                            </div>
                                        @elseif($media->id_type_media == 2) {{-- Vidéo --}}
                                            <video controls class="w-100">
                                                <source src="{{ asset('adminlte/img/' . $media->chemin) }}">
                                                Votre navigateur ne supporte pas la vidéo.
                                            </video>
                                        @else {{-- Audio --}}
                                            <audio controls class="w-100">
                                                <source src="{{ asset('adminlte/img/' . $media->chemin) }}">
                                                Votre navigateur ne supporte pas l'audio.
                                            </audio>
                                        @endif
                                        <p class="text-muted mt-2">{{ $media->description }}</p>
                                    </div>
                                @endforeach
                            @else
                                <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                     style="width: 100%; height: 200px;">
                                    <i class="bi bi-image text-muted display-4"></i>
                                </div>
                                <p class="text-muted text-center mt-2">Aucun média associé</p>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h2 class="fw-bold text-primary">{{ $contenu->titre }}</h2>

                            @if($contenu->description)
                                <p class="lead">{{ $contenu->description }}</p>
                            @endif

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-tag text-primary me-2"></i>
                                        <strong>Type :</strong>
                                        <span class="badge bg-dark ms-2">{{ $contenu->typeContenu->nom_contenu ?? 'Non défini' }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-geo-alt text-primary me-2"></i>
                                        <strong>Région :</strong>
                                        <span class="badge bg-info ms-2">{{ $contenu->region->nom_region ?? 'Non définie' }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-translate text-primary me-2"></i>
                                        <strong>Langue :</strong>
                                        <span class="badge bg-secondary ms-2">{{ $contenu->langue->nom_langue ?? 'Non définie' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-person text-primary me-2"></i>
                                        <strong>Auteur :</strong>
                                        <span class="ms-2">{{ $contenu->auteur->name ?? 'Anonyme' }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-calendar text-primary me-2"></i>
                                        <strong>Créé le :</strong>
                                        <span class="ms-2">{{ $contenu->date_creation ? \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y à H:i') : 'Date non définie' }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-flag text-primary me-2"></i>
                                        <strong>Statut :</strong>
                                        <span class="badge
                                            @if($contenu->statut == 'validé') bg-success
                                            @elseif($contenu->statut == 'rejeté') bg-danger
                                            @elseif($contenu->statut == 'en_attente') bg-warning text-dark
                                            @else bg-secondary
                                            @endif ms-2">
                                            {{ $contenu->statut }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contenu détaillé -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i>Contenu détaillé</h5>
                        </div>
                        <div class="card-body">
                            <div class="content-text">
                                {!! nl2br(e($contenu->texte)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Informations sur le média -->
                    @if($contenu->medias && $contenu->medias->count() > 0)
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-image me-2"></i>Informations du média</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $media = $contenu->medias->first();
                                $mediaType = match($media->id_type_media) {
                                    1 => 'Image',
                                    2 => 'Vidéo',
                                    3 => 'Audio',
                                    default => 'Fichier'
                                };
                            @endphp
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Type :</strong> <span class="badge
                                        @if($media->id_type_media == 1) bg-info
                                        @elseif($media->id_type_media == 2) bg-primary
                                        @elseif($media->id_type_media == 3) bg-success
                                        @else bg-secondary
                                        @endif">
                                        {{ $mediaType }}
                                    </span></p>
                                    <p><strong>Chemin :</strong> <code>{{ $media->chemin }}</code></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Description :</strong> {{ $media->description ?? 'Aucune description' }}</p>
                                    <p><strong>Ajouté le :</strong> {{ $media->created_at ? $media->created_at->format('d/m/Y à H:i') : 'Date non définie' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Actions -->
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                        <div>
                            <a href="{{ route('admin.contenus.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i> Retour à la liste
                            </a>
                        </div>
                        <div class="btn-group">
                            @php
                                $user = Auth::user();
                                $isAdminOrModerator = $user && $user->role && in_array($user->role->nom_role, ['Administrateur', 'Modérateur']);
                                $canEdit = $user && ($user->id == $contenu->id_auteur || $user->role->nom_role == 'Administrateur' || $user->role->nom_role == 'Modérateur');
                                $canDelete = $user && ($user->id == $contenu->id_auteur || $user->role->nom_role == 'Administrateur');
                            @endphp

                            @if($contenu->statut == 'en_attente' && $isAdminOrModerator)
                                <!-- Boutons Valider/Rejeter pour les contenus en attente -->
                                <form action="{{ route('admin.contenus.valider', $contenu->id_contenu) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                            class="btn btn-success"
                                            onclick="return confirm('Valider ce contenu ? Il sera publié publiquement.')">
                                        <i class="bi bi-check-circle me-2"></i> Valider
                                    </button>
                                </form>

                                <form action="{{ route('admin.contenus.rejeter', $contenu->id_contenu) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                            class="btn btn-danger"
                                            onclick="return confirm('Rejeter ce contenu ?')">
                                        <i class="bi bi-x-circle me-2"></i> Rejeter
                                    </button>
                                </form>
                            @endif

                            @if($canEdit)
                                <!-- Bouton Modifier -->
                                <a href="{{ route('admin.contenus.edit', $contenu->id_contenu) }}"
                                   class="btn btn-warning">
                                    <i class="bi bi-pencil me-2"></i> Modifier
                                </a>
                            @endif

                            @if($canDelete)
                                <!-- Bouton Supprimer -->
                                <form action="{{ route('admin.contenus.destroy', $contenu->id_contenu) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            class="btn btn-danger btn-delete">
                                        <i class="bi bi-trash me-2"></i> Supprimer
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirmation de suppression
    const deleteBtn = document.querySelector('.btn-delete');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    }

    // Gestion des erreurs d'image
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('error', function() {
            this.style.display = 'none';
            const fallback = this.nextElementSibling;
            if (fallback && fallback.classList.contains('bg-light')) {
                fallback.style.display = 'flex';
            }
        });
    });
});
</script>

<style>
.content-text {
    line-height: 1.8;
    font-size: 1.1rem;
    color: #333;
    white-space: pre-wrap;
}

.content-text p {
    margin-bottom: 1rem;
}

.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.badge {
    font-size: 0.8em;
}

.btn-group .btn {
    margin: 0 2px;
}
</style>
@endsection
