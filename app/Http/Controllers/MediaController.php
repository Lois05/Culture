<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Contenu;
use App\Models\TypeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    /**
     * Afficher le formulaire d'upload
     */
    public function create()
    {
        $contenus = Contenu::where('statut', 'validé')->get();
        $types = TypeMedia::all();

        return view('medias.create', compact('contenus', 'types'));
    }

    /**
     * Stocker le média - CORRIGÉ POUR public/adminlte/img
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'media_file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4,avi,mov,mp3,wav,ogg|max:102400',
            'description' => 'nullable|string|max:500',
            'id_type_media' => 'required|exists:type_medias,id_type_media',
            'id_contenu' => 'required|exists:contenus,id_contenu'
        ]);

        try {
            $file = $request->file('media_file');
            $contenu = Contenu::findOrFail($request->id_contenu);

            // Nom de fichier unique
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $originalName) . '.' . $extension;

            // Sauvegarder dans public/adminlte/img
            $destinationPath = public_path('adminlte/img');

            // Créer le dossier s'il n'existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Déplacer le fichier
            $file->move($destinationPath, $fileName);

            // Chemin à sauvegarder (juste le nom du fichier)
            $chemin = $fileName;

            // Créer le média
            Media::create([
                'chemin' => $chemin,
                'description' => $request->description,
                'id_contenu' => $request->id_contenu,
                'id_type_media' => $request->id_type_media,
            ]);

            return redirect()->route('medias.index')
                ->with('success', '✅ Média uploadé avec succès !')
                ->with('new_file', $fileName);

        } catch (\Exception $e) {
            Log::error('Erreur upload: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', '❌ Erreur lors de l\'upload: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Liste des médias
     */
    public function index()
    {
        $medias = Media::with(['contenu', 'typeMedia'])
                       ->orderBy('id_media', 'desc')
                       ->get();

        return view('medias.index', compact('medias'));
    }

    /**
     * Afficher un média
     */
    public function show($id)
    {
        $media = Media::with(['contenu', 'typeMedia'])->findOrFail($id);
        return view('medias.show', compact('media'));
    }

    /**
     * Modifier un média
     */
    public function edit($id)
    {
        try {
            $media = Media::findOrFail($id);
            $typesMedia = TypeMedia::all();
            $contenus = Contenu::all();

            return view('medias.edit', compact('media', 'typesMedia', 'contenus'));

        } catch (\Exception $e) {
            Log::error('Erreur édition: ' . $e->getMessage());
            return redirect()->route('medias.index')
                             ->with('error', 'Média non trouvé');
        }
    }

    /**
     * Mettre à jour un média
     */
    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $rules = [
            'description' => 'nullable|string|max:500',
            'id_type_media' => 'required|exists:type_medias,id_type_media',
            'id_contenu' => 'required|exists:contenus,id_contenu'
        ];

        if ($request->hasFile('media_file')) {
            $rules['media_file'] = 'file|mimes:jpg,jpeg,png,gif,webp,mp4,avi,mov,mp3,wav,ogg|max:102400';
        }

        $request->validate($rules);

        try {
            // Si nouveau fichier fourni
            if ($request->hasFile('media_file')) {
                // Supprimer l'ancien fichier
                $oldFile = public_path('adminlte/img/' . $media->chemin);
                if (file_exists($oldFile) && is_file($oldFile)) {
                    @unlink($oldFile);
                }

                // Uploader le nouveau
                $file = $request->file('media_file');
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $originalName) . '.' . $extension;

                $file->move(public_path('adminlte/img'), $fileName);
                $media->chemin = $fileName;
            }

            // Mettre à jour les autres infos
            $media->description = $request->description;
            $media->id_contenu = $request->id_contenu;
            $media->id_type_media = $request->id_type_media;
            $media->save();

            return redirect()->route('medias.index')
                ->with('success', '✅ Média modifié avec succès !');

        } catch (\Exception $e) {
            Log::error('Erreur update: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', '❌ Erreur lors de la modification: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Supprimer un média
     */
    public function destroy($id)
    {
        try {
            $media = Media::findOrFail($id);

            // Supprimer le fichier physique
            $filePath = public_path('adminlte/img/' . $media->chemin);
            if (file_exists($filePath) && is_file($filePath)) {
                @unlink($filePath);
            }

            $media->delete();

            return redirect()->route('medias.index')
                ->with('success', '🗑️ Média supprimé avec succès !');

        } catch (\Exception $e) {
            Log::error('Erreur suppression: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
}
