@extends('layouts.layout')

@section('content')
<main class="app-main">
    <div class="container mt-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-image"></i> Ajouter une Image au Contenu</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('medias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- SECTION UPLOAD - CHOISIR UNE IMAGE DEPUIS L'ORDINATEUR -->
                    <div class="upload-section mb-4">
                        <label class="form-label fw-bold h5">📷 Choisir une image :</label>

                        <div class="file-upload-area p-4 text-center">
                            <i class="bi bi-cloud-upload display-4 text-muted mb-3"></i>
                            <p class="text-muted">Glissez-déposez votre image ici ou cliquez pour parcourir</p>
                            <input type="file" class="form-control d-none" name="media_file" id="mediaFile"
                                   accept="image/*" required>
                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('mediaFile').click()">
                                <i class="bi bi-folder2-open"></i> Parcourir mes fichiers
                            </button>
                            <div class="form-text mt-2">
                                Formats supportés : JPG, JPEG, PNG, GIF • Max 5MB
                            </div>
                        </div>

                        <!-- APERÇU DE L'IMAGE SÉLECTIONNÉE -->
                        <div id="imagePreview" class="mt-4 text-center" style="display: none;">
                            <h6>Aperçu de l'image :</h6>
                            <div class="preview-container position-relative d-inline-block">
                                <img id="preview" class="img-thumbnail shadow" style="max-height: 300px; max-width: 100%;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                        onclick="clearImage()" title="Changer d'image">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            <div id="fileInfo" class="mt-2 text-muted small"></div>
                        </div>
                    </div>

                    <!-- INFORMATIONS SUPPLÉMENTAIRES -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Contenu associé :</label>
                                <select name="id_contenu" class="form-select" required>
                                    <option value="">Sélectionner un contenu...</option>
                                    @foreach($contenus as $contenu)
                                        <option value="{{ $contenu->id_contenu }}">{{ $contenu->titre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Type de média :</label>
                                <select name="id_type_media" class="form-select" required>
                                    <option value="">Sélectionner un type...</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id_type_media }}">{{ $type->nom_media }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description (optionnelle) :</label>
                        <textarea class="form-control" name="description" rows="3"
                                  placeholder="Décrivez brièvement cette image..."></textarea>
                    </div>

                    <!-- BOUTONS -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('medias.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Retour à la liste
                        </a>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-check-circle"></i> Ajouter l'image au contenu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
// Éléments DOM
const fileInput = document.getElementById('mediaFile');
const preview = document.getElementById('preview');
const imagePreview = document.getElementById('imagePreview');
const fileInfo = document.getElementById('fileInfo');

// Quand on clique sur la zone d'upload
document.querySelector('.file-upload-area').addEventListener('click', function(e) {
    if (e.target !== fileInput) {
        fileInput.click();
    }
});

// Glisser-déposer
document.querySelector('.file-upload-area').addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('drag-over');
});

document.querySelector('.file-upload-area').addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.classList.remove('drag-over');
});

document.querySelector('.file-upload-area').addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('drag-over');

    if (e.dataTransfer.files.length > 0) {
        fileInput.files = e.dataTransfer.files;
        handleFileSelection(e.dataTransfer.files[0]);
    }
});

// Sélection de fichier via le input
fileInput.addEventListener('change', function(e) {
    if (this.files.length > 0) {
        handleFileSelection(this.files[0]);
    }
});

// Gérer la sélection de fichier
function handleFileSelection(file) {
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            imagePreview.style.display = 'block';

            // Afficher les infos du fichier
            fileInfo.innerHTML = `
                <strong>${file.name}</strong><br>
                Taille: ${formatFileSize(file.size)} • Type: ${file.type}
            `;
        }

        reader.readAsDataURL(file);
    } else {
        alert('Veuillez sélectionner une image valide (JPG, PNG, GIF)');
        fileInput.value = '';
    }
}

// Effacer l'image sélectionnée
function clearImage() {
    fileInput.value = '';
    imagePreview.style.display = 'none';
    fileInfo.innerHTML = '';
}

// Formater la taille du fichier
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Feedback visuel pour la zone d'upload
document.querySelectorAll('.file-upload-area').forEach(area => {
    area.addEventListener('mouseenter', function() {
        this.style.borderColor = '#0d6efd';
        this.style.backgroundColor = '#f8f9fa';
    });

    area.addEventListener('mouseleave', function() {
        this.style.borderColor = '#dee2e6';
        this.style.backgroundColor = '';
    });
});
</script>

<style>
.file-upload-area {
    border: 3px dashed #dee2e6;
    border-radius: 15px;
    background-color: #fafafa;
    transition: all 0.3s ease;
    cursor: pointer;
}

.file-upload-area:hover {
    border-color: #0d6efd;
    background-color: #f0f8ff;
}

.file-upload-area.drag-over {
    border-color: #198754;
    background-color: #f0fff4;
}

.preview-container {
    border-radius: 10px;
    overflow: hidden;
}

.preview-container img {
    transition: transform 0.3s ease;
}

.preview-container:hover img {
    transform: scale(1.02);
}

.btn-success {
    padding: 12px 30px;
    font-weight: 600;
}
</style>
@endsection
