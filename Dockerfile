# Utiliser PHP 8.3 avec Apache
FROM php:8.3-apache

# Installer les extensions PHP nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer (gestionnaire de packages PHP)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier ton projet Laravel dans le conteneur
COPY . /var/www/html
WORKDIR /var/www/html

# Installer les dépendances Laravel (sans dev)
RUN composer install --optimize-autoloader --no-dev

# Configurer les permissions pour storage et bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Activer Apache mod_rewrite (nécessaire pour Laravel)
RUN a2enmod rewrite

# Commande de démarrage d’Apache
CMD ["apache2-foreground"]
