FROM php:7.3-apache
COPY ./ /var/www/html/


# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html/core


RUN composer install
