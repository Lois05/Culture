@extends('layouts.layout')

@section('page-title', 'Modifier la Région') {{-- Ajoutez cette ligne --}}

@section('content')
<main class="app-main">
    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-pencil-square"></i> Modifier la région
            </h3>
            <a href="{{ route('admin.regions.index') }}" class="btn btn-outline-secondary"> {{-- Corrigez la route --}}
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                <form action="{{ route('admin.regions.update', $region) }}" method="POST"> {{-- Corrigez la route --}}
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom_region" class="form-label fw-bold">Nom de la région</label>
                                <input type="text" name="nom_region" id="nom_region" class="form-control"
                                       value="{{ old('nom_region', $region->nom_region) }}" required>
                                @error('nom_region')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="population" class="form-label fw-bold">Population</label>
                                <input type="number" name="population" id="population" class="form-control"
                                       value="{{ old('population', $region->population) }}" required>
                                @error('population')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="superficie" class="form-label fw-bold">Superficie (km²)</label>
                                <input type="number" step="0.01" name="superficie" id="superficie" class="form-control"
                                       value="{{ old('superficie', $region->superficie) }}" required>
                                @error('superficie')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="localisation" class="form-label fw-bold">Localisation (Lat,Lng)</label>
                                <input type="text" name="localisation" id="localisation" class="form-control"
                                       value="{{ old('localisation', $region->localisation) }}"
                                       placeholder="Ex: 6.4969,2.6000" required>
                                @error('localisation')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $region->description) }}</textarea>
                        @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Mettre à jour
                        </button>
                        <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary"> {{-- Corrigez la route --}}
                            <i class="bi bi-x-circle"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
