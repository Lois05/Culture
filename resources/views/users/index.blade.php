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
                            <th width="60">#</th>
                            <th width="80">Photo</th>
                            <th>Nom Complet</th>
                            <th>Email</th>
                            <th width="100">Rôle</th>
                            <th width="100">Langue</th>
                            <th width="90">Statut</th>
                            <th width="120" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">#{{ $user->id }}</span>
                            </td>
                            <td>
                                @php
                                    // Déterminer l'initiale pour l'avatar
                                    $initial = strtoupper(substr($user->name ?? 'U', 0, 1));

                                    // Vérifier si l'utilisateur a une photo
                                    if ($user->photo) {
                                        // Construire le chemin de la photo
                                        $photoPath = 'adminlte/img/' . $user->photo;
                                        $photoUrl = asset($photoPath);
                                        $photoExists = file_exists(public_path($photoPath));
                                    }
                                @endphp

                                @if($user->photo && ($photoExists ?? false))
                                    <!-- Photo existante -->
                                    <div class="position-relative">
                                        <img src="{{ $photoUrl }}"
                                             class="user-avatar rounded-circle border"
                                             width="45" height="45"
                                             alt="{{ $user->name }}"
                                             onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="user-avatar-fallback rounded-circle border d-none"
                                             style="width: 45px; height: 45px; background: linear-gradient(45deg, #4e73df, #224abe);">
                                            <span class="text-white fw-bold">{{ $initial }}</span>
                                        </div>
                                    </div>
                                @else
                                    <!-- Avatar avec initiales -->
                                    <div class="user-avatar rounded-circle border d-flex align-items-center justify-content-center"
                                         style="width: 45px; height: 45px; background: linear-gradient(45deg,
                                         @switch($user->id % 5)
                                             @case(0) #4e73df, #224abe @break
                                             @case(1) #1cc88a, #13855c @break
                                             @case(2) #36b9cc, #258391 @break
                                             @case(3) #f6c23e, #dda20a @break
                                             @default #e74a3b, #be2617
                                         @endswitch);">
                                        <span class="text-white fw-bold">{{ $initial }}</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <strong class="mb-1">{{ $user->name }} {{ $user->prenom }}</strong>
                                    <small class="text-muted">
                                        <i class="bi bi-person-badge me-1"></i>
                                        {{ $user->role->nom_role ?? 'Aucun rôle' }}
                                    </small>
                                </div>
                            </td>
                            <td>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                    <i class="bi bi-envelope me-1"></i> {{ $user->email }}
                                </a>
                            </td>
                            <td>
                                <span class="badge
                                    @switch($user->role->nom_role ?? '')
                                        @case('Administrateur') bg-danger
                                        @case('Modérateur') bg-warning text-dark
                                        @case('Contributeur') bg-info
                                        @default bg-secondary
                                    @endswitch">
                                    {{ $user->role->nom_role ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-translate me-1"></i>
                                    {{ $user->langue->nom_langue ?? 'FR' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $user->statut == 'actif' ? 'bg-success' : 'bg-danger' }}">
                                    <i class="bi {{ $user->statut == 'actif' ? 'bi-check-circle' : 'bi-x-circle' }} me-1"></i>
                                    {{ ucfirst($user->statut) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <!-- Voir -->
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                       class="btn btn-outline-primary rounded-circle"
                                       title="Voir le profil"
                                       data-bs-toggle="tooltip">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!-- Modifier -->
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="btn btn-outline-warning rounded-circle"
                                       title="Modifier"
                                       data-bs-toggle="tooltip">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <!-- Changer statut -->
                                    @if($user->statut == 'actif')
                                        <form action="{{ route('admin.users.desactiver', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-outline-secondary rounded-circle"
                                                    title="Désactiver"
                                                    data-bs-toggle="tooltip">
                                                <i class="bi bi-person-x"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.users.activer', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-outline-success rounded-circle"
                                                    title="Activer"
                                                    data-bs-toggle="tooltip">
                                                <i class="bi bi-person-check"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Supprimer -->
                                    <button type="button"
                                            class="btn btn-outline-danger rounded-circle btn-delete"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }} {{ $user->prenom }}"
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
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i> Confirmer la suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer l'utilisateur :</p>
                <p class="fw-bold" id="deleteUserName"></p>
                <p class="text-danger small">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    Cette action est irréversible. Toutes les données associées seront supprimées.
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

<!-- SweetAlert2 (optionnel) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Initialiser DataTables
    $('#usersTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        "pageLength": 10,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tous"]],
        "order": [[0, 'desc']],
        "responsive": true,
        "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        "columnDefs": [{
            "orderable": false,
            "targets": [1, 7] // Photo et Actions
        }],
        "drawCallback": function(settings) {
            // Réinitialiser les tooltips après chaque redessin
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    });

    // Initialiser les tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Gestion de la suppression avec modal
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();

        const userId = $(this).data('id');
        const userName = $(this).data('name');

        // Mettre à jour le modal
        $('#deleteUserName').text(userName);
        $('#deleteForm').attr('action', '/admin/users/' + userId);

        // Afficher le modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    });

    // Optionnel : Gestion avec SweetAlert2
    function confirmDeleteWithSweetAlert(userId, userName) {
        Swal.fire({
            title: 'Supprimer cet utilisateur ?',
            html: `Êtes-vous sûr de vouloir supprimer <strong>${userName}</strong> ?<br>
                   <small class="text-danger">Cette action est irréversible.</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler',
            width: 500
        }).then((result) => {
            if (result.isConfirmed) {
                // Soumettre le formulaire
                $(`#deleteForm${userId}`).submit();
            }
        });
    }

    // Vérifier si les images existent
    $('.user-avatar img').each(function() {
        const img = this;
        const fallback = img.nextElementSibling;

        // Tester si l'image se charge
        const testImage = new Image();
        testImage.onload = function() {
            // Image chargée avec succès
        };
        testImage.onerror = function() {
            // Image non trouvée, afficher l'avatar
            img.style.display = 'none';
            if (fallback) fallback.style.display = 'flex';
        };
        testImage.src = img.src;
    });
});

