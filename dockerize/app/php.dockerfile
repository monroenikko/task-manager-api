FROM php:8.2.0-fpm-alpine

RUN apk add --no-cache \
    bash \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    zlib-dev \
    curl \
    unzip \
    mysql-client \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
