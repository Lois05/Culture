# Dockerfile avec SQLite - Ça va MARCHER
FROM php:8.2-alpine

WORKDIR /var/www/html

RUN apk add --no-cache curl sqlite \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# FORCER SQLite - Pas besoin de variables d'environnement
RUN composer install --no-dev --optimize-autoloader --no-scripts \
    && cp .env.example .env \
    # REMPLACER MySQL par SQLite
    && sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/' .env \
    && sed -i 's/DB_HOST=.*/DB_HOST=127.0.0.1/' .env \
    && sed -i 's/DB_PORT=.*/DB_PORT=3306/' .env \
    && sed -i 's/DB_DATABASE=.*/DB_DATABASE=database\/database.sqlite/' .env \
    && sed -i 's/DB_USERNAME=.*/DB_USERNAME=/' .env \
    && sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=/' .env \
    && touch database/database.sqlite \
    && php artisan key:generate --force \
    && mkdir -p storage/framework/{sessions,views,cache} \
    && chmod -R 775 storage bootstrap/cache \
    && php artisan migrate --force

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
