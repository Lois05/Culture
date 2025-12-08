@extends('layouts.layout_front')

@section('title', $categorie->nom)

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categories') }}">Catégories</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $categorie->nom }}</li>
        </ol>
    </nav>

    <!-- En-tête de la catégorie -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary rounded-circle p-3 me-3">
                    <i class="fas {{ $categorie->icone ?? 'fa-folder' }} fa-2x text-white"></i>
                </div>
                <div>
                    <h1 class="mb-2">{{ $categorie->nom }}</h1>
                    <p class="lead text-muted mb-0">{{ $categorie->description ?? 'Découvrez tous les contenus de cette catégorie' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">Statistiques</h5>
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="h4 mb-0">{{ $categorieStats['total_contenus'] ?? 0 }}</div>
                            <small class="text-muted">Contenus</small>
                        </div>
                        <div class="col-4">
                            <div class="h4 mb-0">{{ $categorieStats['total_likes'] ?? 0 }}</div>
                            <small class="text-muted">Likes</small>
                        </div>
                        <div class="col-4">
                            <div class="h4 mb-0">{{ $categorieStats['total_vues'] ?? 0 }}</div>
                            <small class="text-muted">Vues</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des contenus -->
    <h2 class="mb-4">Contenus ({{ $contents->total() }})</h2>

    @if($contents->isEmpty())
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>
        Aucun contenu n'a encore été publié dans cette catégorie.
        @auth
            <a href="{{ route('contribute.create') }}" class="alert-link">Soyez le premier à contribuer !</a>
        @else
            <a href="{{ route('register') }}" class="alert-link">Inscrivez-vous pour contribuer !</a>
        @endauth
    </div>
    @else
    <div class="row">
        @foreach($contents as $contenu)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $contenu->titre ?? 'Titre du contenu' }}</h5>
                    <p class="card-text text-muted small">
                        {{ Str::limit($contenu->description ?? 'Description du contenu', 100) }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            <i class="fas fa-user me-1"></i>
                            {{ $contenu->auteur->name ?? 'Auteur' }}
                        </div>
                        <div class="text-muted small">
                            <i class="fas fa-calendar me-1"></i>
                            {{ isset($contenu->date_creation) ? \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') : date('d/m/Y') }}
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="badge bg-primary me-2">
                                <i class="fas fa-thumbs-up me-1"></i> {{ $contenu->likes_count ?? 0 }}
                            </span>
                            <span class="badge bg-secondary">
                                <i class="fas fa-comment me-1"></i> {{ $contenu->commentaires_count ?? 0 }}
                            </span>
                        </div>
                        <a href="{{ route('contenu.show', $contenu->id) }}" class="btn btn-sm btn-outline-primary">
                            Voir <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($contents->hasPages())
    <div class="mt-4">
        {{ $contents->links() }}
    </div>
    @endif
    @endif

    <!-- Bouton retour -->
    <div class="mt-5">
        <a href="{{ route('categories') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Retour à toutes les catégories
        </a>
        @auth
        <a href="{{ route('contribute.create') }}" class="btn btn-primary float-end">
            <i class="fas fa-plus me-2"></i> Ajouter un contenu
        </a>
        @endif
    </div>
</div>
@endsection
