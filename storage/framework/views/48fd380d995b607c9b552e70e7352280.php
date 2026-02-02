<?php $__env->startSection('title', 'Mes Contributions - Bénin Culture'); ?>
<?php $__env->startSection('page-title', 'Mes Contributions'); ?>
<?php $__env->startSection('page-subtitle', 'Gérez toutes vos contributions'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-card fade-in">
    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-journal-text me-2"></i>
            Mes Contributions
        </h3>
        <div>
            <span class="badge bg-primary-custom me-2"><?php echo e($stats['total_contributions']); ?> contributions</span>
            <button type="button" class="btn btn-sm btn-outline-primary" id="filterToggle">
                <i class="bi bi-funnel me-1"></i>Filtres
            </button>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card-body border-bottom" id="filtersSection" style="display: none;">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="type_filter" class="form-label">Filtrer par type</label>
                <select class="form-select" id="type_filter">
                    <option value="">Tous les types</option>
                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->nom_contenu); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="status_filter" class="form-label">Filtrer par statut</label>
                <select class="form-select" id="status_filter">
                    <option value="">Tous les statuts</option>
                    <option value="validé">Validé</option>
                    <option value="en_attente">En attente</option>
                    <option value="rejeté">Rejeté</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="date_filter" class="form-label">Filtrer par date</label>
                <select class="form-select" id="date_filter">
                    <option value="">Toutes les dates</option>
                    <option value="today">Aujourd'hui</option>
                    <option value="week">Cette semaine</option>
                    <option value="month">Ce mois</option>
                    <option value="year">Cette année</option>
                </select>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end">
                <button type="button" class="btn btn-secondary w-100" id="resetFilters">
                    <i class="bi bi-arrow-clockwise me-1"></i>Réinitialiser
                </button>
            </div>
        </div>
    </div>

    <!-- Tableau des contributions -->
    <div class="card-body">
        <?php if($contributions->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover" id="contributionsTable">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Vues</th>
                            <th>Likes</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $contributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <strong><?php echo e($contribution->titre); ?></strong>
                                <div class="small text-muted"><?php echo e(Str::limit(strip_tags($contribution->texte ?? ''), 50)); ?></div>
                            </td>
                            <td>
                                <span class="badge bg-secondary"><?php echo e($contribution->typeContenu->nom_contenu ?? 'Non défini'); ?></span>
                            </td>
                            <td><?php echo e($contribution->date_creation->format('d/m/Y')); ?></td>
                            <td><?php echo e(number_format($contribution->vues_count ?? 0, 0, ',', ' ')); ?></td>
                            <td><?php echo e(number_format($contribution->likes_count ?? 0, 0, ',', ' ')); ?></td>
                            <td>
                                <span class="badge badge-success">Validé</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-outline-primary" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Affichage de <?php echo e($contributions->firstItem()); ?> à <?php echo e($contributions->lastItem()); ?> sur <?php echo e($contributions->total()); ?> contributions
                </div>
                <div>
                    <?php echo e($contributions->links()); ?>

                </div>
            </div>
        <?php else: ?>
            <!-- État vide -->
            <div class="empty-state text-center py-5">
                <i class="bi bi-journal-x display-1 text-muted mb-3"></i>
                <h4 class="mb-3">Aucune contribution</h4>
                <p class="text-muted mb-4">Vous n'avez pas encore créé de contribution.</p>
                <a href="<?php echo e(route('dashboard.contribuer')); ?>" class="btn btn-primary-custom">
                    <i class="bi bi-plus-circle me-2"></i>Créer une première contribution
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Statistiques rapides -->
    <?php if($contributions->count() > 0): ?>
    <div class="card-footer bg-light">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-2">
                <div class="text-muted small">Total des vues</div>
                <div class="h5 fw-bold"><?php echo e(number_format($contributions->sum('vues_count'), 0, ',', ' ')); ?></div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="text-muted small">Total des likes</div>
                <div class="h5 fw-bold"><?php echo e(number_format($contributions->sum('likes_count'), 0, ',', ' ')); ?></div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="text-muted small">Taux d'engagement</div>
                <div class="h5 fw-bold">
                    <?php
                        $totalViews = max(1, $contributions->sum('vues_count'));
                        $totalInteractions = $contributions->sum('likes_count') + $contributions->sum('commentaires_count');
                        $engagementRate = ($totalInteractions / $totalViews) * 100;
                    ?>
                    <?php echo e(number_format($engagementRate, 1)); ?>%
                </div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="text-muted small">Types utilisés</div>
                <div class="h5 fw-bold"><?php echo e($contributions->unique('id_type_contenu')->count()); ?></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
    // Gestion des filtres
    document.addEventListener('DOMContentLoaded', function() {
        const filterToggle = document.getElementById('filterToggle');
        const filtersSection = document.getElementById('filtersSection');
        const resetFilters = document.getElementById('resetFilters');

        // Afficher/masquer les filtres
        filterToggle.addEventListener('click', function() {
            if (filtersSection.style.display === 'none') {
                filtersSection.style.display = 'block';
                filterToggle.innerHTML = '<i class="bi bi-funnel-fill me-1"></i>Masquer les filtres';
                filterToggle.classList.remove('btn-outline-primary');
                filterToggle.classList.add('btn-primary');
            } else {
                filtersSection.style.display = 'none';
                filterToggle.innerHTML = '<i class="bi bi-funnel me-1"></i>Filtres';
                filterToggle.classList.remove('btn-primary');
                filterToggle.classList.add('btn-outline-primary');
            }
        });

        // Réinitialiser les filtres
        resetFilters.addEventListener('click', function() {
            document.getElementById('type_filter').value = '';
            document.getElementById('status_filter').value = '';
            document.getElementById('date_filter').value = '';
        });

        // Filtrer en temps réel
        const typeFilter = document.getElementById('type_filter');
        const statusFilter = document.getElementById('status_filter');
        const dateFilter = document.getElementById('date_filter');
        const tableRows = document.querySelectorAll('#contributionsTable tbody tr');

        function filterTable() {
            const typeValue = typeFilter.value.toLowerCase();
            const statusValue = statusFilter.value.toLowerCase();
            const dateValue = dateFilter.value;

            tableRows.forEach(row => {
                const typeCell = row.cells[1].textContent.toLowerCase();
                const statusCell = row.cells[5].textContent.toLowerCase();
                const dateCell = row.cells[2].textContent;

                let showRow = true;

                // Filtrer par type
                if (typeValue && !typeCell.includes(typeValue)) {
                    showRow = false;
                }

                // Filtrer par statut
                if (statusValue && statusCell !== statusValue) {
                    showRow = false;
                }

                // Filtrer par date (simplifié)
                if (dateValue) {
                    const rowDate = new Date(dateCell.split('/').reverse().join('-'));
                    const today = new Date();

                    switch(dateValue) {
                        case 'today':
                            if (rowDate.toDateString() !== today.toDateString()) showRow = false;
                            break;
                        case 'week':
                            const weekAgo = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
                            if (rowDate < weekAgo) showRow = false;
                            break;
                        case 'month':
                            const monthAgo = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
                            if (rowDate < monthAgo) showRow = false;
                            break;
                        case 'year':
                            const yearAgo = new Date(today.getFullYear() - 1, today.getMonth(), today.getDate());
                            if (rowDate < yearAgo) showRow = false;
                            break;
                    }
                }

                row.style.display = showRow ? '' : 'none';
            });
        }

        typeFilter.addEventListener('change', filterTable);
        statusFilter.addEventListener('change', filterTable);
        dateFilter.addEventListener('change', filterTable);
    });
</script>

<style>
    .table tbody tr {
        transition: background-color 0.2s;
    }
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\culture\resources\views\front\dashboard\contributions.blade.php ENDPATH**/ ?>