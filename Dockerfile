# Dockerfile
FROM php:8.1-apache

RUN docker-php-ext-install pdo_mysql

COPY . /var/www/html/

# Ensure Apache's mod_rewrite is enabled
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80
