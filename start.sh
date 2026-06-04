#!/bin/sh

echo "=== Generating .env file from Railway environment ==="
echo "APP_NAME=\"${APP_NAME:-PromptGallery}\"" > .env
echo "APP_ENV=${APP_ENV:-production}" >> .env
echo "APP_DEBUG=${APP_DEBUG:-false}" >> .env
echo "APP_URL=${APP_URL:-http://localhost}" >> .env

if [ -n "$APP_KEY" ]; then
  echo "APP_KEY=$APP_KEY" >> .env
  echo "APP_KEY loaded from environment."
else
  echo "APP_KEY=" >> .env
  echo "APP_KEY was missing. Will generate a new one."
fi

echo "DB_CONNECTION=${DB_CONNECTION:-mysql}" >> .env
echo "DB_HOST=${DB_HOST}" >> .env
echo "DB_PORT=${DB_PORT:-3306}" >> .env
echo "DB_DATABASE=${DB_DATABASE}" >> .env
echo "DB_USERNAME=${DB_USERNAME}" >> .env
echo "DB_PASSWORD=${DB_PASSWORD}" >> .env

echo "SESSION_DRIVER=${SESSION_DRIVER:-file}" >> .env
echo "CACHE_STORE=${CACHE_STORE:-file}" >> .env
echo "QUEUE_CONNECTION=${QUEUE_CONNECTION:-sync}" >> .env
echo "LOG_CHANNEL=${LOG_CHANNEL:-stderr}" >> .env
echo "LOG_LEVEL=${LOG_LEVEL:-error}" >> .env

# Generate fresh key if empty
if [ -z "$APP_KEY" ]; then
  echo "=== Generating fresh APP_KEY ==="
  php artisan key:generate
fi

echo "=== System Info & Permissions ===" > public/start_log.txt
echo "User: $(whoami)" >> public/start_log.txt
echo "Current Dir: $(pwd)" >> public/start_log.txt
ls -la .env >> public/start_log.txt 2>&1
ls -la bootstrap/cache/ >> public/start_log.txt 2>&1

echo "=== Generated .env Content (Masked) ===" >> public/start_log.txt
if [ -f .env ]; then
  cat .env | sed -E 's/DB_PASSWORD=.*/DB_PASSWORD=******/' | sed -E 's/APP_KEY=.*/APP_KEY=******/' >> public/start_log.txt
else
  echo ".env file NOT found!" >> public/start_log.txt
fi

echo "=== Clearing stale cache ===" >> public/start_log.txt
php artisan config:clear >> public/start_log.txt 2>&1 || rm -f bootstrap/cache/config.php bootstrap/cache/services.php

echo "=== Running migrations ===" >> public/start_log.txt
php artisan migrate --force >> public/start_log.txt 2>&1

echo "=== Seeding database (skip if already exists) ===" >> public/start_log.txt
php artisan db:seed --force >> public/start_log.txt 2>&1 || echo "Seeding skipped - data already exists" >> public/start_log.txt

echo "=== Setting up storage ==="
php artisan storage:link 2>/dev/null || true

echo "=== Caching config, routes, views ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Starting Laravel server on port ${PORT:-8080} ==="
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
