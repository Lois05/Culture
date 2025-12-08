<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\User;
use App\Models\Contenu;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function index()
    {
        $commentaires = Commentaire::all();
        return view('commentaires.index', compact('commentaires'));
    }

    public function create()
    {
        $utilisateurs = User::all();
        $contenus = Contenu::all();
        return view('commentaires.create', compact('utilisateurs', 'contenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_utilisateur' => 'required|exists:users,id',
            'id_contenu' => 'required|exists:contenus,id_contenu',
            'contenu_commentaire' => 'required|string',
            'date_commentaire' => 'required|date',
            'statut' => 'required|in:actif,inactif',
        ]);

        Commentaire::create($request->all());

        // CORRECTION : Route avec préfixe admin
        return redirect()->route('admin.commentaires.index')->with('success', 'Commentaire créé avec succès.');
    }

    public function show(Commentaire $commentaire)
    {
        return view('commentaires.show', compact('commentaire'));
    }

    public function edit(Commentaire $commentaire)
    {
        $utilisateurs = User::all();
        $contenus = Contenu::all();
        return view('commentaires.edit', compact('commentaire', 'utilisateurs', 'contenus'));
    }

    public function update(Request $request, Commentaire $commentaire)
    {
        // CORRECTION : Validation cohérente avec les noms de colonnes réels
        $request->validate([
            'id_utilisateur' => 'required|exists:users,id', // REQUIRED au lieu de nullable
            'id_contenu' => 'required|exists:contenus,id_contenu', // REQUIRED au lieu de nullable
            'contenu_commentaire' => 'required|string', // Utilisez le bon nom de colonne
            'date_commentaire' => 'required|date', // Utilisez le bon nom de colonne
            'statut' => 'required|in:actif,inactif', // Ajout du statut
            'note' => 'nullable|integer|min:0|max:5',
        ]);

        $commentaire->update($request->all());

        // CORRECTION : Route avec préfixe admin
        return redirect()->route('admin.commentaires.index')->with('success', 'Commentaire modifié avec succès.');
    }

    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();

        // CORRECTION : Route avec préfixe admin
        return redirect()->route('admin.commentaires.index')->with('success', 'Commentaire supprimé avec succès.');
    }
}
