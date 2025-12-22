<?php

// ============================================
// SCRIPT DE CORRECTION DES URLS MÉDIAS
// À exécuter sur Railway via terminal
// ============================================

require __DIR__."/vendor/autoload.php";
$app = require_once __DIR__."/bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=========================================\n";
echo "🔄 CORRECTION DES URLS MÉDIAS CLOUDINARY\n";
echo "=========================================\n\n";

// Vos 10 images Cloudinary
$cloudinaryImages = [
    "https://res.cloudinary.com/drzud4wye/image/upload/v1765979252/discoverbenin_vq9mik.jpg",
    "https://res.cloudinary.com/drzud4wye/image/upload/v1765979182/fresque_s4pcmz.jpg",
    "https://res.cloudinary.com/drzud4wye/image/upload/v1765979213/routeesclave_n5fo3i.webp",
    "https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg",
    "https://res.cloudinary.com/drzud4wye/image/upload/v1765979195/mosqueeporto_hdaiki.jpg",
    "https://res.cloudinary.com/drzud4wye/image/upload/v1765980140/royaumeabo_hiduap.webp",
    "https://res.cloudinary.com/drzud4wye/image/upload/v1765980111/independancegraph_erzbdw.jpg",
    "https://res.cloudinary.com/drzud4wye/image/upload/v1765978489/ancientemps_dqc9bc.jpg",
    "https://res.cloudinary.com/drzud4wye/image/upload/v1765980053/renaissance_js7sja.webp",
    "https://res.cloudinary.com/drzud4wye/image/upload/v1765980083/contemporain_qces9z.webp",
];

echo "📊 Récupération des médias...\n";
$medias = DB::table("medias")->get();
$totalMedias = $medias->count();

echo "✅ {$totalMedias} médias trouvés\n\n";
echo "🔄 Mise à jour en cours...\n";

$updated = 0;
foreach ($medias as $index => $media) {
    // Prendre une image différente pour chaque média (cyclique)
    $imageIndex = $index % count($cloudinaryImages);
    $newUrl = $cloudinaryImages[$imageIndex];
    
    // Mettre à jour
    DB::table("medias")
        ->where("id_media", $media->id_media)
        ->update([
            "chemin" => $newUrl,
            "cloudinary_url" => $newUrl,
            "updated_at" => now(),
        ]);
    
    $updated++;
    
    // Progress bar simple
    $percent = intval(($updated / $totalMedias) * 100);
    $progress = str_repeat("█", $percent / 5) . str_repeat("░", (100 - $percent) / 5);
    echo "\r[{$progress}] {$percent}% - Média {$media->id_media} mis à jour";
}

echo "\n\n";
echo "=========================================\n";
echo "🎉 CORRECTION TERMINÉE AVEC SUCCÈS !\n";
echo "=========================================\n";
echo "✅ {$updated}/{$totalMedias} médias mis à jour\n";
echo "🖼️ Images Cloudinary appliquées : " . count($cloudinaryImages) . "\n";
echo "🔗 Votre site utilise maintenant des images différentes\n";
echo "\n";
echo "📱 Pour vérifier :\n";
echo "1. Allez sur votre site Railway\n";
echo "2. Page /explorer\n";
echo "3. Les images doivent être différentes maintenant !\n";

// Vérification finale
echo "\n📋 VÉRIFICATION FINALE :\n";
$sampleMedias = DB::table("medias")->limit(3)->get();
foreach ($sampleMedias as $media) {
    echo "   - Média {$media->id_media} : " . substr($media->chemin, 0, 60) . "...\n";
}

echo "\n✅ Script terminé. Supprimez ce fichier après usage.\n";
?>
