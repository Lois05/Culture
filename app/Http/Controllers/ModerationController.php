<?php
// app/Http/Controllers/ModerationController.php

namespace App\Http\Controllers;

use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModerationController extends Controller
{
    /**
     * Afficher la liste des contenus en attente de modération
     */
    public function index()
    {
        // Récupérer les contenus avec statut "en_attente" - CORRIGÉ
        $contenusEnAttente = Contenu::with([
                'auteur:id,name,prenom,email',
                'region:id_region,nom_region', // CORRECTION: id_region au lieu de id
                'typeContenu:id_type_contenu,nom_contenu', // CORRECTION: id_type_contenu
                'langue:id_langue,nom_langue', // CORRECTION: id_langue
                'medias'
            ])
            ->where('statut', 'en_attente')
            ->orderBy('date_creation', 'asc')
            ->paginate(15);

        return view('moderateur.index', compact('contenusEnAttente'));
    }

    /**
     * Valider un contenu
     */
    public function valider(Request $request, $id)
    {
        $contenu = Contenu::findOrFail($id);

        // Vérifier que le contenu est bien en attente
        if ($contenu->statut !== 'en_attente') {
            return back()->with('error', 'Ce contenu a déjà été modéré.');
        }

        $contenu->update([
            'statut' => 'validé',
            'date_validation' => now(),
            'id_moderateur' => Auth::id()
        ]);

        return back()->with('success', 'Contenu validé avec succès ! Il est maintenant visible publiquement.');
    }

    /**
     * Rejeter un contenu
     */
    public function rejeter(Request $request, $id)
    {
        $contenu = Contenu::findOrFail($id);

        // Vérifier que le contenu est bien en attente
        if ($contenu->statut !== 'en_attente') {
            return back()->with('error', 'Ce contenu a déjà été modéré.');
        }

        $contenu->update([
            'statut' => 'rejeté',
            'id_moderateur' => Auth::id()
        ]);

        return back()->with('success', 'Contenu rejeté.');
    }

    /**
     * Voir les détails d'un contenu
     */
    public function show($id)
    {
        $contenu = Contenu::with([
                'auteur:id,name,prenom,email,photo',
                'region:id_region,nom_region,description', // CORRECTION
                'typeContenu:id_type_contenu,nom_contenu', // CORRECTION
                'langue:id_langue,nom_langue', // CORRECTION
                'medias:id_media,chemin,description,id_type_media',
                'moderateur:id,name,prenom'
            ])
            ->findOrFail($id);

        return view('moderateur.details', compact('contenu'));
    }
}
