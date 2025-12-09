# Dockerfile Laravel pour Railway - Configuration corrigée
FROM webdevops/php-nginx:8.2

WORKDIR /app

# Configuration correcte pour Nginx + PHP-FPM
ENV WEB_DOCUMENT_ROOT /app/public
ENV PHP_FPM_LISTEN 127.0.0.1:9000

# Copier les fichiers
COPY . /app

# Corriger la configuration Nginx pour pointer vers PHP-FPM
RUN echo 'server {' > /opt/docker/etc/nginx/vhost.conf && \
    echo '    listen 80;' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '    server_name _;' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '    root /app/public;' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '    index index.php index.html;' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '    location / {' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '        try_files $uri $uri/ /index.php?$query_string;' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '    }' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '    location ~ \.php$ {' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '        fastcgi_pass 127.0.0.1:9000;' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '        fastcgi_index index.php;' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '        include fastcgi_params;' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '    }' >> /opt/docker/etc/nginx/vhost.conf && \
    echo '}' >> /opt/docker/etc/nginx/vhost.conf

# Corriger la configuration PHP-FPM
RUN echo 'listen = 127.0.0.1:9000' >> /opt/docker/etc/php/php-fpm.d/application.conf && \
    echo 'listen.allowed_clients = 127.0.0.1' >> /opt/docker/etc/php/php-fpm.d/application.conf

# Installer Composer et dépendances
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Cache Laravel
RUN php artisan config:cache && php artisan route:cache

EXPOSE 80

CMD php artisan migrate --force && supervisord -c /opt/docker/etc/supervisor.conf
