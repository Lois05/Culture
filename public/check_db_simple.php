<?php
// Script ultra simple pour vérifier la base de données
echo "<h1>Vérification ULTRA SIMPLE de la base</h1>";

// Configuration
$host = 'localhost';
$dbname = 'beninculturel'; // Changez selon votre base
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color:green;'>✅ Connecté à la base de données</p>";
    
    // Vérifier les tables
    echo "<h3>Tables disponibles:</h3>";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li>$table</li>";
    }
    echo "</ul>";
    
    // Vérifier les contenus
    if (in_array('contenus', $tables)) {
        $count = $pdo->query("SELECT COUNT(*) FROM contenus")->fetchColumn();
        echo "<p><strong>Nombre de contenus:</strong> $count</p>";
        
        // Afficher les 10 premiers
        $stmt = $pdo->query("SELECT id, titre FROM contenus ORDER BY id LIMIT 10");
        echo "<table border='1'><tr><th>ID</th><th>Titre</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>{$row['id']}</td><td>{$row['titre']}</td></tr>";
        }
        echo "</table>";
        
        // Vérifier les doublons
        $stmt = $pdo->query("SELECT titre, COUNT(*) as c FROM contenus GROUP BY titre HAVING c > 1");
        $duplicates = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($duplicates) > 0) {
            echo "<h3 style='color:red;'>❌ DOUBLONS TROUVÉS:</h3>";
            foreach ($duplicates as $dup) {
                echo "<p>{$dup['titre']} - {$dup['c']} fois</p>";
            }
        } else {
            echo "<p style='color:green;'>✅ Aucun doublon de titre</p>";
        }
    }
    
} catch (PDOException $e) {
    echo "<p style='color:red;'>❌ Erreur de connexion: " . $e->getMessage() . "</p>";
    echo "<p>Essayez avec le nom de base: 'culture'</p>";
    
    // Essayer avec 'culture'
    try {
        $pdo = new PDO("mysql:host=$host;dbname=culture;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p style='color:green;'>✅ Connecté à la base 'culture'</p>";
        
        // Mêmes vérifications...
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        echo "<h3>Tables dans 'culture':</h3><ul>";
        foreach ($tables as $table) {
            echo "<li>$table</li>";
        }
        echo "</ul>";
        
    } catch (PDOException $e2) {
        echo "<p style='color:red;'>❌ Impossible de se connecter à 'culture' non plus</p>";
    }
}