// Fonction pour générer un avatar avec initiales
function generateAvatar(name, size = 45) {
    const colors = [
        ['#4e73df', '#224abe'], // Bleu
        ['#1cc88a', '#13855c'], // Vert
        ['#36b9cc', '#258391'], // Cyan
        ['#f6c23e', '#dda20a'], // Jaune
        ['#e74a3b', '#be2617']  // Rouge
    ];

    const initial = name ? name.charAt(0).toUpperCase() : 'U';
    const colorIndex = (name ? name.charCodeAt(0) : 0) % colors.length;
    const [color1, color2] = colors[colorIndex];

    return `
        <div class="user-avatar rounded-circle border d-flex align-items-center justify-content-center"
             style="width: ${size}px; height: ${size}px; background: linear-gradient(45deg, ${color1}, ${color2});">
            <span class="text-white fw-bold" style="font-size: ${size * 0.4}px">${initial}</span>
        </div>
    `;
}
</script>

<style>
/* Styles pour les avatars */
.user-avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    object-fit: cover;
    border: 2px solid #dee2e6;
    transition: all 0.3s;
}

.user-avatar:hover {
    transform: scale(1.05);
    border-color: #4e73df;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.user-avatar-fallback {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/* Badges */
.badge {
    font-size: 0.85em;
    padding: 5px 10px;
}

/* Boutons d'action */
.btn-group-sm .btn {
    width: 35px;
    height: 35px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-group-sm .btn i {
    font-size: 0.9rem;
}

/* Cartes de statistiques */
.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}

/* Table responsive */
@media (max-width: 768px) {
    .btn-group-sm {
        flex-direction: column;
        gap: 2px;
    }

    .btn-group-sm .btn {
        width: 32px;
        height: 32px;
    }

    .user-avatar {
        width: 40px !important;
        height: 40px !important;
    }
}
</style>
@endsection

