# Dockerfile TEST - Vérifie que tout fonctionne
FROM php:8.2-alpine

WORKDIR /var/www/html

# Créer un fichier test simple
RUN echo '<?php echo "Hello Railway! Server is working."; phpinfo(); ?>' > /var/www/html/public/index.php

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
