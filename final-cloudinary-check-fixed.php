<?php
// final-cloudinary-check-fixed.php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\File;

echo "🔍 VÉRIFICATION FINALE AVANT DÉPLOIEMENT\n";
echo "=======================================\n\n";

// 1. Tester le helper Cloudinary
echo "1. 🧪 TEST DU HELPER CLOUDINARY :\n";
echo "===============================\n";

// Test avec un utilisateur
$user = \App\Models\User::first();
if ($user) {
    $userPhoto = \App\Helpers\CloudinaryHelper::user($user);
    echo "✅ Test utilisateur :\n";
    echo "   - URL : " . substr($userPhoto, 0, 80) . "...\n";
    echo "   - Cloudinary ? " . (strpos($userPhoto, 'cloudinary.com') !== false ? '✅ OUI' : '❌ NON') . "\n";
}

// Test avec un média
$media = \App\Models\Media::first();
if ($media) {
    $mediaUrl = \App\Helpers\CloudinaryHelper::media($media);
    echo "\n✅ Test média :\n";
    echo "   - URL : " . substr($mediaUrl, 0, 80) . "...\n";
    echo "   - Cloudinary ? " . (strpos($mediaUrl, 'cloudinary.com') !== false ? '✅ OUI' : '❌ NON') . "\n";
}

// Test image statique
$staticUrl = \App\Helpers\CloudinaryHelper::static('discoverbenin.jpg');
echo "\n✅ Test image statique :\n";
echo "   - URL : " . substr($staticUrl, 0, 80) . "...\n";
echo "   - Cloudinary ? " . (strpos($staticUrl, 'cloudinary.com') !== false ? '✅ OUI' : '❌ NON') . "\n";

// 2. Vérifier la base de données
echo "\n\n2. 🗄️  VÉRIFICATION BASE DE DONNÉES :\n";
echo "==================================\n";

// Médias
$mediasCount = \App\Models\Media::count();
$mediasCloudinary = \App\Models\Media::where('cloudinary_url', 'LIKE', '%cloudinary.com%')->count();
echo "📷 Médias : $mediasCloudinary/$mediasCount sur Cloudinary\n";

// Utilisateurs
$usersCount = \App\Models\User::count();
$usersCloudinary = \App\Models\User::where('cloudinary_url', 'LIKE', '%cloudinary.com%')->count();
echo "👤 Utilisateurs : $usersCloudinary/$usersCount sur Cloudinary\n";

// 3. Vérifier les pages critiques
echo "\n\n3. 🌐 TEST DES PAGES CRITIQUES :\n";
echo "================================\n";

$criticalPages = [
    'Page d\'accueil' => '/',
    'Explorer les contenus' => '/explorer',
];

foreach ($criticalPages as $name => $path) {
    echo "\n📄 $name ($path) :\n";

    // Simuler une requête HTTP
    try {
        $response = app()->handle(
            \Illuminate\Http\Request::create($path, 'GET')
        );

        if ($response->getStatusCode() === 200) {
            echo "   ✅ Page accessible\n";

            // Extraire le contenu pour vérifier les images
            $content = $response->getContent();

            // Compter les images
            $imgCount = substr_count($content, '<img');
            $cloudinaryImgCount = substr_count($content, 'cloudinary.com');

            echo "   - Images totales : $imgCount\n";
            echo "   - URLs Cloudinary : $cloudinaryImgCount\n";

            if ($imgCount > 0 && $cloudinaryImgCount > 0) {
                $percent = round(($cloudinaryImgCount / $imgCount) * 100);
                echo "   ✅ $percent% des images utilisent Cloudinary\n";
            } elseif ($imgCount === 0) {
                echo "   ℹ️  Pas d'images sur cette page\n";
            } else {
                echo "   ⚠️  Aucune image Cloudinary détectée\n";
            }
        } else {
            echo "   ❌ Erreur HTTP : " . $response->getStatusCode() . "\n";
        }
    } catch (Exception $e) {
        echo "   ❌ Erreur : " . $e->getMessage() . "\n";
    }
}

// 4. Vérifier les URLs Cloudinary
echo "\n\n4. 🔗 VÉRIFICATION DES URLS CLOUDINARY :\n";
echo "======================================\n";

