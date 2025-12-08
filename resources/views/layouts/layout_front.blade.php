<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Plateforme numérique pour la promotion de la culture et des langues du Bénin">
    <title>Bénin Culture | @yield('title', 'Accueil')</title>

    <!-- Bootstrap 5.3 + Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Leaflet pour la carte interactive -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Swiper pour carousel moderne -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- CSS personnalisé -->
    <style>
        :root {
            --primary: #FCD116; /* Jaune Bénin */
            --secondary: #008751; /* Vert Bénin */
            --accent: #E8112D; /* Rouge Bénin */
            --dark: #1A1A2E;
            --light: #F8F9FA;
            --gradient-bg: linear-gradient(135deg, #FCD116 0%, #008751 50%, #E8112D 100%);
            --gradient-vertical: linear-gradient(to bottom, #FCD116 0%, #008751 50%, #E8112D 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #fefefe;
            color: #333;
            overflow-x: hidden;
            padding-top: 80px; /* Pour la navbar fixe */
        }

        /* Header & Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            border-image: var(--gradient-bg);
            border-image-slice: 1;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: var(--gradient-bg);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 600;
            margin: 0 0.3rem;
            padding: 0.6rem 1.2rem !important;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--gradient-bg);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 3px;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }

        /* Hero Section */
        .hero-section {
            height: 90vh;
            min-height: 700px;
            background: linear-gradient(rgba(26, 26, 46, 0.85), rgba(26, 26, 46, 0.95)),
                        url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            margin-top: -80px;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-bg);
            opacity: 0.2;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, #FCD116, #fff, #008751);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            line-height: 1.1;
        }

        /* Cards Pinterest Style */
        .culture-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            border: none;
            position: relative;
            cursor: pointer;
        }

        .culture-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .card-image-container {
            position: relative;
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .card-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 2;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        /* Actions Pinterest Style */
        .card-actions {
            position: absolute;
            bottom: 15px;
            right: 15px;
            display: flex;
            gap: 8px;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 20;
        }

        .culture-card:hover .card-actions {
            opacity: 1;
            transform: translateY(0);
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            color: #333;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .action-btn:hover {
            transform: scale(1.15);
            background: white;
        }

        .action-btn.like-btn:hover {
            color: #E8112D;
            box-shadow: 0 4px 15px rgba(232, 17, 45, 0.3);
        }

        .action-btn.favorite-btn:hover {
            color: #FCD116;
            box-shadow: 0 4px 15px rgba(252, 209, 22, 0.3);
        }

        .action-btn.comment-btn:hover {
            color: #008751;
            box-shadow: 0 4px 15px rgba(0, 135, 81, 0.3);
        }

        .action-btn.share-btn:hover {
            color: #1A1A2E;
            box-shadow: 0 4px 15px rgba(26, 26, 46, 0.3);
        }

        .action-btn.liked {
            color: #E8112D;
            background: rgba(232, 17, 45, 0.1);
        }

        .action-btn.favorited {
            color: #FCD116;
            background: rgba(252, 209, 22, 0.1);
        }

        /* Card Body */
        .card-body-custom {
            padding: 1.5rem;
        }

        .author-info {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .author-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .author-details {
            margin-left: 12px;
        }

        .author-name {
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 2px;
        }

        .author-meta {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .card-title-custom {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            line-height: 1.4;
            color: #1A1A2E;
        }

        .card-text-custom {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1.25rem;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .meta-stats {
            display: flex;
            gap: 20px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .location-badge {
            background: linear-gradient(135deg, #F8F9FA 0%, #E9ECEF 100%);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #495057;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding: 5rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 100%;
            background: var(--gradient-vertical);
            border-radius: 10px;
        }

        .timeline-item {
            margin-bottom: 4rem;
            position: relative;
            width: 45%;
        }

        .timeline-item:nth-child(odd) {
            margin-left: 0;
            margin-right: auto;
            padding-right: 4rem;
        }

        .timeline-item:nth-child(even) {
            margin-left: auto;
            margin-right: 0;
            padding-left: 4rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            background: white;
            border: 4px solid var(--accent);
            border-radius: 50%;
            top: 20px;
            box-shadow: 0 4px 15px rgba(232, 17, 45, 0.3);
        }

        .timeline-item:nth-child(odd)::before {
            right: -12px;
        }

        .timeline-item:nth-child(even)::before {
            left: -12px;
        }

        /* Carte Interactive */
        #benin-map {
            height: 500px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border: 5px solid white;
        }

        /* Quiz Section */
        .quiz-section {
            background: linear-gradient(135deg, #1A1A2E 0%, #16213E 100%);
            border-radius: 30px;
            padding: 4rem;
            color: white;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
        }

        .quiz-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(252, 209, 22, 0.1) 0%, transparent 70%);
            z-index: 0;
        }

        .quiz-content {
            position: relative;
            z-index: 1;
        }

        /* Call to Action Section */
        .cta-section {
            background: linear-gradient(135deg, #FCD116 0%, #008751 50%, #E8112D 100%);
            padding: 6rem 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            opacity: 0.1;
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 2rem;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-cta-primary {
            background: white;
            color: #1A1A2E;
            border: none;
            padding: 1rem 3rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-cta-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            color: #1A1A2E;
        }

        .btn-cta-outline {
            background: transparent;
            color: white;
            border: 3px solid white;
            padding: calc(1rem - 3px) 3rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-cta-outline:hover {
            background: white;
            color: #1A1A2E;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Section Titles */
        .section-title {
            font-size: 2.8rem;
            font-weight: 900;
            margin-bottom: 1rem;
            background: var(--gradient-bg);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-align: center;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
            text-align: center;
            margin-bottom: 4rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1A1A2E 0%, #0F3460 100%);
            color: white;
            padding: 5rem 0 2rem;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient-bg);
        }

        /* Loader */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1A1A2E 0%, #0F3460 100%);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease;
        }

        .loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .spinner {
            width: 80px;
            height: 80px;
            border: 4px solid rgba(255, 255, 255, 0.1);
            border-top: 4px solid var(--primary);
            border-right: 4px solid var(--secondary);
            border-bottom: 4px solid var(--accent);
            border-radius: 50%;
            animation: spin 1.5s linear infinite;
        }

        .loader-text {
            margin-top: 2rem;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Style pour les cartes dans les liens */
        a .culture-card,
        a .region-card {
            text-decoration: none !important;
        }

        /* S'assurer que le texte reste lisible */
        a:hover .card-title-custom,
        a:hover h4,
        a:hover h5,
        a:hover h6 {
            color: var(--primary) !important;
            text-decoration: none !important;
        }

        /* === CORRECTIONS POUR LE DASHBOARD === */

        /* S'assurer que le body a la bonne hauteur */
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Conteneur principal du dashboard */
        .dashboard-container {
            display: flex;
            flex: 1;
            margin-top: 80px; /* Pour le header fixe */
            min-height: calc(100vh - 80px - 60px); /* hauteur totale - header - footer */
            position: relative;
        }

        /* Sidebar du dashboard - corrigé */
        .dashboard-sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1A1A2E 0%, #2A2A4E 100%);
            color: white;
            position: fixed;
            top: 80px; /* Commence après le header */
            left: 0;
            height: calc(100vh - 80px - 60px); /* Ajusté pour le footer */
            padding: 0;
            z-index: 1000;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        /* Contenu principal du dashboard */
        .dashboard-main {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            background: #f8fafc;
            min-height: calc(100vh - 80px - 60px); /* Ajusté pour le footer */
            width: calc(100% - 280px);
            overflow-x: hidden;
        }

        /* Footer pour les pages dashboard */
        .dashboard-container + .footer {
            margin-left: 280px;
            width: calc(100% - 280px);
            position: relative;
            background: linear-gradient(135deg, #1A1A2E 0%, #0F3460 100%);
            z-index: 10;
        }

        /* Style pour le menu utilisateur */
        .user-menu .dropdown-toggle {
            color: #333;
            text-decoration: none;
        }

        .user-menu .dropdown-toggle:hover {
            color: var(--primary);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
        }

        .user-initials {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            font-weight: bold;
            border: 2px solid var(--primary);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .dashboard-sidebar {
                width: 70px;
                overflow-x: hidden;
            }

            .dashboard-sidebar:hover {
                width: 280px;
            }

            .dashboard-main {
                margin-left: 70px;
                width: calc(100% - 70px);
                padding: 1rem;
            }

            .dashboard-container + .footer {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            /* Masquer les textes dans la sidebar réduite */
            .sidebar-header span,
            .user-name,
            .user-role,
            .nav-link span {
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .dashboard-sidebar:hover .sidebar-header span,
            .dashboard-sidebar:hover .user-name,
            .dashboard-sidebar:hover .user-role,
            .dashboard-sidebar:hover .nav-link span {
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .dashboard-main {
                padding: 1rem;
            }

            .dashboard-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .page-title h1 {
                font-size: 1.5rem;
            }
        }

        /* Empêcher le débordement */
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        /* Assurer que le contenu est visible */
        .dashboard-card {
            position: relative;
            z-index: 1;
        }

        /* Correction du scroll */
        .dashboard-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .dashboard-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .dashboard-sidebar::-webkit-scrollbar-thumb {
            background: rgba(252, 209, 22, 0.5);
            border-radius: 3px;
        }

        .dashboard-sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(252, 209, 22, 0.8);
        }

        /* Style spécial pour le lien boutique */
.nav-link[href*="boutique"] {
    background: linear-gradient(135deg, rgba(252, 209, 22, 0.1) 0%, rgba(0, 135, 81, 0.1) 100%);
    border: 2px solid transparent;
    border-image: linear-gradient(135deg, #FCD116, #008751) 1;
    border-image-slice: 1;
    margin: 0 0.5rem;
}

.nav-link[href*="boutique"]:hover {
    background: linear-gradient(135deg, rgba(252, 209, 22, 0.2) 0%, rgba(0, 135, 81, 0.2) 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(252, 209, 22, 0.2);
}

/* Animation pour le badge "Nouveau" */
@keyframes pulse {
    0% { transform: translate(-50%, -50%) scale(1); }
    50% { transform: translate(-50%, -50%) scale(1.1); }
    100% { transform: translate(-50%, -50%) scale(1); }
}

.badge.bg-danger {
    animation: pulse 2s infinite;
}

        /* Animations */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .cta-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }

            .hero-section {
                height: 80vh;
                min-height: 600px;
                margin-top: -70px;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .timeline::before {
                left: 30px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 4rem !important;
                padding-right: 1rem !important;
            }

            .timeline-item:nth-child(odd)::before,
            .timeline-item:nth-child(even)::before {
                left: 18px;
                right: auto;
            }

            .quiz-section {
                padding: 2rem 1.5rem;
            }

            .cta-section {
                padding: 4rem 1rem;
            }

            .cta-title {
                font-size: 2rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-cta-primary,
            .btn-cta-outline {
                width: 100%;
                max-width: 300px;
                text-align: center;
            }

            .card-image-container {
                height: 240px;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .card-image-container {
                height: 200px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Loader -->
    <div class="loader" id="pageLoader">
        <div class="spinner"></div>
        <div class="loader-text">Bénin Culture</div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('front.home') }}">
                <i class="bi bi-globe-africa me-2"></i>Bénin Culture
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('front.home') ? 'active' : '' }}"
           href="{{ route('front.home') }}">Accueil</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('front.explorer') ? 'active' : '' }}"
           href="{{ route('front.explorer') }}">Explorer</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('front.regions') ? 'active' : '' }}"
           href="{{ route('front.regions') }}">Régions</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('front.apropos') ? 'active' : '' }}"
           href="{{ route('front.apropos') }}">À propos</a>
    </li>

    <!-- BOUTIQUE AJOUTÉE ICI -->
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('boutique.index') ? 'active' : '' }}"
           href="{{ route('boutique.index') }}">
            <i class="bi bi-shop me-1"></i>Boutique
        </a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-translate me-1"></i>Langues
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-fonts me-2"></i>Français</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-fonts me-2"></i>Fon</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-fonts me-2"></i>Yoruba</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-fonts me-2"></i>Dendi</a></li>
        </ul>
    </li>
</ul>

                <!-- MENU UTILISATEUR AVEC VÉRIFICATION DE CONNEXION -->
                <div class="d-flex ms-lg-3 mt-3 mt-lg-0">
                    @auth
                        <!-- Menu utilisateur connecté -->
                        <div class="dropdown user-menu">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                @php
                                    $user = Auth::user();
                                    $hasPhoto = $user->photo && Storage::disk('public')->exists($user->photo);
                                @endphp

                                @if($hasPhoto)
                                    <img src="{{ asset('storage/' . $user->photo) }}"
                                         alt="Photo de profil"
                                         class="user-avatar me-2">
                                @else
                                    <div class="user-initials me-2">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="d-none d-lg-inline">{{ $user->name }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.index') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Tableau de bord
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.contributions') }}">
                                        <i class="bi bi-collection me-2"></i>Mes contributions
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.likes') }}">
                                        <i class="bi bi-heart me-2"></i>Mes favoris
                                    </a>
                                </li>

                                <li>
    <a class="dropdown-item" href="{{ route('boutique.index') }}">
        <i class="bi bi-shop me-2"></i>Boutique
    </a>
</li>
<li><hr class="dropdown-divider"></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.settings') }}">
                                        <i class="bi bi-gear me-2"></i>Paramètres
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('deconnexion') }}" id="logout-form">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- Menu visiteur non connecté -->
                        <a href="{{ route('front.connexion') }}" class="btn btn-outline-primary-custom me-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Connexion
                        </a>
                        <a href="{{ route('front.inscription') }}" class="btn btn-primary-custom">
                            <i class="bi bi-person-plus me-1"></i>S'inscrire
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3 class="mb-3">
                        <i class="bi bi-globe-africa me-2"></i>Bénin Culture
                    </h3>
                    <p>Plateforme numérique pour la promotion et la préservation de la richesse culturelle et linguistique du Bénin.</p>
                    <div class="social-icons mt-3">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-youtube fs-5"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="mb-3">Explorer</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('front.explorer') }}" class="text-white-50 text-decoration-none">Contenus</a></li>
                        <li class="mb-2"><a href="{{ route('front.regions') }}" class="text-white-50 text-decoration-none">Régions</a></li>
                        <li class="mb-2"><a href="/categories" class="text-white-50 text-decoration-none">Catégories</a></li>
                        <li class="mb-2"><a href="/quiz" class="text-white-50 text-decoration-none">Quiz</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="mb-3">Contribuer</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('dashboard.contribuer') }}" class="text-white-50 text-decoration-none">Ajouter un contenu</a></li>
                        <li class="mb-2"><a href="/traduire" class="text-white-50 text-decoration-none">Proposer une traduction</a></li>
                        <li class="mb-2"><a href="/medias" class="text-white-50 text-decoration-none">Partager des médias</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">Newsletter</h5>
                    <p class="text-white-50 mb-3">Restez informé des nouveautés culturelles</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Votre email">
                        <button class="btn btn-primary-custom" type="button">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </div>
            </div>

            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">

            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0 text-white-50">
                        &copy; {{ date('Y') }} Bénin Culture. Tous droits réservés.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="/confidentialite" class="text-white-50 text-decoration-none me-3">Confidentialité</a>
                    <a href="/conditions" class="text-white-50 text-decoration-none me-3">Conditions</a>
                    <a href="/contact" class="text-white-50 text-decoration-none">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- JavaScript personnalisé -->
    <script>
        // Loader
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('pageLoader').classList.add('hidden');
                setTimeout(() => {
                    document.getElementById('pageLoader').style.display = 'none';
                }, 500);
            }, 1000);
        });

        // Gestion des likes
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const contentId = this.dataset.id;
                const likeCount = document.getElementById(`like-count-${contentId}`);

                if (this.classList.contains('liked')) {
                    // Unlike
                    this.classList.remove('liked');
                    likeCount.textContent = parseInt(likeCount.textContent) - 1;
                    showNotification('Like retiré', 'info');
                } else {
                    // Like
                    this.classList.add('liked');
                    likeCount.textContent = parseInt(likeCount.textContent) + 1;

                    // Animation cœur
                    this.style.transform = 'scale(1.3)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 300);

                    showNotification('Contenu liké !', 'success');
                }
            });
        });

        // Gestion des favoris
        document.querySelectorAll('.favorite-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const contentId = this.dataset.id;

                if (this.classList.contains('favorited')) {
                    this.classList.remove('favorited');
                    showNotification('Retiré des favoris', 'info');
                } else {
                    this.classList.add('favorited');

                    // Animation étoile
                    this.style.transform = 'rotate(360deg) scale(1.3)';
                    setTimeout(() => {
                        this.style.transform = 'rotate(0deg) scale(1)';
                    }, 500);

                    showNotification('Ajouté aux favoris !', 'success');
                }
            });
        });

        // Partager
        document.querySelectorAll('.share-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const contentId = this.dataset.id;
                const url = window.location.href;
                const title = document.title;

                if (navigator.share) {
                    navigator.share({
                        title: 'Découvrez ce contenu sur Bénin Culture',
                        text: 'Regardez ce contenu culturel incroyable !',
                        url: url + '/contenu/' + contentId
                    });
                } else {
                    navigator.clipboard.writeText(url).then(() => {
                        showNotification('Lien copié dans le presse-papier !', 'success');
                    });
                }
            });
        });

        // Ouvrir modal commentaire
        document.querySelectorAll('.comment-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const contentId = this.dataset.id;
                showNotification('Ouverture des commentaires...', 'info');
            });
        });

        // Confirmation de déconnexion
        document.addEventListener('DOMContentLoaded', function() {
            const logoutForm = document.getElementById('logout-form');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (confirm('Voulez-vous vraiment vous déconnecter ?')) {
                        this.submit();
                    }
                });
            }

            // Empêcher le dropdown de fermer quand on clique sur le formulaire de déconnexion
            document.querySelectorAll('.dropdown-menu form').forEach(form => {
                form.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });

        // Initialiser la carte du Bénin
        if (document.getElementById('benin-map')) {
            initBeninMap();
        }

        // Initialiser le quiz
        if (document.getElementById('quiz-container')) {
            initCulturalQuiz();
        }

        // Fonction pour la carte interactive
        function initBeninMap() {
            const map = L.map('benin-map').setView([9.3077, 2.3158], 7);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Points pour les régions du Bénin
            const regions = [
                { name: "Atacora", coords: [10.30, 1.67], color: "#FCD116", content: "Région des montagnes et traditions ancestrales" },
                { name: "Donga", coords: [9.19, 1.67], color: "#008751", content: "Terre des Tanéka" },
                { name: "Borgou", coords: [10.18, 2.78], color: "#E8112D", content: "Royaume Bariba" },
                { name: "Alibori", coords: [11.13, 2.94], color: "#FCD116", content: "Région des Peuls et Dendi" },
                { name: "Collines", coords: [8.00, 2.18], color: "#008751", content: "Cœur historique du Bénin" },
                { name: "Zou", coords: [7.35, 2.07], color: "#E8112D", content: "Royaume de Danxomè" },
                { name: "Plateau", coords: [7.00, 2.52], color: "#FCD116", content: "Terre des Nagots" },
                { name: "Ouémé", coords: [6.50, 2.60], color: "#008751", content: "Culture Goun" },
                { name: "Atlantique", coords: [6.37, 2.42], color: "#E8112D", content: "Côte et traditions Yoruba" },
                { name: "Littoral", coords: [6.37, 2.43], color: "#FCD116", content: "Cotonou - Capitale économique" },
                { name: "Mono", coords: [6.65, 1.72], color: "#008751", content: "Royaume de Houéda" },
                { name: "Couffo", coords: [7.00, 1.80], color: "#E8112D", content: "Terre des Xwla et Xwéda" }
            ];

            regions.forEach(region => {
                const icon = L.divIcon({
                    html: `<div style="
                        width: 25px;
                        height: 25px;
                        background: ${region.color};
                        border-radius: 50%;
                        border: 3px solid white;
                        box-shadow: 0 0 10px rgba(0,0,0,0.3);
                        cursor: pointer;
                    "></div>`,
                    className: 'custom-marker',
                    iconSize: [25, 25]
                });

                const marker = L.marker(region.coords, { icon: icon }).addTo(map);
                marker.bindPopup(`
                    <div class="map-popup" style="min-width: 200px;">
                        <h6 class="fw-bold mb-2" style="color: ${region.color}">${region.name}</h6>
                        <p class="mb-2">${region.content}</p>
                        <button onclick="window.location.href='/region/${region.name.toLowerCase()}'"
                                class="btn btn-sm w-100"
                                style="background: ${region.color}; color: white; border: none;">
                            Explorer la région
                        </button>
                    </div>
                `);
            });
        }

        // Fonction pour le quiz culturel
        function initCulturalQuiz() {
            const quizQuestions = [
                {
                    question: "Quelle est la capitale historique du Royaume de Danxomè?",
                    options: ["Porto-Novo", "Abomey", "Cotonou", "Ouidah"],
                    correct: 1
                },
                {
                    question: "Quelle langue est principalement parlée dans la région de l'Atacora?",
                    options: ["Fon", "Dendi", "Yoruba", "Ditammari"],
                    correct: 3
                },
                {
                    question: "Quel plat traditionnel béninois est à base de pâte de maïs?",
                    options: ["Akassa", "Fufu", "Amala", "Gari"],
                    correct: 0
                }
            ];

            let currentQuestion = 0;
            let score = 0;

            function loadQuestion() {
                if (currentQuestion >= quizQuestions.length) {
                    showResults();
                    return;
                }

                const q = quizQuestions[currentQuestion];
                document.getElementById('quiz-question').textContent = q.question;

                const optionsContainer = document.getElementById('quiz-options');
                optionsContainer.innerHTML = '';

                q.options.forEach((option, index) => {
                    const optionDiv = document.createElement('div');
                    optionDiv.className = 'quiz-option';
                    optionDiv.innerHTML = `
                        <div class="d-flex align-items-center">
                            <div class="option-letter me-3" style="
                                width: 40px;
                                height: 40px;
                                background: rgba(255,255,255,0.1);
                                border-radius: 10px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-weight: bold;
                                font-size: 1.2rem;
                            ">${String.fromCharCode(65 + index)}</div>
                            <div style="font-size: 1.1rem;">${option}</div>
                        </div>
                    `;

                    optionDiv.addEventListener('click', () => checkAnswer(index));
                    optionsContainer.appendChild(optionDiv);
                });

                document.getElementById('quiz-progress').textContent =
                    `Question ${currentQuestion + 1}/${quizQuestions.length}`;
            }

            function checkAnswer(selectedIndex) {
                const q = quizQuestions[currentQuestion];
                const options = document.querySelectorAll('.quiz-option');

                options.forEach((opt, index) => {
                    if (index === q.correct) {
                        opt.style.background = 'rgba(0, 135, 81, 0.3)';
                        opt.style.borderColor = '#008751';
                    }
                    if (index === selectedIndex && index !== q.correct) {
                        opt.style.background = 'rgba(232, 17, 45, 0.3)';
                        opt.style.borderColor = '#E8112D';
                    }
                });

                if (selectedIndex === q.correct) {
                    score++;
                }

                setTimeout(() => {
                    currentQuestion++;
                    loadQuestion();
                }, 1500);
            }

            function showResults() {
                const percentage = Math.round((score/quizQuestions.length)*100);
                document.getElementById('quiz-container').innerHTML = `
                    <div class="text-center py-5">
                        <h2 class="mb-4 fw-bold">Quiz Terminé !</h2>
                        <div class="score-display mb-4">
                            <div class="score-circle mx-auto mb-3" style="
                                width: 150px; height: 150px;
                                background: var(--gradient-bg);
                                border-radius: 50%;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 3rem;
                                font-weight: bold;
                                color: white;
                                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                            ">
                                ${score}/${quizQuestions.length}
                            </div>
                            <p class="mb-4 fs-5">Votre score : ${percentage}%</p>
                        </div>
                        <button onclick="initCulturalQuiz()" class="btn btn-cta-primary px-5">
                            <i class="bi bi-arrow-repeat me-2"></i>Recommencer le quiz
                        </button>
                    </div>
                `;
            }

            loadQuestion();
        }

        // Notification système
        function showNotification(message, type = 'info') {
            const colors = {
                'success': '#008751',
                'error': '#E8112D',
                'info': '#1A1A2E',
                'warning': '#FCD116'
            };

            const notification = document.createElement('div');
            notification.className = `position-fixed top-0 end-0 m-3`;
            notification.style.cssText = `
                z-index: 9999;
                animation: slideIn 0.3s ease;
            `;

            notification.innerHTML = `
                <div class="alert alert-${type} shadow-lg border-0" style="
                    background: ${colors[type]};
                    color: white;
                    border-radius: 15px;
                    min-width: 300px;
                ">
                    <div class="d-flex align-items-center">
                        <i class="bi ${type === 'success' ? 'bi-check-circle' :
                                      type === 'error' ? 'bi-exclamation-circle' :
                                      'bi-info-circle'} me-2 fs-5"></i>
                        <span>${message}</span>
                        <button type="button" class="btn-close btn-close-white ms-auto"
                                onclick="this.parentElement.parentElement.remove()"></button>
                    </div>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                if (notification.parentElement) {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => {
                        if (notification.parentElement) {
                            notification.remove();
                        }
                    }, 300);
                }
            }, 4000);
        }

        // Ajout des animations CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }

            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>

    @stack('scripts')
</body>
</html>
