# Dockerfile Laravel - CORRIGÉ
FROM php:8.2-alpine

WORKDIR /var/www/html

# Installer extensions et Composer
RUN apk add --no-cache curl \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# Installer Laravel SANS exécuter les scripts
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Configurer Laravel POUR MySQL (pas SQLite)
RUN cp .env.example .env \
    && sed -i "s/APP_ENV=production/APP_ENV=local/" .env \
    && sed -i "s/APP_DEBUG=false/APP_DEBUG=true/" .env \
    # ASSUREZ-VOUS D'UTILISER MYSQL, PAS SQLITE
    && sed -i "s/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/" .env \
    && php artisan key:generate --force \
    && mkdir -p storage/framework/{sessions,views,cache} \
    && chmod -R 775 storage bootstrap/cache

# CRÉER UN INDEX.PHP QUI FONCTIONNE
RUN cat > public/index.php << 'EOF'
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>🚀 Laravel Application</h1>";
echo "<p>PHP: " . phpversion() . "</p>";
echo "<p>Time: " . date('Y-m-d H:i:s') . "</p>";

try {
    // Vérifier les extensions
    if (!extension_loaded('pdo_mysql')) {
        throw new Exception('PDO MySQL extension not loaded!');
    }
    
    define('LARAVEL_START', microtime(true));
    
    require __DIR__.'/../vendor/autoload.php';
    echo "<p style='color:green;'>✓ Vendor loaded</p>";
    
    $app = require_once __DIR__.'/../bootstrap/app.php';
    echo "<p style='color:green;'>✓ App loaded</p>";
    
    // Éviter les erreurs de cache
    $app->make('config')->set('cache.default', 'array');
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle($request = Illuminate\Http\Request::capture());
    $response->send();
    $kernel->terminate($request, $response);
    
} catch (Exception $e) {
    echo "<h2 style='color:red;'>ERROR:</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    
    // Afficher le .env
    echo "<h3>.env content:</h3>";
    if (file_exists(__DIR__.'/../.env')) {
        echo "<pre>" . htmlspecialchars(file_get_contents(__DIR__.'/../.env')) . "</pre>";
    }
}
EOF

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
