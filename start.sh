#!/bin/sh

# Determine DB connection details from environment (standard Railway MySQL variables as fallback)
DB_CONN_VAR="mysql"

DB_HOST_VAR="${DB_HOST:-$MYSQLHOST}"
DB_HOST_VAR="${DB_HOST_VAR:-$MYSQL_HOST}"
DB_HOST_VAR="${DB_HOST_VAR:-mysql.railway.internal}"

DB_PORT_VAR="${DB_PORT:-$MYSQLPORT}"
DB_PORT_VAR="${DB_PORT_VAR:-$MYSQL_PORT}"
DB_PORT_VAR="${DB_PORT_VAR:-3306}"

DB_DATABASE_VAR="${DB_DATABASE:-$MYSQLDATABASE}"
DB_DATABASE_VAR="${DB_DATABASE_VAR:-$MYSQL_DATABASE}"
DB_DATABASE_VAR="${DB_DATABASE_VAR:-railway}"

DB_USERNAME_VAR="${DB_USERNAME:-$MYSQLUSER}"
DB_USERNAME_VAR="${DB_USERNAME_VAR:-$MYSQL_USER}"
DB_USERNAME_VAR="${DB_USERNAME_VAR:-root}"

DB_PASSWORD_VAR="${DB_PASSWORD:-$MYSQLPASSWORD}"
DB_PASSWORD_VAR="${DB_PASSWORD_VAR:-$MYSQL_PASSWORD}"

# EXPORT to the shell environment so that PHP child processes (artisan commands, php serve)
# read these values instead of any default container OS environment variables (like DB_CONNECTION=sqlite or APP_ENV=local)!
export APP_ENV=production
export APP_DEBUG=false
export DB_CONNECTION=mysql
export DB_HOST="${DB_HOST_VAR}"
export DB_PORT="${DB_PORT_VAR}"
export DB_DATABASE="${DB_DATABASE_VAR}"
export DB_USERNAME="${DB_USERNAME_VAR}"
export DB_PASSWORD="${DB_PASSWORD_VAR}"
export SESSION_DRIVER=file
export CACHE_STORE=file
export QUEUE_CONNECTION=sync
export LOG_CHANNEL=stderr
export LOG_LEVEL=error

echo "=== Generating .env file from Railway environment ==="
echo "APP_NAME=\"${APP_NAME:-PromptGallery}\"" > .env
echo "APP_ENV=production" >> .env
echo "APP_DEBUG=false" >> .env
echo "APP_URL=${APP_URL:-http://localhost}" >> .env

if [ -n "$APP_KEY" ]; then
  echo "APP_KEY=$APP_KEY" >> .env
  echo "APP_KEY loaded from environment."
else
  echo "APP_KEY=" >> .env
  echo "APP_KEY was missing. Will generate a new one."
fi

echo "DB_CONNECTION=mysql" >> .env
echo "DB_HOST=${DB_HOST}" >> .env
echo "DB_PORT=${DB_PORT}" >> .env
echo "DB_DATABASE=${DB_DATABASE}" >> .env
echo "DB_USERNAME=${DB_USERNAME}" >> .env
echo "DB_PASSWORD=${DB_PASSWORD}" >> .env

echo "SESSION_DRIVER=file" >> .env
echo "CACHE_STORE=file" >> .env
echo "QUEUE_CONNECTION=sync" >> .env
echo "LOG_CHANNEL=stderr" >> .env
echo "LOG_LEVEL=error" >> .env

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

echo "=== Available Environment Keys ===" >> public/start_log.txt
env | cut -d= -f1 | sort | tr '\n' ' ' >> public/start_log.txt
echo "" >> public/start_log.txt

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
