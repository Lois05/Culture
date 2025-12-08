@extends('layouts.layout_front')

@section('title', $categorie->nom_contenu . ' - Culture Bénin')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-4 mb-3">{{ $categorie->nom_contenu }}</h1>
            <div class="d-flex gap-4 mb-4">
                <div class="stat">
                    <div class="stat-number">{{ $stats['total_contents'] }}</div>
                    <div class="stat-label">Contenus</div>
                </div>
                <div class="stat">
                    <div class="stat-number">{{ $stats['total_likes'] }}</div>
                    <div class="stat-label">Likes</div>
                </div>
                <div class="stat">
                    <div class="stat-number">{{ $stats['total_views'] }}</div>
                    <div class="stat-label">Vues</div>
                </div>
            </div>
        </div>
    </div>

    @if($contents->count() > 0)
        <div class="row">
            @foreach($contents as $content)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $content->medias->first()->chemin ?? '/adminlte/img/collage.png' }}"
                         class="card-img-top"
                         alt="{{ $content->titre }}"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $content->titre }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit(strip_tags($content->texte), 100) }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('front.content.show', $content->id_contenu) }}" class="btn btn-primary btn-sm">
                            Voir plus
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $contents->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <h3>Aucun contenu dans cette catégorie</h3>
        </div>
    @endif
</div>

<style>
.stat {
    text-align: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    min-width: 120px;
}
.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: #008751;
}
.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
}
</style>
@endsection
