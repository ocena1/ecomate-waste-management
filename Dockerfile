# Railway-optimized Dockerfile for EcoMate System
FROM php:8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY ./app /var/www/html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Configure Apache for Railway
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expose port (Railway will set the PORT environment variable)
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]