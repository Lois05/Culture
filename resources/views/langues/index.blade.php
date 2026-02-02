@extends('layouts.layout')

@section('page-title', 'Gestion des Langues')

@section('content')
<main class="app-main bg-light min-vh-100">
    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-translate"></i> Langues
            </h3>
            <a href="{{ route('admin.langues.create') }}" class="btn btn-gradient btn-lg shadow">
                <i class="bi bi-plus-circle"></i> Ajouter une langue
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                <table id="languesTable" class="table table-striped table-hover align-middle w-100">
                    <thead class="table-primary">
                        <tr>
                            <th width="50">#</th>
                            <th>Nom</th>
                            <th width="100">Code</th>
                            <th>Description</th>
                            <th width="120" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($langues as $langue)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $langue->id_langue }}</span></td>
                            <td>{{ $langue->nom_langue }}</td>
                            <td><span class="badge bg-info">{{ $langue->code_langue }}</span></td>
                            <td>{{ Str::limit($langue->description, 50) }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.langues.show', $langue) }}"
                                       class="btn btn-outline-info rounded-circle"
                                       title="Voir"
                                       data-bs-toggle="tooltip">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.langues.edit', $langue) }}"
                                       class="btn btn-outline-warning rounded-circle"
                                       title="Modifier"
                                       data-bs-toggle="tooltip">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-outline-danger rounded-circle btn-delete"
                                            data-id="{{ $langue->id_langue }}"
                                            data-name="{{ $langue->nom_langue }}"
                                            title="Supprimer"
                                            data-bs-toggle="tooltip">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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
                <p>Êtes-vous sûr de vouloir supprimer la langue :</p>
                <p class="fw-bold" id="deleteLangueName"></p>
                <p class="text-danger small">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    Cette action est irréversible.
                </p>
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
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#languesTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50],
        "responsive": true,
        "columnDefs": [{
            "orderable": false,
            "targets": 4
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

        const langueId = $(this).data('id');
        const langueName = $(this).data('name');

        // Mettre à jour le modal
        $('#deleteLangueName').text(langueName);
        $('#deleteForm').attr('action', '/admin/langues/' + langueId);

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
@endsection
