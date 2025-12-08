{{-- resources/views/moderateur/index.blade.php --}}
@extends('layouts.layout')

@section('title', 'Modération des contenus')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning">
                    <h3 class="card-title">
                        <i class="fas fa-clipboard-check mr-2"></i>
                        Modération des contenus
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-dark">
                            {{ $contenusEnAttente->total() }} contenu(s) en attente
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    @if($contenusEnAttente->isEmpty())
                        <div class="alert alert-success text-center">
                            <i class="fas fa-check-circle fa-2x mb-3"></i>
                            <h4>Bravo !</h4>
                            <p>Aucun contenu en attente de modération.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 25%">Titre</th>
                                        <th style="width: 15%">Auteur</th>
                                        <th style="width: 15%">Région</th>
                                        <th style="width: 15%">Type</th>
                                        <th style="width: 15%">Date</th>
                                        <th style="width: 10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contenusEnAttente as $contenu)
                                    <tr>
                                        <td>{{ $contenu->id_contenu }}</td>
                                        <td>
                                            <strong>{{ Str::limit($contenu->titre, 50) }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                {{ Str::limit(strip_tags($contenu->texte), 80) }}
                                            </small>
                                        </td>
                                        <td>
                                            @if($contenu->auteur)
                                                {{ $contenu->auteur->prenom }} {{ $contenu->auteur->name }}
                                                <br>
                                                <small class="text-muted">{{ $contenu->auteur->email }}</small>
                                            @else
                                                <span class="text-danger">Auteur supprimé</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($contenu->region)
                                                {{ $contenu->region->nom_region }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($contenu->typeContenu)
                                                <span class="badge badge-info">
                                                    {{ $contenu->typeContenu->nom_contenu }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $contenu->date_creation->format('d/m/Y') }}
                                            <br>
                                            <small class="text-muted">
                                                {{ $contenu->date_creation->format('H:i') }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.moderateur.show', $contenu->id_contenu) }}"
                                                   class="btn btn-info"
                                                   title="Voir les détails">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <form action="{{ route('admin.moderateur.valider', $contenu->id_contenu) }}"
                                                      method="POST"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit"
                                                            class="btn btn-success"
                                                            title="Valider ce contenu"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir valider ce contenu ?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.moderateur.rejeter', $contenu->id_contenu) }}"
                                                      method="POST"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit"
                                                            class="btn btn-danger"
                                                            title="Rejeter ce contenu"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir rejeter ce contenu ?')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $contenusEnAttente->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
