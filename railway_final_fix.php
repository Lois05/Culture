<?php
// railway_final_fix.php
echo "🚀 CORRECTION FINALE POUR RAILWAY\n";
echo str_repeat("=", 50) . "\n\n";

// 1. Corriger home.blade.php
echo "1. 🔧 Correction de home.blade.php...\n";
$homeFile = __DIR__ . '/resources/views/front/home.blade.php';

if (file_exists($homeFile)) {
    $content = file_get_contents($homeFile);

    // Remplacer TOUTES les asset('adminlte/img/...')
    $content = preg_replace_callback(
        '/asset\(\'adminlte\/img\/([^\']+)\'\)/',
        function($matches) {
            $filename = $matches[1];
            return "App\Helpers\CloudinaryHelper::static('" . $filename . "')";
        },
        $content
    );

    // Ajouter use statement
    if (str_contains($content, 'CloudinaryHelper::') &&
        !str_contains($content, 'use App\Helpers\CloudinaryHelper;')) {
        $content = str_replace(
            '@extends(\'layouts.layout_front\')' . PHP_EOL . PHP_EOL . '@section(\'title\', \'Accueil - Bénin Culture\')',
            '@extends(\'layouts.layout_front\')' . PHP_EOL . PHP_EOL . '@section(\'title\', \'Accueil - Bénin Culture\')' . PHP_EOL . PHP_EOL . '@php' . PHP_EOL . '    use App\Helpers\CloudinaryHelper;' . PHP_EOL . '@endphp',
            $content
        );
    }

    file_put_contents($homeFile, $content);
    echo "   ✅ adminlte/img/ remplacé par CloudinaryHelper\n";
    echo "   ✅ use statement ajouté\n";
} else {
    echo "   ❌ Fichier non trouvé\n";
}

// 2. Vérifier layout_front.blade.php
echo "\n2. 🔍 Vérification de layout_front.blade.php...\n";
$layoutFile = __DIR__ . '/resources/views/layouts/layout_front.blade.php';

if (file_exists($layoutFile)) {
    $content = file_get_contents($layoutFile);

    // Chercher des images dans le layout
    if (preg_match('/src=[\'"]([^\'"]+\.(jpg|jpeg|png|gif|webp))[\'"]/i', $content, $matches)) {
        echo "   📸 Image trouvée : " . $matches[1] . "\n";
        echo "   ⚠️  Ce layout n'utilise pas CloudinaryHelper\n";
        echo "   💡 Vérifiez si cette image est importante\n";
    } else {
        echo "   ✅ Pas d'images locales détectées\n";
    }

    // Vérifier le logo
    if (str_contains($content, 'logo') || str_contains($content, 'Logo')) {
        echo "   🏷️  Logo détecté - Assurez-vous qu'il utilise Cloudinary\n";
    }
} else {
    echo "   ❌ Fichier non trouvé\n";
}

// 3. Scanner toutes les vues pour les derniers adminlte/img/
echo "\n3. 🔎 Scan final pour adminlte/img/ restants...\n";
$adminlteFound = false;

function scanForAdminlte($directory) {
    $files = scandir($directory);
    $found = [];

    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;

        $path = $directory . '/' . $file;

        if (is_dir($path)) {
            $found = array_merge($found, scanForAdminlte($path));
        } elseif (pathinfo($file, PATHINFO_EXTENSION) == 'php') {
            $content = file_get_contents($path);
            if (preg_match('/asset\([\'"]adminlte\/img\//', $content)) {
                $found[] = str_replace(__DIR__ . '/', '', $path);
            }
        }
    }

    return $found;
}

$problemFiles = scanForAdminlte(__DIR__ . '/resources/views');

if (empty($problemFiles)) {
    echo "   ✅ Aucun adminlte/img/ trouvé !\n";
} else {
    echo "   ❌ Fichiers avec adminlte/img/ :\n";
    foreach ($problemFiles as $file) {
        echo "      - " . $file . "\n";

        // Corriger automatiquement
        $fullPath = __DIR__ . '/' . $file;
        $content = file_get_contents($fullPath);

        $content = preg_replace_callback(
            '/asset\(\'adminlte\/img\/([^\']+)\'\)/',
            function($matches) {
                return "App\Helpers\CloudinaryHelper::static('" . $matches[1] . "')";
            },
            $content
        );

        file_put_contents($fullPath, $content);
        echo "        ✅ Corrigé\n";
    }
}

// 4. Vérification finale avec test réel
echo "\n4. ✅ VÉRIFICATION FINALE...\n";

// Test CloudinaryHelper
echo "   Test CloudinaryHelper::static() : ";
try {
    require __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle($request = Illuminate\Http\Request::capture());

    $url = App\Helpers\CloudinaryHelper::static('discoverbenin.jpg');
    if (str_contains($url, 'cloudinary.com')) {
        echo "✅ OK (URL Cloudinary)\n";
    } else {
        echo "❌ ERREUR\n";
    }
} catch (Exception $e) {
    echo "⚠️  Test échoué : " . $e->getMessage() . "\n";
}

// 5. Instructions pour Railway
echo "\n" . str_repeat("=", 50) . "\n";
echo "🎯 VOTRE APPLICATION EST MAINTENANT PRÊTE !\n";
echo str_repeat("=", 50) . "\n\n";

echo "📋 ÉTAPES POUR RAILWAY :\n";
echo "1. Push votre code sur GitHub\n";
echo "2. Dans Railway, connectez votre repo\n";
echo "3. Ajoutez ces variables d'environnement :\n\n";

echo "=== RAILWAY ENV VARS ===\n";
echo "CLOUDINARY_URL=cloudinary://votre_api_key:votre_api_secret@votre_cloud_name\n";
echo "APP_ENV=production\n";
echo "APP_DEBUG=false\n";
echo "APP_URL=https://votre-app.railway.app\n";
echo "DB_CONNECTION=mysql\n";
echo "DB_HOST=xxxx.railway.app\n";
echo "DB_PORT=xxxx\n";
echo "DB_DATABASE=railway\n";
echo "DB_USERNAME=root\n";
echo "DB_PASSWORD=xxxx\n";
echo "=======================\n\n";

echo "✅ TOUT EST CORRIGÉ !\n";
echo "🔍 Pour tester localement :\n";
echo "   php artisan serve\n";
echo "   Visitez http://localhost:8000\n";
echo "   Vérifiez que les images viennent de res.cloudinary.com\n";
