@extends('layouts.layout')

@section('page-title', 'Modifier la Langue')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-translate me-2"></i> Modifier la langue
                    </h4>
                    <a href="{{ route('admin.langues.index') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.langues.update', $langue) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nom_langue" class="form-label fw-bold">Nom de la langue</label>
                            <input type="text"
                                   class="form-control form-control-lg @error('nom_langue') is-invalid @enderror"
                                   id="nom_langue"
                                   name="nom_langue"
                                   value="{{ old('nom_langue', $langue->nom_langue) }}"
                                   required
                                   autofocus>
                            @error('nom_langue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="code_langue" class="form-label fw-bold">Code de la langue</label>
                            <input type="text"
                                   class="form-control @error('code_langue') is-invalid @enderror"
                                   id="code_langue"
                                   name="code_langue"
                                   value="{{ old('code_langue', $langue->code_langue) }}"
                                   placeholder="ex: fr, en, es">
                            @error('code_langue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="4"
                                      placeholder="Description de la langue...">{{ old('description', $langue->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3 justify-content-end pt-3">
                            <a href="{{ route('admin.langues.index') }}" class="btn btn-secondary btn-lg px-4">
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
