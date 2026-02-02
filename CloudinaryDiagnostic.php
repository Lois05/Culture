<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CloudinaryDiagnostic
{
    public static function run()
    {
        echo '<style>
            body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
            .container { max-width: 1200px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
            h1 { color: #333; border-bottom: 3px solid #e8112d; padding-bottom: 10px; }
            h2 { color: #555; margin-top: 30px; }
            .error { color: red; font-weight: bold; }
            .success { color: green; }
            .warning { color: orange; }
            table { width: 100%; border-collapse: collapse; margin: 15px 0; }
            th { background: #e8112d; color: white; padding: 12px; text-align: left; }
            td { padding: 10px; border-bottom: 1px solid #ddd; }
            tr:hover { background: #f9f9f9; }
            .beninwest-row { background: #ffcccc !important; }
            .duplicate-row { background: #fff3cd !important; }
            pre { background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto; }
        </style>';
        
        echo '<div class="container">';
        echo '<h1>🔍 Diagnostic CloudinaryHelper - ' . date("d/m/Y H:i:s") . '</h1>';
        
        // SECTION 1: Analyse du helper
        echo '<h2>1. Analyse de CloudinaryHelper.php</h2>';
        
        $helperPath = app_path('Helpers/CloudinaryHelper.php');
        if (file_exists($helperPath)) {
            $content = file_get_contents($helperPath);
            $lines = explode("\n", $content);
            $beninwestCount = 0;
            $defaultImages = [];
            
            foreach ($lines as $num => $line) {
                if (strpos($line, 'beninwest') !== false) {
                    $beninwestCount++;
                    echo '<p class="error">Ligne ' . ($num + 1) . ': ' . htmlspecialchars(trim($line)) . '</p>';
                }
                if (preg_match("/'(default.*?)' => '(.*beninwest.*)'/", $line, $matches)) {
                    $defaultImages[] = $matches;
                }
            }
            
            echo '<p><strong>Occurrences de "beninwest":</strong> ' . $beninwestCount . '</p>';
            
            if (!empty($defaultImages)) {
                echo '<h3>Images par défaut problématiques:</h3>';
                echo '<table>';
                echo '<tr><th>Clé</th><th>URL</th><th>Problème</th></tr>';
                foreach ($defaultImages as $image) {
                    echo '<tr class="beninwest-row">';
                    echo '<td>' . $image[1] . '</td>';
                    echo '<td>' . $image[2] . '</td>';
                    echo '<td class="error">Utilise beninwest comme image par défaut</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            
            // Vérifier la méthode media()
            if (strpos($content, 'default-content.jpg') !== false) {
                echo '<p class="warning">⚠️ La méthode media() utilise default-content.jpg comme fallback</p>';
            }
        } else {
            echo '<p class="error">Fichier CloudinaryHelper.php non trouvé</p>';
        }
        
        // SECTION 2: Analyse de la base de données
        echo '<h2>2. Analyse de la base de données</h2>';
        
        try {
            // Vérifier les tables
            $tables = ['contenus', 'media', 'regions'];
            echo '<h3>Tables disponibles:</h3>';
            echo '<table>';
            echo '<tr><th>Table</th><th>Statut</th><th>Enregistrements</th></tr>';
            
            foreach ($tables as $table) {
                if (Schema::hasTable($table)) {
                    $count = DB::table($table)->count();
                    $status = '<span class="success">✅ Existe</span>';
                } else {
                    $count = 0;
                    $status = '<span class="error">❌ Manquante</span>';
                }
                echo "<tr><td>$table</td><td>$status</td><td>$count</td></tr>";
            }
            echo '</table>';
            
            // Analyser les contenus
            echo '<h3>Contenus et médias:</h3>';
            
            $contents = DB::table('contenus')
                ->leftJoin('media', 'contenus.id', '=', 'media.contenu_id')
                ->select('contenus.id', 'contenus.titre', DB::raw('COUNT(media.id) as media_count'))
                ->groupBy('contenus.id', 'contenus.titre')
                ->orderBy('contenus.id')
                ->limit(20)
                ->get();
            
            if ($contents->count() > 0) {
                echo '<table>';
                echo '<tr><th>ID</th><th>Titre</th><th>Nb médias</th><th>Problème</th></tr>';
                
                foreach ($contents as $content) {
                    $problem = '';
                    $rowClass = '';
                    
                    if ($content->media_count == 0) {
                        $problem = '❌ Aucun média';
                        $rowClass = 'duplicate-row';
                    } elseif ($content->media_count > 1) {
                        $problem = '⚠️ ' . $content->media_count . ' médias (possible duplication)';
                        $rowClass = 'duplicate-row';
                    } else {
                        $problem = '✅ OK';
                    }
                    
                    echo "<tr class='$rowClass'>";
                    echo "<td>{$content->id}</td>";
                    echo '<td>' . substr($content->titre, 0, 50) . (strlen($content->titre) > 50 ? '...' : '') . '</td>';
                    echo "<td>{$content->media_count}</td>";
                    echo "<td>$problem</td>";
                    echo '</tr>';
                }
                echo '</table>';
            }
            
            // Vérifier les duplications de médias
            echo '<h3>Duplications dans la table media:</h3>';
            $duplicates = DB::table('media')
                ->select('chemin', 'cloudinary_url', DB::raw('COUNT(*) as count'))
                ->whereNotNull('chemin')
                ->orWhereNotNull('cloudinary_url')
                ->groupBy('chemin', 'cloudinary_url')
                ->having('count', '>', 1)
                ->get();
            
            if ($duplicates->count() > 0) {
                echo '<p class="warning">⚠️ ' . $duplicates->count() . ' duplications trouvées</p>';
                echo '<table>';
                echo '<tr><th>Chemin</th><th>URL Cloudinary</th><th>Nombre</th></tr>';
                foreach ($duplicates as $dup) {
                    echo '<tr class="duplicate-row">';
                    echo '<td>' . ($dup->chemin ?: '<em>null</em>') . '</td>';
                    echo '<td>' . ($dup->cloudinary_url ?: '<em>null</em>') . '</td>';
                    echo "<td>{$dup->count}</td>";
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p class="success">✅ Aucune duplication de média trouvée</p>';
            }
            
        } catch (\Exception $e) {
            echo '<p class="error">Erreur de base de données: ' . $e->getMessage() . '</p>';
        }
        
        // SECTION 3: Test du helper
        echo '<h2>3. Test du CloudinaryHelper</h2>';
        
        echo '<h3>Test 1: Média null</h3>';
        $test1 = \App\Helpers\CloudinaryHelper::media(null);
        echo '<p>Résultat: ' . $test1 . '</p>';
        if (strpos($test1, 'beninwest') !== false) {
            echo '<p class="error">❌ PROBLEME: Retourne beninwest comme image par défaut</p>';
        } else {
            echo '<p class="success">✅ OK</p>';
        }
        
        echo '<h3>Test 2: Premier média de la base</h3>';
        try {
            $firstMedia = DB::table('media')->first();
            if ($firstMedia) {
                $test2 = \App\Helpers\CloudinaryHelper::media($firstMedia);
                echo '<p>Chemin: ' . ($firstMedia->chemin ?: '<em>null</em>') . '</p>';
                echo '<p>Cloudinary URL: ' . ($firstMedia->cloudinary_url ?: '<em>null</em>') . '</p>';
                echo '<p>Résultat: ' . $test2 . '</p>';
                
                if (strpos($test2, 'beninwest') !== false) {
                    echo '<p class="error">❌ GRAVE: Le helper ignore les vraies images et retourne beninwest!</p>';
                } else {
                    echo '<p class="success">✅ OK: Utilise l\'image correcte</p>';
                }
            }
        } catch (\Exception $e) {
            echo '<p>Impossible de tester: ' . $e->getMessage() . '</p>';
        }
        
        // SECTION 4: Solutions
        echo '<h2>4. Solutions recommandées</h2>';
        
        echo '<h3>Solution 1: Corriger les images par défaut</h3>';
        echo '<pre>';
        echo "Dans CloudinaryHelper.php, remplacez:\n\n";
        echo "'default-content.jpg' => '...beninwest_rj3d0o.jpg',\n";
        echo "'default.jpg' => '...beninwest_rj3d0o.jpg',\n\n";
        echo "Par:\n\n";
        echo "'default-content.jpg' => '...discoverbenin_vq9mik.jpg',\n";
        echo "'default.jpg' => '...discoverbenin_vq9mik.jpg',\n";
        echo '</pre>';
        
        echo '<h3>Solution 2: Vérifier les relations</h3>';
        echo '<p>Dans votre modèle Contenu.php, assurez-vous que:</p>';
        echo '<pre>';
        echo 'public function medias() {
    return $this->hasMany(Media::class, "contenu_id");
}';
        echo '</pre>';
        
        echo '<h3>Solution 3: Vérifier les contrôleurs</h3>';
        echo '<p>Dans vos contrôleurs, évitez les duplications:</p>';
        echo '<pre>';
        echo '// MAUVAIS (duplication):
$contenus = Contenu::with("medias")->with("region")->with("medias")->get();

// BON:
$contenus = Contenu::with(["medias", "region"])->get();';
        echo '</pre>';
        
        echo '</div>';
    }
}
