<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use Illuminate\Http\Request;

class LanguesController extends Controller
{
    public function index()
    {
        $langues = Langue::all();
        return view('langues.index', compact('langues'));
    }

    public function create()
    {
        return view('langues.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_langue' => 'required|string|max:255',
            'code_langue' => 'nullable|string|max:10',
            'description' => 'nullable|string',
        ]);

        Langue::create($request->all());

        // CORRECTION : Utilisez le bon nom de route avec le préfixe admin
        return redirect()->route('admin.langues.index')->with('success', 'Langue créée avec succès.');
    }

    public function show(Langue $langue)
    {
        return view('langues.show', compact('langue'));
    }

    public function edit(Langue $langue)
    {
        return view('langues.edit', compact('langue'));
    }

    public function update(Request $request, Langue $langue)
    {
        $request->validate([
            'nom_langue' => 'required|string|max:255',
            'code_langue' => 'nullable|string|max:10',
            'description' => 'nullable|string',
        ]);

        $langue->update($request->all());

        // CORRECTION : Utilisez le bon nom de route avec le préfixe admin
        return redirect()->route('admin.langues.index')->with('success', 'Langue modifiée avec succès.');
    }

    public function destroy(Langue $langue)
    {
        $langue->delete();

        // CORRECTION : Utilisez le bon nom de route avec le préfixe admin
        return redirect()->route('admin.langues.index')->with('success', 'Langue supprimée avec succès.');
    }
}
