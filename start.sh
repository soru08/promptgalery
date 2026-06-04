#!/bin/sh

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
