<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard - Bénin Culture">
    <title>Bénin Culture | @yield('title', 'Dashboard')</title>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- CSS Personnalisé -->
    <style>
        :root {
            --primary-color: #E8112D;
            /* Rouge Bénin */
            --secondary-color: #008751;
            /* Vert Bénin */
            --accent-color: #FCD116;
            /* Jaune Bénin */
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
            --sidebar-width: 250px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            min-height: 100vh;
        }

        /* ===== LAYOUT PRINCIPAL ===== */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .dashboard-sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--dark-color) 0%, #2d4059 100%);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            padding: 0;
            z-index: 1000;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            /* Réduit le padding latéral */
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-size: 1.3rem;
            /* Réduit la taille du texte */
            font-weight: bold;
        }

        /* Profil utilisateur réduit */
        .user-profile {
            padding: 1rem 1rem;
            /* Réduit le padding */
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 0.5rem;
            /* Réduit l'espacement */
        }

        .user-avatar {
            width: 50px !important;
            /* Réduit de 80px à 50px */
            height: 50px !important;
            /* Réduit de 80px à 50px */
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent-color);
            /* Bordure plus fine */
            margin: 0 auto 0.75rem auto;
            /* Réduit l'espacement */
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            /* Réduit la taille de police */
            font-weight: bold;
        }

        .user-name {
            font-size: 1rem;
            /* Réduit de 1.1rem à 1rem */
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .user-role {
            font-size: 0.8rem;
            /* Réduit de 0.85rem à 0.8rem */
            color: rgba(255, 255, 255, 0.7);
            background: rgba(255, 255, 255, 0.1);
            padding: 0.2rem 0.6rem;
            /* Padding réduit */
            border-radius: 20px;
            display: inline-block;
        }

        /* Navigation Sidebar - éléments plus compacts */
        .sidebar-nav {
            padding: 0.5rem 0;
            /* Réduit le padding */
        }

        .nav-item {
            margin-bottom: 0.15rem;
            /* Réduit l'espacement entre éléments */
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            /* Réduit l'espace entre icône et texte */
            padding: 0.7rem 1rem;
            /* Padding réduit */
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 2px solid transparent;
            /* Bordure plus fine */
            font-size: 0.9rem;
            /* Texte légèrement plus petit */
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-left-color: var(--accent-color);
        }

        .nav-link.active {
            color: white;
            background: rgba(232, 17, 45, 0.2);
            border-left-color: var(--primary-color);
        }

        .nav-link i {
            width: 18px;
            /* Réduit la largeur */
            text-align: center;
            font-size: 1rem;
            /* Réduit la taille des icônes */
        }

        .nav-badge {
            margin-left: auto;
            background: var(--primary-color);
            color: white;
            font-size: 0.7rem;
            /* Réduit la taille */
            padding: 0.1rem 0.4rem;
            /* Padding réduit */
            border-radius: 8px;
            /* Border-radius réduit */
        }

        /* Ajustements pour mobile */
        @media (max-width: 768px) {
            .dashboard-sidebar {
                width: 60px;
                overflow-x: hidden;
            }

            .dashboard-sidebar:hover {
                width: var(--sidebar-width);
            }

            .dashboard-main {
                margin-left: 60px;
            }

            .sidebar-brand span,
            .user-name,
            .user-role,
            .nav-link span {
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .dashboard-sidebar:hover .sidebar-brand span,
            .dashboard-sidebar:hover .user-name,
            .dashboard-sidebar:hover .user-role,
            .dashboard-sidebar:hover .nav-link span {
                opacity: 1;
            }

            /* Taille de photo encore plus petite sur mobile */
            .user-avatar {
                width: 40px !important;
                height: 40px !important;
                font-size: 1.2rem;
            }
        }

        /* Navigation Sidebar */
        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.85rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-left-color: var(--accent-color);
        }

        .nav-link.active {
            color: white;
            background: rgba(232, 17, 45, 0.2);
            border-left-color: var(--primary-color);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--primary-color);
            color: white;
            font-size: 0.75rem;
            padding: 0.15rem 0.5rem;
            border-radius: 10px;
        }

        /* ===== CONTENU PRINCIPAL ===== */
        .dashboard-main {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 0;
            min-height: 100vh;
        }

        /* Topbar */
        .dashboard-topbar {
            background: white;
            padding: 1rem 2rem;
            border-bottom: 1px solid #eaeaea;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-left h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .topbar-left p {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), #ff416c);
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(232, 17, 45, 0.3);
            color: white;
        }

        .btn-outline-custom {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Content Area */
        .dashboard-content {
            padding: 2rem;
        }

        /* ===== CARTES ===== */
        .dashboard-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            color: var(--primary-color);
        }

        /* Cartes de statistiques */
        .stat-card {
            text-align: center;
            border-top: 4px solid var(--primary-color);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-color);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ===== TABLES ===== */
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: var(--dark-color);
            color: white;
        }

        .table th {
            border: none;
            font-weight: 600;
            padding: 1rem;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        /* ===== BADGES ===== */
        .badge {
            padding: 0.35em 0.65em;
            font-weight: 600;
        }

        .badge-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .badge-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .badge-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        /* ===== FORMULAIRES ===== */
        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #dee2e6;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(232, 17, 45, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        /* ===== UTILITAIRES ===== */
        .text-primary-custom {
            color: var(--primary-color) !important;
        }

        .bg-primary-custom {
            background-color: var(--primary-color) !important;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            color: #adb5bd;
            margin-bottom: 1rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .dashboard-sidebar {
                width: 60px;
                overflow-x: hidden;
            }

            .dashboard-sidebar:hover {
                width: var(--sidebar-width);
            }

            .dashboard-main {
                margin-left: 60px;
            }

            .sidebar-brand span,
            .user-name,
            .user-role,
            .nav-link span {
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .dashboard-sidebar:hover .sidebar-brand span,
            .dashboard-sidebar:hover .user-name,
            .dashboard-sidebar:hover .user-role,
            .dashboard-sidebar:hover .nav-link span {
                opacity: 1;
            }

            .dashboard-content {
                padding: 1rem;
            }
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Loader -->
    <div class="loader" id="pageLoader"
        style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--dark-color), #0f3460);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease;
    ">
        <div class="spinner"
            style="
            width: 60px;
            height: 60px;
            border: 4px solid rgba(252, 209, 22, 0.3);
            border-top-color: var(--accent-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        ">
        </div>
        <div class="loader-text"
            style="
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 2px;
        ">
            Bénin Culture</div>
    </div>

    <div class="dashboard-container">
        <!-- SIDEBAR -->
        @include('front.dashboard.partials.sidebar')

        <!-- CONTENU PRINCIPAL -->
        <main class="dashboard-main">
            <!-- TOPBAR -->
            <div class="dashboard-topbar">
                <div class="topbar-left">
                    <h1>@yield('page-title', 'Tableau de bord')</h1>
                    <p>@yield('page-subtitle', 'Bienvenue dans votre espace personnel')</p>
                </div>

                <div class="topbar-right">
                    <div class="topbar-actions">
                        <a href="{{ route('dashboard.contribuer') }}" class="btn btn-primary-custom">
                            <i class="bi bi-plus-circle me-2"></i>Nouvelle contribution
                        </a>
                        <a href="{{ route('front.home') }}" class="btn btn-outline-custom">
                            <i class="bi bi-globe-africa me-2"></i>Voir le site
                        </a>
                    </div>
                </div>
            </div>

            <!-- CONTENU -->
            <div class="dashboard-content">
                <!-- Messages Flash -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show fade-in" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show fade-in" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Veuillez corriger les erreurs suivantes :</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Contenu de la page -->
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Loader
        window.addEventListener('load', function() {
            setTimeout(() => {
                const loader = document.getElementById('pageLoader');
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }, 1000);
        });

        // Gestion de la sidebar responsive
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.dashboard-sidebar');
            const mainContent = document.querySelector('.dashboard-main');

            if (window.innerWidth <= 768 && sidebar) {
                sidebar.addEventListener('mouseenter', () => {
                    sidebar.style.width = '250px';
                });

                sidebar.addEventListener('mouseleave', () => {
                    sidebar.style.width = '60px';
                });
            }
        });

        // Confirmation pour les actions importantes
        document.addEventListener('submit', function(e) {
            if (e.target.classList.contains('requires-confirmation')) {
                if (!confirm('Êtes-vous sûr de vouloir effectuer cette action ?')) {
                    e.preventDefault();
                }
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
