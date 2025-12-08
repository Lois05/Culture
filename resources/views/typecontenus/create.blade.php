@extends('layouts.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Ajouter un type de contenu</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('typecontenus.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nom_contenu" class="form-label fw-bold">
                                <i class="bi bi-tag"></i> Nom du type
                            </label>
                            <input type="text" name="nom_contenu" id="nom_contenu"
                                   value="{{ old('nom_contenu') }}"
                                   class="form-control shadow-sm" required>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-gradient shadow">
                                <i class="bi bi-check-circle"></i> Enregistrer
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
.bg-gradient-primary { background: linear-gradient(45deg, #0d6efd, #6610f2); }
.btn-gradient { background: linear-gradient(45deg, #0d6efd, #6610f2); color:#fff; border:none; }
.btn-gradient:hover { transform: scale(1.05); opacity:0.9; }
</style>
@endpush
@endsection
