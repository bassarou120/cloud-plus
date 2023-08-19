FROM php:8.1-apache
COPY ./ /var/www/html/


# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    locales \
    zip \
    unzip


RUN docker-php-ext-install bcmath

RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo_mysql


WORKDIR /var/www/html/core

RUN chmod -R 755 /var/www/html/core/storage
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN composer update --ignore-platform-reqs
