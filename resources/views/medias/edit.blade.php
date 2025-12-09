@extends('layouts.layout')

@section('page-title', 'Modifier le Média')

@section('content')
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
                                        @if($media->id_type_media == 1) {{-- Image --}}
                                            <img src="{{ asset('adminlte/img/' . $media->chemin) }}"
                                                 class="img-fluid rounded border mb-3"
                                                 style="max-height: 150px; object-fit: cover;"
                                                 alt="Image actuelle"
                                                 onerror="this.style.display='none'; document.getElementById('currentMediaFallback').style.display='flex';">
                                            <div id="currentMediaFallback" class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto"
                                                 style="width: 150px; height: 100px; display: none;">
                                                <i class="bi bi-image text-muted fs-1"></i>
                                            </div>
                                        @elseif($media->id_type_media == 2) {{-- Vidéo --}}
                                            <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto"
                                                 style="width: 150px; height: 100px;">
                                                <i class="bi bi-play-circle text-primary fs-1"></i>
                                            </div>
                                            <p class="text-muted mt-2">Vidéo</p>
                                        @elseif($media->id_type_media == 3) {{-- Audio --}}
                                            <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto"
                                                 style="width: 150px; height: 100px;">
                                                <i class="bi bi-music-note text-success fs-1"></i>
                                            </div>
                                            <p class="text-muted mt-2">Audio</p>
                                        @else
                                            <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto"
                                                 style="width: 150px; height: 100px;">
                                                <i class="bi bi-file-earmark text-secondary fs-1"></i>
                                            </div>
                                        @endif

                                        <div class="mt-3">
                                            <small class="text-muted">{{ $media->chemin }}</small>
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
@endsection
