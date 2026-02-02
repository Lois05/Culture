@extends('layouts.layout')

@section('page-title', 'Gestion des Médias')

@section('content')
@php
use App\Helpers\ImageHelper;
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-images me-2"></i> Tous les Médias
                        <span class="badge bg-light text-primary ms-2">{{ $medias->count() }}</span>
                    </h4>
                    <div>
                        <a href="{{ route('admin.medias.create') }}" class="btn btn-light btn-lg">
                            <i class="bi bi-upload me-2"></i> Uploader un média
                        </a>
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
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label small text-muted mb-1">Type de média</label>
                                    <select class="form-select" id="filterType">
                                        <option value="">Tous les types</option>
                                        <option value="1">Images</option>
                                        <option value="2">Vidéos</option>
                                        <option value="3">Audios</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small text-muted mb-1">Contenu associé</label>
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
                                <div class="col-md-3">
                                    <label class="form-label small text-muted mb-1">Statut fichier</label>
                                    <select class="form-select" id="filterStatus">
                                        <option value="">Tous les statuts</option>
                                        <option value="exists">Fichier présent</option>
                                        <option value="missing">Fichier manquant</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small text-muted mb-1">Recherche</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchInput" placeholder="Nom du fichier...">
                                        <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($medias->count() > 0)
                        <div class="table-responsive">
                            <table id="mediasTable" class="table table-hover align-middle w-100" style="font-size: 0.9rem;">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">ID</th>
                                        <th width="70">Aperçu</th>
                                        <th width="200">Fichier</th>
                                        <th width="100">Type</th>
                                        <th width="150">Description</th>
                                        <th width="150">Contenu associé</th>
                                        <th width="100">Taille</th>
                                        <th width="100">Statut</th>
                                        <th width="100">Date</th>
                                        <th width="120" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($medias as $media)
                                        @php
                                            // Récupérer l'URL du fichier
                                            $fileUrl = ImageHelper::content($media->chemin);
                                            $filePath = public_path('adminlte/img/' . $media->chemin);

                                            // Vérifier si c'est un chemin local
                                            $isLocalPath = !filter_var($media->chemin, FILTER_VALIDATE_URL) &&
                                                          !str_starts_with($media->chemin, 'http') &&
                                                          !str_contains($media->chemin, 'cloudinary');

                                            // Vérifier l'existence du fichier
                                            $fileExists = $isLocalPath ? file_exists($filePath) : true;

                                            // Vérifier si c'est une URL externe
                                            $isExternalUrl = filter_var($media->chemin, FILTER_VALIDATE_URL) ||
                                                           str_starts_with($media->chemin, 'http') ||
                                                           str_contains($media->chemin, 'cloudinary');

                                            // Vérifier le statut du fichier
                                            $fileStatus = $isExternalUrl ? 'external' : ($fileExists ? 'exists' : 'missing');

                                            // Calculer la taille du fichier (uniquement pour les fichiers locaux existants)
                                            $fileSize = 'N/A';
                                            if ($fileExists && $isLocalPath) {
                                                try {
                                                    $sizeInBytes = filesize($filePath);
                                                    $fileSize = round($sizeInBytes / 1024, 1) . ' KB';
                                                } catch (Exception $e) {
                                                    $fileSize = 'Erreur';
                                                }
                                            } elseif ($isExternalUrl) {
                                                $fileSize = 'Externe';
                                            } else {
                                                $fileSize = 'Manquant';
                                            }

                                            // Déterminer l'icône de type
                                            $typeIcon = match($media->id_type_media) {
                                                1 => 'bi-image',
                                                2 => 'bi-play-circle',
                                                3 => 'bi-music-note-beamed',
                                                default => 'bi-file-earmark'
                                            };

                                            $typeBadge = match($media->id_type_media) {
                                                1 => 'bg-success',
                                                2 => 'bg-danger',
                                                3 => 'bg-warning',
                                                default => 'bg-secondary'
                                            };

                                            $typeText = match($media->id_type_media) {
                                                1 => 'Image',
                                                2 => 'Vidéo',
                                                3 => 'Audio',
                                                default => 'Fichier'
                                            };
                                        @endphp

                                        <tr data-type="{{ $media->id_type_media }}"
                                            data-contenu="{{ $media->id_contenu }}"
                                            data-status="{{ $fileStatus }}">
                                            <td>
                                                <span class="badge bg-secondary">#{{ $media->id_media }}</span>
                                            </td>
                                            <td>
                                                <div class="media-thumbnail
                                                    @if($media->id_type_media == 1) image-thumbnail
                                                    @elseif($media->id_type_media == 2) video-thumbnail
                                                    @else audio-thumbnail
                                                    @endif"
                                                    onclick="previewMedia({{ $media->id_media }}, '{{ addslashes($media->chemin) }}', {{ $media->id_type_media }}, '{{ $fileUrl }}')"
                                                    title="Cliquer pour prévisualiser">
                                                    @if($media->id_type_media == 1)
                                                        <!-- Image -->
                                                        @if($isExternalUrl)
                                                            <!-- URL externe -->
                                                            <img src="{{ $fileUrl }}"
                                                                 alt="{{ $media->description }}"
                                                                 onerror="this.onerror=null; this.src='{{ asset('adminlte/img/default-content.jpg') }}'; this.nextElementSibling.style.display='flex';"
                                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                                            <div class="fallback d-none flex-column align-items-center justify-content-center h-100">
                                                                <i class="bi bi-image text-muted fs-4 mb-1"></i>
                                                                <small class="text-muted">Image</small>
                                                            </div>
                                                        @elseif($fileExists)
                                                            <!-- Fichier local existant -->
                                                            <img src="{{ $fileUrl }}"
                                                                 alt="{{ $media->description }}"
                                                                 onerror="this.onerror=null; this.src='{{ asset('adminlte/img/default-content.jpg') }}'; this.nextElementSibling.style.display='flex';"
                                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                                            <div class="fallback d-none flex-column align-items-center justify-content-center h-100">
                                                                <i class="bi bi-image text-muted fs-4 mb-1"></i>
                                                                <small class="text-muted">Image</small>
                                                            </div>
                                                        @else
                                                            <!-- Fichier manquant -->
                                                            <div class="fallback d-flex flex-column align-items-center justify-content-center h-100 bg-light">
                                                                <i class="bi bi-exclamation-triangle text-danger fs-4 mb-1"></i>
                                                                <small class="text-danger">Manquant</small>
                                                            </div>
                                                        @endif
                                                    @elseif($media->id_type_media == 2)
                                                        <!-- Vidéo -->
                                                        <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-dark text-white">
                                                            <i class="bi bi-play-circle fs-4 mb-1"></i>
                                                            <small>Vidéo</small>
                                                        </div>
                                                    @else
                                                        <!-- Audio -->
                                                        <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-secondary text-white">
                                                            <i class="bi bi-music-note-beamed fs-4 mb-1"></i>
                                                            <small>Audio</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-start">
                                                    <i class="bi {{ $typeIcon }} me-2 mt-1 text-muted"></i>
                                                    <div>
                                                        <div class="fw-medium text-truncate" style="max-width: 180px;">
                                                            {{ basename($media->chemin) }}
                                                        </div>
                                                        <div class="small text-muted text-truncate" style="max-width: 180px;">
                                                            {{ $media->chemin }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge {{ $typeBadge }} badge-sm">
                                                    <i class="bi {{ $typeIcon }} me-1"></i> {{ $typeText }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="small">
                                                    @if($media->description)
                                                        {{ Str::limit($media->description, 50) }}
                                                    @else
                                                        <span class="text-muted">Aucune description</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if($media->contenu)
                                                    <a href="{{ route('admin.contenus.show', $media->contenu->id_contenu) }}"
                                                       class="d-block text-decoration-none">
                                                        <div class="fw-medium">{{ Str::limit($media->contenu->titre, 20) }}</div>
                                                        <div class="small text-muted">
                                                            {{ $media->contenu->typeContenu->nom_contenu ?? 'Type' }}
                                                        </div>
                                                    </a>
                                                @else
                                                    <span class="badge bg-secondary badge-sm">
                                                        <i class="bi bi-unlink me-1"></i> Non associé
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">
                                                    {{ $fileSize }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($isExternalUrl)
                                                    <span class="badge bg-info badge-sm">
                                                        <i class="bi bi-cloud me-1"></i> Externe
                                                    </span>
                                                @elseif($fileExists)
                                                    <span class="badge bg-success badge-sm">
                                                        <i class="bi bi-check-circle me-1"></i> Présent
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger badge-sm">
                                                        <i class="bi bi-exclamation-triangle me-1"></i> Manquant
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="small text-muted">
                                                    <div>{{ $media->created_at->format('d/m/Y') }}</div>
                                                    <div>{{ $media->created_at->format('H:i') }}</div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <!-- Voir/Prévisualiser -->
                                                    <button class="btn btn-outline-primary rounded-circle"
                                                            onclick="previewMedia({{ $media->id_media }}, '{{ addslashes($media->chemin) }}', {{ $media->id_type_media }}, '{{ $fileUrl }}')"
                                                            title="Prévisualiser"
                                                            data-bs-toggle="tooltip">
                                                        <i class="bi bi-eye"></i>
                                                    </button>

                                                    <!-- Modifier -->
                                                    <a href="{{ route('admin.medias.edit', $media->id_media) }}"
                                                       class="btn btn-outline-warning rounded-circle"
                                                       title="Modifier"
                                                       data-bs-toggle="tooltip">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <!-- Télécharger -->
                                                    <a href="{{ $fileUrl }}"
                                                       download="{{ basename($media->chemin) }}"
                                                       class="btn btn-outline-success rounded-circle"
                                                       title="Télécharger"
                                                       data-bs-toggle="tooltip">
                                                        <i class="bi bi-download"></i>
                                                    </a>

                                                    <!-- Supprimer -->
                                                    <button type="button"
                                                            class="btn btn-outline-danger rounded-circle btn-delete"
                                                            data-id="{{ $media->id_media }}"
                                                            data-name="{{ basename($media->chemin) }}"
                                                            title="Supprimer"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-target="#deleteModal{{ $media->id_media }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

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
            <div class="modal-body text-center" id="previewContent">
                <!-- Le contenu sera chargé dynamiquement -->
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

<!-- Modal de confirmation de suppression unique -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i> Confirmer la suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer le média :</p>
                <p class="fw-bold" id="deleteMediaName"></p>
                @if($media->contenu ?? false)
                    <div class="alert alert-warning mt-2">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        Ce média est associé à un contenu
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" style="display: inline;">
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
@endsection

@section('scripts')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<script>
$(document).ready(function() {
    // Initialiser DataTables
    var table = $('#mediasTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json",
            "search": "Rechercher :",
            "lengthMenu": "Afficher _MENU_ médias par page",
            "zeroRecords": "Aucun média trouvé",
            "info": "Affichage de _START_ à _END_ sur _TOTAL_ médias",
            "infoEmpty": "Aucun média disponible",
            "infoFiltered": "(filtrés sur _MAX_ médias au total)",
            "paginate": {
                "first": "Premier",
                "last": "Dernier",
                "next": "Suivant",
                "previous": "Précédent"
            }
        },
        "pageLength": 10,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tous"]],
        "order": [[0, 'desc']], // Tri par ID décroissant
        "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        "columnDefs": [
            {
                "orderable": false,
                "targets": [1, 9] // Désactiver le tri sur Aperçu et Actions
            },
            {
                "searchable": false,
                "targets": [1, 9] // Désactiver la recherche sur Aperçu et Actions
            }
        ],
        "initComplete": function() {
            // Initialiser les tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });

    // Filtre par type
    $('#filterType').on('change', function() {
        var val = $(this).val();
        if (val) {
            table.column(3).search('^' + $(this).find('option:selected').text() + '$', true, false).draw();
        } else {
            table.column(3).search('').draw();
        }
    });

    // Filtre par contenu
    $('#filterContenu').on('change', function() {
        var val = $(this).val();
        table.column(5).search(val ? val : '').draw();
    });

    // Filtre par statut
    $('#filterStatus').on('change', function() {
        var val = $(this).val();
        table.column(7).search(val ? val : '').draw();
    });

    // Recherche personnalisée
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Effacer la recherche
    $('#clearSearch').on('click', function() {
        $('#searchInput').val('');
        table.search('').draw();
    });

    // Gestion de la suppression avec modal unique
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();

        const mediaId = $(this).data('id');
        const mediaName = $(this).data('name');

        // Mettre à jour le modal unique
        $('#deleteMediaName').text(mediaName);
        $('#deleteForm').attr('action', '/admin/medias/' + mediaId);

        // Afficher le modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        deleteModal.show();
    });
});

// Fonction pour prévisualiser un média
function previewMedia(mediaId, fileName, type, fileUrl) {
    console.log('Prévisualisation:', { mediaId, fileName, type, fileUrl });

    document.getElementById('previewTitle').textContent = fileName;
    document.getElementById('previewDownload').href = fileUrl;
    document.getElementById('previewDownload').download = fileName;

    const previewContent = document.getElementById('previewContent');
    previewContent.innerHTML = '';

    // Afficher un indicateur de chargement
    previewContent.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
        </div>
    `;

    // Préparer le contenu selon le type
    setTimeout(() => {
        previewContent.innerHTML = '';

        if (type == 1) { // Image
            const img = document.createElement('img');
            img.src = fileUrl;
            img.className = 'img-fluid rounded shadow';
            img.style.maxHeight = '70vh';
            img.style.maxWidth = '100%';
            img.onerror = function() {
                previewContent.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        L'image n'a pas pu être chargée
                        <div class="mt-2">
                            <small>URL: ${fileUrl}</small>
                        </div>
                    </div>
                `;
            };
            img.onload = function() {
                previewContent.innerHTML = '';
                previewContent.appendChild(img);
            };
            previewContent.appendChild(img);

        } else if (type == 2) { // Vidéo
            const videoContainer = document.createElement('div');
            videoContainer.className = 'video-container';
            videoContainer.innerHTML = `
                <video controls class="w-100 rounded shadow" style="max-height: 70vh;">
                    <source src="${fileUrl}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
                <div class="mt-2 small text-muted">
                    <i class="bi bi-info-circle me-1"></i> Format vidéo
                </div>
            `;
            previewContent.appendChild(videoContainer);

        } else { // Audio
            const audioContainer = document.createElement('div');
            audioContainer.className = 'audio-container';
            audioContainer.innerHTML = `
                <audio controls class="w-100">
                    <source src="${fileUrl}" type="audio/mpeg">
                    Votre navigateur ne supporte pas la lecture audio.
                </audio>
                <div class="mt-3 text-center">
                    <i class="bi bi-music-note-beamed fs-1 text-primary"></i>
                </div>
            `;
            previewContent.appendChild(audioContainer);
        }
    }, 500);

    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    modal.show();
}
</script>

