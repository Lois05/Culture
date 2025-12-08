@extends('layouts.layout_front')

@section('title', 'Inscription - Bénin Culture')

@push('styles')
<style>
    /* Variables de couleur Bénin */
    :root {
        --benin-red: #E8112D;
        --benin-green: #008751;
        --benin-yellow: #FCD116;
        --benin-dark: #1A1A2E;
        --benin-light: #F8F9FA;
    }

    /* Hero Section */
    .inscription-hero {
        background: linear-gradient(135deg,
            rgba(26, 26, 46, 0.95),
            rgba(26, 26, 46, 0.85)),
            url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?auto=format&fit=crop&w=1600&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 6rem 0 3rem;
        position: relative;
        overflow: hidden;
    }

    /* Container principal */
    .registration-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-top: -40px;
        position: relative;
        z-index: 10;
    }

    /* En-tête des étapes */
    .steps-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 2rem 2rem 0;
    }

    .steps-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .steps-container::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 3px;
        background: #dee2e6;
        z-index: 1;
    }

    .step-indicator {
        position: relative;
        z-index: 2;
        text-align: center;
        flex: 1;
    }

    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: 3px solid #dee2e6;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin: 0 auto 0.5rem;
        transition: all 0.3s ease;
    }

    .step-label {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
    }

    .step-indicator.active .step-circle {
        background: var(--benin-red);
        border-color: var(--benin-red);
        color: white;
        transform: scale(1.1);
    }

    .step-indicator.completed .step-circle {
        background: var(--benin-green);
        border-color: var(--benin-green);
        color: white;
    }

    .step-indicator.active .step-label {
        color: var(--benin-red);
        font-weight: 600;
    }

    /* Barre de progression */
    .progress-container {
        padding: 0 2rem 2rem;
    }

    .progress {
        height: 8px;
        border-radius: 4px;
        background: #e9ecef;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg,
            var(--benin-red) 0%,
            var(--benin-yellow) 50%,
            var(--benin-green) 100%);
        transition: width 0.5s ease;
    }

    /* Contenu des étapes */
    .step-content {
        padding: 2rem;
        display: none;
    }

    .step-content.active {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .step-title {
        color: var(--benin-dark);
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 3px solid var(--benin-red);
    }

    /* Styles de formulaire */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--benin-dark);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .form-label i {
        margin-right: 0.5rem;
        color: var(--benin-red);
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--benin-red);
        box-shadow: 0 0 0 3px rgba(232, 17, 45, 0.1);
    }

    /* Avatar upload */
    .avatar-upload {
        text-align: center;
        margin: 2rem 0;
    }

    .avatar-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: #f8f9fa;
        margin: 0 auto 1rem;
        overflow: hidden;
        border: 4px solid white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .avatar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Boutons de navigation */
    .step-navigation {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #dee2e6;
    }

    .btn-step {
        padding: 10px 30px;
        border-radius: 10px;
        font-weight: 600;
        min-width: 120px;
        transition: all 0.3s ease;
    }

    .btn-prev {
        background: white;
        border: 2px solid #dee2e6;
        color: #6c757d;
    }

    .btn-prev:hover {
        background: #f8f9fa;
        border-color: var(--benin-red);
        color: var(--benin-red);
    }

    .btn-next {
        background: var(--benin-red);
        border: 2px solid var(--benin-red);
        color: white;
    }

    .btn-next:hover {
        background: #d10f29;
        box-shadow: 0 5px 15px rgba(232, 17, 45, 0.3);
    }

    .btn-submit {
        background: var(--benin-green);
        border: 2px solid var(--benin-green);
        color: white;
    }

    .btn-submit:hover {
        background: #007744;
        box-shadow: 0 5px 15px rgba(0, 135, 81, 0.3);
    }

    /* Password strength */
    .password-strength {
        height: 5px;
        border-radius: 2.5px;
        margin-top: 0.5rem;
        background: #e9ecef;
        overflow: hidden;
    }

    .strength-bar {
        height: 100%;
        width: 0%;
        transition: width 0.3s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .registration-container {
            margin-top: 0;
            border-radius: 0;
        }

        .steps-header {
            padding: 1rem 1rem 0;
        }

        .step-content {
            padding: 1.5rem;
        }

        .step-label {
            font-size: 0.7rem;
        }

        .step-navigation {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-step {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="inscription-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">Rejoignez la communauté Bénin Culture</h1>
                <p class="lead mb-0">
                    Inscrivez-vous pour contribuer à la préservation du patrimoine culturel béninois
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Registration Form -->
<section class="py-4">
    <div class="container">
        <div class="registration-container">
            <!-- Steps Header -->
            <div class="steps-header">
                <div class="steps-container">
                    <div class="step-indicator active" data-step="1">
                        <div class="step-circle">1</div>
                        <div class="step-label">Informations</div>
                    </div>
                    <div class="step-indicator" data-step="2">
                        <div class="step-circle">2</div>
                        <div class="step-label">Profil</div>
                    </div>
                    <div class="step-indicator" data-step="3">
                        <div class="step-circle">3</div>
                        <div class="step-label">Confirmation</div>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="progress-container">
                <div class="progress">
                    <div class="progress-bar" id="progressBar" style="width: 33%;"></div>
                </div>
            </div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('front.inscription.post') }}" enctype="multipart/form-data" id="registrationForm">
                @csrf

                <!-- Étape 1: Informations personnelles -->
                <div class="step-content active" id="step1">
                    <h3 class="step-title">
                        <i class="bi bi-person-circle me-2"></i>Informations personnelles
                    </h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="bi bi-person-fill"></i>Nom *
                                </label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Votre nom"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prenom" class="form-label">
                                    <i class="bi bi-person"></i>Prénom *
                                </label>
                                <input type="text"
                                       class="form-control @error('prenom') is-invalid @enderror"
                                       id="prenom"
                                       name="prenom"
                                       value="{{ old('prenom') }}"
                                       placeholder="Votre prénom"
                                       required>
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope-fill"></i>Adresse email *
                                </label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="exemple@email.com"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock-fill"></i>Mot de passe *
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           placeholder="Mot de passe"
                                           required>
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div class="password-strength">
                                    <div class="strength-bar" id="passwordStrength"></div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    <i class="bi bi-lock"></i>Confirmer le mot de passe *
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           placeholder="Confirmer le mot de passe"
                                           required>
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Étape 2: Profil -->
                <div class="step-content" id="step2">
                    <h3 class="step-title">
                        <i class="bi bi-person-badge-fill me-2"></i>Profil personnel
                    </h3>

                    <!-- Avatar Upload -->
                    <div class="avatar-upload">
                        <div class="avatar-preview" onclick="document.getElementById('photo').click()">
                            <img src="https://ui-avatars.com/api/?name=Utilisateur&background=667eea&color=fff"
                                 id="avatarPreview"
                                 alt="Avatar">
                        </div>
                        <input type="file"
                               id="photo"
                               name="photo"
                               accept="image/*"
                               style="display: none;"
                               onchange="previewAvatar(event)">
                        <p class="text-muted small">Cliquez pour changer la photo (optionnel)</p>
                        @error('photo')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sexe" class="form-label">
                                    <i class="bi bi-gender-ambiguous"></i>Genre *
                                </label>
                                <select class="form-select @error('sexe') is-invalid @enderror"
                                        id="sexe"
                                        name="sexe"
                                        required>
                                    <option value="">Sélectionnez votre genre</option>
                                    <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Masculin</option>
                                    <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Féminin</option>
                                </select>
                                @error('sexe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_naissance" class="form-label">
                                    <i class="bi bi-calendar3"></i>Date de naissance *
                                </label>
                                <input type="date"
                                       class="form-control @error('date_naissance') is-invalid @enderror"
                                       id="date_naissance"
                                       name="date_naissance"
                                       value="{{ old('date_naissance') }}"
                                       required>
                                @error('date_naissance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="id_langue" class="form-label">
                                    <i class="bi bi-translate"></i>Langue principale (optionnel)
                                </label>
                                <select class="form-select"
                                        id="id_langue"
                                        name="id_langue">
                                    <option value="">Sélectionnez votre langue</option>
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

                <!-- Étape 3: Confirmation -->
                <div class="step-content" id="step3">
                    <h3 class="step-title">
                        <i class="bi bi-check-circle-fill me-2"></i>Confirmation
                    </h3>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Important :</strong> Votre compte sera créé avec le statut de <strong>Contributeur</strong>.
                        Vous pourrez soumettre des contenus qui seront vérifiés par notre équipe.
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input @error('terms') is-invalid @enderror"
                                   type="checkbox"
                                   id="terms"
                                   name="terms"
                                   {{ old('terms') ? 'checked' : '' }}
                                   required>
                            <label class="form-check-label" for="terms">
                                J'accepte les <a href="#" class="text-decoration-none">conditions d'utilisation</a>
                                et la <a href="#" class="text-decoration-none">politique de confidentialité</a> *
                            </label>
                            @error('terms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="newsletter"
                                   name="newsletter"
                                   value="1"
                                   {{ old('newsletter') ? 'checked' : '' }}>
                            <label class="form-check-label" for="newsletter">
                                Je souhaite recevoir la newsletter et les actualités culturelles
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="step-navigation">
                    <button type="button" class="btn btn-step btn-prev" id="prevBtn" disabled>
                        <i class="bi bi-arrow-left me-2"></i>Précédent
                    </button>
                    <button type="button" class="btn btn-step btn-next" id="nextBtn">
                        Suivant <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                    <button type="submit" class="btn btn-step btn-submit" id="submitBtn" style="display: none;">
                        <i class="bi bi-check-circle me-2"></i>S'inscrire
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Variables globales
let currentStep = 1;
const totalSteps = 3;

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    console.log('Registration form initialized');

    // Bouton Suivant
    document.getElementById('nextBtn').addEventListener('click', function() {
        if (validateCurrentStep()) {
            goToStep(currentStep + 1);
        }
    });

    // Bouton Précédent
    document.getElementById('prevBtn').addEventListener('click', function() {
        goToStep(currentStep - 1);
    });

    // Validation du mot de passe en temps réel
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('input', updatePasswordStrength);
    }
});

// Aller à une étape spécifique
function goToStep(step) {
    if (step < 1 || step > totalSteps) return;

    // Masquer toutes les étapes
    document.querySelectorAll('.step-content').forEach(div => {
        div.classList.remove('active');
    });

    // Désactiver tous les indicateurs
    document.querySelectorAll('.step-indicator').forEach(indicator => {
        indicator.classList.remove('active', 'completed');
    });

    // Mettre à jour l'étape courante
    currentStep = step;

    // Afficher l'étape courante
    const currentStepContent = document.getElementById('step' + step);
    if (currentStepContent) {
        currentStepContent.classList.add('active');
    }

    // Mettre à jour les indicateurs
    for (let i = 1; i <= totalSteps; i++) {
        const indicator = document.querySelector(`.step-indicator[data-step="${i}"]`);
        if (indicator) {
            if (i < step) {
                indicator.classList.add('completed');
            } else if (i === step) {
                indicator.classList.add('active');
            }
        }
    }

    // Mettre à jour la barre de progression
    const progressPercent = ((step - 1) / (totalSteps - 1)) * 100;
    document.getElementById('progressBar').style.width = progressPercent + '%';

    // Mettre à jour les boutons
    document.getElementById('prevBtn').disabled = (step === 1);

    if (step === totalSteps) {
        document.getElementById('nextBtn').style.display = 'none';
        document.getElementById('submitBtn').style.display = 'inline-block';
    } else {
        document.getElementById('nextBtn').style.display = 'inline-block';
        document.getElementById('submitBtn').style.display = 'none';
    }

    // Faire défiler vers le haut
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Valider l'étape courante
function validateCurrentStep() {
    let isValid = true;

    switch(currentStep) {
        case 1:
            // Valider les champs de l'étape 1
            const step1Fields = ['name', 'prenom', 'email', 'password', 'password_confirmation'];
            step1Fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field && !field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else if (field) {
                    field.classList.remove('is-invalid');
                }
            });

            // Valider l'email
            const emailField = document.getElementById('email');
            if (emailField && emailField.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value)) {
                    emailField.classList.add('is-invalid');
                    isValid = false;
                }
            }

            // Valider la confirmation du mot de passe
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password_confirmation');
            if (passwordField && confirmPasswordField &&
                passwordField.value && confirmPasswordField.value &&
                passwordField.value !== confirmPasswordField.value) {
                confirmPasswordField.classList.add('is-invalid');
                isValid = false;
            }
            break;

        case 2:
            // Valider les champs de l'étape 2
            const step2Fields = ['sexe', 'date_naissance'];
            step2Fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field && !field.value) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else if (field) {
                    field.classList.remove('is-invalid');
                }
            });
            break;

        case 3:
            // Valider l'acceptation des conditions
            const termsField = document.getElementById('terms');
            if (termsField && !termsField.checked) {
                termsField.classList.add('is-invalid');
                isValid = false;
            } else if (termsField) {
                termsField.classList.remove('is-invalid');
            }
            break;
    }

    if (!isValid) {
        // Afficher un message d'erreur
        showError('Veuillez remplir tous les champs obligatoires correctement.');
    }

    return isValid;
}

