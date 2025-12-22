{{-- resources/views/contenus/edit.blade.php --}}
@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Modifier le Contenu</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.contenus.update', $contenu->id_contenu) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Titre -->
        <div class="mb-3">
            <label>Titre *</label>
            <input type="text" name="titre" class="form-control" value="{{ old('titre', $contenu->titre) }}" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $contenu->description) }}</textarea>
        </div>

        <!-- Contenu -->
        <div class="mb-3">
            <label>Contenu *</label>
            <textarea name="texte" class="form-control" rows="10" required>{{ old('texte', $contenu->texte) }}</textarea>
        </div>

        <!-- Métadonnées -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label>Type de contenu *</label>
                <select name="id_type_contenu" class="form-control" required>
                    @foreach($typesContenu as $type)
                        <option value="{{ $type->id_type_contenu }}" {{ $contenu->id_type_contenu == $type->id_type_contenu ? 'selected' : '' }}>
                            {{ $type->nom_contenu }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label>Région *</label>
                <select name="id_region" class="form-control" required>
                    @foreach($regions as $region)
                        <option value="{{ $region->id_region }}" {{ $contenu->id_region == $region->id_region ? 'selected' : '' }}>
                            {{ $region->nom_region }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label>Langue *</label>
                <select name="id_langue" class="form-control" required>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->id_langue }}" {{ $contenu->id_langue == $langue->id_langue ? 'selected' : '' }}>
                            {{ $langue->nom_langue }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Média actuel -->
        @if($contenu->medias->count() > 0)
            @php $media = $contenu->medias->first(); @endphp
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Média actuel</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($media->id_type_media == 1) {{-- Image --}}
                                <img src="{{ asset('adminlte/img/' . $media->chemin) }}"
                                     class="img-fluid"
                                     alt="Image actuelle"
                                     style="max-height: 200px;">
                            @elseif($media->id_type_media == 2) {{-- Vidéo --}}
                                <div class="bg-dark text-white p-4 text-center">
                                    <i class="bi bi-play-circle fs-1"></i>
                                    <p class="mb-0">Vidéo</p>
                                </div>
                            @else {{-- Audio --}}
                                <div class="bg-secondary text-white p-4 text-center">
                                    <i class="bi bi-music-note-beamed fs-1"></i>
                                    <p class="mb-0">Audio</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <p><strong>Fichier :</strong> {{ $media->chemin }}</p>
                            <p><strong>Description :</strong> {{ $media->description }}</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remove_media" id="remove_media" value="1">
                                <label class="form-check-label text-danger" for="remove_media">
                                    Supprimer ce média
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Nouveau média -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Nouveau média (optionnel)</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Fichier média</label>
                    <input type="file" name="media_file" class="form-control">
                    <small class="text-muted">Images (JPG, PNG, GIF, WEBP), Vidéos (MP4, AVI, MOV), Audio (MP3, WAV, OGG) - Max 100MB</small>
                </div>

                <div class="mb-3">
                    <label>Description du média (optionnel)</label>
                    <textarea name="media_description" class="form-control" rows="2">{{ old('media_description', $contenu->medias->first()->description ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Statut (admin/modo seulement) -->
        @if(auth()->user()->isAdmin() || auth()->user()->isModerator())
            <div class="mb-3">
                <label>Statut</label>
                <select name="statut" class="form-control">
                    <option value="en attente" {{ $contenu->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                    <option value="validé" {{ $contenu->statut == 'validé' ? 'selected' : '' }}>Validé</option>
                    <option value="rejeté" {{ $contenu->statut == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                </select>
            </div>
        @endif

        <!-- Boutons -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.contenus.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>

<script>
// Désactiver la validation HTML5 pour permettre les gros fichiers
document.querySelector('form').setAttribute('novalidate', 'novalidate');
</script>
@endsection

