# Dockerfile Laravel - Version simplifiée et fonctionnelle
FROM php:8.2-alpine

WORKDIR /var/www/html

# Installer extensions et Composer
RUN apk add --no-cache curl \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier l'application AVANT de créer le script
COPY . .

# Créer le script de démarrage
RUN echo '#!/bin/sh' > /start.sh && \
    echo 'echo "=== Starting Laravel Application ==="' >> /start.sh && \
    echo 'echo "Working directory: $(pwd)"' >> /start.sh && \
    echo 'echo "PHP version: $(php --version | head -1)"' >> /start.sh && \
    echo 'echo "Listening on port: ${PORT:-8080}"' >> /start.sh && \
    echo '' >> /start.sh && \
    echo '# Vérifier les fichiers' >> /start.sh && \
    echo 'if [ ! -f "public/index.php" ]; then' >> /start.sh && \
    echo '    echo "ERROR: public/index.php not found!"' >> /start.sh && \
    echo '    ls -la public/' >> /start.sh && \
    echo '    exit 1' >> /start.sh && \
    echo 'fi' >> /start.sh && \
    echo '' >> /start.sh && \
    echo '# Démarrer le serveur PHP' >> /start.sh && \
    echo 'exec php -S 0.0.0.0:${PORT:-8080} -t public' >> /start.sh && \
    chmod +x /start.sh

# Installer Laravel
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Configurer Laravel
RUN cp .env.example .env \
    && php artisan key:generate --force \
    && mkdir -p storage/framework/{sessions,views,cache} \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

# Utiliser le script
CMD ["/start.sh"]
