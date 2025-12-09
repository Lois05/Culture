# Dockerfile minimal - Test
FROM alpine:latest

RUN apk add --no-cache \
    nginx \
    php82 \
    php82-fpm \
    curl

WORKDIR /var/www/html

# Fichier test simple
RUN echo '<?php echo "Hello Railway! Server is working."; ?>' > index.php

# Config Nginx simple
RUN echo 'server { listen 8080; root /var/www/html; location / { try_files $uri $uri/ /index.php; } location ~ \.php$ { fastcgi_pass 127.0.0.1:9000; include fastcgi_params; } }' > /etc/nginx/http.d/default.conf

EXPOSE 8080

CMD sh -c "php-fpm82 && nginx -g 'daemon off;'"
