# Dockerfile Laravel - Écoute sur le port 8080
FROM php:8.2-fpm

WORKDIR /var/www/html

# Installer Nginx et extensions PHP
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    && docker-php-ext-install pdo pdo_mysql

# Configuration Nginx pour le port 8080
RUN echo 'server {\n\
    listen 8080;\n\
    server_name _;\n\
    root /var/www/html/public;\n\
    index index.php index.html;\n\
\n\
    location / {\n\
        try_files $uri $uri/ /index.php?$query_string;\n\
    }\n\
\n\
    location ~ \.php$ {\n\
        fastcgi_pass 127.0.0.1:9000;\n\
        fastcgi_index index.php;\n\
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;\n\
        include fastcgi_params;\n\
    }\n\
}' > /etc/nginx/sites-available/default

# Activer le site et configurer Nginx
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/ \
    && echo "daemon off;" >> /etc/nginx/nginx.conf

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier l'application
COPY . .

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Mettre en cache la configuration Laravel
RUN php artisan config:cache && php artisan route:cache

# Exposer le port 8080
EXPOSE 8080

# Démarrer PHP-FPM et Nginx
CMD php-fpm -D && nginx
