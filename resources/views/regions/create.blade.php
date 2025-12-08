@extends('layouts.layout')

@section('content')
<main class="app-main">
    <div class="container-fluid">
        <h3>Ajouter une région</h3>
        <form action="{{ route('admin.regions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nom_region" class="form-label">Nom de la région</label>
                <input type="text" name="nom_region" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="population" class="form-label">Population</label>
                <input type="number" name="population" class="form-control">
            </div>
            <div class="mb-3">
                <label for="superficie" class="form-label">Superficie</label>
                <input type="text" name="superficie" class="form-control">
            </div>
            <div class="mb-3">
                <label for="localisation" class="form-label">Localisation</label>
                <input type="text" name="localisation" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </form>
    </div>
</main>
@endsection
