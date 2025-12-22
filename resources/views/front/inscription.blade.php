@extends('layouts.layout_front')

@section('title', 'Inscription - Bénin Culture')

@push('styles')
<style>
    /* Variables Bénin Modernes */
    :root {
        --benin-red: #E8112D;
        --benin-yellow: #FCD116;
        --benin-green: #008751;
        --benin-dark: #0A0F2D;
        --benin-light: #F8F9FA;
        --benin-gradient: linear-gradient(135deg, #E8112D 0%, #FCD116 50%, #008751 100%);
        --benin-glass: rgba(255, 255, 255, 0.95);
        --benin-shadow: 0 20px 80px rgba(10, 15, 45, 0.15);
    }

    /* Animated Background */
    .registration-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(-45deg,
            rgba(10, 15, 45, 0.95),
            rgba(26, 26, 46, 0.95),
            rgba(232, 17, 45, 0.9),
            rgba(252, 209, 22, 0.9));
        background-size: 400% 400%;
        animation: gradientShift 20s ease infinite;
        z-index: -1;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Floating Elements */
    .floating-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(40px);
        animation: floatOrb 8s ease-in-out infinite;
        opacity: 0.3;
    }

    @keyframes floatOrb {
        0%, 100% { transform: translateY(0px) scale(1); }
        50% { transform: translateY(-40px) scale(1.1); }
    }

    /* Main Container */
    .registration-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        margin-top: -80px;
        padding-top: 100px;
        position: relative;
    }

    .registration-container {
        width: 100%;
        max-width: 800px;
    }

    /* Header Card */
    .header-card {
        background: var(--benin-glass);
        backdrop-filter: blur(20px);
        border-radius: 30px 30px 0 0;
        padding: 3rem 2rem;
        text-align: center;
        box-shadow: var(--benin-shadow);
        border-bottom: 5px solid var(--benin-red);
        margin-bottom: -20px;
        position: relative;
        z-index: 2;
    }

    .welcome-icon {
        width: 100px;
        height: 100px;
        background: var(--benin-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        box-shadow: 0 15px 40px rgba(232, 17, 45, 0.3);
        animation: pulseGlow 3s infinite;
    }

    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 15px 40px rgba(232, 17, 45, 0.3); }
        50% { box-shadow: 0 15px 50px rgba(232, 17, 45, 0.5); }
    }

    .welcome-icon i {
        font-size: 3rem;
        color: white;
    }

    .welcome-title {
        font-size: 2.8rem;
        font-weight: 900;
        background: var(--benin-gradient);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .welcome-subtitle {
        color: #666;
        font-size: 1.2rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Main Form Card */
    .form-glass-card {
        background: var(--benin-glass);
        backdrop-filter: blur(20px);
        border-radius: 0 0 30px 30px;
        box-shadow: var(--benin-shadow);
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    /* Progress Steps */
    .steps-progress {
        display: flex;
        padding: 2rem 2rem 0;
        position: relative;
    }

    .step-item {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .step-connector {
        position: absolute;
        top: 20px;
        left: 50%;
        width: 100%;
        height: 4px;
        background: #e9ecef;
        transform: translateX(-50%);
        z-index: 1;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: white;
        border: 4px solid #e9ecef;
        color: #999;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.2rem;
        margin: 0 auto 1rem;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        z-index: 2;
    }

    .step-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .step-item.active .step-circle {
        background: var(--benin-gradient);
        border-color: transparent;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 10px 30px rgba(232, 17, 45, 0.3);
    }

    .step-item.completed .step-circle {
        background: var(--benin-green);
        border-color: var(--benin-green);
        color: white;
    }

    .step-item.active .step-label {
        color: var(--benin-red);
        font-weight: 800;
    }

    /* Form Content */
    .form-content {
        padding: 3rem 2rem;
        position: relative;
    }

    .step-panel {
        display: none;
        animation: slideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .step-panel.active {
        display: block;
    }

    .step-heading {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--benin-dark);
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid var(--benin-yellow);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .step-heading i {
        background: var(--benin-gradient);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        font-size: 2rem;
    }

    /* Form Elements */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .form-group {
        position: relative;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        margin-bottom: 0.75rem;
        color: var(--benin-dark);
        font-weight: 700;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: var(--benin-red);
        font-size: 1.1rem;
    }

    .input-wrapper {
        position: relative;
    }

    .form-input {
        width: 100%;
        padding: 1.2rem 1.2rem 1.2rem 3rem;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        color: #333;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--benin-red);
        box-shadow: 0 0 0 4px rgba(232, 17, 45, 0.1);
        transform: translateY(-2px);
    }

    .input-icon {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 1.2rem;
        z-index: 2;
    }

    .toggle-password {
        position: absolute;
        right: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #999;
        cursor: pointer;
        font-size: 1.2rem;
        padding: 0.5rem;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .toggle-password:hover {
        color: var(--benin-red);
        background: rgba(232, 17, 45, 0.1);
    }

    /* Password Strength */
    .password-strength {
        margin-top: 1rem;
    }

    .strength-meter {
        height: 6px;
        border-radius: 3px;
        background: #e9ecef;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .strength-bar {
        height: 100%;
        width: 0%;
        transition: all 0.5s ease;
        background: linear-gradient(90deg,
            #E8112D 0%,
            #FCD116 50%,
            #008751 100%);
    }

    .strength-text {
        font-size: 0.85rem;
        color: #666;
        font-weight: 600;
        text-align: right;
    }

    /* Avatar Upload */
    .avatar-section {
        text-align: center;
        margin: 2rem 0 3rem;
    }

    .avatar-dropzone {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        border: 3px dashed var(--benin-yellow);
        margin: 0 auto 1.5rem;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg,
            rgba(248, 249, 250, 0.9),
            rgba(233, 236, 239, 0.9));
    }

    .avatar-dropzone:hover {
        border-color: var(--benin-red);
        transform: scale(1.05);
        box-shadow: 0 15px 40px rgba(232, 17, 45, 0.2);
    }

    .avatar-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }

    .avatar-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #999;
        transition: all 0.3s ease;
    }

    .avatar-placeholder i {
        font-size: 3rem;
        margin-bottom: 0.5rem;
        color: var(--benin-red);
        opacity: 0.7;
    }

    .avatar-dropzone:hover .avatar-placeholder {
        color: var(--benin-red);
    }

    .avatar-dropzone.active .avatar-placeholder {
        display: none;
    }

    .avatar-dropzone.active .avatar-preview {
        display: block;
    }

    .avatar-hint {
        font-size: 0.9rem;
        color: #666;
    }

    /* Form Navigation */
    .form-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid #f1f3f5;
    }

    .btn-nav {
        padding: 1rem 2.5rem;
        border-radius: 15px;
        font-weight: 700;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        border: 2px solid transparent;
    }

    .btn-prev {
        background: #f8f9fa;
        color: #666;
        border-color: #e9ecef;
    }

    .btn-prev:hover {
        background: white;
        border-color: var(--benin-red);
        color: var(--benin-red);
        transform: translateX(-5px);
    }

    .btn-next {
        background: var(--benin-gradient);
        color: white;
        border-color: transparent;
    }

    .btn-next:hover {
        transform: translateX(5px);
        box-shadow: 0 15px 40px rgba(232, 17, 45, 0.3);
    }

    .btn-submit {
        background: var(--benin-green);
        color: white;
        border-color: transparent;
    }

    .btn-submit:hover {
        background: #007744;
        box-shadow: 0 15px 40px rgba(0, 135, 81, 0.3);
    }

    /* Benefits Section */
    .benefits-section {
        margin-top: 3rem;
        padding: 3rem 2rem;
        background: linear-gradient(135deg,
            rgba(248, 249, 250, 0.9),
            rgba(233, 236, 239, 0.9));
        border-radius: 20px;
        text-align: center;
    }

    .benefits-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--benin-dark);
        margin-bottom: 2rem;
        background: var(--benin-gradient);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .benefit-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .benefit-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border-color: var(--benin-yellow);
    }

    .benefit-icon {
        width: 70px;
        height: 70px;
        background: var(--benin-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 1.8rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .registration-wrapper {
            padding: 1rem;
            padding-top: 120px;
        }

        .welcome-title {
            font-size: 2rem;
        }

        .welcome-icon {
            width: 80px;
            height: 80px;
        }

        .welcome-icon i {
            font-size: 2.5rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .steps-progress {
            padding: 1.5rem 1rem 0;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .form-content {
            padding: 2rem 1.5rem;
        }

        .form-navigation {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-nav {
            width: 100%;
            justify-content: center;
        }

        .avatar-dropzone {
            width: 150px;
            height: 150px;
        }

        .benefits-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .header-card {
            padding: 2rem 1rem;
        }

        .step-heading {
            font-size: 1.5rem;
        }

        .form-input {
            padding: 1rem 1rem 1rem 2.8rem;
        }

        .input-icon {
            left: 1rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Background Elements -->
<div class="registration-bg"></div>
<div class="floating-orb" style="width: 300px; height: 300px; background: rgba(232, 17, 45, 0.3); top: 10%; left: 5%; animation-delay: 0s;"></div>
<div class="floating-orb" style="width: 200px; height: 200px; background: rgba(252, 209, 22, 0.3); top: 20%; right: 10%; animation-delay: 2s;"></div>
<div class="floating-orb" style="width: 250px; height: 250px; background: rgba(0, 135, 81, 0.3); bottom: 15%; left: 15%; animation-delay: 4s;"></div>

<!-- Main Content -->
<div class="registration-wrapper">
    <div class="container">
        <div class="registration-container">
            <!-- Header Card -->
            <div class="header-card">
                <div class="welcome-icon">
                    <i class="bi bi-globe-africa"></i>
                </div>
                <h1 class="welcome-title">Rejoignez Bénin Culture</h1>
                <p class="welcome-subtitle">
                    Devenez un acteur de la préservation du patrimoine culturel béninois.
                    Inscrivez-vous pour contribuer, échanger et découvrir.
                </p>
            </div>

            <!-- Main Form Card -->
            <div class="form-glass-card">
                <!-- Progress Steps -->
                <div class="steps-progress">
                    <div class="step-connector"></div>
                    <div class="step-item active" data-step="1">
                        <div class="step-circle">1</div>
                        <div class="step-label">Informations</div>
                    </div>
                    <div class="step-item" data-step="2">
                        <div class="step-circle">2</div>
                        <div class="step-label">Profil</div>
                    </div>
                    <div class="step-item" data-step="3">
                        <div class="step-circle">3</div>
                        <div class="step-label">Validation</div>
                    </div>
                </div>

                <!-- Registration Form -->
                <form method="POST" action="{{ route('front.inscription.post') }}" enctype="multipart/form-data" id="registrationForm" novalidate>
                    @csrf

                    <!-- Step 1: Personal Information -->
                    <div class="form-content">
                        <div class="step-panel active" id="step1">
                            <h2 class="step-heading">
                                <i class="bi bi-person-circle"></i>Informations personnelles
                            </h2>

                            <div class="form-grid">
                                <!-- Nom -->
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        <i class="bi bi-person-fill"></i>Nom *
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </span>
                                        <input type="text"
                                               id="name"
                                               name="name"
                                               class="form-input @error('name') is-invalid @enderror"
                                               placeholder="Votre nom de famille"
                                               value="{{ old('name') }}"
                                               required
                                               autocomplete="family-name">
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Prénom -->
                                <div class="form-group">
                                    <label for="prenom" class="form-label">
                                        <i class="bi bi-person"></i>Prénom *
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="bi bi-person"></i>
                                        </span>
                                        <input type="text"
                                               id="prenom"
                                               name="prenom"
                                               class="form-input @error('prenom') is-invalid @enderror"
                                               placeholder="Votre prénom"
                                               value="{{ old('prenom') }}"
                                               required
                                               autocomplete="given-name">
                                    </div>
                                    @error('prenom')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group full-width">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope-fill"></i>Adresse email *
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="bi bi-at"></i>
                                        </span>
                                        <input type="email"
                                               id="email"
                                               name="email"
                                               class="form-input @error('email') is-invalid @enderror"
                                               placeholder="votre.adresse@email.com"
                                               value="{{ old('email') }}"
                                               required
                                               autocomplete="email">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="bi bi-lock-fill"></i>Mot de passe *
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="bi bi-key"></i>
                                        </span>
                                        <input type="password"
                                               id="password"
                                               name="password"
                                               class="form-input @error('password') is-invalid @enderror"
                                               placeholder="Créez un mot de passe"
                                               required
                                               autocomplete="new-password">
                                        <button type="button" class="toggle-password" data-target="password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <div class="password-strength">
                                        <div class="strength-meter">
                                            <div class="strength-bar" id="passwordStrength"></div>
                                        </div>
                                        <div class="strength-text" id="strengthText">Force du mot de passe</div>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="bi bi-lock"></i>Confirmer le mot de passe *
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="bi bi-key-fill"></i>
                                        </span>
                                        <input type="password"
                                               id="password_confirmation"
                                               name="password_confirmation"
                                               class="form-input"
                                               placeholder="Confirmez votre mot de passe"
                                               required
                                               autocomplete="new-password">
                                        <button type="button" class="toggle-password" data-target="password_confirmation">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Profile Information -->
                        <div class="step-panel" id="step2">
                            <h2 class="step-heading">
                                <i class="bi bi-person-badge-fill"></i>Profil personnel
                            </h2>

                            <!-- Avatar Upload -->
                            <div class="avatar-section">
                                <div class="avatar-dropzone" id="avatarDropzone">
                                    <img src="" class="avatar-preview" id="avatarPreview">
                                    <div class="avatar-placeholder">
                                        <i class="bi bi-camera"></i>
                                        <span>Cliquez pour ajouter une photo</span>
                                    </div>
                                </div>
                                <input type="file"
                                       id="photo"
                                       name="photo"
                                       accept="image/*"
                                       style="display: none;">
                                <p class="avatar-hint">Taille recommandée : 500x500px • Max 2MB</p>
                                @error('photo')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-grid">
                                <!-- Genre -->
                                <div class="form-group">
                                    <label for="sexe" class="form-label">
                                        <i class="bi bi-gender-ambiguous"></i>Genre *
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="bi bi-person-check"></i>
                                        </span>
                                        <select id="sexe"
                                                name="sexe"
                                                class="form-input @error('sexe') is-invalid @enderror"
                                                required>
                                            <option value="">Sélectionnez votre genre</option>
                                            <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Homme</option>
                                            <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Femme</option>
                                        </select>
                                    </div>
                                    @error('sexe')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Date de naissance -->
                                <div class="form-group">
                                    <label for="date_naissance" class="form-label">
                                        <i class="bi bi-calendar3"></i>Date de naissance *
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="bi bi-calendar-date"></i>
                                        </span>
                                        <input type="date"
                                               id="date_naissance"
                                               name="date_naissance"
                                               class="form-input @error('date_naissance') is-invalid @enderror"
                                               value="{{ old('date_naissance') }}"
                                               required>
                                    </div>
                                    @error('date_naissance')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Langue -->
                                <div class="form-group full-width">
                                    <label for="id_langue" class="form-label">
                                        <i class="bi bi-translate"></i>Langue principale
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="bi bi-chat-left-text"></i>
                                        </span>
                                        <select id="id_langue"
                                                name="id_langue"
                                                class="form-input">
                                            <option value="">Sélectionnez votre langue préférée</option>
                                            @foreach($langues as $langue)
                                                <option value="{{ $langue->id_langue }}" {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                                                    {{ $langue->nom_langue }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Validation -->
                        <div class="step-panel" id="step3">
                            <h2 class="step-heading">
                                <i class="bi bi-check-circle-fill"></i>Validation
                            </h2>

                            <!-- Information Summary -->
                            <div class="form-grid">
                                <div class="form-group full-width">
                                    <div class="alert alert-info bg-gradient">
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-info-circle-fill fs-4 me-3 text-primary"></i>
                                            <div>
                                                <h5 class="alert-heading mb-2">Dernière étape !</h5>
                                                <p class="mb-2">
                                                    Votre compte sera créé avec le statut de <strong>Contributeur</strong>.
                                                    Vous pourrez soumettre des contenus qui seront vérifiés par notre équipe.
                                                </p>
                                                <p class="mb-0">
                                                    Après l'inscription, vous recevrez un email de confirmation.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms -->
                            <div class="form-group full-width">
                                <div class="form-check p-3 border rounded-3">
                                    <input type="checkbox"
                                           id="terms"
                                           name="terms"
                                           class="form-check-input @error('terms') is-invalid @enderror"
                                           {{ old('terms') ? 'checked' : '' }}
                                           required>
                                    <label for="terms" class="form-check-label ms-2">
                                        Je certifie avoir lu et accepté les
                                        <a href="#" class="text-primary text-decoration-none fw-bold">conditions d'utilisation</a>
                                        et la
                                        <a href="#" class="text-primary text-decoration-none fw-bold">politique de confidentialité</a> *
                                    </label>
                                    @error('terms')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Newsletter -->
                            <div class="form-group full-width">
                                <div class="form-check">
                                    <input type="checkbox"
                                           id="newsletter"
                                           name="newsletter"
                                           value="1"
                                           class="form-check-input"
                                           {{ old('newsletter') ? 'checked' : '' }}>
                                    <label for="newsletter" class="form-check-label">
                                        Je souhaite m'abonner à la newsletter culturelle
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="form-navigation">
                            <button type="button" class="btn-nav btn-prev" id="prevBtn" disabled>
                                <i class="bi bi-arrow-left"></i>Précédent
                            </button>
                            <button type="button" class="btn-nav btn-next" id="nextBtn">
                                Suivant <i class="bi bi-arrow-right"></i>
                            </button>
                            <button type="submit" class="btn-nav btn-submit" id="submitBtn" style="display: none;">
                                <i class="bi bi-check-circle"></i>Terminer l'inscription
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Benefits Section -->
            <div class="benefits-section">
                <h3 class="benefits-title">Avantages de l'inscription</h3>
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Sauvegardez vos favoris</h5>
                        <p class="text-muted mb-0">
                            Gardez une trace des contenus culturels qui vous intéressent
                        </p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Communauté active</h5>
                        <p class="text-muted mb-0">
                            Échangez avec des passionnés de culture béninoise
                        </p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-plus-circle"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Contribuez librement</h5>
                        <p class="text-muted mb-0">
                            Partagez vos connaissances et enrichissez la base
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// State management
const registrationState = {
    currentStep: 1,
    totalSteps: 3,
    formData: {
        step1: {},
        step2: {},
        step3: {}
    }
};

// DOM Elements
const stepPanels = document.querySelectorAll('.step-panel');
const stepIndicators = document.querySelectorAll('.step-item');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const submitBtn = document.getElementById('submitBtn');
const registrationForm = document.getElementById('registrationForm');

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    console.log('Registration form initialized');

    // Setup event listeners
    setupEventListeners();
    initializePasswordStrength();
    initializeAvatarUpload();

    // Check if there are validation errors
    checkValidationErrors();
});

function setupEventListeners() {
    // Next button
    nextBtn.addEventListener('click', function() {
        if (validateCurrentStep()) {
            goToStep(registrationState.currentStep + 1);
        }
    });

    // Previous button
    prevBtn.addEventListener('click', function() {
        goToStep(registrationState.currentStep - 1);
    });

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.dataset.target;
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });

    // Form submission
    registrationForm.addEventListener('submit', function(e) {
        if (!validateAllSteps()) {
            e.preventDefault();
            return;
        }

        // Show loading state
        showLoadingState();
    });
}

function checkValidationErrors() {
    // Check for Laravel validation errors
    const errors = {!! $errors->any() ? json_encode($errors->all()) : '{}' !!};
    if (Object.keys(errors).length > 0) {
        // Determine which step has errors
        if (errors.includes('name') || errors.includes('prenom') || errors.includes('email') || errors.includes('password')) {
            goToStep(1);
        } else if (errors.includes('sexe') || errors.includes('date_naissance')) {
            goToStep(2);
        } else if (errors.includes('terms')) {
            goToStep(3);
        }
    }
}

function goToStep(step) {
    if (step < 1 || step > registrationState.totalSteps) return;

    // Save current step data
    saveCurrentStepData();

    // Update step indicators
    stepIndicators.forEach((indicator, index) => {
        indicator.classList.remove('active', 'completed');
        if (index + 1 < step) {
            indicator.classList.add('completed');
        } else if (index + 1 === step) {
            indicator.classList.add('active');
        }
    });

    // Update step panels
    stepPanels.forEach(panel => {
        panel.classList.remove('active');
    });
    document.getElementById(`step${step}`).classList.add('active');

    // Update navigation buttons
    prevBtn.disabled = step === 1;

    if (step === registrationState.totalSteps) {
        nextBtn.style.display = 'none';
        submitBtn.style.display = 'flex';
    } else {
        nextBtn.style.display = 'flex';
        submitBtn.style.display = 'none';
    }

    // Update state
    registrationState.currentStep = step;

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function saveCurrentStepData() {
    const currentStepId = `step${registrationState.currentStep}`;
    const formData = registrationState.formData[currentStepId] = {};

    // Get all inputs in current step
    const inputs = document.querySelectorAll(`#${currentStepId} input, #${currentStepId} select, #${currentStepId} textarea`);
    inputs.forEach(input => {
        formData[input.name] = input.value;
    });
}

function validateCurrentStep() {
    const stepId = `step${registrationState.currentStep}`;
    let isValid = true;

    // Get all required inputs in current step
    const requiredInputs = document.querySelectorAll(`#${stepId} [required]`);
    requiredInputs.forEach(input => {
        if (!input.value.trim()) {
            showInputError(input, 'Ce champ est obligatoire');
            isValid = false;
        } else {
            clearInputError(input);
        }
    });

    // Step-specific validation
    switch(registrationState.currentStep) {
        case 1:
            isValid = validateStep1() && isValid;
            break;
        case 2:
            isValid = validateStep2() && isValid;
            break;
        case 3:
            isValid = validateStep3() && isValid;
            break;
    }

    if (!isValid) {
        showNotification('Veuillez corriger les erreurs dans le formulaire', 'error');
    }

    return isValid;
}

function validateStep1() {
    let isValid = true;

    // Email validation
    const emailInput = document.getElementById('email');
    if (emailInput.value && !isValidEmail(emailInput.value)) {
        showInputError(emailInput, 'Veuillez entrer une adresse email valide');
        isValid = false;
    }

    // Password validation
    const passwordInput = document.getElementById('password');
    if (passwordInput.value && passwordInput.value.length < 8) {
        showInputError(passwordInput, 'Le mot de passe doit contenir au moins 8 caractères');
        isValid = false;
    }

    // Password confirmation
    const confirmInput = document.getElementById('password_confirmation');
    if (passwordInput.value && confirmInput.value && passwordInput.value !== confirmInput.value) {
        showInputError(confirmInput, 'Les mots de passe ne correspondent pas');
        isValid = false;
    }

    return isValid;
}

function validateStep2() {
    let isValid = true;

    // Date of birth validation
    const dobInput = document.getElementById('date_naissance');
    if (dobInput.value) {
        const dob = new Date(dobInput.value);
        const today = new Date();
        const minDate = new Date(today.getFullYear() - 120, today.getMonth(), today.getDate());
        const maxDate = new Date(today.getFullYear() - 13, today.getMonth(), today.getDate());

        if (dob < minDate) {
            showInputError(dobInput, 'Vous devez avoir moins de 120 ans');
            isValid = false;
        } else if (dob > maxDate) {
            showInputError(dobInput, 'Vous devez avoir au moins 13 ans');
            isValid = false;
        }
    }

    return isValid;
}

function validateStep3() {
    // Only terms acceptance is required
    return true;
}

function validateAllSteps() {
    let allValid = true;

    for (let i = 1; i <= registrationState.totalSteps; i++) {
        const tempStep = registrationState.currentStep;
        registrationState.currentStep = i;
        if (!validateCurrentStep()) {
            allValid = false;
            goToStep(i); // Go to step with error
            break;
        }
        registrationState.currentStep = tempStep;
    }

    if (!allValid) {
        showNotification('Veuillez compléter toutes les étapes du formulaire', 'error');
    }

    return allValid;
}

// Helper functions
function showInputError(input, message) {
    clearInputError(input);

    input.classList.add('is-invalid');

    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback mt-2';
    errorDiv.innerHTML = `<i class="bi bi-exclamation-circle me-1"></i>${message}`;

    input.parentNode.appendChild(errorDiv);
}

function clearInputError(input) {
    input.classList.remove('is-invalid');
    const errorDiv = input.parentNode.querySelector('.invalid-feedback');
    if (errorDiv) {
        errorDiv.remove();
    }
}

function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.form-notification');
    existingNotifications.forEach(notification => notification.remove());

    // Create notification
    const notification = document.createElement('div');
    notification.className = `form-notification alert alert-${type} alert-dismissible fade show`;
    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="bi bi-${type === 'error' ? 'exclamation-triangle' : 'info-circle'}-fill me-3 fs-5"></i>
            <div>${message}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    // Add to form
    const formContent = document.querySelector('.form-content');
    if (formContent) {
        formContent.prepend(notification);
    }
}

// Password strength meter
function initializePasswordStrength() {
    const passwordInput = document.getElementById('password');
    if (!passwordInput) return;

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strengthBar = document.getElementById('passwordStrength');
        const strengthText = document.getElementById('strengthText');

        let strength = 0;
        let text = 'Très faible';

        // Length check
        if (password.length >= 8) strength += 20;
        if (password.length >= 12) strength += 20;

        // Complexity checks
        if (/[a-z]/.test(password)) strength += 15;
        if (/[A-Z]/.test(password)) strength += 15;
        if (/[0-9]/.test(password)) strength += 15;
        if (/[^A-Za-z0-9]/.test(password)) strength += 15;

        // Determine strength level
        if (strength >= 75) {
            text = 'Très fort';
            strengthBar.style.background = 'linear-gradient(90deg, #008751 0%, #00B894 100%)';
        } else if (strength >= 50) {
            text = 'Fort';
            strengthBar.style.background = 'linear-gradient(90deg, #FCD116 0%, #FFD700 100%)';
        } else if (strength >= 25) {
            text = 'Moyen';
            strengthBar.style.background = 'linear-gradient(90deg, #E8112D 0%, #FF3366 100%)';
        } else {
            text = 'Faible';
            strengthBar.style.background = '#E8112D';
        }

        strengthBar.style.width = `${strength}%`;
        strengthText.textContent = text;
    });
}

// Avatar upload
function initializeAvatarUpload() {
    const dropzone = document.getElementById('avatarDropzone');
    const fileInput = document.getElementById('photo');
    const preview = document.getElementById('avatarPreview');

    if (!dropzone || !fileInput || !preview) return;

    // Click to upload
    dropzone.addEventListener('click', function() {
        fileInput.click();
    });

    // File selection
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        // Validate file
        if (!file.type.match('image.*')) {
            showNotification('Veuillez sélectionner une image', 'error');
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            showNotification('L\'image est trop grande (max 2MB)', 'error');
            return;
        }

        // Preview image
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            dropzone.classList.add('active');
        };
        reader.readAsDataURL(file);
    });

    // Drag and drop
    dropzone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropzone.style.borderColor = 'var(--benin-red)';
        dropzone.style.transform = 'scale(1.05)';
    });

    dropzone.addEventListener('dragleave', function() {
        dropzone.style.borderColor = '';
        dropzone.style.transform = '';
    });

    dropzone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropzone.style.borderColor = '';
        dropzone.style.transform = '';

        const file = e.dataTransfer.files[0];
        if (file) {
            fileInput.files = e.dataTransfer.files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });
}

// Loading state for form submission
function showLoadingState() {
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Inscription en cours...';

    // Add spinner to form
    const spinner = document.createElement('div');
    spinner.className = 'form-spinner';
    spinner.innerHTML = `
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Chargement...</span>
        </div>
    `;

    const formContent = document.querySelector('.form-content');
    if (formContent) {
        formContent.appendChild(spinner);
    }
}

// Add CSS for spinner
const style = document.createElement('style');
style.textContent = `
    .form-spinner {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        border-radius: 30px;
    }

    .form-notification {
        margin-bottom: 2rem;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);

// Auto-focus first input in current step
document.addEventListener('stepChanged', function(e) {
    const stepId = `step${e.detail.step}`;
    const firstInput = document.querySelector(`#${stepId} input, #${stepId} select, #${stepId} textarea`);
    if (firstInput) {
        firstInput.focus();
    }
});

// Dispatch custom event when step changes
function dispatchStepChangeEvent(step) {
    const event = new CustomEvent('stepChanged', { detail: { step } });
    document.dispatchEvent(event);
}

// Update goToStep function to dispatch event
const originalGoToStep = goToStep;
goToStep = function(step) {
    originalGoToStep(step);
    dispatchStepChangeEvent(step);
};
</script>
@endpush
