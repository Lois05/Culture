@extends('layouts.layout')

@section('page-title', 'Modifier le Commentaire')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-chat-dots me-2"></i> Modifier le commentaire
                    </h4>
                    <a href="{{ route('admin.commentaires.index') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.commentaires.update', $commentaire) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Utilisateur</label>
                            <select name="id_utilisateur" class="form-select @error('id_utilisateur') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un utilisateur --</option>
                                @foreach($utilisateurs as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('id_utilisateur', $commentaire->id_utilisateur) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} {{ $user->prenom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_utilisateur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Contenu</label>
                            <select name="id_contenu" class="form-select @error('id_contenu') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un contenu --</option>
                                @foreach($contenus as $contenuItem)
                                    <option value="{{ $contenuItem->id_contenu }}"
                                        {{ old('id_contenu', $commentaire->id_contenu) == $contenuItem->id_contenu ? 'selected' : '' }}>
                                        {{ $contenuItem->titre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_contenu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Commentaire</label>
                            <textarea name="contenu_commentaire" class="form-control @error('contenu_commentaire') is-invalid @enderror" rows="3" required>{{ old('contenu_commentaire', $commentaire->contenu_commentaire) }}</textarea>
                            @error('contenu_commentaire')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Note</label>
                                    <input type="number" name="note" class="form-control @error('note') is-invalid @enderror"
                                           min="0" max="5" value="{{ old('note', $commentaire->note) }}">
                                    @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Date</label>
                                    <input type="date" name="date_commentaire" class="form-control @error('date_commentaire') is-invalid @enderror"
                                           value="{{ old('date_commentaire', \Carbon\Carbon::parse($commentaire->date_commentaire)->format('Y-m-d')) }}" required>
                                    @error('date_commentaire')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Statut</label>
                            <select name="statut" class="form-select @error('statut') is-invalid @enderror" required>
                                <option value="actif" {{ old('statut', $commentaire->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                                <option value="inactif" {{ old('statut', $commentaire->statut) == 'inactif' ? 'selected' : '' }}>Inactif</option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3 justify-content-end pt-3">
                            <a href="{{ route('admin.commentaires.index') }}" class="btn btn-secondary btn-lg px-4">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4 shadow">
                                <i class="bi bi-check-circle me-2"></i> Modifier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