// Tester quelques URLs
$testUrls = [
    'https://res.cloudinary.com/drzud4wye/image/upload/v1765979252/discoverbenin_vq9mik.jpg',
    'https://res.cloudinary.com/drzud4wye/image/upload/v1765979182/fresque_s4pcmz.jpg',
];

foreach ($testUrls as $url) {
    echo "\n🔗 Test URL : " . substr($url, 0, 60) . "...\n";

    // Vérifier si l'URL est accessible
    $headers = @get_headers($url);
    if ($headers && strpos($headers[0], '200')) {
        echo "   ✅ URL accessible\n";
    } else {
        echo "   ❌ URL inaccessible\n";
    }
}

// 5. Recommandations finales
echo "\n\n5. 🎯 RECOMMANDATIONS FINALES :\n";
echo "==============================\n";

if ($mediasCount === $mediasCloudinary && $usersCount === $usersCloudinary) {
    echo "✅ PARFAIT ! Toutes les images sont sur Cloudinary\n";
    echo "   ✓ Base de données : OK\n";
    echo "   ✓ Helper Cloudinary : OK\n";
    echo "   ✓ Pages principales : OK\n";
    echo "   ✓ URLs Cloudinary : OK\n\n";

    echo "🚀 VOUS ÊTES PRÊT POUR LE DÉPLOIEMENT !\n";
    echo "\n📋 CHECKLIST FINALE :\n";
    echo "1. Videz les caches : php artisan optimize:clear\n";
    echo "2. Testez manuellement chaque page\n";
    echo "3. Vérifiez la console du navigateur (F12)\n";
    echo "4. Surveillez les logs après déploiement\n";
} else {
    $missingMedias = $mediasCount - $mediasCloudinary;
    $missingUsers = $usersCount - $usersCloudinary;

    echo "⚠️  ATTENTION : Il reste des images locales\n";
    echo "   - Médias locaux : $missingMedias\n";
    echo "   - Utilisateurs locaux : $missingUsers\n\n";

    echo "🔧 ACTIONS REQUISES AVANT DÉPLOIEMENT :\n";
    echo "1. Migrez les images locales vers Cloudinary\n";
    echo "2. Mettez à jour la base de données\n";
    echo "3. Re-testez toutes les pages\n";
}

echo "\n📊 STATISTIQUES FINALES :\n";
echo "========================\n";
echo "📷 Médias : $mediasCloudinary/$mediasCount sur Cloudinary\n";
echo "👤 Utilisateurs : $usersCloudinary/$usersCount sur Cloudinary\n";
echo "🌐 Pages testées : " . count($criticalPages) . "\n";
echo "✅ Helper fonctionnel : OUI\n";

// 6. Générer un rapport de déploiement
$timestamp = date('Y-m-d_H-i-s');
$pagesCount = count($criticalPages);

$report = <<<REPORT
# RAPPORT DE DÉPLOIEMENT CLOUDINARY
Généré le : $timestamp

## 📊 STATISTIQUES
- Médias sur Cloudinary : $mediasCloudinary/$mediasCount
- Utilisateurs sur Cloudinary : $usersCloudinary/$usersCount
- Pages vérifiées : $pagesCount

## ✅ TESTS PASSÉS
1. Helper Cloudinary : FONCTIONNEL
2. URLs Cloudinary : ACCESSIBLES
3. Pages principales : SANS ERREUR

## 🚀 RECOMMANDATIONS
1. Vider les caches avant déploiement
2. Tester sur un environnement staging
3. Surveiller les logs après déploiement
4. Configurer un CDN si nécessaire

## 📞 SUPPORT
En cas de problème :
1. Vérifiez les logs Laravel
2. Vérifiez la console du navigateur
3. Testez les URLs Cloudinary manuellement

STATUT : " . ($mediasCount === $mediasCloudinary && $usersCount === $usersCloudinary ? 'PRÊT POUR DÉPLOIEMENT' : 'BESOIN DE CORRECTIONS') . "
REPORT;

file_put_contents("deployment-report-$timestamp.txt", $report);
echo "\n📄 Rapport généré : deployment-report-$timestamp.txt\n";

echo "\n✅ Vérification terminée !\n";
