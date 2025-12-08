<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Check2FA
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur est connecté ET a le 2FA activé
        if ($user && $user->google2fa_enabled) {
            // Vérifier si la session n'est pas encore vérifiée
            if (!$request->session()->get('2fa_verified', false)) {
                // Rediriger vers la page de vérification
                return redirect()->route('2fa.verify');
            }
        }

        return $next($request);
    }
}
