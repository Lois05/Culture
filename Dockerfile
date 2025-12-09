# Dockerfile Laravel - Force les variables manquantes
FROM php:8.2-alpine

WORKDIR /var/www/html

RUN apk add --no-cache curl \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# FORCER les variables MySQL dans .env
RUN composer install --no-dev --optimize-autoloader --no-scripts \
    && cp .env.example .env \
    && echo "DB_CONNECTION=mysql" >> .env \
    && echo "DB_HOST=respect-wonder.railway.internal" >> .env \
    && echo "DB_PORT=3306" >> .env \
    && echo "DB_DATABASE=railway" >> .env \
    && echo "DB_USERNAME=root" >> .env \
    && echo "DB_PASSWORD=XsCCYyzyImuyXlZdNOhCFYDiBRqvZlXv" >> .env \
    && echo "APP_ENV=production" >> .env \
    && echo "APP_DEBUG=true" >> .env \
    && echo "APP_URL=https://culture-production-38e2.up.railway.app" >> .env \
    && php artisan key:generate --force \
    && mkdir -p storage/framework/{sessions,views,cache} \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
