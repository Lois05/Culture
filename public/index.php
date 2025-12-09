<?php
// public/index.php - Mode debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>🔧 Laravel Debug Mode</h1>";

try {
    define('LARAVEL_START', microtime(true));
    
    require __DIR__.'/../vendor/autoload.php';
    echo "<p style='color:green;'>✓ Vendor loaded</p>";
    
    $app = require_once __DIR__.'/../bootstrap/app.php';
    echo "<p style='color:green;'>✓ App loaded</p>";
    
    // Tester la connexion à la base de données
    echo "<h3>Testing Database Connection:</h3>";
    $dbHost = getenv('DB_HOST');
    $dbPort = getenv('DB_PORT');
    $dbUser = getenv('DB_USERNAME');
    $dbPass = getenv('DB_PASSWORD');
    $dbName = getenv('DB_DATABASE');
    
    echo "DB_HOST: " . ($dbHost ?: 'NOT SET') . "<br>";
    echo "DB_PORT: " . ($dbPort ?: 'NOT SET') . "<br>";
    echo "DB_USERNAME: " . ($dbUser ?: 'NOT SET') . "<br>";
    echo "DB_DATABASE: " . ($dbName ?: 'NOT SET') . "<br>";
    echo "DB_PASSWORD: " . ($dbPass ? 'SET' : 'NOT SET') . "<br>";
    
    // Essayer de se connecter
    if ($dbHost && $dbUser) {
        $dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8mb4";
        try {
            $pdo = new PDO($dsn, $dbUser, $dbPass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            echo "<p style='color:green;'>✓ Database connection successful!</p>";
        } catch (PDOException $e) {
            echo "<p style='color:red;'>✗ Database connection failed: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "<p style='color:green;'>✓ Kernel created</p>";
    
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    
    $response->send();
    $kernel->terminate($request, $response);
    
} catch (Exception $e) {
    echo "<h2 style='color:red;'>❌ FATAL ERROR:</h2>";
    echo "<pre style='background:#fdd;padding:10px;'>";
    echo htmlspecialchars($e->getMessage()) . "\n\n";
    echo htmlspecialchars($e->getTraceAsString());
    echo "</pre>";
}
?>
