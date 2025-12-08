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
                                        <img src="{{ asset('storage/' . $media->chemin) }}"
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
                                        <p class="mt-2 text-muted">Vidéo: {{ basename($media->chemin) }}</p>
                                    @elseif($media->id_type_media == 3) {{-- Audio --}}
                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto"
                                             style="width: 200px; height: 150px;">
                                            <i class="bi bi-music-note text-success display-4"></i>
                                        </div>
                                        <p class="mt-2 text-muted">Audio: {{ basename($media->chemin) }}</p>
                                    @else
                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto"
                                             style="width: 200px; height: 150px;">
                                            <i class="bi bi-file-earmark text-secondary display-4"></i>
                                        </div>
                                        <p class="mt-2 text-muted">Fichier: {{ basename($media->chemin) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Informations du média -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informations</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Chemin du fichier</label>
                                        <p class="form-control-plaintext bg-light rounded p-2">
                                            <code>{{ $media->chemin }}</code>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Type de média</label>
                                        <p>
                                            <span class="badge
                                                @if($media->id_type_media == 1) bg-info
                                                @elseif($media->id_type_media == 2) bg-primary
                                                @elseif($media->id_type_media == 3) bg-success
                                                @else bg-secondary @endif">
                                                {{ $media->typeMedia->nom_media ?? 'Non défini' }}
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
                                            <strong>{{ $media->contenu->titre }}</strong>
                                            <br>
                                            <small class="text-muted">ID: {{ $media->contenu->id_contenu }}</small>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Date de création</label>
                                        <p class="form-control-plaintext">
                                            {{ $media->created_at ? $media->created_at->format('d/m/Y à H:i') : 'Non définie' }}
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Dernière modification</label>
                                        <p class="form-control-plaintext">
                                            {{ $media->updated_at ? $media->updated_at->format('d/m/Y à H:i') : 'Non définie' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                        <div>
                            <a href="{{ route('admin.medias.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i> Retour à la liste
                            </a>
                        </div>
                        <div class="btn-group">
                            
                            <form action="{{ route('admin.medias.destroy', $media->id_media) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-delete">
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
});
</script>
@endsection
