@extends('layouts.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-3">
                <!-- Header -->
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Modifier le type de contenu</h4>
                    <a href="{{ route('typecontenus.index') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <form action="{{ route('typecontenus.update', $typecontenu->id_type_contenu) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom_contenu" class="form-label fw-bold">
                                <i class="bi bi-tag"></i> Nom du type
                            </label>
                            <input type="text" name="nom_contenu" id="nom_contenu"
                                   value="{{ old('nom_contenu', $typecontenu->nom_contenu) }}"
                                   class="form-control shadow-sm" required>
                        </div>

                        <!-- Boutons -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-gradient shadow">
                                <i class="bi bi-check-circle"></i> Mettre à jour
                            </button>
                            <a href="{{ route('typecontenus.index') }}" class="btn btn-secondary shadow">
                                <i class="bi bi-x-circle"></i> Annuler
                            </a>
                        </div>
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
    .form-control {
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #6610f2;
        box-shadow: 0 0 0 0.2rem rgba(102,16,242,.25);
    }
    .btn-gradient {
        background: linear-gradient(45deg, #0d6efd, #6610f2);
        color: #fff;
        border: none;
        transition: 0.3s;
    }
    .btn-gradient:hover { transform: scale(1.05); opacity: 0.9; }
</style>
@endpush
@endsection
