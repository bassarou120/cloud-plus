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

RUN chmod -R 777 /var/www/html/core/storage
RUN chmod -R 777 /var/www/html/core/bootstrap/cache/
RUN chmod -R 777 /var/www/html/core/storage/app/
RUN chmod -R 777 /var/www/html/core/storage/logs/


# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


#RUN composer  install
#RUN composer update --ignore-platform-reqs


ARG DB_CONNECTION=${DB_CONNECTION}
ARG DB_HOST=${DB_HOST}
ARG DB_PORT=${DB_PORT}
ARG DB_DATABASE=${DB_DATABASE}
ARG DB_USERNAME=${DB_USERNAME}
ARG DB_PASSWORD=${DB_PASSWORD}
