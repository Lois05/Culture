@extends('layouts.layout')

@section('content')
<main class="app-main">
    <div class="container-fluid mt-3">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-chat-left-text"></i> Commentaire de {{ $commentaire->utilisateur->nom ?? '-' }}</h4>
                <a href="{{ route('commentaires.index') }}" class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i> Retour</a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Utilisateur :</strong> {{ $commentaire->utilisateur->nom ?? '-' }} {{ $commentaire->utilisateur->prenom ?? '' }}
                </div>
                <div class="mb-3">
                    <strong>Contenu :</strong> {{ $commentaire->contenu->titre ?? '-' }}
                </div>
                <div class="mb-3">
                    <strong>Texte :</strong>
                    <p class="border p-3 rounded bg-light">{{ $commentaire->texte }}</p>
                </div>
                <div class="mb-3">
                    <strong>Note :</strong>
                    <span class="badge bg-success">{{ $commentaire->note }}/5</span>
                </div>
                <div class="mb-3">
                    <strong>Date :</strong> {{ \Carbon\Carbon::parse($commentaire->date)->format('d/m/Y') }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
