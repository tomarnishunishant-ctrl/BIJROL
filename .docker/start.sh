#!/usr/bin/env bash
set -e

cd /var/www/html

if [ ! -f .env ]; then
    cp .env.example .env
fi

export APP_ENV="${APP_ENV:-production}"
export APP_DEBUG="${APP_DEBUG:-false}"
export DB_CONNECTION="${DB_CONNECTION:-sqlite}"

if [ -z "${APP_URL:-}" ]; then
    if [ -n "${RENDER_EXTERNAL_URL:-}" ]; then
        export APP_URL="${RENDER_EXTERNAL_URL}"
    elif [ -n "${RENDER_EXTERNAL_HOSTNAME:-}" ]; then
        export APP_URL="https://${RENDER_EXTERNAL_HOSTNAME}"
    fi
fi

if [ -n "${APP_URL:-}" ] && [ -z "${ASSET_URL:-}" ]; then
    export ASSET_URL="${APP_URL}"
fi

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
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

chown -R www-data:www-data storage bootstrap/cache database

apache2-foreground
