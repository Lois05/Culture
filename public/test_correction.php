<?php
// Test immédiat du CloudinaryHelper corrigé
require_once __DIR__ . '/../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "<h1>🧪 Test CloudinaryHelper - APRÈS CORRECTION</h1>";
echo "<style>
    body { font-family: Arial; padding: 20px; }
    .success { color: green; font-weight: bold; }
    .error { color: red; font-weight: bold; }
    .test { border: 1px solid #ccc; padding: 15px; margin: 10px 0; }
</style>";

// Test 1: Média avec URL Cloudinary complète (comme dans votre seed)
echo "<div class='test'>";
echo "<h3>Test 1: Média avec URL Cloudinary complète</h3>";
$media1 = (object) [
    'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157101/roi_gbehanzin.jpg',
    'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157101/roi_gbehanzin.jpg'
];
$result1 = \App\Helpers\CloudinaryHelper::media($media1);
echo "Entrée: " . json_encode($media1) . "<br>";
echo "Résultat: $result1<br>";

if (strpos($result1, 'beninwest') !== false) {
    echo "<span class='error'>❌ ÉCHEC: Retourne beninwest!</span>";
} elseif ($result1 === $media1->cloudinary_url) {
    echo "<span class='success'>✅ SUCCÈS: Retourne l'URL Cloudinary correcte!</span>";
} else {
    echo "<span class='error'>❌ ÉCHEC: Retourne autre chose: $result1</span>";
}
echo "</div>";

// Test 2: Média null
echo "<div class='test'>";
echo "<h3>Test 2: Média null</h3>";
$result2 = \App\Helpers\CloudinaryHelper::media(null);
echo "Résultat: $result2<br>";

if (strpos($result2, 'beninwest') !== false) {
    echo "<span class='error'>❌ ÉCHEC: default-content.jpg pointe encore vers beninwest!</span>";
} else {
    echo "<span class='success'>✅ SUCCÈS: N'utilise pas beninwest comme fallback</span>";
}
echo "</div>";

// Test 3: Média de la base de données réelle
echo "<div class='test'>";
echo "<h3>Test 3: Premier média de la base de données</h3>";
try {
    $dbMedia = \Illuminate\Support\Facades\DB::table('medias')->first();
    if ($dbMedia) {
        echo "ID: {$dbMedia->id}<br>";
        echo "Chemin: " . ($dbMedia->chemin ?: 'null') . "<br>";
        echo "Cloudinary URL: " . ($dbMedia->cloudinary_url ?: 'null') . "<br>";
        
        $result3 = \App\Helpers\CloudinaryHelper::media($dbMedia);
        echo "Résultat du helper: $result3<br>";
        
        if (strpos($result3, 'beninwest') !== false) {
            echo "<span class='error'>❌ ÉCHEC: Le helper ignore vos vraies images!</span>";
        } else {
            echo "<span class='success'>✅ SUCCÈS: Le helper utilise votre image Cloudinary</span>";
        }
    } else {
        echo "Aucun média dans la base de données";
    }
} catch (Exception $e) {
    echo "Erreur DB: " . $e->getMessage();
}
echo "</div>";

// Résumé
echo "<h2>📊 RÉSUMÉ DU TEST</h2>";
if (strpos($result1, 'beninwest') === false && strpos($result2, 'beninwest') === false) {
    echo "<p class='success'>✅ FÉLICITATIONS! Le problème beninwest est résolu!</p>";
} else {
    echo "<p class='error'>❌ Le problème persiste. Vérifiez votre CloudinaryHelper.php</p>";
}
