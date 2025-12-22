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

                // Essayer toutes les sources de photo
                $photoUrl = null;

                // Priorité 1 : URL Cloudinary directe
                if (!empty($user->cloudinary_url)) {
                    $photoUrl = $user->cloudinary_url;
                }
                // Priorité 2 : Photo stockée (peut être une URL Cloudinary)
                elseif (!empty($user->photo)) {
                    // Si c'est une URL Cloudinary complète
                    if (str_contains($user->photo, 'cloudinary.com') || str_contains($user->photo, 'res.cloudinary.com')) {
                        $photoUrl = $user->photo;
                    }
                    // Sinon vérifier le stockage local
                    else {
                        // On vérifie si le fichier existe dans le storage public
                        $filePath = 'public/' . $user->photo;
                        if (Storage::exists($filePath)) {
                            $photoUrl = asset('storage/' . $user->photo);
                        }
                    }
                }

                // Initiales à partir du nom ou du prénom
                $displayName = $user->prenom ?? $user->name ?? 'Utilisateur';
                $initial = strtoupper(substr($displayName, 0, 1));
            @endphp

            @if($photoUrl)
                <img src="{{ $photoUrl }}"
                     alt="{{ $user->name ?? 'Utilisateur' }}"
                     class="user-avatar"
                     id="sidebarProfileImage"
                     onerror="this.style.display='none'; document.getElementById('sidebarProfileInitials').style.display='flex';">
            @endif

            <div class="user-avatar {{ $photoUrl ? 'd-none' : '' }}"
                 id="sidebarProfileInitials"
                 style="{{ $photoUrl ? 'display: none !important;' : 'display: flex !important;' }}">
                {{ $initial }}
            </div>

            <div class="user-name">{{ $displayName }}</div>
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

@push('styles')
<style>
/* Styles pour l'avatar utilisateur */
.user-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
    border: 3px solid rgba(255, 255, 255, 0.3);
    margin: 0 auto 10px;
    overflow: hidden;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.user-name {
    text-align: center;
    color: white;
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 2px;
}

.user-role {
    text-align: center;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.85rem;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vérifier et gérer les images qui ne se chargent pas
    const profileImage = document.getElementById('sidebarProfileImage');
    const profileInitials = document.getElementById('sidebarProfileInitials');

    if (profileImage && profileImage.complete && profileImage.naturalHeight === 0) {
        // L'image a échoué au chargement
        profileImage.style.display = 'none';
        if (profileInitials) {
            profileInitials.style.display = 'flex';
        }
    }

    // Ajouter un gestionnaire d'erreur pour les images
    if (profileImage) {
        profileImage.addEventListener('error', function() {
            this.style.display = 'none';
            if (profileInitials) {
                profileInitials.style.display = 'flex';
            }
        });
    }
});
</script>
@endpush
