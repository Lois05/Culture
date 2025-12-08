<?php
// app/Http/Controllers/ContenuController.php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Media;
use App\Models\Region;
use App\Models\Langue;
use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Achat;

class ContenuController extends Controller
{
    /**
     * Vérifier les permissions
     */
    private function userHasRole($roles)
    {
        $user = Auth::user();
        if ($user && $user->role && $user->role->nom_role) {
            return in_array($user->role->nom_role, (array)$roles);
        }
        return false;
    }

    private function userIsAdminOrModerator()
    {
        return $this->userHasRole(['Administrateur', 'Modérateur']);
    }

    /**
     * Liste des contenus
     */
    public function index()
    {
        $user = Auth::user();

        if ($this->userHasRole('Contributeur') && !$this->userIsAdminOrModerator()) {
            $contenus = Contenu::with(['medias', 'region', 'langue', 'typeContenu', 'auteur'])
                              ->where('id_auteur', $user->id)
                              ->latest('date_creation')
                              ->get();
        } else {
            $contenus = Contenu::with(['medias', 'region', 'langue', 'typeContenu', 'auteur'])
                              ->latest('date_creation')
                              ->get();
        }

        return view('contenus.index', compact('contenus'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        if (!$this->userHasRole(['Administrateur', 'Modérateur', 'Contributeur'])) {
            abort(403, 'Vous n\'êtes pas autorisé à créer des contenus.');
        }

        $regions = Region::all();
        $langues = Langue::all();
        $typesContenu = TypeContenu::all();

        return view('contenus.create', compact('regions', 'langues', 'typesContenu'));
    }

    /**
     * STORE - NOUVELLE MÉTHODE CORRIGÉE
     */
    public function store(Request $request)
    {
        Log::info('=== DÉBUT STORE CONTENU ===');
        Log::info('Données reçues:', $request->except(['_token', 'media_file']));

        // Règles de validation AVANT le fichier pour éviter les erreurs de taille
        $rules = [
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'description' => 'nullable|string',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'statut' => 'nullable|in:en attente,validé,rejeté',
        ];

        // Validation initiale
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::error('Validation échouée', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Vérifier si un fichier est présent
        if (!$request->hasFile('media_file')) {
            Log::error('Aucun fichier média détecté');
            return redirect()->back()
                ->withInput()
                ->with('error', 'Un fichier média est requis.');
        }

        $mediaFile = $request->file('media_file');

        // Vérifier la taille du fichier MANUELLEMENT avant Laravel
        $maxSize = 100 * 1024 * 1024; // 100MB en bytes
        if ($mediaFile->getSize() > $maxSize) {
            Log::error('Fichier trop volumineux: ' . ($mediaFile->getSize() / 1024 / 1024) . 'MB');
            return redirect()->back()
                ->withInput()
                ->with('error', 'Le fichier est trop volumineux (max: 100MB)');
        }

        // Liste exhaustive des extensions autorisées
        $allowedExtensions = [
            // Images
            'jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg',
            // Vidéos
            'mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm', 'mpg', 'mpeg', '3gp', 'm4v',
            // Audio
            'mp3', 'wav', 'ogg', 'aac', 'flac', 'm4a', 'wma'
        ];

        $extension = strtolower($mediaFile->getClientOriginalExtension());

        if (!in_array($extension, $allowedExtensions)) {
            Log::error('Extension non autorisée: ' . $extension);
            return redirect()->back()
                ->withInput()
                ->with('error', "L'extension .{$extension} n'est pas supportée.");
        }

        try {
            // Créer le contenu D'ABORD
            $contenu = Contenu::create([
                'titre' => $request->titre,
                'texte' => $request->texte,
                'description' => $request->description,
                'id_type_contenu' => $request->id_type_contenu,
                'id_region' => $request->id_region,
                'id_langue' => $request->id_langue,
                'id_auteur' => auth()->id(),
                'statut' => $request->statut ?? 'en attente',
                'date_creation' => now(),
            ]);

            Log::info('Contenu créé avec ID: ' . $contenu->id_contenu);

            // Gestion du fichier média
            $originalName = pathinfo($mediaFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName = Str::slug($originalName);
            $fileName = $safeName . '_' . time() . '.' . $extension;

            // Créer le dossier si nécessaire
            $destinationPath = public_path('adminlte/img');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Déplacer le fichier
            $mediaFile->move($destinationPath, $fileName);
            $path = 'adminlte/img/' . $fileName;

            Log::info('Fichier stocké: ' . $path);

            // Déterminer le type de média
            $mimeType = $mediaFile->getMimeType();

            // Types vidéo
            $videoMimes = ['video/mp4', 'video/avi', 'video/x-msvideo', 'video/quicktime',
                          'video/x-ms-wmv', 'video/x-flv', 'video/x-matroska', 'video/webm',
                          'video/mpeg', 'video/3gpp', 'video/mp2t'];

            // Types audio
            $audioMimes = ['audio/mpeg', 'audio/x-wav', 'audio/wav', 'audio/ogg',
                          'audio/aac', 'audio/flac', 'audio/x-m4a', 'audio/x-ms-wma'];

            if (in_array($mimeType, $videoMimes) || in_array($extension, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm', 'mpg', 'mpeg', '3gp'])) {
                $id_type_media = 2; // Vidéo
                Log::info('Type détecté: VIDÉO');
            } elseif (in_array($mimeType, $audioMimes) || in_array($extension, ['mp3', 'wav', 'ogg', 'aac', 'flac', 'm4a', 'wma'])) {
                $id_type_media = 3; // Audio
                Log::info('Type détecté: AUDIO');
            } else {
                $id_type_media = 1; // Image
                Log::info('Type détecté: IMAGE');
            }

            // Créer l'enregistrement média
            Media::create([
                'chemin' => $path,
                'description' => $request->media_description ?? 'Média: ' . $request->titre,
                'id_contenu' => $contenu->id_contenu,
                'id_type_media' => $id_type_media,
            ]);

            Log::info('Média enregistré avec succès');
            Log::info('=== STORE RÉUSSI ===');

            return redirect()->route('contenus.index')
                ->with('success', 'Contenu créé avec succès!');

        } catch (\Exception $e) {
            Log::error('Erreur store: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    /**
     * Afficher un contenu
     */
    public function show($id)
    {
        try {
            $contenu = Contenu::with([
                'medias',
                'region',
                'langue',
                'typeContenu',
                'auteur'
            ])->findOrFail($id);

            return view('contenus.show', compact('contenu'));

        } catch (\Exception $e) {
            Log::error('Erreur show: ' . $e->getMessage());
            return redirect()->route('contenus.index')
                ->with('error', 'Contenu non trouvé');
        }
    }

    /**
     * Formulaire d'édition
     */
    public function edit($id)
    {
        try {
            $contenu = Contenu::with('medias')->findOrFail($id);
            $user = Auth::user();

            // Vérifier les permissions
            if ($contenu->id_auteur !== $user->id && !$this->userIsAdminOrModerator()) {
                abort(403, 'Vous n\'êtes pas autorisé à modifier ce contenu.');
            }

            $regions = Region::all();
            $langues = Langue::all();
            $typesContenu = TypeContenu::all();

            return view('contenus.edit', compact('contenu', 'regions', 'langues', 'typesContenu'));

        } catch (\Exception $e) {
            Log::error('Erreur edit: ' . $e->getMessage());
            return redirect()->route('contenus.index')
                ->with('error', 'Contenu non trouvé');
        }
    }

    /**
     * UPDATE - MÉTHODE CORRIGÉE
     */
    public function update(Request $request, $id)
    {
        Log::info('=== DÉBUT UPDATE CONTENU ID: ' . $id . ' ===');

        try {
            $contenu = Contenu::findOrFail($id);
            $user = Auth::user();

            // Vérifier les permissions
            if ($contenu->id_auteur !== $user->id && !$this->userIsAdminOrModerator()) {
                abort(403, 'Vous n\'êtes pas autorisé à modifier ce contenu.');
            }

            // Règles de validation
            $rules = [
                'titre' => 'required|string|max:255',
                'texte' => 'required|string',
                'description' => 'nullable|string',
                'id_region' => 'required|exists:regions,id_region',
                'id_langue' => 'required|exists:langues,id_langue',
                'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
                'statut' => 'nullable|in:en attente,validé,rejeté',
            ];

            // Validation initiale
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                Log::error('Validation échouée', $validator->errors()->toArray());
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Mise à jour du contenu
            $updateData = [
                'titre' => $request->titre,
                'texte' => $request->texte,
                'description' => $request->description,
                'id_region' => $request->id_region,
                'id_langue' => $request->id_langue,
                'id_type_contenu' => $request->id_type_contenu,
            ];

            if ($this->userIsAdminOrModerator() && $request->has('statut')) {
                $updateData['statut'] = $request->statut;
            }

            $contenu->update($updateData);
            Log::info('Contenu mis à jour');

            // GESTION DU FICHIER
            $hasNewFile = $request->hasFile('media_file');
            $removeMedia = $request->has('remove_media') && $request->remove_media == '1';

            if ($hasNewFile || $removeMedia) {
                // Supprimer l'ancien média
                $oldMedias = $contenu->medias;
                foreach ($oldMedias as $oldMedia) {
                    if ($oldMedia->chemin && file_exists(public_path($oldMedia->chemin))) {
                        unlink(public_path($oldMedia->chemin));
                        Log::info('Ancien média supprimé: ' . $oldMedia->chemin);
                    }
                }
                $contenu->medias()->delete();
                Log::info('Anciens médias supprimés');
            }

            // Ajouter un nouveau fichier si fourni
            if ($hasNewFile && !$removeMedia) {
                $mediaFile = $request->file('media_file');

                // Vérifications
                $maxSize = 100 * 1024 * 1024;
                if ($mediaFile->getSize() > $maxSize) {
                    throw new \Exception('Fichier trop volumineux (max: 100MB)');
                }

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg',
                                     'mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm', 'mpg', 'mpeg', '3gp',
                                     'mp3', 'wav', 'ogg', 'aac', 'flac', 'm4a', 'wma'];

                $extension = strtolower($mediaFile->getClientOriginalExtension());
                if (!in_array($extension, $allowedExtensions)) {
                    throw new \Exception("Extension .{$extension} non supportée");
                }

                // Préparer le nom du fichier
                $originalName = pathinfo($mediaFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeName = Str::slug($originalName);
                $fileName = $safeName . '_' . time() . '.' . $extension;

                // Déplacer le fichier
                $destinationPath = public_path('adminlte/img');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $mediaFile->move($destinationPath, $fileName);
                $path = 'adminlte/img/' . $fileName;
                Log::info('Nouveau fichier stocké: ' . $path);

                // Déterminer le type
                $mimeType = $mediaFile->getMimeType();
                $isVideo = str_starts_with($mimeType, 'video/') || in_array($extension, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm', 'mpg', 'mpeg', '3gp']);
                $isAudio = str_starts_with($mimeType, 'audio/') || in_array($extension, ['mp3', 'wav', 'ogg', 'aac', 'flac', 'm4a', 'wma']);

                $id_type_media = $isVideo ? 2 : ($isAudio ? 3 : 1);

                // Créer le nouveau média
                Media::create([
                    'chemin' => $path,
                    'description' => $request->media_description ?? 'Média: ' . $request->titre,
                    'id_contenu' => $contenu->id_contenu,
                    'id_type_media' => $id_type_media,
                ]);

                Log::info('Nouveau média enregistré');
            }

            Log::info('=== UPDATE RÉUSSI ===');

            return redirect()->route('contenus.index')
                ->with('success', 'Contenu modifié avec succès');

        } catch (\Exception $e) {
            Log::error('Erreur update: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    /**
     * Supprimer un contenu
     */
    public function destroy($id)
    {
        try {
            $contenu = Contenu::findOrFail($id);
            $user = Auth::user();

            if ($contenu->id_auteur !== $user->id && !$this->userHasRole(['Administrateur'])) {
                abort(403, 'Vous n\'êtes pas autorisé à supprimer ce contenu.');
            }

            // Supprimer les fichiers physiques
            $medias = $contenu->medias;
            foreach ($medias as $media) {
                if ($media->chemin && file_exists(public_path($media->chemin))) {
                    unlink(public_path($media->chemin));
                    Log::info('Fichier supprimé: ' . $media->chemin);
                }
            }

            // Supprimer de la base
            $contenu->medias()->delete();
            $contenu->delete();

            return redirect()->route('contenus.index')
                ->with('success', 'Contenu supprimé avec succès');

        } catch (\Exception $e) {
            Log::error('Erreur destroy: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression');
        }
    }
}
