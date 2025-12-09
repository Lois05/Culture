# Dockerfile - Nginx + PHP-FPM (officiel)
FROM nginx:alpine

# Installer PHP et extensions
RUN apk add --no-cache \
    php82 \
    php82-fpm \
    php82-pdo \
    php82-pdo_mysql \
    php82-mbstring \
    php82-tokenizer \
    php82-xml \
    php82-curl \
    php82-opcache \
    curl \
    supervisor

# Créer répertoire app
WORKDIR /var/www/html

# Configuration Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Configuration PHP-FPM
RUN mkdir -p /run/php && \
    echo '[www]' > /etc/php82/php-fpm.d/www.conf && \
    echo 'user = nginx' >> /etc/php82/php-fpm.d/www.conf && \
    echo 'group = nginx' >> /etc/php82/php-fpm.d/www.conf && \
    echo 'listen = 127.0.0.1:9000' >> /etc/php82/php-fpm.d/www.conf && \
    echo 'pm = dynamic' >> /etc/php82/php-fpm.d/www.conf && \
    echo 'pm.max_children = 5' >> /etc/php82/php-fpm.d/www.conf && \
    echo 'pm.start_servers = 2' >> /etc/php82/php-fpm.d/www.conf && \
    echo 'pm.min_spare_servers = 1' >> /etc/php82/php-fpm.d/www.conf && \
    echo 'pm.max_spare_servers = 3' >> /etc/php82/php-fpm.d/www.conf

# Configuration Supervisor
RUN echo '[supervisord]' > /etc/supervisor/conf.d/supervisord.conf && \
    echo 'nodaemon=true' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '[program:nginx]' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'command=/usr/sbin/nginx -g "daemon off;"' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'autorestart=true' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '[program:php-fpm]' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'command=/usr/sbin/php-fpm82 -F' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'autorestart=true' >> /etc/supervisor/conf.d/supervisord.conf

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier l'application
COPY . .

# Installer dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Configurer Laravel
RUN echo "APP_ENV=production" > .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_KEY=base64:Gti3PRAou+Mmqb+65OrPIxKlrD+Wc49jVY5po76oBp0=" >> .env && \
    mkdir -p storage/framework/{sessions,views,cache} && \
    chmod -R 775 storage bootstrap/cache && \
    php artisan config:cache && \
    php artisan route:cache

EXPOSE 8080

# Démarrer avec Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
