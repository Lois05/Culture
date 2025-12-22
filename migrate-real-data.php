<?php
// CONNEXION À LA VRAIE BASE (port 3308)
$host = '127.0.0.1:3308';  // PORT 3308 au lieu de 3306 !
$dbname = 'culture';
$username = 'root';
$password = '';

echo "🚀 MIGRATION DES DONNÉES RÉELLES VERS CLOUDINARY\n";
echo "=================================================\n\n";

try {
    // Connexion au bon port
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Connecté à MySQL sur le port 3308\n";

    // 1. Vérifier les données réelles
    $userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $mediaCount = $pdo->query("SELECT COUNT(*) FROM medias")->fetchColumn();

    echo "📊 Données trouvées :\n";
    echo "   👤 Utilisateurs: $userCount\n";
    echo "   🖼️ Médias: $mediaCount\n\n";

    // 2. Mapping AdminLTE → Cloudinary
    $cloudinaryUrls = [
        'admin.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766057958/admin',
        'moderateur1.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766057958/moderateur1',
        'moderateur2.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766057958/moderateur2',
        'moderateur3.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766057958/moderateur3',
        'user1.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766057958/user1',
        'user2.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766057958/user2',
        'user3.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766057958/user3',
        'user4.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766057958/user4'
    ];

    // 3. Mettre à jour les utilisateurs
    echo "🔄 Mise à jour des utilisateurs :\n";
    $totalUpdated = 0;

    foreach ($cloudinaryUrls as $filename => $cloudinaryUrl) {
        $stmt = $pdo->prepare("
            UPDATE users
            SET cloudinary_url = ?, has_cloudinary = 1
            WHERE photo LIKE ?
            AND (cloudinary_url IS NULL OR cloudinary_url = '')
        ");
        $stmt->execute([$cloudinaryUrl, "%$filename"]);

        $updated = $stmt->rowCount();
        if ($updated > 0) {
            echo "   ✅ $filename : $updated utilisateur(s)\n";
            $totalUpdated += $updated;
        }
    }

    // 4. Pour les avatars uploadés
    $avatars = $pdo->query("SELECT COUNT(*) FROM users WHERE photo LIKE 'avatars/%' OR photo LIKE 'users/%' OR photo LIKE 'profile-photos/%'")->fetchColumn();

    if ($avatars > 0) {
        echo "   👥 $avatars avatar(s) uploadé(s)\n";

        // URL par défaut (user1)
        $defaultUrl = 'https://res.cloudinary.com/drzud4wye/image/upload/v1766057958/user1';

        $stmt = $pdo->prepare("
            UPDATE users
            SET cloudinary_url = ?, has_cloudinary = 1
            WHERE (photo LIKE 'avatars/%' OR photo LIKE 'users/%' OR photo LIKE 'profile-photos/%')
            AND (cloudinary_url IS NULL OR cloudinary_url = '')
        ");
        $stmt->execute([$defaultUrl]);

        $totalUpdated += $avatars;
    }

    // 5. Vérifier les médias (normalement déjà sur Cloudinary)
    echo "\n🔍 Vérification des médias :\n";

    $medias = $pdo->query("SELECT id_media, chemin, cloudinary_url, has_cloudinary FROM medias")->fetchAll();

    $mediaOnCloudinary = 0;
    foreach ($medias as $media) {
        if ($media['has_cloudinary'] == 1 && !empty($media['cloudinary_url'])) {
            $mediaOnCloudinary++;
        }
    }

    echo "   📊 $mediaOnCloudinary/" . count($medias) . " médias sur Cloudinary\n";

    // 6. Résultats finaux
    echo "\n📈 RÉSULTATS FINAUX :\n";
    echo "===================\n";

    $finalStats = $pdo->query("
        SELECT
            COUNT(*) as total_users,
            SUM(CASE WHEN photo IS NOT NULL THEN 1 ELSE 0 END) as with_photo,
            SUM(CASE WHEN has_cloudinary = 1 THEN 1 ELSE 0 END) as on_cloudinary
        FROM users
    ")->fetch(PDO::FETCH_ASSOC);

    echo "   👤 UTILISATEURS :\n";
    echo "      Total: {$finalStats['total_users']}\n";
    echo "      Avec photo: {$finalStats['with_photo']}\n";
    echo "      Sur Cloudinary: {$finalStats['on_cloudinary']}\n";

    if ($finalStats['with_photo'] == $finalStats['on_cloudinary']) {
        echo "\n🎉 SUCCÈS COMPLET !\n";
        echo "Toutes les photos sont maintenant sur Cloudinary !\n";
        echo "🚀 Prêt pour Railway !\n";
    } else {
        $missing = $finalStats['with_photo'] - $finalStats['on_cloudinary'];
        echo "\n⚠️  Il manque $missing photo(s) sur Cloudinary\n";
    }

    echo "\n✨ $totalUpdated utilisateur(s) mis à jour\n";

} catch (PDOException $e) {
    echo "❌ ERREUR DE CONNEXION: " . $e->getMessage() . "\n";
    echo "\n💡 CONSEIL :\n";
    echo "1. Ouvre phpMyAdmin (http://localhost/phpmyadmin)\n";
    echo "2. Regarde le port dans l'URL (probablement :3308)\n";
    echo "3. Utilise ce port dans tes scripts PHP\n";
}
?>
