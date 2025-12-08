<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_region' => 'required|string|max:255',
            'description' => 'nullable|string',
            'population' => 'nullable|integer',
            'superficie' => 'nullable|numeric',
            'localisation' => 'nullable|string',
        ]);

        Region::create($request->all());

        // CORRECTION : Utilisez le même nom de route partout
        return redirect()->route('regions.index')->with('success', 'Région créée avec succès.');
    }

    public function show(Region $region)
    {
        return view('regions.show', compact('region'));
    }

    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'nom_region' => 'required|string|max:255',
            'description' => 'nullable|string',
            'population' => 'nullable|integer',
            'superficie' => 'nullable|numeric',
            'localisation' => 'nullable|string',
        ]);

        $region->update($request->all());
        // CORRECTION : Utilisez le même nom de route partout
        return redirect()->route('regions.index')->with('success', 'Région modifiée avec succès.');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        // CORRECTION : Utilisez le même nom de route partout
        return redirect()->route('regions.index')->with('success', 'Région supprimée avec succès.');
    }
}
