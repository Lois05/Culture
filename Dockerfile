# Dockerfile Laravel - PHP Serveur intégré (le plus simple)
FROM php:8.2-alpine

WORKDIR /var/www/html

# Installer juste les extensions et Composer
RUN apk add --no-cache curl \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier l'application
COPY . .

# Installer les dépendances
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Cache Laravel
RUN php artisan config:cache && php artisan route:cache

# Exposer le port
EXPOSE 8080

# Démarrer avec le serveur PHP intégré
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html/public"]
