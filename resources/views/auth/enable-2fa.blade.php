@extends('layouts.layout_front')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Activer l'authentification à deux facteurs</h4>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(isset($qrCodeUrl))
                        <div class="alert alert-info">
                            <strong>Étape 1:</strong> Téléchargez Google Authenticator, Authy ou Microsoft Authenticator
                        </div>

                        <div class="text-center mb-4">
                            <div id="qrcode" class="d-inline-block p-3 bg-white border rounded"></div>
                        </div>

                        <div class="alert alert-secondary">
                            <strong>Secret manuel:</strong>
                            <code class="d-block mt-1 p-2 bg-light rounded">{{ $secret }}</code>
                            <small class="text-muted">(À utiliser si vous ne pouvez pas scanner le QR code)</small>
                        </div>

                        <hr>

                        <form method="POST" action="{{ route('2fa.activate') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="code" class="form-label">
                                    <strong>Étape 2:</strong> Entrez le code à 6 chiffres depuis l'application
                                </label>
                                <input type="text"
                                       class="form-control form-control-lg text-center @error('code') is-invalid @enderror"
                                       id="code"
                                       name="code"
                                       required
                                       autocomplete="off"
                                       maxlength="6"
                                       pattern="[0-9]{6}"
                                       placeholder="000000">
                                @error('code')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Activer l'authentification à deux facteurs
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="text-center">
                            <p class="mb-4">Sécurisez votre compte avec l'authentification à deux facteurs</p>
                            <a href="{{ route('2fa.generate') }}" class="btn btn-primary btn-lg">
                                Commencer la configuration
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($qrCodeUrl))
<!-- Librairie QR Code JS -->
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Générer le QR code
    const qrCodeUrl = '{{ $qrCodeUrl }}';
    QRCode.toCanvas(document.createElement('canvas'), qrCodeUrl, function(error, canvas) {
        if (error) {
            console.error(error);
            return;
        }

        // Ajouter le canvas au div qrcode
        const container = document.getElementById('qrcode');
        container.appendChild(canvas);

        // Style
        canvas.style.width = '200px';
        canvas.style.height = '200px';
    });

    // Auto-focus sur le champ code
    document.getElementById('code').focus();

    // Auto-soumettre quand 6 chiffres sont entrés
    document.getElementById('code').addEventListener('input', function(e) {
        if (e.target.value.length === 6) {
            e.target.form.submit();
        }
    });
});
</script>
@endif
@endsection
