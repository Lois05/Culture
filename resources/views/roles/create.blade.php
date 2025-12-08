@extends('layouts.layout')

@section('page-title', 'Ajouter un Rôle')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-plus-circle me-2"></i> Ajouter un rôle
                    </h4>
                    <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nom_role" class="form-label fw-bold text-dark">
                                <i class="bi bi-person-badge me-2"></i> Nom du rôle
                            </label>
                            <input type="text"
                                   name="nom_role"
                                   id="nom_role"
                                   value="{{ old('nom_role') }}"
                                   class="form-control form-control-lg @error('nom_role') is-invalid @enderror"
                                   placeholder="Entrez le nom du rôle"
                                   required
                                   autofocus>
                            @error('nom_role')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3 justify-content-end pt-3">
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-lg px-4">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4 shadow">
                                <i class="bi bi-check-circle me-2"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