<style>
/* Vignettes média */
.media-thumbnail {
    width: 60px;
    height: 60px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    overflow: hidden;
    margin: 0 auto;
    position: relative;
}

.media-thumbnail:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.image-thumbnail {
    border: 2px solid #e9ecef;
    background: #f8f9fa;
}

.video-thumbnail {
    background: linear-gradient(45deg, #dc3545, #c82333);
    border: 2px solid #dc3545;
}

.audio-thumbnail {
    background: linear-gradient(45deg, #ffc107, #e0a800);
    border: 2px solid #ffc107;
}

.media-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.media-thumbnail .fallback {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #f8f9fa;
}

/* Boutons d'action */
.btn-group-sm {
    display: flex;
    gap: 2px;
    justify-content: center;
}

.btn-group-sm .btn {
    width: 35px;
    height: 35px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-group-sm .btn i {
    font-size: 0.9rem;
}

/* Badges */
.badge-sm {
    font-size: 0.75rem;
    padding: 3px 8px;
}

/* Style pour les lignes de fichier manquant */
tr[data-status="missing"] {
    background-color: rgba(220, 53, 69, 0.05);
}

/* Style pour les lignes de fichier externe */
tr[data-status="external"] {
    background-color: rgba(13, 110, 253, 0.05);
}

/* DataTables responsive */
@media (max-width: 768px) {
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        float: none;
        text-align: center;
        margin-bottom: 10px;
    }

    .btn-group-sm {
        flex-direction: column;
        gap: 2px;
    }

    .btn-group-sm .btn {
        width: 32px;
        height: 32px;
    }

    .media-thumbnail {
        width: 50px;
        height: 50px;
    }
}

/* Modal de prévisualisation */
.video-container {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    height: 0;
}

.video-container video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.audio-container {
    padding: 20px;
}

/* Avatars et vignettes */
.user-avatar {
    border: 2px solid #dee2e6;
    transition: all 0.3s;
}

.user-avatar:hover {
    transform: scale(1.05);
    border-color: #4e73df;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>
@endsection
