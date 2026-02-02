@extends('layouts.layout_front')

@section('title', 'Connexion - Bénin Culture')

@push('styles')
<style>
    :root {
        --auth-primary: #E8112D;
        --auth-secondary: #FCD116;
        --auth-accent: #008751;
        --auth-dark: #0A0F2D;
        --auth-gradient: linear-gradient(135deg, #E8112D 0%, #FCD116 50%, #008751 100%);
        --auth-light-gradient: linear-gradient(135deg, rgba(232, 17, 45, 0.1) 0%, rgba(252, 209, 22, 0.1) 50%, rgba(0, 135, 81, 0.1) 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    /* Animated Background */
    .auth-bg-animated {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(-45deg,
            rgba(10, 15, 45, 0.9),
            rgba(26, 26, 46, 0.9),
            rgba(232, 17, 45, 0.8),
            rgba(252, 209, 22, 0.8));
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        z-index: -1;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Floating Elements */
    .floating-element {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    /* Main Container - CORRIGÉ */
    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        padding-top: 80px; /* Ajusté pour le header */
        position: relative;
        z-index: 1;
    }

    .auth-container {
        max-width: 480px;
        width: 100%;
        margin: 0 auto;
    }

    /* Glassmorphism Card - CORRIGÉ */
    .auth-glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border-radius: 30px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        margin: 0 auto; /* Centré */
    }

    .auth-glass-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 8px;
        background: var(--auth-gradient);
        z-index: 1;
    }

    /* Header Section - CORRIGÉ */
    .auth-header {
        text-align: center;
        padding: 3rem 2rem 2rem;
        position: relative;
        margin-top: 0;
    }

    .logo-orb {
        width: 80px;
        height: 80px;
        background: var(--auth-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 10px 30px rgba(232, 17, 45, 0.3);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .logo-orb i {
        font-size: 2rem;
        color: white;
    }

    .auth-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: var(--auth-gradient);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .auth-subtitle {
        color: #666;
        font-size: 1.1rem;
        max-width: 320px;
        margin: 0 auto;
    }

    /* Body Section - CORRIGÉ */
    .auth-body {
        padding: 0 2rem 2rem;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: #333;
        font-weight: 600;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .input-group-auth {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 1.1rem;
        z-index: 2;
    }

    .form-input {
        width: 100%;
        padding: 1rem 3.5rem 1rem 3rem; /* Plus d'espace à droite pour l'œil */
        border: 2px solid #e9ecef;
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--auth-primary);
        box-shadow: 0 0 0 4px rgba(232, 17, 45, 0.1);
    }

    /* Password Toggle - CORRIGÉ */
    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #999;
        cursor: pointer;
        font-size: 1.2rem;
        transition: color 0.3s ease;
        padding: 0.5rem;
        border-radius: 50%;
        z-index: 3;
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .password-toggle:hover {
        color: var(--auth-primary);
        background: rgba(232, 17, 45, 0.1);
    }

    /* Remember & Forgot */
    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        border: 2px solid #dee2e6;
        border-radius: 4px;
        cursor: pointer;
        margin: 0;
    }

    .form-check-input:checked {
        background-color: var(--auth-primary);
        border-color: var(--auth-primary);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
    }

    .form-check-label {
        cursor: pointer;
        color: #555;
        font-size: 0.9rem;
        user-select: none;
    }

    .forgot-link {
        color: var(--auth-primary);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .forgot-link:hover {
        color: var(--auth-accent);
        text-decoration: underline;
    }

    /* Submit Button */
    .btn-submit {
        width: 100%;
        padding: 1.2rem;
        background: var(--auth-gradient);
        color: white;
        border: none;
        border-radius: 15px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(232, 17, 45, 0.3);
    }

    .btn-submit:active {
        transform: translateY(-1px);
    }

    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        margin: 2.5rem 0;
        position: relative;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, #e9ecef, transparent);
    }

    .divider-text {
        padding: 0 1.5rem;
        color: #888;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: white;
    }

    /* Social Login */
    .social-login {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        padding: 1rem;
        border-radius: 15px;
        border: 2px solid #e9ecef;
        background: white;
        color: #333;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .social-btn:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-sm);
        border-color: var(--auth-primary);
    }

    .social-btn.google:hover {
        border-color: #DB4437;
        color: #DB4437;
    }

    .social-btn.facebook:hover {
        border-color: #4267B2;
        color: #4267B2;
    }

    .social-btn.twitter:hover {
        border-color: #1DA1F2;
        color: #1DA1F2;
    }

    /* Footer */
    .auth-footer {
        text-align: center;
        padding-top: 2rem;
        margin-top: 2rem;
        border-top: 1px solid #e9ecef;
    }

    .register-link {
        color: var(--auth-primary);
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
        position: relative;
        padding: 0.2rem 0;
    }

    .register-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--auth-gradient);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .register-link:hover {
        color: var(--auth-accent);
    }

    .register-link:hover::after {
        transform: scaleX(1);
    }

    /* Benefits */
    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .benefit-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        border: 1px solid #f1f3f5;
    }

    .benefit-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }

    .benefit-icon {
        width: 70px;
        height: 70px;
        background: var(--auth-light-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--auth-primary);
        font-size: 1.8rem;
    }

    /* Error Messages */
    .alert-container {
        margin-bottom: 2rem;
    }

    .alert {
        padding: 1rem 1.5rem;
        border-radius: 15px;
        border: none;
        font-size: 0.95rem;
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(232, 17, 45, 0.1), rgba(232, 17, 45, 0.05));
        border-left: 4px solid var(--auth-primary);
        color: #721c24;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(0, 135, 81, 0.1), rgba(0, 135, 81, 0.05));
        border-left: 4px solid var(--auth-accent);
        color: #155724;
    }

    /* Responsive - CORRIGÉ */
    @media (max-width: 768px) {
        .auth-wrapper {
            padding: 1rem;
            padding-top: 60px;
        }

        .auth-glass-card {
            border-radius: 25px;
            margin: 0;
            width: 100%;
            max-width: 100%;
        }

        .auth-header {
            padding: 2rem 1.5rem 1.5rem;
        }

        .auth-body {
            padding: 0 1.5rem 1.5rem;
        }

        .auth-title {
            font-size: 2rem;
        }

        .social-login {
            grid-template-columns: 1fr;
        }

        .benefits-grid {
            grid-template-columns: 1fr;
            margin-top: 2rem;
        }
    }

    @media (max-width: 576px) {
        .auth-wrapper {
            padding-top: 40px;
        }

        .logo-orb {
            width: 60px;
            height: 60px;
        }

        .logo-orb i {
            font-size: 1.5rem;
        }

        .auth-title {
            font-size: 1.8rem;
        }

        .remember-forgot {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .form-input {
            padding: 1rem 3.2rem 1rem 2.8rem;
        }

        .password-toggle {
            right: 0.8rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Animated Background -->
<div class="auth-bg-animated"></div>

<!-- Floating Elements -->
<div class="floating-element" style="width: 100px; height: 100px; top: 10%; left: 5%; animation-delay: 0s;"></div>
<div class="floating-element" style="width: 150px; height: 150px; top: 20%; right: 10%; animation-delay: 1s;"></div>
<div class="floating-element" style="width: 80px; height: 80px; bottom: 15%; left: 15%; animation-delay: 2s;"></div>

<!-- Main Content -->
<div class="auth-wrapper">
    <div class="container">
        <div class="auth-container">
            <!-- Glassmorphism Card -->
            <div class="auth-glass-card">
                <!-- Header -->
                <div class="auth-header">
                    <div class="logo-orb">
                        <i class="bi bi-globe-africa"></i>
                    </div>
                    <h1 class="auth-title">Bienvenue de retour</h1>
                    <p class="auth-subtitle">
                        Connectez-vous à votre espace culturel pour continuer l'aventure
                    </p>
                </div>

                <!-- Body -->
                <div class="auth-body">
                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="alert-container">
                            <div class="alert alert-danger">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <div>
                                        <strong>Veuillez corriger les erreurs suivantes :</strong>
                                        <ul class="mb-0 mt-2 ps-3">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('status'))
                        <div class="alert-container">
                            <div class="alert alert-success">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>{{ session('status') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('front.connexion.post') }}" id="loginForm">
                        @csrf

                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group-auth">
                                <span class="input-icon">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       class="form-input"
                                       placeholder="entrez votre email"
                                       value="{{ old('email') }}"
                                       required
                                       autocomplete="email"
                                       autofocus>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group-auth">
                                <span class="input-icon">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-input"
                                       placeholder="votre mot de passe"
                                       required
                                       autocomplete="current-password">
                                <button type="button" class="password-toggle" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="remember-forgot">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="remember"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Se souvenir de moi
                                </label>
                            </div>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-submit" id="submitBtn">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Se connecter</span>
                            <span class="spinner-border spinner-border-sm d-none" id="spinner"></span>
                        </button>
                    </form>

                    <!-- Social Login -->
                    <div class="divider">
                        <span class="divider-text">Ou connectez-vous avec</span>
                    </div>

                    <div class="social-login">
                        <a href="#" class="social-btn google">
                            <i class="bi bi-google"></i>
                            <span>Google</span>
                        </a>
                        <a href="#" class="social-btn facebook">
                            <i class="bi bi-facebook"></i>
                            <span>Facebook</span>
                        </a>
                        <a href="#" class="social-btn twitter">
                            <i class="bi bi-twitter"></i>
                            <span>Twitter</span>
                        </a>
                    </div>

                    <!-- Registration Link -->
                    <div class="auth-footer">
                        <p class="text-muted mb-0">
                            Nouveau sur Bénin Culture ?
                            <a href="{{ route('front.inscription') }}" class="register-link ms-1">
                                Créez votre compte
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Benefits Section -->
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Favoris personnels</h5>
                    <p class="text-muted mb-0">
                        Sauvegardez et organisez vos contenus préférés
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
                    <h5 class="fw-bold mb-2">Contribution libre</h5>
                    <p class="text-muted mb-0">
                        Partagez vos connaissances et découvertes
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility - CORRIGÉ
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password'
                ? '<i class="bi bi-eye"></i>'
                : '<i class="bi bi-eye-slash"></i>';
        });
    }

    // Form submission with loading state
    const loginForm = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');
    const spinner = document.getElementById('spinner');

    if (loginForm && submitBtn) {
        loginForm.addEventListener('submit', function(e) {
            // Basic validation
            const email = document.getElementById('email')?.value.trim();
            const password = document.getElementById('password')?.value.trim();

            if (!email || !password) {
                e.preventDefault();
                showToast('Veuillez remplir tous les champs', 'error');
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            const submitText = submitBtn.querySelector('span');
            if (submitText) submitText.textContent = 'Connexion...';
            if (spinner) spinner.classList.remove('d-none');
        });
    }

    // Helper function to show toast
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="bi bi-${type === 'error' ? 'exclamation-triangle' : 'info-circle'} me-3"></i>
                <div>${message}</div>
            </div>
        `;

        Object.assign(toast.style, {
            position: 'fixed',
            top: '20px',
            right: '20px',
            background: type === 'error' ? 'linear-gradient(135deg, #E8112D, #FF3366)' : 'linear-gradient(135deg, #008751, #00B894)',
            color: 'white',
            padding: '15px 25px',
            borderRadius: '10px',
            boxShadow: '0 10px 30px rgba(0,0,0,0.2)',
            transform: 'translateX(150%)',
            transition: 'transform 0.3s ease',
            zIndex: '9999',
            maxWidth: '350px'
        });

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 10);

        setTimeout(() => {
            toast.style.transform = 'translateX(150%)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
});
</script>
@endpush
