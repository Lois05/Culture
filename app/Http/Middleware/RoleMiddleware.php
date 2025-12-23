<?php
// app/Http/Middleware/RoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }

        $user = Auth::user();

        // Vérifie si l'utilisateur a un rôle
        if (!$user->id_role) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Votre compte n\'a pas de rôle défini.');
        }

        // Récupère le rôle depuis la base
        $role = DB::table('roles')->where('id', $user->id_role)->first();

        if (!$role) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Rôle introuvable.');
        }

        // Le champ s'appelle 'nom_role' dans ta table
        $userRole = $role->nom_role;

        // Si des rôles spécifiques sont demandés
        if (!empty($roles) && !in_array($userRole, $roles)) {
            abort(403, 'Accès refusé. Rôle requis : ' . implode(', ', $roles) .
                  '. Votre rôle: ' . $userRole);
        }

        if ($user->statut !== 'actif') {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Votre compte est désactivé.');
        }

        return $next($request);
    }
}
