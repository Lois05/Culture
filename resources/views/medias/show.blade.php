@extends('layouts.layout')

@section('page-title', 'Détail du Média')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-3">
                <!-- Header -->
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="bi bi-images me-2"></i> Détail du Média
                        </h4>
                        <div>
                            <a href="{{ route('admin.medias.index') }}" class="btn btn-light btn-sm me-2">
                                <i class="bi bi-arrow-left me-1"></i> Retour
                            </a>
                            <a href="{{ route('admin.medias.edit', $media->id_media) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil me-1"></i> Modifier
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <!-- Colonne gauche : Aperçu du média -->
                        <div class="col-lg-6 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="bi bi-file-earmark me-2"></i> Aperçu
                                    </h5>
                                </div>
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    @php
                                        $isImage = $media->typeMedia && $media->typeMedia->id_type_media == 1;
                                        $isVideo = $media->typeMedia && $media->typeMedia->id_type_media == 2;
                                        $isAudio = $media->typeMedia && $media->typeMedia->id_type_media == 3;
                                        $filePath = public_path('adminlte/img/' . $media->chemin);
                                        $fileExists = file_exists($filePath);
                                        $fileUrl = asset('adminlte/img/' . $media->chemin);
                                    @endphp

                                    @if($isImage)
                                        @if($fileExists)
                                            <div class="text-center">
                                                <img src="{{ $fileUrl }}"
                                                     class="img-fluid rounded border"
                                                     style="max-height: 400px; object-fit: contain;"
                                                     alt="{{ $media->description }}"
                                                     onerror="this.onerror=null; this.src='{{ App\Helpers\CloudinaryHelper::static('placeholder.jpg') }}'">
                                                <div class="mt-3">
                                                    <a href="{{ $fileUrl }}"
                                                       target="_blank"
                                                       class="btn btn-outline-primary me-2">
                                                        <i class="bi bi-arrows-fullscreen me-1"></i> Agrandir
                                                    </a>
                                                    <button onclick="downloadMedia()" class="btn btn-outline-success">
                                                        <i class="bi bi-download me-1"></i> Télécharger
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-center py-5">
                                                <i class="bi bi-file-excel text-danger fs-1 mb-3"></i>
                                                <h5 class="text-danger">Fichier non trouvé</h5>
                                                <p class="text-muted">
                                                    <code>{{ $media->chemin }}</code>
                                                </p>
                                                <p class="text-muted small">
                                                    Chemin recherché : {{ $filePath }}
                                                </p>
                                            </div>
                                        @endif
                                    @elseif($isVideo)
                                        <div class="text-center w-100">
                                            <div class="bg-dark rounded p-5 mb-3">
                                                <i class="bi bi-play-circle text-white fs-1"></i>
                                            </div>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ $fileUrl }}"
                                                   target="_blank"
                                                   class="btn btn-primary">
                                                    <i class="bi bi-play-fill me-1"></i> Lire la vidéo
                                                </a>
                                                <button onclick="downloadMedia()" class="btn btn-outline-success">
                                                    <i class="bi bi-download me-1"></i> Télécharger
                                                </button>
                                            </div>
                                            @if($fileExists)
                                                <div class="mt-3 text-success">
                                                    <i class="bi bi-check-circle me-1"></i> Fichier disponible ({{ round(filesize($filePath) / 1024 / 1024, 2) }} MB)
                                                </div>
                                            @else
                                                <div class="mt-3 text-danger">
                                                    <i class="bi bi-exclamation-circle me-1"></i> Fichier manquant
                                                </div>
                                            @endif
                                        </div>
                                    @elseif($isAudio)
                                        <div class="text-center w-100">
                                            <div class="bg-secondary rounded p-5 mb-3">
                                                <i class="bi bi-music-note-beamed text-white fs-1"></i>
                                            </div>
                                            @if($fileExists)
                                                <audio controls class="w-100 mb-3">
                                                    <source src="{{ $fileUrl }}" type="audio/mpeg">
                                                    Votre navigateur ne supporte pas l'élément audio.
                                                </audio>
                                            @endif
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ $fileUrl }}"
                                                   target="_blank"
                                                   class="btn btn-primary">
                                                    <i class="bi bi-play-fill me-1"></i> Écouter
                                                </a>
                                                <button onclick="downloadMedia()" class="btn btn-outline-success">
                                                    <i class="bi bi-download me-1"></i> Télécharger
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Colonne droite : Informations détaillées -->
                        <div class="col-lg-6">
                            <!-- Informations de base -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="bi bi-info-circle me-2"></i> Informations du média
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <td width="40%"><strong>ID :</strong></td>
                                            <td><span class="badge bg-secondary">#{{ $media->id_media }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Type :</strong></td>
                                            <td>
                                                <span class="badge
                                                    @if($isImage) bg-success
                                                    @elseif($isVideo) bg-danger
                                                    @else bg-warning text-dark
                                                    @endif">
                                                    <i class="bi
                                                        @if($isImage) bi-image
                                                        @elseif($isVideo) bi-play-circle
                                                        @else bi-music-note-beamed
                                                        @endif me-1">
                                                    </i>
                                                    {{ $media->typeMedia->nom_type_media ?? 'Non défini' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nom du fichier :</strong></td>
                                            <td><code>{{ $media->chemin }}</code></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Chemin complet :</strong></td>
                                            <td>
                                                <small class="text-muted">{{ $filePath }}</small>
                                            </td>
                                        </tr>
                                        @if($fileExists)
                                            @php
                                                $size = filesize($filePath);
                                                $sizeFormatted = $size > 1024*1024
                                                    ? round($size / 1024 / 1024, 2) . ' MB'
                                                    : round($size / 1024, 2) . ' KB';
                                                $lastModified = filemtime($filePath);
                                            @endphp
                                            <tr>
                                                <td><strong>Taille :</strong></td>
                                                <td>{{ $sizeFormatted }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Date de création :</strong></td>
                                                <td>{{ $media->created_at ? $media->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Date modif fichier :</strong></td>
                                                <td>{{ date('d/m/Y H:i', $lastModified) }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="2" class="text-center text-danger">
                                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                                    Fichier physique non trouvé sur le serveur
                                                </td>
                                            </tr>
                                        @endif
                                    </table>

                                    <!-- Description -->
                                    <div class="mt-3">
                                        <label class="form-label"><strong>Description :</strong></label>
                                        <div class="border rounded p-3 bg-light">
                                            {{ $media->description ?? 'Aucune description' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contenu associé -->
                            @if($media->contenu)
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0">
                                        <i class="bi bi-link me-2"></i> Contenu associé
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                             style="width: 40px; height: 40px; font-size: 1rem;">
                                            <i class="bi bi-file-text"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">{{ $media->contenu->titre }}</h5>
                                            <div class="d-flex flex-wrap gap-1">
                                                <span class="badge bg-dark">
                                                    {{ $media->contenu->typeContenu->nom_contenu ?? 'Type' }}
                                                </span>
                                                <span class="badge bg-secondary">
                                                    {{ $media->contenu->langue->nom_langue ?? 'Langue' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <a href="{{ route('admin.contenus.show', $media->contenu->id_contenu) }}"
                                           class="btn btn-outline-info btn-sm me-2">
                                            <i class="bi bi-eye me-1"></i> Voir le contenu
                                        </a>
                                        <a href="{{ route('admin.contenus.edit', $media->contenu->id_contenu) }}"
                                           class="btn btn-outline-warning btn-sm">
                                            <i class="bi bi-pencil me-1"></i> Modifier le contenu
                                        </a>
                                    </div>

                                    <hr class="my-3">

                                    <div>
                                        <h6>Statut du contenu :</h6>
                                        @switch($media->contenu->statut)
                                            @case('validé')
                                                <span class="badge bg-success">Validé</span>
                                                @break
                                            @case('en attente')
                                                <span class="badge bg-warning text-dark">En attente</span>
                                                @break
                                            @case('rejeté')
                                                <span class="badge bg-danger">Rejeté</span>
                                                @break
                                        @endswitch

                                        @if($media->contenu->date_creation)
                                            <p class="mt-2 mb-0 small text-muted">
                                                <i class="bi bi-calendar me-1"></i>
                                                Créé le {{ \Carbon\Carbon::parse($media->contenu->date_creation)->format('d/m/Y') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="mb-0">
                                        <i class="bi bi-unlink me-2"></i> Aucun contenu associé
                                    </h5>
                                </div>
                                <div class="card-body text-center py-4">
                                    <i class="bi bi-link-slash text-muted fs-1 mb-3"></i>
                                    <p class="text-muted">Ce média n'est pas associé à un contenu</p>
                                    <a href="{{ route('admin.contenus.create') }}" class="btn btn-outline-primary">
                                        <i class="bi bi-plus-circle me-1"></i> Créer un nouveau contenu
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-light border-top py-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('admin.medias.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                            </a>
                        </div>
                        <div class="btn-group">
                            <button type="button"
                                    class="btn btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-1"></i> Supprimer
                            </button>
                            <a href="{{ route('admin.medias.edit', $media->id_media) }}"
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
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i> Supprimer le média
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce média ?</p>
                <p><strong>{{ $media->chemin }}</strong></p>

                @if($fileExists)
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-1"></i>
                        <strong>Fichier trouvé :</strong>
                        {{ round(filesize($filePath) / 1024 / 1024, 2) }} MB
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        <strong>Fichier manquant :</strong>
                        Le fichier physique n'existe plus sur le serveur.
                    </div>
                @endif

                @if($media->contenu)
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        <strong>Attention :</strong> Ce média est associé au contenu :
                        <br>
                        <strong>"{{ $media->contenu->titre }}"</strong>
                        <br>
                        Le contenu restera mais n'aura plus de média associé.
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('admin.medias.destroy', $media->id_media) }}" method="POST">
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
@endsection

@section('scripts')
<script>
function downloadMedia() {
    @php
        $fileUrl = asset('adminlte/img/' . $media->chemin);
    @endphp

    // Créer un lien de téléchargement temporaire
    const link = document.createElement('a');
    link.href = '{{ $fileUrl }}';
    link.download = '{{ $media->chemin }}';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>
@endsection

