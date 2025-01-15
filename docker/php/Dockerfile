# Use the latest PHP 8.3 image with FPM and Alpine for lightweight containerization
FROM php:8.3-fpm-alpine

# Install necessary packages and Composer globally
RUN apk update
RUN apk --no-cache add \
    git \
    curl \
    zip \
    unzip \
    && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Set the working directory inside the container
WORKDIR /app

# Copy the project files into the container
COPY ./project /app

# Install Composer dependencies with optimizations for production
RUN composer install --no-dev --optimize-autoloader

# Rebuild the autoloader for better performance
RUN composer dump-autoload --optimize

# Configure PHP to log errors and specify log file location
RUN echo "error_log = /var/log/php/error.log" >> /usr/local/etc/php/php.ini

# Enable error logging and set error reporting level
RUN echo "log_errors = On" >> /usr/local/etc/php/php.ini \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/php.ini

# Install necessary packages for PostgreSQL
RUN apk --no-cache add postgresql-dev \
php83-pdo_pgsql \
php83-pgsql \
php83-pdo  \
    && docker-php-ext-install pdo_pgsql pgsql

# Ensure the project directory is owned by the web server user
RUN chown -R www-data:www-data /app

# Switch to the non-root user for security
USER www-data

# Expose port 9000 for PHP-FPM
EXPOSE 9000