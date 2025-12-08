@extends('layouts.layout')

@section('page-title', 'Gestion des Commentaires') {{-- Ajoutez cette ligne --}}

@section('content')
    <main class="app-main">
        <div class="container-fluid mt-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold text-primary">
                    <i class="bi bi-chat-dots"></i> Commentaires
                </h3>
                <a href="{{ route('admin.commentaires.create') }}" class="btn btn-gradient btn-lg"> {{-- Corrigez la route --}}
                    <i class="bi bi-plus-circle"></i> Ajouter un commentaire
                </a>
            </div>

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <table id="commentairesTable" class="table table-hover align-middle datatable"> {{-- Ajoutez class datatable --}}
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Texte</th>
                                <th>Note</th>
                                <th>Date</th>
                                <th>Utilisateur</th>
                                <th>Contenu</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commentaires as $commentaire)
                                <tr class="table-row-hover"> {{-- Ajoutez class pour hover --}}
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
                                        {{ $commentaire->utilisateur->name ?? $commentaire->utilisateur->nom ?? '-' }} {{-- Corrigez le nom --}}
                                    </td>
                                    <td>
                                        <i class="bi bi-file-text"></i>
                                        {{ $commentaire->contenu->titre ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.commentaires.show', $commentaire) }}" {{-- Corrigez la route --}}
                                                class="btn btn-sm btn-outline-info rounded-circle" title="Voir"> {{-- Ajoutez rounded-circle --}}
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.commentaires.edit', $commentaire) }}" {{-- Corrigez la route --}}
                                                class="btn btn-sm btn-outline-warning rounded-circle" title="Modifier"> {{-- Ajoutez rounded-circle --}}
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.commentaires.destroy', $commentaire) }}" method="POST" {{-- Corrigez la route --}}
                                                class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger rounded-circle btn-delete" title="Supprimer"> {{-- Ajoutez rounded-circle --}}
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
        // Initialisation unique de DataTables
        $('#commentairesTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            },
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50],
            "columnDefs": [{
                "orderable": false,
                "targets": 6 // Désactive le tri sur la colonne Actions
            }],
            "order": [[3, 'desc']] // Tri par date décroissante par défaut
        });

        // Confirmation avec SweetAlert2
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Supprimer ce commentaire ?',
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
    .table-row-hover:hover {
        background-color: rgba(0,0,0,0.05) !important;
        transition: 0.3s;
    }
    .btn-group .btn {
        margin: 0 2px;
        transition: 0.3s;
    }
    .btn-group .btn:hover {
        transform: scale(1.1);
    }
    /* Style pour les étoiles des notes */
    .badge.bg-info {
        font-size: 0.85em;
    }
</style>
@endsection
