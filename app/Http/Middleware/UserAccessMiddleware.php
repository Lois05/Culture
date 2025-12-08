<?php
// app/Http/Middleware/UserAccessMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccessMiddleware
{
    /**
     * Handle an incoming request for FRONT routes only
     * Ex: /dashboard, /contribuer (quand connecté)
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('front.connexion')
                ->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }

        // Vérifier si l'utilisateur est actif
        if (Auth::user()->statut !== 'actif') {
            Auth::logout();
            return redirect()->route('front.connexion')
                ->with('error', 'Votre compte est désactivé.');
        }

        return $next($request);
    }
}
