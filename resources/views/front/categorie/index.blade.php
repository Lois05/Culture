@extends('layouts.layout_front')

@section('title', 'Toutes les catégories')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Toutes les catégories</h1>
    <p class="lead mb-5">Découvrez notre région à travers différentes thématiques</p>

    <div class="row">
        @foreach($categories as $categorie)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas {{ $categorie->icone }} fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">{{ $categorie->nom }}</h5>
                        <p class="card-text text-muted small">{{ $categorie->description }}</p>
                        <a href="{{ route('categorie.show', $categorie->id) }}" class="btn btn-primary btn-sm mt-2">
                            Explorer <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
