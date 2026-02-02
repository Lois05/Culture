@extends('layouts.layout')

@section('page-title', 'Modifier le Média')

@section('content')
@php
use App\Helpers\ImageHelper;
$fileUrl = ImageHelper::content($media->chemin);
$isImage = $media->typeMedia && $media->typeMedia->id_type_media == 1;
$isVideo = $media->typeMedia && $media->typeMedia->id_type_media == 2;
$isAudio = $media->typeMedia && $media->typeMedia->id_type_media == 3;
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-pencil-square me-2"></i> Modifier le Média
                    </h4>
                    <a href="{{ route('admin.medias.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.medias.update', $media->id_media) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Informations de base -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informations du média</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Description</label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                                      rows="4" placeholder="Description du média...">{{ old('description', $media->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Type de média <span class="text-danger">*</span></label>
                                            <select name="id_type_media" class="form-select @error('id_type_media') is-invalid @enderror" required>
                                                <option value="">Sélectionnez un type</option>
                                                @foreach($typesMedia as $type)
                                                    <option value="{{ $type->id_type_media }}"
                                                        {{ old('id_type_media', $media->id_type_media) == $type->id_type_media ? 'selected' : '' }}>
                                                        {{ $type->nom_type_media }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_type_media')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Contenu associé</label>
                                            <select name="id_contenu" class="form-select @error('id_contenu') is-invalid @enderror">
                                                <option value="">Aucun contenu associé</option>
                                                @foreach($contenus as $contenu)
                                                    <option value="{{ $contenu->id_contenu }}"
                                                        {{ old('id_contenu', $media->id_contenu) == $contenu->id_contenu ? 'selected' : '' }}>
                                                        {{ $contenu->titre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_contenu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Média actuel -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-image me-2"></i>Média actuel</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        @if($isImage)
                                            <!-- Image -->
                                            <div class="media-preview mb-3">
                                                <img src="{{ $fileUrl }}"
                                                     class="img-fluid rounded border"
                                                     style="max-height: 150px; max-width: 100%; object-fit: contain;"
                                                     alt="Image actuelle"
                                                     onerror="this.style.display='none'; document.getElementById('currentMediaFallback').style.display='flex';">
                                                <div id="currentMediaFallback"
                                                     class="bg-light rounded border d-flex flex-column align-items-center justify-content-center mx-auto"
                                                     style="width: 150px; height: 150px; display: none;">
                                                    <i class="bi bi-image text-muted fs-1"></i>
                                                    <small class="text-muted mt-1">Image non chargée</small>
                                                </div>
                                            </div>
                                        @elseif($isVideo)
                                            <!-- Vidéo -->
                                            <div class="bg-dark rounded border d-flex flex-column align-items-center justify-content-center mx-auto mb-3"
                                                 style="width: 150px; height: 150px;">
                                                <i class="bi bi-play-circle text-white fs-1"></i>
                                                <small class="text-white mt-1">Vidéo</small>
                                            </div>
                                        @elseif($isAudio)
                                            <!-- Audio -->
                                            <div class="bg-secondary rounded border d-flex flex-column align-items-center justify-content-center mx-auto mb-3"
                                                 style="width: 150px; height: 150px;">
                                                <i class="bi bi-music-note-beamed text-white fs-1"></i>
                                                <small class="text-white mt-1">Audio</small>
                                            </div>
                                        @else
                                            <!-- Type inconnu -->
                                            <div class="bg-light rounded border d-flex flex-column align-items-center justify-content-center mx-auto mb-3"
                                                 style="width: 150px; height: 150px;">
                                                <i class="bi bi-file-earmark text-secondary fs-1"></i>
                                                <small class="text-muted mt-1">Fichier</small>
                                            </div>
                                        @endif

                                        <div class="mt-2">
                                            <small class="text-muted d-block">{{ basename($media->chemin) }}</small>
                                            <small class="text-muted" style="font-size: 0.75rem;">{{ $media->chemin }}</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nouveau fichier -->
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-arrow-up-circle me-2"></i>Changer le fichier</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Nouveau fichier</label>
                                            <input type="file" name="media_file"
                                                   class="form-control @error('media_file') is-invalid @enderror"
                                                   accept=".jpg,.jpeg,.png,.gif,.webp,.mp4,.avi,.mov,.mkv,.webm,.mp3,.wav,.ogg,.aac">
                                            @error('media_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                Formats: Images, Vidéos, Audio (100MB max)
                                            </div>
                                        </div>

                                        <div class="alert alert-info">
                                            <i class="bi bi-info-circle me-2"></i>
                                            <small>Laissez vide pour conserver le fichier actuel.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 justify-content-end pt-4">
                            <a href="{{ route('admin.medias.index') }}" class="btn btn-secondary btn-lg px-4">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4 shadow">
                                <i class="bi bi-check-circle me-2"></i> Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview du nouveau fichier -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aperçu du nouveau fichier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewImage" src="" class="img-fluid" style="max-height: 70vh;">
                <video id="previewVideo" controls class="w-100 d-none" style="max-height: 70vh;"></video>
                <div id="previewAudio" class="d-none">
                    <audio controls class="w-100"></audio>
                    <div class="mt-3">
                        <i class="bi bi-music-note-beamed fs-1 text-primary"></i>
                    </div>
                </div>
                <div id="previewUnknown" class="d-none">
                    <i class="bi bi-file-earmark fs-1 text-muted"></i>
                    <p class="mt-2 text-muted">Prévisualisation non disponible</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Prévisualiser le fichier sélectionné
document.querySelector('input[name="media_file"]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const previewImage = document.getElementById('previewImage');
    const previewVideo = document.getElementById('previewVideo');
    const previewAudio = document.getElementById('previewAudio');
    const previewUnknown = document.getElementById('previewUnknown');

    // Cacher tous les prévisualisations
    previewImage.style.display = 'none';
    previewVideo.classList.add('d-none');
    previewAudio.classList.add('d-none');
    previewUnknown.classList.add('d-none');

    // Afficher la bonne prévisualisation
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else if (file.type.startsWith('video/')) {
        previewVideo.src = URL.createObjectURL(file);
        previewVideo.classList.remove('d-none');
    } else if (file.type.startsWith('audio/')) {
        const audio = previewAudio.querySelector('audio');
        audio.src = URL.createObjectURL(file);
        previewAudio.classList.remove('d-none');
    } else {
        previewUnknown.classList.remove('d-none');
    }

    // Afficher le modal
    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    modal.show();
});
</script>

<style>
.media-preview {
    position: relative;
    min-height: 150px;
}

#currentMediaFallback {
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
}
</style>
@endsection
