@extends('layouts.layout_front')

@section('title', 'Politique de confidentialité - Culture Bénin')

@section('content')
<div class="section">
    <div class="container">
        <div class="section-header animate-fadeInUp">
            <h1 class="section-title">Politique de confidentialité</h1>
        </div>

        <div class="privacy-content">
            <p>Dernière mise à jour : {{ date('d/m/Y') }}</p>

            <h2>Collecte des informations</h2>
            <p>Nous collectons des informations lorsque vous vous inscrivez sur notre site, vous connectez à votre compte, contribuez du contenu, ou accédez à nos services.</p>

            <h2>Utilisation des informations</h2>
            <p>Les informations que nous recueillons auprès de vous peuvent être utilisées pour :</p>
            <ul>
                <li>Personnaliser votre expérience</li>
                <li>Améliorer notre site web</li>
                <li>Améliorer le service client</li>
                <li>Vous contacter par e-mail</li>
            </ul>

            <h2>Protection des données</h2>
            <p>Nous mettons en œuvre une variété de mesures de sécurité pour préserver la sécurité de vos informations personnelles.</p>

            <h2>Contact</h2>
            <p>Pour toute question concernant cette politique de confidentialité, vous pouvez nous contacter à : <a href="mailto:contact@culturebenin.bj">contact@culturebenin.bj</a></p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .privacy-content {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 3rem;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
    }

    .privacy-content h2 {
        color: var(--benin-green);
        margin: 2rem 0 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--gray-light);
    }

    .privacy-content ul {
        padding-left: 2rem;
        margin: 1rem 0;
    }

    .privacy-content li {
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .privacy-content {
            padding: 2rem 1rem;
        }
    }
</style>
@endpush
