<?php
// cloudinary-diagnostic.php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "🔍 DIAGNOSTIC COMPLET CLOUDINARY\n";
echo "===============================\n\n";

// Fonction pour vérifier si c'est Cloudinary
function isCloudinaryUrl($url) {
    if (empty($url)) return false;
    return strpos($url, 'cloudinary.com') !== false;
}

// 1. Vérifier la structure des tables
echo "📊 STRUCTURE DES TABLES :\n";
echo "========================\n";

$tables = ['medias', 'users', 'contenus'];
foreach ($tables as $table) {
    if (DB::getSchemaBuilder()->hasTable($table)) {
        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        echo "✅ Table '$table' existe\n";
        echo "   Colonnes : " . implode(', ', $columns) . "\n";
    } else {
        echo "❌ Table '$table' n'existe pas\n";
    }
}
echo "\n";

// 2. Vérifier les médias en détail
echo "📷 ANALYSE DES MÉDIAS :\n";
echo "=====================\n";

$medias = DB::table('medias')->get();
$totalMedias = $medias->count();

$stats = [
    'cloudinary' => 0,
    'local' => 0,
    'no_url' => 0,
    'by_type' => [],
];

foreach ($medias as $media) {
    $url = null;

    // Chercher l'URL dans différentes colonnes
    if (!empty($media->cloudinary_url)) {
        $url = $media->cloudinary_url;
    } elseif (!empty($media->chemin)) {
        $url = $media->chemin;
    } elseif (!empty($media->url)) {
        $url = $media->url;
    }

    // Type de média
    $type = $media->type ?? 'inconnu';

    if (empty($url)) {
        $stats['no_url']++;
        if (!isset($stats['by_type'][$type])) $stats['by_type'][$type] = ['total' => 0, 'cloudinary' => 0];
        $stats['by_type'][$type]['total']++;
    } elseif (isCloudinaryUrl($url)) {
        $stats['cloudinary']++;
        if (!isset($stats['by_type'][$type])) $stats['by_type'][$type] = ['total' => 0, 'cloudinary' => 0];
        $stats['by_type'][$type]['total']++;
        $stats['by_type'][$type]['cloudinary']++;
    } else {
        $stats['local']++;
        if (!isset($stats['by_type'][$type])) $stats['by_type'][$type] = ['total' => 0, 'cloudinary' => 0];
        $stats['by_type'][$type]['total']++;
    }
}

echo "Total médias : $totalMedias\n";
echo "✅ Cloudinary : " . $stats['cloudinary'] . " (" . round(($stats['cloudinary']/$totalMedias)*100, 1) . "%)\n";
echo "⚠️  Local : " . $stats['local'] . " (" . round(($stats['local']/$totalMedias)*100, 1) . "%)\n";
echo "❌ Sans URL : " . $stats['no_url'] . " (" . round(($stats['no_url']/$totalMedias)*100, 1) . "%)\n";

if (!empty($stats['by_type'])) {
    echo "\nPar type :\n";
    foreach ($stats['by_type'] as $type => $typeStats) {
        $percent = $typeStats['total'] > 0 ? round(($typeStats['cloudinary']/$typeStats['total'])*100, 1) : 0;
        echo "  - $type : {$typeStats['total']} total, {$typeStats['cloudinary']} Cloudinary ($percent%)\n";
    }
}

// Afficher 5 exemples de médias locaux
$localMedias = DB::table('medias')
    ->where(function($q) {
        $q->whereNotNull('chemin')
          ->where('chemin', 'NOT LIKE', '%cloudinary.com%');
    })
    ->orWhere(function($q) {
        $q->whereNotNull('url')
          ->where('url', 'NOT LIKE', '%cloudinary.com%');
    })
    ->limit(5)
    ->get();

if ($localMedias->count() > 0) {
    echo "\n🔍 EXEMPLES DE MÉDIAS LOCAUX :\n";
    foreach ($localMedias as $media) {
        $id = $media->id_media ?? 'N/A';
        $url = $media->chemin ?? $media->url ?? 'N/A';
        echo "  - Média #$id : " . substr($url, 0, 60) . "\n";
    }
}

// 3. Vérifier les utilisateurs en détail
echo "\n\n👤 ANALYSE DES UTILISATEURS :\n";
echo "============================\n";

$users = DB::table('users')->get();
$totalUsers = $users->count();

$userStats = [
    'cloudinary' => 0,
    'local' => 0,
    'adminlte' => 0,
    'no_photo' => 0,
    'gravatar' => 0,
];

