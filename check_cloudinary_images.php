<?php
// check_cloudinary_images.php - Vérifie toutes les images dans les vues
// Exécutez : php check_cloudinary_images.php

echo "🔍 Vérification des images Cloudinary dans toutes les vues...\n\n";

$basePath = __DIR__;
$viewsPath = $basePath . '/resources/views';
$issues = [];

function scanViews($directory, &$issues) {
    $files = scandir($directory);

    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;

        $fullPath = $directory . '/' . $file;

        if (is_dir($fullPath)) {
            scanViews($fullPath, $issues);
        } elseif (pathinfo($file, PATHINFO_EXTENSION) == 'php') {
            checkBladeFile($fullPath, $issues);
        }
    }
}

function checkBladeFile($filePath, &$issues) {
    $content = file_get_contents($filePath);
    $relativePath = str_replace(__DIR__ . '/', '', $filePath);

    // Recherche de problèmes
    $problems = [];

    // 1. Vérifier les asset('adminlte/img/...')
    if (preg_match_all('/asset\([\'"](adminlte\/img\/[^\'"]+)[\'"]\)/', $content, $matches)) {
        foreach ($matches[0] as $key => $match) {
            $image = $matches[1][$key];
            $problems[] = "❌ Utilise asset() : " . $match . " → Devrait être : App\Helpers\CloudinaryHelper::static('" . basename($image) . "')";
        }
    }

    // 2. Vérifier les asset('storage/...') pour les médias/utilisateurs
    if (preg_match_all('/asset\([\'"](storage\/[^\'"]+)[\'"]\)/', $content, $matches)) {
        foreach ($matches[0] as $key => $match) {
            $path = $matches[1][$key];
            $problems[] = "⚠️  Vérifiez si stockage local : " . $match . " → Devrait peut-être utiliser CloudinaryHelper";
        }
    }

    // 3. Vérifier les images sans CloudinaryHelper
    if (preg_match_all('/src=[\'"]([^\'"]+\.(jpg|jpeg|png|gif|webp))[\'"]/i', $content, $matches)) {
        foreach ($matches[1] as $imageUrl) {
            if (!str_contains($imageUrl, 'cloudinary.com') &&
                !str_contains($imageUrl, 'CloudinaryHelper') &&
                !str_contains($imageUrl, 'http') &&
                !str_contains($imageUrl, 'https') &&
                !str_contains($imageUrl, 'data:image')) {
                $problems[] = "❓ Image locale détectée : " . $imageUrl . " → Vérifiez si besoin de Cloudinary";
            }
        }
    }

    // 4. Vérifier si CloudinaryHelper est utilisé
    if (!str_contains($content, 'CloudinaryHelper') &&
        (str_contains($content, 'src=') || str_contains($content, 'background-image'))) {
        $problems[] = "⚠️  Aucune référence à CloudinaryHelper détectée alors qu'il y a des images";
    }

    // 5. Vérifier les background-image
    if (preg_match_all('/background-image:\s*url\([\'"]([^\'"]+)[\'"]\)/', $content, $matches)) {
        foreach ($matches[1] as $imageUrl) {
            if (!str_contains($imageUrl, 'cloudinary.com') &&
                !str_contains($imageUrl, 'CloudinaryHelper') &&
                !str_contains($imageUrl, 'http') &&
                !str_contains($imageUrl, 'https')) {
                $problems[] = "❌ Background-image locale : " . $imageUrl . " → Devrait utiliser CloudinaryHelper";
            }
        }
    }

    // 6. Vérifier les use statements manquants
    if (str_contains($content, 'CloudinaryHelper::') && !str_contains($content, 'use App\Helpers\CloudinaryHelper;')) {
        $problems[] = "❌ CloudinaryHelper utilisé mais 'use' statement manquant";
    }

    if (!empty($problems)) {
        $issues[$relativePath] = $problems;
        echo "📄 " . $relativePath . " - " . count($problems) . " problème(s)\n";
    }
}

// Scanner toutes les vues
echo "📂 Scan du dossier : " . $viewsPath . "\n\n";
scanViews($viewsPath, $issues);

