<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Contenu;
use App\Models\TypeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class MediaController extends Controller
{
    /**
     * Afficher le formulaire d'upload - AVEC CHOIX DE FICHIER DEPUIS LE PC
     */
    public function create()
    {
        // Récupérer tous les contenus validés
        $contenus = Contenu::where('statut', 'validé')->get();

        // Récupérer les types de médias
        $types = TypeMedia::all();

        return view('medias.create', compact('contenus', 'types'));
    }

    /**
     * Stocker l'image uploadée - DIRECTEMENT DEPUIS LE PC
     */
    public function store(Request $request)
    {
        // VALIDATION : Accepter les fichiers images depuis le PC
        $request->validate([
            'media_file' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120', // Fichier image requis
            'description' => 'nullable|string|max:500',
            'id_type_media' => 'required|exists:type_medias,id_type_media',
            'id_contenu' => 'required|exists:contenus,id_contenu'
        ]);

        try {
            // 🖼️ RÉCUPÉRER LE FICHIER DEPUIS LE PC
            $file = $request->file('media_file');
            $contenu = Contenu::findOrFail($request->id_contenu);

            // 📁 GÉNÉRER UN NOM UNIQUE POUR LE FICHIER
            $fileName = 'contenu_' . $contenu->id_contenu . '_' . time() . '.' . $file->getClientOriginalExtension();

            // 💾 STOCKER LE FICHIER DANS STORAGE - DIRECTEMENT DEPUIS VOTRE PC
            $path = $file->storeAs('contenus', $fileName, 'public');

            // 💽 CRÉER L'ENREGISTREMENT DANS LA BASE
            Media::create([
                'chemin' => $path, // Chemin du fichier uploadé
                'description' => $request->description,
                'id_contenu' => $request->id_contenu,
                'id_type_media' => $request->id_type_media,
            ]);

            return redirect()->route('medias.index')
                ->with('success', '✅ Image ajoutée avec succès depuis votre PC !');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', '❌ Erreur lors de l\'upload: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Afficher la liste des médias
     */
   public function index()
{
    // Simple récupération des données - DataTables gère le reste côté client
    $medias = Media::with(['contenu', 'typeMedia'])
                   ->orderBy('id_media', 'desc')
                   ->get();

    return view('medias.index', compact('medias'));
}
    /**
     * Afficher un média spécifique
     */
    public function show($id)
    {
        $media = Media::with(['contenu', 'typeMedia'])->findOrFail($id);
        return view('medias.show', compact('media'));
    }

/**
 * Afficher le formulaire de modification
 */
public function edit($id)
{
    try {
        $media = Media::findOrFail($id);

        // ✅ Ajoutez ces lignes pour récupérer les types de média
        $typesMedia = TypeMedia::all();
        $contenus = Contenu::all();

        return view('medias.edit', compact('media', 'typesMedia', 'contenus'));

    } catch (\Exception $e) {
        Log::error('Erreur édition média: ' . $e->getMessage());
        return redirect()->route('medias.index')
                         ->with('error', 'Média non trouvé');
    }
}

    /**
     * Mettre à jour un média
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'nullable|string|max:500',
            'id_type_media' => 'required|exists:type_medias,id_type_media',
            'id_contenu' => 'required|exists:contenus,id_contenu'
        ]);

        try {
            $media = Media::findOrFail($id);

            $media->update([
                'description' => $request->description,
                'id_contenu' => $request->id_contenu,
                'id_type_media' => $request->id_type_media,
            ]);

            return redirect()->route('medias.index')
                ->with('success', '✅ Média modifié avec succès !');

        } catch (\Exception $e) {
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

            // Supprimer le fichier physique du stockage
            if (Storage::disk('public')->exists($media->chemin)) {
                Storage::disk('public')->delete($media->chemin);
            }

            $media->delete();

            return redirect()->route('medias.index')
                ->with('success', '🗑️ Image supprimée avec succès !');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la suppression');
        }
    }
}
