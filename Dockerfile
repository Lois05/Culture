# Dockerfile Laravel avec MySQL client
FROM php:8.2-alpine

WORKDIR /var/www/html

# Installer extensions PHP + MySQL client
RUN apk add --no-cache \
    curl \
    mysql-client \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# Tester la connexion MySQL au démarrage
RUN echo '#!/bin/sh\n\
echo "Testing MySQL connection..."\n\
if mysql --host="${DB_HOST}" --port="${DB_PORT}" --user="${DB_USERNAME}" --password="${DB_PASSWORD}" --execute="SELECT 1;" 2>/dev/null; then\n\
    echo "MySQL connection OK"\n\
else\n\
    echo "MySQL connection FAILED"\n\
fi\n\
php -S 0.0.0.0:8080 -t public\n\
' > /start.sh && chmod +x /start.sh

# Installer Laravel
RUN composer install --no-dev --optimize-autoloader --no-scripts \
    && cp .env.example .env \
    && php artisan key:generate --force \
    && mkdir -p storage/framework/{sessions,views,cache} \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD ["/start.sh"]
