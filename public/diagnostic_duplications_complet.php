<?php
/**
 * SCRIPT DE DIAGNOSTIC DES DUPLICATIONS
 * Ce script analyse la base de données ET le code pour trouver la source des duplications
 */

// Configuration
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Chargement de Laravel
$autoloadPath = __DIR__ . '/../../vendor/autoload.php';
$bootstrapPath = __DIR__ . '/../../bootstrap/app.php';

if (!file_exists($autoloadPath) || !file_exists($bootstrapPath)) {
    die("<h1 style='color:red;'>Erreur: Laravel non trouvé. Vérifiez que vous êtes dans le dossier public.</h1>");
}

require_once $autoloadPath;
$app = require_once $bootstrapPath;
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// HTML et CSS
echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔍 Diagnostic des Duplications</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: "Segoe UI", system-ui, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #e8112d, #c00e26);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .header h1 {
            font-size: 2.8em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .header h2 {
            font-size: 1.3em;
            font-weight: 300;
            opacity: 0.9;
        }
        .section {
            margin: 25px;
            padding: 25px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 5px solid;
        }
        .section.primary { border-color: #667eea; }
        .section.danger { border-color: #e8112d; }
        .section.warning { border-color: #ffc107; }
        .section.success { border-color: #28a745; }
        .section-title {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: bold;
            margin-left: 10px;
        }
        .badge-danger { background: #e8112d; color: white; }
        .badge-warning { background: #ffc107; color: #333; }
        .badge-success { background: #28a745; color: white; }
        .badge-info { background: #17a2b8; color: white; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }
        th {
            background: #edf2f7;
            color: #4a5568;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
        }
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }
        tr:hover { background: #f7fafc; }
        .duplicate-row { background: #fff3cd !important; }
        .exact-duplicate { background: #f8d7da !important; }
        .code-block {
            background: #1a202c;
            color: #e2e8f0;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
            font-family: "Consolas", "Monaco", monospace;
            margin: 15px 0;
            font-size: 14px;
            line-height: 1.5;
        }
        .problem {
            background: #fff5f5;
            border: 2px solid #fed7d7;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .solution {
            background: #f0fff4;
            border: 2px solid #c6f6d5;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        .summary-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            text-align: center;
            border-top: 4px solid;
        }
        .summary-card.danger { border-color: #e8112d; }
        .summary-card.warning { border-color: #ffc107; }
        .summary-card.success { border-color: #28a745; }
        .summary-card.info { border-color: #17a2b8; }
        .summary-card h3 {
            font-size: 2em;
            margin: 10px 0;
            color: #2d3748;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin: 10px 5px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn:hover {
            background: #5a67d8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .btn-danger { background: #e8112d; }
        .btn-danger:hover { background: #c00e26; }
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            font-weight: 500;
        }
        .alert-danger {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            color: #c53030;
        }
        .alert-success {
            background: #f0fff4;
            border: 1px solid #c6f6d5;
            color: #276749;
        }
        .section-content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔍 Diagnostic des Duplications</h1>
            <h2>Base de données propre mais affichage dupliqué - Analyse complète</h2>
            <p>Date: ' . date('d/m/Y H:i:s') . ' | Environnement: ' . app()->environment() . '</p>
        </div>';

try {
    // ============================
    // SECTION 1: BASE DE DONNÉES
    // ============================
    echo '<div class="section primary">
            <div class="section-title">
                📊 Analyse de la Base de Données
            </div>
            <div class="section-content">';

    // 1.1 Tables disponibles
    $tables = ['contenus', 'regions', 'categories', 'langues', 'media', 'users'];
    echo '<h3>1.1 Tables disponibles et statistiques:</h3>
          <table>
            <tr><th>Table</th><th>Statut</th><th>Enregistrements</th><th>Duplications</th></tr>';

    foreach ($tables as $table) {
        if (Schema::hasTable($table)) {
            $count = DB::table($table)->count();
            
            // Vérifier les duplications pour les tables principales
            if ($table === 'contenus') {
                $duplicates = DB::table($table)
                    ->select('titre', DB::raw('COUNT(*) as count'))
                    ->groupBy('titre')
                    ->having('count', '>', 1)
                    ->count();
            } elseif ($table === 'regions') {
                $duplicates = DB::table($table)
                    ->select('nom', DB::raw('COUNT(*) as count'))
                    ->groupBy('nom')
                    ->having('count', '>', 1)
                    ->count();
            } elseif ($table === 'categories') {
                $duplicates = DB::table($table)
                    ->select('nom', DB::raw('COUNT(*) as count'))
                    ->groupBy('nom')
                    ->having('count', '>', 1)
                    ->count();
            } else {
                $duplicates = 0;
            }
            
            $status = $duplicates > 0 ? "<span class='badge badge-danger'>$duplicates duplications</span>" : "<span class='badge badge-success'>OK</span>";
            echo "<tr><td><strong>$table</strong></td><td>✅ Existe</td><td>$count</td><td>$status</td></tr>";
        } else {
            echo "<tr><td><strong>$table</strong></td><td>❌ Manquante</td><td>0</td><td>-</td></tr>";
        }
    }
    echo '</table>';

    // 1.2 Contenus spécifiques
    echo '<h3>1.2 Détail des contenus:</h3>';
    $contenus = DB::table('contenus')
        ->select('id', 'titre', 'created_at')
        ->orderBy('id')
        ->get();
    
    if ($contenus->count() > 0) {
        echo '<p><strong>Total contenus en base:</strong> ' . $contenus->count() . '</p>';
        echo '<table>
                <tr><th>ID</th><th>Titre</th><th>Date création</th><th>Doublons titre</th></tr>';
        
        // Vérifier les doublons de titre
        $titres = [];
        foreach ($contenus as $c) {
            $titres[] = $c->titre;
        }
        $titresCounts = array_count_values($titres);
        
        foreach ($contenus as $c) {
            $isDuplicate = $titresCounts[$c->titre] > 1;
            $rowClass = $isDuplicate ? 'duplicate-row' : '';
            $duplicateBadge = $isDuplicate ? "<span class=\"badge badge-danger\">Doublon</span>" : "";
            
            echo "<tr class=\"$rowClass\">
                    <td>{$c->id}</td>
                    <td>{$c->titre} $duplicateBadge</td>
                    <td>{$c->created_at}</td>
                    <td>{$titresCounts[$c->titre]}</td>
                  </tr>";
        }
        echo '</table>';
        
        // Résumé des doublons de titre
        $exactDuplicates = 0;
        foreach ($titresCounts as $titre => $count) {
            if ($count > 1) {
                $exactDuplicates++;
                echo "<div class=\"problem\">
                        <strong>❌ Doublon exact trouvé:</strong> \"$titre\" apparaît $count fois
                      </div>";
            }
        }
        
        if ($exactDuplicates === 0) {
            echo '<div class="alert-success">
                    ✅ Aucun doublon exact de titre trouvé dans la base de données
                  </div>';
        }
    }

    // 1.3 Régions
    echo '<h3>1.3 Détail des régions:</h3>';
    if (Schema::hasTable('regions')) {
        $regions = DB::table('regions')
            ->select('id', 'nom', 'code')
            ->orderBy('id')
            ->get();
        
        echo '<table>
                <tr><th>ID</th><th>Nom</th><th>Code</th><th>Statut</th></tr>';
        
        $regionNoms = [];
        foreach ($regions as $r) {
            $regionNoms[] = $r->nom;
        }
        $regionCounts = array_count_values($regionNoms);
        
        foreach ($regions as $r) {
            $isDuplicate = $regionCounts[$r->nom] > 1;
            $rowClass = $isDuplicate ? 'duplicate-row' : '';
            $duplicateBadge = $isDuplicate ? "<span class=\"badge badge-danger\">Doublon</span>" : "";
            
            echo "<tr class=\"$rowClass\">
                    <td>{$r->id}</td>
                    <td>{$r->nom} $duplicateBadge</td>
                    <td>{$r->code}</td>
                    <td>{$regionCounts[$r->nom]} occurrence(s)</td>
                  </tr>";
        }
        echo '</table>';
    }

    // 1.4 Relations entre tables
    echo '<h3>1.4 Relations et intégrité:</h3>';
    
    // Vérifier les contenus sans médias
    $contenusSansMedia = DB::table('contenus')
        ->leftJoin('media', 'contenus.id', '=', 'media.id_contenu')
        ->whereNull('media.id')
        ->count();
    
    // Vérifier les médias orphelins
    $mediasOrphelins = DB::table('media')
        ->leftJoin('contenus', 'media.id_contenu', '=', 'contenus.id')
        ->whereNull('contenus.id')
        ->count();
    
    echo "<div class=\"summary-grid\">
            <div class=\"summary-card " . ($contenusSansMedia > 0 ? "warning" : "success") . "\">
                <h3>$contenusSansMedia</h3>
                <p>Contenus sans média</p>
            </div>
            <div class=\"summary-card " . ($mediasOrphelins > 0 ? "warning" : "success") . "\">
                <h3>$mediasOrphelins</h3>
                <p>Médias orphelins</p>
            </div>
          </div>";

    echo '</div></div>'; // Fin section base de données

    // ============================
    // SECTION 2: CODE LARAVEL
    // ============================
    echo '<div class="section danger">
            <div class="section-title">
                💻 Analyse du Code Source
            </div>
            <div class="section-content">';

    // 2.1 Chercher les contrôleurs
    $controllersPath = __DIR__ . '/../../app/Http/Controllers';
    $controllers = [];
    
    if (is_dir($controllersPath)) {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($controllersPath));
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $controllers[] = $file->getPathname();
            }
        }
    }
    
    echo '<h3>2.1 Contrôleurs trouvés (' . count($controllers) . '):</h3>';
    
    if (count($controllers) > 0) {
        echo '<ul>';
        foreach ($controllers as $controller) {
            $shortPath = str_replace(__DIR__ . '/../../', '', $controller);
            echo "<li>$shortPath</li>";
            
            // Analyser le contrôleur pour des problèmes potentiels
            $content = file_get_contents($controller);
            
            // Chercher des patterns problématiques
            $patterns = [
                'with\(.*?\).*?with\(.*?\)' => 'Chargements multiples (N+1 queries)',
                'get\(\)->each' => 'Collection each après get()',
                'all\(\)->each' => 'Collection each après all()',
                'Contenu::with' => 'Chargement de Contenu avec relations',
                'Region::all\(\)' => 'Chargement de toutes les régions',
                'Category::all\(\)' => 'Chargement de toutes les catégories'
            ];
            
            foreach ($patterns as $pattern => $description) {
                if (preg_match("/$pattern/", $content)) {
                    echo "<div class=\"problem\">
                            <strong>⚠️ Problème potentiel:</strong> $description dans $shortPath
                          </div>";
                }
            }
        }
        echo '</ul>';
    }

    // 2.2 Chercher les modèles
    $modelsPath = __DIR__ . '/../../app/Models';
    $models = [];
    
    if (is_dir($modelsPath)) {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($modelsPath));
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $models[] = $file->getPathname();
            }
        }
    }
    
    echo '<h3>2.2 Modèles trouvés (' . count($models) . '):</h3>';
    
    if (count($models) > 0) {
        foreach ($models as $model) {
            $shortPath = str_replace(__DIR__ . '/../../', '', $model);
            $content = file_get_contents($model);
            
            echo "<h4>$shortPath</h4>";
            
            // Extraire le nom de la classe
            preg_match('/class\s+(\w+)/', $content, $matches);
            $className = $matches[1] ?? 'Inconnu';
            
            // Chercher les relations
            if (preg_match_all('/public\s+function\s+(\w+)\(\)/', $content, $functions)) {
                echo "<p><strong>Relations/Méthodes:</strong> " . implode(', ', $functions[1]) . "</p>";
                
                // Vérifier les relations spécifiques
                foreach ($functions[1] as $function) {
                    if (in_array($function, ['contenus', 'regions', 'categories', 'medias', 'region', 'categorie'])) {
                        $functionContent = '';
                        $lines = explode("\n", $content);
                        $found = false;
                        
                        foreach ($lines as $line) {
                            if (strpos($line, "function $function") !== false) {
                                $found = true;
                            }
                            if ($found) {
                                $functionContent .= $line . "\n";
                                if (strpos($line, '}') !== false && substr_count($functionContent, '{') === substr_count($functionContent, '}')) {
                                    break;
                                }
                            }
                        }
                        
                        // Vérifier le type de relation
                        if (strpos($functionContent, 'hasMany') !== false) {
                            echo "<div class=\"alert-success\">
                                    ✅ $className::$function() → relation hasMany
                                  </div>";
                        } elseif (strpos($functionContent, 'belongsToMany') !== false) {
                            echo "<div class=\"warning\">
                                    ⚠️ $className::$function() → relation belongsToMany (peut causer des duplications si mal utilisée)
                                  </div>";
                        } elseif (strpos($functionContent, 'belongsTo') !== false) {
                            echo "<div class=\"alert-success\">
                                    ✅ $className::$function() → relation belongsTo
                                  </div>";
                        }
                    }
                }
            }
        }
    }

    // 2.3 Chercher les vues Blade problématiques
    echo '<h3>2.3 Recherche de vues Blade problématiques:</h3>';
    
    $viewsPath = __DIR__ . '/../../resources/views';
    $problematicViews = [];
    
    if (is_dir($viewsPath)) {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsPath));
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $content = file_get_contents($file->getPathname());
                
                // Chercher des patterns problématiques dans Blade
                $bladePatterns = [
                    '/@foreach.*?@foreach/s' => 'Boucles foreach imbriquées sans besoin',
                    '/@foreach.*?\$contenus.*?@endforeach.*?@foreach.*?\$contenus/s' => 'Double boucle sur la même variable',
                    '/@foreach.*?\$regions.*?@endforeach.*?@foreach.*?\$regions/s' => 'Double boucle sur les régions',
                    '/@foreach.*?\$categories.*?@endforeach.*?@foreach.*?\$categories/s' => 'Double boucle sur les catégories'
                ];
                
                foreach ($bladePatterns as $pattern => $description) {
                    if (preg_match($pattern, $content, $matches)) {
                        $shortPath = str_replace(__DIR__ . '/../../', '', $file->getPathname());
                        $problematicViews[$shortPath][] = $description;
                    }
                }
            }
        }
    }
    
    if (count($problematicViews) > 0) {
        echo '<div class="problem">';
        echo '<h4>❌ Vues problématiques trouvées:</h4>';
        foreach ($problematicViews as $view => $problems) {
            echo "<p><strong>$view</strong></p>";
            echo '<ul>';
            foreach ($problems as $problem) {
                echo "<li>$problem</li>";
            }
            echo '</ul>';
        }
        echo '</div>';
    } else {
        echo '<div class="alert-success">✅ Aucune vue problématique trouvée</div>';
    }

    echo '</div></div>'; // Fin section code

    // ============================
    // SECTION 3: DIAGNOSTIC DES REQUÊTES
    // ============================
    echo '<div class="section warning">
            <div class="section-title">
                📡 Analyse des Requêtes SQL
            </div>
            <div class="section-content">';

    // Activer le log des requêtes
    DB::enableQueryLog();

    // 3.1 Simuler une requête typique de contenu
    echo '<h3>3.1 Simulation de requêtes:</h3>';
    
    try {
        // Essayer de charger les contenus comme le ferait votre application
        $contenusTest = DB::table('contenus')
            ->leftJoin('media', 'contenus.id', '=', 'media.id_contenu')
            ->select('contenus.*', 'media.chemin as media_chemin')
            ->limit(5)
            ->get();
        
        echo '<p><strong>Requête test exécutée:</strong> Chargement de 5 contenus avec leurs médias</p>';
        
        // Récupérer les logs de requêtes
        $queries = DB::getQueryLog();
        
        echo '<h4>Requêtes SQL exécutées:</h4>';
        echo '<div class="code-block">';
        foreach ($queries as $query) {
            $sql = $query['query'];
            $bindings = $query['bindings'];
            
            // Remplacer les bindings
            foreach ($bindings as $binding) {
                $sql = preg_replace('/\?/', "'$binding'", $sql, 1);
            }
            
            echo htmlspecialchars($sql) . ";\n\n";
        }
        echo '</div>';
        
        // 3.2 Vérifier les requêtes en double
        echo '<h3>3.2 Analyse des requêtes potentielles en double:</h3>';
        
        // Examiner les requêtes typiques de votre application
        $commonPatterns = [
            'SELECT \* FROM regions' => 'Chargement des régions',
            'SELECT \* FROM categories' => 'Chargement des catégories',
            'SELECT \* FROM contenus' => 'Chargement des contenus'
        ];
        
        $foundDuplicates = false;
        foreach ($commonPatterns as $pattern => $description) {
            $count = 0;
            foreach ($queries as $query) {
                $sql = $query['query'];
                if (stripos($sql, $pattern) !== false) {
                    $count++;
                }
            }
            
            if ($count > 1) {
                echo "<div class=\"problem\">
                        <strong>❌ Problème:</strong> $description exécutée $count fois
                      </div>";
                $foundDuplicates = true;
            }
        }
        
        if (!$foundDuplicates) {
            echo '<div class="alert-success">✅ Aucune requête en double détectée dans le test</div>';
        }
        
    } catch (Exception $e) {
        echo '<div class="problem">Erreur lors de la simulation: ' . $e->getMessage() . '</div>';
    }

    echo '</div></div>'; // Fin section requêtes

    // ============================
    // SECTION 4: CONCLUSIONS ET SOLUTIONS
    // ============================
    echo '<div class="section success">
            <div class="section-title">
                💡 Conclusions et Solutions
            </div>
            <div class="section-content">';

    // 4.1 Résumé des problèmes
    echo '<h3>4.1 Problèmes identifiés:</h3>';
    
    $problems = [];
    
    // Vérifier les doublons dans la base
    $titresDoublons = DB::table('contenus')
        ->select('titre', DB::raw('COUNT(*) as count'))
        ->groupBy('titre')
        ->having('count', '>', 1)
        ->count();
    
    if ($titresDoublons > 0) {
        $problems[] = 'Doublons exacts dans la table contenus';
    }
    
    // Vérifier les vues problématiques
    if (count($problematicViews) > 0) {
        $problems[] = 'Vues Blade avec boucles potentiellement dupliquées';
    }
    
    // Vérifier les contenus sans média
    if ($contenusSansMedia > 0) {
        $problems[] = "$contenusSansMedia contenus sans média associé";
    }
    
    if (count($problems) > 0) {
        echo '<ul>';
        foreach ($problems as $problem) {
            echo "<li>❌ $problem</li>";
        }
        echo '</ul>';
    } else {
        echo '<div class="alert-success">✅ Aucun problème majeur identifié dans la base</div>';
    }

    // 4.2 Solutions recommandées
    echo '<h3>4.2 Solutions recommandées:</h3>';
    
    echo '<div class="solution">
            <h4>Solution 1: Vérifier votre contrôleur principal</h4>
            <p>Le problème vient probablement de votre contrôleur qui charge les données plusieurs fois.</p>
            <div class="code-block">
// MAUVAIS - Peut causer des duplications:
public function index() {
    $contenus = Contenu::all();
    $regions = Region::all();
    $categories = Category::all();
    
    // Puis dans une autre méthode ou plus tard...
    $contenus = Contenu::with(\'media\')->get(); // Duplication!
    
    return view(\'explorer\', compact(\'contenus\', \'regions\', \'categories\'));
}

// BON - Chargement unique:
public function index() {
    $contenus = Contenu::with([\'media\', \'region\', \'categorie\'])->get();
    $regions = Region::all();
    $categories = Category::all();
    
    return view(\'explorer\', compact(\'contenus\', \'regions\', \'categories\'));
}
            </div>
          </div>';
    
    echo '<div class="solution">
            <h4>Solution 2: Vérifier votre vue Blade</h4>
            <p>Recherchez des boucles dupliquées dans vos fichiers Blade:</p>
            <div class="code-block">
{{-- MAUVAIS --}}
@foreach($contenus as $contenu)
    {{-- Affichage --}}
@endforeach

{{-- Plus loin dans le même fichier --}}
@foreach($contenus as $contenu) {{-- DUPLICATION! --}}
    {{-- Autre affichage --}}
@endforeach

{{-- BON --}}
@foreach($contenus as $contenu)
    {{-- Tout l\'affichage pour ce contenu ici --}}
    <div class="contenu">
        <h3>{{ $contenu->titre }}</h3>
        <p>{{ $contenu->description }}</p>
        {{-- ... --}}
    </div>
@endforeach
            </div>
          </div>';
    
    echo '<div class="solution">
            <h4>Solution 3: Vérifier les middlewares et les composants</h4>
            <p>Un middleware ou un composant Livewire/Blade peut charger les données plusieurs fois.</p>
            <div class="code-block">
// Vérifiez vos middlewares:
php artisan route:list

// Cherchez dans app/Http/Kernel.php
// Vérifiez les composants dans resources/views/components/
            </div>
          </div>';

    // 4.3 Script de nettoyage
    echo '<h3>4.3 Script de nettoyage (si nécessaire):</h3>';
    
    echo '<div class="code-block">
// Pour nettoyer les doublons exacts de la table contenus:
DELETE c1 FROM contenus c1
INNER JOIN contenus c2 
WHERE 
    c1.id > c2.id AND 
    c1.titre = c2.titre AND
    c1.description = c2.description;

// Pour voir ce qui serait supprimé d\'abord:
SELECT c1.* FROM contenus c1
INNER JOIN contenus c2 
WHERE 
    c1.id > c2.id AND 
    c1.titre = c2.titre;
        </div>';

    echo '</div></div>'; // Fin section conclusions

    // ============================
    // SECTION 5: TESTS FINAUX
    // ============================
    echo '<div class="section primary">
            <div class="section-title">
                🧪 Tests Finaux
            </div>
            <div class="section-content">';

    echo '<h3>Test 1: Chargement des données comme le ferait votre site</h3>';
    
    // Simuler le chargement typique
    try {
        // Compter les requêtes
        DB::flushQueryLog();
        DB::enableQueryLog();
        
        // Chargement type 1: Contenus avec relations
        $testContenus = DB::table('contenus')->count();
        
        // Chargement type 2: Régions
        $testRegions = DB::table('regions')->count();
        
        // Chargement type 3: Catégories
        $testCategories = Schema::hasTable('categories') ? DB::table('categories')->count() : 0;
        
        $queries = DB::getQueryLog();
        
        echo "<p><strong>Résultats:</strong></p>";
        echo "<ul>
                <li>Contenus: $testContenus</li>
                <li>Régions: $testRegions</li>
                <li>Catégories: $testCategories</li>
                <li>Requêtes SQL exécutées: " . count($queries) . "</li>
              </ul>";
        
        if (count($queries) > 3) {
            echo '<div class="problem">
                    <strong>⚠️ Attention:</strong> Trop de requêtes pour un chargement simple.
                    Cela peut indiquer des chargements multiples.
                  </div>';
        }
        
    } catch (Exception $e) {
        echo '<div class="problem">Erreur: ' . $e->getMessage() . '</div>';
    }

    echo '<h3>Test 2: Vérification du cache</h3>';
    
    // Vérifier le cache Laravel
    $cachePath = __DIR__ . '/../../storage/framework/cache';
    if (is_dir($cachePath)) {
        $cacheFiles = count(glob("$cachePath/*"));
        echo "<p>Fichiers dans le cache: $cacheFiles</p>";
        
        if ($cacheFiles > 100) {
            echo '<div class="warning">
                    <p>⚠️ Cache Laravel volumineux. Essayez de le vider:</p>
                    <div class="code-block">
php artisan cache:clear
php artisan config:clear  
php artisan view:clear
                    </div>
                  </div>';
        }
    }

    echo '</div></div>'; // Fin section tests

} catch (Exception $e) {
    echo '<div class="section danger">
            <div class="section-title">
                ❌ Erreur Critique
            </div>
            <div class="section-content">
                <p>Une erreur est survenue pendant le diagnostic:</p>
                <div class="code-block">' . htmlspecialchars($e->getMessage()) . '</div>
                <p>Fichier: ' . $e->getFile() . ' (Ligne: ' . $e->getLine() . ')</p>
            </div>
          </div>';
}

echo '
    <div class="section">
        <div style="text-align: center; padding: 30px;">
            <button onclick="window.location.reload()" class="btn">🔄 Rafraîchir le diagnostic</button>
            <button onclick="window.print()" class="btn">🖨️ Imprimer ce rapport</button>
            <br><br>
            <small>⚠️ Ce script est temporaire. Supprimez-le après usage.</small>
        </div>
    </div>
</div>
</body>
</html>';
