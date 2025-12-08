<?php
// app/Http/Middleware/RoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Veuillez vous connecter pour accéder à l\'administration.');
        }

        $user = Auth::user();

        // Charger explicitement la relation
        $user->loadMissing('role');

        if (!$user->role) {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Votre compte n\'a pas de rôle défini.');
        }

        $userRole = $user->role->nom_role;

        if (!empty($roles) && !in_array($userRole, $roles)) {
            abort(403, 'Accès refusé. Rôle requis : ' . implode(', ', $roles) .
                  '. Votre rôle: ' . $userRole);
        }

        if ($user->statut !== 'actif') {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Votre compte est désactivé.');
        }

        return $next($request);
    }
}
