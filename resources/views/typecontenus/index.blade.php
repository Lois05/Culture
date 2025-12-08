@extends('layouts.layout')

@section('page-title', 'Types de Contenus')

@section('content')
<main class="app-main bg-light min-vh-100">
    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-tags"></i> Types de contenus
            </h3>
            <a href="{{ route('admin.typecontenus.create') }}" class="btn btn-gradient btn-lg shadow">
                <i class="bi bi-plus-circle"></i> Ajouter un type
            </a>
        </div>

        {{-- Message flash --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                <table id="typecontenusTable" class="table table-striped table-hover align-middle w-100">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Nom du type</th>
                            <th>Description</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($typecontenus as $type)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $type->id_type_contenu }}</span></td>
                            <td><span class="badge bg-info text-dark">{{ $type->nom_contenu }}</span></td>
                            <td>{{ Str::limit($type->description, 80) }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <!-- Voir -->
                                    <a href="{{ route('admin.typecontenus.show', $type->id_type_contenu) }}"
                                       class="btn btn-sm btn-outline-info rounded-circle" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <!-- Modifier -->
                                    <a href="{{ route('admin.typecontenus.edit', $type->id_type_contenu) }}"
                                       class="btn btn-sm btn-outline-warning rounded-circle" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <!-- Supprimer -->
                                    <form action="{{ route('admin.typecontenus.destroy', $type->id_type_contenu) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle btn-delete" title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#typecontenusTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50],
        "responsive": true,
        "columnDefs": [{
            "orderable": false,
            "targets": 3 // Colonne Actions
        }]
    });

    // Confirmation moderne avec SweetAlert2
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        Swal.fire({
            title: 'Supprimer ce type de contenu ?',
            text: "Cette action est irréversible.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

<style>
    .btn-gradient {
        background: linear-gradient(45deg, #0d6efd, #6610f2);
        color: #fff;
        border: none;
        transition: 0.3s;
    }
    .btn-gradient:hover { transform: scale(1.05); opacity: 0.9; }
</style>
@endsection
