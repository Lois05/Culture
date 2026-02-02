<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;

// ========== ROUTES DE TEST TEMPORAIRES ==========
Route::get('/debug-test-1', function() {
    return response()->json([
        'status' => 'ok',
        'time' => now(),
        'session_id' => session()->getId(),
        'app_env' => app()->environment()
    ]);
});

Route::get('/debug-test-2', function() {
    return "Hello World - Simple HTML";
});

Route::get('/debug-test-3', function() {
    try {
        $test = \App\Helpers\CloudinaryHelper::get('test.jpg');
        return "CloudinaryHelper: OK";
    } catch (Exception $e) {
        return "CloudinaryHelper ERROR: " . $e->getMessage();
    }
});

// ========== ROUTES RACINE ==========
Route::get('/', function () {
    return redirect()->route('front.home');
});

// ========== ROUTES LARAVEL PAR DÉFAUT ==========
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========== ROUTES 2FA ==========
Route::middleware(['auth'])->group(function () {
    Route::get('/2fa/enable', [TwoFactorController::class, 'showEnableForm'])->name('2fa.enable');
    Route::get('/2fa/generate-secret', [TwoFactorController::class, 'generateSecret'])->name('2fa.generate');
    Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.activate');
    Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');
    Route::get('/2fa/backup-codes', [TwoFactorController::class, 'showBackupCodes'])->name('2fa.backup-codes');
    Route::post('/2fa/regenerate-backup-codes', [TwoFactorController::class, 'regenerateBackupCodes'])->name('2fa.regenerate-backup-codes');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/2fa/verify', [TwoFactorController::class, 'showVerifyForm'])->name('2fa.verify');
    Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify.post');
});

// ========== ROUTE DE TEST CLOUDINARY SIMPLIFIÉE ==========
Route::get('/cloudinary-test', function() {
    echo "<h1>Test Cloudinary Configuration</h1>";
    echo "<style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .success { color: green; }
        .error { color: red; }
        .warning { color: orange; }
        .box { border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px; }
        img { max-width: 300px; border: 1px solid #ccc; margin: 10px 0; }
    </style>";

    // Test 1: Configuration
    echo "<div class='box'>";
    echo "<h2>1. Configuration Cloudinary</h2>";

    $cloudName = config('cloudinary.cloud_name');
    $cloudinaryUrl = env('CLOUDINARY_URL');

    echo "<p>Cloud Name: <strong>" . ($cloudName ?: '<span class="error">❌ NON CONFIGURÉ</span>') . "</strong></p>";
    echo "<p>CLOUDINARY_URL dans .env: <strong>" . ($cloudinaryUrl ? '<span class="success">✅ CONFIGURÉ</span>' : '<span class="error">❌ NON CONFIGURÉ</span>') . "</strong></p>";

    if ($cloudinaryUrl) {
        $maskedUrl = preg_replace('/cloudinary:\/\/[^:]+:[^@]+@/', 'cloudinary://***:***@', $cloudinaryUrl);
        echo "<p>URL masquée: <code>$maskedUrl</code></p>";
    }
    echo "</div>";

    // Test 2: Images statiques
    echo "<div class='box'>";
    echo "<h2>2. Test des images statiques</h2>";

    $testImages = [
        'discoverbenin.jpg',
        'fresque.jpg',
        'routeesclave.webp',
        'beninwest.jpg',
        'mosqueeporto.jpeg',
        'royaumeabo.webp',
        'independancegraph.jpg',
        'ancientemps.jpg',
        'renaissance.webp',
        'contemporain.webp',
        'collage.png',
        'mamaafrica.jpg'
    ];

    foreach ($testImages as $image) {
        $url = App\Helpers\CloudinaryHelper::static($image);
        echo "<p><strong>$image:</strong> ";
        if (strpos($url, 'res.cloudinary.com') !== false) {
            echo "<span class='success'>✅ Cloudinary</span>";
        } else {
            echo "<span class='error'>❌ Erreur</span>";
        }
        echo "</p>";
    }
    echo "</div>";

    return "<p><a href='/'>Retour à l'accueil</a></p>";
});

// ========== ROUTE POUR TESTER L'ENVIRONNEMENT ==========
Route::get('/env-test', function() {
    echo "<h1>Test Environnement</h1>";
    echo "<p>APP_ENV: " . env('APP_ENV') . "</p>";
    echo "<p>APP_DEBUG: " . env('APP_DEBUG') . "</p>";
    return "<p><a href='/'>Retour</a></p>";
});

// ========== ROUTE TEMPORAIRE POUR CORRIGER LES IMAGES ==========
Route::get('/admin/fix-images', function() {
    if (request()->get('token') !== 'benin2024') {
        abort(403, 'Accès non autorisé');
    }

    $images = [
        'https://res.cloudinary.com/drzud4wye/image/upload/v1765979252/discoverbenin_vq9mik.jpg',
        'https://res.cloudinary.com/drzud4wye/image/upload/v1765979182/fresque_s4pcmz.jpg',
        'https://res.cloudinary.com/drzud4wye/image/upload/v1765979213/routeesclave_n5fo3i.webp',
        'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg',
        'https://res.cloudinary.com/drzud4wye/image/upload/v1765979195/mosqueeporto_hdaiki.jpg',
    ];

    $medias = \App\Models\Media::all();
    $updated = 0;

    foreach ($medias as $index => $media) {
        $newUrl = $images[$index % count($images)];
        $media->update([
            'chemin' => $newUrl,
            'cloudinary_url' => $newUrl,
        ]);
        $updated++;
    }

    return response()->json([
        'success' => true,
        'message' => "$updated médias mis à jour",
    ]);
});

// ========== CHARGEMENT DES AUTRES FICHIERS ==========
require __DIR__.'/auth.php';     // Routes d'authentification Laravel (pour BACK)
//require __DIR__.'/admin.php';
require __DIR__.'/front.php';    // Routes frontales (FRONT)
