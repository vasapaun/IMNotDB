
# Stage 0: Build
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    sqlite3 \
    curl \
    npm \
    && docker-php-ext-install pdo pdo_sqlite zip

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install
RUN npm run build

# Ensure database file exists and is writable
RUN touch database/database.sqlite
RUN chmod -R 777 database

# Cache configs, routes, views
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Expose the port
EXPOSE 8000

# Run migrations and seed database on every container start
CMD php artisan migrate --seed && php artisan serve --host=0.0.0.0 --port=8000
