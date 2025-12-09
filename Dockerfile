# Dockerfile Laravel - Version corrigée sans erreur de syntaxe
FROM php:8.2-alpine

WORKDIR /var/www/html

# Installer extensions et Composer
RUN apk add --no-cache curl \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier l'application
COPY . .

# Créer .env minimal (sans erreur de syntaxe)
RUN echo "APP_ENV=production" > .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_KEY=base64:Gti3PRAou+Mmqb+65OrPIxKlrD+Wc49jVY5po76oBp0=" >> .env

# Installer dépendances
RUN composer install --no-dev --optimize-autoloader

# Préparer Laravel
RUN mkdir -p storage/framework/{sessions,views,cache} && \
    chmod -R 775 storage bootstrap/cache && \
    php artisan config:cache && \
    php artisan route:cache

EXPOSE 8080

# COMMANDE SIMPLE et SANS ERREUR
CMD php -S 0.0.0.0:8080 -t /var/www/html/public
