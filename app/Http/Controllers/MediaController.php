<?php
// app/Http\Controllers\MediaController.php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Contenu;
use App\Models\TypeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
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
     * Formulaire de création
     */
    public function create()
    {
        $contenus = Contenu::where('statut', 'validé')->get();
        $types = TypeMedia::all();

        return view('medias.create', compact('contenus', 'types'));
    }

    /**
     * STORE - Version corrigée
     */
    public function store(Request $request)
    {
        $request->validate([
            'media_file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4,avi,mov,mp3,wav,ogg|max:102400',
            'description' => 'nullable|string|max:500',
            'id_type_media' => 'required|exists:type_medias,id_type_media',
            'id_contenu' => 'required|exists:contenus,id_contenu'
        ]);

        try {
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

            // Créer média
            Media::create([
                'chemin' => $fileName, // Juste le nom du fichier
                'description' => $request->description,
                'id_contenu' => $request->id_contenu,
                'id_type_media' => $request->id_type_media,
            ]);

            return redirect()->route('admin.medias.index')
                ->with('success', '✅ Média uploadé avec succès !');

        } catch (\Exception $e) {
            Log::error('Erreur store média: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', '❌ Erreur lors de l\'upload: ' . $e->getMessage())
                ->withInput();
        }
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
     * Formulaire d'édition
     */
    public function edit($id)
    {
        $media = Media::findOrFail($id);
        $typesMedia = TypeMedia::all();
        $contenus = Contenu::all();

        return view('medias.edit', compact('media', 'typesMedia', 'contenus'));
    }

    /**
     * UPDATE - Version corrigée
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
            // Si nouveau fichier
            if ($request->hasFile('media_file')) {
                // Supprimer ancien
                $oldPath = public_path('adminlte/img/' . $media->chemin);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }

                // Uploader nouveau
                $file = $request->file('media_file');
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $originalName) . '.' . $extension;

                $file->move(public_path('adminlte/img'), $fileName);
                $media->chemin = $fileName;
            }

            // Mettre à jour
            $media->description = $request->description;
            $media->id_contenu = $request->id_contenu;
            $media->id_type_media = $request->id_type_media;
            $media->save();

            return redirect()->route('admin.medias.index')
                ->with('success', '✅ Média modifié avec succès !');

        } catch (\Exception $e) {
            Log::error('Erreur update média: ' . $e->getMessage());
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

            // Supprimer fichier
            $filePath = public_path('adminlte/img/' . $media->chemin);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }

            $media->delete();

            return redirect()->route('admin.medias.index')
                ->with('success', '🗑️ Média supprimé avec succès !');

        } catch (\Exception $e) {
            Log::error('Erreur destroy média: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
}
