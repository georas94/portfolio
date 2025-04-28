FROM php:8.2-fpm

# Ajout de Node.js et npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    default-jre wkhtmltopdf nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    gd mysqli pdo pdo_mysql zip intl opcache

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Construction des assets frontend
COPY package.json package-lock.json /app/
RUN npm ci --no-audit --progress=false
COPY . /app
RUN npm run build

WORKDIR /app

COPY . .

COPY docker/php-fpm/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]

EXPOSE 9000
