FROM php:8.2-fpm

# Étape 1: Installation des dépendances système
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    default-jre \
    wkhtmltopdf \
    nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Étape 2: Configuration PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    gd mysqli pdo pdo_mysql zip intl opcache

# Étape 3: Installation de Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Étape 4: Configuration de l'application
WORKDIR /app

# Étape 5: Installation des dépendances frontend
COPY package.json package-lock.json ./
RUN if [ -f package-lock.json ]; then npm ci --no-audit --progress=false; else npm install --no-audit --legacy-peer-deps --progress=false; fi

# Étape 6: Copie du code source
COPY . .

# Étape 7: Build des assets et installation des dépendances PHP
RUN npm run build && \
    composer install --no-dev --optimize-autoloader --no-interaction

# Étape 8: Configuration finale
COPY docker/php-fpm/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]

EXPOSE 9000