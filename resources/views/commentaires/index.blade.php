@extends('layouts.layout')

@section('page-title', 'Gestion des Commentaires')

@section('content')
    <main class="app-main bg-light min-vh-100">
        <div class="container-fluid mt-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold text-primary">
                    <i class="bi bi-chat-dots"></i> Commentaires
                </h3>
                <a href="{{ route('admin.commentaires.create') }}" class="btn btn-gradient btn-lg shadow">
                    <i class="bi bi-plus-circle"></i> Ajouter un commentaire
                </a>
            </div>

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <table id="commentairesTable" class="table table-striped table-hover align-middle w-100">
                        <thead class="table-primary">
                            <tr>
                                <th width="50">#</th>
                                <th>Texte</th>
                                <th width="80">Note</th>
                                <th width="120">Date</th>
                                <th width="120">Utilisateur</th>
                                <th>Contenu</th>
                                <th width="120" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commentaires as $commentaire)
                                <tr>
                                    <td><span class="badge bg-secondary">{{ $commentaire->id_commentaire }}</span></td>
                                    <td>{{ Str::limit($commentaire->texte, 50) }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $commentaire->note }} ⭐
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($commentaire->date)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <i class="bi bi-person-circle"></i>
                                        {{ $commentaire->utilisateur->name ?? $commentaire->utilisateur->nom ?? '-' }}
                                    </td>
                                    <td>
                                        <i class="bi bi-file-text"></i>
                                        {{ Str::limit($commentaire->contenu->titre ?? '-', 20) }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.commentaires.show', $commentaire) }}"
                                                class="btn btn-outline-info rounded-circle"
                                                title="Voir"
                                                data-bs-toggle="tooltip">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.commentaires.edit', $commentaire) }}"
                                                class="btn btn-outline-warning rounded-circle"
                                                title="Modifier"
                                                data-bs-toggle="tooltip">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-outline-danger rounded-circle btn-delete"
                                                    data-id="{{ $commentaire->id_commentaire }}"
                                                    data-name="Commentaire du {{ \Carbon\Carbon::parse($commentaire->date)->format('d/m/Y') }}"
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
                <p>Êtes-vous sûr de vouloir supprimer le commentaire :</p>
                <p class="fw-bold" id="deleteCommentaireName"></p>
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
        // Initialisation unique de DataTables
        $('#commentairesTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            },
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50],
            "columnDefs": [{
                "orderable": false,
                "targets": 6
            }],
            "order": [[3, 'desc']],
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

            const commentaireId = $(this).data('id');
            const commentaireName = $(this).data('name');

            // Mettre à jour le modal
            $('#deleteCommentaireName').text(commentaireName);
            $('#deleteForm').attr('action', '/admin/commentaires/' + commentaireId);

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
@endsection
