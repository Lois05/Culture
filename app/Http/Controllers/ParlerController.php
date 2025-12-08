<?php

namespace App\Http\Controllers;

use App\Models\Parler;
use App\Models\Region;
use App\Models\Langue;
use Illuminate\Http\Request;

class ParlerController extends Controller
{
    public function index()
    {
        $parlers = Parler::with(['region', 'langue'])->get();
        return view('parler.index', compact('parlers'));
    }

    public function create()
    {
        $regions = Region::all();
        $langues = Langue::all();
        return view('parler.create', compact('regions', 'langues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
        ]);

        Parler::create($request->all());

        return redirect()->route('parler.index')->with('success', 'Association ajoutée avec succès.');
    }

    public function edit(Parler $parler)
    {
        $regions = Region::all();
        $langues = Langue::all();
        return view('parler.edit', compact('parler', 'regions', 'langues'));
    }

    public function update(Request $request, Parler $parler)
    {
        $request->validate([
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
        ]);

        $parler->update($request->all());

        return redirect()->route('parler.index')->with('success', 'Association mise à jour avec succès.');
    }
    public function show(Parler $parler)
    {
        return view('parler.show', compact('parler'));
    }


    public function destroy(Parler $parler)
    {
        $parler->delete();
        return redirect()->route('parler.index')->with('success', 'Association supprimée avec succès.');
    }
}
