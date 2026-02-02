<?php
/**
 * SCRIPT DE DIAGNOSTIC DES DUPLICATIONS - Version sans Laravel
 * Se connecte directement à la base de données
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuration de la base de données (à adapter selon votre configuration)
$dbConfig = [
    'host' => 'localhost',
    'database' => 'beninculturel', // ou 'culture' selon votre base
    'username' => 'root',
    'password' => '', // Mot de passe de votre MySQL
    'charset' => 'utf8mb4'
];

echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔍 Diagnostic Direct des Duplications</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        h1 { color: #e8112d; border-bottom: 3px solid #e8112d; padding-bottom: 10px; }
        h2 { color: #555; margin-top: 30px; }
        .error { color: red; font-weight: bold; }
        .success { color: green; }
        .warning { color: orange; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th { background: #e8112d; color: white; padding: 12px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        tr:hover { background: #f9f9f9; }
        .duplicate { background: #fff3cd; }
        .exact-duplicate { background: #f8d7da; }
        pre { background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto; }
        .section { border: 1px solid #ddd; padding: 20px; margin: 20px 0; border-radius: 8px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Diagnostic Direct des Duplications</h1>
        <p><strong>Date:</strong> ' . date('d/m/Y H:i:s') . '</p>';

try {
    // Connexion à la base de données
    $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']};charset={$dbConfig['charset']}";
    $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo '<div class="success">✅ Connexion à la base de données réussie</div>';

    // ============================================
    // SECTION 1: ANALYSE DE LA BASE DE DONNÉES
    // ============================================
    echo '<div class="section">
            <h2>1. Analyse de la Base de Données</h2>';

    // 1.1 Liste des tables
    echo '<h3>1.1 Tables disponibles:</h3>';
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo '<table><tr><th>Table</th><th>Nombre d\'enregistrements</th></tr>';
    foreach ($tables as $table) {
        $countStmt = $pdo->query("SELECT COUNT(*) as count FROM `$table`");
        $count = $countStmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "<tr><td><strong>$table</strong></td><td>$count</td></tr>";
    }
    echo '</table>';

    // 1.2 Analyse des contenus
    echo '<h3>1.2 Analyse de la table "contenus":</h3>';
    
    // Vérifier si la table existe
    if (in_array('contenus', $tables)) {
        // Compter les contenus
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM contenus");
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        echo "<p><strong>Total contenus:</strong> $total</p>";
        
        // Vérifier les duplications de titre
        echo '<h4>Duplications de titre:</h4>';
        $stmt = $pdo->query("
            SELECT titre, COUNT(*) as occurrences 
            FROM contenus 
            GROUP BY titre 
            HAVING occurrences > 1 
            ORDER BY occurrences DESC
        ");
        $duplicateTitles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($duplicateTitles) > 0) {
            echo '<p class="error">❌ ' . count($duplicateTitles) . ' titres dupliqués trouvés:</p>';
            echo '<table><tr><th>Titre</th><th>Occurrences</th><th>IDs</th></tr>';
            
            foreach ($duplicateTitles as $dup) {
                // Récupérer les IDs des contenus dupliqués
                $idStmt = $pdo->prepare("SELECT id FROM contenus WHERE titre = ?");
                $idStmt->execute([$dup['titre']]);
                $ids = $idStmt->fetchAll(PDO::FETCH_COLUMN);
                
                echo '<tr class="exact-duplicate">';
                echo '<td>' . htmlspecialchars($dup['titre']) . '</td>';
                echo '<td>' . $dup['occurrences'] . '</td>';
                echo '<td>' . implode(', ', $ids) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p class="success">✅ Aucun titre dupliqué trouvé</p>';
        }
        
        // Afficher tous les contenus
        echo '<h4>Tous les contenus (premiers 50):</h4>';
        $stmt = $pdo->query("SELECT id, titre, created_at FROM contenus ORDER BY id LIMIT 50");
        $allContenus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo '<table><tr><th>ID</th><th>Titre</th><th>Date création</th></tr>';
        foreach ($allContenus as $contenu) {
            echo '<tr>';
            echo '<td>' . $contenu['id'] . '</td>';
            echo '<td>' . htmlspecialchars(mb_substr($contenu['titre'], 0, 60)) . (strlen($contenu['titre']) > 60 ? '...' : '') . '</td>';
            echo '<td>' . $contenu['created_at'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p class="error">Table "contenus" non trouvée</p>';
    }

    // 1.3 Analyse des régions
    echo '<h3>1.3 Analyse de la table "regions":</h3>';
    
    if (in_array('regions', $tables)) {
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM regions");
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        echo "<p><strong>Total régions:</strong> $total</p>";
        
        // Vérifier les duplications de nom de région
        $stmt = $pdo->query("
            SELECT nom, COUNT(*) as occurrences 
            FROM regions 
            GROUP BY nom 
            HAVING occurrences > 1 
            ORDER BY occurrences DESC
        ");
        $duplicateRegions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($duplicateRegions) > 0) {
            echo '<p class="error">❌ ' . count($duplicateRegions) . ' régions dupliquées trouvées:</p>';
            echo '<table><tr><th>Nom région</th><th>Occurrences</th><th>IDs</th></tr>';
            
            foreach ($duplicateRegions as $dup) {
                $idStmt = $pdo->prepare("SELECT id FROM regions WHERE nom = ?");
                $idStmt->execute([$dup['nom']]);
                $ids = $idStmt->fetchAll(PDO::FETCH_COLUMN);
                
                echo '<tr class="duplicate">';
                echo '<td>' . htmlspecialchars($dup['nom']) . '</td>';
                echo '<td>' . $dup['occurrences'] . '</td>';
                echo '<td>' . implode(', ', $ids) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p class="success">✅ Aucune région dupliquée trouvée</p>';
        }
        
        // Afficher toutes les régions
        echo '<h4>Toutes les régions:</h4>';
        $stmt = $pdo->query("SELECT id, nom, code FROM regions ORDER BY id");
        $allRegions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo '<table><tr><th>ID</th><th>Nom</th><th>Code</th></tr>';
        foreach ($allRegions as $region) {
            echo '<tr>';
            echo '<td>' . $region['id'] . '</td>';
            echo '<td>' . htmlspecialchars($region['nom']) . '</td>';
            echo '<td>' . $region['code'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p class="warning">Table "regions" non trouvée</p>';
    }

    // 1.4 Analyse des médias
    echo '<h3>1.4 Analyse de la table "medias" ou "media":</h3>';
    
    $mediaTable = null;
    if (in_array('medias', $tables)) {
        $mediaTable = 'medias';
    } elseif (in_array('media', $tables)) {
        $mediaTable = 'media';
    }
    
    if ($mediaTable) {
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM `$mediaTable`");
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        echo "<p><strong>Total médias dans '$mediaTable':</strong> $total</p>";
        
        // Vérifier les doublons de chemin
        $stmt = $pdo->query("
            SELECT chemin, cloudinary_url, COUNT(*) as occurrences 
            FROM `$mediaTable` 
            WHERE chemin IS NOT NULL OR cloudinary_url IS NOT NULL
            GROUP BY chemin, cloudinary_url 
            HAVING occurrences > 1 
            ORDER BY occurrences DESC
            LIMIT 10
        ");
        $duplicateMedias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($duplicateMedias) > 0) {
            echo '<p class="error">❌ ' . count($duplicateMedias) . ' médias dupliqués trouvés:</p>';
            echo '<table><tr><th>Chemin</th><th>URL Cloudinary</th><th>Occurrences</th></tr>';
            
            foreach ($duplicateMedias as $dup) {
                echo '<tr class="duplicate">';
                echo '<td>' . htmlspecialchars(substr($dup['chemin'] ?? '', 0, 50)) . '</td>';
                echo '<td>' . htmlspecialchars(substr($dup['cloudinary_url'] ?? '', 0, 50)) . '</td>';
                echo '<td>' . $dup['occurrences'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p class="success">✅ Aucun média dupliqué trouvé</p>';
        }
        
        // Vérifier la relation avec les contenus
        echo '<h4>Relation médias-contenus:</h4>';
        
        // Vérifier la colonne de clé étrangère
        $stmt = $pdo->query("DESCRIBE `$mediaTable`");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        $foreignKey = null;
        if (in_array('contenu_id', $columns)) {
            $foreignKey = 'contenu_id';
        } elseif (in_array('id_contenu', $columns)) {
            $foreignKey = 'id_contenu';
        }
        
        if ($foreignKey) {
            // Compter les contenus sans médias
            $stmt = $pdo->query("
                SELECT COUNT(DISTINCT c.id) as total_contenus,
                       SUM(CASE WHEN m.id IS NULL THEN 1 ELSE 0 END) as contenus_sans_media
                FROM contenus c
                LEFT JOIN `$mediaTable` m ON c.id = m.$foreignKey
            ");
            $stats = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo "<p><strong>Contenus sans média:</strong> " . $stats['contenus_sans_media'] . " sur " . $stats['total_contenus'] . "</p>";
            
            // Vérifier les médias orphelins
            $stmt = $pdo->query("
                SELECT COUNT(*) as medias_orphelins
                FROM `$mediaTable` m
                LEFT JOIN contenus c ON m.$foreignKey = c.id
                WHERE c.id IS NULL
            ");
            $orphelins = $stmt->fetch(PDO::FETCH_ASSOC)['medias_orphelins'];
            
            if ($orphelins > 0) {
                echo '<p class="warning">⚠️ ' . $orphelins . ' médias orphelins (sans contenu associé)</p>';
            }
        }
    } else {
        echo '<p class="warning">Tables "medias" et "media" non trouvées</p>';
    }

    // 1.5 Vérification de l'intégrité des données
    echo '<h3>1.5 Vérification de l\'intégrité des données:</h3>';
    
    // Vérifier les clés étrangères
    if (in_array('contenus', $tables)) {
        // Vérifier si la table a une colonne region_id
        $stmt = $pdo->query("DESCRIBE contenus");
        $contenuColumns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (in_array('region_id', $contenuColumns)) {
            $stmt = $pdo->query("
                SELECT COUNT(*) as regions_invalides
                FROM contenus c
                LEFT JOIN regions r ON c.region_id = r.id
                WHERE c.region_id IS NOT NULL AND r.id IS NULL
            ");
            $invalidRegions = $stmt->fetch(PDO::FETCH_ASSOC)['regions_invalides'];
            
            if ($invalidRegions > 0) {
                echo '<p class="error">❌ ' . $invalidRegions . ' contenus avec region_id invalide</p>';
            }
        }
    }

    echo '</div>'; // Fin section base de données

    // ============================================
    // SECTION 2: ANALYSE DES FICHIERS PHP
    // ============================================
    echo '<div class="section">
            <h2>2. Analyse des Fichiers PHP</h2>';
    
    $projectRoot = dirname(dirname(__FILE__));
    
    // 2.1 Chercher les contrôleurs
    echo '<h3>2.1 Recherche des contrôleurs:</h3>';
    $controllersPath = $projectRoot . '/app/Http/Controllers';
    
    if (is_dir($controllersPath)) {
        $controllers = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($controllersPath));
        
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $controllers[] = $file->getPathname();
            }
        }
        
        echo '<p><strong>' . count($controllers) . ' contrôleurs trouvés</strong></p>';
        
        // Analyser un par un les contrôleurs importants
        $importantControllers = ['ExplorerController', 'ContenuController', 'HomeController'];
        
        foreach ($controllers as $controller) {
            $filename = basename($controller);
            foreach ($importantControllers as $important) {
                if (strpos($filename, $important) !== false) {
                    echo '<h4>Analyse de: ' . $filename . '</h4>';
                    
                    $content = file_get_contents($controller);
                    
                    // Chercher des patterns problématiques
                    $patterns = [
                        '/with\([^)]*\)[^{}]*with\([^)]*\)/s' => 'Chargements multiples avec with()',
                        '/get\(\)[^{}]*each/s' => 'each() après get()',
                        '/all\(\)[^{}]*each/s' => 'each() après all()',
                        '/Contenu::[^(]*\([^)]*\)[^{}]*Contenu::/s' => 'Chargements multiples de Contenu',
                        '/Region::[^(]*\([^)]*\)[^{}]*Region::/s' => 'Chargements multiples de Region'
                    ];
                    
                    foreach ($patterns as $pattern => $description) {
                        if (preg_match($pattern, $content, $matches)) {
                            echo '<div class="warning">⚠️ ' . $description . ' détecté</div>';
                            echo '<pre>' . htmlspecialchars(substr($matches[0], 0, 200)) . '...</pre>';
                        }
                    }
                    
                    // Extraire les méthodes publiques
                    preg_match_all('/public\s+function\s+(\w+)\s*\(/', $content, $functions);
                    if (!empty($functions[1])) {
                        echo '<p>Méthodes publiques: ' . implode(', ', $functions[1]) . '</p>';
                    }
                }
            }
        }
    } else {
        echo '<p class="warning">Dossier des contrôleurs non trouvé: ' . $controllersPath . '</p>';
    }

    // 2.2 Chercher les vues
    echo '<h3>2.2 Recherche des vues problématiques:</h3>';
    $viewsPath = $projectRoot . '/resources/views';
    
    if (is_dir($viewsPath)) {
        // Chercher les fichiers blade d'exploration
        $bladeFiles = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsPath));
        
        foreach ($iterator as $file) {
            if ($file->isFile() && preg_match('/\.blade\.php$/', $file->getFilename())) {
                $bladeFiles[] = $file->getPathname();
            }
        }
        
        echo '<p><strong>' . count($bladeFiles) . ' fichiers Blade trouvés</strong></p>';
        
        // Chercher des vues avec "explor" dans le nom
        $explorerViews = [];
        foreach ($bladeFiles as $file) {
            if (stripos($file, 'explor') !== false) {
                $explorerViews[] = $file;
            }
        }
        
        if (count($explorerViews) > 0) {
            echo '<h4>Vues d\'exploration trouvées:</h4>';
            foreach ($explorerViews as $view) {
                $relativePath = str_replace($projectRoot, '', $view);
                echo '<p>' . $relativePath . '</p>';
                
                // Analyser la vue pour des boucles dupliquées
                $content = file_get_contents($view);
                
                // Chercher des boucles foreach
                preg_match_all('/@foreach\s*\(([^)]+)\)/', $content, $foreachMatches);
                
                if (!empty($foreachMatches[1])) {
                    echo '<p>Boucles foreach trouvées:</p>';
                    echo '<ul>';
                    foreach ($foreachMatches[1] as $foreach) {
                        echo '<li>@foreach(' . htmlspecialchars(trim($foreach)) . ')</li>';
                    }
                    echo '</ul>';
                    
                    // Vérifier les doublons
                    $foreachVars = array_map('trim', $foreachMatches[1]);
                    $counts = array_count_values($foreachVars);
                    
                    foreach ($counts as $var => $count) {
                        if ($count > 1) {
                            echo '<div class="error">❌ Variable dupliquée dans les boucles: ' . $var . ' (' . $count . ' fois)</div>';
                        }
                    }
                }
            }
        } else {
            // Chercher d'autres vues susceptibles d'afficher les contenus
            echo '<h4>Analyse des vues courantes:</h4>';
            $commonViews = ['index.blade.php', 'home.blade.php', 'welcome.blade.php'];
            
            foreach ($commonViews as $commonView) {
                $viewPath = $viewsPath . '/' . $commonView;
                if (file_exists($viewPath)) {
                    echo '<p>Analyse de: ' . $commonView . '</p>';
                    
                    $content = file_get_contents($viewPath);
                    if (strpos($content, '$contenus') !== false) {
                        echo '<div class="warning">⚠️ Variable $contenus détectée dans ' . $commonView . '</div>';
                    }
                    if (strpos($content, '$regions') !== false) {
                        echo '<div class="warning">⚠️ Variable $regions détectée dans ' . $commonView . '</div>';
                    }
                }
            }
        }
    } else {
        echo '<p class="warning">Dossier des vues non trouvé: ' . $viewsPath . '</p>';
    }

    echo '</div>'; // Fin section fichiers PHP

    // ============================================
    // SECTION 3: CONCLUSIONS
    // ============================================
    echo '<div class="section">
            <h2>3. Conclusions et Recommandations</h2>';
    
    echo '<h3>Problèmes les plus probables:</h3>';
    echo '<ol>
            <li><strong>Contrôleur qui charge plusieurs fois les données</strong> - Vérifiez vos contrôleurs pour des appels en double à la base</li>
            <li><strong>Vue Blade avec boucles dupliquées</strong> - Une même variable bouclée plusieurs fois</li>
            <li><strong>Composant Livewire/Blade qui se répète</strong> - Un composant inclus plusieurs fois</li>
            <li><strong>Middleware qui ajoute des données à chaque requête</strong> - Un middleware qui charge des données globales</li>
            <li><strong>Cache problématique</strong> - Données mises en cache et réutilisées de façon incorrecte</li>
          </ol>';
    
    echo '<h3>Solutions immédiates:</h3>';
    echo '<pre>
1. VIDEZ LES CACHES:
   - php artisan cache:clear
   - php artisan config:clear
   - php artisan view:clear
   - Effacez le cache navigateur (Ctrl+F5)

2. VÉRIFIEZ VOS CONTRÔLEURS:
   - Cherchez des appels en double à Contenu::all(), Region::all(), etc.
   - Utilisez dd($contenus) en début de vue pour voir ce qui est réellement envoyé

3. VÉRIFIEZ VOS VUES:
   - Cherchez des @foreach en double sur les mêmes variables
   - Vérifiez les inclusions de composants

4. VÉRIFIEZ LES ROUTES:
   - Une route pourrait pointer vers deux contrôleurs différents
   - Un middleware pourrait être appliqué plusieurs fois
    </pre>';

    echo '</div>'; // Fin section conclusions

} catch (PDOException $e) {
    echo '<div class="error">❌ Erreur de connexion à la base de données: ' . $e->getMessage() . '</div>';
    echo '<p>Vérifiez votre configuration de base de données dans le script.</p>';
} catch (Exception $e) {
    echo '<div class="error">❌ Erreur: ' . $e->getMessage() . '</div>';
}

echo '
    </div>
    <div style="text-align: center; margin: 30px;">
        <button onclick="window.location.reload()" style="padding: 10px 20px; background: #e8112d; color: white; border: none; border-radius: 5px; cursor: pointer;">
            🔄 Rafraîchir le diagnostic
        </button>
    </div>
</body>
</html>';
