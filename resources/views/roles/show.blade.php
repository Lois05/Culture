@extends('layouts.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-person-badge"></i> Détails du rôle</h4>
                    <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
                <div class="card-body text-center">
                    <i class="bi bi-person-fill display-1 text-primary"></i>
                    <h3 class="fw-bold mt-2">{{ $role->nom_role }}</h3>
                    <span class="badge bg-info fs-6 px-3 py-2">ID : {{ $role->id }}</span>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Modifier
                    </a>
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Voulez-vous supprimer ce rôle ?')">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
