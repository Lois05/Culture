<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IncreaseUploadLimit
{
    public function handle(Request $request, Closure $next)
    {
        // Augmenter les limites pour les routes d'upload
        if ($request->is('admin/contenus/*') || $request->is('admin/medias/*')) {
            ini_set('upload_max_filesize', '100M');
            ini_set('post_max_size', '100M');
            ini_set('max_execution_time', '300');
            ini_set('memory_limit', '256M');
        }

        return $next($request);
    }
}
