# Dockerfile Laravel Simple - PHP seul
FROM php:8.2-alpine

WORKDIR /var/www/html

# Installer extensions et Composer
RUN apk add --no-cache \
    curl \
    sqlite \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# Installer Laravel
RUN composer install --no-dev --optimize-autoloader --no-scripts \
    && cp .env.example .env \
    && php artisan key:generate --force \
    && mkdir -p storage/framework/{sessions,views,cache} \
    && chmod -R 775 storage bootstrap/cache \
    && php artisan config:cache \
    && php artisan route:cache

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
