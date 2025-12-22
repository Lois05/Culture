{{-- resources/views/admin/settings/index.blade.php --}}
@extends('layouts.layout')

@section('page-title', 'Paramètres du Système')

@section('content')
<main class="app-main min-vh-100">
    <div class="container-fluid mt-4">
        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-6 fw-bold text-primary">
                    <i class="bi bi-gear me-2"></i> Paramètres du Système
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.tableaudebord') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Paramètres</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-primary" id="refreshConfig">
                    <i class="bi bi-arrow-clockwise me-2"></i> Actualiser la config
                </button>
            </div>
        </div>

        <!-- Alertes -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Navigation par onglets -->
        <div class="card shadow-lg border-0 rounded-3 mb-4">
            <div class="card-header bg-white border-bottom p-0">
                <ul class="nav nav-tabs" id="settingsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="general-tab" data-bs-toggle="tab"
                                data-bs-target="#general" type="button" role="tab">
                            <i class="bi bi-sliders me-2"></i> Général
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="email-tab" data-bs-toggle="tab"
                                data-bs-target="#email" type="button" role="tab">
                            <i class="bi bi-envelope me-2"></i> Email
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="security-tab" data-bs-toggle="tab"
                                data-bs-target="#security" type="button" role="tab">
                            <i class="bi bi-shield-check me-2"></i> Sécurité
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="maintenance-tab" data-bs-toggle="tab"
                                data-bs-target="#maintenance" type="button" role="tab">
                            <i class="bi bi-tools me-2"></i> Maintenance
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="settingsTabContent">

                    <!-- Onglet Général -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <form action="{{ route('admin.settings.general.update') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="app_name" class="form-label fw-semibold">
                                        Nom de l'application *
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           id="app_name"
                                           name="app_name"
                                           value="{{ old('app_name', $settings['app_name']) }}"
                                           required>
                                    <div class="form-text">
                                        Le nom qui apparaîtra dans le titre et les emails.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="app_url" class="form-label fw-semibold">
                                        URL de l'application *
                                    </label>
                                    <input type="url"
                                           class="form-control"
                                           id="app_url"
                                           name="app_url"
                                           value="{{ old('app_url', $settings['app_url']) }}"
                                           required>
                                    <div class="form-text">
                                        L'URL complète de votre application.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="app_timezone" class="form-label fw-semibold">
                                        Fuseau horaire *
                                    </label>
                                    <select class="form-select" id="app_timezone" name="app_timezone" required>
                                        @foreach($timezones as $timezone)
                                            <option value="{{ $timezone }}"
                                                    {{ old('app_timezone', $settings['app_timezone']) == $timezone ? 'selected' : '' }}>
                                                {{ $timezone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="app_locale" class="form-label fw-semibold">
                                        Langue par défaut *
                                    </label>
                                    <select class="form-select" id="app_locale" name="app_locale" required>
                                        @foreach($languages as $code => $name)
                                            <option value="{{ $code }}"
                                                    {{ old('app_locale', $settings['app_locale']) == $code ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end pt-3 border-top">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i> Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Onglet Email -->
                    <div class="tab-pane fade" id="email" role="tabpanel">
                        <form action="{{ route('admin.settings.email.update') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="mail_mailer" class="form-label fw-semibold">Type d'envoi *</label>
                                    <select class="form-select" id="mail_mailer" name="mail_mailer" required>
                                        <option value="smtp" {{ old('mail_mailer', $settings['mail_mailer']) == 'smtp' ? 'selected' : '' }}>SMTP</option>
                                        <option value="sendmail" {{ old('mail_mailer', $settings['mail_mailer']) == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                                        <option value="mailgun" {{ old('mail_mailer', $settings['mail_mailer']) == 'mailgun' ? 'selected' : '' }}>Mailgun</option>
                                        <option value="ses" {{ old('mail_mailer', $settings['mail_mailer']) == 'ses' ? 'selected' : '' }}>Amazon SES</option>
                                        <option value="postmark" {{ old('mail_mailer', $settings['mail_mailer']) == 'postmark' ? 'selected' : '' }}>Postmark</option>
                                        <option value="log" {{ old('mail_mailer', $settings['mail_mailer']) == 'log' ? 'selected' : '' }}>Log (test)</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="mail_host" class="form-label fw-semibold">Serveur SMTP *</label>
                                    <input type="text"
                                           class="form-control"
                                           id="mail_host"
                                           name="mail_host"
                                           value="{{ old('mail_host', $settings['mail_host']) }}"
                                           required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="mail_port" class="form-label fw-semibold">Port *</label>
                                    <input type="number"
                                           class="form-control"
                                           id="mail_port"
                                           name="mail_port"
                                           value="{{ old('mail_port', $settings['mail_port']) }}"
                                           required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="mail_username" class="form-label fw-semibold">Nom d'utilisateur</label>
                                    <input type="text"
                                           class="form-control"
                                           id="mail_username"
                                           name="mail_username"
                                           value="{{ old('mail_username', $settings['mail_username']) }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="mail_password" class="form-label fw-semibold">Mot de passe</label>
                                    <input type="password"
                                           class="form-control"
                                           id="mail_password"
                                           name="mail_password">
                                    <div class="form-text">
                                        Laisser vide pour ne pas modifier.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="mail_encryption" class="form-label fw-semibold">Chiffrement</label>
                                    <select class="form-select" id="mail_encryption" name="mail_encryption">
                                        <option value="">Aucun</option>
                                        <option value="tls" {{ old('mail_encryption', $settings['mail_encryption']) == 'tls' ? 'selected' : '' }}>TLS</option>
                                        <option value="ssl" {{ old('mail_encryption', $settings['mail_encryption']) == 'ssl' ? 'selected' : '' }}>SSL</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="mail_from_address" class="form-label fw-semibold">Email expéditeur *</label>
                                    <input type="email"
                                           class="form-control"
                                           id="mail_from_address"
                                           name="mail_from_address"
                                           value="{{ old('mail_from_address', config('mail.from.address')) }}"
                                           required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="mail_from_name" class="form-label fw-semibold">Nom expéditeur *</label>
                                    <input type="text"
                                           class="form-control"
                                           id="mail_from_name"
                                           name="mail_from_name"
                                           value="{{ old('mail_from_name', config('mail.from.name')) }}"
                                           required>
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Testez vos paramètres SMTP après modification pour vérifier qu'ils fonctionnent.
                            </div>

                            <div class="d-flex justify-content-end pt-3 border-top">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i> Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Onglet Sécurité -->
                    <div class="tab-pane fade" id="security" role="tabpanel">
                        <form action="{{ route('admin.settings.security.update') }}" method="POST">
                            @csrf

                            <h6 class="fw-bold text-primary mb-3">Authentification</h6>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="session_lifetime" class="form-label fw-semibold">
                                        Durée de session (minutes) *
                                    </label>
                                    <input type="number"
                                           class="form-control"
                                           id="session_lifetime"
                                           name="session_lifetime"
                                           value="{{ old('session_lifetime', $settings['session_lifetime']) }}"
                                           min="1" max="525600" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="password_min_length" class="form-label fw-semibold">
                                        Longueur min. mot de passe *
                                    </label>
                                    <input type="number"
                                           class="form-control"
                                           id="password_min_length"
                                           name="password_min_length"
                                           value="{{ old('password_min_length', $settings['password_min_length']) }}"
                                           min="6" max="32" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Exigences mot de passe</label>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               id="password_requires_uppercase"
                                               name="password_requires_uppercase"
                                               value="1"
                                               {{ old('password_requires_uppercase', $settings['password_requires_uppercase']) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="password_requires_uppercase">
                                            Requiert majuscule
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               id="password_requires_numbers"
                                               name="password_requires_numbers"
                                               value="1"
                                               {{ old('password_requires_numbers', $settings['password_requires_numbers']) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="password_requires_numbers">
                                            Requiert chiffres
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               id="password_requires_special"
                                               name="password_requires_special"
                                               value="1"
                                               {{ old('password_requires_special', $settings['password_requires_special']) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="password_requires_special">
                                            Requiert caractères spéciaux
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold text-primary mb-3 mt-4">Fonctionnalités</h6>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               role="switch"
                                               id="enable_2fa"
                                               name="enable_2fa"
                                               value="1"
                                               {{ old('enable_2fa', config('auth.2fa_enabled', true)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_2fa">
                                            Authentification à 2 facteurs
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               role="switch"
                                               id="enable_registration"
                                               name="enable_registration"
                                               value="1"
                                               {{ old('enable_registration', config('auth.registration_enabled', true)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_registration">
                                            Inscription publique
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               role="switch"
                                               id="debug_mode"
                                               name="debug_mode"
                                               value="1"
                                               {{ old('debug_mode', $settings['debug_mode']) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="debug_mode">
                                            Mode debug
                                        </label>
                                    </div>
                                    <div class="form-text text-danger">
                                        Désactiver en production
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end pt-3 border-top">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i> Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Onglet Maintenance -->
                    <div class="tab-pane fade" id="maintenance" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card border-warning">
                                    <div class="card-header bg-warning text-white">
                                        <h6 class="mb-0">
                                            <i class="bi bi-tools me-2"></i> Maintenance
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        @if($settings['maintenance_mode'])
                                            <div class="alert alert-danger">
                                                <i class="bi bi-exclamation-triangle me-2"></i>
                                                Le mode maintenance est actif. Les utilisateurs ne peuvent pas accéder au site.
                                            </div>
                                            <a href="{{ route('admin.maintenance.disable') }}" class="btn btn-success">
                                                <i class="bi bi-power me-2"></i> Désactiver le mode maintenance
                                            </a>
                                        @else
                                            <p class="mb-3">Activez le mode maintenance pour effectuer des opérations sur le site.</p>
                                            <a href="{{ route('admin.maintenance.enable') }}" class="btn btn-warning">
                                                <i class="bi bi-power me-2"></i> Activer le mode maintenance
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <h6 class="mb-0">
                                            <i class="bi bi-hdd me-2"></i> Cache
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-3">Videz les caches pour forcer le rechargement des données.</p>
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('admin.cache.clear') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-info">
                                                    <i class="bi bi-arrow-clockwise me-2"></i> Vider le cache
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.cache.config') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary">
                                                    <i class="bi bi-gear me-2"></i> Cache config
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informations système -->
                        <div class="card border-secondary">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0">
                                    <i class="bi bi-info-circle me-2"></i> Informations système
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <small class="text-muted">PHP Version</small>
                                        <h6>{{ phpversion() }}</h6>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <small class="text-muted">Laravel Version</small>
                                        <h6>{{ app()->version() }}</h6>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <small class="text-muted">Environment</small>
                                        <h6>{{ app()->environment() }}</h6>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <small class="text-muted">Timezone</small>
                                        <h6>{{ config('app.timezone') }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Actualiser la configuration
    $('#refreshConfig').on('click', function() {
        $(this).find('i').addClass('fa-spin');

        $.ajax({
            url: '{{ route("admin.cache.config") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                location.reload();
            },
            error: function() {
                $(this).find('i').removeClass('fa-spin');
                alert('Erreur lors de l\'actualisation');
            }
        });
    });

    // Gestion des onglets
    const hash = window.location.hash;
    if (hash) {
        const tab = new bootstrap.Tab(document.querySelector(hash + '-tab'));
        tab.show();
    }

    // Auto-sélection du fuseau horaire local
    if (!localStorage.getItem('timezoneSet')) {
        const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        if (userTimezone) {
            $('#app_timezone').val(userTimezone);
            localStorage.setItem('timezoneSet', 'true');
        }
    }

    // Validation des ports
    $('#mail_port').on('change', function() {
        const port = $(this).val();
        if (port < 1 || port > 65535) {
            alert('Le port doit être entre 1 et 65535');
            $(this).val('587');
        }
    });

    // Toggle SMTP settings
    $('#mail_mailer').on('change', function() {
        const mailer = $(this).val();
        const smtpFields = ['mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption'];

        if (mailer === 'smtp') {
            smtpFields.forEach(field => $('#' + field).prop('disabled', false));
        } else {
            smtpFields.forEach(field => $('#' + field).prop('disabled', true));
        }
    });
});
</script>

<style>
.nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 500;
    padding: 1rem 1.5rem;
}

.nav-tabs .nav-link.active {
    color: #4e73df;
    background: transparent;
    border-bottom: 3px solid #4e73df;
}

.form-check-input:checked {
    background-color: #4e73df;
    border-color: #4e73df;
}

.form-switch .form-check-input:checked {
    background-color: #4e73df;
    border-color: #4e73df;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.fa-spin {
    animation: fa-spin 1s infinite linear;
}

@keyframes fa-spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Style pour les alertes */
.alert {
    border: none;
    border-left: 4px solid;
}
</style>
@endsection
