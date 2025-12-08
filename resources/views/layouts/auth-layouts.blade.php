{{-- resources/views/layouts/auth-layout.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Authentification - Admin Bénin Culture')</title>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --admin-primary: #1A1A2E;
            --admin-secondary: #0F3460;
            --admin-accent: #E8112D;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .auth-container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }

        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            border-top: 5px solid var(--admin-accent);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-title {
            color: var(--admin-primary);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .btn-auth {
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-secondary));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
        }

        .btn-auth:hover {
            background: linear-gradient(135deg, var(--admin-secondary), var(--admin-primary));
            color: white;
        }

        .auth-link {
            color: var(--admin-accent);
            text-decoration: none;
        }

        .auth-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="auth-container">
                    <div class="auth-card">
                        <div class="auth-logo">
                            <h3 class="auth-title">
                                <i class="bi bi-globe-africa me-2"></i>Bénin Culture Admin
                            </h3>
                            <p class="auth-subtitle">@yield('subtitle', 'Administration')</p>
                        </div>

                        <!-- Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Contenu -->
                        @yield('content')

                        <!-- Lien retour -->
                        <div class="text-center mt-4">
                            <a href="{{ route('front.home') }}" class="auth-link">
                                <i class="bi bi-arrow-left me-1"></i>Retour au site
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
