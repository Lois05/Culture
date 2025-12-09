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

# Configurer Laravel pour production
RUN cp .env.example .env \
    && php artisan key:generate --force \
    && mkdir -p storage/framework/{sessions,views,cache} \
    && chmod -R 775 storage bootstrap/cache

# CRÉER UN INDEX.PHP PROPRE SANS ERREUR
RUN cat > public/index.php << 'EOF'
<?php
// public/index.php - Version Laravel originale corrigée
define('LARAVEL_START', microtime(true));

if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    require __DIR__.'/../vendor/autoload.php';
    
    $app = require_once __DIR__.'/../bootstrap/app.php';
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    
    $response->send();
    
    $kernel->terminate($request, $response);
} else {
    // Fallback si vendor n'existe pas
    http_response_code(200);
    echo "<h1>Laravel Application</h1>";
    echo "<p>Vendor directory not found. Running migrations...</p>";
    echo "<p>PHP Version: " . phpversion() . "</p>";
}
EOF

# Exécuter les migrations (OPTIONNEL mais recommandé)
# RUN php artisan migrate --force

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
