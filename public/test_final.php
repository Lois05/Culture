<?php
require_once __DIR__ . '/../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test 1: Média avec URL Cloudinary
$media = (object) [
    'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157101/roi_gbehanzin.jpg',
    'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157101/roi_gbehanzin.jpg'
];

$result = \App\Helpers\CloudinaryHelper::media($media);
echo "Test 1 (URL Cloudinary): " . $result . "<br>";

// Test 2: Média null
$result2 = \App\Helpers\CloudinaryHelper::media(null);
echo "Test 2 (null): " . $result2 . "<br>";

// Test 3: Média avec chemin Cloudinary (sans domaine)
$media3 = (object) [
    'chemin' => 'v1766157101/roi_gbehanzin.jpg',
    'cloudinary_url' => null
];
$result3 = \App\Helpers\CloudinaryHelper::media($media3);
echo "Test 3 (chemin Cloudinary): " . $result3 . "<br>";

// Vérifier qu'aucun test ne retourne beninwest
if (strpos($result, 'beninwest') === false && strpos($result2, 'beninwest') === false && strpos($result3, 'beninwest') === false) {
    echo "<h2 style='color:green;'>✅ Tous les tests passent, beninwest n'est plus utilisé par défaut!</h2>";
} else {
    echo "<h2 style='color:red;'>❌ Il y a encore un problème</h2>";
}
