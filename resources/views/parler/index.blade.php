@extends('layouts.layout')

@section('page-title', 'Associations Langue/Région') {{-- Ajoutez cette ligne --}}

@section('content')
<main class="app-main bg-light min-vh-100">
    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-link-45deg"></i> Association Langue / Région
            </h3>
            <a href="{{ route('admin.parler.create') }}" class="btn btn-gradient btn-lg shadow"> {{-- Corrigez la route --}}
                <i class="bi bi-plus-circle"></i> Ajouter une association
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                <table id="parlerTable" class="table table-striped table-hover align-middle w-100"> {{-- Ajoutez table-striped et w-100 --}}
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Région</th>
                            <th>Langue</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parlers as $parler)
                            <tr> {{-- Retirez table-row-hover --}}
                                <td><span class="badge bg-secondary">{{ $parler->id_parler }}</span></td>
                                <td>
                                    <span class="badge bg-info">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $parler->region->nom_region ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-translate me-1"></i>{{ $parler->langue->nom_langue ?? '-' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <!-- Voir -->
                                        <a href="{{ route('admin.parler.show', $parler) }}" {{-- Corrigez la route --}}
                                           class="btn btn-sm btn-outline-info rounded-circle" title="Voir">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <!-- Modifier -->
                                        <a href="{{ route('admin.parler.edit', $parler) }}" {{-- Corrigez la route --}}
                                           class="btn btn-sm btn-outline-warning rounded-circle" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <!-- Supprimer -->
                                        <form action="{{ route('admin.parler.destroy', $parler) }}" method="POST" class="d-inline"> {{-- Corrigez la route et utilisez d-inline --}}
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

@section('scripts') {{-- Utilisez @section au lieu de @push --}}
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
            "targets": 3 // Colonne Actions
        }]
    });

    // Confirmation moderne avec SweetAlert2
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        Swal.fire({
            title: 'Supprimer cette association ?',
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
    .btn-gradient:hover {
        transform: scale(1.05);
        opacity: 0.9;
    }
    /* DataTables fournit déjà le hover, pas besoin de table-row-hover */
</style>
@endsection
