# Dockerfile
FROM php:8.2-alpine

WORKDIR /var/www/html

# 1. Installer les dépendances système
RUN apk add --no-cache \
    curl \
    git \
    zip \
    unzip \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    libxml2-dev \
    postgresql-dev \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 2. Copier le code
COPY . .

# 3. Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 4. Configurer Laravel (sans .env)
RUN php artisan key:generate --force --no-interaction \
    && php artisan storage:link --quiet \
    && php artisan optimize:clear --quiet \
    && chmod -R 775 storage bootstrap/cache

# 5. Créer les répertoires nécessaires
RUN mkdir -p storage/framework/{sessions,views,cache}

# 6. Port d'exposition
EXPOSE 8080

# 7. Commande de démarrage
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
