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
            <i class="bi bi-search fs-5"></i>
        </a>
        <div class="navbar-search-block">
            <form class="form-inline">
                <div class="input-group">
                    <input class="form-control form-control-lg" type="search" placeholder="Rechercher..." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                        <button class="btn btn-outline-secondary" type="button" data-widget="navbar-search">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

    <!-- Messages Dropdown -->
    <li class="nav-item dropdown mx-2">
        <a class="nav-link position-relative" data-bs-toggle="dropdown" href="#" role="button">
            <i class="bi bi-chat-text fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                3
                <span class="visually-hidden">messages non lus</span>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 shadow-lg border-0" style="min-width: 320px;">
            <div class="bg-primary text-white p-3 rounded-top">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">
                        <i class="bi bi-chat-text me-2"></i> Messages
                    </h6>
                    <span class="badge bg-white text-primary">3 nouveaux</span>
                </div>
            </div>
            <div class="p-2" style="max-height: 300px; overflow-y: auto;">
                <a href="#" class="dropdown-item p-3 border-bottom">
                    <div class="d-flex align-items-start">
                        <div class="position-relative me-3">
                            <img src="{{ asset('assets/img/user1-128x128.jpg') }}"
                                 class="rounded-circle"
                                 width="45" height="45"
                                 alt="User">
                            <span class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle"
                                  style="width: 12px; height: 12px;"></span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="mb-1 fw-bold">Brad Diesel</h6>
                                <small class="text-muted">2 min</small>
                            </div>
                            <p class="mb-0 text-muted small">Call me whenever you can...</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="dropdown-item p-3 border-bottom">
                    <div class="d-flex align-items-start">
                        <div class="position-relative me-3">
                            <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center"
                                 style="width: 45px; height: 45px;">
                                <span class="fw-bold">JD</span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="mb-1 fw-bold">John Doe</h6>
                                <small class="text-muted">1h</small>
                            </div>
                            <p class="mb-0 text-muted small">I've finished the task you assigned...</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="dropdown-item p-3">
                    <div class="d-flex align-items-start">
                        <div class="position-relative me-3">
                            <img src="{{ asset('assets/img/user3-128x128.jpg') }}"
                                 class="rounded-circle"
                                 width="45" height="45"
                                 alt="User">
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="mb-1 fw-bold">Sarah Connor</h6>
                                <small class="text-muted">3h</small>
                            </div>
                            <p class="mb-0 text-muted small">Meeting tomorrow at 10AM...</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="text-center p-2 border-top">
                <a href="#" class="btn btn-link text-decoration-none">
                    <i class="bi bi-arrow-right me-1"></i> Voir tous les messages
                </a>
            </div>
        </div>
    </li>

    <!-- Notifications Dropdown -->
    <li class="nav-item dropdown mx-2">
        <a class="nav-link position-relative" data-bs-toggle="dropdown" href="#" role="button">
            <i class="bi bi-bell fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                5
                <span class="visually-hidden">notifications non lues</span>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 shadow-lg border-0" style="min-width: 320px;">
            <div class="bg-warning text-dark p-3 rounded-top">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">
                        <i class="bi bi-bell me-2"></i> Notifications
                    </h6>
                    <span class="badge bg-dark text-white">5 nouvelles</span>
                </div>
            </div>
            <div class="p-2" style="max-height: 300px; overflow-y: auto;">
                <a href="#" class="dropdown-item p-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 40px; height: 40px;">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Nouveau message</h6>
                            <p class="mb-0 text-muted small">Vous avez reçu un nouveau message</p>
                        </div>
                        <small class="text-muted">3 min</small>
                    </div>
                </a>
                <a href="#" class="dropdown-item p-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 40px; height: 40px;">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Tâche complétée</h6>
                            <p class="mb-0 text-muted small">"Rapport mensuel" a été complété</p>
                        </div>
                        <small class="text-muted">1h</small>
                    </div>
                </a>
                <a href="#" class="dropdown-item p-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 40px; height: 40px;">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Alerte système</h6>
                            <p class="mb-0 text-muted small">Utilisation CPU élevée détectée</p>
                        </div>
                        <small class="text-muted">2h</small>
                    </div>
                </a>
                <a href="#" class="dropdown-item p-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 40px; height: 40px;">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Nouvel utilisateur</h6>
                            <p class="mb-0 text-muted small">Un nouvel utilisateur s'est inscrit</p>
                        </div>
                        <small class="text-muted">5h</small>
                    </div>
                </a>
            </div>
            <div class="text-center p-2 border-top">
                <a href="#" class="btn btn-link text-decoration-none">
                    <i class="bi bi-arrow-right me-1"></i> Voir toutes les notifications
                </a>
            </div>
        </div>
    </li>

    <!-- User Menu -->
    <li class="nav-item dropdown user-menu ms-3">
        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center p-0" data-bs-toggle="dropdown">
            <div class="position-relative">
                @php
                    $user = Auth::user();
                    $initial = strtoupper(substr($user->name ?? 'A', 0, 1));

                    // Vérifier si l'utilisateur a une photo
                    if ($user->photo) {
                        $photoPath = 'adminlte/img/' . $user->photo;
                        $photoUrl = asset($photoPath);
                        $photoExists = file_exists(public_path($photoPath));
                    }
                @endphp

                @if($user->photo && ($photoExists ?? false))
                    <img src="{{ $photoUrl }}"
                         class="rounded-circle border border-3 border-primary"
                         width="40" height="40"
                         alt="{{ $user->name }}"
                         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                @endif

                <div class="rounded-circle border border-3 border-primary d-flex align-items-center justify-content-center
                           {{ ($user->photo && ($photoExists ?? false)) ? 'd-none' : '' }}"
                     style="width: 40px; height: 40px; background: linear-gradient(45deg, #4e73df, #224abe);">
                    <span class="text-white fw-bold fs-5">{{ $initial }}</span>
                </div>

                <!-- Badge de statut -->
                <span class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle"
                      style="width: 12px; height: 12px;"
                      title="{{ $user->statut == 'actif' ? 'En ligne' : 'Hors ligne' }}"></span>
            </div>
            <div class="d-none d-lg-block ms-2">
                <span class="fw-bold">{{ $user->name }}</span>
                <br>
                <small class="text-muted">{{ $user->role->nom_role ?? 'Utilisateur' }}</small>
            </div>
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3" style="min-width: 280px;">
            <!-- En-tête du profil -->
            <li class="dropdown-header bg-gradient-primary text-white p-4 rounded-top">
                <div class="text-center mb-3">
                    <div class="position-relative d-inline-block">
                        @if($user->photo && ($photoExists ?? false))
                            <img src="{{ $photoUrl }}"
                                 class="rounded-circle border border-3 border-white shadow"
                                 width="70" height="70"
                                 alt="{{ $user->name }}"
                                 onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        @endif

                        <div class="rounded-circle border border-3 border-white shadow d-flex align-items-center justify-content-center
                                   {{ ($user->photo && ($photoExists ?? false)) ? 'd-none' : '' }}"
                             style="width: 70px; height: 70px; background: linear-gradient(45deg, #4e73df, #224abe);">
                            <span class="text-white fw-bold fs-3">{{ $initial }}</span>
                        </div>
                    </div>
                </div>
                <h6 class="mb-1 fw-bold text-center">{{ $user->name }} {{ $user->prenom }}</h6>
                <p class="mb-0 text-center small opacity-75">{{ $user->email }}</p>
                <div class="text-center mt-2">
                    <span class="badge {{ $user->statut == 'actif' ? 'bg-success' : 'bg-danger' }}">
                        <i class="bi bi-circle-fill me-1"></i> {{ ucfirst($user->statut) }}
                    </span>
                    <span class="badge bg-info ms-1">{{ $user->role->nom_role ?? 'Utilisateur' }}</span>
                </div>
            </li>

            <li class="dropdown-divider my-0"></li>

            <!-- Liens rapides -->
            <li>
                <a href="{{ route('admin.profile.show', $user->id) }}" class="dropdown-item py-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 36px; height: 36px;">
                            <i class="bi bi-person text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">Mon profil</h6>
                            <small class="text-muted">Voir votre profil</small>
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.profile.edit', $user->id) }}" class="dropdown-item py-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 36px; height: 36px;">
                            <i class="bi bi-pencil-square text-warning"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">Modifier profil</h6>
                            <small class="text-muted">Mettre à jour vos informations</small>
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <a href="{{ route('profile.edit') }}" class="dropdown-item py-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 36px; height: 36px;">
                            <i class="bi bi-gear text-info"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">Paramètres</h6>
                            <small class="text-muted">Gérer vos préférences</small>
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.tableaudebord') }}" class="dropdown-item py-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 36px; height: 36px;">
                            <i class="bi bi-speedometer2 text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">Tableau de bord</h6>
                            <small class="text-muted">Accéder au tableau de bord</small>
                        </div>
                    </div>
                </a>
            </li>

            <li class="dropdown-divider my-0"></li>

            <!-- Actions rapides -->
            <li class="px-3 py-2">
                <div class="row g-2">
                    <div class="col-6">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary w-100 btn-sm">
                            <i class="bi bi-people me-1"></i> Utilisateurs
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.settings') }}" class="btn btn-outline-warning w-100 btn-sm">
                            <i class="bi bi-sliders me-1"></i> Réglages
                        </a>
                    </div>
                </div>
            </li>

            <li class="dropdown-divider my-0"></li>

            <!-- Déconnexion -->
            <li class="p-3">
                <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                    </button>
                </form>
            </li>

            <!-- Footer -->
            <li class="dropdown-footer bg-light p-3 rounded-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        <i class="bi bi-clock me-1"></i>
                        Dernière connexion : {{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() : 'Jamais' }}
                    </small>
                </div>
            </li>
        </ul>
    </li>
