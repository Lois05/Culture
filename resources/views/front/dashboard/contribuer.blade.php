@extends('layouts.dashboard')

@section('title', 'Contribuer - Bénin Culture')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <!-- En-tête -->
            <div class="text-center mb-5">
                <div class="mb-4">
                    <i class="bi bi-plus-circle-fill text-primary" style="font-size: 3.5rem;"></i>
                </div>
                <h1 class="display-5 fw-bold text-primary mb-3">
                    Contribuer à Bénin Culture
                </h1>
                <p class="lead text-muted">
                    Partagez vos connaissances sur la culture béninoise et aidez à préserver notre patrimoine.
                </p>
            </div>

            <!-- Alertes -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Veuillez corriger les erreurs suivantes :</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Carte du formulaire -->
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-pencil-square fs-3 me-3"></i>
                        <div>
                            <h3 class="mb-1">Nouvelle Contribution</h3>
                            <p class="mb-0 opacity-75">Remplissez ce formulaire pour partager votre savoir</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">
                    <!-- Formulaire - CORRECTION : <form> au lieu de form -->
                    <form method="POST" action="{{ route('dashboard.contribuer.store') }}" enctype="multipart/form-data" id="contributionForm">
                        @csrf

                        <div class="row g-4">
                            <!-- Titre -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="titre" class="form-label fw-bold fs-5">
                                        <i class="bi bi-type me-2"></i>Titre de votre contribution *
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg @error('titre') is-invalid @enderror"
                                           id="titre"
                                           name="titre"
                                           value="{{ old('titre') }}"
                                           placeholder="Ex: Les traditions vodoun de Ouidah"
                                           required>
                                    @error('titre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted mt-2">
                                        <i class="bi bi-lightbulb me-1"></i>Donnez un titre clair et descriptif
                                    </div>
                                </div>
                            </div>

                            <!-- Type de contenu et Région -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_type_contenu" class="form-label fw-bold">
                                        <i class="bi bi-tags me-2"></i>Type de contenu *
                                    </label>
                                    <select class="form-select @error('id_type_contenu') is-invalid @enderror"
                                            id="id_type_contenu"
                                            name="id_type_contenu"
                                            required>
                                        <option value="" disabled {{ old('id_type_contenu') ? '' : 'selected' }}>
                                            Sélectionnez un type
                                        </option>
                                        @foreach($typesContenu as $type)
                                            <option value="{{ $type->id_type_contenu }}"
                                                {{ old('id_type_contenu') == $type->id_type_contenu ? 'selected' : '' }}>
                                                {{ $type->nom_contenu }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_type_contenu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_region" class="form-label fw-bold">
                                        <i class="bi bi-geo-alt me-2"></i>Région concernée *
                                    </label>
                                    <select class="form-select @error('id_region') is-invalid @enderror"
                                            id="id_region"
                                            name="id_region"
                                            required>
                                        <option value="" disabled {{ old('id_region') ? '' : 'selected' }}>
                                            Sélectionnez une région
                                        </option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id_region }}"
                                                {{ old('id_region') == $region->id_region ? 'selected' : '' }}>
                                                {{ $region->nom_region }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_region')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Langue et Mots-clés -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_langue" class="form-label fw-bold">
                                        <i class="bi bi-translate me-2"></i>Langue principale
                                    </label>
                                    <select class="form-select @error('id_langue') is-invalid @enderror"
                                            id="id_langue"
                                            name="id_langue">
                                        <option value="" {{ old('id_langue') ? '' : 'selected' }}>
                                            Français (par défaut)
                                        </option>
                                        @foreach($langues as $langue)
                                            <option value="{{ $langue->id_langue }}"
                                                {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                                                {{ $langue->nom_langue }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_langue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mots_cles" class="form-label fw-bold">
                                        <i class="bi bi-hash me-2"></i>Mots-clés
                                    </label>
                                    <input type="text"
                                           class="form-control @error('mots_cles') is-invalid @enderror"
                                           id="mots_cles"
                                           name="mots_cles"
                                           value="{{ old('mots_cles') }}"
                                           placeholder="vodoun, tradition, ouidah, fête">
                                    @error('mots_cles')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted">
                                        <i class="bi bi-info-circle me-1"></i>Séparez par des virgules
                                    </div>
                                </div>
                            </div>

                            <!-- Contenu texte -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="texte" class="form-label fw-bold">
                                        <i class="bi bi-text-paragraph me-2"></i>Contenu détaillé *
                                    </label>
                                    <textarea class="form-control @error('texte') is-invalid @enderror"
                                              id="texte"
                                              name="texte"
                                              rows="10"
                                              placeholder="Rédigez votre contribution ici..."
                                              required>{{ old('texte') }}</textarea>
                                    @error('texte')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div class="form-text text-muted">
                                            <i class="bi bi-exclamation-circle me-1"></i>Minimum 50 caractères
                                        </div>
                                        <div class="text-muted">
                                            <span id="charCount">0</span> caractères
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fichier média -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="media_file" class="form-label fw-bold">
                                        <i class="bi bi-file-earmark-arrow-up me-2"></i>Fichier média (optionnel)
                                    </label>
                                    <div class="input-group">
                                        <input type="file"
                                               class="form-control @error('media_file') is-invalid @enderror"
                                               id="media_file"
                                               name="media_file"
                                               accept="image/*,video/*,audio/*">
                                        <label class="input-group-text" for="media_file">
                                            <i class="bi bi-folder2-open"></i>
                                        </label>
                                    </div>
                                    @error('media_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted mt-2">
                                        <i class="bi bi-card-checklist me-1"></i>
                                        Formats acceptés : images (JPG, PNG, GIF, WebP), vidéos (MP4, AVI, MOV, MKV, WebM), audio (MP3, WAV, OGG, AAC).
                                        <strong>Taille max : 100MB</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Prévisualisation du média -->
                            <div class="col-12" id="mediaPreview" style="display: none;">
                                <div class="card border mt-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="bi bi-eye me-2"></i>Aperçu du média</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="previewContainer"></div>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-sm btn-outline-danger" id="removeMedia">
                                                <i class="bi bi-trash me-1"></i> Supprimer ce fichier
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Options -->
                            <div class="col-12">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="brouillon" name="brouillon" value="1">
                                    <label class="form-check-label fw-bold" for="brouillon">
                                        <i class="bi bi-save me-2"></i>Sauvegarder comme brouillon
                                    </label>
                                    <div class="form-text text-muted">
                                        Si coché, votre contribution sera sauvegardée comme brouillon et non soumise pour validation.
                                    </div>
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input @error('terms') is-invalid @enderror"
                                           type="checkbox"
                                           id="terms"
                                           name="terms"
                                           value="1"
                                           required>
                                    <label class="form-check-label" for="terms">
                                        <i class="bi bi-shield-check me-2"></i>
                                        Je certifie que les informations fournies sont exactes et que j'ai le droit de partager ce contenu.
                                        Je comprends que ma contribution sera examinée par l'équipe de modération avant publication.
                                    </label>
                                    @error('terms')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                            <a href="{{ route('dashboard.index') }}" class="btn btn-outline-secondary px-4 py-2">
                                <i class="bi bi-arrow-left me-2"></i>Retour au tableau de bord
                            </a>

                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary px-4 py-2" id="saveDraftBtn">
                                    <i class="bi bi-save me-2"></i>Sauvegarder comme brouillon
                                </button>
                                <button type="submit" class="btn btn-primary px-5 py-2" id="submitBtn">
                                    <i class="bi bi-send me-2"></i>Soumettre pour validation
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Conseils -->
            <div class="card border-0 shadow-sm mt-5">
                <div class="card-header bg-light">
                    <h4 class="mb-0 text-primary">
                        <i class="bi bi-lightbulb-fill me-2"></i>
                        Conseils pour une bonne contribution
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success fs-5 me-3 mt-1"></i>
                                <div>
                                    <h6 class="fw-bold">Soyez précis</h6>
                                    <p class="text-muted mb-0">Mentionnez les noms exacts, dates, lieux, personnes concernées.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success fs-5 me-3 mt-1"></i>
                                <div>
                                    <h6 class="fw-bold">Citez vos sources</h6>
                                    <p class="text-muted mb-0">Livres, personnes interviewées, archives consultées, etc.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success fs-5 me-3 mt-1"></i>
                                <div>
                                    <h6 class="fw-bold">Respectez les droits</h6>
                                    <p class="text-muted mb-0">Assurez-vous d'avoir le droit de partager les textes et médias.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success fs-5 me-3 mt-1"></i>
                                <div>
                                    <h6 class="fw-bold">Soignez la qualité</h6>
                                    <p class="text-muted mb-0">Photos nettes, texte clair et bien structuré.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-question-circle me-2"></i>
                    Confirmation
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-5">
                <i class="bi bi-check-circle display-1 text-primary mb-4"></i>
                <h4 class="mb-3" id="modalTitle">Êtes-vous sûr ?</h4>
                <p id="modalMessage" class="text-muted mb-0"></p>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Annuler
                </button>
                <button type="button" class="btn btn-primary px-4" id="confirmSubmit">
                    <i class="bi bi-check-circle me-2"></i>Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Éléments DOM
    const form = document.getElementById('contributionForm');
    const texteInput = document.getElementById('texte');
    const charCount = document.getElementById('charCount');
    const mediaInput = document.getElementById('media_file');
    const previewContainer = document.getElementById('previewContainer');
    const mediaPreview = document.getElementById('mediaPreview');
    const removeMediaBtn = document.getElementById('removeMedia');
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    const submitBtn = document.getElementById('submitBtn');
    const brouillonCheckbox = document.getElementById('brouillon');
    const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    const confirmSubmitBtn = document.getElementById('confirmSubmit');

    // Variables
    let isDraft = false;

    // 1. Compteur de caractères
    texteInput.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count;

        if (count < 50) {
            charCount.classList.add('text-danger');
            charCount.classList.remove('text-success');
        } else {
            charCount.classList.remove('text-danger');
            charCount.classList.add('text-success');
        }
    });

    // Initialiser le compteur
    charCount.textContent = texteInput.value.length;

    // 2. Prévisualisation des médias
    mediaInput.addEventListener('change', function() {
        previewContainer.innerHTML = '';
        mediaPreview.style.display = 'none';

        if (this.files && this.files[0]) {
            const file = this.files[0];

            // Vérifier la taille
            const maxSize = 100 * 1024 * 1024; // 100MB
            if (file.size > maxSize) {
                alert('Le fichier est trop volumineux. Taille maximale : 100MB');
                this.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                if (file.type.startsWith('image/')) {
                    previewContainer.innerHTML = `
                        <img src="${e.target.result}" class="img-fluid rounded"
                             alt="Aperçu" style="max-height: 300px;">
                        <div class="mt-3">
                            <p class="mb-1"><strong>Image :</strong> ${file.name}</p>
                            <p class="mb-0 text-muted"><small>Taille : ${(file.size / 1024 / 1024).toFixed(2)} MB</small></p>
                        </div>
                    `;
                } else if (file.type.startsWith('video/')) {
                    previewContainer.innerHTML = `
                        <video controls class="w-100 rounded" style="max-height: 300px;">
                            <source src="${e.target.result}" type="${file.type}">
                            Votre navigateur ne supporte pas la lecture vidéo.
                        </video>
                        <div class="mt-3">
                            <p class="mb-1"><strong>Vidéo :</strong> ${file.name}</p>
                            <p class="mb-0 text-muted"><small>Taille : ${(file.size / 1024 / 1024).toFixed(2)} MB</small></p>
                        </div>
                    `;
                } else if (file.type.startsWith('audio/')) {
                    previewContainer.innerHTML = `
                        <audio controls class="w-100">
                            <source src="${e.target.result}" type="${file.type}">
                            Votre navigateur ne supporte pas la lecture audio.
                        </audio>
                        <div class="mt-3">
                            <p class="mb-1"><strong>Audio :</strong> ${file.name}</p>
                            <p class="mb-0 text-muted"><small>Taille : ${(file.size / 1024 / 1024).toFixed(2)} MB</small></p>
                        </div>
                    `;
                } else {
                    previewContainer.innerHTML = `
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <p class="mb-1"><strong>Fichier :</strong> ${file.name}</p>
                            <p class="mb-0"><strong>Taille :</strong> ${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                        </div>
                    `;
                }
                mediaPreview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        }
    });

    // 3. Supprimer le média
    removeMediaBtn.addEventListener('click', function() {
        mediaInput.value = '';
        previewContainer.innerHTML = '';
        mediaPreview.style.display = 'none';
    });

    // 4. Gestion brouillon/soumission
    saveDraftBtn.addEventListener('click', function() {
        isDraft = true;
        brouillonCheckbox.checked = true;

        document.getElementById('modalTitle').textContent = 'Sauvegarder comme brouillon';
        document.getElementById('modalMessage').textContent =
            'Votre contribution sera sauvegardée comme brouillon. Vous pourrez la modifier et la soumettre plus tard.';

        confirmationModal.show();
    });

    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();
        isDraft = false;
        brouillonCheckbox.checked = false;

        // Validation
        const titre = document.getElementById('titre').value.trim();
        const texte = texteInput.value.trim();

        if (!titre || !texte) {
            alert('Veuillez remplir tous les champs obligatoires (*)');
            return;
        }

        if (texte.length < 50) {
            alert('Le contenu doit contenir au moins 50 caractères');
            return;
        }

        if (!document.getElementById('terms').checked) {
            alert('Veuillez accepter les conditions d\'utilisation');
            return;
        }

        document.getElementById('modalTitle').textContent = 'Soumettre pour validation';
        document.getElementById('modalMessage').textContent =
            'Votre contribution sera soumise à notre équipe de modération. Elle sera examinée avant publication.';

        confirmationModal.show();
    });

    // 5. Confirmation finale
    confirmSubmitBtn.addEventListener('click', function() {
        confirmationModal.hide();

        if (isDraft) {
            const draftInput = document.createElement('input');
            draftInput.type = 'hidden';
            draftInput.name = 'is_draft';
            draftInput.value = '1';
            form.appendChild(draftInput);
        }

        // Désactiver les boutons pendant la soumission
        saveDraftBtn.disabled = true;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Soumission en cours...';

        // Soumettre le formulaire
        form.submit();
    });
});
</script>

<style>
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    .form-control-lg {
        padding: 0.75rem 1rem;
        font-size: 1.1rem;
    }

    .form-text {
        font-size: 0.875rem;
    }

    #charCount {
        font-weight: bold;
        font-size: 0.95rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        background-color: #f8f9fa;
    }

    .text-danger {
        color: #dc3545 !important;
        background-color: rgba(220, 53, 69, 0.1);
    }

    .text-success {
        color: #198754 !important;
        background-color: rgba(25, 135, 84, 0.1);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 500;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
    }

    .btn-outline-primary {
        padding: 0.75rem 2rem;
        font-weight: 500;
    }

    .btn-outline-secondary {
        padding: 0.75rem 2rem;
        font-weight: 500;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        margin-bottom: 0.5rem;
        color: #2c3e50;
    }

    .card {
        border-radius: 1rem;
        overflow: hidden;
    }

    .card-header {
        border-bottom: none;
    }
</style>
@endsection
