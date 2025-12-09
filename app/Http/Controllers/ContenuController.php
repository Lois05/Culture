<?php
// app/Http\Controllers/ContenuController.php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Media;
use App\Models\Region;
use App\Models\Langue;
use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ContenuController extends Controller
{
    /**
     * Liste des contenus
     */
    public function index()
    {
        $user = Auth::user();
        $isContributeur = $user->role && $user->role->nom_role === 'Contributeur';
        $isAdminOrModerator = $user->role && in_array($user->role->nom_role, ['Administrateur', 'Modérateur']);

        if ($isContributeur && !$isAdminOrModerator) {
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
        $regions = Region::all();
        $langues = Langue::all();
        $typesContenu = TypeContenu::all();

        return view('contenus.create', compact('regions', 'langues', 'typesContenu'));
    }

    /**
     * STORE - Version corrigée pour public/adminlte/img
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'description' => 'nullable|string',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'media_file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4,avi,mov,mp3,wav,ogg|max:102400',
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
                'statut' => 'en attente',
                'date_creation' => now(),
            ]);

            // Gérer le fichier média
            if ($request->hasFile('media_file')) {
                $file = $request->file('media_file');

                // Nom unique
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $originalName) . '.' . $extension;

                // Sauvegarder dans public/adminlte/img
                $destinationPath = public_path('adminlte/img');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $fileName);

                // Déterminer type
                $mimeType = $file->getMimeType();
                if (str_starts_with($mimeType, 'video/')) {
                    $id_type_media = 2;
                } elseif (str_starts_with($mimeType, 'audio/')) {
                    $id_type_media = 3;
                } else {
                    $id_type_media = 1;
                }

                // Créer média
                Media::create([
                    'chemin' => $fileName, // Juste le nom du fichier
                    'description' => $request->media_description ?? 'Média: ' . $request->titre,
                    'id_contenu' => $contenu->id_contenu,
                    'id_type_media' => $id_type_media,
                ]);
            }

            return redirect()->route('admin.contenus.index')
                ->with('success', 'Contenu créé avec succès!');

        } catch (\Exception $e) {
            Log::error('Erreur store contenu: ' . $e->getMessage());
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
        $contenu = Contenu::with(['medias', 'region', 'langue', 'typeContenu', 'auteur'])->findOrFail($id);
        return view('contenus.show', compact('contenu'));
    }

    /**
     * Formulaire d'édition
     */
    public function edit($id)
    {
        $contenu = Contenu::with('medias')->findOrFail($id);
        $user = Auth::user();

        // Vérifier permissions
        if ($contenu->id_auteur !== $user->id &&
            !($user->role && in_array($user->role->nom_role, ['Administrateur', 'Modérateur']))) {
            abort(403, 'Non autorisé');
        }

        $regions = Region::all();
        $langues = Langue::all();
        $typesContenu = TypeContenu::all();

        return view('contenus.edit', compact('contenu', 'regions', 'langues', 'typesContenu'));
    }

    /**
     * UPDATE - Version corrigée
     */
    public function update(Request $request, $id)
    {
        $contenu = Contenu::with('medias')->findOrFail($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'description' => 'nullable|string',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4,avi,mov,mp3,wav,ogg|max:102400',
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
            ]);

            // Si nouveau fichier
            if ($request->hasFile('media_file')) {
                // Supprimer anciens médias
                foreach ($contenu->medias as $media) {
                    if ($media->chemin) {
                        $oldPath = public_path('adminlte/img/' . $media->chemin);
                        if (file_exists($oldPath)) {
                            @unlink($oldPath);
                        }
                    }
                }
                $contenu->medias()->delete();

                // Ajouter nouveau
                $file = $request->file('media_file');
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $originalName) . '.' . $extension;

                $file->move(public_path('adminlte/img'), $fileName);

                // Déterminer type
                $mimeType = $file->getMimeType();
                if (str_starts_with($mimeType, 'video/')) {
                    $id_type_media = 2;
                } elseif (str_starts_with($mimeType, 'audio/')) {
                    $id_type_media = 3;
                } else {
                    $id_type_media = 1;
                }

                Media::create([
                    'chemin' => $fileName,
                    'description' => $request->media_description ?? 'Média: ' . $request->titre,
                    'id_contenu' => $contenu->id_contenu,
                    'id_type_media' => $id_type_media,
                ]);
            }

            return redirect()->route('admin.contenus.index')
                ->with('success', 'Contenu modifié avec succès');

        } catch (\Exception $e) {
            Log::error('Erreur update contenu: ' . $e->getMessage());
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
        $contenu = Contenu::findOrFail($id);
        $user = Auth::user();

        // Vérifier permissions
        if ($contenu->id_auteur !== $user->id &&
            !($user->role && $user->role->nom_role === 'Administrateur')) {
            abort(403, 'Non autorisé');
        }

        try {
            // Supprimer fichiers
            foreach ($contenu->medias as $media) {
                if ($media->chemin) {
                    $path = public_path('adminlte/img/' . $media->chemin);
                    if (file_exists($path)) {
                        @unlink($path);
                    }
                }
            }

            // Supprimer de la base
            $contenu->medias()->delete();
            $contenu->delete();

            return redirect()->route('admin.contenus.index')
                ->with('success', 'Contenu supprimé avec succès');

        } catch (\Exception $e) {
            Log::error('Erreur destroy: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression');
        }
    }

    /**
     * Valider un contenu
     */
    public function valider($id)
    {
        $contenu = Contenu::findOrFail($id);
        $contenu->update(['statut' => 'validé']);

        return redirect()->route('admin.contenus.index')
            ->with('success', 'Contenu validé avec succès');
    }

    /**
     * Rejeter un contenu
     */
    public function rejeter($id)
    {
        $contenu = Contenu::findOrFail($id);
        $contenu->update(['statut' => 'rejeté']);

        return redirect()->route('admin.contenus.index')
            ->with('success', 'Contenu rejeté');
    }
}
