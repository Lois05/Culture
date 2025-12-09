# Dockerfile Laravel - Production Ready
FROM php:8.2-fpm-alpine

# Installer les extensions PHP nécessaires pour Laravel
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    sqlite \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configuration Nginx
RUN mkdir -p /run/nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Configuration PHP-FPM
RUN echo 'listen = 9000' >> /usr/local/etc/php-fpm.d/zz-docker.conf

# Configuration Supervisor
COPY docker/supervisor.conf /etc/supervisor/conf.d/supervisor.conf

# Répertoire de travail
WORKDIR /var/www/html

# Copier l'application
COPY . .

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Configurer Laravel pour production
RUN cp .env.example .env \
    && php artisan key:generate --force \
    && mkdir -p storage/framework/{sessions,views,cache} \
    && chmod -R 775 storage bootstrap/cache \
    && php artisan config:cache \
    && php artisan route:cache

EXPOSE 8080

# Démarrer avec Supervisor
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisor.conf"]
