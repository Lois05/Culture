FROM webdevops/php-nginx:8.2

WORKDIR /app

# Copier tout le projet
COPY . /app

# Installer les dépendances Composer
RUN composer install --optimize-autoloader --no-dev

# Donner les permissions à Laravel
RUN chmod -R 775 storage bootstrap/cache

# Générer la clé Laravel
RUN php artisan key:generate

# Cache config + routes
RUN php artisan config:cache
RUN php artisan route:cache

# Exposer le port
EXPOSE 80
