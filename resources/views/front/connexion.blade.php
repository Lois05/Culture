@extends('layouts.layout_front')

@section('title', 'Connexion - Bénin Culture')

@push('styles')
<style>
    .auth-hero {
        background: linear-gradient(135deg, rgba(26, 26, 46, 0.95), rgba(26, 26, 46, 0.98)),
                    url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?auto=format&fit=crop&w=1600&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 8rem 0 4rem;
        margin-top: -80px;
        position: relative;
    }

    .auth-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--gradient-bg);
        opacity: 0.3;
        z-index: 1;
    }

    .auth-hero-content {
        position: relative;
        z-index: 2;
    }

    .auth-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 2rem 0;
    }

    .auth-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        border: none;
    }

    .auth-header {
        background: var(--gradient-bg);
        padding: 3rem 2rem;
        text-align: center;
        color: white;
    }

    .auth-body {
        padding: 3rem 2.5rem;
    }

    .form-control-auth {
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control-auth:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(252, 209, 22, 0.25);
    }

    .btn-auth {
        background: var(--gradient-bg);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-auth:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 2rem 0;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e9ecef;
    }

    .divider span {
        padding: 0 1rem;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .social-login-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 0.8rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
        border: 2px solid #e9ecef;
        background: white;
        color: #333;
    }

    .social-login-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .auth-footer {
        text-align: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e9ecef;
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    @media (max-width: 576px) {
        .auth-body {
            padding: 2rem 1.5rem;
        }

        .auth-header {
            padding: 2rem 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="auth-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="auth-hero-content">
                    <h1 class="display-4 fw-bold mb-4">Bienvenue sur Bénin Culture</h1>
                    <p class="lead mb-5">
                        Connectez-vous pour contribuer, sauvegarder vos favoris et interagir
                        avec notre communauté culturelle.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Formulaire de connexion -->
<section class="py-5">
    <div class="container">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <div class="mb-3">
                        <i class="bi bi-globe-africa fs-1"></i>
                    </div>
                    <h2 class="fw-bold mb-2">Connexion</h2>
                    <p class="mb-0">Accédez à votre espace personnel</p>
                </div>

                <div class="auth-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('front.connexion') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">Adresse email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email"
                                       class="form-control form-control-auth border-start-0"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="votre@email.com"
                                       required>
                            </div>
                        </div>

                        <!-- Mot de passe -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password"
                                       class="form-control form-control-auth border-start-0"
                                       id="password"
                                       name="password"
                                       placeholder="Votre mot de passe"
                                       required>
                                <button class="btn btn-outline-secondary border-start-0"
                                        type="button"
                                        id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember me & Forgot password -->
                        <div class="remember-forgot">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Se souvenir de moi
                                </label>
                            </div>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn-auth mb-4">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Se connecter
                        </button>
                    </form>

                    <!-- Auth footer -->
                    <div class="auth-footer">
                        <p class="mb-0">
                            Pas encore de compte ?
                            <a href="{{ route('front.inscription') }}" class="text-primary fw-bold text-decoration-none">
                                Inscrivez-vous ici
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Benefits -->
            <div class="row mt-5 g-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-start">
                        <div class="bg-light rounded-circle p-3 me-3">
                            <i class="bi bi-heart text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2">Sauvegardez vos favoris</h6>
                            <p class="text-muted small mb-0">Gardez une trace des contenus qui vous intéressent</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-start">
                        <div class="bg-light rounded-circle p-3 me-3">
                            <i class="bi bi-chat text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2">Participez aux discussions</h6>
                            <p class="text-muted small mb-0">Échangez avec la communauté culturelle</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-start">
                        <div class="bg-light rounded-circle p-3 me-3">
                            <i class="bi bi-plus-circle text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2">Contribuez aux contenus</h6>
                            <p class="text-muted small mb-0">Partagez vos connaissances culturelles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
    });
</script>
@endpush
