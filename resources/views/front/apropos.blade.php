@extends('layouts.layout_front')

@section('title', 'À propos - Bénin Culture')

@push('styles')
<style>
    .about-hero {
        background: linear-gradient(135deg, rgba(26, 26, 46, 0.95), rgba(26, 26, 46, 0.98)),
                    url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?auto=format&fit=crop&w=1600&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 10rem 0 6rem;
        margin-top: -80px;
        position: relative;
        overflow: hidden;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--gradient-bg);
        opacity: 0.3;
        z-index: 1;
    }

    .about-hero-content {
        position: relative;
        z-index: 2;
    }

    .value-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        border: 2px solid transparent;
    }

    .value-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        border-color: var(--primary);
    }

    .value-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: white;
    }

    .team-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .team-image {
        height: 250px;
        object-fit: cover;
        width: 100%;
    }

    .team-social {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 1rem;
    }

    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        color: #333;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        transform: translateY(-3px);
        color: white;
    }

    .social-link.facebook:hover { background: #1877f2; }
    .social-link.twitter:hover { background: #1da1f2; }
    .social-link.linkedin:hover { background: #0077b5; }

    .timeline-vertical {
        position: relative;
        padding: 3rem 0;
    }

    .timeline-vertical::before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 3px;
        height: 100%;
        background: var(--gradient-vertical);
        border-radius: 10px;
    }

    .timeline-item-vertical {
        margin-bottom: 3rem;
        position: relative;
        width: 45%;
    }

    .timeline-item-vertical:nth-child(odd) {
        margin-left: 0;
        margin-right: auto;
        padding-right: 3rem;
    }

    .timeline-item-vertical:nth-child(even) {
        margin-left: auto;
        margin-right: 0;
        padding-left: 3rem;
    }

    .timeline-item-vertical::before {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background: white;
        border: 4px solid var(--accent);
        border-radius: 50%;
        top: 20px;
        box-shadow: 0 4px 15px rgba(232, 17, 45, 0.3);
    }

    .timeline-item-vertical:nth-child(odd)::before {
        right: -10px;
    }

    .timeline-item-vertical:nth-child(even)::before {
        left: -10px;
    }

    .partner-logo {
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .partner-logo:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .counter-box {
        text-align: center;
        padding: 2rem;
    }

    .counter-number {
        font-size: 3.5rem;
        font-weight: 800;
        background: var(--gradient-bg);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .timeline-vertical::before {
            left: 30px;
        }

        .timeline-item-vertical {
            width: 100%;
            padding-left: 4rem !important;
            padding-right: 1rem !important;
        }

        .timeline-item-vertical::before {
            left: 20px !important;
            right: auto !important;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="about-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="about-hero-content">
                    <h1 class="display-3 fw-bold mb-4">Notre Mission : Préserver le patrimoine béninois</h1>
                    <p class="lead mb-5" style="font-size: 1.3rem;">
                        Plateforme numérique dédiée à la documentation, valorisation et diffusion
                        de la richesse culturelle et linguistique du Bénin.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="#histoire" class="btn btn-primary-custom btn-lg">
                            <i class="bi bi-clock-history me-2"></i>Notre histoire
                        </a>
                        <a href="#equipe" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-people me-2"></i>Notre équipe
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Chiffres clés -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="counter-box">
                    <div class="counter-number">2,458</div>
                    <p class="text-muted mb-0">Contenus culturels</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="counter-box">
                    <div class="counter-number">1,247</div>
                    <p class="text-muted mb-0">Contributeurs actifs</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="counter-box">
                    <div class="counter-number">12</div>
                    <p class="text-muted mb-0">Régions couvertes</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="counter-box">
                    <div class="counter-number">50+</div>
                    <p class="text-muted mb-0">Langues documentées</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Notre Mission -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Notre Mission & Valeurs</h2>
                <p class="section-subtitle">Les principes fondamentaux qui guident notre action</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon" style="background: var(--primary);">
                        <i class="bi bi-translate"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Valorisation linguistique</h4>
                    <p class="text-muted">
                        Donner une place centrale aux langues nationales comme véhicules authentiques
                        de transmission culturelle et de préservation du patrimoine immatériel.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon" style="background: var(--secondary);">
                        <i class="bi bi-people"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Participation communautaire</h4>
                    <p class="text-muted">
                        Créer un espace collaboratif où chaque citoyen peut contribuer à enrichir
                        la mémoire collective et partager ses connaissances traditionnelles.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon" style="background: var(--accent);">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Authenticité & Fiabilité</h4>
                    <p class="text-muted">
                        Mettre en place des processus rigoureux de validation pour garantir
                        l'exactitude et la fiabilité des contenus partagés sur la plateforme.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon" style="background: var(--dark);">
                        <i class="bi bi-globe"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Accessibilité universelle</h4>
                    <p class="text-muted">
                        Rendre le patrimoine culturel béninois accessible à tous,
                        partout dans le monde, grâce aux technologies numériques modernes.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon" style="background: var(--primary);">
                        <i class="bi bi-heart"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Transmission intergénérationnelle</h4>
                    <p class="text-muted">
                        Faciliter le dialogue entre les générations pour préserver
                        les savoirs ancestraux et les adapter au monde contemporain.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon" style="background: var(--secondary);">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Innovation numérique</h4>
                    <p class="text-muted">
                        Utiliser les technologies les plus récentes pour documenter,
                        archiver et diffuser le patrimoine culturel de manière innovante.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Notre Histoire -->
<section id="histoire" class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Notre Histoire</h2>
                <p class="section-subtitle">Le parcours qui nous a conduits à créer cette plateforme</p>
            </div>
        </div>

        <div class="timeline-vertical">
            <div class="timeline-item-vertical">
                <div class="culture-card p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle p-3 me-3">
                            <i class="bi bi-lightbulb fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">L'Idée</h4>
                            <span class="text-muted">Janvier 2023</span>
                        </div>
                    </div>
                    <p class="mb-0">
                        Constatant la dispersion et la fragilité du patrimoine culturel immatériel béninois,
                        un groupe de passionnés de culture et de technologie décide de créer une plateforme
                        numérique dédiée à sa préservation.
                    </p>
                </div>
            </div>

            <div class="timeline-item-vertical">
                <div class="culture-card p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-secondary rounded-circle p-3 me-3">
                            <i class="bi bi-people fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Premières Consultations</h4>
                            <span class="text-muted">Mars 2023</span>
                        </div>
                    </div>
                    <p class="mb-0">
                        Rencontres avec les communautés locales, les gardiens de traditions,
                        les linguistes et les historiens pour comprendre les besoins réels
                        et les enjeux de la préservation culturelle.
                    </p>
                </div>
            </div>

            <div class="timeline-item-vertical">
                <div class="culture-card p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-accent rounded-circle p-3 me-3">
                            <i class="bi bi-code-slash fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Développement</h4>
                            <span class="text-muted">Juillet 2023</span>
                        </div>
                    </div>
                    <p class="mb-0">
                        Développement de la première version de la plateforme avec une équipe
                        de développeurs béninois, en mettant l'accent sur l'interface multilingue
                        et l'expérience utilisateur.
                    </p>
                </div>
            </div>

            <div class="timeline-item-vertical">
                <div class="culture-card p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success rounded-circle p-3 me-3">
                            <i class="bi bi-rocket-takeoff fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Lancement Beta</h4>
                            <span class="text-muted">Novembre 2023</span>
                        </div>
                    </div>
                    <p class="mb-0">
                        Lancement de la version beta avec 100 contributeurs pilotes et
                        500 premiers contenus culturels validés par notre comité scientifique.
                    </p>
                </div>
            </div>

            <div class="timeline-item-vertical">
                <div class="culture-card p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning rounded-circle p-3 me-3">
                            <i class="bi bi-globe fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Lancement Public</h4>
                            <span class="text-muted">Février 2024</span>
                        </div>
                    </div>
                    <p class="mb-0">
                        Lancement public de la plateforme avec plus de 2,000 contenus culturels,
                        couvrant les 12 régions du Bénin et documentant plus de 50 langues nationales.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Notre Équipe -->
<section id="equipe" class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Notre Équipe</h2>
                <p class="section-subtitle">Des passionnés dédiés à la préservation du patrimoine béninois</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80"
                         class="team-image"
                         alt="Kofi Adjo">
                    <div class="p-4">
                        <h5 class="fw-bold mb-1">Kofi Adjo</h5>
                        <p class="text-primary mb-2">Directeur & Historien</p>
                        <p class="text-muted small mb-3">
                            Spécialiste de l'histoire du Royaume de Danxomè,
                            auteur de plusieurs ouvrages sur les traditions béninoises.
                        </p>
                        <div class="team-social">
                            <a href="#" class="social-link facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-link twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="social-link linkedin">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?auto=format&fit=crop&w=800&q=80"
                         class="team-image"
                         alt="Amina Sika">
                    <div class="p-4">
                        <h5 class="fw-bold mb-1">Amina Sika</h5>
                        <p class="text-primary mb-2">Responsable Linguistique</p>
                        <p class="text-muted small mb-3">
                            Linguiste spécialisée dans les langues goun et fon,
                            experte en documentation des langues en danger.
                        </p>
                        <div class="team-social">
                            <a href="#" class="social-link facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-link twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="social-link linkedin">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=800&q=80"
                         class="team-image"
                         alt="Sekou Touré">
                    <div class="p-4">
                        <h5 class="fw-bold mb-1">Sekou Touré</h5>
                        <p class="text-primary mb-2">Responsable Technologie</p>
                        <p class="text-muted small mb-3">
                            Développeur full-stack avec 10 ans d'expérience,
                            passionné par l'utilisation de la tech pour la culture.
                        </p>
                        <div class="team-social">
                            <a href="#" class="social-link facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-link twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="social-link linkedin">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=800&q=80"
                         class="team-image"
                         alt="Fatou Diop">
                    <div class="p-4">
                        <h5 class="fw-bold mb-1">Fatou Diop</h5>
                        <p class="text-primary mb-2">Responsable Communauté</p>
                        <p class="text-muted small mb-3">
                            Anthropologue sociale, spécialiste des communautés
                            rurales et des méthodes de collecte participative.
                        </p>
                        <div class="team-social">
                            <a href="#" class="social-link facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-link twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="social-link linkedin">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="/contribuer" class="btn btn-primary-custom px-5 py-3">
                <i class="bi bi-plus-circle me-2"></i>Rejoindre notre équipe de contributeurs
            </a>
        </div>
    </div>
</section>

<!-- Partenaires -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Nos Partenaires</h2>
                <p class="section-subtitle">Des institutions qui nous soutiennent dans notre mission</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-4 col-6">
                <div class="partner-logo">
                    <i class="bi bi-building fs-1 text-primary"></i>
                </div>
                <p class="text-center mt-3 fw-bold">Ministère de la Culture</p>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <div class="partner-logo">
                    <i class="bi bi-book fs-1 text-secondary"></i>
                </div>
                <p class="text-center mt-3 fw-bold">Université d'Abomey-Calavi</p>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <div class="partner-logo">
                    <i class="bi bi-globe fs-1 text-accent"></i>
                </div>
                <p class="text-center mt-3 fw-bold">UNESCO Bénin</p>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <div class="partner-logo">
                    <i class="bi bi-bank fs-1 text-primary"></i>
                </div>
                <p class="text-center mt-3 fw-bold">Fondation Culture Bénin</p>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <div class="partner-logo">
                    <i class="bi bi-megaphone fs-1 text-secondary"></i>
                </div>
                <p class="text-center mt-3 fw-bold">Radio Nationale</p>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <div class="partner-logo">
                    <i class="bi bi-camera-reels fs-1 text-accent"></i>
                </div>
                <p class="text-center mt-3 fw-bold">TV Bénin Culture</p>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <div class="partner-logo">
                    <i class="bi bi-archive fs-1 text-primary"></i>
                </div>
                <p class="text-center mt-3 fw-bold">Archives Nationales</p>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <div class="partner-logo">
                    <i class="bi bi-people fs-1 text-secondary"></i>
                </div>
                <p class="text-center mt-3 fw-bold">Associations Culturelles</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="cta-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <div class="cta-content">
                    <h2 class="cta-title mb-4">
                        Prêt à contribuer à cette aventure culturelle ?
                    </h2>
                    <p class="lead mb-5 opacity-90" style="font-size: 1.3rem;">
                        Rejoignez notre communauté de contributeurs et aidez-nous à préserver
                        le patrimoine culturel béninois pour les générations futures.
                    </p>
                    <div class="cta-buttons">
                        <a href="{{ route('front.inscription') }}" class="btn btn-cta-primary">
                            <i class="bi bi-person-plus me-2"></i>Devenir contributeur
                        </a>
                        <a href="{{ route('dashboard.contribuer') }}" class="btn btn-cta-outline">
                            <i class="bi bi-chat me-2"></i>Nous contacter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