</ul>

<style>
/* Styles pour le navbar amélioré */
.navbar-search-block {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    width: 300px;
    padding: 1rem;
    background: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-radius: 8px;
    z-index: 1050;
}

.navbar-search-block.show {
    display: block;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-menu-lg {
    min-width: 320px;
}

.user-menu .dropdown-toggle::after {
    display: none;
}

.user-menu .dropdown-menu {
    border: none;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}

.dropdown-item {
    transition: all 0.2s;
}

.dropdown-item:hover {
    background-color: rgba(78, 115, 223, 0.1);
    transform: translateX(5px);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
}

/* Animation des badges */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.bg-danger, .bg-warning {
    animation: pulse 2s infinite;
}

/* Style pour les avatars */
.rounded-circle.border-primary {
    border-color: #4e73df !important;
}

/* Responsive */
@media (max-width: 768px) {
    .navbar-search-block {
        position: fixed;
        top: 70px;
        left: 0;
        right: 0;
        width: auto;
        margin: 0 1rem;
    }

    .dropdown-menu-lg {
        min-width: 280px;
        margin-right: 1rem;
    }

    .user-menu .dropdown-menu {
        position: fixed;
        top: 70px;
        right: 1rem;
        left: 1rem;
        margin: 0;
    }
}

/* Effet hover pour les icônes */
.nav-link {
    position: relative;
    transition: all 0.3s;
}

.nav-link:hover {
    transform: translateY(-2px);
}

.nav-link i {
    transition: transform 0.3s;
}

.nav-link:hover i {
    transform: scale(1.1);
}

/* Style pour le statut en ligne */
.bg-success {
    box-shadow: 0 0 0 2px rgba(255,255,255,0.8);
}
</style>

<script>
$(document).ready(function() {
    // Gestion de la recherche
    $('[data-widget="navbar-search"]').on('click', function(e) {
        e.preventDefault();
        const searchBlock = $(this).closest('.nav-item').find('.navbar-search-block');
        searchBlock.toggleClass('show');

        if (searchBlock.hasClass('show')) {
            searchBlock.find('input[type="search"]').focus();
        }
    });

    // Fermer la recherche en cliquant ailleurs
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.navbar-search-block, [data-widget="navbar-search"]').length) {
            $('.navbar-search-block').removeClass('show');
        }
    });

    // Vérifier les images de profil
    $('.user-menu img').on('error', function() {
        $(this).hide();
        $(this).next('.rounded-circle').show();
    });

    // Animation des dropdowns
    $('.dropdown').on('show.bs.dropdown', function() {
        $(this).find('.dropdown-menu').addClass('animate__animated animate__fadeIn');
    });

    $('.dropdown').on('hide.bs.dropdown', function() {
        $(this).find('.dropdown-menu').removeClass('animate__animated animate__fadeIn');
    });
});
</script>
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

