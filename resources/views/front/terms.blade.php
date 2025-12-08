@extends('layouts.layout_front')

@section('title', 'Conditions d\'utilisation - Culture Bénin')

@section('content')
<div class="section">
    <div class="container">
        <div class="section-header animate-fadeInUp">
            <h1 class="section-title">Conditions d'utilisation</h1>
        </div>

        <div class="terms-content">
            <p>Dernière mise à jour : {{ date('d/m/Y') }}</p>

            <h2>Acceptation des conditions</h2>
            <p>En accédant à ce site web, vous acceptez d'être lié par ces conditions d'utilisation.</p>

            <h2>Utilisation de la plateforme</h2>
            <p>Vous vous engagez à utiliser la plateforme CultureBénin uniquement à des fins légales et conformément à ces conditions.</p>

            <h2>Contenus utilisateur</h2>
            <p>En contribuant du contenu, vous garantissez que vous en êtes l'auteur ou que vous disposez des droits nécessaires pour le partager.</p>

            <h2>Propriété intellectuelle</h2>
            <p>Le contenu de la plateforme (logos, design, textes) est protégé par les lois sur la propriété intellectuelle.</p>

            <h2>Modifications des conditions</h2>
            <p>Nous nous réservons le droit de modifier ces conditions à tout moment. Les modifications prendront effet dès leur publication.</p>

            <h2>Contact</h2>
            <p>Pour toute question concernant ces conditions, contactez-nous à : <a href="mailto:contact@culturebenin.bj">contact@culturebenin.bj</a></p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .terms-content {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 3rem;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
    }

    .terms-content h2 {
        color: var(--benin-green);
        margin: 2rem 0 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--gray-light);
    }

    @media (max-width: 768px) {
        .terms-content {
            padding: 2rem 1rem;
        }
    }
</style>
@endpush
