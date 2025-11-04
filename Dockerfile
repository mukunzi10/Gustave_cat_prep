FROM php:8.1-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    docker-php-ext-enable mysqli pdo pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite headers expires

# Allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Set working directory and copy source
WORKDIR /var/www/html
COPY src/ /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose Apache port
EXPOSE 80

CMD ["apache2-foreground"]
