<?php $__env->startSection('page-title', 'Gestion des Régions'); ?>

<?php $__env->startSection('content'); ?>
<main class="app-main bg-light min-vh-100">
    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-map"></i> Régions
            </h3>
            <a href="<?php echo e(route('admin.regions.create')); ?>" class="btn btn-gradient btn-lg shadow">
                <i class="bi bi-plus-circle"></i> Ajouter une région
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                <table id="regionsTable" class="table table-striped table-hover align-middle w-100">
                    <thead class="table-primary">
                        <tr>
                            <th width="50">ID</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th width="100">Population</th>
                            <th width="100">Superficie</th>
                            <th width="100">Localisation</th>
                            <th width="120" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?php echo e($region->id_region ?? $region->id); ?></span></td>
                            <td><?php echo e($region->nom_region); ?></td>
                            <td><?php echo e(Str::limit($region->description, 50)); ?></td>
                            <td>
                                <?php if($region->population): ?>
                                    <span class="badge bg-info"><?php echo e(number_format($region->population)); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($region->superficie): ?>
                                    <span class="badge bg-warning text-dark"><?php echo e($region->superficie); ?> km²</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <i class="bi bi-geo-alt"></i>
                                <?php echo e($region->localisation ?? 'Non spécifiée'); ?>

                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <!-- Bouton Voir ouvre le modal -->
                                    <button type="button"
                                            class="btn btn-outline-info rounded-circle"
                                            data-bs-toggle="modal"
                                            data-bs-target="#mapModal<?php echo e($region->id_region ?? $region->id); ?>"
                                            title="Voir"
                                            data-bs-toggle="tooltip">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    <a href="<?php echo e(route('admin.regions.edit', $region)); ?>"
                                       class="btn btn-outline-warning rounded-circle"
                                       title="Modifier"
                                       data-bs-toggle="tooltip">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <button type="button"
                                            class="btn btn-outline-danger rounded-circle btn-delete"
                                            data-id="<?php echo e($region->id_region ?? $region->id); ?>"
                                            data-name="<?php echo e($region->nom_region); ?>"
                                            title="Supprimer"
                                            data-bs-toggle="tooltip">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modals en dehors de la table -->
<?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="mapModal<?php echo e($region->id_region ?? $region->id); ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-geo-alt"></i> <?php echo e($region->nom_region); ?>

                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Description :</strong> <?php echo e($region->description ?? 'Non renseignée'); ?></p>
                <p><strong>Population :</strong> <?php echo e($region->population ? number_format($region->population) : 'Non renseignée'); ?></p>
                <p><strong>Superficie :</strong> <?php echo e($region->superficie ? $region->superficie . ' km²' : 'Non renseignée'); ?></p>
                <div id="map<?php echo e($region->id_region ?? $region->id); ?>" style="height:400px;" class="rounded shadow"></div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!-- Modal de confirmation de suppression -->
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
                <p>Êtes-vous sûr de vouloir supprimer la région :</p>
                <p class="fw-bold" id="deleteRegionName"></p>
                <p class="text-danger small">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    Cette action est irréversible.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" style="display: inline;">
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
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<!-- Leaflet pour les cartes -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
$(document).ready(function () {
    console.log('Initialisation DataTables...');

    // Initialiser DataTables
    var table = $('#regionsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        "pageLength": 10,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tous"]],
        "responsive": true,
        "autoWidth": false,
        "order": [[0, 'asc']],
        "initComplete": function() {
            // Initialiser les tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });

    console.log('DataTables initialisé avec succès');

    // Gestion de la suppression avec modal
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();

        const regionId = $(this).data('id');
        const regionName = $(this).data('name');

        // Mettre à jour le modal
        $('#deleteRegionName').text(regionName);
        $('#deleteForm').attr('action', '/admin/regions/' + regionId);

        // Afficher le modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        deleteModal.show();
    });

    // Initialiser les cartes Leaflet
    <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    $('#mapModal<?php echo e($region->id_region ?? $region->id); ?>').on('shown.bs.modal', function () {
        var mapId = 'map<?php echo e($region->id_region ?? $region->id); ?>';
        var mapElement = document.getElementById(mapId);

        // Vérifier si la carte est déjà initialisée
        if (mapElement._leaflet_id) {
            return;
        }

        // Coordonnées par défaut (Bénin)
        var defaultLat = 9.3077;
        var defaultLng = 2.3158;
        var zoomLevel = 7;

        // Essayer d'extraire les coordonnées de la localisation
        <?php if($region->localisation): ?>
            var coords = "<?php echo e($region->localisation); ?>".split(',');
            if (coords.length === 2) {
                var lat = parseFloat(coords[0].trim());
                var lng = parseFloat(coords[1].trim());
                if (!isNaN(lat) && !isNaN(lng)) {
                    defaultLat = lat;
                    defaultLng = lng;
                    zoomLevel = 10;
                }
            }
        <?php endif; ?>

        var map = L.map(mapId).setView([defaultLat, defaultLng], zoomLevel);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Ajouter un marqueur
        var marker = L.marker([defaultLat, defaultLng]).addTo(map)
            .bindPopup("<b><?php echo e($region->nom_region); ?></b><br>" +
                      "Population: <?php echo e($region->population ? number_format($region->population) : 'N/A'); ?><br>" +
                      "Superficie: <?php echo e($region->superficie ? $region->superficie . ' km²' : 'N/A'); ?>")
            .openPopup();
    });
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
});
</script>

<style>
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

.btn-gradient {
    background: linear-gradient(45deg, #0d6efd, #6610f2);
    color: #fff;
    border: none;
    transition: 0.3s;
}

.btn-gradient:hover {
    transform: scale(1.05);
    opacity: 0.9;
}

/* Responsive */
@media (max-width: 768px) {
    .btn-group-sm {
        flex-direction: column;
        gap: 2px;
    }

    .btn-group-sm .btn {
        width: 32px;
        height: 32px;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\regions\index.blade.php ENDPATH**/ ?>