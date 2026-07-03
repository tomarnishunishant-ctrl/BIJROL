#!/usr/bin/env bash
set -e

cd /var/www/html

if [ ! -f .env ]; then
    cp .env.example .env
fi

export APP_ENV="${APP_ENV:-production}"
export APP_DEBUG="${APP_DEBUG:-false}"
export DB_CONNECTION="${DB_CONNECTION:-sqlite}"

if [ -z "${APP_KEY:-}" ]; then
    php artisan key:generate --force --no-interaction
fi

if [ "${DB_CONNECTION}" = "sqlite" ]; then
    export DB_DATABASE="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
    touch database/database.sqlite
fi

php artisan storage:link || true
php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

chown -R www-data:www-data storage bootstrap/cache database

apache2-foreground
