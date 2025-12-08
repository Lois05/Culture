@extends('layouts.layout')

@section('page-title', 'Tableau de bord')

@section('content')
<div class="row g-4">
    @php
        $cards = [];
        $roleName = '';
        $user = Auth::user();

        // Récupérer le nom du rôle
        if ($user && $user->role) {
            $roleName = $user->role->nom_role;
        }

        // Compter les contenus en attente (pour admin et moderateur)
        $contenusEnAttenteCount = 0;
        if (in_array($roleName, ['Administrateur', 'Modérateur'])) {
            $contenusEnAttenteCount = \App\Models\Contenu::where('statut', 'en_attente')->count();
        }

        // Définir les cartes selon le rôle
        switch ($roleName) {
            case 'Administrateur':
                $cards = [
                    ['color' => 'primary', 'title'=>'Langues','total'=>$totalLangues ?? 0,'icon'=>'bi-translate', 'route' => 'admin.langues.index'],
                    ['color' => 'success', 'title'=>'Contenus','total'=>$totalContenus ?? 0,'icon'=>'bi-journal-text', 'route' => 'admin.contenus.index'],
                    ['color' => 'warning', 'title'=>'Utilisateurs','total'=>$totalUsers ?? 0,'icon'=>'bi-people', 'route' => 'admin.users.index'],
                    ['color' => 'danger', 'title'=>'Régions','total'=>$totalRegions ?? 0,'icon'=>'bi-geo-alt', 'route' => 'admin.regions.index'],
                ];
                // Ajouter carte modération si des contenus en attente
                if ($contenusEnAttenteCount > 0) {
                    array_unshift($cards, [
                        'color' => 'danger',
                        'title' => 'À modérer',
                        'total' => $contenusEnAttenteCount,
                        'icon' => 'bi-clipboard-check',
                        'route' => 'admin.moderateur.index',
                        'badge' => 'badge-danger'
                    ]);
                }
                break;

            case 'Modérateur':
                $cards = [
                    ['color' => 'success','title'=>'Contenus','total'=>$totalContenus ?? 0,'icon'=>'bi-journal-text', 'route' => 'admin.contenus.index'],
                    ['color' => 'info','title'=>'Commentaires','total'=>$totalCommentaires ?? 0,'icon'=>'bi-chat-left-text', 'route' => 'admin.commentaires.index'],
                ];
                // Ajouter carte modération si des contenus en attente
                if ($contenusEnAttenteCount > 0) {
                    array_unshift($cards, [
                        'color' => 'warning',
                        'title' => 'À modérer',
                        'total' => $contenusEnAttenteCount,
                        'icon' => 'bi-clipboard-check',
                        'route' => 'admin.moderateur.index',
                        'badge' => 'badge-warning animate-pulse'
                    ]);
                }
                break;

            case 'Contributeur':
                $cards = [
                    ['color'=>'primary','title'=>'Langues','total'=>$totalLangues ?? 0,'icon'=>'bi-translate', 'route' => 'admin.langues.index'],
                    ['color'=>'success','title'=>'Contenus','total'=>$totalContenus ?? 0,'icon'=>'bi-journal-text', 'route' => 'admin.contenus.index'],
                ];
                break;

            case 'Lecteur':
                $cards = [
                    ['color'=>'success','title'=>'Contenus disponibles','total'=>$totalContenus ?? 0,'icon'=>'bi-journal-text'],
                ];
                break;
        }
    @endphp

    {{-- Cards avec liens --}}
    @foreach($cards as $card)
    <div class="col-lg-3 col-md-6">
        @if(isset($card['route']) && Route::has($card['route']))
            <a href="{{ route($card['route']) }}" class="text-decoration-none">
        @endif

        <div class="card card-hover h-100 border-0 rounded-4 text-white bg-{{ $card['color'] }} position-relative">
            @if(isset($card['badge']))
                <div class="position-absolute top-0 end-0 p-2">
                    <span class="badge {{ $card['badge'] }} animate__animated animate__pulse animate__infinite">
                        {{ $card['total'] }} en attente
                    </span>
                </div>
            @endif
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="display-6 fw-bold mb-1">{{ $card['total'] }}</h2>
                    <p class="mb-0 text-light small">{{ $card['title'] }}</p>
                </div>
                <i class="bi {{ $card['icon'] }} fs-1 opacity-50"></i>
            </div>
        </div>

        @if(isset($card['route']) && Route::has($card['route']))
            </a>
        @endif
    </div>
    @endforeach
</div>

