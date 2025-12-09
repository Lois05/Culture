# Dockerfile Laravel - Test connexion MySQL
FROM php:8.2-alpine

WORKDIR /var/www/html

RUN apk add --no-cache curl mysql-client \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# Script de démarrage avec test de connexion
RUN echo '#!/bin/sh\n\
echo "=== Testing MySQL Connection ==="\n\
echo "Host: ${DB_HOST}"\n\
echo "Port: ${DB_PORT}"\n\
echo "Database: ${DB_DATABASE}"\n\
echo "User: ${DB_USERNAME}"\n\
\n\
# Test de connexion\n\
if mysql --host="${DB_HOST}" --port=${DB_PORT} --user="${DB_USERNAME}" --password="${DB_PASSWORD}" --execute="SELECT 1;" 2>/dev/null; then\n\
    echo "✅ MySQL connection SUCCESS"\n\
else\n\
    echo "❌ MySQL connection FAILED"\n\
    echo "Trying without password..."\n\
    if mysql --host="${DB_HOST}" --port=${DB_PORT} --user="${DB_USERNAME}" --execute="SELECT 1;" 2>/dev/null; then\n\
        echo "✅ MySQL connection SUCCESS (no password)"\n\
    else\n\
        echo "❌ MySQL connection completely FAILED"\n\
    fi\n\
fi\n\
\n\
echo "=== Starting Laravel ==="\n\
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
