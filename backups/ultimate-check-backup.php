<?php
echo "🔍 VÉRIFICATION ULTIME POUR RAILWAY\n";
echo "===================================\n\n";

// Chercher tous les fichiers Blade
$viewsPath = __DIR__ . '/resources/views/';
$allFiles = [];

function getAllBladeFiles($dir, &$allFiles) {
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;

        $path = $dir . '/' . $file;

        if (is_dir($path)) {
            getAllBladeFiles($path, $allFiles);
        } elseif (preg_match('/\.(blade\.php|php)$/', $file)) {
            $allFiles[] = $path;
        }
    }
}

if (!is_dir($viewsPath)) {
    echo "❌ Dossier views introuvable\n";
    exit;
}

getAllBladeFiles($viewsPath, $allFiles);

echo "📁 " . count($allFiles) . " fichiers Blade trouvés\n\n";

$results = [];
$hasIssues = false;

foreach ($allFiles as $file) {
    $relativePath = str_replace(__DIR__, '', $file);
    $content = file_get_contents($file);

    // Analyser ligne par ligne
    $lines = explode("\n", $content);
    $fileIssues = [];
    $fileGood = [];

    foreach ($lines as $lineNumber => $line) {
        $line = trim($line);

        // Chercher les images
        if (preg_match('/src\s*=\s*["\'][^"\']*["\']/', $line, $srcMatch) ||
            preg_match('/background(-image)?\s*:\s*url\([^)]*\)/', $line, $bgMatch) ||
            preg_match('/\{\{.*(photo|image|avatar|chemin|cloudinary).*\}\}/', $line, $bladeMatch)) {

            // Vérifier le contenu
            if (strpos($line, 'storage/') !== false &&
                strpos($line, 'cloudinary') === false &&
                strpos($line, 'has_cloudinary') === false) {

                $fileIssues[] = [
                    'line' => $lineNumber + 1,
                    'code' => strlen($line) > 100 ? substr($line, 0, 100) . '...' : $line,
                    'type' => 'STORAGE_SANS_CLOUDINARY'
                ];
                $hasIssues = true;

            } elseif (strpos($line, 'cloudinary_url') !== false ||
                     strpos($line, 'has_cloudinary') !== false ||
                     strpos($line, 'cloudinary.com') !== false) {

                $fileGood[] = [
                    'line' => $lineNumber + 1,
                    'code' => strlen($line) > 100 ? substr($line, 0, 100) . '...' : $line,
                    'type' => 'CLOUDINARY_READY'
                ];
            }
        }
    }

    if (!empty($fileIssues) || !empty($fileGood)) {
        $results[$relativePath] = [
            'issues' => $fileIssues,
            'good' => $fileGood
        ];
    }
}

// Afficher les résultats
if (empty($results)) {
    echo "✅ AUCUNE référence d'image trouvée dans les vues !\n";
    echo "   (Soit tes vues n'ont pas d'images, soit elles utilisent d'autres méthodes)\n";
} else {
    echo "📊 RÉSULTATS :\n\n";

    $totalIssues = 0;
    $totalGood = 0;

    foreach ($results as $file => $data) {
        echo "📄 $file\n";

        if (!empty($data['issues'])) {
            echo "  ⚠️  PROBLÈMES (" . count($data['issues']) . ") :\n";
            foreach ($data['issues'] as $issue) {
                echo "    • Ligne {$issue['line']}: {$issue['code']}\n";
                echo "      → Doit être migré vers Cloudinary\n";
            }
            $totalIssues += count($data['issues']);
        }

        if (!empty($data['good'])) {
            echo "  ✅ BON (" . count($data['good']) . ") :\n";
            foreach ($data['good'] as $good) {
                echo "    • Ligne {$good['line']}: {$good['code']}\n";
            }
            $totalGood += count($data['good']);
        }

        echo "\n";
    }

    echo "📈 SYNTHÈSE :\n";
    echo "  • Problèmes à corriger: $totalIssues\n";
    echo "  • Références Cloudinary OK: $totalGood\n\n";

    if ($totalIssues == 0) {
        echo "🎉 FÉLICITATIONS ! Tes vues sont 100% Railway-ready ! 🚀\n";
        echo "   Toutes les images pointent vers Cloudinary.\n";
    } else {
        echo "🚨 ATTENTION : Il y a $totalIssues problème(s) à corriger !\n";
        echo "   Ces images ne s'afficheront pas sur Railway.\n";
    }
}

// Vérification supplémentaire : chercher dans les contrôleurs
echo "\n🔍 VÉRIFICATION SUPPLÉMENTAIRE :\n";

$controllerPath = __DIR__ . '/app/Http/Controllers/';
if (is_dir($controllerPath)) {
    $controllers = glob($controllerPath . '*.php');
    echo "📦 " . count($controllers) . " contrôleurs trouvés\n";

    foreach ($controllers as $controller) {
        $content = file_get_contents($controller);
        if (strpos($content, 'storage') !== false || strpos($content, 'photo') !== false) {
            $name = basename($controller);
            echo "   • $name : Utilise des références d'images\n";
        }
    }
}

echo "\n✨ VÉRIFICATION TERMINÉE\n";

// Générer un mini-rapport
if ($hasIssues) {
    echo "\n💡 CONSEIL :\n";
    echo "   Exécute ceci pour voir les fichiers problématiques :\n";
    echo "   grep -r 'storage/' resources/views/\n";
}
?>
