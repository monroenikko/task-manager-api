FROM php:8.2.0-fpm-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    bash \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    zlib-dev \
    mysql-client \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    intl

WORKDIR /var/www/html
