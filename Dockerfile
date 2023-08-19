FROM php:8.1-apache
COPY ./ /var/www/html/


# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    locales \
    zip \
    unzip \



WORKDIR /var/www/html/core
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN composer update --ignore-platform-reqs
