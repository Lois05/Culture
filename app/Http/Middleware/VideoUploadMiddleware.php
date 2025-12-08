<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VideoUploadMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('admin/contenus*')) {
            // Augmenter les limites pour les contenus
            ini_set('upload_max_filesize', '500M');
            ini_set('post_max_size', '500M');
            ini_set('max_execution_time', '600');
            ini_set('memory_limit', '512M');
            ini_set('max_input_time', '600');
        }

        return $next($request);
    }
}