foreach ($users as $user) {
    $photo = $user->cloudinary_url ?? $user->photo ?? $user->photo_url ?? $user->avatar ?? null;

    if (empty($photo)) {
        $userStats['no_photo']++;
    } elseif (isCloudinaryUrl($photo)) {
        $userStats['cloudinary']++;
    } elseif (strpos($photo, 'adminlte/img/') !== false) {
        $userStats['adminlte']++;
    } elseif (strpos($photo, 'gravatar.com') !== false) {
        $userStats['gravatar']++;
    } elseif (filter_var($photo, FILTER_VALIDATE_URL)) {
        $userStats['local']++; // URL externe mais pas Cloudinary
    } elseif (strpos($photo, 'storage/') === 0 || strpos($photo, '/storage/') !== false) {
        $userStats['local']++; // URL locale
    } else {
        $userStats['local']++; // Autre
    }
}

echo "Total utilisateurs : $totalUsers\n";
echo "✅ Cloudinary : " . $userStats['cloudinary'] . " (" . round(($userStats['cloudinary']/$totalUsers)*100, 1) . "%)\n";
echo "👤 AdminLTE : " . $userStats['adminlte'] . " (" . round(($userStats['adminlte']/$totalUsers)*100, 1) . "%)\n";
echo "🌐 Gravatar : " . $userStats['gravatar'] . " (" . round(($userStats['gravatar']/$totalUsers)*100, 1) . "%)\n";
echo "⚠️  Local/Autre : " . $userStats['local'] . " (" . round(($userStats['local']/$totalUsers)*100, 1) . "%)\n";
echo "❌ Sans photo : " . $userStats['no_photo'] . " (" . round(($userStats['no_photo']/$totalUsers)*100, 1) . "%)\n";

// Afficher des exemples de photos
echo "\n🔍 EXEMPLES DE PHOTOS D'UTILISATEURS :\n";
$sampleUsers = DB::table('users')->limit(5)->get();
foreach ($sampleUsers as $user) {
    $id = $user->id_user ?? $user->id ?? 'N/A';
    $email = $user->email ?? 'N/A';
    $photo = $user->cloudinary_url ?? $user->photo ?? $user->photo_url ?? 'Aucune';

    $type = 'Inconnu';
    if (empty($photo) || $photo === 'Aucune') {
        $type = '❌ Sans photo';
    } elseif (isCloudinaryUrl($photo)) {
        $type = '✅ Cloudinary';
    } elseif (strpos($photo, 'adminlte/img/') !== false) {
        $type = '👤 AdminLTE';
    } elseif (strpos($photo, 'gravatar.com') !== false) {
        $type = '🌐 Gravatar';
    } elseif (filter_var($photo, FILTER_VALIDATE_URL)) {
        $type = '⚠️  URL externe';
    } elseif (strpos($photo, 'storage/') === 0) {
        $type = '📁 Local storage';
    } else {
        $type = '❓ Autre';
    }

    echo "  - #$id ($email) : $type\n";
    if ($photo !== 'Aucune' && !isCloudinaryUrl($photo)) {
        echo "    URL : " . substr($photo, 0, 50) . "...\n";
    }
}

// 4. Vérifier les contenus
echo "\n\n📰 ANALYSE DES CONTENUS :\n";
echo "========================\n";

if (DB::getSchemaBuilder()->hasTable('contenus')) {
    $totalContenus = DB::table('contenus')->count();
    $contenusAvecMedias = DB::table('contenus')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('medias')
                  ->whereColumn('medias.contenu_id', 'contenus.id_contenu');
        })
        ->count();

    $contenusAvecCloudinary = DB::table('contenus')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('medias')
                  ->whereColumn('medias.contenu_id', 'contenus.id_contenu')
                  ->where('medias.cloudinary_url', 'LIKE', '%cloudinary.com%');
        })
        ->count();

    echo "Total contenus : $totalContenus\n";
    echo "Avec médias : $contenusAvecMedias\n";
    echo "Avec Cloudinary : $contenusAvecCloudinary\n";

    if ($contenusAvecMedias > 0) {
        $percent = round(($contenusAvecCloudinary/$contenusAvecMedias)*100, 1);
        echo "Pourcentage Cloudinary : $percent%\n";
    }
} else {
    echo "Table 'contenus' non trouvée\n";
}

// 5. Résumé et recommandations
echo "\n\n🎯 RÉSUMÉ ET RECOMMANDATIONS :\n";
echo "=============================\n";

$totalImages = $totalMedias + $totalUsers;
$totalCloudinary = $stats['cloudinary'] + $userStats['cloudinary'];

