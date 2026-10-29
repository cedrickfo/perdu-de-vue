
# Étape 1 : compiler les fichiers CSS et JavaScript
FROM node:22-alpine AS assets

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

# Étape 2 : installer Laravel avec PHP 8.4
FROM php:8.4-cli-bookworm

RUN apt-get update && apt-get install -y \
    git unzip libsqlite3-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo_sqlite mbstring zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

COPY --from=assets /app/public/build /app/public/build

RUN composer install --no-dev --no-interaction \
    --prefer-dist --optimize-autoloader

RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000


CMD ["sh", "/app/start.sh"]
