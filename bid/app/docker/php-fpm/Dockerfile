# Étape 1 : installer les libs front
FROM node:18 as frontend

WORKDIR /app

COPY package.json ./
RUN yarn install --frozen-lockfile || yarn install

RUN mkdir -p public/vendor/leaflet && \
    cp node_modules/leaflet/dist/* public/vendor/leaflet/

COPY assets/ ./assets

# Étape 2 : PHP-FPM
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    default-jre wkhtmltopdf \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    gd mysqli pdo pdo_mysql zip intl opcache

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app

COPY . .

COPY docker/php-fpm/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]

EXPOSE 9000
