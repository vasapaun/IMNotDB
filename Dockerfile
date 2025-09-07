# Use official PHP + Composer image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    unzip \
    git \
    curl \
    npm \
    nodejs \
    libonig-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install
RUN npm run build

# Cache configs and routes
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Expose port 8000
EXPOSE 8000

# Create the database
RUN touch /var/www/html/database/database.sqlite

# Startup command: run migrations and seed every time, then serve
CMD php artisan migrate:fresh --seed --force && php artisan serve --host=0.0.0.0 --port=8000
