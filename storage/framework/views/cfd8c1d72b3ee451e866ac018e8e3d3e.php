<?php $__env->startSection('page-title', 'Associations Langue/Région'); ?>

<?php $__env->startSection('content'); ?>
<main class="app-main bg-light min-vh-100">
    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-link-45deg"></i> Association Langue / Région
            </h3>
            <a href="<?php echo e(route('admin.parler.create')); ?>" class="btn btn-gradient btn-lg shadow">
                <i class="bi bi-plus-circle"></i> Ajouter une association
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                <table id="parlerTable" class="table table-striped table-hover align-middle w-100">
                    <thead class="table-primary">
                        <tr>
                            <th width="50">#</th>
                            <th>Région</th>
                            <th>Langue</th>
                            <th width="120" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $parlers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parler): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><span class="badge bg-secondary"><?php echo e($parler->id_parler); ?></span></td>
                                <td>
                                    <span class="badge bg-info">
                                        <i class="bi bi-geo-alt me-1"></i><?php echo e($parler->region->nom_region ?? '-'); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-translate me-1"></i><?php echo e($parler->langue->nom_langue ?? '-'); ?>

                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <!-- Voir -->
                                        <a href="<?php echo e(route('admin.parler.show', $parler)); ?>"
                                           class="btn btn-outline-info rounded-circle"
                                           title="Voir"
                                           data-bs-toggle="tooltip">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <!-- Modifier -->
                                        <a href="<?php echo e(route('admin.parler.edit', $parler)); ?>"
                                           class="btn btn-outline-warning rounded-circle"
                                           title="Modifier"
                                           data-bs-toggle="tooltip">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <!-- Supprimer -->
                                        <button type="button"
                                                class="btn btn-outline-danger rounded-circle btn-delete"
                                                data-id="<?php echo e($parler->id_parler); ?>"
                                                data-name="<?php echo e($parler->region->nom_region ?? 'Région'); ?> - <?php echo e($parler->langue->nom_langue ?? 'Langue'); ?>"
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
                <p>Êtes-vous sûr de vouloir supprimer l'association :</p>
                <p class="fw-bold" id="deleteParlerName"></p>
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

<script>
$(document).ready(function() {
    console.log('Initialisation DataTables pour associations langue/région...');

    $('#parlerTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50],
        "responsive": true,
        "columnDefs": [{
            "orderable": false,
            "targets": 3
        }],
        "initComplete": function() {
            // Initialiser les tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });

    // Gestion de la suppression avec modal
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();

        const parlerId = $(this).data('id');
        const parlerName = $(this).data('name');

        // Mettre à jour le modal
        $('#deleteParlerName').text(parlerName);
        $('#deleteForm').attr('action', '/admin/parler/' + parlerId);

        // Afficher le modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        deleteModal.show();
    });
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
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views/parler/index.blade.php ENDPATH**/ ?>