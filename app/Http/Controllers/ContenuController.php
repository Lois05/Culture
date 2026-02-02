<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Media;
use App\Models\Region;
use App\Models\Langue;
use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ContenuController extends Controller
{
    /**
     * Liste des contenus
     */
    public function index()
    {
        $user = Auth::user();
        $userRole = $user ? optional($user->role)->nom_role : null;

        if (!in_array($userRole, ['Administrateur', 'Modérateur', 'Contributeur'])) {
            return redirect()->route('admin.tableaudebord')
                ->with('error', 'Accès non autorisé');
        }

        $query = Contenu::with([
            'medias' => function($q) {
                $q->select('id_media', 'chemin', 'id_contenu', 'id_type_media'); // RETIRÉ cloudinary_url
            },
            'medias.typeMedia',
            'region' => function($q) {
                $q->select('id_region', 'nom_region');
            },
            'langue' => function($q) {
                $q->select('id_langue', 'nom_langue');
            },
            'typeContenu' => function($q) {
                $q->select('id_type_contenu', 'nom_contenu');
            },
            'auteur' => function($q) {
                $q->select('id', 'name', 'email');
            }
        ]);

        if ($userRole === 'Contributeur') {
            $query->where('id_auteur', $user->id);
        }

        $contenus = $query->latest('date_creation')->get();

        // SUPPRIMÉ: Le code Cloudinary
        // foreach ($contenus as $contenu) {
        //     $contenu->image_url = \App\Helpers\CloudinaryHelper::getContentImage($contenu);
        // }

        $typesContenu = TypeContenu::all();

        return view('contenus.index', compact('contenus', 'typesContenu'));
    }

    /**
     * Gérer la requête DataTables AJAX
     */
    private function handleDatatableRequest(Request $request, $user, $userRole)
    {
        $query = $this->getContenusQuery($userRole, $user->id);

        // Total sans filtres
        $total = $query->count();

        // Recherche
        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where(function($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('statut', 'like', "%{$search}%");
            });
        }

        // Tri
        if ($request->has('order')) {
            $columnIndex = $request->order[0]['column'];
            $columnDir = $request->order[0]['dir'];

            $columns = ['id_contenu', 'titre', 'id_type_contenu', 'id_region',
                       'id_langue', 'statut', 'id_auteur', 'date_creation'];

            if (isset($columns[$columnIndex])) {
                $query->orderBy($columns[$columnIndex], $columnDir);
            } else {
                $query->orderBy('date_creation', 'desc');
            }
        }

        // Total filtré
        $filteredTotal = $query->count();

        // Pagination
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $contenus = $query->skip($start)->take($length)->get();

        // Préparer les données
        $data = [];
        foreach ($contenus as $contenu) {
            $data[] = [
                'DT_RowId' => 'row_' . $contenu->id_contenu,
                'id' => $contenu->id_contenu,
                'media' => $this->formatMedia($contenu),
                'titre' => $this->formatTitre($contenu),
                'type' => $this->formatType($contenu),
                'region' => $this->formatRegion($contenu),
                'langue' => $this->formatLangue($contenu),
                'statut' => $this->formatStatut($contenu),
                'auteur' => $this->formatAuteur($contenu),
                'date' => $this->formatDate($contenu),
                'actions' => $this->formatActions($contenu, $user, $userRole)
            ];
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $total,
            'recordsFiltered' => $filteredTotal,
            'data' => $data
        ]);
    }

    /**
     * Obtenir la requête de base selon le rôle
     */
    private function getContenusQuery($userRole, $userId)
    {
        $query = Contenu::with([
            'medias' => function($q) {
                $q->select('id_media', 'chemin', 'id_contenu', 'id_type_media');
            },
            'medias.typeMedia',
            'region' => function($q) {
                $q->select('id_region', 'nom_region');
            },
            'langue' => function($q) {
                $q->select('id_langue', 'nom_langue');
            },
            'typeContenu' => function($q) {
                $q->select('id_type_contenu', 'nom_contenu');
            },
            'auteur' => function($q) {
                $q->select('id', 'name', 'email');
            }
        ]);

        if ($userRole === 'Contributeur') {
            $query->where('id_auteur', $userId);
        }

        return $query;
    }

    /**
     * Formater le média pour DataTables - SANS CLOUDINARY
     */
    private function formatMedia($contenu)
    {
        if ($contenu->medias && $contenu->medias->count() > 0) {
            $media = $contenu->medias->first();
            $isVideo = isset($media->typeMedia) && $media->typeMedia->id_type_media == 2;
            $isAudio = isset($media->typeMedia) && $media->typeMedia->id_type_media == 3;

            // URL locale simple
            $localUrl = asset('adminlte/img/' . $media->chemin);

            if ($isVideo) {
                return '<div class="media-thumbnail video-thumbnail" onclick="window.open(\'' . $localUrl . '\', \'_blank\')" title="Voir la vidéo">
                            <i class="bi bi-play-circle-fill"></i>
                        </div>';
            } elseif ($isAudio) {
                return '<div class="media-thumbnail audio-thumbnail" onclick="window.open(\'' . $localUrl . '\', \'_blank\')" title="Écouter l\'audio">
                            <i class="bi bi-music-note-beamed"></i>
                        </div>';
            } else {
                return '<div class="media-thumbnail image-thumbnail" onclick="showImageModal(\'' . htmlspecialchars($localUrl) . '\', \'' . addslashes($contenu->titre) . '\')" title="Voir l\'image">
                            <img src="' . htmlspecialchars($localUrl) . '"
                                 alt="' . htmlspecialchars($contenu->titre) . '"
                                 onerror="this.onerror=null; this.src=\'' . asset('adminlte/img/default-content.jpg') . '\'">
                        </div>';
            }
        }

        // Aucun média - image par défaut locale
        return '<div class="media-thumbnail no-media" title="Aucun média">
                    <img src="' . asset('adminlte/img/default-content.jpg') . '"
                         alt="Pas d\'image"
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>';
    }

    /**
     * Formater le titre pour DataTables
     */
    private function formatTitre($contenu)
    {
        $titre = '<div class="contenu-info">
                    <a href="' . route('admin.contenus.show', $contenu->id_contenu) . '"
                       class="contenu-titre"
                       title="' . htmlspecialchars($contenu->titre) . '">
                        ' . Str::limit($contenu->titre, 40) . '
                    </a>';

        if ($contenu->description) {
            $titre .= '<div class="contenu-description text-muted small mt-1">
                        ' . Str::limit($contenu->description, 60) . '
                       </div>';
        }

        $titre .= '</div>';
        return $titre;
    }

    /**
     * Formater le type pour DataTables
     */
    private function formatType($contenu)
    {
        $type = $contenu->typeContenu->nom_contenu ?? 'Non défini';
        return '<span class="badge bg-dark badge-sm">' . Str::limit($type, 15) . '</span>';
    }

    /**
     * Formater la région pour DataTables
     */
    private function formatRegion($contenu)
    {
        $region = $contenu->region->nom_region ?? 'N/D';
        return '<span class="badge bg-info badge-sm">' . Str::limit($region, 10) . '</span>';
    }

    /**
     * Formater la langue pour DataTables
     */
    private function formatLangue($contenu)
    {
        $langue = $contenu->langue->nom_langue ?? 'N/D';
        return '<span class="badge bg-secondary badge-sm">' . Str::limit($langue, 10) . '</span>';
    }

    /**
     * Formater le statut pour DataTables
     */
    private function formatStatut($contenu)
    {
        switch($contenu->statut) {
            case 'validé':
                return '<span class="badge bg-success badge-sm">
                            <i class="bi bi-check-circle me-1"></i> Validé
                        </span>';
            case 'en attente':
                return '<span class="badge bg-warning text-dark badge-sm">
                            <i class="bi bi-clock me-1"></i> Attente
                        </span>';
            case 'rejeté':
                return '<span class="badge bg-danger badge-sm">
                            <i class="bi bi-x-circle me-1"></i> Rejeté
                        </span>';
            default:
                return '<span class="badge bg-secondary badge-sm">' . $contenu->statut . '</span>';
        }
    }

    /**
     * Formater l'auteur pour DataTables
     */
    private function formatAuteur($contenu)
    {
        $name = $contenu->auteur->name ?? 'Anonyme';
        $initial = strtoupper(substr($name, 0, 1));

        return '<div class="d-flex align-items-center">
                    <div class="avatar-sm me-2">' . $initial . '</div>
                    <div class="small">
                        <div class="fw-medium">' . Str::limit($name, 8) . '</div>
                    </div>
                </div>';
    }

    /**
     * Formater la date pour DataTables
     */
    private function formatDate($contenu)
    {
        if ($contenu->date_creation) {
            return '<div class="small text-muted">' .
                   \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') .
                   '</div>';
        }
        return '<div class="small text-muted">—</div>';
    }

    /**
     * Formater les actions pour DataTables
     */
    private function formatActions($contenu, $user, $userRole)
    {
        $isAdminOrModerator = in_array($userRole, ['Administrateur', 'Modérateur']);
        $userId = $user ? ($user->id ?? $user->getKey()) : null;
        $canEdit = $user && ($userId == $contenu->id_auteur || $isAdminOrModerator);
        $canDelete = $user && ($userId == $contenu->id_auteur || $userRole === 'Administrateur');

        $actions = '<div class="action-buttons">';

        // Voir
        $actions .= '<a href="' . route('admin.contenus.show', $contenu->id_contenu) . '"
                       class="btn btn-sm btn-outline-primary"
                       title="Voir"
                       data-bs-toggle="tooltip">
                        <i class="bi bi-eye"></i>
                    </a>';

        // Modifier
        if ($canEdit) {
            $actions .= '<a href="' . route('admin.contenus.edit', $contenu->id_contenu) . '"
                           class="btn btn-sm btn-outline-warning"
                           title="Modifier"
                           data-bs-toggle="tooltip">
                            <i class="bi bi-pencil"></i>
                        </a>';
        } else {
            $actions .= '<a href="#" class="btn btn-sm btn-outline-warning disabled" title="Modification non autorisée">
                            <i class="bi bi-pencil"></i>
                        </a>';
        }

        // Supprimer
        if ($canDelete) {
            $actions .= '<form action="' . route('admin.contenus.destroy', $contenu->id_contenu) . '"
                              method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    title="Supprimer"
                                    data-bs-toggle="tooltip"
                                    onclick="confirmDelete(' . $contenu->id_contenu . ', \'' . addslashes($contenu->titre) . '\')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>';
        } else {
            $actions .= '<button class="btn btn-sm btn-outline-danger disabled" title="Suppression non autorisée">
                            <i class="bi bi-trash"></i>
                        </button>';
        }

        // Menu dropdown pour actions supplémentaires
        $actions .= '<div class="dropdown d-inline-block">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
                                title="Plus d\'actions">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">';

        // Ajouter média
        $actions .= '<li>
                        <a class="dropdown-item"
                           href="' . route('admin.medias.create') . '?contenu_id=' . $contenu->id_contenu . '">
                            <i class="bi bi-image me-2"></i> Ajouter média
                        </a>
                    </li>';

        // Voir média
        if ($contenu->medias && $contenu->medias->count() > 0) {
            $actions .= '<li>
                            <a class="dropdown-item"
                               href="' . route('admin.medias.show', $contenu->medias->first()->id_media) . '">
                                <i class="bi bi-eye me-2"></i> Voir média
                            </a>
                        </li>';
        }

        // Modération rapide
        if (in_array($userRole, ['Administrateur', 'Modérateur'])) {
            $actions .= '<li><hr class="dropdown-divider"></li>';

            if ($contenu->statut != 'validé') {
                $actions .= '<li>
                                <form action="' . route('admin.contenus.valider', $contenu->id_contenu) . '"
                                      method="POST" class="d-inline">
                                    ' . csrf_field() . '
                                    <button type="submit" class="dropdown-item text-success">
                                        <i class="bi bi-check-circle me-2"></i> Valider
                                    </button>
                                </form>
                            </li>';
            }

            if ($contenu->statut != 'rejeté') {
                $actions .= '<li>
                                <form action="' . route('admin.contenus.rejeter', $contenu->id_contenu) . '"
                                      method="POST" class="d-inline">
                                    ' . csrf_field() . '
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-x-circle me-2"></i> Rejeter
                                    </button>
                                </form>
                            </li>';
            }
        }

        $actions .= '</ul></div></div>';

        return $actions;
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $user = Auth::user();
        $userRole = $user ? optional($user->role)->nom_role : null;

        if (!in_array($userRole, ['Administrateur', 'Modérateur', 'Contributeur'])) {
            return redirect()->route('admin.tableaudebord')
                ->with('error', 'Accès non autorisé');
        }

        $regions = Region::all();
        $langues = Langue::all();
        $typesContenu = TypeContenu::all();

        return view('contenus.create', compact('regions', 'langues', 'typesContenu'));
    }

    /**
     * STORE - Version simplifiée SANS CLOUDINARY
     */
    public function store(Request $request)
    {
        Log::info('=== STORE CONTENU SIMPLE ===');

        try {
            // Validation de base
            $request->validate([
                'titre' => 'required|string|max:255',
                'texte' => 'required|string|min:10',
                'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
                'id_region' => 'required|exists:regions,id_region',
                'id_langue' => 'required|exists:langues,id_langue',
            ]);

            // Créer contenu
            $contenu = Contenu::create([
                'titre' => $request->titre,
                'texte' => $request->texte,
                'description' => $request->description,
                'id_type_contenu' => $request->id_type_contenu,
                'id_region' => $request->id_region,
                'id_langue' => $request->id_langue,
                'id_auteur' => Auth::id(),
                'statut' => 'en attente',
                'date_creation' => now(),
            ]);

            // Gérer média si fourni
            if ($request->hasFile('media_file')) {
                $this->uploaderFichierSimple($request->file('media_file'), $request, $contenu);
            }

            return redirect()->route('admin.contenus.index')
                ->with('success', '✅ Contenu créé avec succès !');

        } catch (\Exception $e) {
            Log::error('Erreur store: ' . $e->getMessage());
            return back()->withInput()->with('error', '❌ Erreur: ' . $e->getMessage());
        }
    }

    /**
     * Afficher un contenu
     */
    public function show($id)
    {
        $contenu = Contenu::with(['medias', 'region', 'langue', 'typeContenu', 'auteur'])->findOrFail($id);

        $user = Auth::user();
        $userRole = optional($user->role)->nom_role;

        if ($contenu->id_auteur !== $user->id &&
            !in_array($userRole, ['Administrateur', 'Modérateur'])) {
            return redirect()->route('admin.contenus.index')
                ->with('error', 'Accès non autorisé');
        }

        return view('contenus.show', compact('contenu'));
    }

    /**
     * Formulaire d'édition
     */
    public function edit($id)
    {
        $contenu = Contenu::with('medias')->findOrFail($id);

        $user = Auth::user();
        $userRole = optional($user->role)->nom_role;

        if ($contenu->id_auteur !== $user->id &&
            !in_array($userRole, ['Administrateur', 'Modérateur'])) {
            return redirect()->route('admin.contenus.index')
                ->with('error', 'Accès non autorisé');
        }

        $regions = Region::all();
        $langues = Langue::all();
        $typesContenu = TypeContenu::all();

        return view('contenus.edit', compact('contenu', 'regions', 'langues', 'typesContenu'));
    }

    /**
     * UPDATE - Version simplifiée SANS CLOUDINARY
     */
    public function update(Request $request, $id)
    {
        Log::info('=== UPDATE CONTENU SIMPLE ===');

        $contenu = Contenu::with('medias')->findOrFail($id);

        // Vérifier les permissions
        $user = Auth::user();
        $userRole = optional($user->role)->nom_role;

        if ($contenu->id_auteur !== $user->id && !in_array($userRole, ['Administrateur', 'Modérateur'])) {
            return redirect()->route('admin.contenus.index')
                ->with('error', 'Accès non autorisé');
        }

        try {
            // Validation de base
            $request->validate([
                'titre' => 'required|string|max:255',
                'texte' => 'required|string|min:10',
                'description' => 'nullable|string|max:500',
                'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
                'id_region' => 'required|exists:regions,id_region',
                'id_langue' => 'required|exists:langues,id_langue',
                'statut' => $userRole && in_array($userRole, ['Administrateur', 'Modérateur'])
                    ? 'nullable|in:en attente,validé,rejeté'
                    : '',
            ]);

            // Mettre à jour le contenu
            $updateData = [
                'titre' => $request->titre,
                'texte' => $request->texte,
                'description' => $request->description,
                'id_type_contenu' => $request->id_type_contenu,
                'id_region' => $request->id_region,
                'id_langue' => $request->id_langue,
            ];

            if (in_array($userRole, ['Administrateur', 'Modérateur'])) {
                $updateData['statut'] = $request->statut ?? $contenu->statut;
            }

            $contenu->update($updateData);

            Log::info('Contenu mis à jour: ' . $contenu->id_contenu);

            // GESTION DES MÉDIAS - SANS CLOUDINARY
            $this->gererMediasSimple($request, $contenu);

            return redirect()->route('admin.contenus.index')
                ->with('success', '✅ Contenu modifié avec succès !');

        } catch (\Exception $e) {
            Log::error('Erreur update: ' . $e->getMessage());
            return back()->withInput()->with('error', '❌ Erreur: ' . $e->getMessage());
        }
    }

    /**
     * Gestion simple des médias - SANS CLOUDINARY
     */
    private function gererMediasSimple(Request $request, Contenu $contenu)
    {
        // 1. Supprimer le média si demandé
        if ($request->has('remove_media') && $request->remove_media == '1') {
            if ($contenu->medias->count() > 0) {
                foreach ($contenu->medias as $media) {
                    // Supprimer fichier physique
                    $filePath = public_path('adminlte/img/' . $media->chemin);
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                    // Supprimer de la base
                    $media->delete();
                }
                Log::info('Média supprimé pour contenu: ' . $contenu->id_contenu);
            }
        }

        // 2. Ajouter nouveau média si fourni
        if ($request->hasFile('media_file')) {
            $this->uploaderFichierSimple($request->file('media_file'), $request, $contenu);
        }
    }

    /**
     * Uploader fichier avec gestion manuelle - SANS CLOUDINARY
     */
    private function uploaderFichierSimple($file, Request $request, Contenu $contenu)
    {
        // Supprimer ancien média si existe
        if ($contenu->medias->count() > 0) {
            foreach ($contenu->medias as $media) {
                $filePath = public_path('adminlte/img/' . $media->chemin);
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
                $media->delete();
            }
        }

        // Vérifier taille (100MB max)
        if ($file->getSize() > 100 * 1024 * 1024) {
            throw new \Exception('Fichier trop volumineux. Maximum: 100MB');
        }

        // Générer nom sécurisé
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . uniqid() . '.' . $extension;
        $destination = public_path('adminlte/img/' . $fileName);

        Log::info('Upload fichier:', [
            'nom_original' => $file->getClientOriginalName(),
            'nom_final' => $fileName,
            'taille' => $file->getSize(),
            'type' => $file->getMimeType()
        ]);

        // Déplacer le fichier
        if (!$file->move(public_path('adminlte/img/'), $fileName)) {
            throw new \Exception('Impossible de déplacer le fichier uploadé');
        }

        // Déterminer type de média
        $typeMedia = 1; // Image par défaut
        if (strpos($file->getMimeType(), 'video/') === 0) {
            $typeMedia = 2;
        } elseif (strpos($file->getMimeType(), 'audio/') === 0) {
            $typeMedia = 3;
        }

        // Créer média
        Media::create([
            'chemin' => $fileName,
            'description' => $request->input('media_description', 'Média: ' . $contenu->titre),
            'id_contenu' => $contenu->id_contenu,
            'id_type_media' => $typeMedia,
            'type_fichier' => $file->getMimeType(),
            'taille' => $file->getSize(),
        ]);

        Log::info('Média uploadé avec succès: ' . $fileName);
    }

    /**
     * Supprimer un contenu
     */
    public function destroy($id)
    {
        $contenu = Contenu::with('medias')->findOrFail($id);

        $user = Auth::user();
        $userRole = optional($user->role)->nom_role;

        if ($contenu->id_auteur !== $user->id &&
            $userRole !== 'Administrateur') {
            return redirect()->route('admin.contenus.index')
                ->with('error', 'Accès non autorisé');
        }

        try {
            DB::beginTransaction();

            // Supprimer les fichiers médias
            foreach ($contenu->medias as $media) {
                if (!empty($media->chemin)) {
                    $cheminFichier = public_path('adminlte/img/' . $media->chemin);
                    if (file_exists($cheminFichier)) {
                        @unlink($cheminFichier);
                        Log::info('Fichier supprimé: ' . $cheminFichier);
                    }
                }
                $media->delete();
            }

            // Supprimer le contenu
            $contenu->delete();

            DB::commit();

            Log::info('Contenu supprimé, ID: ' . $id);

            return redirect()->route('admin.contenus.index')
                ->with('success', '✅ Contenu supprimé avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur suppression contenu: ' . $e->getMessage());
            return back()->with('error', '❌ Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    /**
     * Valider un contenu
     */
    public function valider($id)
    {
        $contenu = Contenu::findOrFail($id);

        $user = Auth::user();
        $userRole = optional($user->role)->nom_role;

        if (!in_array($userRole, ['Administrateur', 'Modérateur'])) {
            return redirect()->route('admin.contenus.index')
                ->with('error', 'Accès non autorisé');
        }

        $contenu->update([
            'statut' => 'validé',
            'id_moderateur' => $user->id,
        ]);

        Log::info('Contenu validé', ['contenu_id' => $id, 'moderateur_id' => $user->id]);

        return redirect()->route('admin.contenus.index')
            ->with('success', '✅ Contenu validé avec succès !');
    }

    /**
     * Rejeter un contenu
     */
    public function rejeter($id)
    {
        $contenu = Contenu::findOrFail($id);

        $user = Auth::user();
        $userRole = optional($user->role)->nom_role;

        if (!in_array($userRole, ['Administrateur', 'Modérateur'])) {
            return redirect()->route('admin.contenus.index')
                ->with('error', 'Accès non autorisé');
        }

        $contenu->update([
            'statut' => 'rejeté',
            'id_moderateur' => $user->id,
        ]);

        Log::info('Contenu rejeté', ['contenu_id' => $id, 'moderateur_id' => $user->id]);

        return redirect()->route('admin.contenus.index')
            ->with('success', '❌ Contenu rejeté.');
    }

    /**
     * Corriger les chemins des médias existants
     */
    public function fixMediaPaths()
    {
        $medias = Media::all();
        $fixed = 0;

        foreach ($medias as $media) {
            $oldPath = $media->chemin;
            $cleanPath = $oldPath;

            if (strpos($cleanPath, 'adminlte/img/') === 0) {
                $cleanPath = substr($cleanPath, strlen('adminlte/img/'));
            }

            $cleanPath = ltrim($cleanPath, '/');

            if ($cleanPath !== $oldPath) {
                $media->chemin = $cleanPath;
                $media->save();
                $fixed++;
                Log::info("Corrigé: {$oldPath} -> {$cleanPath}");
            }
        }

        return "Terminé ! {$fixed} chemins corrigés sur {$medias->count()} médias.";
    }
}
