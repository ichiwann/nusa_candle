# ──────────────────────────────────────────────
# Stage 1: Build Frontend Assets (Vite)
# ──────────────────────────────────────────────
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci || npm install
COPY . .
RUN npm run build

# ──────────────────────────────────────────────
# Stage 2: PHP Application
# ──────────────────────────────────────────────
FROM php:8.4-cli-alpine

WORKDIR /app

RUN apk add --no-cache libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Composer dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Copy application source
COPY . .

# Copy compiled frontend assets from frontend stage
COPY --from=frontend /app/public/build ./public/build

RUN php artisan package:discover --ansi \
    && php artisan storage:link || true \
    && chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
