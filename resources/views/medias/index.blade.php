@extends('layouts.layout')

@section('page-title', 'Gestion des Médias')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-images me-2"></i> Tous les Médias
                    </h4>
                    <div>
                        <a href="{{ route('admin.medias.create') }}" class="btn btn-light">
                            <i class="bi bi-upload me-1"></i> Uploader un média
                        </a>
                        <button class="btn btn-outline-light ms-2" onclick="toggleViewMode()">
                            <i class="bi bi-grid" id="viewIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Statistiques -->
                    <div class="row mb-4">
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h2 class="mb-0">{{ $medias->count() }}</h2>
                                    <small>Total médias</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h2 class="mb-0">{{ $medias->where('id_type_media', 1)->count() }}</h2>
                                    <small>Images</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <h2 class="mb-0">{{ $medias->where('id_type_media', 2)->count() }}</h2>
                                    <small>Vidéos</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card bg-warning text-dark">
                                <div class="card-body text-center">
                                    <h2 class="mb-0">{{ $medias->where('id_type_media', 3)->count() }}</h2>
                                    <small>Audios</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filtres -->
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <select class="form-select" id="filterType">
                                        <option value="">Tous les types</option>
                                        <option value="1">Images</option>
                                        <option value="2">Vidéos</option>
                                        <option value="3">Audios</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <select class="form-select" id="filterContenu">
                                        <option value="">Tous les contenus</option>
                                        @if(isset($contenus) && $contenus->count() > 0)
                                            @foreach($contenus as $contenu)
                                                <option value="{{ $contenu->id_contenu }}">{{ $contenu->titre }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>Aucun contenu disponible</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <input type="text" class="form-control" id="searchMedia" placeholder="Rechercher par nom...">
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($medias->count() > 0)
                        <!-- Vue grille (défaut) -->
                        <div id="gridView" class="row">
                            @foreach($medias as $media)
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4 media-card"
                                     data-type="{{ $media->id_type_media }}"
                                     data-contenu="{{ $media->id_contenu }}"
                                     data-name="{{ strtolower($media->chemin) }}">
                                    <div class="card h-100 shadow-sm border-0">
                                        <!-- En-tête avec badges -->
                                        <div class="card-header bg-transparent border-bottom-0 pt-3 pb-2">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <span class="badge bg-secondary">
                                                    #{{ $media->id_media }}
                                                </span>
                                                <span class="badge
                                                    @if($media->id_type_media == 1) bg-success
                                                    @elseif($media->id_type_media == 2) bg-danger
                                                    @else bg-warning text-dark
                                                    @endif">
                                                    @if($media->id_type_media == 1) <i class="bi bi-image me-1"></i> Image
                                                    @elseif($media->id_type_media == 2) <i class="bi bi-play-circle me-1"></i> Vidéo
                                                    @else <i class="bi bi-music-note-beamed me-1"></i> Audio
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Aperçu du média -->
                                        <div class="text-center p-3" style="height: 180px; cursor: pointer;"
                                             onclick="previewMedia('{{ $media->id_media }}')">
                                            @php
                                                $fileUrl = asset('adminlte/img/' . $media->chemin);
                                                $filePath = public_path('adminlte/img/' . $media->chemin);
                                                $fileExists = file_exists($filePath);
                                            @endphp

                                            @if($media->id_type_media == 1) {{-- Image --}}
                                                @if($fileExists)
                                                    <img src="{{ $fileUrl }}"
                                                         class="img-fluid rounded border"
                                                         style="max-height: 140px; max-width: 100%; object-fit: contain;"
                                                         alt="{{ $media->description }}"
                                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                @endif

                                                <div class="bg-light rounded border d-flex flex-column align-items-center justify-content-center h-100 {{ $fileExists ? 'd-none' : '' }}">
                                                    <i class="bi bi-image text-muted fs-1 mb-2"></i>
                                                    <small class="text-muted text-center px-2">{{ Str::limit($media->chemin, 20) }}</small>
                                                </div>

                                            @elseif($media->id_type_media == 2) {{-- Vidéo --}}
                                                <div class="bg-dark rounded border d-flex flex-column align-items-center justify-content-center h-100">
                                                    <i class="bi bi-play-circle text-white fs-1 mb-2"></i>
                                                    <span class="text-white">Vidéo</span>
                                                    <small class="text-white-50">{{ Str::limit($media->chemin, 20) }}</small>
                                                </div>
                                            @else {{-- Audio --}}
                                                <div class="bg-secondary rounded border d-flex flex-column align-items-center justify-content-center h-100">
                                                    <i class="bi bi-music-note-beamed text-white fs-1 mb-2"></i>
                                                    <span class="text-white">Audio</span>
                                                    <small class="text-white-50">{{ Str::limit($media->chemin, 20) }}</small>
                                                </div>
                                            @endif

                                            @if(!$fileExists)
                                                <div class="position-absolute top-0 end-0 m-2">
                                                    <span class="badge bg-danger" title="Fichier manquant">
                                                        <i class="bi bi-exclamation-triangle"></i>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Informations du média -->
                                        <div class="card-body pt-0">
                                            <h6 class="card-title mb-2" title="{{ $media->chemin }}">
                                                <i class="bi bi-file-earmark me-1"></i>
                                                {{ Str::limit($media->chemin, 25) }}
                                            </h6>

                                            <p class="card-text small text-muted mb-2">
                                                {{ $media->description ? Str::limit($media->description, 60) : 'Aucune description' }}
                                            </p>

                                            <!-- Contenu associé -->
                                            @if($media->contenu)
                                                <div class="border-top pt-2 mt-2">
                                                    <p class="small mb-1">
                                                        <strong><i class="bi bi-link-45deg me-1"></i> Contenu :</strong>
                                                    </p>
                                                    <div class="d-flex flex-wrap gap-1">
                                                        <a href="{{ route('admin.contenus.show', $media->contenu->id_contenu) }}"
                                                           class="badge bg-info text-white border-0 text-decoration-none"
                                                           title="{{ $media->contenu->titre }}">
                                                            <i class="bi bi-file-text me-1"></i>
                                                            {{ Str::limit($media->contenu->titre, 15) }}
                                                        </a>
                                                        <span class="badge bg-light text-dark border">
                                                            {{ $media->contenu->typeContenu->nom_contenu ?? 'Type' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="border-top pt-2 mt-2">
                                                    <span class="badge bg-secondary">
                                                        <i class="bi bi-unlink me-1"></i> Aucun contenu associé
                                                    </span>
                                                </div>
                                            @endif

                                            <!-- Date -->
                                            <div class="small text-muted mt-2">
                                                <i class="bi bi-calendar me-1"></i>
                                                {{ $media->created_at->format('d/m/Y') }}
                                                <span class="ms-2">
                                                    <i class="bi bi-clock me-1"></i>
                                                    {{ $media->created_at->format('H:i') }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="card-footer bg-transparent border-top-0 pt-0">
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-sm btn-outline-primary"
                                                        onclick="previewMedia('{{ $media->id_media }}')"
                                                        title="Prévisualiser">
                                                    <i class="bi bi-eye"></i>
                                                </button>

                                                <a href="{{ route('admin.medias.edit', $media->id_media) }}"
                                                   class="btn btn-sm btn-outline-warning"
                                                   title="Modifier">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                @if($media->contenu)
                                                    <a href="{{ route('admin.contenus.show', $media->contenu->id_contenu) }}"
                                                       class="btn btn-sm btn-outline-info"
                                                       title="Voir le contenu">
                                                        <i class="bi bi-link-45deg"></i>
                                                    </a>
                                                @endif

                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $media->id_media }}"
                                                        title="Supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal de suppression -->
                                <div class="modal fade" id="deleteModal{{ $media->id_media }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                                    Supprimer le média
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Êtes-vous sûr de vouloir supprimer ce média ?</p>
                                                <p><strong>{{ $media->chemin }}</strong></p>

                                                @if($media->contenu)
                                                    <div class="alert alert-warning">
                                                        <i class="bi bi-exclamation-circle me-1"></i>
                                                        <strong>Attention :</strong> Ce média est associé au contenu :
                                                        <br>
                                                        <strong>"{{ $media->contenu->titre }}"</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <form action="{{ route('admin.medias.destroy', $media->id_media) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash me-1"></i> Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Vue tableau (caché par défaut) -->
                        <div id="tableView" class="table-responsive" style="display: none;">
                            <table class="table table-striped table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Fichier</th>
                                        <th>Description</th>
                                        <th>Contenu associé</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($medias as $media)
                                    <tr>
                                        <td><span class="badge bg-secondary">#{{ $media->id_media }}</span></td>
                                        <td>
                                            <span class="badge
                                                @if($media->id_type_media == 1) bg-success
                                                @elseif($media->id_type_media == 2) bg-danger
                                                @else bg-warning text-dark
                                                @endif">
                                                @if($media->id_type_media == 1) Image
                                                @elseif($media->id_type_media == 2) Vidéo
                                                @else Audio
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <code>{{ $media->chemin }}</code>
                                        </td>
                                        <td>{{ Str::limit($media->description, 50) }}</td>
                                        <td>
                                            @if($media->contenu)
                                                <a href="{{ route('admin.contenus.show', $media->contenu->id_contenu) }}">
                                                    {{ Str::limit($media->contenu->titre, 30) }}
                                                </a>
                                            @else
                                                <span class="text-muted">Aucun</span>
                                            @endif
                                        </td>
                                        <td>{{ $media->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.medias.show', $media->id_media) }}" class="btn btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.medias.edit', $media->id_media) }}" class="btn btn-outline-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $media->id_media }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-images display-1 text-muted"></i>
                            <h3 class="mt-3 text-muted">Aucun média trouvé</h3>
                            <p class="text-muted">Commencez par uploader votre premier média</p>
                            <a href="{{ route('admin.medias.create') }}" class="btn btn-primary">
                                <i class="bi bi-upload me-1"></i> Uploader un média
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de prévisualisation -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div id="previewContent"></div>
            </div>
            <div class="modal-footer">
                <a id="previewDownload" href="#" class="btn btn-primary" download>
                    <i class="bi bi-download me-1"></i> Télécharger
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let isGridView = true;

