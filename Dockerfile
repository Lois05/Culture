# Dockerfile Laravel - Affiche les erreurs
FROM php:8.2-alpine

WORKDIR /var/www/html

# Installer extensions et Composer
RUN apk add --no-cache curl \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# Installer Laravel
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Configurer Laravel POUR LE DEBUG
RUN cp .env.example .env \
    && sed -i "s/APP_ENV=production/APP_ENV=local/" .env \
    && sed -i "s/APP_DEBUG=false/APP_DEBUG=true/" .env \
    && php artisan key:generate --force \
    && mkdir -p storage/framework/{sessions,views,cache} \
    && chmod -R 775 storage bootstrap/cache \
    && php artisan config:clear \
    && php artisan cache:clear

# CRÉER UN FICHIER QUI AFFICHE LES ERREURS
RUN cat > public/index.php << 'EOF'
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>🚀 Laravel Debug Mode</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Time: " . date('Y-m-d H:i:s') . "</p>";

try {
    define('LARAVEL_START', microtime(true));
    
    if (!file_exists(__DIR__.'/../vendor/autoload.php')) {
        throw new Exception('vendor/autoload.php not found!');
    }
    
    require __DIR__.'/../vendor/autoload.php';
    echo "<p style='color:green;'>✓ Vendor autoload loaded</p>";
    
    $app = require_once __DIR__.'/../bootstrap/app.php';
    echo "<p style='color:green;'>✓ Laravel app loaded</p>";
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "<p style='color:green;'>✓ Kernel loaded</p>";
    
    $response = $kernel->handle($request = Illuminate\Http\Request::capture());
    echo "<p style='color:green;'>✓ Request handled</p>";
    
    $response->send();
    $kernel->terminate($request, $response);
    
} catch (Exception $e) {
    echo "<h2 style='color:red;'>❌ ERROR:</h2>";
    echo "<pre>";
    echo htmlspecialchars($e->getMessage()) . "\n\n";
    echo htmlspecialchars($e->getTraceAsString());
    echo "</pre>";
    
    echo "<h3>Environment:</h3>";
    echo "<pre>";
    echo "DB_CONNECTION: " . (getenv('DB_CONNECTION') ?: 'NOT SET') . "\n";
    echo "DB_HOST: " . (getenv('DB_HOST') ?: 'NOT SET') . "\n";
    echo "APP_ENV: " . (getenv('APP_ENV') ?: 'NOT SET') . "\n";
    echo "</pre>";
}
EOF

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
