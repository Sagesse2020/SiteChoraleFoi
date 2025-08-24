# Base PHP 8.3 avec Apache
FROM php:8.3-apache

# Installer les dépendances système nécessaires à Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip unzip git curl libpq-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install pdo pdo_mysql pdo_pgsql gd zip

# Activer mod_rewrite pour Laravel
RUN a2enmod rewrite

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier le projet Laravel
WORKDIR /var/www/html
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Permissions correctes pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
 && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configurer Apache pour pointer sur le dossier public/
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Nettoyer cache Laravel pour éviter les erreurs de compilation
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan cache:clear

# Copier et rendre exécutable le script d'entrée
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Exposer le port 80
EXPOSE 80

# Lancer le script d'entrée au démarrage
CMD ["/entrypoint.sh"]
