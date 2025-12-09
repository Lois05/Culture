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
    // Validation simple
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'texte' => 'required|string',
        'description' => 'nullable|string',
        'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
        'id_region' => 'required|exists:regions,id_region',
        'id_langue' => 'required|exists:langues,id_langue',
        'media_file' => 'required|file|max:102400', // 100MB
        'statut' => 'nullable|in:en attente,validé,rejeté',
    ]);

    try {
        // Créer le contenu
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

        // Gérer le fichier média
        if ($request->hasFile('media_file')) {
            $mediaFile = $request->file('media_file');

            // Déterminer le type de média
            $extension = strtolower($mediaFile->getClientOriginalExtension());
            $mimeType = $mediaFile->getMimeType();

            if (str_starts_with($mimeType, 'video/')) {
                $id_type_media = 2; // Vidéo
            } elseif (str_starts_with($mimeType, 'audio/')) {
                $id_type_media = 3; // Audio
            } else {
                $id_type_media = 1; // Image
            }

            // Nom du fichier
            $fileName = time() . '_' . $mediaFile->getClientOriginalName();

            // Déplacer le fichier
            $destinationPath = public_path('adminlte/img');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $mediaFile->move($destinationPath, $fileName);
            $chemin = 'adminlte/img/' . $fileName;

            // Créer le média
            Media::create([
                'chemin' => $chemin,
                'description' => $request->media_description ?? 'Média: ' . $request->titre,
                'id_contenu' => $contenu->id_contenu,
                'id_type_media' => $id_type_media,
            ]);
        }

        return redirect()->route('contenus.index')->with('success', 'Contenu créé avec succès!');

    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Erreur: ' . $e->getMessage());
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
    $contenu = Contenu::with('medias')->findOrFail($id);

    // Validation
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'texte' => 'required|string',
        'description' => 'nullable|string',
        'id_region' => 'required|exists:regions,id_region',
        'id_langue' => 'required|exists:langues,id_langue',
        'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
        'media_file' => 'nullable|file|max:102400',
        'statut' => 'nullable|in:en attente,validé,rejeté',
    ]);

    try {
        // Mise à jour du contenu
        $contenu->update([
            'titre' => $request->titre,
            'texte' => $request->texte,
            'description' => $request->description,
            'id_region' => $request->id_region,
            'id_langue' => $request->id_langue,
            'id_type_contenu' => $request->id_type_contenu,
            'statut' => $request->statut ?? $contenu->statut,
        ]);

        // Gestion du fichier
        $removeMedia = $request->has('remove_media') && $request->remove_media == '1';
        $hasNewFile = $request->hasFile('media_file');

        if ($removeMedia || $hasNewFile) {
            // Supprimer l'ancien média
            $oldMedias = $contenu->medias;
            foreach ($oldMedias as $oldMedia) {
                if ($oldMedia->chemin && file_exists(public_path($oldMedia->chemin))) {
                    @unlink(public_path($oldMedia->chemin));
                }
            }
            $contenu->medias()->delete();
        }

        // Ajouter un nouveau fichier si fourni
        if ($hasNewFile && !$removeMedia) {
            $mediaFile = $request->file('media_file');

            // Déterminer le type
            $mimeType = $mediaFile->getMimeType();

            if (str_starts_with($mimeType, 'video/')) {
                $id_type_media = 2;
            } elseif (str_starts_with($mimeType, 'audio/')) {
                $id_type_media = 3;
            } else {
                $id_type_media = 1;
            }

            // Nom du fichier
            $fileName = time() . '_' . $mediaFile->getClientOriginalName();

            // Déplacer le fichier
            $destinationPath = public_path('adminlte/img');
            $mediaFile->move($destinationPath, $fileName);
            $chemin = 'adminlte/img/' . $fileName;

            // Créer le nouveau média
            Media::create([
                'chemin' => $chemin,
                'description' => $request->media_description ?? 'Média: ' . $request->titre,
                'id_contenu' => $contenu->id_contenu,
                'id_type_media' => $id_type_media,
            ]);
        }

        return redirect()->route('contenus.index')->with('success', 'Contenu modifié avec succès');

    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Erreur: ' . $e->getMessage());
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
