{{-- resources/views/front/boutique/choisir.blade.php --}}
@extends('layouts.layout_front')

@section('title', 'Confirmer votre choix')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- En-tête -->
            <div class="text-center mb-5">
                <h1 class="display-6 fw-bold text-primary mb-3">
                    <i class="bi bi-check-circle me-2"></i>Confirmez votre choix
                </h1>
                <p class="text-muted">
                    Sélectionnez l'abonnement qui correspond le mieux à vos besoins
                </p>
            </div>

            <!-- Messages d'erreur/success -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Formulaire de choix -->
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-4">
                    <h4 class="mb-0">
                        <i class="bi bi-credit-card me-2"></i>
                        Sélectionnez votre abonnement
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('paiement.process-choix') }}" method="POST" id="choixForm">
                        @csrf

                        <div class="row g-4">
                            @forelse($abonnements as $abonnement)
                                @php
                                    $colors = [
                                        'Basic' => 'primary',
                                        'Pro' => 'success',
                                        'Premium' => 'warning',
                                        'VIP' => 'danger',
                                    ];
                                    $color = $colors[$abonnement->nom] ?? 'info';
                                @endphp

                                <div class="col-md-6">
                                    <input type="radio"
                                           name="id_abonnement"
                                           id="abonnement_{{ $abonnement->id }}"
                                           value="{{ $abonnement->id }}"
                                           class="d-none"
                                           {{ $loop->first ? 'checked' : '' }}>

                                    <label for="abonnement_{{ $abonnement->id }}"
                                           class="card-choice h-100 cursor-pointer">
                                        <div class="card h-100 border-3 border-transparent transition-all">
                                            <!-- Badge Recommandé -->
                                            @if($abonnement->recommandé ?? false)
                                                <div class="position-absolute top-0 end-0 m-3">
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-star-fill me-1"></i> Recommandé
                                                    </span>
                                                </div>
                                            @endif

                                            <!-- Header -->
                                            <div class="card-header bg-{{ $color }} bg-opacity-10 border-0 py-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0 text-{{ $color }} fw-bold">
                                                        {{ $abonnement->nom }}
                                                    </h5>
                                                    <i class="bi bi-check-circle-fill text-{{ $color }} fs-4"></i>
                                                </div>
                                            </div>

                                            <!-- Body -->
                                            <div class="card-body">
                                                <!-- Prix -->
                                                <div class="text-center mb-3">
                                                    <h2 class="text-dark fw-bold">
                                                        {{ number_format($abonnement->prix, 0) }} €
                                                    </h2>
                                                    <small class="text-muted">
                                                        pour {{ $abonnement->duree_jours }} jours
                                                    </small>
                                                </div>

                                                <!-- Avantages -->
                                                @if($abonnement->description)
                                                    <div class="mb-3">
                                                        @php
                                                            $avantages = array_slice(explode('|', $abonnement->description), 0, 3);
                                                        @endphp
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach($avantages as $avantage)
                                                                @if(trim($avantage))
                                                                    <li class="mb-1">
                                                                        <i class="bi bi-check text-{{ $color }} me-2"></i>
                                                                        <small>{{ trim($avantage) }}</small>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning text-center py-4">
                                        <i class="bi bi-exclamation-triangle fs-1 mb-3"></i>
                                        <p class="mb-0">Aucun abonnement disponible pour le moment.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                            <a href="{{ route('boutique.index') }}"
                               class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-arrow-left me-2"></i> Retour
                            </a>

                            <button type="submit"
                                    class="btn btn-primary btn-lg px-5"
                                    id="submitBtn"
                                    {{ $abonnements->isEmpty() ? 'disabled' : '' }}>
                                <i class="bi bi-arrow-right me-2"></i> Continuer vers le paiement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.card-choice input:checked + label .card {
    border-color: var(--bs-primary) !important;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
    transform: scale(1.02);
}

.cursor-pointer {
    cursor: pointer;
}

.transition-all {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('choixForm');
    const submitBtn = document.getElementById('submitBtn');

    // Gestion de la soumission
    if (form) {
        form.addEventListener('submit', function(e) {
            const selected = document.querySelector('input[name="id_abonnement"]:checked');

            if (!selected) {
                e.preventDefault();
                alert('Veuillez sélectionner un abonnement');
                return false;
            }

            // Animation du bouton
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Traitement...';
            submitBtn.disabled = true;

            return true;
        });
    }

    // Animation sur sélection
    const radioInputs = document.querySelectorAll('input[name="id_abonnement"]');
    radioInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Retirer la sélection de toutes les cartes
            document.querySelectorAll('.card-choice .card').forEach(card => {
                card.classList.remove('border-primary');
            });

            // Ajouter la sélection à la carte choisie
            const label = document.querySelector(`label[for="${this.id}"]`);
            if (label) {
                label.querySelector('.card').classList.add('border-primary');
            }
        });
    });
});
</script>
@endsection
