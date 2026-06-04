#!/bin/sh

echo "=== Environment Check ==="
echo "PORT: ${PORT}"
echo "APP_ENV: ${APP_ENV}"
if [ -z "$APP_KEY" ]; then
  echo "APP_KEY is NOT set in environment!"
else
  echo "APP_KEY is set. Length: ${#APP_KEY}"
  echo "APP_KEY start: $(echo "$APP_KEY" | cut -c 1-15)..."
fi

echo "=== Clearing stale cache ==="
php artisan config:clear 2>/dev/null || rm -f bootstrap/cache/config.php bootstrap/cache/services.php

echo "=== Running migrations ==="
php artisan migrate --force

echo "=== Seeding database (skip if already exists) ==="
php artisan db:seed --force 2>/dev/null || echo "Seeding skipped - data already exists"

echo "=== Setting up storage ==="
php artisan storage:link 2>/dev/null || true

echo "=== Caching config, routes, views ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Starting Laravel server on port ${PORT:-8080} ==="
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
