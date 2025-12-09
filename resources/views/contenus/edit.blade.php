{{-- resources/views/contenus/edit.blade.php --}}
@extends('layouts.layout')

@section('page-title', 'Modifier le Contenu')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-pencil-square me-2"></i> Modifier le Contenu
                    </h4>
                    <a href="{{ route('admin.contenus.index') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.contenus.update', $contenu->id_contenu) }}" method="POST" enctype="multipart/form-data" id="updateForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Informations de base -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informations du contenu</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Titre <span class="text-danger">*</span></label>
                                            <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre', $contenu->titre) }}" required>
                                            @error('titre')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Description</label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $contenu->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Contenu détaillé <span class="text-danger">*</span></label>
                                            <textarea name="texte" class="form-control @error('texte') is-invalid @enderror" rows="8" required>{{ old('texte', $contenu->texte) }}</textarea>
                                            @error('texte')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Métadonnées -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-tags me-2"></i>Classification</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Type de contenu <span class="text-danger">*</span></label>
                                            <select name="id_type_contenu" class="form-select @error('id_type_contenu') is-invalid @enderror" required>
                                                <option value="">Sélectionnez un type</option>
                                                @foreach ($typesContenu as $type)
                                                    <option value="{{ $type->id_type_contenu }}" {{ old('id_type_contenu', $contenu->id_type_contenu) == $type->id_type_contenu ? 'selected' : '' }}>
                                                        {{ $type->nom_contenu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_type_contenu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Région <span class="text-danger">*</span></label>
                                            <select name="id_region" class="form-select @error('id_region') is-invalid @enderror" required>
                                                <option value="">Sélectionnez une région</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id_region }}" {{ old('id_region', $contenu->id_region) == $region->id_region ? 'selected' : '' }}>
                                                        {{ $region->nom_region }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_region')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Langue <span class="text-danger">*</span></label>
                                            <select name="id_langue" class="form-select @error('id_langue') is-invalid @enderror" required>
                                                <option value="">Sélectionnez une langue</option>
                                                @foreach ($langues as $langue)
                                                    <option value="{{ $langue->id_langue }}" {{ old('id_langue', $contenu->id_langue) == $langue->id_langue ? 'selected' : '' }}>
                                                        {{ $langue->nom_langue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_langue')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        @if (auth()->user()->isAdmin() || auth()->user()->isModerator())
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Statut</label>
                                                <select name="statut" class="form-select @error('statut') is-invalid @enderror">
                                                    <option value="en attente" {{ old('statut', $contenu->statut) == 'en attente' ? 'selected' : '' }}>En attente</option>
                                                    <option value="validé" {{ old('statut', $contenu->statut) == 'validé' ? 'selected' : '' }}>Validé</option>
                                                    <option value="rejeté" {{ old('statut', $contenu->statut) == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                                                </select>
                                                @error('statut')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @else
                                            <input type="hidden" name="statut" value="{{ $contenu->statut }}">
                                        @endif
                                    </div>
                                </div>

                                <!-- Média actuel -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-file-earmark me-2"></i>Média Actuel</h5>
                                    </div>
                                    <div class="card-body">
                                        @if ($contenu->medias && $contenu->medias->count() > 0)
                                            @php
                                                $media = $contenu->medias->first();
                                                $isVideo = $media->id_type_media == 2;
                                                $isAudio = $media->id_type_media == 3;
                                                $filePath = asset($media->chemin);
                                            @endphp

                                            <div class="text-center mb-3">
                                                @if ($isVideo)
                                                    <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto" style="width: 200px; height: 150px;">
                                                        <i class="bi bi-play-circle text-primary fs-1"></i>
                                                    </div>
                                                    <small class="text-muted d-block mt-2">Vidéo actuelle</small>
                                                @elseif($isAudio)
                                                    <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto" style="width: 200px; height: 150px;">
                                                        <i class="bi bi-music-note-beamed text-success fs-1"></i>
                                                    </div>
                                                    <small class="text-muted d-block mt-2">Audio actuel</small>
                                                @else
                                                    <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto" style="width: 200px; height: 150px;">
                                                        <i class="bi bi-image text-muted fs-1"></i>
                                                    </div>
                                                    <small class="text-muted d-block mt-2">Image actuelle</small>
                                                @endif
                                            </div>

                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="checkbox" name="remove_media" id="remove_media" value="1">
                                                <label class="form-check-label text-danger" for="remove_media">
                                                    <i class="bi bi-trash me-1"></i> Supprimer le média actuel
                                                </label>
                                            </div>
                                        @else
                                            <div class="text-center text-muted py-4">
                                                <i class="bi bi-file-earmark-x fs-1"></i>
                                                <p class="mt-2 mb-0">Aucun média associé</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Nouveau média -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-file-earmark-arrow-up me-2"></i>Nouveau Média (Optionnel)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Fichier média</label>
                                            <input type="file" name="media_file" id="media_file" class="form-control @error('media_file') is-invalid @enderror">
                                            @error('media_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <div class="form-text mt-2">
                                                <strong>Formats acceptés :</strong><br>
                                                • Images: JPG, PNG, GIF<br>
                                                • Vidéos: MP4, AVI, MOV<br>
                                                • Audio: MP3, WAV<br>
                                                <strong>⚠️ Max 100MB</strong>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Description du média (optionnel)</label>
                                            <textarea name="media_description" class="form-control" rows="2" placeholder="Description du fichier...">{{ old('media_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 justify-content-end pt-4 border-top">
                            <a href="{{ route('admin.contenus.index') }}" class="btn btn-secondary btn-lg px-4">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4 shadow" id="submitBtn">
                                <i class="bi bi-check-circle me-2"></i> Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mediaFileInput = document.getElementById('media_file');
    const removeMediaCheckbox = document.getElementById('remove_media');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('updateForm');

    // Gérer la case à cocher
    if (removeMediaCheckbox) {
        removeMediaCheckbox.addEventListener('change', function() {
            if (this.checked) {
                mediaFileInput.disabled = true;
                mediaFileInput.value = '';
            } else {
                mediaFileInput.disabled = false;
            }
        });
    }

    // Validation du formulaire
    form.addEventListener('submit', function(e) {
        const titre = document.querySelector('input[name="titre"]').value.trim();
        const texte = document.querySelector('textarea[name="texte"]').value.trim();
        const idTypeContenu = document.querySelector('select[name="id_type_contenu"]').value;
        const idRegion = document.querySelector('select[name="id_region"]').value;
        const idLangue = document.querySelector('select[name="id_langue"]').value;
        const mediaFile = mediaFileInput.files[0];

        // Validation des champs requis
        let errors = [];

        if (!titre) errors.push('Le titre est requis');
        if (!texte) errors.push('Le contenu détaillé est requis');
        if (!idTypeContenu) errors.push('Le type de contenu est requis');
        if (!idRegion) errors.push('La région est requise');
        if (!idLangue) errors.push('La langue est requise');

        if (errors.length > 0) {
            e.preventDefault();
            alert('❌ Erreurs :\n' + errors.join('\n'));
            return false;
        }

        // Vérifier la taille du fichier si fourni
        if (mediaFile && !removeMediaCheckbox.checked) {
            const maxSize = 100 * 1024 * 1024;
            if (mediaFile.size > maxSize) {
                e.preventDefault();
                alert('❌ Fichier trop volumineux (' + (mediaFile.size/1024/1024).toFixed(2) + 'MB). Maximum: 100MB');
                return false;
            }
        }

        // Afficher l'indicateur de chargement
        submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Mise à jour...';
        submitBtn.disabled = true;
    });
});

// Style pour le spinner
var style = document.createElement('style');
style.textContent = '.spinner { animation: spin 1s linear infinite; } @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }';
document.head.appendChild(style);
</script>
@endsection
