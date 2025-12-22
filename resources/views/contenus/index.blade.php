@extends('layouts.layout')

@section('page-title', 'Gestion des Contenus')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-journal-text me-2"></i> Liste des Contenus
                        <span class="badge bg-light text-primary ms-2">{{ $contenus->count() }}</span>
                    </h4>
                    <div>
                        <a href="{{ route('admin.contenus.create') }}" class="btn btn-light btn-lg">
                            <i class="bi bi-plus-circle me-2"></i> Nouveau Contenu
                        </a>
                    </div>
                </div>

               


                    <div class="table-responsive">
                        <table id="contenusTable" class="table table-hover align-middle w-100" style="font-size: 0.9rem;">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">ID</th>
                                    <th width="70">Média</th>
                                    <th width="250">Titre</th>
                                    <th width="100">Type</th>
                                    <th width="90">Région</th>
                                    <th width="90">Langue</th>
                                    <th width="90">Statut</th>
                                    <th width="100">Auteur</th>
                                    <th width="90">Date</th>
                                    <th width="150" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contenus as $contenu)
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">#{{ $contenu->id_contenu }}</span>
                                        </td>
                                        <td>
                                            @if ($contenu->medias && $contenu->medias->count() > 0)
                                                @php
                                                    $media = $contenu->medias->first();
                                                    $isVideo = isset($media->typeMedia) && $media->typeMedia->id_type_media == 2;
                                                    $isAudio = isset($media->typeMedia) && $media->typeMedia->id_type_media == 3;
                                                    $fileUrl = asset('adminlte/img/' . $media->chemin);
                                                    $filePath = public_path('adminlte/img/' . $media->chemin);
                                                    $fileExists = file_exists($filePath);
                                                @endphp

                                                @if ($isVideo)
                                                    <div class="media-thumbnail video-thumbnail"
                                                         onclick="window.open('{{ $fileUrl }}', '_blank')"
                                                         title="Voir la vidéo">
                                                        <i class="bi bi-play-circle-fill"></i>
                                                    </div>
                                                @elseif($isAudio)
                                                    <div class="media-thumbnail audio-thumbnail"
                                                         onclick="window.open('{{ $fileUrl }}', '_blank')"
                                                         title="Écouter l'audio">
                                                        <i class="bi bi-music-note-beamed"></i>
                                                    </div>
                                                @else
                                                    <div class="media-thumbnail image-thumbnail"
                                                         onclick="showImageModal('{{ $fileUrl }}', '{{ $contenu->titre }}')"
                                                         title="Voir l'image">
                                                        @if($fileExists)
                                                            <img src="{{ $fileUrl }}"
                                                                 alt="{{ $contenu->titre }}"
                                                                 onerror="this.onerror=null; this.src='{{ App\Helpers\CloudinaryHelper::static('placeholder.jpg') }}'">
                                                        @else
                                                            <i class="bi bi-image text-muted"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                            @else
                                                <div class="media-thumbnail no-media" title="Aucun média">
                                                    <i class="bi bi-file-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="contenu-info">
                                                <a href="{{ route('admin.contenus.show', $contenu->id_contenu) }}"
                                                   class="contenu-titre"
                                                   title="{{ $contenu->titre }}">
                                                    {{ Str::limit($contenu->titre, 40) }}
                                                </a>
                                                @if($contenu->description)
                                                    <div class="contenu-description text-muted small mt-1">
                                                        {{ Str::limit($contenu->description, 60) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-dark badge-sm">
                                                {{ Str::limit($contenu->typeContenu->nom_contenu ?? 'Non défini', 15) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info badge-sm">
                                                {{ Str::limit($contenu->region->nom_region ?? 'N/D', 10) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary badge-sm">
                                                {{ Str::limit($contenu->langue->nom_langue ?? 'N/D', 10) }}
                                            </span>
                                        </td>
                                        <td>
                                            @switch($contenu->statut)
                                                @case('validé')
                                                    <span class="badge bg-success badge-sm">
                                                        <i class="bi bi-check-circle me-1"></i> Validé
                                                    </span>
                                                    @break
                                                @case('en attente')
                                                    <span class="badge bg-warning text-dark badge-sm">
                                                        <i class="bi bi-clock me-1"></i> Attente
                                                    </span>
                                                    @break
                                                @case('rejeté')
                                                    <span class="badge bg-danger badge-sm">
                                                        <i class="bi bi-x-circle me-1"></i> Rejeté
                                                    </span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary badge-sm">{{ $contenu->statut }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    {{ strtoupper(substr($contenu->auteur->name ?? 'A', 0, 1)) }}
                                                </div>
                                                <div class="small">
                                                    <div class="fw-medium">{{ Str::limit($contenu->auteur->name ?? 'Anonyme', 8) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="small text-muted">
                                                {{ $contenu->date_creation ? \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') : '—' }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <!-- Voir -->
                                                <a href="{{ route('admin.contenus.show', $contenu->id_contenu) }}"
                                                   class="btn btn-sm btn-outline-primary"
                                                   title="Voir"
                                                   data-bs-toggle="tooltip">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <!-- Modifier -->
                                                @php
                                                    $user = Auth::user();
                                                    $userRole = $user ? optional($user->role)->nom_role : null;
                                                    $isAdminOrModerator = in_array($userRole, ['Administrateur', 'Modérateur']);
                                                    $userId = $user ? ($user->id ?? $user->getKey()) : null;
                                                    $canEdit = $user && ($userId == $contenu->id_auteur || $isAdminOrModerator);
                                                @endphp

                                                @if($canEdit)
                                                    <a href="{{ route('admin.contenus.edit', $contenu->id_contenu) }}"
                                                       class="btn btn-sm btn-outline-warning"
                                                       title="Modifier"
                                                       data-bs-toggle="tooltip">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-outline-warning disabled"
                                                            title="Modification non autorisée">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                @endif

                                                <!-- Supprimer -->
                                                @php
                                                    $canDelete = $user && ($userId == $contenu->id_auteur || $userRole === 'Administrateur');
                                                @endphp

                                                @if($canDelete)
                                                    <form action="{{ route('admin.contenus.destroy', $contenu->id_contenu) }}"
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                                class="btn btn-sm btn-outline-danger"
                                                                title="Supprimer"
                                                                data-bs-toggle="tooltip"
                                                                onclick="confirmDelete('{{ $contenu->id_contenu }}', '{{ addslashes($contenu->titre) }}')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-sm btn-outline-danger disabled"
                                                            title="Suppression non autorisée">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif

                                                <!-- Menu dropdown pour actions supplémentaires -->
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                            type="button"
                                                            data-bs-toggle="dropdown"
                                                            title="Plus d'actions">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <!-- Ajouter média -->
                                                        <li>
                                                            <a class="dropdown-item"
                                                               href="{{ route('admin.medias.create') }}?contenu_id={{ $contenu->id_contenu }}">
                                                                <i class="bi bi-image me-2"></i> Ajouter média
                                                            </a>
                                                        </li>
                                                        <!-- Voir média -->
                                                        @if($contenu->medias && $contenu->medias->count() > 0)
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{ route('admin.medias.show', $contenu->medias->first()->id_media) }}">
                                                                    <i class="bi bi-eye me-2"></i> Voir média
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <!-- Modération rapide -->
                                                        @if(in_array($userRole, ['Administrateur', 'Modérateur']))
                                                            <li><hr class="dropdown-divider"></li>
                                                            @if($contenu->statut != 'validé')
                                                            <li>
                                                                <form action="{{ route('admin.contenus.valider', $contenu->id_contenu) }}"
                                                                      method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item text-success">
                                                                        <i class="bi bi-check-circle me-2"></i> Valider
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            @endif
                                                            @if($contenu->statut != 'rejeté')
                                                            <li>
                                                                <form action="{{ route('admin.contenus.rejeter', $contenu->id_contenu) }}"
                                                                      method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item text-danger">
                                                                        <i class="bi bi-x-circle me-2"></i> Rejeter
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            @endif
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour afficher l'image en grand -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid rounded" alt="">
            </div>
            <div class="modal-footer">
                <a id="downloadLink" href="#" class="btn btn-primary btn-sm" download>
                    <i class="bi bi-download me-1"></i> Télécharger
                </a>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i> Confirmation
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="deleteMessage">Êtes-vous sûr de vouloir supprimer ce contenu ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteFormModal" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
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
    // Initialiser DataTables côté client
    var table = $('#contenusTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json",
            "search": "Rechercher dans le tableau :",
            "lengthMenu": "Afficher _MENU_ contenus par page",
            "zeroRecords": "Aucun contenu trouvé",
            "info": "Affichage de _START_ à _END_ sur _TOTAL_ contenus",
            "infoEmpty": "Aucun contenu disponible",
            "infoFiltered": "(filtrés sur _MAX_ contenus au total)",
            "paginate": {
                "first": "Premier",
                "last": "Dernier",
                "next": "Suivant",
                "previous": "Précédent"
            }
        },
        "pageLength": 10,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tous"]],
        "order": [[0, 'desc']],
        "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        "columnDefs": [
            {
                "orderable": false,
                "targets": [1, 9] // Désactiver le tri sur Média et Actions
            },
            {
                "searchable": false,
                "targets": [1, 9] // Désactiver la recherche sur Média et Actions
            },
            {
                "className": "dt-nowrap",
                "targets": [0, 3, 4, 5, 6, 7, 8]
            }
        ],
        "initComplete": function() {
            // Initialiser les tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Initialiser les dropdowns
            $('.dropdown-toggle').dropdown();
        }
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

    // Actualiser la page
    $('#refreshBtn').on('click', function() {
        location.reload();
    });

    // Filtre par statut
    $('#filterStatut').on('change', function() {
        var val = $(this).val();
        if (val) {
            table.column(6).search('^' + val + '$', true, false).draw();
        } else {
            table.column(6).search('').draw();
        }
    });

    // Filtre par type
    $('#filterType').on('change', function() {
        var val = $(this).val();
        if (val) {
            var typeName = $(this).find('option:selected').text();
            table.column(3).search(typeName, true, false).draw();
        } else {
            table.column(3).search('').draw();
        }
    });
});

// Fonction pour afficher l'image en modal
function showImageModal(imageUrl, title) {
    document.getElementById('modalImage').src = imageUrl;
    document.getElementById('imageModalTitle').textContent = title;
    document.getElementById('downloadLink').href = imageUrl;
    document.getElementById('downloadLink').download = title + '.jpg';

    var modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

// Fonction de confirmation de suppression avec modal
function confirmDelete(id, title) {
    $('#deleteMessage').html('Êtes-vous sûr de vouloir supprimer le contenu : <strong>"' + title + '"</strong> ?');
    $('#deleteFormModal').attr('action', '/admin/contenus/' + id);

    var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    deleteModal.show();
}

// Gérer la soumission du formulaire de suppression
$('#deleteFormModal').on('submit', function(e) {
    e.preventDefault();

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
        url: url,
        type: 'POST',
        data: form.serialize(),
        success: function(response) {
            $('#deleteConfirmModal').modal('hide');
            location.reload(); // Recharger la page pour voir les changements
        },
        error: function(xhr) {
            alert('Erreur lors de la suppression');
        }
    });
});
</script>

<style>
/* Styles DataTables */
.dataTables_wrapper {
    padding-top: 10px;
}

.dataTables_length select {
    width: auto;
    display: inline-block;
}

.dataTables_filter input {
    margin-left: 10px;
}

/* Vignettes média */
.media-thumbnail {
    width: 50px;
    height: 50px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    overflow: hidden;
    margin: 0 auto;
}

.media-thumbnail:hover {
    transform: scale(1.05);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.image-thumbnail {
    border: 1px solid #dee2e6;
    background: #f8f9fa;
}

.image-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.video-thumbnail {
    background: linear-gradient(45deg, #1e3c72, #2a5298);
    color: white;
    font-size: 1.2rem;
}

.audio-thumbnail {
    background: linear-gradient(45deg, #1a535c, #4ecdc4);
    color: white;
    font-size: 1.2rem;
}

.no-media {
    background: #f8f9fa;
    border: 2px dashed #dee2e6;
    color: #6c757d;
}

/* Boutons d'action */
.action-buttons {
    display: flex;
    gap: 4px;
    justify-content: center;
    flex-wrap: nowrap;
}

.action-buttons .btn {
    width: 32px;
    height: 32px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
}

.action-buttons .btn i {
    font-size: 0.9rem;
}

/* Désactiver les boutons non autorisés */
.btn.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Dropdown dans les actions */
.action-buttons .dropdown-toggle::after {
    display: none;
}

.action-buttons .dropdown-menu {
    font-size: 0.85rem;
    min-width: 180px;
}

/* Badges */
.badge-sm {
    font-size: 0.7rem;
    padding: 3px 6px;
}

/* Avatar auteur */
.avatar-sm {
    width: 28px;
    height: 28px;
    background: #0d6efd;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Titre contenu */
.contenu-titre {
    font-weight: 600;
    color: #212529;
    text-decoration: none;
    display: block;
    line-height: 1.2;
}

.contenu-titre:hover {
    color: #0d6efd;
    text-decoration: underline;
}

.contenu-description {
    line-height: 1.3;
    opacity: 0.8;
}

/* Responsive */
@media (max-width: 768px) {
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        float: none;
        text-align: center;
        margin-bottom: 10px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 2px;
    }

    .action-buttons .btn {
        width: 28px;
        height: 28px;
    }
}
</style>
@endsection

