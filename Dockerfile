FROM node:22-alpine AS assets

WORKDIR /app

COPY package*.json vite.config.js ./
COPY resources ./resources

RUN npm install && npm run build

FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    libpng-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring dom \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

ENV APP_ENV=production \
    APP_DEBUG=false

COPY . .

COPY --from=assets /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader

COPY docker/start.sh /usr/local/bin/start

RUN chmod +x /usr/local/bin/start \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD ["start"]