// Afficher un message d'erreur
function showError(message) {
    // Supprimer les anciens messages d'erreur
    const oldErrors = document.querySelectorAll('.alert-danger');
    oldErrors.forEach(error => error.remove());

    // Créer le nouveau message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'alert alert-danger alert-dismissible fade show';
    errorDiv.innerHTML = `
        <i class="bi bi-exclamation-triangle me-2"></i>${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    // Ajouter le message au contenu de l'étape
    const currentStepContent = document.getElementById('step' + currentStep);
    if (currentStepContent) {
        currentStepContent.prepend(errorDiv);
    }
}

// Basculer la visibilité du mot de passe
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    if (!field) return;

    const button = field.nextElementSibling;
    const icon = button.querySelector('i');

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

// Prévisualiser l'avatar
function previewAvatar(event) {
    const file = event.target.files[0];
    if (!file) return;

    // Vérifier la taille (max 2MB)
    if (file.size > 2 * 1024 * 1024) {
        alert('L\'image est trop grande. Taille maximale : 2MB');
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById('avatarPreview');
        if (preview) {
            preview.src = e.target.result;
        }
    };
    reader.readAsDataURL(file);
}

// Mettre à jour la force du mot de passe
function updatePasswordStrength() {
    const password = document.getElementById('password').value;
    const strengthBar = document.getElementById('passwordStrength');
    if (!strengthBar) return;

    let strength = 0;

    // Longueur
    if (password.length >= 8) strength += 25;
    if (password.length >= 12) strength += 15;

    // Complexité
    if (/[a-z]/.test(password)) strength += 20;
    if (/[A-Z]/.test(password)) strength += 20;
    if (/[0-9]/.test(password)) strength += 20;

    // Caractères spéciaux
    if (/[^A-Za-z0-9]/.test(password)) strength += 20;

    strength = Math.min(strength, 100);
    strengthBar.style.width = strength + '%';

    // Couleur selon la force
    if (strength < 40) {
        strengthBar.style.background = '#E8112D'; // Rouge
    } else if (strength < 70) {
        strengthBar.style.background = '#FCD116'; // Jaune
    } else {
        strengthBar.style.background = '#008751'; // Vert
    }
}

// Soumission du formulaire
document.getElementById('registrationForm').addEventListener('submit', function(e) {
    // Valider toutes les étapes
    let allValid = true;
    for (let i = 1; i <= totalSteps; i++) {
        const tempStep = currentStep;
        currentStep = i;
        if (!validateCurrentStep()) {
            allValid = false;
            goToStep(i); // Aller à l'étape avec erreur
            break;
        }
        currentStep = tempStep;
    }

    if (!allValid) {
        e.preventDefault();
        return;
    }

    // Afficher l'indicateur de chargement
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Inscription en cours...';
    }
});
</script>
@endpush