// Afficher le rapport
if (empty($issues)) {
    echo "\n✅ EXCELLENT ! Toutes les images utilisent correctement Cloudinary !\n";
} else {
    echo "\n📋 RAPPORT D'ANALYSE :\n";
    echo "========================================\n\n";

    $totalProblems = 0;
    foreach ($issues as $file => $problems) {
        echo "📄 FICHIER : " . $file . "\n";
        echo str_repeat("-", 50) . "\n";

        foreach ($problems as $problem) {
            echo $problem . "\n";
            $totalProblems++;
        }

        echo "\n";
    }

    echo "========================================\n";
    echo "📊 STATISTIQUES :\n";
    echo "• Fichiers avec problèmes : " . count($issues) . "\n";
    echo "• Total des problèmes : " . $totalProblems . "\n\n";

    echo "🚨 CORRECTIONS RECOMMANDÉES :\n";
    echo "1. Remplacer asset('adminlte/img/...') par App\Helpers\CloudinaryHelper::static('...')\n";
    echo "2. Ajouter 'use App\Helpers\CloudinaryHelper;' en haut des fichiers\n";
    echo "3. Pour les photos utilisateurs : utiliser CloudinaryHelper::user(\$user)\n";
    echo "4. Pour les médias : utiliser CloudinaryHelper::media(\$media)\n";
    echo "5. Pour les contenus : utiliser CloudinaryHelper::getContentImage(\$contenu)\n\n";

    // Générer un script de correction automatique
    echo "💡 Pour corriger automatiquement, créez ce script :\n\n";
    echo generateFixScript($issues);
}

function generateFixScript($issues) {
    $script = "<?php\n";
    $script .= "// auto_fix_cloudinary.php - Correction automatique basée sur l'analyse\n";
    $script .= "\$filesToFix = [\n";

    foreach ($issues as $file => $problems) {
        $hasAdminlte = false;
        $hasStorage = false;

        foreach ($problems as $problem) {
            if (str_contains($problem, "asset('adminlte/img/")) $hasAdminlte = true;
            if (str_contains($problem, "asset('storage/")) $hasStorage = true;
        }

        $script .= "    [\n";
        $script .= "        'file' => '" . $file . "',\n";
        $script .= "        'fix_adminlte' => " . ($hasAdminlte ? 'true' : 'false') . ",\n";
        $script .= "        'fix_storage' => " . ($hasStorage ? 'true' : 'false') . ",\n";
        $script .= "        'add_use' => true,\n";
        $script .= "    ],\n";
    }

    $script .= "];\n\n";

    $script .= <<<'EOT'
foreach ($filesToFix as $config) {
    $filePath = __DIR__ . '/' . $config['file'];

    if (!file_exists($filePath)) {
        echo "❌ Fichier non trouvé : " . $filePath . "\n";
        continue;
    }

    echo "📝 Correction de : " . $config['file'] . "\n";
    $content = file_get_contents($filePath);

    // Ajouter use statement
    if ($config['add_use'] && !str_contains($content, 'use App\Helpers\CloudinaryHelper;')) {
        $content = preg_replace('/@php/', '@php' . PHP_EOL . '    use App\Helpers\CloudinaryHelper;', $content, 1);
    }

    // Remplacer adminlte/img
    if ($config['fix_adminlte']) {
        $content = preg_replace_callback(
            '/asset\(\'adminlte\/img\/([^\']+)\'\)/',
            function($matches) {
                return "App\Helpers\CloudinaryHelper::static('" . $matches[1] . "')";
            },
            $content
        );
    }

    // Remplacer storage/ (à vérifier manuellement)
    if ($config['fix_storage']) {
        echo "   ⚠️  Images storage détectées, vérifiez manuellement\n";
    }

    file_put_contents($filePath, $content);
    echo "✅ Fichier corrigé\n";
}

echo "\n🎉 Correction terminée !\n";
EOT;

    return $script;
}

// Vérifier également les fichiers spécifiques connus
echo "\n🔎 VÉRIFICATION DES FICHIERS IMPORTANTS :\n";
echo str_repeat("-", 50) . "\n";

$importantFiles = [
    'front/explorer.blade.php',
    'front/home.blade.php',
    'front/contenu.blade.php',
    'layouts/layout_front.blade.php'
];

foreach ($importantFiles as $file) {
    $fullPath = $viewsPath . '/' . $file;
    if (file_exists($fullPath)) {
        $content = file_get_contents($fullPath);

        echo "\n📄 " . $file . " :\n";

        // Vérifier CloudinaryHelper
        if (str_contains($content, 'CloudinaryHelper::')) {
            echo "   ✅ Utilise CloudinaryHelper\n";
        } else {
            echo "   ⚠️  N'utilise pas CloudinaryHelper\n";
        }

        // Vérifier asset('adminlte/img/')
        if (preg_match('/asset\([\'"](adminlte\/img\/[^\'"]+)[\'"]\)/', $content)) {
            echo "   ❌ Utilise encore asset('adminlte/img/...')\n";
        } else {
            echo "   ✅ Pas de asset('adminlte/img/...')\n";
        }

        // Vérifier use statement
        if (str_contains($content, 'use App\Helpers\CloudinaryHelper;')) {
            echo "   ✅ 'use' statement présent\n";
        } else {
            echo "   ⚠️  'use' statement manquant\n";
        }
    } else {
        echo "\n📄 " . $file . " :\n";
        echo "   ❌ Fichier non trouvé\n";
    }
}