{{-- Alert pour contenus en attente --}}
@if($contenusEnAttenteCount > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                <div class="flex-grow-1">
                    <strong>{{ $contenusEnAttenteCount }} contenu(s) en attente de modération</strong>
                    <p class="mb-0">Des utilisateurs ont soumis des contenus qui nécessitent votre validation.</p>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('admin.moderateur.index') }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-clipboard-check me-2"></i>Modérer maintenant
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if($roleName === 'Administrateur')
{{-- Section Statistiques --}}
<div class="row mt-5">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-white border-0 pb-0">
                <h5 class="fw-bold mb-0"><i class="bi bi-graph-up"></i> Statistiques des contenus</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Contenus par statut --}}
                    <div class="col-lg-6">
                        <h6 class="fw-bold mb-3"><i class="bi bi-pie-chart"></i> Répartition des contenus</h6>
                        <div class="d-flex flex-column gap-3">
                            @php
                                $statistiques = [
                                    'validé' => ['count' => $contenusValides ?? 0, 'color' => 'success', 'icon' => 'bi-check-circle-fill'],
                                    'en_attente' => ['count' => $contenusEnAttente ?? 0, 'color' => 'warning', 'icon' => 'bi-hourglass-split'],
                                    'rejeté' => ['count' => $contenusRejects ?? 0, 'color' => 'danger', 'icon' => 'bi-x-circle-fill'],
                                ];
                                $totalContenusStat = array_sum(array_column($statistiques, 'count'));
                            @endphp

                            @foreach($statistiques as $statut => $data)
                                @php
                                    $pourcentage = $totalContenusStat > 0 ? round(($data['count'] / $totalContenusStat) * 100) : 0;
                                    $statutLabel = str_replace('_', ' ', $statut);
                                @endphp
                                <div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>
                                            <i class="bi {{ $data['icon'] }} text-{{ $data['color'] }} me-2"></i>
                                            {{ ucfirst($statutLabel) }}
                                            <span class="badge bg-{{ $data['color'] }}">{{ $data['count'] }}</span>
                                        </span>
                                        <span class="fw-semibold">{{ $pourcentage }}%</span>
                                    </div>
                                    <div class="progress" style="height: 12px;">
                                        <div class="progress-bar bg-{{ $data['color'] }}"
                                             role="progressbar"
                                             style="width: {{ $pourcentage }}%"
                                             aria-valuenow="{{ $pourcentage }}"
                                             aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Utilisateurs par rôle --}}
                    <div class="col-lg-6">
                        <h6 class="fw-bold mb-3"><i class="bi bi-people-fill"></i> Répartition des utilisateurs</h6>
                        <div class="d-flex flex-column gap-3">
                            @php
                                $rolesStats = [
                                    'Administrateur' => ['count' => $nbAdmins ?? 0, 'color' => 'primary', 'icon' => 'bi-shield-lock-fill'],
                                    'Modérateur' => ['count' => $nbModerateurs ?? 0, 'color' => 'info', 'icon' => 'bi-person-badge-fill'],
                                    'Contributeur' => ['count' => $nbContributeurs ?? 0, 'color' => 'warning', 'icon' => 'bi-person-fill'],
                                    'Lecteur' => ['count' => $nbLecteurs ?? 0, 'color' => 'success', 'icon' => 'bi-person-lines-fill'],
                                ];
                                $totalUsersStat = array_sum(array_column($rolesStats, 'count'));
                            @endphp

                            @foreach($rolesStats as $role => $data)
                                @php
                                    $pourcentage = $totalUsersStat > 0 ? round(($data['count'] / $totalUsersStat) * 100) : 0;
                                @endphp
                                <div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>
                                            <i class="bi {{ $data['icon'] }} text-{{ $data['color'] }} me-2"></i>
                                            {{ $role }}
                                            <span class="badge bg-{{ $data['color'] }}">{{ $data['count'] }}</span>
                                        </span>
                                        <span class="fw-semibold">{{ $pourcentage }}%</span>
                                    </div>
                                    <div class="progress" style="height: 12px;">
                                        <div class="progress-bar bg-{{ $data['color'] }}"
                                             role="progressbar"
                                             style="width: {{ $pourcentage }}%"
                                             aria-valuenow="{{ $pourcentage }}"
                                             aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Derniers contenus et utilisateurs --}}
