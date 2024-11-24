FROM php:8.3-fpm-alpine

RUN apk --no-cache add \
    git \
    curl \
    zip \
    unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/project

COPY ./project /var/www/project

RUN composer install --no-dev --optimize-autoloader

RUN composer dump-autoload --optimize

RUN echo "error_log = /var/log/php/error.log" >> /usr/local/etc/php/php.ini

RUN echo "log_errors = On" >> /usr/local/etc/php/php.ini \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/php.ini \
    && echo "display_errors = Off" >> /usr/local/etc/php/php.ini

RUN chown -R www-data:www-data /var/www/project

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
