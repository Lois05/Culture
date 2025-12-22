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

    <!-- Animation CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        :root {
            --primary: #E8112D;
            --primary-light: rgba(232, 17, 45, 0.1);
            --secondary: #FCD116;
            --accent: #008751;
            --dark: #1a1a1a;
            --light: #f8f9fa;
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
            padding-top: 80px;
        }

        /* ============ NAVBAR ============ */
        .navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            border-image: linear-gradient(135deg, var(--primary), var(--secondary), var(--accent));
            border-image-slice: 1;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary), var(--accent));
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
        }

        .nav-link:hover {
            background: var(--primary-light);
            color: var(--primary) !important;
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white !important;
        }

        /* ============ HERO SECTION ============ */
        .hero-section {
            position: relative;
            width: 100%;
            height: 100vh;
            min-height: 800px;
            overflow: hidden;
        }

        #heroCarousel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        #heroCarousel .carousel-inner,
        #heroCarousel .carousel-item {
            width: 100%;
            height: 100%;
        }

        .hero-slide-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            filter: brightness(0.9);
        }

        .hero-slide-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom,
                rgba(0, 0, 0, 0.4) 0%,
                rgba(0, 0, 0, 0.3) 50%,
                rgba(0, 0, 0, 0.6) 100%);
        }

        .hero-content-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-content {
            text-align: center;
            max-width: 1200px;
            padding: 0 20px;
            margin-top: 100px;
        }

        .hero-title {
            font-size: clamp(2.8rem, 6vw, 5rem);
            font-weight: 900;
            color: white;
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.8);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.5px;
        }

        .hero-subtitle {
            font-size: clamp(1.3rem, 3vw, 2rem);
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 0 2px 15px rgba(0, 0, 0, 0.5);
            max-width: 800px;
            margin: 0 auto 3rem;
            line-height: 1.4;
            font-weight: 300;
        }

        .hero-statistics {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.25);
            max-width: 900px;
            margin: 0 auto 3rem auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .stat-item {
            padding: 0 1.5rem;
        }

        .stat-number {
            font-size: clamp(2.8rem, 5vw, 4rem);
            background: linear-gradient(135deg, #FCD116, #E8112D);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1;
            font-weight: 900;
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.95);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, var(--primary), #c20a24);
            border: none;
            color: white;
            font-weight: 700;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 15px 40px rgba(232, 17, 45, 0.4);
            font-size: 1.2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 220px;
        }

        .btn-hero-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(232, 17, 45, 0.5);
            color: white;
        }

        .btn-hero-secondary {
            background: transparent;
            border: 3px solid white;
            color: white;
            font-weight: 700;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-size: 1.2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 220px;
            backdrop-filter: blur(10px);
        }

        .btn-hero-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
            color: white;
            border-color: rgba(255, 255, 255, 0.8);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 70px;
            height: 70px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.7;
            transition: all 0.3s ease;
            margin: 0 25px;
            z-index: 3;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: rgba(0, 0, 0, 0.6);
            opacity: 1;
            border-color: rgba(255, 255, 255, 0.4);
        }

        .carousel-indicators {
            bottom: 40px;
            margin-bottom: 0;
            z-index: 3;
        }

        .carousel-indicators button {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            margin: 0 8px;
            border: 2px solid white;
            background-color: transparent;
            opacity: 0.6;
            transition: all 0.3s ease;
        }

        .carousel-indicators button.active {
            background-color: var(--primary);
            opacity: 1;
            transform: scale(1.3);
            border-color: var(--primary);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            color: white;
            text-align: center;
            animation: bounce 2s infinite;
        }

        .scroll-indicator a {
            color: white;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .scroll-indicator span {
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: 0.8;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        /* ============ TIMELINE INTERACTIVE ============ */
        .timeline-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
        }

        .timeline-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .timeline-header .badge {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 12px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            margin-bottom: 25px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(232, 17, 45, 0.2);
        }

        .timeline-header h2 {
            font-size: 3.2rem;
            font-weight: 900;
            color: #1a1a1a;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .timeline-header p {
            font-size: 1.3rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .timeline-navigation {
            margin-bottom: 50px;
        }

        .timeline-nav-buttons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 0 20px;
        }

        .timeline-nav-btn {
            background: white;
            border: 2px solid #dee2e6;
            color: #6c757d;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .timeline-nav-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .timeline-nav-btn.active {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-color: var(--primary);
            color: white;
            box-shadow: 0 15px 40px rgba(232, 17, 45, 0.25);
            transform: translateY(-5px);
        }

        .timeline-content-wrapper {
            position: relative;
            min-height: 600px;
        }

        .timeline-content {
            display: none;
            animation: timelineFadeIn 0.6s ease;
        }

        @keyframes timelineFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .timeline-content.active {
            display: block;
        }

        .timeline-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.1);
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .timeline-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 35px 90px rgba(0, 0, 0, 0.15);
        }

        .timeline-image-container {
            position: relative;
            height: 400px;
            overflow: hidden;
        }

        .timeline-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .timeline-card:hover .timeline-image-container img {
            transform: scale(1.08);
        }

        .period-badge {
            position: absolute;
            top: 25px;
            left: 25px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }

        .timeline-text-content {
            padding: 40px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .timeline-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .period-info {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .period-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-light), white);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.8rem;
            border: 2px solid var(--primary-light);
        }

        .period-date {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1rem;
            border: 2px solid var(--primary-light);
        }

        .timeline-description {
            font-size: 1.15rem;
            line-height: 1.7;
            color: #495057;
            margin-bottom: 30px;
            flex-grow: 1;
        }

        .timeline-highlights {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            border: 2px solid var(--primary-light);
        }

        .timeline-highlights h5 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .highlight-item {
            background: white;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .highlight-item:hover {
            transform: translateX(10px);
            border-color: var(--primary-light);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .highlight-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.3rem;
        }

        .timeline-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e9ecef;
        }

        .btn-prev-period,
        .btn-next-period {
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-prev-period {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            color: var(--primary);
            border: 2px solid var(--primary-light);
        }

        .btn-prev-period:hover {
            background: var(--primary);
            color: white;
            transform: translateX(-10px);
            box-shadow: 0 15px 40px rgba(232, 17, 45, 0.2);
        }

        .btn-next-period {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border: 2px solid var(--primary);
        }

        .btn-next-period:hover {
            background: linear-gradient(135deg, #c20a24, #008751);
            transform: translateX(10px);
            box-shadow: 0 15px 40px rgba(232, 17, 45, 0.3);
        }

        .timeline-progress {
            margin-top: 60px;
        }

        .progress-info {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .progress-label span:first-child {
            font-size: 1.1rem;
            font-weight: 600;
            color: #666;
        }

        #current-period {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
        }

        .progress {
            height: 10px;
            background: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: width 0.5s ease;
        }

        .progress-dates {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #888;
            font-weight: 500;
        }

        /* ============ MISSION INTERACTIVE ============ */
        .mission-section {
            padding: 100px 0;
            background: white;
            position: relative;
        }

        .mission-card {
            background: white;
            border-radius: 25px;
            padding: 40px;
            height: 100%;
            border: 2px solid var(--primary-light);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .mission-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(232, 17, 45, 0.1);
            border-color: var(--primary);
        }

        .mission-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-light), white);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 25px;
            border: 2px solid var(--primary-light);
            transition: all 0.3s ease;
        }

        .mission-card:hover .mission-icon {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            transform: rotate(15deg) scale(1.1);
        }

        .mission-card h4 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .mission-card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .mission-features {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mission-features li {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            color: #555;
            font-weight: 500;
        }

        .mission-features li i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        .mission-image {
            position: relative;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
            height: 100%;
            min-height: 500px;
        }

        .mission-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .mission-image:hover img {
            transform: scale(1.05);
        }

        .mission-image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 30px;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            color: white;
        }

        .mission-image-overlay h4 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .mission-image-overlay p {
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
        }

        /* ============ RÉGIONS INTERACTIVE ============ */
        .regions-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
        }

        .section-title {
            font-size: 3.2rem;
            font-weight: 900;
            color: #1a1a1a;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .section-subtitle {
            font-size: 1.3rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto 50px;
            line-height: 1.6;
        }

        .map-container {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            height: 600px;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(232, 17, 45, 0.1);
        }

        #benin-map {
            width: 100%;
            height: 100%;
            border-radius: 15px;
            overflow: hidden;
        }

        .map-legend {
            position: absolute;
            bottom: 30px;
            left: 30px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            z-index: 1000;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(232, 17, 45, 0.1);
        }

        .legend-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #666;
        }

        .legend-color {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            border: 2px solid transparent;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(232, 17, 45, 0.15);
            border-color: var(--primary-light);
        }

        .stat-card-number {
            font-size: 2.8rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1;
            margin-bottom: 10px;
        }

        .stat-card-label {
            font-size: 1.1rem;
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .regions-list {
            background: white;
            border-radius: 25px;
            padding: 30px;
            height: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(232, 17, 45, 0.1);
        }

        .regions-list h4 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .region-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            background: #f8f9fa;
        }

        .region-item:hover {
            background: var(--primary-light);
            transform: translateX(10px);
            border-color: var(--primary);
        }

        .region-item.active {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-color: var(--primary);
            transform: translateX(10px);
        }

        .region-item.active .region-info h5,
        .region-item.active .region-info p,
        .region-item.active .region-count {
            color: white !important;
        }

        .region-info h5 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .region-info p {
            font-size: 0.9rem;
            color: #666;
            margin: 0;
        }

        .region-count {
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .region-item.active .region-count {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* ============ CONTENUS PINTEREST ============ */
        .contenus-section {
            padding: 100px 0;
            background: white;
            position: relative;
        }

        .pinterest-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            margin: 50px 0;
        }

        .pin-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .pin-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 35px 90px rgba(232, 17, 45, 0.15);
        }

        .pin-image {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .pin-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .pin-card:hover .pin-image img {
            transform: scale(1.1);
        }

        .pin-type-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        .pin-region-badge {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 6px 12px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 6px;
            backdrop-filter: blur(5px);
        }

        .pin-actions {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .pin-card:hover .pin-actions {
            opacity: 1;
            transform: translateY(0);
        }

        .pin-action-btn {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 50%;
            color: var(--primary);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .pin-action-btn:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(232, 17, 45, 0.3);
        }

        .pin-action-btn.saved {
            background: var(--primary);
            color: white;
        }

        .pin-content {
            padding: 25px;
        }

        .pin-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .pin-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .pin-title a:hover {
            color: var(--primary);
        }

        .pin-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .pin-author {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f8f9fa;
        }

        .pin-author-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--primary-light);
        }

        .pin-author-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-initials {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            border: 3px solid var(--primary-light);
        }

        .pin-author-info h6 {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .pin-author-info p {
            font-size: 0.85rem;
            color: #888;
            margin: 0;
        }

        .pin-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .pin-stat {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 10px;
            border-radius: 10px;
        }

        .pin-stat:hover {
            background: var(--primary-light);
            transform: translateY(-5px);
        }

        .pin-stat i {
            font-size: 1.3rem;
            color: var(--primary);
        }

        .pin-stat-count {
            font-size: 1rem;
            font-weight: 900;
            color: #1a1a1a;
        }

        .pin-stat span:last-child {
            font-size: 0.75rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .pin-read-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .pin-read-btn:hover {
            background: linear-gradient(135deg, #c20a24, #008751);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(232, 17, 45, 0.3);
        }

        /* ============ QUIZ CULTUREL ============ */
        .quiz-section {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .quiz-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .quiz-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 50px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .quiz-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .quiz-header i {
            font-size: 4rem;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 20px;
            display: inline-block;
        }

        .quiz-header h3 {
            font-size: 2.2rem;
            font-weight: 900;
            color: white;
            margin-bottom: 15px;
        }

        .quiz-header p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .quiz-progress {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 40px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .quiz-question {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            margin-bottom: 40px;
            text-align: center;
            line-height: 1.4;
        }

        .quiz-option {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 2px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .quiz-option:hover:not(:disabled) {
            background: rgba(255, 255, 255, 0.1) !important;
            border-color: var(--primary) !important;
            transform: translateX(10px);
        }

        .quiz-option:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .quiz-option.correct {
            background: rgba(0, 135, 81, 0.2) !important;
            border-color: #008751 !important;
            color: white !important;
        }

        .quiz-option.incorrect {
            background: rgba(232, 17, 45, 0.2) !important;
            border-color: #E8112D !important;
            color: white !important;
        }

        .quiz-start-btn {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border: none;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            padding: 20px 50px;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        .quiz-start-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 30px 70px rgba(232, 17, 45, 0.4);
        }

        /* ============ CTA ============ */
        .cta-section {
            background: linear-gradient(135deg, var(--secondary), var(--accent), var(--primary));
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .cta-title {
            font-size: 3.5rem;
            font-weight: 900;
            color: white;
            margin-bottom: 30px;
            line-height: 1.2;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        /* ============ FOOTER ============ */
        .footer {
            background: linear-gradient(135deg, #1a1a2e, #0f3460);
            color: white;
            padding: 80px 0 30px;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, var(--primary), var(--secondary), var(--accent));
        }

        /* ============ LOADER ============ */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a1a2e, #0f3460);
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
            margin-top: 20px;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* ============ TOAST NOTIFICATIONS ============ */
        .toast-notification {
            position: fixed;
            top: 100px;
            right: 30px;
            background: white;
            border-radius: 15px;
            padding: 20px 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 15px;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-left: 5px solid var(--primary);
            max-width: 400px;
        }

        .toast-notification.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast-notification.success {
            border-left-color: #008751;
        }

        .toast-notification.info {
            border-left-color: #0DCAF0;
        }

        .toast-notification i {
            font-size: 1.5rem;
        }

        .toast-notification.success i {
            color: #008751;
        }

        .toast-notification.info i {
            color: #0DCAF0;
        }

        .toast-notification span {
            font-weight: 500;
            color: #333;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 1200px) {
            .hero-title {
                font-size: 4rem;
            }

            .timeline-header h2 {
                font-size: 2.8rem;
            }

            .section-title {
                font-size: 2.8rem;
            }
        }

        @media (max-width: 992px) {
            .hero-section {
                min-height: 700px;
            }

            .hero-title {
                font-size: 3rem;
            }

            .hero-subtitle {
                font-size: 1.5rem;
            }

            .hero-statistics {
                padding: 2rem;
            }

            .timeline-nav-buttons {
                flex-direction: column;
                align-items: center;
            }

            .timeline-nav-btn {
                width: 100%;
                max-width: 350px;
                justify-content: center;
            }

            .timeline-controls {
                flex-direction: column;
                gap: 15px;
            }

            .btn-prev-period,
            .btn-next-period {
                width: 100%;
                justify-content: center;
            }

            .mission-image {
                min-height: 400px;
                margin-bottom: 30px;
            }

            .map-container {
                height: 500px;
                margin-bottom: 30px;
            }

            .pinterest-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 20px;
            }

            .quiz-container {
                padding: 30px;
            }

            .quiz-question {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }

            .hero-section {
                height: 90vh;
                min-height: 600px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
                margin-bottom: 2rem;
            }

            .hero-statistics {
                padding: 1.5rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .hero-actions {
                flex-direction: column;
                align-items: center;
            }

            .btn-hero-primary,
            .btn-hero-secondary {
                width: 100%;
                max-width: 300px;
            }

            .timeline-header h2 {
                font-size: 2.2rem;
            }

            .timeline-header p {
                font-size: 1.1rem;
            }

            .timeline-image-container {
                height: 300px;
            }

            .timeline-text-content {
                padding: 25px;
            }

            .mission-card {
                padding: 25px;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .section-subtitle {
                font-size: 1.1rem;
            }

            .pinterest-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .pin-image {
                height: 220px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .map-container {
                height: 400px;
                padding: 20px;
            }

            .quiz-container {
                padding: 20px;
            }

            .quiz-header h3 {
                font-size: 1.8rem;
            }

            .quiz-question {
                font-size: 1.3rem;
            }

            .cta-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .timeline-header h2 {
                font-size: 1.8rem;
            }

            .timeline-nav-btn {
                padding: 12px 20px;
                font-size: 0.9rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .pin-actions {
                opacity: 1;
                transform: translateY(0);
                flex-direction: row;
                top: auto;
                bottom: 20px;
                right: 20px;
            }

            .pin-action-btn {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }

            .quiz-start-btn {
                padding: 15px 30px;
                font-size: 1rem;
            }

            .cta-title {
                font-size: 2rem;
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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('boutique.index') ? 'active' : '' }}"
                           href="{{ route('boutique.index') }}">
                            <i class="bi bi-shop me-1"></i>Boutique
                        </a>
                    </li>
                </ul>

                <!-- Menu utilisateur -->
                <div class="d-flex ms-lg-3 mt-3 mt-lg-0">
                    @auth
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                @php
                                    $user = Auth::user();
                                    $hasPhoto = $user->photo && Storage::disk('public')->exists($user->photo);
                                @endphp

                                @if($hasPhoto)
                                    <img src="@if($user->has_cloudinary && $user->cloudinary_url)
    {{ $user->cloudinary_url }}
@elseif($user->photo)
@if($user->has_cloudinary && $user->cloudinary_url)
    <img src="{{ $user->cloudinary_url }}"
@elseif($user->photo)
    @if($user->has_cloudinary && $user->cloudinary_url)
    <img src="{{ $user->cloudinary_url }}"
@elseif($user->photo)
    @if($user->has_cloudinary && $user->cloudinary_url)
    <img src="{{ $user->cloudinary_url }}"
@elseif($user->photo)
@if($user->has_cloudinary && $user->cloudinary_url)
@elseif($user->photo)
    <img src="{{ asset('storage/' . $user->
@else
    <div class="avatar-default">{{ substr($user->name, 0, 1) }}</div>
@endif
@else
    <div class="avatar-default">{{ substr($user->name, 0, 1) }}</div>
@endif{{ substr($user->name, 0, 1) }}</div>
@endif
@else
    <div class="avatar-default">{{ substr($user->name, 0, 1) }}</div>
@endif
@else
    <div class="avatar-default">{{ substr($user->name, 0, 1) }}</div>
@endif"
                                         alt="Photo de profil"
                                         class="rounded-circle me-2"
                                         style="width: 40px; height: 40px; object-fit: cover; border: 2px solid var(--primary);">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-2"
                                         style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--primary), var(--accent)); color: white; font-weight: bold;">
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
                                <li><hr class="dropdown-divider"></li>
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
                        <a href="{{ route('front.connexion') }}" class="btn btn-outline-primary me-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Connexion
                        </a>
                        <a href="{{ route('front.inscription') }}" class="btn btn-primary">
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
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                    <div class="footer-brand">
                        <h3 class="mb-3">
                            <i class="bi bi-globe-africa me-2"></i>Bénin Culture
                        </h3>
                        <p class="mb-4" style="color: rgba(255,255,255,0.8);">Plateforme numérique pour la promotion et la préservation de la richesse culturelle et linguistique du Bénin.</p>
                        <div class="social-icons">
                            <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                            <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-5"></i></a>
                            <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-youtube fs-5"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
                    <h5 class="mb-3">Explorer</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('front.explorer') }}" class="text-white-50 text-decoration-none">Contenus</a></li>
                        <li class="mb-2"><a href="{{ route('front.regions') }}" class="text-white-50 text-decoration-none">Régions</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Catégories</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Quiz</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
                    <h5 class="mb-3">Contribuer</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('dashboard.contribuer') }}" class="text-white-50 text-decoration-none">Ajouter un contenu</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Proposer une traduction</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Partager des médias</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h5 class="mb-3">Newsletter</h5>
                    <p class="text-white-50 mb-3">Restez informé des nouveautés culturelles</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Votre email">
                        <button class="btn btn-primary" type="button">
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
                    <a href="#" class="text-white-50 text-decoration-none me-3">Confidentialité</a>
                    <a href="#" class="text-white-50 text-decoration-none me-3">Conditions</a>
                    <a href="#" class="text-white-50 text-decoration-none">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Scripts personnalisés -->
    <script>
        // ============ FONCTIONS GÉNÉRALES ============

        // Loader
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('pageLoader').classList.add('hidden');
                setTimeout(() => {
                    document.getElementById('pageLoader').style.display = 'none';
                }, 500);
            }, 1000);
        });

        // Toast notifications
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `toast-notification ${type}`;
            toast.innerHTML = `
                <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-info-circle-fill'}"></i>
                <span>${message}</span>
            `;

            document.body.appendChild(toast);

            // Afficher avec animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 10);

            // Cacher après 3 secondes
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }

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

            // Smooth scroll pour ancres
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    if (this.getAttribute('href') !== '#') {
                        e.preventDefault();
                        const targetId = this.getAttribute('href');
                        const targetElement = document.querySelector(targetId);
                        if (targetElement) {
                            window.scrollTo({
                                top: targetElement.offsetTop - 80,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        });

        // ============ TIMELINE INTERACTIVE ============

        function initTimeline() {
            const timelineButtons = document.querySelectorAll('.timeline-nav-btn');
            const timelineContents = document.querySelectorAll('.timeline-content');
            const prevButton = document.querySelector('.btn-prev-period');
            const nextButton = document.querySelector('.btn-next-period');
            const progressBar = document.querySelector('.progress-bar');
            const currentPeriodSpan = document.getElementById('current-period');

            let currentPeriod = 0;
            const totalPeriods = timelineContents.length;

            function showPeriod(index) {
                // Validation
                if (index < 0 || index >= totalPeriods) return;

                // Désactiver tout
                timelineContents.forEach(content => content.classList.remove('active'));
                timelineButtons.forEach(button => button.classList.remove('active'));

                // Activer la période sélectionnée
                timelineContents[index].classList.add('active');
                timelineButtons[index].classList.add('active');

                // Mettre à jour la barre de progression
                const progressPercentage = ((index + 1) / totalPeriods) * 100;
                if (progressBar) {
                    progressBar.style.width = `${progressPercentage}%`;
                }
                if (currentPeriodSpan) {
                    currentPeriodSpan.textContent = `${index + 1}/${totalPeriods}`;
                }

                // Gérer l'état des boutons
                if (prevButton) {
                    prevButton.disabled = index === 0;
                    prevButton.style.opacity = index === 0 ? '0.5' : '1';
                    prevButton.style.cursor = index === 0 ? 'not-allowed' : 'pointer';
                }

                if (nextButton) {
                    nextButton.disabled = index === totalPeriods - 1;
                    nextButton.style.opacity = index === totalPeriods - 1 ? '0.5' : '1';
                    nextButton.style.cursor = index === totalPeriods - 1 ? 'not-allowed' : 'pointer';
                }

                currentPeriod = index;

                // Animation
                const activeContent = timelineContents[index];
                activeContent.style.animation = 'none';
                setTimeout(() => {
                    activeContent.style.animation = 'timelineFadeIn 0.6s ease';
                }, 10);
            }

            // Écouteurs pour les boutons de navigation
            timelineButtons.forEach((button, index) => {
                button.addEventListener('click', () => showPeriod(index));
            });

            // Écouteurs pour les boutons précédent/suivant
            if (prevButton) {
                prevButton.addEventListener('click', function() {
                    if (!this.disabled) {
                        showPeriod(currentPeriod - 1);
                    }
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', function() {
                    if (!this.disabled) {
                        showPeriod(currentPeriod + 1);
                    }
                });
            }

            // Démarrer avec la première période
            showPeriod(0);
        }

        // ============ CARTE INTERACTIVE DU BÉNIN ============

        function initBeninMap() {
            if (!document.getElementById('benin-map')) return;

            const map = L.map('benin-map', {
                center: [9.3077, 2.3158],
                zoom: 7,
                minZoom: 6,
                maxZoom: 12,
                scrollWheelZoom: true
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 12,
                minZoom: 6
            }).addTo(map);

            // Données des régions
            const regionsData = {
                'Atacora': {
                    lat: 10.30,
                    lng: 1.67,
                    color: '#E8112D',
                    count: 45,
                    capital: 'Natitingou',
                    description: 'Montagnes et traditions ancestrales'
                },
                'Donga': {
                    lat: 9.19,
                    lng: 1.67,
                    color: '#FCD116',
                    count: 32,
                    capital: 'Djougou',
                    description: 'Terre des Tanéka'
                },
                'Borgou': {
                    lat: 9.97,
                    lng: 2.72,
                    color: '#008751',
                    count: 67,
                    capital: 'Parakou',
                    description: 'Royaume Bariba'
                },
                'Alibori': {
                    lat: 11.13,
                    lng: 2.94,
                    color: '#E8112D',
                    count: 28,
                    capital: 'Kandi',
                    description: 'Région des Peuls et Dendi'
                },
                'Collines': {
                    lat: 8.00,
                    lng: 2.20,
                    color: '#FCD116',
                    count: 53,
                    capital: 'Dassa-Zoumé',
                    description: 'Cœur historique du Bénin'
                },
                'Zou': {
                    lat: 7.37,
                    lng: 2.07,
                    color: '#008751',
                    count: 89,
                    capital: 'Abomey',
                    description: 'Royaume de Danxomè'
                }
            };

            // Créer les marqueurs
            const markers = [];

            for (const [regionName, data] of Object.entries(regionsData)) {
                const icon = L.divIcon({
                    html: `
                        <div style="
                            width: 50px;
                            height: 50px;
                            background: ${data.color};
                            border-radius: 50%;
                            border: 4px solid white;
                            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: white;
                            font-weight: bold;
                            font-size: 14px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        " title="${regionName}">
                            ${data.count}
                        </div>
                    `,
                    className: 'custom-marker',
                    iconSize: [50, 50],
                    iconAnchor: [25, 50]
                });

                const marker = L.marker([data.lat, data.lng], { icon: icon })
                    .addTo(map)
                    .bindPopup(`
                        <div style="min-width: 250px; padding: 15px;">
                            <h4 style="margin: 0 0 10px 0; color: ${data.color}; font-weight: bold;">${regionName}</h4>
                            <p style="margin: 0 0 5px 0; color: #666; font-size: 0.9rem;">
                                <i class="bi bi-geo-alt"></i> Capitale : ${data.capital}
                            </p>
                            <p style="margin: 0 0 15px 0; color: #666; font-size: 0.9rem;">${data.description}</p>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-weight: bold; color: ${data.color};">${data.count} contenus</span>
                                <button onclick="showToast('Ouverture de la région ${regionName}', 'info')"
                                        style="background: ${data.color}; color: white; border: none; padding: 8px 20px; border-radius: 20px; cursor: pointer; font-weight: bold;">
                                    Explorer
                                </button>
                            </div>
                        </div>
                    `);

                // Stocker le marqueur
                markers.push({
                    name: regionName,
                    marker: marker,
                    data: data
                });

                // Animation au survol
                const iconElement = marker.getElement();
                if (iconElement) {
                    iconElement.addEventListener('mouseenter', function() {
                        this.style.transform = 'scale(1.2)';
                        this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.4)';
                    });

                    iconElement.addEventListener('mouseleave', function() {
                        this.style.transform = 'scale(1)';
                        this.style.boxShadow = '0 5px 20px rgba(0,0,0,0.3)';
                    });
                }
            }

            // Interaction avec la liste des régions
            document.querySelectorAll('.region-item').forEach(item => {
                item.addEventListener('click', function() {
                    const regionName = this.querySelector('h5').textContent.trim();
                    const marker = markers.find(m => m.name === regionName);

                    if (marker) {
                        // Ouvrir le popup
                        marker.marker.openPopup();

                        // Centrer la carte
                        map.setView([marker.data.lat, marker.data.lng], 8);

                        // Animation sur le marqueur
                        const icon = marker.marker.getElement();
                        if (icon) {
                            icon.style.transform = 'scale(1.3)';
                            setTimeout(() => {
                                icon.style.transform = 'scale(1)';
                            }, 300);
                        }

                        // Mettre en surbrillance l'élément de la liste
                        document.querySelectorAll('.region-item').forEach(i => {
                            i.classList.remove('active');
                        });
                        this.classList.add('active');

                        showToast(`Région ${regionName} sélectionnée`, 'info');
                    }
                });
            });

            // Ajouter une légende
            const legend = L.control({ position: 'bottomleft' });
            legend.onAdd = function(map) {
                const div = L.DomUtil.create('div', 'info legend');
                div.innerHTML = `
                    <div class="map-legend">
                        <div class="legend-title">
                            <i class="bi bi-map"></i>
                            <span>Légende</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #E8112D;"></div>
                            <span>Régions du Nord</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #FCD116;"></div>
                            <span>Régions du Centre</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #008751;"></div>
                            <span>Régions du Sud</span>
                        </div>
                    </div>
                `;
                return div;
            };
            legend.addTo(map);
        }

        // ============ INTERACTIONS PINTEREST ============

        function initPinterestInteractions() {
            // Gestion des likes
            document.querySelectorAll('.pin-action-btn.like-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const card = this.closest('.pin-card');
                    const likeCount = card.querySelector('.pin-stat.like-stat .pin-stat-count');

                    if (this.classList.contains('liked')) {
                        // Unlike
                        this.classList.remove('liked');
                        this.innerHTML = '<i class="bi bi-heart"></i>';
                        const currentCount = parseInt(likeCount.textContent);
                        likeCount.textContent = Math.max(0, currentCount - 1);
                        showToast('Like retiré', 'info');
                    } else {
                        // Like
                        this.classList.add('liked');
                        this.innerHTML = '<i class="bi bi-heart-fill"></i>';
                        const currentCount = parseInt(likeCount.textContent);
                        likeCount.textContent = currentCount + 1;

                        // Animation cœur
                        this.style.transform = 'scale(1.3)';
                        setTimeout(() => {
                            this.style.transform = 'scale(1)';
                        }, 300);

                        showToast('Contenu liké !', 'success');
                    }
                });
            });

            // Gestion des favoris
            document.querySelectorAll('.pin-action-btn.save-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();

                    if (this.classList.contains('saved')) {
                        this.classList.remove('saved');
                        this.innerHTML = '<i class="bi bi-bookmark"></i>';
                        showToast('Retiré des favoris', 'info');
                    } else {
                        this.classList.add('saved');
                        this.innerHTML = '<i class="bi bi-bookmark-fill"></i>';

                        // Animation
                        this.style.transform = 'rotate(360deg) scale(1.3)';
                        setTimeout(() => {
                            this.style.transform = 'rotate(0deg) scale(1)';
                        }, 500);

                        showToast('Ajouté aux favoris !', 'success');
                    }
                });
            });

            // Gestion du partage
            document.querySelectorAll('.pin-action-btn.share-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const card = this.closest('.pin-card');
                    const title = card.querySelector('.pin-title').textContent;

                    if (navigator.share) {
                        navigator.share({
                            title: title,
                            text: 'Découvrez ce contenu sur Bénin Culture',
                            url: window.location.href
                        }).then(() => {
                            showToast('Contenu partagé !', 'success');
                        }).catch(() => {
                            showToast('Partage annulé', 'info');
                        });
                    } else {
                        // Fallback
                        navigator.clipboard.writeText(window.location.href).then(() => {
                            showToast('Lien copié dans le presse-papier !', 'success');
                        });
                    }
                });
            });

            // Animation au survol des cartes
            document.querySelectorAll('.pin-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const actions = this.querySelector('.pin-actions');
                    if (actions) {
                        actions.style.opacity = '1';
                        actions.style.transform = 'translateY(0)';
                    }
                });
            });
        }

        // ============ QUIZ CULTUREL ============

        function initCulturalQuiz() {
            const questions = [
                {
                    question: "Quel est le nom du dernier roi indépendant du Dahomey ?",
                    options: ["Kpêto Gbêdê", "Béhanzin", "Gakpé", "Glèlè"],
                    answer: 1,
                    explanation: "Béhanzin fut le dernier roi indépendant du Dahomey avant la colonisation française."
                },
                {
                    question: "Quelle langue est principalement parlée dans la région du Zou ?",
                    options: ["Yoruba", "Fon", "Dendi", "Bariba"],
                    answer: 1,
                    explanation: "Le Fon est la langue principale de la région du Zou, cœur historique du royaume de Danxomè."
                },
                {
                    question: "Où se trouve la célèbre Porte du Non-Retour ?",
                    options: ["Abomey", "Ouidah", "Porto-Novo", "Cotonou"],
                    answer: 1,
                    explanation: "La Porte du Non-Retour se trouve à Ouidah, lieu symbolique de la traite négrière."
                }
            ];

            let currentQuestion = 0;
            let score = 0;

            function showQuestion() {
                const question = questions[currentQuestion];
                document.getElementById('quiz-question').textContent = question.question;

                const optionsContainer = document.getElementById('quiz-options');
                optionsContainer.innerHTML = '';

                question.options.forEach((option, index) => {
                    const button = document.createElement('button');
                    button.className = 'btn btn-outline-light w-100 mb-3 text-start py-3 quiz-option';
                    button.innerHTML = `
                        <span class="option-letter me-3 fw-bold">${String.fromCharCode(65 + index)}.</span>
                        <span>${option}</span>
                    `;
                    button.onclick = () => selectAnswer(index);
                    optionsContainer.appendChild(button);
                });

                // Mettre à jour la progression
                const progressBar = document.querySelector('.quiz-progress .progress-bar');
                const progressText = document.getElementById('quiz-progress');
                const progressPercentage = ((currentQuestion + 1) / questions.length) * 100;

                if (progressBar) {
                    progressBar.style.width = `${progressPercentage}%`;
                }
                if (progressText) {
                    progressText.textContent = `Question ${currentQuestion + 1}/${questions.length}`;
                }
            }

            function selectAnswer(selectedIndex) {
                const question = questions[currentQuestion];
                const options = document.querySelectorAll('#quiz-options .quiz-option');

                // Désactiver tous les boutons
                options.forEach(btn => btn.disabled = true);

                // Marquer la bonne réponse en vert
                options[question.answer].classList.remove('btn-outline-light');
                options[question.answer].classList.add('correct');

                // Si la réponse est incorrecte, marquer en rouge
                if (selectedIndex !== question.answer) {
                    options[selectedIndex].classList.remove('btn-outline-light');
                    options[selectedIndex].classList.add('incorrect');
                } else {
                    score++;
                }

                // Afficher l'explication
                setTimeout(() => {
                    showToast(question.explanation, 'info');

                    // Passer à la question suivante
                    setTimeout(() => {
                        currentQuestion++;
                        if (currentQuestion < questions.length) {
                            showQuestion();
                        } else {
                            showResults();
                        }
                    }, 2000);
                }, 1000);
            }

            function showResults() {
                const scorePercentage = Math.round((score / questions.length) * 100);
                let message = '';
                let badge = '';

                if (scorePercentage >= 90) {
                    message = 'Exceptionnel ! Vous êtes un véritable expert de la culture béninoise 🏆';
                    badge = '<span class="badge bg-warning ms-2">Expert</span>';
                } else if (scorePercentage >= 70) {
                    message = 'Excellent ! Vous maîtrisez bien la culture béninoise 🎯';
                    badge = '<span class="badge bg-success ms-2">Avancé</span>';
                } else if (scorePercentage >= 50) {
                    message = 'Bien ! Vous avez de bonnes connaissances de base 👍';
                    badge = '<span class="badge bg-info ms-2">Intermédiaire</span>';
                } else {
                    message = 'Continuez à explorer pour en savoir plus sur notre culture 📚';
                    badge = '<span class="badge bg-secondary ms-2">Débutant</span>';
                }

                document.getElementById('quiz-question').innerHTML = `
                    <div class="text-center">
                        <h4 class="mb-3 text-white">Quiz terminé !</h4>
                        <div class="display-1 fw-bold mb-3" style="color: var(--primary);">${scorePercentage}%</div>
                        <p class="mb-3 text-white">${message} ${badge}</p>
                        <small class="text-muted">Score : ${score} sur ${questions.length}</small>
                    </div>
                `;

                document.getElementById('quiz-options').innerHTML = `
                    <div class="text-center mt-4">
                        <button onclick="initCulturalQuiz()" class="btn btn-primary me-2 mb-2">
                            <i class="bi bi-arrow-repeat me-2"></i>Recommencer
                        </button>
                        <a href="{{ route('front.explorer') }}" class="btn btn-outline-light mb-2">
                            <i class="bi bi-compass me-2"></i>Explorer les contenus
                        </a>
                    </div>
                `;

                // Animation finale
                const finalProgressBar = document.querySelector('.quiz-progress .progress-bar');
                if (finalProgressBar) {
                    finalProgressBar.style.width = '100%';
                }

                showToast(`Quiz terminé avec ${scorePercentage}% de bonnes réponses !`, 'success');
            }

            // Cacher le bouton "Commencer" s'il existe
            const startButton = document.querySelector('.quiz-start-btn');
            if (startButton) {
                startButton.style.display = 'none';
            }

            // Afficher la première question
            showQuestion();
        }

        // ============ INITIALISATION GÉNÉRALE ============

        document.addEventListener('DOMContentLoaded', function() {
            // Initialiser tous les composants
            initTimeline();
            initBeninMap();
            initPinterestInteractions();

            // Animation au scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    }
                });
            }, { threshold: 0.1 });

            // Observer les cartes Pinterest
            document.querySelectorAll('.pin-card').forEach(card => {
                observer.observe(card);
            });

            // Observer les cartes mission
            document.querySelectorAll('.mission-card').forEach(card => {
                observer.observe(card);
            });

            // Observer les cartes timeline
            document.querySelectorAll('.timeline-card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
