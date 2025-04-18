FROM php:8.2-fpm

# Dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    default-jre \
    wkhtmltopdf && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# PHP Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) \
    gd \
    mysqli \
    pdo \
    pdo_mysql \
    zip \
    intl \
    opcache

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

WORKDIR /app
COPY . /app/

RUN mkdir -p /tmp/cache /tmp/log /var/tmp/nginx /app/public/uploads/pdf \
    && rm -rf /tmp/cache/* /tmp/log/* /var/tmp/nginx/* /app/var/cache/* /app/var/log/* \
    && chown -R www-data:www-data /tmp/cache /tmp/log /var/tmp/nginx /app/symfony /var/cache /app/var/log \
    && chmod -R 1777 /tmp \
    && chmod -R 777 /app/public/uploads /app/var/cache /app/var/log

CMD ["sh", "-c", "composer install --optimize-autoloader && php bin/console doctrine:schema:update --force && php-fpm"]

EXPOSE 9000