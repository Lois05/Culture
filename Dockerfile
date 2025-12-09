# Dockerfile - Affiche toutes les infos
FROM php:8.2-alpine

WORKDIR /var/www/html

RUN apk add --no-cache curl mysql-client \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-scripts

# Script de démarrage avec tests
RUN echo '#!/bin/sh\n\
echo "=== ENVIRONMENT ==="\n\
env | grep -E "(DB_|APP_|MYSQL_)" | sort\n\
echo ""\n\
echo "=== TESTING MYSQL CONNECTION ==="\n\
if mysql --host="${DB_HOST}" --port="${DB_PORT}" --user="${DB_USERNAME}" --password="${DB_PASSWORD}" --execute="SELECT 1;" 2>&1; then\n\
    echo "✅ MySQL connection SUCCESS"\n\
else\n\
    echo "❌ MySQL connection FAILED"\n\
fi\n\
echo ""\n\
echo "=== STARTING PHP SERVER ==="\n\
exec php -S 0.0.0.0:8080 -t public\n\
' > /start.sh && chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]
