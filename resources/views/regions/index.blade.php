@extends('layouts.layout')

@section('page-title', 'Gestion des Régions')

@section('content')
<main class="app-main bg-light min-vh-100">
    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary">
                <i class="bi bi-map"></i> Régions
            </h3>
            <a href="{{ route('admin.regions.create') }}" class="btn btn-primary btn-lg shadow">
                <i class="bi bi-plus-circle"></i> Ajouter une région
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                <table id="regionsTable" class="table table-striped table-hover align-middle w-100">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Population</th>
                            <th>Superficie</th>
                            <th>Localisation</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($regions as $region)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $region->id_region ?? $region->id }}</span></td>
                            <td>{{ $region->nom_region }}</td>
                            <td>{{ Str::limit($region->description, 50) }}</td>
                            <td>
                                @if($region->population)
                                    <span class="badge bg-info">{{ number_format($region->population) }}</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($region->superficie)
                                    <span class="badge bg-warning text-dark">{{ $region->superficie }} km²</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>
                                <i class="bi bi-geo-alt"></i>
                                {{ $region->localisation ?? 'Non spécifiée' }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <!-- Bouton Voir ouvre le modal -->
                                    <button type="button"
                                            class="btn btn-sm btn-outline-info rounded-circle"
                                            data-bs-toggle="modal"
                                            data-bs-target="#mapModal{{ $region->id_region ?? $region->id }}"
                                            title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    <a href="{{ route('admin.regions.edit', $region) }}"
                                       class="btn btn-sm btn-outline-warning rounded-circle" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.regions.destroy', $region) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle btn-delete" title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modals en dehors de la table -->
@foreach($regions as $region)
<div class="modal fade" id="mapModal{{ $region->id_region ?? $region->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-geo-alt"></i> {{ $region->nom_region }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Description :</strong> {{ $region->description ?? 'Non renseignée' }}</p>
                <p><strong>Population :</strong> {{ $region->population ? number_format($region->population) : 'Non renseignée' }}</p>
                <p><strong>Superficie :</strong> {{ $region->superficie ? $region->superficie . ' km²' : 'Non renseignée' }}</p>
                <div id="map{{ $region->id_region ?? $region->id }}" style="height:400px;" class="rounded shadow"></div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('scripts')
<!-- Inclure DataTables CSS et JS si pas déjà dans le layout -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<!-- Leaflet pour les cartes -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
$(document).ready(function () {
    console.log('Initialisation DataTables...');

    // Initialiser DataTables
    var table = $('#regionsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        "pageLength": 10,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tous"]],
        "responsive": true,
        "autoWidth": false,
        "columns": [
            { "width": "5%" },  // ID
            { "width": "15%" }, // Nom
            { "width": "25%" }, // Description
            { "width": "10%" }, // Population
            { "width": "10%" }, // Superficie
            { "width": "15%" }, // Localisation
            { "width": "20%", "orderable": false } // Actions
        ],
        "order": [[0, 'asc']] // Tri par ID par défaut
    });

    console.log('DataTables initialisé avec succès');

    // Confirmation de suppression
    $('#regionsTable').on('click', '.btn-delete', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');

        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Initialiser les cartes Leaflet
    @foreach($regions as $region)
    $('#mapModal{{ $region->id_region ?? $region->id }}').on('shown.bs.modal', function () {
        var mapId = 'map{{ $region->id_region ?? $region->id }}';
        var mapElement = document.getElementById(mapId);

        // Vérifier si la carte est déjà initialisée
        if (mapElement._leaflet_id) {
            return;
        }

        // Coordonnées par défaut (Bénin)
        var defaultLat = 9.3077;
        var defaultLng = 2.3158;
        var zoomLevel = 7;

        // Essayer d'extraire les coordonnées de la localisation
        @if($region->localisation)
            var coords = "{{ $region->localisation }}".split(',');
            if (coords.length === 2) {
                var lat = parseFloat(coords[0].trim());
                var lng = parseFloat(coords[1].trim());
                if (!isNaN(lat) && !isNaN(lng)) {
                    defaultLat = lat;
                    defaultLng = lng;
                    zoomLevel = 10;
                }
            }
        @endif

        var map = L.map(mapId).setView([defaultLat, defaultLng], zoomLevel);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Ajouter un marqueur
        var marker = L.marker([defaultLat, defaultLng]).addTo(map)
            .bindPopup("<b>{{ $region->nom_region }}</b><br>" +
                      "Population: {{ $region->population ? number_format($region->population) : 'N/A' }}<br>" +
                      "Superficie: {{ $region->superficie ? $region->superficie . ' km²' : 'N/A' }}")
            .openPopup();
    });
    @endforeach
});
</script>

<style>
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
    margin: 1rem 0;
}

/* Style pour les boutons d'action */
.btn-group .btn {
    margin: 0 2px;
}

/* Responsive */
@media (max-width: 768px) {
    .btn-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .btn-group .btn {
        margin: 0;
    }
}
</style>
@endsection
