@extends('layouts.layout')

@section('page-title', 'Profil Utilisateur')

@section('content')
<main class="app-main min-vh-100">
    <!-- En-tête avec photo de couverture -->
    <div class="header-profile bg-gradient-primary position-relative" style="height: 200px;">
        <div class="container-fluid h-100">
            <div class="row h-100 align-items-end pb-4">
                <div class="col">
                    <div class="d-flex align-items-center">
                        <div class="profile-avatar-container position-relative" style="margin-top: 50px;">
                            <!-- Avatar/Photo de profil -->
                            @php
                                $initial = strtoupper(substr($user->name ?? 'U', 0, 1));
                                if ($user->photo) {
                                    $photoPath = 'adminlte/img/' . $user->photo;
                                    $photoUrl = asset($photoPath);
                                    $photoExists = file_exists(public_path($photoPath));
                                }
                            @endphp

                            @if($user->photo && ($photoExists ?? false))
                                <img src="{{ $photoUrl }}"
                                     class="profile-avatar rounded-circle border-4 border-white shadow-lg"
                                     width="120" height="120"
                                     alt="{{ $user->name }}"
                                     onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif

                            <!-- Fallback avatar -->
                            <div class="profile-avatar rounded-circle border-4 border-white shadow-lg d-flex align-items-center justify-content-center {{ $user->photo && ($photoExists ?? false) ? 'd-none' : '' }}"
                                 style="width: 120px; height: 120px; background: linear-gradient(45deg,
                                 @switch($user->id % 5)
                                     @case(0) #4e73df, #224abe @break
                                     @case(1) #1cc88a, #13855c @break
                                     @case(2) #36b9cc, #258391 @break
                                     @case(3) #f6c23e, #dda20a @break
                                     @default #e74a3b, #be2617
                                 @endswitch);">
                                <span class="text-white fw-bold display-6">{{ $initial }}</span>
                            </div>

                            <!-- Badge de statut -->
                            <div class="position-absolute bottom-0 end-0">
                                <span class="badge rounded-pill {{ $user->statut == 'actif' ? 'bg-success' : 'bg-danger' }} p-2">
                                    <i class="bi {{ $user->statut == 'actif' ? 'bi-check-circle' : 'bi-x-circle' }} me-1"></i>
                                    {{ ucfirst($user->statut) }}
                                </span>
                            </div>
                        </div>

                        <div class="ms-4 text-white">
                            <h1 class="display-6 fw-bold mb-2">{{ $user->name }} {{ $user->prenom }}</h1>
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <span class="badge bg-white text-primary fs-6 px-3 py-2">
                                    <i class="bi bi-person-badge me-2"></i>
                                    {{ $user->role->nom_role ?? 'Aucun rôle' }}
                                </span>
                                <span class="badge bg-white text-primary fs-6 px-3 py-2">
                                    <i class="bi bi-envelope me-2"></i>
                                    {{ $user->email }}
                                </span>
                                <span class="badge bg-white text-primary fs-6 px-3 py-2">
                                    <i class="bi bi-translate me-2"></i>
                                    {{ $user->langue->nom_langue ?? 'Français' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="position-absolute top-0 end-0 m-4">
            <div class="btn-group shadow-sm">
                <a href="{{ route('admin.users.edit', $user->id) }}"
                   class="btn btn-light rounded-start-3">
                    <i class="bi bi-pencil me-2"></i> Modifier
                </a>
                @if($user->statut == 'actif')
                    <form action="{{ route('admin.users.desactiver', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-person-x me-2"></i> Désactiver
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.users.activer', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-person-check me-2"></i> Activer
                        </button>
                    </form>
                @endif
                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-secondary rounded-end-3">
                    <i class="bi bi-arrow-left me-2"></i> Retour
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Informations personnelles -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-person-lines-fill me-2"></i> Informations Personnelles
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label text-muted small mb-1">Nom complet</label>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person me-3 text-primary fs-5"></i>
                                    <h6 class="mb-0">{{ $user->name }} {{ $user->prenom }}</h6>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-muted small mb-1">Email</label>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-envelope me-3 text-primary fs-5"></i>
                                    <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                        <h6 class="mb-0">{{ $user->email }}</h6>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-muted small mb-1">Rôle</label>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-shield-check me-3 text-primary fs-5"></i>
                                    <span class="badge
                                        @switch($user->role->nom_role ?? '')
                                            @case('Administrateur') bg-danger
                                            @case('Modérateur') bg-warning text-dark
                                            @case('Contributeur') bg-info
                                            @default bg-secondary
                                        @endswitch fs-6 px-3 py-2">
                                        {{ $user->role->nom_role ?? 'Non assigné' }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-muted small mb-1">Langue préférée</label>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-translate me-3 text-primary fs-5"></i>
                                    <span class="badge bg-light text-dark border fs-6 px-3 py-2">
                                        {{ $user->langue->nom_langue ?? 'Français' }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-muted small mb-1">Date de création</label>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar-plus me-3 text-primary fs-5"></i>
                                    <h6 class="mb-0">{{ $user->created_at->format('d/m/Y H:i') }}</h6>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-muted small mb-1">Dernière modification</label>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar-check me-3 text-primary fs-5"></i>
                                    <h6 class="mb-0">{{ $user->updated_at->format('d/m/Y H:i') }}</h6>
                                </div>
                            </div>
                        </div>

                        @if($user->adresse || $user->telephone)
                        <div class="mt-4 pt-4 border-top">
                            <h6 class="fw-bold text-muted mb-3">Coordonnées supplémentaires</h6>
                            <div class="row">
                                @if($user->adresse)
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Adresse</label>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-geo-alt me-3 text-primary fs-5"></i>
                                        <h6 class="mb-0">{{ $user->adresse }}</h6>
                                    </div>
                                </div>
                                @endif

                                @if($user->telephone)
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Téléphone</label>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-telephone me-3 text-primary fs-5"></i>
                                        <a href="tel:{{ $user->telephone }}" class="text-decoration-none">
                                            <h6 class="mb-0">{{ $user->telephone }}</h6>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Section des permissions (si applicable) -->
                @if($user->role && $user->role->permissions && $user->role->permissions->isNotEmpty())
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-key-fill me-2"></i> Permissions du Rôle
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($user->role->permissions as $permission)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="d-flex align-items-center p-3 border rounded-3 bg-light">
                                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                                    <div>
                                        <h6 class="mb-0">{{ $permission->nom_permission ?? 'Permission' }}</h6>
                                        <small class="text-muted">{{ $permission->description ?? '' }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Statistiques et métriques -->
            <div class="col-lg-4">
                <!-- Carte de statut -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-graph-up me-2"></i> Statut du Compte
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="position-relative d-inline-block mb-3">
                                @php
                                    $statutPercentage = $user->statut == 'actif' ? 100 : 0;
                                    $statutColor = $user->statut == 'actif' ? '#1cc88a' : '#e74a3b';
                                @endphp

                                <svg width="120" height="120" viewBox="0 0 36 36" class="circular-chart">
                                    <path class="circle-bg"
                                          d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831"
                                          fill="none"
                                          stroke="#eee"
                                          stroke-width="3"/>
                                    <path class="circle"
                                          stroke-dasharray="{{ $statutPercentage }}, 100"
                                          d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831"
                                          fill="none"
                                          stroke="{{ $statutColor }}"
                                          stroke-width="3"
                                          stroke-linecap="round"/>
                                    <text x="18" y="20.35" class="percentage">{{ $statutPercentage }}%</text>
                                </svg>
                            </div>
                            <h4 class="fw-bold mb-2">
                                Compte {{ $user->statut == 'actif' ? 'Actif' : 'Inactif' }}
                            </h4>
                            <p class="text-muted mb-0">
                                @if($user->statut == 'actif')
                                    L'utilisateur peut accéder à toutes les fonctionnalités
                                @else
                                    L'accès aux fonctionnalités est restreint
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-lightning-charge me-2"></i> Actions Rapides
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="mailto:{{ $user->email }}" class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-envelope me-2"></i> Envoyer un email
                            </a>

                            <!-- Vérifier si la route reset-password existe -->
                            @if(Route::has('admin.users.reset-password'))
                            <button class="btn btn-outline-warning btn-lg" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">
                                <i class="bi bi-key me-2"></i> Réinitialiser le mot de passe
                            </button>
                            @endif

                            <button class="btn btn-outline-danger btn-lg btn-delete-user"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }} {{ $user->prenom }}">
                                <i class="bi bi-trash me-2"></i> Supprimer l'utilisateur
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Dernière activité -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-clock-history me-2"></i> Activité Récente
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Compte créé</h6>
                                    <p class="text-muted small mb-0">{{ $user->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Dernière connexion</h6>
                                    <p class="text-muted small mb-0">
                                        @if(isset($user->last_login_at) && $user->last_login_at)
                                            {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}
                                        @else
                                            Jamais connecté
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Dernière modification</h6>
                                    <p class="text-muted small mb-0">{{ $user->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal de réinitialisation de mot de passe (conditionnel) -->
@if(Route::has('admin.users.reset-password'))
<div class="modal fade" id="resetPasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">
                    <i class="bi bi-key me-2"></i> Réinitialiser le mot de passe
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous réinitialiser le mot de passe de <strong>{{ $user->name }} {{ $user->prenom }}</strong> ?</p>
                <p class="text-muted small">
                    <i class="bi bi-info-circle me-1"></i>
                    Un email contenant un lien de réinitialisation sera envoyé à l'utilisateur.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-key me-1"></i> Réinitialiser
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal de suppression -->
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
                <p>Êtes-vous sûr de vouloir supprimer définitivement l'utilisateur :</p>
                <p class="fw-bold" id="deleteUserName"></p>
                <div class="alert alert-danger mt-3">
                    <i class="bi bi-exclamation-octagon me-2"></i>
                    <strong>Attention !</strong> Cette action supprimera :
                    <ul class="mb-0 mt-2 small">
                        <li>Toutes les données personnelles de l'utilisateur</li>
                        <li>L'historique d'activité</li>
                        <li>Les permissions associées</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Gestion de la suppression
    $('.btn-delete-user').on('click', function() {
        const userId = $(this).data('id');
        const userName = $(this).data('name');

        $('#deleteUserName').text(userName);
        $('#deleteForm').attr('action', '/admin/users/' + userId);

        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    });

    // Animation pour les cartes
    $('.card').hover(
        function() {
            $(this).css('transform', 'translateY(-5px)');
            $(this).css('box-shadow', '0 10px 25px rgba(0,0,0,0.1)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
            $(this).css('box-shadow', '');
        }
    );

    // Vérifier si l'image de profil existe
    const profileImg = $('.profile-avatar-container img');
    if (profileImg.length) {
        const img = profileImg[0];
        const fallback = img.nextElementSibling;

        const testImage = new Image();
        testImage.onerror = function() {
            img.style.display = 'none';
            if (fallback) fallback.style.display = 'flex';
        };
        testImage.src = img.src;
    }

    // Animation du graphique circulaire
    function animateCircle() {
        const circle = $('.circle');
        if (circle.length) {
            const length = circle[0].getTotalLength();
            circle.css('stroke-dasharray', length + ' ' + length);
            circle.css('stroke-dashoffset', length);

            setTimeout(() => {
                circle.css('transition', 'stroke-dashoffset 1.5s ease-in-out');
                circle.css('stroke-dashoffset', '0');
            }, 500);
        }
    }

    animateCircle();
});
</script>

<style>
/* Styles pour le header de profil */
.header-profile {
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
}

.profile-avatar {
    border: 4px solid white;
    object-fit: cover;
    transition: all 0.3s ease;
}

.profile-avatar-container:hover .profile-avatar {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

/* Graphique circulaire */
.circular-chart {
    display: block;
    margin: 10px auto;
    max-width: 120px;
}

.circle {
    fill: none;
    stroke-width: 3;
    stroke-linecap: round;
}

.circle-bg {
    fill: none;
    stroke-width: 3;
}

.percentage {
    fill: #666;
    font-size: 0.5em;
    text-anchor: middle;
    font-weight: bold;
}

/* Timeline */
.timeline {
    position: relative;
    padding-left: 20px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 7px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
}

.timeline-content {
    padding-left: 10px;
}

/* Boutons */
.btn-group .btn {
    border-radius: 0;
}

.btn-group .btn:first-child {
    border-top-left-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}

.btn-group .btn:last-child {
    border-top-right-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
}

/* Animations */
.card {
    transition: all 0.3s ease;
}

/* Responsive */
@media (max-width: 768px) {
    .header-profile {
        height: 250px;
    }

    .profile-avatar {
        width: 90px !important;
        height: 90px !important;
    }

    .profile-avatar-container {
        margin-top: 30px !important;
    }

    .btn-group {
        flex-direction: column;
        gap: 10px;
    }

    .btn-group .btn {
        border-radius: 0.5rem !important;
        width: 100%;
    }
}
</style>
@endsection

