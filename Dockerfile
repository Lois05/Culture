# Image Laravel + Nginx qui fonctionne parfaitement sur Render
FROM webdevops/php-nginx:8.2

# Installer les dépendances système
RUN apk add --no-cache \
    curl \
    git \
    zip \
    unzip \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    postgresql-dev

# Définir la racine web (public/)
ENV WEB_DOCUMENT_ROOT=/app/public

# Copier tous les fichiers du projet
COPY . /app

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Permissions Laravel
RUN chmod -R 775 storage bootstrap/cache

# Générer la clé Laravel (si elle n'existe pas déjà)
RUN php artisan key:generate --force

# Cache Laravel
RUN php artisan config:cache || true
RUN php artisan route:cache || true

# Exposer le port web
EXPOSE 80

# Démarrer PHP-FPM (Nginx se lance automatiquement dans l’image)
CMD php artisan migrate --force && supervisord -c /opt/docker/etc/supervisor.conf

