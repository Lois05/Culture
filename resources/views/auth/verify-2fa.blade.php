@extends('layouts.layout_front')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Vérification en deux étapes</h4>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-shield-lock display-4 text-primary"></i>
                        <p class="mt-3">Veuillez entrer le code depuis votre application d'authentification</p>
                    </div>

                    <form method="POST" action="{{ route('2fa.verify.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="code" class="form-label">Code à 6 chiffres</label>
                            <input type="text"
                                   class="form-control form-control-lg text-center @error('code') is-invalid @enderror"
                                   id="code"
                                   name="code"
                                   required
                                   autocomplete="off"
                                   maxlength="6"
                                   pattern="[0-9]{6}"
                                   placeholder="000000"
                                   autofocus>
                            @error('code')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Vérifier et continuer
                            </button>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#backupOptions">
                                Problème avec votre code ?
                            </button>

                            <div id="backupOptions" class="collapse mt-3">
                                <div class="card card-body">
                                    <h6>Utiliser un code de secours</h6>
                                    <p class="text-muted small mb-3">
                                        Les codes de secours sont à usage unique.
                                        Après utilisation, ils seront désactivés.
                                    </p>
                                    <a href="{{ route('2fa.backup-codes') }}" class="btn btn-outline-secondary btn-sm">
                                        Voir mes codes de secours
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const codeInput = document.getElementById('code');

    // Auto-soumettre quand 6 chiffres sont entrés
    codeInput.addEventListener('input', function(e) {
        if (e.target.value.length === 6) {
            e.target.form.submit();
        }
    });

    // Permettre uniquement les chiffres
    codeInput.addEventListener('keypress', function(e) {
        if (!/[0-9]/.test(e.key)) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
