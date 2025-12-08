@extends('layouts.layout')
@section('title')
 <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Gestion de la langue</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
@endsection

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Ajouter une langue</h3>
                        <a href="{{ route('langues.index') }}" class="btn btn-sm btn-secondary float-end">Retour</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('langues.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nom_langue" class="form-label">Nom de la langue</label>
                                <input type="text" class="form-control" id="nom_langue" name="nom_langue" required>
                            </div>
                            <div class="mb-3">
                                <label for="code_langue" class="form-label">Code de la langue</label>
                                <input type="text" class="form-control" id="code_langue" name="code_langue">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
