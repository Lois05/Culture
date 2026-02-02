<?php $__env->startSection('page-title', 'Gestion des Contenus'); ?>

<?php $__env->startSection('content'); ?>
<?php
use App\Helpers\ImageHelper;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-journal-text me-2"></i> Liste des Contenus
                        <span class="badge bg-light text-primary ms-2"><?php echo e($contenus->count()); ?></span>
                    </h4>
                    <div>
                        <a href="<?php echo e(route('admin.contenus.create')); ?>" class="btn btn-light btn-lg">
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
                                <th width="120" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $contenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $media = $contenu->medias->first();
                                    $mediaUrl = $media ? ImageHelper::content($media->chemin) : asset('adminlte/img/default-content.jpg');
                                    $mediaType = $media ? ($media->typeMedia->id_type_media ?? 1) : 1;
                                ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary">#<?php echo e($contenu->id_contenu); ?></span>
                                    </td>
                                    <td>
                                        <?php if($media): ?>
                                            <?php if($mediaType == 2): ?> 
                                                <div class="media-thumbnail video-thumbnail"
                                                    onclick="window.open('<?php echo e($mediaUrl); ?>', '_blank')"
                                                    title="Voir la vidéo">
                                                    <i class="bi bi-play-circle-fill"></i>
                                                </div>
                                            <?php elseif($mediaType == 3): ?> 
                                                <div class="media-thumbnail audio-thumbnail"
                                                    onclick="window.open('<?php echo e($mediaUrl); ?>', '_blank')"
                                                    title="Écouter l'audio">
                                                    <i class="bi bi-music-note-beamed"></i>
                                                </div>
                                            <?php else: ?> 
                                                <div class="media-thumbnail image-thumbnail"
                                                    onclick="showImageModal('<?php echo e($mediaUrl); ?>', '<?php echo e(addslashes($contenu->titre)); ?>')"
                                                    title="Voir l'image">
                                                    <img src="<?php echo e($mediaUrl); ?>"
                                                        alt="<?php echo e($contenu->titre); ?>"
                                                        onerror="this.onerror=null; this.src='<?php echo e(asset('adminlte/img/default-content.jpg')); ?>'">
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="media-thumbnail no-media" title="Aucun média">
                                                <img src="<?php echo e(asset('adminlte/img/default-content.jpg')); ?>"
                                                    alt="Pas d'image"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="contenu-info">
                                            <a href="<?php echo e(route('admin.contenus.show', $contenu->id_contenu)); ?>"
                                                class="contenu-titre"
                                                title="<?php echo e($contenu->titre); ?>">
                                                <?php echo e(Str::limit($contenu->titre, 40)); ?>

                                            </a>
                                            <?php if($contenu->description): ?>
                                                <div class="contenu-description text-muted small mt-1">
                                                    <?php echo e(Str::limit($contenu->description, 60)); ?>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-dark badge-sm">
                                            <?php echo e(Str::limit($contenu->typeContenu->nom_contenu ?? 'Non défini', 15)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info badge-sm">
                                            <?php echo e(Str::limit($contenu->region->nom_region ?? 'N/D', 10)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary badge-sm">
                                            <?php echo e(Str::limit($contenu->langue->nom_langue ?? 'N/D', 10)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php switch($contenu->statut):
                                            case ('validé'): ?>
                                                <span class="badge bg-success badge-sm">
                                                    <i class="bi bi-check-circle me-1"></i> Validé
                                                </span>
                                                <?php break; ?>
                                            <?php case ('en attente'): ?>
                                                <span class="badge bg-warning text-dark badge-sm">
                                                    <i class="bi bi-clock me-1"></i> Attente
                                                </span>
                                                <?php break; ?>
                                            <?php case ('rejeté'): ?>
                                                <span class="badge bg-danger badge-sm">
                                                    <i class="bi bi-x-circle me-1"></i> Rejeté
                                                </span>
                                                <?php break; ?>
                                            <?php default: ?>
                                                <span class="badge bg-secondary badge-sm"><?php echo e($contenu->statut); ?></span>
                                        <?php endswitch; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <?php echo e(strtoupper(substr($contenu->auteur->name ?? 'A', 0, 1))); ?>

                                            </div>
                                            <div class="small">
                                                <div class="fw-medium"><?php echo e(Str::limit($contenu->auteur->name ?? 'Anonyme', 8)); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small text-muted">
                                            <?php echo e($contenu->date_creation ? \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') : '—'); ?>

                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <!-- Voir -->
                                            <a href="<?php echo e(route('admin.contenus.show', $contenu->id_contenu)); ?>"
                                                class="btn btn-outline-primary rounded-circle"
                                                title="Voir"
                                                data-bs-toggle="tooltip">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- Modifier -->
                                            <?php
                                                $user = Auth::user();
                                                $userRole = $user ? optional($user->role)->nom_role : null;
                                                $isAdminOrModerator = in_array($userRole, ['Administrateur', 'Modérateur']);
                                                $userId = $user ? ($user->id ?? $user->getKey()) : null;
                                                $canEdit = $user && ($userId == $contenu->id_auteur || $isAdminOrModerator);
                                            ?>

                                            <?php if($canEdit): ?>
                                                <a href="<?php echo e(route('admin.contenus.edit', $contenu->id_contenu)); ?>"
                                                    class="btn btn-outline-warning rounded-circle"
                                                    title="Modifier"
                                                    data-bs-toggle="tooltip">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            <?php else: ?>
                                                <button class="btn btn-outline-warning rounded-circle disabled"
                                                        title="Modification non autorisée">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            <?php endif; ?>

                                            <!-- Ajouter média -->
                                            <a href="<?php echo e(route('admin.medias.create')); ?>?contenu_id=<?php echo e($contenu->id_contenu); ?>"
                                               class="btn btn-outline-info rounded-circle"
                                               title="Ajouter média"
                                               data-bs-toggle="tooltip">
                                                <i class="bi bi-image"></i>
                                            </a>

                                            <!-- Supprimer -->
                                            <?php
                                                $canDelete = $user && ($userId == $contenu->id_auteur || $userRole === 'Administrateur');
                                            ?>

                                            <?php if($canDelete): ?>
                                                <button type="button"
                                                        class="btn btn-outline-danger rounded-circle btn-delete"
                                                        data-id="<?php echo e($contenu->id_contenu); ?>"
                                                        data-name="<?php echo e($contenu->titre); ?>"
                                                        title="Supprimer"
                                                        data-bs-toggle="tooltip">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            <?php else: ?>
                                                <button class="btn btn-outline-danger rounded-circle disabled"
                                                        title="Suppression non autorisée">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
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
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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

    // Gestion de la suppression avec modal
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();

        const contenuId = $(this).data('id');
        const contenuName = $(this).data('name');

        $('#deleteMessage').html('Êtes-vous sûr de vouloir supprimer le contenu : <strong>"' + contenuName + '"</strong> ?');
        $('#deleteFormModal').attr('action', '/admin/contenus/' + contenuId);

        var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        deleteModal.show();
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

/* Désactiver les boutons non autorisés */
.btn.disabled {
    opacity: 0.5;
    cursor: not-allowed;
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

    .btn-group-sm {
        flex-direction: column;
        gap: 2px;
    }

    .btn-group-sm .btn {
        width: 32px;
        height: 32px;
    }

    .media-thumbnail {
        width: 40px;
        height: 40px;
    }

    .avatar-sm {
        width: 24px;
        height: 24px;
        font-size: 0.7rem;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views/contenus/index.blade.php ENDPATH**/ ?>