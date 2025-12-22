<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;

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
        // Cacher les informations sensibles
        $maskedUrl = preg_replace('/cloudinary:\/\/[^:]+:[^@]+@/', 'cloudinary://***:***@', $cloudinaryUrl);
        echo "<p>URL masquée: <code>$maskedUrl</code></p>";

        if (strpos($cloudinaryUrl, 'cloudinary://') === 0) {
            echo "<p class='success'>✅ Format correct</p>";
        } else {
            echo "<p class='error'>❌ Format incorrect - doit commencer par cloudinary://</p>";
        }
    }
    echo "</div>";

    // Test 2: Images statiques via CloudinaryHelper
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
        'mamaafrica.jpg',
        'pattern.png',
        'placeholder.jpg'
    ];

    foreach ($testImages as $image) {
        $url = App\Helpers\CloudinaryHelper::static($image);

        echo "<p><strong>$image:</strong> ";

        if (strpos($url, 'res.cloudinary.com') !== false) {
            echo "<span class='success'>✅ Cloudinary</span>";
            echo " - <a href='$url' target='_blank'>Voir</a>";
            echo "<br><img src='$url' alt='$image' style='max-height: 100px;'>";
        } elseif (strpos($url, 'via.placeholder.com') !== false) {
            echo "<span class='warning'>⚠️ Placeholder</span>";
        } else {
            echo "<span class='error'>❌ Erreur</span>";
        }

        echo "</p>";
    }
    echo "</div>";

    // Test 3: Vérification des médias
    echo "<div class='box'>";
    echo "<h2>3. Test des médias</h2>";
    try {
        $media = \App\Models\Media::first();
        if ($media) {
            echo "<p>Média ID: {$media->id_media}</p>";
            echo "<p>Chemin: {$media->chemin}</p>";

            $imageUrl = $media->image_url;
            echo "<p>Image URL: $imageUrl</p>";

            if (strpos($imageUrl, 'res.cloudinary.com') !== false) {
                echo "<p class='success'>✅ Sur Cloudinary</p>";
                echo "<img src='$imageUrl' alt='Média'>";
            } elseif (strpos($imageUrl, 'storage/') !== false) {
                echo "<p class='warning'>⚠️ En local (storage)</p>";
                echo "<img src='$imageUrl' alt='Média'>";
            } else {
                echo "<p class='warning'>⚠️ Placeholder</p>";
            }

            // Vérifier si la méthode isOnCloudinary existe
            if (method_exists($media, 'isOnCloudinary')) {
                echo "<p>Méthode isOnCloudinary: " . ($media->isOnCloudinary() ? '✅ OUI' : '❌ NON') . "</p>";
            }
        } else {
            echo "<p>Aucun média trouvé dans la base de données</p>";
        }
    } catch (\Exception $e) {
        echo "<p class='error'>Erreur: " . $e->getMessage() . "</p>";
    }
    echo "</div>";

    // Test 4: Vérification des utilisateurs
    echo "<div class='box'>";
    echo "<h2>4. Test des avatars</h2>";
    try {
        $user = \App\Models\User::first();
        if ($user) {
            echo "<p>Utilisateur: {$user->name}</p>";
            echo "<p>Photo: {$user->photo}</p>";

            $avatarUrl = $user->image_url;
            echo "<p>Avatar URL: $avatarUrl</p>";

            if (strpos($avatarUrl, 'res.cloudinary.com') !== false) {
                echo "<p class='success'>✅ Sur Cloudinary</p>";
                echo "<img src='$avatarUrl' alt='Avatar' style='border-radius: 50%; width: 150px; height: 150px;'>";
            } elseif (strpos($avatarUrl, 'storage/') !== false) {
                echo "<p class='warning'>⚠️ En local (storage)</p>";
                echo "<img src='$avatarUrl' alt='Avatar' style='border-radius: 50%; width: 150px; height: 150px;'>";
            } else {
                echo "<p class='warning'>⚠️ Placeholder</p>";
            }
        } else {
            echo "<p>Aucun utilisateur trouvé</p>";
        }
    } catch (\Exception $e) {
        echo "<p class='error'>Erreur: " . $e->getMessage() . "</p>";
    }
    echo "</div>";

    // Test 5: Structure Cloudinary
    echo "<div class='box'>";
    echo "<h2>5. Structure Cloudinary recommandée</h2>";
    echo "<ul>";
    echo "<li><strong>culture_app/static/</strong> - Images statiques (hero, timeline, etc.)</li>";
    echo "<li><strong>culture_app/uploads/</strong> - Médias uploadés</li>";
    echo "<li><strong>culture_app/avatars/</strong> - Avatars utilisateurs</li>";
    echo "</ul>";

    echo "<h3>Images déjà sur Cloudinary:</h3>";
    echo "<ol>";
    echo "<li>discoverbenin.jpg (Hero)</li>";
    echo "<li>fresque.jpg (Hero)</li>";
    echo "<li>routeesclave.webp (Hero)</li>";
    echo "<li>beninwest.jpg (Hero)</li>";
    echo "<li>mosqueeporto.jpeg (Hero)</li>";
    echo "<li>royaumeabo.webp (Timeline)</li>";
    echo "<li>independancegraph.jpg (Timeline)</li>";
    echo "<li>ancientemps.jpg (Timeline)</li>";
    echo "<li>renaissance.webp (Timeline)</li>";
    echo "<li>contemporain.webp (Timeline)</li>";
    echo "</ol>";
    echo "</div>";

    // Instructions
    echo "<div class='box'>";
    echo "<h2>6. Instructions pour Railway</h2>";
    echo "<ol>";
    echo "<li>Vérifiez la variable <strong>CLOUDINARY_URL</strong> dans Railway</li>";
    echo "<li>Format: <code>cloudinary://API_KEY:API_SECRET@CLOUD_NAME</code></li>";
    echo "<li>Les images statiques sont déjà sur Cloudinary</li>";
    echo "<li>Les nouveaux uploads iront automatiquement sur Cloudinary</li>";
    echo "</ol>";

    echo "<h3>Vérifications à faire:</h3>";
    echo "<ul>";
    echo "<li>✅ Fichiers de vues modifiés (script PowerShell)</li>";
    echo "<li>✅ CloudinaryHelper.php créé</li>";
    echo "<li>✅ 10 images déjà sur Cloudinary</li>";
    echo "<li>🔲 Accesseurs image_url dans les modèles</li>";
    echo "<li>🔲 Test avec php artisan serve</li>";
    echo "</ul>";
    echo "</div>";
});

