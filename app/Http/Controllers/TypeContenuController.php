<?php

namespace App\Http\Controllers;

use App\Models\TypeContenu;
use Illuminate\Http\Request;

class TypeContenuController extends Controller
{
    // Liste des types
    public function index()
    {
        $typecontenus = TypeContenu::all();
        return view('typecontenus.index', compact('typecontenus'));
    }

    // Formulaire de création
    public function create()
    {
        return view('typecontenus.create');
    }

    // Enregistrer un nouveau type
    public function store(Request $request)
    {
        $request->validate([
            'nom_contenu' => 'required|string|max:255|unique:type_contenus,nom_contenu',
        ]);

        TypeContenu::create($request->all());

        return redirect()->route('typecontenus.index')
                         ->with('success', 'Type de contenu ajouté avec succès ✅');
    }

    // Afficher un type
    public function show(TypeContenu $typecontenu)
    {
        return view('typecontenus.show', compact('typecontenu'));
    }

    // Formulaire d’édition
    public function edit(TypeContenu $typecontenu)
    {
        return view('typecontenus.edit', compact('typecontenu'));
    }

    // Mettre à jour
    public function update(Request $request, TypeContenu $typecontenu)
    {
        $request->validate([
            'nom_contenu' => 'required|string|max:255|unique:type_contenus,nom_contenu,' . $typecontenu->id_type_contenu . ',id_type_contenu',
        ]);

        $typecontenu->update($request->all());

        return redirect()->route('typecontenus.index')
                         ->with('success', 'Type de contenu mis à jour avec succès ✨');
    }

    // Supprimer
    public function destroy(TypeContenu $typecontenu)
    {
        $typecontenu->delete();

        return redirect()->route('typecontenus.index')
                         ->with('success', 'Type de contenu supprimé avec succès ❌');
    }
}
