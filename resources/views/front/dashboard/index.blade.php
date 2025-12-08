@extends('layouts.dashboard')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Bienvenue dans votre espace personnel')

@section('content')
<div class="row fade-in">
    <!-- Statistiques -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card stat-card">
            <div class="stat-icon">
                <i class="bi bi-journal-text"></i>
            </div>
            <div class="stat-number">{{ $stats['total_contributions'] ?? 0 }}</div>
            <div class="stat-label">Contributions</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card stat-card">
            <div class="stat-icon">
                <i class="bi bi-heart-fill"></i>
            </div>
            <div class="stat-number">{{ $stats['total_likes_received'] ?? 0 }}</div>
            <div class="stat-label">J'aime reçus</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card stat-card">
            <div class="stat-icon">
                <i class="bi bi-chat-dots"></i>
            </div>
            <div class="stat-number">{{ $stats['total_comments_received'] ?? 0 }}</div>
            <div class="stat-label">Commentaires</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card stat-card">
            <div class="stat-icon">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-number">{{ $stats['total_views'] ?? 0 }}</div>
            <div class="stat-label">Vues totales</div>
        </div>
    </div>
</div>

<div class="row fade-in">
    <!-- Dernières contributions -->
    <div class="col-lg-6 mb-4">
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-clock-history"></i>
                    Dernières contributions
                </h3>
                <a href="{{ route('dashboard.contributions') }}" class="btn btn-sm btn-outline-custom">
                    Voir tout
                </a>
            </div>

            @if($recent_contributions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_contributions as $contribution)
                            <tr>
                                <td>
                                    <a href="{{ route('front.contenu', $contribution->id_contenu) }}"
                                       class="text-decoration-none">
                                        {{ Str::limit($contribution->titre, 30) }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-primary-custom">
                                        {{ $contribution->typeContenu->nom_contenu ?? 'Général' }}
                                    </span>
                                </td>
                                <td>
                                    @if($contribution->statut == 'validé')
                                        <span class="badge badge-success">Validé</span>
                                    @elseif($contribution->statut == 'en_attente')
                                        <span class="badge badge-warning">En attente</span>
                                    @else
                                        <span class="badge badge-danger">Rejeté</span>
                                    @endif
                                </td>
                                <td>{{ $contribution->date_creation->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-journal-x"></i>
                    <p>Aucune contribution pour le moment</p>
                    <a href="{{ route('dashboard.contribuer') }}" class="btn btn-primary-custom btn-sm mt-2">
                        <i class="bi bi-plus-circle me-2"></i>Créer une contribution
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Vos contenus populaires -->
    <div class="col-lg-6 mb-4">
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-star-fill"></i>
                    Vos contenus populaires
                </h3>
            </div>

            @if($popular_contents->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($popular_contents as $content)
                    <a href="{{ route('front.contenu', $content->id_contenu) }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">{{ Str::limit($content->titre, 40) }}</h6>
                            <small class="text-muted">
                                {{ $content->typeContenu->nom_contenu ?? 'Général' }}
                            </small>
                        </div>
                        <div class="text-end">
                            <div class="d-flex gap-3">
                                <span class="text-muted">
                                    <i class="bi bi-heart me-1"></i>{{ $content->likes_count ?? 0 }}
                                </span>
                                <span class="text-muted">
                                    <i class="bi bi-eye me-1"></i>{{ $content->vues_count ?? 0 }}
                                </span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-bar-chart"></i>
                    <p>Aucune statistique disponible</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Actions rapides -->
<div class="dashboard-card fade-in">
    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-lightning-fill"></i>
            Actions rapides
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('dashboard.contribuer') }}" class="btn btn-primary-custom w-100 py-3 h-100 d-flex flex-column align-items-center justify-content-center">
                <i class="bi bi-plus-circle display-6 mb-2"></i>
                <div>Nouvelle contribution</div>
                <small class="text-white-50 mt-1">Partagez votre savoir</small>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('front.explorer') }}" class="btn btn-outline-custom w-100 py-3 h-100 d-flex flex-column align-items-center justify-content-center">
                <i class="bi bi-compass display-6 mb-2"></i>
                <div>Explorer</div>
                <small class="text-muted mt-1">Découvrez du contenu</small>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('front.regions') }}" class="btn btn-outline-custom w-100 py-3 h-100 d-flex flex-column align-items-center justify-content-center">
                <i class="bi bi-globe display-6 mb-2"></i>
                <div>Régions</div>
                <small class="text-muted mt-1">Explorez par région</small>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('dashboard.settings') }}" class="btn btn-outline-custom w-100 py-3 h-100 d-flex flex-column align-items-center justify-content-center">
                <i class="bi bi-gear display-6 mb-2"></i>
                <div>Paramètres</div>
                <small class="text-muted mt-1">Gérez votre compte</small>
            </a>
        </div>
    </div>
</div>
@endsection
