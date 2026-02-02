@extends('layouts.layout_front')

@section('title', 'Achat article')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <i class="bi bi-book text-primary display-1 mb-3"></i>
                        <h2 class="mb-3">Confirmer votre achat</h2>
                        <p class="text-muted">Accès permanent à cet article</p>
                    </div>

                    <!-- Détails de l'article -->
                    <div class="card border mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                @if($contenu->medias->count() > 0)
                                <img src="{{ asset($contenu->medias->first()->chemin) }}"
                                     class="rounded me-3"
                                     width="80"
                                     height="80"
                                     style="object-fit: cover;">
                                @endif
                                <div>
                                    <h5 class="mb-1">{{ $contenu->titre }}</h5>
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ ceil(str_word_count(strip_tags($contenu->texte)) / 200) }} min de lecture
                                    </p>
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-person-circle me-1"></i>
                                        {{ $contenu->auteur->prenom ?? 'Auteur' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Prix -->
                    <div class="text-center mb-5">
                        <div class="display-4 fw-bold text-primary mb-2">
                            {{ number_format($achat['prix'], 0, ',', ' ') }} FCFA
                        </div>
                        <p class="text-muted">Paiement unique • Accès permanent</p>
                    </div>

                    <!-- Avantages -->
                    <div class="alert alert-success mb-4">
                        <h5><i class="bi bi-check-circle me-2"></i>Avantages inclus :</h5>
                        <ul class="mb-0">
                            <li>Accès complet à l'article</li>
                            <li>Téléchargement PDF disponible</li>
                            <li>Accès permanent (même après annulation)</li>
                            <li>Support client inclus</li>
                        </ul>
                    </div>

                    <!-- Boutons -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <form action="{{ route('boutique.paiement.article.process', $contenu->id_contenu) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                                    <i class="bi bi-credit-card me-2"></i>
                                    Payer maintenant
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('front.contenu', $contenu->id_contenu) }}"
                               class="btn btn-outline-secondary btn-lg w-100 py-3">
                                <i class="bi bi-arrow-left me-2"></i>
                                Retour à l'article
                            </a>
                        </div>
                    </div>

                    <!-- Sécurité -->
                    <div class="text-center mt-5">
                        <small class="text-muted">
                            <i class="bi bi-shield-check me-1"></i>
                            Paiement 100% sécurisé • Données cryptées • Aucune information bancaire stockée
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation du bouton de paiement
    const payButton = document.querySelector('button[type="submit"]');
    if (payButton) {
        payButton.addEventListener('click', function() {
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Traitement...';
            this.disabled = true;
        });
    }
});
</script>
@endpush
