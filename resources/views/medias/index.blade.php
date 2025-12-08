@extends('layouts.layout')

@section('page-title', 'Gestion des Médias')

@section('content')
<main class="app-main bg-light min-vh-100">
    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-collection-play"></i> Gestion des Médias
            </h3>
            <a href="{{ route('admin.medias.create') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle"></i> Ajouter un média
            </a>
        </div>

        <!-- Messages de statut -->
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
                        <table class="table table-striped table-hover" id="mediasTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Prévisualisation</th>
                                    <th>Chemin</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Contenu associé</th>
                                    <th>Date création</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($medias as $media)
                                <tr>
                                    <td><strong>#{{ $media->id_media }}</strong></td>
                                    <td>
                                        @if($media->id_type_media == 1) {{-- Image --}}
                                            <img src="{{ asset('storage/'.$media->chemin) }}"
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
                                    <td>
                                        <code class="text-muted small" title="{{ $media->chemin }}">
                                            {{ Str::limit($media->chemin, 30) }}
                                        </code>
                                    </td>
                                    <td>
                                        <span title="{{ $media->description }}">
                                            {{ Str::limit($media->description, 50) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge
                                            @if($media->id_type_media == 1) bg-success
                                            @elseif($media->id_type_media == 2) bg-primary
                                            @elseif($media->id_type_media == 3) bg-warning text-dark
                                            @else bg-secondary
                                            @endif">
                                            @if($media->id_type_media == 1) Image
                                            @elseif($media->id_type_media == 2) Vidéo
                                            @elseif($media->id_type_media == 3) Audio
                                            @else Autre
                                            @endif
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
                                        <small class="text-muted">
                                            {{ $media->created_at ? $media->created_at->format('d/m/Y') : 'N/A' }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <!-- Voir -->
                                            <a href="{{ route('admin.medias.show', $media->id_media) }}"
                                               class="btn btn-outline-info"
                                               title="Voir les détails"
                                               data-bs-toggle="tooltip">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- Modifier -->
                                            <a href="{{ route('admin.medias.edit', $media->id_media) }}"
                                               class="btn btn-outline-warning"
                                               title="Modifier"
                                               data-bs-toggle="tooltip">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <!-- Supprimer -->
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-delete"
                                                    title="Supprimer"
                                                    data-bs-toggle="tooltip"
                                                    data-id="{{ $media->id_media }}"
                                                    data-title="{{ $media->description }}">
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
                        <i class="bi bi-collection display-1 text-muted"></i>
                        <h4 class="text-muted mt-3">Aucun média trouvé</h4>
                        <p class="text-muted">Commencez par ajouter votre premier média.</p>
                        <a href="{{ route('admin.medias.create') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Ajouter un média
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

<!-- Formulaire de suppression caché -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<!-- Inclure DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation de DataTables
    const table = $('#mediasTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tous"]],
        "responsive": true,
        "autoWidth": false,
        "order": [[0, 'desc']],
        "dom": '<"row"<"col-md-6"B><"col-md-6"f>>rt<"row"<"col-md-6"l><"col-md-6"p>>',
        "buttons": [
            {
                extend: 'copy',
                className: 'btn btn-secondary btn-sm',
                text: '<i class="bi bi-files"></i> Copier'
            },
            {
                extend: 'excel',
                className: 'btn btn-success btn-sm',
                text: '<i class="bi bi-file-earmark-excel"></i> Excel'
            },
            {
                extend: 'pdf',
                className: 'btn btn-danger btn-sm',
                text: '<i class="bi bi-file-earmark-pdf"></i> PDF'
            },
            {
                extend: 'print',
                className: 'btn btn-info btn-sm',
                text: '<i class="bi bi-printer"></i> Imprimer'
            },
            {
                extend: 'colvis',
                className: 'btn btn-warning btn-sm',
                text: '<i class="bi bi-eye"></i> Colonnes'
            }
        ],
        "columnDefs": [
            { "orderable": false, "targets": [1, 7] }, // Désactiver le tri sur image et actions
            { "searchable": false, "targets": [1, 7] }, // Désactiver la recherche sur image et actions
            { "width": "80px", "targets": [1, 7] }, // Largeur fixe pour image et actions
            { "className": "dt-center", "targets": [1, 7] } // Centrer image et actions
        ]
    });

    // Initialisation des tooltips Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Gestion de la suppression avec SweetAlert
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const mediaId = this.getAttribute('data-id');
            const mediaTitle = this.getAttribute('data-title') || 'ce média';

            Swal.fire({
                title: 'Êtes-vous sûr ?',
                html: `Vous êtes sur le point de supprimer <strong>${mediaTitle}</strong>. Cette action est irréversible !`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler',
                reverseButtons: true,
                backdrop: true,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mettre à jour l'action du formulaire
                    const form = document.getElementById('deleteForm');
                    form.action = `{{ url('admin/medias') }}/${mediaId}`;
                    form.submit();
                }
            });
        });
    });

    // Re-initialiser les tooltips après chaque redessin de DataTables
    table.on('draw', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
});
</script>
@endpush

@push('styles')
<style>
    .table td {
        vertical-align: middle;
    }

    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
    }

    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.04);
    }

    /* Style pour DataTables */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.375rem 0.75rem;
    }

    .dt-buttons .btn {
        margin-right: 0.25rem;
        margin-bottom: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dataTables_wrapper .dt-buttons {
            text-align: center;
        }

        .btn-group-sm > .btn {
            padding: 0.2rem 0.4rem;
            font-size: 0.75rem;
        }
    }
</style>
@endpush