<div class="row mt-5 g-4">
    {{-- Derniers contenus --}}
    <div class="col-lg-6">
        <div class="card shadow h-100 border-0 rounded-4">
            <div class="card-header bg-white border-0">
                <h5 class="fw-bold mb-0"><i class="bi bi-clock-history"></i> Derniers contenus</h5>
            </div>
            <div class="card-body p-0">
                @if($dernierContenus && $dernierContenus->count())
                    <div class="list-group list-group-flush">
                        @foreach($dernierContenus as $contenu)
                            <a href="{{ route('admin.contenus.show', $contenu->id_contenu) }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        @if($contenu->medias && $contenu->medias->first())
                                            <div class="bg-light rounded-circle p-2">
                                                <i class="bi bi-image text-primary"></i>
                                            </div>
                                        @else
                                            <div class="bg-light rounded-circle p-2">
                                                <i class="bi bi-file-text text-secondary"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ Str::limit($contenu->titre, 40) }}</h6>
                                        <small class="text-muted">
                                            Par {{ $contenu->auteur->prenom ?? 'Anonyme' }} •
                                            {{ $contenu->date_creation->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                                <span class="badge rounded-pill
                                    @if($contenu->statut === 'validé') bg-success
                                    @elseif($contenu->statut === 'en_attente') bg-warning
                                    @else bg-danger @endif">
                                    {{ ucfirst(str_replace('_', ' ', $contenu->statut)) }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                    <div class="card-footer bg-white border-0 text-center">
                        <a href="{{ route('admin.contenus.index') }}" class="btn btn-outline-primary btn-sm">
                            Voir tous les contenus <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-journal-x fs-1 text-muted"></i>
                        <p class="text-muted mt-2">Aucun contenu trouvé</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Derniers utilisateurs --}}
    <div class="col-lg-6">
        <div class="card shadow h-100 border-0 rounded-4">
            <div class="card-header bg-white border-0">
                <h5 class="fw-bold mb-0"><i class="bi bi-person-lines-fill"></i> Derniers utilisateurs</h5>
            </div>
            <div class="card-body p-0">
                @if($dernierUsers && $dernierUsers->count())
                    <div class="list-group list-group-flush">
                        @foreach($dernierUsers as $user)
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        @if($user->photo)
                                            <img src="{{ asset('storage/' . $user->photo) }}"
                                                 class="rounded-circle"
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded-circle p-2">
                                                <i class="bi bi-person-circle text-secondary"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ $user->prenom }} {{ $user->name }}</h6>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-{{ $user->statut === 'actif' ? 'success' : 'danger' }}">
                                        {{ $user->statut }}
                                    </span>
                                    <br>
                                    <small class="text-muted">{{ $user->role->nom_role ?? 'Sans rôle' }}</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="card-footer bg-white border-0 text-center">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-sm">
                            Voir tous les utilisateurs <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-people fs-1 text-muted"></i>
                        <p class="text-muted mt-2">Aucun utilisateur trouvé</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

{{-- Quick Actions pour Admin/Modo --}}
@if(in_array($roleName, ['Administrateur', 'Modérateur']))
<div class="row mt-5">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-white border-0">
                <h5 class="fw-bold mb-0"><i class="bi bi-lightning-charge"></i> Actions rapides</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('admin.contenus.create') }}" class="btn btn-primary w-100 h-100 py-3">
                            <i class="bi bi-plus-circle fs-4 d-block mb-2"></i>
                            Nouveau contenu
                        </a>
                    </div>
                    @if($contenusEnAttenteCount > 0)
                    <div class="col-md-3">
                        <a href="{{ route('admin.moderateur.index') }}" class="btn btn-warning w-100 h-100 py-3">
                            <i class="bi bi-clipboard-check fs-4 d-block mb-2"></i>
                            Modérer ({{ $contenusEnAttenteCount }})
                        </a>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-success w-100 h-100 py-3">
                            <i class="bi bi-person-plus fs-4 d-block mb-2"></i>
                            Nouvel utilisateur
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.regions.create') }}" class="btn btn-info w-100 h-100 py-3">
                            <i class="bi bi-geo-alt fs-4 d-block mb-2"></i>
                            Nouvelle région
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation pour les cartes
    const cards = document.querySelectorAll('.card-hover');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 25px rgba(0,0,0,0.1)';
            this.style.transition = 'all 0.3s ease';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });

    // Auto-dismiss alerts après 5 secondes
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert.classList.contains('show')) {
                alert.classList.remove('show');
                alert.classList.add('fade');
            }
        }, 5000);
    });
});
</script>

<style>
.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.animate-pulse {
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.7; }
    100% { opacity: 1; }
}

.list-group-item-action:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.05);
}

.badge {
    font-weight: 500;
}
</style>
@endsection
