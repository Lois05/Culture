@extends('layouts.layout')

@section('page-title', 'Gestion des Utilisateurs')

@section('content')
<main class="app-main bg-light min-vh-100">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-people-fill"></i> Gestion des Utilisateurs
            </h3>
            <a href="{{ route('admin.users.create') }}" class="btn btn-gradient btn-lg shadow">
                <i class="bi bi-plus-circle"></i> Ajouter
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                <table id="usersTable" class="table table-striped table-hover align-middle w-100">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Langue</th>
                            <th>Statut</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $user->id }}</span></td>
                            <td>
                                @if($user->photo)
                                    <img src="{{ asset('storage/'.$user->photo) }}"
                                         class="rounded-circle" width="40" height="40" alt="photo">
                                @else
                                    <div class="avatar-circle bg-info text-white fw-bold">
                                        {{ strtoupper(substr($user->name,0,1)) }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->prenom }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge bg-primary">{{ $user->role->nom_role ?? '-' }}</span></td>
                            <td><span class="badge bg-warning text-dark">{{ $user->langue->nom_langue ?? '-' }}</span></td>
                            <td>
                                <span class="badge {{ $user->statut == 'actif' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($user->statut) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.users.show', $user) }}"
                                       class="btn btn-sm btn-outline-info rounded-circle" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="btn btn-sm btn-outline-warning rounded-circle" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
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
// Solution alternative avec délai
function initDataTables() {
    console.log('Tentative d\'initialisation DataTables...');

    if (typeof $.fn.DataTable === 'undefined') {
        console.error('DataTables non disponible, réessai dans 1 seconde...');
        setTimeout(initDataTables, 1000);
        return;
    }

    if ($.fn.DataTable.isDataTable('#usersTable')) {
        $('#usersTable').DataTable().destroy();
        console.log('Ancienne instance DataTables détruite');
    }

    $('#usersTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50],
        "responsive": true,
        "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        "columnDefs": [{
            "orderable": false,
            "targets": [1, 8] // Photo et Actions
        }]
    });

    console.log('✅ DataTables initialisé');
}

// Démarrer l'initialisation
$(document).ready(function() {
    setTimeout(initDataTables, 500);

    // SweetAlert2
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        Swal.fire({
            title: 'Supprimer cet utilisateur ?',
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
@endsection
