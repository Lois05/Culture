# Dockerfile Laravel fonctionnel
FROM alpine:latest

RUN apk add --no-cache \
    php82 \
    php82-common \
    php82-mbstring \
    php82-xml \
    php82-curl \
    php82-tokenizer \
    php82-pdo \
    php82-pdo_mysql \
    php82-opcache \
    php82-phar \
    curl \
    composer

WORKDIR /var/www/html

# Copier l'application
COPY . .

# Installer Laravel
RUN composer install --no-dev --optimize-autoloader

# Configurer
RUN echo "APP_ENV=production" > .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_KEY=base64:Gti3PRAou+Mmqb+65OrPIxKlrD+Wc49jVY5po76oBp0=" >> .env

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
