FROM node:22-alpine AS assets

WORKDIR /app
COPY package*.json ./
RUN if [ -f package-lock.json ]; then npm ci; else npm install; fi
COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
RUN npm run build

FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libicu-dev \
        libsqlite3-dev \
        libzip-dev \
    && docker-php-ext-install \
        intl \
        pdo_mysql \
        pdo_pgsql \
        pdo_sqlite \
        zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY . .
COPY --from=assets /app/public/build ./public/build
COPY .docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/start.sh /usr/local/bin/start-laravel

RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && chmod +x /usr/local/bin/start-laravel \
    && mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache database \
    && chown -R www-data:www-data storage bootstrap/cache database

EXPOSE 80

CMD ["start-laravel"]
