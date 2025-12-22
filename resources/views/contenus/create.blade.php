{{-- resources/views/contenus/create.blade.php --}}
@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Créer un nouveau contenu</h1>

    <form action="{{ route('admin.contenus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Titre -->
        <div class="mb-3">
            <label>Titre *</label>
            <input type="text" name="titre" class="form-control" value="{{ old('titre') }}" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label>Description (optionnel)</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <!-- Contenu -->
        <div class="mb-3">
            <label>Contenu *</label>
            <textarea name="texte" class="form-control" rows="10" required>{{ old('texte') }}</textarea>
        </div>

        <!-- Métadonnées -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label>Type de contenu *</label>
                <select name="id_type_contenu" class="form-control" required>
                    <option value="">Sélectionnez...</option>
                    @foreach($typesContenu as $type)
                        <option value="{{ $type->id_type_contenu }}" {{ old('id_type_contenu') == $type->id_type_contenu ? 'selected' : '' }}>
                            {{ $type->nom_contenu }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label>Région *</label>
                <select name="id_region" class="form-control" required>
                    <option value="">Sélectionnez...</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id_region }}" {{ old('id_region') == $region->id_region ? 'selected' : '' }}>
                            {{ $region->nom_region }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label>Langue *</label>
                <select name="id_langue" class="form-control" required>
                    <option value="">Sélectionnez...</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->id_langue }}" {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                            {{ $langue->nom_langue }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Média (obligatoire pour la création) -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Média *</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Fichier média *</label>
                    <input type="file" name="media_file" class="form-control" required>
                    <small class="text-muted">Images (JPG, PNG, GIF, WEBP), Vidéos (MP4, AVI, MOV), Audio (MP3, WAV, OGG) - Max 100MB</small>
                </div>

                <div class="mb-3">
                    <label>Description du média (optionnel)</label>
                    <textarea name="media_description" class="form-control" rows="2">{{ old('media_description') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Boutons -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.contenus.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Créer le contenu</button>
        </div>
    </form>
</div>

<script>
// Désactiver la validation HTML5
document.querySelector('form').setAttribute('novalidate', 'novalidate');
</script>
@endsection
