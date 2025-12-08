<aside class="dashboard-sidebar">
    <!-- Logo -->
    <div class="sidebar-header">
        {{-- Logo qui renvoie vers le dashboard principal --}}
        <a href="{{ route('dashboard.index') }}" class="sidebar-brand">
            <i class="bi bi-globe-africa"></i>
            <span>Bénin Culture</span>
        </a>
    </div>

    <!-- Profil utilisateur - Taille réduite -->
    <div class="user-profile">
        @auth
            @php
                $user = Auth::user();
                $hasPhoto = false;
                $photoUrl = null;

                if (isset($user->photo) && !empty($user->photo)) {
                    $hasPhoto = Storage::disk('public')->exists($user->photo);
                    $photoUrl = $hasPhoto ? asset('storage/' . $user->photo) : null;
                }
            @endphp

            @if($hasPhoto && $photoUrl)
                <img src="{{ $photoUrl }}"
                     alt="{{ $user->name ?? 'Utilisateur' }}"
                     class="user-avatar">
            @else
                <div class="user-avatar">
                    {{ strtoupper(substr($user->name ?? $user->email ?? 'U', 0, 1)) }}
                </div>
            @endif

            <div class="user-name">{{ $user->prenom ?? $user->name ?? 'Utilisateur' }}</div>
            <div class="user-role">
                @if(isset($user->role) && $user->role)
                    {{ $user->role->nom_role ?? 'Rôle non défini' }}
                @elseif(isset($user->id_role) && $user->id_role == 1)
                    Administrateur
                @else
                    Contributeur
                @endif
            </div>
        @endauth
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        {{-- Tableau de bord (page principale) --}}
        <div class="nav-item">
            <a href="{{ route('dashboard.index') }}"
               class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Tableau de bord</span>
            </a>
        </div>

        {{-- Mes contributions --}}
        <div class="nav-item">
            <a href="{{ route('dashboard.contributions') }}"
               class="nav-link {{ request()->routeIs('dashboard.contributions') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>Mes contributions</span>
                @isset($stats['total_contributions'])
                    @if($stats['total_contributions'] > 0)
                        <span class="nav-badge">{{ $stats['total_contributions'] }}</span>
                    @endif
                @endisset
            </a>
        </div>

        {{-- Contenus aimés --}}
        <div class="nav-item">
            <a href="{{ route('dashboard.likes') }}"
               class="nav-link {{ request()->routeIs('dashboard.likes') ? 'active' : '' }}">
                <i class="bi bi-heart-fill"></i>
                <span>Contenus aimés</span>
                @isset($stats['total_likes_given'])
                    @if($stats['total_likes_given'] > 0)
                        <span class="nav-badge">{{ $stats['total_likes_given'] }}</span>
                    @endif
                @endisset
            </a>
        </div>

        {{-- Explorer (site public) --}}
        <div class="nav-item">
            <a href="{{ route('front.explorer') }}" class="nav-link">
                <i class="bi bi-compass"></i>
                <span>Explorer</span>
            </a>
        </div>

        {{-- Nouvelle contribution --}}
        <div class="nav-item">
            <a href="{{ route('dashboard.contribuer') }}"
               class="nav-link {{ request()->routeIs('front.contribuer') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i>
                <span>Contribuer</span>
            </a>
        </div>

        {{-- Paramètres --}}
        <div class="nav-item">
            <a href="{{ route('dashboard.settings') }}"
               class="nav-link {{ request()->routeIs('dashboard.settings') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                <span>Paramètres</span>
            </a>
        </div>

        <!-- Séparateur -->
        <hr style="border-color: rgba(255,255,255,0.1); margin: 1rem 1.5rem;">

        <!-- Déconnexion -->
        <div class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="requires-confirmation">
                @csrf
                <button type="submit" class="nav-link" style="
                    background: none;
                    border: none;
                    width: 100%;
                    text-align: left;
                    cursor: pointer;
                ">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
