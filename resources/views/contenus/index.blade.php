@extends('layouts.layout')

@section('page-title', 'Gestion des Contenus')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                        <h4 class="mb-0 fw-bold">
                            <i class="bi bi-journal-text me-2"></i> Liste des Contenus
                        </h4>
                        <a href="{{ route('admin.contenus.create') }}" class="btn btn-light btn-lg">
                            <i class="bi bi-plus-circle me-2"></i> Nouveau Contenu
                        </a>
                    </div>
                    <div class="card-body p-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="contenusTable" class="table table-striped table-hover align-middle w-100">
                                <thead class="table-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Titre</th>
                                        <th>Type</th>
                                        <th>Région</th>
                                        <th>Langue</th>
                                        <th>Statut</th>
                                        <th>Auteur</th>
                                        <th>Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contenus as $contenu)
                                        <tr>
                                            <td><span class="badge bg-secondary">#{{ $contenu->id_contenu }}</span></td>
                                            <td>
                                                @if ($contenu->medias && $contenu->medias->count() > 0)
                                                    @php
                                                        $media = $contenu->medias->first();
                                                        $isVideo = $media->id_type_media == 2;
                                                        $isAudio = $media->id_type_media == 3;
                                                    @endphp

                                                    @if ($isVideo)
                                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                                            style="width: 60px; height: 60px;">
                                                            <i class="bi bi-play-circle text-primary fs-4"></i>
                                                        </div>
                                                    @elseif($isAudio)
                                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                                            style="width: 60px; height: 60px;">
                                                            <i class="bi bi-music-note text-success fs-4"></i>
                                                        </div>
                                                    @else
                                                        <img src="{{ asset('storage/' . $media->chemin) }}" width="60"
                                                            height="60" class="rounded border" style="object-fit: cover;"
                                                            alt="{{ $contenu->titre }}"
                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                    @endif
                                                @endif
                                                <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 60px; {{ $contenu->medias && $contenu->medias->count() > 0 ? 'display: none;' : '' }}">
                                                    <i class="bi bi-image text-muted fs-4"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <strong class="d-block">{{ $contenu->titre }}</strong>
                                                <small class="text-muted">{{ Str::limit(strip_tags($contenu->texte), 50) }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-dark">
                                                    {{ $contenu->typeContenu->nom_contenu ?? 'Non défini' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $contenu->region->nom_region ?? 'Non définie' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $contenu->langue->nom_langue ?? 'Non définie' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge
                                            @if ($contenu->statut == 'validé') bg-success
                                            @elseif($contenu->statut == 'rejeté') bg-danger
                                            @elseif($contenu->statut == 'en_attente') bg-warning text-dark
                                            @else bg-secondary @endif">
                                                    {{ $contenu->statut }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                                        style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                        {{ strtoupper(substr($contenu->auteur->name ?? 'A', 0, 1)) }}
                                                    </div>
                                                    <small>{{ $contenu->auteur->name ?? 'Anonyme' }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $contenu->date_creation ? \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') : '—' }}
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    @php
                                                        // Vérifier les permissions
                                                        $user = Auth::user();
                                                        $userRole = $user ? optional($user->role)->nom_role : null;
                                                        $isAdmin = $userRole === 'Administrateur';
                                                        $isModerator = $userRole === 'Modérateur';
                                                        $isAdminOrModerator = $isAdmin || $isModerator;
                                                        $userId = $user ? ($user->id ?? $user->getKey()) : null;

                                                        // Définir les permissions
                                                        $canEdit = $user && (
                                                            $userId == $contenu->id_auteur ||
                                                            $isAdminOrModerator
                                                        );
                                                        $canDelete = $user && (
                                                            $userId == $contenu->id_auteur ||
                                                            $isAdmin
                                                        );
                                                    @endphp

                                                    <!-- Bouton Voir - TOUJOURS visible -->
                                                    <a href="{{ route('admin.contenus.show', $contenu->id_contenu) }}"
                                                        class="btn btn-outline-primary btn-sm"
                                                        title="Voir le détail"
                                                        data-bs-toggle="tooltip">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    <!-- Bouton Modifier - Visible selon permissions -->
                                                    @if($canEdit)
                                                        <a href="{{ route('admin.contenus.edit', $contenu->id_contenu) }}"
                                                            class="btn btn-outline-warning btn-sm"
                                                            title="Modifier"
                                                            data-bs-toggle="tooltip">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                    @endif

                                                    <!-- Boutons Valider/Rejeter - SEULEMENT pour les modérateurs ET contenus en attente -->
                                                    @if($isModerator && $contenu->statut == 'en_attente')
                                                        <!-- Valider -->
                                                        <form action="{{ route('admin.moderateur.valider', $contenu->id_contenu) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-outline-success btn-sm"
                                                                    title="Valider ce contenu"
                                                                    onclick="return confirm('Valider ce contenu ? Il sera publié publiquement.')">
                                                                <i class="bi bi-check"></i>
                                                            </button>
                                                        </form>

                                                        <!-- Rejeter -->
                                                        <form action="{{ route('admin.moderateur.rejeter', $contenu->id_contenu) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                                    title="Rejeter ce contenu"
                                                                    onclick="return confirm('Rejeter ce contenu ?')">
                                                                <i class="bi bi-x"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <!-- Bouton Supprimer - Visible selon permissions -->
                                                    @if($canDelete)
                                                        <form action="{{ route('admin.contenus.destroy', $contenu->id_contenu) }}"
                                                            method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-outline-danger btn-sm btn-delete"
                                                                title="Supprimer"
                                                                data-bs-toggle="tooltip">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            console.log('Initialisation DataTables...');

            // Initialiser DataTables
            var table = $('#contenusTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
                },
                "pageLength": 10,
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Tous"]
                ],
                "responsive": true,
                "autoWidth": false,
                "order": [
                    [0, 'desc']
                ]
            });

            console.log('DataTables initialisé avec succès');

            // Confirmation de suppression
            $('#contenusTable').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cette action est irréversible !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Confirmation pour valider
            $('#contenusTable').on('click', 'button[title="Valider ce contenu"]', function(e) {
                if (!confirm('Valider ce contenu ? Il sera publié publiquement.')) {
                    e.preventDefault();
                }
            });

            // Confirmation pour rejeter
            $('#contenusTable').on('click', 'button[title="Rejeter ce contenu"]', function(e) {
                if (!confirm('Rejeter ce contenu ?')) {
                    e.preventDefault();
                }
            });

            // Initialisation des tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>

    <style>
        .table td {
            vertical-align: middle;
        }

        .btn-group .btn {
            margin: 0 2px;
            border-radius: 0.375rem !important;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .btn i {
            font-size: 0.9rem;
        }

        .btn-group {
            gap: 4px;
        }

        /* Style spécial pour les boutons de modération */
        .btn-outline-success:hover {
            background-color: #198754;
            color: white;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
@endsection
