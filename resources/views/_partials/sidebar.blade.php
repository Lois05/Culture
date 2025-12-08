<aside class="sidebar bg-white shadow">
    <div class="sidebar-brand p-3 border-bottom">
        <a href="{{ route('admin.tableaudebord') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('assets/img/benin logo.png') }}" alt="Logo" class="me-2" style="width: 40px; height: 40px;">
            <div>
                <span class="fw-bold text-dark">Culture & Langues</span>
                <span class="badge bg-primary mt-1 d-block">
                    <i class="bi bi-person-badge"></i> {{ Auth::user()->role->nom_role }}
                </span>
            </div>
        </a>
    </div>

    <nav class="p-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.tableaudebord') }}" class="nav-link">
                    <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
                </a>
            </li>

            <li class="nav-header">GESTION DES DONNÉES</li>

            @if(Auth::user()->role->nom_role === 'Administrateur')
                <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link"><i class="bi bi-people-fill me-2"></i> Utilisateurs</a></li>
                <li class="nav-item"><a href="{{ route('roles.index') }}" class="nav-link"><i class="bi bi-person-badge me-2"></i> Rôles</a></li>
            @endif

            @if(in_array(Auth::user()->role->nom_role, ['Administrateur', 'Contributeur']))
                <li class="nav-item"><a href="{{ route('regions.index') }}" class="nav-link"><i class="bi bi-globe-americas me-2"></i> Régions</a></li>
                <li class="nav-item"><a href="{{ route('langues.index') }}" class="nav-link"><i class="bi bi-translate me-2"></i> Langues</a></li>
            @endif

            <li class="nav-item"><a href="{{ route('contenus.index') }}" class="nav-link"><i class="bi bi-journal-text me-2"></i> Contenus</a></li>

            <li class="nav-header">SESSION</li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-start w-100 border-0 bg-transparent">
                        <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>
