@extends('layouts.layout')

@section('content')
<main class="app-main">
    <div class="container-fluid mt-4">

        <!-- Header avec titre et bouton retour -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary"><i class="bi bi-globe-americas me-2"></i>Détails de la région</h3>
            <a href="{{ route('regions.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Retour à la liste
            </a>
        </div>

        <!-- Carte principale de la région -->
        <div class="card shadow-sm border-primary">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ $region->nom_region }}</h4>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    <!-- Description -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded shadow-sm h-100 bg-light">
                            <h5 class="text-muted"><i class="bi bi-card-text me-2"></i>Description</h5>
                            <p class="mb-0">{{ $region->description }}</p>
                        </div>
                    </div>

                    <!-- Population -->
                    <div class="col-md-3">
                        <div class="p-3 border rounded shadow-sm h-100 text-center bg-white">
                            <h6 class="text-muted"><i class="bi bi-people-fill me-1"></i>Population</h6>
                            <span class="fs-4 fw-bold">{{ number_format($region->population, 0, ',', ' ') }}</span>
                        </div>
                    </div>

                    <!-- Superficie -->
                    <div class="col-md-3">
                        <div class="p-3 border rounded shadow-sm h-100 text-center bg-white">
                            <h6 class="text-muted"><i class="bi bi-arrows-fullscreen me-1"></i>Superficie</h6>
                            <span class="fs-4 fw-bold">{{ $region->superficie }} km²</span>
                        </div>
                    </div>

                    <!-- Localisation -->
                    <div class="col-12">
                        <div class="p-3 border rounded shadow-sm bg-light">
                            <h5 class="text-muted"><i class="bi bi-geo-alt-fill me-2"></i>Localisation</h5>
                            <p class="mb-0">{{ $region->localisation }}</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('regions.edit', $region) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square me-1"></i> Modifier
                </a>
                <a href="{{ route('regions.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle me-1"></i> Retour
                </a>
            </div>
        </div>
    </div>
</main>
@endsection