// Changer entre vue grille et tableau
function toggleViewMode() {
    const gridView = document.getElementById('gridView');
    const tableView = document.getElementById('tableView');
    const viewIcon = document.getElementById('viewIcon');

    if (isGridView) {
        // Passer en vue tableau
        gridView.style.display = 'none';
        tableView.style.display = 'block';
        viewIcon.className = 'bi bi-list';
        isGridView = false;
    } else {
        // Passer en vue grille
        tableView.style.display = 'none';
        gridView.style.display = 'flex';
        viewIcon.className = 'bi bi-grid';
        isGridView = true;
    }
}

// Filtrer les médias
document.addEventListener('DOMContentLoaded', function() {
    const filterType = document.getElementById('filterType');
    const filterContenu = document.getElementById('filterContenu');
    const searchMedia = document.getElementById('searchMedia');
    const mediaCards = document.querySelectorAll('.media-card');

    function filterMedia() {
        const typeValue = filterType.value;
        const contenuValue = filterContenu.value;
        const searchValue = searchMedia.value.toLowerCase();

        mediaCards.forEach(card => {
            const cardType = card.getAttribute('data-type');
            const cardContenu = card.getAttribute('data-contenu');
            const cardName = card.getAttribute('data-name');

            const typeMatch = !typeValue || cardType === typeValue;
            const contenuMatch = !contenuValue || cardContenu === contenuValue;
            const searchMatch = !searchValue || cardName.includes(searchValue);

            if (typeMatch && contenuMatch && searchMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    if (filterType) filterType.addEventListener('change', filterMedia);
    if (filterContenu) filterContenu.addEventListener('change', filterMedia);
    if (searchMedia) searchMedia.addEventListener('input', filterMedia);
});

// Prévisualiser un média
function previewMedia(mediaId) {
    // Récupérer les données du média (vous pourriez faire un appel AJAX ici)
    const card = document.querySelector(`[data-media-id="${mediaId}"]`);
    if (!card) return;

    const title = card.getAttribute('data-title');
    const type = card.getAttribute('data-type');
    const fileUrl = card.getAttribute('data-url');

    document.getElementById('previewTitle').textContent = title;
    document.getElementById('previewDownload').href = fileUrl;
    document.getElementById('previewDownload').download = title;

    const previewContent = document.getElementById('previewContent');
    previewContent.innerHTML = '';

    if (type === '1') {
        // Image
        const img = document.createElement('img');
        img.src = fileUrl;
        img.className = 'img-fluid';
        img.style.maxHeight = '70vh';
        img.onerror = function() {
            previewContent.innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    L'image n'a pas pu être chargée
                </div>
            `;
        };
        previewContent.appendChild(img);
    } else if (type === '2') {
        // Vidéo
        const video = document.createElement('video');
        video.src = fileUrl;
        video.controls = true;
        video.className = 'w-100';
        video.style.maxHeight = '70vh';
        previewContent.appendChild(video);
    } else {
        // Audio
        const audio = document.createElement('audio');
        audio.src = fileUrl;
        audio.controls = true;
        audio.className = 'w-100';
        previewContent.appendChild(audio);
    }

    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    modal.show();
}

// Ajouter les attributs de données aux cartes pour la prévisualisation
document.querySelectorAll('.media-card').forEach(card => {
    const mediaId = card.querySelector('.badge.bg-secondary')?.textContent.replace('#', '') || '';
    const title = card.querySelector('.card-title')?.textContent.trim() || '';
    const type = card.getAttribute('data-type');

    // Trouver l'URL du fichier
    let fileUrl = '';
    const img = card.querySelector('img');
    if (img && img.src) {
        fileUrl = img.src;
    } else {
        // Construire l'URL à partir du nom du fichier
        const fileName = card.querySelector('.card-title')?.textContent.trim() || '';
        if (fileName) {
            fileUrl = '{{ url("/") }}/adminlte/img/' + fileName;
        }
    }

    if (mediaId) {
        card.setAttribute('data-media-id', mediaId);
        card.setAttribute('data-title', title);
        card.setAttribute('data-type', type);
        card.setAttribute('data-url', fileUrl);
    }
});
</script>

<style>
.media-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.media-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.card {
    transition: all 0.3s;
}
.card:hover {
    border-color: #0d6efd;
}

.badge {
    font-size: 0.75rem;
}

.media-thumbnail {
    cursor: pointer;
    transition: all 0.3s;
}
.media-thumbnail:hover {
    opacity: 0.9;
}

/* Style pour les images qui échouent au chargement */
img[onerror] {
    min-height: 140px;
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
}

/* Responsive */
@media (max-width: 768px) {
    .media-card {
        margin-bottom: 1rem;
    }
    .card-body {
        padding: 0.75rem;
    }
}
</style>
@endsection