if ($totalImages > 0) {
    $globalPercent = round(($totalCloudinary/$totalImages)*100, 1);
    echo "Statut global : $globalPercent% des images utilisent Cloudinary\n\n";

    if ($globalPercent < 30) {
        echo "❌ STATUT : CRITIQUE\n";
        echo "   La plupart des images ne sont pas sur Cloudinary\n";
        echo "   Actions urgentes nécessaires\n";
    } elseif ($globalPercent < 60) {
        echo "⚠️  STATUT : À AMÉLIORER\n";
        echo "   Moitié des images sur Cloudinary\n";
        echo "   Migration en cours\n";
    } elseif ($globalPercent < 85) {
        echo "✅ STATUT : BON\n";
        echo "   Majorité des images sur Cloudinary\n";
        echo "   Quelques ajustements nécessaires\n";
    } else {
        echo "🏆 STATUT : EXCELLENT\n";
        echo "   Presque toutes les images sur Cloudinary\n";
        echo "   Prêt pour la production\n";
    }
}

echo "\n🔧 ACTIONS RECOMMANDÉES :\n";

if ($stats['local'] > 0) {
    echo "1. Migrer {$stats['local']} média(s) local(aux) vers Cloudinary\n";
}

if ($userStats['adminlte'] > 0) {
    echo "2. Remplacer {$userStats['adminlte']} photo(s) AdminLTE\n";
    echo "   Options :\n";
    echo "   - Utiliser des initiales avec avatar coloré\n";
    echo "   - Importer vers Cloudinary\n";
    echo "   - Utiliser un service comme Gravatar\n";
}

if ($userStats['local'] > 0) {
    echo "3. Migrer {$userStats['local']} photo(s) d'utilisateur(s) locales\n";
}

if ($stats['no_url'] > 0) {
    echo "4. Ajouter des URLs pour {$stats['no_url']} média(s) sans URL\n";
}

echo "\n💡 CONSEILS TECHNIQUES :\n";
echo "1. Vérifiez votre fichier App\Helpers\CloudinaryHelper.php\n";
echo "2. Assurez-vous que les méthodes user() et media() fonctionnent\n";
echo "3. Testez avec quelques IDs spécifiques\n";
echo "4. Vérifiez les logs pour les erreurs d'images\n";

// 6. Tester le helper Cloudinary
echo "\n\n🔬 TEST DU HELPER CLOUDINARY :\n";
echo "=============================\n";

try {
    // Tester avec un média
    $testMedia = DB::table('medias')->first();
    if ($testMedia) {
        $mediaId = $testMedia->id_media ?? $testMedia->id ?? 'N/A';
        echo "Test média #$mediaId :\n";

        // Simuler l'appel au helper
        $url = $testMedia->cloudinary_url ?? $testMedia->chemin ?? null;
        if ($url) {
            if (isCloudinaryUrl($url)) {
                echo "  ✅ URL Cloudinary détectée\n";
                echo "  📍 URL : " . substr($url, 0, 60) . "...\n";
            } else {
                echo "  ⚠️  URL locale détectée\n";
                echo "  📍 URL : " . substr($url, 0, 60) . "...\n";
            }
        } else {
            echo "  ❌ Aucune URL trouvée\n";
        }
    }

    // Tester avec un utilisateur
    $testUser = DB::table('users')->first();
    if ($testUser) {
        $userId = $testUser->id_user ?? $testUser->id ?? 'N/A';
        echo "\nTest utilisateur #$userId :\n";

        $photo = $testUser->cloudinary_url ?? $testUser->photo ?? null;
        if ($photo) {
            if (isCloudinaryUrl($photo)) {
                echo "  ✅ Photo Cloudinary détectée\n";
                echo "  📍 URL : " . substr($photo, 0, 60) . "...\n";
            } elseif (strpos($photo, 'adminlte/img/') !== false) {
                echo "  👤 Photo AdminLTE détectée\n";
                echo "  📍 Chemin : $photo\n";
                echo "  💡 Recommandation : Utiliser des initiales\n";
            } else {
                echo "  ⚠️  Photo locale/autre détectée\n";
                echo "  📍 URL : " . substr($photo, 0, 60) . "...\n";
            }
        } else {
            echo "  ❌ Aucune photo trouvée\n";
            echo "  💡 Générer des initiales : " . strtoupper(substr($testUser->email ?? '?', 0, 1)) . "\n";
        }
    }
} catch (Exception $e) {
    echo "Erreur lors du test : " . $e->getMessage() . "\n";
}

echo "\n📋 POUR TESTER VOTRE PAGE :\n";
echo "1. Allez sur la page d'accueil\n";
echo "2. Vérifiez la console du navigateur (F12)\n";
echo "3. Cherchez les erreurs 404 sur les images\n";
echo "4. Testez quelques contenus\n";

echo "\n✅ Diagnostic terminé !\n";
