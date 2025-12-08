<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Admin - Culture Bénin')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="color-scheme" content="light dark">
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)">
    <meta name="supported-color-schemes" content="light dark">

    <meta name="author" content="Culture Bénin">
    <meta name="description" content="Administration de la plateforme Culture Bénin">
    <meta name="keywords" content="bénin, culture, patrimoine, administration">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">

    <style>
        /* Amélioration de la visibilité du sidebar */
        .sidebar-wrapper .nav-link {
            color: #495057 !important;
            font-weight: 500;
            padding: 12px 15px;
            margin: 2px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-wrapper .nav-link:hover {
            background-color: #e9ecef;
            color: #007bff !important;
            transform: translateX(5px);
        }

        .sidebar-wrapper .nav-link.active {
            background-color: #007bff;
            color: white !important;
        }

        .sidebar-wrapper .nav-header {
            color: #6c757d !important;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 10px 15px 5px;
        }

        /* Amélioration des badges */
        .navbar-badge {
            font-size: 0.6rem;
            position: absolute;
            top: 8px;
            right: 5px;
        }

        /* Style pour DataTables */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            margin: 0 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #007bff;
            color: white !important;
            border-color: #007bff;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <!-- Header avec navbar complet -->
        <nav class="app-header navbar navbar-expand bg-body shadow-sm">
            <div class="container-fluid">
                <!-- Left Side -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#">
                            <i class="bi bi-list fs-4"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="{{ url('/') }}" class="nav-link" target="_blank">
                            <i class="bi bi-house me-1"></i> Site Public
                        </a>
                    </li>
                </ul>

                <!-- Right Side -->
                <ul class="navbar-nav ms-auto">
                    <!-- Search -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="bi bi-search"></i>
                        </a>
                        <div class="navbar-search-block">
                            <form class="form-inline">
                                <div class="input-group">
                                    <input class="form-control" type="search" placeholder="Rechercher..." aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar" type="submit">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Messages -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-chat-text"></i>
                            <span class="badge bg-danger navbar-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <span class="dropdown-header">3 Messages</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/img/user1-128x128.jpg') }}" class="rounded-circle me-2" width="40" height="40">
                                    <div>
                                        <strong>Brad Diesel</strong>
                                        <small class="text-muted">Call me whenever you can...</small>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">Voir tous les messages</a>
                        </div>
                    </li>

                    <!-- Notifications -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-bell"></i>
                            <span class="badge bg-warning navbar-badge">5</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <span class="dropdown-header">5 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-envelope me-2"></i> Nouveau message
                                <span class="float-end text-muted text-sm">3 min</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">Voir toutes les notifications</a>
                        </div>
                    </li>

                    <!-- User Menu -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                            @if (Auth::user()->photo)
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header text-center">
                                <p class="mb-0">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</p>
                                <small class="text-muted">{{ Auth::user()->role->nom_role ?? 'Utilisateur' }}</small>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <i class="bi bi-person me-2"></i> Profil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <i class="bi bi-gear me-2"></i> Paramètres
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item border-0 bg-transparent w-100 text-start">
                                        <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Sidebar amélioré -->
        <aside class="app-sidebar bg-white shadow">
            <!-- Logo -->
            <div class="sidebar-brand p-3 border-bottom">
                <a href="{{ route('admin.tableaudebord') }}" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('assets/img/benin logo.png') }}" alt="Logo" class="brand-image me-2" style="width: 40px; height: 40px; object-fit: contain;">
                    <span class="brand-text fw-bold text-dark">Culture Bénin</span>
                </a>
            </div>

            

            <!-- Menu amélioré -->
            <div class="sidebar-wrapper">
                <nav class="mt-3">
                    <ul class="nav flex-column">

                        <!-- Tableau de bord -->
                        <li class="nav-item">
                            <a href="{{ route('admin.tableaudebord') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.tableaudebord') ? 'active' : '' }}">
                                <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
                            </a>
                        </li>

                        <li class="nav-header text-uppercase small text-muted mt-3 mb-1">Gestion des données</li>

                        <!-- Administrateur -->
                        @if (Auth::user()->role->nom_role === 'Administrateur')
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                    <i class="bi bi-people-fill me-2"></i> Utilisateurs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                    <i class="bi bi-person-badge me-2"></i> Rôles
                                </a>
                            </li>
                        @endif

                        <!-- Administrateur + Contributeur -->
                        @if (in_array(Auth::user()->role->nom_role, ['Administrateur', 'Contributeur']))
                            <li class="nav-item">
                                <a href="{{ route('admin.regions.index') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.regions.*') ? 'active' : '' }}">
                                    <i class="bi bi-globe-americas me-2"></i> Régions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.langues.index') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.langues.*') ? 'active' : '' }}">
                                    <i class="bi bi-translate me-2"></i> Langues
                                </a>
                            </li>
                        @endif

                        <!-- Administrateur + Modérateur -->
                        @if (in_array(Auth::user()->role->nom_role, ['Administrateur', 'Modérateur']))
                            <li class="nav-item">
                                <a href="{{ route('admin.contenus.index') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.contenus.*') ? 'active' : '' }}">
                                    <i class="bi bi-journal-text me-2"></i> Contenus
                                </a>
                            </li>
                        @endif

                        <li class="nav-header text-uppercase small text-muted mt-3 mb-1">Gestion multimédia</li>

                        <!-- Administrateur + Contributeur -->
                        @if (in_array(Auth::user()->role->nom_role, ['Administrateur', 'Contributeur']))
                            <li class="nav-item">
                                <a href="{{ route('admin.medias.index') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.medias.*') ? 'active' : '' }}">
                                    <i class="bi bi-image me-2"></i> Médias
                                </a>
                            </li>
                        @endif

                        <!-- Administrateur + Modérateur -->
                        @if (in_array(Auth::user()->role->nom_role, ['Administrateur', 'Modérateur']))
                            <li class="nav-item">
                                <a href="{{ route('admin.commentaires.index') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.commentaires.*') ? 'active' : '' }}">
                                    <i class="bi bi-chat-dots me-2"></i> Commentaires
                                </a>
                            </li>
                        @endif

                        <!-- Administrateur + Contributeur -->
                        @if (in_array(Auth::user()->role->nom_role, ['Administrateur', 'Contributeur']))
                            <li class="nav-item">
                                <a href="{{ route('admin.parler.index') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.parler.*') ? 'active' : '' }}">
                                    <i class="bi bi-link-45deg me-2"></i> Langue / Région
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.typecontenus.index') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.typecontenus.*') ? 'active' : '' }}">
                                    <i class="bi bi-tags me-2"></i> Types de contenus
                                </a>
                            </li>
                        @endif

                        <!-- Session -->
                        <li class="nav-header text-uppercase small text-muted mt-3 mb-1">Session</li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="w-100">
                                @csrf
                                <button type="submit" class="nav-link sidebar-link text-start w-100 border-0 bg-transparent">
                                    <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                                </button>
                            </form>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <!-- Content Header -->
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('page-title', 'Tableau de bord')</h1>
                        </div>
                        <div class="col-sm-6 text-end">
                            @yield('breadcrumb', '')
                        </div>
                    </div>

                    <!-- Main Content -->
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">Culture Bénin</div>
            <strong>Copyright &copy; 2024 <a href="{{ url('/') }}" class="text-decoration-none">Culture Bénin</a>.</strong>
            Tous droits réservés.
        </footer>
    </div>

    <!-- Scripts -->
    <!-- jQuery DOIT être en premier -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>

    <!-- DataTables Scripts -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AdminLTE JS -->
    <script src="{{ asset('adminlte/js/adminlte.js') }}"></script>

    <script>
        // Configuration des scrollbars
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector('.sidebar-wrapper');
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: 'os-theme-light',
                        autoHide: 'leave',
                        clickScroll: true,
                    },
                });
            }

            // Gestion de la recherche navbar
            const searchButton = document.querySelector('[data-widget="navbar-search"]');
            const searchBlock = document.querySelector('.navbar-search-block');

            if (searchButton && searchBlock) {
                searchButton.addEventListener('click', function() {
                    searchBlock.classList.toggle('show');
                });
            }

            // Vérification que jQuery et DataTables sont chargés
            console.log('jQuery chargé:', typeof jQuery !== 'undefined');
            console.log('DataTables chargé:', typeof $.fn.DataTable !== 'undefined');
        });
    </script>

    <!-- Scripts spécifiques aux pages -->
    @yield('scripts')
</body>
</html>
