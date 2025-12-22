@extends('layouts.layout')

@section('page-title', 'Détail du Contenu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-3">
                <!-- Header -->
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="bi bi-journal-text me-2"></i> Détail du Contenu
                        </h4>
                        <div>
                            <a href="{{ route('admin.contenus.index') }}" class="btn btn-light btn-sm me-2">
                                <i class="bi bi-arrow-left me-1"></i> Retour
                            </a>
                            @php
                                $user = Auth::user();
                                $userRole = optional($user->role)->nom_role;
                                $canEdit = $contenu->id_auteur == $user->id ||
                                          in_array($userRole, ['Administrateur', 'Modérateur']);
                                $canDelete = $contenu->id_auteur == $user->id ||
                                            $userRole === 'Administrateur';
                            @endphp

                            @if($canEdit)
                                <a href="{{ route('admin.contenus.edit', $contenu->id_contenu) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil me-1"></i> Modifier
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Messages d'alert -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Colonne gauche : Média et informations principales -->
                        <div class="col-lg-4 mb-4">
                            <!-- Carte Média -->
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="bi bi-file-earmark-image me-2"></i> Média
                                    </h5>
                                </div>
                                <div class="card-body text-center">
                                    @if($contenu->medias && $contenu->medias->count() > 0)
                                        @php
                                            $media = $contenu->medias->first();
                                            $isImage = $media->typeMedia && $media->typeMedia->id_type_media == 1;
                                            $isVideo = $media->typeMedia && $media->typeMedia->id_type_media == 2;
                                            $isAudio = $media->typeMedia && $media->typeMedia->id_type_media == 3;
                                            $filePath = public_path('adminlte/img/' . $media->chemin);
                                            $fileExists = file_exists($filePath);
                                            $fileUrl = asset('adminlte/img/' . $media->chemin);
                                        @endphp

                                        @if($isImage)
                                            @if($fileExists)
                                                <div class="mb-3">
                                                    <img src="{{ $fileUrl }}"
                                                         class="img-fluid rounded border"
                                                         style="max-height: 300px; object-fit: contain;"
                                                         alt="{{ $contenu->titre }}"
                                                         onerror="this.onerror=null; this.src='{{ App\Helpers\CloudinaryHelper::static('placeholder.jpg') }}'">
                                                </div>
                                                <div class="d-flex justify-content-center mb-2">
                                                    <a href="{{ $fileUrl }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-outline-primary me-2">
                                                        <i class="bi bi-arrows-fullscreen me-1"></i> Agrandir
                                                    </a>
                                                    <a href="{{ route('admin.medias.show', $media->id_media) }}"
                                                       class="btn btn-sm btn-outline-info">
                                                        <i class="bi bi-info-circle me-1"></i> Détails média
                                                    </a>
                                                </div>
                                            @else
                                                <div class="alert alert-warning">
                                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                                    Fichier image non trouvé
                                                </div>
                                                <div class="bg-light rounded p-4">
                                                    <i class="bi bi-file-image text-muted fs-1 mb-3"></i>
                                                    <p class="text-muted mb-0">
                                                        Chemin : {{ $media->chemin }}
                                                    </p>
                                                </div>
                                            @endif
                                        @elseif($isVideo)
                                            <div class="bg-dark rounded p-4 mb-3">
                                                <i class="bi bi-play-circle text-white fs-1 mb-2"></i>
                                                <p class="text-white mb-0">Fichier vidéo</p>
                                            </div>
                                            <a href="{{ $fileUrl }}"
                                               target="_blank"
                                               class="btn btn-primary">
                                                <i class="bi bi-play-fill me-1"></i> Lire la vidéo
                                            </a>
                                        @elseif($isAudio)
                                            <div class="bg-secondary rounded p-4 mb-3">
                                                <i class="bi bi-music-note-beamed text-white fs-1 mb-2"></i>
                                                <p class="text-white mb-0">Fichier audio</p>
                                            </div>
                                            <audio controls class="w-100">
                                                <source src="{{ $fileUrl }}" type="audio/mpeg">
                                                Votre navigateur ne supporte pas l'élément audio.
                                            </audio>
                                        @endif

                                        <div class="mt-3">
                                            <h6 class="mb-2">Informations du média</h6>
                                            <table class="table table-sm">
                                                <tr>
                                                    <td><strong>Type :</strong></td>
                                                    <td>
                                                        <span class="badge
                                                            @if($isImage) bg-success
                                                            @elseif($isVideo) bg-danger
                                                            @else bg-warning text-dark
                                                            @endif">
                                                            @if($isImage) Image
                                                            @elseif($isVideo) Vidéo
                                                            @else Audio
                                                            @endif
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Nom :</strong></td>
                                                    <td><code>{{ $media->chemin }}</code></td>
                                                </tr>
                                                @if($media->description)
                                                <tr>
                                                    <td><strong>Description :</strong></td>
                                                    <td>{{ $media->description }}</td>
                                                </tr>
                                                @endif
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="bi bi-image text-muted fs-1 mb-3"></i>
                                            <p class="text-muted">Aucun média associé</p>
                                            <a href="{{ route('admin.medias.create') }}?contenu_id={{ $contenu->id_contenu }}"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-plus-circle me-1"></i> Ajouter un média
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Informations générales -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="bi bi-info-circle me-2"></i> Informations générales
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <td><strong>ID :</strong></td>
                                            <td><span class="badge bg-secondary">#{{ $contenu->id_contenu }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Statut :</strong></td>
                                            <td>
                                                @switch($contenu->statut)
                                                    @case('validé')
                                                        <span class="badge bg-success">Validé</span>
                                                        @break
                                                    @case('en attente')
                                                        <span class="badge bg-warning text-dark">En attente</span>
                                                        @break
                                                    @case('rejeté')
                                                        <span class="badge bg-danger">Rejeté</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary">{{ $contenu->statut }}</span>
                                                @endswitch
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Date création :</strong></td>
                                            <td>{{ $contenu->date_creation ? \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y H:i') : 'N/A' }}</td>
                                        </tr>
                                        @if($contenu->date_modification)
                                        <tr>
                                            <td><strong>Dernière modif :</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($contenu->date_modification)->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Colonne droite : Détails du contenu -->
                        <div class="col-lg-8">
                            <!-- Titre et badges -->
                            <div class="mb-4">
                                <h1 class="h2 mb-3">{{ $contenu->titre }}</h1>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-dark">
                                        <i class="bi bi-tag me-1"></i>
                                        {{ $contenu->typeContenu->nom_contenu ?? 'Non défini' }}
                                    </span>
                                    <span class="badge bg-info">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        {{ $contenu->region->nom_region ?? 'Non défini' }}
                                    </span>
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-translate me-1"></i>
                                        {{ $contenu->langue->nom_langue ?? 'Non défini' }}
                                    </span>
                                </div>

                                @if($contenu->description)
                                <div class="alert alert-light border">
                                    <h6 class="mb-2">Description courte :</h6>
                                    <p class="mb-0">{{ $contenu->description }}</p>
                                </div>
                                @endif
                            </div>

                            <!-- Contenu principal -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="bi bi-text-paragraph me-2"></i> Contenu
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="content-text">
                                        {!! nl2br(e($contenu->texte)) !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Informations auteur -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="bi bi-person-circle me-2"></i> Auteur
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                             style="width: 50px; height: 50px; font-size: 1.2rem;">
                                            {{ strtoupper(substr($contenu->auteur->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <div>
                                            <h5 class="mb-1">{{ $contenu->auteur->name ?? 'Anonyme' }}</h5>
                                            <p class="text-muted mb-0">
                                                <i class="bi bi-envelope me-1"></i> {{ $contenu->auteur->email ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions modération (pour admins/mods) -->
                            @if(in_array($userRole, ['Administrateur', 'Modérateur']))
                                <div class="card border-0 shadow-sm mt-4">
                                    <div class="card-header bg-warning text-dark">
                                        <h5 class="mb-0">
                                            <i class="bi bi-shield-check me-2"></i> Actions de modération
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @if($contenu->statut != 'validé')
                                            <div class="col-md-6 mb-2">
                                                <form action="{{ route('admin.contenus.valider', $contenu->id_contenu) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success w-100">
                                                        <i class="bi bi-check-circle me-1"></i> Valider ce contenu
                                                    </button>
                                                </form>
                                            </div>
                                            @endif

                                            @if($contenu->statut != 'rejeté')
                                            <div class="col-md-6 mb-2">
                                                <form action="{{ route('admin.contenus.rejeter', $contenu->id_contenu) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger w-100">
                                                        <i class="bi bi-x-circle me-1"></i> Rejeter ce contenu
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer avec boutons d'action -->
                <div class="card-footer bg-light border-top py-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('admin.contenus.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                            </a>
                        </div>
                        <div class="btn-group">
                            @if($canDelete)
                                <button type="button"
                                        class="btn btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                    <i class="bi bi-trash me-1"></i> Supprimer
                                </button>
                            @endif

                            <a href="{{ route('admin.contenus.edit', $contenu->id_contenu) }}"
                               class="btn btn-primary">
                                <i class="bi bi-pencil me-1"></i> Modifier
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
@if($canDelete)
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i> Supprimer le contenu
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce contenu ?</p>
                <p><strong>{{ $contenu->titre }}</strong></p>

                @if($contenu->medias->count() > 0)
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        <strong>Attention :</strong>
                        {{ $contenu->medias->count() }} média(s) associé(s) seront également supprimé(s).
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('admin.contenus.destroy', $contenu->id_contenu) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('styles')
<style>
.content-text {
    line-height: 1.6;
    font-size: 1.1rem;
}
.content-text p {
    margin-bottom: 1rem;
}
.table-sm td {
    padding: 0.5rem;
    vertical-align: middle;
}
.badge {
    font-size: 0.9em;
}
</style>
@endsection

