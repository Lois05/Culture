@extends('layouts.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-3">
                <!-- Header -->
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-tags"></i> Détails du type de contenu
                    </h4>
                    <a href="{{ route('typecontenus.index') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>

                <!-- Body -->
                <div class="card-body text-center">
                    <i class="bi bi-tag-fill display-1 text-primary"></i>
                    <h3 class="fw-bold mt-2">{{ $typecontenu->nom_contenu }}</h3>
                    <span class="badge bg-info fs-6 px-3 py-2">
                        ID : {{ $typecontenu->id_type_contenu }}
                    </span>
                </div>

                <!-- Footer -->
                <div class="card-footer text-end">
                    <a href="{{ route('typecontenus.edit', $typecontenu->id_type_contenu) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Modifier
                    </a>
                    <form action="{{ route('typecontenus.destroy', $typecontenu->id_type_contenu) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Voulez-vous supprimer ce type de contenu ?')">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #0d6efd, #6610f2);
    }
</style>
@endpush
@endsection
