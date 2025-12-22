{{-- resources/views/moderateur/index.blade.php --}}
@extends('layouts.layout')

@section('page-title', 'Modération des Contenus')

@section('content')
<main class="app-main min-vh-100">
    <div class="container-fluid mt-4">
        <!-- En-tête avec statistiques -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-6 fw-bold text-warning">
                    <i class="fas fa-clipboard-check me-2"></i> Modération des Contenus
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modération</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#helpModal">
                    <i class="fas fa-question-circle me-2"></i> Aide
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Retour
                </a>
            </div>
        </div>

        <!-- Cartes de statistiques -->
        <div class="row mb-4">
            <div class="col-md-3 col-6 mb-3">
                <div class="card bg-gradient-warning text-white shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="mb-0">{{ $contenusEnAttente->total() }}</h2>
                                <small>En attente</small>
                            </div>
                            <i class="fas fa-clock fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card bg-gradient-info text-white shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="mb-0">{{ $totalContenusValides ?? 0 }}</h2>
                                <small>Validés</small>
                            </div>
                            <i class="fas fa-check-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card bg-gradient-danger text-white shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="mb-0">{{ $totalContenusRejetes ?? 0 }}</h2>
                                <small>Rejetés</small>
                            </div>
                            <i class="fas fa-times-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card bg-gradient-success text-white shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="mb-0">{{ $totalContenusTotal ?? 0 }}</h2>
                                <small>Total</small>
                            </div>
                            <i class="fas fa-list-alt fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau de modération -->
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-warning">
                        <i class="fas fa-list me-2"></i> Contenus en attente de modération
                    </h5>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-warning" id="refreshBtn">
                            <i class="fas fa-sync-alt me-1"></i> Actualiser
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i> Filtrer
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Tous les types</a></li>
                                <li><a class="dropdown-item" href="#">Articles</a></li>
                                <li><a class="dropdown-item" href="#">Vidéos</a></li>
                                <li><a class="dropdown-item" href="#">Images</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if($contenusEnAttente->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success fa-5x"></i>
                        </div>
                        <h3 class="text-success mb-3">Félicitations !</h3>
                        <p class="text-muted mb-4">Aucun contenu en attente de modération.</p>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-success">
                            <i class="fas fa-home me-2"></i> Retour au tableau de bord
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-warning">
                                <tr>
                                    <th width="60">#ID</th>
                                    <th width="80">Type</th>
                                    <th>Titre & Description</th>
                                    <th width="180">Auteur</th>
                                    <th width="120">Région</th>
                                    <th width="140">Date</th>
                                    <th width="180" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contenusEnAttente as $contenu)
                                <tr class="border-bottom">
                                    <td>
                                        <span class="badge bg-secondary">#{{ $contenu->id_contenu }}</span>
                                    </td>
                                    <td>
                                        @if($contenu->typeContenu)
                                            <span class="badge bg-info">
                                                <i class="fas {{ $contenu->typeContenu->icon ?? 'fa-file' }} me-1"></i>
                                                {{ $contenu->typeContenu->nom_contenu }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong class="mb-1">{{ Str::limit($contenu->titre, 60) }}</strong>
                                            <small class="text-muted">
                                                {{ Str::limit(strip_tags($contenu->texte), 100) }}
                                            </small>
                                            <div class="mt-1">
                                                @if($contenu->tags && $contenu->tags->isNotEmpty())
                                                    @foreach($contenu->tags->take(2) as $tag)
                                                        <span class="badge bg-light text-dark border me-1">
                                                            #{{ $tag->nom_tag }}
                                                        </span>
                                                    @endforeach
                                                    @if($contenu->tags->count() > 2)
                                                        <span class="text-muted small">+{{ $contenu->tags->count() - 2 }}</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <div class="avatar-initials bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                     style="width: 32px; height: 32px;">
                                                    @if($contenu->auteur)
                                                        {{ strtoupper(substr($contenu->auteur->prenom ?? 'A', 0, 1)) }}
                                                    @else
                                                        A
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                @if($contenu->auteur)
                                                    <strong>{{ $contenu->auteur->prenom }} {{ $contenu->auteur->name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $contenu->auteur->email }}</small>
                                                @else
                                                    <span class="text-danger">Auteur supprimé</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($contenu->region)
                                            <span class="badge bg-light text-dark border">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                {{ $contenu->region->nom_region }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span>{{ $contenu->date_creation->format('d/m/Y') }}</span>
                                            <small class="text-muted">
                                                {{ $contenu->date_creation->format('H:i') }}
                                            </small>
                                            <small class="text-info">
                                                {{ $contenu->date_creation->diffForHumans() }}
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <!-- Bouton Voir -->
                                            <a href="{{ route('admin.moderateur.show', $contenu->id_contenu) }}"
                                               class="btn btn-info btn-action"
                                               data-bs-toggle="tooltip"
                                               title="Voir les détails">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Bouton Valider -->
                                            <form action="{{ route('admin.moderateur.valider', $contenu->id_contenu) }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('POST')
                                                <button type="submit"
                                                        class="btn btn-success btn-action"
                                                        data-bs-toggle="tooltip"
                                                        title="Valider ce contenu">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>

                                            <!-- Bouton Rejeter -->
                                            <button type="button"
                                                    class="btn btn-danger btn-action btn-reject"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#rejectModal"
                                                    data-contenu-id="{{ $contenu->id_contenu }}"
                                                    data-contenu-titre="{{ $contenu->titre }}"
                                                    title="Rejeter ce contenu">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Affichage de {{ $contenusEnAttente->firstItem() ?? 0 }} à {{ $contenusEnAttente->lastItem() ?? 0 }}
                            sur {{ $contenusEnAttente->total() }} contenus
                        </div>
                        <div>
                            {{ $contenusEnAttente->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

<!-- Modal de rejet -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i> Rejeter un contenu
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <p>Vous êtes sur le point de rejeter le contenu :</p>
                    <p class="fw-bold" id="contenuTitre"></p>

                    <div class="mb-3">
                        <label for="raison_rejet" class="form-label">Raison du rejet</label>
                        <select class="form-select" id="raison_rejet" name="raison_rejet" required>
                            <option value="">Sélectionnez une raison</option>
                            <option value="contenu_inappropriate">Contenu inapproprié</option>
                            <option value="qualite_insuffisante">Qualité insuffisante</option>
                            <option value="hors_sujet">Hors sujet</option>
                            <option value="violation_droits">Violation des droits d'auteur</option>
                            <option value="autre">Autre raison</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="commentaire_rejet" class="form-label">Commentaire (optionnel)</label>
                        <textarea class="form-control"
                                  id="commentaire_rejet"
                                  name="commentaire_rejet"
                                  rows="3"
                                  placeholder="Ajoutez un commentaire pour l'auteur..."></textarea>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle me-2"></i>
                        Cette action est définitive. L'auteur sera notifié du rejet.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times me-2"></i> Confirmer le rejet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal d'aide -->
<div class="modal fade" id="helpModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">
                    <i class="fas fa-question-circle me-2"></i> Guide de modération
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card border-warning">
                            <div class="card-body">
                                <h6 class="text-warning">
                                    <i class="fas fa-check-circle me-2"></i> Quand valider ?
                                </h6>
                                <ul class="mb-0">
                                    <li>Contenu approprié et de qualité</li>
                                    <li>Respect des règles de la communauté</li>
                                    <li>Information vérifiable</li>
                                    <li>Format correct</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-danger">
                            <div class="card-body">
                                <h6 class="text-danger">
                                    <i class="fas fa-times-circle me-2"></i> Quand rejeter ?
                                </h6>
                                <ul class="mb-0">
                                    <li>Contenu inapproprié</li>
                                    <li>Violation des droits</li>
                                    <li>Fausses informations</li>
                                    <li>Spam ou publicité non autorisée</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialiser les tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Gestion du bouton de rejet
    $('.btn-reject').on('click', function() {
        const contenuId = $(this).data('contenu-id');
        const contenuTitre = $(this).data('contenu-titre');

        $('#contenuTitre').text(contenuTitre);
        $('#rejectForm').attr('action', '/admin/moderateur/rejeter/' + contenuId);
    });

    // Actualisation de la page
    $('#refreshBtn').on('click', function() {
        $(this).find('i').addClass('fa-spin');
        location.reload();
    });

    // Confirmation avant validation
    $('form').on('submit', function(e) {
        const isValidationForm = $(this).attr('action') && $(this).attr('action').includes('valider');

        if (isValidationForm && !$(this).hasClass('skip-confirm')) {
            e.preventDefault();

            Swal.fire({
                title: 'Valider ce contenu ?',
                text: "Êtes-vous sûr de vouloir valider ce contenu ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1cc88a',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, valider',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).addClass('skip-confirm').submit();
                }
            });
        }
    });

    // Animation des cartes
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
});
</script>

<style>
/* Styles personnalisés */
.card {
    transition: all 0.3s ease;
    border: none;
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
}

.bg-gradient-danger {
    background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
}

.btn-action {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.btn-action:hover {
    transform: scale(1.1);
}

.avatar-initials {
    font-weight: bold;
}

.table tbody tr {
    transition: background-color 0.2s;
}

.table tbody tr:hover {
    background-color: rgba(246, 194, 62, 0.1);
}

/* Animation pour le bouton refresh */
.fa-spin {
    animation: fa-spin 1s infinite linear;
}

/* Responsive */
@media (max-width: 768px) {
    .btn-action {
        width: 36px;
        height: 36px;
    }

    .d-flex.gap-2 {
        gap: 0.5rem !important;
    }

    .card-body .table {
        font-size: 0.9rem;
    }
}
</style>
@endsection
