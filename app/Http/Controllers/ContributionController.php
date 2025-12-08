<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\Region;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContributionController extends Controller
{
    /**
     * Afficher le formulaire de contribution
     */
    public function create()
    {
        $categories = TypeContenu::orderBy('nom_contenu')->get();
        $regions = Region::orderBy('nom_region')->get();

        return view('front.contribution.create', compact('categories', 'regions'));
    }

    /**
     * Enregistrer une nouvelle contribution
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'id_region' => 'nullable|exists:regions,id_region',
            'texte' => 'required|string|min:100',
            'image_principale' => 'nullable|image|max:2048',
            'medias.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi,pdf|max:5120',
        ]);

        $contenu = new Contenu();
        $contenu->titre = $request->titre;
        $contenu->id_type_contenu = $request->id_type_contenu;
        $contenu->id_region = $request->id_region;
        $contenu->texte = $request->texte;
        $contenu->id_auteur = Auth::id();
        $contenu->statut = 'en attente'; // ou 'brouillon' selon ton workflow
        $contenu->slug = Str::slug($request->titre);

        // Image principale
        if ($request->hasFile('image_principale')) {
            $path = $request->file('image_principale')->store('contenus/images', 'public');
            $contenu->image_principale = $path;
        }

        $contenu->save();

        // Médias supplémentaires
        if ($request->hasFile('medias')) {
            foreach ($request->file('medias') as $media) {
                $path = $media->store('contenus/medias', 'public');

                // Détecter le type de média
                $type = in_array($media->getClientOriginalExtension(), ['mp4', 'mov', 'avi']) ? 2 : 1;

                $contenu->medias()->create([
                    'chemin' => $path,
                    'type' => $type,
                    'nom_original' => $media->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('user.contents')
            ->with('success', 'Votre contribution a été soumise avec succès ! Elle sera publiée après validation.');
    }

    /**
     * Liste des contributions de l'utilisateur
     */
    public function myContributions()
    {
        $contenus = Contenu::where('id_auteur', Auth::id())
            ->with(['typeContenu', 'region', 'medias'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('front.contribution.list', compact('contenus'));
    }

    /**
     * Éditer une contribution
     */
    public function edit($id)
    {
        $contenu = Contenu::where('id_auteur', Auth::id())->findOrFail($id);
        $categories = TypeContenu::orderBy('nom_contenu')->get();
        $regions = Region::orderBy('nom_region')->get();

        return view('front.contribution.edit', compact('contenu', 'categories', 'regions'));
    }

    /**
     * Mettre à jour une contribution
     */
    public function update(Request $request, $id)
    {
        $contenu = Contenu::where('id_auteur', Auth::id())->findOrFail($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'id_region' => 'nullable|exists:regions,id_region',
            'texte' => 'required|string|min:100',
            'image_principale' => 'nullable|image|max:2048',
        ]);

        $contenu->titre = $request->titre;
        $contenu->id_type_contenu = $request->id_type_contenu;
        $contenu->id_region = $request->id_region;
        $contenu->texte = $request->texte;
        $contenu->slug = Str::slug($request->titre);
        $contenu->statut = 'en attente'; // Retour en attente après modification

        // Nouvelle image principale
        if ($request->hasFile('image_principale')) {
            // Supprimer l'ancienne image
            if ($contenu->image_principale) {
                Storage::disk('public')->delete($contenu->image_principale);
            }

            $path = $request->file('image_principale')->store('contenus/images', 'public');
            $contenu->image_principale = $path;
        }

        $contenu->save();

        return redirect()->route('user.contents')
            ->with('success', 'Contribution mise à jour avec succès !');
    }

    /**
     * Supprimer une contribution
     */
    public function destroy($id)
    {
        $contenu = Contenu::where('id_auteur', Auth::id())->findOrFail($id);

        // Supprimer les médias associés
        foreach ($contenu->medias as $media) {
            Storage::disk('public')->delete($media->chemin);
            $media->delete();
        }

        // Supprimer l'image principale
        if ($contenu->image_principale) {
            Storage::disk('public')->delete($contenu->image_principale);
        }

        $contenu->delete();

        return redirect()->route('user.contents')
            ->with('success', 'Contribution supprimée avec succès.');
    }

    /**
     * Ajouter un commentaire
     */
    public function addComment(Request $request, $id)
    {
        $request->validate([
            'contenu' => 'required|string|min:5|max:1000',
            'parent_id' => 'nullable|exists:commentaires,id',
        ]);

        $contenu = Contenu::findOrFail($id);

        $commentaire = new Commentaire();
        $commentaire->contenus = $request->contenu;
        $commentaire->id_contenu = $id;
        $commentaire->id_auteur = Auth::id();
        $commentaire->parent_id = $request->parent_id;
        $commentaire->save();

        return back()->with('success', 'Commentaire ajouté avec succès.');
    }

    /**
     * Supprimer un commentaire
     */
    public function deleteComment($id)
    {
        $commentaire = Commentaire::where('id_auteur', Auth::id())->findOrFail($id);
        $commentaire->delete();

        return back()->with('success', 'Commentaire supprimé.');
    }
}
