{{-- resources/views/front/boutique/success.blade.php --}}
@extends('layouts.layout_front')

@section('title', 'Paiement Réussi - Bénin Culture')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill display-1 text-success"></i>
                    </div>

                    <h1 class="fw-bold mb-3">Paiement réussi !</h1>
                    <p class="lead mb-4">
                        Merci pour votre achat. Votre accès premium a été activé.
                    </p>

                    @if(isset($transaction))
                    <div class="alert alert-info mb-4">
                        <h5 class="fw-bold">Détails de la transaction</h5>
                        <div class="row text-start">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Référence :</strong> {{ $transaction->reference }}</p>
                                <p class="mb-1"><strong>Montant :</strong> {{ number_format($transaction->montant, 0, ',', ' ') }} {{ $transaction->devise }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Date :</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                                <p class="mb-1"><strong>Statut :</strong> <span class="badge bg-success">Confirmé</span></p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="feature-card p-3">
                                <i class="bi bi-unlock-fill display-4 text-primary mb-3"></i>
                                <h5>Accès immédiat</h5>
                                <p class="small">Tous les contenus sont débloqués</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card p-3">
                                <i class="bi bi-download display-4 text-success mb-3"></i>
                                <h5>Téléchargements</h5>
                                <p class="small">Téléchargez les ressources</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card p-3">
                                <i class="bi bi-headset display-4 text-warning mb-3"></i>
                                <h5>Support</h5>
                                <p class="small">Notre équipe est à votre écoute</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('front.explorer') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-compass me-2"></i>
                            Explorer les contenus
                        </a>
                        <a href="{{ route('front.dashboard') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-person-circle me-2"></i>
                            Mon compte
                        </a>
                        <a href="{{ route('boutique.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-gift me-2"></i>
                            Voir d'autres offres
                        </a>
                    </div>

                    <div class="mt-5">
                        <p class="text-muted mb-2">
                            Une confirmation a été envoyée à {{ auth()->user()->email ?? 'votre adresse email' }}
                        </p>
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Pour toute question, contactez
                            <a href="mailto:support@beninculture.com">support@beninculture.com</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
