# Dockerfile Laravel pour Render - prêt à déployer

FROM webdevops/php-nginx:8.2

# Répertoire de travail
WORKDIR /app

# Racine web
ENV WEB_DOCUMENT_ROOT /app/public

# Copier tout le projet
COPY . /app

# Installer les dépendances PHP via Composer
RUN composer install --no-dev --optimize-autoloader

# Mettre en cache la config et les routes
RUN php artisan config:cache
RUN php artisan route:cache

# Exposer le port HTTP
EXPOSE 80

# Commande corrigée : démarrer à la fois Nginx et PHP-FPM
CMD php artisan migrate --force && supervisord -c /opt/docker/etc/supervisor.conf
