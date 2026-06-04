FROM php:8.3-cli

# Install system dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy all project files (including pre-built public/build assets)
COPY . .

# Install PHP dependencies only
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions to allow dynamic file creation/caching
RUN chmod -R 777 storage bootstrap/cache \
    && chmod 777 . \
    && chmod +x start.sh

EXPOSE 8080

CMD ["sh", "start.sh"]
