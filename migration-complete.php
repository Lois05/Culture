<?php
// migration-complete.php - MIGRATION FINALE QUI MARCHE
echo "🚀 MIGRATION COMPLÈTE CLOUDINARY\n";
echo "================================\n\n";

// Configuration MANUELLE - Mets tes vraies clés ici
$config = [
    'api_key' => '882645721268122',
    'api_secret' => 'u4FGjNnB0K9RSRiTuRdEJlkYQRQ',
    'cloud_name' => 'drzud4wye'
];

echo "🌐 Cloud: {$config['cloud_name']}\n";
echo "🔑 API Key: {$config['api_key']}\n\n";

// Vérifier le dossier images
$image_dir = 'public/adminlte/img';
if (!is_dir($image_dir)) {
    die("❌ Dossier non trouvé: $image_dir\n");
}

// Lister les images
echo "📁 Recherche des images...\n";
$images = [];
$files = scandir($image_dir);

foreach ($files as $file) {
    if ($file === '.' || $file === '..') continue;

    $path = $image_dir . '/' . $file;
    if (is_dir($path)) continue;

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
        $images[] = $file;
    }
}

$total = count($images);
echo "✅ $total images trouvées\n\n";

if ($total === 0) {
    die("❌ Aucune image\n");
}

// Confirmation
echo "⚠️  Prêt à migrer $total images ?\n";
echo "Tape 'MIGRATE' pour confirmer: ";
$input = trim(fgets(STDIN));

if (strtoupper($input) !== 'MIGRATE') {
    die("Annulé\n");
}

// Charger Laravel
echo "\n⚙️  Connexion base de données...\n";
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
echo "✅ Base connectée\n\n";

// Démarrer
echo "🚀 Démarrage...\n\n";

$success = 0;
$failed = 0;

foreach ($images as $i => $filename) {
    $current = $i + 1;
    $percent = round(($current / $total) * 100);

    // Barre de progression
    $bar = "[";
    for ($j = 0; $j < 30; $j++) {
        if ($j < ($percent / 3.33)) {
            $bar .= "#";
        } else {
            $bar .= ".";
        }
    }
    $bar .= "]";

    echo "$bar $percent% ($current/$total) $filename\n";

    $filepath = $image_dir . '/' . $filename;

    if (!file_exists($filepath)) {
        echo "   ❌ Manquant\n";
        $failed++;
        continue;
    }

    // UPLOAD - Méthode SIMPLE (sans folder)
    $timestamp = time();
    $public_id = cleanName($filename) . '_' . $timestamp;

    // Signature SIMPLE
    $string_to_sign = "public_id=$public_id&timestamp=$timestamp" . $config['api_secret'];
    $signature = sha1($string_to_sign);

    // cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.cloudinary.com/v1_1/{$config['cloud_name']}/upload");
    curl_setopt($ch, CURLOPT_POST, true);

    $post_data = [
        'file' => new CURLFile($filepath),
        'api_key' => $config['api_key'],
        'timestamp' => $timestamp,
        'public_id' => $public_id,
        'signature' => $signature
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code === 200) {
        $data = json_decode($response, true);
        $cloud_url = $data['secure_url'];

        echo "   ✅ " . $cloud_url . "\n";
        $success++;

        // Mettre à jour DB
        DB::table('medias')->where('chemin', $filename)->update([
            'cloudinary_url' => $cloud_url,
            'has_cloudinary' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->where('photo', 'like', "%$filename%")->update([
            'cloudinary_url' => $cloud_url,
            'has_cloudinary' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

    } else {
        echo "   ❌ HTTP $http_code\n";
        $failed++;
    }

    // Pause
    if ($current % 5 === 0) sleep(1);
    if ($current % 20 === 0) {
        sleep(2);
        echo "   ⏸️\n";
    }
}

// Résumé
echo "\n" . str_repeat("=", 50) . "\n";
echo "🎉 TERMINÉ !\n";
echo str_repeat("=", 50) . "\n";
echo "✅ Succès: $success\n";
echo "❌ Échecs: $failed\n";
echo "📁 Total: $total\n\n";

if ($success > 0) {
    echo "✨ MIGRATION RÉUSSIE !\n";
    echo "Tes images sont sur Cloudinary.\n";

    // Exemple
    $example = DB::table('medias')->whereNotNull('cloudinary_url')->first();
    if ($example) {
        echo "🔗 Exemple: " . $example->cloudinary_url . "\n";
    }
}

function cleanName($filename) {
    $name = pathinfo($filename, PATHINFO_FILENAME);
    $name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
    return substr($name, 0, 50);
}
