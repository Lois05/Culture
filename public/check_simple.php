<?php
// Script simple pour vérifier rapidement les duplications
require_once __DIR__ . '/../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "<h1>Vérification rapide des duplications</h1>";
echo "<h3>Contenus dupliqués (même titre):</h3>";

$duplicateContenus = DB::table('contenus')
    ->select('titre', DB::raw('COUNT(*) as count'))
    ->groupBy('titre')
    ->having('count', '>', 1)
    ->get();

if ($duplicateContenus->count() > 0) {
    echo "<table border='1'><tr><th>Titre</th><th>Occurrences</th></tr>";
    foreach ($duplicateContenus as $dup) {
        echo "<tr><td>{$dup->titre}</td><td>{$dup->count}</td></tr>";
        
        // Montrer les IDs des duplications
        $ids = DB::table('contenus')
            ->where('titre', $dup->titre)
            ->pluck('id')
            ->toArray();
        echo "<tr><td colspan='2'>IDs: " . implode(', ', $ids) . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color:green;'>✅ Aucun contenu dupliqué dans la base</p>";
}

echo "<h3>Régions dupliquées:</h3>";
if (DB::getSchemaBuilder()->hasTable('regions')) {
    $duplicateRegions = DB::table('regions')
        ->select('nom', DB::raw('COUNT(*) as count'))
        ->groupBy('nom')
        ->having('count', '>', 1)
        ->get();
    
    if ($duplicateRegions->count() > 0) {
        echo "<table border='1'><tr><th>Région</th><th>Occurrences</th></tr>";
        foreach ($duplicateRegions as $dup) {
            echo "<tr><td>{$dup->nom}</td><td>{$dup->count}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color:green;'>✅ Aucune région dupliquée</p>";
    }
}

echo "<h3>Test: Affichage de tous les contenus</h3>";
$allContenus = DB::table('contenus')->select('id', 'titre')->orderBy('id')->get();
echo "<p>Nombre total de contenus en base: " . $allContenus->count() . "</p>";
echo "<table border='1'><tr><th>ID</th><th>Titre</th></tr>";
foreach ($allContenus as $c) {
    echo "<tr><td>{$c->id}</td><td>{$c->titre}</td></tr>";
}
echo "</table>";
