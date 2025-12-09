@extends('layouts.layout')

@section('page-title', 'Gestion des Médias')

@section('content')
<main class="app-main bg-light min-vh-100">
    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-collection-play"></i> Gestion des Médias
            </h3>
            <a href="{{ route('medias.create') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle"></i> Ajouter un média
            </a>
        </div>

        <!-- Messages -->
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

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                @if($medias->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Prévisualisation</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Contenu</th>
                                    <th>Fichier</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($medias as $media)
                                <tr>
                                    <td><strong>#{{ $media->id_media }}</strong></td>
                                    <td>
                                        @if($media->id_type_media == 1) {{-- Image --}}
                                            <img src="{{ asset('adminlte/img/' . $media->chemin) }}"
                                                 width="80" height="60"
                                                 class="rounded border"
                                                 style="object-fit: cover;"
                                                 alt="{{ $media->description }}"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                                 style="width: 80px; height: 60px; display: none;">
                                                <i class="bi bi-image text-muted fs-3"></i>
                                            </div>
                                        @elseif($media->id_type_media == 2) {{-- Vidéo --}}
                                            <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                                 style="width: 80px; height: 60px;">
                                                <i class="bi bi-play-circle text-primary fs-3"></i>
                                            </div>
                                        @elseif($media->id_type_media == 3) {{-- Audio --}}
                                            <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                                 style="width: 80px; height: 60px;">
                                                <i class="bi bi-music-note text-success fs-3"></i>
                                            </div>
                                        @else
                                            <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                                 style="width: 80px; height: 60px;">
                                                <i class="bi bi-file-earmark text-secondary fs-3"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($media->description, 50) ?: 'Sans description' }}</td>
                                    <td>
                                        <span class="badge
                                            @if($media->id_type_media == 1) bg-success
                                            @elseif($media->id_type_media == 2) bg-primary
                                            @elseif($media->id_type_media == 3) bg-warning text-dark
                                            @else bg-secondary @endif">
                                            {{ $media->typeMedia->nom_type_media ?? 'Non défini' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($media->contenu)
                                            <span class="badge bg-info" title="{{ $media->contenu->titre }}">
                                                {{ Str::limit($media->contenu->titre, 20) }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">Non associé</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ Str::limit($media->chemin, 20) }}</small><br>
                                        <a href="{{ asset('adminlte/img/' . $media->chemin) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-link p-0">
                                            <small><i class="bi bi-download"></i> Télécharger</small>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('medias.show', $media->id_media) }}"
                                               class="btn btn-outline-info"
                                               title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('medias.edit', $media->id_media) }}"
                                               class="btn btn-outline-warning"
                                               title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('medias.destroy', $media->id_media) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Supprimer ce média ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-collection display-1 text-muted"></i>
                        <h4 class="text-muted mt-3">Aucun média trouvé</h4>
                        <a href="{{ route('medias.create') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Ajouter un média
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
