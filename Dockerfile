FROM php:7.3-apache
COPY ./ /var/www/html/



WORKDIR /var/www/html/core
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN composer install