// ========== ROUTE POUR TESTER L'ENVIRONNEMENT ==========
Route::get('/env-test', function() {
    echo "<h1>Test Environnement</h1>";

    echo "<h2>Variables d'environnement</h2>";
    echo "<p>APP_ENV: " . env('APP_ENV') . "</p>";
    echo "<p>APP_DEBUG: " . env('APP_DEBUG') . "</p>";

    echo "<h2>Extensions PHP</h2>";
    echo "<p>GD: " . (extension_loaded('gd') ? '✅ Installé' : '❌ Non installé') . "</p>";
    echo "<p>Fileinfo: " . (extension_loaded('fileinfo') ? '✅ Installé' : '❌ Non installé') . "</p>";

    echo "<h2>Permissions</h2>";
    $paths = [
        storage_path() => 'storage/',
        public_path('storage') => 'public/storage',
        base_path('bootstrap/cache') => 'bootstrap/cache',
    ];

    foreach ($paths as $path => $name) {
        echo "<p>$name: ";
        echo is_writable($path) ? '✅ Écriture OK' : '❌ Pas accessible en écriture';
        echo "</p>";
    }
});

// ========== CHARGEMENT DES AUTRES FICHIERS ==========
require __DIR__.'/auth.php';     // Routes d'authentification Laravel (pour BACK)
require __DIR__.'/admin.php';    // Routes administration (BACK)
require __DIR__.'/front.php';    // Routes frontales (FRONT)
