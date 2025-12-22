<?php
// Script FINAL - Migre TOUTES les images utilisées vers Cloudinary
require_once 'vendor/autoload.php';

use Cloudinary\Cloudinary;

// 1. Configuration Cloudinary
$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'drzud4wye',
        'api_key'    => '882645721268122',
        'api_secret' => 'TON_API_SECRET_CLOUDINARY' // Mets ta clé ici
    ]
]);

// 2. Connexion base de données
$pdo = new PDO("mysql:host=localhost;dbname=culture;charset=utf8", "root", "");

echo "🚀 MIGRATION FINALE VERS CLOUDINARY\n";
echo "===================================\n\n";

// 3. Liste TOUTES les images utilisées dans ton site
$imagesToMigrate = [];

// A. Images dans la table `medias` (tes contenus)
$medias = $pdo->query("SELECT id_media, chemin FROM medias WHERE chemin IS NOT NULL")->fetchAll();
foreach ($medias as $media) {
    $imagesToMigrate[] = [
        'type' => 'media',
        'id' => $media['id_media'],
        'path' => $media['chemin'],
        'table' => 'medias',
        'id_field' => 'id_media'
    ];
}

// B. Photos dans la table `users`
$users = $pdo->query("SELECT id, photo FROM users WHERE photo IS NOT NULL")->fetchAll();
foreach ($users as $user) {
    $imagesToMigrate[] = [
        'type' => 'user',
        'id' => $user['id'],
        'path' => $user['photo'],
        'table' => 'users',
        'id_field' => 'id'
    ];
}

echo "📊 " . count($imagesToMigrate) . " images à traiter\n\n";

// 4. Migrer chaque image
foreach ($imagesToMigrate as $image) {
    $localPath = getLocalPath($image['path']);

    echo "🔍 " . $image['type'] . " - " . $image['path'] . "... ";

    if (file_exists($localPath)) {
        echo "📂 Fichier trouvé... ";

        try {
            // Upload vers Cloudinary
            $result = $cloudinary->uploadApi()->upload($localPath, [
                'folder' => 'culture-app/' . $image['type'] . 's',
                'use_filename' => true,
                'unique_filename' => false
            ]);

            $cloudinaryUrl = $result['secure_url'];

            // Mettre à jour la base de données
            $sql = "UPDATE {$image['table']} SET cloudinary_url = ?, has_cloudinary = 1 WHERE {$image['id_field']} = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$cloudinaryUrl, $image['id']]);

            echo "✅ Migré vers Cloudinary\n";
            echo "   🔗 {$cloudinaryUrl}\n";

        } catch (Exception $e) {
            echo "❌ Erreur: " . $e->getMessage() . "\n";
        }
    } else {
        echo "⚠️ Fichier non trouvé localement\n";

        // Vérifier si c'est déjà sur Cloudinary
        $checkSql = "SELECT cloudinary_url FROM {$image['table']} WHERE {$image['id_field']} = ? AND has_cloudinary = 1";
        $stmt = $pdo->prepare($checkSql);
        $stmt->execute([$image['id']]);
        $existing = $stmt->fetch();

        if ($existing && $existing['cloudinary_url']) {
            echo "   ℹ️ Déjà sur Cloudinary: {$existing['cloudinary_url']}\n";
        }
    }
}

echo "\n✨ MIGRATION TERMINÉE !\n";

// Fonction pour trouver le chemin local
function getLocalPath($dbPath) {
    // Si le chemin commence par storage/
    if (strpos($dbPath, 'storage/') === 0) {
        return 'public/' . $dbPath;
    }

    // Si c'est un chemin adminlte
    if (strpos($dbPath, 'adminlte/') === 0) {
        return 'public/' . $dbPath;
    }

    // Si c'est un chemin simple
    return 'public/storage/' . $dbPath;
}
?>
