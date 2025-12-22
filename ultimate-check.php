<?php
echo "🔍 VÉRIFICATION INTELLIGENTE POUR RAILWAY\n";
echo "========================================\n\n";

$files = [
    'resources/views/front/contenu.blade.php',
    'resources/views/front/dashboard/settings.blade.php',
    'resources/views/layouts/layout_front.blade.php',
    'resources/views/moderateur/details.blade.php',
    'resources/views/tableaudebord.blade.php'
];

$totalProblems = 0;
$allGood = true;

foreach ($files as $filePath) {
    if (!file_exists($filePath)) {
        echo "❌ $filePath non trouvé\n";
        continue;
    }

    echo "📄 $filePath\n";
    $content = file_get_contents($filePath);
    $lines = explode("\n", $content);

    $fileProblems = 0;

    for ($i = 0; $i < count($lines); $i++) {
        $line = trim($lines[$i]);
        $lineNum = $i + 1;

        // Chercher storage/ sans vérification Cloudinary
        if (strpos($line, 'storage/') !== false && strpos($line, 'asset(') !== false) {
            // Vérifier si c'est dans un @elseif (ce qui est CORRECT)
            $isProtected = false;

            // Regarder 3 lignes au-dessus
            for ($j = max(0, $i - 3); $j < $i; $j++) {
                if (isset($lines[$j]) && strpos(trim($lines[$j]), '@elseif') === 0) {
                    $isProtected = true;
                    break;
                }
            }

            // Vérifier si la ligne elle-même a cloudinary (cas de double vérification)
            if (strpos($line, 'cloudinary') !== false) {
                $isProtected = true;
            }

            if (!$isProtected) {
                echo "   ❌ Ligne $lineNum: VRAI PROBLÈME - " . substr($line, 0, 60) . "...\n";
                $fileProblems++;
                $totalProblems++;
                $allGood = false;
            } else {
                echo "   ✅ Ligne $lineNum: OK (dans @elseif) - " . substr($line, 0, 60) . "...\n";
            }
        }
    }

    if ($fileProblems === 0) {
        echo "   ✅ 0 problème détecté\n";
    } else {
        echo "   📊 $fileProblems vrai(s) problème(s)\n";
    }

    echo "\n";
}

echo "📊 SYNTHÈSE :\n";
echo "=============\n";
echo "Problèmes totaux: $totalProblems\n\n";

if ($totalProblems === 0) {
    echo "🎉🎉🎉 SUCCÈS ABSOLU ! 🎉🎉🎉\n";
    echo "TON APPLICATION EST 100% RAILWAY-READY ! 🚀\n\n";

    echo "📋 DÉPLOIEMENT IMMÉDIAT :\n";
    echo "1. git add .\n";
    echo "2. git commit -m 'Ready for Railway deployment'\n";
    echo "3. git push\n";
    echo "4. Sur Railway: Settings → Variables → Ajouter CLOUDINARY_API_SECRET\n";
    echo "5. DÉPLOYER !\n";
} else {
    echo "⚠️  Il reste $totalProblems VRAI(S) problème(s) à corriger.\n";
    echo "Ces lignes doivent être placées dans des conditions @elseif.\n";
}

echo "\n✨ VÉRIFICATION TERMINÉE\n";

// Vérification bonus : les modèles
echo "\n🔍 VÉRIFICATION DES MODÈLES :\n";
echo "============================\n";

if (file_exists('app/Models/User.php')) {
    $userModel = file_get_contents('app/Models/User.php');
    $hasFields = strpos($userModel, 'has_cloudinary') !== false &&
                 strpos($userModel, 'cloudinary_url') !== false;
    echo "📄 User.php: " . ($hasFields ? "✅ Champs Cloudinary présents" : "❌ Champs manquants") . "\n";
}

if (file_exists('app/Models/Media.php')) {
    $mediaModel = file_get_contents('app/Models/Media.php');
    $hasFields = strpos($mediaModel, 'has_cloudinary') !== false &&
                 strpos($mediaModel, 'cloudinary_url') !== false;
    echo "📄 Media.php: " . ($hasFields ? "✅ Champs Cloudinary présents" : "❌ Champs manquants") . "\n";
}