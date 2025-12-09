@extends('layouts.layout')

@section('page-title', 'Détails du Média')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-eye-fill me-2"></i> Détails du Média
                    </h4>
                    <a href="{{ route('admin.medias.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Aperçu du média -->
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="bi bi-image me-2"></i>Aperçu</h5>
                                </div>
                                <div class="card-body text-center">
                                    @if($media->id_type_media == 1) {{-- Image --}}
                                        <img src="{{ asset('adminlte/img/' . $media->chemin) }}"
                                             class="img-fluid rounded border"
                                             style="max-height: 300px; object-fit: cover;"
                                             alt="{{ $media->description }}"
                                             onerror="this.style.display='none'; document.getElementById('mediaFallback').style.display='flex';">
                                        <div id="mediaFallback" class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto mt-2"
                                             style="width: 200px; height: 150px; display: none;">
                                            <i class="bi bi-image text-muted display-4"></i>
                                        </div>
                                    @elseif($media->id_type_media == 2) {{-- Vidéo --}}
                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto"
                                             style="width: 200px; height: 150px;">
                                            <i class="bi bi-play-circle text-primary display-4"></i>
                                        </div>
                                        <p class="mt-2 text-muted">Vidéo</p>
                                    @elseif($media->id_type_media == 3) {{-- Audio --}}
                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto"
                                             style="width: 200px; height: 150px;">
                                            <i class="bi bi-music-note text-success display-4"></i>
                                        </div>
                                        <p class="mt-2 text-muted">Audio</p>
                                    @else
                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto"
                                             style="width: 200px; height: 150px;">
                                            <i class="bi bi-file-earmark text-secondary display-4"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Informations -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informations</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Fichier</label>
                                        <p class="form-control-plaintext bg-light rounded p-2">
                                            <code>{{ $media->chemin }}</code><br>
                                            <a href="{{ asset('adminlte/img/' . $media->chemin) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-primary mt-1">
                                                <i class="bi bi-download"></i> Télécharger
                                            </a>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Type</label>
                                        <p>
                                            <span class="badge
                                                @if($media->id_type_media == 1) bg-info
                                                @elseif($media->id_type_media == 2) bg-primary
                                                @elseif($media->id_type_media == 3) bg-success
                                                @else bg-secondary @endif">
                                                {{ $media->typeMedia->nom_type_media ?? 'Non défini' }}
                                            </span>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Description</label>
                                        <p class="form-control-plaintext bg-light rounded p-2">
                                            {{ $media->description ?? 'Aucune description' }}
                                        </p>
                                    </div>

                                    @if($media->contenu)
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Contenu associé</label>
                                        <div class="bg-light rounded p-2">
                                            <strong>{{ $media->contenu->titre }}</strong><br>
                                            <a href="{{ route('admin.contenus.show', $media->contenu->id_contenu) }}"
                                               class="btn btn-sm btn-link p-0">
                                                <small>Voir le contenu</small>
                                            </a>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Date de création</label>
                                        <p>{{ $media->created_at ? $media->created_at->format('d/m/Y H:i') : 'N/A' }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Dernière modification</label>
                                        <p>{{ $media->updated_at ? $media->updated_at->format('d/m/Y H:i') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                        <div>
                            <a href="{{ route('admin.medias.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i> Retour
                            </a>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('admin.medias.edit', $media->id_media) }}"
                               class="btn btn-warning">
                                <i class="bi bi-pencil me-2"></i> Modifier
                            </a>
                            <form action="{{ route('admin.medias.destroy', $media->id_media) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Supprimer ce média ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash me-2"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
